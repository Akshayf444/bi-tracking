
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
                                <div class="progress-bar progress-bar-aqua" style="width:<?php echo $Over_all_count['over_all'] * 100 / $dr_by_product['Division_dr']; ?> "></div>
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
                                <div class="progress-bar progress-bar-red" style="width: <?php echo $profiling_by_product1['profiling_by_product'] * 100 / $dr_by_product['Division_dr']; ?>"></div>
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
                                <div class="progress-bar progress-bar-green" style="width: <?php echo $profiling_by_product2['profiling_by_product'] * 100 / $dr_by_product['Division_dr']; ?>"></div>
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
                                <div class="progress-bar progress-bar-yellow" style="width: <?php echo $profiling_by_product3['profiling_by_product'] * 100 / $dr_by_product['Division_dr']; ?>"></div>
                            </div>
                        </div><!-- /.progress-group -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- ./box-body -->
            <!--                    <div class="box-footer">
                                    <div class="row">
                                        <div class="col-sm-3 col-xs-6">
                                            <div class="description-block border-right">
                                                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                                                <h5 class="description-header"> 35,210.43</h5>
                                                <span class="description-text">TOTAL Target</span>
                                            </div> /.description-block 
                                        </div> /.col 
                                        <div class="col-sm-3 col-xs-6">
                                            <div class="description-block border-right">
                                                <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                                                <h5 class="description-header">10,390.90</h5>
                                                <span class="description-text">TOTAL Achievement </span>
                                            </div> /.description-block 
                                        </div> /.col 
                                        <div class="col-sm-3 col-xs-6">
                                            <div class="description-block border-right">
                                                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                                                <h5 class="description-header">2498</h5>
                                                <span class="description-text">TOTAL Activities Planned</span>
                                            </div> /.description-block 
                                        </div> /.col 
                                        <div class="col-sm-3 col-xs-6">
                                            <div class="description-block">
                                                <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                                                <h5 class="description-header">1200</h5>
                                                <span class="description-text">Total Activities Executed</span>
                                            </div> /.description-block 
                                        </div>
                                    </div> /.row 
                                </div> /.box-footer -->
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
                array_push($a, (int)$plan->TOTAL);

            }
           
            ?>
            <?php
            $b = array();
            foreach ($count_achive_month as $plan) {
                array_push($b, (int)$plan->TOTAL);
//  
            }
           
            ?>
            <script src="<?php echo asset_url() ?>/dashboard/plugins/jQuery/jQuery-2.1.3.min.js" type="text/javascript"></script>

            <!-- Bootstrap 3.3.2 JS -->
            <script src="<?php echo asset_url() ?>/dashboard/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

            <!-- FastClick -->
            <script src="<?php echo asset_url() ?>/dashboard/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>

            <!-- AdminLTE App -->
            <script src="<?php echo asset_url() ?>/dashboard/dist/js/app.min.js" type="text/javascript"></script>

            <!-- Sparkline -->
            <script src="<?php echo asset_url() ?>/dashboard/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>

            <!-- jvectormap -->
            <script src="<?php echo asset_url() ?>/dashboard/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
            <script src="<?php echo asset_url() ?>/dashboard/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>


            <!-- daterangepicker -->
            <script src="<?php echo asset_url() ?>/dashboard/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>


            <!-- datepicker -->
            <script src="<?php echo asset_url() ?>/dashboard/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

            <!-- iCheck -->
            <script src="<?php echo asset_url() ?>/dashboard/plugins/iCheck/icheck.min.js" type="text/javascript"></script>


            <!-- SlimScroll 1.3.0 -->
            <script src="<?php echo asset_url() ?>/dashboard/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>

            <!-- ChartJS 1.0.1 -->
            <script src="<?php echo asset_url() ?>/dashboard/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
            <script src="plugins/chartjs/Chart.min.js" type="text/javascript"></script>

            <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
            <!--<script src="<?php echo asset_url() ?>/dashboard/dist/js/pages/dashboard2.js" type="text/javascript"></script>-->


            <!-- AdminLTE for demo purposes -->
            <script src="<?php echo asset_url() ?>/dashboard/dist/js/demo.js" type="text/javascript"></script>
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
=======
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"> <?php echo  77 ; ?></div>
                        <div>Total Doctors</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel" style="background-color: #5cb85c">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"> <?php echo  77 ; ?></div>
                        <div> Profile Completed</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow" style="background-color:#f0ad4e">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo  77 ; ?></div>
                        <div>Planned Till Date </div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red" style="background-color: #d9534f">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php
