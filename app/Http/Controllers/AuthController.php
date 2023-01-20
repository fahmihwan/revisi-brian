<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function list_account()
    {
        return view('auth.index', [
            'users' => User::all()
        ]);
    }
    public function register()
    {
        return view('auth.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
        ]);

        User::create([
            'nama' => $validated['name'],
            'username' => $validated['username'],
            'password' => Hash::make(($validated['password'])),
            'role' => $validated['role'],
        ]);

        return redirect('setting/account/list-account');
    }

    public function destroy($id)
    {

        User::where('id', $id)->delete();

        return redirect('setting/account/list-account');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function demo_create()
    {
        return view('welcome');
    }
}
