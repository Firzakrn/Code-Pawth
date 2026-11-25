<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'role' => [
                'required',
                Rule::in(['murid', 'guru']),
            ],
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
                'string',
            ],
        ]);

        if (!Auth::attempt($data, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'Email, password, atau peran akun tidak sesuai.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'role' => [
                'required',
                Rule::in(['murid', 'guru']),
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
            ],
            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],
            'school' => [
                'nullable',
                'string',
                'max:255',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'school' => $data['role'] === 'guru'
                ? ($data['school'] ?? null)
                : null,
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Akun berhasil dibuat!');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}