
<link href="<?php echo asset_url() ?>css/owl.carousel.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo asset_url() ?>css/owl.transitions.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo asset_url() ?>css/responsive.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo asset_url() ?>js/knob.js" type="text/javascript"></script>
<script src="<?php echo asset_url() ?>js/jquery.knob.js" type="text/javascript"></script>
<link href="<?php echo asset_url() ?>css/style.css" rel="stylesheet" type="text/css"/>
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
    audio, canvas, progress, video {
        height: 90px;
        margin-left: 208px;
        margin-top: -12px;
        margin-bottom: -22px;
    }
</style>
<div class="card">
    <ul class="table-view">
        <li class="table-view-cell">
            <a class="navigate-right" style="    margin-top: 10px;    margin-bottom: -47px;"  onclick="window.location = '<?php echo site_url('User/askQuestion'); ?>';" >
                Doctor Profiling </a>
            <div class="demo pull-right">
                <input class="knob" style="display: none;" data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="">
                <span style="    margin-left: 86px;position: absolute;margin-top: -39px;">10/100</span>
            </div>


        </li>
    </ul>
</div>
<div class="card">
    <ul class="table-view">
        <li class="table-view-cell" style="    margin-bottom: -32px;">
            <a class="navigate-right" style="margin-bottom: -2px;" onclick="window.location = '<?php echo site_url('User/PlanMenu'); ?>';">
                Planning
            </a>
            <div class="progress planning" style="    height: 5px;    width: 100%;margin-left: -13px;">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo 25; ?>" aria-valuemin="0" aria-valuemax="100" style="    height: 6px;width: <?php echo 25 . "%"; ?>;background-color: #00CCFF">
                   
                </div>
            </div>
        </li>
    </ul>
</div>
<div class="card">
    <ul class="table-view">
        <li class="table-view-cell" style="    margin-bottom: -32px;">
            <a class="navigate-right" style="margin-bottom: -2px;" onclick="window.location = '<?php echo site_url('User/addRx'); ?>';" >
                Reporting
            </a>
            <div class="progress planning" style="    height: 5px;    width: 100%;margin-left: -13px;">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo 25; ?>" aria-valuemin="0" aria-valuemax="100" style="    height: 6px;width: <?php echo 50 . "%"; ?>;background-color: #00CCFF">
                   
                </div>
            </div>
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
            <a class="navigate-right" onclick="window.location = '<?php echo site_url('User/productSel'); ?>';" >
                View Result
            </a>
        </li>
    </ul>
</div>

<div id="owl-demo2" class="owl-carousel owl-theme" style="text-align: center">
    <div class="item card" > 
        <ul class="table-view" style="background-color: #4CD964">
            <li class="table-view-cell table-view-divider" style="color: #4CD964;font-weight: 700;">Sep 2015</li>
            <li class="table-view-cell media">
                <table class="slider-table table" style="margin-left: -87px;">
                    <tr>

                        <td  style="text-align:right"></td>
                        <th  style="text-align:center">Doc</th>
                        <th>Rx</th>
                    </tr>

                    <tr>
                        <th  style="text-align:right">Pradaxa</th>
                        <td  style="text-align:center">4</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <th  style="text-align:right">Trajenta</th>
                        <td  style="text-align:center">4</td>
                        <td>2</td>
                    </tr>
                </table>
            </li>
        </ul>
    </div>
    <div class="item card"> 
        <ul class="table-view" style="background-color: #E8A698">
            <li class="table-view-cell table-view-divider" style="color: #E8A698;font-weight: 700;">Oct 2015</li>
            <li class="table-view-cell media">
                <table class="slider-table table" style="margin-left: -87px;">
                    <tr>
                        <td style="text-align:right"></td>
                        <th style="text-align:center">Doc</th>
                        <th>Rx</th>
                    </tr>

                    <tr>
                        <th style="text-align:right">Pradaxa</th>
                        <td style="text-align:center">4</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <th style="text-align:right">Trajenta</th>
                        <td style="text-align:center">4</td>
                        <td>2</td>
                    </tr>
                </table>
            </li>
        </ul>
    </div>
    <div class="item card"> 
        <ul class="table-view" style="background-color: #2680E4">
            <li class="table-view-cell table-view-divider" style="    color: #2680E4;font-weight: 700;">Nov 2015</li>
            <li class="table-view-cell media">
                <table class="slider-table table" style="margin-left: -147px;">
                    <tr>

                        <td style="text-align:right"></td>
                        <th style="text-align:center">Doc</th>
                        <td>Rx</td>
                    </tr>

                    <tr>
                        <th style="text-align:right">Pradaxa</th>
                        <td style="text-align:center">4</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <th style="text-align:right">Trajenta Family</th>
                        <td style="text-align:center">4</td>
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
    .progress .planning{
        height: 5px;
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
                
                $(document).ready(function () {
                    $('.knob').trigger(
                            'configure',
                            {
                                'min': 10,
                                'readOnly': true,
                                'width': 150,
                                'height': 20,
                                'fgColor': '#88BBC8',
                                'dynamicDraw': true,
                                'thickness': 0.3,
                                'tickColorizeValues': true
                            }
                    );
            });
                
//                $(document).ready(function () {
//                    var initval = 10;
//                    $({value: 0}).animate({value: initval}, {
//                        duration: 1000,
//                        easing: 'swing',
//                        step: function ()
//                        {
//                            $('.knob').val(this.value,{"readOnly":true}).trigger('change');
//                            $('#preval').val(initval);
//                            $('.knob').knob();
//                        }
//                    });
//                });
</script>