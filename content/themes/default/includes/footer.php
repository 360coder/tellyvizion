	
	<footer>
	<div class="footer-top">
	<div class="container">
	<div class="row">
			<div class="col-lg-2">
			<span>On Our Blog</span>
			</div>
			<div class="col-lg-8">
			<p>Indy feature film Sugar! secures film and soundtrack distribution<br/>How to book a stand-up comedy job?</p>
			</div>
			<div class="col-lg-2">
			<a href="/page/faq">FAQ</a>
			</div>
			</div>
			</div>
			</div>
		<div class="container">
		
			
		

			<div class="row">
				<!-- <div class="col-md-4">
					<h3><?php echo $settings->website_name; ?></h3>
					<p><?= ThemeHelper::getThemeSetting(@$theme_settings->footer_description, 'HelloVideo is your Video Subscription Platform. Add unlimited videos, posts, and pages to your subscription site. Earn re-curring revenue and require users to subscribe to access premium content on your website.') ?></p>
					<a href="http://facebook.com/<?php echo $settings->facebook_page_id; ?>" target="_blank" class="facebook social-link"><i class="fa fa-facebook"></i></a>
					<a href="http://twitter.com/<?php echo $settings->twitter_page_id; ?>" target="_blank" class="twitter social-link"><i class="fa fa-twitter"></i></a>
					<a href="http://plus.google.com/<?php echo $settings->google_page_id; ?>" target="_blank" class="google social-link"><i class="fa fa-google-plus"></i></a>
					<a href="http://youtube.com/<?php echo $settings->youtube_page_id; ?>" target="_blank" class="youtube social-link"><i class="fa fa-youtube"></i></a>
					<div class="clear"></div>
				</div> -->
				<div class="col-md-4">
					<h4>Learn About Tellyvizion</h3>
					<ul>
						<?php foreach($video_categories as $category): ?>
							<!--li><a href="<?= ($settings->enable_https) ? secure_url('videos/category') : URL::to('videos/category'); ?><?= '/' . $category->slug; ?>"><?= $category->name; ?></a></li-->
						<?php endforeach; ?>
						<li><a href="/page/telly">What is Tellyvizion?</a></li>
						<li><a href="/about">About Us</a></li>						
						<li><a href="/page/terms">Terms & Conditions</a></li>
						<li><a href="/page/privacy">Privacy Policy</a></li>
						<li><a href="#">Site Map</a></li>


					</ul>
				</div>
				<div class="col-md-4">
					<h4>Make Money With Tellyvizion</h3>
					<ul>
						<?php foreach($post_categories as $category): ?>
							<!--li><a href="<?= ($settings->enable_https) ? secure_url('posts/category') : URL::to('posts/category'); ?><?= '/' . $category->slug; ?>"><?= $category->name; ?></a></li-->
						<?php endforeach; ?>
						<!-- <li><a href="#">Create Your Account</a></li> -->
						<li><a href="/page/distribute">Distribute your Video</a></li>
						<li><a href="/page/TipJar">Tip Jar</a></li>
						<li><a href="/page/promote">Promote Your Brand</a></li>
						
						
					</ul>
				</div>
				<div class="col-md-4">
					<h4>Got Question?</h3>
					<ul>
						<?php foreach($pages as $page): ?>
							<!--li><a href="<?= ($settings->enable_https) ? secure_url('page') : URL::to('page'); ?><?= '/' . $page->slug ?>"><?= $page->title ?></a></li-->
						<?php endforeach; ?>
						<li><a href="#">Blog</a></li>
						<li><a href="/contact">Contact</a></li>
						<!-- <li><a href="#">Help</a></li> -->
						

					</ul>
					<h4 class="top-less-footer">Get Connected</h4>
					<ul class="social-icon">
						<li><a href="#" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="https://twitter.com/@tellyvizion" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<!-- <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li> -->
						<li><a href="https://www.instagram.com/sam_tellyvizion/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>

					</ul>
				</div>
			</div>

		
			
		</div>
		<div class="footer-bottom">
		<div class="container">
		<div class="col-lg-6">
		<p class="copyright pull-left">Copyright &copy; <?= date('Y'); ?> <?= $settings->website_name; ?></p>
		</div>
		<div class="col-lg-6">
		
			<!-- <ul class="pull-right">
			<h4>Account Services: </h4>
				<li><a href="#">Login </a></li>
				<li><a href="#"> | Contact | </a></li>
				<li><a href="#"> Help</a></li>
			</ul> -->
		</div>
		</div>
		</div>
	</footer>
	</div>
    <script src="<?=THEME_URL?>/assets/js/toastr.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?=THEME_URL?>/assets/css/toast.css">
