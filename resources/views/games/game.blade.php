<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Game") }}
        </h2>
    </x-slot>

    <div class="flex justify-center mb-6">
        <img src="{{ asset('storage/' . $game->game_picture) }}" alt="{{ $game->name }}" class="max-w-xs max-h-72 rounded-lg shadow-md">
    </div>

    <h1 class="text-xl font-bold mb-4"><strong>{{ $game->name }}</strong></h1>
    
    <p class="mb-2">{{ $game->description }}</p>
    <p class="mb-2">{{ $game->release_date }}</p>
    <p class="mb-2">{{ $game->developer }}</p>
    <p class="mb-2">{{ $game->publisher }}</p>
</x-app-layout>
