<div class="row">
    <div class="col-md-8">
        <div class="ajax_viewsTopCountry"></div>
    </div>
	<div class="col-md-4">
		<table class="table table-striped table-hover listTopCountry">
            <tbody>
	            <tr>
	                <th style="width: 10px">No.</th>
	                <th>Country</th>
	                <th style="width: 40px">Views</th>
	            </tr>
	            
	        </tbody>
        </table>
	</div>
</div>

<script type="text/javascript">
$(function () {
    Analytics.Highcharts({
        element : '.ajax_viewsTopCountry',
        height  : 400,
        titlex  : 'datetime',
		colorx  : '#d73925',
		colory  : '#333',
    	type    : 'pie',
		name    : 'Country',
		data    : [<?=!empty($data_viewsTopCountry)?$data_viewsTopCountry:""?>],
		dataLabels : {
            formatter: function() {
                return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ Analytics.round(this.percentage,2) +'%'  : null;
            }
        }
    });

    _data = [<?=!empty($data_viewsTopCountry)?$data_viewsTopCountry:""?>];
    $.each(_data, function(index,value){
    	_html = '<tr><td>'+(index+1)+'.</td><td>'+value[0]+'</td><td><span class="badge bg-'+Analytics.colorTop(index+1)+'">'+Analytics.formatNumber(value[1])+'</span></td></tr>';
    	$(".listTopCountry tbody").append(_html);
    });
});
</script>