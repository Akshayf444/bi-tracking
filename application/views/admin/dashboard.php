
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-user-md"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Doctors </span>
                        <span class="info-box-number"><?php echo $Doctor_Count ?>2</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-medkit"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Target</span>
                        <span class="info-box-number"><?php echo $Planning_Count ?></span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Sales</span>
                        <span class="info-box-number"><?php echo $Actual_Count ?></span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">New Conversion</span>
                        <span class="info-box-number">2248</span>
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
                                    <strong>Sales: 1 Jan, 2015 - 30 Aug, 2015</strong>
                                </p>
                                <div class="chart-responsive">
                                    <!-- Sales Chart Canvas -->
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
                                        <div class="progress-bar progress-bar-aqua" style="width: 0.08%"></div>
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
                                        <div class="progress-bar progress-bar-red" style="width: 0.05%"></div>
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
                                        <div class="progress-bar progress-bar-green" style="width: 0.02%"></div>
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
                                        <div class="progress-bar progress-bar-yellow" style="width: 0.00%"></div>
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
                            <span class="info-box-text">Sales</span>
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
                                <span class="info-box-text">Sales</span>
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
                                    <span class="info-box-text">Sales</span>
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
                                    <span class="info-box-number"><?php echo $Doctor_Count ?></span>
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
                    <script src="<?php echo asset_url() ?>dashboard/plugins/jQuery/jQuery-2.1.3.min.js" type="text/javascript"></script>

                    <!-- Bootstrap 3.3.2 JS -->
                    <script src="<?php echo asset_url() ?>dashboard/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

                    <!-- FastClick -->
                    <script src="<?php echo asset_url() ?>dashboard/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>

                    <!-- AdminLTE App -->
                    <script src="<?php echo asset_url() ?>dashboard/dist/js/app.min.js" type="text/javascript"></script>

                    <!-- Sparkline -->
                    <script src="<?php echo asset_url() ?>dashboard/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>

                    <!-- jvectormap -->
                    <script src="<?php echo asset_url() ?>dashboard/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
                    <script src="<?php echo asset_url() ?>dashboard/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>


                    <!-- daterangepicker -->
                    <script src="<?php echo asset_url() ?>dashboard/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>


                    <!-- datepicker -->
                    <script src="<?php echo asset_url() ?>dashboard/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

                    <!-- iCheck -->
                    <script src="<?php echo asset_url() ?>dashboard/plugins/iCheck/icheck.min.js" type="text/javascript"></script>


                    <!-- SlimScroll 1.3.0 -->
                    <script src="<?php echo asset_url() ?>/dashboard/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>

                    <!-- ChartJS 1.0.1 -->
                    <script src="<?php echo asset_url() ?>/dashboard/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
                    <script src="plugins/chartjs/Chart.min.js" type="text/javascript"></script>

                    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
                    <script src="<?php echo asset_url() ?>/dashboard/dist/js/pages/dashboard2.js" type="text/javascript"></script>


                    <!-- AdminLTE for demo purposes -->
                    <script src="<?php echo asset_url() ?>/dashboard/dist/js/demo.js" type="text/javascript"></script>
