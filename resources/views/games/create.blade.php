<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Game Register") }}
        </h2>
    </x-slot>

    <form action="{{ route("games.store") }}" method="POST">
        @csrf

        <div>
            <label for="">{{ __("Insert Game") }}:</label>
            <input type="text" name="name" placeholder="{{ __("Game") }}">
        </div>

        <div>
            <label for="">{{ __("Insert Game Description") }}:</label>
            <input type="text" name="description" placeholder="{{ __("Description") }}">
        </div>

        <div>
            <label for="">{{ __("Insert Game Launch Date") }}:</label>
            <input type="date" name="release_date">
        </div>

        <div>
            <label for="">{{ __("Insert Game Developer") }}:</label>
            <input type="text" name="developer" placeholder="{{ __("Game Developer") }}">
        </div>

        <div>
            <label for="">{{ __("Insert Game Publisher") }}:</label>
            <input type="text" name="publisher" placeholder="{{ __("Game Publisher") }}">
        </div>

        <button type="submit" style="background-color: salmon; padding: 1rem; border-radius: 1em;">Cadastrar</button>
    </form>
</x-app-layout>
