<div class="row">
    <div class="col-md-12">
        <div class="head-title">
            <div class="name">Page Fans By Like Source</div>
            <div class="desc">This is a breakdown of the number of Page likes from the most common places where people can like your Page.</div>
        </div>
        <div class="col-md-8">
            <div class="ajax_page_fans_by_like_source"></div>
        </div>

        <div class="col-md-4">
            <div class="table-responsive box-listSource">
                <table class="table table-striped table-hover listSource">
                    <tbody>
                        <tr>
                            <th style="width: 10px">No.</th>
                            <th>Source</th>
                            <th style="width: 40px">Total</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row mt40">
    <div class="col-md-12">
        <div class="head-title">
            <div class="name">Page Views External Referrals</div>
            <div class="desc">Top referrering external domains sending traffic to your Page.</div>
        </div>
        <div class="ajax_page_views_external_referrals"></div>
        <div class="row">
        <?php if(!empty($data_page_views_external_referrals)){
            foreach ($data_page_views_external_referrals as $key => $row) {
        ?>
            <div class="col-sm-3 col-xs-4 border-right">
                <div class="description-block">
                    <h5 class="description-header text-red total_referrers_<?=str_replace('.','',$key)?>"></h5>
                    <span class="description-text"><?=$key?></span>
                </div>
            </div>
        <?php }}?>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function() {    
    data_page_fans_by_like_source  = [<?=!empty($data_page_fans_by_like_source)?$data_page_fans_by_like_source:""?>];

    Main.Highcharts({
        element : '.ajax_page_fans_by_like_source',
        height  : 300,
        titlex  : 'datetime',
        colorx  : '#d73925',
        colory  : '#333',
        type    : 'pie',
        name    : 'Country',
        data    : data_page_fans_by_like_source,
        dataLabels : {
            formatter: function() {
                return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ Main.round(this.percentage,2) +'%'  : null;
            }
        }
    });

    <?php if(!empty($data_page_views_external_referrals)){?>
    Main.Highcharts({
        element : '.ajax_page_views_external_referrals',
        titlex  : 'datetime',
        crosshairs : true,
        multi   : true,
        data    : [
        <?php foreach ($data_page_views_external_referrals as $key => $row) {?>
            {
                type   : 'spline',
                name   : "<?=$key?>",
                data   : [<?=$row?>]
            },
        <?php }?>
        ]
    });
    <?php foreach ($data_page_views_external_referrals as $key => $row) {?>
        Main.CountValue("total_referrers_<?=str_replace('.','',$key)?>", [<?=$row?>]);
    <?php }?>

    <?php }?>

    $.each(data_page_fans_by_like_source, function(index,value){
        _html = '<tr><td>'+(index+1)+'.</td><td>'+value[0]+'</td><td><span class="badge bg-'+Main.colorTop(2)+'">'+Main.formatNumber(value[1])+'</span></td></tr>';
        $(".listSource tbody").append(_html);
    });

    $('.box-listSource').slimScroll({
        height: '300px'
    });
});
</script>