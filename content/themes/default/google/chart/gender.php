<div class="row"></div>
<div class="row">
	<div class="col-md-6">
        <div class="head-title">
            <div class="name">Gender</div>
            <div class="desc">The statistics gender on channel</div>
            <div class="ajax_viewsGender"></div>
            <div class="foot-title">
	            <span class="gender-male"></span> Male | <span class='gender-female'></span> Female
	        </div>
        </div>
	</div>
	<div class="col-md-6">
		<div class="head-title">
            <div class="name">Age Group</div>
            <div class="desc">The statistics age group on channel</div>
            <div class="ajax_viewsAgeGroup"></div>
        </div>
	</div>
</div>

<script type="text/javascript">
$(function () {
		Analytics.Highcharts({
            element : '.ajax_viewsAgeGroup',
            height  : 250,
            titlex  : 'datetime',
    		colorx  : '#d73925',
    		colory  : '#333',
	    	type    : 'pie',
    		name    : 'Age Group',
    		data    : [<?=!empty($data_viewsAgeGroup)?$data_viewsAgeGroup:""?>],
    		dataLabels : {
                formatter: function() {
                    return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ Analytics.round(this.percentage,2) +'%'  : null;
                }
            }
        });

        Analytics.Highcharts({
            element : '.ajax_viewsGender',
            height  : 200,
            titlex  : 'datetime',
    		colorx  : '#d73925',
    		colory  : '#333',
	    	type    : 'pie',
    		name    : 'Gender',
    		data    : [<?=!empty($data_viewsGender)?$data_viewsGender:""?>],
    		dataLabels : {
                formatter: function() {
                    return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ Analytics.round(this.percentage,2) +'%'  : null;
                }
            }
        });

        _data = [<?=!empty($data_viewsGender)?$data_viewsGender:""?>];
        $.each(_data, function(index,value){
        	if(value[0] == 'Male'){
        		$('.gender-male').html(value[1]+"%");
        	}else{
        		$('.gender-female').html(value[1]+"%");
        	}
        });
	});
</script>