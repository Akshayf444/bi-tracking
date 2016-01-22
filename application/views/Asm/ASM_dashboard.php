
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
        margin-top: 2px;
        margin-bottom: 30px;
    }
    audio,#kp1, progress, video {
        height: 90px;
        margin-left: 208px;
        margin-top: -12px;
        margin-bottom: -22px;
    }
    a{
        font-weight: bold;
    }
</style>
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <div class="panel panel-default ">
        <div class="panel-body ">
            <div class="col-md-4">

                <a class="btn btn-block" style="    border: 1px solid;background-color: " onclick="window.location = '<?php echo site_url('ASM/target'); ?>';" >
                    Approve Target
                </a>

            </div>
            <div class="col-md-4">
                <a class="btn btn-block" style="    border: 1px solid;background-color: " onclick="window.location = '<?php echo site_url('ASM/Planning'); ?>';" > Approve Planning </a>

            </div>

            <div class="col-md-4">
                <a class="btn btn-block" style="    border: 1px solid;background-color: " onclick="window.location = '<?php echo site_url('ASM/reporting'); ?>';" > Approve Reporting </a>

            </div>

        </div>
    </div>
</div>
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <div class="panel panel-default "> 
        <div class="panel-heading">
            Achievement Of Jan 2016
        </div>


        <div class="panel-body " style="padding-bottom: 31px;">
            <div class="col-lg-1 col-xs-2 col-md-2">
                <select class="form-control">
                    <option><?php echo date('M', strtotime($this->nextMonth)); ?> <?php echo $this->nextMonth; ?></option>
                    <option>Cycle 1</option>
                </select>
            </div>
            <div class="col-lg-5 col-md-5 col-xs-5">

                <div class="demo" >        
                    <input class="knob" id="kp1" style="display: none" data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="35">
                    <span style="margin-left: 116px;position: absolute;margin-top: -50px;"><?php //echo round($kpi1, 2);     ?>%</span>
                    <span style="margin-left: 100px;position: absolute;margin-top: -35px">KPI 1</span>
                    <span style="margin-left: 66px;position: absolute;margin-top: -17px;"><?php //echo $rxlabel;     ?> Actual / <?php //echo $rxlabel;     ?> Planned</span>

                </div>
            </div>

            <div class="col-lg-5 col-md-5 col-xs-5">

                <div class="demo" >       
                    <input class="knob" id="kp2" style="display: none"  data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="35">
                    <span style="margin-left: 116px;position: absolute;margin-top: -50px;"><?php // echo round($kpi2, 2);     ?>%</span>
                    <span style="margin-left: 100px;position: absolute;margin-top: -35px">KPI 2</span>
                    <span style="margin-left: 0px;position: absolute;margin-top: -17px;"><?php
                        if ($this->Product_Id == 1) {
                            echo "Hospital";
                        } else {
                            echo "Doctor";
                        }
                        ?> Engaged in Activity / Planned</span>
                </div>
            </div>
        </div>
    </div>
</div>



