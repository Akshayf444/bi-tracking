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
                    Assign Target
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
<?php
if (!empty($division)) {
    if ($division['division'] == 'Diabetes') {
        ?>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="panel panel-default "> 
                <div class="panel-heading">
                    Achievement Of Jan 2016
                </div>
                <div class="panel-body " style="padding-bottom: 31px;">
                    <div align="center" class="col-lg-12 col-md-12">
                        <ul align="center" class="nav nav-tabs ">
                            <li class="active"><a data-toggle="tab" style="    padding: 12px;" href="#Trajenta">Trajenta</a></li>
                            <li><a data-toggle="tab" style="    padding: 12px;" href="#Jardiance">Jardiance</a></li>
                            <li><a data-toggle="tab" style="    padding: 12px;" href="#Trajenta_Duo">Trajenta Duo</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div id="Trajenta" class="tab-pane fade in active">
                            <div class="col-lg-5 col-md-5 col-xs-5">

                                <div class="demo" >        
                                    <input class="knob" id="kp1" style="display: none" data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="35">
                                    <span style="margin-left: 116px;position: absolute;margin-top: -50px;"><?php echo $kp14 ?>%</span>
                                    <span style="margin-left: 100px;position: absolute;margin-top: -35px">KPI 1</span>
                                    <span style="margin-left: 66px;position: absolute;margin-top: -17px;"><?php //echo $rxlabel;             ?> Actual / <?php //echo $rxlabel;             ?> Planned</span>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-xs-5">
                                <div class="demo" >       
                                    <input class="knob" id="kp2" style="display: none"  data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="35">
                                    <span style="margin-left: 116px;position: absolute;margin-top: -50px;"><?php // echo round($kpi2, 2);             ?>%</span>
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
                        <div id="Jardiance" class="tab-pane fade">
                            <div class="col-lg-5 col-md-5 col-xs-5">
                                <div class="demo" >        
                                    <input class="knob" id="kp1" style="display: none" data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="35">
                                    <span style="margin-left: 116px;position: absolute;margin-top: -50px;"><?php echo $kp15 ?>%</span>
                                    <span style="margin-left: 100px;position: absolute;margin-top: -35px">KPI 1</span>
                                    <span style="margin-left: 66px;position: absolute;margin-top: -17px;"><?php //echo $rxlabel;             ?> Actual / <?php //echo $rxlabel;             ?> Planned</span>
                                </div>
                            </div>

                            <div class="col-lg-5 col-md-5 col-xs-5">
                                <div class="demo" >       
                                    <input class="knob" id="kp2" style="display: none"  data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="35">
                                    <span style="margin-left: 116px;position: absolute;margin-top: -50px;"><?php // echo round($kpi2, 2);             ?>%</span>
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
                        <div id="Trajenta_Duo" class="tab-pane fade">
                            <div class="col-lg-5 col-md-5 col-xs-5">
                                <div class="demo" >        
                                    <input class="knob" id="kp1" style="display: none" data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="35">
                                    <span style="margin-left: 116px;position: absolute;margin-top: -50px;"><?php echo $kp16 ?>%</span>
                                    <span style="margin-left: 100px;position: absolute;margin-top: -35px">KPI 1</span>
                                    <span style="margin-left: 66px;position: absolute;margin-top: -17px;"><?php //echo $rxlabel;             ?> Actual / <?php //echo $rxlabel;             ?> Planned</span>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-xs-5">
                                <div class="demo" >       
                                    <input class="knob" id="kp2" style="display: none"  data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="35">
                                    <span style="margin-left: 116px;position: absolute;margin-top: -50px;"><?php // echo round($kpi2, 2);             ?>%</span>
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
            </div>
        </div>  
        <?php
    } else {
        ?>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="panel panel-default "> 
                <div class="panel-heading">
                    Achievement Of Jan 2016
                </div>
                <div class="panel-body " style="padding-bottom: 31px;">
                    <div align="center" class="col-lg-12 col-md-12">
                        <ul align="center" class="nav nav-tabs ">
                            <li class="active"><a data-toggle="tab" style="    padding: 12px;" href="#Actilyse">Actilyse</a></li>
                            <li><a data-toggle="tab" style="    padding: 12px;" href="#Pradaxa">Pradaxa</a></li>
                            <li><a data-toggle="tab" style="    padding: 12px;" href="#Metalyse">Metalyse</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div id="Actilyse" class="tab-pane fade in active">
                            <div class="col-lg-5 col-md-5 col-xs-5">
                                <div class="demo" >        
                                    <input class="knob" id="kp1" style="display: none" data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="35">
                                    <span style="margin-left: 116px;position: absolute;margin-top: -50px;"><?php echo $kp11 ?>%</span>
                                    <span style="margin-left: 100px;position: absolute;margin-top: -35px">KPI 1</span>
                                    <span style="margin-left: 66px;position: absolute;margin-top: -17px;"><?php //echo $rxlabel;             ?> Actual / <?php //echo $rxlabel;             ?> Planned</span>

                                </div>
                            </div>

                            <div class="col-lg-5 col-md-5 col-xs-5">
                                <div class="demo" >       
                                    <input class="knob" id="kp2" style="display: none"  data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="35">
                                    <span style="margin-left: 116px;position: absolute;margin-top: -50px;"><?php // echo round($kpi2, 2);             ?>%</span>
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
                        <div id="Pradaxa" class="tab-pane fade">
                            <div class="col-lg-5 col-md-5 col-xs-5">
                                <div class="demo" >        
                                    <input class="knob" id="kp1" style="display: none" data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="35">
                                    <span style="margin-left: 116px;position: absolute;margin-top: -50px;"><?php echo $kp12 ?>%</span>
                                    <span style="margin-left: 100px;position: absolute;margin-top: -35px">KPI 1</span>
                                    <span style="margin-left: 66px;position: absolute;margin-top: -17px;"><?php //echo $rxlabel;             ?> Actual / <?php //echo $rxlabel;             ?> Planned</span>

                                </div>
                            </div>

                            <div class="col-lg-5 col-md-5 col-xs-5">
                                <div class="demo" >       
                                    <input class="knob" id="kp2" style="display: none"  data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="35">
                                    <span style="margin-left: 116px;position: absolute;margin-top: -50px;"><?php // echo round($kpi2, 2);             ?>%</span>
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
                        <div id="Metalyse" class="tab-pane fade">
                            <div class="col-lg-5 col-md-5 col-xs-5">
                                <div class="demo" >        
                                    <input class="knob" id="kp1" style="display: none" data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="35">
                                    <span style="margin-left: 116px;position: absolute;margin-top: -50px;"><?php echo $kp13 ?>%</span>
                                    <span style="margin-left: 100px;position: absolute;margin-top: -35px">KPI 1</span>
                                    <span style="margin-left: 66px;position: absolute;margin-top: -17px;"><?php //echo $rxlabel;             ?> Actual / <?php //echo $rxlabel;             ?> Planned</span>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-xs-5">
                                <div class="demo" >       
                                    <input class="knob" id="kp2" style="display: none"  data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="35">
                                    <span style="margin-left: 116px;position: absolute;margin-top: -50px;"><?php // echo round($kpi2, 2);             ?>%</span>
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
            </div>
        </div> 
        <?php
    }
}
?>




