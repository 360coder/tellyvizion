<?php include('includes/header.php'); ?>
<script type="text/javascript" src="<?=THEME_URL?>/facebook/assets/js/main.js"></script>
<link rel="stylesheet" href="<?=THEME_URL?>/facebook/assets/css/AdminLTE.css">
<script type="text/javascript">
            var PATH       = '<?=url()?>/';
            var token      = '<?=csrf_token();?>';
            var module     = 'facebook';
        </script>
<section class="content-header">
    <h1>
        Manage Page
        <small>List</small>
    </h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-xs-3">
			<a href="<?=url()."/fb-pages/add"?>" class="btn btn-info"><i class="fa fa-plus"></i> Add New</a>
		</div>
		<div class="col-xs-9">
			<div class="btn-group pull-right">
				<button type="button" class="btnStatusAll item-show btn btn-danger"><i class="fa fa-toggle-on"></i> Show</button>
				<button type="button" class="btnStatusAll item-hide btn btn-danger"><i class="fa fa-toggle-off"></i> Hide</button>
				<button type="button" class="btnDeleteAll btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button>
            </div>
		</div>
		<br/>
		<br/>
	</div>
    <div class="row">
    	<div class="col-md-12">
    		<form class="formList">
			    <div class="box">
			        <div class="box-header with-border">
			            <h3 class="box-title"><i class="fa fa-th-list"></i> List page</h3>
			        </div>
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
			                    <th class="text-center">Status</th>
			                    <th class="text-center">Option</th>
			                </tr>
			                <?php 
			                if(!empty($result)){
			                foreach ($result as $key => $row) {
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
			                    	<?php if($row->status != 0){?>
			                        	<span class="text-green" style="font-size: 25px;"><i class="fa fa-toggle-on"></i></span>
			                        <?php }else{?>
			                        	<span class="text-danger" style="font-size: 25px;"><i class="fa fa-toggle-off"></i></span>
			                        <?php }?>
			                    </td>
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