//                            $Activity = zone::count_by_bm_zoneid($zone_id);
                            echo  77 ;
                            ?></div>
                        <div>Achievement Till Date</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>




<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Doctor Specialty
            </div>
            <div class="panel-body">
                <div id="piechart" style=""></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Business By Specialty
            </div>
            <div class="panel-body">
                <div id="piechart1" style=""></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Doctor Winability FOR Prodruct
            </div>
            <div class="panel-body">
                <div id="piechart2" style=""></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i>Doctor Winability FOR Prodruct
            </div>
            <div class="panel-body">
                <div id="piechart3" style=""></div>
            </div>
        </div>
    </div>
      <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Doctor Winability FOR Prodruct
            </div>
            <div class="panel-body">
                <div id="piechart4" style=""></div>
            </div>
        </div>
    </div>
</div>



<div class="row" >      
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-bar-chart-o fa-fw"></i> Monthwise Rx Trained
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
                <i class="fa fa-bar-chart-o fa-fw"></i> Delta
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
                     data: [{
                name: "CARDIOLOGIST",

                y: 56.33
            }, {
                name: "NEUROLOGIST",

                y: 24.03,
                sliced: true,
                selected: true
            }, {
                name: "RADIOLOGIST",

                y: 10.38
            }, {
                name: "PHYSICIAN",
                y: 4.77
            }, {
                name: "OTHERS",
                y: 0.91
            }]
//                    data: [
//<?php // echo join(',', $myurl) . ","; ?>
//                    ]
                }]
        });
    });
    
</script>
<script>
    $(function () {
        $('#piechart1').highcharts({
            chart: {
                plotBackgroundColor: null,
               
                plotShadow: false
            },
            title: {
                text: 'Business By Specialty'
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
                      data: [{
                name: "CARDIOLOGIST",

                y: 56.33
            }, {
                name: "NEUROLOGIST",

                y: 24.03,
                sliced: true,
                selected: true
            }, {
                name: "RADIOLOGIST",

                y: 10.38
            }, {
                name: "PHYSICIAN",
                y: 4.77
            }, {
                name: "OTHERS",
                y: 0.91
            }]
//                  
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
                 categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
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
                        name: 'Planned',
                      
                        data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
                    }, {
                        color: ' #5cb85c',
                        data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8],
                        name: 'Achievement',
                    }]
           
        });
    });
    $(function () {
        $('#BarGraph1').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Delta'
            },
            xAxis: {
               categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
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
                    data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
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
                 categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
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
                   data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
                }]
        });
    });
</script>

<script>
    $(function () {
        $('#piechart2').highcharts({
            chart: {
                plotBackgroundColor: null,
               //null,
                plotShadow: false
            },
            title: {
                text: 'Doctor By Winability  FOR Prodruct'
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
                     data: [{
                name: "high",

                y: 56.33
            }, {
                name: "Medium",

                y: 24.03,
                sliced: true,
                selected: true
            }, {
                name: "Low",

                y: 10.38
            
            }]
//                    data: [
//<?php // echo join(',', $myurl) . ","; ?>
//                    ]
                }]
        });
    });
    $(function () {
        $('#piechart3').highcharts({
            chart: {
                plotBackgroundColor: null,
               
                plotShadow: false
            },
            title: {
                text: 'Doctor  Winability  FOR Prodruct'
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
                     data: [{
                name: "high",

                y: 56.33
            }, {
                name: "Medium",

                y: 24.03,
                sliced: true,
                selected: true
            }, {
                name: "Low",

                y: 10.38
            
            }]
//                    data: [
//<?php // echo join(',', $myurl) . ","; ?>
//                    ]
                }]
        });
    });
    $(function () {
        $('#piechart4').highcharts({
            chart: {
                plotBackgroundColor: null,
              
                plotShadow: false
            },
            title: {
                text: 'Doctor Winability FOR Prodruct'
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
                      data: [{
                name: "high",

                y: 56.33
            }, {
                name: "Medium",

                y: 24.03,
                sliced: true,
                selected: true
            }, {
                name: "Low",

                y: 10.38
            
            }]
//                    data: [
//<?php // echo join(',', $myurl) . ","; ?>
//                    ]
                }]
        });
    });
</script>
>>>>>>> 5c8c64e558fe7827b02df92a2bff1b014eef1e66
