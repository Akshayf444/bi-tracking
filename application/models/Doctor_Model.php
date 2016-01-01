<?php

class Doctor_Model extends MY_model {

    public function __construct() {
        parent::__construct();
    }

    public function getDoctor($VEEVA_Employee_ID = 0) {
        $this->db->select('dm.*');
        $this->db->from('Doctor_Master dm');
        $this->db->join('Employee_Doc ed', 'ed.VEEVA_Account_ID = dm.Account_ID');
        $this->db->where('ed.Local_Employee_ID', $VEEVA_Employee_ID);
        $query = $this->db->get();
        return $query->result();
    }

    public function CountDoctor($VEEVA_Employee_ID = 0) {
        $this->db->select('COUNT(dm.Account_ID) AS DoctorCount');
        $this->db->from('Doctor_Master dm');
        $this->db->join('Employee_Doc ed', 'ed.VEEVA_Account_ID = dm.Account_ID');
        $this->db->where('ed.Local_Employee_ID', $VEEVA_Employee_ID);
        $query = $this->db->get();
        return $query->row_array();
    }

}
