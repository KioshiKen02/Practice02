<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
    <script>
        function updatePreview() {
            document.getElementById('preview-name').innerText = document.getElementById('name').value;
            document.getElementById('preview-description').innerText = document.getElementById('description').value;
            document.getElementById('preview-price').innerText = document.getElementById('price').value ? '₱' + document.getElementById('price').value : '';
            document.getElementById('preview-quantity').innerText = document.getElementById('quantity').value ? 'Quantity: ' + document.getElementById('quantity').value : '';

            const fileInput = document.getElementById('image');
            const previewImage = document.getElementById('preview-image');
            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                }
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                previewImage.src = 'https://placehold.co/300x300?text=No+Image';
            }
        }
    </script>
</head>
<body class="bg-gray-800 font-roboto">

    <!-- Header -->
    <header class="bg-white shadow-md py-4">
        <div class="max-w-4xl mx-auto flex justify-between items-center px-4">
            <h1 class="text-3xl font-bold text-gray-900">Marketplace</h1>
            <nav>
                <ul class="flex space-x-3">
                    <li>
                        <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-700 hover:text-gray-900">
                            <i class="fas fa-home mr-1"></i> Home
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('marketdash')); ?>" class="text-gray-700 hover:text-gray-900">
                            <i class="fab fa-shopify mr-1"></i> Products
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <div class="flex flex-col lg:flex-row max-w-4xl mx-auto mt-8 px-4 lg:space-x-6">

        <!-- Product Form -->
        <div class="w-full lg:w-1/2 p-6 bg-white shadow-lg rounded-lg mb-6 lg:mb-0">
            <h1 class="text-3xl font-bold mb-4 text-center text-gray-800">
                <i class="fas fa-plus-circle mr-2"></i> Add New Product
            </h1>
            <form action="<?php echo e(route('marketplace.store')); ?>" class="space-y-4" enctype="multipart/form-data" method="POST" oninput="updatePreview()">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label class="block text-gray-800 font-semibold" for="name">
                        <i class="fas fa-tag mr-2"></i> Product Name
                    </label>
                    <input class="w-full p-3 border border-gray-300 rounded-lg mt-2 focus:outline-none focus:ring-2 focus:ring-gray-500" id="name" name="name" placeholder="Product Name" required="" type="text"/>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-800 font-semibold" for="description">
                        <i class="fas fa-info-circle mr-2"></i> Description
                    </label>
                    <textarea class="w-full p-3 border border-gray-300 rounded-lg mt-2 focus:outline-none focus:ring-2 focus:ring-gray-500" id="description" name="description" placeholder="Description"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-800 font-semibold" for="price">
                        <i class="fas fa-money-bill-wave mr-2"></i> Price
                    </label>
                    <input class="w-full p-3 border border-gray-300 rounded-lg mt-2 focus:outline-none focus:ring-2 focus:ring-gray-500" id="price" name="price" placeholder="Price" required="" type="number"/>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-800 font-semibold" for="quantity">
                        <i class="fas fa-boxes mr-2"></i> Quantity
                    </label>
                    <input class="w-full p-3 border border-gray-300 rounded-lg mt-2 focus:outline-none focus:ring-2 focus:ring-gray-500" id="quantity" name="quantity" placeholder="Quantity" required="" type="number"/>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-800 font-semibold" for="image">
                        <i class="fas fa-image mr-2"></i> Product Image
                    </label>
                    <input class="w-full p-3 border border-gray-300 rounded-lg mt-2 focus:outline-none focus:ring-2 focus:ring-gray-500" id="image" name="image" type="file"/>
                </div>
                <button class="w-full bg-gray-600 text-white p-3 rounded-lg font-semibold hover:bg-gray-700 transition duration-300" type="submit">
                    <i class="fas fa-plus-circle mr-2"></i> Add Product
                </button>
            </form>
        </div>

        <!-- Product Preview -->
        <div class="w-full lg:w-1/2 p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-3xl font-bold mb-4 text-center text-gray-800">
                <i class="fas fa-eye mr-2"></i> Product Preview
            </h2>
            <div class="space-y-4">
                <div class="text-center">
                    <img alt="Product Image Preview" class="mx-auto rounded-lg" height="250" id="preview-image" src="https://placehold.co/300x300?text=No+Image" width="250"/>
                </div>
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-800" id="preview-name">Product Name</h3>
                    <p class="text-gray-600" id="preview-description">Description</p>
                    <p class="text-xl font-semibold text-gray-800" id="preview-price">₱0.00</p>
                    <p class="text-gray-600" id="preview-quantity">Quantity: 0</p>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
<?php /**PATH C:\laragon\www\Practice02\resources\views/marketplace/create.blade.php ENDPATH**/ ?>