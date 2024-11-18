<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    // Show all orders for the authenticated user
    public function index()
    {
        // Fetch orders for the logged-in user
        $orders = Order::where('users_id', auth()->id())->get();
        return view('transactions.details', compact('orders'));
    }

    // Show a specific order with details using the reference number
    public function transactionDetails($referenceNumber)
    {
        // Make sure to query by 'user_id' instead of 'users_id'
        $order = Order::with('orderItems.product')
            ->where('reference_number', $referenceNumber)
            ->where('users_id', auth()->id()) // Ensure this matches your table column
            ->firstOrFail();

        return view('marketplace.transaction_details', compact('order'));
    }
}
