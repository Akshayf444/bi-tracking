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
        $sql = "select  Tab_Control.*, Employee_Master.Full_Name from Employee_Master left join Tab_Control on Employee_Master. VEEVA_Employee_ID=Tab_Control.VEEVA_Employee_ID ";
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

    public function doc_view() {
        $sql = "select * from Doctor_Master";
        $query = $this->db->query($sql);
        return $query->result();
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

    public function total_target_by_product($product_id) {
        $sql = "SELECT SUM(`target`) AS total_target FROM `Rx_Target`
                WHERE `Product_Id`= $product_id";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function total_actualrx_by_product($product_id) {
        $sql = "SELECT SUM(`Actual_Rx`) AS total_actual_rx FROM `Rx_Actual`
                WHERE `Product_Id`= $product_id";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function total_convertion_by_product($product_id) {
        $sql = "SELECT COUNT(`Doctor_Id`) AS total_convertion FROM `Rx_Actual`
                WHERE `Product_Id`= $product_id";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

}
