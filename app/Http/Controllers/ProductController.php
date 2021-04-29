<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\SisterConcern;
use App\Model\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('unit', 'sisterConcern')->get();

        return view('administrator.product.all', compact('products'));
    }

    public function add() {
        $sisterConcerns = SisterConcern::orderBy('name')->get();
        $units = Unit::orderBy('name')->get();

        return view('administrator.product.add', compact('units', 'sisterConcerns'));
    }

    public function addPost(Request $request) {
        $request->validate([
            'sister_concern' => 'required',
            'name' => 'required|string|max:255',
            'unit' => 'required',
            'code' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'status' => 'required'
        ]);

        $product = new Product();
        $product->sister_concern_id = $request->sister_concern;
        $product->name = $request->name;
        $product->unit_id = $request->unit;
        $product->code = $request->code;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->save();

        return redirect()->route('product')->with('message', 'Product add successfully.');
    }

    public function edit(Product $product) {
        $sisterConcerns = SisterConcern::orderBy('name')->get();
        $units = Unit::orderBy('name')->get();

        return view('administrator.product.edit', compact('units', 'product', 'sisterConcerns'));
    }

    public function editPost(Product $product, Request $request) {
        $request->validate([
            'sister_concern' => 'required',
            'name' => 'required|string|max:255',
            'unit' => 'required',
            'code' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'status' => 'required'
        ]);

        $product->sister_concern_id = $request->sister_concern;
        $product->name = $request->name;
        $product->unit_id = $request->unit;
        $product->code = $request->code;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->save();

        return redirect()->route('product')->with('message', 'Product edit successfully.');
    }
}
