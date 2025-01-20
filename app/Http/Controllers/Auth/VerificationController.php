<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

     /**
     * Handle what happens after the user verifies their email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function verified(Request $request)
    {
        // Call your MailController to send the email
        MailController::sendPendingApproval(
            auth()->user()->email,
            [
                "firstname" => auth()->user()->firstname,
            ]
        );

        // Optionally, add a success message to the session
        session()->flash('message', 'Your email has been verified, and a pending approval notification has been sent.');

        // Redirect the user
        return redirect($this->redirectPath());
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
