<?php $attributes = $attributes->exceptProps(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white']); ?>
<?php foreach (array_filter((['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
// Determine alignment classes
if ($align === 'left') {
    $alignmentClasses = 'ltr:origin-top-left rtl:origin-top-right start-0';
} elseif ($align === 'top') {
    $alignmentClasses = 'origin-top';
} else {
    $alignmentClasses = 'ltr:origin-top-right rtl:origin-top-left end-0';
}

// Determine width classes
if ($width === '48') {
    $width = 'w-48';
} else {
    $width = $width; // This keeps the original width if it's not '48'
}
?>

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        <?php echo e($trigger); ?>

    </div>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute z-50 mt-2 <?php echo e($width); ?> rounded-md shadow-lg <?php echo e($alignmentClasses); ?>"
         style="display: none;"
         @click="open = false">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 <?php echo e($contentClasses); ?>">
            <?php echo e($content); ?>

        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\Practice02\resources\views\components\dropdown.blade.php ENDPATH**/ ?>