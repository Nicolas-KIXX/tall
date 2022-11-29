<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-8 px-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <p class="pb-6 text-xl uppercase text-gray-900">
                    Admin actions
                </p>
                <ul class="pl-4 list-disc">
                    <li class="text-blue-400 hover:underline">
                        <a href="{{ route('subscribers.all') }}">Manage subscribers</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
