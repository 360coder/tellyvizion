<?php 
use HelloVideo\User as User;
use \Redirect as Redirect;
set_error_handler(null);
set_exception_handler(null);


define('DAILYMOTION_KEY', '2bdbdef761769b225eee');
define('DAILYMOTION_SECRET', 'b5d86ba4e79dc6ce9bf58a388fe51b3f434097ad');
define('DAILYMOTION_SCOPE', 'email, manage_videos');

define('NOW', date('Y-m-d H:i:s'));
include(app_path() . '/Libraries/thumbncrop.inc.php');
include(app_path() . '/Libraries/Facebook/autoload.php');
include_once(app_path() . '/helpers/facebook_helper.php');
include(app_path() . '/helpers/common_helper.php');
include(app_path() . '/helpers/analytics_helper.php');

include(app_path() . '/Libraries/Google/autoload.php');
include(app_path() . '/Libraries/Madcoda/YoutubeC.php');
include(app_path() . '/Libraries/Dailymotion/Dailymotion.php');
include(app_path() . '/helpers/google_helper.php');
class DailymotionController extends BaseController {

	public function __construct()
	{
		//$this->middleware('secure');
	}

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	*/

	public function index()
	{

		echo 'test';
	}

    // Dailymotion Start
    public function dailymotion_analytics(){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;
       return View::make('Theme::dailymotion-analytics', $data);
    }
     //Ajax
    public function dailymotion_ajax_viewchart(){
        $table_data =  DB::table('tbl_dailymotion')->where('user_id', '=', Auth::user()->id)->orderBy('date', 'asc')->first();
		//echo "<pre>"; print_r($table_data).'<br/>';
        //$viewresponse = file_get_contents("https://api.dailymotion.com/user/x1xp7ry/likes?fields=likes_total,views_total");
        if($table_data->username) {
            $viewresponse_url = "https://api.dailymotion.com/user/".$table_data->username."/videos?fields=created_time,views_last_month&limit=15&sort=recent";
        }
        $viewresponse = file_get_contents($viewresponse_url);
        $result = json_decode($viewresponse, TRUE);
        //echo "<pre>"; print_r($result).'<br/>';
		
        $views_total = $result['total'];
        //echo "<pre>"; print_r($views_total); "</pre>";
		
        //$created_time = $result['list'][1]['created_time'];
        
        /* echo "<pre>"; print_r($total_likes).'<br>';echo "</pre>";
        echo "<pre>"; print_r($views_total).'<br>'; echo "</pre>";
        echo "<pre>"; print_r($created_time).'<br>'; echo "</pre>"; */
        
        // UTC converted start
        
        /*  date_default_timezone_set('UTC');
        $utc = $created_time;
        echo "<pre>"; print_r($utc); "</pre>";
        $time = strtotime($utc);
        echo "<pre>"; print_r($time); "</pre>";
        $dateInLocal = date("Y-m-d H:i:s", $time);      
        echo "<pre>"; print_r($dateInLocal).'<br>'; echo "</pre>"; */
        
        // UTC converted start end
        
        //echo "<pre>"; print_r($viewresponse); "</pre>"; 
        //$result = DB::table('video_views')->select('views','date')->where('user_id', '=', Auth::user()->id)->get();
        $res = array();
        foreach ($result['list'] as $value) {
		
			
            // Use $field and $value here
            date_default_timezone_set('UTC');
            $utc = $value['created_time'];
			
           // $timezone = new DateTimeZone('UTC'); 
			$date = gmdate("Y,m,d", $utc);
		    //$date = date("Y,m,d", strtotime($utc));
		   //echo "<pre>"; print_r($date); "</pre>"; 
            //$date =  gmdate("Y,m,d,H,i,s", $utc);

            //echo "<pre>"; print_r($date).'<br>'; echo "</pre>";
            $res[].= '[Date.UTC('.$date.',0,0,0),'.$value['views_last_month'].']'; 
			//$res = rsort($res);
            //echo "<pre>"; print_r($res).'<br>'; echo "</pre>";
            //$res[].= '[Date.UTC(2017,03,05,0,0,0),1],[Date.UTC(2017,03,06,0,0,0),1],[Date.UTC(2017,03,07,0,0,0),1],[Date.UTC(2017,03,12,0,0,0),1],[Date.UTC(2017,03,13,0,0,0),1]'; 
            $count_views = $views_total; 
        }
            //echo "<pre>"; print_r($views_total).'<br>'; echo "</pre>";

        //$res = array_unique(r$res);
        $data_views = implode(",", $res);
        //echo "<pre>"; print_r($data_views); echo "</pre>"; 
      
        echo $original = '[Date.UTC(2017,03,05,0,0,0),10],[Date.UTC(2017,03,06,0,0,0),0],[Date.UTC(2017,03,07,0,0,0),1],[Date.UTC(2017,03,12,0,0,0),0],[Date.UTC(2017,03,13,0,0,0),2]';
        //echo $original = '[Date.UTC(2017,06,02,0,0,0),1],[Date.UTC(2017,06,01,0,0,0),2],[Date.UTC(2017,05,31,0,0,0),0],[Date.UTC(2017,05,31,0,0,0),0],[Date.UTC(2017,05,31,0,0,0),0],[Date.UTC(2017,05,31,0,0,0),0],[Date.UTC(2017,05,31,0,0,0),0],[Date.UTC(2017,05,31,0,0,0),0],[Date.UTC(2017,05,31,0,0,0),0],[Date.UTC(2017,04,21,0,0,0),15],[Date.UTC(2017,04,21,0,0,0),1],[Date.UTC(2017,04,21,0,0,0),1],[Date.UTC(2017,04,21,0,0,0),0],[Date.UTC(2017,04,20,0,0,0),2],[Date.UTC(2017,04,20,0,0,0),3]';
        //print_r('[Date.UTC(2017,03,05,0,0,0),1],[Date.UTC(2017,03,06,0,0,0),1],[Date.UTC(2017,03,07,0,0,0),1],[Date.UTC(2017,03,12,0,0,0),1],[Date.UTC(2017,03,13,0,0,0),1]');
        $data = array(
            //'data_views'   => $data_views,
            'data_views'   => $original,
            'count_views'  => $count_views,
        );
		//echo "<pre>"; print_r($data); echo "</pre>";
        return View::make('Theme::dailymotion/chart/views', $data);
    }

