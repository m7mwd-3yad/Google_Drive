<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoies =  Category::paginate(500);
        return view('category.index',compact('categoies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:20|unique:categories,title',
            'description' => 'required|string|min:10|max:50',
        ]);
        $category = new Category();
        $category->title = $request->title;
        $category->description = $request->description;
        $category->save();
        return redirect()->back()->with('done', 'Create Category Successfully');
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
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:20',
            'description' => 'required|string|min:10|max:50',
        ]);
        $category = Category::find($id);
        $category->title = $request->title;
        $category->description = $request->description;
        $category->save();
        return redirect()->route('category.index')->with('done', 'Updated Category Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            $category = Category::find($id);

            $category->delete();

            return redirect()->route('category.index')->with('done', 'Deleted Successfully');

    }
}
