<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('payments.show', compact('order')); // Show payment options
    }
    public function store(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        // Get the selected payment method
        $paymentMethod = $request->input('method');

        // Handle Online Payment via Stripe
        if ($paymentMethod == 'online') {
            // Create a "pending" payment record before redirecting to Stripe
            Payment::create([
                'order_id' => $order->id,
                'user_id' => auth()->id(),
                'amount' => $order->total_amount,
                'method' => 'online',
                'status' => 'pending'  // Initially marked as pending until payment is confirmed
            ]);

            // Redirect to Stripe checkout
            return redirect()->route('stripe.checkout', ['order_id' => $order->id]);
        }

        // Handle Cash on Delivery (COD) option
        if ($paymentMethod == 'COD') {
            Payment::create([
                'order_id' => $order->id,
                'user_id' => auth()->id(),
                'amount' => $order->total_amount,
                'method' => 'COD',
                'status' => 'pending'  // Mark as pending until delivery
            ]);

            // Update the order status for COD
            $order->update(['status' => 'pending_delivery']);

            return redirect()->route('orders.index')->with('success', 'Order placed successfully with Cash on Delivery.');
        }

        return back()->with('error', 'Invalid payment method selected.');
    }


    public function stripeCheckout($orderId)
    {
        $order = Order::findOrFail($orderId);

        // Initialize Stripe (Assuming you've set up your Stripe keys in env file)
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create a Stripe checkout session
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Order #' . $order->id,
                    ],
                    'unit_amount' => $order->total_amount * 100, // Amount in cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', $order->id),
            'cancel_url' => route('payment.cancel', $order->id),
        ]);

        // Redirect to Stripe's hosted checkout page
        return redirect($session->url);
    }
    public function paymentSuccess($orderId)
    {
        $order = Order::findOrFail($orderId);

        // Find the pending payment for this order and update its status to paid
        Payment::where('order_id', $order->id)->update(['status' => 'paid']);

        // Update the order status to confirmed
        $order->update(['status' => 'confirmed']);

        return redirect()->route('orders.index')->with('success', 'Payment successful. Your order is confirmed.');
    }


    public function paymentCancel($orderId)
    {
        // Payment was cancelled, simply redirect with a message
        return redirect()->route('orders.index')->with('error', 'Payment was canceled.');
    }
}
