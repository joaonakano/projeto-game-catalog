<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600 leading-tight">
            {{ __("Catálogo de Jogos") }}
        </h2>
    </x-slot>

    @if(session()->exists("status"))
        <div class="max-w-7xl mx-auto mb-6 p-4 bg-green-600 text-white rounded-lg shadow-lg">
            <p class="font-medium">{{ session()->get("status") }}</p>
        </div>
    @endif
    
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-4">
        @foreach ($games as $game)
            <div class="bg-gray-800 rounded-lg shadow-xl overflow-hidden transition-transform duration-300 hover:scale-[1.02] hover:shadow-2xl border border-gray-700">
                <!-- Game Image -->
                <div class="relative h-48 overflow-hidden bg-black">
                    <img src="{{ asset($game->game_picture) }}" alt="{{ $game->name }}" 
                         class="w-full h-full object-cover transition-opacity duration-300 hover:opacity-80">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent opacity-70"></div>
                    
                    <!-- Admin Actions -->
                    <div class="absolute top-2 right-2 flex space-x-2">
                        <a href="{{ route('games.edit', $game) }}" 
                           class="p-2 bg-blue-600 rounded-full hover:bg-blue-700 transition-colors"
                           title="Editar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </a>
                        <form action="{{ route("games.destroy", $game) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="p-2 bg-red-600 rounded-full hover:bg-red-700 transition-colors"
                                    title="Excluir"
                                    onclick="return confirm('Tem certeza que deseja excluir este jogo?')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Game Info -->
                <div class="p-5">
                    <h1 class="text-xl font-bold text-white mb-2 truncate">{{ $game->name }}</h1>
                    <p class="text-gray-300 text-sm mb-4 line-clamp-3">{{ $game->description }}</p>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-400">ID: {{ $game->uuid }}</span>
                        
                        <a href="{{ route('games.show', $game) }}" 
                           class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                            Detalhes
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>