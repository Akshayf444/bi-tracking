<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper();
        $this->load->model('User_model');
    }

    public function index() {
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $check=  $this->User_model->bdm_authentication($username,$password);
            if (empty($check)) {
                $data['message'] = ' Username/password Incorrect';
                $data = array('title' => 'Login', 'content' => 'User/login', 'view_data' => $data);
                $this->load->view('template1', $data);
            } else {
                redirect('User/dashboard', 'refresh');
            }
        }
        $data = array('title' => 'Login', 'content' => 'User/login', 'view_data' => $data);
        $this->load->view('template1', $data);
    }

    public function PlanningDr() {
        $data = array('title' => 'PlanningDr', 'content' => 'User/PlanningDr', 'view_data' => 'blank');
        $this->load->view('template2', $data);
    }

    public function dashboard() {

        $data = array('title' => 'Main', 'content' => 'User/Main', 'view_data' => 'blank');
        $this->load->view('template2', $data);
    }

    public function productSel() {
        $data = array('title' => 'Select Product', 'content' => 'User/Product', 'view_data' => 'blank');
        $this->load->view('template2', $data);
    }

    public function doctorList() {
        $data = array('title' => 'Search', 'content' => 'User/doctorList', 'view_data' => 'blank');
        $this->load->view('template2', $data);
    }

    public function askQuestion() {
        $data = array('title' => 'Question', 'content' => 'User/Question', 'view_data' => 'blank');
        $this->load->view('template2', $data);
    }

    public function addPlanning() {
        $data = array('title' => 'Planning', 'content' => 'User/addbusiness', 'view_data' => 'blank');
        $this->load->view('template2', $data);
    }

    public function addRx() {
        $data = array('title' => 'Report', 'content' => 'User/Report', 'view_data' => 'blank');
        $this->load->view('template2', $data);
    }

    public function Delta() {
        $data = array('title' => 'Report', 'content' => 'User/addDelta', 'view_data' => 'blank');
        $this->load->view('template2', $data);
    }

    public function doctorwiseDelta() {
        $data = array('title' => 'Report', 'content' => 'User/DoctorWiseDelta', 'view_data' => 'blank');
        $this->load->view('template2', $data);
    }

    public function PlanMenu() {
        $data = array('title' => 'Report', 'content' => 'User/PlanMenu', 'view_data' => 'blank');
        $this->load->view('template2', $data);
    }

    public function logout() {
        redirect('User/index', 'refresh');
    }

    public function view_status() {
        $data = array('title' => 'View_status', 'content' => 'User/view_status', 'view_data' => 'blank');
        $this->load->view('template2', $data);
    }

    public function rep_doc() {
        $data = array('title' => 'Reporting Doctor', 'content' => 'User/reporting_doctor', 'view_data' => 'blank');
        $this->load->view('template2', $data);
    }

}
