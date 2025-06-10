<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-gray-800 p-10 rounded-xl shadow-2xl border border-gray-700">
            <div class="text-center">
                <x-application-logo class="mx-auto h-16 w-auto text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600" />
                <h2 class="mt-6 text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600">
                    Acesse sua conta
                </h2>
                <p class="mt-2 text-sm text-gray-400">
                    Ou <a href="{{ route('register') }}" class="font-medium text-purple-400 hover:text-pink-400 transition-colors">crie uma nova conta</a>
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 p-4 bg-green-600/20 text-green-300 rounded-lg" :status="session('status')" />

            <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="rounded-md shadow-sm space-y-4">
                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                   class="pl-10 block w-full bg-gray-700 border border-gray-600 rounded-lg py-3 px-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                   placeholder="seu@email.com" value="{{ old('email') }}">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-sm" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Senha</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                   class="pl-10 block w-full bg-gray-700 border border-gray-600 rounded-lg py-3 px-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                   placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-sm" />
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox"
                               class="h-4 w-4 bg-gray-700 border-gray-600 rounded focus:ring-purple-500 text-purple-600">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-300">
                            Lembrar de mim
                        </label>
                    </div>

                    <!-- Forgot Password -->
                    @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-purple-400 hover:text-pink-400 transition-colors">
                                Esqueceu sua senha?
                            </a>
                        </div>
                    @endif
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-300">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-purple-300 group-hover:text-pink-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                        </span>
                        Entrar
                    </button>
                </div>

                <div class="text-center text-sm text-gray-400">
                    Não tem uma conta? 
                    <a href="{{ route('register') }}" class="font-medium text-purple-400 hover:text-pink-400 transition-colors">
                        Cadastre-se aqui
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>