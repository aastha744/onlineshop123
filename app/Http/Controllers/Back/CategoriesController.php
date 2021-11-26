<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view('back.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:categories,slug',
            'status' => 'required|in:Active,Inactive',
        ]);

        Category::create($data);

        flash('Categories created.')->success();

        return redirect()->route('back.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('back.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        if($request->slug != $category->slug) {
            $check = Category::select('id')->where('slug', $request->slug)->first();

            if(!is_null($check)) {
                return redirect()->back()->withInput()->withErrors('The slug has already been taken.');
            }
        }

        $category->update($data);

        flash('Category updated.')->success();

        return redirect()->route('back.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        flash('Category removed.')->success();

        return redirect()->route('back.categories.index');
    }
}
