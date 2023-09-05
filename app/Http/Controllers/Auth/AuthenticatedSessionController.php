<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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
        $request->authenticate();

        $id = Auth::user()->id;
        $profileData = User::find($id);
        $name = $profileData->name;

        $request->session()->regenerate();


        $notification = array(
            'message' => $name.' logged in Successfully',
            'alert-type' =>'success'
        );


        $url = '';
        if($request->user()->role === 'admin'){
            $url = 'admin/dashboard';
        } elseif($request->user()->role === 'agent'){
            $url = 'agent/dashboard';
        } elseif($request->user()->role === 'user'){
            $url = '/dashboard';
        }


        return redirect()->intended($url)->with($notification);
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