    public function dailymotion_ajax_revenuechart(){
        $viewresponse_url = "https://api.dailymotion.com/user/x1xp7ry/videos/";
        $viewresponse = file_get_contents($viewresponse_url);
        $result = json_decode($viewresponse, TRUE);
        $data = array(
            'data_views'   => chart(array('channel' => 'fun', 'metrics' => 'earnings')),
            'count_views'  => format_number(CountYT('fun', 'earnings')),
        );
        return View::make('Theme::dailymotion/chart/revenue', $data);
    }

    public function dailymotion_ajax_watchchart(){
		
        $data = array(
            'data_estimatedMinutesWatched' => chart(array('channel' => 'fun', 'metrics' => 'estimatedMinutesWatched')),
            'count_estimatedMinutesWatched'=> format_number(CountYT('fun', 'estimatedMinutesWatched')),
            'data_averageViewDuration'     => chart(array('channel' => 'fun', 'metrics' => 'averageViewDuration')),
            'count_averageViewDuration'    => format_number(CountYT('fun', 'averageViewDuration'))
        );
        return View::make('Theme::dailymotion/chart/watch', $data);
    }

    public function dailymotion_ajax_engagementchart(){
		$table_data =  DB::table('tbl_dailymotion')->where('user_id', '=', Auth::user()->id)->orderBy('date', 'asc')->first();
		//echo "<pre>"; print_r($table_data);
		
		if($table_data->username) {
            $viewresponse_url = "https://api.dailymotion.com/user/".$table_data->username."/videos?fields=created_time,views_last_month,likes_total&limit=70&sort=recent";
        }
        $viewresponse = file_get_contents($viewresponse_url);
        $results = json_decode($viewresponse, TRUE);
        //echo "<pre>"; print_r($results).'<br/>'; 
		
        $views_total = $results['total'];
        //echo "<pre>"; print_r($views_total).'<br/>';
		
		$res  = array();
		foreach($results['list'] as $engagementchart){
			
			
			 $date = date('Y-m-d');           
            $date_format = explode(" ", $engagementchart['created_time']);
            $date = $date_format[0];
            $date = date("Y,m,d", strtotime($date));
            //echo "<pre>"; print_r($date).'<br>'; echo "</pre>";           
            $res[].= '[Date.UTC('.$date.',0,0,0),'.$engagementchart['likes_total'].']';
            $count_likes+= count($engagementchart['likes_total']);
			echo "<pre>"; print_r($count_likes); die;
			
			
			/* date_default_timezone_set('UTC');
            $utc = $engagementchart['created_time'];
           // $timezone = new DateTimeZone('UTC'); 
			$date = gmdate("Y,m,d", $utc);
			//$date = strtotime( "y,m,d",$utc);
			echo "<pre>"; print_r($date).'<br/>';
            //echo "<pre>"; print_r($date).'<br>'; echo "</pre>";
            $res[].= '[Date.UTC('.$date.',0,0,0),'.$engagementchart['likes_total'].']'; 
			echo "<pre>"; print_r($res).'<br/>';
			
            $count_likes += count($engagementchart['likes_total']);
			echo "<pre>"; print_r($count_likes).'<br/>'; */
			
			
			
			//$likes_total = $engagementchart['likes_total'];        

			//$total_likes = $likes_total;
		}
		 $data_subscribersLost = implode(",", $res); 
		
		
		/*  $date = date('Y-m-d');
           // Result Favourites subscribe Start
           $favourite = DB::table('favorites')
                   ->select(DB::raw('SUM(`user_id`) As "userid"'), 'video_id', 'created_at')
                   ->where('user_id', '=', Auth::user()->id)
                   ->groupBy(DB::raw('DATE(created_at)'))
                   ->orderBy('created_at', 'asc')
                   ->get(); 
        $video = array();
        
        foreach ($favourite as $favs) {
            $video[] = $favs->video_id;           
            $count_subscribersLost+= count($favs->video_id);
           
        }
        $data_subscribersLost = implode(",", $video); */		
		
		
        $data = array(
            //'count_subscribersGained'          => format_number(CountYT('fun', 'subscribersGained')),
            //'count_subscribersLost'            => $count_subscribersLost,
            //'count_subscribersLost'            => format_number(CountYT('fun', 'subscribersLost')),
            'count_likes'                      => $count_likes,
            //'count_dislikes'                   => format_number(CountYT('fun', 'dislikes')),
            //'count_comments'                   => format_number(CountYT('fun', 'comments')),
            //'count_shares'                     => format_number(CountYT('fun', 'shares')),
            //'count_videosAddedToPlaylists'     => format_number(CountYT('fun', 'videosAddedToPlaylists')),
            //'count_videosRemovedFromPlaylists' => format_number(CountYT('fun', 'videosRemovedFromPlaylists')),
            //'data_subscribersGained'           => chart(array('channel' => 'fun', 'metrics' => 'subscribersGained')),
            'data_subscribersLost'             => $data_subscribersLost,
            //'data_subscribersLost'             => chart(array('channel' =>'fun', 'metrics' => 'subscribersLost')),
            //'data_likes'                       => chart(array('channel' => 'fun', 'metrics' => 'likes')),
            //'data_dislikes'                    => chart(array('channel' => 'fun', 'metrics' => 'dislikes')),
            //'data_comments'                    => chart(array('channel' => 'fun', 'metrics' => 'comments')),
            //'data_shares'                      => chart(array('channel' => 'fun', 'metrics' => 'shares')),
            //'data_videosAddedToPlaylists'      => chart(array('channel' => 'fun', 'metrics' => 'videosAddedToPlaylists')),
            //'data_videosRemovedFromPlaylists'  => chart(array('channel' => 'fun', 'metrics' => 'videosRemovedFromPlaylists'))
        );
        return View::make('Theme::dailymotion/chart/engagement', $data);
    }

