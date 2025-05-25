<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Game Update") }}
        </h2>    
    </x-slot>

    <form action="">

        @csrf
        @method("PUT")
        
        <div>
            <label for="">Insira o Nome do Jogo:</label>
            <input type="text" value="{{ $game->name }}" required>
        </div>

        <div>
            <label for="">Insira a Descrição do Jogo:</label>
            <input type="text" value="{{ $game->description }}" required>
        </div>

        <div>
            <label for="">Insira a Data de Lançamento</label>
            <input type="date" value="{{ $game->release_date }}" required>
        </div>

        <div>
            <label for="">Insira a Desenvolvedora:</label>
            <input type="text" value="{{ $game->developer }}" required>
        </div>

        <div>
            <label for="">Insira a Publisher</label>
            <input type="text" value="{{ $game->publisher }}" required>
        </div>

        <button type="submit" style="background-color: cornflowerblue; padding: 1rem; border-radius: 1em;">Atualizar</button>
    </form>
</x-app-layout>
