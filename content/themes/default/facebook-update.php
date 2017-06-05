<section class="content-header">
    <h1>
        Manage Page
        <small>add new/edit</small>
    </h1>
</section>

<section class="content">
    <div class="box box-danger">
        <form class="formUpdate" role="form">
            <div class="box-body">
                <?php if(empty($pages)){?>
                <div class="form-group wrap-loginFB">
                    <a href="<?=$authUrl?>">
                        <img src="<?=PATH."assets/img/login-facebook.png"?>" alt="Login Facebook" title="Login Facebook">
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
                                            <input type="checkbox" class="icheck" name="pages[]" value="<?=$page->id?>" />
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