<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center space-x-2 mb-6">
            <i class="fas fa-shopping-cart text-blue-500"></i> <!-- Cart Icon -->
            <span>Your Cart</span>
        </h1>
        
        <?php if(!$cartItems->isEmpty()): ?>
        <a href="<?php echo e(route('cart.show')); ?>" class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-md flex items-center space-x-2">
            <i class="fas fa-edit"></i>
            <span>Edit Your Cart</span>
        </a>
        <?php endif; ?>
    </div>

    <?php if(session('message')): ?>
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
      <?php echo e(session('message')); ?>

    </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
      <?php echo e(session('error')); ?>

    </div>
    <?php endif; ?>

    <?php if($cartItems->isEmpty()): ?>
      <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6">
        <i class="fas fa-exclamation-circle"></i> <!-- Warning Icon -->
        Your cart is empty.
      </div>
    <?php else: ?>
      <table class="min-w-full table-auto border-collapse shadow-md">
        <thead>
          <tr>
            <th class="px-6 py-3 bg-gray-100 text-left text-sm font-semibold text-gray-700">Product</th>
            <th class="px-6 py-3 bg-gray-100 text-left text-sm font-semibold text-gray-700">Quantity</th>
            <th class="px-6 py-3 bg-gray-100 text-left text-sm font-semibold text-gray-700">Price</th>
            <th class="px-6 py-3 bg-gray-100 text-left text-sm font-semibold text-gray-700">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="border-b hover:bg-gray-50">
              <td class="px-6 py-4">
                <div class="flex items-center space-x-4">
                  <div class="w-20">
                    <img src="<?php echo e(asset('storage/' . $item->product->image)); ?>" 
                         alt="<?php echo e($item->product->name); ?>" 
                         class="w-full h-16 object-cover rounded transition-transform duration-200 hover:scale-105">
                  </div>
                  <div>
                    <h2 class="text-lg font-semibold"><?php echo e($item->product->name); ?></h2>
                    <p class="text-gray-500">Available: <?php echo e($item->product->quantity); ?></p>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 text-sm text-gray-700"><?php echo e($item->quantity); ?></td>
              <td class="px-6 py-4 text-sm text-gray-700">₱<?php echo e(number_format($item->product->price, 2)); ?></td>
              <td class="px-6 py-4 text-sm text-gray-700">₱<?php echo e(number_format($item->product->price * $item->quantity, 2)); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>

      <div class="mt-6 flex items-center justify-between">
        <h2 class="text-xl font-semibold text-gray-800 flex items-center space-x-2">
            <i class="fas fa-coins text-yellow-500"></i> <!-- Coin Icon -->
            <span>Total: ₱<?php echo e(number_format($total, 2)); ?></span>
        </h2>
        
      </div>

      <!-- Buttons (Back to Marketplace and View Your Cart) -->
      <div class="mt-6 flex items-center justify-end">
        <form action="<?php echo e(route('cart.checkout')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-md transition duration-200 flex items-center space-x-2">
              <span>Checkout</span>
              <i class="fas fa-arrow-right"></i> <!-- Check Icon -->
            </button>
        </form>
      </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\Practice02\resources\views/marketplace/show_pop.blade.php ENDPATH**/ ?>