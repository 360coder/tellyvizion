<?php 
use HelloVideo\User as User;
use \Redirect as Redirect;
set_error_handler(null);
set_exception_handler(null);
set_time_limit(120);
include app_path().'/Libraries/S3.php';
include app_path().'/aws/vendor/autoload.php';
use Aws\S3\S3Client;
if (!defined('AKIAIEMFDP5ZOLXTFESA')) define('AKIAIEMFDP5ZOLXTFESA', 'CHANGE THIS');
if (!defined('+RsFdC6yIPdpxbNrhF/+AQkEjMNrIdoTGjGmw9m0')) define('+RsFdC6yIPdpxbNrhF/+AQkEjMNrIdoTGjGmw9m0', 'CHANGE THIS TOO');
$s3 = new S3('AKIAIEMFDP5ZOLXTFESA', '+RsFdC6yIPdpxbNrhF/+AQkEjMNrIdoTGjGmw9m0');
define("FACEBOOK_APP_ID", "969852379772212");
define("FACEBOOK_APP_SECRET", "17a7557ac09f7be7847ad82511f83a61");
define("FACEBOOK_PERMISSIONS", "read_insights,manage_pages,public_profile,email");
define("FACEBOOK_LOGIN_PERMISSIONS", "email");

define('GOOGLE_API_KEY', 'AIzaSyCGALrI4rjtgON1Ow9MwXWoGkGpa48VpUk');
define('GOOGLE_ID', '1097835388951-h78rhr5jtpcc8agpmfj9jjqd0vleolle.apps.googleusercontent.com');
define('GOOGLE_SECRET', 'WoDikiu1DPDYNccgbVTJ5qT6');


define('DAILYMOTION_KEY', '2bdbdef761769b225eee');
define('DAILYMOTION_SECRET', 'b5d86ba4e79dc6ce9bf58a388fe51b3f434097ad');
define('DAILYMOTION_SCOPE', 'email', 'manage_videos');

define('NOW', date('Y-m-d H:i:s'));
include_once(app_path() . '/authorizenet/vendor/autoload.php');
//include_once(app_path().'/../vendor/laravel/youtube/vendor/autoload.php');
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

include_once(app_path() . '/Libraries/thumbncrop.inc.php');
include_once(app_path() . '/Libraries/Facebook/autoload.php');
include_once(app_path() . '/helpers/facebook_helper.php');
include_once(app_path() . '/helpers/common_helper.php');
include_once(app_path() . '/helpers/analytics_helper.php');

include_once(app_path() . '/Libraries/Google/autoload.php');
include_once(app_path() . '/Libraries/Madcoda/YoutubeC.php');
include_once(app_path() . '/Libraries/Dailymotion/Dailymotion.php');
include_once(app_path() . '/helpers/google_helper.php');
class ThemeUserController extends BaseController{


    public function __construct()
    {
        $this->middleware('secure');
    }

    public static $rules = array(
        'username' => 'required|unique:users',
                            'email' => 'required|email|unique:users',
                            'password' => 'required|confirmed'
                        );

    public function index($username){
        $user = User::where('username', '=', $username)->first();

        $favorites = Favorite::where('user_id', '=', $user->id)->orderBy('created_at', 'desc')->get();

        $favorite_array = array();
        foreach($favorites as $key => $fave){
            array_push($favorite_array, $fave->video_id);
        }

        $videos = Video::where('active', '=', '1')->whereIn('id', $favorite_array)->take(9)->get();
        $user_videos = Video::where('active', '=', '1')->where('user_id', '=', $user->id)->get();
        $user_featured_videos = Video::where('active', '=', '1')->where('user_id', '=', $user->id)->where('featured', '=', 1)->get();
        $data = array(
                    'user' => $user,
                    'type' => 'profile',
                    'videos' => $videos,
                    'user_videos' => $user_videos,
                    'user_featured_videos' => $user_featured_videos,
                    'menu' => Menu::orderBy('order', 'ASC')->get(),
                    'video_categories' => VideoCategory::all(),
                    'post_categories' => PostCategory::all(),
                    'theme_settings' => ThemeHelper::getThemeSettings(),
                    'pages' => Page::all(),
        );
        return View::make('Theme::user', $data);
    }

    public function edit($username){
        if(!Auth::guest() && Auth::user()->username == $username){

            $user = User::where('username', '=', $username)->first();
            $data = array(
                                'user' => $user,
                                'post_route' => URL::to('user') . '/' . $user->username . '/update',
                                'type' => 'edit',
                                'menu' => Menu::orderBy('order', 'ASC')->get(),
                                'video_categories' => VideoCategory::all(),
                                'post_categories' => PostCategory::all(),
                                'theme_settings' => ThemeHelper::getThemeSettings(),
                                'pages' => Page::all(),
                );
            return View::make('Theme::user', $data);

        } else {
            return Redirect::to('/');
        }
    }

    public function update($username){
    
        $input = array_except(Input::all(), '_method');
        $input['username'] = str_replace('.', '-', $input['username']);

        $user = User::where('username', '=', $username)->first();

        if (Auth::user()->id == $user->id)
        {

            if(Input::hasFile('avatar')){
                $input['avatar'] = ImageHandler::uploadImage(Input::file('avatar'), 'avatars');
            } else { $input['avatar'] = $user->avatar; }

            if(Input::hasFile('cover')){
                $input['cover'] = ImageHandler::uploadImage(Input::file('cover'), 'covers');
                $input['cropped'] = '0';
            } else { $input['cover'] = $user->cover; }

            if($input['password'] == ''){
                $input['password'] = $user->password;
            } else{ $input['password'] = Hash::make($input['password']); }
            
            /* Shaan Code Start */
            


            if($input['bio'] == ''){
                $input['bio'] = $user->bio;
            } else{ $input['bio'] = Input::get('bio'); }


            if($input['facebook_link'] == ''){
                $input['facebook_link'] = $user->facebook_link;
            } else{ $input['facebook_link'] = Input::get('facebook_link'); }


            if($input['imdb_link'] == ''){
                $input['imdb_link'] = $user->imdb_link;
            } else{ $input['imdb_link'] = Input::get('imdb_link'); }


            if($input['backstage_link'] == ''){
                $input['backstage_link'] = $user->backstage_link;
            } else{ $input['backstage_link'] = Input::get('backstage_link'); }


            if($input['twitter_link'] == ''){
                $input['twitter_link'] = $user->twitter_link;
            } else{ $input['twitter_link'] = Input::get('twitter_link'); }

            if($input['artist_link'] == ''){
                $input['artist_link'] = $user->artist_link;
            } else{ $input['artist_link'] = Input::get('artist_link'); }


                
             if (Input::hasFile('resume')){
              $destinationPath = '/var/www/html/content/uploads/resume/';  // upload path
              
              $extension = Input::file('resume')->getClientOriginalExtension(); // getting image extension
              
              $fileName = rand(11111,99999).'.'.$extension; // renameing image
             
             Input::file('resume')->move($destinationPath, $fileName); // uploading file to given path
              $data = array(
                        'resume' => $fileName,                      
                    );
        //if(DB::table('users')->insert($data)){
        /*if( DB::table('users')->where('id', 1)->update($data)){
            return Redirect::to('user/' .$user->username . '/edit')->with(array('note' => 'Successfully Updated User Info', 'note_type' => 'success') );
        }else{
            return Redirect::to('user/' . Auth::user()->username . '/edit ')->with(array('note' => 'Sorry, there seems to have been an error when updating the user info', 'note_type' => 'error') );
        }*/
              // sending back with message
               //return Redirect::to('user/' .$user->username . '/edit')->with(array('note' => 'Successfully Updated User Info', 'note_type' => 'success') ); 
              //return Redirect::to('user');
            $input['resume'] = $fileName;
            }
            else {              
                $input['resume'] = $user->resume;
              //Session::flash('error', 'uploaded file is not valid');
               //return Redirect::to('user/' . Auth::user()->username . '/edit ')->with(array('note' => 'Sorry, there seems to have been an error when updating the user info', 'note_type' => 'error') );
            }
            
            
            /*if($input['gender'] == ''){
                $input['gender'] = $user->gender;
            } else{ $input['gender'] = Input::get('gender'); }
            
            
            if($input['age'] == ''){
                $input['age'] = $user->age;
            } else{ $input['age'] = Input::get('age'); }
            
            if($input['ethinicties'] == ''){
                $input['ethinicties'] = $user->ethinicties;
            } else{ $input['ethinicties'] = Input::get('ethinicties'); }
            
            if($input['height'] == ''){
                $input['height'] = $user->height;
            } else{ $input['height'] = Input::get('height'); }
            
            
            if($input['weight'] == ''){
                $input['weight'] = $user->weight;
            } else{ $input['weight'] = Input::get('weight'); }
            
            
            if($input['build'] == ''){
                $input['build'] = $user->build;
            } else{ $input['build'] = Input::get('build'); }
            
            if($input['hair'] == ''){
                $input['hair'] = $user->hair;
            } else{ $input['hair'] = Input::get('hair'); }
            
            if($input['eyes'] == ''){
                $input['eyes'] = $user->eyes;
            } else{ $input['eyes'] = Input::get('eyes'); }
            
            if($input['skills'] == ''){
                $input['skills'] = $user->skills;
            } else{ $input['skills'] = Input::get('skills'); }*/
            
            
            /* Shaan Code End */
            
            
            
            
           $input['name'] = Input::get('name');
           
           

            if($user->username != $input['username']){
                $username_exist = User::where('username', '=', $input['username'])->first();
                if($username_exist){
                    return Redirect::to('user/' .$user->username . '/edit')->with(array('note' => 'Sorry That Username is already in Use', 'note_type' => 'error') );
                }
            }

            $user->update($input);
            //echo "<pre>"; print_r($input); die;
            return Redirect::to('user/' .$user->username . '/edit')->with(array('note' => 'Successfully Updated User Info', 'note_type' => 'success') );
        }

        return Redirect::to('user/' . Auth::user()->username . '/edit ')->with(array('note' => 'Sorry, there seems to have been an error when updating the user info', 'note_type' => 'error') );

    }

    
    public function billing($username){
        if(Auth::guest()):
            return Redirect::to('/');
        endif;

        if(Auth::user()->username == $username){

        if(Auth::user()->role == 'admin' || Auth::user()->role == 'admin'){
            return Redirect::to('/user/' . $username . '/edit')->with(array('note' => 'This user type does not have billing info associated with their account.', 'note_type' => 'warning'));
        }

            $user = User::where('username', '=', $username)->first();

            $payment_settings = PaymentSetting::first();

            if($payment_settings->live_mode){
                User::setStripeKey( $payment_settings->live_secret_key );
            } else {
                User::setStripeKey( $payment_settings->test_secret_key );
            }

            $invoices = $user->invoices(); 

            $data = array(
                    'user' => $user,
                    'post_route' => URL::to('user') . '/' . $user->username . '/update',
                    'type' => 'billing',
                    'menu' => Menu::orderBy('order', 'ASC')->get(),
                    'video_categories' => VideoCategory::all(),
                    'post_categories' => PostCategory::all(),
                    'theme_settings' => ThemeHelper::getThemeSettings(),
                    'payment_settings' => $payment_settings,
                    'invoices' => $invoices,
                    'pages' => Page::all(),
                );
            return View::make('Theme::user', $data);

        } else {
            return Redirect::to('/');
        }
    }
    
