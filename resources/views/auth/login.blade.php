<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-900 p-4">
        <div class="w-full max-w-xs bg-gray-800 p-6 rounded-xl shadow-2xl border border-gray-700">
            <div class="text-center mb-4">
                <x-application-logo class="mx-auto h-10 w-auto text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600" />
                <h2 class="mt-2 text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600">
                    Acesse sua conta
                </h2>
            </div>

            <x-auth-session-status class="mb-3 p-2 bg-green-600/20 text-green-300 rounded text-xs" :status="session('status')" />

            <form class="space-y-3" method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email" class="block text-xs text-gray-300 mb-1">Email</label>
                    <input id="email" name="email" type="email" required
                           class="text-xs w-full bg-gray-700 border border-gray-600 rounded px-3 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-purple-500"
                           placeholder="email@exemplo.com" value="{{ old('email') }}">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-400 text-xs" />
                </div>

                <div>
                    <label for="password" class="block text-xs text-gray-300 mb-1">Senha</label>
                    <input id="password" name="password" type="password" required
                           class="text-xs w-full bg-gray-700 border border-gray-600 rounded px-3 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-purple-500"
                           placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-400 text-xs" />
                </div>

                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="h-3 w-3 text-purple-600 focus:ring-purple-500 border-gray-600 rounded bg-gray-700">
                        <span class="ml-1 text-gray-300">Lembrar</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-purple-400 hover:text-pink-400">Esqueceu a senha?</a>
                </div>

                <button type="submit" class="w-full py-2 px-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white text-sm rounded hover:from-purple-700 hover:to-pink-700 transition">
                    Entrar
                </button>

                <div class="text-center text-xs text-gray-400 mt-2">
                    Não tem conta? <a href="{{ route('register') }}" class="text-purple-400 hover:text-pink-400">Cadastre-se</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>