    /*public function dailymotion_ajax_countrychart(){
        $data = array(
            'data_viewsTopCountry' => chart(array('channel' => 'fun', 'metrics' => 'views', 'dimensions' => 'country-pie', 'limit' => 10, 'sort' => '-views')),
            'data_viewsCountry'    => chart(array('channel' => 'fun', 'metrics' => 'views', 'dimensions' => 'country', 'limit' => 1000, 'sort' => '-views'))
        );
        return View::make('Theme::dailymotion/chart/country', $data);
    }

    public function dailymotion_ajax_genderchart(){
        $data = array(
            'data_viewsGender'   => chart(array('channel' => 'fun', 'metrics' => 'viewerPercentage', 'dimensions' => 'gender', 'limit' => 10, 'sort' => '')),
            'data_viewsAgeGroup' => chart(array('channel' => 'fun', 'metrics' => 'viewerPercentage', 'dimensions' => 'ageGroup', 'limit' => 10, 'sort' => ''))
            
        );
        return View::make('Theme::dailymotion/chart/gender', $data);
    }

    public function dailymotion_ajax_annotationschart(){
        $data = array(
            'count_annotationImpressions'         => format_number(CountYT('fun', 'annotationImpressions')),
            'count_annotationClickableImpressions'=> format_number(CountYT('fun', 'annotationClickableImpressions')),
            'count_annotationClosableImpressions' => format_number(CountYT('fun', 'annotationClosableImpressions')),
            'count_annotationClicks'              => format_number(CountYT('fun', 'annotationClicks')),
            'count_annotationCloses'              => format_number(CountYT('fun', 'annotationCloses')),
            'data_annotationImpressions'          => chart(array('channel' => 'fun', 'metrics' => 'annotationImpressions')),
            'data_annotationClickableImpressions' => chart(array('channel' => 'fun', 'metrics' => 'annotationClickableImpressions')),
            'data_annotationClicks'               => chart(array('channel' => 'fun', 'metrics' => 'annotationClicks')),
            'data_annotationClickThroughRate'     => chart(array('channel' => 'fun', 'metrics' => 'annotationClickThroughRate')),
            'data_annotationClosableImpressions'  => chart(array('channel' => 'fun', 'metrics' => 'annotationClosableImpressions')),
            'data_annotationCloses'               => chart(array('channel' => 'fun', 'metrics' => 'annotationCloses')),
            'data_annotationCloseRate'            => chart(array('channel' => 'fun', 'metrics' => 'annotationCloseRate'))
        );
        return View::make('Theme::dailymotion/chart/annotations', $data);
    }
    
    public function dailymotion_ajax_devicechart(){
        $data = array(
            'data_operatingSystem'   => chart(array('channel' => 'fun', 'metrics' => 'views', 'dimensions' => 'operatingSystem', 'sort' => '')),
            'data_deviceType'   => chart(array('channel' => 'fun', 'metrics' => 'views', 'dimensions' => 'deviceType', 'sort' => '')),
            
        );
        return View::make('Theme::dailymotion/chart/device', $data);
    }*/       
    

