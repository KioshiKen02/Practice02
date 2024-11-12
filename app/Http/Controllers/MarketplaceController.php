<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;


class MarketplaceController extends Controller
{
    public function index()
    {
       
        $products = Product::all();  // Retrieve all products from the database
        $cartQuantity = Cart::where('users_id', auth()->id())->sum('quantity'); 
        return view('marketdash', compact('products', 'cartQuantity'));
    }


    public function store(Request $request) {
        if (!auth()->check()) {
            return redirect()->route('login'); // Redirect to login page if the user is not authenticated
        }
    
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // For file uploads
        ]);
    
        // Handle the image file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');  // Store in public/images
        }
    
        // Create a new product with the authenticated user's ID and the image path
        Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'quantity' => $validated['quantity'],
            'image' => $imagePath ?? null,  // If image was uploaded, store the file path
            'users_id' => auth()->id(),  // Set the current user's ID
        ]);
    
        return redirect()->route('marketdash')->with('success', 'Product added successfully!');
    }
    

    public function create()
    {
        return view('marketplace.create');
    }
    
}
