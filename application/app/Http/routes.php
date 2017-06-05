<?php


Route::group(array('before' => 'if_logged_in_must_be_subscribed'), function(){

	/*
	|--------------------------------------------------------------------------
	| Home Page Routes
	|--------------------------------------------------------------------------
	*/

		Route::get('/', 'ThemeHomeController@index');
		//Route::get('/', 'ThemeHomeController@slider_view');

	/*
	|--------------------------------------------------------------------------
	| Video Page Routes
	|--------------------------------------------------------------------------
	*/

		Route::get('videos', array('uses' => 'ThemeVideoController@videos', 'as' => 'videos') );
		Route::get('add-video', array('uses' => 'ThemeVideoController@create_video', 'as' => 'create_video') );
		Route::post('store-video', array('uses' => 'ThemeVideoController@store_video', 'as' => 'store_video') );
		Route::post('video_upload', array('uses' => 'ThemeVideoController@video_upload', 'as' => 'video_upload') );
		Route::get('success_message', array('uses' => 'ThemeVideoController@success_message', 'as' => 'success_message') );
		Route::get('error_message', array('uses' => 'ThemeVideoController@error_message', 'as' => 'error_message') );
		Route::get('my-videos', array('uses' => 'ThemeVideoController@user_videos', 'as' => 'user_videos') );
		Route::get('videos/category/{category}', 'ThemeVideoController@category' );
		Route::get('videos/tag/{tag}', 'ThemeVideoController@tag' );
		Route::get('video/{id}', 'ThemeVideoController@index');
		Route::get('videos/edit/{id}', 'ThemeVideoController@edit');
		Route::post('videos/update', 'ThemeVideoController@update');
		Route::get('videos/delete/{id}', array('before' => 'demo', 'uses' => 'ThemeVideoController@destroy'));
		Route::get('donate-now', 'ThemeVideoController@donatenow');

	/*
	
	
	/*
	|--------------------------------------------------------------------------
	| Paypal Page Routes
	|--------------------------------------------------------------------------
	*/
	//Route::post('paypal', 'ThemePaypalController@paypal');
	
	/*
	
	
	
	|--------------------------------------------------------------------------
	| Favorite Routes
	|--------------------------------------------------------------------------
	*/

		Route::post('favorite', 'ThemeFavoriteController@favorite');
		Route::get('favorites', 'ThemeFavoriteController@show_favorites');


	/*
	|--------------------------------------------------------------------------
	| Post Page Routes
	|--------------------------------------------------------------------------
	*/
		
		Route::get( 'posts', array('uses' => 'ThemePostController@posts', 'as' => 'posts') );
		Route::get( 'posts/category/{category}', 'ThemePostController@category' );
		Route::get( 'post/{slug}', 'ThemePostController@index' );
		

	/*
	|--------------------------------------------------------------------------
	| Page Routes
	|--------------------------------------------------------------------------
	*/

		Route::get('pages', 'ThemePageController@pages');
		Route::get('about', 'ThemePageController@about');
		Route::get('page/{slug}', 'ThemePageController@index');


	/*
	|--------------------------------------------------------------------------
	| Search Routes
	|--------------------------------------------------------------------------
	*/

		Route::get('search', 'ThemeSearchController@index');

	/*
	|--------------------------------------------------------------------------
	| Auth and Password Reset Routes
	|--------------------------------------------------------------------------
	*/

		Route::get('login', 'ThemeAuthController@login_form');
		Route::get('signup', 'ThemeAuthController@signup_form');
		Route::post('login', 'ThemeAuthController@login');
		Route::post('signup', 'ThemeAuthController@signup');
		Route::any('contact', 'ThemePageController@contact');
		Route::get('facebook/{fb_id}', 'ThemeUserController@facebook');
		Route::get('facebook', 'ThemeUserController@fb');
		Route::get('fb-pages', 'ThemeUserController@fb_pages');
		Route::get('fb-pages/add', 'ThemeUserController@add_fb');
		Route::any('login_with_fb', 'ThemeUserController@login_with_fb');
		Route::post('facebook/postUpdate', 'ThemeUserController@postUpdate');
		Route::post('facebook/postDelete', 'ThemeUserController@postDelete');
		//Route::post('facebook/postUpdate', 'ThemeUserController@postUpdate');
		Route::get('youtube_accounts', 'ThemeUserController@youtube_accounts');
		Route::get('social-accounts', 'ThemeUserController@social_accounts');
		Route::get('login_with_google', 'ThemeUserController@login_with_google');
		Route::get('channels', 'ThemeUserController@channels');
		Route::get('channels/{id}/{yt_user}', 'ThemeUserController@channels_view');
		Route::get('tellyvizion-analytics', 'ThemeUserController@tellyvizion_analytics');
		Route::post('youtube_accounts/ajax_action_item', 'ThemeUserController@ajax_action_item');
		Route::post('youtube_accounts/ajax_action_multiple', 'ThemeUserController@ajax_action_multiple');

		Route::post('ajax_postschart', 'ThemeUserController@ajax_postschart');
		Route::post('ajax_reachchart', 'ThemeUserController@ajax_reachchart');
		Route::post('ajax_tabchart', 'ThemeUserController@ajax_tabchart');
		Route::post('ajax_fanschart', 'ThemeUserController@ajax_fanschart');
		Route::post('ajax_likeschart', 'ThemeUserController@ajax_likeschart');
		Route::post('ajax_genderchart', 'ThemeUserController@ajax_genderchart');
		Route::post('ajax_countrychart', 'ThemeUserController@ajax_countrychart');
		Route::post('ajax_citychart', 'ThemeUserController@ajax_citychart');
		Route::post('ajax_sourcechart', 'ThemeUserController@ajax_sourcechart');
		Route::any('post-to-fb', 'ThemeUserController@post_to_fb');
		Route::any('post-to-youtube', 'ThemeUserController@post_to_youtube');
		Route::post('like_video', 'ThemeUserController@like_video');
		Route::post('dislike_video', 'ThemeUserController@dislike_video');

		Route::post('youtube_analytics/google_ajax_viewchart', 'ThemeUserController@google_ajax_viewchart');
		Route::post('youtube_analytics/google_ajax_revenuechart', 'ThemeUserController@google_ajax_revenuechart');
		Route::post('youtube_analytics/google_ajax_watchchart', 'ThemeUserController@google_ajax_watchchart');
		Route::post('youtube_analytics/google_ajax_engagementchart', 'ThemeUserController@google_ajax_engagementchart');
		Route::post('youtube_analytics/google_ajax_countrychart', 'ThemeUserController@google_ajax_countrychart');
		Route::post('youtube_analytics/google_ajax_genderchart', 'ThemeUserController@google_ajax_genderchart');
		Route::post('youtube_analytics/google_ajax_annotationschart', 'ThemeUserController@google_ajax_annotationschart');
		Route::post('youtube_analytics/google_ajax_devicechart', 'ThemeUserController@google_ajax_devicechart');
		
		Route::post('tellyvizion_ajax_viewchart', 'ThemeUserController@tellyvizion_ajax_viewchart');
		Route::post('tellyvizion_ajax_revenuechart', 'ThemeUserController@tellyvizion_ajax_revenuechart');
		Route::post('tellyvizion_ajax_watchchart', 'ThemeUserController@tellyvizion_ajax_watchchart');
		Route::post('tellyvizion_ajax_engagementchart', 'ThemeUserController@tellyvizion_ajax_engagementchart');
		Route::post('tellyvizion_ajax_countrychart', 'ThemeUserController@tellyvizion_ajax_countrychart');
		Route::post('tellyvizion_ajax_genderchart', 'ThemeUserController@tellyvizion_ajax_genderchart');
		Route::post('tellyvizion_ajax_annotationschart', 'ThemeUserController@tellyvizion_ajax_annotationschart');
		Route::post('tellyvizion_ajax_devicechart', 'ThemeUserController@tellyvizion_ajax_devicechart');
		
		
		
		// dailymotion views start
		Route::get('dailymotion-analytics', 'DailymotionController@dailymotion_analytics');
		Route::post('dailymotion_ajax_viewchart', 'DailymotionController@dailymotion_ajax_viewchart');
		Route::post('dailymotion_ajax_revenuechart', 'DailymotionController@dailymotion_ajax_revenuechart');
		Route::post('dailymotion_ajax_watchchart', 'DailymotionController@dailymotion_ajax_watchchart');
		Route::post('dailymotion_ajax_engagementchart', 'DailymotionController@dailymotion_ajax_engagementchart');
		Route::post('dailymotion_ajax_countrychart', 'DailymotionController@dailymotion_ajax_countrychart');
		Route::post('dailymotion_ajax_genderchart', 'DailymotionController@dailymotion_ajax_genderchart');
		Route::post('dailymotion_ajax_annotationschart', 'DailymotionController@dailymotion_ajax_annotationschart');
		Route::post('dailymotion_ajax_devicechart', 'DailymotionController@dailymotion_ajax_devicechart');
		Route::any('dailymotion_save_user', 'DailymotionController@dailymotion_save_user');
		Route::any('dailymotion_analytics_deleteuser/{id}', 'DailymotionController@dailymotion_analytics_deleteuser');
		Route::post('post-to-dailymotion', 'DailymotionController@post_to_dailymotion');
		
		// dailymotion views end

		Route::get('password/reset', array('before' => 'demo', 'uses' => 'ThemeAuthController@password_reset', 'as' => 'password.remind'));
		Route::post('password/reset', array('before' => 'demo', 'uses' => 'ThemeAuthController@password_request', 'as' => 'password.request'));
		Route::get('password/reset/{token}', array('before' => 'demo', 'uses' => 'ThemeAuthController@password_reset_token', 'as' => 'password.reset'));
		Route::post('password/reset/{token}', array('before' => 'demo', 'uses' => 'ThemeAuthController@password_reset_post', 'as' => 'password.update'));

		Route::get('verify/{activation_code}', 'ThemeAuthController@verify');

	/*
	|--------------------------------------------------------------------------
	| User and User Edit Routes
	|--------------------------------------------------------------------------
	*/

		Route::get('user/{username}', 'ThemeUserController@index');
		Route::post('user/save_reposition', 'ThemeUserController@save_reposition');
		Route::get('user/{username}/edit', 'ThemeUserController@edit');
		Route::get('youtube-share', 'ThemeUserController@youtube_share');
		Route::post('user/{username}/update', array('before' => 'demo', 'uses' => 'ThemeUserController@update'));
		Route::get('user/{username}/billing', array('before' => 'demo', 'uses' => 'ThemeUserController@billing'));
		Route::get('user/{username}/cancel', array('before' => 'demo', 'uses' => 'ThemeUserController@cancel_account'));
		Route::get('user/{username}/resume', array('before' => 'demo', 'uses' => 'ThemeUserController@resume_account'));
		Route::get('user/{username}/update_cc', 'ThemeUserController@update_cc');
		Route::get('account-settings/',  'ThemeUserController@deactivate_user');
		Route::any('account-settings/{id}/deactivated_user',  array('before' => 'demo', 'uses' => 'ThemeUserController@deactivated_user'));
		//Route::get('account-settings', array('uses' => 'ThemeVideoController@account_settings', 'as' => 'account_settings') );

}); // End if_logged_in_must_be_subscribed route

