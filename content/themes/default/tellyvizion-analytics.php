<?php include('includes/header.php'); ?>
<?php include('tellyvizion/tellyvizion_header_scripts.php'); ?><div class="analytics-page">
    <div class="col-md-2 p0 box-listCore">
        <ul class="listCore">
            <li><a href="#section-0"><i class="fa fa-bar-chart-o text-green"></i> Information</a></li>
            <li><a href="#section-1"><i class="fa fa-bar-chart-o text-green"></i> Views</a></li>
            <li><a href="#section-3"><i class="fa fa-bar-chart-o text-green"></i> Engagement</a></li>
            <li><a href="#section-4"><i class="fa fa-bar-chart-o text-green"></i> Revenue</a></li>

        </ul>
    </div>
    <div class="col-md-10">
        <!--SEARCH-->
        <section class="head-sort">
            <div class="row">
                <div class="col-md-4">
                    <form class="form form-daterange">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-line">
                                <?php $date = date('m/d/Y', strtotime(NOW.' -28 day'))." - ".date('m/d/Y', strtotime(NOW))?>
                                <input type="text" name="daterange" class="form-control daterange" value="<?=(Input::get('daterange') != '')?Input::get('daterange'):$date?>">
                            </div>
                            <span class="input-group-addon">
                                <button type="submit">Submit</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </section>          

        <!--INFO-->
        <?php if(!empty($channel)){?>
        <section class="item-metric" id="section-0">
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-black" style="height: 175px; background: url(<?=$channel->brandingSettings->image->bannerImageUrl?>) center center;">
                    <h3 class="widget-user-username"><?=$channel->snippet->title?></h3>
                    <h5 class="widget-user-desc">channel</h5>
                </div>
                <div class="widget-user-image" style="top: 120px;">
                    <img class="img-circle" src="<?=$channel->snippet->thumbnails->high->url?>" alt="<?=$channel->snippet->title?>">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 col-xs-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header text-red"><?=format_number($info[1] - $info[2])?></h5>
                                <span class="description-text">SUBSCRIBERS</span>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header text-red"><?=format_number($info[0])?></h5>
                                <span class="description-text">VIEWS</span>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-4">
                            <div class="description-block">
                                <h5 class="description-header text-red"><?=format_number($channel->statistics->videoCount)?></h5>
                                <span class="description-text">VIDEOS</span>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
        </section>
        <?php }?>

        <!--VIEWS-->
        <section class="item-metric" id="section-1">
            <div class="box box-widget">
                <div class="box-header with-border">
                    <div class="user-block">
                        <img class="img-circle" src="<?=THEME_URL?>/google/assets/images/icon-view.png">
                        <span class="username">Views</span>
                        <span class="description">Viewed by day statistics</span>
                    </div>
                </div>
                <div class="box-body">
                    <div class="viewchart"></div>
                </div>
            </div>
        </section>


        <!--ENGAGEMENT-->
        <section class="item-metric" id="section-3">
            <div class="box box-widget">
                <div class="box-header with-border">
                    <div class="user-block">
                        <img class="img-circle" src="<?=THEME_URL?>/google/assets/images/icon-engagement.png">
                        <span class="username">Engagement</span>
                        <span class="description">The statistics engagement plays on videos</span>
                    </div>
                </div>
                <div class="box-body">
                    <div class="engagementchart"></div>
                </div>
            </div>
        </section>

  <!--Revenue-->
        <section class="item-metric" id="section-4">
            <div class="box box-widget">
                <div class="box-header with-border">
                    <div class="user-block">
                        <img class="img-circle" src="<?=THEME_URL?>/google/assets/images/icon-engagement.png">
                        <span class="username">Revenue</span>
                        <span class="description">The total amount got by users</span>
                    </div>
                </div>
                <div class="box-body">
                    <div class="revenuechart"></div>
                </div>
            </div>
        </section>

      
    </div>
</div>

<?php include('tellyvizion/tellyvizion_footer_scripts.php'); ?>
<?php include('includes/footer.php'); ?>