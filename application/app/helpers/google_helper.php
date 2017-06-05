<?php
if(!function_exists("GOOGLE_GET_USER")){
    function GOOGLE_GET_USER($code = ""){
        $GA = GOOGLE_API();
        $GA->authenticate($code);
        $access_token = $GA->getAccessToken();
        $GA->setAccessToken($access_token);
        $oauth2 = new Google_Service_Oauth2($GA);
        return $oauth2->userinfo->get();
    }
}

if(!function_exists("GOOGLE_GET_LOGIN_URL")){
    function GOOGLE_GET_LOGIN_URL(){
        $GA = GOOGLE_API();
        return $GA->createAuthUrl();
    }
}

if(!function_exists("GOOGLE_API")){
    function GOOGLE_API(){
        require_once app_path().'/Libraries/Google/autoload.php';

        $client = new Google_Client();
        $client->setAccessType('offline');
        $client->setApplicationName('YouTube Analytics Dashboard');
        $client->setRedirectUri(PATH."openid/google");
        
        $client->setClientId(GOOGLE_ID);
        $client->setClientSecret(GOOGLE_SECRET);
        $client->setDeveloperKey(GOOGLE_API_KEY);

        $client->setScopes(array('https://www.googleapis.com/auth/youtube.upload', 'https://www.googleapis.com/auth/yt-analytics.readonly','https://www.googleapis.com/auth/yt-analytics-monetary.readonly',"https://www.googleapis.com/auth/youtube", "https://www.googleapis.com/auth/youtube.readonly", "https://www.googleapis.com/auth/youtubepartner", 'https://www.googleapis.com/auth/youtubepartner-content-owner-readonly', 'https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/youtubepartner-channel-audit', 'https://www.googleapis.com/auth/youtube.force-ssl'));
        
        return $client;
    }
}
?>