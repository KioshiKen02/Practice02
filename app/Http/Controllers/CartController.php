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
        'product_id' => 'required|exists:products,id', // Ensure product exists in the database
        'quantity' => 'required|integer|min:1', // Quantity must be at least 1
    ]);

    // Find the product using the validated product_id
    $product = Product::findOrFail($request->input('product_id'));

    // Check if the requested quantity is greater than available stock
    if ($request->quantity > $product->quantity) {
        // Redirect back with an error message if quantity exceeds stock
        return redirect()->back()->with('error', 'Not enough stock available!');
    }

    // Check if the product already exists in the cart
    $cartItem = Cart::where('users_id', auth()->id())
                    ->where('product_id', $product->id)
                    ->first();

    if ($cartItem) {
        // If the product is already in the cart, increment the quantity
        $newQuantity = $cartItem->quantity + $request->quantity;

        // Ensure the new quantity does not exceed available stock
        if ($newQuantity > $product->quantity) {
            return redirect()->back()->with('error', 'Not enough stock available!');
        }

        // Update the quantity
        \Log::info('Product found in cart, updating quantity', ['cart_item' => $cartItem]);
        $cartItem->quantity = $newQuantity;
        $cartItem->save();
    } else {
        // If the product is not in the cart, create a new cart entry
        \Log::info('Creating new cart item', ['product_id' => $product->id, 'quantity' => $request->input('quantity')]);
        Cart::create([
            'users_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => $request->input('quantity'),
        ]);
    }

    // Redirect back to the marketplace or cart with a success message
    return redirect()->route('marketdash')->with('message', 'Product added to cart!');
    }

    
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function show()
    {
    // Retrieve cart items for the authenticated user with the associated product data
    $cartItems = Cart::where('users_id', auth()->id())->with('product')->get(); // Filter by user and eager load the product

    // Calculate the total cost of items in the cart
    $total = $cartItems->reduce(function ($carry, $item) {
    return $carry + ($item->product->price * $item->quantity);
    }, 0);

    // Return the cart view with cart items and total cost
    return view('marketplace.show', compact('cartItems', 'total'));

    }

    public function showPop()
    {
    // Retrieve cart items for the authenticated user with the associated product data
    $cartItems = Cart::where('users_id', auth()->id())->with('product')->get(); // Filter by user and eager load the product

    // Calculate the total cost of items in the cart
    $total = $cartItems->reduce(function ($carry, $item) {
    return $carry + ($item->product->price * $item->quantity);
    }, 0);

    // Return the cart view with cart items and total cost
    return view('marketplace.show_pop', compact('cartItems', 'total'));

    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

   // Update quantity of an item in the cart
   public function update(Request $request, $itemId)
{
    // Get the currently authenticated user
    $user = auth()->user();

    // Find the cart item for the current user
    $cartItem = Cart::where('users_id', $user->id)->find($itemId);

    // Check if the cart item exists for the current user
    if (!$cartItem) {
        return redirect()->back()->with('message', 'Item not found.');
    }

    // Retrieve the associated product
    $product = Product::findOrFail($cartItem->product_id);

    // Check if the requested quantity exceeds the available stock
    if ($request->quantity > $product->quantity) {
        return redirect()->back()->with('error', 'Not enough stock available!');
    }

    // Validate the requested quantity
    $request->validate([
        'quantity' => 'required|integer|min:1|max:' . $product->quantity,
    ]);

    // Update the cart item's quantity
    $cartItem->quantity = $request->quantity;
    $cartItem->save();

    return redirect()->back()->with('message', 'Quantity updated successfully.');
}


 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 


   // Delete an item from the cart
   public function delete($itemId)
    {
    $user = auth()->user();

    // Find the cart item for the current user by item ID
    $cartItem = Cart::where('users_id', $user->id)->find($itemId);

    // Check if the cart item exists
    if (!$cartItem) {
        return redirect()->route('marketdash')->with('error', 'Item not found.');
    }

    // Delete the cart item
    $cartItem->delete();

    return redirect()->route('cart.show')->with('message', 'Item removed from cart.');
    }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
// Checkout process
   public function checkout()
   {
       // Implement checkout logic here.
       return redirect()->route('marketdash')->with('message', 'Checkout completed successfully!');
   }
}