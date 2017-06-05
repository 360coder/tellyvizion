<?php
if(!function_exists("GOOGLE_GET_USER_YOUTUBE")){
    function GOOGLE_GET_USER_YOUTUBE($code = ""){
        try {
            $YT = Youtube();
            $YT->authenticate($code);
            $oauth2 = new Google_Service_Oauth2($YT);
            $access_token = $YT->getAccessToken();
            $YT->setAccessToken($access_token);
            $Info = $oauth2->userinfo->get();
            return array(
                "first_name"     => $Info->givenName,
                "last_name"     => $Info->familyName,
                "email"        => $Info->email,
                "yt_id"        => $Info->id,
                "profile_pic"  => $Info->picture,
                "access_token" => $access_token,
                "access_token_at" => NOW,
                "account_status" => 1,
                "user_id"       => Auth::user()->id
            );
        } catch (Exception $e) {
            return array();
        }
    }
}

if(!function_exists("YOUTUBE_GET_LIST_CHANNEL")){
    function YOUTUBE_GET_LIST_CHANNEL($access_token = ""){
        try {
            $YT = YTService($access_token);
            $channels = $YT->channels->listChannels("snippet,id,statistics", array(
                "mine" => true
            ));
            $result = array();
            if(!empty($channels)){
                foreach ($channels as $channel) {
                    $result[] = array(
                        'id'    => $channel->id,
                        'title' => $channel->snippet->title,
                        'description' => $channel->snippet->description,
                        'thumbnail' =>  $channel->snippet->thumbnails->default->url,
                        'publishedAt' => $channel->snippet->publishedAt,
                        'viewCount' => $channel->statistics->viewCount,
                        'commentCount' => $channel->statistics->commentCount,
                        'subscriberCount' => $channel->statistics->subscriberCount,
                        'videoCount' => $channel->statistics->videoCount
                    );
                }
            }
            
            return $result;
        } catch (Exception $e) {
            return array();
        }
    }
}

function search($keyword = "", $channelId = "", $page = ""){
    $youtube = YoutubeC();
    $params = array(
        'q'             => $keyword,
        'type'          => 'video',
        'part'          => 'id, snippet',
        'maxResults'    => 50
    );

    if($channelId != ""){
        $params['channelId'] = $channelId;
    }

    $search = $youtube->searchAdvanced($params, true);

    $nextToken      = "";
    $prevToken      = "";
    $totalResults   = "";
    $resultsPerPage = "";

    if($page != ""){
        $search = $youtube->paginateResults($params, $page);
    }

    if (isset($search['info']['nextPageToken'])) {
        $nextToken = $search['info']['nextPageToken'];
    }

    if (isset($search['info']['nextPageToken'])) {
        $prevToken = $search['info']['prevPageToken'];
    }

    if (isset($search['info']['totalResults'])) {
        $totalResults = $search['info']['totalResults'];
    }

    if (isset($search['info']['resultsPerPage'])) {
        $resultsPerPage = $search['info']['resultsPerPage'];
    }
    
    $ids = array();
    if(!empty($search) && isset($search['results']) && !empty($search['results'])){
        foreach ($search['results'] as $key => $row) {
            $ids[] = $row->id->videoId;
        }
    }

    if(!empty($ids)){
        $search = $youtube->getVideosInfo($ids);
        $results = array(
            'data'           => $search,
            'nextToken'      => $nextToken,
            'prevToken'      =>  $prevToken,
            'resultsPerPage' =>  $resultsPerPage,
            'totalResults'   =>  $totalResults
        );
        return $results;
    }else{
        return false;
    }
    
}

function getCategory($key){
    $data = array(
        "1" => "Film & Animation",
        "2" => "Autos & Vehicles",
        "10" => "Music",
        "15" => "Pets & Animals",
        "17" => "Sports",
        "18" => "Short Movies",
        "19" => "Travel & Events",
        "20" => "Gaming",
        "21" => "Videoblogging",
        "22" => "People & Blogs",
        "23" => "Comedy",
        "24" => "Entertainment",
        "25" => "News & Politics",
        "26" => "Howto & Style",
        "27" => "Education",
        "28" => "Science & Technology",
        "29" => "Nonprofits & Activism",
        "30" => "Movies",
        "31" => "Anime/Animation",
        "32" => "Action/Adventure",
        "33" => "Classics",
        "34" => "Comedy",
        "35" => "Documentary",
        "36" => "Drama",
        "37" => "Family",
        "38" => "Foreign",
        "39" => "Horror",
        "40" => "Sci-Fi/Fantasy",
        "41" => "Thriller",
        "42" => "Shorts",
        "43" => "Shows",
        "44" => "Trailers"
    );

    if(!empty($data[$key])){
        return $data[$key];
    }else{
        return $key;
    }
}

