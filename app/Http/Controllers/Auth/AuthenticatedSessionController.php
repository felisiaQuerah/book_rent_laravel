<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        // ambil path sebelumnya / route sebelumnya
        $url = url()->previous();
        $path = parse_url($url, PHP_URL_PATH);
        //simpan ke session
        session(['url.intended' => $path]);

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // dd($request->all());

        //validate email, password
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);


        // dd(Hash::make($request->password));

        //cek apakah user ada
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            // return redirect()->intended(RouteServiceProvider::HOME);
            //kembali ke halaman sebelumnya
            //cek role
            if (Auth::user()->role == 'user') {
                return redirect()->intended(session('url.intended'));
            }  else {
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }


    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
