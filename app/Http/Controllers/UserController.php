<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(RegisterRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user = User::create([
            'surname' => $request->surname,
            'name' => $request->name,
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        Auth::login($user);
        $request->session()->regenerate();
        return redirect('/');
    }

    public function login(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user = User::all()->where('login','=',$request->login)->first();
        if($user != null)
        {
            if ($user && Hash::check($request->password, $user->password)){
                Auth::login($user);
                $request->session()->regenerate();
            }
            else {
                return redirect()->route('login')->withErrors('Невернный пароль')->withInput();
            }
        }
        else {
            return redirect()->route('login')->withErrors('Пользователь не найден')->withInput();
        }
        return redirect('/');
    }

    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
}
