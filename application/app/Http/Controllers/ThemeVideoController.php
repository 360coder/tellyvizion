<?php

use \Redirect as Redirect;
use \HelloVideo\User as User;
include app_path().'/Libraries/S3.php';
if (!defined('AKIAIEMFDP5ZOLXTFESA')) define('AKIAIEMFDP5ZOLXTFESA', 'CHANGE THIS');
if (!defined('+RsFdC6yIPdpxbNrhF/+AQkEjMNrIdoTGjGmw9m0')) define('+RsFdC6yIPdpxbNrhF/+AQkEjMNrIdoTGjGmw9m0', 'CHANGE THIS TOO');
$s3 = new S3('AKIAIEMFDP5ZOLXTFESA', '+RsFdC6yIPdpxbNrhF/+AQkEjMNrIdoTGjGmw9m0');
set_error_handler(null);
set_exception_handler(null);
class ThemeVideoController extends \BaseController {

    private $videos_per_page = 12;

    public function __construct()
    {
        $this->middleware('secure');
        $settings = Setting::first();
        $this->videos_per_page = $settings->videos_per_page;
    }

    /**
     * Display the specified video.
     *
     * @param  int  $id
     * @return Response
     */
    public function index($id)
    {
        try{
        $video  = Video::with('tags')->findOrFail($id);
        }catch(Exception $e){
            return Redirect::to('videos')->with(array('note' => 'Sorry, this video does not exist.', 'note_type' => 'error'));
        }
        //print_r($video);
        /*if ($video->first()->isEmpty()) {
        return Redirect::to('videos')->with(array('note' => 'Sorry, this video is no longer active.', 'note_type' => 'error'));
        }*/
        //$inner = DB::table('videos')->where('id', '<', $video->video_category_id)->first();
        //select max(id) from foo where id < 4
        //$id_check = DB::table('videos')->where('id', '=', $video->video_category_id)->first();
        $id_check = DB::table('videos')->where('id', DB::raw("(select max(`id`) from videos where id < $id+3)"))->pluck('id');
        $id_check2 = DB::table('videos')->where('id', DB::raw("(select max(`id`) from videos where id < $id+4)"))->pluck('id');
        $id_check3 = DB::table('videos')->where('id', DB::raw("(select max(`id`) from videos where id < $id+5)"))->pluck('id');
        $id_check4 = DB::table('videos')->where('id', DB::raw("(select max(`id`) from videos where id < $id+6)"))->pluck('id');
        $id_check5 = DB::table('videos')->where('id', DB::raw("(select max(`id`) from videos where id < $id+7)"))->pluck('id');
        $id_check6 = DB::table('videos')->where('id', DB::raw("(select max(`id`) from videos where id < $id+8)"))->pluck('id');
        $id_check7 = DB::table('videos')->where('id', DB::raw("(select max(`id`) from videos where id < $id+9)"))->pluck('id');
        //select * from foo where id = ()
        $video2 = Video::with('tags')->findOrFail($id_check2);
        $video3 = Video::with('tags')->findOrFail($id_check3);
        $video4 = Video::with('tags')->findOrFail($id_check4);
        $video5 = Video::with('tags')->findOrFail($id_check5);
        $video6 = Video::with('tags')->findOrFail($id_check6);
        $video7 = Video::with('tags')->findOrFail($id_check7);
        $user_details = User::where('id', '=', $video->user_id)->first();
        //print_r($user_details);
        $related = Video::where('active', '=', '1')->where('title', 'LIKE', '%'.$video->title.'%')->orwhere('title', 'LIKE', '%'.$video->details.'%')->orwhere('title', 'LIKE', '%'.$video->description.'%')->orwhere('details', 'LIKE', '%'.$video->details.'%')->orwhere('details', 'LIKE', '%'.$video->description.'%')->orderBy('created_at', 'DESC')->get();
        //$related = array_unique($related);
        //$cat_videos = Video::where('active', '=', '1')->where('video_category_id', '=', $video->video_category_id)->orderBy('created_at', 'DESC')->get();
        //$related = array_push//($related, $cat_videos);
       /* echo "<pre>";
        print_r($related);
        echo "</pre>";*/
        //Make sure video is active
        if((!Auth::guest() && Auth::user()->role == 'admin') || $video->active){

            $favorited = false;
            if(!Auth::guest()):
                $favorited = Favorite::where('user_id', '=', Auth::user()->id)->where('video_id', '=', $video->id)->first();
            endif;

            $view_increment = $this->handleViewCount($id);

            $likes = DB::table('like_dislike')->where('video_id', '=', $id)->where('like', '=', 1)->get();

            $recent = Session::get('recent');
              if (!is_array($recent)) {
                       $recent = array();
                    }
              $recent[] = $id;
              while (count($recent) > 20) {
                    array_shift($recent);
              }
              Session::put('recent', $recent);
            $data = array(
                'video' => $video,
                'video2' => $video2,
                'video3' => $video3,
                'video4' => $video4,
                'video5' => $video5,
                'video6' => $video6,
                'video7' => $video7,
                'related' => $related,
                'featured_videos' => Video::where('active', '=', '1')->where('video_category_id', '=', '27')->orderBy('created_at', 'DESC')->simplePaginate(9),
                'user_details' => $user_details,
                'menu' => Menu::orderBy('order', 'ASC')->get(),
                'view_increment' => $view_increment,
                'favorited' => $favorited,
                'video_categories' => VideoCategory::all(),
                'post_categories' => PostCategory::all(),
                'theme_settings' => ThemeHelper::getThemeSettings(),
                'pages' => Page::all(),
                'likes' => count($likes),
                );
            return View::make('Theme::video', $data);

        } else {
            return Redirect::to('videos')->with(array('note' => 'Sorry, this video is no longer active.', 'note_type' => 'error'));
        }
    }

