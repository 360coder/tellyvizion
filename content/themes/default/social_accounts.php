<?php include('includes/header.php'); ?>
<script type="text/javascript" src="<?=THEME_URL?>/facebook/assets/js/main.js"></script>

    <link href="<?=THEME_URL?>/google/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <script type="text/javascript">
        var PATH       = '<?=url()?>/';
        var BASE       = '<?=THEME_URL?>/google/';
        var CURRENT_URL= '<?=url()?>/';
        var list_chart = [];
        var token      = '<?=csrf_token()?>';
        var module     = 'youtube';
        var Lang = {};
        Lang["yes"]     = 'Yes';
        Lang["deleted"] = 'Deleted';
        Lang["selectoneitem"] = 'Select at least one item';
        Lang["selectonemedia"] = 'Select at least one Page/Group/Profile/Friend';
        Lang["emptyTable"] = 'No data available in table';
        Lang["processing"] = 'Processing';
    </script>
	
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">

<script src="<?=THEME_URL?>/assets/js/toastr.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?=THEME_URL?>/assets/css/toast.css">
<?php if(isset($_REQUEST['e'])): ?>
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
	toastr.error('Please Connect your facebook account and then try again');
	</script>
	
<?php endif;?>
<script type="text/javascript">
<?php if(isset($_REQUEST['y'])): ?>
toastr.error('Please Connect your youtube account and then try again');
<?php endif;?>

