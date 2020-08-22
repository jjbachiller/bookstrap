<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth']);
    }

    public function notActivatedAccount(Request $request)
    {
        return view('auth.active-pending');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        $page_title = 'Bookstrap Home';
        $page_description = 'All you need to create low content books';

        return view('pages.dashboard', compact('page_title', 'page_description'));

    }


}
