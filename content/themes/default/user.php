<?php include('includes/header.php'); ?>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=THEME_URL?>/assets/js/jquery.form.min.js"></script>
<script type="text/javascript" src="<?=THEME_URL?>/assets/js/jquery.imagedrag.min.js"></script>

    <style type="text/css">
      .wrap {
        width: 938px;
        height: 400px;
        overflow: hidden;
        margin: auto;
        cursor: -webkit-grab;

      }
      img.u110 {
    height: auto !important;
    position: relative;
}
    </style>
<div class="user">

	<?php /* echo "<pre>"; print_r($user); echo "</pre>"; */ ?>

	<?php if(isset($type) && $type == 'profile'): ?>
	<div class="cover-container user-badge-main">
	<div class="cover-wrapper wrap">
	<?php if($user->cover): ?>
		<img <?=$size?> class="u110" src="<?= Config::get('site.uploads_url') . 'covers/' . $user->cover ?>" />
	<?php endif;?>
		<div id="output"></div>
    </div>

	<div id="user-badge">
		<img src="<?= Config::get('site.uploads_url') . 'avatars/' . $user->avatar ?>" />
		
		<h2 class="form-signin-heading"><?= $user->name ?></h2>
		<div class="label label-info"><?= ucfirst($user->role) ?> User</div>
		<p class="member-since">Member since: <?= $user->created_at ?></p>
		<?php if(Auth::user()->username == $user->username) { ?>
		<a href="<?= ($settings->enable_https) ? secure_url('user') : URL::to('user') ?><?= '/' . $user->username . '/edit' ?>" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
		<?php } ?>
	</div>
</div>
<?php if(Auth::user()->username == $user->username) { ?>
<div class="float-left span35">
        <div class="timeline-buttons cover-resize-buttons">
<br><br>
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center" valign="middle">
                <a onclick="saveReposition();">Save Position</a>
            </td>
            <td align="center" valign="middle">
                <a onclick="cancelReposition();">Cancel</a>
            </td>
        </tr>
        </table>
        <form class="cover-position-form hidden" method="post">
            <input class="cover-position" name="pos" value="0" type="hidden">
        </form>
    </div>

<div class="timeline-buttons default-buttons">
<br><br>
        <table border="0" width="150" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center" valign="middle">
                <a onclick="repositionCover();">Reposition cover</a>
            </td>
        </tr>
        </table>
    </div>
</div>
<?php } ?>
</div>
<?php //echo "HELLO INSIDE VIDEO SLIDER".'</br>';
//echo "<pre>"; print_r($user_videos); die; ?>



<?php if (!$user_featured_videos->isEmpty()) { ?>
<div class="video-bg-bx">

<div class="">
    <div class="col-md-12">

               <div class="well">
                 
<div class="slider6">
<?php foreach ($user_featured_videos as $video) { ?>
  <div class="slide"><a href="<?= ($settings->enable_https) ? secure_url('video') : URL::to('video') ?><?= '/' . $video->id ?>"><img src="<?= ImageHandler::getImage($video->image, 'medium')  ?>" class="img-responsive"></a></div>
  <?php } ?>
</div>

              
        </div>
        <!--/well-->
    </div>
</div>
</div>
<?php } ?>

<div class="user">
 <div class="container">
  <div class="mail-section01">
 <div class="row">
 <div class="col-lg-12">
<!-- <span class="position-nam01">Musicians, directors, comedians</span> -->
<a href="mailto:<?=$user->email?>" class="pull-right"><span>Contact <i class="fa fa-envelope" aria-hidden="true"></i></span></a>
</div>
</div>
<?php if($user->bio): ?>
<div class="row appearance01">
<div class="col-lg-12">
<h3>Bio</h3>
<div class="textarea"><?=$user->bio?></div>
</div>

