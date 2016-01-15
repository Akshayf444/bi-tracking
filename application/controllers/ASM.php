<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ASM extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper();
        $this->load->model('User_model');
        $this->load->model('asm_model');
        $this->load->model('Master_Model');
        $this->load->model('Doctor_Model');
        $this->load->library('form_validation');
        $this->calcPlanning();
    }

    function calcPlanning() {
        $this->db->select('*');
        $this->db->from('Setting');
        $this->db->where('Current_Month', date('n'));
        $query = $this->db->get();
        $result = $query->result();
        if (!empty($result)) {
            foreach ($result as $value) {
                $this->nextMonth = $value->Planned_For_Month;
                $this->nextYear = $value->Planned_For_Year;
            }
        }
    }

    public function index() {
        $data = array();
        if ($this->input->post()) {

            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $check = $this->User_model->authentication($username, $password);
            if (empty($check)) {
                $data['message'] = ' Username/password Incorrect';
                $emp = $this->User_model->employee_id($username);
                $add = array(
                    'VEEVA_Employee_ID' => $emp['VEEVA_Employee_ID'],
                    'password' => $password,
                    'created_at' => date('Y-m-d H:i:s'),
                );
                $this->User_model->password_save($add);
                $count = $this->User_model->password_count($emp['VEEVA_Employee_ID']);
                if ($count['cnt'] > 5) {
                    $data1 = array(
                        'Status' => 'locked',
                    );
                    $this->User_model->update_status($username, $data1);
                    $data['message'] = 'Your Account Has Been Locked';
                }
                $data = array('title' => 'Login', 'content' => 'ASM/login', 'view_data' => $data);
                $this->load->view('template1', $data);
            } else {
                $this->session->set_userdata('VEEVA_Employee_ID', $check['VEEVA_Employee_ID']);
                $this->session->set_userdata('Local_Employee_ID', $check['Local_Employee_ID']);
                $this->session->set_userdata('Full_Name', $check['Full_Name']);
                $this->session->set_userdata('Division', $check['Division']);
                $this->session->set_userdata('Designation', $check['Designation']);
                $this->session->set_userdata('Reporting_To', $check['Reporting_To']);
                $this->session->set_userdata('Reporting_VEEVA_ID', $check['Reporting_VEEVA_ID']);
                $this->session->set_userdata('Reporting_Local_ID', $check['Reporting_Local_ID']);
                $this->session->set_userdata('Reporting_To', $check['Reporting_To']);

                $check_password = $this->User_model->password_status($this->session->userdata('VEEVA_Employee_ID'));

                if (is_null($check_password['password_status'])) {
                    redirect('ASM/dashboard', 'refresh');
                } else {
                    redirect('ASM/dashboard', 'refresh');
                }
            }
        }
        $data = array('title' => 'Login', 'content' => 'ASM/login', 'view_data' => $data);
        $this->load->view('template1', $data);
    }

    public function logout() {
        redirect('ASM/index', 'refresh');
    }

    public function dashboard() {
        if ($this->is_logged_in()) {


            $data = array('title' => 'Main', 'content' => 'ASM/ASM_dashboard', 'view_data' => 'blank');
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    public function Planning() {
        if ($this->is_logged_in()) {
            $data = array('title' => 'Planning', 'content' => 'ASM/asm_planning', 'backUrl' => 'ASM/dashboard', 'view_data' => 'blank');
            $this->load->view('template2', $data);
        }
    }

    public function target() {
        if ($this->is_logged_in()) {
            $data = array('title' => 'Target', 'content' => 'ASM/target', 'backUrl' => 'ASM/dashboard', 'view_data' => 'blank');
            $this->load->view('template2', $data);
        }
    }

    public function reporting() {
        if ($this->is_logged_in()) {
            $data = array('title' => 'Planning', 'content' => 'ASM/Asm_Reporting', 'backUrl' => 'ASM/dashboard', 'view_data' => 'blank');
            $this->load->view('template2', $data);
        }
    }

    public function asm_rx_planning() {
        if ($this->is_logged_in()) {
            $id = $this->session->userdata('VEEVA_Employee_ID');
//            echo $id;
            $result = $this->asm_model->rx_view($id);

            $data['bdm'] = $this->Master_Model->generateDropdown($result, 'VEEVA_Employee_ID', 'Full_Name');

            $result2 = $this->asm_model->product();
            $data['product'] = $this->Master_Model->generateDropdown($result2, 'id', 'Brand_Name');

            if ($this->input->post()) {
                $product = $this->input->post('product_id');
                $id = $this->input->post('rx_id');
                $data['show'] = $this->User_model->getPlanning($id, $product);
                //var_dump($data);
            }
            $data = array('title' => 'Report', 'content' => 'ASM/Asm_rxplanning', 'backUrl' => 'ASM/dashboard', 'view_data' => $data);
            //$this->load->view('template2', $data);
        }
    }

    public function activity_planning() {
        if ($this->is_logged_in()) {
            $data = array('title' => 'Planning', 'content' => 'ASM/activity_planning', 'backUrl' => 'ASM/dashboard', 'view_data' => 'blank');
            $this->load->view('template2', $data);
        }
    }

    public function reporting_rx() {
        if ($this->is_logged_in()) {
            $data = array('title' => 'Planning', 'content' => 'ASM/reporting_rx', 'backUrl' => 'ASM/dashboard', 'view_data' => 'blank');
            $this->load->view('template2', $data);
        }
    }

    public function reporting_activity() {
        if ($this->is_logged_in()) {
            $data = array('title' => 'Planning', 'content' => 'ASM/reporting_activity', 'backUrl' => 'ASM/dashboard', 'view_data' => 'blank');
            $this->load->view('template2', $data);
        }
    }

}
