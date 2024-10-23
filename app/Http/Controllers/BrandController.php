<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function brand()
    {
        return view("viewbrand", ['brands' => Brand::all()]);
    }
    public function viewbrand()
    {
        return view("addbrand");
    }

    public function addbrand(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        if (Brand::where('name', $validatedData['name'])->exists()) {
            return redirect('/addbrand')->with('fail', 'Brand already exists!');
        }
        $brand = new Brand;
        $brand->name = $validatedData['name'];
        $brand->save();

        return redirect('/addbrand')->with('Success', 'Brand Added!');
    }

    public function deleteData($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return redirect('/brand')->with('Success', ' Data Deleted!!');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('editbrand', ['fetchedbrand' => $brand]);
    }

    public function update($id, Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:10',
        ]);


        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->save();
        return redirect('/brand')->with('Success', ' Data Updated!!');
    }
}
