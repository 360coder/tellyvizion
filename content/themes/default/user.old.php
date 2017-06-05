<?php include('includes/header.php'); ?>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=THEME_URL?>/assets/js/jquery.form.min.js"></script>
<div class="user">

	<?php /* echo "<pre>"; print_r($user); echo "</pre>"; */ ?>

	<?php if(isset($type) && $type == 'profile'): ?>
	<div class="cover-container user-badge-main">
	<div class="cover-wrapper">
	<?php $cover_image = ($user->cropped == 1) ? 'cropped/'.$user->cover : $user->cover ;?>
		<img class="u110" src="<?= Config::get('site.uploads_url') . 'covers/' . $cover_image ?>" />
		<div class="cover-progress"></div>
    </div>
        
    <div class="cover-resize-wrapper">
        <img src="<?= Config::get('site.uploads_url') . 'covers/' . $user->cover ?>" alt="w3lessons.info">
        <div class="drag-div" align="center">Drag to reposition</div>
        <div class="cover-progress"></div>
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

</div>

		<!-- <h2><?= ucfirst($user->username) ?>'s Favorites </h2>
		<div class="heading-divider"></div>
		<div class="row">

			<?php //include('partials/video-loop.php'); ?>

			<div class="clear"></div>
			<a class="user-favorites" href="<?=url()?>/favorites">View All Favorites</a>
		</div>
 -->

 <div class="container user">
<div class="col-lg-12">
<div class="row">
	<div class="col-lg-12"><h2>View All <?= (ucfirst($user->name)) ? ucfirst($user->name) : ucfirst($user->username) ;  ?>'s Videos <span class="pull-right resume11"><?php if( !empty ($user->resume)){ ?>
					<a href="<?=url()?>/content/uploads/resume/<?=$user->resume?>" download>Download Resume</a>
				<?php } ?></span></h2>

	</div>
		
		<?php include('partials/user-videos.php'); ?>
		</div>
</div>

 </div>
		
		



	<?php elseif(isset($type) && $type == 'edit'): ?>
		 <div class="container user">
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

			<div class="well">
				<?php if($errors->first('name')): ?><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <strong>Oh snap!</strong> <?= $errors->first('name'); ?></div><?php endif; ?>
				<label for="name">Name</label>
				<input type="text" class="form-control" name="name" id="name" value="<?php if(!empty($user->name)): ?><?= $user->name ?><?php endif; ?>" />
			</div>

			<div class="well">
				<?php if($errors->first('username')): ?><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <strong>Oh snap!</strong> <?= $errors->first('username'); ?></div><?php endif; ?>
				<label for="username">Username</label>
				<input type="text" class="form-control" name="username" id="username" value="<?php if(!empty($user->username)): ?><?= $user->username ?><?php endif; ?>" />
			</div>

			<div class="well">
				<?php if($errors->first('email')): ?><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <strong>Oh snap!</strong> <?= $errors->first('email'); ?></div><?php endif; ?>
				<label for="email">Email</label>
				<input type="text" class="form-control" name="email" id="email" value="<?php if(!empty($user->email)): ?><?= $user->email ?><?php endif; ?>" />
			</div>

			<div class="well">
				<label for="password">Password (leave empty to keep your original password)</label>
				<input type="password" class="form-control" name="password" id="password" value="" />
			</div>
			
			<!-- Shaan Code Start -->
			
			<div class="well">
				<label for="resume">Resume</label>
				<input type="file" multiple="true" class="form-control" name="resume" id="resume" onchange="ValidateSingleInput(this);"/>
				
				<?php if( !empty ($user->resume)){ ?>
					<a href="<?=url()?>/content/uploads/resume/<?=$user->resume?>" download>Download Resume</a>
				<?php } ?>
				
			</div>
			
			
			
			<!-- <div class="well">