<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <?php if (!empty($productlist)) { ?>
        <div class="panel panel-default"> 
            <div class="panel-heading"> Status  </div>
            <div class="panel-body">

                <ul align="center" class="nav nav-tabs ">
                    <?php
                    if (!empty($productlist)) {
                        $count = 1;
                        foreach ($productlist as $product) {
                            ?>
                            <li class="<?php echo isset($count) && $count == 1 ? 'active' : ''; ?>"><a data-toggle="tab" style="    padding: 12px;" href="#<?php echo $product->id ?>"><?php echo $product->Brand_Name ?></a></li>
                            <?php
                            $count ++;
                        }
                    }
                    ?>
                </ul>

                <div class="tab-content">
                    <?php
                    if (!empty($productlist)) {
                        $count = 1;
                        $ApproveCount = 0;
                        $UnApproveCount = 0;
                        $Pending = 0;
                        $Submitted = 0;
                        foreach ($productlist as $product) {
                            ?>

                            <div id="<?php echo $product->id ?>" class="tab-pane fade <?php echo isset($count) && $count == 1 ? 'in active' : ''; ?>">
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 20%">BDM Name</th>
                                        <th>No. of Doctors in MCL</th>
                                        <th>No. of Doctors profiled</th>
                                        <th>Target New Rxn for the month</th>
                                        <th>Planned New Rxn for the month</th>
                                        <th>Achieved New Rxn for the month</th>
                                        <th>No. of Doctors planned for activities</th>
                                        <th>Achieved No. of Doctors planned for activities</th>
                                    </tr>
                                    <?php
                                    $Status = $this->User_model->report($this->VEEVA_Employee_ID, $this->nextMonth, $this->nextYear, $product->id);
                                    if (!empty($Status)) {
                                        $nod = 0;
                                        $profiled = 0;
                                        $target = 0;
                                        $planned = 0;
                                        $actual = 0;
                                        $dplanned = 0;
                                        $actplaned = 0;
                                        foreach ($Status as $value) {
                                            $nod += $value->No_of_Doctors;
                                            $profiled += $value->No_of_Doctors_profiled;
                                            $target += $value->Target_New_Rxn_for_the_month;
                                            $planned += $value->Planned_New_Rxn;
                                            $nod += $value->No_of_Doctors;
                                            $currentMonthRx = $this->User_model->product_detail($value->VEEVA_Employee_ID, $product->id, $this->nextMonth, $this->nextYear);
                                            echo '<tr><td style="width: 20%">' . $value->Full_Name . '</td>'
                                            . '<td>' . $value->No_of_Doctors . '</td>'
                                            . '<td>' . $value->No_of_Doctors_profiled . '</td>'
                                            . '<td>' . $value->Target_New_Rxn_for_the_month . '</td>'
                                            . '<td>' . $value->Planned_New_Rxn . '</td>'
                                            . '<td>' . $currentMonthRx['Actual_Rx'] . '</td>'
                                            . '<td>' . $value->No_of_Doctors_planned . '</td>'
                                            . '<td>' . $value->checkk . '</td></tr>';
                                        }
                                    }
                                    ?>
                                </table>
                            </div>


                            <?php
                            $count ++;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>  
    <?php } ?>
</div>







<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <?php if (!empty($productlist)) { ?>
        <div class="panel panel-default"> 
            <div class="panel-heading"> Status  </div>
            <div class="panel-body">

                <ul align="center" class="nav nav-tabs ">
                    <?php
                    if (!empty($productlist)) {
                        $count = 1;
                        foreach ($productlist as $product) {
                            ?>
                            <li class="<?php echo isset($count) && $count == 1 ? 'active' : ''; ?>"><a data-toggle="tab" style="    padding: 12px;" href="#<?php echo $product->id ?>"><?php echo $product->Brand_Name ?></a></li>
                            <?php
                            $count ++;
                        }
                    }
                    ?>
                </ul>

                <div class="tab-content">
                    <?php
                    if (!empty($productlist)) {
                        $count = 1;
                        $ApproveCount = 0;
                        $UnApproveCount = 0;
                        $Pending = 0;
                        $Submitted = 0;
                        foreach ($productlist as $product) {
                            ?>

                            <div id="<?php echo $product->id ?>" class="tab-pane fade <?php echo isset($count) && $count == 1 ? 'in active' : ''; ?>">
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 20%">BDM Name</th>
                                        <th>KPI1</th>
                                        <th>KPI2</th>
                                       
                                    </tr>
                                    <?php
                                    $Status = $this->User_model->report($this->VEEVA_Employee_ID, $this->nextMonth, $this->nextYear, $product->id);
                                    if (!empty($Status)) {
                                        $nod = 0;
                                        $profiled = 0;
                                        $target = 0;
                                        $planned = 0;
                                        $actual = 0;
                                        $dplanned = 0;
                                        $actplaned = 0;
                                        foreach ($Status as $value) {
                                             $KPL1=$value->Target_New_Rxn_for_the_month *$currentMonthRx['Actual_Rx']/100;
                                             $KPL2=$value->No_of_Doctors_planned * $value->checkk/100;
                                            $nod += $value->No_of_Doctors;
                                            $profiled += $value->No_of_Doctors_profiled;
                                            $target += $value->Target_New_Rxn_for_the_month;
                                            $planned += $value->Planned_New_Rxn;
                                            $nod += $value->No_of_Doctors;
                                            $currentMonthRx = $this->User_model->product_detail($value->VEEVA_Employee_ID, $product->id, $this->nextMonth, $this->nextYear);
                                            echo '<tr><td style="width: 20%">' . $value->Full_Name . '</td>'
                                            
                                            . '<td>' . $KPL1 . '</td>'
                                           
                                            . '<td>' . $KPL2 . '</td></tr>';
                                           
                                            
                                        }
                                    }
                                    ?>
                                </table>
                            </div>


                            <?php
                            $count ++;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>  
    <?php } ?>
</div>