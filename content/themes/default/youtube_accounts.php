<?php include('includes/header.php'); ?>
<?php include('google/google_header_scripts.php'); ?>
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
                                <button type="button" class="btn bg-red waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                    <span class="caret"></span>
                                </button> 
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
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(!empty($result)){
                                foreach ($result as $key => $row) {
                                ?>
                                <tr class="pending" data-action="<?=url()?>/youtube_accounts/ajax_action_item" data-action-groups="<?=url()?>/youtube_accounts/ajax_get_groups" data-id="<?=$row->id?>">
                                    <td>
                                        <input type="checkbox" name="id[]" id="md_checkbox_<?=$key?>" class="filled-in chk-col-red checkItem" value="<?=$row->id?>">
                                        <label class="p0 m0" for="md_checkbox_<?=$key?>">&nbsp;</label>
                                    </td>
                                    <td><?=$row->first_name?> <?=$row->last_name?></td>
                                    <td><?=$row->email?></td>
                                    <td style="width: 60px;">
                                        <div class="switch">
                                            <label><input type="checkbox" class="btnActionModuleItem" <?=$row->account_status==1?"checked":""?>><span class="lever switch-col-light-blue"></span></label>
                                        </div>
                                    </td>
                                    <td style="width: 80px;">
                                        <div class="btn-group" role="group">
                                            <a href="<?=url('youtube_accounts/update?id='.$row->id)?>" class="btn bg-light-green waves-effect"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <button type="button" class="btn bg-light-green waves-effect btnActionModuleItem" data-action="delete" data-confirm="Are you sure you want to delete this item?"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <?php }}?>
                            </tbody>
                        </table> 
                    </div>  
                </div>
            </div>
        </div>
    </div>
</form>

<style type="text/css">
    .table-responsive .row{
        margin-left: 0!important;
        margin-right: 0!important;
    }

    .table-responsive .col-md-12, .table-responsive .col-sm-12{
        padding-left: 0!important;
        padding-right: 0!important;
    }
</style>
<?php include('google/google_footer_scripts.php'); ?>
<?php include('includes/footer.php'); ?>