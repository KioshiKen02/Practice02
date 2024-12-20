<html>
 <head>
  <title>Your Cart</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Roboto', sans-serif;
    }
  </style>
 </head>
 <body class="bg-gray-100">
  <!-- Header -->
  <header class="bg-gradient-to-r from-green-400 to-blue-500 shadow-lg">
    <div class="container mx-auto p-6 flex justify-between items-center">
      <h1 class="text-3xl font-bold text-white"><i class="fas fa-shopping-bag mr-2"></i>Anime Hub</h1>
    </div>
  </header>

  <!-- Cart Container -->
  <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800"><i class="fas fa-shopping-cart mr-2"></i>Your Cart</h1>

    <!-- Messages -->
    @if(session('message'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
      <i class="fas fa-check-circle mr-2"></i>{{ session('message') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
      <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
    </div>
    @endif

    <!-- Cart Items -->
    @if($cartItems->isEmpty())
      <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6">
        <i class="fas fa-exclamation-triangle mr-2"></i>Your cart is empty.
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
            <tr class="border-b">
              <td class="px-6 py-4">
                <div class="flex items-center space-x-4">
                  <div class="w-20">
                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-16 object-cover rounded">
                  </div>
                  <div>
                    <h2 class="text-lg font-semibold">{{ $item->product->name }}</h2>
                    <p class="text-gray-500"><i class="fas fa-cubes mr-1"></i>Available: {{ $item->product->quantity }}</p>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4">
                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                  @csrf
                  @method('PUT')
                  <input 
                    type="number" 
                    name="quantity" 
                    value="{{ $item->quantity }}" 
                    min="1" 
                    max="{{ $item->product->quantity }}" 
                    class="border border-gray-300 rounded p-2 w-16 focus:ring focus:ring-blue-500 focus:outline-none" 
                    required
                  >
                  <button type="submit" class="ml-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-300">
                    <i class="fas fa-sync-alt"></i> Update
                  </button>
                </form>
              </td>
              <td class="px-6 py-4 text-sm text-gray-700">₱{{ number_format($item->product->price, 2) }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">₱{{ number_format($item->product->price * $item->quantity, 2) }}</td>
              <td class="px-6 py-4">
                <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition duration-300">
                         <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <!-- Cart Total and Checkout -->
      <div class="mt-6 flex items-center justify-end">
        <h2 class="text-xl font-semibold text-gray-800 mr-4">Total: ₱{{ number_format($total, 2) }}</h2>
            <form action="{{ route('checkout.preview') }}" method="GET">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-md transition duration-200 flex items-center space-x-2">
                <span>Proceed to Checkout</span>
                <i class="fas fa-arrow-right"></i>
                </button>
            </form>
      </div>
    @endif

    <!-- Back to Marketplace Button -->
    <div class="mt-6 flex items-center justify-end">
      <a href="{{ route('marketdash') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-md flex items-center space-x-2 transition duration-200">
        <i class="fas fa-arrow-left"></i><span>Back to Marketplace</span>
      </a>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-white shadow mt-8">
    <div class="container mx-auto p-4 text-center">
      <p class="text-gray-700">© 2024 Marketplace. All rights reserved.</p>
    </div>
  </footer>
 </body>
</html>