<script>
		var opts = {
			"closeButton": true,
			"debug": false,
			"positionClass": "toast-top-right",
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		};

		<?php if(Session::get('note') != '' && Session::get('note_type') != ''): ?>
	        
	        if('<?= Session::get("note_type") ?>' == 'success'){
	        	toastr.success('<?= Session::get("note") ?>', "Sweet Success!", opts);
	        } else if('<?= Session::get("note_type") ?>' == 'error'){
	        	toastr.error('<?= Session::get("note") ?>', "Whoops!", opts);
	        }
	        <?php Session::forget('note');
	              Session::forget('note_type');
	        ?>
	    <?php endif; ?>

		
	</script>


    <script src="<?= THEME_URL . '/assets/js/bootstrap.min.js'; ?>"></script>
    <script src="<?= THEME_URL . '/assets/js/moment.min.js'; ?>"></script>
	<script type="text/javascript" src="<?= THEME_URL . '/assets/js/noty/jquery.noty.js'; ?>"></script>
	<script type="text/javascript" src="<?= THEME_URL . '/assets/js/noty/themes/default.js'; ?>"></script>
	<script type="text/javascript" src="<?= THEME_URL . '/assets/js/noty/layouts/top.js'; ?>"></script>

	<script type="text/javascript">
	  
	

	  /********** LOGIN MODAL FUNCTIONALITY **********/

	  var loginSignupModal = $('<div class="modal fade" id="loginSignupModal" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><h4 class="modal-title" id="myModalLabel">Login Below</h4></div><div class="modal-body"></div></div></div></div>');

		$(document).ready(function(){
			
			// Load the Modal Window for login signup when they are clicked
			$('.login-desktop a').click(function(e){
				e.preventDefault();
				$('body').prepend(loginSignupModal);
				$('#loginSignupModal .modal-body').load($(this).attr('href') + '?redirect=' + document.URL + ' .form-signin', function(){
					$('#loginSignupModal').show(200, function(){
						setTimeout(function() { $('#email').focus() }, 300);

						
					});
					$('#loginSignupModal').modal();
					
				});

				// Be sure to remove the modal from the DOM after it is closed
				$('#loginSignupModal').on('hidden.bs.modal', function (e) {
			    	$('#loginSignupModal').remove();
				});

			});

			
			

		});

		/********** END LOGIN MODAL FUNCTIONALITY **********/

	</script>

	<?php if(isset($settings->google_tracking_id)): ?>
	  <script>
	    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	    ga('create', '<?= $settings->google_tracking_id ?>', 'auto');
	    ga('send', 'pageview');

	  </script>
	<?php endif; ?>
 <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
    <link rel="stylesheet" type="text/css" href="<?= THEME_URL . '/assets/css/full-slider.css'?>">
	<script><?= ThemeHelper::getThemeSetting(@$theme_settings->custom_js, '') ?></script>
	<script type="text/javascript">
		$(function () {
    $('a[href="#search"]').on('click', function(event) {
       // event.preventDefault();
        $('#search').addClass('open');
        $('#search > form > input[type="search"]').focus();
    });
    
    $('#search, #search button.close').on('click keyup', function(event) {
        if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
            $(this).removeClass('open');
        }
    });
    
    
    //Do not include! This prevents the form from submitting for DEMO purposes only!
    /*$('form').submit(function(event) {
        event.preventDefault();
        return false;
    })*/
});
	</script>
	<script>
// function openNav() {
//     document.getElementById("mySidenav").style.width = "250px";
//     document.getElementById("main").style.marginLeft = "250px";
// }

// function closeNav() {
//     document.getElementById("mySidenav").style.width = "0";
//     document.getElementById("main").style.marginLeft= "0";
// }
 $('#nav-toggle11').click(function(){
	    	$('#signup-form').toggleClass('active');
	    	$('#login-form').removeClass('active');
});

  $('#login-section').click(function(){
	    	$('#login-form').toggleClass('active');
	    	$('#signup-form').removeClass('active');
});


$('[data-toggle="tooltip"]').tooltip(); 

</script>
<script type="text/javascript">
	 jQuery(document).on('show','.accordion', function (e) {
	 	alert('aaaa');
         //$('.accordion-heading i').toggleClass(' ');
         jQuery(e.target).prev('.accordion-heading').addClass('accordion-opened');
    });
    
    jQuery(document).on('hide','.accordion', function (e) {
        jQuery(this).find('.accordion-heading').not($(e.target)).removeClass('accordion-opened');
        //$('.accordion-heading i').toggleClass('fa-chevron-right fa-chevron-down');
    });
</script>
<script>
       $(document).ready(function(){
    $(".open-dollars").click(function(){
        $(".close-opacity").toggleClass("intro");
    });
});

</script>
<script type="text/javascript">
	$(document).ready(function(){
  $('.slider6').bxSlider({
    slideWidth: 300,
    minSlides: 2,
    maxSlides: 6,
    startSlide: 2,
    slideMargin: 10
  });
});
</script>
<script src="<?= THEME_URL . '/assets/js/jquery.bxslider.min.js'; ?>"></script>
</body>
</html>
