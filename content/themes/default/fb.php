

<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="<?=THEME_URL?>/facebook/assets/css/AdminLTE.css">
<div class="container">
<section class="content-header">
    <div class="row">
		<div class="col-md-12">
    		<h2>
		        View Facebook Pages
		    </h2>
	    </div>
	    
    </div>
</section>
</div>

<div class="container">
<section class="content">
    <div class="row">
    	<?php if(!empty($result)){
    		foreach ($result as $row) {
    	?>
    	<div class="col-md-4">
    		<a href="<?=url()."/facebook/".$row->fid?>" title="">
	    		<div class="box box-widget widget-user">
				    <div class="widget-user-header bg-blue" style="background: url(<?=$row->data->banner?>) center center;">
				        <h3 class="widget-user-username"><?=$row->name?></h3>
				        <h5 class="widget-user-desc"><?=$row->data->category?></h5>

				    </div>
				    <div class="widget-user-image">
				        <img class="img-circle" src="<?=$row->data->avatar?>" style="width:90px; height: 90px;" alt="User Avatar">
				    </div>
				    
				    <div class="box-footer">
				        <div class="row">
				            <div class="col-sm-6 col-xs-6 border-right">
				                <div class="description-block">
				                    <h5 class="description-header text-red"><?=number_format($row->data->likes)?></h5>
				                    <span class="description-text text-black">LIKES</span>
				                </div>
				            </div>
			             	<div class="col-sm-6 col-xs-6 border-right">
				                <div class="description-block">
				                    <h5 class="description-header text-red"><?=number_format($row->data->talking_about_count)?></h5>
				                    <span class="description-text text-black">TALKING ABOUT</span>
				                </div>
				            </div>
				        </div>
				    </div>
				</div>
			</a>
    	</div>
    	<?php }}else{?>
    		<p class="lead text-center">Empty data</p>
    	<?php }?>
    </div>
</section>
</div>
<?php include('includes/footer.php'); ?>