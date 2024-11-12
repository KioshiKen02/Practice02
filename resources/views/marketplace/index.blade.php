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
    <!-- Cart Button -->
    <div class="flex justify-end mb-4 p-4">
      <a href="{{ route('cart.show') }}" class="bg-green-500 text-white p-2 rounded inline-flex items-center">
        <i class="fas fa-shopping-cart mr-2"></i> View Cart
      </a>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-4">
      @foreach($products as $product)
        <div class="border p-4 bg-white rounded shadow hover:shadow-lg transition duration-300">
          <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded mb-4">
          <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
          <p class="text-gray-700">{{ $product->description }}</p>
          <p class="text-lg font-bold mt-2">₱{{ $product->price }}</p>

          <!-- Add to Cart Form -->
          <form action="{{ route('cart.add') }}" method="POST" class="flex flex-col items-center space-y-2">
            @csrf
            <div class="flex items-center space-x-2">
              <button class="bg-blue-500 text-white p-2 rounded w-36 hover:bg-blue-600 transition duration-300" type="submit">
                Add to Cart
              </button>
              <input class="border p-2 rounded w-16 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" type="number" name="quantity" value="1" min="1" required>
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              
            </div>
          </form>
        </div>
      @endforeach
    </div>
  </body>
</html>
