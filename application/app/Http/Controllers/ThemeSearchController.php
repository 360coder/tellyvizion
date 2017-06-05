<?php

use \Redirect as Redirect;
use HelloVideo\User as User;

class ThemeSearchController extends BaseController {

	public function __construct()
	{
		$this->middleware('secure');
	}

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	*/

	public function index()
	{
		$search_value = Input::get('value');

		if(empty($search_value)){
			return Redirect::to('/');
		}
		$videos = Video::where('active', '=', 1)->where('title', 'LIKE', '%'.$search_value.'%')->orderBy('created_at', 'desc')->get();
		$users = User::where('active', '=', 1)->where('name', 'LIKE', '%'.$search_value.'%')->orWhere('username', 'LIKE', '%'.$search_value.'%')->get();

		$tag_name = $search_value;

        $tag = Tag::where('name', '=', $search_value)->first();

        $tags = VideoTag::where('tag_id', '=', $tag->id)->get();

        $tag_array = array();
        foreach($tags as $key => $tag){
            array_push($tag_array, $tag->video_id);
        }

        $tagvideos = Video::where('active', '=', '1')->whereIn('id', $tag_array)->paginate($this->videos_per_page);

        //$videos= array_merge($videos, $tagvideos);
        //print_r($tagvideos);
		$data = array(
			'videos' => $videos,
			'tagvideos' => $tagvideos,
			'users' => $users,
			'search_value' => $search_value,
			'menu' => Menu::orderBy('order', 'ASC')->get(),
			'video_categories' => VideoCategory::all(),
			'post_categories' => PostCategory::all(),
			'theme_settings' => ThemeHelper::getThemeSettings(),
			'pages' => Page::all(),
			);

		return View::make('Theme::search-list', $data);
	}

}