<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Validation\ValidationException;
use Illuminate\Support\MessageBag;
use App\Auth\aMember;
use App\User;
use Auth;

class AuthenticationController extends Controller
{
    public function showLogin()
    {
      return view('auth.login');
    }

    public function login(Request $request)
    {
      // Ask for amember user with this credentials
      $aMemberUser = aMember::login($request->input('email'), $request->input('password'));
      if (!isset($aMemberUser['ok']) || !$aMemberUser['ok']) {
        // Not exist, redirect to login with an error.
        $errors = new MessageBag(['password' => ['Email and/or password invalid.']]);

        return redirect()->route('login.form')->withErrors($errors)->withInput($request->except('password'));
      }

      // Check if user exists locally.
      $user = User::where( 'amember_id', '=', $aMemberUser['user_id'])
        ->where( 'email', '=', $request->input('email'))
        ->first();

      // If not exists locally --> Create the user.
      if ( $user == null ) {
        $newUser = new User();

        $newUser->name = $aMemberUser['name'];
        $newUser->email = $aMemberUser['email'];
        $newUser->password = '';
        $newUser->amember_id = $aMemberUser['user_id'];
        $newUser->active = 1;

        $newUser->save();

        $user = $newUser;
      }

      // Update suscription info
      list($subscriptionType, $subscribedUntil) = aMember::getHigherSubscription($aMemberUser['subscriptions']);
      if (!is_null($subscriptionType)) {
        $user->subscription_type = $subscriptionType;
        $user->subscribed_until = $subscribedUntil;
        $user->save();
      }

      // Logged the user locally
      Auth::login($user);

      // Redirect to the dashboard
      // FIXME: Check if user has a book pending to associate the book and show the screen
      return redirect()->route('dashboard');
    }

    public function logout() {
      Auth::logout();

      return redirect('/');
    }
}
