<?php 

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CheckoutController extends Controller
{
    public function preview()
    {
    // Get cart items for the logged-in user
    $cartItems = Cart::where('users_id', auth()->id())->get();

    // Get the logged-in user's default address
    $user = auth()->user();
    $defaultAddress = $user->only([
        'default_house_no', 'default_street', 'default_barangay', 'default_municipality', 'default_province'
    ]);

    // Return both cart items and default address to the view
    return view('marketplace.preview', compact('cartItems', 'defaultAddress'));
    }



    public function storeShippingInfo(Request $request)
    {
    // Log the incoming request data to check if save_default is being sent
    Log::info('Request Data: ', $request->all());

    // Validate input
    $request->validate([
        'house_no' => 'required|string|max:255',
        'street' => 'required|string|max:255',
        'barangay' => 'required|string|max:255',
        'municipality' => 'required|string|max:255',
        'province' => 'required|string|max:255',
        'payment_method' => 'required|in:COD,Bank Transfer,Credit Card,Check,Debit Card',
    ]);

    // Generate a unique reference number
    $referenceNumber = 'ORD-' . strtoupper(uniqid());

    // Use a transaction for consistency
    DB::beginTransaction();

    try {
        // Create the order
        $order = Order::create([
            'users_id' => auth()->id(),
            'house_no' => $request->house_no,
            'street' => $request->street,
            'barangay' => $request->barangay,
            'municipality' => $request->municipality,
            'province' => $request->province,
            'payment_method' => $request->payment_method,
            'order_status' => 'pending',
            'reference_number' => $referenceNumber,
        ]);

        if ($request->has('save_as_default') && $request->input('save_as_default') === 'on') {
            // Saving default address logic
            $user = auth()->user();
            logger("Saving default address for user: {$user->id}");
            $user->update([
                'default_house_no' => $request->house_no,
                'default_street' => $request->street,
                'default_barangay' => $request->barangay,
                'default_municipality' => $request->municipality,
                'default_province' => $request->province,
            ]);
            logger("Default address saved.");
        } else {
            logger("Save default address not requested.");
        }
        

        // Get items from the cart
        $cartItems = Cart::where('users_id', auth()->id())->get();
        $errors = [];

        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);

            if ($product->quantity >= $item->quantity) {
                // Create an order item entry
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                // Reduce the product's quantity
                $product->quantity -= $item->quantity;

                if ($product->quantity == 0) {
                    $product->status = 'out of stock';
                }

                $product->save();
            } else {
                $errors[] = "Not enough stock for product: {$product->name}";
            }
        }

        // If there are stock issues, rollback and show errors
        if (!empty($errors)) {
            DB::rollBack();
            return back()->withErrors($errors);
        }

        // Clear the cart after placing the order
        Cart::where('users_id', auth()->id())->delete();

        DB::commit();

        return redirect()->route('marketdash')->with('success', "Order placed successfully. Reference Number: {$referenceNumber}");
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('An error occurred while placing the order: ' . $e->getMessage());
        return back()->withErrors('An error occurred while placing the order. Please try again.');
    }
    }



}
