<div class="row">
	<div class="col-md-12">
        <div class="head-title">
            <div class="name">Subscribers</div>
            <div class="desc">The number of times that users subscribed or unsubscribed to a channel</div>
        </div>
		<div class="ajax_subscribersGained"></div>
        <div class="foot-title">
            <span><?=$count_subscribersGained?></span> Subscribers | <span><?=$count_subscribersLost?></span> Unsubscribed
        </div>
	</div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="head-title">
            <div class="name">Likes</div>
            <div class="desc">The number of times that users indicated that they liked disliked videos by giving it a positive rating or disliked a video by giving it a negative rating</div>
        </div>
        <div class="ajax_likes"></div>
        <div class="foot-title">
            <span><?=$count_likes?></span> Likes | <span><?=$count_dislikes?></span> Dislikes
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="head-title">
            <div class="name">Videos on Playlists</div>
            <div class="desc">The number of times that videos were added to any and removed from any YouTube playlists</div>
        </div>
        <div class="ajax_videosAddedToPlaylists"></div>
        <div class="foot-title">
            <span><?=$count_videosAddedToPlaylists?></span> Videos Added To Playlists | <span><?=$count_videosRemovedFromPlaylists?></span> Videos Removed From Playlists
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="head-title">
            <div class="name">Commment</div>
            <div class="desc">The number of times that users commented on videos</div>
        </div>
        <div class="ajax_comments"></div>
        <div class="foot-title">
            <span><?=$count_comments?></span> Comments
        </div>
    </div>
    <div class="col-md-6">
        <div class="head-title">
            <div class="name">Shares</div>
            <div class="desc">The number of times that users shared on videos</div>
        </div>
        <div class="ajax_shares"></div>
        <div class="foot-title">
            <span><?=$count_shares?></span> Shares
        </div>
    </div>
</div>

<script type="text/javascript">
	$(function(){
    	Analytics.Highcharts({
    		element : '.ajax_subscribersGained',
            titlex  : 'datetime',
    		titley  : '',
            colorx  : '#fff',
            crosshairs : true,
            multi   : true,
    		data    : [{
                type   : 'spline',
                color  : '#00a65a',
                name   : "subscribers Gaine",
                data   : [<?=!empty($data_subscribersGained)?$data_subscribersGained:""?>]
            },{
                type   : 'spline',
                color  : '#dd4b39',
                name   : "subscribers Lost",
                data   : [<?=!empty($data_subscribersLost)?$data_subscribersLost:""?>]
            }]
    	});

        Analytics.Highcharts({
            element : '.ajax_likes',
            titlex  : 'datetime',
            titley  : '',
            crosshairs : true,
            type    : 'area',
            multi   : true,
            data    : [{
                type   : 'spline',
                color  : '#00c0ef',
                name   : "Likes",
                data   : [<?=!empty($data_likes)?$data_likes:""?>]
            },{
                type   : 'spline',
                color  : '#d2d6de',
                name   : "Dislikes",
                data   : [<?=!empty($data_dislikes)?$data_dislikes:""?>]
            }]
        });

        Analytics.Highcharts({
            element : '.ajax_videosAddedToPlaylists',
            titlex  : 'datetime',
            titley  : '',
            colorx  : '#fff',
            crosshairs : true,
            multi   : true,
            data    : [{
                type   : 'spline',
                color  : '#00a65a',
                name   : "Videos Added To Playlists",
                data   : [<?=!empty($data_videosAddedToPlaylists)?$data_videosAddedToPlaylists:""?>]
            },{
                type   : 'spline',
                color  : '#dd4b39',
                name   : "Videos Removed From Playlists",
                data   : [<?=!empty($data_videosRemovedFromPlaylists)?$data_videosRemovedFromPlaylists:""?>]
            }]
        });

        Analytics.Highcharts({
            element : '.ajax_comments',
            titlex  : 'datetime',
            titley  : '',
            colorx  : '#00a65a',
            colory  : '#00a65a',
            type    : 'line',
            name    : 'Comments',
            data    : [<?=!empty($data_comments)?$data_comments:""?>]
        });

        Analytics.Highcharts({
            element : '.ajax_shares',
            titlex  : 'datetime',
            titley  : '',
            colorx  : '#f39c12',
            colory  : '#f39c12',
            type    : 'line',
            name    : 'Shares',
            data    : [<?=!empty($data_shares)?$data_shares:""?>]
        });
	});
</script>