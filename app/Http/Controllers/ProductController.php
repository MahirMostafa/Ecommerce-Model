<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Inventory; // Import the Inventory model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function products()
    {
        if (Session::has('LoginId')) {
            $userId = Session::get('LoginId');
            return view("products", ['categories' => Category::all(), 'brands' => Brand::all()]);
        }
        return redirect('/login')->with('error', 'Please log in first.');
    }

    public function home(Request $request)
    {
        $categories = Category::all();
        $brands = Brand::all();

        $query = Product::query();

        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('brand_id') && $request->brand_id) {
            $query->where('brand_id', $request->brand_id);
        }

        $products = $query->get();

        return view('welcome', compact('products', 'categories', 'brands'));
    }

    public function productstore(Request $request)
    {
        $validatedData = $request->validate([
            'product-name' => 'required|string|max:255',
            'file_input' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB Max
            'description' => 'required|string',
            'status' => 'required',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id'
        ]);

        // Handle file upload
        if ($request->hasFile('file_input')) {
            $filePath = $request->file('file_input')->store('products', 'public');
        } else {
            return redirect('/products')->with('fail', 'Image upload failed!');
        }

        // Create the product
        $product = new Product;
        $product->pname = $validatedData['product-name'];
        $product->image = $filePath;
        $product->description = $validatedData['description'];
        $product->status = $validatedData['status'];
        $product->category_id = $validatedData['category_id'];
        $product->brand_id = $validatedData['brand_id'];

        $product->save();

        return redirect('/products')->with('Success', 'Product created successfully!');
    }

    public function addToInventory(Request $request, $productId)
    {
        // Validate the request data for inventory
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1',
            'buying-price' => 'required|numeric|min:0',
            'selling-price' => 'required|numeric|min:0',
        ]);

        // Find the product to add inventory
        $product = Product::findOrFail($productId);

        // Create or update the inventory entry for this product
        $inventory = Inventory::firstOrNew(['product_id' => $product->id]);
        $inventory->quantity = $validatedData['quantity'];
        $inventory->buying_price = $validatedData['buying-price'];
        $inventory->selling_price = $validatedData['selling-price'];

        $inventory->save(); // Save inventory

        return redirect('/products')->with('Success', 'Inventory updated successfully!');
    }

    public function viewproducts()
    {
        // Fetch all products with their related inventory
        $products = Product::with('inventory')->get();

        return view('viewproducts', ['products' => $products]);
    }
}
