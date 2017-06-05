<div class="row">
	<div class="col-md-12">
        <div class="head-title">
            <div class="name">Annotation Impressions</div>
            <div class="desc">The total number of annotation impressions</div>
        </div>
		<div class="ajax_annotationImpressions"></div>
        <div class="foot-title">
            <span><?=$count_annotationImpressions?></span> Annotation impressions
        </div>
	</div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="head-title">
            <div class="name">Annotation Clicks And Closes Impressions</div>
            <div class="desc">The number of annotations that appeared and could be clicked or closed</div>
        </div>
        <div class="ajax_annotationClickableImpressions"></div>
        <div class="foot-title">
            <span><?=$count_annotationClickableImpressions?></span> clicks | <span><?=$count_annotationClosableImpressions?></span> closed
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="head-title">
            <div class="name">Annotation Clicks And Closes</div>
            <div class="desc">The number of clicked and closed annotations</div>
        </div>
        <div class="ajax_annotationClicks"></div>
        <div class="foot-title">
            <span><?=$count_annotationClicks?></span> clicks | <span><?=$count_annotationCloses?></span> closed
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="head-title">
            <div class="name">Annotation Click Through And Close Rate</div>
            <div class="desc">The ratio of annotations that viewers clicked or closed to the total number of clickable annotation impressions</div>
        </div>
        <div class="ajax_annotationClickThroughRate"></div>
    </div>
</div>

<script type="text/javascript">
	$(function(){
    	Analytics.Highcharts({
    		element : '.ajax_annotationImpressions',
            titlex  : 'datetime',
    		colorx  : '#d73925',
    		colory  : '#333',
	    	type    : 'line',
    		name    : 'Annotation Impressions',
    		data    : [<?=!empty($data_annotationImpressions)?$data_annotationImpressions:""?>]
    	});

        Analytics.Highcharts({
            element : '.ajax_annotationClickableImpressions',
            titlex  : 'datetime',
            crosshairs : true,
            multi   : true,
            data    : [{
                type   : 'spline',
                color  : '#00c0ef',
                name   : "Annotation Clickable Impressions",
                data   : [<?=!empty($data_annotationClickableImpressions)?$data_annotationClickableImpressions:""?>]
            },{
                type   : 'spline',
                color  : '#f39c12',
                name   : "Annotation Closable Impressions",
                data   : [<?=!empty($data_annotationClosableImpressions)?$data_annotationClosableImpressions:""?>]
            }]
        });

        Analytics.Highcharts({
            element : '.ajax_annotationClicks',
            titlex  : 'datetime',
            crosshairs : true,
            multi   : true,
            data    : [{
                type   : 'spline',
                color  : '#00a65a',
                name   : "Annotation Clicks",
                data   : [<?=!empty($data_annotationClicks)?$data_annotationClicks:""?>]
            },{
                type   : 'spline',
                color  : '#dd4b39',
                name   : "Annotation Closes",
                data   : [<?=!empty($data_annotationCloses)?$data_annotationCloses:""?>]
            }]
        });

        Analytics.Highcharts({
            element : '.ajax_annotationClickThroughRate',
            titlex  : 'datetime',
            crosshairs : true,
            multi   : true,
            data    : [{
                type   : 'spline',
                color  : '#00a65a',
                name   : "Annotation Click Through Rate",
                data   : [<?=!empty($data_annotationClickThroughRate)?$data_annotationClickThroughRate:""?>]
            },{
                type   : 'spline',
                color  : '#00c0ef',
                name   : "Annotation Close Rate",
                data   : [<?=!empty($data_annotationCloseRate)?$data_annotationCloseRate:""?>]
            }]
        });
	});
</script>