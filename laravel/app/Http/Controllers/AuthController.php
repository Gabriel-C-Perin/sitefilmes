<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function showLogin()
	{
		return view('auth.login');
	}

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user && $user->is_admin) {
                return redirect()->route('admin.movies.index');
            }
            return redirect()->route('catalog.index');
        }

        return back()->withErrors(['email' => 'Credenciais inválidas'])->onlyInput('email');
    }

	public function showRegister()
	{
		return view('auth.register');
	}

	public function register(Request $request)
	{
		$data = $request->validate([
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'email', 'max:255', 'unique:users,email'],
			'password' => ['required', 'confirmed', 'min:6'],
		]);

		$user = User::create($data);
		Auth::login($user);
		return redirect()->route('catalog.index');
	}

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
        }
        try {
            $request->session()->invalidate();
        } catch (\Throwable $e) {}
        try {
            $request->session()->regenerateToken();
        } catch (\Throwable $e) {}
        return redirect()->route('login');
    }
}


