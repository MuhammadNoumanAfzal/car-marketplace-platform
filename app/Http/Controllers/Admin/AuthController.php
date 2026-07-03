<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLoginForm(): View
    {
        return view('admin.auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'These admin credentials do not match our records.']);
        }

        $request->session()->regenerate();

        return redirect()
            ->intended(route('admin.dashboard'))
            ->with([
                'status' => 'Welcome back. You are now signed in to the admin dashboard.',
                'status_type' => 'success',
                'status_title' => 'Login successful',
            ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with([
                'status' => 'You have been logged out successfully.',
                'status_type' => 'success',
                'status_title' => 'Signed out',
            ]);
    }

    public function editAccount(): View
    {
        return view('admin.auth.account', [
            'heading' => 'Account Settings',
            'title' => 'Account Settings',
            'active' => 'account',
            'user' => Auth::user(),
        ]);
    }

    public function updateAccount(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password' => ['nullable', 'required_with:password,password_confirmation'],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        if (! empty($validated['password']) && ! Hash::check((string) $request->input('current_password'), $user->password)) {
            return back()->withErrors([
                'current_password' => 'The current password you entered is incorrect.',
            ])->withInput($request->except(['current_password', 'password', 'password_confirmation']));
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()
            ->route('admin.account.edit')
            ->with([
                'status' => 'Your admin account has been updated successfully.',
                'status_type' => 'success',
                'status_title' => 'Account updated',
            ]);
    }
}
