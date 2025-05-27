<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __("Game") }}
        </h2>
    </x-slot>

    <h1 style="font-size: 20px;"><strong>{{ $game->name }}</strong></h1>
    <p>{{ $game->description }}</p>
    <p>{{ $game->release_date}}</p>
    <p>{{ $game->developer }}</p>
    <p>{{ $game->publisher }}</p>
    
</x-app-layout>