<?php

class admin_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function login($email, $pass) {
        $query = $this->db->get_where('admin_master', array('email' => $email, 'password' => $pass,));
        return $query->row_array();
    }

    public function insert($data) {
        return $this->db->insert('Employee_Master', $data);
    }

    public function insert_territory($data) {
        return $this->db->insert('Territory_master', $data);
    }

    public function del_terr($id, $data) {
        $query = $this->db->where('id', $id);
        $query = $this->db->update('Territory_master', $data);
        return $query;
    }

    public function emp_view() {
        $sql = "select * from Employee_Master where status='1'";
        $query = $this->db->query($sql);

        return $query->result();
    }

    public function territory() {
        $sql = "select * from  Territory_master where status='1'";
        $query = $this->db->query($sql);

        return $query->result();
    }

    public function territory_view($name) {
        $sql = "select * from  Territory_master where territory='$name'and status='1'";
        $query = $this->db->query($sql);

        return $query->row_array();
    }

    public function find_by_terrid($id) {
        $sql = "select * from  Territory_master where id='$id'and status='1'";
        $query = $this->db->query($sql);

        return $query->row_array();
    }

    public function update_terr($id, $data) {
        $query = $this->db->where('id', $id);
        $query = $this->db->update('Territory_master', $data);
        return $query;
    }

    public function find_by_empid($id) {
        $sql = "select * from Employee_Master where VEEVA_Employee_ID='$id'  ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function find_zone() {
        $sql = "select distinct(Zone) as Zone from Employee_Master WHERE Zone IS NOT NULL AND Zone <> ''";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function find_Division() {
        $sql = "select distinct(Division) as Division from Employee_Master WHERE Division IS NOT NULL AND Division <> ''";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function find_profile() {
        $sql = "select distinct(Profile) as Profile from Employee_Master WHERE Profile IS NOT NULL AND Profile <> ''";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function reporting_to($profile) {
        $sql = "SELECT * FROM Employee_Master WHERE Profile='$profile' GROUP BY Reporting_VEEVA_ID ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function reporting_id($reporting_to) {
        $sql = "SELECT  * FROM Employee_Master WHERE Reporting_To ='$reporting_to'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function zone_data($zone) {
        $sql = "select * from Employee_Master WHERE Zone = '$zone'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function find_region() {
        $sql = "select distinct(Region) as Region from Employee_Master WHERE Region IS NOT NULL AND Region <> ''";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function find_Designation() {
        $sql = "select distinct(Designation) as Designation from Employee_Master WHERE Designation IS NOT NULL AND Designation <> ''";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function find_territory() {
        $sql = "select distinct (Territory) AS Territory,id from Territory_master where status='1' AND Territory IS NOT NULL AND Territory <> ''";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function find_REPORTING_TO() {
        $sql = "select distinct (Reporting_To) AS  Reporting_To from Employee_Master";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function find_REPORTING_TO_VALUE($NAME) {
        $sql = "select * from Employee_Master WHERE Reporting_To=$NAME";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function update_emp($id, $data) {
        $query = $this->db->where('VEEVA_Employee_ID', $id);
        $query = $this->db->update('Employee_Master', $data);
        return $query;
    }

    public function del_emp($id, $data) {
        $query = $this->db->where('VEEVA_Employee_ID', $id);
        $query = $this->db->update('Employee_Master', $data);
        return $query;
    }

    public function asm() {
        $sql = "select * from asm";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function asm_by_id($id) {
        $sql = "select * from asm
             where asm_id=$id";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function asm_edit($id) {
        $sql = "select * from asm
                where asm_id=$id";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function zsm_edit($id) {
        $sql = "select * from zsm
                where zsm_id=$id";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function bdm_edit($id) {
        $sql = "select * from bdm
                where bdm_id=$id";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function zsm() {
        $sql = "select * from zsm";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function bdm() {
        $sql = "select * from bdm";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function insert_activity($data) {
        return $this->db->insert('Activity_Master', $data);
    }

    public function view_activity() {

        $sql = "SELECT Brand_Master.id, Brand_Master.Brand_Name,Activity_Master.Activity_Name,Activity_Master.Division,Activity_Master.Activity_id
 FROM Activity_Master LEFT JOIN  Brand_Master  ON Brand_Master.id=Activity_Master.Product_ID  where Activity_Master.Status='1'
  ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function show_pro_list() {
        $sql = "select * from Brand_Master";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function del_act($id, $data) {
        $query = $this->db->where('Activity_id', $id);
        $query = $this->db->update('Activity_Master', $data);
        return $query;
    }

    public function find_by_activityid($id) {
        $sql = "select * from Activity_Master where Activity_id='$id'  ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function update_act($id, $data) {
        $query = $this->db->where('Activity_id', $id);
        $query = $this->db->update('Activity_Master', $data);
        return $query;
    }

    public function view_profile_controller() {
        $sql = "SELECT  Tab_Control.*,Employee_Master.Territory, Employee_Master.Zone,Employee_Master.Full_Name FROM Employee_Master Left Join Tab_Control on Employee_Master. VEEVA_Employee_ID=Tab_Control.VEEVA_Employee_ID GROUP BY Zone";
//        $sql = "select  Tab_Control.*, Employee_Master.Full_Name from Employee_Master left join Tab_Control on Employee_Master. VEEVA_Employee_ID=Tab_Control.VEEVA_Employee_ID ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function update_profile($id, $data) {
        $query = $this->db->where('VEEVA_Employee_ID', $id);
        $query = $this->db->update('Tab_Control', $data);
        return $query;
    }

    public function lock() {
        $sql = "UPDATE `Tab_Control` SET `Tab1`='0',`Tab2`='0',`Tab3`='0',`Tab4`='0',`Tab5`='0'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function unlock() {
        $sql = "UPDATE `Tab_Control` SET `Tab1`='1',`Tab2`='1',`Tab3`='1',`Tab4`='1',`Tab5`='1'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function active_profile($id, $data) {
        $query = $this->db->where('VEEVA_Employee_ID', $id);
        $query = $this->db->update('Tab_Control', $data);
        return $query;
    }

    public function doc_count() {
        $sql = "select count(Account_ID) as Account_Id from Doctor_Master ";
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function doc_view($limit, $offset) {
        $sql = "SELECT * FROM Doctor_Master  ";
        $sql .= "LIMIT $limit ";
        $sql .= "OFFSET $offset";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function insert_csv($data) {
        return $this->db->insert('Employee_Master', $data);
    }

    public function insert_csv_doc($data) {
        return $this->db->insert('Doctor_Master', $data);
    }

    public function emp_duplicate($id) {
        $sql = " select * from  Employee_Master WHERE VEEVA_Employee_ID='$id'";
    }

    public function dr_by_product($division) {
        $sql = "SELECT COUNT(dm.Account_id) AS Division_dr FROM `Doctor_Master` dm
                INNER JOIN `Employee_Doc` ed
                ON ed.VEEVA_Account_ID=dm.Account_ID
                INNER JOIN `Employee_Master` em
                ON em.VEEVA_Employee_ID=ed.Local_Employee_ID
                WHERE em.Division='$division'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function doc_duplicate($id) {
        $sql = " select * from  Doctor_Master WHERE Account_ID='$id'";
    }

    public function total_target_by_product($product_id) {
        $sql = "SELECT SUM(`target`) AS total_target FROM `Rx_Target`
                WHERE `Product_Id`= $product_id";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function insert_doc($data) {
        return $this->db->insert('Doctor_Master', $data);
    }

    public function update_doc($id, $data) {
        $query = $this->db->where('Account_ID', $id);
        $query = $this->db->update('Doctor_Master', $data);
        return $query;
    }

    public function del_doc($id, $data) {
        $query = $this->db->where('Account_ID', $id);
        $query = $this->db->update('Doctor_Master', $data);
        return $query;
    }

    public function find_by_docid($id) {
        $sql = "select * from Doctor_Master where Account_ID='$id'  ";
    }

    public function total_actualrx_by_product($product_id) {
        $sql = "SELECT SUM(`Actual_Rx`) AS total_actual_rx FROM `Rx_Actual`
                WHERE `Product_Id`= $product_id";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function count() {
        $sql = "SELECT COUNT(Employee_Doc.VEEVA_Account_ID) AS COUNT FROM Employee_Master em  
                INNER JOIN Employee_Doc on Employee_Doc.VEEVA_Employee_ID = em.VEEVA_Employee_ID ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function total_target($month, $Year) {
        $sql = "SELECT SUM(`target`) AS TOTAL FROM `Rx_Target` WHERE month = {$month} AND Year = '$Year' ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function total_convertion_by_product($product_id) {
        $sql = "SELECT COUNT(`Doctor_Id`) AS total_convertion FROM `Rx_Actual`
                WHERE `Product_Id`= $product_id";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function total_convertion() {
        $sql = "SELECT COUNT(DISTINCT(`Doctor_Id`)) AS TOTAL FROM `Rx_Actual`";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function count_planned($month, $Year) {
        $sql = "SELECT SUM(Rx_Planning.Planned_RX) AS TOTAL FROM Employee_Master
            LEFT JOIN Rx_Planning ON Employee_Master.VEEVA_Employee_ID=Rx_Planning.VEEVA_Employee_ID
            WHERE Employee_Master.status='1' AND Rx_Planning.month = {$month} AND Rx_Planning.Year = '$Year'  ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function count_planned_month() {
        $sql = "SELECT SUM(Rx_Planning.Planned_RX) AS TOTAL FROM Employee_Master
            LEFT JOIN Rx_Planning ON Employee_Master.VEEVA_Employee_ID=Rx_Planning.VEEVA_Employee_ID
             WHERE Employee_Master.status='1' GROUP BY Rx_Planning.month  ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function count_achive($month, $Year) {
        $sql = "SELECT SUM(Rx_Actual.Actual_Rx) AS TOTAL FROM Rx_Actual
            WHERE month = {$month} AND Year = '$Year' ";

        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function count_achive_month() {
        $sql = "SELECT SUM(Rx_Actual.Actual_Rx) AS TOTAL FROM Rx_Actual
 LEFT JOIN Employee_Master ON Employee_Master.VEEVA_Employee_ID=Rx_Actual.VEEVA_Employee_ID
 WHERE Employee_Master.status='1' GROUP BY  Rx_Actual.month ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function Tab1() {
        $sql = "UPDATE `Tab_Control` SET `Tab1`='1',`Tab2`='1',`Tab3`='1',`Tab4`='1',`Tab5`='1'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function Tab2() {
        $sql = "UPDATE `Tab_Control` SET `Tab1`='1',`Tab2`='1',`Tab3`='1',`Tab4`='1',`Tab5`='1'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function Tab3() {
        $sql = "UPDATE `Tab_Control` SET `Tab1`='1',`Tab2`='1',`Tab3`='1',`Tab4`='1',`Tab5`='1'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function Tab4() {
        $sql = "UPDATE `Tab_Control` SET `Tab1`='1',`Tab2`='1',`Tab3`='1',`Tab4`='1',`Tab5`='1'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function Tab5() {
        $sql = "UPDATE `Tab_Control` SET `Tab1`='1',`Tab2`='1',`Tab3`='1',`Tab4`='1',`Tab5`='1'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function count_doc($class) {
        $sql = "SELECT COUNT(DISTINCT(Specialty)) FROM Doctor_Master GROUP BY Specialty where Specialty=$class";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function BDM_show() {
        $sql = "SELECT em.`Full_Name`,em.`Region`,em.`State`,ra.`Actual_Rx`,ra.`Product_Id`,em.`VEEVA_Employee_ID` FROM `Employee_Master` em
LEFT JOIN `Rx_Actual` ra
ON em.`VEEVA_Employee_ID`=ra.`VEEVA_Employee_ID`
WHERE em.`Designation`='BDM' 
GROUP BY em.`VEEVA_Employee_ID`";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function Over_all_count() {
        $sql = "SELECT COUNT(p.Doctor_Id) AS over_all FROM `Profiling` p
                WHERE p.Product_Id IN(1,2,3)";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function profiling_by_product($data) {
        $sql = "SELECT COUNT(p.Doctor_Id) AS profiling_by_product FROM `Profiling` p
                WHERE p.Product_Id = $data";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function insert_empdoc_csv($data) {
        return $this->db->insert('Employee_Doc', $data);
    }

    public function insert_tab($data) {
        return $this->db->insert('Tab_Control', $data);
    }

    public function bdm_unlocked_list() {
        $sql = "select * from  Employee_Master where Status ='locked' ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function emp_doc($id) {
        $sql = "select DM.Account_Name as Name,DM.Specialty from Doctor_Master DM  LEFT JOIN Employee_Doc ED ON DM.Account_ID=ED.VEEVA_Account_ID where Territory ='$id' ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function reset_target($VEEVA_Employee_ID, $data) {
        $query = $this->db->where('VEEVA_Employee_ID', $VEEVA_Employee_ID);
        $query = $this->db->update('Rx_Target', $data);
        return $query;
    }

    public function target_view() {
        $sql = "Select * from Employee_Master Where Profile='ASM'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function Reporting_view() {
        $sql = "Select * from Employee_Master Where  Reporting_VEEVA_ID=''";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function target_by_bdm() {
        $sql = "Select * from Rx_Target Where Designation='ASM'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function ASm_view($VEEVA_Employee_ID) {
        $sql = "SELECT em.Division, em.`Full_Name`,em.`VEEVA_Employee_ID`FROM `Employee_Master` em
            WHERE `Reporting_VEEVA_ID`= '$VEEVA_Employee_ID'";

        $query = $this->db->query($sql);
        return $query->result();
    }

    function ASM_division($VEEVA_Employee_ID) {
        $sql = "SELECT em.`Division` as division FROM `Employee_Master` em
                WHERE em.`VEEVA_Employee_ID`='$VEEVA_Employee_ID'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function ASM_Assign_Target($VEEVA_Employee_ID, $product1, $product2, $product3) {
        $sql = " (SELECT 
            em.`Division`,
                        em.`Full_Name`,
                        em.`VEEVA_Employee_ID`,
                        rt.`target`,
                      rt.`Product_Id` 
                      FROM
                        `Employee_Master` em 
                        LEFT JOIN `Rx_Target` rt 
                          ON em.`VEEVA_Employee_ID` = rt.`VEEVA_Employee_ID` 
                          AND `Product_id` = $product1 
                          AND MONTH = '$this->nextMonth' 
                          AND YEAR = '$this->nextYear' 
                      WHERE em.`VEEVA_Employee_ID` = '$VEEVA_Employee_ID' 
                      GROUP BY em.`VEEVA_Employee_ID`) 
                      UNION
                      ALL 
                      (SELECT 
                       em.`Division`,
                        em.`Full_Name`,
                        em.`VEEVA_Employee_ID`,
                        rt.`target`,
                         rt.`Product_Id` 
                      FROM
                        `Employee_Master` em 
                        LEFT JOIN `Rx_Target` rt 
                          ON em.`VEEVA_Employee_ID` = rt.`VEEVA_Employee_ID` 
                          AND `Product_id` = $product2 
                          AND MONTH = '$this->nextMonth' 
                          AND YEAR = '$this->nextYear' 
                      WHERE em.`VEEVA_Employee_ID` = '$VEEVA_Employee_ID' 
                      GROUP BY em.`VEEVA_Employee_ID`) 
                      UNION
                      ALL 
                      (SELECT 
                       em.`Division`,
                        em.`Full_Name`,
                        em.`VEEVA_Employee_ID`,
                        rt.`target`,
                         rt.`Product_Id` 
                      FROM
                        `Employee_Master` em 
                        LEFT JOIN `Rx_Target` rt 
                          ON em.`VEEVA_Employee_ID` = rt.`VEEVA_Employee_ID` 
                          AND `Product_id` = $product3
                            AND MONTH = '$this->nextMonth' 
                          AND YEAR = '$this->nextYear' 

                      WHERE em.`VEEVA_Employee_ID` = '$VEEVA_Employee_ID' 
                      GROUP BY em.`VEEVA_Employee_ID`)";

        $query = $this->db->query($sql);
//        echo $this->db->last_query() . "<br/>";
        return $query->result();
    }

    public function login_history() {
        $sql = "
                SELECT 
                  em.Full_Name,
                  em.Zone,
                  em.Profile,
                  em.Division,
                  tr.Territory,
                  lh.VEEVA_Employee_ID AS id,
                  COUNT(lh.VEEVA_Employee_ID) AS COUNT
                FROM
                  login_history lh 
                  INNER JOIN Employee_Master em 
                    ON em.`VEEVA_Employee_ID` = lh.`VEEVA_Employee_ID` 
                  LEFT JOIN Territory_master tr 
                    ON em.Territory = tr.id 
                GROUP BY lh.`VEEVA_Employee_ID` ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function login_view($id) {
        $sql = "select * FROM login_history WHERE VEEVA_Employee_ID ='$id' ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function adminDashboardCount($Product_Id, $month, $Year) {
        $individualType = (int) $Product_Id == 1 ? 'Hospital' : 'Doctor';
        $sql = "SELECT 
                    em.`Full_Name`,
                    em.VEEVA_Employee_ID,
                    COUNT(ed.`VEEVA_Account_ID`) AS No_of_Doctors,
                    COUNT(p.`Doctor_Id`) AS No_of_Doctors_profiled,
                    rt.`target` AS Target_New_Rxn_for_the_month,
                    SUM(rp.`Planned_Rx`) AS Planned_New_Rxn,
                    COUNT(ap.`Act_Plan`) AS No_of_Doctors_planned,
                    COUNT(
                      CASE
                        WHEN ar.`Activity_Done` = 'Yes' 
                        THEN 1 
                      END
                    ) AS checkk 
                  FROM
                    Employee_Master em 
                    LEFT JOIN Employee_Doc ed 
                      ON em.`VEEVA_Employee_ID` = ed.`VEEVA_Employee_ID` 
                    INNER JOIN Doctor_Master dm 
                      ON dm.`Account_ID` = ed.`VEEVA_Account_ID` 
                      AND dm.Individual_Type = '$individualType' 
                    LEFT JOIN Profiling p 
                      ON ed.`VEEVA_Account_ID` = p.`Doctor_Id` 
                      AND p.`Product_id` = {$Product_Id} 
                      AND p.Status = 'Submitted' 
                    LEFT JOIN 
                      (SELECT 
                        * 
                      FROM
                        Rx_Target 
                      WHERE MONTH = {$month} 
                        AND YEAR = '$Year' 
                        AND `Product_Id` = {$Product_Id} 
                        AND STATUS = 'Submitted') AS rt 
                      ON em.`VEEVA_Employee_ID` = rt.`VEEVA_Employee_ID` 
                    LEFT JOIN Rx_Planning rp 
                      ON ed.`VEEVA_Account_ID` = rp.`Doctor_Id` 
                      AND rp.`Product_Id` = {$Product_Id}  
                      AND rp.`Month` = {$month} 
                      AND rp.`Year` = '$Year' 
                      AND rp.VEEVA_Employee_ID = em.VEEVA_Employee_ID 
                    LEFT JOIN Activity_Planning ap 
                      ON ed.`VEEVA_Account_ID` = ap.`Doctor_Id` 
                      AND ap.`Product_Id` = {$Product_Id}   
                      AND ap.`Month` = {$month} 
                      AND ap.`Year` = '$Year' 
                      AND em.`VEEVA_Employee_ID` = ap.`VEEVA_Employee_ID` 
                    LEFT JOIN Activity_Reporting ar 
                      ON ed.`VEEVA_Account_ID` = ar.`Doctor_Id` 
                      AND ar.`Product_Id` = {$Product_Id} 
                      AND ar.`Month` = {$month} 
                      AND ar.`Year` = '$Year'  
                      AND em.`VEEVA_Employee_ID` = ar.`VEEVA_Employee_ID` 
                  GROUP BY em.`VEEVA_Employee_ID` ";
        //echo $sql;
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function reporting_view2($id) {
        $sql = "select em.*,tr.* FROM Employee_Master em   LEFT JOIN Territory_master tr 
                    ON em.Territory = tr.id WHERE VEEVA_Employee_ID ='$id'  ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function reporting_change($id, $data) {
        $query = $this->db->where('VEEVA_Employee_ID', $id);
        $query = $this->db->update('Employee_Master', $data);
        return $query;
    }

    public function target_assign() {
        $sql = "SELECT 
            em.*,tm.`Territory` 
          FROM
            `Employee_Master` em
            INNER JOIN `Territory_master` tm ON tm.`id` = em.`Territory`

          WHERE `VEEVA_Employee_ID` IN 
            (SELECT DISTINCT 
              (`Reporting_VEEVA_ID`) 
            FROM
              Employee_Master em 
              INNER JOIN `Rx_Target` rt 
                ON rt.VEEVA_Employee_ID = em.VEEVA_Employee_ID 
            WHERE rt.Status = 'Submitted')";
        $query = $this->db->query($sql);
        return $query->result();
    }

}
