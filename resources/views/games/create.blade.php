<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600 leading-tight">
            {{ __("Cadastrar Novo Jogo") }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-600 bg-opacity-20 border-l-4 border-red-500 text-red-100 rounded">
                <h3 class="font-bold mb-2">Corrija os seguintes erros:</h3>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Registration Form -->
        <form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data" 
              class="space-y-6 bg-gray-800 rounded-xl shadow-2xl overflow-hidden border border-gray-700 p-6 md:p-8">
            @csrf

            <!-- Game Image Section -->
            <div class="space-y-4">
                <label class="block text-lg font-semibold text-purple-400" for="game_picture">
                    <i class="fas fa-image mr-2"></i>Imagem do Jogo
                </label>
                <div class="flex flex-col">
                    <input type="file" id="game_picture" name="game_picture" accept="image/*" required
                           class="block w-full text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-700 transition">
                    <p class="mt-2 text-sm text-gray-400">Formatos aceitos: JPG, PNG, GIF (Máx: 5MB)</p>
                </div>
            </div>

            <!-- Game Info Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Game Name -->
                <div class="space-y-2">
                    <label class="block text-lg font-semibold text-purple-400" for="name">
                        <i class="fas fa-gamepad mr-2"></i>Nome do Jogo
                    </label>
                    <input type="text" id="name" name="name" placeholder="Ex: The Witcher 3" required
                           class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>

                <!-- Release Date -->
                <div class="space-y-2">
                    <label class="block text-lg font-semibold text-purple-400" for="release_date">
                        <i class="far fa-calendar-alt mr-2"></i>Data de Lançamento
                    </label>
                    <input type="date" id="release_date" name="release_date" required
                           class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>

                <!-- Developer -->
                <div class="space-y-2">
                    <label class="block text-lg font-semibold text-purple-400" for="developer">
                        <i class="fas fa-code mr-2"></i>Desenvolvedora
                    </label>
                    <input type="text" id="developer" name="developer" placeholder="Ex: CD Projekt Red" required
                           class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>

                <!-- Publisher -->
                <div class="space-y-2">
                    <label class="block text-lg font-semibold text-purple-400" for="publisher">
                        <i class="fas fa-building mr-2"></i>Publisher
                    </label>
                    <input type="text" id="publisher" name="publisher" placeholder="Ex: Bandai Namco" required
                           class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
            </div>

            <!-- Description -->
            <div class="space-y-2">
                <label class="block text-lg font-semibold text-purple-400" for="description">
                    <i class="fas fa-align-left mr-2"></i>Descrição
                </label>
                <textarea id="description" name="description" rows="4" placeholder="Descreva sobre o jogo..." required
                          class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:border-transparent"></textarea>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                <button type="submit" 
                        class="flex-1 bg-gradient-to-r from-salmon-500 to-orange-500 hover:from-salmon-600 hover:to-orange-600 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-plus-circle mr-2"></i> Cadastrar Jogo
                </button>
                
                <a href="{{ route('games.index') }}" 
                   class="flex-1 bg-gray-600 hover:bg-gray-500 text-white font-bold py-3 px-6 rounded-lg transition text-center">
                    <i class="fas fa-arrow-left mr-2"></i> Voltar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>