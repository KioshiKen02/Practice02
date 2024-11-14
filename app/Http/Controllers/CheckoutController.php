<?php 

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function preview()
    {
        $cartItems = Cart::where('users_id', auth()->id())->get(); // Get cart items for the logged-in user
        return view('marketplace.preview', compact('cartItems'));
    }

    public function storeShippingInfo(Request $request)
    {
        // Validate the individual address components
        $request->validate([
            'house_no' => 'required|string|max:100',
            'street' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'payment_method' => 'required|in:COD,Bank Transfer,Credit Card,Debit Card, Check',
        ]);
    
        // Create the order and store the shipping address components
        $order = Order::create([
            'house_no' => $request->input('house_no'),
            'street' => $request->input('street'),
            'barangay' => $request->input('barangay'),
            'municipality' => $request->input('municipality'),
            'province' => $request->input('province'),
            'users_id' => auth()->id(),  // Assuming user is logged in
            'payment_method' => $request->input('payment_method'),
            'order_status' => 'pending', // default status
        ]);
        
    
        // Store the items in the order_items table
        $cartItems = Cart::where('users_id', auth()->id())->get();
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }
    
        // Clear the cart
        Cart::where('users_id', auth()->id())->delete();
    
        // Redirect to the order complete page
        return redirect()->route('marketplace.complete');
    }
    

    public function completeOrder()
    {
        return view('marketplace.complete');
    }
}
