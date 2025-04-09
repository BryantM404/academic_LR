<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {  
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {      
        // Auth::logout();
        
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));


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



        // Coba logout dulu agar session lama terhapus
        // Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        // // Ambil data login dari request
        // $credentials = $request->only('username', 'password');

        // if (Auth::attempt($credentials)) {
        //     // Regenerasi session untuk memastikan user baru masuk
        //     $request->session()->regenerate(); 
            
        //     // Cek user yang login untuk debugging
        //     // dd(Auth::user());

        //     return redirect()->intended('/dashboard');
        // }

        // return back()->withErrors(['username' => 'username atau password salah.']);