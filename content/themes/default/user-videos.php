<?php include('includes/header.php'); ?>
<script src="<?=THEME_URL?>/assets/js/toastr.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?=THEME_URL?>/assets/css/toast.css">
<?php if(isset($_REQUEST['msg'])): ?>
	<script type="text/javascript">
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
	toastr.success('The video is under review and be available within 24 hours!');
	</script>
	
<?php endif;?>


<?php if (!$recent_videos->isEmpty()) { ?>
<div class="video-bg-bx">

<div class="">
    <div class="col-md-12">

               <div class="well">
                 
<div class="slider6">
<?php foreach ($recent_videos as $video) { ?>
  <div class="slide"><a href="<?= ($settings->enable_https) ? secure_url('video') : URL::to('video') ?><?= '/' . $video->id ?>"><img src="<?= ImageHandler::getImage($video->image, 'medium')  ?>" class="img-responsive"></a></div>
  <?php } ?>
</div>

              
        </div>
        <!--/well-->
    </div>
</div>
</div>
<?php } ?>
<?php if (!$fav_videos->isEmpty()) { ?>
<div class="video-slider-for-user 11">
<div class="container">
<div class="row">

<div class="well">
                 <h3>My Favorites</h3>
                 <div class="slider6">
<?php foreach ($fav_videos as $video) { ?>
  <div class="slide"><a href="<?= ($settings->enable_https) ? secure_url('video') : URL::to('video') ?><?= '/' . $video->id ?>"><img src="<?= ImageHandler::getImage($video->image, 'medium')  ?>" class="img-responsive"></a>
						<div class="information-video-user">
									<p class="date"><?= date("F jS, Y", strtotime($video->created_at)); ?>
										<?php if($video->access == 'guest'): ?>
											<span class="label label-info pull-right">Free</span>
										<?php elseif($video->access == 'subscriber'): ?>
											<span class="label label-success pull-right">Subscribers Only</span>
										<?php elseif($video->access == 'registered'): ?>
											<span class="label label-warning pull-right">Registered Users</span>
										<?php endif; ?>
									</p>
									<p class="desc"><?php if(strlen($video->description) > 90){ echo substr($video->description, 0, 90) . '...'; } else { echo $video->description; } ?></p>
						</div>
  </div>
  <?php } ?>
</div>

        </div>
        <!--/well-->

</div></div>
</div>

<?php } ?>


<div class="container">

		
		<?php if(isset($page_title)): ?>
			<!-- <h3><?= $page_title ?><?php if(isset($page_description)): ?><span><?= $page_description ?></span><?php endif; ?></h3> -->
		<?php endif; ?>
		<div class="row">
		<div class="col-lg-12">
		<p class="video-top-line">
		<span>My Videos :</span>
			<a class="user-favorites" href="<?=url()?>/add-video"><!-- <img src="<?=Config::get('site.uploads_dir')?>images/icon_Download.png" class="img-responsive"> --><i class="fa fa-upload" aria-hidden="true"></i>
Upload Video</a>
			</p></div>
			<div class="masonry extra-videohover">
			<?php foreach($videos as $video): ?>
<div class="videohover-bottomgap">
	<article class="block">
		<a class="block-thumbnail" href="<?= ($settings->enable_https) ? secure_url('video') : URL::to('video') ?><?= '/' . $video->id ?>">
			<div class="thumbnail-overlay"></div>
			<span class="play-button"></span>
			<img src="<?= ImageHandler::getImage($video->image, 'medium')  ?>">
			<div class="details">
				<h2><?= $video->title; ?></h2>
				<span><?= TimeHelper::convert_seconds_to_HMS($video->duration); ?></span>
			</div>
		</a>
		<div class="block-contents">
						
						<div class="album-images-count">
							<i class="fa fa-video-camera" aria-hidden="true"></i>
						</div>
						
						<div class="album-options">
							<a href="<?=url()?>/videos/edit/<?=$video->id ?>">
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>
							
							<a href="<?=url()?>/videos/delete/<?=$video->id ?>" class="delete">
								<i class="fa fa-trash-o" aria-hidden="true"></i>
							</a>
						</div>

						<div class="information-video-user">
			<p class="date"><?= date("F jS, Y", strtotime($video->created_at)); ?>
				<?php if($video->active == '1'): ?>
					<span class="label label-success">Active</span>
				<?php else: ?>
					<span class="label label-info">Pending</span>
				<?php endif; ?>
			</p>
			<p class="desc"><?php if(strlen($video->description) > 90){ echo substr($video->description, 0, 90) . '...'; } else { echo $video->description; } ?></p>
		</div>
						
					</div>
	</article>
</div>
<?php endforeach; ?>
</div>
		</div>


	<?php include('partials/pagination.php'); ?>

</div>

<link rel="stylesheet" href="<?=url()?>/application/assets/admin/css/sweetalert.css">
<script src="<?=url()?>/application/assets/admin/js/sweetalert.min.js"></script>
<script>

		$(document).ready(function(){
			var delete_link = '';

			$('.delete').click(function(e){
				e.preventDefault();
				delete_link = $(this).attr('href');
				swal({   title: "Are you sure?",   text: "Do you want to permanantly delete this video?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, function(){    window.location = delete_link });
			    return false;
			});
		});

		
	</script>
<?php include('includes/footer.php'); ?>
