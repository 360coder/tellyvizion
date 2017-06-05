<div class="row">
	<div class="col-md-12">
        <div class="head-title">
            <div class="name">Revenue</div>
            <div class="desc">The total amount got by users</div>
        </div>
		<div class="ajax_revenuechart"></div>
        <div class="foot-title">
            <span><?=$count_views?></span> 
        </div>
	</div>
</div>

<script type="text/javascript">
	$(function(){
    	Analytics.Highcharts({
    		element : '.ajax_revenuechart',
    		titlex  : 'datetime',
    		colorx  : '#00a65a',
    		colory  : '#00a65a',
    		name    : 'Revenue',
    		data    : [<?=!empty($data_views)?$data_views:""?>]
    	});
	});
</script>