Route::get('user/{username}/renew_subscription', 'ThemeUserController@renew');
Route::post('user/{username}/update_cc', array('before' => 'demo', 'uses' => 'ThemeUserController@update_cc_store'));

Route::get('user/{username}/upgrade_subscription', 'ThemeUserController@upgrade');
Route::post('user/{username}/upgrade_cc', array('before' => 'demo', 'uses' => 'ThemeUserController@upgrade_cc_store'));

Route::any('user/{username}/support_artist', 'ThemeUserController@support_artist');
Route::post('user/{username}/paynow', 'ThemeUserController@paynow');

Route::get('logout', 'ThemeAuthController@logout');

Route::get('upgrade', 'UpgradeController@upgrade');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

	Route::group(array('before' => 'admin'), function(){
		
		// Admin Dashboard
		Route::get('admin', 'AdminController@index');

		// Admin Video Functionality
		Route::get('admin/videos', 'AdminVideosController@index');
		Route::get('admin/videos/edit/{id}', 'AdminVideosController@edit');
		Route::post('admin/videos/update', array('before' => 'demo', 'uses' => 'AdminVideosController@update'));
		Route::get('admin/videos/delete/{id}', array('before' => 'demo', 'uses' => 'AdminVideosController@destroy'));
		Route::get('admin/videos/update_status/{id}', array('before' => 'demo', 'uses' => 'AdminVideosController@update_status'));
		Route::get('admin/videos/create', 'AdminVideosController@create');
		Route::post('admin/videos/store', array('before' => 'demo', 'uses' => 'AdminVideosController@store'));
		Route::get('admin/videos/categories', 'AdminVideoCategoriesController@index');
		Route::post('admin/videos/categories/store', array('before' => 'demo', 'uses' => 'AdminVideoCategoriesController@store'));
		Route::post('admin/videos/categories/order', array('before' => 'demo', 'uses' => 'AdminVideoCategoriesController@order'));
		Route::get('admin/videos/categories/edit/{id}', 'AdminVideoCategoriesController@edit');
		Route::post('admin/videos/categories/update', array('before' => 'demo', 'uses' => 'AdminVideoCategoriesController@update'));
		Route::get('admin/videos/categories/delete/{id}', array('before' => 'demo', 'uses' => 'AdminVideoCategoriesController@destroy'));

		Route::get('admin/posts', 'AdminPostController@index');
		Route::get('admin/posts/create', 'AdminPostController@create');
		Route::post('admin/posts/store', array('before' => 'demo', 'uses' => 'AdminPostController@store'));
		Route::get('admin/posts/edit/{id}', 'AdminPostController@edit');
		Route::post('admin/posts/update', array('before' => 'demo', 'uses' => 'AdminPostController@update'));
		Route::get('admin/posts/delete/{id}', array('before' => 'demo', 'uses' => 'AdminPostController@destroy'));
		Route::get('admin/posts/categories', 'AdminPostCategoriesController@index');
		Route::post('admin/posts/categories/store', array('before' => 'demo', 'uses' => 'AdminPostCategoriesController@store'));
		Route::post('admin/posts/categories/order', array('before' => 'demo', 'uses' => 'AdminPostCategoriesController@order'));
		Route::get('admin/posts/categories/edit/{id}', 'AdminPostCategoriesController@edit');
		Route::get('admin/posts/categories/delete/{id}', array('before' => 'demo', 'uses' => 'AdminPostCategoriesController@destroy'));
		Route::post('admin/posts/categories/update', array('before' => 'demo', 'uses' => 'AdminPostCategoriesController@update'));

		Route::get('admin/pages', 'AdminPageController@index');
		Route::get('admin/pages/create', 'AdminPageController@create');
		Route::post('admin/pages/store', array('before' => 'demo', 'uses' => 'AdminPageController@store'));
		Route::get('admin/pages/edit/{id}', 'AdminPageController@edit');
		Route::post('admin/pages/update', array('before' => 'demo', 'uses' => 'AdminPageController@update'));
		Route::get('admin/pages/delete/{id}', array('before' => 'demo', 'uses' => 'AdminPageController@destroy'));
		

		Route::get('admin/users', 'AdminUsersController@index');
		Route::get('admin/user/create', 'AdminUsersController@create');
		Route::post('admin/user/store', array('before' => 'demo', 'uses' => 'AdminUsersController@store'));
		Route::get('admin/user/edit/{id}', 'AdminUsersController@edit');
		Route::post('admin/user/update', array('before' => 'demo', 'uses' => 'AdminUsersController@update'));
		Route::get('admin/user/delete/{id}', array('before' => 'demo', 'uses' => 'AdminUsersController@destroy'));

		Route::get('admin/menu', 'AdminMenuController@index');
		Route::post('admin/menu/store', array('before' => 'demo', 'uses' => 'AdminMenuController@store'));
		Route::get('admin/menu/edit/{id}', 'AdminMenuController@edit');
		Route::post('admin/menu/update', array('before' => 'demo', 'uses' => 'AdminMenuController@update'));
		Route::post('admin/menu/order', array('before' => 'demo', 'uses' => 'AdminMenuController@order'));
		Route::get('admin/menu/delete/{id}', array('before' => 'demo', 'uses' => 'AdminMenuController@destroy'));

		Route::get('admin/plugins', 'AdminPluginsController@index');
		Route::get('admin/plugin/deactivate/{plugin_name}', 'AdminPluginsController@deactivate');
		Route::get('admin/plugin/activate/{plugin_name}', 'AdminPluginsController@activate');

		Route::get('admin/themes', 'AdminThemesController@index');
		Route::get('admin/theme/activate/{slug}', array('before' => 'demo', 'uses' => 'AdminThemesController@activate'));

		Route::get('admin/settings', 'AdminSettingsController@index');
		Route::post('admin/settings', array('before' => 'demo', 'uses' => 'AdminSettingsController@save_settings'));

		Route::get('admin/payment_settings', 'AdminPaymentSettingsController@index');
		Route::post('admin/payment_settings', array('before' => 'demo', 'uses' => 'AdminPaymentSettingsController@save_payment_settings'));

		Route::get('admin/theme_settings_form', 'AdminThemeSettingsController@theme_settings_form');
		Route::get('admin/theme_settings', 'AdminThemeSettingsController@theme_settings');
		Route::post('admin/theme_settings', array('before' => 'demo', 'uses' => 'AdminThemeSettingsController@update_theme_settings'));
	});

/*
|--------------------------------------------------------------------------
| Payment Webhooks
|--------------------------------------------------------------------------
*/

	Route::post('stripe/webhook', 'Laravel\Cashier\WebhookController@handleWebhook');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

/*Route::get('test', function(){
	echo Illuminate\Support\Str::random(32);
});*/
Route::any('test', 'TestController@index');
Route::group(array('prefix' => 'api/v1'), function()
{
    Route::get('/', 'Api\v1\ApiController@index');

    Route::get('videos', 'Api\v1\VideoController@index');
    Route::get('video/{id}', 'Api\v1\VideoController@video');
    Route::get('video_categories', 'Api\v1\VideoController@video_categories');
    Route::get('video_category/{id}', 'Api\v1\VideoController@video_category');

    Route::get('posts', 'Api\v1\PostController@index');
    Route::get('post/{id}', 'Api\v1\PostController@post');
    Route::get('post_categories', 'Api\v1\PostController@post_categories');
    Route::get('post_category/{id}', 'Api\v1\PostController@post_category');
});


