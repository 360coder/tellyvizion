<?php include('includes/header.php'); ?>
<div class="container user">
<h4 class="subheadline"><i class="fa fa-edit"></i>
<?php if(!empty($video->id)) {
 echo "Edit Video"; 
}else{
	echo "Add Video";
} ?>
 </h4>
	<form method="POST" action="<?=url()?>/videos/update" accept-charset="UTF-8" file="1" enctype="multipart/form-data">

		<div class="panel panel-primary" data-collapsed="0"> <div class="panel-heading"> 
	<div class="panel-title">Title</div> <div class="panel-options"> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> </div></div> 
	<div class="panel-body" style="display: block;"> 
		<p>Add the video title in the textbox below:</p> 
		<input type="text" class="form-control" name="title" id="title" placeholder="Video Title" value="<?php if(!empty($video->title)) { echo $video->title; }?>" />
	</div> 
</div>

			<div class="panel panel-primary" data-collapsed="0"> <div class="panel-heading"> 
				<div class="panel-title">Video Image Cover</div> <div class="panel-options"> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> </div></div> 
				<div class="panel-body" style="display: block;"> 
										<p>Select the video image (1280x720 px or 16:9 ratio):</p> 
					<input type="file" multiple="true" class="form-control" name="image" id="image" />
					
				</div> 
			</div>



			<div class="panel panel-primary" data-collapsed="0"> <div class="panel-heading"> 
				<div class="panel-title">Video Details, Links, and Info</div> <div class="panel-options"> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> </div></div> 
				<div class="panel-body" style="display: block; padding:0px;">
					<textarea style="min-height: 260px" class="form-control" name="details" id="details"><?=$video->details?></textarea>
				</div> 
			</div>



			<div class="panel panel-primary" data-collapsed="0"> <div class="panel-heading"> 
				<div class="panel-title">Short Description</div> <div class="panel-options"> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> </div></div> 
				<div class="panel-body" style="display: block;"> 
					<p>Add a short description of the video below:</p> 
					<textarea class="form-control" name="description" id="description"><?=$video->description?></textarea>
				</div> 
			</div>
			<div class="panel panel-primary pull-right" data-collapsed="0"> <div class="panel-heading"> 
				<div class="panel-title">Featured</div> <div class="panel-options"> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> </div></div> 
				<div class="panel-body" style="display: block;">
				<label>Mark as featured</label>
					<input class="checkbox" <?php if($video->featured) echo "checked='checked'";?> type="checkbox" value="1" name="featured">
				</div> 
			</div>

			<div class="panel panel-primary pull-right" data-collapsed="0"> <div class="panel-heading"> 
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


			<div class="row half-six"> 
			<div class="col-sm-6"> 
				<div class="panel panel-primary" data-collapsed="0"> <div class="panel-heading"> 
				<div class="panel-title">Tags</div> <div class="panel-options"> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> </div></div> 
				<div class="panel-body" style="display: block;"> 
					<p>Add video tags below:</p> 
					<input class="form-control" name="tags" id="tags" value="
				<?php if(!empty($video) && $video->tags->count() > 0) {
					 foreach($video->tags as $tag) {
					  echo $tag->name . ', ';
						}
					}?>">
				</div> 
				</div>
			</div>
			<div class="col-sm-6"> 
				<div class="panel panel-primary" data-collapsed="0"> 
					<div class="panel-heading"> <div class="panel-title"> Duration</div> <div class="panel-options"> <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> </div></div> 
					<div class="panel-body"> 
						<p>Enter the video duration in the following format (Hours : Minutes : Seconds)</p> 
						<input class="form-control" name="duration" id="duration" value="<?=$video->duration?>">
					</div> 
				</div>
			</div>				
			</div><!-- row -->
			<input type="hidden" name="user_id" id="user_id" value="<?php echo Auth::user()->id;?>" />
			<input type="hidden" id="id" name="id" value="<?php echo $video->id;?>" />
			<input type="hidden" name="_token" value="<?= csrf_token() ?>" />
			<input type="submit" value="Update Video" class="btn btn-success pull-right" />
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