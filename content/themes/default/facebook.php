<?php include('includes/header.php'); ?>
        <link rel="stylesheet" href="<?=THEME_URL?>/facebook/assets/plugins/datepicker/datepicker3.css">
        <link rel="stylesheet" href="<?=THEME_URL?>/facebook/assets/plugins/daterangepicker/daterangepicker-bs3.css">
<script type="text/javascript" src="<?=THEME_URL?>/facebook/assets/js/main.js"></script>
        <link rel="stylesheet" href="<?=THEME_URL?>/facebook/assets/css/AdminLTE.css">
        <link rel="stylesheet" href="<?=THEME_URL?>/facebook/assets/css/style.css">



 <script type="text/javascript">
            var PATH       = '<?=url()?>';
            var token      = '<?=csrf_token();?>';
            var module     = 'Facebook';
            var list_chart = [];
        </script>
<div class="top-space">

		
		<?php if(isset($page_title)): ?>
			<h3><?= $page_title ?><?php if(isset($page_description)): ?><span><?= $page_description ?></span><?php endif; ?></h3>
		<?php endif; ?>
		<div class="row">
		<?php //print_r($facebook);
		?>

		</div>

<section class="content">
  	<div class="row">
        <div class="col-md-2 p0 box-listCore">
        	<ul class="listCore">
        		<li><a href="#section-1"><i class="fa fa-bar-chart-o text-green"></i> Reach and Impressions</a></li>
        		<li><a href="#section-2"><i class="fa fa-bar-chart-o text-green"></i> Interactive Posts</a></li>
        		<li><a href="#section-3"><i class="fa fa-bar-chart-o text-green"></i> Page and Tab Visits</a></li>
        		<li><a href="#section-4"><i class="fa fa-bar-chart-o text-green"></i> Fans Online</a></li>
        		<li><a href="#section-5"><i class="fa fa-bar-chart-o text-green"></i> Likes & Unlikes</a></li>
        		<li><a href="#section-6"><i class="fa fa-bar-chart-o text-green"></i> Age and Gender</a></li>
        		<li><a href="#section-7"><i class="fa fa-bar-chart-o text-green"></i> Country</a></li>
        		<li><a href="#section-8"><i class="fa fa-bar-chart-o text-green"></i> City</a></li>
        		<li><a href="#section-9"><i class="fa fa-bar-chart-o text-green"></i> Referrers and Sources</a></li>
        	</ul>
        </div>
        <div class="col-md-10">
        	<!--SEARCH-->
        	<section class="head-sort col-lg-12">
	        	<div class="row">
	        		<div class="col-md-12">
	        			<form class="form">
	        				<div class="input-group input-group-sm" style="width: 320px;">
		        				<span class="input-group-btn">
									<div class="btn btn-default"><i class="fa fa-calendar"></i></div>
								</span>
								<?php $date = date('m/d/Y', strtotime(NOW.' -29 day'))." - ".date('m/d/Y', strtotime(NOW.'-1 day'))?>
								<input type="text" class="form-control datepicker daterange" name="daterange" value="<?=(Input::get('daterange') != '')?Input::get('daterange'):$date?>">
								<span class="input-group-btn">
									<button class="btn btn-default btn-flat btnDateRange" type="submit">Submit</button>
								</span>
							</div>
	        			</form>
	        		</div>
	        	</div>
        	</section>			

        	<!--INFO-->
        	<!--INFO-->
        	<?php if(!empty($info)){
        		$info = (object)$info;
        	?>
        	<section class="item-metric col-lg-12" id="section-0">
			    <div class="box box-widget widget-user">
			        <div class="widget-user-header bg-green" style="height: 265px; background: url(<?=(isset($info->cover)?$info->cover["source"]:"")?>) center center;">
			            <h3 class="widget-user-username"><?=$info->name?></h3>
			            <h5 class="widget-user-desc"><?=$info->category?></h5>
			        </div>
			        <div class="widget-user-image" style="top: 209px;">
			            <img class="img-circle" src="<?=(isset($info->picture)?$info->picture["url"]:"")?>" alt="">
			        </div>
			        <div class="box-footer">
			            <div class="row">
			                <div class="col-sm-6 col-xs-6 border-right">
			                    <div class="description-block">
			                        <h5 class="description-header text-red"><?=format_number($info->likes)?></h5>
			                        <span class="description-text">Likes</span>
			                    </div>
			                </div>
			                <div class="col-sm-6 col-xs-6 border-right">
			                    <div class="description-block last">
			                        <h5 class="description-header text-red"><?=format_number($info->talking_about_count)?></h5>
			                        <span class="description-text">Talking About</span>
			                    </div>
			                </div>
			            </div>
			        </div>
				    </div>
			</section>
			<?php }?>

        	<section class="item-metric col-lg-12" id="section-1">
			    <div class="box box-widget">
				    <div class="box-header with-border">
				        <div class="user-block">
				            <img class="img-circle" src="<?=THEME_URL?>/assets/img/icon-reach.png">
				            <span class="username" style="line-height: 40px;">Reach and Impressions</span>
				        </div>
				        <div class="box-tools">
				            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				        </div>
				    </div>
				    <div class="box-body">
				        <div class="reachchart"></div>
				    </div>
				</div>
			</section>

			<section class="item-metric col-lg-12" id="section-2">
			    <div class="box box-widget">
				    <div class="box-header with-border">
				        <div class="user-block">
				            <img class="img-circle" src="<?=THEME_URL?>/assets/img/icon-posts.png">
				            <span class="username" style="line-height: 40px;">Interactive Posts</span>
				        </div>
				        <div class="box-tools">
				            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				        </div>
				    </div>
				    <div class="box-body">
				        <div class="postschart"></div>
				    </div>
				</div>
			</section>
			
			<section class="item-metric col-lg-12" id="section-3">
			    <div class="box box-widget">
				    <div class="box-header with-border">
				        <div class="user-block">
				            <img class="img-circle" src="<?=THEME_URL?>/assets/img/icon-page.png">
				            <span class="username" style="line-height: 40px;">Page and Tab Visits</span>
				        </div>
				        <div class="box-tools">
				            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				        </div>
				    </div>
				    <div class="box-body">
				        <div class="tabchart"></div>
				    </div>
				</div>
			</section>

			<section class="item-metric col-lg-12" id="section-4">
			    <div class="box box-widget">
				    <div class="box-header with-border">
				        <div class="user-block">
				            <img class="img-circle" src="<?=THEME_URL?>/assets/img/icon-fan.png">
				            <span class="username" style="line-height: 40px;">Fans Online</span>
				        </div>
				        <div class="box-tools">
				            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				        </div>
				    </div>
				    <div class="box-body">
				        <div class="fanschart"></div>
				    </div>
				</div>
			</section>

			<section class="item-metric col-lg-12" id="section-5">
			    <div class="box box-widget">
				    <div class="box-header with-border">
				        <div class="user-block">
				            <img class="img-circle" src="<?=THEME_URL?>/assets/img/icon-like.png">
				            <span class="username" style="line-height: 40px;">Likes & Unlikes</span>
				        </div>
				        <div class="box-tools">
				            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				        </div>
				    </div>
				    <div class="box-body">
				        <div class="likeschart"></div>
				    </div>
				</div>
			</section>

			<section class="item-metric col-lg-12" id="section-6">
			    <div class="box box-widget">
				    <div class="box-header with-border">
				        <div class="user-block">
				            <img class="img-circle" src="<?=THEME_URL?>/assets/img/icon-gender.png">
				            <span class="username" style="line-height: 40px;">Age and Gender</span>
				        </div>
				        <div class="box-tools">
				            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				        </div>
				    </div>
				    <div class="box-body">
				        <div class="genderchart"></div>
				    </div>
				</div>
			</section>

			<section class="item-metric col-lg-12" id="section-7">
			    <div class="box box-widget">
				    <div class="box-header with-border">
				        <div class="user-block">
				            <img class="img-circle" src="<?=THEME_URL?>/assets/img/icon-country.png">
				            <span class="username" style="line-height: 40px;">Country</span>
				        </div>
				        <div class="box-tools">
				            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				        </div>
				    </div>
				    <div class="box-body">
				        <div class="countrychart"></div>
				    </div>
				</div>
			</section>
			<section class="item-metric col-lg-12" id="section-8">
			    <div class="box box-widget">
				    <div class="box-header with-border">
				        <div class="user-block">
				            <img class="img-circle" src="<?=THEME_URL?>/assets/img/icon-city.png">
				            <span class="username" style="line-height: 40px;">City</span>
				        </div>
				        <div class="box-tools">
				            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				        </div>
				    </div>
				    <div class="box-body">
				        <div class="citychart"></div>
				    </div>
				</div>
			</section>
			<section class="item-metric col-lg-12" id="section-9">
			    <div class="box box-widget">
				    <div class="box-header with-border">
				        <div class="user-block">
				            <img class="img-circle" src="<?=THEME_URL?>/assets/img/icon-source.png">
				            <span class="username" style="line-height: 40px;">Referrers & Sources</span>
				        </div>
				        <div class="box-tools">
				            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				        </div>
				    </div>
				    <div class="box-body">
				        <div class="sourcechart"></div>
				    </div>
				</div>
			</section>
        </div>
    </div>