<!-- <div class="col-lg-6"><h3>Appearance</h3>
<p><label>Gender:</label> <span>Female</span></p>
<p><label>Age range:</label> <span>25-23</span></p>
<p><label>Ethinicties:</label> <span>Caucasian</span></p>
<p><label>Height:</label> <span>4'5</span></p>
<p><label>Weight:</label> <span>105lbs / 48kg</span></p>
<p><label>Build:</label> <span>Slim</span></p>
<p><label>Hair:</label> <span>Red / Blond</span></p>
<p><label>Eyes:</label> <span>Blue</span></p>
</div> -->
<!-- <div class="col-lg-6"><h3>Skills</h3>
<p class="skills01">
	
	<span>Accents/Dialects  </span>
	<span>Choreography  </span>
	<span>Clowntraining  </span>
	<span>Dancer  </span>
	<span>Acrobat Training  </span>
	<span>Drivers License  </span>
	<span>Fight Training  </span>
	<span>Voiceover  </span>
	<span>Hourseback </span>
	<span>Riding  </span>
	<span>Archery  		</span>
</p>
</div> -->
</div>
<?php endif;?>
<?php if($user->facebook_link || $user->backstage_link || $user->twitter_link || $user->artist_link): ?>
<div class="row appearance01">
<div class="col-lg-12">
<h3>Connect with me</h3>
<ul>
<?php if($user->facebook_link):?>
	<li><a target="_blank" href="<?=$user->facebook_link?>"><img src="<?=url()?>/content/themes/default/assets/img/icon_fb-art_gray.png" />Facebook</a></li>
<?php endif; ?>
<?php if($user->imdb_link):?>
	<li><a target="_blank" href="<?=$user->imdb_link?>"><img src="<?=url()?>/content/themes/default/assets/img/icon_imdb_gray.png" />IMDB</a></li>
<?php endif; ?>
<?php if($user->backstage_link):?>
	<li><a target="_blank" href="<?=$user->backstage_link?>"><img src="<?=url()?>/content/themes/default/assets/img/icon_backstagestar_gray.png" />Backstage</a></li>
<?php endif; ?>
<?php if($user->twitter_link):?>
	<li><a target="_blank" href="<?=$user->twitter_link?>"><img src="<?=url()?>/content/themes/default/assets/img/icon_twitter_gray.png" />Twitter</a></li>
<?php endif; ?>
<?php if($user->artist_link):?>
	<li><a target="_blank" href="<?=$user->artist_link?>"><img src="<?=url()?>/content/themes/default/assets/img/icon_wesite_gray.png" />Artist Website</a></li>
<?php endif; ?>
</ul>


</div>
</div>
<?php endif;?>

 </div>


<div class="row">
	<div class="col-lg-12"><h2 class="padding-top10">View All <?= (ucfirst($user->name)) ? ucfirst($user->name) : ucfirst($user->username) ;  ?>'s Videos <!-- <span class="pull-right resume11"><?php if( !empty ($user->resume)){ ?>
					<a href="<?=url()?>/content/uploads/resume/<?=$user->resume?>" download><i class="fa fa-download" aria-hidden="true"></i> Download Resume</a>
				<?php } ?></span> --></h2>

	</div>
		
		<?php include('partials/user-videos.php'); ?>
