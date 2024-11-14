<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show the list of items for the dashboard
    public function index()
    {
        $products = Product::all();  // Get all products
        return view('marketplace.dashboard', compact('products'));
    }

    // Show the form for editing a product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('marketplace.edit', compact('product'));
    }

    // Update the product
    public function update(Request $request, $id)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
    ]);

    $product = Product::findOrFail($id);
    $product->update($request->all());

    // Update the status based on the quantity
    if ($product->quantity > 0) {
        $product->status = 'In Stock';
    } else {
        $product->status = 'Out of Stock';
    }
    $product->save();

    return redirect()->route('marketplace.dashboard')->with('success', 'Product updated successfully!');
    }


    public function destroy($id)
    {
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->route('marketplace.dashboard')->with('success', 'Product deleted successfully!');
    }

}
