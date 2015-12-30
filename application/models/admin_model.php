<?php

class admin_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
     public function login($email, $pass) {
        $query = $this->db->get_where('admin_login', array('email' => $email, 'password' => $pass,));
        return $query->row_array();
    }
    public function insert($data){
              return $this->db->insert('hq_master', $data);

        
    }
     }