    public function cancel_account($username){
        if(Auth::guest()):
            return Redirect::to('/');
        endif;

        if(Auth::user()->username == $username){

            $payment_settings = PaymentSetting::first();

            if($payment_settings->live_mode){
                User::setStripeKey( $payment_settings->live_secret_key );
            } else {
                User::setStripeKey( $payment_settings->test_secret_key );
            }

            $user = Auth::user();
            $user->subscription()->cancel();

            return Redirect::to('user/' . $username . '/billing')->with(array('note' => 'Your account has been cancelled.', 'note_type' => 'success') );
        }
    }

	
	/* Deactivate User Account Start
	*/
	
	public function deactivate_user(){
		if(Auth::guest()):
		return Redirect::to('/');
		endif;
        return View::make('Theme::deactivate_user');
	
	}
	
	
	public function deactivated_user($id){
		if(Auth::guest()):
		return Redirect::to('/');
		endif;

		//echo $id;
        $user_post = DB::table('users')->where('id', '=', $id)->first();
		//echo "<pre>"; print_r($user_post); 
		//echo "Hello Inside Deactivate User";
		//$user = Auth::user();
		//echo "<pre>"; print_r($user);
		  /* $data = array(
					//'user' => $user,
					'active' => 0
					); */
		DB::table('users')->where('id', '=', $id)->delete();
		DB::table('videos')->where('user_id', '=', $id)->delete();
		DB::table('tbl_facebook')->where('user_id', '=', $id)->delete();
		DB::table('tbl_dailymotion')->where('user_id', '=', $id)->delete();
		DB::table('social_yt_accounts')->where('user_id', '=', $id)->delete();
		DB::table('favorites')->where('user_id', '=', $id)->delete();
			//DB::table('users')->where('id', $id)->update($data);
		Auth::logout();
        return Redirect::to('/')->with(array('note' => 'Your account has been deactivated.', 'note_type' => 'success') );
		
		
		
	}
	
	
	 
	/* Deactivate User Account End */
	
	
	
	
	
    public function resume_account($username){
        if(Auth::guest()):
            return Redirect::to('/');
        endif;

        if(Auth::user()->username == $username){

            $payment_settings = PaymentSetting::first();

            if($payment_settings->live_mode){
                User::setStripeKey( $payment_settings->live_secret_key );
            } else {
                User::setStripeKey( $payment_settings->test_secret_key );
            }

            $user = Auth::user();
            $user->subscription('monthly')->resume();

            return Redirect::to('user/' . $username . '/billing')->with(array('note' => 'Welcome back, your account has been successfully re-activated.', 'note_type' => 'success') );
        }

    }

    public function update_cc_store($username){
        if(Auth::guest()):
            return Redirect::to('/');
        endif;

        $payment_settings = PaymentSetting::first();

        if($payment_settings->live_mode){
            User::setStripeKey( $payment_settings->live_secret_key );
        } else {
            User::setStripeKey( $payment_settings->test_secret_key );
        }

        $user = Auth::user();

        if(Auth::user()->username == $username){
          
            $token = Input::get('stripeToken');

            try{
           
                $user->subscription('monthly')->resume($token);
                return Redirect::to('user/' . $username . '/billing')->with(array('note' => 'Your Credit Card Info has been successfully updated.', 'note_type' => 'success'));

            } catch(Exception $e){
                return Redirect::to('/user/' . $username . '/update_cc')->with(array('note' => 'Sorry, there was an error with your card: ' . $e->getMessage(), 'note_type' => 'error'));
            }

        } else {
            return Redirect::to('user/' . $username);
        }

    }

    public function update_cc($username){
        if(Auth::guest()):
            return Redirect::to('/');
        endif;

        $payment_settings = PaymentSetting::first();

        if($payment_settings->live_mode){
            User::setStripeKey( $payment_settings->live_secret_key );
        } else {
            User::setStripeKey( $payment_settings->test_secret_key );
        }

        $user = Auth::user();

        if(Auth::user()->username == $username && $user->subscribed()){

            $data = array(
                'user' => $user,
                'post_route' => URL::to('user') . '/' . $user->username . '/update',
                'type' => 'update_credit_card',
                'menu' => Menu::orderBy('order', 'ASC')->get(),
                'payment_settings' => $payment_settings,
                'video_categories' => VideoCategory::all(),
                'post_categories' => PostCategory::all(),
                'theme_settings' => ThemeHelper::getThemeSettings(),
                'pages' => Page::all(),
                );

            return View::make('Theme::user', $data);
        } else {
            return Redirect::to('user/' . $username);
        }

    }

    public function renew($username){
        if(Auth::guest()):
            return Redirect::to('/');
        endif;

        $user = User::where('username', '=', $username)->first();

        $payment_settings = PaymentSetting::first();

        if($payment_settings->live_mode){
            User::setStripeKey( $payment_settings->live_secret_key );
        } else {
            User::setStripeKey( $payment_settings->test_secret_key );
        }

        if(Auth::user()->username == $username){

            $data = array(
                    'user' => $user,
                    'post_route' => URL::to('user') . '/' . $user->username . '/update',
                    'type' => 'renew_subscription',
                    'menu' => Menu::orderBy('order', 'ASC')->get(),
                    'payment_settings' => $payment_settings,
                    'video_categories' => VideoCategory::all(),
                    'post_categories' => PostCategory::all(),
                    'theme_settings' => ThemeHelper::getThemeSettings(),
                    'pages' => Page::all(),
                );

            return View::make('Theme::user', $data);
        } else {
            return Redirect::to('/');
        }
    }

    public function upgrade($username){
        if(Auth::guest()):
            return Redirect::to('/');
        endif;

        $user = User::where('username', '=', $username)->first();

        $payment_settings = PaymentSetting::first();

        if($payment_settings->live_mode){
            User::setStripeKey( $payment_settings->live_secret_key );
        } else {
            User::setStripeKey( $payment_settings->test_secret_key );
        }

        if(Auth::user()->username == $username){

            $data = array(
                    'user' => $user,
                    'post_route' => URL::to('user') . '/' . $user->username . '/update',
                    'type' => 'upgrade_subscription',
                    'menu' => Menu::orderBy('order', 'ASC')->get(),
                    'payment_settings' => $payment_settings,
                    'video_categories' => VideoCategory::all(),
                    'post_categories' => PostCategory::all(),
                    'theme_settings' => ThemeHelper::getThemeSettings(),
                    'pages' => Page::all(),
                );

            return View::make('Theme::user', $data);
        } else {
            return Redirect::to('/');
        }
    }

    public function upgrade_cc_store($username){
        if(Auth::guest()):
            return Redirect::to('/');
        endif;

        $payment_settings = PaymentSetting::first();

        if($payment_settings->live_mode){
            User::setStripeKey( $payment_settings->live_secret_key );
        } else {
            User::setStripeKey( $payment_settings->test_secret_key );
        }

        $user = User::find(Auth::user()->id);

        if(Auth::user()->username == $username){
          
            $token = Input::get('stripeToken');

            try{
           
                $user->subscription('monthly')->create($token, ['email' => $user->email]);
                $user->role = 'subscriber';
                $user->save();
                return Redirect::to('user/' . $username . '/billing')->with(array('note' => 'You have been successfully signed up for a subscriber membership!', 'note_type' => 'success'));

            } catch(Exception $e){
                return Redirect::to('/user/' . $username . '/upgrade_subscription')->with(array('note' => 'Sorry, there was an error with your card: ' . $e->getMessage(), 'note_type' => 'error'));
            }

        } else {
            return Redirect::to('user/' . $username);
        }

    }

