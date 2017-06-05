<div class="row">
	<div class="col-md-12">
        <div class="head-title">
            <div class="name">Views</div>
            <div class="desc">The number of times that videos was viewed. In a playlist report, the metric indicates the number of times that videos was viewed in the context of a playlist</div>
        </div>
		<div class="ajax_viewchart"></div>
        <div class="foot-title">
            <span><?=$count_views?></span> Views
        </div>
	</div>
</div>

<script type="text/javascript">
	$(function(){
    	Analytics.Highcharts({
    		element : '.ajax_viewchart',
    		titlex  : 'datetime',
    		colorx  : '#00a65a',
    		colory  : '#00a65a',
    		name    : 'Views',
    		data    : [<?=!empty($data_views)?$data_views:""?>]
    	});
	});
</script>