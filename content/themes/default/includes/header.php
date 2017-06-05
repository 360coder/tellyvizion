<!DOCTYPE html>
<html>
<head>
	
    <?php include('head.php'); ?>
    <style type="text/css">
         #placement-bottom {display: none!important;}
    </style>
    

</head>
<body <?php if(Request::is('/')) echo 'class="home"'; ?>>

<nav class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="">
        
            <div class="navbar-header">
              <!-- <a id="nav-toggle" href="#"><span></span></a> -->

              <?php $logo = (!empty($settings->logo)) ? Config::get('site.uploads_dir') . 'settings/' . $settings->logo : THEME_URL . '/assets/img/logo.png'; ?>
              <a href="<?=url()?>/" class="navbar-brand"><img src="<?= $logo ?>" /></a>
            </div>


            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav navbar-left">
                    <!-- <li><a href="<?=url()?>/videos"><i class="hv-video"></i> Videos</a> / </li> -->
                  

<!-- Example single danger button -->
<div class="btn-group menu-top-header">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <img src="/content/uploads//images/march2017/home-ham.png"><span>Browse </span><i class="fa fa-angle-down" aria-hidden="true"></i>
  </button>
  <div class="dropdown-menu">
  <div class="part-nav1">

    <a class="dropdown-item" href="<?=url()?>">Home</a>
	<?php if(Auth::guest()): ?>
    <a class="dropdown-item" href="<?= ($settings->enable_https) ? secure_url('login') : URL::to('login') ?>">Dashboard</a>
	<?php else: ?>
	
    <a class="dropdown-item" href="<?= ($settings->enable_https) ? secure_url('user') : URL::to('user') ?><?= '/' . Auth::user()->username; ?>">Dashboard</a>
     <?php endif; ?>
	<a class="dropdown-item" href="#">Tip Jar</a>
    <a class="dropdown-item inactive" href="#">Community</a>
    <a class="dropdown-item inactive" href="#">Portfolio</a>

    <a class="dropdown-item" href="#">How to watch</a>
  </div>
  <div class="part-nav2">
  <div>
  <h3><a href="<?=url()?>/videos/category/film">Film : </a></h3>
  <ul>
      <li><a class="dropdown-item" href="<?=url()?>/videos/category/feature-length">Feature-length</a></li>
      <li><a class="dropdown-item" href="<?=url()?>/videos/category/short">Short</a></li>
      <li><a class="dropdown-item" href="<?=url()?>/videos/category/documentary">Documentary</a></li>
      <li><a class="dropdown-item" href="<?=url()?>/videos/category/web-series">Web Series</a></li>
      <li><a class="dropdown-item" href="<?=url()?>/videos/category/independent">Independent</a></li>
      <li><a class="dropdown-item" href="<?=url()?>/videos/category/animation">Animation</a></li>

  </ul>
  </div>
    <div>
  <h3><a href="<?=url()?>/videos/category/theatre"> Theatre : </h3>
  <ul>
      <li><a class="dropdown-item" href="<?=url()?>/videos/category/plays">Plays</a></li>
      <li><a class="dropdown-item" href="<?=url()?>/videos/category/musicals">Musicals</a></li>
  </ul>
  </div>

  <div>
  <h3><a href="<?=url()?>/videos/category/tv"> TV : </a></h3>
  <ul>
      <li><a class="dropdown-item" href="<?=url()?>/videos/category/talk-show">Talk Show</a></li>
      <li><a class="dropdown-item" href="<?=url()?>/videos/category/variety">Variety</a></li>
      <li><a class="dropdown-item" href="<?=url()?>/videos/category/episodic">Episodic</a></li>

  </ul>
  </div>
   
   </div>
  <div  class="part-nav3">
   <div>
  <h3><a href="<?=url()?>/videos/category/comedy"> Comedy : </a></h3>
  <ul>
      <li><a class="dropdown-item" href="<?=url()?>/videos/category/stand-up">Stand Up</a></li>
      <li><a class="dropdown-item" href="<?=url()?>/videos/category/skit-sketch">Skit/Sketch</a></li>
  </ul>

  </div>
   <div>
  <h3><a href="<?=url()?>/videos/category/music"> Music/Dance : </a></h3>
  <ul>
      <li><a class="dropdown-item" href="<?=url()?>/videos/category/music-videos">Music Videos</a></li>
      <li><a class="dropdown-item" href="<?=url()?>/videos/category/cabaret">Cabaret</a></li>
      <li><a class="dropdown-item" href="<?=url()?>/videos/category/performances">Performances</a></li>

  </ul>
  
  </div>
    <a class="dropdown-item" href="<?=url()?>/videos/category/kids-family">Kids & Family</a>
    <a class="dropdown-item" href="<?=url()?>/videos/category/trailers">Trailers</a>
    <a class="dropdown-item" href="<?=url()?>/videos/category/educational">Educational</a>
    <a class="dropdown-item text-align-right" href="<?=url()?>/page/faq">Help</a>
  </div>
  </div>
</div>


