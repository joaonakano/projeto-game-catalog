<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Game Update") }}
        </h2>    
    </x-slot>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route("games.update", $game) }}" method="POST">

        @csrf
        @method("PUT")
        
        <div>
            <label for="">Insira o Nome do Jogo:</label>
            <input type="text" name="name" value="{{ $game->name }}" required>
        </div>

        <div>
            <label for="">Insira a Descrição do Jogo:</label>
            <input type="text" name="description" value="{{ $game->description }}" required>
        </div>

        <div>
            <label for="">Insira a Data de Lançamento</label>
            <input type="date" name="release_date" value="{{ $game->release_date }}" required>
        </div>

        <div>
            <label for="">Insira a Desenvolvedora:</label>
            <input type="text" name="developer" value="{{ $game->developer }}" required>
        </div>

        <div>
            <label for="">Insira a Publisher</label>
            <input type="text" name="publisher" value="{{ $game->publisher }}" required>
        </div>

        <button type="submit" style="background-color: cornflowerblue; padding: 1rem; border-radius: 1em;">{{__("Update")}}</button>
    </form>
</x-app-layout>
