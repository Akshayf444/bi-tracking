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
        $this->db->join('Rx_Target rt', 'em.VEEVA_Employee_ID = rt.VEEVA_Employee_ID AND rt.month =  ' . $this->nextMonth . 'AND rt.Year = "' . $this->nextYear . '"', 'left');
        $this->db->where(array('rt.Product_Id' => $this->Product_Id, 'Reporting_VEEVA_ID' => $this->VEEVA_Employee_ID));
        $query = $this->db->get();
        echo $this->db->last_query();
        return $query->result();
    }

    public function report_rx($id, $product_id) {
        $sql = "SELECT `dm`.*,rt.Rxplan_id,rt.Approve_Status,SUM(rt.Actual_Rx) as Actual_Rx FROM (`Employee_Doc` ed) 
            INNER JOIN Doctor_Master dm ON ed.VEEVA_Account_ID = dm.Account_ID
            LEFT JOIN `Rx_Actual` rt ON `dm`.`Account_ID` = `rt`.`Doctor_Id` AND `rt`.`VEEVA_Employee_ID` = '$id' AND `rt`.`month` = '$this->nextMonth'  AND `rt`.`Year` = '$this->nextYear' AND `rt`.`Product_Id` = '$product_id' "
                . " WHERE   rt.Approve_Status = 'SFA'  OR rt.Approve_Status = 'Un-Approved' GROUP BY rt.Doctor_Id  ORDER BY Actual_Rx DESC";
        $query = $this->db->query($sql);
        echo $sql;
        return $query->result();
    }

    public function approveReporting($VEEVA_Employee_ID, $Product_Id) {
        $this->db->select('*');
        $this->db->from('Employee_Doc ed');
        $this->db->join('Doctor_Master dm', 'ed.VEEVA_Account_ID = dm.Account_ID');
        $this->db->join('Rx_Actual er', '`dm`.`Account_ID` = `rt`.`Doctor_Id` AND `rt`.`VEEVA_Employee_ID` = "' . $VEEVA_Employee_ID . '" AND `rt`.`month` = "' . $this->nextMonth . '"  AND `rt`.`Year` = "' . $this->nextYear . '"');
        $this->db->where('Rx_Actual er', '`dm`.`Account_ID` = `rt`.`Doctor_Id` AND `rt`.`VEEVA_Employee_ID` = "' . $VEEVA_Employee_ID . '" AND `rt`.`month` = "' . $this->nextMonth . '"  AND `rt`.`Year` = "' . $this->nextYear . '"');
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

    public function status_change($VEEVA_Employee_ID) {
        $query = $this->db->where('Act_Plan', $id);
        $query = $this->db->update('Employee_Master', $data);
        return $query;
    }

    public function ASm($VEEVA_Employee_ID) {
        $sql = "SELECT em.`Full_Name`,em.`VEEVA_Employee_ID`FROM `Employee_Master` em
            WHERE `Reporting_VEEVA_ID`= '$VEEVA_Employee_ID'";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function ASM_Assign_Target($VEEVA_Employee_ID, $product1, $product2, $product3) {
        $sql = " (SELECT 
                        em.`Full_Name`,
                        em.`VEEVA_Employee_ID`,
                        rt.`target`,
                        `Product_Id` 
                      FROM
                        `Employee_Master` em 
                        LEFT JOIN `Rx_Target` rt 
                          ON em.`VEEVA_Employee_ID` = rt.`VEEVA_Employee_ID` 
                          AND `Product_id` = $product1 
                          AND MONTH = {$this->nextMonth} 
                          AND YEAR = '$this->nextYear' 
                      WHERE em.`VEEVA_Employee_ID` = '$VEEVA_Employee_ID' 
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
                          AND MONTH = {$this->nextMonth} 
                          AND YEAR = '$this->nextYear' 
                      WHERE em.`VEEVA_Employee_ID` = '$VEEVA_Employee_ID' 
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
                            AND MONTH = {$this->nextMonth} 
                          AND YEAR = '$this->nextYear' 

                      WHERE em.`VEEVA_Employee_ID` = '$VEEVA_Employee_ID' 
                      GROUP BY em.`VEEVA_Employee_ID`)";

        $query = $this->db->query($sql);
        //echo $this->db->last_query() . "<br/>";
        return $query->result();
    }

    function PlanningStatus($Product_Id) {
        $sql = "SELECT 
                em.`Full_Name`,
                em.`VEEVA_Employee_ID`,
                COUNT(
                  CASE
                    WHEN rp.`Planning_Status` = 'Submitted' 
                    THEN 1 
                  END
                ) AS SubmitCount,
                COUNT(
                  CASE
                    WHEN rp.`Approve_Status` = 'Approved' 
                    THEN 1 
                  END
                ) AS ApproveCount,
                COUNT(
                  CASE
                    WHEN rp.`Approve_Status` = 'Un-Approved' 
                    THEN 1 
                  END
                ) AS UnApproveCount,
                COUNT(
                  CASE
                    WHEN rp.`Approve_Status` = 'SFA' 
                    THEN 1 
                  END
                ) AS SFACount 
              FROM
                `Employee_Master` em 
                INNER JOIN Employee_Doc ed
                   ON ed.`VEEVA_Employee_ID` = em.`VEEVA_Employee_ID`
                LEFT JOIN `Rx_Planning` rp 
                  ON rp.`Doctor_Id` = ed.`VEEVA_Account_ID` 
                  AND rp.`month` = {$this->nextMonth} 
                  AND Product_Id = {$Product_Id} 
                  AND YEAR = '$this->nextYear' 
                  AND em.`VEEVA_Employee_ID` = rp.`VEEVA_Employee_ID`    
              WHERE `Reporting_VEEVA_ID` = '$this->VEEVA_Employee_ID' 
              GROUP BY em.`VEEVA_Employee_ID` ";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        return $query->result();
    }

    function ActivityPlanningStatus($Product_Id) {
        $sql = "SELECT 
                em.`Full_Name`,
                em.`VEEVA_Employee_ID`,
                COUNT(
                  CASE
                    WHEN rp.`Status` = 'Submitted' 
                    THEN 1 
                  END
                ) AS SubmitCount,
                COUNT(
                  CASE
                    WHEN rp.`Approve_Status` = 'Approved' 
                    THEN 1 
                  END
                ) AS ApproveCount,
                COUNT(
                  CASE
                    WHEN rp.`Approve_Status` = 'Un-Approved' 
                    THEN 1 
                  END
                ) AS UnApproveCount,
                COUNT(
                  CASE
                    WHEN rp.`Approve_Status` = 'SFA' 
                    THEN 1 
                  END
                ) AS SFACount 
              FROM
                `Employee_Master` em 
                INNER JOIN Employee_Doc ed
                   ON ed.`VEEVA_Employee_ID` = em.`VEEVA_Employee_ID`
                LEFT JOIN `Activity_Planning` rp 
                  ON rp.`Doctor_Id` = ed.`VEEVA_Account_ID` 
                  AND rp.`month` = {$this->nextMonth} 
                  AND Product_Id = {$Product_Id} 
                  AND YEAR = '$this->nextYear' 
                   AND em.`VEEVA_Employee_ID` = rp.`VEEVA_Employee_ID`    
              WHERE `Reporting_VEEVA_ID` = '$this->VEEVA_Employee_ID' 
              GROUP BY em.`VEEVA_Employee_ID` ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function ActivityReportingStatus($Product_Id) {
        $sql = "SELECT 
                em.`Full_Name`,
                em.`VEEVA_Employee_ID`,
                COUNT(
                  CASE
                    WHEN rp.`Status` = 'Submitted' 
                    THEN 1 
                  END
                ) AS SubmitCount,
                COUNT(
                  CASE
                    WHEN rp.`Approve_Status` = 'Approved' 
                    THEN 1 
                  END
                ) AS ApproveCount,
                COUNT(
                  CASE
                    WHEN rp.`Approve_Status` = 'Un-Approved' 
                    THEN 1 
                  END
                ) AS UnApproveCount,
                COUNT(
                  CASE
                    WHEN rp.`Approve_Status` = 'SFA' 
                    THEN 1 
                  END
                ) AS SFACount 
              FROM
                `Employee_Master` em 
                INNER JOIN Employee_Doc ed
                   ON ed.`VEEVA_Employee_ID` = em.`VEEVA_Employee_ID`
                LEFT JOIN `Activity_Reporting` rp 
                  ON rp.`Doctor_Id` = ed.`VEEVA_Account_ID` 
                  AND rp.`month` = {$this->nextMonth} 
                  AND Product_Id = {$Product_Id} 
                  AND YEAR = '$this->nextYear' 
                   AND em.`VEEVA_Employee_ID` = rp.`VEEVA_Employee_ID`    
                WHERE `Reporting_VEEVA_ID` = '$this->VEEVA_Employee_ID' 
              GROUP BY em.`VEEVA_Employee_ID` ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function RxReportingStatus($Product_Id, $VEEVA_Employee_Id) {
        $sql = "SELECT 
                COUNT(
                  CASE
                    WHEN rp.`Status` = 'Submitted' 
                    THEN 1 
                  END
                ) AS SubmitCount,
                COUNT(
                  CASE
                    WHEN rp.`Approve_Status` = 'Approved' 
                    THEN 1 
                  END
                ) AS ApproveCount,
                COUNT(
                  CASE
                    WHEN rp.`Approve_Status` = 'Un-Approved' 
                    THEN 1 
                  END
                ) AS UnApproveCount,
                COUNT(
                  CASE
                    WHEN rp.`Approve_Status` = 'SFA' 
                    THEN 1 
                  END
                ) AS SFACount 
              FROM
                `Rx_Actual` rp 
                WHERE  rp.`VEEVA_Employee_ID` = '$VEEVA_Employee_Id'
                  AND rp.`month` = {$this->nextMonth} 
                  AND Product_Id = {$Product_Id}                                     
                  AND YEAR = '$this->nextYear' 
             ";
        $query = $this->db->query($sql);
        //echo $sql.'<br/>';
        return $query->result();
    }

    function insertComment($data) {
        $this->db->insert('Asm_Comment', $data);
    }

    function PlanningStatusAll($Product_Id) {
        $sql = "SELECT 
                em.`Full_Name`,
                em.`VEEVA_Employee_ID`,
                COUNT(
                  CASE
                    WHEN rp.`Planning_Status` = 'Submitted' 
                    THEN 1 
                  END
                ) AS SubmitCount,
                COUNT(
                  CASE
                    WHEN rp.`Approve_Status` = 'Approved' 
                    THEN 1 
                  END
                ) AS ApproveCount,
                COUNT(
                  CASE
                    WHEN rp.`Approve_Status` = 'Un-Approved' 
                    THEN 1 
                  END
                ) AS UnApproveCount,
                COUNT(
                  CASE
                    WHEN rp.`Approve_Status` = 'SFA' 
                    THEN 1 
                  END
                ) AS SFACount 
              FROM
                `Employee_Master` em 
                INNER JOIN Employee_Doc ed
                   ON ed.`VEEVA_Employee_ID` = em.`VEEVA_Employee_ID`
                LEFT JOIN `Rx_Planning` rp 
                  ON rp.`Doctor_Id` = ed.`VEEVA_Account_ID` 
                  AND rp.`month` = 2 
                  AND Product_Id = {$Product_Id} 
                  AND YEAR = '2016' 
                  AND em.`VEEVA_Employee_ID` = rp.`VEEVA_Employee_ID`    

              GROUP BY em.`VEEVA_Employee_ID` ";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        return $query->result();
    }

}
