<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Album") }}
        </h2>
    </x-slot>

    @if(session()->exists("status"))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            <p>{{ session()->get("status") }}</p>
        </div>
    @endif
    
    <div class="space-y-8">
        @foreach ($games as $game)
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <div class="flex items-center justify-between mb-3">
                    <a href="{{ route('games.edit', $game) }}" class="text-blue-600 hover:underline">Editar</a>
                    <form action="{{ route("games.destroy", $game) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                    </form>
                    <a href="{{ route('games.show', $game) }}" class="text-green-600 hover:underline">Visualizar</a>
                </div>

                <div class="flex justify-center mb-4">
                    <img src="{{ asset('storage/' . $game->game_picture) }}" alt="{{ $game->name }}" class="max-w-xs max-h-72 rounded-lg shadow">
                </div>

                <h1 class="text-lg font-semibold mb-1"><strong>Jogo:</strong> {{ $game->name }}</h1>
                <h2 class="text-sm text-gray-500 mb-1"><strong>UUID:</strong> {{ $game->uuid }}</h2>
                <p><strong>Descrição:</strong> {{ $game->description }}</p>
            </div>
        @endforeach
    </div>
</x-app-layout>
