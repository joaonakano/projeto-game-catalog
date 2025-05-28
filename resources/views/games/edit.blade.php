<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Game Update") }}
        </h2>    
    </x-slot>

    @if ($errors->any())
        <ul class="mb-4 list-disc list-inside text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route("games.update", $game) }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-lg mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        @csrf
        @method("PUT")

        <div>
            <label class="block mb-1 font-medium" for="game_picture">Insira a Imagem do Jogo:</label>
            <input type="file" id="game_picture" name="game_picture" accept="image/*" class="block w-full rounded border-gray-300 dark:border-gray-700">
            <img src="{{ asset('storage/' . $game->game_picture) }}" alt="{{ $game->name }}" class="mt-3 max-w-xs max-h-72 rounded-lg shadow">
        </div>

        <div>
            <label class="block mb-1 font-medium" for="name">Insira o Nome do Jogo:</label>
            <input type="text" id="name" name="name" value="{{ $game->name }}" required class="block w-full rounded border-gray-300 dark:border-gray-700 p-2">
        </div>

        <div>
            <label class="block mb-1 font-medium" for="description">Insira a Descrição do Jogo:</label>
            <input type="text" id="description" name="description" value="{{ $game->description }}" required class="block w-full rounded border-gray-300 dark:border-gray-700 p-2">
        </div>

        <div>
            <label class="block mb-1 font-medium" for="release_date">Insira a Data de Lançamento:</label>
            <input type="date" id="release_date" name="release_date" value="{{ $game->release_date }}" required class="block w-full rounded border-gray-300 dark:border-gray-700 p-2">
        </div>

        <div>
            <label class="block mb-1 font-medium" for="developer">Insira a Desenvolvedora:</label>
            <input type="text" id="developer" name="developer" value="{{ $game->developer }}" required class="block w-full rounded border-gray-300 dark:border-gray-700 p-2">
        </div>

        <div>
            <label class="block mb-1 font-medium" for="publisher">Insira a Publisher:</label>
            <input type="text" id="publisher" name="publisher" value="{{ $game->publisher }}" required class="block w-full rounded border-gray-300 dark:border-gray-700 p-2">
        </div>

        <button type="submit" class="w-full bg-cornflowerblue text-white py-3 rounded-lg hover:bg-blue-700 transition">
            {{ __("Update") }}
        </button>
    </form>
</x-app-layout>