    public function support_artist($username){
        if(Auth::guest()):
            return Redirect::to('/');
        endif;

        $user = User::where('username', '=', $username)->first();

        $payment_settings = PaymentSetting::first();

        if($payment_settings->live_mode){
            User::setStripeKey( $payment_settings->live_secret_key );
        } else {
            User::setStripeKey( $payment_settings->test_secret_key );
        }

        //if(Auth::user()->username == $username){
        if(Input::get('amount_actual')){

            $data = array(
                    'user' => $user,
                    'amount' => Input::get('amount_actual'),
                    'video_id' => Input::get('video_id'),
                    'post_route' => URL::to('user') . '/' . $user->username . '/paynow',
                    'type' => 'upgrade_subscription',
                    'menu' => Menu::orderBy('order', 'ASC')->get(),
                    'payment_settings' => $payment_settings,
                    'video_categories' => VideoCategory::all(),
                    'post_categories' => PostCategory::all(),
                    'theme_settings' => ThemeHelper::getThemeSettings(),
                    'pages' => Page::all(),
                );

            return View::make('Theme::support_artist', $data);
        } else {
            return Redirect::to('/');
        }
    }
    public function paynow($username){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;


        $user_details = $username;
        $user = User::find(Auth::user()->id);
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName("5EsfNdf649"); // Production
        $merchantAuthentication->setTransactionKey("6pSHQJ3jYk522M2K"); // Production
		
		//$merchantAuthentication->setName("8ycM2L2R"); // Demo
        //$merchantAuthentication->setTransactionKey("8sbd4a4MS3j68wT4"); // Demo
		
     if(Input::get('amount')) {
        $video_id = Input::get('video_id');
        $token = Input::get('stripeToken');
        $amount = Input::get('amount');

        $cc = Input::get('cc-number');
        $month = Input::get('cc-expiration-month');
        $year = Input::get('cc-expiration-year');
        $cvv = Input::get('cvv');

        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($cc);
        $creditCard->setExpirationDate($year."-".$month);
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create a transaction
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType( "authCaptureTransaction"); 
        $transactionRequestType->setAmount($amount);
        $transactionRequestType->setPayment($paymentOne);

        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setTransactionRequest( $transactionRequestType);
        $controller = new AnetController\CreateTransactionController($request);
        //$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
        $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);

        if ($response != null)
        {
            $tresponse = $response->getTransactionResponse();

            if (($tresponse != null) && ($tresponse->getResponseCode()=="1") )   
            {
                 //$receiver = User::find(Auth::user()->username);
				 //$receiver = Auth::user()->username;
				 //echo "<pre>"; print_r($receiver); die;
				$user_details = $user_details ? $user_details : $user->username;

                $data = array(
                'video_id' => $video_id,
                'token' => $tresponse->getTransId(),
                'amount' => $amount,
                //'receipt_email' => $user->email,
                'user_id' => $user->id,
                'payer_name' => $user->username,
                'receipt_name' => $user_details,
                );
				//echo "<pre>"; print_r($data); die;
                DB::table('payment_received_data')->insert($data);
                //echo "Charge Credit Card AUTH CODE : " . $tresponse->getAuthCode() . "\n";
				/* Mail::send('Theme::emails.verify', array('activation_code' => $user->activation_code, 'website_name' => $settings->website_name), function($message) {
            		$message->to(Input::get('email'), Input::get('username'))->subject('Verify your email address');
       			 }); */
                //echo "Charge Credit Card TRANS ID  : " . $tresponse->getTransId() . "\n";
                Mail::send('Theme::emails.support_artist', array('note' => 'success','user_details' => $user_details), function($message) {
                    $message->to(Auth::user()->email, Auth::user()->username )->subject('Thanks for the order');
                 });
                return Redirect::to('/video/'.$video_id)->with(array('note' => "Your Paymnent is Successful. <br> AUTH CODE : " . $tresponse->getAuthCode() . "<br> " . "TRANS ID  : " . $tresponse->getTransId() . " ", 'note_type' => 'success'));
            }
            else
            {
                return Redirect::to('/video/' . $video_id)->with(array('note' => 'Sorry, there was an error with your card: ', 'note_type' => 'error'));
            }
        }
        else
        {
           return Redirect::to('/video/' . $video_id)->with(array('note' => 'sorry, there was an error with your card: ', 'note_type' => 'error'));
        }
    }
    }
    
    
    public function dailymotion_analytics_deleteuser($id){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;
        
        $id = (int)Input::get('id');
        $POST = DB::table('tbl_dailymotion')->where('id', '=', $id)->get();
        if(!empty($POST)){
            DB::table('tbl_dailymotion')->where('id', '=', $id)->delete();
           return Redirect::to('/social-accounts')->with(array('note' => 'Successfully deleted dailymotion.', 'note_type' => 'success'));
        }
        print_r(json_encode($json));
    } 

    
    
    
    
    
    

    public function facebook($fb_id){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;
        

        $result = DB::table('tbl_facebook')->where('fid', '=', Request::segment(2))->where('user_id', '=', Auth::user()->id)->first();
        if(!empty($result)){
            session(['access_token' => $result->access_token]);
            session(['fid' => $result->fid]);
            //set_session('access_token', $result->access_token);
            //set_session('fid', $result->fid);
        }
        $reponse = @FB()->get('/'.$result->fid.'?fields=name,access_token,picture.type(large),cover,id,category,talking_about_count,likes', $result->access_token);
            $pages = @$reponse->getGraphPage()->asArray();
       // print_r($pages);
        $data = array(
                    'info'    => $pages,
                    'theme_settings' => ThemeHelper::getThemeSettings(),
                    'pages' => Page::all(),
        );
        return View::make('Theme::facebook', $data);
    }

        public function fb(){

        $result = DB::table('tbl_facebook')->where('user_id', '=', Auth::user()->id)->get();
        

        $keyword = '';
        if(Input::get('q')){
            //$keyword = " AND name LIKE '%".Input::('q')."%'";
            //$keyword = where('name', 'LIKE %', Input::('q').'%');
        }

        /*$result = $this->model->fetch('*', FACEBOOK_TB, "(user_id = '".Auth::user()->id."' OR  list_user like '%\"".Auth::user()->id."\"%') AND status = 1 {$keyword}", "name", "ASC");*/

        $result = DB::table('tbl_facebook')->where('user_id', '=', Auth::user()->id)->orWhere('list_user', 'like', '%\"".Auth::user()->id."\"%')->where('status', '=', '1')->get();
        if(!empty($result)){
            for ($i=0; $i < count($result); $i++) {
                $response = FB_PAGE($result[$i]->access_token, $result[$i]->fid."?fields=name,access_token,picture.type(large),cover,id,category,likes,talking_about_count"); 
                if(!empty($response)){
                    $response = (object)$response;
                    $result[$i]->data = (object)array(
                        'title'      => $response->name,
                        'banner'     => (isset($response->cover))?$response->cover["source"]:"",
                        'avatar'     => $response->picture["url"],
                        'category'   => $response->category,
                        'likes'      => $response->likes,
                        'talking_about_count' => $response->talking_about_count
                    );
                }else{
                    $result[$i]->data = (object)array(
                        'title'      => '',
                        'banner'     => '',
                        'avatar'     => '',
                        'category'   => '',
                        'likes'      => 0,
                        'talking_about_count' => 0
                    );
                }
            }
        }
        $data = array(
                    'result'    => $result,
                    'theme_settings' => ThemeHelper::getThemeSettings(),
                    //'pages' => Page::all(),
        );
        return View::make('Theme::fb', $data);
    }

    public function fb_pages(){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;
        $result = DB::table('tbl_facebook')->where('user_id', '=', Auth::user()->id)->get();
        $data = array(
            'result' => $result,
            'theme_settings' => ThemeHelper::getThemeSettings(),
            'pages' => Page::all(),
        );
        return View::make('Theme::fb-pages', $data);
    }

    public function add_fb(){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;
        $pages = array();

        if(Input::get("code")){
            FB_ACCESS_TOKEN();
            redirect("fb-pages/add");
        }
        if(session("fb_token")){
            $reponse = FB()->get('/me/accounts?fields=name,access_token,perms,picture.type(large),cover,id,category', session("fb_token"));
            $pages = @json_decode($reponse->getBody())->data;
        }
            
        $id   = (int)Input::get("id");
        $data = array(
            "result"   => DB::table('tbl_facebook')->where('id', '=', $id)->get(),
            "authUrl"  => FB_LOGIN(),
            "pages"    => $pages
        );
       return View::make('Theme::add_fb', $data);
    }
    public function postUpdate(){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;
        $id       = (int)Input::get('id');
        $page_id  = Input::get('pages');
    
        if(!empty($page_id)){
            if(session("fb_token")){
                $reponse = FB()->get('/me/accounts?fields=name,access_token,perms,picture.type(large),cover,id,category', session("fb_token"));
                $pages = @json_decode($reponse->getBody())->data;
                if(!empty($pages)){
                    foreach ($pages as $page) {
                        $check = DB::table('tbl_facebook')->where('fid', '=', $page->id)->where('user_id', '=', Auth::user()->id)->first();
                        if(in_array($page->id, $page_id) || !empty($check)){
                            $check_category = DB::table('tbl_facebook_category')->where('name_onwer', '=', $page->category)->where('user_id', '=', Auth::user()->id)->first();
                            $cid = 0;
                            if(empty($check_category)){
                                $category = array(
                                    'name'      => $page->category,
                                    'name_onwer'=> $page->category,
                                    'user_id'   => Auth::user()->id,
                                    'status'    => 1,
                                    'changed'   => NOW,
                                    'created'   => NOW
                                );
                                $cid = DB::table('tbl_facebook_category')->insertGetId($category);
                            }else{
                                $cid = $check_category->id;
                            }

                            $data = array(
                                "cid"          => $cid,
                                "fid"          => $page->id,
                                "name"         => $page->name,
                                "access_token" => $page->access_token,
                                "user_id"      => Auth::user()->id,
                                "changed"      => NOW,
                            );

                            if(empty($check)){
                                $data["created"] = NOW;
                                DB::table('tbl_facebook')->insert($data);
                            }else{
                                DB::table('tbl_facebook')->where('id', $check->id)->update($data);
                            }

                            //$request->session()->forget('fb_token');
                            Session::forget('fb_token');
                        }
                    }
                    $json= array(
                        'st'    => 'success',
                        'txt'   => 'Add page successfully'
                    );
                }else{
                    $json= array(
                        'st'    => 'error',
                        'txt'   => 'Token expires'
                    );
                }
            }else{
                $json= array(
                    'st'    => 'error',
                    'txt'   => 'Token expires'
                );
            }
        }else{
            $json= array(
                'st'    => 'error',
                'txt'   => 'Choose at least one page'
            );
        }

        print_r(json_encode($json));
    }

    public function permission(){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;
        $id   = (int)Input::get("id");
        $data = array(
            "result"   => DB::table('tbl_facebook')->where('id', '=', $id)->where('user_id', '=', Auth::user()->id)->first(),
        );
        
        return View::make('Theme::permission', $data);
    }

    public function postPermission(){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;

        $id          = (int)Input::get('id');
        $list_user   = json_encode(Input::get('list_user'));
    
        $data = array(
            "list_user" => $list_user,
            "changed"   => NOW,
        );
        DB::table('tbl_facebook')->where('id', $id)->update($data);
        $json= array(
            'st'    => 'success',
            'txt'   => 'Update permission successfully'
        );

        print_r(json_encode($json));
    }

    public function postDelete(){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;
        $id = (int)Input::get('id');
        $POST = DB::table('tbl_facebook')->where('id', '=', $id)->where('id', '!=', 1)->get();
        if(!empty($POST)){
            DB::table('tbl_facebook')->where('id', '=', $id)->delete();
            $json= array(
                'st'    => 'success',
                'txt'   => 'Delete successfully'
            );
        }else{
            $json= array(
                'st'    => 'error',
                'txt'   => 'Cannot delete item. Please check back.'
            );
        }
        print_r(json_encode($json));
    }

    public function postDeleteAll(){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;

        $ids =Input::get('id');
        if(!empty($ids)){
            foreach ($ids as $id) {
                $POST = DB::table('tbl_facebook')->where('id', '=', $id)->where('id', '!=', 1)->first();
                if(!empty($POST)){
                    DB::table('tbl_facebook')->where('id', '=', $id)->delete();
                }
            }
        }
        print_r(json_encode(array(
            'st'    => 'success',
            'txt'   => 'Successfully'
        )));
    }

    public function postStatusAll(){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;
        $ids    =Input::get('id');
        $status =(int)Input::get('status');
        if(!empty($ids)){
            foreach ($ids as $id) {
                $POST = DB::table('tbl_facebook')->where('id', '=', $id)->get();
                if(!empty($POST)){
                    if($id != 1){
                        DB::table('tbl_facebook')->where('id', $id)->update(array("status" => $status));
                    }
                }
            }
        }
        print_r(json_encode(array(
            'st'    => 'success',
            'txt'   => 'Successfully'
        )));
    }
        public function youtube_share($username){
        $user = User::where('username', '=', $username)->first();
        $data = array(
                    'user' => $user,
                    'type' => 'profile',
                    'menu' => Menu::orderBy('order', 'ASC')->get(),
                    'theme_settings' => ThemeHelper::getThemeSettings(),
                    'pages' => Page::all(),
        );
        return View::make('Theme::youtube_share', $data);
    }

    //Ajax 
   public function ajax_reachchart(){
        $data = array(
            'data_reach'              => FB_DATA(session('access_token'), session('fid'), "insights/page_impressions_unique/day"),
            'data_impressions'        => FB_DATA(session('access_token'), session('fid'), "insights/page_impressions/day"),
            'data_reach_paid'         => FB_DATA(session('access_token'), session('fid'), "insights/page_impressions_paid_unique/day"),
            'data_reach_organic'      => FB_DATA(session('access_token'), session('fid'), "insights/page_impressions_organic_unique/day"),
            'data_impressions_paid'   => FB_DATA(session('access_token'), session('fid'), "insights/page_impressions_paid/day"),
            'data_impressions_organic'=> FB_DATA(session('access_token'), session('fid'), "insights/page_impressions_organic/day")
        );
        return View::make('Theme::chart/rearch', $data);
    }

   public function ajax_postschart(){
        $data = array(
            'data_page_engaged_users'                            => FB_DATA(session('access_token'), session('fid'), "insights/page_engaged_users/day"),
            'data_page_consumptions'                             => FB_DATA(session('access_token'), session('fid'), "insights/page_consumptions/day"),
            'data_page_consumptions_unique'                      => FB_DATA(session('access_token'), session('fid'), "insights/page_consumptions_unique/day"),
            'data_negative'                                      => FB_DATA_NEGATIVE(session('access_token'), session('fid'), "insights/page_negative_feedback_by_type/day"),
            'data_page_positive_feedback_by_type'                => FB_DATA_POSITIVE_FEEDBACK(session('access_token'), session('fid'), "insights/page_positive_feedback_by_type_unique/day"),
            'data_page_consumptions_by_consumption_type_unique'  => FB_DATA_CLICK_BY_TYPE(session('access_token'), session('fid'), "insights/page_consumptions_by_consumption_type_unique/day"),
            'data_page_posts_impressions_frequency_distribution' => FB_DATA_FREQUENCY(session('access_token'), session('fid'), "insights/page_posts_impressions_frequency_distribution/day"),
            'data_posts_reach'              => FB_DATA(session('access_token'), session('fid'), "insights/page_posts_impressions_unique/day"),
            'data_posts_impressions'        => FB_DATA(session('access_token'), session('fid'), "insights/page_posts_impressions/day"),
            'data_posts_reach_paid'         => FB_DATA(session('access_token'), session('fid'), "insights/page_posts_impressions_paid_unique/day"),
            'data_posts_reach_organic'      => FB_DATA(session('access_token'), session('fid'), "insights/page_posts_impressions_organic_unique/day"),
            'data_posts_impressions_paid'   => FB_DATA(session('access_token'), session('fid'), "insights/page_posts_impressions_paid/day"),
            'data_posts_impressions_organic'=> FB_DATA(session('access_token'), session('fid'), "insights/page_posts_impressions_organic/day")
        );
        return View::make('Theme::chart/posts', $data);
    }

   public function ajax_tabchart(){
        $data = array(

            'data_tab'                                      => FB_DATA_TAB(session('access_token'), session('fid'), "insights/page_tab_views_login_top_unique/day"),
            'data_page_impressions_frequency_distribution'  => FB_DATA_FREQUENCY(session('access_token'), session('fid'), "insights/page_impressions_frequency_distribution/day"),
            'data_page_storytellers_by_story_type'          => FB_DATA_STRORYTELLERS(session('access_token'), session('fid'), "insights/page_storytellers_by_story_type/day"),
        );
        return View::make('Theme::chart/tab', $data);
    }

   public function ajax_fanschart(){
        $data = array(
            'data_fanshour' => FB_DATA_FANS_ONLINE(session('access_token'), session('fid'), "insights/page_fans_online/day"),
            'data_fansday'  => FB_DATA(session('access_token'), session('fid'), "insights/page_fans_online_per_day/day"),
        );
        return View::make('Theme::chart/fans', $data);
    }

   public function ajax_likeschart(){
        $data = array(
            'data_fans'        => FB_DATA(session('access_token'), session('fid'), "insights/page_fans/lifetime"),
            'data_fan_adds'    => FB_DATA(session('access_token'), session('fid'), "insights/page_fan_adds/day"),
            'data_fan_removes' => FB_DATA(session('access_token'), session('fid'), "insights/page_fan_removes/day")
        );
        return View::make('Theme::chart/likes', $data);
    }

   public function ajax_genderchart(){
        $data = array(
            'data_fans_gender_age'                       => FB_DATA_GENDER(session('access_token'), session('fid'), "insights/page_fans_gender_age/lifetime"),
            'data_fans_storytellers_gender_age'          => FB_DATA_GENDER(session('access_token'), session('fid'), "insights/page_storytellers_by_age_gender/day"),
            'data_page_impressions_by_age_gender_unique' => FB_DATA_GENDER(session('access_token'), session('fid'), "insights/page_impressions_by_age_gender_unique/day")
        );
        
        return View::make('Theme::chart/gender', $data);
    }

   public function ajax_countrychart(){
        $data = array(
            'data_page_fans_country'                  => FB_DATA_COUNTRY(session('access_token'), session('fid'), "insights/page_fans_country/lifetime"),
            'data_page_storytellers_by_country'       => FB_DATA_COUNTRY(session('access_token'), session('fid'), "insights/page_storytellers_by_country/day"),
            'data_page_impressions_by_country_unique' => FB_DATA_COUNTRY(session('access_token'), session('fid'), "insights/page_impressions_by_country_unique/day")
        );
        
        return View::make('Theme::chart/country', $data);
    }

   public function ajax_citychart(){
        $data = array(
            'data_page_fans_city'                  => FB_DATA_COUNTRY(session('access_token'), session('fid'), "insights/page_fans_city/lifetime"),
            'data_page_storytellers_by_city'       => FB_DATA_COUNTRY(session('access_token'), session('fid'), "insights/page_storytellers_by_city/day"),
            'data_page_impressions_by_city_unique' => FB_DATA_COUNTRY(session('access_token'), session('fid'), "insights/page_impressions_by_city_unique/day")
        );
        
        return View::make('Theme::chart/city', $data);
    }
    
   public function ajax_sourcechart(){
        $data = array(
            'data_page_views_external_referrals' => FB_DATA_REFERRERS(session('access_token'), session('fid'), "insights/page_views_external_referrals/day"),
            'data_page_fans_by_like_source'      => FB_DATA_SOURCE(session('access_token'), session('fid'), "insights/page_fans_by_like_source/day"),
        );
        
        return View::make('Theme::chart/source', $data);
    }

    public function youtube_accounts(){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;
        if(Input::get("code")){
            $data = GOOGLE_GET_USER_YOUTUBE(Input::get("code"));
            if(!empty($data)){
                $check = DB::table('social_yt_accounts')->where('user_id', '=', $data['user_id'])->where('email', '=', $data['email'])->first();
                if(empty($check)){
                    $count = DB::table('social_yt_accounts')->where('user_id', '=', $data['user_id'])->get();
                    DB::table('social_yt_accounts')->insert($data);
                }else{
                    DB::table('social_yt_accounts')->where('id', $check->id)->update($data);
                }
            }
            Redirect::to('/youtube_accounts');
        }

        $data = array(
            "result" => DB::table('social_yt_accounts')->get()
        );
        return View::make('Theme::youtube_accounts', $data);
    }

    public function ajax_action_item(){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;

        $id = (int)Input::get('id');
        $POST = DB::table('social_yt_accounts')->where('user_id', '=', Auth::user()->id)->where('id', '=', $id)->first();
        if(!empty($POST)){
            switch (Input::get("action")) {
                case 'delete':
                    DB::table('social_yt_accounts')->where('id', '=', $id)->where('user_id', '=', Auth::user()->id)->delete();
                    break;
                
                case 'active':
                DB::table('social_yt_accounts')->where('user_id', Auth::user()->id)->where('id', $id)->update(array("account_status" => 1));
                    break;

                case 'disable':
                DB::table('social_yt_accounts')->where('user_id', Auth::user()->id)->where('id', $id)->update(array("account_status" => 0));
                    break;
            }
        }

        ms(array(
            'st'    => 'success',
            'txt'   => 'Successfully'
        ));
    }

    public function ajax_action_multiple(){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;

        $ids =Input::get('id');
        if(!empty($ids)){
            foreach ($ids as $id) {
            $POST = DB::table('social_yt_accounts')->where('user_id', Auth::user()->id)->where('id', $id)->first();
                if(!empty($POST)){
                    switch (Input::get("action")) {
                        case 'delete':
                        DB::table('social_yt_accounts')->where('id', '=', $id)->where('user_id', '=', Auth::user()->id)->delete();
                            break;
                        case 'active':
                            DB::table('social_yt_accounts')->where('user_id', Auth::user()->id)->where('id', $id)->update(array("account_status" => 1));
                            break;

                        case 'disable':
                           DB::table('social_yt_accounts')->where('user_id', Auth::user()->id)->where('id', $id)->update(array("account_status" => 0));
                            break;
                    }
                }
            }
        }

        print_r(json_encode(array(
            'st'    => 'success',
            'txt'   => 'Successfully'
        )));
    }

    public function channels(){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;

        $result = DB::table('social_yt_accounts')->where('user_id', '=', Auth::user()->id)->where('account_status', '=', 1)->get();
        if(!empty($result)){
            foreach ($result as $key => $row) {
                $result[$key]->channels = YOUTUBE_GET_LIST_CHANNEL($row->access_token);
            }
        }
        $data = array(
            "result" => $result
        );

       return View::make('Theme::youtube_channels', $data);
    }

    public function channels_view(){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;

        $result = DB::table('social_yt_accounts')->where('user_id', '=', Auth::user()->id)->where('id', '=', Request::segment(2))->first();
        if(!empty($result)){
            session(['access_token' => $result->access_token]);
            session(['channelId' => Request::segment(3)]);

            $youtube = YoutubeC(); 
            $data = array(
                'channel' => $youtube->getChannelById(session('channelId')),
                'info'    => CountYT(session('channelId'), 'views,subscribersGained,subscribersLost')
            );return View::make('Theme::channels_view', $data);
        }else{
        }
    }

    //Ajax
    public function google_ajax_viewchart(){
        $data = array(
            'data_views'   => chart(array('channel' => session('channelId'), 'metrics' => 'views')),
            'count_views'  => format_number(CountYT(session('channelId'), 'views')),
        );
        return View::make('Theme::google/chart/views', $data);
    }

    public function google_ajax_revenuechart(){
        $data = array(
            'data_views'   => chart(array('channel' => session('channelId'), 'metrics' => 'earnings')),
            'count_views'  => format_number(CountYT(session('channelId'), 'earnings')),
        );
        return View::make('Theme::google/chart/revenue', $data);
    }

    public function google_ajax_watchchart(){
        $data = array(
            'data_estimatedMinutesWatched' => chart(array('channel' => session('channelId'), 'metrics' => 'estimatedMinutesWatched')),
            'count_estimatedMinutesWatched'=> format_number(CountYT(session('channelId'), 'estimatedMinutesWatched')),
            'data_averageViewDuration'     => chart(array('channel' => session('channelId'), 'metrics' => 'averageViewDuration')),
            'count_averageViewDuration'    => format_number(CountYT(session('channelId'), 'averageViewDuration'))
        );
        return View::make('Theme::google/chart/watch', $data);
    }

    public function google_ajax_engagementchart(){
        $data = array(
            'count_subscribersGained'          => format_number(CountYT(session('channelId'), 'subscribersGained')),
            'count_subscribersLost'            => format_number(CountYT(session('channelId'), 'subscribersLost')),
            'count_likes'                      => format_number(CountYT(session('channelId'), 'likes')),
            'count_dislikes'                   => format_number(CountYT(session('channelId'), 'dislikes')),
            'count_comments'                   => format_number(CountYT(session('channelId'), 'comments')),
            'count_shares'                     => format_number(CountYT(session('channelId'), 'shares')),
            'count_videosAddedToPlaylists'     => format_number(CountYT(session('channelId'), 'videosAddedToPlaylists')),
            'count_videosRemovedFromPlaylists' => format_number(CountYT(session('channelId'), 'videosRemovedFromPlaylists')),
            'data_subscribersGained'           => chart(array('channel' => session('channelId'), 'metrics' => 'subscribersGained')),
            'data_subscribersLost'             => chart(array('channel' => session('channelId'), 'metrics' => 'subscribersLost')),
            'data_likes'                       => chart(array('channel' => session('channelId'), 'metrics' => 'likes')),
            'data_dislikes'                    => chart(array('channel' => session('channelId'), 'metrics' => 'dislikes')),
            'data_comments'                    => chart(array('channel' => session('channelId'), 'metrics' => 'comments')),
            'data_shares'                      => chart(array('channel' => session('channelId'), 'metrics' => 'shares')),
            'data_videosAddedToPlaylists'      => chart(array('channel' => session('channelId'), 'metrics' => 'videosAddedToPlaylists')),
            'data_videosRemovedFromPlaylists'  => chart(array('channel' => session('channelId'), 'metrics' => 'videosRemovedFromPlaylists'))
        );
        return View::make('Theme::google/chart/engagement', $data);
    }

    public function google_ajax_countrychart(){
        $data = array(
            'data_viewsTopCountry' => chart(array('channel' => session('channelId'), 'metrics' => 'views', 'dimensions' => 'country-pie', 'limit' => 10, 'sort' => '-views')),
            'data_viewsCountry'    => chart(array('channel' => session('channelId'), 'metrics' => 'views', 'dimensions' => 'country', 'limit' => 1000, 'sort' => '-views'))
        );
        return View::make('Theme::google/chart/country', $data);
    }

    public function google_ajax_genderchart(){
        $data = array(
            'data_viewsGender'   => chart(array('channel' => session('channelId'), 'metrics' => 'viewerPercentage', 'dimensions' => 'gender', 'limit' => 10, 'sort' => '')),
            'data_viewsAgeGroup' => chart(array('channel' => session('channelId'), 'metrics' => 'viewerPercentage', 'dimensions' => 'ageGroup', 'limit' => 10, 'sort' => ''))
            
        );
        return View::make('Theme::google/chart/gender', $data);
    }

    public function google_ajax_annotationschart(){
        $data = array(
            'count_annotationImpressions'         => format_number(CountYT(session('channelId'), 'annotationImpressions')),
            'count_annotationClickableImpressions'=> format_number(CountYT(session('channelId'), 'annotationClickableImpressions')),
            'count_annotationClosableImpressions' => format_number(CountYT(session('channelId'), 'annotationClosableImpressions')),
            'count_annotationClicks'              => format_number(CountYT(session('channelId'), 'annotationClicks')),
            'count_annotationCloses'              => format_number(CountYT(session('channelId'), 'annotationCloses')),
            'data_annotationImpressions'          => chart(array('channel' => session('channelId'), 'metrics' => 'annotationImpressions')),
            'data_annotationClickableImpressions' => chart(array('channel' => session('channelId'), 'metrics' => 'annotationClickableImpressions')),
            'data_annotationClicks'               => chart(array('channel' => session('channelId'), 'metrics' => 'annotationClicks')),
            'data_annotationClickThroughRate'     => chart(array('channel' => session('channelId'), 'metrics' => 'annotationClickThroughRate')),
            'data_annotationClosableImpressions'  => chart(array('channel' => session('channelId'), 'metrics' => 'annotationClosableImpressions')),
            'data_annotationCloses'               => chart(array('channel' => session('channelId'), 'metrics' => 'annotationCloses')),
            'data_annotationCloseRate'            => chart(array('channel' => session('channelId'), 'metrics' => 'annotationCloseRate'))
        );
        return View::make('Theme::google/chart/annotations', $data);
    }

    public function google_ajax_devicechart(){
        $data = array(
            'data_operatingSystem'   => chart(array('channel' => session('channelId'), 'metrics' => 'views', 'dimensions' => 'operatingSystem', 'sort' => '')),
            'data_deviceType'   => chart(array('channel' => session('channelId'), 'metrics' => 'views', 'dimensions' => 'deviceType', 'sort' => '')),
            
        );
        return View::make('Theme::google/chart/device', $data);
    }

    //Tellyvizion

     public function tellyvizion_analytics(){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;

     
       return View::make('Theme::tellyvizion-analytics', $data);
        
    }
    
    
            /*public function dailymotion_ajax_viewcharts1(){
        $table_data =  DB::table('tbl_dailymotion')->where('user_id', '=', Auth::user()->id)->first();
        //$viewresponse = file_get_contents("https://api.dailymotion.com/user/x1xp7ry/likes?fields=likes_total,views_total");
        if($table_data->username) {
            $viewresponse_url = "https://api.dailymotion.com/user/".$table_data->username."/videos?fields=created_time,views_last_month&limit=5";
        }
        $viewresponse = file_get_contents($viewresponse_url);
        $result = json_decode($viewresponse, TRUE);
        //echo "<pre>";
        //print_r($result);
        
        $views_total = $result['total'];
        
        
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


            //echo "<pre>"; print_r($date).'<br>'; echo "</pre>";
            $res[].= '[Date.UTC('.$date.',0,0,0),'.$value['views_last_month'].']'; 
            //echo "<pre>"; print_r($res).'<br>'; echo "</pre>";
            //$res[].= '[Date.UTC(2017,03,05,0,0,0),1],[Date.UTC(2017,03,06,0,0,0),1],[Date.UTC(2017,03,07,0,0,0),1],[Date.UTC(2017,03,12,0,0,0),1],[Date.UTC(2017,03,13,0,0,0),1]'; 
            $count_views = $views_total;
            //echo "<pre>"; print_r($count_views).'<br>'; echo "</pre>";
        }

        
        $data_views = implode(",", $res);
        print_r($data_views);
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo $original = '[Date.UTC(2017,03,05,0,0,0),10],[Date.UTC(2017,03,06,0,0,0),0],[Date.UTC(2017,03,07,0,0,0),1],[Date.UTC(2017,03,12,0,0,0),0],[Date.UTC(2017,03,13,0,0,0),2]';
    //die();
        //print_r($data_views); die;
        //print_r('[Date.UTC(2017,03,05,0,0,0),1],[Date.UTC(2017,03,06,0,0,0),1],[Date.UTC(2017,03,07,0,0,0),1],[Date.UTC(2017,03,12,0,0,0),1],[Date.UTC(2017,03,13,0,0,0),1]');
        $data = array(
            //'data_views'   => $data_views,
            'data_views'   => $original,
            'count_views'  => $count_views,
        );
        return View::make('Theme::dailymotion/chart/views', $data);
    }*/
    
    
    
    //Ajax
    public function tellyvizion_ajax_viewchart(){
      
       $date = date('Y-m-d');
      
       //$result = DB::table('video_views')->select('views','date')->where('user_id', '=', Auth::user()->id)->orderBy('views', 'asc')->orderBy('date', 'asc')->get();
        $result = DB::table('video_views')
                   ->select(DB::raw('SUM(views) As "views"'),'date')
                   ->where('user_id', '=', Auth::user()->id)
                    //->where('date', '=', $date)
                   //->orderBy('views', 'asc')
                   ->groupBy(DB::raw('DATE(date)'))
                   ->orderBy('date', 'asc')
                   ->limit(30)
                   ->get();
         //echo "<pre>"; print_r($result); die;

       
        $res = array();
        foreach ($result as $value) {


            $date = date('Y-m-d');           
            $date_format = explode(" ", $value->date);
            $date = $date_format[0];
            $date = date("Y,m,d", strtotime($date));
            //echo "<pre>"; print_r($date).'<br>'; echo "</pre>";

           
            $res[].= '[Date.UTC('.$date.',0,0,0),'.$value->views.']';


        
            $count_views+= count($value->views);
            //echo "<pre>"; print_r($count_views).'<br>'; echo "</pre>";
            

            
        }

       
        $data_views = implode(",", $res);
        //echo "<pre>"; print_r($data_views).'<br>'; echo "</pre>";
        $data = array(
            'data_views'   => $data_views,
            'count_views'  => $count_views,
        );
        //echo "<pre>"; print_r($data).'<br>'; echo "</pre>";
        return View::make('Theme::tellyvizion/chart/views', $data);
    }

    public function tellyvizion_ajax_revenuechart(){
        $date = date('Y-m-d');
        $result = DB::table('payment_received_data')
                   ->select(DB::raw('SUM(amount) As "amount"'),'created_at')
                   ->where('receipt_name', '=', Auth::user()->username)
                    //->where('date', '=', $date)
                   //->orderBy('views', 'asc')
                   ->groupBy(DB::raw('DATE(created_at)'))
                   ->orderBy('created_at', 'asc')
                   ->limit(30)
                   ->get();
         //echo "<pre>"; print_r($result); die;

       
        $res = array();
        foreach ($result as $value) {


            $date = date('Y-m-d');           
            $date_format = explode(" ", $value->created_at);
            $date = $date_format[0];
            $date = date("Y,m,d", strtotime($date));
            //echo "<pre>"; print_r($date).'<br>'; echo "</pre>";

           
            $res[].= '[Date.UTC('.$date.',0,0,0),'.$value->amount.']';


        
            $count_amount+= count($value->amount);
            //echo "<pre>"; print_r($count_views).'<br>'; echo "</pre>";
            

            
        }

       
        $data_amount = implode(",", $res);
        //echo "<pre>"; print_r($data_views).'<br>'; echo "</pre>";
        $data = array(
            'data_views'   => $data_amount,
            'count_views'  => $count_amount,
        );
        //echo "<pre>";
        //print_r($data);
        //echo "<pre>"; print_r($data).'<br>'; echo "</pre>";
        return View::make('Theme::tellyvizion/chart/revenue', $data);
    }

    public function tellyvizion_ajax_watchchart(){
        $data = array(
            //'data_estimatedMinutesWatched' => chart(array('channel' => session('channelId'), 'metrics' => 'estimatedMinutesWatched')),
           // 'count_estimatedMinutesWatched'=> format_number(CountYT(session('channelId'), 'estimatedMinutesWatched')),
           //'data_averageViewDuration'     => chart(array('channel' => session('channelId'), 'metrics' => 'averageViewDuration')),
           // 'count_averageViewDuration'    => format_number(CountYT(session('channelId'), 'averageViewDuration'))
        );      
        //echo "<pre>"; print_r($data).'<br>'; echo "</pre>";
        return View::make('Theme::tellyvizion/chart/watch', $data);
    }

    public function tellyvizion_ajax_engagementchart(){
           $date = date('Y-m-d');
           // Result Favourites subscribe Start
           $favourite = DB::table('favorites')
                   ->select(DB::raw('SUM(`user_id`) As "userid"'), 'video_id', 'created_at')
                   ->where('user_id', '=', Auth::user()->id)
                   ->groupBy(DB::raw('DATE(created_at)'))
                   ->orderBy('created_at', 'asc')
                   ->get(); 
           // echo "<pre>"; print_r($favourite).'<br>'; echo "</pre>";

        $video = array();
        
        foreach ($favourite as $favs) {
            $video[] = $favs->video_id;           
            $count_subscribersLost+= count($favs->video_id);
           // echo "<pre>"; print_r($count_subscribersLost).'<br>'; echo "</pre>";
            //$count_users+= count($values->user_id);
        }
        $data_subscribersLost = implode(",", $video);
      
         // Result Favourites subscribe END


        // Result Favourites Uploads Start
           $video_uploads = DB::table('videos')
                   ->select(DB::raw('SUM(`user_id`) As "userid"'), 'video_category_id', 'created_at')
                   ->where('user_id', '=', Auth::user()->id)
                   ->groupBy(DB::raw('DATE(created_at)'))
                   ->orderBy('created_at', 'asc')
                   ->get(); 
            //echo "<pre>"; print_r($video_uploads).'<br>'; echo "</pre>";

        $videoup = array();
        
        foreach ($video_uploads as $videoups) {
            $videoup[] = $videoups->video_category_id;
            $count_subscribersGained+= count($videoups->video_category_id);
            //echo "<pre>"; print_r($count_subscribersGained).'<br>'; echo "</pre>";
            //$count_users+= count($values->user_id);
        }
        $data_subscribersGained = implode(",", $videoup);
      
         // Result Favourites Uploads END








        // Result Likes
           $result_likes = DB::table('like_dislike')               
                   ->select(DB::raw('SUM(`like`) As "like", SUM(`dislike`) As "dislike"'), 'date')
                   ->where('user_id', '=', Auth::user()->id)
                   ->where('like', '=',1)
                   ->orWhere('dislike', '=',1)
                   ->groupBy(DB::raw('DATE(date)'))
                   ->orderBy('date', 'asc')
                   ->get();

        $lik = array();
        $lik1 = array();
        foreach ($result_likes as $values) {

            /*$date = date('Y-m-d');           
            $date_format = explode(" ", $values->date);
            $date = $date_format[0];
            $date = date("Y,m,d", strtotime($date));
            //echo "<pre>"; print_r($date).'<br>'; echo "</pre>";           
            $lik[].= '[Date.UTC('.$date.',0,0,0),'.$values->like.']';
            $lik1[].= '[Date.UTC('.$date.',0,0,0),'.$values->dislike.']';*/
            $lik[] = $values->like;
            $lik1[] = $values->dislike;
            $count_likes+= count($values->like);
            $count_dislikes+= count($values->dislike);
            //echo "<pre>"; print_r($count_likes).'<br>'; echo "</pre>";
            

            
        }
        $data_likes = implode(",", $lik);
        //echo "<pre>"; print_r($data_likes).'<br>'; echo "</pre>";
        $data_dislikes = implode(",", $lik1);
        //echo "<pre>"; print_r($data_dislikes).'<br>'; echo "</pre>"; 
     
        $data = array(
            
            'count_subscribersGained'          => $count_subscribersGained,
            //'count_subscribersGained'          => format_number(CountYT(session('channelId'), 'subscribersGained')),
            'count_subscribersLost'            => $count_subscribersLost,
            //'count_subscribersLost'            => format_number(CountYT(session('channelId'), 'subscribersLost')),
            //'count_likes'                      => format_number(CountYT(session('channelId'), 'likes')),
            'count_likes'                      => $count_likes,
            'count_dislikes'                   => $count_dislikes,
            //'count_dislikes'                   => format_number(CountYT(session('channelId'), 'dislikes')),
            //'count_comments'                   => format_number(CountYT(session('channelId'), 'comments')),
            //'count_shares'                     => format_number(CountYT(session('channelId'), 'shares')),
            //'count_videosAddedToPlaylists'     => format_number(CountYT(session('channelId'), 'videosAddedToPlaylists')),
            //'count_videosRemovedFromPlaylists' => format_number(CountYT(session('channelId'), 'videosRemovedFromPlaylists')),
            'data_subscribersGained'           => $data_subscribersGained,
            //'data_subscribersGained'           => chart(array('channel' => session('channelId'), 'metrics' => 'subscribersGained')),
            'data_subscribersLost'             => $data_subscribersLost,
            //'data_subscribersLost'             => chart(array('channel' => session('channelId'), 'metrics' => 'subscribersLost')),
            //'data_likes'                       => chart(array('channel' => session('channelId'), 'metrics' => 'likes')),
            'data_likes'                       => $data_likes,
            //'data_dislikes'                    => chart(array('channel' => session('channelId'), 'metrics' => 'dislikes')),
            'data_dislikes'                    => $data_dislikes,
            //'data_comments'                    => chart(array('channel' => session('channelId'), 'metrics' => 'comments')),
            //'data_shares'                      => chart(array('channel' => session('channelId'), 'metrics' => 'shares')),
           // 'data_videosAddedToPlaylists'      => chart(array('channel' => session('channelId'), 'metrics' => 'videosAddedToPlaylists')),
            //'data_videosRemovedFromPlaylists'  => chart(array('channel' => session('channelId'), 'metrics' => 'videosRemovedFromPlaylists'))
        );      
        //echo "<pre>"; print_r($data).'<br>'; echo "</pre>";
        return View::make('Theme::tellyvizion/chart/engagement', $data);
    }

    public function tellyvizion_ajax_countrychart(){
        
        $data = array(
            'data_viewsTopCountry' => chart(array('channel' => session('channelId'), 'metrics' => 'views', 'dimensions' => 'country-pie', 'limit' => 10, 'sort' => '-views')),
            'data_viewsCountry'    => chart(array('channel' => session('channelId'), 'metrics' => 'views', 'dimensions' => 'country', 'limit' => 1000, 'sort' => '-views'))
        );      
        //echo "<pre>"; print_r($data).'<br>'; echo "</pre>";
        return View::make('Theme::tellyvizion/chart/country', $data);
    }

    public function tellyvizion_ajax_genderchart(){
        $data = array(
            'data_viewsGender'   => chart(array('channel' => session('channelId'), 'metrics' => 'viewerPercentage', 'dimensions' => 'gender', 'limit' => 10, 'sort' => '')),
            'data_viewsAgeGroup' => chart(array('channel' => session('channelId'), 'metrics' => 'viewerPercentage', 'dimensions' => 'ageGroup', 'limit' => 10, 'sort' => ''))
            
        );      
        //echo "<pre>"; print_r($data).'<br>'; echo "</pre>";
        return View::make('Theme::tellyvizion/chart/gender', $data);
    }

    public function tellyvizion_ajax_annotationschart(){
        $data = array(
            'count_annotationImpressions'         => format_number(CountYT(session('channelId'), 'annotationImpressions')),
            'count_annotationClickableImpressions'=> format_number(CountYT(session('channelId'), 'annotationClickableImpressions')),
            'count_annotationClosableImpressions' => format_number(CountYT(session('channelId'), 'annotationClosableImpressions')),
            'count_annotationClicks'              => format_number(CountYT(session('channelId'), 'annotationClicks')),
            'count_annotationCloses'              => format_number(CountYT(session('channelId'), 'annotationCloses')),
            'data_annotationImpressions'          => chart(array('channel' => session('channelId'), 'metrics' => 'annotationImpressions')),
            'data_annotationClickableImpressions' => chart(array('channel' => session('channelId'), 'metrics' => 'annotationClickableImpressions')),
            'data_annotationClicks'               => chart(array('channel' => session('channelId'), 'metrics' => 'annotationClicks')),
            'data_annotationClickThroughRate'     => chart(array('channel' => session('channelId'), 'metrics' => 'annotationClickThroughRate')),
            'data_annotationClosableImpressions'  => chart(array('channel' => session('channelId'), 'metrics' => 'annotationClosableImpressions')),
            'data_annotationCloses'               => chart(array('channel' => session('channelId'), 'metrics' => 'annotationCloses')),
            'data_annotationCloseRate'            => chart(array('channel' => session('channelId'), 'metrics' => 'annotationCloseRate'))
        );
        return View::make('Theme::tellyvizion/chart/annotations', $data);
    }

    public function tellyvizion_ajax_devicechart(){
        $data = array(
            'data_operatingSystem'   => chart(array('channel' => session('channelId'), 'metrics' => 'views', 'dimensions' => 'operatingSystem', 'sort' => '')),
            'data_deviceType'   => chart(array('channel' => session('channelId'), 'metrics' => 'views', 'dimensions' => 'deviceType', 'sort' => '')),
            
        );
        //echo "<pre>"; print_r($data).'<br>'; echo "</pre>";
        return View::make('Theme::tellyvizion/chart/device', $data);
    }

    //Tellyvizion End
    
    
    
    // Dailymotion Start
    public function dailymotion_analytics(){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;
       return View::make('Theme::dailymotion-analytics', $data);
    }
     //Ajax
    public function dailymotion_ajax_viewchart(){
        //$viewresponse = file_get_contents("https://api.dailymotion.com/user/x1xp7ry/likes?fields=likes_total,views_total");
        
        $viewresponse_url = "https://api.dailymotion.com/user/x1xp7ry/likes?fields=likes_total,views_total,created_time";
        $viewresponse = file_get_contents($viewresponse_url);
        $result = json_decode($viewresponse, TRUE);
         /* echo "<pre>";
        print_r($result);
        echo "</pre>"; */
        
        $total_likes = $result['list'][1]['likes_total'];
        $views_total = $result['list'][1]['views_total'];
        $created_time = $result['list'][1]['created_time'];
        
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
        foreach ($result as $value) {
            // Use $field and $value here
            /* date_default_timezone_set('UTC');
            $utc = $value->$created_time;
            $time = strtotime($utc);
            $dateInLocal = date("Y-m-d H:i:s", $time);
             $res[] = $dateInLocal; */
            //echo "<pre>"; print_r($res).'<br>'; echo "</pre>";
            
          /*   $date_format = explode(" ", $created_time);
            echo "<pre>"; print_r($date_format).'<br>'; echo "</pre>";
            $date = $date_format[0];
            echo "<pre>"; print_r($date).'<br>'; echo "</pre>"; */
            $date = date("Y,m,d", strtotime('UTC'));
            //echo "<pre>"; print_r($date).'<br>'; echo "</pre>";
            $res[].= '[Date.UTC('.$date.',0,0,0),'.$value -> $views_total.']'; 
            //echo "<pre>"; print_r($res).'<br>'; echo "</pre>";
            //$res[].= '[Date.UTC(2017,03,05,0,0,0),1],[Date.UTC(2017,03,06,0,0,0),1],[Date.UTC(2017,03,07,0,0,0),1],[Date.UTC(2017,03,12,0,0,0),1],[Date.UTC(2017,03,13,0,0,0),1]'; 
            $count_views = $views_total;            
            //echo "<pre>"; print_r($count_views).'<br>'; echo "</pre>";
        }
    
        
        $data_views = implode(",", $res);
        //print_r($data_views); die;
        //print_r('[Date.UTC(2017,03,05,0,0,0),1],[Date.UTC(2017,03,06,0,0,0),1],[Date.UTC(2017,03,07,0,0,0),1],[Date.UTC(2017,03,12,0,0,0),1],[Date.UTC(2017,03,13,0,0,0),1]');
        $data = array(
            'data_views'   => $data_views,
           // 'data_views'   => '[Date.UTC(2017,03,05,0,0,0),1],[Date.UTC(2017,03,06,0,0,0),1],[Date.UTC(2017,03,07,0,0,0),1],[Date.UTC(2017,03,12,0,0,0),1],[Date.UTC(2017,03,13,0,0,0),1]',
            'count_views'  => $count_views,
        );
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
        $data = array(
            'count_subscribersGained'          => format_number(CountYT('fun', 'subscribersGained')),
            'count_subscribersLost'            => format_number(CountYT('fun', 'subscribersLost')),
            'count_likes'                      => format_number(CountYT('fun', 'likes')),
            'count_dislikes'                   => format_number(CountYT('fun', 'dislikes')),
            'count_comments'                   => format_number(CountYT('fun', 'comments')),
            'count_shares'                     => format_number(CountYT('fun', 'shares')),
            'count_videosAddedToPlaylists'     => format_number(CountYT('fun', 'videosAddedToPlaylists')),
            'count_videosRemovedFromPlaylists' => format_number(CountYT('fun', 'videosRemovedFromPlaylists')),
            'data_subscribersGained'           => chart(array('channel' => 'fun', 'metrics' => 'subscribersGained')),
            'data_subscribersLost'             => chart(array('channel' =>'fun', 'metrics' => 'subscribersLost')),
            'data_likes'                       => chart(array('channel' => 'fun', 'metrics' => 'likes')),
            'data_dislikes'                    => chart(array('channel' => 'fun', 'metrics' => 'dislikes')),
            'data_comments'                    => chart(array('channel' => 'fun', 'metrics' => 'comments')),
            'data_shares'                      => chart(array('channel' => 'fun', 'metrics' => 'shares')),
            'data_videosAddedToPlaylists'      => chart(array('channel' => 'fun', 'metrics' => 'videosAddedToPlaylists')),
            'data_videosRemovedFromPlaylists'  => chart(array('channel' => 'fun', 'metrics' => 'videosRemovedFromPlaylists'))
        );
        return View::make('Theme::dailymotion/chart/engagement', $data);
    }

    public function dailymotion_ajax_countrychart(){
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
    }       
    
    // Dailymotion End
    
    
    

    public function post_to_fb(){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;
        $video_id = Input::get('video_id');
        $video_id = 12;
        $video = Video::with('tags')->findOrFail($video_id);
        $video_cat = DB::table('video_categories')->where('id', '=', $video->video_category_id)->first();
        $tags = array();
        foreach($video->tags as $tag):
            $tags[].= $tag->name;
        endforeach;

        $result = DB::table('tbl_facebook')->where('user_id', '=', Auth::user()->id)->first();
        if(empty($result)){
            die('fb_not_connected');
        }

        $access_token = $result->access_token;
         if ($video->video) {
                   //$testVideoFile = '/var/www/html/'.Config::get('site.uploads_dir').'videos/'.$video->video;
                   $testVideoFile = Config::get('site.s3_video') . 'videos/'.$video->video;
               }elseif ($video->embed_code) {
                   $testVideoFile = $video->embed_code;
               }

        if ($video->details) {
                   $video_description = $video->details;
               }else{
                   $video_description = $video->description;
               }
        $fb = new Facebook\Facebook([
          'app_id' => FACEBOOK_APP_ID,
          'app_secret' => FACEBOOK_APP_SECRET,
          'default_graph_version' => 'v2.8',
          ]);
        $data = [
          'title' => $video->title,
          'description' => $video_description,
          'source' => $fb->videoToUpload($testVideoFile),
        ];

        try {
          $response = $fb->post('/me/videos', $data, $access_token);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
          // When Graph returns an error
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          // When validation fails or other local issues
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }

        $graphNode = $response->getGraphNode();

        echo 'Video ID: ' . $graphNode['id'];
    } 

    public function post_to_youtube(){

         if(Auth::guest()):
            return Redirect::to('/');
        endif;
        session(['video_id' => Input::get('video_id')]);
        $video_id = session('video_id');
        //die($video_id);
        $result = DB::table('social_yt_accounts')->where('user_id', '=', Auth::user()->id)->first();
        if(empty($result)){
            die('yt_not_connected');
        }

        //$video = Video::find(Input::get('video_id'));
        $video = Video::with('tags')->findOrFail(12);
        $video_cat = DB::table('video_categories')->where('id', '=', $video->video_category_id)->first();
        $tags = array();
        foreach($video->tags as $tag):
            $tags[].= $tag->name;
        endforeach;
          $videoTitle = $video->title;
           if ($video->video) {
               //$testVideoFile = '/var/www/html/'.Config::get('site.uploads_dir').'videos/'.$video->video;
			   $testVideoFile = Config::get('site.s3_video') . 'videos/'.$video->video;
           }elseif ($video->embed_code) {
               $testVideoFile = $video->embed_code;
           }
           if ($video->details) {
               $video_description = $video->details;
           }else{
               $video_description = $video->description;
           }
        $video_description = str_replace(array('\'', '"'), '', $video_description);
        $video_description = trim(preg_replace('/\s\s+/', ' ', $video_description));
        $video_description = strip_tags($video_description);
        //echo $video_description;
        //die();
        $videoCategory = $video_cat->name;
        $videoPath = $testVideoFile;
        //$result = $result->toArray();
        $access_token = $result->access_token;

        $streamName = 's3://tellyvizion/uploads/videos/'.$video->video;
        $s3client = S3Client::factory(array(
                    'key'    => 'AKIAIEMFDP5ZOLXTFESA',
                    'secret' => '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',
                    'region' => 'us-east-1' // if you need to set.
                ));
        $s3client->registerStreamWrapper();
        //print_r($streamName);
        //die();
        //$access_token = '{"access_token":"ya29.GlxaBM9N_6_YhJFhG3XLLhvRlhTkDhOw8f9Hsgld3Nelt3XQCsexGN69Ks6JQD33bF1XVXlauPfkSOy7W_ntrZDQk5s-lo7CUtJ-k4PR9kj1AxoGhCNl1_5imtv57Q","expires_in":3582,"token_type":"Bearer","created":1496188788}';
try{
    // Client init
    $client = new Google_Client();
    $client->setApplicationName('tellyvizion');
    $client->setClientId(GOOGLE_ID);
    $client->setApprovalPrompt('force');
    $client->setAccessType('offline');
    $client->setAccessToken($access_token);
    $client->setScopes($scope);
    $client->setClientSecret(GOOGLE_SECRET);
	//echo "<pre>" print_r($client);
    if ($client->getAccessToken()) {
 
        /**
         * Check to see if our access token has expired. If so, get a new one and save it to file for future use.
         */
        if($client->isAccessTokenExpired()) {
            $newToken = json_decode($client->getAccessToken());
			//echo "<pre>"; print_r($newToken); die();
            $client->refreshToken($newToken->refresh_token);
            //file_put_contents('the_key.txt', $client->getAccessToken());
        }
 
        $youtube = new Google_Service_YouTube($client);
 
 
 
        // Create a snipet with title, description, tags and category id
        $snippet = new Google_Service_YouTube_VideoSnippet();
        $snippet->setTitle($videoTitle);
        $snippet->setDescription($video_description);
        $snippet->setCategoryId($videoCategory);
        $snippet->setTags($tags);
 
        // Create a video status with privacy status. Options are "public", "private" and "unlisted".
        $status = new Google_Service_YouTube_VideoStatus();
        $status->setPrivacyStatus('public');
 
        // Create a YouTube video with snippet and status
        $video = new Google_Service_YouTube_Video();
        $video->setSnippet($snippet);
        $video->setStatus($status);
 
        // Size of each chunk of data in bytes. Setting it higher leads faster upload (less chunks,
        // for reliable connections). Setting it lower leads better recovery (fine-grained chunks)
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
        $media->setFileSize(filesize($streamName));
 
 
        // Read the media file and upload it chunk by chunk.
        $status = false;
        $handle = fopen($streamName, "r");
        while (!$status && !feof($handle)) {
            $chunk = fread($handle, $chunkSizeBytes);
            $status = $media->nextChunk($chunk);
        }
 
        fclose($handle);
 
        /**
         * Video has successfully been upload, now lets perform some cleanup functions for this video
         */
        if ($status->status['uploadStatus'] == 'uploaded') {
            $uploaded_video_id = $status['id'];
            // Actions to perform for a successful upload
             //return Redirect::to('/')->with(array('note' => 'Sorry, there was an error with your card: ', 'note_type' => 'error'));
            echo 'Your Video has been succussfully uploaded to Youtube <a target="_blank" href="https://www.youtube.com/embed/'. $uploaded_video_id .'">click here </a> to see your video';
        }
 
        // If you want to make other calls after the file upload, set setDefer back to false
        $client->setDefer(true);
 
    } else{
        // @TODO Log error
        echo 'Problems creating the client';
    }
 
} catch(Google_Service_Exception $e) {
    print "Caught Google service Exception ".$e->getCode(). " message is ".$e->getMessage();
    print "Stack trace is ".$e->getTraceAsString();
}catch (Exception $e) {
    print "Caught Google service Exception ".$e->getCode(). " message is ".$e->getMessage();
    print "Stack trace is ".$e->getTraceAsString();
}

}


     public function like_video(){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;
       $video_id = Input::get('video_id');
       $data = array('user_id' => Auth::user()->id,
            'video_id' => $video_id,
            'like' => 1
        );
       $check_like = DB::table('like_dislike')->where('video_id', '=', $video_id)->where('user_id', '=', Auth::user()->id)->where('like', '=', 1)->first();
       if ($check_like) {
        DB::table('like_dislike')->where('video_id', '=', $video_id)->where('user_id', '=', Auth::user()->id)->update(array("like" => 0));
        $likes = DB::table('like_dislike')->where('video_id', '=', $video_id)->where('like', '=', 1)->get();
        echo '('.count($likes).')';
       }else{
            //DB::table('like_dislike')->where('video_id', '=', $video_id)->where('user_id', '=', Auth::user()->id)->delete();
            DB::table('like_dislike')->insert($data);
            $likes = DB::table('like_dislike')->where('video_id', '=', $video_id)->where('like', '=', 1)->get();
             echo '('.count($likes).')';
        }
   }
   public function dislike_video(){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;
       $video_id = Input::get('video_id');
       $data = array('user_id' => Auth::user()->id,
            'video_id' => $video_id,
            'dislike' => 1
        );
       $check_dislike = DB::table('like_dislike')->where('video_id', '=', $video_id)->where('user_id', '=', Auth::user()->id)->where('dislike', '=', 1)->first();
       if ($check_dislike) {
          DB::table('like_dislike')->where('video_id', '=', $video_id)->where('user_id', '=', Auth::user()->id)->update(array("dislike" => 0));
        $likes = DB::table('like_dislike')->where('video_id', '=', $video_id)->where('dislike', '=', 1)->get();
        echo '('.count($likes).')';
       }else{
            //DB::table('like_dislike')->where('video_id', '=', $video_id)->where('user_id', '=', Auth::user()->id)->delete();
            DB::table('like_dislike')->insert($data);
            $dislikes = DB::table('like_dislike')->where('video_id', '=', $video_id)->where('dislike', '=', 1)->get();
            echo '('.count($dislikes).')';
        }
   }

    public function dailymotion_save_user() {
        $check_data =  DB::table('tbl_dailymotion')->where('user_id', '=', Auth::user()->id)->get();

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
                $result = $api->get(
                    '/user/'.Request::input('uid'),
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
   
    public function social_accounts(){
         if(Auth::guest()):
            return Redirect::to('/');
        endif;
          
          if(Input::get("code")){
            $data = GOOGLE_GET_USER_YOUTUBE(Input::get("code"));
            if(!empty($data)){
                $check = DB::table('social_yt_accounts')->where('user_id', '=', $data['user_id'])->where('email', '=', $data['email'])->first();
                if(empty($check)){
                    $count = DB::table('social_yt_accounts')->where('user_id', '=', $data['user_id'])->get();
                    DB::table('social_yt_accounts')->insert($data);
                }else{
                    DB::table('social_yt_accounts')->where('id', $check->id)->update($data);
                }
            }
            Redirect::to('/social_accounts');
        }

        $social_data = DB::table('social_yt_accounts')->where('user_id', '=', Auth::user()->id)->where('account_status', '=', 1)->get();
        if(!empty($social_data)){
            foreach ($social_data as $key => $row) {
                $social_data[$key]->channels = YOUTUBE_GET_LIST_CHANNEL($row->access_token);
            }
        }
        
        $result_dailymotion_user = DB::table('tbl_dailymotion')->where('user_id', '=', Auth::user()->id)->get();
        
        //echo "<pre>"; print_r($result_dailymotion_user); echo "</pre>"; die();
        
        $result_fb = DB::table('tbl_facebook')->where('user_id', '=', Auth::user()->id)->get();
        $data = array(
            "result" => DB::table('social_yt_accounts')->get(),
            'result_fb' => $result_fb,
            'result_dailymotion_user' => $result_dailymotion_user,
            'social_data' => $social_data,
            "authUrl"  => FB_LOGIN(),
            'theme_settings' => ThemeHelper::getThemeSettings(),
            'pages' => Page::all(),
        );
        return View::make('Theme::social_accounts', $data);
    }
	
	

    public function save_reposition(){
        /*ini_set('display_errors', 1);
        error_reporting(E_ALL);*/
       if(Input::get("pos"))
        {
        $user = User::where('id', '=', Auth::user()->id)->first();

        
        $data['status'] = 200;
        $cover_data = array('cropped' =>  Input::get("pos") );
        DB::table('users')->where('id',  Auth::user()->id)->update($cover_data);
        echo json_encode($data);
        }
    }

    public function login_with_fb()
    {
        if(Input::get("code")){
            FB_ACCESS_TOKEN();
            redirect("login_with_fb");
        }
        if(session("fb_token")){
            //$reponse = FB()->get('/me/accounts?fields=name,access_token,perms,picture.type(large),cover,id,category', session("fb_token"));
            $reponse = FB()->get('/me?fields=name,email,picture.type(large)', session("fb_token"));
            $pages = @json_decode($reponse->getBody());
			//echo "<pre>"; print_r($pages).'<br/>';
			//echo "<pre>"; print_r($pages->picture->data->url).'<br/>';
       //die;
        $user = User::where('email', $pages->email)->first();
        if($pages->email == $user->email){
			Auth::loginUsingId($user->id);
/*         if ( Auth::login($user)) {
            if($settings->free_registration){
                Auth::user()->role = 'registered';
                $user = User::find(Auth::user()->id);
                $user->role = 'registered';
                $user->save();
            }
            
        } */
        Session::forget('fb_token');
        return Redirect::to('/')->with(array('note' => 'You have been successfully logged in.', 'note_type' => 'success'));
        }else{
			$fileName = str_random(5).'.jpg';
			$password = str_random(10);
		    $image = $pages->picture->data->url;
			//Storage::disk('local')->put('/var/www/html/content/uploads'.'/'.$fileName, $image, 'public');
			copy($image, '/var/www/html/content/uploads/avatars/'.$fileName);
			$user_data['avatar'] = $fileName;
			
			$user_data['username'] = $pages->email;
			$user_data['name'] = $pages->name;
			$user_data['email'] = $pages->email;
			$user_data['active'] = 1;
			$user_data['role'] = "registered";
			$user_data['password'] = Hash::make($password);
			$user = new User($user_data);
			$user->save();
			Auth::loginUsingId($user->id);
            return Redirect::to('/')->with(array('note' => 'You have been successfully logged in using facebook.', 'note_type' => 'success'));
            }
        }
    }

public function login_with_google(){
  if(Input::get("code")){
    $client = new Google_Client();
    $client->setApplicationName('Tellyvizion');        
    $client->setClientId(GOOGLE_ID);
    $client->setClientSecret(GOOGLE_SECRET);
    $client->setDeveloperKey(GOOGLE_API_KEY);
    $client->setRedirectUri(url()."/login_with_google");
    $client->setScopes(array('https://www.googleapis.com/auth/userinfo.email'));
    $client->authenticate(Input::get("code"));
    $oauth2 = new Google_Service_Oauth2($client);
    $access_token = $client->getAccessToken();
    $client->setAccessToken($access_token);
    $Info = $oauth2->userinfo->get();
    $user = User::where('email', $Info->email)->first();
    if($Info->email == $user->email){
        Auth::loginUsingId($user->id);
    return Redirect::to('/')->with(array('note' => 'You have been successfully logged in.', 'note_type' => 'success'));
    }else{
        $fileName = str_random(5).'.jpg';
        $password = str_random(10);
        $image = $Info->picture;
        //Storage::disk('local')->put('/var/www/html/content/uploads'.'/'.$fileName, $image, 'public');
        copy($image, '/var/www/html/content/uploads/avatars/'.$fileName);
        $user_data['avatar'] = $fileName;
        
        $user_data['username'] = $Info->email;
        $user_data['name'] = $Info->name;
        $user_data['email'] = $Info->email;
        $user_data['active'] = 1;
        $user_data['role'] = "registered";
        $user_data['password'] = Hash::make($password);
        $user = new User($user_data);
        $user->save();
        Auth::loginUsingId($user->id);
        return Redirect::to('/')->with(array('note' => 'You have been successfully logged in using google.', 'note_type' => 'success'));
        }
    }

    }

}