</div>


 </div>
 </div>
		
		



	<?php elseif(isset($type) && $type == 'edit'): ?>
		<div class="user">
		 <div class="container ">
		<h4 class="subheadline"><i class="fa fa-edit"></i> Update Your Profile Info</h4>
		<div class="clear"></div>

		<form method="POST" action="<?= $post_route ?>" id="update_profile_form" accept-charset="UTF-8" file="1" enctype="multipart/form-data">

			<div id="user-badge">
				<img src="<?= Config::get('site.uploads_url') . 'avatars/' . $user->avatar ?>" />
				<label for="avatar">Avatar</label>
				<input type="file" multiple="true" class="form-control" name="avatar" id="avatar" />
			</div>

			<div id="user-badge">
				<img src="<?= Config::get('site.uploads_url') . 'covers/' . $user->cover ?>" />
				<label for="cover">Cover Image</label>
				<input type="file" multiple="true" class="form-control" name="cover" id="cover" />
			</div>
			<div class="row">

			<div class="col-lg-6">
			<div class="well">
				<?php if($errors->first('name')): ?><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <strong>Oh snap!</strong> <?= $errors->first('name'); ?></div><?php endif; ?>
				<label for="name">Name</label>
				<input type="text" class="form-control" name="name" id="name" value="<?php if(!empty($user->name)): ?><?= $user->name ?><?php endif; ?>" />
			</div>
			</div>

			<div class="col-lg-6">
			<div class="well">
				<?php if($errors->first('username')): ?><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <strong>Oh snap!</strong> <?= $errors->first('username'); ?></div><?php endif; ?>
				<label for="username">Username</label>
				<input type="text" class="form-control" name="username" id="username" value="<?php if(!empty($user->username)): ?><?= $user->username ?><?php endif; ?>" />
			</div>
			</div>

			</div>

			<div class="row">
			
			<div class="col-lg-6">
			<div class="well">
				<?php if($errors->first('email')): ?><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <strong>Oh snap!</strong> <?= $errors->first('email'); ?></div><?php endif; ?>
				<label for="email">Email</label>
				<input type="text" class="form-control" name="email" id="email" value="<?php if(!empty($user->email)): ?><?= $user->email ?><?php endif; ?>" />
			</div>
			</div>
			<div class="col-lg-6">
			<div class="well">
				<label for="password">Password (leave empty to keep your original password)</label>
				<input type="password" class="form-control" name="password" id="password" value="" />
			</div>
			</div>
			</div>
			
			<!-- Shaan Code Start -->
			
			<!-- <div class="well">
				<label for="resume">Resume</label>
				<input type="file" multiple="true" class="form-control" name="resume" id="resume" onchange="ValidateSingleInput(this);"/>
				
				<?php if( !empty ($user->resume)){ ?>
					<a href="<?=url()?>/content/uploads/resume/<?=$user->resume?>" download>Download Resume</a>
				<?php } ?>
				
			</div> -->

			<div class="well">
				<label for="bio">Bio</label>
				<textarea style="min-height: 200px" class="form-control" name="bio" id="details"><?php if(!empty($user->bio)): ?><?= $user->bio ?><?php endif; ?></textarea>
			</div>
			<div class="row">
			
			<div class="col-lg-6">
			<div class="well">
				<label>Facebook Link</label>
				<input type="text" class="form-control" name="facebook_link" value="<?php if(!empty($user->facebook_link)): ?><?= $user->facebook_link ?><?php endif; ?>" />
			</div>
			</div>
			<div class="col-lg-6">
			<div class="well">
				<label>IMDB Link</label>
				<input type="text" class="form-control" name="imdb_link" value="<?php if(!empty($user->imdb_link)): ?><?= $user->imdb_link ?><?php endif; ?>" />
			</div>
			</div>
			</div>

			<div class="row">
			
			<div class="col-lg-6">
			<div class="well">
				<label>Backstage Link</label>
				<input type="text" class="form-control" name="backstage_link" value="<?php if(!empty($user->backstage_link)): ?><?= $user->backstage_link ?><?php endif; ?>" />
			</div>
			</div>
			<div class="col-lg-6">
			<div class="well">
				<label>Twitter Link</label>
				<input type="text" class="form-control" name="twitter_link" value="<?php if(!empty($user->twitter_link)): ?><?= $user->twitter_link ?><?php endif; ?>" />
			</div>
			</div>
			</div>
			<div class="row">
			
			<div class="col-lg-6">
			<div class="well">
				<label>Artist Website</label>
				<input type="text" class="form-control" name="artist_link" value="<?php if(!empty($user->artist_link)): ?><?= $user->artist_link ?><?php endif; ?>" />
			</div>
			</div>
			<div class="col-lg-6">
			<?php if(($settings->free_registration && $settings->premium_upgrade) || (!$settings->free_registration)): ?>
				<div class="well">
					<label for="role" style="margin-bottom:10px;">User Type</label>
					<?php if($user->role == 'subscriber'): ?>
						<div class="label label-success"><i class="fa fa-certificate"></i> <?= ucfirst($user->role) ?> User</div>
						<div class="clear"></div>
					<?php elseif($user->role == 'registered'): ?>
						<div class="label label-warning"><i class="fa fa-user"></i> <?= ucfirst($user->role) ?> User</div>
						<div class="clear"></div>
					<?php elseif($user->role == 'demo'): ?>
						<div class="label label-danger"><i class="fa fa-life-saver"></i> <?= ucfirst($user->role) ?> User</div>
						<div class="clear"></div>
					<?php elseif($user->role == 'admin'): ?>
						<div class="label label-primary"><i class="fa fa-star"></i> <?= ucfirst($user->role) ?> User</div>
						<div class="clear"></div>
					<?php endif; ?>
					<?php if($settings->free_registration && $settings->premium_upgrade): ?>
						<a class="btn btn-primary" href="<?= ($settings->enable_https) ? secure_url('/') : URL::to('user') ?><?= '/' . $user->username; ?>/upgrade_subscription" style="margin-top:10px;"><i class="fa fa-certificate"></i> Upgrade to Premium Subscription</a>
					<?php else: ?>
						<a class="btn btn-danger" href="<?= ($settings->enable_https) ? secure_url('/') : URL::to('user') ?><?= '/' . $user->username; ?>/billing" style="margin-top:10px;"><i class="fa fa-credit-card"></i> Manage Your Billing Info</a>
					<?php endif; ?>
				</div>
				</div>
				</div>
			<?php endif; ?>
			<input type="hidden" name="_token" value="<?= csrf_token() ?>" />
			<a class="delete" href="<?= ($settings->enable_https) ? secure_url('account-settings') : URL::to('account-settings') ?><?= '/' . $user->id; ?>/deactivated_user"><button type="button" class="btn btn-danger" />Deactivate Account</button></a>
			<input type="submit" value="Update Profile" class="btn btn-primary" />

			<div class="clear"></div>
		</form>
