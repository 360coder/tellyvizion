<?php include('includes/header.php'); ?>
<div class="container">
<script type="text/javascript" src="<?=THEME_URL?>/facebook/assets/js/main.js"></script>
<script type="text/javascript">
            var PATH       = '<?=url()?>/';
            var token      = '<?=csrf_token();?>';
            var module     = 'facebook';
        </script>
<div class="row">
<div class="col-lg-12">
<section class="content-header">
    <h1>
        Manage Page
        <small>add new/edit</small>
    </h1>
</section>
</div>
</div>
<section class="content">
    <div class="box box-danger">
        <form class="formUpdate" role="form">
            <div class="box-body">
                <?php if(empty($pages)){?>
                <div class="form-group wrap-loginFB">
                    <a href="<?=$authUrl?>">
                        <img src="<?=THEME_URL."/assets/img/login-facebook.png"?>" alt="Login Facebook" title="Login Facebook">
                    </a>
                </div>
                <?php }else{?>
                    <div class="col-md-12">
                        <p class="lead">List Page</p>
                    </div>
                    <?php foreach ($pages as $page){?>

                    <div class="col-md-4">
                        <div class="box box-widget widget-user">
                            <div class="widget-user-header bg-blue" style="background: url(<?=(isset($page->cover))?$page->cover->source:""?>) center center;">
                                    <h3 class="widget-user-username"><?=$page->name?></h3>
                                    <h5 class="widget-user-desc"><?=$page->category?></h5>
                            </div>
                            <div class="widget-user-image">
                                    <img class="img-circle" src="<?=$page->picture->data->url?>" alt="User Avatar" style="width: 90px; height: 90px;">
                            </div>
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-sm-12 border-right">
                                        <div class="description-block">
                                            <input type="checkbox" class="icheckk" name="pages[]" value="<?=$page->id?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <?php }?> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="msg"></div>
                        </div>
                    </div>
                <?php }?>
            </div>
            <?php if(!empty($pages)){?>
            <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Submit</button>
            </div>
            <?php }?>
        </form>
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
        </div>
<?php include('includes/footer.php'); ?>