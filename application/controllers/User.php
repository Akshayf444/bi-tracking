<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MY_Controller {

    public $alertLabel = 'Doctor';
    public $doctorIds = array();

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

        $this->nextMonth = date('m');
        $this->nextYear = date('Y');
    }

    public function index() {
        $data = array();
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $check = $this->User_model->authentication($username, $password);
            if (empty($check)) {
                $emp = $this->User_model->employee_id($username);
                if (isset($emp['VEEVA_Employee_ID'])) {
                    $count = $this->User_model->password_count($emp['VEEVA_Employee_ID']);
                    if ($count['cnt'] > 4) {
                        $data1 = array(
                            'Status' => 'locked',
                        );
                        $this->User_model->update_status($username, $data1);
                        $data['message'] = 'Your Account Has Been Locked';
                        $this->session->set_userdata('message', $this->Master_Model->DisplayAlert('Your Account Has Been Locked', 'danger'));
                    } else {
                        $lastFailed_attempt = $this->User_model->lastFailedAttempt($emp['VEEVA_Employee_ID']);
                        if (!empty($lastFailed_attempt)) {
                            $current_date = date('Y-m-d H:i:s');
                            $current_date = strtotime($current_date);
                            $lastAttemptDate = strtotime($lastFailed_attempt->created_at);

                            if (($current_date - $lastAttemptDate) > 3600) {
                                $data1 = array(
                                    'Status' => '1',
                                );
                                $this->User_model->update_status($username, $data1);
                                $add = array(
                                    'VEEVA_Employee_ID' => $emp['VEEVA_Employee_ID'],
                                    'password' => $password,
                                    'created_at' => date('Y-m-d H:i:s'),
                                );
                                $this->User_model->password_save($add);
                                $this->session->set_userdata('message', $this->Master_Model->DisplayAlert('Username/password Incorrect', 'danger'));
                            } else {
                                $add = array(
                                    'VEEVA_Employee_ID' => $emp['VEEVA_Employee_ID'],
                                    'password' => $password,
                                    'created_at' => date('Y-m-d H:i:s'),
                                );
                                $this->User_model->password_save($add);
                                $this->session->set_userdata('message', $this->Master_Model->DisplayAlert('Username/password Incorrect', 'danger'));
                            }
                        } else {
                            $add = array(
                                'VEEVA_Employee_ID' => $emp['VEEVA_Employee_ID'],
                                'password' => $password,
                                'created_at' => date('Y-m-d H:i:s'),
                            );
                            $this->User_model->password_save($add);
                            $this->session->set_userdata('message', $this->Master_Model->DisplayAlert('Username/password Incorrect', 'danger'));
                        }
                    }
                } else {
                    $this->session->set_userdata('message', $this->Master_Model->DisplayAlert('Username/password Incorrect', 'danger'));
                }
            } else {
                $this->session->set_userdata('VEEVA_Employee_ID', $check['VEEVA_Employee_ID']);
                $this->session->set_userdata('Local_Employee_ID', $check['Local_Employee_ID']);
                $this->session->set_userdata('Full_Name', $check['Full_Name']);
                $this->session->set_userdata('Division', $check['Division']);
                $this->session->set_userdata('Designation', $check['Profile']);
                $this->session->set_userdata('Reporting_To', $check['Reporting_To']);
                $this->session->set_userdata('Reporting_VEEVA_ID', $check['Reporting_VEEVA_ID']);
                $this->session->set_userdata('Reporting_Local_ID', $check['Reporting_Local_ID']);
                $this->session->set_userdata('Reporting_To', $check['Reporting_To']);
                $this->session->set_userdata('password_status', $check['password_status']);

                $check_password = $this->User_model->password_status($this->session->userdata('VEEVA_Employee_ID'));
                $add = array(
                    'VEEVA_Employee_ID' => $check['VEEVA_Employee_ID'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'password' => $check['password']
                );
                $this->db->insert('login_history', $add);
                if (is_null($check_password['password_status']) || $check_password['password_status'] == '') {
                    redirect('User/password', 'refresh');
                } else {
                    $data = array('Last_Login' => date('Y-m-d H:i:s'));
                    $this->User_model->update_last_login($this->session->userdata('VEEVA_Employee_ID'), $data);
                    if ($check_password['Profile'] === 'ASM') {
                        redirect('ASM/dashboard', 'refresh');
                    } elseif ($check_password['Profile'] === 'ZSM') {
                        redirect('ZSM/dashboard', 'refresh');
                    } elseif ($check_password['Profile'] === 'BDM') {
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

            if ($this->Product_Id > 0) {
                $target = $this->User_model->Rx_Target_month2($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id, $this->nextMonth);
            }
            $activity_planned = $this->User_model->activity_planned($this->VEEVA_Employee_ID, $this->Product_Id);
            $activitya_actual = $this->User_model->activity_actual($this->VEEVA_Employee_ID, $this->Product_Id);
            if (isset($target['target']) && $target['target'] > 0) {
                $data['kpi1'] = ($current_month_actual['Actual_Rx'] / $target['target']) * 100;
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
            $result = $this->Doctor_Model->getDoctor($this->VEEVA_Employee_ID, $this->Individual_Type);
            $this->doctorIds = $this->Doctor_Model->generateDoctorId($result);
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

//        if ($this->input->post()) {
//            $values = $this->input->post('value');
//            $data1 = array(
//                'target' => $values,
//                'VEEVA_Employee_ID' => $this->session->userdata('VEEVA_Employee_ID'),
//                'Product_Id' => $this->session->userdata('Product_Id'),
//                'Month' => $this->nextMonth,
//                'Year' => $this->nextYear,
//                'created_at' => date('Y-m-d H:i:s'),
//                'Status' => $this->input->post('Status'),
//            );
//
//            $check = $this->User_model->Set_Target_by_id($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id, $this->nextMonth);
//            if (empty($check)) {
//                $this->User_model->Set_Target($data1);
//                $this->session->set_userdata('message', $this->Master_Model->DisplayAlert('No of New Rx Targeted for ' . date('M', strtotime($this->nextMonth)) . '' . $this->nextYear . ' has been saved successfully! Thank you!.', 'success'));
//                redirect('User/dashboard', 'refresh');
//            } elseif ($check['Status'] == 'Draft') {
//
//                $this->User_model->Set_Target_update2($data1);
//                $this->session->set_userdata('message', $this->Master_Model->DisplayAlert('No of New Rx Targeted for ' . date('M', strtotime($this->nextMonth)) . '' . $this->nextYear . ' has been set successfully! Thank you!', 'success'));
//                redirect('User/dashboard', 'refresh');
//            } else {
//                $this->session->set_userdata('message', $this->Master_Model->DisplayAlert('No of New Rx Targeted for ' . date('M', strtotime($this->nextMonth)) . '  ' . $this->nextYear . ' is already submitted, cant overwrite it. Thank you!', 'danger'));
//                redirect('User/dashboard', 'refresh');
//            }
//        }
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
                    if ($this->Product_Id == 4 || $this->Product_Id == 6) {
                        $_POST['Product_id'] = 4;
                        $this->db->insert('Profiling', $_POST);
                        $_POST['Product_id'] = 6;
                        $this->db->insert('Profiling', $_POST);
                        $_POST['Product_id'] = 5;
                        $_POST['Win_Q1'] = '';
                        $_POST['Win_Q2'] = '';
                        $_POST['Win_Q3'] = '';
                        $_POST['Patient_Rxbed_In_Week'] = '';
                        $_POST['Patient_Rxbed_In_Month'] = '';
                        $_POST['Winability'] = '';
                        $_POST['Status'] = 'Draft';
                        $this->db->insert('Profiling', $_POST);

                        $this->session->set_userdata('message', $this->Master_Model->DisplayAlert($this->alertLabel . ' Profile Added Successfully.', 'success'));
                        redirect('User/Profiling', 'refresh');
                    } elseif ($this->Product_Id == 5) {
                        $_POST['Product_id'] = 5;
                        $this->db->insert('Profiling', $_POST);

                        $_POST['Product_id'] = 6;
                        $_POST['Win_Q1'] = '';
                        $_POST['Win_Q2'] = '';
                        $_POST['Win_Q3'] = '';
                        $_POST['Patient_Rxbed_In_Week'] = '';
                        $_POST['Patient_Rxbed_In_Month'] = '';
                        $_POST['Winability'] = '';
                        $_POST['Status'] = 'Draft';
                        $this->db->insert('Profiling', $_POST);
                        $_POST['Product_id'] = 4;
                        $this->db->insert('Profiling', $_POST);
                        $this->session->set_userdata('message', $this->Master_Model->DisplayAlert($this->alertLabel . ' Profile Added Successfully.', 'success'));
                        redirect('User/Profiling', 'refresh');
                    } else {
                        $this->db->insert('Profiling', $_POST);
                        $this->session->set_userdata('message', $this->Master_Model->DisplayAlert($this->alertLabel . ' Profile Added Successfully.', 'success'));
                        redirect('User/Profiling', 'refresh');
                    }
                } elseif ($check['Status'] == 'Draft') {
                    if ($this->Product_Id == 4 || $this->Product_Id == 6) {
                        $_POST['Product_id'] = 4;
                        $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_id' => 4, 'Doctor_id' => $_POST['Doctor_id']));
                        $this->db->update('Profiling', $_POST);

                        $_POST['Product_id'] = 6;
                        $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_id' => 6, 'Doctor_id' => $_POST['Doctor_id']));
                        $this->db->update('Profiling', $_POST);

                        $field_array = array(
                            'Patient_Seen' => $_POST['Patient_Seen'],
                            'Patient_Seen_month' => $_POST['Patient_Seen_month'],
                        );

                        $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_id' => 5, 'Doctor_id' => $_POST['Doctor_id']));
                        $this->db->update('Profiling', $field_array);
                        $this->session->set_userdata('message', $this->Master_Model->DisplayAlert($this->alertLabel . ' Profile Updated Successfully.', 'success'));
                        redirect('User/Profiling', 'refresh');
                    } elseif ($this->Product_Id == 5) {
                        $_POST['Product_id'] = 5;
                        $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_id' => 5, 'Doctor_id' => $_POST['Doctor_id']));
                        $this->db->update('Profiling', $_POST);

                        $field_array = array(
                            'Patient_Seen' => $_POST['Patient_Seen'],
                            'Patient_Seen_month' => $_POST['Patient_Seen_month'],
                        );

                        $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_id' => 6, 'Doctor_id' => $_POST['Doctor_id']));
                        $this->db->update('Profiling', $field_array);

                        $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_id' => 4, 'Doctor_id' => $_POST['Doctor_id']));
                        $this->db->update('Profiling', $field_array);

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
            $targetSet = $this->User_model->Rx_Target_month($this->VEEVA_Employee_ID, $this->Product_Id, $this->nextMonth, $this->nextYear);
            if (!empty($targetSet)) {
                $data['result'] = $this->User_model->getPlanning($this->VEEVA_Employee_ID, $this->Product_Id, $this->nextMonth, $this->nextYear);
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
                            'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID,
                            'Product_Id' => $this->Product_Id,
                            'Doctor_Id' => $doc_id[$i],
                            'Planning_Status' => $this->input->post('Planning_Status')
                        );
                        if (empty($result)) {
                            $doc['created_at'] = date('Y-m-d H:i:s');
                            $doc['Approve_Status'] = 'Draft';
                            if ($this->input->post('Button_click_status') == 'SaveForApproval') {
                                $doc['Approve_Status'] = 'SFA';
                            }
                            if ($this->User_model->Save_Planning($doc)) {
                                array_push($messages, $this->Master_Model->DisplayAlert('The Planning for ' . date('M') . '' . $this->nextYear . ' has been saved successfully! Thank you!.', 'success'));
                            }
                        } elseif (isset($result->Planning_Status) && $result->Planning_Status == 'Draft') {

                            if ($result->Planned_Rx != $value[$i]) {
                                $doc['field_changed'] = 1;
                            }

                            if ($result->Planned_Rx != $value[$i] || $result->Approve_Status == 'Draft' || $result->field_changed == 1) {
                                if ($this->input->post('Button_click_status') == 'SaveForApproval') {
                                    $doc['Approve_Status'] = 'SFA';
                                }
                            } else {
                                $doc['Approve_Status'] = $result->Approve_Status;
                            }
                            $doc['updated_at'] = date('Y-m-d H:i:s');
                            $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_Id' => $this->Product_Id, 'Doctor_Id' => $doc_id[$i]));
                            $this->db->update('Rx_Planning', $doc);
                            array_push($messages, $this->Master_Model->DisplayAlert('The Planning for ' . date('M') . '' . $this->nextYear . ' has been Updated successfully! Thank you!.', 'success'));
                        } elseif (isset($result->Planning_Status) && $result->Planning_Status == 'Submitted') {
                            array_push($messages, $this->Master_Model->DisplayAlert('The Planning for ' . date('M') . '' . $this->nextYear . ' Already Submitted ! Thank you!.', 'danger'));
                        }
                    }
                    if (!empty($messages)) {
                        $this->session->set_userdata('message', join(" ", array_unique($messages)));
                    }
                    redirect('User/dashboard', 'refresh');
                }
            } else {
                $message = $this->Master_Model->DisplayAlert('Please Set Target Before Planning.', 'danger');
                $this->session->set_userdata('message', $message);
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
        $check_planning = $this->User_model->priority_check($this->VEEVA_Employee_ID, $this->Product_Id, $this->nextMonth);
        if (!empty($check_planning)) {
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
                            'Status' => $this->input->post('Status'),
                            'Year' => $this->nextYear,
                            'month' => $this->nextMonth
                        );

                        $result = $this->User_model->ActivityPlanned($docid[$i]);
                        if (empty($result)) {
                            $data2['created_at'] = date('Y-m-d H:i:s');
                            $data2['Approve_Status'] = 'Draft';
                            if ($this->input->post('Button_click_status') == 'SaveForApproval') {
                                $data2['Approve_Status'] = 'SFA';
                            }
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
                            $data2['updated_at'] = date('Y-m-d H:i:s');
                            if ($result->Activity_Id != $Activity[$i]) {
                                $data2['field_changed'] = 1;
                            }

                            if ($result->Activity_Id != $Activity[$i] || $result->Approve_Status == 'Draft' || $result->field_changed == 1) {
                                if ($this->input->post('Button_click_status') == 'SaveForApproval') {
                                    $data2['Approve_Status'] = 'SFA';
                                }
                            } else {
                                $data2['Approve_Status'] = $result->Approve_Status;
                            }

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
        } else {
            $data['doctorList'] = "<h1>" . $this->alertLabel . " Are Not Prioritize</h1>";
        }
        $data = array('title' => 'Activity Planning', 'content' => 'User/Act_Plan', 'backUrl' => 'User/PlanMenu', 'view_data' => $data);
        $this->load->view('template2', $data);
    }

    public function PlanMenu() {
        if ($this->is_logged_in()) {
            $data['activity_planned'] = $this->User_model->activity_planned($this->VEEVA_Employee_ID, $this->Product_Id);
            $data['prio_dr'] = $this->User_model->prio_dr($this->VEEVA_Employee_ID, $this->Product_Id);
            $data['asm_comment'] = $this->User_model->ASM_comment($this->VEEVA_Employee_ID, $this->Product_Id);
            $data = array('title' => 'Report', 'content' => 'User/PlanMenu', 'backUrl' => 'User/dashboard', 'view_data' => $data);
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    public function password() {
        //if ($this->is_logged_in()) {
        if ($this->input->post()) {
            $password = $this->input->post('password');
            if (preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/', $password)) {
                if ($this->input->post('password') === $this->input->post('password2')) {
                    if (!empty($password)) {
                        $data = array(
                            'password' => $password,
                            'password_status' => 'Active',
                        );
                        $this->User_model->password($this->session->userdata('VEEVA_Employee_ID'), $data);
                        $check_password = $this->User_model->password_status($this->session->userdata('VEEVA_Employee_ID'));
                        if ($check_password['Profile'] == 'ASM') {
                            redirect('ASM/dashboard', 'refresh');
                        } elseif ($check_password['Profile'] == 'BDM') {
                            redirect('User/dashboard', 'refresh');
                        } elseif ($check_password['Profile'] == 'ZSM') {
                            redirect('ZSM/dashboard', 'refresh');
                        }
                    }
                } else {
                    $this->session->set_userdata('message', $this->Master_Model->DisplayAlert('Password And Its Repeat Must Be Same', 'danger'));
                }
            } else {
                $this->session->set_userdata('message', $this->Master_Model->DisplayAlert('Password Must Contain 8 characters with 1 Uppercase Alphabet, 1 Lowercase Alphabet and 1 Number', 'danger'));
            }
        }
        $data = array('title' => 'Change Password', 'content' => 'User/password', 'view_data' => 'blank');
        $this->load->view('template2', $data);
    }

    public function Reporting() {

        if ($this->Product_Id == 1) {
            $this->alertLabel = "Hospital";
        }
        $messages = array();
        $current_month = date('n');
        $data['show4'] = $this->User_model->Rx_Target_month2($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id, $current_month);
        if ($this->is_logged_in()) {
            $check_planning = $this->User_model->check_planning($this->VEEVA_Employee_ID, $this->Product_Id, $this->nextMonth, $this->nextYear);
            if (!empty($check_planning)) {
                $data['result'] = $this->User_model->getReporting($this->VEEVA_Employee_ID, $this->Product_Id, $this->nextMonth, $this->nextYear);
                if ($this->input->post()) {
                    for ($i = 0; $i < count($this->input->post('doc_id')); $i++) {
                        $value = $this->input->post('value');
                        $doc_id = $this->input->post('doc_id');
                        $current_date = date('Y-m-d');
                        $next_date = date('M');
                        $doc = array(
                            'Actual_Rx' => $value[$i],
                            'Year' => $this->nextYear,
                            'month' => $this->nextMonth,
                            'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID,
                            'Product_Id' => $this->Product_Id,
                            'Doctor_Id' => $doc_id[$i],
                            'Status' => $this->input->post('Status'),
                        );

                        $result = $this->User_model->ReportingExist($doc_id[$i]);

                        if (empty($result)) {
                            $doc['created_at'] = date('Y-m-d H:i:s');
                            $doc['Approve_Status'] = 'Draft';
                            if ($this->input->post('Button_click_status') == 'SaveForApproval') {
                                $doc['Approve_Status'] = 'SFA';
                            }
                            if ($this->User_model->SaveReporting($doc)) {
                                array_push($messages, $this->Master_Model->DisplayAlert('Reporting Data Added Successfully.', 'success'));
                            }
                        } else {
                            if (isset($result->Status) && $result->Status == 'Draft') {
                                if ($result->Actual_Rx != $value[$i]) {
                                    $doc['field_changed'] = 1;
                                }
                                if ($result->Actual_Rx != $value[$i] || $result->Approve_Status == 'Draft' || $result->field_changed == 1) {
                                    if ($this->input->post('Button_click_status') == 'SaveForApproval') {
                                        $doc['Approve_Status'] = 'SFA';
                                    }
                                } else {
                                    $doc['Approve_Status'] = $result->Approve_Status;
                                }
                                $doc['updated_at'] = date('Y-m-d H:i:s');
                                $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_Id' => $this->Product_Id, 'Doctor_Id' => $doc_id[$i], 'DATE_FORMAT(created_at,"%Y-%m-%d")' => date('Y-m-d')));
                                if ($this->db->update('Rx_Actual', $doc)) {
                                    array_push($messages, $this->Master_Model->DisplayAlert('Reporting Data Updated Successfully.', 'success'));
                                }
                            } else {
                                if (isset($result->Status) && $result->Status == 'Submitted') {
                                    array_push($messages, $this->Master_Model->DisplayAlert('Reporting Data Already Submitted For ' . date('M', strtotime($this->nextMonth)) . '' . $this->nextYear, 'danger'));
                                }
                            }
                        }
                    }
                    if (!empty($messages)) {
                        $this->session->set_userdata('message', join(" ", array_unique($messages)));
                    }
                    redirect('User/dashboard', 'refresh');
                }

                //echo $data['doctorList'] ;
            } else {
                $data['doctorList'] = "<h1>Please Save Planning First</h1>";
            }
            $data = array('title' => 'Reporting Doctor', 'content' => 'User/Prescription_Doctor_List', 'backUrl' => 'User/dashboard', 'view_data' => $data);
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    public function Priority() {
        $data = array();
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
                    'Status' => $this->input->post('Status'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'Year' => $this->nextYear
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
        $Status = "Submitted";
        $check = $this->User_model->Activity_reporting_check($this->VEEVA_Employee_ID, $this->Product_Id, $Status);

        if (!empty($check)) {
            if ($this->Product_Id == 1) {
                $this->alertLabel = "Hospital";
            }

            $messages = array();
            $result = $this->User_model->getPlannedActivityDoctor();
            $data['doctorList'] = $this->User_model->generateActivityTable($result, 'Reporting');
            $Activity_Detail = $this->input->post('Activity_Detail');
            $Reason = $this->input->post('Reason');
            //var_dump($_POST);
            if ($this->input->post()) {
                $Activity_Detail = $this->input->post('Activity_Detail');
                $Reason = $this->input->post('Reason');
                for ($i = 0; $i < count($this->input->post('Doctor_Id')); $i ++) {
                    $docid = $this->input->post('Doctor_Id');
                    $Activity = $this->input->post('Activity_Id');

                    if (trim($Activity[$i]) != '-1') {
                        $data2 = array(
                            'Activity_Id' => $Activity[$i],
                            'Doctor_Id' => $docid[$i],
                            'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID,
                            'Product_Id' => $this->Product_Id,
                            'Status' => $this->input->post('Status'),
                            'Year' => $this->nextYear,
                            'month' => $this->nextMonth,
                            'Activity_Done' => $this->input->post($docid[$i])
                        );
                        if ($data2['Activity_Done'] == 'Yes') {
                            $data2['Activity_Detail'] = $Activity_Detail[$i];
                            $data2['Reason'] = '';
                        } elseif ($data2['Activity_Done'] == 'No') {
                            $data2['Reason'] = $Reason[$i];
                            $data2['Activity_Detail'] = '';
                        }
                        $result = $this->User_model->ActivityReportingExist($docid[$i]);
                        if (empty($result)) {
                            $data2['created_at'] = date('Y-m-d H:i:s');
                            $data2['Approve_Status'] = 'Draft';
                            if ($this->input->post('Button_click_status') == 'SaveForApproval') {
                                $data2['Approve_Status'] = 'SFA';
                            }
                            //$data2['Approve_Status'] = 'SFA';
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
                            if ($this->input->post($docid[$i]) != $result->Activity_Done) {
                                $data2['field_changed'] = 1;
                            }

                            $data2['updated_at'] = date('Y-m-d H:i:s');
                            if ($this->input->post($docid[$i]) != $result->Activity_Done || $result->Approve_Status == 'Draft' || $result->field_changed == 1) {
                                if ($this->input->post('Button_click_status') == 'SaveForApproval') {
                                    $data2['Approve_Status'] = 'SFA';
                                }
                            } else {
                                $data2['Approve_Status'] = $result->Approve_Status;
                            }

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
                            array_push($messages, $this->Master_Model->DisplayAlert('Activity Reporting Already Submitted ', 'danger'));
                        }
                    }
                }

                if (!empty($messages)) {
                    $this->session->set_userdata('message', join(" ", array_unique($messages)));
                }
                redirect('User/dashboard', 'refresh');
            }
        } else {
            $data['doctorList'] = "Activity Planning Not Submitted";
        }
        $data['asm_comment'] = $this->User_model->ASM_comment_rep($this->VEEVA_Employee_ID, $this->Product_Id);
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
                $date = $this->input->post('date');
                $date1 = date('m-d-y', strtotime($date));
                $mobile = array('Mobile' => $number, 'DOB' => $date1);
                $mob = $this->User_model->Update_mobile($this->VEEVA_Employee_ID, $mobile);
                $this->session->set_userdata('message', $this->Master_Model->DisplayAlert('Update Successfully.', 'success'));
            }
            $data['detail'] = $this->User_model->All_data($this->VEEVA_Employee_ID);
            $data = array('title' => 'Profile Update', 'content' => 'User/Profile_Update', 'view_data' => $data, 'backUrl' => 'User/dashboard');
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
                $pass_exit_history = $this->User_model->check_history($this->VEEVA_Employee_ID, $new);
                $pass = $this->User_model->All_data($this->VEEVA_Employee_ID);
                if (empty($pass_exit_history)) {
                    if (!empty($pass)) {
                        if ($old == $pass['password']) {
                            $mobile = array('password' => $new);
                            $mob = $this->User_model->Update_mobile($this->VEEVA_Employee_ID, $mobile);
                            $data = array('password' => $new,
                                'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID,
                                'created_at' => date('y-m-d'));
                            $this->User_model->insert_pass($data);
                            $this->session->set_userdata('message', $this->Master_Model->DisplayAlert('Password Changed Successfully.', 'success'));
                        } else {
                            $this->session->set_userdata('message', $this->Master_Model->DisplayAlert('Old Password Not Match.', 'danger'));
                        }
                    }
                } else {
                    $this->session->set_userdata('message', $this->Master_Model->DisplayAlert(' Already Exit Password .', 'danger'));
                }
            }

            $data['detail'] = $this->User_model->All_data($this->VEEVA_Employee_ID);
            $data = array('title' => 'Profile Update', 'content' => 'User/Profile_Update', 'view_data' => $data, 'backUrl' => 'User/dashboard');
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    public function BDM_Report() {
        if ($this->is_logged_in()) {

            $data['detail'] = $this->User_model->bdm_doctor_rx($this->VEEVA_Employee_ID, $this->nextMonth, $this->nextYear);
            $data = array('title' => 'Profile Update', 'content' => 'User/BDM_Report', 'view_data' => $data);
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    function sendMail2() {
        include APPPATH . 'third_party/phpMailer/class.phpmailer.php';
        include APPPATH . 'third_party/phpMailer/class.smtp.php';

        $email = $this->input->post('email');

        $emp = $this->User_model->employee_id($email);
        if (!empty($emp)) {
            $encodedPassword = base64_encode($emp['VEEVA_Employee_ID']);
            $link = "http://instacom.in/test-bitracking/index.php/User/Reset_Password/?e=" . $encodedPassword;

            $mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

            $mail->IsSMTP(); // telling the class to use SMTP

            try {
                $mail->SMTPAuth = true;                  // enable SMTP authentication
                $mail->SMTPSecure = "ssl";                 // sets the prefix to the server
                $mail->Host = "smtpout.asia.secureserver.net";      // sets the SMTP server
                $mail->Port = 465;                   // set the SMTP port for the MAIL server
                $mail->Username = "bi@instacom.in";  //  username
                $mail->Password = "bitracker";            // password

                $mail->FromName = "BI-Tracking";
                $mail->From = "bi@instacom.in";
                $mail->AddAddress($email, "BI-Tracking");

                $mail->Subject = "Forgot Password";

                $mail->IsHTML(true);

                $mail->Body = <<<EMAILBODY

Link For Reseting Password <br/>{$link}
EMAILBODY;

                $mail->Send();
            } catch (phpmailerException $e) {
                echo $e->errorMessage(); //Pretty error messages from PHPMailer
            } catch (Exception $e) {
                echo $e->getMessage(); //Boring error messages from anything else!
            }
            $this->session->set_userdata('message', $this->Master_Model->DisplayAlert('Link For Resetting Password Has Been Mailed To Your Emailid.', 'success'));

            redirect('User/index', 'refresh');
        } else {
            $this->session->set_userdata('message', $this->Master_Model->DisplayAlert('Wrong Emailid', 'danger'));
            redirect('User/index', 'refresh');
        }
    }

    public function forget_pass() {
        $data = array('title' => 'forget', 'content' => 'User/forget', 'view_data' => 'blank');
        $this->load->view('template1', $data);
    }

    public function Reset_Password() {
        $data = array();
        if ($this->input->get('e')) {
            $id = $this->input->get('e');
            $id1 = base64_decode($id);
            $data['VEEVA_Employee_ID'] = $id1;
        }

        if ($this->input->post()) {
            $new = $this->input->post('password');
            $id1 = $this->input->post('VEEVA_Employee_ID');
            $data2 = array(
                'VEEVA_Employee_ID' => $id1,
                'password' => $new);
            $this->User_model->Update_password($id1, $data2);

            $this->session->set_userdata('message', $this->Master_Model->DisplayAlert('Password Changed Successfully.', 'success'));

            redirect('User/index', 'refresh');
        }


        $data = array('title' => 'Reset_Password', 'content' => 'User/reset_password', 'view_data' => $data);
        $this->load->view('template1', $data);
    }

}
