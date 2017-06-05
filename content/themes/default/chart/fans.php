<div class="row">
	<div class="col-md-12">
        <div class="head-title">
            <div class="name">FANS ONLINE BY HOUR</div>
            <div class="desc">The number of your fans who saw any posts on Facebook on a given day, broken down by hour of day in PST.</div>
        </div>
		<div class="ajax_fanshour"></div>
        <div class="foot-title">
            <span class="total_most_hour"></span><span>:00</span> Most Online Time
        </div>
	</div>
	<div class="col-md-12">
        <div class="head-title">
            <div class="name">FANS ONLINE BY DAY</div>
            <div class="desc">The number of your fans who saw any posts on Facebook on a given day.</div>
        </div>
        <div class="ajax_fansday"></div>
        <div class="foot-title">
            <span class="total_fans_day"></span> Fans Online
        </div>
	</div>
</div>

<script type="text/javascript">
$(function(){
    var data_fanshour = [<?=!empty($data_fanshour)?$data_fanshour:""?>];
    var data_fansday  = [<?=!empty($data_fansday)?$data_fansday:""?>];
    Main.Highcharts({
        element : '.ajax_fanshour',
        titlex  : 'nummber',
        titley  : '',
        colorx  : '#00a65a',
        colory  : '#00a65a',
        type    : 'column',
        formatterx: 'text',
        name    : 'Hour',
        tick    : 1,
        data    : data_fanshour
    });

    Main.Highcharts({
        element : '.ajax_fansday',
        titlex  : 'datetime',
        titley  : '',
        colorx  : '#00a65a',
        colory  : '#00a65a',
        type    : 'line',
        name    : 'Hour',
        data    : data_fansday
    });

    Main.MostValue("total_most_hour", data_fanshour);
    Main.CountValue("total_fans_day", data_fanshour);
});
</script>