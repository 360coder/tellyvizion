<?php

use \HelloVideo\User as User;
use Carbon\Carbon;

Route::group(array('before' => 'if_logged_in_must_be_subscribed', 'middleware' => 'secure'), function() {
    Route::get('signup', function() {

        if(!Auth::guest()){
            return Redirect::to('/');
        }

        $data = array(
            'type' => 'signup',
            'menu' => Menu::orderBy('order', 'ASC')->get(),
            'payment_settings' => PaymentSetting::first(),
            'video_categories' => VideoCategory::all(),
            'post_categories' => PostCategory::all(),
            'theme_settings' => ThemeHelper::getThemeSettings(),
            'pages' => Page::all(),
            'plugin_data' => (object) array_build(PluginData::where('plugin_slug', 'paypal')->get(), function($key, $data) {
                return array($data->key, $data->value);
            })
        );

        return View::make('plugins::paypal.views.signup', $data);
    });

    Route::post('ajax_signup', function() {
        $user_data = array('username' => Input::get('username'), 'email' => Input::get('email'), 'password' => Hash::make(Input::get('password')) );

        $input = Input::all();

        $validation = Validator::make( $input, User::$rules );

        if ($validation->fails()){
            $msg = json_decode($validation->messages(), true);
            $msg['note'][] = 'Sorry, there was an error creating your account.';
            $msg['note_type'][] = 'error';
            echo json_encode($msg);
            exit;
        }

        $user = new User($user_data);
        $user->save();
        Auth::loginUsingId($user->id);

        echo $user->id;
        exit;
    });
});

Route::get('user/{username}/renew_subscription', array('middleware' => 'secure', function($username) {
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
            'plugin_data' => (object) array_build(PluginData::where('plugin_slug', 'paypal')->get(), function($key, $data) {
                return array($data->key, $data->value);
            })
        );

        return View::make('plugins::paypal.views.renew-subscription', $data);
    } else {
        return Redirect::to('/');
    }

}));

Route::get('user/{username}/upgrade_subscription', array('middleware' => 'secure', function($username) {
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
            'plugin_data' => (object) array_build(PluginData::where('plugin_slug', 'paypal')->get(), function($key, $data) {
                return array($data->key, $data->value);
            })
        );

        return View::make('plugins::paypal.views.upgrade-subscription', $data);
    } else {
        return Redirect::to('/');
    }
}));

Route::post('ipn', function() {
    $payment_settings = PaymentSetting::first();

    $plugin_data = (object) array_build(PluginData::where('plugin_slug', 'paypal')->get(), function($key, $data) {
        return array($data->key, $data->value);
    });

    header('HTTP/1.1 200 OK');

    $sandbox = 'sandbox.';
    if($payment_settings->live_mode)
        $sandbox = '';

    $receiver_email   = Input::get('receiver_email');
    $txn_type         = Input::get('txn_type');
    $payment_status   = Input::get('payment_status');
    $payment_amount   = Input::get('mc_gross');
    $payment_currency = Input::get('mc_currency');
    $user_id          = Input::get('custom');

    // reference: https://developer.paypal.com/docs/classic/ipn/ht_ipn/
    $raw_post_data = file_get_contents('php://input');
    $raw_post_array = explode('&', $raw_post_data);
    $myPost = array();
    foreach ($raw_post_array as $keyval) {
        $keyval = explode ('=', $keyval);
        if (count($keyval) == 2)
            $myPost[$keyval[0]] = urldecode($keyval[1]);
    }

    $req = 'cmd=_notify-validate';
    $get_magic_quotes_exists = false;
    if(function_exists('get_magic_quotes_gpc')) {
        $get_magic_quotes_exists = true;
    }
    foreach ($myPost as $key => $value) {
        if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
            $value = urlencode(stripslashes($value));
        } else {
            $value = urlencode($value);
        }
        $req .= "&$key=$value";
    }

    $result = '';
    $used_curl = false;

    if(function_exists('curl_init')) {
        $ch = curl_init('https://www.' . $sandbox . 'paypal.com/cgi-bin/webscr');
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

        $result = curl_exec($ch);
        curl_close($ch);

        if($result !== false)
            $used_curl = true;
    }

    if( ! $used_curl) {
        $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
        $header .= "Host: www." . $sandbox . "paypal.com\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

        if($fp = fsockopen('www.paypal.com', 80, $errno, $errstr, 15)) {
            socket_set_timeout($fp, 15);
            fwrite($fp, $header . $req);

            while( ! feof($fp)) {
                $result = fgets($fp, 1024);
                if(strcmp($result, 'VERIFIED') == 0)
                    break;
            }

            fclose($fp);
        }
    }

    if($result == 'VERIFIED' && strtolower($receiver_email) == strtolower($plugin_data->paypal_merchant_id)) {
        $user = User::find($user_id);

        if(
            in_array($txn_type, array('web_accept', 'subscr_payment')) &&
            in_array($payment_amount, array($plugin_data->monthly_price, $plugin_data->yearly_price)) &&
            $payment_currency == 'USD' &&
            $payment_status == 'Completed'
        ) {
            $user->role = 'subscriber';

            if($payment_amount == $plugin_data->yearly_price)
                $user->setSubscriptionEndDate(Carbon::now()->addYear());
            else
                $user->setSubscriptionEndDate(Carbon::now()->addMonth());
        }
        elseif($payment_status == 'Reversed' || $payment_status == 'Refunded') {
            $user->setSubscriptionEndDate(Carbon::now());
        }

        $user->save();
    }
});