function covtime($youtube_time){
    preg_match_all('/(\d+)/',$youtube_time,$parts);

    // Put in zeros if we have less than 3 numbers.
    if (count($parts[0]) == 1) {
        array_unshift($parts[0], "0", "0");
    } elseif (count($parts[0]) == 2) {
        array_unshift($parts[0], "0");
    }

    $sec_init = $parts[0][2];
    $seconds = $sec_init%60;
    $seconds_overflow = floor($sec_init/60);

    $min_init = $parts[0][1] + $seconds_overflow;
    $minutes = ($min_init)%60;
    $minutes_overflow = floor(($min_init)/60);

    $hours = $parts[0][0] + $minutes_overflow;

    if($hours != 0)
        return $hours.':'.$minutes.':'.$seconds;
    else
        return $minutes.':'.$seconds;
}


if(!function_exists("CountYT")){
    function CountYT($channel, $metrics){
        $channelId="channel==".$channel;
        try{
            $from = date('Y-m-d', strtotime(NOW.' -28 day'));
            $to = date('Y-m-d', strtotime(NOW));
            /*if(Input::post('daterange'))
            {
                $range = explode('-', Input::post('daterange'));
                $from  = date('Y-m-d', strtotime($range[0]));
                $to    = date('Y-m-d', strtotime($range[1]));
            }*/

           if(Input::get('daterange'))
            {
                $range = explode('-', Input::get('daterange'));
                $from  = date('Y-m-d', strtotime($range[0]));
                $to    = date('Y-m-d', strtotime($range[1]));
            }

            try{
                $service = YTAnalyticsService(session("access_token"));
                $data = $service->reports->query($channelId, $from, $to, $metrics); 
            } catch (Google_Service_Exception $e) {
                return false;
            }

            if (!empty($data)){
                if(stripos($metrics, ",") !== false){
                    return $data->rows[0];
                }else{
                    return $data->rows[0][0];
                }
            }else{
                return false;
            }
        } catch (Google_Service_Exception $e) {
            return false;
        }
    }
}

if(!function_exists("chart")){
    function chart($response = array()){
        $response = (object)$response;
        $channel    = (!empty($response->channel))?$response->channel:'';
        $metrics    = (!empty($response->metrics))?$response->metrics:'';
        $dimensions = (!empty($response->dimensions))?$response->dimensions:'day';
        $limit      = (isset($response->limit))?$response->limit:0;
        $sort       = (isset($response->sort))?$response->sort:'day';
        $filters    = (isset($response->filters))?$response->filters:'';

        $channelId  = 'channel=='.$channel;

        $from = date('Y-m-d', strtotime(NOW.' -28 day'));
        $to = date('Y-m-d', strtotime(NOW));
        

        if(Input::get('daterange'))
        {
            $range = explode('-', Input::get('daterange'));
            $from  = date('Y-m-d', strtotime($range[0]));
            $to    = date('Y-m-d', strtotime($range[1]));
        }

        $array = array('dimensions' => str_replace("-pie", "", $dimensions));

        if($limit != 0)
            $array['max-results'] = $limit;

        if($sort != '')
            $array['sort'] = $sort;

        if($filters != '')
            $array['filters'] = $filters;

        try{
            $service = YTAnalyticsService(session("access_token"));
            $data = $service->reports->query($channelId, $from, $to, $metrics, $array); 
        } catch (Google_Service_Exception $e) {
            return false;
        }

        $yt_dash_statsdata="";
        $dataRow = $data->getRows();
        if(!empty($dataRow)){
            $result = $data->getRows();
            foreach ($dataRow as $row){
                switch ($dimensions) {
                    case 'country':
                        $yt_dash_statsdata.="{'code' : '".$row[0]."', 'name' : '".nameCountry($row[0])."', 'value' : ".$row[1]."},";
                        break;
                    case 'country-pie':
                        $yt_dash_statsdata.="['".nameCountry($row[0])."',".$row[1]."],";
                        break;
                    case 'gender':
                        $yt_dash_statsdata.="['".ucfirst($row[0])."',".$row[1]."],";
                        break;
                    case 'ageGroup':
                        $text = str_replace("age", "age ", $row[0]);
                        $yt_dash_statsdata.="['".ucfirst($text)."',".$row[1]."],";
                        break;
                    case 'operatingSystem':
                        $yt_dash_statsdata.="['".ucfirst(strtolower($row[0]))."',".$row[1]."],";
                        break;
                    case 'deviceType':
                        $yt_dash_statsdata.="['".ucfirst(strtolower($row[0]))."',".$row[1]."],";
                        break;
                    default:
                        $year  = date("Y", strtotime($row[0]));
                        $month = date("m", strtotime($row[0])) - 1;
                        $day   = date("d", strtotime($row[0]));
                        $yt_dash_statsdata.="[Date.UTC(".$year.",".$month.",".$day.",0,0,0),".$row[1]."],";
                        break;
                }
            }
        }else{
            $yt_dash_statsdata.="['0',0],";
        }

        return substr($yt_dash_statsdata, 0, -1);
    }
}

