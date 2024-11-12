<x-app-layout>
    <x-slot name="header">
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @include('marketplace.index')
            </div>
        </div>
    </div>
</x-app-layout>