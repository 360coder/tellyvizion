<?php include('includes/header.php'); ?>
<script src="<?=THEME_URL?>/assets/js/video_upload/jquery.form.js" type="text/javascript"></script>
<div class="container user">
<h4 class="subheadline"><i class="fa fa-edit"></i> Add Video</h4>
	<form method="POST" action="<?=url()?>/store-video" id="MyUploadForm" accept-charset="UTF-8" file="1" enctype="multipart/form-data">

		<div class="panel panel-primary" data-collapsed="0"> 
		
		<?php $title_error = $errors->first('title'); ?>
		
		<?php if (!empty($errors) && !empty($title_error)): ?>
			<div class="alert alert-danger"><?= $errors->first('title'); ?></div>
		<?php endif; ?>

		<div class="panel-heading"> 
			<div class="panel-title">Title</div> <div class="panel-options">
				<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> </div></div> 
			<div class="panel-body" style="display: block;"> 
				<p>Add the video title in the textbox below:</p> 
				<input type="text" class="form-control" name="title" id="title" placeholder="Video Title" value="" />
			</div> 
		</div>


		<div class="panel panel-primary" data-collapsed="0">
			<?php $image_error = $errors->first('image'); ?>
					<?php if (!empty($errors) && !empty($image_error)): ?>
						<div class="alert alert-danger"><?= $errors->first('image'); ?></div>
					<?php endif; ?>
		 <div class="panel-heading"> 
			<div class="panel-title">Video Image Cover</div> <div class="panel-options"> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> </div></div> 
			<div class="panel-body" style="display: block;"> 
									<p>Select the video image (1280x720 px or 16:9 ratio):</p> 
				<input type="file" multiple="true" class="form-control" name="image" id="image" />
				
			</div> 
		</div>

			<div class="panel panel-primary" data-collapsed="0">
				<?php $video_error = $errors->first('video'); ?>
			            <?php if (!empty($errors) && !empty($video_error)): ?>
			                <div class="alert alert-danger"><?= $errors->first('video'); ?></div>
			            <?php endif; ?>
				<div class="panel-heading"> 
					<div class="panel-title">Video Source</div> 
					<div class="panel-options"> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a></div>
				</div>
				
				<div class="panel-body" style="display: block;">
				
					<label for="type" style="float:left; margin-right:10px; padding-top:1px;">Video Format</label>
					<select id="type" name="type">
						<option value="embed">Embed Code</option>
						<option value="file" >Video File</option>
					</select>
					<hr />

					<div class="new-video-file" style="display: none;" >
						<label for="mp4_url">Video File:</label>
						<input type="file" class="form-control" name="video" id="FileInput" value="" />
						<!-- <input type="submit"  id="submit-btn" value="Upload" /> -->
						<img src="<?=THEME_URL?>/assets/img/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
					<div id="progressbox" ><div id="progressbar"></div ><div id="statustxt">0%</div></div>
					</div>

					<div class="new-video-embed" >
						<label for="embed_code">Embed Code:</label>
						<textarea class="form-control" name="embed_code" id="embed_code"></textarea>
					</div>
					<div style="display: none;" id="output"></div>
				</div>
				
			</div>

			<div class="panel panel-primary" data-collapsed="0"> <div class="panel-heading"> 
				<div class="panel-title">Video Details, Links, and Info</div> <div class="panel-options"> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> </div></div> 
				<div class="panel-body" style="display: block; padding:0px;">
					<textarea class="form-control" name="details" id="details"></textarea>
				</div> 
			</div>
		<div class="panel panel-primary" data-collapsed="0"> <div class="panel-heading"> 
				<div class="panel-title">Featured</div> <div class="panel-options"> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> </div></div> 
				<div class="panel-body" style="display: block;">
				<label>Mark as featured</label>
					<input class="checkbox" type="checkbox" value="1" name="featured">
				</div> 
			</div>

			<div class="panel panel-primary" data-collapsed="0"> <div class="panel-heading"> 
				<div class="panel-title">Short Description</div> <div class="panel-options"> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> </div></div> 
				<div class="panel-body" style="display: block;"> 
					<p>Add a short description of the video below:</p> 
					<textarea class="form-control" name="description" id="description"></textarea>
				</div> 
			</div>

			<div class="panel panel-primary" data-collapsed="0"> <div class="panel-heading"> 
				<div class="panel-title">Category</div> <div class="panel-options"> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> </div></div> 
				<div class="panel-body" style="display: block;"> 
					<p>Select a Video Category Below:</p>
					<select id="video_category_id" name="video_category_id">
						<option value="0">Uncategorized</option>
						<?php foreach($video_categories as $category) { ?>
							<option value="<?php echo $category->id?>" <?php if(!empty($video->video_category_id) && $video->video_category_id == $category->id) echo "selected='\selected\'" ?>> 
							<?=$category->name ?></option>
						<?php } ?>
						
					</select>
				</div> 
			</div>


			<div class="clear"></div>

			
				<div class="panel panel-primary" data-collapsed="0"> <div class="panel-heading"> 
				<div class="panel-title">Tags</div> <div class="panel-options"> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> </div></div> 
				<div class="panel-body" style="display: block;"> 
					<p>Add video tags below:</p> 
					<input class="form-control" name="tags" id="tags" value="">
				</div> 
				</div>
			
					<div class="panel panel-primary" data-collapsed="0"> 
						<div class="panel-heading"> <div class="panel-title"> Duration</div> <div class="panel-options"> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> </div></div> 
						<div class="panel-body"> 
							<p>Enter the video duration in the following format (Hours : Minutes : Seconds)</p> 
							<input class="form-control" name="duration" id="duration" value="">
						</div> 
					</div>
							
			
			<input type="hidden" name="_token" value="<?= csrf_token() ?>" />
			<input type="submit" id="submit-btn" value="Add New Video" class="btn btn-success pull-right" />
		</form>