    /*
     * Page That shows the latest video list
     *
     */
    public function videos()
    {   
        $page = Input::get('page');
        if( !empty($page) ){
            $page = Input::get('page');
        } else {
            $page = 1;
        }

        $data = array(
            'videos' => Video::where('active', '=', '1')->orderBy('created_at', 'DESC')->simplePaginate($this->videos_per_page),
            'page_title' => 'All Videos',
            'page_description' => 'Page ' . $page,
            'current_page' => $page,
            'menu' => Menu::orderBy('order', 'ASC')->get(),
            'pagination_url' => url().'/videos',
            'video_categories' => VideoCategory::all(),
            'post_categories' => PostCategory::all(),
            'theme_settings' => ThemeHelper::getThemeSettings(),
            'pages' => Page::all(),
            );
        return View::make('Theme::video-list', $data);
    }

    public function user_videos(){

        if(!Auth::guest()):
            
            $page = Input::get('page');

            if(empty($page)){
                $page = 1;
            }
            
            $favorites = Favorite::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->get();

            $favorite_array = array();
            foreach($favorites as $key => $fave){
                array_push($favorite_array, $fave->video_id);
            }

            $recent = Session::get('recent');

            $fav_videos = Video::where('active', '=', '1')->whereIn('id', $favorite_array)->get();
            $videos = Video::where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->paginate(12);
            $recent_videos = Video::where('active', '=', '1')->whereIn('id', $recent)->get();

            $data = array(
                    'videos' => $videos,
                    'recent_videos' => $recent_videos,
                    'fav_videos' => $fav_videos,
                    'page_title' => ucfirst(Auth::user()->username) . '\'s Videos',
                    'current_page' => $page,
                    'page_description' => 'Page ' . $page,
                    'menu' => Menu::orderBy('order', 'ASC')->get(),
                    'pagination_url' => url().'/my-videos',
                    'video_categories' => VideoCategory::all(),
            'post_categories' => PostCategory::all(),
            'theme_settings' => ThemeHelper::getThemeSettings(),
            'pages' => Page::all(),
                );
           /* print_r($videos);
            die();*/
            return View::make('Theme::user-videos', $data);

        else:

            return Redirect::to('videos');

        endif;
    }

