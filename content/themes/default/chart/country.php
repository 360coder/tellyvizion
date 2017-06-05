<div class="row">
    <div class="head-title">
        <div class="name">Page Fans Country</div>
        <div class="desc">Aggregated Facebook location data, sorted by country, about the people who like your Page.</div>
    </div>
    <div class="col-md-8">
        <div class="ajax_fans_country"></div>
    </div>
    <div class="col-md-4">
        <div class="table-responsive box-listcountry">
            <table class="table table-striped table-hover listcountry">
                <tbody>
                    <tr>
                        <th style="width: 10px">No.</th>
                        <th>Country</th>
                        <th style="width: 40px">Total</th>
                     </tr>
                    <?php if(!empty($data_page_fans_country['result'])){
                        $count = 0;
                        $result = $data_page_fans_country['result'];
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
        <div class="name">Page Storytellers By Country</div>
        <div class="desc">The number of People Talking About the Page by user country.</div>
    </div>
    <div class="col-md-8">
        <div class="ajax_page_storytellers_by_country"></div>
    </div>
    <div class="col-md-4">
        <div class="table-responsive box-listcountry">
            <table class="table table-striped table-hover listcountry">
                <tbody>
                    <tr>
                        <th style="width: 10px">No.</th>
                        <th>Country</th>
                        <th style="width: 40px">Total</th>
                     </tr>
                    <?php if(!empty($data_page_storytellers_by_country['result'])){
                        $count = 0;
                        $result = $data_page_storytellers_by_country['result'];
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
        <div class="name">Page Reach By Country</div>
        <div class="desc">The number of people who have seen any content associated with your Page by country.</div>
    </div>
    <div class="col-md-8">
        <div class="ajax_page_impressions_by_country_unique"></div>
    </div>
    <div class="col-md-4">
        <div class="table-responsive box-listcountry">
            <table class="table table-striped table-hover listcountry">
                <tbody>
                    <tr>
                        <th style="width: 10px">No.</th>
                        <th>Country</th>
                        <th style="width: 40px">Total</th>
                     </tr>
                    <?php if(!empty($data_page_impressions_by_country_unique['result'])){
                        $count = 0;
                        $result = $data_page_impressions_by_country_unique['result'];
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
    data_page_fans_country  = [<?=!empty($data_page_fans_country)?$data_page_fans_country['top']:""?>];
    data_page_storytellers_by_country  = [<?=!empty($data_page_storytellers_by_country)?$data_page_storytellers_by_country['top']:""?>];
    data_page_impressions_by_country_unique  = [<?=!empty($data_page_impressions_by_country_unique)?$data_page_impressions_by_country_unique['top']:""?>];

    Main.Highcharts({
        element : '.ajax_fans_country',
        height  : 300,
        titlex  : 'datetime',
        colorx  : '#d73925',
        colory  : '#333',
        type    : 'pie',
        name    : 'Country',
        data    : data_page_fans_country,
        dataLabels : {
            formatter: function() {
                return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ Main.round(this.percentage,2) +'%'  : null;
            }
        }
    });

    Main.Highcharts({
        element : '.ajax_page_storytellers_by_country',
        height  : 300,
        titlex  : 'datetime',
        colorx  : '#d73925',
        colory  : '#333',
        type    : 'pie',
        name    : 'Country',
        data    : data_page_storytellers_by_country,
        dataLabels : {
            formatter: function() {
                return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ Main.round(this.percentage,2) +'%'  : null;
            }
        }
    });

    Main.Highcharts({
        element : '.ajax_page_impressions_by_country_unique',
        height  : 300,
        titlex  : 'datetime',
        colorx  : '#d73925',
        colory  : '#333',
        type    : 'pie',
        name    : 'Country',
        data    : data_page_impressions_by_country_unique,
        dataLabels : {
            formatter: function() {
                return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ Main.round(this.percentage,2) +'%'  : null;
            }
        }
    });

    $('.box-listcountry').slimScroll({
        height: '300px'
    });
});
</script>