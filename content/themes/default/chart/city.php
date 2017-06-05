<div class="row">
    <div class="head-title">
        <div class="name">Page Fans City</div>
        <div class="desc">Aggregated Facebook location data, sorted by city, about the people who like your Page.</div>
    </div>
    <div class="col-md-8">
        <div class="ajax_fans_city"></div>
    </div>
    <div class="col-md-4">
        <div class="table-responsive box-listcity">
            <table class="table table-striped table-hover listcity">
                <tbody>
                    <tr>
                        <th style="width: 10px">No.</th>
                        <th>city</th>
                        <th style="width: 40px">Total</th>
                     </tr>
                    <?php if(!empty($data_page_fans_city['result'])){
                        $count = 0;
                        $result = $data_page_fans_city['result'];
                        foreach ($result as $key => $row) {
                            switch ($count) {
                                case 0:
                                    $color = "text-red";
                                    break;
                                case 1:
                                    $color = "text-green";
                                    break;
                                case 2:
                                    $color = "text-blue";
                                    break;
                                default:
                                    $color = "";
                                    break;
                            }
                    ?>
                    <tr>
                        <td style="width: 10px"><?=$count+1?></td>
                        <td><?=$key?></td>
                        <td style="width: 40px" class="<?=$color?>"><?=format_number($row)?></td>
                    </tr>
                    <?php $count++; }}?>
                    
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row mt40">
    <div class="head-title">
        <div class="name">Page Storytellers By City</div>
        <div class="desc">The number of People Talking About the Page by user city.</div>
    </div>
    <div class="col-md-8">
        <div class="ajax_page_storytellers_by_city"></div>
    </div>
    <div class="col-md-4">
        <div class="table-responsive box-listcity">
            <table class="table table-striped table-hover listcity">
                <tbody>
                    <tr>
                        <th style="width: 10px">No.</th>
                        <th>city</th>
                        <th style="width: 40px">Total</th>
                     </tr>
                    <?php if(!empty($data_page_storytellers_by_city['result'])){
                        $count = 0;
                        $result = $data_page_storytellers_by_city['result'];
                        foreach ($result as $key => $row) {
                            switch ($count) {
                                case 0:
                                    $color = "text-red";
                                    break;
                                case 1:
                                    $color = "text-green";
                                    break;
                                case 2:
                                    $color = "text-blue";
                                    break;
                                default:
                                    $color = "";
                                    break;
                            }
                    ?>
                    <tr>
                        <td style="width: 10px"><?=$count+1?></td>
                        <td><?=$key?></td>
                        <td style="width: 40px" class="<?=$color?>"><?=format_number($row)?></td>
                    </tr>
                    <?php $count++; }}?>
                    
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row mt40">
    <div class="head-title">
        <div class="name">Page Reach By City</div>
        <div class="desc">The number of people who have seen any content associated with your Page by city.</div>
    </div>
    <div class="col-md-8">
        <div class="ajax_page_impressions_by_city_unique"></div>
    </div>
    <div class="col-md-4">
        <div class="table-responsive box-listcity">
            <table class="table table-striped table-hover listcity">
                <tbody>
                    <tr>
                        <th style="width: 10px">No.</th>
                        <th>city</th>
                        <th style="width: 40px">Total</th>
                     </tr>
                    <?php if(!empty($data_page_impressions_by_city_unique['result'])){
                        $count = 0;
                        $result = $data_page_impressions_by_city_unique['result'];
                        foreach ($result as $key => $row) {
                            switch ($count) {
                                case 0:
                                    $color = "text-red";
                                    break;
                                case 1:
                                    $color = "text-green";
                                    break;
                                case 2:
                                    $color = "text-blue";
                                    break;
                                default:
                                    $color = "";
                                    break;
                            }
                    ?>
                    <tr>
                        <td style="width: 10px"><?=$count+1?></td>
                        <td><?=$key?></td>
                        <td style="width: 40px" class="<?=$color?>"><?=format_number($row)?></td>
                    </tr>
                    <?php $count++; }}?>
                    
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function() {    
    data_page_fans_city  = [<?=!empty($data_page_fans_city)?$data_page_fans_city['top']:""?>];
    data_page_storytellers_by_city  = [<?=!empty($data_page_storytellers_by_city)?$data_page_storytellers_by_city['top']:""?>];
    data_page_impressions_by_city_unique  = [<?=!empty($data_page_impressions_by_city_unique)?$data_page_impressions_by_city_unique['top']:""?>];

    Main.Highcharts({
        element : '.ajax_fans_city',
        height  : 320,
        titlex  : 'datetime',
        colorx  : '#d73925',
        colory  : '#333',
        type    : 'bar',
        formatterx : 'text',
        name    : 'city',
        data    : data_page_fans_city,
        dataLabels : {
            formatter: function() {
                return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ Main.round(this.percentage,2) +'%'  : null;
            }
        }
    });

    Main.Highcharts({
        element : '.ajax_page_storytellers_by_city',
        height  : 320,
        titlex  : 'datetime',
        colorx  : '#d73925',
        colory  : '#333',
        type    : 'bar',
        formatterx : 'text',
        name    : 'city',
        data    : data_page_storytellers_by_city,
        dataLabels : {
            formatter: function() {
                return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ Main.round(this.percentage,2) +'%'  : null;
            }
        }
    });

    Main.Highcharts({
        element    : '.ajax_page_impressions_by_city_unique',
        height     : 320,
        titlex     : '',
        colorx     : '#d73925',
        colory     : '#333',
        type       : 'bar',
        formatterx : 'text',
        name       : 'City',
        data       : data_page_impressions_by_city_unique,
        dataLabels : {
            formatter: function() {
                return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ Main.round(this.percentage,2) +'%'  : null;
            }
        }
    });

    $('.box-listcity').slimScroll({
        height: '300px'
    });
});
</script>