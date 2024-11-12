<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-bold text-indigo-600" href="#">
            {{ __('Anime Merchandise') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                </div>
                @include('marketplace.index')
            </div>
        </div>
    </div>
</x-app-layout>