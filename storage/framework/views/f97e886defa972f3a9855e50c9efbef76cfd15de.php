<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?>  <?php $__env->endSlot(); ?>

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
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="transaction-row">
                                    <td class="px-4 py-2"><?php echo e($order->reference_number ?? $order->id); ?></td>
                                    <td class="px-4 py-2">
                                        <?php echo e($order->barangay); ?>, <?php echo e($order->municipality); ?>, <?php echo e($order->province); ?>

                                    </td>
                                    <td class="px-4 py-2">
                                        <span class="badge bg-<?php echo e($order->order_status == 'completed' ? 'success' : ($order->order_status == 'pending' ? 'warning' : 'danger')); ?>">
                                            <?php echo e(ucfirst($order->order_status)); ?>

                                        </span>
                                    </td>
                                    <td class="px-4 py-2">
                                        <i class="fas fa-credit-card"></i> <?php echo e(ucfirst($order->payment_method)); ?>

                                    </td>
                                    <td class="px-4 py-2"><?php echo e($order->created_at->format('F j, Y')); ?></td> <!-- Display Date -->
                                    <td class="px-4 py-2 text-center">
                                        <button 
                                            class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg transition-all duration-200 transform hover:scale-105 inline-block"
                                            x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'view-transaction-details-<?php echo e($order->id); ?>')">
                                            <a href="#" class="btn btn-info">
                                                <i class="fas fa-eye"></i> View Details
                                            </a>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Transaction Details -->
    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.modal','data' => ['name' => 'view-transaction-details-'.e($order->id).'','focusable' => true,'xData' => '{ open: false }','xOn:openModal.window' => 'if ($event.detail === \'view-transaction-details-'.e($order->id).'\') { open = true }','xOn:closeModal.window' => 'if ($event.detail === \'view-transaction-details-'.e($order->id).'\') { open = false }']]); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['name' => 'view-transaction-details-'.e($order->id).'','focusable' => true,'x-data' => '{ open: false }','x-on:open-modal.window' => 'if ($event.detail === \'view-transaction-details-'.e($order->id).'\') { open = true }','x-on:close-modal.window' => 'if ($event.detail === \'view-transaction-details-'.e($order->id).'\') { open = false }']); ?>
            <div class="p-8 bg-white rounded-xl shadow-xl max-w-3xl mx-auto my-12 transform transition-all duration-300" x-show="open" x-transition>
                <!-- Modal Header -->
                <h2 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Transaction Details - Reference No: <?php echo e($order->reference_number ?? $order->id); ?></h2>

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
                            <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-t border-gray-200">
                                    <td class="px-4 py-2"><?php echo e($orderItem->product->name); ?></td>
                                    <td class="px-4 py-2"><?php echo e($orderItem->quantity); ?></td>
                                    <td class="px-4 py-2">₱<?php echo e($orderItem->price * $orderItem->quantity); ?></td>
                                    <td class="px-4 py-2"><?php echo e(ucfirst($order->payment_method)); ?></td>
                                    <td class="px-4 py-2">
                                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-<?php echo e($order->order_status == 'completed' ? 'green' : ($order->order_status == 'pending' ? 'yellow' : 'red')); ?>-500 text-white">
                                            <?php echo e(ucfirst($order->order_status)); ?>

                                        </span>
                                    </td>
                                    <td class="px-4 py-2"><?php echo e($order->created_at->format('F j, Y')); ?></td> <!-- Display Date -->
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal Footer -->
                <div class="mt-6 text-center">
                    <button class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg" x-on:click="$dispatch('close-modal', 'view-transaction-details-<?php echo e($order->id); ?>')">
                        Close
                    </button>
                </div>
            </div>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>

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
<?php /**PATH C:\laragon\www\Practice02\resources\views/transactions/details.blade.php ENDPATH**/ ?>