<?php include('includes/header.php'); ?>


 <script type="text/javascript">
	like = '<div class="like_video btn btn-default" data-authenticated="<?= !Auth::guest() ?>" data-videoid="<?= $video->id ?>"><i class="fa fa-thumbs-up" aria-hidden="true"></i> <span>(<?=$likes?>)</span></div>';
	dislike = '<div class="dislike_video btn btn-default" data-authenticated="<?= !Auth::guest() ?>" data-videoid="<?= $video->id ?>"><i class="fa fa-thumbs-down" aria-hidden="true"></i> <span>(<?=$dislike?>)</span></div>';
	favorite = '<div class="favorite btn btn-default <?php if(isset($favorited->id)): ?>active<?php endif; ?>" data-authenticated="<?= !Auth::guest() ?>" data-videoid="<?= $video->id ?>"><i class="fa fa-heart"></i></div>';
	paypal = '<form class="open-dollars" action="<?=url().'/user/'.$user_details->username?>/support_artist" method="post"><span id="amount-select"></span><div class="close-opacity"><input type="hidden" name="amount" value="00.00"><input type="hidden" value="<?=$video->id?>" name="video_id"><input type="image" name="submit" border="0" src="<?=THEME_URL?>/assets/img/send1.png" alt=""><div class="btn-group" data-toggle="buttons"><label class="btn btn-primary donate3" donate3="1"><input type="radio" name="options" id="option1" autocomplete="off" checked> $1 </label><label class="btn btn-primary donate3" donate3="5"><input type="radio" name="options" id="option2" autocomplete="off"> $5 </label><label class="btn btn-primary donate3" donate3="0"><input type="radio" name="options" id="option3" autocomplete="off"> $+ </label></div><div class="amount-choose"><div class="arrow-right"></div><span><input placeholder="choose your amount" class="form-control" id="amount_actual" name="amount_actual" maxlength="5" data-rule-required="true" type="text" contenteditable="false" required></span></div></div></form>'
</script>
  <?php if ($video->details) {
                   $video_description = $video->details;
            }else{
                   $video_description = $video->description;
            }?>
	<!-- <link rel="stylesheet" href="css/elite-font-awesome.css" type="text/css"> -->
	
	<link rel="stylesheet" href="<?= THEME_URL . '/assets/single_video/elite-font-awesome.css'; ?>" type="text/css">
	<link rel="stylesheet" href="<?= THEME_URL . '/assets/single_video/elite.css'; ?>" type="text/css">
	<link rel="stylesheet" href="<?= THEME_URL . '/assets/single_video/jquery.mCustomScrollbar.css'; ?>" type="text/css">
	<script src="<?= THEME_URL . '/assets/single_video/froogaloop.js'; ?>"></script>
	<script src="<?= THEME_URL . '/assets/single_video/jquery.mCustomScrollbar.js'; ?>"></script>
	<script src="<?= THEME_URL . '/assets/single_video/THREEx.FullScreen.js'; ?>"></script>
	<script src="<?= THEME_URL . '/assets/single_video/videoPlayer.js'; ?>"></script>
	<script src="<?= THEME_URL . '/assets/single_video/ZeroClipboard.js'; ?>"></script>
	<script src="<?= THEME_URL . '/assets/single_video/Playlist.js'; ?>" type="text/javascript"></script>

	<!-- <div id="video_title">
		<div class="container">
			<span class="label">You're watching:</span> <h1><?= $video->title ?></h1>
		</div>
	</div> -->		
			
</div>			
<div class="Elite_video_player-parent"><div class="container"><div id="Elite_video_player"></div></div></div>
<div class="video-details">			
<div class="container ">
<div class="col-lg-12">
<h3><?= $video->title ?><span class="view-count"><i class="fa fa-eye"></i> <?php if(isset($view_increment) && $view_increment == true ): ?><?= $video->views + 1 ?><?php else: ?><?= $video->views ?><?php endif; ?> Views </span> </h3></div>
	<div class="col-lg-12">
		<span class="video_user">
					<a href="<?=url()?>/user/<?=$user_details->username?>"><img src="<?= Config::get('site.uploads_url') . 'avatars/' . $user_details->avatar ?>" /></a><div><?=$user_details->username?></div>
			</span>
	</div>

