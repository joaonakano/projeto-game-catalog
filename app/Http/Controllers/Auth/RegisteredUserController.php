<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'picture' => ['file', 'mimes:jpg,png,gif', 'max:10240']
        ]);

        $path = null;

        // Se tiver arquivo 'picture', salva direto em public/pictures
        if ($request->hasFile('picture')) {
            // Cria a pasta caso não exista
            if (!file_exists(public_path('pictures'))) {
                mkdir(public_path('pictures'), 0755, true);
            }

            $file = $request->file('picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('pictures'), $filename);

            $path = 'pictures/' . $filename;
        }

        // Cria o usuário já com o caminho da imagem, se existir
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'picture' => $path,
        ]);

        event(new Registered($user));
        Auth::login($user);


        event(new Registered($user));

        Auth::login($user);

        return redirect(route('games.index', absolute: false));
    }
}
