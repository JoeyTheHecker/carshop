<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        // Check user role and redirect accordingly
        if (Auth::user()->role == 1) {
            return '/dashboard';  // Admin dashboard for role 1
        } else {
            return '/';  // Normal user dashboard for role 0
        }
    }

    // Override the attemptLogin method
    protected function attemptLogin(Request $request)
    {
        // Fetch the user by their credentials (typically email)
        $user = User::where('email', $request->email)->first();

        // Check if user exists and if customer_status is active (1)
        if ($user && $user->customer_status === 1) {
            // If customer_status is 1, allow login using parent method
            return $this->guard()->attempt(
                $this->credentials($request),
                $request->filled('remember')
            );
        }

        // If customer_status is not 1, deny login and return false
        return false;
    }

    // Override the sendFailedLoginResponse method
    protected function sendFailedLoginResponse(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && $user->customer_status === 0) {
            return redirect()->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => 'Your account is currently awaiting approval. Please keep an eye on your email for updates.',
                ]);
        }

        // If user doesn't exist or other failure, use the default error
        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => trans('auth.failed'),
            ]);
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
