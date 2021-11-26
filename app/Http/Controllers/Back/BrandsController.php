<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(10);

        return view('back.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.brands.create');
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

        Brand::create($data);

        flash('Brands created.')->success();

        return redirect()->route('back.brands.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('back.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        if($request->slug != $brand->slug) {
            $check = Brand::select('id')->where('slug', $request->slug)->first();

            if(!is_null($check)) {
                return redirect()->back()->withInput()->withErrors('The slug has already been taken.');
            }
        }

        $brand->update($data);

        flash('Brand updated.')->success();

        return redirect()->route('back.brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        flash('Brand removed.')->success();

        return redirect()->route('back.brands.index');
    }
}
