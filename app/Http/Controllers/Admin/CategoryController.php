<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::all();
        return view('dashboard.Categories.index_categories',compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('dashboard.Categories.create_categories');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $this->validate($request,[
        'name' => 'required|string',
        'description' => 'required|string'
       ]);

    Category::create([ 
    'name' => $request->name,
    'description' => $request->description,

     ]);
   return redirect()->route('categories.index')->with('success', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
{
    return view('dashboard.Categories.edit_categories', compact('category'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
{
    $request->validate([
        'name' => 'required|string',
        'description' => 'required|string'
    ]);

    $category->update([
        'name' => $request->name,
        'description' => $request->description
    ]);

    return redirect()->route('categories.index')
                     ->with('success', 'Category updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
           return redirect()->route('categories.index')->with('success', 'Product Deleted successfully');
    }
}
