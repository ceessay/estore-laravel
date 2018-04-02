<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    
    public function create()
    {
        return view('admin.product.create');
    }
    
    public function store(Request $request)
    {
        $product = $this->validate(
            request(), [
                'name' => 'required',
                'price'=> 'required|numeric'
                ]
        );   


        // dd($product);
        Product::create($product);
        return back()->with('success', 'product added succesfully');
        // return;
    }


    public function index()
    {
        $products = Product::all()->toArray();
        return view('admin.product.index', compact('products'));
    }

    public function edit ($id)
    {
        $product = Product::find($id);
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id); 
        $this->validate(
            request(), [
                'name' => 'required',
                'price'=> 'required|numeric'
                ]
        );
        
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->save();
        // return back()->with('success', 'product updated succesfully');
        return redirect('products')->with('success', 'product updated succesfully');
        
    } 


    public function destroy ($id)
    {
        $product = Product::find($id);
        $product->delete();
        // return view('admin.product.edit', compact('product'));
        return redirect('products')->with('success', 'product deleted succesfully');

    }


}
