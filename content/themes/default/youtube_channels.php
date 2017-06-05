<?php include('includes/header.php'); ?>
<?php include('google/google_header_scripts.php'); ?>
<div class="container">
<form class="ScheduleList" action="<?url()?>/channels/ajax_action_multiple">
    <div class="row">
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="block-header">
                <h2>LIST CHANNEL</h2>
            </div>
            <div class="row">
            <?php if(!empty($result)){
                //pr($result);
                foreach ($result as $row) {
                    if(!empty($row->channels)){
                        foreach ($row->channels as $channel) {
            ?>
            <a href="<?=url('channels/'.$row->id.'/'.$channel['id'])?>" title="">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-2 bg-red hover-zoom-effect mb0">
                        <div class="icon">
                            <img style="width: 65px; margin-top: 8px;" src="<?=$channel['thumbnail']?>" title="" alt="">
                        </div>
                        <div class="content">
                            <div class="text">Channel</div>
                            <div class="number" style="font-size: 18px; line-height: 20px;"><?=$channel['title']?></div>
                        </div>
                    </div>

                    <ul class="list-group">
                        <li class="list-group-item">Subscribers <span class="badge bg-pink"><?=$channel['subscriberCount']?></span></li>
                        <li class="list-group-item">Views <span class="badge bg-cyan"><?=$channel['viewCount']?></span></li>
                        <li class="list-group-item">Videos <span class="badge bg-teal"><?=$channel['videoCount']?></span></li>
                        <li class="list-group-item">Comment <span class="badge bg-orange"><?=$channel['commentCount']?></span></li>
                    </ul>
                </div>
            </a>
            <?php }}}}?>
            </div>
        </div>
    </div>
</form>
</div>
<?php include('google/google_footer_scripts.php'); ?>
<?php include('includes/footer.php'); ?>