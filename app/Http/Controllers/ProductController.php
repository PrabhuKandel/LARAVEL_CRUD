<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {

        return view('products.index',['products'=>Product::latest()->paginate(5)]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {

        //validate image

        $request->validate([

            'name'=>'required',
            'price'=>'required|numeric',
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:10000'
        ]);
        //upload image
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('products'),$imageName);
        

        $product = new Product;
        $product->image = $imageName;
        $product->name =  $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save(); 
        return back()->withSuccess('Product Created !!!!');
    }

    public function edit(String $id)
    {
        $product = Product::where('id',$id)->first();
        return view('products.edit',['product'=> $product]);
    }

    public function update(Request $request,$id)
    {
        $request->validate([

            'name'=>'required',
            'price'=>'required|numeric',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg|max:10000'
        ]);

        $product = Product::where('id',$id)->first();
        //upload image
        if(isset($request->image))
        {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('products'),$imageName);
        $product->image = $imageName;
        }
        

    
       
        $product->name =  $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save(); 
        return back()->withSuccess('Product Updated !!!!');

    }
    public function destroy($id)
    {

        $product = Product::where('id',$id)->first();
        $product->delete();
        return back()->withSuccess('Product deleted!!!!!');
    }
    public function show($id)
    {
        $product = Product::where('id',$id)->first();
       
        return view('products.show',['product'=>$product]);

    }
}
