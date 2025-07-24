<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(20);
        return view('admin.modules.product.index',['products'=>$products]);
    }

    public function create()
    {
        $categories = Category::get();
         return view('admin.modules.product.create',['categories'=>$categories]);
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated() ;
        Product::create($data) ;
        return redirect()->route('product.index') 
                     ->with('success', 'Product created successfully!');
    }


    public function edit(Product $product)
    {
        $categories = Category::get();
         return view('admin.modules.product.edit',['categories'=>$categories , 'product'=>$product]);
    }

    public function update(StoreProductRequest $request , Product $product)
    {
        $data = $request->validated() ;
        $product->update($data) ;
        return redirect()->route('product.index') 
                     ->with('success', 'Product update successfully!');
    }

    public function delete(Client $client)
    {
        
    }
}
