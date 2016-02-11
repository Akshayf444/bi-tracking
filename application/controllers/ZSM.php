<?php

class ZSM extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function dashboard() {
        if ($this->is_logged_in()) {
            $result2 = $this->Master_Model->BrandList($this->session->userdata('Division'));
            $data['productlist'] = $result2;
            $data['division'] = $this->User_model->ASM_division($this->VEEVA_Employee_ID);
            $data = array('title' => 'Main', 'content' => 'ASM/ASM_dashboard', 'view_data' => $data);
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

}
