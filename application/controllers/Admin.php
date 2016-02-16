<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->helper();
        $this->load->library('Csvimport');
        $this->load->helper("url");
        $this->load->model('admin_model');
        $this->load->model('Master_Model');
        $this->load->library('grocery_CRUD');
        $this->nextMonth = date('m');
        $this->nextYear = date('Y');
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
        $data['productlist'] = $this->admin_model->show_pro_list();

        $data['Doctor_Count'] = $this->admin_model->count();
        //$data['Doctor_Count'] = $this->admin_model->count_planned($this->nextMonth, $this->nextYear);
        $data['Actual_Count'] = $this->admin_model->count_achive($this->nextMonth, $this->nextYear);
        $data['Target_Count'] = $this->admin_model->total_target($this->nextMonth, $this->nextYear);
        $data['Con_Count'] = $this->admin_model->total_convertion();
        
////        $data['Doctor_Count'] = isset($doctor_count['COUNT']) ? $doctor_count['COUNT'] : 0;
//        $data['Planning_Count'] = isset($doctor_count['TOTAL']) ? $doctor_count['TOTAL'] : 0;
//        $data['Actual_Count'] = isset($doctor_count['TOTAL']) ? $doctor_count['TOTAL'] : 0;
        /*       $data['Doctor_Count'] = $this->admin_model->count();
          
          $data['Actual_Count'] = $this->admin_model->count_achive();
          
          $data['Planning_Count'] = $this->admin_model->count_planned();
          $division = 'Diabetes';
          $division1 = 'ThromBI';
          //        $month = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12');
          $data['count_achive_month'] = $this->admin_model->count_achive_month();
          $data['plan_month'] = $this->admin_model->count_planned_month();

          $data['dr_by_product'] = $this->admin_model->dr_by_product($division);
          $data['Over_all_count'] = $this->admin_model->Over_all_count();
          $data['profiling_by_product1'] = $this->admin_model->profiling_by_product(1);

          $data['profiling_by_product2'] = $this->admin_model->profiling_by_product(2);
          $data['profiling_by_product3'] = $this->admin_model->profiling_by_product(3);
          if ($data['profiling_by_product1']['profiling_by_product'] > 0) {
          $data['tot1'] = ($data['Over_all_count']['over_all'] / $data['profiling_by_product1']['profiling_by_product']) * 100;
          } else {
          $data['tot1'] = 0;
          }
          if ($data['profiling_by_product2']['profiling_by_product'] > 0) {
          $data['tot2'] = ($data['Over_all_count']['over_all'] / $data['profiling_by_product2']['profiling_by_product']) * 100;
          } else {
          $data['tot2'] = 0;
          }
          if ($data['profiling_by_product3']['profiling_by_product'] > 0) {
          $data['tot3'] = ($data['Over_all_count']['over_all'] / $data['profiling_by_product3']['profiling_by_product']) * 100;
          } else {
          $data['tot3'] = 0;
          }
          $data['total_target_by_product1'] = $this->admin_model->total_target_by_product(1);
          $data['total_target_by_product2'] = $this->admin_model->total_target_by_product(2);
          $data['total_target_by_product3'] = $this->admin_model->total_target_by_product(3);
          $data['total_actualrx_by_product1'] = $this->admin_model->total_actualrx_by_product(1);
          $data['total_actualrx_by_product2'] = $this->admin_model->total_actualrx_by_product(2);
          $data['total_actualrx_by_product3'] = $this->admin_model->total_actualrx_by_product(3);
          $data['total_convertion_by_product1'] = $this->admin_model->total_convertion_by_product(1);
          $data['total_convertion_by_product2'] = $this->admin_model->total_convertion_by_product(2);
          $data['total_convertion_by_product3'] = $this->admin_model->total_convertion_by_product(3);
          $data = array('title' => 'Dashboard', 'content' => 'admin/dashboard', 'page_title' => 'Dashboard', 'view_data' => $data);
          $this->load->view('template3', $data); */

        //}
        $data = array('title' => 'Dashboard', 'content' => 'admin/dashboard', 'page_title' => 'Dashboard', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function emp_view() {
        $data['show'] = $this->admin_model->emp_view();
        $result = $this->admin_model->find_zone();
        $data['zone'] = $this->Master_Model->generateDropdown($result, 'Zone', 'Zone');
        if ($this->input->get()) {
            $id = $this->input->get('id');
            $data['show'] = $this->admin_model->zone_data($id);
        }
        $data = array('title' => 'Employee View', 'content' => 'admin/add_emp', 'page_title' => ' Employeee Master', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function emp_Doc() {
        $id = $_GET['id'];
        $data['show'] = $this->admin_model->emp_doc($id);

        $data = array('title' => 'Doctor List', 'content' => 'admin/emp_doc', 'page_title' => 'Doctor LIST', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function bdm_wise() {
        $data['show'] = $this->admin_model->BDM_show();

        $data = array('title' => 'Employee View', 'content' => 'admin/bdm_wise', 'page_title' => 'Employee Master', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function logout() {
        redirect('admin/index', 'refresh');
    }

    public function territory_view() {
        $data['show'] = $this->admin_model->territory();

        $data = array('title' => ' Territory View', 'content' => 'admin/territory', 'page_title' => 'Territory Master', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function territory_add() {
        if ($_POST) {
            $name = $this->input->post('territory');
            $vaild = $this->admin_model->territory_view($name);

            if (empty($vaild)) {
                $data = array('Territory' => $name, 'status' => 1);
                $this->admin_model->insert_territory($data);


                redirect('admin/territory_view', 'refresh');
            } else {
                redirect('admin/territory_view', 'refresh');
                $this->session->set_userdata('message', $this->Master_Model->DisplayAlert('Already Exit', 'error'));
            }
        }
    }

    public function update_terr() {
        $id = $_GET['id'];
        $data['rows'] = $this->admin_model->find_by_terrid($id);
        if ($this->input->post()) {
            $terrid = $this->input->post('terrid');
            $data = array(
                'territory' => $this->input->post('territory'),
                'status' => '1',
            );
            $this->admin_model->update_terr($terrid, $data);
            redirect('admin/territory_view', 'refresh');
        }

        $data = array('title' => 'Upadte Activity', 'content' => 'admin/edit_terr', 'page_title' => 'Update Territory', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function terr_del() {
        $id = $_GET['id'];
        $data = array('status' => 0);
        $this->admin_model->del_terr($id, $data);

        redirect('admin/territory_view', 'refresh');
        $this->session->set_userdata('message', $this->Master_Model->DisplayAlert('Delete Successfully', 'success'));
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
                'Username' => $this->input->post('Email_ID'),
                'Password' => $this->input->post('First_Name') . '@bi',
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
            redirect('admin/emp_view', 'refresh');
        }
        $result = $this->admin_model->find_Designation();
        $data['Designation'] = $this->Master_Model->generateDropdown($result, 'Designation', 'Designation');
        $result = $this->admin_model->find_territory();
        $data['Territory'] = $this->Master_Model->generateDropdown($result, 'id', 'Territory');
        $result = $this->admin_model->find_Division();
        $data['Division'] = $this->Master_Model->generateDropdown($result, 'Division', 'Division');
        $result = $this->admin_model->find_zone();
        $data['zone'] = $this->Master_Model->generateDropdown($result, 'Zone', 'Zone');
        $result = $this->admin_model->find_region();
        $data['region'] = $this->Master_Model->generateDropdown($result, 'Region', 'Region');
        $result = $this->admin_model->reporting_to($this->input->post('Profile'));
        $data['Reporting_To'] = $this->Master_Model->generateDropdown($result, 'Reporting_To', 'Reporting_To');
        $result = $this->admin_model->find_Profile();
        $data['Profile'] = $this->Master_Model->generateDropdown($result, 'Profile', 'Profile');
        $data['Reporting_id'] = $this->admin_model->reporting_id($this->input->post('Reporting_To'));
        $data = array('title' => 'Add Employee', 'content' => 'admin/emp_add', 'page_title' => 'Add Employee', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function ajax_data() {
        $result = $this->admin_model->reporting_to($this->input->post('profile'));
        $data = $this->Master_Model->generateDropdown($result, 'Reporting_To', 'Reporting_To');
        echo $data;
    }

    public function update_emp() {
        $id = $_GET['id'];
        $data['rows'] = $this->admin_model->find_by_empid($id);
        $result = $this->admin_model->find_zone();
        $data['zone'] = $this->Master_Model->generateDropdown($result, 'Zone', 'Zone', $data['rows']['Zone']);
        $result = $this->admin_model->find_region();
        $data['region'] = $this->Master_Model->generateDropdown($result, 'Region', 'Region', $data['rows']['Region']);
        $result = $this->admin_model->find_territory();
        $data['Territory'] = $this->Master_Model->generateDropdown($result, 'Territory', 'Territory', $data['rows']['Territory']);
        $result = $this->admin_model->find_Designation();
        $data['Designation'] = $this->Master_Model->generateDropdown($result, 'Designation', 'Designation', $data['rows']['Designation']);
        $result = $this->admin_model->find_Division();
        $data['Division'] = $this->Master_Model->generateDropdown($result, 'Division', 'Division', $data['rows']['Division']);
        $result = $this->admin_model->find_Profile();
        $data['Profile'] = $this->Master_Model->generateDropdown($result, 'Profile', 'Profile', $data['rows']['Profile']);
        $result = $this->admin_model->find_REPORTING_TO();
        $data['Reporting_To'] = $this->Master_Model->generateDropdown($result, 'Reporting_To', 'Reporting_To', $data['rows']['Reporting_To']);
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
            redirect('admin/emp_view', 'refresh');
        }


        $data = array('title' => 'Update Employee', 'content' => 'admin/update_emp', 'page_title' => 'Update Employee', 'view_data' => $data);
        $this->load->view('template3', $data);

//        $data = array('title' => 'Login', 'content' => 'admin/update_emp', 'view_data' => $data);
//        $this->load->view('admin/update_emp', $data);
    }

    public function get_record() {


        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->admin_model->find_REPORTING_TO_VALUE($name)));
    }

    public function emp_del() {
        $id = $_GET['id'];
        $data = array('status' => 0);
        $this->admin_model->del_emp($id, $data);
        redirect('admin/emp_view', 'refresh');
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
        $data = array('title' => 'View_Activity', 'content' => 'admin/activity_view', 'page_title' => 'Activity Master', 'view_data' => $data);
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
            redirect('admin/view_activity', 'refresh');
        }

        $data = array('title' => 'Upadte Activity', 'content' => 'admin/update_activity', 'page_title' => 'Update Activity', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function profile_view() {
        if (isset($_POST['tab1'])) {
            $this->load->admin_model->Tab1();
            redirect('admin/profile_view', 'refresh');
        }
        $data['show'] = $this->admin_model->view_profile_controller();

        $data = array('title' => 'Control Access', 'content' => 'admin/profile_controller', 'page_title' => 'Control Access', 'view_data' => $data);
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
        require_once( APPPATH . 'libraries/Autopaginate.php' );
        $page = isset($_GET['page']) && !empty($_GET['page']) ? (int) $_GET['page'] : 1;

        $per_page = 100;
        $HTML = "";
        $total_count = $this->admin_model->doc_count();
        $pagination = new Autopaginate($page, $per_page, $total_count->Account_Id);
        $HTML = $pagination->renderPaging('doc_view', $page);
        $data['html'] = $HTML;
        $data["show"] = $this->admin_model->doc_view($per_page, $pagination->offset());
        $data = array('title' => 'Doctor', 'content' => 'admin/doctor_view', 'page_title' => 'Doctor Master', 'view_data' => $data);
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
        $data = array('title' => 'View_Employee', 'content' => 'admin/emp_csv', 'page_title' => 'Import FILES', 'view_data' => 'blank');
        $this->load->view('template3', $data);

        if ($this->input->post()) {

            $fp = fopen($_FILES['csv']['tmp_name'], 'r+');
            $count = 0;
            while (($row = fgetcsv($fp, "500", ",")) != FALSE) {


                $count++;
                if ($count == 1) {
                    continue;
                }

                $check['show'] = $this->admin_model->emp_duplicate($row['0']);
//                var_dump($check);
                if (!empty($check) && $check != '') {
                    $data = array(
                        'VEEVA_Employee_ID' => $row['0'],
                        'Local_Employee_ID' => $row['1'],
                        'First_Name' => $row['2'],
                        'Last_Name' => $row['3'],
                        'Full_Name' => $row['4'],
                        'Territory' => $row['5'],
                        'Gender' => $row['6'],
                        'Mobile' => $row['7'],
                        'Email_ID' => $row['8'],
                        'Username' => $row['9'],
                        'Password' => $row['10'],
                        'Last_Login' => $row['11'],
                        'Address_1' => $row['12'],
                        'Address_2' => $row['13'],
                        'City' => $row['14'],
                        'State' => $row['15'],
                        'Division' => $row['16'],
                        'Zone' => $row['17'],
                        'Region' => $row['18'],
                        'Profile' => $row['19'],
                        'Designation' => $row['20'],
                        'Created_By' => 'System',
                        'created_date' => date('Y-m-d'),
                        'Modified_By' => $row['23'],
                        'Modified_Date' => $row['24'],
                        'Reporting_To' => $row['25'],
                        'Reporting_VEEVA_ID' => $row['26'],
                        'Reporting_Local_ID' => $row['27'],
                        'Status' => '1',
                    );

                    $sql = $this->admin_model->insert_csv($data);
                }


//insert csv data into mysql table
            }
        }
    }

//
    public function doc_csv() {
        $data = array('title' => 'Import ', 'content' => 'admin/emp_csv', 'page_title' => 'Import csv', 'view_data' => 'blank');
        $this->load->view('template3', $data);

        if ($this->input->post()) {
            $fp = fopen($_FILES['csv']['tmp_name'], 'r+');
            $count = 0;
            while (($row = fgetcsv($fp, "5000", ",")) != FALSE) {
                $count++;
                if ($count == 1) {
                    continue;
                }
//
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
                    'Address' => $row['21']
                );
//                $data = array(
//                    'Account_ID' => $row['5'],
//                    'Account_Name' => $row['4'],
//                    'Individual_Type' => $row['7'],
//                    'Status' => $row['8'],
//                    'City' => $row['2'],
//                    'State' => $row['1'],
//                    'Address' => $row['6'],
//                );
//insert csv data into mysql table
                $sql = $this->admin_model->insert_csv_doc($data);
            }
        }
    }

    public function add_doc() {
        if ($_POST) {
            $data = array(
                'Account_ID' => $this->input->post('Account_ID'),
                'Salutation' => $this->input->post('Salutation'),
                'First_Name' => $this->input->post('First_Name'),
                'Last_Name' => $this->input->post('Last_Name'),
                'Account_Name' => $this->input->post('Account_Name'),
                'Specialty' => $this->input->post('Specialty'),
                'Specialty_2' => $this->input->post('Specialty_2'),
                'Specialty_3' => $this->input->post('Specialty_3'),
                'Specialty_4' => $this->input->post('Specialty_4'),
                'Individual_Type' => $this->input->post('Individual_Type'),
                'Email' => $this->input->post('Email'),
                'Gender' => $this->input->post('Gender'),
                'Mobile' => $this->input->post('Mobile'),
                'Status' => $this->input->post('Status'),
                'Created_Date' => $this->input->post('Activity_Name'),
                'Created_By' => $this->input->post('Activity_Name'),
                'Modified_Date' => $this->input->post('Activity_Name'),
                'Modified_By' => $this->input->post('Activity_Name'),
                'City' => $this->input->post('City'),
                'State' => $this->input->post('State'),
                'Pin_Code' => $this->input->post('Pin_Code'),
                'Address' => $this->input->post('Address')
            );
            $this->admin_model->insert_activity($data);
            redirect('admin/view_activity', 'refresh');
        }

        $data = array('title' => 'Login', 'content' => 'admin/', 'page_title' => 'Add Activity', 'view_data' => 'blank');
        $this->load->view('template3', $data);
    }

    public function doc_del() {
        $id = $_GET['id'];
        $data = array('status' => 0);
        $this->admin_model->del_act($id, $data);
        redirect('admin/doc_view', 'refresh');
    }

    public function update_doc() {
        $id = $_GET['id'];
        $data['rows'] = $this->admin_model->find_by_docid($id);
        if ($this->input->post()) {
            $actid = $this->input->post('Act_id');
            $data = array(
                'Account_ID' => $this->input->post('Account_ID'),
                'Salutation' => $this->input->post('Salutation'),
                'First_Name' => $this->input->post('First_Name'),
                'Last_Name' => $this->input->post('Last_Name'),
                'Account_Name' => $this->input->post('Account_Name'),
                'Specialty' => $this->input->post('Specialty'),
                'Specialty_2' => $this->input->post('Specialty_2'),
                'Specialty_3' => $this->input->post('Specialty_3'),
                'Specialty_4' => $this->input->post('Specialty_4'),
                'Individual_Type' => $this->input->post('Individual_Type'),
                'Email' => $this->input->post('Email'),
                'Gender' => $this->input->post('Gender'),
                'Mobile' => $this->input->post('Mobile'),
                'Status' => $this->input->post('Status'),
                'Created_Date' => $this->input->post('Activity_Name'),
                'Created_By' => $this->input->post('Activity_Name'),
                'Modified_Date' => $this->input->post('Activity_Name'),
                'Modified_By' => $this->input->post('Activity_Name'),
                'City' => $this->input->post('City'),
                'State' => $this->input->post('State'),
                'Pin_Code' => $this->input->post('Pin_Code'),
                'Address' => $this->input->post('Address'),
            );

            $this->admin_model->update_act($actid, $data);
            redirect('admin/update_act', 'refresh');
        }

        $data = array('title' => 'Upadte Activity', 'content' => 'admin/', 'page_title' => 'Update Activity', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function control_access() {
        
    }

    public function empdoc_csv() {
        $data = array('title' => 'View_Employee', 'content' => 'admin/emp_csv', 'page_title' => 'Import FILES', 'view_data' => 'blank');
        $this->load->view('template3', $data);

        if ($this->input->post()) {

            $fp = fopen($_FILES['csv']['tmp_name'], 'r+');
            $count = 0;
            while (($row = fgetcsv($fp, "500", ",")) != FALSE) {


                $count++;
                if ($count == 1) {
                    continue;
                }

//                var_dump($check);

                $data = array(
                    'Local_Employee_ID' => $row['1'],
                    'VEEVA_Employee_ID' => $row['2'],
                    'Employee_Name' => $row['3'],
                    'VEEVA_Account_ID' => $row['4'],
                    'Account_Name' => $row['5'],
                    'SAP_ID' => $row['10'],
                    'Status' => 'Active',
                    'Specialty' => $row['7'],
                );

                $sql = $this->admin_model->insert_empdoc_csv($data);
            }
        }
    }

    public function hospital_csv() {
        $data = array('title' => 'View_Employee', 'content' => 'admin/emp_csv', 'page_title' => 'Import FILES', 'view_data' => 'blank');
        $this->load->view('template3', $data);

        if ($this->input->post()) {

            $fp = fopen($_FILES['csv']['tmp_name'], 'r+');
            $count = 0;
            while (($row = fgetcsv($fp, "500", ",")) != FALSE) {


                $count++;
                if ($count == 1) {
                    continue;
                }


//                var_dump($check);

                $data = array(
                    'NEWS_region' => $row['1'],
                    'VEEVA_Employee_ID' => $row['2'],
                    'Employee_Name' => $row['3'],
                    'VEEVA_Account_ID' => $row['4'],
                    'Account_Name' => $row['5'],
                    'SAP_ID' => $row['10'],
                    'Status' => 'Active',
                    'Specialty' => $row['7'],
                );

                $sql = $this->admin_model->insert_hospital($data);
            }
        }
    }

    public function tab_csv() {
        $data = array('title' => 'View_Employee', 'content' => 'admin/emp_csv', 'page_title' => 'Import FILES', 'view_data' => 'blank');
        $this->load->view('template3', $data);

        if ($this->input->post()) {

            $fp = fopen($_FILES['csv']['tmp_name'], 'r+');
            $count = 0;
            while (($row = fgetcsv($fp, "500", ",")) != FALSE) {


                $count++;
                if ($count == 1) {
                    continue;
                }


//                var_dump($check);

                $data = array(
                    'VEEVA_Employee_ID' => $row['0'],
                );

                $sql = $this->admin_model->insert_tab($data);



//insert csv data into mysql table
            }
        }
    }

    public function unlocked_employee() {
        $data['unlock'] = $this->admin_model->bdm_unlocked_list();

        $data = array('title' => 'Block Accounts', 'content' => 'admin/bdm_unlocked', 'page_title' => 'Block Accounts', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function unlock_account() {

        $id = $_GET['id'];
        $this->db->where('VEEVA_Employee_ID', $id);
        $this->db->delete('password_count');
        $data = array('status' => 1);
        $this->admin_model->del_emp($id, $data);
        redirect('admin/unlocked_employee', 'refresh');
    }

    public function asm_target() {
        $data['show'] = $this->admin_model->target_view();

        $data = array('title' => 'Employee View', 'content' => 'admin/target_view', 'page_title' => 'ASM List', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function asm_target_by_bdm() {
        $id = $_GET['id'];
        $check = $this->admin_model->ASM_division($id);

        $data['show'] = $this->admin_model->ASM_division($id);
        if (!empty($check)) {
            if ($data['show'] == 'Diabetes') {
                $data['table'] = $this->admin_model->ASm_view($id);
                $data['ck'] = "Diabetes";
            } else {
                $data['table'] = $this->admin_model->ASm_view($id);
                $data['ck'] = "Thrombi";
            }
        }

        $data = array('title' => 'Employee View', 'content' => 'admin/target_bdm', 'page_title' => 'Target ', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function Reset_Target() {
        $id = $_GET['id'];
        $data = array('status' => 'Draft');
        $this->admin_model->reset_target($id, $data);

        redirect('admin/asm_target', 'refresh');
    }

    public function login_history() {

        $data['show'] = $this->admin_model->login_history();
        $data = array('title' => 'Login_History', 'content' => 'admin/login_history', 'page_title' => 'Login History ', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function reporting_change() {
        $data[] = array();

        if ($this->input->get()) {
            $id = $this->input->get('id');
            $data['rows'] = $this->admin_model->find_by_empid($id);
            $data['show'] = $this->admin_model->reporting_view2($id);
            $result = $this->admin_model->find_Profile();
            $data['Profile'] = $this->Master_Model->generateDropdown($result, 'Profile', 'Profile', $data['rows'] ['Profile']);
            $result = $this->admin_model->find_REPORTING_TO();
            $data['Reporting_To'] = $this->Master_Model->generateDropdown($result, 'Reporting_To', 'Reporting_To', $data['rows'] ['Reporting_To']);
        }
        $data = array('title' => ' Reporting', 'content' => 'admin/reporting_change', 'page_title' => 'Reporting Change', 'view_data' => $data);
        $this->load->view('template3', $data);
    }

    public function change_profile() {
        $id = $this->input->post('veeva_id');
        $profile = $this->input->post('Profile');
        $Reporting_To = $this->input->post('Reporting_To');
        $reporting_id = $this->input->post('reporting_veeva_id');
        if ($this->input->post()) {
        $data = array('Profile' => $profile,
            'Reporting_To' => $Reporting_To,
            'Reporting_VEEVA_ID' => $reporting_id,
            'Designation'=>$Reporting_To);
        $this->admin_model->reporting_change($id, $data);
        redirect('admin/reporting_change', 'refresh');
    }
    }
 public function Target_assign(){
     $data['show']=$this->admin_model->target_assign();
    
        $data = array('title' => 'Target_Assign', 'content' => 'admin/target_assign', 'page_title' => 'Target_Assign', 'view_data' => $data);
        $this->load->view('template3', $data);
 }
}