</div>
</div>
	<?php elseif(isset($type) && $type == 'billing'): ?>

		<?php include('partials/user-billing.php'); ?>

	<?php elseif(isset($type) && $type == 'update_credit_card'): ?>

		<?php include('partials/user-update-billing.php'); ?>

	<?php elseif(isset($type) && $type == 'renew_subscription'): ?>

		<?php include('partials/renew-subscription.php'); ?>

	<?php elseif(isset($type) && $type == 'upgrade_subscription'): ?>

		<?php include('partials/upgrade-subscription.php'); ?>

	<?php endif; ?>
</div>

<script type="text/javascript">
      function repositionCover(){

        $('.wrap').imagedrag({
          input: "#output",
          position: "middle",
          attribute: "html"
        });

    $('.default-buttons').hide();
    $('.cover-resize-buttons').show();

      };
</script>

<script type="text/javascript">
function saveReposition() {
   // if ($('#output').length == 1) {
        posY = $('#output').text();

		jQuery.post('<?=url()?>/user/save_reposition', {
		pos : posY,
		}, function(data){
			$( "#output" ).html( data );
			$('.default-buttons').show();
    		$('.cover-resize-buttons').hide();
    		$(".cover-wrapper").removeClass("wrap");
    		$(".u110").removeClass("ui-draggable");
		});
				
        //$('form.cover-position-form').submit();
   // }
}

function cancelReposition() {
    $('.cover-wrapper').show();
    $('.cover-resize-wrapper').hide();
    $('.cover-resize-buttons').hide();
    $('.default-buttons').show();
    $('input.cover-position').val(0);
    $('.cover-resize-wrapper img').draggable('destroy').css('cursor','default');
}


 $(function(){
    $('.cover-resize-wrapper').height($('.cover-resize-wrapper').width()*0.3);

    $('form.cover-position-form').ajaxForm({
        url:  'save_reposition',
        dataType:  'json', 
        beforeSend: function() {
            $('.cover-progress').html('Repositioning...').fadeIn('fast').removeClass('hidden');
        },
        
        success: function(responseText) {
            if ((responseText.status) == 200) {
                $('.cover-wrapper img')
                    .attr('src', responseText.url + '?' + new Date().getTime())
                    .load(function () {
                        $('.cover-progress').fadeOut('fast').addClass('hidden').html('');
                        $('.cover-wrapper').show();
                        $('.cover-resize-wrapper')
                            .hide()
                            .find('img').css('top', 0);
                        $('.cover-resize-buttons').hide();
                        $('.default-buttons').show();
                        $('input.cover-position').val(0);
                        $('.cover-resize-wrapper img').draggable('destroy').css('cursor','default');
                    });
            }
        }
    });
});  

