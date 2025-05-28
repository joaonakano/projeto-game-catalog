<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Game Register") }}
        </h2>
    </x-slot>

    @if ($errors->any())
        <ul class="mb-4 list-disc list-inside text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route("games.store") }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-lg mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        @csrf

        <div>
            <label class="block mb-1 font-medium" for="game_picture">{{ __("Insert Game Image") }}:</label>
            <input type="file" id="game_picture" name="game_picture" accept="image/*" required class="block w-full rounded border-gray-300 dark:border-gray-700">
        </div>

        <div>
            <label class="block mb-1 font-medium" for="name">{{ __("Insert Game") }}:</label>
            <input type="text" id="name" name="name" placeholder="{{ __("Game") }}" required class="block w-full rounded border-gray-300 dark:border-gray-700 p-2">
        </div>

        <div>
            <label class="block mb-1 font-medium" for="description">{{ __("Insert Game Description") }}:</label>
            <input type="text" id="description" name="description" placeholder="{{ __("Description") }}" required class="block w-full rounded border-gray-300 dark:border-gray-700 p-2">
        </div>

        <div>
            <label class="block mb-1 font-medium" for="release_date">{{ __("Insert Game Launch Date") }}:</label>
            <input type="date" id="release_date" name="release_date" required class="block w-full rounded border-gray-300 dark:border-gray-700 p-2">
        </div>

        <div>
            <label class="block mb-1 font-medium" for="developer">{{ __("Insert Game Developer") }}:</label>
            <input type="text" id="developer" name="developer" placeholder="{{ __("Game Developer") }}" required class="block w-full rounded border-gray-300 dark:border-gray-700 p-2">
        </div>

        <div>
            <label class="block mb-1 font-medium" for="publisher">{{ __("Insert Game Publisher") }}:</label>
            <input type="text" id="publisher" name="publisher" placeholder="{{ __("Game Publisher") }}" required class="block w-full rounded border-gray-300 dark:border-gray-700 p-2">
        </div>

        <button type="submit" class="w-full bg-salmon-500 text-white py-3 rounded-lg hover:bg-red-600 transition" style="background-color: salmon;">
            {{ __("Register") }}
        </button>
    </form>
</x-app-layout>
