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

    public function report_rx($id, $product_id) {
        $sql = "
     SELECT `dm`.*, `rt`.* FROM (`Doctor_Master` dm) 
LEFT JOIN `Rx_Actual` rt ON `dm`.`Account_ID` = `rt`.`Doctor_Id` WHERE `rt`.`Product_Id` = '$product_id' 
AND `rt`.`VEEVA_Employee_ID` = '$id' AND `rt`.`month` = '$this->nextMonth' AND `rt`.`Status` = 'Submitted' AND `rt`.`Year` = '$this->nextYear'";
     
        $query = $this->db->query($sql);
        return $query->result();
        ;
    }
  public function report_Activity($id, $product_id) {
        $sql = "
            SELECT `dm`.*, `ar`.*,am.*  FROM (`Doctor_Master` dm) 
LEFT JOIN `Activity_Reporting` ar ON `dm`.`Account_ID` = `ar`.`Doctor_Id` 
inner JOIN `Activity_Master` am ON `am`.`Activity_Id` = `ar`.`Activity_id`
WHERE `ar`.`Product_Id` = '$product_id' 
AND `ar`.`VEEVA_Employee_ID` = '$id' AND `ar`.`month` = '$this->nextMonth' AND `ar`.`Status` = 'Submitted' AND `ar`.`Year` = '$this->nextYear'";
    
        $query = $this->db->query($sql);
        return $query->result();
        ;
    }
    
}