    public function create_video()
    {
        
        if(!Auth::guest()):
             $data = array(
            'headline' => '<i class="fa fa-plus-circle"></i> New Video',
            'post_route' => URL::to('store_video'),
            'button_text' => 'Add New Video',
            'admin_user' => Auth::user()->id,
            'video_categories' => VideoCategory::all(),
            );            
            return View::make('Theme::add-video', $data);

        else:

            return Redirect::to('videos');

        endif;
    }
    
    public function video_upload($video){
        if(Input::get('video')) {
            $video = VideoHandler::uploadVideo($data['video'], 'videos');
            print_r($video);
            die;
        }
    }
    public function store_video($data)

    {

        $validator = Validator::make($data = Input::all(), [
            'title' => 'required',
            /*'video' => 'required',*/
            'image' => 'required',
        ]);

        //echo "<pre>";
        //print_r($validator);
        if ($validator->fails())
        {
            //return Redirect::back()->with(array('note' => 'Please make sure to activate your account in your email before logging in.', 'note_type' => 'error'));
            //Session::flash('message', 'This is a message!'); 
            return Redirect::back()->with(array('note' => 'Please make sure to fill all required fields.', 'note_type' => 'error'))->withErrors($validator)->withInput();
        }
        //die('aaaaaaaa');
        $image = (isset($data['image'])) ? $data['image'] : '';
        if(!empty($image)){
            $data['image'] = ImageHandler::uploadImage($data['image'], 'images');
            print_r($data['image']);
        } else {
            $data['image'] = 'placeholder.jpg';
        }

        $video = (isset($data['video'])) ? $data['video'] : '';
        if(!empty($video)){
            $data['video'] = VideoHandler::uploadVideo($data['video'], 'videos');
            //print_r($video);
        }

        $tags = $data['tags'];
        unset($data['tags']);
        
        if(empty($data['active'])){
            $data['active'] = 0;
        }

        if(empty($data['featured'])){
            $data['featured'] = 0;
        }else{
            $data['featured'] = 1;
        }

        if(isset($data['duration'])){
                //$str_time = $data
                $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $data['duration']);
                sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
                $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;
                $data['duration'] = $time_seconds;

        }

        $data['user_id'] = Auth::user()->id;
		
        $video = Video::create($data);
        $this->addUpdateVideoTags($video, $tags);
        /* $activities = array(
		'user_id' => $data['user_id'],
		'message' => "Your Video is under review"
		);

		DB::table('notification_activities')->insert($activities); */
		//Session::flash('message', 'The video is under review and be available within 24 hours!');
		//$request->session()->flash('message', 'The video is under review and be available within 24 hours!');

