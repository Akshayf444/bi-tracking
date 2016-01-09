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

                if (is_null($check_password['password_status'])) {
                    redirect('User/password', 'refresh');
                } else {
                    if ($check_password['Designation'] == 'ASM') {
                        redirect('User/ASM_dashboard', 'refresh');
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
            $data['tab1'] = $this->User_model->generateTabs($this->VEEVA_Employee_ID, $this->Product_Id);

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
            $data['kpi1'] = ($current_month_actual['actual_rx'] / $current_month_planned['planned_rx']) * 100;
            $data['kpi2'] = ($activitya_actual['activity_actual'] / $activity_planned ['activity_planned']) * 100;
            $data['Product_Id'] = $this->Product_Id;
            $data['productList'] = $this->Master_Model->generateDropdown($result, 'id', 'Brand_Name', $this->Product_Id);
            $data = array('title' => 'Main', 'content' => 'User/Main', 'view_data' => $data);
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    public function ASM_dashboard() {
        if ($this->is_logged_in()) {

            $data = array('title' => 'Main', 'content' => 'User/ASM_dashboard', 'view_data' => $data);
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    public function ASM_hospital_profiling() {
        if ($this->is_logged_in()) {

            $data = array('title' => 'Main', 'content' => 'User/ASM_hospital_profiling', 'view_data' => $data);
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
        if ($this->input->post()) {
            $values = $this->input->post('value');
            $data1 = array(
                'target' => $values,
                'VEEVA_Employee_ID' => $this->session->userdata('VEEVA_Employee_ID'),
                'Product_Id' => $this->session->userdata('Product_Id'),
                'Month' => $this->nextMonth,
                'Year' => $this->nextYear,
                'created_at' => date('Y-m-d H:i:s'),
                'Status' => 'Draft',
            );

            $check = $this->User_model->Set_Target_by_id($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id, $this->nextMonth);
            if (empty($check)) {
                $this->User_model->Set_Target($data1);
                redirect('User/Set_Target', 'refresh');
            } elseif ($check['Status'] == 'Draft') {
                $this->User_model->Set_Target_update2($data1);
                redirect('User/Set_Target', 'refresh');
            }
        }
        $month_start = date('n', strtotime('-4 month'));
        $month_mid = date('n', strtotime('-3 month'));
        $month_between = date('n', strtotime('-2 month'));
        $month_ends = date('n', strtotime('-1 month'));
        $current_month = date('n');
        $year = date('Y');
        $data['show1'] = $this->User_model->Rx_Target_month($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id, $month_start, $year);
        $data['show2'] = $this->User_model->Rx_Target_month($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id, $month_between, $year);
        $data['show3'] = $this->User_model->Rx_Target_month($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id, $month_ends, $year);
        $data['show4'] = $this->User_model->Rx_Target_month($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id, $current_month, $year);
        $data['show5'] = $this->User_model->Rx_Target_month($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id, $month_mid, $year);
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
        $data = array('title' => 'Report', 'content' => 'User/addDelta', 'view_data' => $data);
        $this->load->view('template2', $data);
    }

    public function Planning() {
        if ($this->is_logged_in()) {
            $data['doctorList'] = $this->User_model->generatePlanningTab();
            // echo($data['doctorList']);
            if ($this->input->post()) {
                // if (empty($result)) {
                $currentPlanned = array_sum($this->input->post('value'));
                $currentPlanned = (int) $currentPlanned;
                for ($i = 0; $i < count($this->input->post('value')); $i++) {

                    $value = $this->input->post('value');
                    $doc_id = $this->input->post('doc_id');
                    $result = $this->User_model->PlanningExist($doc_id[$i]);
                    if (empty($result)) {
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
                            'Planning_Status' => 'Draft'
                        );
                        $this->User_model->Save_Planning($doc);
                    } else {
                        if (isset($result->Planning_Status) && $result->Planning_Status == 'Draft') {
                            $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_Id' => $this->Product_Id, 'Doctor_Id' => $doc_id[$i]));
                            $this->db->update('Rx_Planning', $data);
                        }
                    }
                }
                echo $this->Master_Model->DisplayAlert('Planning Data Added Successfully.');
            }
            $current_month = $this->nextMonth;
            $data['show4'] = $this->User_model->Rx_Target_month2($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id, $current_month);
            $data['expected'] = $this->User_model->Expected_Rx($this->VEEVA_Employee_ID, $this->Product_Id, $this->nextMonth);
            $data = array('title' => 'Search', 'content' => 'User/doctorList', 'view_data' => $data);
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    /*     * ************* Almost Completed ****************** */

    public function Profiling() {
        if ($this->is_logged_in()) {
            $result = $this->Doctor_Model->getDoctor($this->VEEVA_Employee_ID, $this->Individual_Type);

            if ($this->input->post()) {
                $_POST['VEEVA_Employee_ID'] = $this->VEEVA_Employee_ID;
                $_POST['Product_id'] = $this->Product_Id;
                $_POST['created_at'] = date('Y-m-d H:i:s');
                $_POST['Status'] = 'Draft';
                $check = $this->User_model->profiling_by_id($_POST['Doctor_id'], $_POST['VEEVA_Employee_ID'], $_POST['Product_id']);
                if (empty($check)) {
                    if ($this->Product_Id == 4 || $this->Product_Id == 6) {
                        $_POST['Product_id'] = 4;
                        $this->db->insert('Profiling', $_POST);
                        $_POST['Product_id'] = 6;
                        $this->db->insert('Profiling', $_POST);
                        redirect('User/Profiling', 'refresh');
                    } else {
                        $this->db->insert('Profiling', $_POST);
                        redirect('User/Profiling', 'refresh');
                    }
                    echo $this->Master_Model->DisplayAlert('Doctor Profile Added Successfully.');
                } elseif ($check['Status'] == 'Draft') {
                    if ($this->Product_Id == 4 || $this->Product_Id == 6) {
                        $_POST['Product_id'] = 4;
                        $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_id' => 4, 'Doctor_id' => $_POST['Doctor_id']));
                        $this->db->update('Profiling', $_POST);

                        $_POST['Product_id'] = 6;
                        $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_id' => 6, 'Doctor_id' => $_POST['Doctor_id']));
                        $this->db->update('Profiling', $_POST);
                    } else {
                        $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_id' => $this->Product_Id, 'Doctor_id' => $_POST['Doctor_id']));
                        $this->db->update('Profiling', $_POST);
                    }
                    echo $this->Master_Model->DisplayAlert('Doctor Profile Updated Successfully.');
                }
            }

            $data['Product_Id'] = $this->Product_Id;
            $data['doctorList'] = $this->Master_Model->generateDropdown($result, 'Account_ID', 'Account_Name');
            $data['questionList'] = $this->Master_Model->getQuestions($this->Product_Id);
            $data = array('title' => 'Question', 'content' => 'User/Question', 'view_data' => $data);
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    public function ActivityPlanning() {
        $data['doctorList'] = $this->User_model->getActivityDoctor();
        $result = $this->User_model->getActivityList();
        $data['ActivityList'] = $this->Master_Model->generateDropdown($result, 'Activity_id', 'Activity_Name');
        if ($this->input->post()) {
            for ($i = 0; $i < count($this->input->post('Doctor_Id')); $i ++) {
                $docid = $this->input->post('Doctor_Id');
                $Activity = $this->input->post('Activity_id');
                if (trim($Activity[$i]) != '') {
                    $data2 = array(
                        'Activity_Id' => $Activity[$i],
                        'Doctor_Id' => $docid[$i],
                        'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID,
                        'Product_Id' => $this->Product_Id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'Status' => 'Draft'
                    );
                    if ($this->Product_Id == 4 || $this->Product_Id == 6) {
                        $data2['Product_Id'] = 4;
                        $this->db->insert('Activity_Planning', $data2);
                        $data2['Product_Id'] = 6;
                        $this->db->insert('Activity_Planning', $data2);
                    } else {
                        $this->db->insert('Activity_Planning', $data2);
                    }
                }
            }
        }
        $data = array('title' => 'Activity Planning', 'content' => 'User/Act_Plan', 'view_data' => $data);
        $this->load->view('template2', $data);
    }

    public function addRx() {
        $data = array('title' => 'Report', 'content' => 'User/Report', 'view_data' => 'blank');
        $this->load->view('template2', $data);
    }

    public function PlanMenu() {
        $data = array('title' => 'Report', 'content' => 'User/PlanMenu', 'view_data' => 'blank');
        $this->load->view('template2', $data);
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
                        redirect('User/ASM_dashboard', 'refresh');
                    } else {
                        redirect('User/dashboard', 'refresh');
                    }
                }
            }
            $data = array('title' => 'Report', 'content' => 'User/password', 'view_data' => 'blank');
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
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
                    $doc_id = $this->input->post('doc_id');
                    $doc_id = $doc_id[$i];
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
            //echo $data['doctorList'] ;
            $current_month = date('n');
            $data['show4'] = $this->User_model->Rx_Target_month2($this->session->userdata('VEEVA_Employee_ID'), $this->Product_Id, $current_month);
            $data = array('title' => 'Reporting Doctor', 'content' => 'User/Prescription_Doctor_List', 'view_data' => $data);
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    public function Priority() {
        $doctor_ids = $this->User_model->PriorityIds();
        //var_dump($doctor_ids);
        if (!empty($doctor_ids)) {
            $data['doctorList'] = $this->User_model->generatePlanningTab('Planning', 'true', $doctor_ids);
        }

        if ($this->input->post()) {
            for ($i = 0; $i < count($this->input->post('priority')); $i++) {

                $priority = $this->input->post('priority');
                $result = $this->User_model->ActualPriorityExist($priority[$i]);
                //var_dump($result);
                $data2 = array(
                    'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID,
                    'Product_Id' => $this->Product_Id,
                    'month' => $this->nextMonth,
                    'Doctor_Id' => $priority[$i],
                );
                if (empty($result)) {
                    $this->db->insert('Actual_Doctor_Priority', $data2);
                }
            }

            redirect('User/Priority', 'refresh');
        }

        $data = array('title' => 'Set Priority', 'content' => 'User/Priority', 'view_data' => $data);
        $this->load->view('template2', $data);
    }

    public function ActivityReporting() {
        $result = $this->User_model->getPlannedActivityDoctor();
        $data['doctorList'] = $this->Master_Model->generateDropdown($result, 'Account_ID', 'Account_Name');
        if ($this->input->get('Doctor_Id')) {
            $data['ActiviyList'] = $this->User_model->getPlannedActivityList($this->input->get('Doctor_Id'));
        }
        if ($this->input->post()) {
            foreach ($data['ActiviyList'] as $Activity) {
                if ($this->input->post($Activity->Activity_id)) {
                    $data2 = array(
                        'Activity_Id' => $Activity->Activity_id,
                        'Doctor_Id' => $this->input->post('Doctor_Id'),
                        'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID,
                        'Product_Id' => $this->Product_Id,
                        'Activity_detail' => $this->input->post($Activity->Activity_id . 'Detail'),
                        'Reason' => $this->input->post($Activity->Activity_id . 'Reason'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'Status' => $this->input->post($Activity->Activity_id)
                    );
                    $this->db->insert('Activity_Planning', $data2);
                }
            }
        }
        $data = array('title' => 'Activity Planning', 'content' => 'User/Act_Report', 'view_data' => $data);
        $this->load->view('template2', $data);
    }

    public function getActivityDetails() {
        $ActiviyList = $this->User_model->getPlannedActivityList($this->input->post('Doctor_Id'));
        $html = '';
        if (isset($ActiviyList) && !empty($ActiviyList)) {
            foreach ($ActiviyList as $Activity) {
                $html .= '<li class="table-view-cell">
                    <div class="col-xs-4">' . $Activity->Activity_Name . '</div>
                    <div class="col-xs-8">
                        <div class="toggle">
                            <label><input type="radio" name="' . $Activity->Activity_id . '" value="Yes"><span id="' . $Activity->Activity_id . '-1 ">Yes</span></label>    
                        </div>
                        <div class="toggle">
                            <label><input type="radio" name="' . $Activity->Activity_id . '" value="No"><span id="' . $Activity->Activity_id . '-2 " >No</span></label>
                        </div>
                    </div>
                    <div id="heading ' . $Activity->Activity_id . '" class="custom-collapse " style="display: none">
                        <div class="row row-margin-top">
                            <div class="col-xs-12 col-lg-12"><textarea class="form-control" name=" ' . $Activity->Activity_id . 'Detail" placeholder="Activity Details"></textarea> </div> 
                        </div> 
                    </div>
                    <div id="reason ' . $Activity->Activity_id . '" class="custom-collapse " style="display: none">
                        <div class="row row-margin-top">
                            <div class="col-xs-12 col-lg-12"><textarea class="form-control" name="' . $Activity->Activity_id . 'Reason " placeholder="Reason"></textarea> </div> 
                        </div> 
                    </div>
                </li>';
            }
        }

        echo $html;
    }

    public function Profiling_thnx() {
        $data = array('title' => 'Activity Planning', 'content' => 'User/Profiling_thnx', 'view_data' => 'blank');
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

    public function updateDraftStatus() {
        $Doctor_Id = $this->input->post('Doctor_Id') ? $this->input->post('Doctor_Id') : 0;
        $Table_Name = $this->input->post('Table_Name');
        if ($Table_Name == 'Profiling') {
            $data = array('Status' => 'Submitted');
            $this->db->where(array('Product_Id' => $this->Product_Id, 'Doctor_Id' => $Doctor_Id, 'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID));
            if ($this->db->update($Table_Name, $data)) {
                echo 'Success';
            } else {
                echo '404';
            }
        } elseif ($Table_Name == 'Rx_Target') {
            $data = array('Status' => 'Submitted');
            $this->db->where(array('Product_Id' => $this->Product_Id, 'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID));
            if ($this->db->update($Table_Name, $data)) {
                echo 'Success';
            } else {
                echo '404';
            }
        } elseif ($Table_Name == 'Rx_Planning') {
            $data = array('Status' => 'Submitted');
            $this->db->where(array('Product_Id' => $this->Product_Id, 'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID));
            if ($this->db->update($Table_Name, $data)) {
                echo 'Success';
            } else {
                echo '404';
            }
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

                if (empty($result)) {
                    $month = date('n', strtotime('-1 month'));

                    $month3 = $this->User_model->getMonthwiseRx($doc_id[$i], $month);
                    $month3rx = isset($month3->Actual_Rx) ? $month3->Actual_Rx : 0;
                    $currentDependancy = round(($value[$i] / $currentPlanned) * 100, 0, PHP_ROUND_HALF_EVEN);
                    $data2 = array('Delta' => $value[$i] - $month3rx, 'Dependancy' => $currentDependancy, 'Doctor_Id' => $doc_id[$i], 'VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'month' => $this->nextMonth, 'Product_Id' => $this->Product_Id, 'Planned_Rx' => $value[$i]);
                    $this->db->insert('Doctor_Priority', $data2);
                } else {
                    $this->db->where(array('VEEVA_Employee_ID' => $this->VEEVA_Employee_ID, 'Product_id' => $this->Product_Id, 'Doctor_id' => $doc_id[$i]));
                    $this->db->upadate('Doctor_Priority', $data2);
                }
            }
            redirect('User/Priority', 'refresh');
        }
    }

}
