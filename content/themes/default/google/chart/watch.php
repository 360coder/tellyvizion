<div class="row">
	<div class="col-md-6">
        <div class="head-title">
            <div class="name">Estimated Minutes Watched</div>
            <div class="desc">The number of minutes that users watched videos</div>
        </div>
		<div class="ajax_estimatedMinutesWatched"></div>
        <div class="foot-title">
            <span><?=$count_estimatedMinutesWatched?></span> Minutes
        </div>
	</div>
    <div class="col-md-6">
        <div class="head-title">
            <div class="name">Average View Duration</div>
            <div class="desc">The average length, in seconds, of video playbacks</div>
        </div>
        <div class="ajax_averageViewDuration"></div>
        <div class="foot-title">
            <span><?=$count_averageViewDuration?></span> Seconds
        </div>
    </div>
</div>

<script type="text/javascript">
	$(function(){
    	Analytics.Highcharts({
    		element : '.ajax_estimatedMinutesWatched',
            titlex  : 'datetime',
    		titley  : '',
    		colorx  : '#e32cbe',
    		colory  : '#e32cbe',
    		name    : 'Minutes',
    		data    : [<?=!empty($data_estimatedMinutesWatched)?$data_estimatedMinutesWatched:""?>]
    	});

        Analytics.Highcharts({
            element : '.ajax_averageViewDuration',
            titlex  : 'datetime',
            titley  : '',
            colorx  : '#f37d21',
            colory  : '#f37d21',
            name    : 'Seconds',
            data    : [<?=!empty($data_averageViewDuration)?$data_averageViewDuration:""?>]
        });
	});
</script>