        return Redirect::to('my-videos')->with(array('note' => 'The video is under review and be available within 24 hours!', 'note_type' => 'success') );
    }
    private function addTag($tag){
        $tag_exists = Tag::where('name', '=', $tag)->first();
            
        if($tag_exists){ 
            return $tag_exists->id; 
        } else {
            $new_tag = new Tag;
            $new_tag->name = strtolower($tag);
            $new_tag->save();
            return $new_tag->id;
        }
    }
    private function attachTagToVideo($video, $tag_id){
        // Add New Tags to video
        if (!$video->tags->contains($tag_id)) {
            $video->tags()->attach($tag_id);
        }
    }
    private function addUpdateVideoTags($video, $tags){
        $tags = array_map('trim', explode(',', $tags));


        foreach($tags as $tag){
            
            $tag_id = $this->addTag($tag);
            $this->attachTagToVideo($video, $tag_id);
        }  

        // Remove any tags that were removed from video
        foreach($video->tags as $tag){
            if(!in_array($tag->name, $tags)){
                $this->detachTagFromVideo($video, $tag->id);
                if(!$this->isTagContainedInAnyVideos($tag->name)){
                    $tag->delete();
                }
            }
        }
    }
    public function destroy($id)
    {
        $video = Video::find($id);

        // Detach and delete any unused tags
        foreach($video->tags as $tag){
            $this->detachTagFromVideo($video, $tag->id);
            if(!$this->isTagContainedInAnyVideos($tag->name)){
                $tag->delete();
            }
        }

        $this->deleteVideoImages($video);

        Video::destroy($id);

        return Redirect::to('my-videos')->with(array('note' => 'Successfully Deleted Video', 'note_type' => 'success') );
    }

    private function detachTagFromVideo($video, $tag_id){
        // Detach the pivot table
        $video->tags()->detach($tag_id);
    }

    public function isTagContainedInAnyVideos($tag_name){
        // Check if a tag is associated with any videos
        $tag = Tag::where('name', '=', $tag_name)->first();
        return (!empty($tag) && $tag->videos->count() > 0) ? true : false;
    }

    private function deleteVideoImages($video){
        $ext = pathinfo($video->image, PATHINFO_EXTENSION);

        if(file_exists('.' . Config::get('site.uploads_dir') . 'images/' . $video->image) && $video->image != 'placeholder.jpg'){
            @unlink('.' . Config::get('site.uploads_dir') . 'images/' . $video->image);
        }

        if(file_exists('.' . Config::get('site.uploads_dir') . 'images/' . str_replace('.' . $ext, '-large.' . $ext, $video->image) )  && $video->image != 'placeholder.jpg'){
            @unlink('.' . Config::get('site.uploads_dir') . 'images/' . str_replace('.' . $ext, '-large.' . $ext, $video->image) );
        }

        if(file_exists('.' . Config::get('site.uploads_dir') . 'images/' . str_replace('.' . $ext, '-medium.' . $ext, $video->image) )  && $video->image != 'placeholder.jpg'){
            @unlink('.' . Config::get('site.uploads_dir') . 'images/' . str_replace('.' . $ext, '-medium.' . $ext, $video->image) );
        }

        if(file_exists('.' . Config::get('site.uploads_dir') . 'images/' . str_replace('.' . $ext, '-small.' . $ext, $video->image) )  && $video->image != 'placeholder.jpg'){
            @unlink('.' . Config::get('site.uploads_dir') . 'images/' . str_replace('.' . $ext, '-small.' . $ext, $video->image) );
        }
    }

    public function tag($tag)
    {   
        $page = Input::get('page');
        if( !empty($page) ){
            $page = Input::get('page');
        } else {
            $page = 1;
        }

        if(!isset($tag)){
            return Redirect::to('videos');
        }

        $tag_name = $tag;

        $tag = Tag::where('name', '=', $tag)->first();

        $tags = VideoTag::where('tag_id', '=', $tag->id)->get();

        $tag_array = array();
        foreach($tags as $key => $tag){
            array_push($tag_array, $tag->video_id);
        }

        $videos = Video::where('active', '=', '1')->whereIn('id', $tag_array)->paginate($this->videos_per_page);

        $data = array(
            'videos' => $videos,
            'current_page' => $page,
            'page_title' => 'Videos tagged with "' . $tag_name . '"',
            'page_description' => 'Page ' . $page,
            'menu' => Menu::orderBy('order', 'ASC')->get(),
            'pagination_url' => url().'/videos/tags/' . $tag_name,
            'video_categories' => VideoCategory::all(),
            'post_categories' => PostCategory::all(),
            'theme_settings' => ThemeHelper::getThemeSettings(),
            'pages' => Page::all(),
            );

        return View::make('Theme::video-list', $data);
    }

    public function category($category)
    {
        $page = Input::get('page');
        if( !empty($page) ){
            $page = Input::get('page');
        } else {
            $page = 1;
        }

        $cat = VideoCategory::where('slug', '=', $category)->first();

        $parent_cat = VideoCategory::where('parent_id', '=', $cat->id)->first();

        if(!empty($parent_cat->id)){
            $parent_cat2 = VideoCategory::where('parent_id', '=', $parent_cat->id)->first();
            if(!empty($parent_cat2->id)){
                $videos = Video::where('active', '=', '1')->where('video_category_id', '=', $cat->id)->orWhere('video_category_id', '=', $parent_cat->id)->orWhere('video_category_id', '=', $parent_cat2->id)->orderBy('created_at', 'DESC')->simplePaginate(9);
            } else {
                $videos = Video::where('active', '=', '1')->where('video_category_id', '=', $cat->id)->orWhere('video_category_id', '=', $parent_cat->id)->orderBy('created_at', 'DESC')->simplePaginate(9);
            }
        } else {
            $videos = Video::where('active', '=', '1')->where('video_category_id', '=', $cat->id)->orderBy('created_at', 'DESC')->simplePaginate(9);
        }


        $data = array(
            'videos' => $videos,
            'current_page' => $page,
            'category' => $cat,
            'page_title' => 'Videos - ' . $cat->name,
            'page_description' => 'Page ' . $page,
            'pagination_url' => url().'/videos/category/' . $category,
            'menu' => Menu::orderBy('order', 'ASC')->get(),
            'video_categories' => VideoCategory::all(),
            'post_categories' => PostCategory::all(),
            'theme_settings' => ThemeHelper::getThemeSettings(),
            'pages' => Page::all(),
        );

        return View::make('Theme::video-list', $data);
    }

    public function handleViewCount($id){
        // check if this key already exists in the view_media session
        $blank_array = array();
        if (! array_key_exists($id, Session::get('viewed_video', $blank_array) ) ) {
            
            try{
                // increment view
                $video = Video::find($id);
                $video->views = $video->views + 1;
                $video->save();

                $views = 1;
                $date = date('Y-m-d');
                $data = array('user_id' => Auth::user()->id, 'video_id' => $id, 'views' => $views );
                $check_date = DB::table('video_views')->select('date')->where('video_id', '=', $id)->where('date', '==', $date)->first();
                 $date_format = explode(" ", $value->date);
                $date = $date_format[0];
                $date = date("Y,m,d", strtotime($date));
                /*if ($date == date("Y-m-d")) {
                    DB::table('video_views')->where('video_id', $id)->update(array('views' => $value->views+1));
                }else{*/
                    DB::table('video_views')->insert($data);
                //}
                                
                // Add key to the view_media session
                Session::put('viewed_video.'.$id, time());
                return true;
            } catch (Exception $e){
                return false;
            }
        } else {
            return false;
        }
    }
    public function edit($id)
    {
        $video = Video::find($id);

        $data = array(
            'headline' => '<i class="fa fa-edit"></i> Edit Video',
            'video' => $video,
            'post_route' => URL::to('videos/update'),
            'button_text' => 'Update Video',
            'admin_user' => Auth::user(),
            'video_categories' => VideoCategory::all(),
            );

        return View::make('Theme::edit-video', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update()
    {
        $input = Input::all();
        $id = $input['id'];
        $video = Video::findOrFail($id);

        $validator = Validator::make($data = $input, Video::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $tags = $data['tags'];
        unset($data['tags']);
        $this->addUpdateVideoTags($video, $tags);

        if(isset($data['duration'])){
                //$str_time = $data
                $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $data['duration']);
                sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
                $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;
                $data['duration'] = $time_seconds;
        }

        if(empty($data['image'])){
            unset($data['image']);
        } else {
            $data['image'] = ImageHandler::uploadImage($data['image'], 'images');
        }

        /*if(empty($data['active'])){
            $data['active'] = 0;
        }*/

        if(empty($data['featured'])){
            $data['featured'] = 0;
        }else{
            $data['featured'] = 1;
        }

        $video->update($data);

        return Redirect::to('videos/edit' . '/' . $id)->with(array('note' => 'Successfully Updated Video!', 'note_type' => 'success') );
    }
	
	
	
	public function donatenow(){
		
        return View::make('Theme::donate-now');
	}
	
	

}