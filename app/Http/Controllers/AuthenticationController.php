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
      $page_title = 'Bookstrap Sign In';
      $page_description = 'Access to your Bookstrap account';
      $fullLayout = true;

      return view('pages.login', compact('page_title', 'page_description', 'fullLayout'));
    }

    public function login(Request $request)
    {
      // Ask for amember user with this credentials
      if (app()->isLocal()) {
        // For local development, don't ask the API for the user
        $aMemberUser = ['ok' => true, 'name' => 'Juan Bachiller', 'email' => 'jjbachiller@gmail.com', 'user_id' => 198, 'subscriptions' => [32 => '2021-08-19']];
      } else {
        $aMemberUser = aMember::login($request->input('email'), $request->input('password'));
      }

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
        $newUser->uid = uniqid();
        $newUser->active = 1;

        $newUser->save();

        $user = $newUser;
      }

      // Update suscription info
      list($subscriptionType, $subscribedUntil) = aMember::getHigherSubscription($aMemberUser['subscriptions']);

      $user->subscription_type = $subscriptionType;
      $user->subscribed_until = $subscribedUntil;
      $user->save();

      // Logged the user locally
      Auth::login($user);

      // If the user created a book as guest, assign it to the user.
      if (session('idBook')) {
        if (session('user_uid')) {
          // Move the book content to the user logged
          moveUserContent(session('user_uid'), $user->uid);
          $book = \App\Book::findOrFail(session('idBook'));
          // Move content from the folder of the guess uid to the folder of the user uid
          $book->updateBookOwner($user);
          session()->forget('idBook');
          session()->forget('user_uid');
        }
      }

      // Redirect to the dashboard
      return redirect()->route('dashboard');
    }

    public function logout() {
      Auth::logout();

      return redirect('/');
    }
}
