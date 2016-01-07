<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Charts
            </div>
            <div class="panel-body">
                <div id="piechart" style=""></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Charts
            </div>
            <div class="panel-body">
                <div id="piechart1" style=""></div>
            </div>
        </div>
    </div>
</div>
<div class="row" >      
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-bar-chart-o fa-fw"></i> Charts
        </div>
        <div class="panel-body">
            <div id="BarGraph" style="width: 100%; height: 400px; float:left"></div>
        </div>
    </div>
</div>
<div class="row" >      
    <div class="col-lg-6" >      
        <div class="panel panel-default ">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Monthwise Business
            </div>
            <div class="panel-body">
                <div id="BarGraph1" style="width: 100%; height: 400px; float:left"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6" >  
        <div class="panel panel-default ">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Activities
            </div>
            <div class="panel-body">
                <div id="BarGraph2" style="width: 100%; height: 400px; float:left"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#piechart').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: 1, //null,
                plotShadow: false
            },
            title: {
                text: 'Doctor Class'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            credits: {
                enabled: false,
                text: 'Techvertica.com',
                href: 'http://www.techvertica.com'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                    type: 'pie',
                    name: 'Class',
                    data: [
<?php echo join(',', $myurl) . ","; ?>
                    ]
                }]
        });
    });
    
</script>
<script>
    $(function () {
        $('#piechart1').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: 1, //null,
                plotShadow: false
            },
            title: {
                text: 'Service Provided To Doctors'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            credits: {
                enabled: false,
                text: 'Techvertica.com',
                href: 'http://www.techvertica.com'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                    type: 'pie',
                    name: 'Service',
                    data: [
<?php echo join(',', $myurl1) . ","; ?>
                    ]
                }]
        });
    });
$(function () {
        $('#BarGraph').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Monthly Business'
            },
            xAxis: {
                categories: <?php echo json_encode($xAxis_title) ?>
            },
            yAxis: {
                title: {
                    text: 'No of doctors'
                },
                plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
            },
            tooltip: {
                valueSuffix: ''
            },
            credits: {
                enabled: false,
                text: 'Techvertica.com',
                href: 'http://www.techvertica.com'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                    name: 'Doctors',
                    data: [<?php echo join(",", $myurl3); ?>]
                }]
        });
    });
$(function () {
        $('#BarGraph1').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Monthwise Business'
            },
            xAxis: {
                categories: <?php
$temp = array_shift($xAxisData);
array_push($xAxisData, $temp);
echo json_encode($xAxisData)
?>
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'Business'
                },
                plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
            },
            tooltip: {
                valueSuffix: ''
            },
            credits: {
                enabled: false,
                text: 'Techvertica.com',
                href: 'http://www.techvertica.com'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                    name: 'Value',
                    data: <?php echo json_encode($brandSeriesData); ?>
                }]
        });
    });


      </script>
      <script>
    $(function () {
        $('#BarGraph2').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Monthwise Activities'
            },
            xAxis: {
                categories: <?php echo json_encode($xAxisData1) ?>
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'No. Of Activities '
                },
                plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
            },
            tooltip: {
                valueSuffix: ''
            },
            credits: {
                enabled: false,
                text: 'Techvertica.com',
                href: 'http://www.techvertica.com'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                    name: 'Unit',
                    data: <?php echo json_encode($Activitys); ?>
                }]
        });
    });
</script>

