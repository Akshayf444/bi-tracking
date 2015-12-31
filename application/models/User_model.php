<?php

class User_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->table_name = 'Employee_Master';
    }

    public function authentication($username, $password) {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where(array('Username' => $username, 'Password' => $password, 'Status' => '1'));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function validateLogin() {
        
    }

    public function Set_Target($data) {
        return $this->db->insert('Rx_Target', $data);
    }

    public function Set_Target_by_id($id, $pid) {
        $sql = "select * from Rx_Target
               where VEEVA_Employee_ID='$id' And Product_Id='$pid'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function Set_Target_update($id, $data,$Pid) {
        $this->db->where(array('VEEVA_Employee_ID' => $id, 'Product_Id' => $Pid));
        return $this->db->update('Rx_Target', $data);
    }

    public function Tabs($VEEVA_Employee_ID) {
        $this->db->select('*');
        $this->db->from($this->table_name . ' Em');
        $this->db->join('Tab_Control tb', 'Em.VEEVA_Employee_ID = tb.VEEVA_Employee_ID');
        $this->db->where(array('Em.VEEVA_Employee_ID' => $VEEVA_Employee_ID));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function generateTab($VEEVA_Employee_ID = 0, $Product_id = 0) {
        $tabs = $this->Tabs($VEEVA_Employee_ID);
    }

}
