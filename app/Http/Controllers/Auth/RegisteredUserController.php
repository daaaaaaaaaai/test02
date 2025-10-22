<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Masters\User;
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
            'user_id' => ['required', 'string', 'max:20', 'unique:'.User::class],
            'name_last' => ['required', 'string', 'max:40'],
            'name_first' => ['nullable', 'string', 'max:40'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255'],
//            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'user_id' => $request->user_id,
            'name_last' => $request->name_last,
            'name_first' => $request->name_first,
            'name' => $request->name_last ." ". $request->name_first,
            'email' => $request->email,
//            'password' => Hash::make($request->password),
            'password' => Hash::make('init1234!'),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
