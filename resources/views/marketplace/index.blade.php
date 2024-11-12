<html>
<head>
  <title>Marketplace</title>
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

  <!-- Header Section -->
  <header class="bg-white shadow p-4 mb-6">
    <div class="container mx-auto flex justify-between items-center">
      <h2 class="text-4xl font-bold text-indigo-600">
        {{ __('Anime Merchandise') }}
      </h2>
      <!-- Cart Button with Notification Badge -->
      <a href="{{ route('cart.show') }}" class="relative bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full inline-flex items-center transition duration-300">
        <i class="fas fa-shopping-cart mr-2"></i> Cart
        @if($cartQuantity > 0)
          <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full px-2 py-1 text-xs font-bold">{{ $cartQuantity }}</span>
        @endif
      </a>
    </div>
  </header>

  <!-- Products Grid -->
  <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4">
    @foreach($products as $product)
      <div class="border border-gray-200 p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg mb-4">
        <h2 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h2>
        <p class="text-gray-600 mt-2 mb-4">{{ Str::limit($product->description, 60) }}</p>
        <p class="text-sm text-gray-500 mb-2">Available: {{ $product->quantity }}</p>
        <p class="text-xl font-bold text-green-600">₱{{ number_format($product->price, 2) }}</p>

        <!-- Add to Cart Form -->
        <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
          @csrf
          <div class="flex items-center space-x-2">
            <!-- Limit quantity input based on available stock -->
            <input 
              class="border border-gray-300 rounded-lg p-2 w-16 focus:ring focus:ring-blue-500 focus:outline-none" 
              type="number" 
              name="quantity" 
              value="1" 
              min="1" 
              max="{{ $product->quantity }}" 
              required
            >
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-300 w-full" 
                    @if($product->quantity <= 0) disabled @endif>
              <i class="fas fa-cart-plus"></i> Add to Cart
            </button>
          </div>
        </form>
      </div>
    @endforeach
  </div>

</body>
</html>
