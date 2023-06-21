<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::latest()->paginate(5);
        return view('products',['products' => $products]);
    }
    public function addProduct(Request $request)
    {
        $name = $request->name;
        $price = $request->price;
        $product = new Product();
        $product->name = $name;
        $product->price = $price;
        $product->save();
        $products = Product::latest()->paginate(5);
        $view = view('render.paginations_products', ['products' => $products])->render();

        return response()->json([
            'view' => $view,
            'status' => 'success'
        ]);
        
    }
    
    public function updateProduct(Request $request)
    {
        $name = $request->name;
        $price = $request->price;
        $id = $request->id;
        Product::find($id)->update([
            'name' => $name,
            'price' => $price
        ]);
        

        $products = Product::latest()->paginate(5);
        $view = view('render.paginations_products', ['products' => $products])->render();

        return response()->json([
            'view' => $view,
            'status' => 'success'
        ]);
        
    }

    public function searchProduct(Request $request)
    {
        $searchString = $request->search_string;
        $products = Product::where('name','like','%'.$searchString.'%')
                        ->orWhere('price','like','%'.$searchString.'%')
                        ->orderBy('id','desc')
                        ->paginate(5);
        return view('render.paginations_products',['products' => $products])->render();
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        $products = Product::latest()->paginate(5);
        $view = view('render.paginations_products', ['products' => $products])->render();

        return response()->json([
            'view' => $view,
            'status' => 'success'
        ]);
    }
}
