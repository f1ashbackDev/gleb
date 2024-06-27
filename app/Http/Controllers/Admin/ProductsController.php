<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Catalogs;
use App\Models\Image;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        return view('new_admin.product',[
            'products' => Products::all()
        ]);
    }

    public function create()
    {
        return view('new_admin.product-add', [
           'categories' => Catalogs::all()
        ]);
    }

    public function store(ProductRequest $request)
    {
        $path = $request->file('image')->store('products', 'public');
        Products::create([
            'name' => $request->name,
            'count' => $request->count,
            'price' => $request->price,
            'image' => $path,
            'description' => $request->description
        ]);
        return redirect()->route('admin.products.index');
    }

    public function edit(Products $products)
    {
        return view('new_admin.product-edit', [
           'product' => $products,
           'image' => $products->image,
           'name_category' => $products->category->categories_name,
            'category' => Catalogs::all()
        ]);
    }

    public function update(Request $request, Products $products)
    {
        $products->update($request->all());
        return redirect()->route('admin.products.index');
    }

    public function delete(Products $products)
    {
        Storage::disk('public')->delete($products->image);
        $products->delete();
        return redirect()->route('admin.products.index');
    }
}
