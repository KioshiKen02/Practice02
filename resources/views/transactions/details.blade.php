<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container p-6">
                    <h1 class="text-3xl font-bold mb-6">Your Transactions</h1>

                    <!-- Search Bar -->
                    <div class="mb-4 flex justify-between items-center">
                        <input type="text" id="search-input" class="px-4 py-2 border rounded-md" placeholder="Search by Reference No." onkeyup="filterTransactions()" />
                    </div>

                    <table class="table table-striped table-bordered" id="transactions-table">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">Reference No.</th>
                                <th class="px-4 py-2 text-left">Shipping Address</th>
                                <th class="px-4 py-2 text-left">Order Status</th>
                                <th class="px-4 py-2 text-left">Payment Method</th>
                                <th class="px-4 py-2 text-left">Date Of Order</th> <!-- Added Date Column -->
                                <th class="px-4 py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="transaction-row">
                                    <td class="px-4 py-2">{{ $order->reference_number ?? $order->id }}</td>
                                    <td class="px-4 py-2">
                                        {{ $order->barangay }}, {{ $order->municipality }}, {{ $order->province }}
                                    </td>
                                    <td class="px-4 py-2">
                                        <span class="badge bg-{{ $order->order_status == 'completed' ? 'success' : ($order->order_status == 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($order->order_status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">
                                        <i class="fas fa-credit-card"></i> {{ ucfirst($order->payment_method) }}
                                    </td>
                                    <td class="px-4 py-2">{{ $order->created_at->format('F j, Y') }}</td> <!-- Display Date -->
                                    <td class="px-4 py-2 text-center">
                                        <button 
                                            class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg transition-all duration-200 transform hover:scale-105 inline-block"
                                            x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'view-transaction-details-{{ $order->id }}')">
                                            <a href="#" class="btn btn-info">
                                                <i class="fas fa-eye"></i> View Details
                                            </a>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Transaction Details -->
    @foreach ($orders as $order)
        <x-modal name="view-transaction-details-{{ $order->id }}" focusable x-data="{ open: false }" x-on:open-modal.window="if ($event.detail === 'view-transaction-details-{{ $order->id }}') { open = true }" x-on:close-modal.window="if ($event.detail === 'view-transaction-details-{{ $order->id }}') { open = false }">
            <div class="p-8 bg-white rounded-xl shadow-xl max-w-3xl mx-auto my-12 transform transition-all duration-300" x-show="open" x-transition>
                <!-- Modal Header -->
                <h2 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Transaction Details - Reference No: {{ $order->reference_number ?? $order->id }}</h2>

                <!-- Modal Content -->
                <div class="container">
                    <table class="table table-auto w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Product Name</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Quantity</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Amount</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Payment Method</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Order Status</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Date</th> <!-- Added Date Column in Modal -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $orderItem)
                                <tr class="border-t border-gray-200">
                                    <td class="px-4 py-2">{{ $orderItem->product->name }}</td>
                                    <td class="px-4 py-2">{{ $orderItem->quantity }}</td>
                                    <td class="px-4 py-2">₱{{ $orderItem->price * $orderItem->quantity }}</td>
                                    <td class="px-4 py-2">{{ ucfirst($order->payment_method) }}</td>
                                    <td class="px-4 py-2">
                                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-{{ $order->order_status == 'completed' ? 'green' : ($order->order_status == 'pending' ? 'yellow' : 'red') }}-500 text-white">
                                            {{ ucfirst($order->order_status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">{{ $order->created_at->format('F j, Y') }}</td> <!-- Display Date -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Modal Footer -->
                <div class="mt-6 text-center">
                    <button class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg" x-on:click="$dispatch('close-modal', 'view-transaction-details-{{ $order->id }}')">
                        Close
                    </button>
                </div>
            </div>
        </x-modal>
    @endforeach

</x-app-layout>

<script>
    // JavaScript function to filter transactions based on search input
    function filterTransactions() {
        var input, filter, table, rows, td, i, txtValue;
        input = document.getElementById("search-input");
        filter = input.value.toUpperCase();
        table = document.getElementById("transactions-table");
        rows = table.getElementsByTagName("tr");

        for (i = 1; i < rows.length; i++) {
            td = rows[i].getElementsByTagName("td")[0]; // Reference No column
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    }
</script>
