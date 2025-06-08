<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Game") }}
        </h2>
    </x-slot>

    <div class="flex justify-center mb-6">
    <img src="{{ asset($game->game_picture) }}" alt="{{ $game->name }}" class="w-full max-h-96 object-contain">
    </div>

    <h1 class="text-xl font-bold mb-4"><strong>{{ $game->name }}</strong></h1>
    
    <p class="mb-2">{{ $game->description }}</p>
    <p class="mb-2">{{ $game->release_date }}</p>
    <p class="mb-2">{{ $game->developer }}</p>
    <p class="mb-2">{{ $game->publisher }}</p>
</x-app-layout>
