<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{


    public function index()
    {
        // Fetch orders with orderItems, ordered by created_at in descending order
        $orders = Order::where('user_id', auth()->id())
            ->with('orderItems') // Eager load orderItems only
            ->orderBy('created_at', 'desc') // Order by created_at descending
            ->get();

        // Create an array to store product names
        $productIds = [];
        foreach ($orders as $order) {
            foreach ($order->orderItems as $item) {
                $productIds[] = $item->product_id; // Collect product IDs
            }
        }

        // Fetch product names based on IDs
        $products = \App\Models\Product::whereIn('id', $productIds)->get()->keyBy('id');

        return view('orders.index', compact('orders', 'products'));
    }
}