<div id="navbar-search-form">
                        <form role="search" action="<?=url()?>/search" method="GET">
                            <a href="#search"><img src="/content/uploads//images/march2017/icon-search-header.png"></a>
                           <div id="search" class="">
                            <button type="button" class="close">×</button>
                                <input name="value" value="" placeholder="type keyword(s) here" type="search">
                                <button type="submit" class="btn btn-primary">Search</button>
                        </div>

                           
                        </form>
                    </div>
                    <!-- <li class="nav-header-right-browse"><a href="#">Browse <i class="fa fa-angle-down" aria-hidden="true"></i></a></li> -->
                    <!-- <li><a href="<?=url()?>/posts"><i class="hv-book"></i> Articles</a></li> -->
                   
                </ul>
                

                <ul class="nav navbar-nav navbar-right">
                    
                    <?php if(Auth::guest()): ?>

                      <li id="login-section" class="signup-header"><a href="#">Sign In</a></li>
                        
                       <!--  <li id="nav-toggle12" class="login-desktop"><a href="<?=url()?>/login"> Sign In</a></li> -->
                        <li id="nav-toggle11" class="signup-desktop" type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo" ><a href="#"> Sign Up</a></li>
             <?php include($_SERVER['DOCUMENT_ROOT']."/content/themes/default/partials/signup.php"); ?>
             <div id="login-form" class="row">
            
              <form method="post" action="<?= ($settings->enable_https) ? secure_url('login') : URL::to('login') ?>" class="form-signin">
              <div>
               <p class="main-circle"><span class="two-circle"><img src="<?=THEME_URL?>/assets/img/img-1.png"></span></p>
        <input type="text" class="form-control" placeholder="Email address or Username" tabindex="0" id="email" name="email" value="<?php if($settings->demo_mode == 1): ?>demo<?php endif; ?>">
        <input type="password" class="form-control" placeholder="Password" id="password" name="password" value="<?php if($settings->demo_mode == 1): ?>demo<?php endif; ?>">
       
              <input type="hidden" id="redirect" name="redirect" value="<?= Input::get('redirect') ?>" />
        <div class="checkbox">
    <label><input type="checkbox"> Remember me</label>
  </div>
        <a href="<?= ($settings->enable_https) ? secure_url('password/reset') : URL::to('password/reset') ?>">Forgot my id / password</a>
        <br/> <br/>
         <button class="btn btn-lg btn-primary btn-block" type="submit">LOG IN</button>
         <p class="sign-in12">or sign in with</p>
         <ul class="social-signin">
           <li><a href="<?=LOGIN_WITH_FB()?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
           <!--<li><a href="https://twitter.com/@tellyvizion" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>-->
           <li><a href="<?=G_Login()?>"><i class="fa fa-google-plus" aria-hidden="true"></i>
</a></li>

         </ul>
    
      <input type="hidden" name="_token" value="<?= csrf_token() ?>" />
      </div>
    </form>
             </div>

                    <?php else: ?>
                        
                        <li class="dropdown admin-mobile-style1">
                            <a href="#_" class="user-link-desktop dropdown-toggle" data-toggle="dropdown"><img src="<?= Config::get('site.uploads_dir') . 'avatars/' . Auth::user()->avatar ?>" class="img-circle" /> <?= ucwords(Auth::user()->username) ?> <i class="fa fa-chevron-down"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?= ($settings->enable_https) ? secure_url('user') : URL::to('user') ?><?= '/' . Auth::user()->username; ?>">My Profile</a></li>
                                <li><a href="<?=url()?>/social-accounts">Dashboard</a></li>
                                <li><a href="<?= ($settings->enable_https) ? secure_url('favorites') : URL::to('favorites') ?>">My Favorites</a></li>
                                <li><a href="<?= ($settings->enable_https) ? secure_url('my-videos') : URL::to('my-videos') ?>">My Videos</a></li>
                                <!--<li><a href="<?//= ($settings->enable_https) ? secure_url('account-settings') : URL::to('account-settings') ?>">Account Settings</a></li>-->
                                <?php if(Auth::user()->role == 'admin' || Auth::user()->role == 'demo'): ?>
                                    <li class="divider"></li>
                                    <li><a href="<?= ($settings->enable_https) ? secure_url('admin') : URL::to('admin') ?>"> Settings </a></li>
                                <?php endif; ?>
                                <li class="divider"></li>
                                <li><a href="<?= ($settings->enable_https) ? secure_url('logout') : URL::to('logout') ?>" id="user_logout_mobile"><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>
                        </li>
                        
                    <?php endif; ?>
                    
                </ul>



                <div class="right-tip-header">
                 <ul>
                     
                 </ul>
             </div>

                <!--form class="navbar-form navbar-right search" role="search"><div class="form-search search-only"><i class="fa fa-search"></i> <input class="form-control search-query" placeholder="search..."></div></form-->

            </div>

         </div>

      </div>
    </nav>
    
    <div class="clear"></div>
    <nav class="navbar navbar-default navbar-static-top second-nav">
        <div class="container">
            
            
            <div id="mobile-subnav"><i class="fa fa-bars"></i> Open Submenu</div>
            <ul class="navbar-right">
                <li>
                    <div id="navbar-search-form">
                        <form role="search" action="<?=url()?>/search" method="GET">
                            <i class="fa fa-search"></i>
                            <input type="text" id="value" name="value" placeholder="Search...">

                           
                        </form>
                    </div>
                </li>
            </ul>
            <div class="row main-nav-row">
                <?php include('menu.php'); ?>
            </div>
        </div>
    </nav>