<?php if(isset($_REQUEST['d'])): ?>
toastr.error('Please Connect your dailymotion account and then try again');
<?php endif;?>
</script>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			
<form class="formSchedule" action="<?=url()?>/youtube_accounts/ajax_action_multiple">
    <div class="row">
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <i class="fa fa-youtube-square" aria-hidden="true"></i> Youtube accounts
                    </h2>
                </div>
                <div class="header">
                	<div class="form-inline">
                        <div class="btn-group" role="group">
                            <div class="btn-group" role="group">
                               
                                <ul class="dropdown-menu">
                                    <li><a class="btnActionModule" data-action="active" href="javascript:void(0);">Active</a></li>
                                    <li><a class="btnActionModule" data-action="disable" href="javascript:void(0);">Deactive</a></li>
                                    <li><a class="btnActionModule" data-action="delete" data-confirm="Are you sure you want to delete this items" href="javascript:void(0);">Delete</a></li>
                                </ul>
                            </div>
                            <a href="<?=Youtube_Login()?>" class="btn bg-light-green waves-effect"><i class="fa fa-plus" aria-hidden="true"></i> Add new</a>
                        </div>
                    </div>
                </div>
                <div class="body p0">
                     <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-dataTable dataTable mb0">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">
                                        <input type="checkbox" id="md_checkbox_211" class="filled-in chk-col-red checkAll">
                                        <label class="p0 m0" for="md_checkbox_211">&nbsp;</label>
                                    </th>
                                    <th>Fullname</th> 
                                    <th>Email</th> 
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                 if(!empty($social_data)){
                                foreach ($social_data as $key => $row) {
                                    foreach ($row->channels as $channel) {
                                ?>
                                <tr class="pending" data-action="<?=url()?>/youtube_accounts/ajax_action_item" data-action-groups="<?=url()?>/youtube_accounts/ajax_get_groups" data-id="<?=$row->id?>">
                                    <td>
                                        <input type="checkbox" name="id[]" id="md_checkbox_<?=$key?>" class="filled-in chk-col-red checkItem" value="<?=$row->id?>">
                                        <label class="p0 m0" for="md_checkbox_<?=$key?>">&nbsp;</label>
                                    </td>
                                    <td><?=$row->first_name?> <?=$row->last_name?></td>
                                    <td><?=$row->email?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                           <a href="<?=url('channels/'.$row->id.'/'.$channel['id'])?>" class="btn btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <button type="button" class="btn bg-light-green waves-effect btnActionModuleItem" data-action="delete" data-confirm="Are you sure you want to delete this item?"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <?php }}}?>
                            </tbody>
                        </table> 
                    </div>  
                </div>
            </div>
        </div>
    </div>
</form>
</div>
		
		<div class="col-md-12">
			<section class="content">
				<div class="row">
					<div class="col-xs-12">
					<h2 class="face-add-new"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</h2>
						<a class="add-space12" href="<?=$authUrl?>">
									<i class="fa fa-plus" aria-hidden="true"></i>Add New
								</a>
					</div>
					
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<form class="formList">
							<div class="box">
							   
								<div class="box-body">
														 <table class="table table-striped">
										<tbody><tr>
											<th style="width: 10px">
												<label>
													<input type="checkbox" class="CheckAll">
												</label>
											</th>
											<th style="width: 10px">No.</th>
											<th>Title</th>
											<th>Page ID</th>
											<th class="text-center">Option</th>
										</tr>
										<?php 
										if(!empty($result_fb)){
										foreach ($result_fb as $key => $row) {
										?>
										<tr data-id="<?=$row->id?>">
											<td>
												<label>
													<input type="checkbox" name="id[]" class="checkItem" value="<?=$row->id?>">
												</label>
											</td>
											<td><?=((int)Input::get('p')*10) + ($key+1)?></td>
											<td><?=$row->name?></td>
											<td><?=$row->fid?></td>

											<td class="text-center">
												<div class="btn-group">
													<a href="<?=url()."/facebook/".$row->fid?>" class="btn btn-default"><i class="fa fa-eye"></i></a>                                       
													<a href="javascript:void(0);" class="btn btn-default btnDelete"><i class="fa fa-trash-o"></i></a>
												</div>
											</td>
										</tr>
										<?php }}else{?>
										<tr>
											<td class="text-center" colspan="6">
												Empty
											</td>
										</tr>
										<?php }?>
									</tbody></table>
								</div><!-- /.box-body -->
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
		
		<!-- -->
		<div class="col-md-12">
			<section class="content">
				<div class="row">
					<div class="col-xs-12">
						<h2 class="dailymotyion-add-new"><a href="<?=url()?>/dailymotion-analytics">Dailymotion</a></h2>
						<!-- <h2 class="face-add-new"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</h2> -->
						<a href="<?=url()?>/dailymotion_save_user" class="add-space12">
							<i class="fa fa-plus" aria-hidden="true"></i>Add New
						</a>
					
						
					</div>
					
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<form class="formList">
							<div class="box">
							   
								<div class="box-body">
									<table class="table table-striped">
										<tbody>
										<tr>
											<th>Profile</th>
											<th>username</th>
											<th>Email</th>
											<th>Total Views</th>
											<th class="text-center">Option</th>
										</tr>
										<?php 
										if(!empty($result_dailymotion_user)){
										foreach ($result_dailymotion_user as $dailymotion) { ?>
										<tr>

											
											<td><img src="<?=$dailymotion->avatar?>" width="50"></td>
											<td><?=$dailymotion->username?></td>
											<td><?=$dailymotion->email?></td>
											<td><?=$dailymotion->views_total?></td>

											<td class="text-center">
												<div class="btn-group">
													
													<a href="<?=url()?>/dailymotion-analytics" class="btn btn-default"><i class="fa fa-eye"></i></a>

																				
													
													<a href="<?=url()?>/dailymotion_analytics_deleteuser/<?=$dailymotion->id ?>" class="btn btn-default btnDeletedaily" onclick="if(!confirm('Are you sure to delete this record?')){return false;}"><i class="fa fa-trash-o"></i></a>
													
													
												</div>
											</td>
										</tr>
										<?php }}else{?>
										<tr>
											<td class="text-center" colspan="6">
												Empty
											</td>
										</tr>
										<?php }?>
									</tbody></table>
								</div><!-- /.box-body -->
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
		<!-- -->
		<!--<a title="Delete" href="<?//=base_url('users')?>/delete/id/<?//=$user['id'];?>" onclick="if(!confirm('Are you sure to delete this record?')){return false;}">
                                                           <i class="fa fa-eraser"></i>
                                                        </a>-->
		<!--
		<div class="col-md-12">
			<h2 class="dailymotyion-add-new"><a href="<?=url()?>/dailymotion-analytics">Dailymotion</a></h2>
		</div>
		-->
		
		<div class="col-md-12">
			<h2 class="tellyvizion-add-new"><a href="<?=url()?>/tellyvizion-analytics">Tellyvizion</a></h2>
		</div>
		
	</div>
	
</div>

    <script src="<?=THEME_URL?>/google/assets/plugins/momentjs/moment.js"></script>
    <script src="<?=THEME_URL?>/google/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="<?=THEME_URL?>/google/assets/plugins/jquery-datatable/jquery.dataTables.js"></script>

    <script src="<?=THEME_URL?>/google/assets/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- Custom Js -->
    <script src="<?=THEME_URL?>/google/assets/js/script.js"></script>
    <?php include('includes/footer.php'); ?>