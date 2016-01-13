<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {

        parent::__construct();
        //$this->load->library('csvimport');
        $this->load->model('admin_model');
        $this->load->model('Master_Model');
        $this->load->library('grocery_CRUD');
//       $this->ADMIN_ID= $this->session->set_userdata('admin_id', $validadmin['admin_id']);
    }

    public function index() {
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $validadmin = $this->admin_model->login($username, $password);
            if (empty($validadmin)) {
                $data['message'] = 'Username/Password Incorrect';
                $data = array('title' => 'Login', 'content' => 'admin/login', 'view_data' => $data);
                $this->load->view('template1', $data);
            } else {
                $this->session->set_userdata('admin_id', $validadmin['admin_id']);
                redirect('admin/dashboard', 'refresh');
            }
        }
        $data = array('title' => 'Login', 'content' => 'admin/login', 'view_data' => 'blank');
        $this->load->view('template1', $data);
    }

    public function dashboard() {


        $division = 'Diabetes';
        $division1 = 'ThromBI';
        $data['dr_by_product'] = $this->admin_model->dr_by_product($division);
        $data['total_target_by_product1'] = $this->admin_model->total_target_by_product(1);
        $data['total_target_by_product2'] = $this->admin_model->total_target_by_product(2);
        $data['total_target_by_product3'] = $this->admin_model->total_target_by_product(3);
        $data['total_actualrx_by_product1'] = $this->admin_model->total_actualrx_by_product(1);
        $data['total_actualrx_by_product2'] = $this->admin_model->total_actualrx_by_product(2);
        $data['total_actualrx_by_product3'] = $this->admin_model->total_actualrx_by_product(3);
        $data['total_convertion_by_product1'] = $this->admin_model->total_convertion_by_product(1);
        $data['total_convertion_by_product2'] = $this->admin_model->total_convertion_by_product(2);
        $data['total_convertion_by_product3'] = $this->admin_model->total_convertion_by_product(3);
        $data = array('title' => 'Login', 'content' => 'admin/dashboard', 'page_title' => 'Admin', 'view_data' => 'blank');
        $this->load->view('template3', $data);
//        }
    }

    public function emp_view() {
        $data['show'] = $this->admin_model->emp_view();
        $data = array('title' => 'Login', 'content' => 'admin/add_emp', 'page_title' => 'Employee Master', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function logout() {
        redirect('admin/index', 'refresh');
    }

    public function emp_add() {
        if ($_POST) {
            $data = array(
                'VEEVA_Employee_ID' => $this->input->post('VEEVA_Employee_ID'),
                'Local_Employee_ID' => $this->input->post('Local_Employee_ID'),
                'First_Name' => $this->input->post('First_Name'),
                'Middle_Name' => $this->input->post('Middle_Name'),
                'Last_Name' => $this->input->post('Last_Name'),
                'Full_Name' => $this->input->post('Full_Name'),
                'Territory' => $this->input->post('Territory'),
                'Gender' => $this->input->post('Gender'),
                'Mobile' => $this->input->post('Mobile'),
                'Email_ID' => $this->input->post('Email_ID'),
                'Username' => $this->input->post('Username'),
                'Password' => '',
                'Last_Login' => $this->input->post('Last_Login'),
                'Address_1' => $this->input->post('Address_1'),
                'Address_2' => $this->input->post('Address_2'),
                'City' => $this->input->post('City'),
                'State' => $this->input->post('State'),
                'Division' => $this->input->post('Division'),
                'Product' => $this->input->post('Product'),
                'Zone' => $this->input->post('Zone'),
                'Region' => $this->input->post('Region'),
                'Profile' => $this->input->post('Profile'),
                'Designation' => $this->input->post('Designation'),
                'Created_By' => 'System',
                'created_date' => date('Y-m-d'),
                'Date_of_Joining' => $this->input->post('Date_of_Joining'),
                'DOB' => $this->input->post('DOB'),
                'Reporting_To' => $this->input->post('Reporting_To'),
                'Reporting_VEEVA_ID' => $this->input->post('Reporting_VEEVA_ID'),
                'Reporting_Local_ID' => $this->input->post('Reporting_Local_ID'),
                'Status' => '1',
            );
            $this->admin_model->insert($data);
            redirect('admin/dashboard', 'refresh');
        }
        $result = $this->admin_model->find_zone();
        $data['zone'] = $this->Master_Model->generateDropdown($result, 'Zone', 'Zone');
        $result = $this->admin_model->find_region();
        $data['region'] = $this->Master_Model->generateDropdown($result, 'Region', 'Region');
        $result = $this->admin_model->find_Designation();
        $data['Designation'] = $this->Master_Model->generateDropdown($result, 'Designation', 'Designation');
        $data = array('title' => 'Login', 'content' => 'admin/emp_add', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function update_emp() {
        $id = $_GET['id'];
        $data['rows'] = $this->admin_model->find_by_empid($id);
        $result = $this->admin_model->find_zone();
        $data['zone'] = $this->Master_Model->generateDropdown($result, 'Zone', 'Zone', $data['rows']['Zone']);
        $result = $this->admin_model->find_region();
        $data['region'] = $this->Master_Model->generateDropdown($result, 'Region', 'Region', $data['rows']['Region']);
        $result = $this->admin_model->find_Designation();
        $data['Designation'] = $this->Master_Model->generateDropdown($result, 'Designation', 'Designation', $data['rows']['Designation']);

        if ($this->input->post()) {
            $empid = $this->input->post('VEEVA_Employee_ID');
            $data = array(
                'VEEVA_Employee_ID' => $this->input->post('VEEVA_Employee_ID'),
                'Local_Employee_ID' => $this->input->post('Local_Employee_ID'),
                'First_Name' => $this->input->post('First_Name'),
                'Middle_Name' => $this->input->post('Middle_Name'),
                'Last_Name' => $this->input->post('Last_Name'),
                'Full_Name' => $this->input->post('Full_Name'),
                'Territory' => $this->input->post('Territory'),
                'Gender' => $this->input->post('Gender'),
                'Mobile' => $this->input->post('Mobile'),
                'Email_ID' => $this->input->post('Email_ID'),
                'Username' => $this->input->post('Username'),
                'Address_1' => $this->input->post('Address_1'),
                'Address_2' => $this->input->post('Address_2'),
                'City' => $this->input->post('City'),
                'State' => $this->input->post('State'),
                'Division' => $this->input->post('Division'),
                'Product' => $this->input->post('Product'),
                'Zone' => $this->input->post('Zone'),
                'Region' => $this->input->post('Region'),
                'Profile' => $this->input->post('Profile'),
                'Designation' => $this->input->post('Designation'),
                'Modified_By' => 'Admin',
                'Modified_Date' => date('Y-m-d'),
                'Date_of_Joining' => $this->input->post('Date_of_Joining'),
                'DOB' => $this->input->post('DOB'),
                'Reporting_To' => $this->input->post('Reporting_To'),
                'Reporting_VEEVA_ID' => $this->input->post('Reporting_VEEVA_ID'),
                'Reporting_Local_ID' => $this->input->post('Reporting_Local_ID'),
                'Status' => '1',
            );
            $this->admin_model->update_emp($empid, $data);
            redirect('admin/update_emp', 'refresh');
        }


        $data = array('title' => 'Login', 'content' => 'admin/update_emp', 'view_data' => $data);
        $this->load->view('template3', $data);

//        $data = array('title' => 'Login', 'content' => 'admin/update_emp', 'view_data' => $data);
//        $this->load->view('admin/update_emp', $data);
    }

    public function emp_del() {
        $id = $_GET['id'];
        $data = array('status' => 0);
        $this->admin_model->del_emp($id, $data);
        redirect('admin/dashboard', 'refresh');
    }

    public function edit() {
        $id = $_GET['id'];
        $name = $_GET['name'];
        if ($this->input->post()) {
            if ($name == 'asm') {
                $check['show'] = $this->admin_model->asm_edit($id);
            } elseif ($name == 'zsm') {
                $check['show'] = $this->admin_model->zsm_edit($id);
            } elseif ($name == 'bdm') {
                $check['show'] = $this->admin_model->bdm_edit($id);
            }
        }
        $check['show'] = $this->admin_model->asm_by_id($id);
        $data = array('title' => 'Login', 'content' => 'admin/edit', 'view_data' => $check);
        $this->load->view('template2', $data);
    }

    public function manage() {
        if ($this->input->post()) {
            $team = $this->input->post('team');
            if ($team == 'asm') {
                $check['team1'] = $this->admin_model->asm();
            } elseif ($team == 'zsm') {
                $check['team2'] = $this->admin_model->zsm();
            } elseif ($team == 'bdm') {
                $check['team3'] = $this->admin_model->bdm();
            } else {
                $check['team4'] = '';
            }
        }

        $data = array('title' => 'Login', 'content' => 'admin/Manage', 'view_data' => $check);
        $this->load->view('template2', $data);
    }

    public function view_activity() {
        $data['show'] = $this->admin_model->view_activity();
        $data = array('title' => 'Login', 'content' => 'admin/activity_view', 'page_title' => 'Activity Master', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function act_del() {
        $id = $_GET['id'];
        $data = array('status' => 0);
        $this->admin_model->del_act($id, $data);
        redirect('admin/view_activity', 'refresh');
    }

    public function add_activity() {
        if ($_POST) {
            $data = array(
                'Activity_Name' => $this->input->post('Activity_Name'),
                'Division' => $this->input->post('Division'),
                'Product_ID' => $this->input->post('Product_ID'),
                'Created_By' => 'Admin',
                'Status' => '1',
                'created_at' => date('Y-m-d'),
            );
            $this->admin_model->insert_activity($data);
            redirect('admin/view_activity', 'refresh');
        }
        $result = $this->admin_model->show_pro_list();
        $data['Product'] = $this->Master_Model->generateDropdown($result, 'id', 'Brand_Name');
        $data = array('title' => 'Login', 'content' => 'admin/add_activity', 'page_title' => 'Add Activity', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function update_act() {
        $id = $_GET['id'];
        $data['rows'] = $this->admin_model->find_by_activityid($id);

        $result = $this->admin_model->show_pro_list();
        $data['Product'] = $this->Master_Model->generateDropdown($result, 'id', 'Brand_Name', $data['rows']['Product_Id']);


        if ($this->input->post()) {
            $actid = $this->input->post('Act_id');
            $data = array(
                'Activity_Name' => $this->input->post('Activity_Name'),
                'Division' => $this->input->post('Division'),
                'Product_ID' => $this->input->post('Product_ID'),
                'modified_by' => 'Admin',
                'Status' => '1',
                'updated_at' => date('Y-m-d'),
            );
            $this->admin_model->update_act($actid, $data);
            redirect('admin/update_act', 'refresh');
        }

        $data = array('title' => 'Login', 'content' => 'admin/update_activity', 'page_title' => 'Update Activity', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function profile_view() {
        $data['show'] = $this->admin_model->view_profile_controller();

        $data = array('title' => 'Login', 'content' => 'admin/profile_controller', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function lock() {

        $this->admin_model->lock();
        redirect('admin/profile_view', 'refresh');
    }

    public function unlock() {


        $this->admin_model->unlock();
        redirect('admin/profile_view', 'refresh');
    }

    public function profile_active() {
        if ($this->input->post()) {
            $actid = $this->input->post('Act_id');
            $data = array(
                'Tab1' => $this->input->post('Tab1'),
                'Tab2' => $this->input->post('Tab2'),
                'Tab3' => $this->input->post('Tab3'),
                'Tab4' => $this->input->post('Tab4'),
                'Tab5' => $this->input->post('Tab5'),
                'updated_at' => date('Y-m-d'),
            );
            $this->admin_model->active_profile($actid, $data);
            redirect('admin/view_activity', 'refresh');
        }
    }

    public function doc_view() {
        $data['show'] = $this->admin_model->doc_view();

        $data = array('title' => 'Login', 'content' => 'admin/doctor_view', 'page_title' => 'Doctor Master', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function Profile_Completion() {

        $data = array('title' => 'Profile_Completion', 'content' => 'admin/Profile_Completion', 'view_data' => 'blank');
        $this->load->view('template3', $data);
    }

    public function Rx_Planning() {

        $data = array('title' => 'Rx_Planning', 'content' => 'admin/Rx_Planning', 'view_data' => 'blank');
        $this->load->view('template3', $data);
    }

    public function sideBar() {
        
    }

    public function GroceryCrud() {
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('twitter-bootstrap');
            $crud->set_table('Employee_Master');
            $crud->set_subject('Employee');
            $crud->set_primary_key('VEEVA_Employee_ID', 'Employee_Master');
            $output = $crud->render();
            $data['output'] = $output->output;
            $data['css_files'] = $output->css_files;
            $data['js_files'] = $output->js_files;
            $data = array('title' => 'Profile_Completion', 'content' => 'admin/GroceryCrud', 'view_data' => $data);
            $this->load->view('template3', $data);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function QuestionMaster() {
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('flexigrid');
            $crud->set_table('Question_Master');
            $crud->set_subject('Question');
            $output = $crud->render();
            $data['output'] = $output->output;
            $data['css_files'] = $output->css_files;
            $data['js_files'] = $output->js_files;
            $data = array('title' => 'Profile_Completion', 'content' => 'admin/GroceryCrud', 'page_title' => 'Question Master', 'view_data' => $data);
            $this->load->view('template3', $data);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function BrandMaster() {
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('flexigrid');
            $crud->set_table('Brand_Master');
            $crud->set_subject('Product');
            $output = $crud->render();
            $data['output'] = $output->output;
            $data['css_files'] = $output->css_files;
            $data['js_files'] = $output->js_files;
            $data = array('title' => 'Profile_Completion', 'content' => 'admin/GroceryCrud', 'page_title' => 'Question Master', 'view_data' => $data);
            $this->load->view('template3', $data);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function emp_csv() {
        $data = array('title' => 'View_Employee', 'content' => 'admin/add_emp', 'view_data' => 'blank');
        $this->load->view('template3', $data);

        if ($this->input->post()) {
            $fp = fopen($_FILES['csv']['tmp_name'], 'r+');
            while (($row = fgetcsv($fp, "500", ",")) != FALSE) {
                $data = array(
                    'VEEVA_Employee_ID' => $row['0'],
                    'Local_Employee_ID' => $row['1'],
                    'First_Name' => $row['2'],
                    'Middle_Name' => $row['3'],
                    'Last_Name' => $row['4'],
                    'Full_Name' => $row['5'],
                    'Territory' => $row['6'],
                    'Gender' => $row['7'],
                    'Mobile' => $row['8'],
                    'Email_ID' => $row['9'],
                    'Username' => $row['10'],
                    'Password' => $row['11'],
                    'Last_Login' => $row['12'],
                    'Address_1' => $row['13'],
                    'Address_2' => $row['14'],
                    'City' => $row['15'],
                    'State' => $row['16'],
                    'Division' => $row['17'],
                    'Product' => $row['18'],
                    'Zone' => $row['19'],
                    'Region' => $row['20'],
                    'Profile' => $row['21'],
                    'Designation' => $row['22'],
                    'Created_By' => $row['23'],
                    'created_date' => date('Y-m-d'),
                    'Modified_By' => $row['25'],
                    'Modified_Date' => $row['26'],
                    'Date_of_Joining' => $row['27'],
                    'DOB' => $row['28'],
                    'Reporting_To' => $row['29'],
                    'Reporting_VEEVA_ID' => $row['30'],
                    'Reporting_Local_ID' => $row['31'],
                    'Status' => $row['32'],
                );
                //insert csv data into mysql table
                $sql = $this->admin_model->insert_csv($data);
            }
        }
    }

    public function doc_csv() {
        $data = array('title' => 'Doctor_view', 'content' => 'admin/add_emp', 'view_data' => 'blank');
        $this->load->view('template3', $data);

        if ($this->input->post()) {
            $fp = fopen($_FILES['csv']['tmp_name'], 'r+');
            while (($row = fgetcsv($fp, "500", ",")) != FALSE) {
                $data = array(
                    'Account_ID' => $row['0'],
                    'Salutation' => $row['1'],
                    'First_Name' => $row['2'],
                    'Last_Name' => $row['3'],
                    'Account_Name' => $row['4'],
                    'Specialty' => $row['5'],
                    'Specialty_2' => $row['6'],
                    'Specialty_3' => $row['7'],
                    'Specialty_4' => $row['8'],
                    'Individual_Type' => $row['9'],
                    'Email' => $row['10'],
                    'Gender' => $row['11'],
                    'Mobile' => $row['12'],
                    'Status' => $row['13'],
                    'Created_Date' => $row['14'],
                    'Created_By' => $row['15'],
                    'Modified_Date' => $row['16'],
                    'Modified_By' => $row['17'],
                    'City' => $row['18'],
                    'State' => $row['19'],
                    'Pin_Code' => $row['20'],
                    'Address' => $row['21'],
                    'Designation' => $row['22'],
                );
                //insert csv data into mysql table
                $sql = $this->admin_model->insert_csv($data);
            }
        }
    }

}
