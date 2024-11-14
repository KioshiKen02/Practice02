<!-- resources/views/profile/partials/profile-picture-form.blade.php -->
<div class="bg-gray-50 p-4 rounded-lg shadow-sm mb-6">
    <h2 class="text-xl font-semibold text-gray-900"><?php echo e(__('Profile Picture')); ?></h2>
    
    <!-- Profile Picture Upload Form -->
    <form method="post" action="<?php echo e(route('avatar.update')); ?>" enctype="multipart/form-data" class="mt-4 space-y-4">
        <?php echo csrf_field(); ?>

        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.input-label','data' => ['for' => 'avatar','value' => __('Upload Profile Picture')]]); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['for' => 'avatar','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Upload Profile Picture'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        <input type="file" id="avatar" name="avatar" accept="image/*" onchange="previewImage(event)" class="mt-1 block w-full text-sm text-gray-700 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.input-error','data' => ['class' => 'mt-2','messages' => $errors->get('avatar')]]); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'mt-2','messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('avatar'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

        <!-- Preview Image or Initials -->
        <div class="mt-4 flex items-center">
            <div id="avatar-preview-container" class="relative w-20 h-20 rounded-full overflow-hidden border border-gray-300 flex items-center justify-center">
                <?php if(Auth::user()->avatar): ?>
                    <img id="avatar-preview" src="<?php echo e(asset('storage/' . Auth::user()->avatar)); ?>" alt="Profile Picture Preview" class="w-full h-full object-cover" />
                <?php else: ?>
                    <div class="text-3xl font-bold text-gray-500">
                        <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?> <!-- Display the first initial -->
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.primary-button','data' => ['class' => 'mt-2']]); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'mt-2']); ?><?php echo e(__('Update Profile Picture')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    </form>

    <!-- Notification for Profile Picture Update -->
    <?php if(session('status') === 'avatar-updated'): ?>
        <div x-data="{ show: true }" x-show="show" x-transition class="mt-2 w-full">
            <div class="bg-green-500 text-black p-4 rounded-md shadow-md flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 0C4.485 0 0 4.485 0 10s4.485 10 10 10 10-4.485 10-10S15.515 0 10 0zm1 15l-5-5 1.415-1.415L10 12.585l4.585-4.585L16 8l-5 5z" />
                </svg>
                <p class="text-sm text-black font-semibold"><?php echo e(__('Profile Picture uploaded successfully!')); ?></p>
                <button @click="show = false" class="ml-auto text-white hover:text-gray-200 focus:outline-none">
                    &times; <!-- Close button -->
                </button>
            </div>
        </div>
    <?php endif; ?>

    <!-- Remove Profile Picture Form -->
    <form method="post" action="<?php echo e(route('avatar.remove')); ?>" class="mt-2">
        <?php echo csrf_field(); ?>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.primary-button','data' => []]); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?><?php echo e(__('Remove Profile Picture')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    </form>

    <!-- Notification for Profile Picture Removal -->
    <?php if(session('removed-status')): ?>
        <div x-data="{ show: true }" x-show="show" x-transition class="mt-2 w-full">
            <div class="bg-red-500 text-black p-4 rounded-md shadow-md flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 0C4.485 0 0 4.485 0 10s4.485 10 10 10 10-4.485 10-10S15.515 0 10 0zm1 15l-5-5 1.415-1.415L10 12.585l4.585-4.585L16 8l-5 5z" />
                </svg>
                <p class="text-sm text-black font-semibold"><?php echo e(__('Profile Picture removed successfully!')); ?></p>
                <button @click="show = false" class="ml-auto text-white hover:text-gray-200 focus:outline-none">
                    &times; <!-- Close button -->
                </button>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
    function previewImage(event) {
        const preview = document.getElementById('avatar-preview');
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
<?php /**PATH C:\laragon\www\Practice02\resources\views\profile\partials\profile-picture-form.blade.php ENDPATH**/ ?>