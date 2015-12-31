<?php

class Doctor_Model extends MY_model {

    public function __construct() {
        parent::__construct();
    }

    public function getDoctor($VEEVA_Employee_ID = 0) {
        $this->db->select('*');
        $this->db->from('Employee_Doc ed');
        $this->db->join('Employee_Master e', 'e.VEEVA_Employee_ID = ed.Local_Employee_ID');
        $this->db->where('e.VEEVA_Employee_ID', $VEEVA_Employee_ID);
        $query = $this->db->get();
        return $query->result();
    }

}
