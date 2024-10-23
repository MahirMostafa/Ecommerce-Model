<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class ProductController extends Controller
{
    public function products()
    {
        if (Session::has('LoginId')) {
            $userId = Session::get('LoginId');
            return view("products", ['categories' => Category::all()], ['brands' => Brand::all()]);
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
            'quantity' => 'required|integer|min:1',
            'buying-price' => 'required|numeric|min:0',
            'selling-price' => 'required|numeric|min:0',
            'file_input' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB Max
            'description' => 'required|string',
            'status' => 'required',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id'

        ]);


        if ($request->hasFile('file_input')) {
            $filePath = $request->file('file_input')->store('products', 'public');
        } else {
            return redirect('/products')->with('fail', 'image upload failed!');
        }


        $product = new Product;
        $product->pname = $validatedData['product-name'];
        $product->quantity = $validatedData['quantity'];
        $product->buying_price = $validatedData['buying-price'];
        $product->price = $validatedData['selling-price'];
        $product->image = $filePath;
        $product->description = $validatedData['description'];
        $product->status = $validatedData['status'];
        $product->category_id = $validatedData['category_id'];
        $product->brand_id = $validatedData['brand_id'];


        $product->save();

        return redirect('/products')->with('Success', 'Product created successfully!');
    }

    public function viewproducts()
    {
        return view('viewproducts', ['products' => Product::all()]);
    }
}
