<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function viewCart()
    {
        // Retrieve cart from session, default to empty array if it doesn't exist
        $cart = session()->get('cart', []);
        return view('cart.view', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->pname,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function placeOrder(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to place your order.');
        }

        $user = Auth::user();
        $address = Address::where('user_id', $user->id)->first();

        if (!$address) {
            return redirect()->route('addresses.create')->with('error', 'Please add your address before placing an order.');
        }

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        foreach ($cart as $id => $details) {
            $product = Product::find($id);

            if (!$product) {
                return redirect()->back()->with('error', 'Product not found!');
            }

            if ($product->quantity < $details['quantity']) {
                return redirect()->back()->with('error', 'Product "' . $product->pname . '" does not have enough stock.');
            }
        }

        $order = Order::create([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'status' => 'pending',
            'total_amount' => $this->calculateTotal($cart),
            'address_id' => $address->id,
        ]);

        foreach ($cart as $productId => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }

        session()->forget('cart');
        return redirect()->route('payment.show', ['order' => $order->id])->with('success', 'Please select the payment Option!');
    }

    // Method to calculate the total amount of the cart
    private function calculateTotal($cart)
    {
        $total = 0;

        foreach ($cart as $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return $total;
    }
}
