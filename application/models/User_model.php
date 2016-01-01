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

    public function validateLogin() {
        
    }

    public function Set_Target($data) {
        return $this->db->insert('Rx_Target', $data);
    }

    public function Set_Target_by_id($id, $pid) {
        $sql = "select * from Rx_Target
               where VEEVA_Employee_ID='$id' And Product_Id='$pid'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function Expected_Rx($id, $pid,$month) {
        $this->db->select('target');
        $this->db->from(' Rx_Target');
        $this->db->where(array('month' => $month,'VEEVA_Employee_ID'=>$id,'Product_Id'=>$pid));
        $query = $this->db->get();
        return $query->row_array();
    }
    public function Save_Planning($data) {
        return $this->db->insert('Rx_Planning',$data);
    }
    public function Save_Planning_prescription($data,$id,$doc_id,$pid) {
         $this->db->where(array('VEEVA_Employee_ID'=>$id,'Doctor_Id'=>$doc_id,'Product_Id'=>$pid));
         return $this->db->update('Rx_Planning',$data);
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
        $doctorCount = $this->Doctor_Model->CountDoctor($VEEVA_Employee_ID);
        $profileCount = $this->ProfilingCount($VEEVA_Employee_ID, $Product_id);
        $Tab1Location = '#';

        if ($tabs['Tab1'] == 1) {
            $Tab1Location = "'" . site_url('User/Profiling') . "'";
        }

        $tab1Calc = ($profileCount["profile_count"] / $doctorCount["DoctorCount"]) * 100;
        
        $HTML = '<div class="card">
                    <ul class="table-view">
                        <li class="table-view-cell">
                            <a class="navigate-right" style="    margin-bottom: -61px;margin-top: 11px;"  onclick="window.location = ' . $Tab1Location . '" >Doctor Profiling </a>
                            <div class="demo pull-right">
                            <input type="hidden" id="profile" value="'.$tab1Calc.'">
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

}
