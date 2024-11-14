<?php

namespace App\Http\Controllers;

use App\Models\Product_details;
use Illuminate\Http\Request;

class Product_detailsController extends Controller
{
    public function index()
    {
        $product_details = Product_details::all();
        return view('product_details.index', compact('product_details'));
    }

    public function create()
    {
        return view('product_details.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'size' => 'required',
        ]);

        Product_details::create($request->all());

        return redirect()->route('product_details.index')
                         ->with('success', 'Product details created successfully.');
    }

    public function show(Product_details $product_details)
    {
        return view('product_details.show', compact('product_details'));
    }

    public function edit(Product_details $product_details)
    {
        return view('product_details.edit', compact('product_details'));
    }

    public function update(Request $request, Product_details $product_details)
    {
        $request->validate([
            'size' => 'required',
        ]);

        $product_details->update($request->all());

        return redirect()->route('product_details.index')
                         ->with('success', 'Product details updated successfully.');
    }

    public function destroy(Product_details $product_details)
    {
        $product_details->delete();

        return redirect()->route('product_details.index')
                         ->with('success', 'Product details deleted successfully.');
    }
}