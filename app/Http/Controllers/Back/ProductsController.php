<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('back.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.products.create');
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
            'slug' => 'required|string|unique:products,slug',
            'summary' => 'required|string',
            'details' => 'required|string',
            'price' => 'required|numeric',
            'stock_qty' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'files.*' => 'image',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'status' => 'required|in:Active,Inactive',
            'featured' => 'required|in:Yes,No',
        ]);

        $images = [];

        foreach ($request->files->all('files') as $file) {
            $img = Image::make($file);
            $filename = "img_".date('YmdHis')."_".rand(1000,9999).".jpg";
            $img->resize(1280, 720, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save('public/images/'.$filename);

            $images[] = $filename;
        }

        $data['images'] = $images;

        Product::create($data);

        flash('Product created.')->success();

        return redirect()->route('back.products.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('back.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
            'summary' => 'required|string',
            'details' => 'required|string',
            'price' => 'required|numeric',
            'stock_qty' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'files.*' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'status' => 'required|in:Active,Inactive',
            'featured' => 'required|in:Yes,No',
        ]);
        if($request->slug != $product->slug) {
            $check = Product::select('id')->where('slug', $request->slug)->first();

            if(!is_null($check)) {
                return redirect()->back()->withInput()->withErrors('The slug has already been taken.');
            }
        }

        $images = $product->images;

        if($request->files->count() > 0) {

            foreach ($request->files->all('files') as $file) {
                $img = Image::make($file);
                $filename = "img_" . date('YmdHis') . "_" . rand(1000, 9999) . ".jpg";
                $img->resize(1280, 720, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save('public/images/' . $filename);

                $images[] = $filename;
            }
        }
        $data['images'] = $images;

        $product->update($data);

        flash('Product updated.')->success();

        return redirect()->route('back.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $images = $product->images;

        foreach($images as $image) {
            @unlink('/public/images/' . $image);
        }
        $product->delete();

        flash('Product removed.')->success();

        return redirect()->route('back.products.index');
    }

    public function destroyImage(Product $product, $filename)
    {
        $images = $product->images;

        if(count($images) > 1) {
            $new = [];

            foreach($images as $image) {
                if($image != $filename) {
                    $new[] = $image;
                }
            }

            @unlink('/public/images/' . $filename);

            $product->update([
                'images' => $new
            ]);

            flash('Image removed.')->success();
        }
        else {
            flash('Product must have at least one image.')->error();
        }
    }
}

