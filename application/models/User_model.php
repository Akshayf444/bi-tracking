<?php

class User_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->table_name = 'Employee_Master';
    }

    public function authentication($username, $password) {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where(array('Username' => $username, 'Password' => $password, 'Status' => '1'));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function profiling_by_id($Doctor_id, $VEEVA_Employee_ID, $Product_id) {
        $this->db->select('*');
        $this->db->from('Profiling');
        $this->db->where(array('Doctor_id' => $Doctor_id, 'VEEVA_Employee_ID' => $VEEVA_Employee_ID, 'Product_id' => $Product_id));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function Set_Target($data) {
        return $this->db->insert('Rx_Target', $data);
    }

    public function Set_Target_update2($data) {
        $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_Id' => $this->Product_Id));
        return $this->db->update('Rx_Target', $data);
    }

    public function Set_Target_by_id($id, $pid, $month) {
        $sql = "select * from Rx_Target
               where VEEVA_Employee_ID='$id' And Product_Id='$pid' And Month=$month";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function Rx_Target_month($VEEVA_Employee_ID, $Product_Id, $month_start, $year) {
        $sql = "SELECT * FROM Rx_Target
                WHERE Month = $month_start
                AND `VEEVA_Employee_ID`='$VEEVA_Employee_ID' AND `Product_Id`=$Product_Id And Year=$year";
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function Actual_Rx_Target_month($VEEVA_Employee_ID, $Product_Id, $month, $year) {
        $sql = "SELECT SUM(Actual_Rx) as Act FROM Rx_Actual
                WHERE month=$month
                AND `VEEVA_Employee_ID`='$VEEVA_Employee_ID' AND `Product_Id`=$Product_Id  And Year=$year";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function Rx_Target_month2($VEEVA_Employee_ID, $Product_Id, $month_start) {
        $sql = "SELECT * FROM Rx_Target
                WHERE Month = $month_start
                AND `VEEVA_Employee_ID`='$VEEVA_Employee_ID' AND `Product_Id`=$Product_Id";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function Expected_Rx($id, $pid, $month) {
        $this->db->select('target');
        $this->db->from(' Rx_Target');
        $this->db->where(array('month' => $month, 'VEEVA_Employee_ID' => $id, 'Product_Id' => $pid));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function Save_Planning($data) {
        return $this->db->insert('Rx_Planning', $data);
    }

    public function Save_Planning_prescription($data, $id, $doc_id, $pid, $month = 0, $year = 0) {
        $this->db->where(array('VEEVA_Employee_ID' => $id, 'Doctor_Id' => $doc_id, 'Product_Id' => $pid, 'month' => $month, 'Year' => $year));
        return $this->db->update('Rx_Planning', $data);
    }

    public function Set_Target_update($id, $data, $Pid) {
        $this->db->where(array('VEEVA_Employee_ID' => $id, 'Product_Id' => $Pid));
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

    public function generateTabs($VEEVA_Employee_ID = 0, $Product_id = 0) {
        $tabs = $this->Tabs($VEEVA_Employee_ID);
        $this->load->model('Doctor_Model');
        $doctorCount = $this->Doctor_Model->CountDoctor($VEEVA_Employee_ID, $this->Individual_Type);
        $profileCount = $this->ProfilingCount($VEEVA_Employee_ID, $this->Product_Id);
        $rxlabel = $this->Product_Id == 1 ? 'Vials' : 'Rx';
        $hospital = $this->Product_Id == 1 ? 'Hospital' : 'Doctor';

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

        $activity_planned = $this->activity_planned($this->VEEVA_Employee_ID, $this->Product_Id);
        $prio_dr = $this->prio_dr($this->VEEVA_Employee_ID, $this->Product_Id);
        $target = isset($data['show4']['target']) ? $data['show4']['target'] : 0;
        $Planned = isset($data['Planned']['Planned_Rx']) ? $data['Planned']['Planned_Rx'] : 0;
        $Actual = isset($data['Actual']['Actual_Rx']) ? $data['Actual']['Actual_Rx'] : 0;

        $HTML = '<div class="card">
                    <ul class="table-view">
                        <li class="table-view-cell" style="margin-bottom: -32px;">
                            <a class="navigate-right" style="    margin-bottom: -61px;margin-top: 11px;"  onclick="window.location = ' . $Tab1Location . '" >' . $hospital . ' Profiling </a>
                            <div class="demo pull-right">
                            <input type="hidden" id="profile" value="' . $tab1Calc . '">
                                <input class="knob" id="1" style="display: none;" data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="">
                                <span style="margin-left: 100px;position: absolute;margin-top: -46px;">' . $profileCount["profile_count"] . '/' . $doctorCount["DoctorCount"] . '</span>
                            </div>
                        </li>
                    </ul>
                    </div>';
        $HTML .='<div class="card">
                    <ul class="table-view">
                        <li class="table-view-cell" style="margin-bottom: 0px;height: 92px;">
                        <div style="margin-top: 17px;" class="">
                         <a class="navigate-right" style="    margin-bottom: -61px;margin-top: 11px;color: #333333;" onclick="window.location = ' . $Tab2Location . ';">
                            No Of New ' . $vials . ' Targeted For ' . date('M') . "&nbsp" . date('Y') . '
                        </a>
                                <span style="font-size: x-large;" class="pull-right"><b>' . $target . '</b></span>
                         </div>
                        </li>
                    </ul>
                </div>';

        $HTML .='<div class="card">
                    <ul class="table-view">
                        <li class="table-view-cell" style="    margin-bottom: -32px;height: 120px;">
                            <a class="navigate-right" style="    margin-bottom: -61px;margin-top: 11px;" onclick="window.location = ' . $Tab3Location . '">
                                Planning For The Month Of ' . date('M', strtotime($this->nextMonth)) . "&nbsp" . date('Y', strtotime($this->nextYear)) . ' </a>
                        </li>
                    </ul>
                </div>';

        $HTML .='<div class="card">
                    <ul class="table-view">
                        <li class="table-view-cell" style="    margin-bottom: -32px;">
                            <a class="navigate-right" style="    margin-bottom: -61px;margin-top: 11px;" onclick="window.location = ' . $Tab5Location . '" >
                                Reporting Of ' . $vials . '
                            </a>
                            <div class="demo pull-right">
                                <input class="knob" id="5" style="display: none;" data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="35">
                                <span style="margin-left: 100px;position: absolute;margin-top: -46px;">' . $Actual . '/' . $target . '</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <ul class="table-view">
                        <li class="table-view-cell" style="    margin-bottom: -32px;">
                            <a class="navigate-right" style="    margin-bottom: -61px;margin-top: 11px;" onclick="window.location = ' . $Tab4Location . '" >
                                Reporting For Activities
                            </a>
                            <div class="demo pull-right">
                                <input class="knob" id="4" style="display: none;" data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="35">
                                <span style="margin-left: 100px;position: absolute;margin-top: -46px;">' . $activity_planned["activity_planned"] . '/' . $prio_dr["doctor_id"] . '</span>
                            </div>
                        </li>
                    </ul>
                </div>';
        return $HTML;
    }

    public function ProfilingCount($VEEVA_Employee_ID, $Product_id = 0) {
        $this->db->select('COUNT(pf.`VEEVA_Employee_ID`) AS profile_count,emp.`VEEVA_Employee_ID`');
        $this->db->from('Employee_Master emp');
        $this->db->join('Profiling pf', 'emp.VEEVA_Employee_ID = pf.VEEVA_Employee_ID', 'LEFT');
        $this->db->where(array('pf.Product_id' => $Product_id, 'emp.VEEVA_Employee_ID' => $VEEVA_Employee_ID));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getActivityDoctor() {
        $this->db->select('Distinct(dp.Doctor_Id) As Doctor_Id,dm.*,ap.*');
        $this->db->from('Actual_Doctor_Priority dp');
        $this->db->join('Doctor_Master dm', 'dp.Doctor_Id = dm.Account_ID');
        $this->db->join('Activity_Planning ap', 'ap.Doctor_Id = dm.Account_ID', 'left');
        if ($this->Product_Id == 4 || $this->Product_Id == 6) {
            $this->db->where(array('dp.Product_Id' => 4, 'dp.Product_Id' => 6, 'dp.VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'dp.month' => $this->nextMonth));
        } else {
            $this->db->where(array('dp.Product_Id' => $this->Product_Id, 'dp.VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'dp.month' => $this->nextMonth));
        }
        $this->db->group_by('dp.Doctor_Id');
        $query = $this->db->get();
//echo $this->db->last_query();
        return $query->result();
    }

    public function getPlannedActivityDoctor() {
        $this->db->select('*');
        $this->db->from('Actual_Doctor_Priority dp');
        $this->db->join('Doctor_Master dm', 'dp.Doctor_Id = dm.Account_ID');
        $this->db->join('Activity_Planning ap', 'ap.Doctor_Id = dm.Account_ID');
        $this->db->where(array('dp.Product_Id' => $this->Product_Id, 'dp.VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'dp.month' => $this->nextMonth));
        $this->db->group_by('dp.Doctor_Id');
        $query = $this->db->get();
//echo $this->db->last_query();
        return $query->result();
    }

    function getPlanning($VEEVA_Employee_ID, $Product_id = 0, $month = 0, $Year = '2016', $where = 'false', $doctor_ids = array()) {
        $this->db->select('rxp.*,dm.*,act.Actual_Rx');
        $this->db->from('Employee_Master emp');
        $this->db->join('Employee_Doc ed', 'ed.Local_Employee_ID = emp.VEEVA_Employee_ID');
        $this->db->join('Doctor_Master dm', 'dm.Account_ID = ed.VEEVA_Account_ID');
        $this->db->join('Rx_Planning rxp', 'dm.Account_ID = rxp.Doctor_Id', 'LEFT');
        $this->db->join('Rx_Actual act', 'dm.Account_ID = act.Doctor_Id', 'LEFT');
        if ($where == 'true') {
            $this->db->where_in('rxp.Doctor_Id', $doctor_ids);
        }

        $this->db->where(array('rxp.Product_id' => $Product_id, 'emp.VEEVA_Employee_ID' => $VEEVA_Employee_ID, 'rxp.month' => $month, 'rxp.Year' => $Year));
        $this->db->group_by('dm.Account_ID');
        $query = $this->db->get();

        return $query->result();
    }

    function getPlanning2($VEEVA_Employee_ID, $Product_id = 0, $month = 0, $Year = '2016', $where = 'false', $doctor_ids = array()) {

        $doctor_id = join(",", $doctor_ids);
        $sql = "SELECT rxp.*,dm.* FROM Employee_Master emp "
                . " INNER JOIN Employee_Doc ed ON ed.Local_Employee_ID = emp.VEEVA_Employee_ID "
                . " INNER JOIN Doctor_Master dm ON dm.Account_ID = ed.VEEVA_Account_ID "
                . " LEFT JOIN Rx_Planning rxp ON dm.Account_ID = rxp.Doctor_Id "
                . " WHERE rxp.Doctor_Id IN (" . $doctor_id . ") AND rxp.Product_id = '$Product_id' AND emp.VEEVA_Employee_ID = '$VEEVA_Employee_ID' AND rxp.month = '$month' AND rxp.Year = '$Year' "
                . " GROUP BY dm.Account_ID order by FIELD(rxp.Doctor_Id ," . $doctor_id . ")";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function generatePlanningTab($type = 'Planning', $priority = 'false', $doctor_ids = array()) {
        $result = $this->Rx_Target_month($this->VEEVA_Employee_ID, $this->Product_Id, $this->nextMonth, $this->nextYear);

        if (isset($result->target) && $result->target > 0) {
            if ($priority == 'true') {
                $result = $this->User_model->getPlanning2($this->VEEVA_Employee_ID, $this->Product_Id, $this->nextMonth, $this->nextYear, 'true', $doctor_ids);
            } else {
                $result = $this->User_model->getPlanning($this->VEEVA_Employee_ID, $this->Product_Id, $this->nextMonth, $this->nextYear);
            }
            if (empty($result)) {
                $this->load->model('Doctor_Model');
                $result = $this->Doctor_Model->getDoctor($this->VEEVA_Employee_ID, $this->Individual_Type);
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
                $html .= '<th>Winability</th><th>Dependency</th>
                            <th>BI Market Share</th>';
            }

            $html .= '<th>' . date('M', strtotime('-3 month')) . $vials . ' </th>
                            <th>' . date('M', strtotime('-2 month')) . $vials . '</th>
                            <th>' . date('M', strtotime('-1 month')) . $vials . '</th>
                            <th>New ' . $vials . ' Targeted For ' . date('M', strtotime($this->nextMonth)) . ' </th>';
            if ($type == 'Planning') {
                $html .= '</tr></thead><tbody>';
            } elseif ($type == 'Actual') {
                $html .= '<th>Actual</th></tr></thead><tbody>';
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
                    $getPlan = $this->getWinability($doctor->Account_ID);
                    $winability = $this->calcWinability($getPlan);

                    $month = date('n', strtotime('-3 month'));
                    $month1 = $this->getMonthwiseRx($doctor->Account_ID, $month);
                    $month = date('n', strtotime('-2 month'));
                    $month2 = $this->getMonthwiseRx($doctor->Account_ID, $month);
                    $month = date('n', strtotime('-1 month'));
                    $month3 = $this->getMonthwiseRx($doctor->Account_ID, $month);

                    $month1rx = isset($month1->Actual_Rx) ? $month1->Actual_Rx : 0;
                    $month2rx = isset($month2->Actual_Rx) ? $month2->Actual_Rx : 0;
                    $month3rx = isset($month3->Actual_Rx) ? $month3->Actual_Rx : 0;
                    if ($lastMonthRx->Actual_Rx > 0)
                        $dependancy = round(($month3rx / $lastMonthRx->Actual_Rx ) * 100, 0, PHP_ROUND_HALF_EVEN);
                    else {
                        $dependancy = 0;
                    }
                    if (isset($getPlan->Patient_Rxbed_In_Month) && $getPlan->Patient_Rxbed_In_Month > 0) {
                        $BI_Share = round(($month3rx / $getPlan->Patient_Rxbed_In_Month) * 100, 0, PHP_ROUND_HALF_EVEN);
                    } else {
                        $BI_Share = '';
                    }

                    if ($priority == 'true') {
                        $result = $this->User_model->PriorityExist($doctor->Account_ID);
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

                    $html .='<td>' . $month1rx . '</td>
                            <td>' . $month2rx . '</td>
                            <td>' . $month3rx . '</td>';
                    if ($type == 'Planning') {
                        $html .= '<td> <input name = "value[]" class = "val" type = "number" value = "' . $planned_rx . '"/><input type = "hidden" name = "doc_id[]" value = "' . $doctor->Account_ID . '"/></td>
                                </tr>';
                    } elseif ($type == 'Actual') {
                        $html .= '<td>' . $planned_rx . '<input type = "hidden" name = "doc_id[]" value = "' . $doctor->Account_ID . '"/></td>
                                <td> <input name = "value[]" type = "number" value = "' . $actual_rx . '"/></td>
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

    function getMonthwiseRx($Doctor_Id = 0, $month = 0) {
        $this->db->select('*');
        $this->db->from('Rx_Planning');
        $this->db->where(array('Doctor_id' => $Doctor_Id, 'Product_id' => $this->Product_Id, 'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'month' => $month));
        $query = $this->db->get();
        return $query->row();
    }

    function countLastMonthRx($month = 0) {
        $this->db->select('SUM(Actual_Rx) AS Actual_Rx');
        $this->db->from('Rx_Actual');
        $this->db->where(array('Product_id' => $this->Product_Id, 'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'month' => $month));
        $query = $this->db->get();
        return $query->row();
    }

    function countPlannedRx($month = 0) {
        $this->db->select('SUM(Actual_Rx) AS Planned_Rx');
        $this->db->from('Rx_Actual');
        $this->db->where(array('Product_id' => $this->Product_Id, 'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'month' => $month));
        $query = $this->db->get();
        return $query->row();
    }

    function getWinability($Doctor_Id = 0) {
        $this->db->select('*');
        $this->db->from('Profiling');
        $this->db->where(array('Doctor_id' => $Doctor_Id, 'Product_id' => $this->Product_Id, 'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID));
        $query = $this->db->get();
        return $query->row();
    }

    function calcWinability($result) {
        $winabilty = '';
        if (!empty($result)) {
            if ($this->Product_Id == 1) {
                if ($result->Win_Q1 == 'No') {
                    $winabilty = '<a class = "control-item badge badge-negative">L</a>';
                } elseif ($result->Win_Q1 == 'Yes') {
                    if ($result->Win_Q2 == 'No') {
                        $winabilty = '<a class = "control-item badge badge-primary">M</a>';
                    } elseif ($result->Win_Q2 == 'Yes' && $result->Win_Q3 == 'No') {
                        $winabilty = '<a class = "control-item badge badge-primary">M</a>';
                    } elseif ($result->Win_Q2 == 'Yes' && $result->Win_Q3 == 'Yes') {
                        $winabilty = '<a class = "control-item badge badge-positive">H</a>';
                    }
                }
            } elseif ($this->Product_Id == 2 || $this->Product_Id == 3 || $this->Product_Id == 4 || $this->Product_Id == 5) {
                if ($result->Win_Q1 == 'Yes' && $result->Win_Q2 == 'Yes' && $result->Win_Q3 == 'No') {
                    $winabilty = '<a class = "control-item badge badge-positive">H</a>';
                } elseif ($result->Win_Q1 == 'No' && $result->Win_Q2 == 'Yes' && $result->Win_Q3 == 'No' || $result->Win_Q1 == 'Yes' && $result->Win_Q2 == 'No' && $result->Win_Q3 == 'No' || $result->Win_Q1 == 'Yes' && $result->Win_Q2 == 'No' && $result->Win_Q3 == 'Yes' || $result->Win_Q1 == 'Yes' && $result->Win_Q2 == 'Yes' && $result->Win_Q3 == 'Yes') {
                    $winabilty = '<a class = "control-item badge badge-primary">M</a>';
                } elseif ($result->Win_Q1 == 'No' && $result->Win_Q2 == 'No' && $result->Win_Q3 == 'No' || $result->Win_Q1 == 'No' && $result->Win_Q2 == 'No' && $result->Win_Q3 == 'Yes' || $result->Win_Q1 == 'No' && $result->Win_Q2 == 'Yes' && $result->Win_Q3 == 'Yes') {
                    $winabilty = '<a class = "control-item badge badge-negative">L</a>';
                }
            }
        }
        return $winabilty;
    }

    function PriorityIds() {
        $doctors = array();
        $sql = "SELECT `Doctor_Id` FROM `Doctor_Priority` WHERE `Delta` >= 20
        AND VEEVA_Employee_Id = '$this->VEEVA_Employee_ID' and Product_Id = '$this->Product_Id'  AND month = '$this->nextMonth' ORDER BY Delta DESC ";

        $query = $this->db->query($sql);
        $result = $query->result();
        if (!empty($result)) {
            foreach ($result as $value) {
                array_push($doctors, $value->Doctor_Id);
            }
        }

        $sql = "SELECT `Doctor_Id` FROM `Doctor_Priority` WHERE `Dependancy` >= 20
                AND VEEVA_Employee_Id = '$this->VEEVA_Employee_ID' and Product_Id = '$this->Product_Id' ORDER BY Dependancy DESC  ";

        $query = $this->db->query($sql);
        $result = $query->result();
        if (!empty($result)) {
            foreach ($result as $value) {
                array_push($doctors, $value->Doctor_Id);
            }
        }
        $doctors = array_unique($doctors);
        $sql = "SELECT `Doctor_Id` FROM `Doctor_Priority` 
                WHERE VEEVA_Employee_Id = '$this->VEEVA_Employee_ID' and Product_Id = '$this->Product_Id'  ORDER BY `Planned_Rx` DESC                ";

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

        $doctors = array_unique($doctors);
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
        $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_Id' => $this->Product_Id, 'month' => $this->nextMonth));
        $query = $this->db->get();
        return $query->row_array();
    }

    function Actual_Rx_Count() {
        $this->db->select('SUM(`Actual_Rx`) AS Actual_Rx');
        $this->db->from('Rx_Actual');
        $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_Id' => $this->Product_Id, 'month' => $this->nextMonth));
        $query = $this->db->get();
        return $query->row_array();
    }

    function getPlannedActivityList($Doctor_Id) {
        $this->db->select('*');
        $this->db->from('Activity_Planning ap');
        $this->db->join('Activity_Master am', 'ap.Activity_Id = am.Activity_id');
        $this->db->where(array('ap.Product_id' => $this->Product_Id, 'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID));
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
        $this->db->where(array('Product_Id' => $this->Product_Id, 'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Doctor_Id' => $Doctor_Id, 'month' => $this->nextMonth, 'Year' => $this->nextYear));
        $query = $this->db->get();
        return $query->row();
    }

    function password($id, $data) {
        $this->db->where(array('VEEVA_Employee_ID' => $id));
        return $this->db->update('Employee_Master', $data);
    }

    function password_status($id) {
        $this->db->select('*');
        $this->db->from('Employee_Master');
        $this->db->where(array('VEEVA_Employee_ID' => $id));
        $query = $this->db->get();
        return $query->row_array();
    }

    function employee_id($id) {
        $this->db->select('VEEVA_Employee_ID');
        $this->db->from('Employee_Master');
        $this->db->where(array('Username' => $id));
        $query = $this->db->get();
        return $query->row_array();
    }

    function password_count($id) {
        $this->db->select('COUNT(VEEVA_Employee_ID) AS cnt');
        $this->db->from('password_count');
        $this->db->where(array('VEEVA_Employee_ID' => $id));
        $query = $this->db->get();
        return $query->row_array();
    }

    function password_save($data) {
        return $this->db->insert('password_count', $data);
    }

    function update_status($id, $data) {
        $this->db->where(array('Username' => $id));
        return $this->db->update('Employee_Master', $data);
    }

    function PriorityExist($Doctor_Id) {
        $this->db->select('*');
        $this->db->from('Doctor_Priority');
        $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_Id' => $this->Product_Id, 'Doctor_Id' => $Doctor_Id));
        $query = $this->db->get();
        return $query->row_array();
    }

    function ActualPriorityExist($Doctor_Id) {
        $this->db->select('*');
        $this->db->from('Actual_Doctor_Priority');
        $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_Id' => $this->Product_Id, 'Doctor_Id' => $Doctor_Id, 'month' => $this->nextMonth));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function product_detail($VEEVA_Employee_ID, $Product_id, $month, $year) {
        $this->db->select('SUM(`Actual_Rx`) as actual_rx');
        $this->db->from('`Rx_Actual`');
        $this->db->where(array('VEEVA_Employee_ID' => $VEEVA_Employee_ID, 'Product_id' => $Product_id, 'month' => $month, 'Year' => $year));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function kpi($VEEVA_Employee_ID, $Product_id, $month, $year) {
        $this->db->select('SUM(`Planned_Rx`) as planned_rx');
        $this->db->from('`Rx_Planning`');
        $this->db->where(array('VEEVA_Employee_ID' => $VEEVA_Employee_ID, 'Product_id' => $Product_id, 'month' => $month, 'Year' => $year));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function product_detail_user($VEEVA_Employee_ID, $Product_id, $month, $year) {
        $this->db->select('COUNT(`Doctor_Id`) AS doctor_count');
        $this->db->from('`Rx_Planning`');
        $this->db->where(array('VEEVA_Employee_ID' => $VEEVA_Employee_ID, 'Product_id' => $Product_id, 'month' => $month, 'Year' => $year));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function activity_planned($VEEVA_Employee_ID, $Product_id) {
        $this->db->select('COUNT(`Activity_Id`) AS activity_planned,Status');
        $this->db->from('`Activity_Planning`');
        $this->db->where(array('VEEVA_Employee_ID' => $VEEVA_Employee_ID, 'Product_id' => $Product_id));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function activity_actual($VEEVA_Employee_ID, $Product_id) {
        $this->db->select('COUNT(`Activity_Id`) AS activity_actual');
        $this->db->from('`Activity_Reporting`');
        $this->db->where(array('VEEVA_Employee_ID' => $VEEVA_Employee_ID, 'Product_id' => $Product_id));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function prio_dr($VEEVA_Employee_ID, $Product_id) {
        $this->db->select('COUNT(`Doctor_Id`) AS doctor_id');
        $this->db->from('`Actual_Doctor_Priority`');
        if ($this->Product_Id == 4 && $this->Product_Id == 6) {
            $this->db->where(array('VEEVA_Employee_ID' => $VEEVA_Employee_ID, 'Product_id' => 4, 'Product_Id' => 6));
        } else {
            $this->db->where(array('VEEVA_Employee_ID' => $VEEVA_Employee_ID, 'Product_id' => $Product_id));
        }

        $query = $this->db->get();
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
            foreach ($result as $value) {
                if (isset($value->Act_Plan) && !is_null($value->Act_Plan)) {
                    $ActivityList = $this->Master_Model->generateDropdown($Activities, 'Activity_id', 'Activity_Name', $value->Activity_Id);
                } else {
                    $ActivityList = $this->Master_Model->generateDropdown($Activities, 'Activity_id', 'Activity_Name');
                }

                $HTML .= '<tr><td>' . $value->Account_Name . '<input type="hidden" name="Doctor_Id[]" value="' . $value->Account_ID . '" ></td>';
                if ($type == 'Reporting') {
                    $HTML .= '<td><select class="form-control" readonly="readonly" name="Activity_Id[]"><option value="-1">Select Activity</option>' . $ActivityList . '</select></td>';
                    $HTML .='<td><div class="col-xs-8">
                        <div class="toggle">
                            <label><input type="radio" name="' . $value->Account_ID . '" value="Yes"><span id="' . $value->Account_ID . '-1 ">Yes</span></label>    
                        </div>
                        <div class="toggle">
                            <label><input type="radio" name="' . $value->Account_ID . '" value="No"><span id="' . $value->Account_ID . '-2 " >No</span></label>
                        </div>
                    </div>
                    <div id="heading' . $value->Account_ID . '" class="custom-collapse " style="display: none">
                        <div class="row row-margin-top">
                            <div class="col-xs-12 col-lg-12"><textarea class="form-control" name="' . $value->Account_ID . 'Detail" placeholder="Activity Details"></textarea> </div> 
                        </div> 
                    </div>
                    <div id="reason' . $value->Account_ID . '" class="custom-collapse " style="display: none">
                        <div class="row row-margin-top">
                            <div class="col-xs-12 col-lg-12"><textarea class="form-control" name="' . $value->Account_ID . 'Reason" placeholder="Reason"></textarea> </div> 
                        </div> 
                    </div></td>';
                } else {
                    $HTML .= '<td><select class="form-control" name="Activity_Id[]"><option value="-1">Select Activity</option>' . $ActivityList . '</select></td>';
                }

                $HTML .= '</tr>';
            }
            $HTML .= '</table>';
        }

        return $HTML;
    }

    function ReportingExist($Doctor_Id = "") {
        $this->db->select('*');
        $this->db->from('Rx_Actual');
        $this->db->where(array('Product_Id' => $this->Product_Id, 'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Doctor_Id' => $Doctor_Id, 'month' => $this->nextMonth, 'Year' => $this->nextYear));
        $query = $this->db->get();
        return $query->row();
    }

    function ActivityReportingExist($Doctor_Id = "") {
        $this->db->select('*');
        $this->db->from('Activity_Reporting');
        $this->db->where(array('Product_Id' => $this->Product_Id, 'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Doctor_Id' => $Doctor_Id, 'month' => $this->nextMonth, 'Year' => $this->nextYear));
        $query = $this->db->get();
        return $query->row();
    }

    function ActivityPlanned($Doctor_Id = "") {
        $this->db->select('*');
        $this->db->from('Activity_Planning');
        $this->db->where(array('Product_Id' => $this->Product_Id, 'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Doctor_Id' => $Doctor_Id, 'month' => $this->nextMonth, 'Year' => $this->nextYear));
        $query = $this->db->get();
        return $query->row();
    }

    function SaveReporting($data = array()) {
        $this->db->insert('Rx_Actual', $data);
        return $this->db->insert_id();
    }

}