</script>
<link rel="stylesheet" href="<?=url('/application/assets/js/tagsinput/jquery.tagsinput.css')?>" />
<script type="text/javascript" src="<?=url('/application/assets/admin/js/tinymce/tinymce.min.js')?>"></script>
<script type="text/javascript" src="<?=url('/application/assets/js/jquery.mask.min.js')?>"></script>
<script type="text/javascript" src="<?=url('/application/assets/js/tagsinput/jquery.tagsinput.min.js')?>"></script>
<script type="text/javascript">

	$ = jQuery;

	$(document).ready(function(){
		
		$('#skills').tagsInput();

		

	});



	</script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
//var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"]; 
var _validFileExtensions = [".txt",".doc", ".docx",".pdf"];    
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                //sweetAlert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                //sweetAlert('Oops...' + _validFileExtensions.join(", ") + ' are allowed','error');
                sweetAlert('Oops...','Only ' + _validFileExtensions.join(", ") + ' are allowed','error');
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}
</script> 	


<script>

		$(document).ready(function(){
			var delete_link = '';

			$('.delete').click(function(e){
				e.preventDefault();
				delete_link = $(this).attr('href');
				swal({   title: "Are you sure?",   text: "Do you want to permanantly deactivate this account?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, deactivate it!",   closeOnConfirm: false }, function(){    window.location = delete_link });
			    return false;
			});
		});

		
	</script>
	
	
<style type="text/css">
.cover-wrapper {
position: relative;
width: 100%;
}
.cover-wrapper img {
width: 100%;
box-shadow: 0 0 0 1px rgba(0, 0, 0, .3);
}
.cover-resize-wrapper {
position: relative;
width: 100%;
height: 400px;
overflow: hidden;
display: none;
}
.cover-resize-wrapper img {
position: absolute;
width: 100%;
box-shadow: 0 0 0 1px rgba(0, 0, 0, .3);
}
.cover-resize-wrapper .drag-div {
position: absolute;
top: 0;
width: 100%;
background: rgba(0,0,0,0.15);
color: white;
font-weight: 500;
padding: 7px;
border: 1px solid rgba(0,0,0,0.1);
border-radius: 3px;
}
.cover-progress {
position: absolute;
top: 0;
right: 0;
bottom: 0;
left: 0;
display: none;
background: rgba(0,0,0,0.6);
color: white;
text-align: center;
}
.timeline-buttons {
margin-bottom: 5px;
}
.timeline-buttons a {
display: block;
width: 96%;
background: #f9fafb;
background: linear-gradient(#f5f6f7 1%, #ffffff 2%, #ffffff 70%, #f5f6f7 100%);
color: #4e5665;
text-align: center;
font-weight: 500;
margin: 0 0 5px 0;
padding: 7px 0;
border: 1px solid #d4d5d6;
border-radius: 3px;
cursor: pointer;
}
.timeline-buttons a i {
margin-right: 3px;
}
.timeline-buttons .active {
background: #527dbb;
background: linear-gradient(#5791d4,#5571ac);
color: white;
border-color: #3a558e;
}
.cover-resize-buttons {
display: none;
}
</style>

<script type="text/javascript">

	jQuery(document).ready(function(){
	tinymce.init({
			relative_urls: false,
		    selector: '#details',
		    toolbar: "styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview media | forecolor backcolor | code",
		    plugins: [
		         "advlist autolink link image code lists charmap print preview hr anchor pagebreak spellchecker code fullscreen",
		         "save table contextmenu directionality emoticons template paste textcolor code"
		   ],
		   menubar:false,
		 });

	});
</script>
<?php include('includes/footer.php'); ?>