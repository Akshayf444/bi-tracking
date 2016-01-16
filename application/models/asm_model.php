<?php

class asm_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function rx_view($id) {
        $sql = " SELECT  * FROM Employee_Master WHERE Designation='BDM' AND `Reporting_VEEVA_ID`='$id'";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function product() {
        $sql = "SELECT  * FROM Brand_Master ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function planning_view($id, $product) {
        $sql = " 
                 SELECT Doctor_Master.`Account_Name`,Rx_Planning .* FROM  Doctor_Master  
                LEFT JOIN  Rx_Planning ON Doctor_Master.Account_ID= Rx_Planning.Doctor_Id
                 WHERE Rx_Planning.Product_Id='$product'
                  AND Rx_Planning.VEEVA_Employee_ID='$id' 
                  AND Rx_Planning.Planning_Status='submitted'
                  ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getTarget() {
        $this->db->select('*');
        $this->db->from('Employee_Master em');
        $this->db->join('Rx_Target rt', 'em.VEEVA_Employee_ID = rt.VEEVA_Employee_ID', 'left');
        $this->db->where(array('rt.Product_Id' => $this->Product_Id, 'Reporting_VEEVA_ID' => $this->VEEVA_Employee_ID, 'month' => $this->nextMonth, 'Year' => $this->nextYear));
        $query = $this->db->get();
        return $query->result();
    }

}
