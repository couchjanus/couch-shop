<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\{Product, Category};
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->pluck('name', 'id');
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description, 
            'category_id'=>$request->category_id, 
            'status'=>$request->status,
            'recommended'=> ($request->recommended =='on')?1:0, 
            'cover' => $this->uploadImage($request->file("cover")),
        ]);

        return redirect()->route('admin.products.index')->withSuccess('Product Created Successfully');
    }
    
    public function uploadImage(UploadedFile $file) : string
    {
        $filename = time() . "." . $file->getClientOriginalExtension();
        $img = Image::make($file);
        $img->resize(220, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save(storage_path('app/public/covers')."/".$filename);
        return asset("storage/covers/". $filename);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all()->pluck('name', 'id');
        return view('admin.products.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = [
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'category_id'=>$request->category_id,
            'status'=>$request->status,
            'recommended'=> ($request->recommended =='on')?1:0,
        ];

        if($request->file("cover")) {
            Storage::delete("public/covers/" . $product->cover);
            $data += ["cover" => $this->uploadImage($request->file("cover"))]; 
        } else {
            $data += ["cover" => $product->cover]; 
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->withSuccess('Product has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Storage::delete("public/covers/{$product->cover}");
        $product->delete();
        return redirect()->route('admin.products.index')->withSuccess('Product deleted successfully');
    }
}
