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

    public function emp_view() {
        $sql = "select * from Employee_Master where status='1'";
        $query = $this->db->query($sql);
       
        return $query->result();
    }

    public function find_by_empid($id) {
        $sql = "select * from Employee_Master where VEEVA_Employee_ID='$id'  ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function find_zone() {
        $sql = "select distinct(Zone) as Zone from Employee_Master";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function find_region() {
        $sql = "select distinct(Region) as Region from Employee_Master";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function find_Designation() {
        $sql = "select distinct(Designation) as Designation from Employee_Master";
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
        $sql="SELECT  Tab_Control.*,Territory, Zone FROM Employee_Master Left Join Tab_Control on Employee_Master. VEEVA_Employee_ID=Tab_Control.VEEVA_Employee_ID GROUP BY Zone";
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
    public  function  active_profile($id,$data){
        $query = $this->db->where('VEEVA_Employee_ID', $id);
        $query = $this->db->update('Tab_Control', $data);
        return $query;
    
    }
     public function doc_view(){
         $sql="select * from Doctor_Master";
     $query = $this->db->query($sql);
        return $query->result();
    }
     public function insert_csv($data) {
        return $this->db->insert('Employee_Master', $data);
    }
     public function insert_csv_doc($data) {
        return $this->db->insert('Doctor_Master', $data);
    }
     public  function  emp_duplicate($id){
         $sql= " select * from  Employee_Master WHERE VEEVA_Employee_ID='$id'";
          $query = $this->db->query($sql);
        return $query->row_array();
     }
     public  function  doc_duplicate($id){
         $sql= " select * from  Doctor_Master WHERE Account_ID='$id'";
         
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
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function count() {
        $sql = "SELECT COUNT(Employee_Doc.VEEVA_Account_ID) AS COUNT FROM Doctor_Master
LEFT JOIN  Employee_Doc ON Employee_Doc.VEEVA_Account_ID=Doctor_Master.Account_ID
 WHERE Doctor_Master.status='Active'  ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
      public function count_planned() {
        $sql = "SELECT SUM(Rx_Planning.Planned_RX) AS TOTAL FROM Employee_Master
LEFT JOIN Rx_Planning ON Employee_Master.VEEVA_Employee_ID=Rx_Planning.VEEVA_Employee_ID
 WHERE Employee_Master.status='1' ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function count_achive() {
        $sql = "SELECT SUM(Rx_Planning.Actual_RX) AS TOTAL FROM Employee_Master
LEFT JOIN Rx_Planning ON Employee_Master.VEEVA_Employee_ID=Rx_Planning.VEEVA_Employee_ID
 WHERE Employee_Master.status='1' ";
        $query = $this->db->query($sql);
        return $query->row_array();
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
     public function count_doc(){
         $sql="SELECT COUNT(DISTINCT(Specialty)) FROM Doctor_Master GROUP BY Specialty";
          $query = $this->db->query($sql);
        return $query->result();
     }
}