<div class="col-lg-8">
	
				

		<div class="video-details-container"><?= $video->details ?></div>

</div>

<?php// if($_SERVER['REMOTE_ADDR'] == '122.173.67.159') { ?>
<div class="social-media col-lg-4">
<div class="post-to-fb btn btn-default active" data-authenticated="1" data-videoid="137">Post this video to facebook<!-- <i class="fa fa-facebook"></i> --></div>
<div class="post-to-youtube btn btn-default active" data-authenticated="1" data-videoid="137">Post this video to youtube<!-- <i class="fa fa-facebook"></i> --></div>
<div class="post-to-dailymotion btn btn-default active" data-authenticated="1" data-videoid="137">Post this video to dailymotion</div>
</div>
<div class="social-response"></div>
<!-- <form method="post" action="<?=url()?>/post-to-youtube">
	<input type="hidden" name="video_id" value="137">
	<input type="hidden" value="<?= csrf_token(); ?>" name="_token">
	<input type="submit" name="">
</form> -->
<?php //} ?>
		
    
	</div></div></div>

		<div class="tag-section-video">
		<div class="container">
		<h2 id="tags"> 
		<?php foreach($video->tags as $key => $tag): ?>
<?php if(!empty($tag->name)): ?>
			<span><a href="/videos/tag/<?= $tag->name ?>"><?= $tag->name ?></a></span><?php if($key+1 != count($video->tags)): ?><?php endif; ?>
<?php endif;?>
		<?php endforeach; ?>
		</h2>
		</div></div>




	<script src="<?= THEME_URL . '/assets/js/jquery.fitvid.js'; ?>"></script>
	<script type="text/javascript">

		jQuery(document).ready(function(){
			jQuery('#video_container').fitVids();
			//jQuery('.favorite').click(function(){
			jQuery(document).on('click','.favorite', function(){
				if(jQuery(this).data('authenticated')){
					jQuery.post('<?=url()?>/favorite', { video_id : jQuery(this).data('videoid'), _token: '<?= csrf_token(); ?>' }, function(data){});
					jQuery(this).toggleClass('active');
				} else {
					window.location = '<?=url()?>/signup';
				}
			});

			jQuery('.post-to-fb').click(function(){
				if(jQuery(this).data('authenticated')){
					jQuery.post('<?=url()?>/post-to-fb', {
					video_id : jQuery(this).data('videoid'),
					_token: '<?= csrf_token(); ?>'
					}, function(data){
						if (data == 'fb_not_connected') {
							window.location = '<?=url()?>/social-accounts?e=fb';
						}else{
							//$( ".post-to-fb" ).html( data );
							$( ".social-response" ).html( data );
						}
					});
					jQuery(this).toggleClass('active');
					$( ".social-response" ).html( '<img src="https://m.knyguklubas.lt/out/kk_mobile/html//src/images/ajax-loader.gif">' );
				} else {
					window.location = '<?=url()?>/signup';
				}
			});
			jQuery('.post-to-youtube').click(function(){
				if(jQuery(this).data('authenticated')){
					jQuery.post('<?=url()?>/post-to-youtube', {
					video_id : jQuery(this).data('videoid'),
					_token: '<?= csrf_token(); ?>'
					}, function(data){
						//$( ".post-to-youtube" ).html( data );
						if (data == 'yt_not_connected') {
							window.location = '<?=url()?>/social-accounts?y=error';
						}else{
							//$( ".post-to-fb" ).html( data );
							$( ".social-response" ).html( data );
						}
					});
					jQuery(this).toggleClass('active');
					$( ".social-response" ).html( '<img src="https://m.knyguklubas.lt/out/kk_mobile/html//src/images/ajax-loader.gif">' );
				} else {
					window.location = '<?=url()?>/signup';
				}
			});
			jQuery('.post-to-dailymotion').click(function(){
				if(jQuery(this).data('authenticated')){
					jQuery.post('<?=url()?>/post-to-dailymotion', {
					video_id : jQuery(this).data('videoid'),
					_token: '<?= csrf_token(); ?>'
					}, function(data){
						if (data == 'dailymotion_not_connected') {
							window.location = '<?=url()?>/social-accounts?d=error';
						}else{
						//$( ".post-to-dailymotion" ).html( data );
						$( ".social-response" ).html( data );
						}
					});
					jQuery(this).toggleClass('active');
					$( ".social-response" ).html( '<img src="https://m.knyguklubas.lt/out/kk_mobile/html//src/images/ajax-loader.gif">' );
				} else {
					window.location = '<?=url()?>/signup';
				}
			});
			jQuery(document).on('click','.like_video', function(){
				if(jQuery(this).data('authenticated')){
					jQuery.post('<?=url()?>/like_video', {
					video_id : jQuery(this).data('videoid'),
					_token: '<?= csrf_token(); ?>'
					}, function(data){
						$(".like_video span").html( data );
					});
					jQuery(this).toggleClass('active');
				} else {
					window.location = '<?=url()?>/signup';
				}
			});
			jQuery(document).on('click','.dislike_video', function(){
				if(jQuery(this).data('authenticated')){
					jQuery.post('<?=url()?>/dislike_video', {
					video_id : jQuery(this).data('videoid'),
					_token: '<?= csrf_token(); ?>'
					}, function(data){
						$(".dislike_video span").html( data );
					});
					jQuery(this).toggleClass('active');
				} else {
					window.location = '<?=url()?>/signup';
				}
			});
		});

	</script>

	<!-- RESIZING FLUID VIDEO for VIDEO JS -->
	<script type="text/javascript">
	  // Once the video is ready
	  _V_("video_player").ready(function(){

	    var myPlayer = this;    // Store the video object
	    var aspectRatio = 9/16; // Make up an aspect ratio

	    function resizeVideoJS(){
	    	console.log(myPlayer.id);
	      // Get the parent element's actual width
	      var width = document.getElementById('video_container').offsetWidth;
	      // Set width to fill parent element, Set height
	      myPlayer.width(width).height( width * aspectRatio );
	    }

	    resizeVideoJS(); // Initialize the function
	    window.onresize = resizeVideoJS; // Call the function on resize
	  });
	</script>

	<script src="<?= THEME_URL . '/assets/js/rrssb.min.js'; ?>"></script>