</div>
<link rel="stylesheet" href="<?=url('/application/assets/js/tagsinput/jquery.tagsinput.css')?>" />
<script type="text/javascript" src="<?=url('/application/assets/admin/js/tinymce/tinymce.min.js')?>"></script>
<script type="text/javascript" src="<?=url('/application/assets/js/jquery.mask.min.js')?>"></script>
<script type="text/javascript" src="<?=url('/application/assets/js/tagsinput/jquery.tagsinput.min.js')?>"></script>
<script type="text/javascript">

	jQuery(document).ready(function(){

		jQuery('#duration').mask('00:00:00');
		jQuery('#tags').tagsInput();
		jQuery('#type').change(function(){
			if(jQuery(this).val() == 'file'){
				jQuery('.new-video-file').show();
				jQuery('.new-video-embed').hide();
			} else {
				jQuery('.new-video-file').hide();
				jQuery('.new-video-embed').show();
			}
		});
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
<script type="text/javascript">
$(document).ready(function() {
	var options = { 
			//target:   '#output',   // target element(s) to be updated with server response 
			beforeSubmit:  beforeSubmit,  // pre-submit callback 
			success:       afterSuccess,  // post-submit callback 
			uploadProgress: OnProgress, //upload progress callback 
			resetForm: true        // reset the form after successful submit 
		}; 
		
	 $('#MyUploadForm').submit(function() {
			$(this).ajaxSubmit(options);  			
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}); 
		

//function after succesful file upload (when server response)
function afterSuccess()
{
	toastr.success('The video is under review and be available within 24 hours!');
	window.location.href = "<?=url()?>/my-videos?msg=success";
	/*window.setTimeout(function(){
        window.location.href = "<?=url()?>/my-videos?msg=success";

    }, 5000);*/

	$('#submit-btn').show(); //hide submit button
	$('#loading-img').hide(); //hide submit button
	$('#progressbox').delay( 1000 ).fadeOut(); //hide progress bar

}

//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
		if (jQuery.trim($('#title').val()) == '') {
			toastr.error('Please enter the video title');
			return false
		}
		if (jQuery.trim($('#image').val()) == '') {
			toastr.error('Please upload the video image cover');
			return false
		}
		var iftype = $('#image')[0].files[0].type;
		switch(iftype)
        {
			case 'image/jpeg':
                break;
            case 'image/jpg':
                break;
            case 'image/png':
                break;
            case 'image/gif':
                break;
            default:
                //$("#output").html("<b>"+ftype+"</b> Unsupported file type!");
                toastr.error('Unsupported Image file type!');
				return false
        }
		
		var FileInput = $('#FileInput').val();
		var embed_code = $('#embed_code').val();
		
		if( (jQuery.trim(FileInput) != '') || (jQuery.trim(embed_code) != '')) //check empty input filed
		{
		var fsize = $('#FileInput')[0].files[0].size; //get file size
		var ftype = $('#FileInput')[0].files[0].type; // get file type
		console.log(ftype);
		switch(ftype)
        {
			case 'video/mp4':
                break;
            case 'video/mov':
                break; 
            case 'video/quicktime':
                break;
            default:
                //$("#output").html("<b>"+ftype+"</b> Unsupported file type!");
                toastr.error('Unsupported video file type!');
				return false
        }
		
		//Allowed file size is less than 5 MB (1048576)
		if(fsize>1200000000) 
		{
			$("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big file! <br />File is too big, it should be less than 5 MB.");
			return false
		}
				
		$('#submit-btn').hide(); //hide submit button
		$('#loading-img').show(); //hide submit button
		$("#output").html("");
		}else{
			toastr.error('Please upload the video or enter embed code');
			return false
		}
	}
	else
	{
		//Output error to older unsupported browsers that doesn't support HTML5 File API
		$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
		return false;
	}
}

//progress bar function
function OnProgress(event, position, total, percentComplete)
{
    //Progress bar
	$('#progressbox').show();
    $('#progressbar').width(percentComplete + '%') //update progressbar percent complete
    $('#statustxt').html(percentComplete + '%'); //update status text
    if(percentComplete>50)
        {
            $('#statustxt').css('color','#000'); //change status text to white after 50%
        }
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

}); 

</script>
<?php include('includes/footer.php'); ?>