if(!function_exists("YT_Post")){
    function YT_Post($data){
        $response = array();
        
        switch ($data->type) {
            case 'comment':
                $response = youtube_comment($data->access_token, $data->group_id, $data->message);
                if($response){
                    $response = array(
                        "txt" => l('Comment successfully'),
                        "st"  => "success"
                    );
                }else{
                    $response = array(
                        "txt" => l('Comment failure'),
                        "st"  => "error"
                    );
                }
                break;
        }
        return $response;
    }
}

function youtube_comment($access_token, $videoId, $text_comment){
    try{
        $youtube = YTService($access_token);
        $commentSnippet = new Google_Service_YouTube_CommentSnippet();
        $commentSnippet->setTextOriginal($text_comment);

        $topLevelComment = new Google_Service_YouTube_Comment();
        $topLevelComment->setSnippet($commentSnippet);

        $commentThreadSnippet = new Google_Service_YouTube_CommentThreadSnippet();
        //$commentThreadSnippet->setChannelId($CHANNEL_ID);
        $commentThreadSnippet->setTopLevelComment($topLevelComment);

        $commentThread = new Google_Service_YouTube_CommentThread();
        $commentThread->setSnippet($commentThreadSnippet);

        # Insert video comment
        $commentThreadSnippet->setVideoId($videoId);
        // Call the YouTube Data API's commentThreads.insert method to create a comment.
        $videoCommentInsertResponse = $youtube->commentThreads->insert('snippet', $commentThread);
        return true;
    } catch (Google_Service_Exception $e) {
        return false;
    }
}

