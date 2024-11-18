<x-app-layout>
    <x-slot name="header">
        
    </x-slot>
    @if(session('success'))
    <div class="bg-gradient-to-r from-green-400 to-green-500 text-white px-6 py-3 rounded-lg mb-8 text-center shadow-lg">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @include('marketplace.index')
            </div>
        </div>
    </div>
</x-app-layout>