    public function post_to_dailymotion(){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;
        $check_data =  DB::table('tbl_dailymotion')->where('user_id', '=', Auth::user()->id)->first();
        
        if(empty($check_data)) {
            die('dailymotion_not_connected');
        }
        $result = DB::table('videos')->where('id', '=', Input::get('video_id'))->first();
        $result = DB::table('videos')->where('id', '=', '12')->first();
        $video_cat = DB::table('video_categories')->where('id', '=', $result->video_category_id)->first();
        $video_cat = DB::table('video_categories')->where('id', '=', '11')->first();

        $apiKey = DAILYMOTION_KEY;
        $apiSecret = DAILYMOTION_SECRET;
        $testUser = 'navi.sohal162@gmail.com';  
        $testPassword = 'navi@123';  
        $api = new Dailymotion();  
           $videoTitle = $result->title;
           if ($result->video) {
               //$testVideoFile = '/var/www/html/'.Config::get('site.uploads_dir').'videos/'.$result->video;
			   $testVideoFile = Config::get('site.s3_video') . 'videos/'.$result->video;
           }elseif ($result->embed_code) {
               $testVideoFile = $result->embed_code;
           }
           $videoCategory = $video_cat->name;
            $api->setGrantType(Dailymotion::GRANT_TYPE_AUTHORIZATION, $apiKey, $apiSecret, array('write','delete'));  
            //$url = $api->uploadFile($testVideoFile);  
            $result = $api->call('video.create', array('url' => $testVideoFile, 'title' => $videoTitle , 'channel' => $videoCategory , 'published' => true));  
            $videourl = 'http://www.dailymotion.com/video/'.$result['id'];  
        if($result)  
             {  
               ?><a href="<?php echo $videourl; ?>">Click Here </a> <?php echo " to see this video.";  
               echo "Video uploaded successfully on dailymotion.com";   
            }  
    }