function youtube_bulk_upload($access_token, $text_comment){
    try{
        $list = getVideos($data->group_id);
        //pr($list['item'][2]['link'],1);
        $videoPath = "";
        require_once app_path().'/Libraries/Google/autoload.php';

        $client = new Google_Client();
        $client->setAccessType('offline');
        $client->setApplicationName('YouTube Analytics Dashboard');
        $client->setRedirectUri("http://localhost/project/youtube_analytics/index.php/youtube_accounts");
        
        $client->setClientId("1088992811074-98f4e7d22gebaodjfa94hfdimnmvk6cl.apps.googleusercontent.com");
        $client->setClientSecret("5LVHrM0xwLY2L_cbsC3qSHl6");
        $client->setDeveloperKey("AIzaSyDN6jrU8Fu9TWrB68V7jN20v2QuTLjsRF4");

        $client->setScopes(array('https://www.googleapis.com/auth/youtube.upload', 'https://www.googleapis.com/auth/yt-analytics.readonly','https://www.googleapis.com/auth/yt-analytics-monetary.readonly',"https://www.googleapis.com/auth/youtube", "https://www.googleapis.com/auth/youtube.readonly", "https://www.googleapis.com/auth/youtubepartner", 'https://www.googleapis.com/auth/youtubepartner-content-owner-readonly', 'https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/youtubepartner-channel-audit', 'https://www.googleapis.com/auth/youtube.force-ssl'));
        
        $client = Youtube();
        $youtube = new Google_Service_YouTube($client);
        $client->setAccessToken('{}');

        // REPLACE this value with the path to the file you are uploading.

        // Create a snippet with title, description, tags and category ID
        // Create an asset resource and set its snippet metadata and type.
        // This example sets the video's title, description, keyword tags, and
        // video category.
        $snippet = new Google_Service_YouTube_VideoSnippet();
        $snippet->setTitle("video_title");
        $snippet->setDescription("video_description");
        $snippet->setTags("video_tags");

        // Numeric video category. See
        // https://developers.google.com/youtube/v3/docs/videoCategories/list 
        $snippet->setCategoryId("22");

        // Set the video's status to "public". Valid statuses are "public",
        // "private" and "unlisted".
        $status = new Google_Service_YouTube_VideoStatus();
        $status->privacyStatus = "public";

        // Associate the snippet and status objects with a new video resource.
        $video = new Google_Service_YouTube_Video();
        $video->setSnippet($snippet);
        $video->setStatus($status);

        // Specify the size of each chunk of data, in bytes. Set a higher value for
        // reliable connection as fewer chunks lead to faster uploads. Set a lower
        // value for better recovery on less reliable connections.
        $chunkSizeBytes = 1 * 1024 * 1024;

        // Setting the defer flag to true tells the client to return a request which can be called
        // with ->execute(); instead of making the API call immediately.
        $client->setDefer(true);

        // Create a request for the API's videos.insert method to create and upload the video.
        $insertRequest = $youtube->videos->insert("status,snippet", $video);

        // Create a MediaFileUpload object for resumable uploads.
        $media = new Google_Http_MediaFileUpload(
            $client,
            $insertRequest,
            'video/*',
            null,
            true,
            $chunkSizeBytes
        );
        $media->setFileSize(get_size($videoPath));

        // Read the media file and upload it.
        $status = false;
        $handle = fopen($videoPath, "rb");
        while (!$status && !feof($handle)) {
          $chunk = fread($handle, $chunkSizeBytes);
          $status = $media->nextChunk($chunk);
        }
        fclose($handle);

        // If you want to make other calls after the file upload, set setDefer back to false
        $client->setDefer(false);

    } catch (Google_Service_Exception $e) {
        return false;
    }
}

if(!function_exists("YTAnalyticsService")){
    function YTAnalyticsService($access_token){
        $client = Youtube();
        $service = new Google_Service_YouTubeAnalytics($client);
        $client->setAccessToken($access_token);
        return $service;
    }
}

if(!function_exists("YTService")){
    function YTService($access_token){
        $client = Youtube();
        $service = new Google_Service_YouTube($client);
        $client->setAccessToken($access_token);
        return $service;
    }
}

if(!function_exists("YoutubeC")){
    function YoutubeC(){
        require_once app_path() . "/Libraries/Madcoda/YoutubeC.php";
        return new YoutubeC(array('key' => GOOGLE_API_KEY));
    }
}

if(!function_exists("Youtube")){
    function Youtube(){
        require_once app_path().'/Libraries/Google/autoload.php';

        $client = new Google_Client();
        $client->setApprovalPrompt('force');
        $client->setAccessType('offline');
        $client->setApplicationName('YouTube Analytics Dashboard');
        $client->setRedirectUri(url()."/social-accounts");
        
        $client->setClientId(GOOGLE_ID);
        $client->setClientSecret(GOOGLE_SECRET);
        $client->setDeveloperKey(GOOGLE_API_KEY);

        $client->setScopes(array('https://www.googleapis.com/auth/youtube.upload', 'https://www.googleapis.com/auth/yt-analytics.readonly','https://www.googleapis.com/auth/yt-analytics-monetary.readonly',"https://www.googleapis.com/auth/youtube", "https://www.googleapis.com/auth/youtube.readonly", "https://www.googleapis.com/auth/youtubepartner", 'https://www.googleapis.com/auth/youtubepartner-content-owner-readonly', 'https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/youtubepartner-channel-audit', 'https://www.googleapis.com/auth/youtube.force-ssl'));
        
        return $client;
    }
}

