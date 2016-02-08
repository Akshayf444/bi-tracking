<?php

class User_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->table_name = 'Employee_Master';
    }

    public function authentication($username, $password) {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where(array('Username' => $username, 'password' => $password, 'Status' => '1'));
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row_array();
    }

    public function profiling_by_id($Doctor_id, $Territory, $Product_id) {
        $this->db->select('*');
        $this->db->from('Profiling');
        $this->db->where(array('Doctor_id' => $Doctor_id, 'Territory' => $Territory, 'Product_id' => $Product_id));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function Set_Target($data) {
        return $this->db->insert('Rx_Target', $data);
    }

    public function Set_Target_update2($data) {
        $this->db->where(array('Territory' => $this->Territory, 'Product_Id' => $this->Product_Id));
        return $this->db->update('Rx_Target', $data);
    }

    ///Not Territory Specific
    public function Set_Target_by_id($id, $pid, $month) {
        $sql = "select * from Rx_Target
                where VEEVA_Employee_ID = '$id' And Product_Id='$pid' And Month=$month";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function Rx_Target_month($Territory, $Product_Id, $month_start, $year) {
        $sql = "SELECT * FROM Rx_Target
                WHERE Month = $month_start
                AND `Territory`='$Territory' AND `Product_Id`= '$Product_Id' And Year='$year' AND Status = 'Submitted' ";
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function Actual_Rx_Target_month($Territory, $Product_Id, $month, $year) {
        $sql = "SELECT SUM(Actual_Rx) as Act FROM Rx_Actual
                WHERE month=$month
                AND `Territory`='$Territory' AND `Product_Id`=$Product_Id  And Year=$year";
        $query = $this->db->query($sql);
        return $query->result();
    }

    ////Not Territory Specific
    public function Rx_Target_month2($VEEVA_Employee_ID, $Product_Id, $month_start) {
        $sql = "SELECT *  FROM Rx_Target
                WHERE Month = $month_start
                AND `VEEVA_Employee_ID`='$VEEVA_Employee_ID' AND `Product_Id`=$Product_Id And Year='$this->nextYear' AND Status = 'Submitted'  ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function Expected_Rx($id, $pid, $month) {
        $this->db->select('target');
        $this->db->from(' Rx_Target');
        $this->db->where(array('month' => $month, 'Territory' => $id, 'Product_Id' => $pid));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function Save_Planning($data) {
        $this->db->insert('Rx_Planning', $data);
        return $this->db->insert_id();
    }

    public function Save_Planning_prescription($data, $id, $doc_id, $pid, $month = 0, $year = 0) {
        $this->db->where(array('Territory' => $id, 'Doctor_Id' => $doc_id, 'Product_Id' => $pid, 'month' => $month, 'Year' => $year));
        return $this->db->update('Rx_Planning', $data);
    }

    public function Set_Target_update($id, $data, $Pid) {
        $this->db->where(array('Territory' => $id, 'Product_Id' => $Pid));
        return $this->db->update('Rx_Target', $data);
    }

    public function Tabs($VEEVA_Employee_ID) {
        $this->db->select('*');
        $this->db->from($this->table_name . ' Em');
        $this->db->join('Tab_Control tb', 'Em.VEEVA_Employee_ID = tb.VEEVA_Employee_ID');
        $this->db->where(array('Em.VEEVA_Employee_ID' => $VEEVA_Employee_ID));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function generateTabs($Territory = 0, $Product_id = 0) {
        $tabs = $this->Tabs($this->VEEVA_Employee_ID);
        $this->load->model('Doctor_Model');
        $doctorCount = $this->Doctor_Model->CountDoctor($Territory, $this->Individual_Type);
        $profileCount = $this->ProfilingCount($Territory, $this->Product_Id);
        $rxlabel = $this->Product_Id == 1 ? 'Vials' : 'Rx';
        $hospital = $this->Product_Id == 1 ? 'Hospital' : 'Doctor';
        if ($doctorCount["DoctorCount"] > 0) {
            $PROFILE = ($profileCount["profile_count"] / $doctorCount["DoctorCount"]) * 100;
        } else {
            $PROFILE = 0;
        }

        if (isset($tabs['Tab1']) && $tabs['Tab1'] == 1) {
            $Tab1Location = "'" . site_url('User/Profiling') . "'";
        } elseif (isset($tabs['Tab1']) && $tabs['Tab1'] == 0) {
            $Tab1Location = '#';
        } else {
            $Tab1Location = '#';
        }

        if (isset($tabs['Tab2']) && $tabs['Tab2'] == 1) {
            $Tab2Location = "'" . site_url('User/Set_Target') . "'";
        } elseif (isset($tabs['Tab2']) && $tabs['Tab2'] == 0) {
            $Tab2Location = '#';
        } else {
            $Tab2Location = '#';
        }

        if (isset($tabs['Tab3']) && $tabs['Tab3'] == 1) {
            $Tab3Location = "'" . site_url('User/PlanMenu') . "'";
        } elseif (isset($tabs['Tab3']) && $tabs['Tab3'] == 0) {
            $Tab3Location = '#';
        } else {
            $Tab3Location = '#';
        }
        if (isset($tabs['Tab4']) && $tabs['Tab4'] == 1) {
            $Tab4Location = "'" . site_url('User/ActivityReporting') . "'";
        } elseif (isset($tabs['Tab4']) && $tabs['Tab4'] == 0) {
            $Tab4Location = '#';
        } else {
            $Tab4Location = '#';
        }
        if (isset($tabs['Tab5']) && $tabs['Tab5'] == 1) {
            $Tab5Location = "'" . site_url('User/Reporting') . "'";
        } elseif (isset($tabs['Tab5']) && $tabs['Tab5'] == 0) {
            $Tab5Location = '#';
        } else {
            $Tab5Location = '#';
        }
        if ($this->Product_Id == 1) {
            $vials = "Vials";
        } else {
            $vials = "Rx";
        }

        if ($doctorCount["DoctorCount"] > 0) {
            $tab1Calc = ($profileCount["profile_count"] / $doctorCount["DoctorCount"]) * 100;
        } else {
            $tab1Calc = 0;
        }
        if ($this->Product_Id > 0) {
            $data['show4'] = $this->Rx_Target_month2($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id, $this->nextMonth);
            $data['Planned'] = $this->Planned_Rx_Count();
            $data['Actual'] = $this->Actual_Rx_Count();
        }

        $activity_planned = $this->activity_planned($this->Territory, $this->Product_Id);
        $activity_actual = $this->activity_actual($this->Territory, $this->Product_Id);

        $prio_dr = $this->prio_dr($this->Territory, $this->Product_Id);
        $target = isset($data['show4']['target']) && $data['show4']['Status'] == 'Submitted' ? $data['show4']['target'] : 0;
        $Planned = isset($data['Planned']['Planned_Rx']) ? $data['Planned']['Planned_Rx'] : 0;
        $Actual = isset($data['Actual']['Actual_Rx']) ? $data['Actual']['Actual_Rx'] : 0;

        $HTML = '<div class="col-lg-12 col-md-12 col-xs-12">

                    <div class="panel panel-default" style="border-color: #fff;">
                        <div class="panel-body" style="    height: 117px;  " >
                            <a style="position: absolute;margin: 28px 0px 0px 0px;font-weight: 700;" onclick="window.location = ' . $Tab1Location . '" >' . $hospital . ' Profiling </a>
                            <div class="pull-right">
                            <input type="hidden" id="profile" value="' . $tab1Calc . '">
                                <input class="knob"   readonly="" id="1" style="display: none;" data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="' . $PROFILE . '">
                                <span style="    margin: -25px 0px 0px 41px;position: absolute;">' . $profileCount["profile_count"] . '/' . $doctorCount["DoctorCount"] . '</span>
                            </div>
                        </div>
                    </div>
                </div>';
        $HTML .='<div class="col-lg-12 col-md-12 col-xs-12">

                    <div class="panel panel-default" style="border-color: #fff;">
                        <div class="panel-body" style="    height: 117px; ">                       
                            <a style="position: absolute;margin: 28px 0px 0px 0px;font-weight: 700;" onclick="window.location = ' . $Tab2Location . ';">
                               No Of New ' . $vials . ' Targeted For ' . date('M') . "&nbsp" . date('Y') . '
                            </a>
                             <div class="pull-right">
                                <span style="font-size: x-large;position: absolute;margin: 25px 0px 0px -62px;" class="pull-right"><b>' . $target . '</b></span>

                         </div>
                        </div>
                    </div>
                </div>';


        $HTML .='<div class="col-lg-12 col-md-12 col-xs-12" >           
                     <div class="panel panel-default" style="border-color: #fff;">
                        <div class="panel-body" style="    height: 117px; ">
                            <a style="position: absolute;margin: 28px 0px 0px 0px;font-weight: 700;" onclick="window.location = ' . $Tab3Location . '">
                                Planning For The Month Of ' . date('M') . "&nbsp" . date('Y') . ' </a>
                        </div>
                    </div>
                </div>';

        $HTML .='<div class="col-lg-12 col-md-12 col-xs-12">

                    <div class="panel panel-default" style="border-color: #fff;">
                        <div class="panel-body" style="    height: 117px;  ">
                            <a style="position: absolute;margin: 28px 0px 0px 0px;font-weight: 700;" onclick="window.location = ' . $Tab5Location . '" >
                                Reporting Of ' . $vials . '
                            </a>
                            <div class="pull-right">
                                <input class="knob" id="5"  readonly="" style="display: none;" data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="35">

                                <span style="    margin: -25px 0px 0px 41px;position: absolute;">' . $Actual . '/' . $target . '</span>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default" style="border-color: #fff;">
                    <div class="panel-body" style="    height: 117px; ">
                            <a style="position: absolute;margin: 28px 0px 0px 0px;font-weight: 700;" onclick="window.location = ' . $Tab4Location . '" >

                                Reporting For Activities
                            </a>
                            <div class="pull-right">
                                <input class="knob" id="4"  readonly="" style="display: none;" data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="35">

                                <span style="    margin: -25px 0px 0px 41px;position: absolute;">' . $activity_actual['activity_actual'] . '/' . $activity_planned["activity_planned"] . '</span>

                            </div>
                        </div>
                    </div>
                </div>';
        return $HTML;
    }

    public function ProfilingCount($Territory, $Product_id = 0) {
        $this->db->select('COUNT(pf.`Territory`) AS profile_count,emp.`Territory`');
        $this->db->from('Employee_Master emp');
        $this->db->join('Profiling pf', 'emp.Territory = pf.Territory', 'LEFT');
        $this->db->where(array('pf.Product_id' => $Product_id, 'emp.Territory' => $Territory, 'pf.Status' => 'Submitted'));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getActivityDoctor() {
        $this->db->select('dm.*,ap.*');
        $this->db->from('Actual_Doctor_Priority dp');
        $this->db->join('Doctor_Master dm', 'dp.Doctor_Id = dm.Account_ID');
        $this->db->join('Activity_Planning ap', 'ap.Doctor_Id = dm.Account_ID AND ap.Product_Id = ' . $this->Product_Id, 'left');
        if ($this->Product_Id == 4 || $this->Product_Id == 6) {
            $where = "dp.Territory ='$this->Territory' AND dp.Product_id='4' OR dp.Territory ='$this->Territory' AND dp.Product_id='6' AND dp.month = '$this->nextMonth' AND 'dm.Individual_Type' = '$this->Individual_Type' ";
            $this->db->where($where);
        } else {
            $this->db->where(array('dp.Product_Id' => $this->Product_Id, 'dp.Territory' => $this->Territory, 'dp.month' => $this->nextMonth, 'dm.Individual_Type' => $this->Individual_Type));
        }
        $this->db->group_by('dp.Doctor_Id');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }

    ///Not Territory Specific
    public function getActivityDoctor2($id, $product_id) {
        $this->db->select('dm.*,ap.*');
        $this->db->from('Doctor_Master dm', 'dp.Doctor_Id = dm.Account_ID');
        $this->db->join('Activity_Planning ap', 'ap.Doctor_Id = dm.Account_ID AND ap.month = ' . $this->nextMonth . ' AND Year = ' . $this->nextYear . ' AND ap.Product_Id = ' . $this->Product_Id, 'left');
        $where = "ap.VEEVA_Employee_ID ='$id' ";
        $this->db->where($where);
        $this->db->group_by('ap.Doctor_Id');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }

    public function getPlannedActivityDoctor() {
        $this->db->select('dm.*, `ap`.*,rp.`Activity_Done`,rp.`Activity_Detail`,rp.`Reason`,rp.Approve_Status');
        $this->db->from('Activity_Planning ap');
        $this->db->join('Doctor_Master dm', 'ap.Doctor_Id = dm.Account_ID');
        $this->db->join('Activity_Reporting rp', 'rp.Doctor_Id = dm.Account_ID AND rp.Product_Id = "' . $this->Product_Id . '"', 'LEFT');
        $this->db->where(array('ap.Product_Id' => $this->Product_Id, 'ap.Territory' => $this->Territory, 'ap.month' => $this->nextMonth));
        $this->db->group_by('ap.Doctor_Id');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }

    public function getPlannedActivityDoctor2($id, $Product_Id) {
        $this->db->select('dm.*,ap.*');
        $this->db->from('Doctor_Master dm', 'dp.Doctor_Id = dm.Account_ID');
        $this->db->join('Activity_Reporting ap', 'ap.Doctor_Id = dm.Account_ID AND ap.month = ' . $this->nextMonth . ' AND Year = ' . $this->nextYear . ' AND ap.Product_Id = ' . $this->Product_Id, 'left');
        $where = "ap.Territory ='$id' ";
        $this->db->where($where);
        $this->db->group_by('ap.Doctor_Id');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }

    function getPlanning($Territory, $Product_id = 0, $month = 0, $Year = '2016', $where = 'false', $doctor_ids = array()) {
        $this->db->select('rxp.*,dm.*,pf.Winability,pf.Patient_Rxbed_In_Month,pf.Patient_Seen_month');
        $this->db->from('Employee_Doc ed');
        $this->db->join('Doctor_Master dm', 'dm.Account_ID = ed.VEEVA_Account_ID');
        $this->db->join('Profiling pf', 'dm.Account_ID = pf.Doctor_Id', 'LEFT');
        $this->db->join('Rx_Planning rxp', 'dm.Account_ID = rxp.Doctor_Id AND rxp.Product_Id = ' . $Product_id . ' AND rxp.Year = "' . $Year . '" AND rxp.month = "' . $month . '" AND rxp.Territory = "' . $Territory . '"', 'LEFT');

        //$where = "ed.Territory ='$Territory' AND dm.Individual_Type = '$this->Individual_Type' ";
        $this->db->where(array('ed.Territory' => $Territory, 'dm.Individual_Type' => $this->Individual_Type));
        $this->db->group_by('dm.Account_ID');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }

    function getReporting($Territory, $Product_id = 0, $month = 0, $Year = '2016', $where = 'false', $doctor_ids = array()) {
        $date = date('Y-m-d');
        $sql = "SELECT 
                    `rxp`.`Planned_Rx`,
                    `dm`.*,
                    SUM(CASE WHEN DATE_FORMAT(act.created_at,'%Y-%m-%d') = '$date' THEN act.Actual_Rx END ) AS Actual_Rx2,
                    SUM(act.Actual_Rx) AS Actual_Rx,
                    `pf`.`Winability`,
                    `pf`.`Patient_Rxbed_In_Month`,
                    `pf`.`Patient_Seen_month`,                   
                    act.Approve_Status
                  FROM
                    (`Employee_Doc` ed) 
                    JOIN `Doctor_Master` dm 
                      ON `dm`.`Account_ID` = `ed`.`VEEVA_Account_ID` 
                    LEFT JOIN `Profiling` pf                     
                      ON `dm`.`Account_ID` = `pf`.`Doctor_Id` AND Product_Id = {$Product_id} 
                    LEFT JOIN `Rx_Planning` rxp 
                      ON `dm`.`Account_ID` = `rxp`.`Doctor_Id` 
                      AND rxp.Product_Id = {$Product_id} 
                      AND rxp.Year = '$Year' 
                      AND rxp.month = '$month' 
                      AND rxp.Territory = '$Territory' 
                    LEFT JOIN `Rx_Actual` act 
                      ON `dm`.`Account_ID` = `act`.`Doctor_Id` 
                      AND act.Product_Id = {$Product_id} 
                      AND act.Year = '$Year' 
                      AND act.month =  '$month' 
                      AND act.Territory = '$Territory' 
                  WHERE `ed`.`Territory` = '$Territory' 
                    AND `dm`.`Individual_Type` = '$this->Individual_Type' 
                  GROUP BY `dm`.`Account_ID` ORDER BY act.created_at DESC ";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        return $query->result();
    }

    ///Not Territory SPecific
    function getPlanningAproval($VEEVA_Employee_ID, $Product_id = 0, $month = 0, $Year = '2016', $where = 'false', $doctor_ids = array()) {
        $this->db->select('rxp.*,dm.*');
        $this->db->from('Employee_Doc ed');
        $this->db->join('Doctor_Master dm', 'dm.Account_ID = ed.VEEVA_Account_ID', 'INNER');
        $this->db->join('Rx_Planning rxp', 'dm.Account_ID = rxp.Doctor_Id AND rxp.Product_Id = ' . $Product_id . ' AND rxp.Year = "' . $Year . '" AND rxp.month = "' . $month . '" AND rxp.VEEVA_Employee_ID = "' . $VEEVA_Employee_ID . '"', 'INNER');
        $where = "ed.VEEVA_Employee_ID ='$VEEVA_Employee_ID' AND dm.Individual_Type = '$this->Individual_Type'";
        $this->db->where($where);
        $this->db->group_by('dm.Account_ID');
        $this->db->order_by('rxp.Planned_Rx DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }

    function getPlanning2($Territory, $Product_id = 0, $month = 0, $Year = '2016', $where = 'false', $doctor_ids = array()) {

        $doctor_id = join(",", $doctor_ids);
        $sql = "SELECT rxp.*,dm.*,pf.Winability,pf.Patient_Rxbed_In_Month,pf.Patient_Seen_month FROM Employee_Master emp "
                . " INNER JOIN Employee_Doc ed ON ed.Territory = emp.Territory "
                . " INNER JOIN Doctor_Master dm ON dm.Account_ID = ed.VEEVA_Account_ID "
                . " LEFT JOIN Profiling pf ON dm.Account_ID = pf.Doctor_ID "
                . " LEFT JOIN Rx_Planning rxp ON dm.Account_ID = rxp.Doctor_Id "
                . " WHERE rxp.Doctor_Id IN (" . $doctor_id . ") AND rxp.Product_id = '$Product_id' AND emp.Territory = '$Territory' AND rxp.month = '$month' AND rxp.Year = '$Year' "
                . " GROUP BY dm.Account_ID order by FIELD(rxp.Doctor_Id ," . $doctor_id . ")";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        return $query->result();
    }

    function generatePlanningTab($type = 'Planning', $priority = 'false', $doctor_ids = array()) {
        $result1 = $this->Rx_Target_month($this->Territory, $this->Product_Id, $this->nextMonth, $this->nextYear);

        if (isset($result1->target) && $result1->target > 0) {
            if ($priority == 'true') {
                $result = $this->User_model->getPlanning2($this->Territory, $this->Product_Id, $this->nextMonth, $this->nextYear, 'true', $doctor_ids);
            } else {
                $result = $this->User_model->getPlanning($this->Territory, $this->Product_Id, $this->nextMonth, $this->nextYear);
                //var_dump($result);
            }
            if (empty($result)) {
                $this->load->model('Doctor_Model');
                $result = $this->Doctor_Model->getDoctor($this->Territory, $this->Individual_Type);
                //var_dump($result);
            }
            if ($type == 'Planning') {
                $html = form_open('User/doctorList');
            } elseif ($type == 'Actual') {
                $html = form_open('User/Prescription_Doctor_List');
            }


            if ($this->Product_Id == 1) {
                $vials = "Vials";
                $hospital = "Hospital";
            } else {
                $vials = "Rx";
                $hospital = "Doctor";
            }

            $html .= '<table class="table table-bordered" id="datatable">
                <thead>
                <tr>
                    <th>' . $hospital . ' List</th>';
            if ($type == 'Planning') {
                $html .= '<th>Winability</th><th>Dependency</th>';
                if ($this->Product_Id == 1) {
                    $html .= '<th>LYSIS Share</th>';
                } else {
                    $html .= '<th>BI Market Share</th>';
                }
            }

            $html .= '<th>' . date('M', strtotime('-3 month')) . $vials . ' </th>
                            <th>' . date('M', strtotime('-2 month')) . $vials . '</th>
                            <th>' . date('M', strtotime('-1 month')) . $vials . '</th>
                            <th>New ' . $vials . ' Targeted For ' . date('M', strtotime($this->nextMonth)) . ' </th>';
            if ($type == 'Planning') {
                $html .= '<th>New ' . $vials . ' Targeted For ' . date('M', strtotime($this->nextMonth)) . ' </th></tr></thead><tbody>';
            } elseif ($type == 'Actual') {
                $html .= '<th>Cumulative Month to Date</th><th>Actual</th></tr></thead><tbody>';
            } else {
                $html .= '</tr></thead><tbody>';
            }


            $month = date('n', strtotime('-1 month'));
            $lastMonthRx = $this->countLastMonthRx($month);
            $currentMonthRx = $this->countPlannedRx(date('n'));
            if (isset($result) && !empty($result)) {
                foreach ($result as $doctor) {
                    $planned_rx = isset($doctor->Planned_Rx) ? $doctor->Planned_Rx : "";
                    $actual_rx = isset($doctor->Actual_Rx) ? $doctor->Actual_Rx : "";


                    $month1 = date('n', strtotime('-3 month'));
                    $month2 = date('n', strtotime('-2 month'));
                    $month3 = date('n', strtotime('-1 month'));
                    $month4 = date('n');
                    $year1 = date('Y', strtotime('-3 month'));
                    $year2 = date('Y', strtotime('-2 month'));
                    $year3 = date('Y', strtotime('-1 month'));
                    $year4 = date('Y');

                    $month1Actual = 0;
                    $month2Actual = 0;
                    $month3Actual = 0;
                    $month4Actual = 0;

                    $last3MonthRx = $this->Last3MonthsRx($month1, $month2, $month3, $month4, $year1, $year2, $year3, $year4, $doctor->Account_ID);
                    if (!empty($last3MonthRx)) {
                        $count = 1;
                        foreach ($last3MonthRx as $value) {
                            if ($value->month === $month1) {
                                $month1Actual = isset($value->Actual_Rx) ? $value->Actual_Rx : '';
                            } elseif ($value->month === $month2) {
                                $month2Actual = isset($value->Actual_Rx) ? $value->Actual_Rx : '';
                            } elseif ($value->month === $month3) {
                                $month3Actual = isset($value->Actual_Rx) ? $value->Actual_Rx : '';
                            } elseif ($value->month === $month4) {
                                $month4Actual = isset($value->Actual_Rx) ? $value->Actual_Rx : '';
                            }
                        }
                    }
                    $winability = isset($doctor->Winability) ? $doctor->Winability : '';
                    $month4rx = $month4Actual;
                    if ($lastMonthRx->Actual_Rx > 0) {
                        $dependancy = round(($month3Actual / $lastMonthRx->Actual_Rx ) * 100, 0, PHP_ROUND_HALF_EVEN);
                    } else {
                        $dependancy = 0;
                    }
                    if ($this->Product_Id == 1) {
                        if (isset($doctor->Patient_Seen_month) && $doctor->Patient_Seen_month > 0) {
                            $BI_Share = round(($month3Actual / $doctor->Patient_Seen_month) * 100, 0, PHP_ROUND_HALF_EVEN);
                        } else {
                            $BI_Share = '';
                        }
                    } else {
                        if (isset($doctor->Patient_Rxbed_In_Month) && $doctor->Patient_Rxbed_In_Month > 0) {
                            $BI_Share = round(($month3Actual / $doctor->Patient_Rxbed_In_Month) * 100, 0, PHP_ROUND_HALF_EVEN);
                        } else {
                            $BI_Share = '';
                        }
                    }


                    if ($priority == 'true') {
                        $result = $this->User_model->ActualPriorityExist($doctor->Account_ID);
                        if (!empty($result)) {
                            $html .= '<tr>
                        <td><input type = "checkbox" name = "priority[]" checked="checked" value = "' . $doctor->Account_ID . '" >   ' . $doctor->Account_Name . '';
                        } else {
                            $html .= '<tr>
                        <td><input type = "checkbox" name = "priority[]" value = "' . $doctor->Account_ID . '" >   ' . $doctor->Account_Name . '';
                        }
                    } else {
                        $html .= '<tr>
                        <td>' . $doctor->Account_Name . '';
                    }


                    $html .='<p>Speciality : ' . $doctor->Specialty . '</p></a></td>';
                    if ($type == 'Planning') {
                        $html .= '<td>' . $winability . '</td><td>' . $dependancy . '%</td>
                                   <td>' . $BI_Share . '</td>';
                    }

                    $html .='<td>' . $month1Actual . '</td>
                            <td>' . $month2Actual . '</td>
                            <td>' . $month3Actual . '</td>';
                    if ($type == 'Planning') {
                        if ($priority == 'true') {
                            $html .= '<td>' . $planned_rx . '</td><td> <input name = "value[]" min="0" disabled="disabled" class = "val" type = "number" value = "' . $planned_rx . '"/><input type = "hidden" name = "doc_id[]" value = "' . $doctor->Account_ID . '"/></td>
                                </tr>';
                        } else {
                            $html .= '<td>' . $planned_rx . '</td><td> <input name = "value[]" min="0" class = "val" type = "number" value = "' . $planned_rx . '"/><input type = "hidden" name = "doc_id[]" value = "' . $doctor->Account_ID . '"/></td>
                                </tr>';
                        }
                    } elseif ($type == 'Actual') {
                        $html .= '<td>' . $planned_rx . '<input type = "hidden" name = "doc_id[]" value = "' . $doctor->Account_ID . '"/></td>
                                <td>' . $month4rx . '</td>
                                <td> <input name = "value[]" type = "number" class="val" min="0" value = ""/></td>
                                </tr>';
                    }
                }
            }
            $html.='</tbody></table>';
        } else {
            $html = "<h1>Please Set Target Before Planning</h1>";
        }

        return $html;
    }

    function getMonthwiseRx($Doctor_Id = 0, $month = 0, $Year = '2015') {
        $this->db->select('*');
        $this->db->from('Rx_Actual');
        $this->db->where(array('Doctor_id' => $Doctor_Id, 'Product_id' => $this->Product_Id, 'Territory' => $this->Territory, 'month' => $month, 'Year' => $Year));
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row();
    }

    function Last3MonthsRx($month1, $month2, $month3, $month4, $year1, $year2, $year3, $year4, $Doctor_ID) {
        $sql = "SELECT
                SUM(Actual_Rx) AS Actual_Rx,month

               FROM (`Rx_Actual`)
               WHERE 
               `Doctor_id` =  '$Doctor_ID'
               AND `Product_id` =  '$this->Product_Id'
               AND `Territory` =  '$this->Territory'
               AND `month` =  '$month1'
               AND `Year` =  '$year1'

               OR `month` =  '$month2'
               AND `Doctor_id` =  '$Doctor_ID'
               AND `Product_id` =  '$this->Product_Id'
               AND `Territory` =  '$this->Territory'
               AND `Year` =  '$year2'

               OR `month` =  '$month3'
               AND `Doctor_id` =  '$Doctor_ID'
               AND `Product_id` =  '$this->Product_Id'
               AND `Territory` =  '$this->Territory'
               AND `Year` =  '$year3'
                   
                OR `month` =  '$month4'
               AND `Doctor_id` =  '$Doctor_ID'
               AND `Product_id` =  '$this->Product_Id'
               AND `Territory` =  '$this->Territory'
               AND `Year` =  '$year4' GROUP BY month   ";
        $query = $this->db->query($sql);
        ///echo $this->db->last_query();
        return $query->result();
    }

    function countLastMonthRx($month = 0, $Year = '2015') {
        $this->db->select('SUM(Actual_Rx) AS Actual_Rx');
        $this->db->from('Rx_Actual rx');
        $this->db->join('Doctor_Master dm', 'rx.Doctor_Id = dm.Account_ID');
        $this->db->where(array('rx.Product_id' => $this->Product_Id, 'rx.Territory' => $this->Territory, 'rx.month' => $month, 'rx.Year' => $Year));
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row();
    }

    function countPlannedRx($month = 0) {
        $this->db->select('SUM(Actual_Rx) AS Planned_Rx');
        $this->db->from('Rx_Actual');
        $this->db->where(array('Product_id' => $this->Product_Id, 'Territory' => $this->Territory, 'month' => $month));
        $query = $this->db->get();
        return $query->row();
    }

    function getWinability($Doctor_Id = 0) {
        $this->db->select('*');
        $this->db->from('Profiling');
        $this->db->where(array('Doctor_id' => $Doctor_Id, 'Product_id' => $this->Product_Id, 'Territory' => $this->Territory));
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->row();
    }

    function calcWinability($Win_Q1, $Win_Q2, $Win_Q3) {

        $winabilty = '';

        if ($this->Product_Id == 1) {
            if ($Win_Q1 == 'No') {
                $winabilty = '<a class = "control-item badge badge-negative">L</a>';
            } elseif ($Win_Q1 == 'Yes') {
                if ($Win_Q2 == 'No') {
                    $winabilty = '<a class = "control-item badge badge-primary">M</a>';
                } elseif ($Win_Q2 == 'Yes' && $Win_Q3 == 'No') {
                    $winabilty = '<a class = "control-item badge badge-primary">M</a>';
                } elseif ($Win_Q2 == 'Yes' && $Win_Q3 == 'Yes') {
                    $winabilty = '<a class = "control-item badge badge-positive">H</a>';
                }
            }
        } elseif ($this->Product_Id == 2 || $this->Product_Id == 3 || $this->Product_Id == 4 || $this->Product_Id == 5 || $this->Product_Id == 6) {
            if ($Win_Q1 == 'Yes' && $Win_Q2 == 'Yes' && $Win_Q3 == 'No') {
                $winabilty = '<a class = "control-item badge badge-positive">H</a>';
            } elseif ($Win_Q1 == 'No' && $Win_Q2 == 'Yes' && $Win_Q3 == 'No' || $Win_Q1 == 'Yes' && $Win_Q2 == 'No' && $Win_Q3 == 'No' || $Win_Q1 == 'Yes' && $Win_Q2 == 'No' && $Win_Q3 == 'Yes' || $Win_Q1 == 'Yes' && $Win_Q2 == 'Yes' && $Win_Q3 == 'Yes') {
                $winabilty = '<a class = "control-item badge badge-primary">M</a>';
            } elseif ($Win_Q1 == 'No' && $Win_Q2 == 'No' && $Win_Q3 == 'No' || $Win_Q1 == 'No' && $Win_Q2 == 'No' && $Win_Q3 == 'Yes' || $Win_Q1 == 'No' && $Win_Q2 == 'Yes' && $Win_Q3 == 'Yes') {
                $winabilty = '<a class = "control-item badge badge-negative">L</a>';
            }
        }

        return $winabilty;
    }

    function PriorityIds() {
        $doctors = array();
        $sql = "SELECT `Doctor_Id` FROM `Doctor_Priority` WHERE `Delta` >= 20
        AND VEEVA_Employee_Id = '$this->Territory' and Product_Id = '$this->Product_Id'  AND month = '$this->nextMonth' ORDER BY Delta DESC ";
        //echo $sql;
        $query = $this->db->query($sql);
        $result = $query->result();
        if (!empty($result)) {
            foreach ($result as $value) {
                array_push($doctors, $value->Doctor_Id);
            }
        }

        $sql = "SELECT `Doctor_Id` FROM `Doctor_Priority` WHERE `Dependancy` >= 20
                AND VEEVA_Employee_Id = '$this->Territory' and Product_Id = '$this->Product_Id' AND month = '$this->nextMonth' ORDER BY Dependancy DESC  ";
        //echo $sql;
        $query = $this->db->query($sql);
        $result = $query->result();
        if (!empty($result)) {
            foreach ($result as $value) {
                array_push($doctors, $value->Doctor_Id);
            }
        }
        $doctors = array_unique($doctors);

        $sql = "SELECT `Doctor_Id` FROM `Doctor_Priority` 
                WHERE VEEVA_Employee_Id = '$this->Territory' and Product_Id = '$this->Product_Id' AND month = '$this->nextMonth' ORDER BY `Planned_Rx` DESC                ";
        //echo $sql;
        $query = $this->db->query($sql);
        $result = $query->result();
        if (!empty($result)) {
            foreach ($result as $value) {
                array_push($doctors, $value->Doctor_Id);
            }
        }

        $doctors = array_unique($doctors);
        $doctors2 = array();
        if (!empty($doctors)) {
            foreach ($doctors as $value) {
                array_push($doctors2, "'" . $value . "'");
            }
        }

        //$doctors = array_unique($doctors);
        return $doctors2;
    }

    function getActivityList() {
        $this->db->select('*');
        $this->db->from('Activity_Master');
        $this->db->where(array('Product_id' => $this->Product_Id));
        $query = $this->db->get();
        return $query->result();
    }

    function Planned_Rx_Count() {
        $this->db->select('SUM(`Planned_Rx`) AS Planned_Rx');
        $this->db->from('Rx_Planning');
        $this->db->where(array('Territory' => $this->Territory, 'Product_Id' => $this->Product_Id, 'month' => $this->nextMonth, 'Year' => $this->nextYear, 'Planning_Status' => 'Submitted'));
        $query = $this->db->get();
        return $query->row_array();
    }

    function Actual_Rx_Count() {
        $this->db->select('SUM(`Actual_Rx`) AS Actual_Rx');
        $this->db->from('Rx_Actual');
        $this->db->where(array('Territory' => $this->Territory, 'Product_Id' => $this->Product_Id, 'month' => $this->nextMonth, 'Year' => $this->nextYear, 'Status' => 'Submitted'));
        $query = $this->db->get();
        return $query->row_array();
    }

    function getPlannedActivityList($Doctor_Id) {
        $this->db->select('*');
        $this->db->from('Activity_Planning ap');
        $this->db->join('Activity_Master am', 'ap.Activity_Id = am.Activity_id');
        $this->db->where(array('ap.Product_id' => $this->Product_Id, 'Territory' => $this->Territory));
        $query = $this->db->get();
        return $query->result();
    }

    function generateCheckboxList($result, $id) {
        $html = '';
        if (!empty($result)) {
            foreach ($result as $item) {
                $html .= '<p><input name = "activity[]" value = "' . $item->Activity_id . '" type = "checkbox" /> ' . $item->Activity_Name . '</p>';
            }
        }
        return $html;
    }

    function PlanningExist($Doctor_Id = "") {
        $this->db->select('*');
        $this->db->from('Rx_Planning');
        $this->db->where(array('Product_Id' => $this->Product_Id, 'Territory' => $this->Territory, 'Doctor_Id' => $Doctor_Id, 'month' => $this->nextMonth, 'Year' => $this->nextYear));
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row();
    }

    function password($id, $data) {
        if ($id != '') {
            $this->db->where(array('VEEVA_Employee_ID' => $id));
            return $this->db->update('Employee_Master', $data);
        }
    }

    //// Not a Territory Specific
    function password_status($id) {
        $this->db->select('*');
        $this->db->from('Employee_Master');
        $this->db->where(array('VEEVA_Employee_ID' => $id));
        $query = $this->db->get();
        return $query->row_array();
    }

    function employee_id($id) {
        $this->db->select('*');
        $this->db->from('Employee_Master');
        $this->db->where(array('Username' => $id));
        $query = $this->db->get();
        return $query->row_array();
    }

    //Dont Require Territory
    function password_count($id) {
        $current_date = date('Y-m-d H:i:s');
        $previous_date = date('Y-m-d H:i:s', strtotime('-1 hour'));
        $this->db->select('COUNT(VEEVA_Employee_ID) AS cnt');
        $this->db->from('password_count');
        $where = "VEEVA_Employee_ID = '$id' AND created_at BETWEEN '$previous_date' AND '$current_date' ";
        $this->db->where($where);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row_array();
    }

    function password_save($data) {
        return $this->db->insert('password_count', $data);
    }

    function update_status($id, $data) {
        $this->db->where(array('Username' => $id));
        return $this->db->update('Employee_Master', $data);
    }

    function update_last_login($id, $data) {
        $this->db->where(array('Territory' => $id));
        return $this->db->update('Employee_Master', $data);
    }

    function PriorityExist($Doctor_Id) {
        $this->db->select('*');
        $this->db->from('Doctor_Priority');
        $this->db->where(array('Territory' => $this->Territory, 'Product_Id' => $this->Product_Id, 'Doctor_Id' => $Doctor_Id));
        $query = $this->db->get();
        return $query->row_array();
    }

    function ActualPriorityExist($Doctor_Id) {
        $this->db->select('*');
        $this->db->from('Actual_Doctor_Priority');
        $this->db->where(array('Territory' => $this->Territory, 'Product_Id' => $this->Product_Id, 'Doctor_Id' => $Doctor_Id, 'month' => $this->nextMonth, 'Year' => $this->nextYear));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function product_detail($Territory, $Product_id, $month, $year) {
        $this->db->select('SUM(Actual_Rx) AS Actual_Rx');
        $this->db->from('Rx_Actual rx');
        $this->db->join('Doctor_Master dm', 'rx.Doctor_Id = dm.Account_ID');
        $this->db->where(array('rx.Territory' => $Territory, 'rx.Product_id' => $Product_id, 'rx.month' => $month, 'Year' => $year, 'rx.Status' => 'Submitted'));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function kpi($Territory, $Product_id, $month, $year) {
        $this->db->select('SUM(`Planned_Rx`) as planned_rx');
        $this->db->from('`Rx_Planning` rp');
        $this->db->join('Employee_Doc ed', 'ed.VEEVA_Account_ID = rp.Doctor_Id');
        $this->db->where(array('rp.Territory' => $Territory, 'Product_id' => $Product_id, 'month' => $month, 'Year' => $year, 'Planning_Status' => 'Submitted'));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function product_detail_user($Territory, $Product_id, $month, $year) {
        $this->db->select('COUNT(DISTINCT(`Doctor_Id`)) AS doctor_count');
        $this->db->from('`Rx_Actual`');
        $this->db->where(array('Territory' => $Territory, 'Product_id' => $Product_id, 'month' => $month, 'Year' => $year));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function activity_planned($Territory, $Product_id) {
        $this->db->select('COUNT(`Activity_Id`) AS activity_planned');
        $this->db->from('`Activity_Planning`');
        $this->db->where(array('Territory' => $Territory, 'Product_id' => $Product_id, 'Year' => $this->nextYear, 'month' => $this->nextMonth, 'Status' => 'Submitted'));
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row_array();
    }

    public function activity_actual($Territory, $Product_id) {
        $this->db->select('COUNT(Act_Plan) AS activity_actual');
        $this->db->from('`Activity_Reporting`');
        $this->db->where(array('Territory' => $Territory, 'Product_id' => $Product_id, 'Year' => $this->nextYear, 'month' => $this->nextMonth, 'Status' => 'Submitted', 'Activity_Done' => 'Yes'));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function prio_dr($Territory, $Product_id) {
        $this->db->select('COUNT(DISTINCT(`Doctor_Id`)) AS doctor_id');
        $this->db->from('`Actual_Doctor_Priority`');
        if ($this->Product_Id == 4 || $this->Product_Id == 6) {
            $where = "Territory ='$Territory' AND Product_id='4' AND Year='$this->nextYear' OR Territory ='$Territory' AND Product_id='6' AND Year='$this->nextYear' AND Status ='Submitted' ";
            $this->db->where($where);
        } else {
            $this->db->where(array('Territory' => $Territory, 'Product_id' => $Product_id, 'Status' => 'Submitted', 'Year' => $this->nextYear));
        }

        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row_array();
    }

    public function generateActivityTable($result = array(), $type = "") {
        $HTML = '';
        if ($this->Product_Id == 1) {
            $hospital = "Hospital";
        } else {
            $hospital = "Doctor";
        }
        $Activities = $this->getActivityList();

        if (!empty($result)) {
            $HTML = '<table class="table table-bordered">';
            $HTML .= '<tr>
                                <th>
                                    ' . $hospital . ' Name
                                </th>
                                <th>Activity</th>';
            if ($type == 'Reporting') {
                $HTML .= '<th>Action</th>';
            }
            $HTML .= '</tr>';

            $allApproved = TRUE;
            foreach ($result as $value) {

                if (isset($value->Act_Plan) && !is_null($value->Act_Plan)) {
                    $ActivityList = $this->Master_Model->generateDropdown($Activities, 'Activity_id', 'Activity_Name', $value->Activity_Id);
                } else {
                    $ActivityList = $this->Master_Model->generateDropdown($Activities, 'Activity_id', 'Activity_Name');
                }
                $style = '';
                if (isset($value->Approve_Status) && $value->Approve_Status == 'Approved') {
                    $style = 'style="background-color:#c6ebd9;"';
                } elseif (isset($value->Approve_Status) && $value->Approve_Status == 'Un-Approved') {
                    $style = 'style="background-color: #ff9999;"';
                    $allApproved = FALSE;
                } else {
                    $allApproved = FALSE;
                }
                $HTML .= '<tr ' . $style . ' ><td>' . $value->Account_Name . '<input type="hidden" name="Doctor_Id[]" value="' . $value->Account_ID . '" ></td>';

                if ($type == 'Reporting') {
                    $activity_detail = isset($value->Activity_Detail) ? $value->Activity_Detail : '';
                    $reason = isset($value->Reason) ? $value->Reason : '';
                    $Activity_Done = isset($value->Activity_Done) ? $value->Activity_Done : '';
                    $Status = isset($value->Status) && $value->Status != '' ? $value->Status : '';
                    $HTML .= '<td><input type="hidden" value="' . $value->Activity_Id . '" name="Activity_Id[]" ><select class="form-control" readonly="readonly" disabled="disabled" name="Activity_Id[]"><option value>Select Activity</option>' . $ActivityList . '</select></td>';
                    $HTML .='<td><div class="col-xs-8">
                        <div class="toggle">';
                    if ($Activity_Done == "Yes" && $Status == 'Submitted' || $Activity_Done == "Yes" && $Status == 'Draft') {
                        $HTML .=' <label><input type="radio" checked="checked" name="' . $value->Account_ID . '" value="Yes"><span class="input-checked" id="' . $value->Account_ID . '-1 ">Yes</span>';
                    } else {
                        $HTML .=' <label><input type="radio" name="' . $value->Account_ID . '" value="Yes"><span id="' . $value->Account_ID . '-1 ">Yes</span>';
                    }
                    $HTML .='</label>    
                        </div>
                        <div class="toggle">';
                    if ($Activity_Done == "No" && $Status == 'Submitted' || $Activity_Done == "No" && $Status == 'Draft') {
                        $HTML .=' <label><input type="radio" checked="checked" name="' . $value->Account_ID . '" value="No"><span class="input-checked" id="' . $value->Account_ID . '-2 " >No</span>';
                    } else {
                        $HTML .=' <label><input type="radio" name="' . $value->Account_ID . '" value="No"><span id="' . $value->Account_ID . '-2 " >No</span>';
                    }
                    $HTML .='</label>
                        </div>
                    </div>';

                    if ($Activity_Done == "Yes" && $Status == 'Submitted') {
                        $HTML .= $activity_detail;
                    } else {
                        $HTML .='<div id="heading' . $value->Account_ID . '" class="custom-collapse " style="display: none">
                        <div class="row row-margin-top">
                            <div class="col-xs-12 col-lg-12"><textarea id="act' . $value->Account_ID . '" class="form-control" name="Activity_Detail[]"  placeholder="Activity Details">' . $activity_detail . '</textarea> </div> 
                        </div> 
                    </div><div id="reason' . $value->Account_ID . '" class="custom-collapse " style="display: none">
                        <div class="row row-margin-top">
                            <div class="col-xs-12 col-lg-12"><textarea id="res' . $value->Account_ID . '" class="form-control" name="Reason[]"  placeholder="Reason">' . $reason . '</textarea> </div> 
                        </div> 
                    </div>';
                    }

                    if ($Activity_Done == "No" && $Status == 'Submitted') {
                        $HTML .=$reason;
                    } else {
                        $HTML .='<div id="heading' . $value->Account_ID . '" class="custom-collapse " style="display: none">
                        <div class="row row-margin-top">
                            <div class="col-xs-12 col-lg-12"><textarea id="act' . $value->Account_ID . '" class="form-control" name="Activity_Detail[]"  placeholder="Activity Details">' . $activity_detail . '</textarea> </div> 
                        </div> 
                    </div> <div id="reason' . $value->Account_ID . '" class="custom-collapse " style="display: none">
                        <div class="row row-margin-top">
                            <div class="col-xs-12 col-lg-12"><textarea id="res' . $value->Account_ID . '" class="form-control" name="Reason[]"  placeholder="Reason">' . $reason . '</textarea> </div> 
                        </div> 
                    </div>';
                    }
                    $HTML .='</td>';
                } else {
                    $HTML .= '<td><div class="form-group"><select class="form-control" name="Activity_Id[]"><option value>Select Activity</option>' . $ActivityList . '</select></div></td>';
                }

                $HTML .= '</tr>';
            }
            $HTML .= '</table>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">Save</button>';
            if ($allApproved == TRUE) {
                $HTML .='<button type="submit" id="Submit" class="btn btn-danger">Submit</button>';
            } else {
                $HTML .='<button type="submit" id="Approve" class="btn btn-info">Save For Approval</button>';
            }
            $HTML .='</div>';
        }

        return $HTML;
    }

    public function generateActivityTable2($result = array(), $type = "") {
        $HTML = '';
        if ($this->Product_Id == 1) {
            $hospital = "Hospital";
        } else {
            $hospital = "Doctor";
        }
        $Activities = $this->getActivityList();

        if (!empty($result)) {
            $HTML = '<div class="table-responsive panel"><table class="table table-bordered">';
            $HTML .= '<tr><th>
                                    ' . $hospital . ' Name
                            </th>
                                <th>Activity</th>
                                ';
            if ($type == 'Reporting') {
                $HTML .= '<th>Activity Done</th>';
            }
            $HTML .= '<th><input type="radio" name="toggle" id="check-all" >Approve</th><th><input type="radio" name="toggle" id="uncheck-all" >Reject</th></tr>';

            foreach ($result as $value) {
                $Status = isset($value->Approve_Status) && $value->Approve_Status == 'Un-Approved' ? 'checked' : '';
                if (isset($value->Act_Plan) && !is_null($value->Act_Plan)) {
                    $ActivityList = $this->Master_Model->generateDropdown($Activities, 'Activity_id', 'Activity_Name', $value->Activity_Id);
                } else {
                    $ActivityList = $this->Master_Model->generateDropdown($Activities, 'Activity_id', 'Activity_Name');
                }

                $isApproved = isset($value->Approve_Status) && $value->Approve_Status == 'Approved' ? 'background-color:#c6ebd9;' : '';

                if ($value->Approve_Status == 'Approved') {
                    $HTML .= '<tr style="' . $isApproved . '"><td>' . $value->Account_Name . '</td>';
                    $HTML .= '<td><select class="form-control" disabled="disabled" ><option value="-1">Select Activity</option>' . $ActivityList . '</select></td>';
                    if ($type == 'Reporting') {
                        $HTML .= '<td>' . $value->Activity_Done . '</td>';
                    }
                    $HTML .= '<td><input type="radio" disabled="disabled" checked="checked"  value="Approved"></td>';
                    $HTML .= '<td><input type="radio" disabled="disabled"  ' . $Status . ' value="Un-Approved"></td>';
                } else {
                    $HTML .= '<tr style="' . $isApproved . '"><td>' . $value->Account_Name . '<input type="hidden" name="Doctor_Id[]" value="' . $value->Account_ID . '"></td>';
                    $HTML .= '<td><select class="form-control" disabled="disabled" name="Activity_Id[]"><option value="-1">Select Activity</option>' . $ActivityList . '</select></td>';
                    if ($type == 'Reporting') {
                        $HTML .= '<td>' . $value->Activity_Done . '</td>';
                    }
                    $HTML .= '<td><input type="radio" class="check-all" ' . $Status . ' name="approve_' . $value->Account_ID . '" value="Approved"></td>';
                    $HTML .= '<td><input type="radio" class="uncheck-all" ' . $Status . ' name="approve_' . $value->Account_ID . '" value="Un-Approved"></td>';
                }
                $HTML .= '</tr>';
            }
            $HTML .= '</table></div>'
                    . ' <button type="button" data-toggle="modal" data-target="#CommentModal" class="btn btn-primary pull-right">Approve</button>';
        } else {
            $HTML .= '<h1>Data Not Available.</h1>';
        }

        return $HTML;
    }

    function ReportingExist($Doctor_Id = "") {
        $this->db->select('*');
        $this->db->from('Rx_Actual');
        $this->db->where(array('Product_Id' => $this->Product_Id, 'Territory' => $this->Territory, 'Doctor_Id' => $Doctor_Id, 'month' => $this->nextMonth, 'Year' => $this->nextYear, 'DATE_FORMAT(created_at,"%Y-%m-%d")' => date('Y-m-d')));
        $query = $this->db->get();
        return $query->row();
    }

    function ActivityReportingExist($Doctor_Id = "") {
        $this->db->select('*');
        $this->db->from('Activity_Reporting');
        $this->db->where(array('Product_Id' => $this->Product_Id, 'Territory' => $this->Territory, 'Doctor_Id' => $Doctor_Id, 'month' => $this->nextMonth, 'Year' => $this->nextYear));
        $query = $this->db->get();
        return $query->row();
    }

    function ActivityPlanned($Doctor_Id = "") {
        $this->db->select('*');
        $this->db->from('Activity_Planning');
        $this->db->where(array('Product_Id' => $this->Product_Id, 'Territory' => $this->Territory, 'Doctor_Id' => $Doctor_Id, 'month' => $this->nextMonth, 'Year' => $this->nextYear));
        $query = $this->db->get();
        return $query->row();
    }

    function SaveReporting($data = array()) {
        $this->db->insert('Rx_Actual', $data);
        //echo $this->db->last_query();
        return $this->db->insert_id();
    }

    function Update_mobile($Territory, $data) {
        $this->db->where(array('Territory' => $Territory));
        return $this->db->update($this->table_name, $data);
    }

    function Update_password($Territory, $data) {
        $this->db->where(array('Territory' => $Territory));
        return $this->db->update($this->table_name, $data);
    }

    public function All_data($Territory) {
        $sql = "SELECT em.`Full_Name`,em.`Mobile`,em.`password`,em.`Territory`,em.`DOB`,em.`Date_of_Joining`,(em2.`Reporting_To`) AS ZSM,(em.`Reporting_To`) AS ASM  FROM `Employee_Master`em
                INNER JOIN `Employee_Master`em2
                ON em.`Reporting_VEEVA_ID`= em2.`Territory`
                WHERE em.`Territory`='$Territory'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    function check_planning($Territory, $Product_Id, $nextMonth, $nextYear) {
        $sql = "SELECT * FROM `Rx_Planning`
                WHERE `Territory`='$Territory' AND `Product_Id`= $Product_Id AND month=$nextMonth AND Year=$nextYear AND Planning_Status = 'Draft' ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function priority_check($Territory, $Product_Id, $nextMonth) {
        $sql = "SELECT * FROM `Actual_Doctor_Priority`
                WHERE `Territory`='$Territory' AND `Product_Id`= $Product_Id AND month=$nextMonth AND Year='$this->nextYear' ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function Activity_reporting_check($Territory, $Product_Id, $Status) {
        $sql = "SELECT * FROM `Activity_Planning`
                WHERE `Territory`='$Territory' AND Status= '$Status' AND `Product_Id`=$Product_Id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function bdm_doctor_rx($Territory, $month, $year) {
        $sql = "SELECT (dm.`Account_Name`) AS doctor_name,dm.`Account_ID`,COUNT(ra.`Actual_Rx`) AS Rx_Actual,COUNT(rp.`Planned_Rx`) AS rx_planned FROM `Employee_Master` em
                LEFT JOIN `Employee_Doc` ed
                ON em.`Territory`=ed.`Territory`
                INNER JOIN `Doctor_Master`dm
                ON ed.`VEEVA_Account_ID`=dm.`Account_ID`
                LEFT JOIN Rx_Actual ra
                ON dm.`Account_ID`=ra.`Doctor_Id` AND ra.`month`=$month AND ra.`Year`=$year
                LEFT JOIN `Rx_Planning` rp
                ON dm.`Account_ID`=rp.`Doctor_Id` AND rp.`month`=$month AND rp.`Year`=$year
                WHERE em.`Territory`='$Territory'
                GROUP BY dm.`Account_ID`";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function ASM_kp1($Territory, $month, $year, $product_id) {
        $sql = "SELECT SUM(ra.`Actual_Rx`) as Actual,SUM(rp.`target`) as Planned FROM `Employee_Master` em 
                LEFT JOIN `Rx_Actual` ra 
                ON em.`Territory`=ra.`Territory` AND ra.`month`=$month AND ra.`Year`=$year AND ra.`Product_Id`=$product_id
                LEFT JOIN `Rx_Target` rp 
                ON em.`Territory` = rp.`Territory` AND rp.`month`=$month AND rp.`Year`=$year AND rp.`Product_Id`=$product_id
                WHERE `Reporting_VEEVA_ID`='$Territory'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    ///Not Territory SPecific
    function ASM_division($VEEVA_Employee_ID) {
        $sql = "SELECT em.`Division` as division FROM `Employee_Master` em
                WHERE em.`VEEVA_Employee_ID`='$VEEVA_Employee_ID'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    function report($Territory, $month, $year, $product) {
        $sql = "SELECT em.`Full_Name`,em.Territory,em.VEEVA_Employee_ID,COUNT(ed.`VEEVA_Account_ID`) AS No_of_Doctors ,COUNT(p.`Doctor_Id`)AS No_of_Doctors_profiled,rt.`target` AS Target_New_Rxn_for_the_month,SUM(rp.`Planned_Rx`) AS Planned_New_Rxn,COUNT(ap.`Act_Plan`) AS No_of_Doctors_planned,COUNT(CASE WHEN ar.`Activity_Done`='Yes' THEN 1 END) AS checkk FROM Employee_Master em
                LEFT JOIN Employee_Doc ed 
                ON em.`Territory`=ed.`Territory`
                LEFT JOIN Doctor_Master dm 
                ON dm.`Account_ID` = ed.`VEEVA_Account_ID` AND dm.Individual_Type = '$this->Individual_Type'
                LEFT JOIN Profiling p
                ON ed.`VEEVA_Account_ID`=p.`Doctor_Id` AND p.`Product_id`= $product AND p.Status = 'Submitted'
                LEFT JOIN Rx_Target rt
                ON em.`Territory`=rt.`Territory`AND rt.`Status`='Submitted' AND rt.`Product_Id`=$product AND rt.`Month`=$month AND rt.`Year`=$year
                LEFT JOIN Rx_Planning rp
                ON ed.`VEEVA_Account_ID`=rp.`Doctor_Id`AND rp.`Product_Id`=$product AND rp.`Month`=$month AND rp.`Year`=$year AND rp.Territory = em.Territory
                LEFT JOIN Activity_Planning ap
                ON ed.`VEEVA_Account_ID`=ap.`Doctor_Id` AND ap.`Product_Id`=$product AND ap.`Month`=$month AND ap.`Year`=$year AND em.`Territory` = ap.`Territory` 
                LEFT JOIN Activity_Reporting ar
                ON ed.`VEEVA_Account_ID`=ar.`Doctor_Id` AND ar.`Product_Id`=$product AND ar.`Month`=$month AND ar.`Year`=$year AND em.`Territory` = ar.`Territory` 
                WHERE em.Reporting_VEEVA_ID='$Territory'
                GROUP BY em.`Territory`";
        $query = $this->db->query($sql);
        //echo $sql;
        return $query->result();
    }

    function getReporting2($Territory, $Product_id = 0, $month = 0, $Year = '2016', $where = 'false', $doctor_ids = array()) {
        $sql = "SELECT 
                  `dm`.*,
                  GROUP_CONCAT(`act`.`Rxplan_id`) AS Rxplan_id,
                  SUM(act.Actual_Rx) AS Actual_Rx 
                FROM
                  (`Employee_Doc` ed) 
                  JOIN `Doctor_Master` dm 
                    ON `dm`.`Account_ID` = `ed`.`VEEVA_Account_ID` 
                  LEFT JOIN `Rx_Actual` act 
                    ON `dm`.`Account_ID` = `act`.`Doctor_Id` 
                    AND act.Product_Id = {$Product_id} 
                    AND act.Year = '$Year' 
                    AND act.month = '$month'
                    AND act.Territory = '$Territory' 
                WHERE `ed`.`Territory` = '$Territory' 
                  
                GROUP BY `dm`.`Account_ID` ";

        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        return $query->result();
    }

    public function check_email($id) {
        $this->db->select('*');
        $this->db->from('Employee_Master');
        $this->db->where(array('Territory' => $id));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function Reset_pass($id, $data) {
        $this->db->where(array('VEEVA_Employee_ID' => $id));
        $this->db->update('Employee_Master', $data);
        return $query;
    }

    //Not Territory Specific
    public function lastFailedAttempt($VEEVA_Employee_ID) {
        $sql = "SELECT * FROM password_count WHERE VEEVA_Employee_ID = '$VEEVA_Employee_ID' ORDER BY created_at DESC LIMIT 1 ";
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function check_history($id, $pass) {
        $sql = "select * from Password_History where VEEVA_Employee_ID='$VEEVA_Employee_ID' AND password='$pass'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function insert_pass($data) {
        return $this->db->insert('Password_History', $data);
    }

    public function getComment($Territory, $Comment_Type, $Product_Id) {
        $this->db->select('*');
        $this->db->from('Asm_Comment');
        $this->db->where(array('Territory' => $Territory, 'Comment_Type' => $Comment_Type, 'Product_Id' => $Product_Id));
        $this->db->order_by('Com_id DESC LIMIT 1');
        $query = $this->db->get();
        return $query->row();
    }

    public function getTerritory($Territory_id) {
        $this->db->select('*');
        $this->db->from('Territory_master');
        $this->db->where(array('id' => $Territory_id));
        $query = $this->db->get();
        return $query->row();
    }

    ///Not Territory Specific
    public function ASM_comment($VEEVA_Employee_ID, $PRODUCT_ID) {
        $sql = "SELECT * FROM Asm_Comment
                WHERE
                `VEEVA_Employee_ID`='$VEEVA_Employee_ID' and `Product_Id`='$PRODUCT_ID' and `Comment_type`='Planning' or  `VEEVA_Employee_ID`='$VEEVA_Employee_ID' and `Product_Id`='$PRODUCT_ID' and `Comment_type`='Activity_Planning'";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        return $query->result();
    }

    public function ASM_comment_rep($Territory, $PRODUCT_ID) {
        $sql = "SELECT * FROM Asm_Comment
                WHERE
                `Territory`='$Territory' and `Product_Id`='$PRODUCT_ID' and  `Comment_type`='Activity_Reporting'";
        $query = $this->db->query($sql);

        return $query->result();
    }

}
