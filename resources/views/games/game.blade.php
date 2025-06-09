<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600 leading-tight">
            {{ __("Detalhes do Jogo") }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Game Hero Section -->
        <div class="bg-gray-800 rounded-xl shadow-2xl overflow-hidden mb-8 border border-gray-700">
            <!-- Game Cover Image -->
            <div class="relative h-96 w-full bg-black flex items-center justify-center">
                <img src="{{ asset($game->game_picture) }}" alt="{{ $game->name }}" 
                     class="w-full h-full object-contain transition-opacity duration-300">
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent opacity-50"></div>
            </div>

            <!-- Game Info Container -->
            <div class="p-6 md:p-8">
                <!-- Game Title -->
                <h1 class="text-4xl font-bold text-white mb-4">{{ $game->name }}</h1>
                
                <!-- Game Metadata Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-gray-700 bg-opacity-50 p-4 rounded-lg">
                        <h3 class="text-sm font-semibold text-purple-400 mb-1">DESENVOLVEDOR</h3>
                        <p class="text-white">{{ $game->developer }}</p>
                    </div>
                    
                    <div class="bg-gray-700 bg-opacity-50 p-4 rounded-lg">
                        <h3 class="text-sm font-semibold text-purple-400 mb-1">PUBLICADOR</h3>
                        <p class="text-white">{{ $game->publisher }}</p>
                    </div>
                    
                    <div class="bg-gray-700 bg-opacity-50 p-4 rounded-lg">
                        <h3 class="text-sm font-semibold text-purple-400 mb-1">DATA DE LANÇAMENTO</h3>
                        <p class="text-white">{{ \Carbon\Carbon::parse($game->release_date)->format('d/m/Y') }}</p>
                    </div>
                </div>

                <!-- Game Description -->
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-white mb-3">SOBRE O JOGO</h3>
                    <p class="text-gray-300 leading-relaxed">{{ $game->description }}</p>
                </div>

                <!-- Back Button -->
                <div class="flex justify-start">
                    <a href="{{ route('games.index') }}" 
                       class="px-6 py-3 bg-gray-600 hover:bg-gray-500 text-white rounded-lg transition-colors flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Voltar para o Catálogo
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>