<script type="text/javascript" charset="utf-8">
		jQuery(document).ready(function(jQuery)
		{

    	   

			videoPlayer = jQuery("#Elite_video_player").Video({   //ALL PLUGIN OPTIONS
				instanceName:"player1",                      //name of the player instance
				autohideControls:5,                          //autohide HTML5 player controls
				hideControlsOnMouseOut:"No",                 //hide HTML5 player controls on mouse out of the player: "Yes","No"
				videoPlayerWidth:1006,                       //fixed total player width
				videoPlayerHeight:420,                       //fixed total player height
				responsive:false,				             //this option will overwrite above videoPlayerWidth/videoPlayerHeight and set player to fit your div (parent) container: true/false
				playlist:"Right playlist",                   //choose playlist type: "Right playlist", "Off"
				playlistScrollType:"light",                  //choose scrollbar type: "light","minimal","light-2","light-3","light-thick","light-thin","inset","inset-2","inset-3","rounded","rounded-dots","3d"
				playlistBehaviourOnPageload:"closed",		 //choose playlist behaviour when webpage loads: "closed", "opened" (not apply to Vimeo player)
				autoplay:true,                              //autoplay when webpage loads: true/false
				colorAccent:"#cc181e",                       //plugin colors accent (hexadecimal or RGB value - http://www.colorpicker.com/)
				vimeoColor:"00adef",                         //set "hexadecimal value", default vimeo color is "00adef"
				youtubeControls:"custom controls",			 //choose youtube player controls: "custom controls", "default controls"
				youtubeSkin:"dark",                          //default youtube controls theme: light, dark
				youtubeColor:"red",                          //default youtube controls bar color: red, white
				youtubeQuality:"default",                    //choose youtube quality: "small", "medium", "large", "hd720", "hd1080", "highres", "default"
				youtubeShowRelatedVideos:"Yes",				 //choose to show youtube related videos when video finish: "Yes", "No" (onFinish:"Stop video" needs to be enabled)
				videoPlayerShadow:"effect1",                 //choose player shadow:  "effect1" , "effect2", "effect3", "effect4", "effect5", "effect6", "off"
				loadRandomVideoOnStart:"No",                 //choose to load random video when webpage loads: "Yes", "No"
				shuffle:"No",				                 //choose to shuffle videos when playing one after another: "Yes", "No" (shuffle button enabled/disabled on start)
				posterImg:"<?= Config::get('site.uploads_url') . '/images/' . str_replace(' ', '%20', $video->image) ?>",//player poster image  
				onFinish:"Play next video",                  //"Play next video","Restart video", "Stop video",
				nowPlayingText:"Yes",                        //enable disable now playing title: "Yes","No"
				fullscreen:"Fullscreen native",              //choose fullscreen type: "Fullscreen native","Fullscreen browser"
				rightClickMenu:true,                         //enable/disable right click over HTML5 player: true/false
				hideVideoSource:false,						 //option to hide self hosted video sources (to prevent users from download/steal your videos): true/false
				showAllControls:true,						 //enable/disable all HTML5 player controls: true/false
				allowSkipAd:true,                            //enable/disable "Skip advertisement" option: true/false
				infoShow:"Yes",                              //enable/disable info option: "Yes","No"
				shareShow:"Yes",                             //enable/disable all share options: "Yes","No"
				facebookShow:"Yes",                          //enable/disable facebook option individually: "Yes","No"
				twitterShow:"Yes",                           //enable/disable twitter option individually: "Yes","No"
				mailShow:"Yes",                              //enable/disable mail option individually: "Yes","No"
				facebookShareName:"Tellyvizion", 
				facebookShareLink:"<?=url()?>",  //second parametar of facebook share in facebook feed dialog is link below title
				facebookShareDescription:"We offer artist the opportunity for exposure & marketing while offering videos for users to enjoy. We provide only original content that passes our strict professional guidelines.", //third parametar of facebook share in facebook feed dialog is description below link
				facebookSharePicture:"<?=url()?>", //fourth parametar in facebook feed dialog is picture on left side
				twitterText:"Tellyvizion",
				twitterLink:"<?=url()?>", //second parametar of twitter share in twitter feed dialog is link
				twitterHashtags:"wordpressvideoplayer",		 //third parametar of twitter share in twitter feed dialog is hashtag
				twitterVia:"Creative media",				 //fourth parametar of twitter share in twitter feed dialog is via (@)
				googlePlus:"<?=url()?>", //share link over Google +
				logoShow:"Yes",                              //"Yes","No"
				logoClickable:"Yes",                         //"Yes","No"
				logoPath:"<?=THEME_URL?>/assets/img/single-for-video.png",             //path to logo image
				logoGoToLink:"<?=url()?>",       //redirect to page when logo clicked
				logoPosition:"bottom-left",                  //choose logo position: "bottom-right","bottom-left"
				embedShow:"Yes",                             //enable/disable embed option: "Yes","No"
				embedCodeSrc:"<?=url()?>", //path to your video player on server
				embedCodeW:"746",                            //embed player code width
				embedCodeH:"420",                            //embed player code height
				embedShareLink:"<?=url()?>", //direct link to your site (or any other URL) you want to be "shared"
				youtubePlaylistID:"",                        //automatic youtube playlist ID (leave blank "" if you want to use manual playlist) LL4qbSRobYCjvwo4FCQFrJ4g
				youtubeChannelID:"",                         //automatic youtube channel ID (leave blank "" if you want to use manual playlist) UCHqaLr9a9M7g9QN6xem9HcQ
				
				//manual playlist
				videos:[
				{
				<?php if ($video->video) { ?>
							videoType:"HTML5",
						<?php }elseif (getYouTubeVideoId($video->embed_code)) { ?>
							videoType:"youtube",
							youtubeID:"<?php echo getYouTubeVideoId($video->embed_code);?>",
						<?php }elseif(preg_match('~video/(.*?)"~', $video->embed_code, $output)){
						preg_match('~video/(.*?)"~', $video->embed_code, $output);
						 $vimeo = $output[1]; ?>
						 videoType:"vimeo",
						 vimeoID:"<?=$vimeo?>",
						<?php } ?>
						<?php $title = str_replace(array('\'', '"'), '', $video->title);
						$title = trim(preg_replace('/\s\s+/', ' ', $title)); ?>
						title:"<?=strip_tags(substr($title, 0,50))?>..",
						 //choose video type: "HTML5", "youtube", "vimeo", "image"
						 //last part of the URL http://vimeo.com/119641053
						mp4:"<?= Config::get('site.s3_video') . 'videos/'.$video->video?>",
						    //HTML5 video mp4 url
						imageUrl:"<?= Config::get('site.uploads_url') . '/images/' . str_replace(' ', '%20', $video->image) ?>", 
						//display image instead of playing video
						imageTimer:4, 																	  //set time how long image will display
						prerollAD:"no",                                                                  //show pre-roll "yes","no"
						prerollGotoLink:"<?=url()?>",                                         //pre-roll goto link
						preroll_mp4:"http://creativeinteractivemedia.com/player/videos/Short_Elegant_Logo_Reveal.mp4",   //pre-roll video mp4 format
						prerollSkipTimer:5,
						midrollAD:"no",                                                                  //show mid-roll "yes","no"
						midrollAD_displayTime:"00:10",                                                    //show mid-roll at any custom time in format "minutes:seconds" ("00:00")
						midrollGotoLink:"<?=url()?>",                                         //mid-roll goto link
						midroll_mp4:"http://creativeinteractivemedia.com/player/videos/Logo_Explode.mp4", //mid-roll video mp4 format
						midrollSkipTimer:5,	
						postrollAD:"no",                                                                 //show post-roll "yes","no"
						postrollGotoLink:"<?=url()?>",                                        //post-roll goto link
						postroll_mp4:"http://creativeinteractivemedia.com/player/videos/Logo_Light.mp4",  //post-roll video mp4 format
						postrollSkipTimer:5,
						popupImg:"images/preview_images/popup.jpg",                        			  	  //popup image URL
						popupAdShow:"no",                                                                //enable/disable popup image: "yes","no"
						popupAdStartTime:"00:03",                                                         //time to show popup ad during playback
						popupAdEndTime:"00:07",                                                           //time to hide popup ad during playback
						popupAdGoToLink:"<?=url()?>",                                         //re-direct to URL when popup ad clicked
						<?php $description = str_replace(array('\'', '"'), '', $video->description);
						$description = trim(preg_replace('/\s\s+/', ' ', $description)); ?>
						description:"<?=strip_tags(substr($description, 0,50))?>..",
						thumbImg:"<?= Config::get('site.uploads_url') . '/images/' . str_replace(' ', '%20', $video->image) ?>",                                      //path to playlist thumbnail image
						info:"Tellyvizion was founded with the belief that we would always honor our commitment to our clients, our partners, our knowledge and our creativity by inspiring with our work. The framework of our business and fabric of our culture are rooted in this belief — it's what enables us to continuously go One Step Further."                                                                                    //video info
					},
				<?php
				if($related) {
				 foreach ($related as $video): ?>
					{
						<?php if ($video->video) { ?>
							videoType:"HTML5",
						<?php }elseif (getYouTubeVideoId($video->embed_code)) { ?>
							videoType:"youtube",
							youtubeID:"<?php echo getYouTubeVideoId($video->embed_code);?>",
						<?php }elseif(preg_match('~video/(.*?)"~', $video->embed_code, $output)){
						preg_match('~video/(.*?)"~', $video->embed_code, $output);
						 $vimeo = $output[1]; ?>
						 videoType:"vimeo",
						 vimeoID:"<?=$vimeo?>",
						<?php } ?>
						<?php $title = str_replace(array('\'', '"'), '', $video->title);
						$title = trim(preg_replace('/\s\s+/', ' ', $title)); ?>
						title:"<?=strip_tags(substr($title, 0,50))?>..",
						 //choose video type: "HTML5", "youtube", "vimeo", "image"
						 //last part of the URL http://vimeo.com/119641053
						mp4:"<?= Config::get('site.s3_video') . 'videos/'.$video->video?>",
						    //HTML5 video mp4 url
						imageUrl:"<?= Config::get('site.uploads_url') . '/images/' . str_replace(' ', '%20', $video->image) ?>", 
						//display image instead of playing video
						imageTimer:4, 																	  //set time how long image will display
						prerollAD:"no",                                                                  //show pre-roll "yes","no"
						prerollGotoLink:"<?=url()?>",                                         //pre-roll goto link
						preroll_mp4:"http://creativeinteractivemedia.com/player/videos/Short_Elegant_Logo_Reveal.mp4",   //pre-roll video mp4 format
						prerollSkipTimer:5,
						midrollAD:"no",                                                                  //show mid-roll "yes","no"
						midrollAD_displayTime:"00:10",                                                    //show mid-roll at any custom time in format "minutes:seconds" ("00:00")
						midrollGotoLink:"<?=url()?>",                                         //mid-roll goto link
						midroll_mp4:"http://creativeinteractivemedia.com/player/videos/Logo_Explode.mp4", //mid-roll video mp4 format
						midrollSkipTimer:5,	
						postrollAD:"no",                                                                 //show post-roll "yes","no"
						postrollGotoLink:"<?=url()?>",                                        //post-roll goto link
						postroll_mp4:"http://creativeinteractivemedia.com/player/videos/Logo_Light.mp4",  //post-roll video mp4 format
						postrollSkipTimer:5,
						popupImg:"images/preview_images/popup.jpg",                        			  	  //popup image URL
						popupAdShow:"no",                                                                //enable/disable popup image: "yes","no"
						popupAdStartTime:"00:03",                                                         //time to show popup ad during playback
						popupAdEndTime:"00:07",                                                           //time to hide popup ad during playback
						popupAdGoToLink:"<?=url()?>",                                         //re-direct to URL when popup ad clicked
						<?php $description = str_replace(array('\'', '"'), '', $video->description);
						$description = trim(preg_replace('/\s\s+/', ' ', $description)); ?>
						description:"<?=strip_tags(substr($description, 0,50))?>..",
						thumbImg:"<?= Config::get('site.uploads_url') . '/images/' . str_replace(' ', '%20', $video->image) ?>",                                      //path to playlist thumbnail image
						info:"Tellyvizion was founded with the belief that we would always honor our commitment to our clients, our partners, our knowledge and our creativity by inspiring with our work. The framework of our business and fabric of our culture are rooted in this belief — it's what enables us to continuously go One Step Further."                                                                                    //video info
					},
					<?php endforeach;
				}
					?>
				
				]
			});
		});
	</script>	
	
	<script type="text/javascript">
		
		j = jQuery;
		
		j(document).on( 'click', '.donate3', function(){
			
			var donate3 = j(this).attr('donate3');
			
			if( donate3 == 0 ) {
				//j("#amount_actual").removeAttr('disabled'); 
				j("#amount_actual").val('');
				j("input[name=amount]").val('');
			} else {
				//j("#amount_actual").prop("disabled", true);
				//j("#amount_actual").attr("disabled", true);
				j("input[name=amount]").val(donate3);
				j("#amount_actual").val(donate3);
			}
			
			//alert('On Snap you click me. ... .. .');
			
		});
		
		j(document).on( 'click', '.open-dollars input[name=submit]', function(event){
			
			//alert('Are you sure?');
			var amount_actual = j("#amount_actual").val();
			if( amount_actual == '') {
				event.preventDefault();
				alert('Please add some amount.');
			} else {
				j("input[name=amount]").val(amount_actual);
			}
		
		});
		
	
	</script>
	
	<?php include('includes/footer.php'); ?>