if(!function_exists("Youtube_video")){
    function Youtube_video(){
        require_once app_path().'/Libraries/Google/autoload.php';

        $client = new Google_Client();
        $client->setAccessType('offline');
        $client->setApplicationName('Tellyvizion');
        $client->setRedirectUri(url()."/post-to-youtube");
        
        $client->setClientId(GOOGLE_ID);
        $client->setClientSecret(GOOGLE_SECRET);
        $client->setDeveloperKey(GOOGLE_API_KEY);

        $client->setScopes(array('https://www.googleapis.com/auth/youtube.upload', 'https://www.googleapis.com/auth/yt-analytics.readonly','https://www.googleapis.com/auth/yt-analytics-monetary.readonly',"https://www.googleapis.com/auth/youtube", "https://www.googleapis.com/auth/youtube.readonly", "https://www.googleapis.com/auth/youtubepartner", 'https://www.googleapis.com/auth/youtubepartner-content-owner-readonly', 'https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/youtubepartner-channel-audit', 'https://www.googleapis.com/auth/youtube.force-ssl'));
        
        return $client;
    }
}

if(!function_exists("Youtube_Login")){
    function Youtube_Login(){
        $client  = Youtube();
        $authUrl = $client->createAuthUrl();
        return $authUrl;
    }
}


if(!function_exists("Check_Youtube_Link")){
    function Check_Youtube_Link($youtube_link){
        $my_id = $youtube_link;
        if( preg_match('/^https:\/\/w{3}?.youtube.com\//', $my_id) ){
            $url   = parse_url($my_id);
            $my_id = NULL;
            if( is_array($url) && count($url)>0 && isset($url['query']) && !empty($url['query']) ){
                $parts = explode('&',$url['query']);
                if( is_array($parts) && count($parts) > 0 ){
                    foreach( $parts as $p ){
                        $pattern = '/^v\=/';
                        if( preg_match($pattern, $p) ){
                            $my_id = preg_replace($pattern,'',$p);
                            break;
                        }
                    }
                }
                if( !$my_id ){
                    echo '<p>No video id passed in</p>';
                    exit;
                }
            }else{
                echo '<p>Invalid url</p>';
                exit;
            }
        }elseif( preg_match('/^https?:\/\/youtu.be/', $my_id) ) {
            $url   = parse_url($my_id);
            $my_id = NULL;
            $my_id = preg_replace('/^\//', '', $url['path']);
        }

        return $my_id;
    }
}

if(!function_exists("formatBytes")){
    function formatBytes($bytes, $precision = 2) { 
        $units = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'); 
        $bytes = max($bytes, 0); 
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
        $pow = min($pow, count($units) - 1); 
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . '' . $units[$pow]; 
    }
}

if(!function_exists("curlGet")){
    function curlGet($URL) {
        $ch = curl_init();
        $timeout = 3;
        curl_setopt( $ch , CURLOPT_URL , $URL );
        curl_setopt( $ch , CURLOPT_RETURNTRANSFER , 1 );
        curl_setopt( $ch , CURLOPT_CONNECTTIMEOUT , $timeout );
        /* if you want to force to ipv6, uncomment the following line */ 
        //curl_setopt( $ch , CURLOPT_IPRESOLVE , 'CURLOPT_IPRESOLVE_V6');
        $tmp = curl_exec( $ch );
        curl_close( $ch );
        return $tmp;
    }  
}

