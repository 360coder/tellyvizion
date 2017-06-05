<?php namespace HelloVideo\Http\Controllers;

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
		return view('home');
	}
	
/* 	public function slider_view(){
		
		$slider = DB::table('videos')->where('id', '=', 1)->where('sliders','=', 1)->get();
		echo "<pre>"; print_r($slider); die;
		return View::make('Theme::home',$slider);
	} */

}
