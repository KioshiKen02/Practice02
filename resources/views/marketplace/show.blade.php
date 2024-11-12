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
  <header class="bg-gradient-to-r from-green-400 to-blue-500 shadow-lg">
    <div class="container mx-auto p-6 flex justify-between items-center">
      <h1 class="text-3xl font-bold text-white"> <i class="fas fa-shopping-bag mr-2"> </i> Anime Hub</h1>
    </div>
  </header>

  <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Your Cart</h1>

    @if(session('message'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
      {{ session('message') }}
    </div>
    @endif

  @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
      {{ session('error') }}
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
            <tr class="border-b">
              <td class="px-6 py-4">
                <div class="flex items-center space-x-4">
                  <div class="w-20">
                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-16 object-cover rounded">
                  </div>
                  <div>
                    <h2 class="text-lg font-semibold">{{ $item->product->name }}</h2>
                    <p class="text-gray-500">Available: {{ $item->product->quantity }}</p>
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
                    Update
                  </button>
                </form>
              </td>
              <td class="px-6 py-4 text-sm text-gray-700">₱{{ number_format($item->product->price, 2) }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">₱{{ number_format($item->product->price * $item->quantity, 2) }}</td>
              <td class="px-6 py-4">
                <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE') <!-- This simulates the DELETE HTTP method -->
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg">
                         Delete
                    </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <div class="mt-6 flex items-center justify-end">
        <h2 class="text-xl font-semibold text-gray-800 mr-4">Total: ₱{{ number_format($total, 2) }}</h2>
        <form action="{{ route('cart.checkout') }}" method="POST">
          @csrf
          <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-md transition duration-200 mt-4">Checkout</button>
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
      <p class="text-gray-700">© 2024 Marketplace. All rights reserved.</p>
    </div>
  </footer>
 </body>
</html>
