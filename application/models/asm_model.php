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
        $sql = "SELECT `dm`.*,rt.Rxplan_id,rt.Approve_Status,SUM(rt.Actual_Rx) as Actual_Rx FROM (`Employee_Doc` ed) 
            INNER JOIN Doctor_Master dm ON ed.VEEVA_Account_ID = dm.Account_ID
            LEFT JOIN `Rx_Actual` rt ON `dm`.`Account_ID` = `rt`.`Doctor_Id` AND `rt`.`VEEVA_Employee_ID` = '$id' AND `rt`.`month` = '$this->nextMonth'  AND `rt`.`Year` = '$this->nextYear' "
                . " WHERE `rt`.`Product_Id` = '$product_id' GROUP BY rt.Doctor_Id ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function report_Activity($id, $product_id) {
        $sql = "SELECT `dm`.*, `ar`.* FROM (`Employee_Doc` ed) 
            INNER JOIN Doctor_Master dm ON ed.VEEVA_Account_ID = dm.Account_ID
            LEFT JOIN `Activity_Reporting` ar ON `dm`.`Account_ID` = `ar`.`Doctor_Id` 
            WHERE `ar`.`Product_Id` = '$product_id' 
            AND `ar`.`VEEVA_Employee_ID` = '$id' AND `ar`.`month` = '$this->nextMonth' AND `ar`.`Status` = 'Submitted' AND `ar`.`Year` = '$this->nextYear'";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function status_change($id, $data) {
        $query = $this->db->where('Act_Plan', $id);
        $query = $this->db->update('Employee_Master', $data);
        return $query;
    }

    public function ASM_Assign_Target($VEEVA_Employee_ID,$product1, $product2, $product3) {
        $sql = "SELECT 
                t_union.`VEEVA_Employee_ID`,t_union.`Full_Name`,`Product_Id`,t_union.target 
                 FROM
                (  (SELECT 
                        em.`Full_Name`,
                        em.`VEEVA_Employee_ID`,
                        rt.`target`,
                        `Product_Id` 
                      FROM
                        `Employee_Master` em 
                        LEFT JOIN `Rx_Target` rt 
                          ON em.`VEEVA_Employee_ID` = rt.`VEEVA_Employee_ID` 
                          AND `Product_id` = $product1 
                          AND MONTH = 1 
                          AND YEAR = '2016' 
                      WHERE `Reporting_VEEVA_ID` = '$VEEVA_Employee_ID' 
                      GROUP BY em.`VEEVA_Employee_ID`) 
                      UNION
                      ALL 
                      (SELECT 
                        em.`Full_Name`,
                        em.`VEEVA_Employee_ID`,
                        rt.`target`,
                        `Product_Id` 
                      FROM
                        `Employee_Master` em 
                        LEFT JOIN `Rx_Target` rt 
                          ON em.`VEEVA_Employee_ID` = rt.`VEEVA_Employee_ID` 
                          AND `Product_id` = $product2 
                          AND MONTH = 1 
                          AND YEAR = '2016' 
                      WHERE `Reporting_VEEVA_ID` = '$VEEVA_Employee_ID' 
                      GROUP BY em.`VEEVA_Employee_ID`) 
                      UNION
                      ALL 
                      (SELECT 
                        em.`Full_Name`,
                        em.`VEEVA_Employee_ID`,
                        rt.`target`,
                        `Product_Id` 
                      FROM
                        `Employee_Master` em 
                        LEFT JOIN `Rx_Target` rt 
                          ON em.`VEEVA_Employee_ID` = rt.`VEEVA_Employee_ID` 
                          AND `Product_id` = $product3
                          AND MONTH = 1 
                          AND YEAR = '2016' 
                      WHERE `Reporting_VEEVA_ID` = '$VEEVA_Employee_ID' 
                      GROUP BY em.`VEEVA_Employee_ID`)    ) AS t_union 
ORDER BY t_union.VEEVA_Employee_ID ";
        $query = $this->db->query($sql);
        return $query->result();
    }

}
