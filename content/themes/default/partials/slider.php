 <!-- Full Page Image Background Carousel Header -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
		<?php 
		$active = 'active';
		$data_slide = 0;
		foreach ($slider as $sliders) { ?>
            <img src="<?= ImageHandler::getImage($sliders->image)  ?>" data-target="#myCarousel" data-slide-to="<?=$data_slide?>" class="<?=$active?>">
            <!--<img src="<?//= THEME_URL ?>/assets/img/home/2.png" data-target="#myCarousel" data-slide-to="1">
            <img src="<?//= THEME_URL ?>/assets/img/home/3.jpg" data-target="#myCarousel" data-slide-to="2">
            <img src="<?//= THEME_URL ?>/assets/img/home/6.png" data-target="#myCarousel" data-slide-to="3">
            <img src="<?//= THEME_URL ?>/assets/img/home/5.png" data-target="#myCarousel" data-slide-to="4">-->

		<?php $active = ''; ++$data_slide; } ?>
        </ol>
        <!-- Wrapper for Slides -->
		
		
		
		
		<?php //echo "<pre>"; print_r(getYouTubeVideoId($slider->embed_code)); echo "</pre>"; ?>
        <div class="carousel-inner">
		<?php 
		$active = 'active';
		foreach ($slider as $slides) { ?>
            <div class="item <?=$active?>">
                <div class="fill" style="background-image:url('<?= ImageHandler::getImage($slides->image)  ?>');">
                <!--<div class="fill">
               <img src="<?= ImageHandler::getImage($slides->image)  ?>" class="img-responsive">-->
               <!--  <a href="#">Watch now <i class="fa fa-caret-right" aria-hidden="true"></i></a> -->

                </div>
                <div class="carousel-caption">
                
                    <span><?php if(strlen($slides->description) > 90){ echo substr($slides->description, 0, 90) . '...'; } else { echo $slides->description; } ?></span>
                    <?php 
					//$originalString = $slides->embed_code;
					//$embed_code = preg_replace('/<iframe.*?\/iframe>/i','', $originalString);
					?>
					
					<a href="<?= url().'/video/'.$slides->id ?>">Watch now <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                    <h3><?php if(strlen($slides->title) > 17){ echo substr($slides->title, 0, 17) . '...'; } else { echo $slides->title; } ?></h3>
                    <!--<span>Stars: Quvenzhane Wallis, Dwight Henry</span>-->
                    
                </div>
            </div>
			 <?php $active = ''; } ?>
            <!--<div class="item">
                <div class="fill" style="background-image:url('<?= THEME_URL ?>/assets/img/home/2.png');">
                 
                    
                </div>

                <div class="carousel-caption">
                
                    
                    <span>She’s funny. Fearless. Full of questions. And there’s no<br/>telling how she will find her way in a Big Apple…</span>
                    <a href="#">Watch now <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                    <h3>NEW YORK STORY</h3>
                    <span>Stars: Quvenzhane Wallis, Dwight Henry</span>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('<?= THEME_URL ?>/assets/img/home/3.jpg');"><h2>Independent Art <br>Channel</h2>
                    
                </div>
                
                <div class="carousel-caption">
                
                   
                    <span>She’s funny. Fearless. Full of questions. And there’s no<br/>telling how she will find her way in a Big Apple…</span>
                    <a href="#">Watch now <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                    <h3>NEW YORK STORY</h3>
                    <span>Stars: Quvenzhane Wallis, Dwight Henry</span>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('<?= THEME_URL ?>/assets/img/home/6.png');">
            
                </div>
                
                <div class="carousel-caption">
                
                 
                    <span>She’s funny. Fearless. Full of questions. And there’s no<br/>telling how she will find her way in a Big Apple…</span>
                    <a href="#">Watch now <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                    <h3>NEW YORK STORY</h3>
                    <span>Stars: Quvenzhane Wallis, Dwight Henry</span>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('<?= THEME_URL ?>/assets/img/home/5.png');"><h2>Independent Art <br/>Channel</h2>
             
                </div>
                
                <div class="carousel-caption">

                   
                    <span>She’s funny. Fearless. Full of questions. And there’s no<br/>telling how she will find her way in a Big Apple…</span>
                    <a href="#">Watch now <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                    <h3>NEW YORK STORY</h3>
                    <span>Stars: Quvenzhane Wallis, Dwight Henry</span>
                </div>
            </div>-->
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
		
    </header>
