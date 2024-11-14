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
        
        <?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-3 rounded-lg mb-8 text-center">
                <span class="block sm:inline"><?php echo e(session('success')); ?></span>
            </div>
        <?php endif; ?>

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
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-gray-700 transition-all duration-300">
                            <td class="py-4 px-6 border-b border-gray-600"><?php echo e($product->name); ?></td>
                            <td class="py-4 px-6 border-b border-gray-600"><?php echo e(Str::limit($product->description, 50)); ?></td>
                            <td class="py-4 px-6 border-b border-gray-600">₱<?php echo e(number_format($product->price, 2)); ?></td>
                            <td class="py-4 px-6 border-b border-gray-600"><?php echo e($product->quantity); ?></td>
                            <td class="py-4 px-6 border-b border-gray-600">
                                <span class="px-3 py-1 text-sm font-medium rounded-full <?php echo e($product->status == 'In Stock' ? 'bg-green-600 text-white' : 'bg-red-600 text-white'); ?>">
                                    <?php echo e($product->status); ?>

                                </span>
                            </td>
                            <td class="py-4 px-6 border-b border-gray-600 text-center">
                                <button 
                                    class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg transition-all duration-200 transform hover:scale-105 inline-block"
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'edit-product-modal-<?php echo e($product->id); ?>')">
                                    <i class="fas fa-edit mr-2"></i> Edit
                                </button>
                                <form action="<?php echo e(route('product.destroy', $product->id)); ?>" method="POST" class="inline-block ml-2">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition-all duration-200 transform hover:scale-105">
                                        <i class="fas fa-trash mr-2"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal for editing product -->
                        <!-- Modal for editing product -->
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.modal','data' => ['name' => 'edit-product-modal-'.e($product->id).'','focusable' => true]]); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['name' => 'edit-product-modal-'.e($product->id).'','focusable' => true]); ?>
    <div class="p-8 bg-white rounded-xl shadow-xl max-w-lg mx-auto my-12">
        <!-- Modal Header -->
        <h2 class="text-3xl font-semibold text-black mb-6 text-center">Edit Product - <?php echo e($product->name); ?></h2>

        <!-- Modal Form -->
        <form id="editProductForm-<?php echo e($product->id); ?>" action="<?php echo e(route('product.update', $product->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- Form Fields -->
            <div class="space-y-4">
                <!-- Product Name -->
                <div>
                    <label for="name" class="block text-gray-700 font-medium mb-2">Product Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="<?php echo e($product->name); ?>" 
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
                        rows="3"><?php echo e($product->description); ?></textarea>
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-gray-700 font-medium mb-2">Price</label>
                    <input 
                        type="number" 
                        id="price" 
                        name="price" 
                        value="<?php echo e($product->price); ?>" 
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
                        value="<?php echo e($product->quantity); ?>" 
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
                <button type="submit" form="editProductForm-<?php echo e($product->id); ?>" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-all duration-200 transform hover:scale-105">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>


                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <!-- Back to Marketplace Button -->
        <div class="mt-8 flex items-center justify-end space-x-3">
            <a href="<?php echo e(route('marketdash')); ?>" class="bg-gray-600 hover:bg-gray-700 text-white py-3 px-6 rounded-lg flex items-center space-x-3 transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-arrow-left text-lg"></i>
                <span class="text-lg font-semibold">Back to Marketplace</span>
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
<?php /**PATH C:\laragon\www\Practice02\resources\views\marketplace\dashboard.blade.php ENDPATH**/ ?>