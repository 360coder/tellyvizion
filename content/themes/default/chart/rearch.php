<div class="row">
	<div class="col-md-12">
        <div class="head-title">
            <div class="name">Reach and Impressions</div>
            <div class="desc">The number of people who saw any of your Page posts and impressions that came from all of your posts</div>
        </div>
		<div class="ajax_rearchchart"></div>
        <div class="foot-title">
            <span class="total_reach"></span> Reach | <span class="total_impressions"></span> Impressions
        </div>
	</div>
    <div class="col-md-12">
        <div class="head-title">
            <div class="name">Page Reach Breakdown By Type</div>
            <div class="desc">Number of people who saw a sponsored story or Ad about your Page and people who visited your Page, or saw your Page or one of its posts in News Feed or Ticker. These impressions can be Fans or non-Fans.</div>
        </div>
        <div class="ajax_rearchpaidchart"></div>
        <div class="foot-title">
            <span class="total_reach_paid"></span> Paid Reach | <span class="total_reach_organic"></span> Organic Reach
        </div>
    </div>
    <div class="col-md-12">
        <div class="head-title">
            <div class="name">Page Impressions Breakdown By Type</div>
            <div class="desc">The number of impressions of a Sponsored Story or Ad pointing to your Page and The number of times your posts were seen in News Feed or Ticker or on visits to your Page.</div>
        </div>
        <div class="ajax_impressionspaidchart"></div>
        <div class="foot-title">
            <span class="total_impressions_paid"></span> Paid Impressions | <span class="total_impressions_organic"></span> Organic Impressions
        </div>
    </div>
</div>

<script type="text/javascript">
	$(function(){
        var data_reach               = [<?=!empty($data_reach)?$data_reach:""?>];
        var data_impressions         = [<?=!empty($data_impressions)?$data_impressions:""?>];
        var data_reach_paid          = [<?=!empty($data_reach_paid)?$data_reach_paid:""?>];
        var data_reach_organic       = [<?=!empty($data_reach_organic)?$data_reach_organic:""?>];
        var data_impressions_paid    = [<?=!empty($data_impressions_paid)?$data_impressions_paid:""?>];
        var data_impressions_organic = [<?=!empty($data_impressions_organic)?$data_impressions_organic:""?>];

    	Main.Highcharts({
            element : '.ajax_rearchchart',
            titlex  : 'datetime',
            crosshairs : true,
            multi   : true,
            data    : [{
                type   : 'spline',
                color  : '#00a65a',
                name   : "Reach",
                data   : data_reach
            },{
                type   : 'spline',
                color  : '#dd4b39',
                name   : "Impressions",
                data   : data_impressions
            }]
        });

        Main.Highcharts({
            element : '.ajax_rearchpaidchart',
            titlex  : 'datetime',
            crosshairs : true,
            multi   : true,
            data    : [{
                type   : 'spline',
                color  : '#0066ff',
                name   : "Paid Reach",
                data   : data_reach_paid
            },{
                type   : 'spline',
                color  : '#ff8a00',
                name   : "Organic Reach",
                data   : data_reach_organic
            }]
        });

        Main.Highcharts({
            element : '.ajax_impressionspaidchart',
            titlex  : 'datetime',
            crosshairs : true,
            multi   : true,
            data    : [{
                type   : 'spline',
                color  : '#333333',
                name   : "Paid Impressions",
                data   : data_impressions_paid
            },{
                type   : 'spline',
                color  : '#ff006c',
                name   : "Organic Impressions",
                data   : data_impressions_organic
            }]
        });

        Main.CountValue("total_reach",data_reach);
        Main.CountValue("total_impressions",data_impressions);
        Main.CountValue("total_reach_paid",data_reach_paid);
        Main.CountValue("total_reach_organic",data_reach_organic);
        Main.CountValue("total_impressions_paid",data_impressions_paid);
        Main.CountValue("total_impressions_organic",data_impressions_organic);
	});
</script>