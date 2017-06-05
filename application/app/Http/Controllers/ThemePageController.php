<?php

use \Redirect as Redirect;
use \HelloVideo\User as User;

class ThemePageController extends \BaseController {

    public function __construct()
    {
        $this->middleware('secure');
    }

    /**
     * Display the specified post.
     *
     * @param  int  $id
     * @return Response
     */
    public function index($slug)
    {
        $page = Page::where('slug', '=', $slug)->first();
            
        //Make sure page is active
        if((!Auth::guest() && Auth::user()->role == 'admin') || $page->active){

            $author = User::find($page->user_id);
            $data = array(
                    'page' => $page, 
                    'author' => $author,
                    'menu' => Menu::orderBy('order', 'ASC')->get(),
                    'video_categories' => VideoCategory::all(),
                    'post_categories' => PostCategory::all(),
                    'theme_settings' => ThemeHelper::getThemeSettings(),
                    'pages' => Page::all(),
                );
            return View::make('Theme::page', $data);

        } else {
            return Redirect::to('pages')->with(array('note' => 'Sorry, this page is no longer active.', 'note_type' => 'error'));
        }
    }

    /*
     * Page That shows the latest video list
     *
     */
    public function pages()
    {
        $data = array(
                'pages' => Page::orderBy('created_at', 'DESC')->get(),
                'page_title' => 'Pages',
                'page_description' => 'All Pages',
                'menu' => Menu::orderBy('order', 'ASC')->get(),
                'video_categories' => VideoCategory::all(),
                'post_categories' => PostCategory::all(),
                'theme_settings' => ThemeHelper::getThemeSettings(),
                'pages' => Page::all(),
            );

        return View::make('Theme::page-list', $data);
    }

    public function about()
    {
        $data = array(
                'pages' => Page::orderBy('created_at', 'DESC')->get(),
                'page_title' => 'Pages',
                'page_description' => 'All Pages',
            );

        return View::make('Theme::about', $data);
    }

    public function contact()
    {
        $data = array(
                'pages' => Page::orderBy('created_at', 'DESC')->get(),
                'page_title' => 'Contact',
                'page_description' => 'Contact Form',
        );
        if (Input::get('name')) {
            $name = Input::get('name');
            $phone = Input::get('phone');
            $email_id =  trim(Input::get('email'));
            $tmessage = Input::get('tmessage');
           Mail::send('Theme::emails.contact', array('name' => $name, 'email' => $email_id, 'phone' => $phone, 'tmessage' => $tmessage), function($message) {
                    $message->to('navi.sohal162@gmail.com', $name)->subject('Contact Form');
                    //$message->to($email);
                 });
            return Redirect()->back()->with(array('note' => 'Thanks for contacting with us'));
        }
        return View::make('Theme::contact', $data);
    }

}