
<link href="<?php echo asset_url() ?>css/owl.carousel.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo asset_url() ?>css/owl.transitions.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo asset_url() ?>css/responsive.css" rel="stylesheet" type="text/css"/>
<style>
    #owl-demo .item img{
        display: block;
        width: 100%;
        height: auto;
    }
    #owl-demo2 .item img{
        display: block;
        width: 100%;
        height: auto;
    }
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        border-top: 0px solid #dddddd;
    }
</style>
<div class="card">
    <ul class="table-view">
        <li class="table-view-cell">
            <a class="navigate-right" onclick="window.location = '<?php echo site_url('User/askQuestion'); ?>';" >
                Doctor Profiling  <span class="badge badge-positive">20%</span>
            </a>
        </li>
    </ul>
</div>
<div class="card">
    <ul class="table-view">
        <li class="table-view-cell">
            <a class="navigate-right" onclick="window.location = '<?php echo site_url('User/PlanMenu'); ?>';">
                Planning
            </a>
        </li>
    </ul>
</div>
<div class="card">
    <ul class="table-view">
        <li class="table-view-cell">
            <a class="navigate-right" onclick="window.location = '<?php echo site_url('User/addRx'); ?>';" >
                Reporting
            </a>
        </li>
    </ul>
</div>
<div class="card">
    <ul class="table-view">
        <li class="table-view-cell">
            <a class="navigate-right" onclick="window.location = '<?php echo site_url('User/productSel'); ?>';" >
                View Status
            </a>
        </li>
    </ul>
</div>
<div class="card">
    <ul class="table-view">
        <li class="table-view-cell">
            <a class="navigate-right" onclick="window.location = '<?php echo site_url('User/view_status'); ?>';" >
                View Result
            </a>
        </li>
    </ul>
</div>

<div id="owl-demo2" class="owl-carousel owl-theme" style="text-align: center">
    <div class="item card" > 
        <ul class="table-view" style="background-color: #4CD964">
            <li class="table-view-cell table-view-divider">Sep 2015</li>
            <li class="table-view-cell media">
                <table class="slider-table table">
                    <tr>

                        <td></td>
                        <th>Doc</th>
                        <th>Rx</th>
                    </tr>

                    <tr>
                        <th>Pradaxa</th>
                        <td>4</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <th>Trajenta</th>
                        <td>4</td>
                        <td>2</td>
                    </tr>
                </table>
            </li>
        </ul>
    </div>
    <div class="item card"> 
        <ul class="table-view" style="background-color: #E8A698">
            <li class="table-view-cell table-view-divider">Oct 2015</li>
            <li class="table-view-cell media">
                <table class="slider-table table">
                    <tr>
                        <td></td>
                        <th>Doc</th>
                        <th>Rx</th>
                    </tr>

                    <tr>
                        <th>Pradaxa</th>
                        <td>4</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <th>Trajenta</th>
                        <td>4</td>
                        <td>2</td>
                    </tr>
                </table>
            </li>
        </ul>
    </div>
    <div class="item card"> 
        <ul class="table-view" style="background-color: #2680E4">
            <li class="table-view-cell table-view-divider">Nov 2015</li>
            <li class="table-view-cell media">
                <table class="slider-table table">
                    <tr>

                        <td></td>
                        <th>Doc</th>
                        <td>Rx</td>
                    </tr>

                    <tr>
                        <th>Pradaxa</th>
                        <td>4</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <th>Trajenta</th>
                        <td>4</td>
                        <td>2</td>
                    </tr>
                </table>
            </li>
        </ul>
    </div>
</div>
<style>
    .progress{
        height: 25px;
    }
    .progress .progress-bar{
        font-size: 15px;
        vertical-align: central;
        line-height: 25px;
    }
    .achievement {
        padding: 11px 15px 11px 15px;
    }
</style>
<ul class="table-view card ">
    <li class="table-view-cell table-view-divider" style="padding: 11px 20px 11px 15px;">
        <div class="col-xs-10">
            Achievement Of Jan 2016
        </div>
        <div class="col-xs-2">
            Target
        </div>
    </li>
    <li class="table-view-cell achievement">

        <div class="col-xs-10">
            Doctor Prioritiesed
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo 10; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo 10 . "%"; ?>;">
                    <?php echo 10 . "%"; ?>
                </div>
            </div>
        </div>
        <div class="col-xs-2">
           <br>
            23
        </div>

        <div class="col-xs-10">
            KPI 1 (Rx from targeted/Prioritiesed Doctor)
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo 20; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo 20 . "%"; ?>;background-color: green">
                    <?php echo 20 . "%"; ?>
                </div>
            </div>
        </div>
        <div class="col-xs-2">
           <br>
            56
        </div>

        <div class="col-xs-10">
            KPI 2 (No. Of Doctor Engaged)
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo 25; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo 25 . "%"; ?>;background-color: #00CCFF">
                    <?php echo 25 . "%"; ?>
                </div>
            </div>
        </div>
        <div class="col-xs-2">
            <br>
            32
        </div>
    </li>
</ul>

<script src="<?php echo asset_url() ?>js/owl.carousel.min.js" type="text/javascript"></script>
<script>
                $(document).ready(function () {
                    $("#owl-demo").owlCarousel({
                        navigation: true, // Show next and prev buttons
                        slideSpeed: 300,
                        paginationSpeed: 400,
                        singleItem: true,
                        navigation : false
                    });
                    $("#owl-demo2").owlCarousel({
                        navigation: true, // Show next and prev buttons
                        slideSpeed: 300,
                        paginationSpeed: 400,
                        singleItem: true,
                        navigation : false
                    });
                });
</script>