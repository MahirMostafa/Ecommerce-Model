<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\InventoryTransaction;

class InventoryTransactionController extends Controller
{
    public function showHistory()
    {
        return view('transactions.history');
    }


    public function transactionHistory(Request $request)
    {
        $productId = $request->input('product_id');

        if (!$productId) {
            return redirect()->back()->with('noProductMessage', 'Please enter a valid product ID.');
        }

        $product = Product::find($productId);

        if (!$product) {
            return view('transactions.history')->with('noProductMessage', 'Product not found.');
        }

        $transactions = InventoryTransaction::where('product_id', $productId)->get();

        return view('transactions.history', compact('product', 'transactions'));
    }
}
