<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-bold text-indigo-600">
            {{ __('Check Out Process') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Cart Items -->
            <div class="bg-white shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">
                        <i class="fa-solid fa-shopping-cart text-blue-500"></i> <!-- Cart Icon -->
                        <span> Your Cart</span>
                    </h3>
                    @php
                        $total = 0;
                        foreach ($cartItems as $item) {
                            $total += $item->product->price * $item->quantity;
                        }
                    @endphp
                    @foreach ($cartItems as $item)
                        <div class="flex justify-between items-center py-2 border-b">
                            <span class="font-medium">{{ $item->product->name }} x{{ $item->quantity }}</span>
                            <span class="font-semibold text-gray-600">₱{{ number_format($item->product->price, 2) }}</span>
                        </div>
                    @endforeach
                    <div class="flex justify-between items-center py-2 border-t mt-4">
                        <span class="font-semibold">Total:</span>
                        <span class="font-semibold text-gray-600">₱{{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Shipping & Payment Form -->
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Shipping Information</h3>

                    <!-- Display Errors -->
                    @if ($errors->any())
                        <div class="bg-red-100 text-red-700 p-4 rounded-md mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('checkout.storeShipping') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Shipping Address -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- House No. -->
                            <div class="flex flex-col space-y-2">
                                <label for="house_no" class="font-medium text-gray-700 flex items-center">
                                    <i class="fa-solid fa-home text-indigo-600 mr-2"></i>
                                    House No.
                                </label>
                                <input id="house_no" name="house_no" type="text" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required placeholder="e.g., 123" value="{{ old('house_no', $defaultAddress['default_house_no'] ?? '') }}" />
                                @error('house_no')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Street -->
                            <div class="flex flex-col space-y-2">
                                <label for="street" class="font-medium text-gray-700 flex items-center">
                                    <i class="fa-solid fa-road text-indigo-600 mr-2"></i>
                                    Street
                                </label>
                                <input id="street" name="street" type="text" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required placeholder="e.g., Main Street" value="{{ old('street', $defaultAddress['default_street'] ?? '') }}" />
                                @error('street')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Barangay -->
                            <div class="flex flex-col space-y-2">
                                <label for="barangay" class="font-medium text-gray-700 flex items-center">
                                    <i class="fa-solid fa-map-marker-alt text-indigo-600 mr-2"></i>
                                    Barangay
                                </label>
                                <input id="barangay" name="barangay" type="text" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required placeholder="e.g., Barangay 1" value="{{ old('barangay', $defaultAddress['default_barangay'] ?? '') }}" />
                                @error('barangay')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Municipality -->
                            <div class="flex flex-col space-y-2">
                                <label for="municipality" class="font-medium text-gray-700 flex items-center">
                                    <i class="fa-solid fa-city text-indigo-600 mr-2"></i>
                                    Municipality
                                </label>
                                <input id="municipality" name="municipality" type="text" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required placeholder="e.g., Quezon City" value="{{ old('municipality', $defaultAddress['default_municipality'] ?? '') }}" />
                                @error('municipality')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Province -->
                            <div class="flex flex-col space-y-2">
                                <label for="province" class="font-medium text-gray-700 flex items-center">
                                    <i class="fa-solid fa-globe text-indigo-600 mr-2"></i>
                                    Province
                                </label>
                                <input id="province" name="province" type="text" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required placeholder="e.g., Metro Manila" value="{{ old('province', $defaultAddress['default_province'] ?? '') }}" />
                                @error('province')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Save as Default Address -->
                        <div class="flex items-center space-x-2 mt-4">
                            <input type="checkbox" id="save_as_default" name="save_as_default" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <label for="save_as_default" class="text-gray-700">Save this address as default</label>
                        </div>

                        <!-- Payment Method -->
                        <div class="flex flex-col space-y-2">
                            <label for="payment_method" class="font-medium text-gray-700 flex items-center">
                                <i class="fa-solid fa-credit-card text-indigo-600 mr-2"></i>
                                Payment Method
                            </label>
                            <select id="payment_method" name="payment_method" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="COD">Cash on Delivery</option>
                                <option value="Check">Check</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                                <option value="Credit Card">Credit Card</option>
                                <option value="Debit Card">Debit Card</option>
                            </select>
                            @error('payment_method')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4 flex justify-end">
                            <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300" aria-label="Complete Order">
                                Place Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
