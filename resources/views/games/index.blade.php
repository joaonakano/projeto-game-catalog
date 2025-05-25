<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Album") }}
        </h2>
    </x-slot>
    @foreach ($games as $game)
        <div>
            <a href="{{ route('games.edit', $game) }}">Editar</a>
            
            <h1><strong>Jogo:</strong> {{ $game->name }}</h1>
            <h2><strong>UUID:</strong> {{ $game->uuid }}</h2>
            <p><strong>Descrição:</strong> {{ $game->description }}</p>
        </div>
        <br>
    @endforeach
</x-app-layout>