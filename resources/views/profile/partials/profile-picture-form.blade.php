<!-- resources/views/profile/partials/profile-picture-form.blade.php -->
<div class="bg-gray-50 p-4 rounded-lg shadow-sm mb-6">
    <h2 class="text-xl font-semibold text-gray-900">{{ __('Profile Picture') }}</h2>
    
    <!-- Profile Picture Upload Form -->
    <form method="post" action="{{ route('avatar.update') }}" enctype="multipart/form-data" class="mt-4 space-y-4">
        @csrf

        <x-input-label for="avatar" :value="__('Upload Profile Picture')" />
        <input type="file" id="avatar" name="avatar" accept="image/*" onchange="previewImage(event)" class="mt-1 block w-full text-sm text-gray-700 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
        <x-input-error class="mt-2" :messages="$errors->get('avatar')" />

        <!-- Preview Image or Initials -->
        <div class="mt-4 flex items-center">
            <div id="avatar-preview-container" class="relative w-20 h-20 rounded-full overflow-hidden border border-gray-300 flex items-center justify-center">
                @if(Auth::user()->avatar)
                    <img id="avatar-preview" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile Picture Preview" class="w-full h-full object-cover" />
                @else
                    <div class="text-3xl font-bold text-gray-500">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }} <!-- Display the first initial -->
                    </div>
                @endif
            </div>
        </div>

        <x-primary-button class="mt-2">{{ __('Update Profile Picture') }}</x-primary-button>
    </form>

    <!-- Notification for Profile Picture Update -->
    @if (session('status') === 'avatar-updated')
        <div x-data="{ show: true }" x-show="show" x-transition class="mt-2 w-full">
            <div class="bg-green-500 text-black p-4 rounded-md shadow-md flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 0C4.485 0 0 4.485 0 10s4.485 10 10 10 10-4.485 10-10S15.515 0 10 0zm1 15l-5-5 1.415-1.415L10 12.585l4.585-4.585L16 8l-5 5z" />
                </svg>
                <p class="text-sm text-black font-semibold">{{ __('Profile Picture uploaded successfully!') }}</p>
                <button @click="show = false" class="ml-auto text-white hover:text-gray-200 focus:outline-none">
                    &times; <!-- Close button -->
                </button>
            </div>
        </div>
    @endif

    <!-- Remove Profile Picture Form -->
    <form method="post" action="{{ route('avatar.remove') }}" class="mt-2">
        @csrf
        <x-primary-button>{{ __('Remove Profile Picture') }}</x-primary-button>
    </form>

    <!-- Notification for Profile Picture Removal -->
    @if (session('removed-status'))
        <div x-data="{ show: true }" x-show="show" x-transition class="mt-2 w-full">
            <div class="bg-red-500 text-black p-4 rounded-md shadow-md flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 0C4.485 0 0 4.485 0 10s4.485 10 10 10 10-4.485 10-10S15.515 0 10 0zm1 15l-5-5 1.415-1.415L10 12.585l4.585-4.585L16 8l-5 5z" />
                </svg>
                <p class="text-sm text-black font-semibold">{{ __('Profile Picture removed successfully!') }}</p>
                <button @click="show = false" class="ml-auto text-white hover:text-gray-200 focus:outline-none">
                    &times; <!-- Close button -->
                </button>
            </div>
        </div>
    @endif
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
