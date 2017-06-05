<div class="col-md-12">
    <div class="head-title">
        <div class="name">Page Fans Gender And Age</div>
        <div class="desc">Aggregated demographic graph about the people who like your Page based on the age and gender information they provide in their user profiles.</div>
    </div>
    <div id="chart-age-1"></div>
</div>
<div class="col-md-12 mt40">
    <div class="head-title">
        <div class="name">Page Storytellers By Age And Gender</div>
        <div class="desc">The number graph of People Talking About the Page by user age and gender.</div>
    </div>
    <div id="chart-age-2"></div>
</div>
<div class="col-md-12 mt40">
    <div class="head-title">
        <div class="name">Page Reach By Age And Gender</div>
        <div class="desc">The number of people who have seen any content associated with your Page by age and gender grouping.</div>
    </div>
    <div id="chart-age-3"></div>
</div>
<script type="text/javascript">
$(function() {    
    data_fans_gender_age_male  = [<?=!empty($data_fans_gender_age)?$data_fans_gender_age['male']:""?>];
    data_fans_gender_age_female  = [<?=!empty($data_fans_gender_age)?$data_fans_gender_age['female']:""?>];
    data_fans_storytellers_gender_age_male    = [<?=!empty($data_fans_storytellers_gender_age)?$data_fans_storytellers_gender_age['male']:""?>];
    data_fans_storytellers_gender_age_female  = [<?=!empty($data_fans_storytellers_gender_age)?$data_fans_storytellers_gender_age['female']:""?>];
    data_page_impressions_by_age_gender_unique_male    = [<?=!empty($data_page_impressions_by_age_gender_unique)?$data_page_impressions_by_age_gender_unique['male']:""?>];
    data_page_impressions_by_age_gender_unique_female  = [<?=!empty($data_page_impressions_by_age_gender_unique)?$data_page_impressions_by_age_gender_unique['female']:""?>];

    $('#chart-age-1').highcharts({
        credits: {
            enabled: false
        },
        chart: {
            backgroundColor: '#fff',
            type: 'column',
            height:250
        },
        title: {
            text: ''
        },
        xAxis: {
            type: "category"
        },
        yAxis: {
            min: 0,
            title: {
                text: '.'
            },
           
        },
        tooltip: {
            formatter: function () {
                return this.series.name + ': ' + Highcharts.numberFormat(this.y,0) + '<br/>'
            }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
               
            }
        },
       
        series: [{
            name: 'Male',
            color : '#F89406',
            data: data_fans_gender_age_male
        }, {
            name: 'Female',
            color : '#52B3D9',
            data: data_fans_gender_age_female
        }]
    });

    $('#chart-age-2').highcharts({
        credits: {
            enabled: false
        },
        chart: {
            backgroundColor: '#fff',
            type: 'column',
            height:250
        },
        title: {
            text: ''
        },
        xAxis: {
            type: "category"
        },
        yAxis: {
            min: 0,
            title: {
                text: '.'
            },
           
        },
        tooltip: {
            formatter: function () {
                return this.series.name + ': ' + Highcharts.numberFormat(this.y,0) + '<br/>'
            }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
               
            }
        },
       
        series: [{
            name: 'Male',
            color : '#F89406',
            data: data_fans_storytellers_gender_age_male
        }, {
            name: 'Female',
            color : '#52B3D9',
            data: data_fans_storytellers_gender_age_female
        }]
    });

    $('#chart-age-3').highcharts({
        credits: {
            enabled: false
        },
        chart: {
            backgroundColor: '#fff',
            type: 'column',
            height:250
        },
        title: {
            text: ''
        },
        xAxis: {
            type: "category"
        },
        yAxis: {
            min: 0,
            title: {
                text: '.'
            },
           
        },
        tooltip: {
            formatter: function () {
                return this.series.name + ': ' + Highcharts.numberFormat(this.y,0) + '<br/>'
            }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
               
            }
        },
       
        series: [{
            name: 'Male',
            color : '#F89406',
            data: data_page_impressions_by_age_gender_unique_male
        }, {
            name: 'Female',
            color : '#52B3D9',
            data: data_page_impressions_by_age_gender_unique_female
        }]
    });
});
</script>