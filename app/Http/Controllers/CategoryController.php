<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category()
    {
        return view("viewcategory", ['categories' => Category::all()]);
    }
    public function viewcategory()
    {
        return view("addcategory");
    }

    public function addcategory(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        if (Category::where('name', $validatedData['name'])->exists()) {
            return redirect('/addcategory')->with('fail', 'Category already exists!');
        }
        $category = new Category;
        $category->name = $validatedData['name'];
        $category->save();

        return redirect('/addcategory')->with('Success', 'Category Added!');
    }

    public function deleteData($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect('/category')->with('Success', ' Data Deleted!!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('editcategory', ['fetchedcategory' => $category]);
    }

    public function update($id, Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:10',
        ]);


        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();
        return redirect('/category')->with('Success', ' Data Updated!!');
    }
}
