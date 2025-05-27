<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Album") }}
        </h2>
    </x-slot>

    @if(session()->exists("status"))
        <div>
            <p style="color: green;">{{ session()->get("status") }}</p>
        </div>
    @endif
    
    @foreach ($games as $game)
        <div>
            <a href="{{ route('games.edit', $game) }}">Editar</a>

            <div>
                <form action="{{ route("games.destroy", $game) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Excluir</button>
                </form>
            </div>
            
            <a href="{{ route('games.show', $game) }}">Visualizar</a>

            <h1><strong>Jogo:</strong> {{ $game->name }}</h1>
            <h2><strong>UUID:</strong> {{ $game->uuid }}</h2>
            <p><strong>Descrição:</strong> {{ $game->description }}</p>
        </div>
        <br>
    @endforeach
</x-app-layout>