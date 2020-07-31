<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
      // If the user created a book as guess, asign it to the user.
      if (session('idBook')) {
        if (session('user_uid')) {
          // Move the book content to the user logged
          moveUserContent(session('user_uid'), $user->uid);
          $book = \App\Book::findOrFail(session('idBook'));
          // Move content from the folder of the guess uid to the folder of the user uid
          $book->updateBookOwner($user);
          session()->forget('idBook');
        }
      }

      return redirect()->route('dashboard');
    }
}
