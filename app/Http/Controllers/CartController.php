<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
 

    public function add(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        // Log validated data
        \Log::info('Adding to cart', $validated);
    
        // Find the product
        $product = Product::find($request->input('product_id'));
    
        if (!$product) {
            \Log::error('Product not found', ['product_id' => $request->input('product_id')]);
            return redirect()->route('shop.index')->withErrors('Product not found');
        }
    
        // Check if the product already exists in the cart
        $cartItem = Cart::where('users_id', auth()->id())
                        ->where('product_id', $product->id)
                        ->first();
    
        if ($cartItem) {
            // If the product is already in the cart, increment the quantity
            \Log::info('Product found in cart, updating quantity', ['cart_item' => $cartItem]);
            $cartItem->quantity += $request->input('quantity');
            $cartItem->save();
        } else {
            // If the product is not in the cart, create a new entry
            \Log::info('Creating new cart item', ['product_id' => $product->id, 'quantity' => $request->input('quantity')]);
            Cart::create([
                'users_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $request->input('quantity')
            ]);
        }
    
        return redirect()->route('marketdash')->with('message', 'Product added to cart!');
    }
    

    public function show()
    {
    // Retrieve all cart items for the authenticated user
    $cartItems = Cart::where('users_id', auth()->id())->get();
    // Calculate the total cost of items in the cart
    $total = $cartItems->reduce(function ($carry, $item) {
        return $carry + ($item->product->price * $item->quantity);
    }, 0);

    // Return the cart view with cart items and total cost
    return view('marketplace.show', compact('cartItems', 'total'));
    }



   // Update quantity of an item in the cart
   public function update(Request $request)
   {
       $cartItem = Cart::find($request->item_id);
       if ($cartItem) {
           $cartItem->quantity = $request->quantity;
           $cartItem->save();
           return redirect()->back()->with('message', 'Quantity updated successfully.');
       }
       return redirect()->back()->with('message', 'Item not found.');
   }

   // Delete an item from the cart
   public function delete(Request $request)
   {
       $cartItem = Cart::find($request->item_id);
       if ($cartItem) {
           $cartItem->delete();
           return redirect()->back()->with('message', 'Item deleted successfully.');
       }
       return redirect()->back()->with('message', 'Item not found.');
   }

   // Checkout process
   public function checkout()
   {
       // Implement checkout logic here.
       return redirect()->route('marketplace')->with('message', 'Checkout completed successfully!');
   }
}