</section>
</div>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
 <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <script src="http://code.highcharts.com/stock/highstock.js"></script>
        <script src="<?=THEME_URL?>/facebook/assets/js/modules/map.js"></script>
        <script src="<?=THEME_URL?>/facebook/assets/js/modules/exporting.js"></script>
        <script src="<?=THEME_URL?>/facebook/assets/js/modules/world.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
        <script src="<?=THEME_URL?>/facebook/assets/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="<?=THEME_URL?>/facebook/assets/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="<?=THEME_URL?>/facebook/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <script src="<?=THEME_URL?>/facebook/assets/plugins/fastclick/fastclick.min.js"></script>
        <script src="<?=THEME_URL?>/facebook/assets/js/jquery.scrollsmooth.js"></script>
        <script src="<?=THEME_URL?>/facebook/assets/plugins/iCheck/icheck.min.js"></script>
        <script src="<?=THEME_URL?>/facebook/assets/js/app.js"></script>
        <script src="<?=THEME_URL?>/facebook/assets/js/main.js"></script>
        <script type="text/javascript">
            $(function () {
                $('input.icheck').iCheck({
                    checkboxClass: 'icheckbox_square-red',
                    radioClass: 'iradio_square-red',
                    increaseArea: '20%' // optional
                });
            });
        </script>
<?php include('includes/footer.php'); ?>