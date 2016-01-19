<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MY_Controller {

    public $alertLabel = 'Doctor';

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

                $check_password = $this->User_model->password_status($this->session->userdata('VEEVA_Employee_ID'));

                if (is_null($check_password['password_status']) || $check_password['password_status'] == '') {
                    redirect('User/password', 'refresh');
                } else {
                    if ($check_password['Designation'] === 'ASM') {
                        redirect('ASM/dashboard', 'refresh');
                    } else {
                        redirect('User/dashboard', 'refresh');
                    }
                }
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
            if ($this->Product_Id == '-1' || $this->Product_Id == '') {
                $data['tab1'] = "";
            } else {
                $data['tab1'] = $this->User_model->generateTabs($this->VEEVA_Employee_ID, $this->Product_Id);
            }
            if ($this->input->post()) {
                $this->Product_Id = $this->input->post('Product_Id');
                $this->session->set_userdata('Product_Id', $this->input->post('Product_Id'));

                redirect('User/dashboard', 'refresh');
            }
            $month1 = date('n', strtotime('-1 month'));
            $month2 = date('n', strtotime('-2 month'));
            $month3 = date('n', strtotime('-3 month'));
            $month4 = date('n', strtotime('-4 month'));
            $current_month = date('n');
            $year1 = date('Y', strtotime('-1 month'));
            $year2 = date('Y', strtotime('-2 month'));
            $year3 = date('Y', strtotime('-3 month'));
            $year4 = date('Y', strtotime('-4 month'));
            $current_year = date('Y');

            $data['month1'] = $this->User_model->product_detail($this->VEEVA_Employee_ID, $this->Product_Id, $month1, $year1);
            $data['month2'] = $this->User_model->product_detail($this->VEEVA_Employee_ID, $this->Product_Id, $month2, $year2);
            $data['month3'] = $this->User_model->product_detail($this->VEEVA_Employee_ID, $this->Product_Id, $month3, $year3);
            $data['month4'] = $this->User_model->product_detail($this->VEEVA_Employee_ID, $this->Product_Id, $month4, $year4);

            $data['user1'] = $this->User_model->product_detail_user($this->VEEVA_Employee_ID, $this->Product_Id, $month1, $year1);
            $data['user2'] = $this->User_model->product_detail_user($this->VEEVA_Employee_ID, $this->Product_Id, $month2, $year2);
            $data['user3'] = $this->User_model->product_detail_user($this->VEEVA_Employee_ID, $this->Product_Id, $month3, $year3);
            $data['user4'] = $this->User_model->product_detail_user($this->VEEVA_Employee_ID, $this->Product_Id, $month4, $year4);
            $current_month_actual = $this->User_model->product_detail($this->VEEVA_Employee_ID, $this->Product_Id, $current_month, $current_year);
            $current_month_planned = $this->User_model->kpi($this->VEEVA_Employee_ID, $this->Product_Id, $current_month, $current_year);
            $activity_planned = $this->User_model->activity_planned($this->VEEVA_Employee_ID, $this->Product_Id);
            $activitya_actual = $this->User_model->activity_actual($this->VEEVA_Employee_ID, $this->Product_Id);
            if ($current_month_planned['planned_rx'] > 0) {
                $data['kpi1'] = ($current_month_actual['actual_rx'] / $current_month_planned['planned_rx']) * 100;
            } else {
                $data['kpi1'] = 0;
            }
            if ($activity_planned ['activity_planned'] > 0) {
                $data['kpi2'] = ($activitya_actual['activity_actual'] / $activity_planned ['activity_planned']) * 100;
            } else {
                $data['kpi2'] = 0;
            }

            $activity_planned = $this->User_model->activity_planned($this->VEEVA_Employee_ID, $this->Product_Id);
            $activity_actual = $this->User_model->activity_actual($this->VEEVA_Employee_ID, $this->Product_Id);
            $prio_dr = $this->User_model->prio_dr($this->VEEVA_Employee_ID, $this->Product_Id);
            if ($activity_planned["activity_planned"] > 0) {
                $data['tot'] = ($activity_actual['activity_actual'] / $activity_planned["activity_planned"]) * 100;
            } else {
                $data['tot'] = 0;
            }
            if ($this->Product_Id > 0) {
                $data['show4'] = $this->User_model->Rx_Target_month2($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id, $this->nextMonth);
                $data['Actual'] = $this->User_model->Actual_Rx_Count();
            }
            $target = isset($data['show4']['target']) && $data['show4']['Status'] == 'Submitted' ? $data['show4']['target'] : 0;
            $Actual = isset($data['Actual']['Actual_Rx']) ? $data['Actual']['Actual_Rx'] : 0;
            if ($target > 0) {
                $data['tot1'] = ($Actual / $target) * 100;
            } else {
                $data['tot1'] = 0;
            }
            $data['Product_Id'] = $this->Product_Id;

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

    public function Set_Target() {

        if ($this->Product_Id == 1) {
            $alertLabel = "Hospital";
        }
        $target = $this->User_model->Rx_Target_month2($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id, $this->nextMonth);
        $data['target'] = isset($target['target']) ? $target['target'] : 0;

        if ($this->input->post()) {
            $values = $this->input->post('value');
            $data1 = array(
                'target' => $values,
                'VEEVA_Employee_ID' => $this->session->userdata('VEEVA_Employee_ID'),
                'Product_Id' => $this->session->userdata('Product_Id'),
                'Month' => $this->nextMonth,
                'Year' => $this->nextYear,
                'created_at' => date('Y-m-d H:i:s'),
                'Status' => $this->input->post('Status'),
            );

            $check = $this->User_model->Set_Target_by_id($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id, $this->nextMonth);
            if (empty($check)) {
                $this->User_model->Set_Target($data1);
                $this->session->set_userdata('message', $this->Master_Model->DisplayAlert('No of New Rx Targeted for ' . date('M', strtotime($this->nextMonth)) . '' . $this->nextYear . ' has been saved successfully! Thank you!.', 'success'));
                redirect('User/dashboard', 'refresh');
            } elseif ($check['Status'] == 'Draft') {
                $this->User_model->Set_Target_update2($data1);
                $this->session->set_userdata('message', $this->Master_Model->DisplayAlert('No of New Rx Targeted for ' . date('M', strtotime($this->nextMonth)) . '' . $this->nextYear . ' has been set successfully! Thank you!', 'success'));
                redirect('User/dashboard', 'refresh');
            } else {
                $this->session->set_userdata('message', $this->Master_Model->DisplayAlert('No of New Rx Targeted for ' . date('M', strtotime($this->nextMonth)) . '  ' . $this->nextYear . ' is already submitted, cant overwrite it. Thank you!', 'danger'));
                redirect('User/dashboard', 'refresh');
            }
        }
        $month_start = date('n', strtotime('-4 month'));
        $month_mid = date('n', strtotime('-3 month'));
        $month_between = date('n', strtotime('-2 month'));
        $month_ends = date('n', strtotime('-1 month'));
        $current_month = date('n');
        $year = date('Y');
        $year = '2015';
        $data['Actual1'] = $this->User_model->Actual_Rx_Target_month($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id, $month_start, $year);
        $data['Actual2'] = $this->User_model->Actual_Rx_Target_month($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id, $month_mid, $year);
        $data['Actual3'] = $this->User_model->Actual_Rx_Target_month($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id, $month_between, $year);
        $data['Actual4'] = $this->User_model->Actual_Rx_Target_month($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id, $month_ends, $year);
        $data['date'] = date('M', strtotime('+1 month'));
        $data['month_mid'] = date('M', strtotime('-4 month'));
        $data['month_start'] = date('M', strtotime('-3 month'));
        $data['month_between'] = date('M', strtotime('-2 month'));
        $data['month_ends'] = date('M', strtotime('-1 month'));
        $data['current_month'] = date('M');
        $data['Product_Id'] = $this->Product_Id;

        $data = array('title' => 'Report', 'content' => 'User/addDelta', 'backUrl' => 'User/dashboard', 'view_data' => $data);
        $this->load->view('template2', $data);
    }

    public function Profiling() {

        if ($this->Product_Id == 1) {
            $this->alertLabel = "Hospital";
        }

        $messages = array();
        if ($this->is_logged_in()) {
            $result = $this->Doctor_Model->getDoctor($this->VEEVA_Employee_ID, $this->Individual_Type);

            if ($this->input->post()) {
                $_POST['VEEVA_Employee_ID'] = $this->VEEVA_Employee_ID;
                $_POST['Product_id'] = $this->Product_Id;
                $_POST['created_at'] = date('Y-m-d H:i:s');
                $_POST['Status'] = $this->input->post('Status');
                $_POST['Winability'] = $this->User_model->calcWinability($_POST['Win_Q1'], $_POST['Win_Q2'], $_POST['Win_Q3']);

                $check = $this->User_model->profiling_by_id($_POST['Doctor_id'], $_POST['VEEVA_Employee_ID'], $_POST['Product_id']);
                if (empty($check)) {
                    if ($this->Product_Id == 4 || $this->Product_Id == 6 || $this->Product_Id == 5) {
                        $_POST['Product_id'] = 4;
                        $this->db->insert('Profiling', $_POST);
                        $_POST['Product_id'] = 6;
                        $this->db->insert('Profiling', $_POST);
                        $_POST['Product_id'] = 5;
                        $this->db->insert('Profiling', $_POST);
                        $this->session->set_userdata('message', $this->Master_Model->DisplayAlert($this->alertLabel . ' Profile Added Successfully.', 'success'));
                        redirect('User/Profiling', 'refresh');
                    } else {
                        $this->db->insert('Profiling', $_POST);
                        $this->session->set_userdata('message', $this->Master_Model->DisplayAlert($this->alertLabel . ' Profile Added Successfully.', 'success'));
                        redirect('User/Profiling', 'refresh');
                    }
                } elseif ($check['Status'] == 'Draft') {
                    if ($this->Product_Id == 4 || $this->Product_Id == 6 || $this->Product_Id == 5) {
                        $_POST['Product_id'] = 4;
                        $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_id' => 4, 'Doctor_id' => $_POST['Doctor_id']));
                        $this->db->update('Profiling', $_POST);

                        $_POST['Product_id'] = 6;
                        $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_id' => 6, 'Doctor_id' => $_POST['Doctor_id']));
                        $this->db->update('Profiling', $_POST);
                        $_POST['Product_id'] = 5;
                        $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_id' => 6, 'Doctor_id' => $_POST['Doctor_id']));
                        $this->db->update('Profiling', $_POST);
                        $this->session->set_userdata('message', $this->Master_Model->DisplayAlert($this->alertLabel . ' Profile Updated Successfully.', 'success'));
                        redirect('User/Profiling', 'refresh');
                    } else {
                        $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_id' => $this->Product_Id, 'Doctor_id' => $_POST['Doctor_id']));
                        $this->db->update('Profiling', $_POST);
                        $this->session->set_userdata('message', $this->Master_Model->DisplayAlert($this->alertLabel . ' Profile Updated Successfully.', 'success'));
                        redirect('User/Profiling', 'refresh');
                    }
                } elseif ($check['Status'] == 'Submitted') {
                    $this->session->set_userdata('message', $this->Master_Model->DisplayAlert($this->alertLabel . ' Profile Already Submitted .', 'danger'));
                    redirect('User/Profiling', 'refresh');
                }
            }

            $data['Product_Id'] = $this->Product_Id;
            $data['doctorList'] = $this->Master_Model->generateDropdown($result, 'Account_ID', 'Account_Name');
            $data['questionList'] = $this->Master_Model->getQuestions($this->Product_Id);
            $data = array('title' => 'Question', 'content' => 'User/Question', 'backUrl' => 'User/dashboard', 'view_data' => $data);
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    public function Planning() {

        if ($this->Product_Id == 1) {
            $this->alertLabel = "Hospital";
        }
        $messages = array();
        if ($this->is_logged_in()) {
            $data['doctorList'] = $this->User_model->generatePlanningTab();
            // echo($data['doctorList']);
            if ($this->input->post()) {
                $currentPlanned = array_sum($this->input->post('value'));
                $currentPlanned = (int) $currentPlanned;
                $value = $this->input->post('value');
                $doc_id = $this->input->post('doc_id');
                //var_dump($doc_id);
                for ($i = 0; $i < count($this->input->post('value')); $i++) {

                    $result = $this->User_model->PlanningExist($doc_id[$i]);
                    //var_dump($result);
                    $current_date = date('Y-m-d');
                    $next_date = date('M');
                    $doc = array(
                        'Planned_Rx' => $value[$i],
                        'Year' => $this->nextYear,
                        'month' => $this->nextMonth,
                        $next_date => $value[$i],
                        'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID,
                        'Product_Id' => $this->Product_Id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'Doctor_Id' => $doc_id[$i],
                        'Planning_Status' => $this->input->post('Planning_Status'),
                        'Approve_Status' => $this->input->post('Approve_Status'),
                    );
                    if (empty($result)) {
                        if ($this->User_model->Save_Planning($doc)) {
                            array_push($messages, $this->Master_Model->DisplayAlert('The Planning for ' . date('M', strtotime($this->nextMonth)) . '' . $this->nextYear . ' has been saved successfully! Thank you!.', 'success'));
                        }
                    } elseif (isset($result->Planning_Status) && $result->Planning_Status == 'Draft') {
                        if ($result->Planned_Rx != $value[$i]) {
                            $doc['Approve_Status'] = 'SFA';
                        }
                        $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_Id' => $this->Product_Id, 'Doctor_Id' => $doc_id[$i]));
                        $this->db->update('Rx_Planning', $doc);
                        array_push($messages, $this->Master_Model->DisplayAlert('The Planning for ' . date('M', strtotime($this->nextMonth)) . '' . $this->nextYear . ' has been Updated successfully! Thank you!.', 'success'));
                    } elseif (isset($result->Planning_Status) && $result->Planning_Status == 'Submitted') {
                        array_push($messages, $this->Master_Model->DisplayAlert('The Planning for ' . date('M', strtotime($this->nextMonth)) . '' . $this->nextYear . ' Already Submitted ! Thank you!.', 'danger'));
                    }
                }
                if (!empty($messages)) {
                    $this->session->set_userdata('message', join(" ", array_unique($messages)));
                }
                redirect('User/dashboard', 'refresh');
            }


            $current_month = $this->nextMonth;
            $data['show4'] = $this->User_model->Rx_Target_month2($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id, $current_month);
            $data['expected'] = $this->User_model->Expected_Rx($this->VEEVA_Employee_ID, $this->Product_Id, $this->nextMonth);
            $data = array('title' => 'Planning', 'content' => 'User/doctorList', 'backUrl' => 'User/PlanMenu', 'view_data' => $data);
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    public function ActivityPlanning() {

        if ($this->Product_Id == 1) {
            $this->alertLabel = "Hospital";
        }
        $messages = array();
        $result = $this->User_model->getActivityDoctor();
        $data['doctorList'] = $this->User_model->generateActivityTable($result);

        if ($this->input->post()) {
            for ($i = 0; $i < count($this->input->post('Doctor_Id')); $i ++) {
                $docid = $this->input->post('Doctor_Id');
                $Activity = $this->input->post('Activity_Id');
                if (trim($Activity[$i]) != '') {
                    $data2 = array(
                        'Activity_Id' => $Activity[$i],
                        'Doctor_Id' => $docid[$i],
                        'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID,
                        'Product_Id' => $this->Product_Id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'Status' => $this->input->post('Status'),
                        'Year' => $this->nextYear,
                        'month' => $this->nextMonth
                    );

                    $result = $this->User_model->ActivityPlanned($docid[$i]);
                    if (empty($result)) {
                        if ($this->Product_Id == 4 || $this->Product_Id == 6) {
                            $data2['Product_Id'] = 4;
                            $this->db->insert('Activity_Planning', $data2);
                            $data2['Product_Id'] = 6;
                            $this->db->insert('Activity_Planning', $data2);
                            array_push($messages, $this->Master_Model->DisplayAlert('Activity Planned Successfully.', 'success'));
                        } else {
                            $this->db->insert('Activity_Planning', $data2);
                            array_push($messages, $this->Master_Model->DisplayAlert('Activity Planned Successfully.', 'success'));
                        }
                    } elseif (isset($result->Status) && $result->Status == 'Draft') {
                        if ($this->Product_Id == 4 || $this->Product_Id == 6) {
                            $data2['Product_Id'] = 4;
                            $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_Id' => 4, 'Doctor_Id' => $docid[$i], 'Year' => $this->nextYear, 'month' => $this->nextMonth));
                            $this->db->update('Activity_Planning', $data2);

                            $data2['Product_Id'] = 6;
                            $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_Id' => 6, 'Doctor_Id' => $docid[$i], 'Year' => $this->nextYear, 'month' => $this->nextMonth));
                            $this->db->update('Activity_Planning', $data2);
                            array_push($messages, $this->Master_Model->DisplayAlert('Activity Updated Successfully.', 'success'));
                        } else {
                            $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_Id' => $this->Product_Id, 'Doctor_Id' => $docid[$i], 'Year' => $this->nextYear, 'month' => $this->nextMonth));
                            $this->db->update('Activity_Planning', $data2);
                            array_push($messages, $this->Master_Model->DisplayAlert('Activity Updated Successfully.', 'success'));
                        }
                    } elseif (isset($result->Status) && $result->Status == 'Submitted') {
                        array_push($messages, $this->Master_Model->DisplayAlert('Data Already Submitted.', 'danger'));
                    }
                }
            }
            if (!empty($messages)) {
                $this->session->set_userdata('message', join(" ", array_unique($messages)));
            }
            redirect('User/dashboard', 'refresh');
        }

        $data = array('title' => 'Activity Planning', 'content' => 'User/Act_Plan', 'backUrl' => 'User/PlanMenu', 'view_data' => $data);
        $this->load->view('template2', $data);
    }

    public function PlanMenu() {
        if ($this->is_logged_in()) {
            $data['activity_planned'] = $this->User_model->activity_planned($this->VEEVA_Employee_ID, $this->Product_Id);
            $data['prio_dr'] = $this->User_model->prio_dr($this->VEEVA_Employee_ID, $this->Product_Id);
            $data = array('title' => 'Report', 'content' => 'User/PlanMenu', 'backUrl' => 'User/dashboard', 'view_data' => $data);
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    public function password() {
        if ($this->is_logged_in()) {
            if ($this->input->post()) {
                $password = $this->input->post('password');
                if (!empty($password)) {
                    $data = array(
                        'password' => $password,
                        'password_status' => 'Active',
                    );
                    $this->User_model->password($this->session->userdata('VEEVA_Employee_ID'), $data);
                    $check_password = $this->User_model->password_status($this->session->userdata('VEEVA_Employee_ID'));
                    if ($check_password['Designation'] == 'ASM') {
                        redirect('ASM/dashboard', 'refresh');
                    } else {
                        redirect('User/dashboard', 'refresh');
                    }
                }
            }
            $data = array('title' => 'Change Password', 'content' => 'User/password', 'view_data' => 'blank');
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    public function Reporting() {

        if ($this->Product_Id == 1) {
            $this->alertLabel = "Hospital";
        }
        $messages = array();
        $current_month = date('n');
        $data['show4'] = $this->User_model->Rx_Target_month2($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id, $current_month);
        if ($this->is_logged_in()) {
            $data['doctorList'] = $this->User_model->generatePlanningTab('Actual');
            if ($this->input->post()) {
                for ($i = 0; $i < count($this->input->post('value')); $i++) {
                    $value = $this->input->post('value');
                    $doc_id = $this->input->post('doc_id');
                    $current_date = date('Y-m-d');
                    $next_date = date('M');
                    $doc = array(
                        'Actual_Rx' => $value[$i],
                        'Year' => $this->nextYear,
                        'month' => $this->nextMonth,
                        $next_date => $value[$i],
                        'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID,
                        'Product_Id' => $this->Product_Id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'Doctor_Id' => $doc_id[$i],
                        'Status' => $this->input->post('Status')
                    );

                    $result = $this->User_model->ReportingExist($doc_id[$i]);
                    if (empty($result)) {
                        if ($this->User_model->SaveReporting($doc)) {
                            array_push($messages, $this->Master_Model->DisplayAlert('Reporting Data Added Successfully.', 'success'));
                        }
                    } else {
                        if (isset($result->Status) && $result->Status == 'Draft') {
                            if ($this->User_model->SaveReporting($doc)) {
                                array_push($messages, $this->Master_Model->DisplayAlert('Reporting Data Added Successfully.', 'success'));
                            }
                        } elseif (isset($result->Status) && $result->Status == 'Submitted') {
                            array_push($messages, $this->Master_Model->DisplayAlert('Reporting Data Already Submitted For ' . date('M', strtotime($this->nextMonth)) . '' . $this->nextYear, 'danger'));
                        }
                    }
                }
                if (!empty($messages)) {
                    $this->session->set_userdata('message', join(" ", array_unique($messages)));
                }
                redirect('User/dashboard', 'refresh');
            }

            //echo $data['doctorList'] ;

            $data = array('title' => 'Reporting Doctor', 'content' => 'User/Prescription_Doctor_List', 'backUrl' => 'User/dashboard', 'view_data' => $data);
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    public function Priority() {

        if ($this->Product_Id == 1) {
            $this->alertLabel = "Hospital";
        }
        $messages = array();
        $doctor_ids = $this->User_model->PriorityIds();
        //var_dump($doctor_ids);
        if (!empty($doctor_ids)) {
            $data['doctorList'] = $this->User_model->generatePlanningTab('Planning', 'true', $doctor_ids);
        }

        if ($this->input->post()) {
            for ($i = 0; $i < count($this->input->post('priority')); $i++) {

                $priority = $this->input->post('priority');
                $result = $this->User_model->ActualPriorityExist($priority[$i]);
                $data2 = array(
                    'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID,
                    'Product_Id' => $this->Product_Id,
                    'month' => $this->nextMonth,
                    'Doctor_Id' => $priority[$i],
                    'Status' => $this->input->post('Status')
                );
                if (empty($result)) {
                    $this->db->insert('Actual_Doctor_Priority', $data2);
                    array_push($messages, $this->Master_Model->DisplayAlert($this->alertLabel . ' Priority Added .', 'success'));
                } elseif ($result['Status'] == 'Draft') {
                    $this->db->where(array('VEEVA_Employee_Id' => $this->VEEVA_Employee_ID, 'Product_Id' => $this->Product_Id, 'month' => $this->nextMonth, 'Doctor_Id' => $priority[$i]));
                    $this->db->update('Actual_Doctor_Priority', $data2);
                    array_push($messages, $this->Master_Model->DisplayAlert($this->alertLabel . ' Priority Updated .', 'success'));
                } elseif ($result['Status'] == 'Submitted') {
                    array_push($messages, $this->Master_Model->DisplayAlert($this->alertLabel . ' Priority Already Submitted .', 'danger'));
                }
            }
            if (!empty($messages)) {
                $this->session->set_userdata('message', join(" ", array_unique($messages)));
            }
            redirect('User/dashboard', 'refresh');
        }

        $data = array('title' => 'Set Priority', 'content' => 'User/Priority', 'backUrl' => 'User/dashboard', 'view_data' => $data);
        $this->load->view('template2', $data);
    }

    public function ActivityReporting() {

        if ($this->Product_Id == 1) {
            $this->alertLabel = "Hospital";
        }
        $messages = array();
        $result = $this->User_model->getPlannedActivityDoctor();
        $data['doctorList'] = $this->User_model->generateActivityTable($result, 'Reporting');
        if ($this->input->post()) {
            for ($i = 0; $i < count($this->input->post('Doctor_Id')); $i ++) {
                $docid = $this->input->post('Doctor_Id');
                $Activity = $this->input->post('Activity_Id');
                $Activity_Detail = $this->input->post('Activity_Detail');
                $Reason = $this->input->post('Reason');
                if (trim($Activity[$i]) != '-1') {
                    $data2 = array(
                        'Activity_Id' => $Activity[$i],
                        'Doctor_Id' => $docid[$i],
                        'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID,
                        'Activity_Detail' => $Activity_Detail[$i],
                        'Reason' => $Reason[$i],
                        'Product_Id' => $this->Product_Id,
                        'Status' => $this->input->post('Status'),
                        'Year' => $this->nextYear,
                        'month' => $this->nextMonth,
                        'Activity_Done' => $this->input->post($docid[$i])
                    );

                    $result = $this->User_model->ActivityReportingExist($docid[$i]);
                    if (empty($result)) {
                        $data2['created_at'] = date('Y-m-d H:i:s');
                        if ($this->Product_Id == 4 || $this->Product_Id == 6) {
                            $data2['Product_Id'] = 4;
                            $this->db->insert('Activity_Reporting', $data2);
                            $data2['Product_Id'] = 6;
                            $this->db->insert('Activity_Reporting', $data2);
                            array_push($messages, $this->Master_Model->DisplayAlert('Activity Added Successfully.', 'success'));
                        } else {
                            $this->db->insert('Activity_Reporting', $data2);
                            array_push($messages, $this->Master_Model->DisplayAlert('Activity Added Successfully.', 'success'));
                        }
                    } elseif (isset($result->Status) && $result->Status == 'Draft') {
                        $data2['updated_at'] = date('Y-m-d H:i:s');
                        if ($this->Product_Id == 4 || $this->Product_Id == 6) {
                            $data2['Product_Id'] = 4;
                            $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_Id' => 4, 'Doctor_Id' => $docid[$i], 'Year' => $this->nextYear, 'month' => $this->nextMonth));
                            $this->db->update('Activity_Reporting', $data2);
                            $data2['Product_Id'] = 6;
                            $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_Id' => 6, 'Doctor_Id' => $docid[$i], 'Year' => $this->nextYear, 'month' => $this->nextMonth));
                            $this->db->update('Activity_Reporting', $data2);
                            array_push($messages, $this->Master_Model->DisplayAlert('Activities Updated Successfully.', 'success'));
                        } else {
                            $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_Id' => $this->Product_Id, 'Doctor_Id' => $docid[$i], 'Year' => $this->nextYear, 'month' => $this->nextMonth));
                            $this->db->update('Activity_Reporting', $data2);
                            array_push($messages, $this->Master_Model->DisplayAlert('Activities Updated Successfully.', 'success'));
                        }
                    } elseif (isset($result->Status) && $result->Status == 'Submitted') {
                        array_push($messages, $this->Master_Model->DisplayAlert('Activity Reporting Already Submitted For ' . date('M', strtotime($this->nextMonth)) . '' . $this->nextYear, 'danger'));
                    }
                }
            }
            if (!empty($messages)) {
                $this->session->set_userdata('message', join(" ", array_unique($messages)));
            }
            redirect('User/dashboard', 'refresh');
        }
        $data = array('title' => 'Activity Planning', 'content' => 'User/Act_Report', 'backUrl' => 'User/dashboard', 'view_data' => $data);
        $this->load->view('template2', $data);
    }

    public function getProfilingData() {
        $Doctor_Id = $this->input->post('Doctor_Id');
        $ProfilingDetails = $this->User_model->profiling_by_id($Doctor_Id, $this->VEEVA_Employee_ID, $this->Product_Id);

        if (!empty($ProfilingDetails)) {
            echo json_encode($ProfilingDetails);
        } else {
            echo '404';
        }
    }

    public function generatePriority() {
        if ($this->input->post()) {
            // if (empty($result)) {
            $currentPlanned = array_sum($this->input->post('value'));
            $currentPlanned = (int) $currentPlanned;
            for ($i = 0; $i < count($this->input->post('value')); $i++) {

                $value = $this->input->post('value');
                $doc_id = $this->input->post('doc_id');

                $result = $this->User_model->PriorityExist($doc_id[$i]);
                $month = date('n', strtotime('-1 month'));
                $month3 = $this->User_model->getMonthwiseRx($doc_id[$i], $month);
                $month3rx = isset($month3->Actual_Rx) ? $month3->Actual_Rx : 0;
                if ($currentPlanned > 0) {
                    $currentDependancy = round(($value[$i] / $currentPlanned) * 100, 0, PHP_ROUND_HALF_EVEN);
                } else {
                    $currentDependancy = 0;
                }

                $data2 = array('Delta' => $value[$i] - $month3rx, 'Dependancy' => $currentDependancy, 'Doctor_Id' => $doc_id[$i], 'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'month' => $this->nextMonth, 'Product_Id' => $this->Product_Id, 'Planned_Rx' => $value[$i]);

                if (empty($result)) {
                    $this->db->insert('Doctor_Priority', $data2);
                    $this->message = $this->Master_Model->DisplayAlert('Doctor Priority ' . date('M', strtotime($this->nextMonth)) . '' . $this->nextYear . ' has been saved successfully! Thank you!.', 'success');
                } else {
                    $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_id' => $this->Product_Id, 'Doctor_id' => $doc_id[$i]));
                    $this->db->update('Doctor_Priority', $data2);
                    $this->message = $this->Master_Model->DisplayAlert('Doctor Priority ' . date('M', strtotime($this->nextMonth)) . '' . $this->nextYear . ' has been Updated successfully! Thank you!.', 'success');
                }
            }
            redirect('User/priority', 'refresh');
        }
    }

    public function BDM_update() {
        if ($this->is_logged_in()) {
            if ($this->input->post()) {
                $number = $this->input->post('mobile');

                $mobile = array('Mobile' => $number);
                $mob = $this->User_model->Update_mobile($this->VEEVA_Employee_ID, $mobile);
                $data['error'] = "Successfully Updated";
            }
            $data['detail'] = $this->User_model->All_data($this->VEEVA_Employee_ID);
            $data = array('title' => 'Profile Update', 'content' => 'User/Profile_Update', 'view_data' => $data);
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    public function pwd_update() {
        if ($this->is_logged_in()) {
            if ($this->input->post()) {

                $old = $this->input->post('old');
                $new = $this->input->post('new');
                $pass = $this->User_model->All_data($this->VEEVA_Employee_ID);
                if (!empty($pass)) {
                    if ($old == $pass['password']) {
                        $mobile = array('password' => $new);
                        $mob = $this->User_model->Update_mobile($this->VEEVA_Employee_ID, $mobile);
                        $data['error'] = "Successfully Updated";
                    } else {
                        $data['error'] = "Old Password Not Matched";
                    }
                }
            }

            $data['detail'] = $this->User_model->All_data($this->VEEVA_Employee_ID);
            $data = array('title' => 'Profile Update', 'content' => 'User/Profile_Update', 'view_data' => $data);
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

}
