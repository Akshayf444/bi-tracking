
<!-- Info boxes -->
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-user-md"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Doctors </span>
                <span class="info-box-number"><?php echo $Doctor_Count['COUNT'] ?></span>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
    </div><!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-medkit"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Target</span>
                <span class="info-box-number"><?php echo $Target_Count['TOTAL']; ?></span>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
    </div><!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Achievements</span>
                <span class="info-box-number"><?php echo $Actual_Count['TOTAL'] ?></span>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
    </div><!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">New Conversion</span>
                <span class="info-box-number"><?php echo $Con_Count['TOTAL'] ?></span>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Monthly Plan V/s Actual Report</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <div class="btn-group">
                        <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </div>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8">
                        <p class="text-center">
                            <strong>Achievements: 1 Jan, 2016 - 30 Aug, 2016</strong>
                        </p>
                        <div class="chart-responsive">
                            <!-- Achievements Chart Canvas -->
                            <canvas id="salesChart" height="200"></canvas>
                        </div><!-- /.chart-responsive -->
                    </div><!-- /.col -->




                    <div class="col-md-4">
                        <p class="text-center">
                            <strong>Profile Completion</strong>
                        </p>
                        <div class="progress-group">
                            <span class="progress-text">Overall</span>
                            <span class="progress-number"><b><?php
                                    if ($Over_all_count['over_all'] == 0) {
                                        echo 0;
                                    } else {
                                        echo $Over_all_count['over_all'];
                                    }
                                    ?></b>/<?php
                                if ($dr_by_product['Division_dr'] == 0) {
                                    echo 0;
                                } else {
                                    echo $dr_by_product['Division_dr'];
                                }
                                ?></span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-aqua" style="width:<?php
                                if ($dr_by_product['Division_dr'] != 0) {
                                    $pb = $Over_all_count['over_all'] * 100 / $dr_by_product['Division_dr'];

                                    echo $pb;
                                }
                                ?>"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">Actylase</span>
                            <span class="progress-number"><b><?php
                                    if ($profiling_by_product1['profiling_by_product'] == 0) {
                                        echo 0;
                                    } else {
                                        echo $profiling_by_product1['profiling_by_product'];
                                    }
                                    ?></b>/<?php
                                if ($dr_by_product['Division_dr'] == 0) {
                                    echo 0;
                                } else {
                                    echo $dr_by_product['Division_dr'];
                                }
                                ?></span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-red" style="width: <?php
                                if($dr_by_product['Division_dr']!=0){ $pb1 = $profiling_by_product1['profiling_by_product'] * 100 / $dr_by_product['Division_dr'];

                                echo $pb1;
                                }
                                ?>"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">Pradaxa</span>
                            <span class="progress-number"><b><?php
                                    if ($profiling_by_product2['profiling_by_product'] == 0) {
                                        echo 0;
                                    } else {
                                        echo $profiling_by_product2['profiling_by_product'];
                                    }
                                    ?></b>/<?php
                                    if ($dr_by_product['Division_dr'] == 0) {
                                        echo 0;
                                    } else {
                                        echo $dr_by_product['Division_dr'];
                                    }
                                    ?></span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-green" style="width: <?php
                                     if($dr_by_product['Division_dr']!=0){ $pb2 = $profiling_by_product2['profiling_by_product'] * 100 / $dr_by_product['Division_dr'];

                                     echo $pb2;
                                     }
                                    ?>"></div>
                            </div>
                        </div><!-- /.progress-group -->
                        <div class="progress-group">
                            <span class="progress-text">Metalyse</span>
                            <span class="progress-number"><b><?php
                                if ($profiling_by_product3['profiling_by_product'] == 0) {
                                    echo 0;
                                } else {
                                    echo $profiling_by_product3['profiling_by_product'];
                                }
                                ?></b>/<?php
                                if ($dr_by_product['Division_dr'] == 0) {
                                    echo 0;
                                } else {
                                    echo $dr_by_product['Division_dr'];
                                }
                                ?></span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-yellow" style="width: <?php
                                if ($dr_by_product['Division_dr'] != 0) {
                                    $pb3 = $profiling_by_product3['profiling_by_product'] * 100 / $dr_by_product['Division_dr'];

                                    echo $pb3;
                                }
                                ?>"></div>
                            </div> 
                        </div><!-- /.progress-group -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- ./box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
