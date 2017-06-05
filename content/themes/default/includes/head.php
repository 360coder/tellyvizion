<?php $settings = Setting::first(); ?>
    
<?php if(isset($video->id)): ?>

    <title><?= $video->title; ?></title>
    <meta name="description" content="<?= $video->description ?>">
    

    <?php 
    $keywords = '';

    foreach($video->tags as $tag):
        $keywords .= $tag->name . ', ';
    endforeach;

    $keywords = rtrim($keywords, ', ');
    ?>

    <!-- for Google -->
    <meta name="keywords" content="<?= $keywords ?>" />

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="<?= $video->title ?>">
    <meta itemprop="description" content="<?= $video->description ?>">
    <meta itemprop="image" content="<?= ($settings->enable_https) ? secure_url('/') : URL::to('/') ?><?= ImageHandler::getImage($video->image, 'large')  ?>">

    <!-- for Facebook -->          
    <meta property="og:title" content="<?= $video->title ?>" />
    <meta property="og:type" content="video.other" />
    <meta property="og:image" content="<?= ($settings->enable_https) ? secure_url('/') : URL::to('/') ?><?= ImageHandler::getImage($video->image, 'large')  ?>" />
    <meta property="og:url" content="<?= Request::url(); ?>" />
    <meta property="og:description" content="<?= $video->description ?>" />

    <!-- for Twitter -->          
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="<?= $video->title ?>" />
    <meta name="twitter:description" content="<?= $video->description ?>" />
    <meta name="twitter:image" content="<?= ($settings->enable_https) ? secure_url('/') : URL::to('/') ?><?= ImageHandler::getImage($video->image, 'large')  ?>" />

<?php elseif(isset($post->id)): ?>

    <?php $post_description = preg_replace('/^\s+|\n|\r|\s+$/m', '', strip_tags($post->body)); ?>

    <title><?= $post->title; ?></title>
    <meta name="description" content="<?= $post_description ?>">

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="<?= $post->title ?>">
    <meta itemprop="description" content="<?= $post_description ?>">
    <meta itemprop="image" content="<?= ($settings->enable_https) ? secure_url('/') : URL::to('/') ?><?= ImageHandler::getImage($post->image, 'large')  ?>">

    <!-- for Facebook -->          
    <meta property="og:title" content="<?= $post->title ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:image" content="<?= ($settings->enable_https) ? secure_url('/') : URL::to('/') ?><?= ImageHandler::getImage($post->image, 'large')  ?>" />
    <meta property="og:url" content="<?= Request::url(); ?>" />
    <meta property="og:description" content="<?= $post_description ?>" />

    <!-- for Twitter -->          
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="<?= $post->title ?>" />
    <meta name="twitter:description" content="<?= $post_description ?>" />
    <meta name="twitter:image" content="<?= ($settings->enable_https) ? secure_url('/') : URL::to('/') ?><?= ImageHandler::getImage($post->image, 'large')  ?>" />

<?php elseif(isset($page->id)): ?>

    <title><?= $page->title . '-' . $settings->website_name; ?></title>
    <meta name="description" content="<?= $page->title . '-' . $settings->website_name; ?>">

<?php else: ?>

    <title><?php echo $settings->website_name . ' - ' . $settings->website_description; ?></title>
    <meta name="description" content="<?= $settings->website_description ?>">
    
<?php endif; ?>

<meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1">
<link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> 
<link rel="stylesheet" href="<?= THEME_URL . '/assets/css/bootstrap.min.css'; ?>" />
<link rel="stylesheet" href="<?= THEME_URL . '/assets/css/noty.css'; ?>" />
<link rel="stylesheet" href="<?= THEME_URL . '/assets/css/font-awesome.min.css'; ?>" />

<link href="<?= THEME_URL . '/assets/js/jquery.bxslider.min.css'; ?>" rel="stylesheet">
<link href="<?= THEME_URL . '/assets/js/jquery.bxslider.css'; ?>" rel="stylesheet">
<link rel="stylesheet" href="<?= THEME_URL . '/assets/css/hellovideo-fonts.css'; ?>" />
<?php if(isset($video->id) || isset($episode->id)): ?>

    <link href="<?= THEME_URL . '/assets/css/video-js.css'; ?>" rel="stylesheet">
    

    <script src="<?= THEME_URL . '/assets/js/video.js'; ?>"></script>
    
    

    <style type="text/css">
      .vjs-default-skin .vjs-control-bar,
      .vjs-default-skin .vjs-big-play-button { background: rgba(0,0,0,0.58) }
      .vjs-default-skin .vjs-slider { background: rgba(0,0,0,0.19333333333333333) }
      body #olark-wrapper .olark-top-bar,body #olark-wrapper .olark-launch-button {background-color: #560567!important; border-color: #560567!important;}
      
    </style>
   

<?php endif; ?>

<link rel="stylesheet" href="<?= THEME_URL . '/assets/css/style.css'; ?>" />
<link rel="stylesheet" href="<?= THEME_URL . '/assets/css/rrssb.css'; ?>" />
<link rel="stylesheet" href="<?= THEME_URL . '/assets/css/animate.min.css'; ?>" />
<style type="text/css"><?= dynamic_styles($theme_settings); ?></style>
<style type="text/css"><?= ThemeHelper::getThemeSetting(@$theme_settings->custom_css, '') ?></style>
<link href='//fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>if (!window.jQuery) { document.write('<script src="<?= THEME_URL . '/assets/js/jquery.min.js'; ?>"><\/script>'); }</script>

<?php $favicon = (!empty($settings->favicon)) ? Config::get('site.uploads_dir') . 'settings/' . $settings->favicon : THEME_URL . '/assets/img/favicon.png'; ?>
<link rel="icon" href="<?= $favicon ?>" type="image/x-icon">
<link rel="shortcut icon" href="<?= $favicon ?>" type="image9sx-icon">
<!-- begin olark code -->
<script type="text/javascript" async> ;(function(o,l,a,r,k,y){if(o.olark)return; r="script";y=l.createElement(r);r=l.getElementsByTagName(r)[0]; y.async=1;y.src="//"+a;r.parentNode.insertBefore(y,r); y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)}; y.extend=function(i,j){y("extend",i,j)}; y.identify=function(i){y("identify",k.i=i)}; y.configure=function(i,j){y("configure",i,j);k.c[i]=j}; k=y._={s:[],t:[+new Date],c:{},l:a}; })(window,document,"static.olark.com/jsclient/loader.js");
/* custom configuration goes here (www.olark.com/documentation) */
olark.identify('9171-648-10-1642');</script>
<!-- end olark code -->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-99466143-1', 'auto');
  ga('send', 'pageview');

</script>