if(!function_exists("get_size")){
    function get_size($url) {
        global $config;
        $my_ch = curl_init();
        curl_setopt($my_ch, CURLOPT_URL,$url);
        curl_setopt($my_ch, CURLOPT_HEADER,         true);
        curl_setopt($my_ch, CURLOPT_NOBODY,         true);
        curl_setopt($my_ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($my_ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($my_ch, CURLOPT_TIMEOUT,        10);
        $r = curl_exec($my_ch);
         foreach(explode("\n", $r) as $header) {
            if(strpos($header, 'Content-Length:') === 0) {
                return trim(substr($header,16)); 
            }
         }
        return '';
    }
}

if(!function_exists("getImageVideo")){
    function getImageVideo($my_id){
        $thumbnail_url="http://i1.ytimg.com/vi/".$my_id."/default.jpg"; // make image link
        return $thumbnail_url;
    }
}

if (!function_exists('FBDownloadVideo')) {
    function FBDownloadVideo($url) {
        $useragent = 'Mozilla/5.0 (Linux; U; Android 2.3.3; de-de; HTC Desire Build/GRI40) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $source = curl_exec($ch);
        curl_close($ch);

        $download = explode('/video_redirect/?src=', $source);
        if(isset($download[1])){
            $download = explode('&amp', $download[1]);
            $download = rawurldecode($download[0]);
            return $download;
        }
        
        return "error";
    }
}
if (!function_exists('clean_string')) {
function clean_string($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
}
if(!function_exists("getVideos")){
    function getVideos($videoId){
        if(preg_match('/^https:\/\/w{3}?.facebook.com\//', $videoId)){
            $link = FBDownloadVideo($videoId);
            if($link=='error'){
                $json = array(
                    "st" => "error",
                    "message" => l("Can't find video")
                );
                return $json;
            }else{
                $size = formatBytes(get_size($link));
                $json['st'] = "success";
                $json['title'] = "";
                $json['thumbnail'] = "";
                $json['item'] = array();
                $json['item'][] = array(
                    "link" => $link,
                    "type" => "Video/Mp4",
                    "size" => $size
                );
            }
        }else{
            $videoId = Check_Youtube_Link($videoId);
            $json = array();
            $my_video_info = 'http://www.youtube.com/get_video_info?&video_id='. $videoId.'&asv=3&el=detailpage&hl=en_US'; //video details fix *1
            $my_video_info = curlGet($my_video_info);

            $thumbnail_url = $title = $url_encoded_fmt_stream_map = $type = $url = '';

            parse_str($my_video_info);
            if($status=='fail'){
                $json = array(
                    "st" => "error",
                    "message" => "Error in video ID"
                );
                return $json;
            }

            $my_title = $title;
            $cleanedtitle = clean_string($title);

            if(isset($url_encoded_fmt_stream_map)) {
                $my_formats_array = explode(',',$url_encoded_fmt_stream_map);
            } else {
                $json = array(
                    "st" => "error",
                    "message" => "No encoded format stream found. Here is what we got from YouTube: ".$my_video_info
                );
                return $json;
            }

            if (count($my_formats_array) == 0) {
                $json = array(
                    "st" => "error",
                    "message" => "No format stream map found - was the video id correct?"
                );
                return $json;
            }

            /* create an array of available download formats */
            $avail_formats[] = '';
            $i = 0;
            $ipbits = $ip = $itag = $sig = $quality = '';
            $expire = time(); 

            foreach($my_formats_array as $format) {
                parse_str($format);
                $avail_formats[$i]['itag'] = $itag;
                $avail_formats[$i]['quality'] = $quality;
                $type = explode(';',$type);
                $avail_formats[$i]['type'] = $type[0];
                $avail_formats[$i]['url'] = urldecode($url) . '&signature=' . $sig;
                parse_str(urldecode($url));
                $avail_formats[$i]['expires'] = date("G:i:s T", $expire);
                $avail_formats[$i]['ipbits'] = $ipbits;
                $avail_formats[$i]['ip'] = $ip;
                $i++;
            }

            $json['st'] = "success";
            $json['title'] = $cleanedtitle;
            $json['thumbnail'] = getImageVideo($videoId);
            $json['item'] = array();
            for ($i = 0; $i < count($avail_formats); $i++) {
                $directlink = explode('.googlevideo.com/',$avail_formats[$i]['url']);
                $directlink = 'http://redirector.googlevideo.com/' . $directlink[1] . '';
                $size       = formatBytes(get_size($avail_formats[$i]['url']));
                if($size != "0B"){
                    $json['item'][] = array(
                        "link" => $directlink . '&title='.$cleanedtitle,
                        "type" => $avail_formats[$i]['type'],
                        "quality" => $avail_formats[$i]['quality'],
                        "size" => $size
                    );
                }
            }
        }
        
        return $json;
    }
}
?>