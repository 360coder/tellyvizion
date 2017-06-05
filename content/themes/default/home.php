<?php include('includes/header.php'); ?>

<style type="text/css">
/*#home-content{
	margin-top:850px;
}*/
ul.video_list{
	margin:0px;
	padding:0px;
}

.video_list li{
	display:inline;
	list-style: none;
}
</style>

 <?php include('partials/slider.php'); ?>

<div class="container-fluid">

	<div id="home-content">
		
		<!-- <h3>Checkout our Latest Videos Below</h3> -->
		<div class="row">

			<?php //include('partials/video-loop.php'); ?>
			<ul class="home-img-content">
			 
				<li><p class="top-11"></p><p>We are an independent<br/> artist community</p>
				<span><i class="fa fa-clock-o" aria-hidden="true"></i>
sign up</span>
				</li>
				<li><img src="<?=url()?>/content/themes/default/assets/img/h3.png"><div class="arrow-down"></div></li>
				<li><p>Get funding for <br/>projects and keep all<br/> that you earn</p><span><img src="<?=url()?>/content/themes/default/assets/img/jar.jpg">Tip Jar</span></li>
				<li><img src="<?=url()?>/content/themes/default/assets/img/5.png"><div class="arrow-down"></div>
				
				</li>
				<li><img src="<?=url()?>/content/themes/default/assets/img/h2.png"><!-- <span class="img198">We are an independent artist community</span> --><div class="arrow-down"></div></li>
				<li><p>100% vetted content </p><span><i class="fa fa-navicon" aria-hidden="true"></i>create your playlist</span></li>
				
				<li><img src="<?=url()?>/content/themes/default/assets/img/h1.jpg"><!-- <span class="img198">Support independant storylling art through you generousity</span> --><div class="arrow-down"></div></li>
				<li><p>Our dashboard allows you to manage your career with just the click of a button</p><div class="arrow-down"></div>
				<span><i class="fa fa-dashboard" aria-hidden="true"></i>dashboard</span></li>

			</ul>
		
		</div>

	</div>

	<?php include('partials/pagination.php'); ?>

</div>


   


<?php include('includes/footer.php'); ?>