   	public function dailymotion_analytics_deleteuser($id){
		
         if(Auth::guest()):
            return Redirect::to('/');
        endif;
		
        $POST = DB::table('tbl_dailymotion')->where('id', '=', $id)->get();
        if(!empty($POST)){
            DB::table('tbl_dailymotion')->where('id', '=', $id)->delete();
           return Redirect::to('/social-accounts')->with(array('note' => 'Successfully deleted dailymotion.', 'note_type' => 'success'));
        }
        print_r(json_encode($json));
    } 
	
	public function dailymotion_save_user() {
        $check_data =  DB::table('tbl_dailymotion')->where('user_id', '=', Auth::user()->id)->first();

        if(empty($check_data)) {
        $api = new Dailymotion();
        $apiKey = DAILYMOTION_KEY;
        $apiSecret = DAILYMOTION_SECRET;
        $setScopes= array(DAILYMOTION_SCOPE);
        // Tell the SDK what kind of authentication you'd like to use.
        // Because the SDK works with lazy authentication, no request is performed at this point.
        $api->setGrantType(Dailymotion::GRANT_TYPE_AUTHORIZATION, $apiKey, $apiSecret, $setScopes );
        try
        {
            //$api->logout();
            // The following line will actually try to authenticate before making the API call.
            // * The SDK takes care of retrying if the access token has expired.
            // * The SDK takes care of storing the access token itself using its `readSession()`
            //   and `storeSession()` methods that are made to be overridden in an extension
            //   of the class if you want a different storage than provided by default.
            print_r($api->getSession());
            //unset(($api->getSession()));
            //die();
                $result = $api->get(
                    '/me',
                    array('fields' => array('id', 'email', 'avatar_720_url', 'views_total'))
                );
                if($result) {
                $dailymotion_access_token = $api->getAccessToken();
                $data = array(
                        "user_id"          => Auth::user()->id,
                        "username"         => $result['id'],
                        "email"            => $result['email'],
                        "avatar"           => $result['avatar_720_url'],
                        "views_total"      => $result['views_total'],
                        "access_token"     => $dailymotion_access_token
                    );
                DB::table('tbl_dailymotion')->insert($data);
                return Redirect::to('/social-accounts')->with(array('note' => 'Successfully added dailymotion.', 'note_type' => 'success') );
               }
        }
        catch (DailymotionAuthRequiredException $e)
        {
            // If the SDK doesn't have any access token stored in memory, it tries to
            // redirect the user to the Dailymotion authorization page for authentication.
            header('Location: ' . $api->getAuthorizationUrl());
            die();
        }
        catch (DailymotionAuthRefusedException $e)
        {
            return Redirect::to('/social-accounts')->with(array('note' => 'Error in API', 'note_type' => 'error') );
            // Handle the situation when the user refused to authorize and came back here.
            // <YOUR CODE>
        }
        }else{
            return Redirect::to('/social-accounts')->with(array('note' => 'Dailymotion Account already added', 'note_type' => 'error') );
        }
        //die();
        //print_r($check_dailymotion);
        
	}

}