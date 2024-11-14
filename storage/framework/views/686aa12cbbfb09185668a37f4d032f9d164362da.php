<form action="<?php echo e(route('product.update', $product->id)); ?>" method="POST" class="space-y-6">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div>
        <label for="name" class="block text-gray-700 font-bold mb-2">Product Name</label>
        <input 
            type="text" 
            id="name" 
            name="name" 
            value="<?php echo e($product->name); ?>" 
            required 
            class="form-control w-full px-3 py-2 border rounded-lg text-gray-900"
        >
    </div>

    <div>
        <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
        <textarea 
            id="description" 
            name="description" 
            required 
            class="form-control w-full px-3 py-2 border rounded-lg text-gray-900"
        ><?php echo e($product->description); ?></textarea>
    </div>

    <div>
        <label for="price" class="block text-gray-700 font-bold mb-2">Price</label>
        <input 
            type="number" 
            id="price" 
            name="price" 
            value="<?php echo e($product->price); ?>" 
            required 
            class="form-control w-full px-3 py-2 border rounded-lg text-gray-900"
        >
    </div>

    <div>
        <label for="quantity" class="block text-gray-700 font-bold mb-2">Quantity</label>
        <input 
            type="number" 
            id="quantity" 
            name="quantity" 
            value="<?php echo e($product->quantity); ?>" 
            required 
            class="form-control w-full px-3 py-2 border rounded-lg text-gray-900"
        >
    </div>
</form>
<?php /**PATH C:\laragon\www\Practice02\resources\views/marketplace/edit.blade.php ENDPATH**/ ?>