<html>
 <head>
  <title>
   Your Cart
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
            font-family: 'Roboto', sans-serif;
        }
  </style>
 </head>
 <body class="bg-gray-100">
 <header class="bg-white shadow">
   <div class="container mx-auto p-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">
     Anime Hub
    </h1>
   </div>
  </header>

  <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Your Cart</h1>

    @if(session('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
            {{ session('message') }}
        </div>
    @endif

    @if($cartItems->isEmpty())
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6">
            Your cart is empty.
        </div>
    @else
        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-100 text-left text-sm font-semibold text-gray-700">Product</th>
                    <th class="px-6 py-3 bg-gray-100 text-left text-sm font-semibold text-gray-700">Quantity</th>
                    <th class="px-6 py-3 bg-gray-100 text-left text-sm font-semibold text-gray-700">Price</th>
                    <th class="px-6 py-3 bg-gray-100 text-left text-sm font-semibold text-gray-700">Total</th>
                    <th class="px-6 py-3 bg-gray-100 text-left text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $item->product->name }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('cart.update') }}" method="POST" class="flex items-center space-x-2">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 text-center border border-gray-300 rounded-md">
                                <button type="submit" class="text-blue-500 hover:text-blue-700">Update</button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">₱{{ $item->product->price }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">₱{{ $item->product->price * $item->quantity }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('cart.delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6 flex justify-between items-center">
            <h2  class="text-xl font-semibold text-gray-800">Total:₱{{ $total }}</h2>

            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit"  class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-md transition duration-200">Checkout</button>
            </form>
        </div>
    @endif

    <!-- Back Button (Redirects to Marketplace Page) -->
    <div class="mt-6">
        <a href="{{ route('marketdash') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-md">
            <i class="fas fa-arrow-left mr-2"></i> Back to Marketplace
        </a>
    </div>
</div>
  <footer class="bg-white shadow mt-8">
   <div class="container mx-auto p-4 text-center">
    <p class="text-gray-700">
     © 2023 Marketplace. All rights reserved.
    </p>
   </div>
  </footer>
 </body>
</html>