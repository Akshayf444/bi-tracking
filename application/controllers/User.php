<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper();
        $this->load->model('User_model');
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
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $check = $this->User_model->authentication($username, $password);
            if (empty($check)) {
                $data['message'] = ' Username/password Incorrect';
                $data = array('title' => 'Login', 'content' => 'User/login', 'view_data' => $data);
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
        if ($this->is_logged_in()) {
            $data = array();
            $result = $this->Master_Model->BrandList($this->session->userdata('Division'));
            $data['productList'] = $this->Master_Model->generateDropdown($result, 'id', 'Brand_Name');
            $data['tab1'] = $this->User_model->generateTabs($this->VEEVA_Employee_ID, $this->Product_Id);

            if ($this->input->post()) {
                $this->Product_Id = $this->input->post('Product_Id');
                $this->session->set_userdata('Product_Id', $this->input->post('Product_Id'));
                redirect('User/dashboard', 'refresh');
            }
            $data['productList'] = $this->Master_Model->generateDropdown($result, 'id', 'Brand_Name', $this->Product_Id);
            $data = array('title' => 'Main', 'content' => 'User/Main', 'view_data' => $data);
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    public function productSel() {
        $data = array('title' => 'Select Product', 'content' => 'User/Product', 'view_data' => 'blank');
        $this->load->view('template2', $data);
    }

    public function Act_Plan() {
        $data = array('title' => 'Select Product', 'content' => 'User/Act_Plan', 'view_data' => 'blank');
        $this->load->view('template2', $data);
    }

    public function doctorList() {
        if ($this->is_logged_in()) {

            $data['doctorList'] = $this->User_model->generatePlanningTab();
            //echo($data['doctorList']);
            if ($this->input->post()) {
                for ($i = 0; $i < count($this->input->post('value')); $i++) {
                    $value = $this->input->post('value');
                    $doc_id = $this->input->post('doc_id');
                    $current_date = date('Y-m-d');
                    $next_date = date('M');
                    $doc = array(
                        'Planned_Rx' => $value[$i],
                        'Year' => $this->nextYear,
                        'month' => $this->nextMonth,
                        $next_date => $value[$i],
                        'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID,
                        'Product_Id' => $this->Product_Id,
                        'created_at' => date('Y-m-d'),
                        'Doctor_Id' => $doc_id[$i],
                    );
                    $this->User_model->Save_Planning($doc);
                }
            }

            $data['expected'] = $this->User_model->Expected_Rx($this->VEEVA_Employee_ID, $this->Product_Id, $this->nextMonth);
            $data = array('title' => 'Search', 'content' => 'User/doctorList', 'view_data' => $data);
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    public function Profiling() {
        if ($this->is_logged_in()) {
            $result = $this->Doctor_Model->getDoctor($this->VEEVA_Employee_ID);
            if ($this->input->post()) {
                $this->form_validation->set_rules('Doctor_Id', 'Doctor ', 'required');
                $this->form_validation->set_rules('Patient_Seen', 'Patient Seen', 'required');
                $this->form_validation->set_rules('Patient_Rxbed_In_Week', 'Patient Rxbed In Week', 'required');
                $this->form_validation->set_rules('Win_Q1', 'Win Q1', 'required');
                if ($this->form_validation->run() == FALSE) {
//                   $this->form_validation->set_message('required', 'Your custom message here');
                } else {
                    $_POST['VEEVA_Employee_ID'] = $this->VEEVA_Employee_ID;
                    $_POST['Product_id'] = $this->Product_Id;
                    $_POST['created_at'] = date('Y-m-d H:i:s');
                    $check - $this->User_model->profiling_by_id($_POST['Doctor_id'], $_POST['VEEVA_Employee_ID'], $_POST['Product_id']);
                    if (empty($check)) {
                        if ($this->db->insert('Profiling', $_POST)) {
                            redirect('User/Profiling', 'refresh');
                        }else
                        {
                            redirect('User/Profiling', 'refresh');
                        }
                    }
                }
            }
            $data['doctorList'] = $this->Master_Model->generateDropdown($result, 'Account_ID', 'Account_Name');
            $data['questionList'] = $this->Master_Model->getQuestions($this->Product_Id);
            $data = array('title' => 'Question', 'content' => 'User/Question', 'view_data' => $data);
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    public function addPlanning() {
        $data = array('title' => 'Planning', 'content' => 'User/addbusiness', 'view_data' => 'blank');
        $this->load->view('template2', $data);
    }

    public function addRx() {
        $data = array('title' => 'Report', 'content' => 'User/Report', 'view_data' => 'blank');
        $this->load->view('template2', $data);
    }

    public function Set_Target() {
        if ($this->input->post()) {
            $values = $this->input->post('value');
            $data = array(
                'target' => $values,
                'VEEVA_Employee_ID' => $this->session->userdata('VEEVA_Employee_ID'),
                'Product_Id' => $this->session->userdata('Product_Id'),
                'Month' => date('m', strtotime('+1 month')),
                'Year' => date('Y'),
                'created_at' => date('Y-m-d H:i:s'),
            );
            $check = $this->User_model->Set_Target_by_id($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id);
            if (!empty($check)) {
                $data = array(
                    'target' => $values,
                    'Product_Id' => $this->session->userdata('Product_Id'));
                $this->User_model->Set_Target_update($this->session->userdata('VEEVA_Employee_ID'), $data, $this->Product_Id);
            } else {
                $this->User_model->Set_Target($data);
            }
        }
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

    public function Reporting() {
        if ($this->is_logged_in()) {

            $data['doctorList'] = $this->User_model->generatePlanningTab('Actual');

            if ($this->input->post()) {
                for ($i = 0; $i < count($this->input->post('value')); $i++) {
                    $value = $this->input->post('value');
                    $doc_id = $this->input->post('doc_id')[$i];
                    $current_date = date('Y-m-d');
                    $next_date = date('M');

                    $doc = array(
                        'Actual_Rx' => $value[$i],
                        $next_date => $value[$i],
                        'Actual_Created' => date('Y-m-d H:i:s'),
                    );

                    $this->User_model->Save_Planning_prescription($doc, $this->VEEVA_Employee_ID, $doc_id, $this->Product_Id, $this->nextMonth, $this->nextYear);
                }
            }

            $data = array('title' => 'Reporting Doctor', 'content' => 'User/Prescription_Doctor_List', 'view_data' => $data);
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

}
