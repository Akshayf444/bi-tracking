<?php

class Doctor_Model extends MY_model {

    public function __construct() {
        parent::__construct();
    }

    public function getDoctor($VEEVA_Employee_ID = 0, $type) {
        $this->db->select('dm.*');
        $this->db->from('Doctor_Master dm');
        $this->db->join('Employee_Doc ed', 'ed.VEEVA_Account_ID = dm.Account_ID');
        $this->db->where(array('ed.VEEVA_Employee_ID' => $VEEVA_Employee_ID, 'dm.Individual_Type' => $type));
        $this->db->group_by("dm.Account_Name");
        $query = $this->db->get();
        return $query->result();
    }

    public function getProfilingDoctor($type) {
        $this->db->select('dm.*');
        $this->db->from('Doctor_Master dm');
        $this->db->join('Employee_Doc ed', 'ed.VEEVA_Account_ID = dm.Account_ID');
        $this->db->join('Profiling pf', 'ed.VEEVA_Account_ID = pf.Doctor_Id AND pf.Product_id =  ' . $this->Product_Id, 'LEFT');
        $this->db->where(array('ed.VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'dm.Individual_Type' => $type, 'pf.Doctor_id' => NULL));
        $this->db->group_by("dm.Account_Name");
        $query = $this->db->get();
       // echo $this->db->last_query();
        return $query->result();
    }

    public function CountDoctor($VEEVA_Employee_ID = 0, $type) {
        $this->db->select('COUNT(DISTINCT(dm.Account_ID)) AS DoctorCount');
        $this->db->from('Doctor_Master dm');
        $this->db->join('Employee_Doc ed', 'ed.VEEVA_Account_ID = dm.Account_ID');
        $this->db->where(array('ed.VEEVA_Employee_ID' => $VEEVA_Employee_ID, 'dm.Individual_Type' => $type));
        $query = $this->db->get();
        
        return $query->row_array();
    }
    
    public function generateDoctorId($result){
        $doctors = array();
        if (!empty($result)) {
            foreach ($result as $value) {
                array_push($doctors, "'" . $value->Account_ID . "'");
            }
        }
        
        return $doctors;
    }

}