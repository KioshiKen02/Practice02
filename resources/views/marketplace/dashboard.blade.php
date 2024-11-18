<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Listed Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-800 text-gray-100 font-roboto min-h-screen">

    <div class="container mx-auto p-8">
        <h1 class="text-5xl font-semibold text-white text-center mb-12">Your Listed Products</h1>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-3 rounded-lg mb-8 text-center">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-3 rounded-lg mb-8 text-center">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif


        <div class="overflow-x-auto bg-gray-900 shadow-xl rounded-lg">
            <table class="min-w-full table-auto text-gray-100">
                <thead class="bg-gray-700 text-white">
                    <tr>
                        <th class="py-4 px-6 font-semibold text-left">Product Name</th>
                        <th class="py-4 px-6 font-semibold text-left">Description</th>
                        <th class="py-4 px-6 font-semibold text-left">Price</th>
                        <th class="py-4 px-6 font-semibold text-left">Quantity</th>
                        <th class="py-4 px-6 font-semibold text-left">Status</th>
                        <th class="py-4 px-6 font-semibold text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="hover:bg-gray-700 transition-all duration-300">
                            <td class="py-4 px-6 border-b border-gray-600">{{ $product->name }}</td>
                            <td class="py-4 px-6 border-b border-gray-600">{{ Str::limit($product->description, 50) }}</td>
                            <td class="py-4 px-6 border-b border-gray-600">₱{{ number_format($product->price, 2) }}</td>
                            <td class="py-4 px-6 border-b border-gray-600">{{ $product->quantity }}</td>
                            <td class="py-4 px-6 border-b border-gray-600">
                                <span class="px-3 py-1 text-sm font-medium rounded-full {{ $product->status == 'In Stock' ? 'bg-green-600 text-white' : 'bg-red-600 text-white' }}">
                                    {{ $product->status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 border-b border-gray-600 text-center">
                                <button 
                                    class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg transition-all duration-200 transform hover:scale-105 inline-block"
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'edit-product-modal-{{ $product->id }}')">
                                    <i class="fas fa-edit mr-2"></i> Edit
                                </button>
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition-all duration-200 transform hover:scale-105">
                                        <i class="fas fa-trash mr-2"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal for editing product -->
                        <!-- Modal for editing product -->
<x-modal name="edit-product-modal-{{ $product->id }}" focusable>
    <div class="p-8 bg-white rounded-xl shadow-xl max-w-lg mx-auto my-12">
        <!-- Modal Header -->
        <h2 class="text-3xl font-semibold text-black mb-6 text-center">Edit Product - {{ $product->name }}</h2>

        <!-- Modal Form -->
        <form id="editProductForm-{{ $product->id }}" action="{{ route('product.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Form Fields -->
            <div class="space-y-4">
                <!-- Product Name -->
                <div>
                    <label for="name" class="block text-gray-700 font-medium mb-2">Product Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ $product->name }}" 
                        required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-800 focus:ring-2 focus:ring-gray-400 focus:border-gray-400">
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-800 focus:ring-2 focus:ring-gray-400 focus:border-gray-400"
                        rows="3">{{ $product->description }}</textarea>
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-gray-700 font-medium mb-2">Price</label>
                    <input 
                        type="number" 
                        id="price" 
                        name="price" 
                        value="{{ $product->price }}" 
                        required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-800 focus:ring-2 focus:ring-gray-400 focus:border-gray-400">
                </div>

                <!-- Quantity -->
                <div>
                    <label for="quantity" class="block text-gray-700 font-medium mb-2">Quantity</label>
                    <input 
                        type="number" 
                        id="quantity" 
                        name="quantity" 
                        value="{{ $product->quantity }}" 
                        required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-800 focus:ring-2 focus:ring-gray-400 focus:border-gray-400">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex justify-end space-x-4">
                <!-- Cancel Button -->
                <button type="button" x-on:click="$dispatch('close')" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-200">
                    Cancel
                </button>

                <!-- Save Changes Button -->
                <button type="submit" form="editProductForm-{{ $product->id }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-all duration-200 transform hover:scale-105">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</x-modal>


                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Back to Marketplace Button -->
        <div class="mt-8 flex items-center justify-end space-x-3">
            <a href="{{ route('marketdash') }}" class="bg-gray-600 hover:bg-gray-700 text-white py-3 px-6 rounded-lg flex items-center space-x-3 transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-arrow-left text-lg"></i>
                <span class="text-lg font-semibold">Back to Marketplace</span>
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
