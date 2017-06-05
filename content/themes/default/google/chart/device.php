<div class="row">
    <div class="col-md-12">
        <div class="head-title">
            <div class="name">Device Type</div>
            <div class="desc">This statistics aggregates viewing statistics based on the manner in which viewers reached your playlist content</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="ajax_deviceType"></div>
    </div>
    <div class="col-md-4">
        <div class="table-responsive box-listdeviceType">
            <table class="table table-striped table-hover listdeviceType">
                <tbody>
                    <tr>
                        <th style="width: 10px">No.</th>
                        <th>Device Type</th>
                        <th style="width: 40px">Total</th>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="head-title">
            <div class="name">Operating System</div>
            <div class="desc">The statistics aggregates viewing statistics based on viewers' operating systems</div>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-md-8">
        <div class="ajax_operatingSystem"></div>
	</div>
	<div class="col-md-4">
        <div class="table-responsive box-listoperatingSystem">
            <table class="table table-striped table-hover listoperatingSystem">
                <tbody>
                    <tr>
                        <th style="width: 10px">No.</th>
                        <th>Operating System</th>
                        <th style="width: 40px">Total</th>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function () {
		Analytics.Highcharts({
            element : '.ajax_deviceType',
            height  : 300,
            titlex  : 'datetime',
    		colorx  : '#d73925',
    		colory  : '#333',
	    	type    : 'pie',
    		name    : 'Device Type',
    		data    : [<?=!empty($data_deviceType)?$data_deviceType:""?>],
    		dataLabels : {
                formatter: function() {
                    return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ Analytics.round(this.percentage,2) +'%'  : null;
                }
            }
        });

        Analytics.Highcharts({
            element : '.ajax_operatingSystem',
            height  : 300,
            titlex  : 'datetime',
    		colorx  : '#d73925',
    		colory  : '#333',
	    	type    : 'pie',
    		name    : 'Operating System',
    		data    : [<?=!empty($data_operatingSystem)?$data_operatingSystem:""?>],
    		dataLabels : {
                formatter: function() {
                    return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ Analytics.round(this.percentage,2) +'%'  : null;
                }
            }
        });

        _data = [<?=!empty($data_operatingSystem)?$data_operatingSystem:""?>];
        $.each(_data, function(index,value){
            _html = '<tr><td>'+(index+1)+'.</td><td>'+value[0]+'</td><td><span class="badge bg-'+Analytics.colorTop(2)+'">'+Analytics.formatNumber(value[1])+'</span></td></tr>';
            $(".listoperatingSystem tbody").append(_html);
        });

        _data = [<?=!empty($data_deviceType)?$data_deviceType:""?>];
        $.each(_data, function(index,value){
            _html = '<tr><td>'+(index+1)+'.</td><td>'+value[0]+'</td><td><span class="badge bg-'+Analytics.colorTop(2)+'">'+Analytics.formatNumber(value[1])+'</span></td></tr>';
            $(".listdeviceType tbody").append(_html);
        });

        $('.box-listoperatingSystem,.box-listdeviceType').slimScroll({
            height: '300px'
        });

	});
</script>