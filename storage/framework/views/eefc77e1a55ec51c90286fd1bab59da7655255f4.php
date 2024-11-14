<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="text-4xl font-bold text-indigo-600">
            <?php echo e(__('Check Out Process')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Cart Items -->
            <div class="bg-white shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">
                        <i class="fas fa-shopping-cart text-blue-500"></i> <!-- Cart Icon -->
                        <span> Your Cart</span>
                    </h3>
                    <?php
                        $total = 0;
                        foreach ($cartItems as $item) {
                            $total += $item->product->price * $item->quantity;
                        }
                    ?>
                    <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex justify-between items-center py-2 border-b">
                            <span class="font-medium"><?php echo e($item->product->name); ?> x<?php echo e($item->quantity); ?></span>
                            <span class="font-semibold text-gray-600">₱<?php echo e(number_format($item->product->price, 2)); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex justify-between items-center py-2 border-t mt-4">
                        <span class="font-semibold">Total:</span>
                        <span class="font-semibold text-gray-600">₱<?php echo e(number_format($total, 2)); ?></span>
                    </div>
                </div>
            </div>
            
            <!-- Shipping & Payment Form -->
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Shipping Information</h3>

                    <!-- Display Errors -->
                    <?php if($errors->any()): ?>
                        <div class="bg-red-100 text-red-700 p-4 rounded-md mb-4">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('checkout.storeShipping')); ?>" method="POST" class="space-y-6">
                        <?php echo csrf_field(); ?>
                        
                        <!-- Shipping Address -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- House No. -->
                            <div class="flex flex-col space-y-2">
                                <label for="house_no" class="font-medium text-gray-700 flex items-center">
                                    <i class="fa-solid fa-home text-indigo-600 mr-2"></i>
                                    House No.
                                </label>
                                <input id="house_no" name="house_no" type="text" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required placeholder="e.g., 123" />
                                <?php $__errorArgs = ['house_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Street -->
                            <div class="flex flex-col space-y-2">
                                <label for="street" class="font-medium text-gray-700 flex items-center">
                                    <i class="fa-solid fa-road text-indigo-600 mr-2"></i>
                                    Street
                                </label>
                                <input id="street" name="street" type="text" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required placeholder="e.g., Main Street" />
                                <?php $__errorArgs = ['street'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Barangay -->
                            <div class="flex flex-col space-y-2">
                                <label for="barangay" class="font-medium text-gray-700 flex items-center">
                                    <i class="fa-solid fa-map-marker-alt text-indigo-600 mr-2"></i>
                                    Barangay
                                </label>
                                <input id="barangay" name="barangay" type="text" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required placeholder="e.g., Barangay 1" />
                                <?php $__errorArgs = ['barangay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Municipality -->
                            <div class="flex flex-col space-y-2">
                                <label for="municipality" class="font-medium text-gray-700 flex items-center">
                                    <i class="fa-solid fa-city text-indigo-600 mr-2"></i>
                                    Municipality
                                </label>
                                <input id="municipality" name="municipality" type="text" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required placeholder="e.g., Quezon City" />
                                <?php $__errorArgs = ['municipality'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Province -->
                            <div class="flex flex-col space-y-2">
                                <label for="province" class="font-medium text-gray-700 flex items-center">
                                    <i class="fa-solid fa-globe text-indigo-600 mr-2"></i>
                                    Province
                                </label>
                                <input id="province" name="province" type="text" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required placeholder="e.g., Metro Manila" />
                                <?php $__errorArgs = ['province'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
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
                            <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4 flex justify-end">
                            <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300" aria-label="Complete Order">
                                Complete Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\Practice02\resources\views\marketplace\preview.blade.php ENDPATH**/ ?>