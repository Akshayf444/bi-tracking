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

    public function Set_Target_by_id($id, $pid, $month) {
        $sql = "select * from Rx_Target
               where VEEVA_Employee_ID='$id' And Product_Id='$pid' And Month=$month";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function Rx_Target_month($VEEVA_Employee_ID, $Product_Id, $month_start,$year) {
        $sql = "SELECT * FROM Rx_Target
                WHERE Month = $month_start
                AND `VEEVA_Employee_ID`='$VEEVA_Employee_ID' AND `Product_Id`=$Product_Id And Year=$year";
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
        $profileCount = $this->ProfilingCount($VEEVA_Employee_ID, $Product_id);


        if (isset($tabs['Tab1']) && $tabs['Tab1'] == 1) {
            $Tab1Location = "'" . site_url('User/Profiling') . "'";
        } elseif (isset($tabs['Tab1']) && $tabs['Tab1'] == 0) {
            $Tab1Location = '#';
        } else {
            $Tab1Location = '#';
        }

        if ($doctorCount["DoctorCount"] > 0) {
            $tab1Calc = ($profileCount["profile_count"] / $doctorCount["DoctorCount"]) * 100;
        } else {
            $tab1Calc = 0;
        }


        $HTML = '<div class="card">
                    <ul class="table-view">
                        <li class="table-view-cell" style="margin-bottom: -32px;">
                            <a class="navigate-right" style="    margin-bottom: -61px;margin-top: 11px;"  onclick="window.location = ' . $Tab1Location . '" >Doctor Profiling </a>
                            <div class="demo pull-right">
                            <input type="hidden" id="profile" value="' . $tab1Calc . '">
                                <input class="knob" id="1" style="display: none;" data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="">
                                <span style="    margin-left: 86px;position: absolute;margin-top: -85px;">' . $profileCount["profile_count"] . '/' . $doctorCount["DoctorCount"] . '</span>
                            </div>
                        </li>
                    </ul>
                    </div>';
        return $HTML;
    }

    public function Tab1($VEEVA_Employee_ID = 0, $Product_id = 0) {
        
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
        $this->db->select('*');
        $this->db->from('Actual_Doctor_Priority dp');
        $this->db->join('Doctor_Master dm', 'dp.Doctor_Id = dm.Account_ID');
        $this->db->where(array('dp.Product_Id' => $this->Product_Id, 'dp.VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'dp.month' => $this->nextMonth));
        $query = $this->db->get();
        return $query->result();
    }

    public function getPlannedActivityDoctor() {
        $this->db->select('*');
        $this->db->from('Activity_Planning dp');
        $this->db->join('Doctor_Master dm', 'dp.Doctor_Id = dm.Account_ID');
        $this->db->where(array('dp.Product_Id' => $this->Product_Id, 'dp.VEEVA_Employee_ID' => $this->VEEVA_Employee_ID));
        $query = $this->db->get();
        return $query->result();
    }

    function getPlanning($VEEVA_Employee_ID, $Product_id = 0, $month = 0, $Year = '2016', $where = 'false', $doctor_ids = array()) {
        $this->db->select('rxp.*,dm.*');
        $this->db->from('Employee_Master emp');
        $this->db->join('Employee_Doc ed', 'ed.Local_Employee_ID = emp.VEEVA_Employee_ID');
        $this->db->join('Doctor_Master dm', 'dm.Account_ID = ed.VEEVA_Account_ID');
        $this->db->join('Rx_Planning rxp', 'dm.Account_ID = rxp.Doctor_Id', 'LEFT');
        if ($where == 'true') {
            $this->db->where_in('rxp.Doctor_Id', $doctor_ids);
        }

        $this->db->where(array('rxp.Product_id' => $Product_id, 'emp.VEEVA_Employee_ID' => $VEEVA_Employee_ID, 'rxp.month' => $month, 'rxp.Year' => $Year));
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
                . " order by FIELD(rxp.Doctor_Id ," . $doctor_id . ")";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function generatePlanningTab($type = 'Planning', $priority = 'false', $doctor_ids = array()) {
        $result = $this->Rx_Target_month($this->VEEVA_Employee_ID, $this->Product_Id, $this->nextMonth);

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
            $html .= '<table class="table table-bordered">
                <tr>
                    <th>Doctor List</th>
                    <th>Winability</th>
                    <th>Dependency</th>
                    <th>BI Rx Share</th>
                    <th>' . date('M', strtotime('-3 month')) . ' Rx</th>
                    <th>' . date('M', strtotime('-2 month')) . ' Rx</th>
                    <th>' . date('M', strtotime('-1 month')) . ' Rx</th>
                    <th>Planned for Jan</th>
                    <th>Actual</th>
                </tr>';

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
                        $html .= '<tr>
                    <td><a ><input type="checkbox" name="priority[]" value="' . $doctor->Account_ID . '" >' . $doctor->Account_Name . '</a>';
                    } else {
                        $html .= '<tr>
                    <td><a >' . $doctor->Account_Name . '</a>';
                    }
                    $html .='<p>Speciality : ' . $doctor->Specialty . '</p></a></td>
                <td>' . $winability . '</td>
                <td><a class="control-item">' . $dependancy . '%</a></td>
                <td><a class="control-item">' . $BI_Share . '</a></td>
                <td><a class="control-item">' . $month1rx . '</a></td>
                <td><a class="control-item">' . $month2rx . '</a></td>
                <td> <a class="control-item">' . $month3rx . '</a></td>';
                    if ($type == 'Planning') {
                        $html .= '<td> <input name="value[]" class="val" type="text" value="' . $planned_rx . '"/><input type = "hidden" name = "doc_id[]" value = "' . $doctor->Account_ID . '"/></td>
                <td> <a class = "control-item"></a></td>
                </tr>';
                    } elseif ($type == 'Actual') {
                        $html .= '<td>' . $planned_rx . '<input type = "hidden" name = "doc_id[]" value = "' . $doctor->Account_ID . '"/></td>
                <td> <input name="value[]" type="text" value="' . $actual_rx . '"/></td>
                </tr>';
                    }
                }
            }
            $html.='</table>';
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
        $this->db->from('Rx_Planning');
        $this->db->where(array('Product_id' => $this->Product_Id, 'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'month' => $month));
        $query = $this->db->get();
        return $query->row();
    }

    function countPlannedRx($month = 0) {
        $this->db->select('SUM(Actual_Rx) AS Planned_Rx');
        $this->db->from('Rx_Planning');
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
                
            } elseif ($this->Product_Id == 2 || $this->Product_Id == 3 || $this->Product_Id == 4 || $this->Product_Id == 5) {
                if ($result->Win_Q1 == 'Yes' && $result->Win_Q2 == 'Yes' && $result->Win_Q3 == 'No') {
                    $winabilty = '<a class="control-item badge badge-positive">H</a>';
                } elseif ($result->Win_Q1 == 'No' && $result->Win_Q2 == 'Yes' && $result->Win_Q3 == 'No' || $result->Win_Q1 == 'Yes' && $result->Win_Q2 == 'No' && $result->Win_Q3 == 'No' || $result->Win_Q1 == 'Yes' && $result->Win_Q2 == 'No' && $result->Win_Q3 == 'Yes' || $result->Win_Q1 == 'Yes' && $result->Win_Q2 == 'Yes' && $result->Win_Q3 == 'Yes') {
                    $winabilty = '<a class="control-item badge badge-primary">M</a>';
                } elseif ($result->Win_Q1 == 'No' && $result->Win_Q2 == 'No' && $result->Win_Q3 == 'No' || $result->Win_Q1 == 'No' && $result->Win_Q2 == 'No' && $result->Win_Q3 == 'Yes' || $result->Win_Q1 == 'No' && $result->Win_Q2 == 'Yes' && $result->Win_Q3 == 'Yes') {
                    $winabilty = '<a class="control-item badge badge-negative">L</a>';
                }
            }
        }
        return $winabilty;
    }

    function PriorityIds() {
        $doctors = array();
        $sql = "SELECT `Doctor_Id` FROM `Doctor_Priority` WHERE `Delta` >= 20
                AND VEEVA_Employee_Id = '$this->VEEVA_Employee_ID' and Product_Id = '$this->Product_Id'  AND month = '$this->nextMonth'          ";
        $query = $this->db->query($sql);
        $result = $query->result();
        if (!empty($result)) {
            foreach ($result as $value) {
                array_push($doctors, $value->Doctor_Id);
            }
        }

        $sql = "SELECT `Doctor_Id` FROM `Doctor_Priority` WHERE `Dependancy` >= 20
                AND VEEVA_Employee_Id = '$this->VEEVA_Employee_ID' and Product_Id = '$this->Product_Id'                ";
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

        return $doctors2;
    }

    function getActivityList() {
        $this->db->select('*');
        $this->db->from('Activity_Master');
        $this->db->where(array('Product_id' => $this->Product_Id));
        $query = $this->db->get();
        return $query->result();
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
                $html .= '<p><input name="activity[]" value="' . $item->Activity_id . '" type="checkbox" />   ' . $item->Activity_Name . '</p>';
            }
        }
        return $html;
    }

    function PlanningExist() {
        $this->db->select('*');
        $this->db->from('Rx_Planning');
        $this->db->where(array('Product_Id' => $this->Product_Id, 'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID));
        $query = $this->db->get();
        return $query->result();
    }

}
