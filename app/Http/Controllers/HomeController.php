<?php namespace App\Http\Controllers;

use App\Snippet;
use App\User;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $snippets = Snippet::all()->sortByDesc('created_at');
//		$snippet = Snippet::first();
//		dd($snippet->tags->toArray());
//        $snippet = new Snippet();
//        $snippets = $snippet->getTags();
//        dd($snippet);
//        dd($snippet->getTags());
        return view('home')->with(compact('snippets'));
	}

}