<!-- Main content -->
<section class="content">
    <H3> Actylase Summary </h3>
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-user-md"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Doctors </span>
                    <span class="info-box-number"><?php echo $dr_by_product['Division_dr']; ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 50%"></div>
                    </div>
                    <span class="progress-description">
                        50% Increase in 30 Days
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-medkit"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Target</span>
                    <span class="info-box-number"><?php
                                if ($total_target_by_product1['total_target'] == 0) {
                                    echo 0;
                                } else {


                                    echo $total_target_by_product1['total_target'];
                                }
                                ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 50%"></div>
                    </div>
                    <span class="progress-description">
                        50% Increase in 30 Days
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="ion ion-ios-cart-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Achievements</span>
                    <span class="info-box-number"><?php
                                if ($total_actualrx_by_product1['total_actual_rx'] == 0) {
                                    echo 0;
                                } else {
                                    echo $total_actualrx_by_product1['total_actual_rx'];
                                }
                                ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 50%"></div>
                    </div>
                    <span class="progress-description">
                        50% Increase in 30 Days
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">New Conversion</span>
                    <span class="info-box-number"><?php
                                if ($total_convertion_by_product1['total_convertion'] == 0) {
                                    echo 0;
                                } else {
                                    echo $total_convertion_by_product1['total_convertion'];
                                }
                                ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 50%"></div>
                    </div>
                    <span class="progress-description">
                        50% Increase in 30 Days
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- Main content -->
    <section class="content">
        <H3> Prodaxa Summary </h3>
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="fa fa-user-md"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Doctors </span>
                        <span class="info-box-number"><?php echo $dr_by_product['Division_dr']; ?></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 50%"></div>
                        </div>
                        <span class="progress-description">
                            50% Increase in 30 Days
                        </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-medkit"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Target</span>
                        <span class="info-box-number"><?php
                                if ($total_target_by_product2['total_target'] == 0) {
                                    echo 0;
                                } else {


                                    echo $total_target_by_product2['total_target'];
                                }
                                ?></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 50%"></div>
                        </div>
                        <span class="progress-description">
                            50% Increase in 30 Days
                        </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="ion ion-ios-cart-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Achievements</span>
                        <span class="info-box-number"><?php
                                if ($total_actualrx_by_product2['total_actual_rx'] == 0) {
                                    echo 0;
                                } else {
                                    echo $total_actualrx_by_product2['total_actual_rx'];
                                }
                                ?></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 50%"></div>
                        </div>
                        <span class="progress-description">
                            50% Increase in 30 Days
                        </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">New Conversion</span>
                        <span class="info-box-number">2248</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 50%"></div>
                        </div>
                        <span class="progress-description">
                            50% Increase in 30 Days
                        </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- Main content -->
        <section class="content">
            <H3> Metalyse Summary </h3>
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="fa fa-user-md"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Doctors </span>
                            <span class="info-box-number"><?php echo $dr_by_product['Division_dr']; ?></span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 50%"></div>
                            </div>
                            <span class="progress-description">
                                50% Increase in 30 Days
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="fa fa-medkit"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Target</span>
                            <span class="info-box-number"><?php
                                if ($total_target_by_product3['total_target'] == 0) {
                                    echo 0;
                                } else {


                                    echo $total_target_by_product3['total_target'];
                                }
                                ?></span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 50%"></div>
                            </div>
                            <span class="progress-description">
                                50% Increase in 30 Days
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="ion ion-ios-cart-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Achievements</span>
                            <span class="info-box-number"><?php
                                if ($total_actualrx_by_product3['total_actual_rx'] == 0) {
                                    echo 0;
                                } else {
                                    echo $total_actualrx_by_product3['total_actual_rx'];
                                }
                                ?></span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 50%"></div>
                            </div>
                            <span class="progress-description">
                                50% Increase in 30 Days
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="ion ion-ios-people-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">New Conversion</span>
                            <span class="info-box-number"><?php
                                if ($total_convertion_by_product3['total_convertion'] == 0) {
                                    echo 0;
                                } else {
                                    echo $total_convertion_by_product3['total_convertion'];
                                }
                                ?></span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 50%"></div>
                            </div>
                            <span class="progress-description">
                                50% Increase in 30 Days
                            </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
            <?php
            $a = array();
            foreach ($plan_month as $plan) {
                array_push($a, (int) $plan->TOTAL);
            }
            ?>
            <?php
            $b = array();
            foreach ($count_achive_month as $plan) {
                array_push($b, (int) $plan->TOTAL);
//  
            }
            ?>
            <script src="<?php echo asset_url() ?>/dashboard/plugins/jQuery/jQuery-2.1.3.min.js" type="text/javascript"></script>

            <!-- Bootstrap 3.3.2 JS -->
            <script src="<?php echo asset_url() ?>/dashboard/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>


            <script src="<?php echo asset_url() ?>/dashboard/plugins/chartjs/Chart.min.js" type="text/javascript"></script>





            <!-- AdminLTE for demo purposes -->

            <script>
                $(function () {

                    /* ChartJS
                     * -------
                     * Here we will create a few charts using ChartJS
                     */

                    //-----------------------
                    //- MONTHLY SALES CHART -
                    //-----------------------

                    // Get context with jQuery - using jQuery's .get() method.
                    var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
                    // This will get the first returned node in the jQuery collection.
                    var salesChart = new Chart(salesChartCanvas);

                    var salesChartData = {
                        labels: ["January", "February", "March", "April", "May", "June", "July", "August"],
                        datasets: [
                            {
                                label: "Electronics",
                                fillColor: "rgb(210, 214, 222)",
                                strokeColor: "rgb(210, 214, 222)",
                                pointColor: "rgb(210, 214, 222)",
                                pointStrokeColor: "#c1c7d1",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "rgb(220,220,220)",
                                data: [<?php echo join(',', $a) . ","; ?>]
                            },
                            {
                                label: "Digital Goods",
                                fillColor: "rgba(60,141,188,0.9)",
                                strokeColor: "rgba(60,141,188,0.8)",
                                pointColor: "#3b8bba",
                                pointStrokeColor: "rgba(60,141,188,1)",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "rgba(60,141,188,1)",
                                data: [<?php echo join(',', $b) . ","; ?>]
                            }
                        ]
                    };

                    var salesChartOptions = {
                        //Boolean - If we should show the scale at all
                        showScale: true,
                        //Boolean - Whether grid lines are shown across the chart
                        scaleShowGridLines: false,
                        //String - Colour of the grid lines
                        scaleGridLineColor: "rgba(0,0,0,.05)",
                        //Number - Width of the grid lines
                        scaleGridLineWidth: 1,
                        //Boolean - Whether to show horizontal lines (except X axis)
                        scaleShowHorizontalLines: true,
                        //Boolean - Whether to show vertical lines (except Y axis)
                        scaleShowVerticalLines: true,
                        //Boolean - Whether the line is curved between points
                        bezierCurve: true,
                        //Number - Tension of the bezier curve between points
                        bezierCurveTension: 0.3,
                        //Boolean - Whether to show a dot for each point
                        pointDot: false,
                        //Number - Radius of each point dot in pixels
                        pointDotRadius: 4,
                        //Number - Pixel width of point dot stroke
                        pointDotStrokeWidth: 1,
                        //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                        pointHitDetectionRadius: 20,
                        //Boolean - Whether to show a stroke for datasets
                        datasetStroke: true,
                        //Number - Pixel width of dataset stroke
                        datasetStrokeWidth: 2,
                        //Boolean - Whether to fill the dataset with a color
                        datasetFill: true,
                        //String - A legend template
                        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
                        //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                        maintainAspectRatio: false,
                        //Boolean - whether to make the chart responsive to window resizing
                        responsive: true
                    };

                    //Create the line chart
                    salesChart.Line(salesChartData, salesChartOptions);

                    //---------------------------
                    //- END MONTHLY SALES CHART -
                    //---------------------------

                    //-------------
                    //- PIE CHART -
                    //-------------
                    // Get context with jQuery - using jQuery's .get() method.

                });
            </script>
            </body>
            </html>