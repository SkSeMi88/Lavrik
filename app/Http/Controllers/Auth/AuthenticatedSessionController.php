<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
        // return("login page");
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {

        $credentials= $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // $this->ensureIsNotRateLimited();

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {

            throw ValidationException::withMessages([
                'email' => "Credntials are wrong!",
            ]);
        }
        
        $request->session()->regenerate();
        return redirect()->intended('/');

        // var_dump($data);
        // var_dump($request->only("email", "password"));
        
        // return("hi");
        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME);


    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
