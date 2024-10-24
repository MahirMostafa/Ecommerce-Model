<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\InventoryTransaction; // Import the InventoryTransaction model

class InventoryController extends Controller
{
    public function getAddToInventory()
    {
        // Fetch all products
        $products = Product::all();

        // Return the view with the products to populate the form
        return view('inventory.add', ['products' => $products]);
    }



    public function addToInventory(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'buying_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
        ]);

        $productId = $validatedData['product_id'];
        $newQuantity = $validatedData['quantity'];
        $newBuyingPrice = $validatedData['buying_price'];
        $newSellingPrice = $validatedData['selling_price'];

        // Check if the inventory already has this product
        $inventory = Inventory::where('product_id', $productId)->first();

        if ($inventory) {
            // Update quantity and recalculate prices
            $currentQuantity = $inventory->quantity;
            $totalQuantity = $currentQuantity + $newQuantity;

            // Recalculate weighted average for buying price
            $inventory->buying_price = (($currentQuantity * $inventory->buying_price) + ($newQuantity * $newBuyingPrice)) / $totalQuantity;

            // Optionally, you can recalculate the selling price similarly, or just overwrite it
            $inventory->selling_price = (($currentQuantity * $inventory->selling_price) + ($newQuantity * $newSellingPrice)) / $totalQuantity;

            // Update the total quantity
            $inventory->quantity = $totalQuantity;
            $inventory->save();
        } else {
            // Create a new inventory entry if none exists for the product
            $inventory = Inventory::create([
                'product_id' => $productId,
                'quantity' => $newQuantity,
                'buying_price' => $newBuyingPrice,
                'selling_price' => $newSellingPrice,
            ]);
        }

        // Log this restocking event in the inventory_transactions table
        InventoryTransaction::create([
            'product_id' => $productId,
            'quantity' => $newQuantity,
            'buying_price' => $newBuyingPrice,
            'selling_price' => $newSellingPrice,
        ]);

        return redirect()->back()->with('success', 'Inventory updated and restock logged successfully!');
    }
}