<?php if($errors->first('gender')): ?><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <strong>Oh snap!</strong> <?= $errors->first('gender'); ?></div><?php endif; ?>				
			<label for="gender">Gender</label>
			<?php $male = ($user->gender == 'male') ? 'checked="true"' : '' ;?>
			<?php $female = ($user->gender == 'female') ? 'checked="true"' : '' ;?>
				<label class="radio-inline">
				  <input type="radio" <?=$male?> name="gender" id="gender" value="male">Male
				</label>
				<label class="radio-inline">
				  <input type="radio" <?=$female?> name="gender" id="gender" value="female">Female
				</label>								
			</div>
			
			<div class="well">
			<?php if($errors->first('age')): ?><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <strong>Oh snap!</strong> <?= $errors->first('age'); ?></div><?php endif; ?>			
				<label for="age">Age</label>
				<input type="text" class="form-control" name="age" id="age" value="<?php if(!empty($user->age)): ?><?= $user->age ?><?php endif; ?>" />
			</div>
			
			
			<div class="well">
				<?php if($errors->first('ethinicties')): ?><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <strong>Oh snap!</strong> <?= $errors->first('ethinicties'); ?></div><?php endif; ?>
				<label for="ethinicties">Ethinicties</label>
				<input type="text" class="form-control" name="ethinicties" id="ethinicties" value="<?php if(!empty($user->ethinicties)): ?><?= $user->ethinicties ?><?php endif; ?>" />
			</div>
			
			<div class="well">
				<?php if($errors->first('height')): ?><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <strong>Oh snap!</strong> <?= $errors->first('height'); ?></div><?php endif; ?>
				<label for="height">Height</label>
				<input type="text" class="form-control" name="height" id="height" value="<?php if(!empty($user->height)): ?><?= $user->height ?><?php endif; ?>" />
			</div>
			
			<div class="well">
				<?php if($errors->first('weight')): ?><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <strong>Oh snap!</strong> <?= $errors->first('weight'); ?></div><?php endif; ?>
				<label for="weight">Weight</label>
				<input type="text" class="form-control" name="weight" id="weight" value="<?php if(!empty($user->weight)): ?><?= $user->weight ?><?php endif; ?>" />
			</div>
			
			<div class="well">
				<?php if($errors->first('build')): ?><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <strong>Oh snap!</strong> <?= $errors->first('build'); ?></div><?php endif; ?>
				<label for="build">Build</label>
				<input type="text" class="form-control" name="build" id="build" value="<?php if(!empty($user->build)): ?><?= $user->build ?><?php endif; ?>" />
			</div>
			
			<div class="well">
				<?php if($errors->first('hair')): ?><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <strong>Oh snap!</strong> <?= $errors->first('hair'); ?></div><?php endif; ?>
				<label for="hair">Hair</label>
				<input type="text" class="form-control" name="hair" id="hair" value="<?php if(!empty($user->hair)): ?><?= $user->hair ?><?php endif; ?>" />
			</div>
			
			<div class="well">
				<?php if($errors->first('eyes')): ?><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <strong>Oh snap!</strong> <?= $errors->first('eyes'); ?></div><?php endif; ?>
				<label for="eyes">Eyes</label>
				<input type="text" class="form-control" name="eyes" id="eyes" value="<?php if(!empty($user->eyes)): ?><?= $user->eyes ?><?php endif; ?>" />
			</div>
			
			<div class="well">
			<?php if($errors->first('eyes')): ?><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <strong>Oh snap!</strong> <?= $errors->first('eyes'); ?></div><?php endif; ?>
			<label for="skills">Skills</label>
				<input type="text" class="form-control" data-role="tagsinput" name="skills" id="skills" value="<?php if(!empty($user->skills)): ?><?= $user->skills ?><?php endif; ?>" />
			
			</div> -->
			
			
			<!-- Shaan Code End -->
			
			
			
			

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
			<?php endif; ?>
			<input type="hidden" name="_token" value="<?= csrf_token() ?>" />
			<input type="submit" value="Update Profile" class="btn btn-primary" />

			<div class="clear"></div>
		</form>
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
function repositionCover() {
    $('.cover-wrapper').hide();
    $('.cover-resize-wrapper').show();
    $('.cover-resize-buttons').show();
    $('.default-buttons').hide();
    $('.screen-width').val($('.cover-resize-wrapper').width());
    $('.cover-resize-wrapper img')
    .css('cursor', 's-resize')
    .draggable({
        scroll: false,
        
        axis: "y",
        
        cursor: "s-resize",
        
        drag: function (event, ui) {
            y1 = $('.timeline-header-wrapper').height();
            y2 = $('.cover-resize-wrapper').find('img').height();
            
            if (ui.position.top >= 0) {
                ui.position.top = 0;
            }
            else
            if (ui.position.top <= (y1-y2)) {
                ui.position.top = y1-y2;
            }
        },
        
        stop: function(event, ui) {
            $('input.cover-position').val(ui.position.top);
        }
    });
}

function saveReposition() {
    
    if ($('input.cover-position').length == 1) {
        posY = $('input.cover-position').val();
        $('form.cover-position-form').submit();
    }
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
<?php include('includes/footer.php'); ?>