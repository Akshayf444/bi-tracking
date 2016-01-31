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

    public function dashboard() {
        if ($this->is_logged_in()) {

            $result2 = $this->Master_Model->BrandList($this->session->userdata('Division'));

            $data['productlist'] = $result2;

            $kp11['one'] = $this->User_model->ASM_kp1($this->VEEVA_Employee_ID, $this->nextMonth, $this->nextYear, 1);
            $kp12['two'] = $this->User_model->ASM_kp1($this->VEEVA_Employee_ID, $this->nextMonth, $this->nextYear, 2);
            $kp13['three'] = $this->User_model->ASM_kp1($this->VEEVA_Employee_ID, $this->nextMonth, $this->nextYear, 3);
            $kp14['four'] = $this->User_model->ASM_kp1($this->VEEVA_Employee_ID, $this->nextMonth, $this->nextYear, 4);
            $kp15['five'] = $this->User_model->ASM_kp1($this->VEEVA_Employee_ID, $this->nextMonth, $this->nextYear, 5);
            $kp16['six'] = $this->User_model->ASM_kp1($this->VEEVA_Employee_ID, $this->nextMonth, $this->nextYear, 6);
            if ($kp11['one']['Planned'] != 0) {
                $data['kp11'] = ($kp11['one']['Actual'] / $kp11['one']['Planned']) * 100;
            } else {
                $data['kp11'] = 0;
            }
            if ($kp12['two']['Planned'] != 0) {
                $data['kp12'] = ($kp12['two']['Actual'] / $kp12['two']['Planned']) * 100;
            } else {
                $data['kp12'] = 0;
            }
            if ($kp13['three']['Planned'] != 0) {
                $data['kp13'] = ($kp13['three']['Actual'] / $kp13['three']['Planned']) * 100;
            } else {
                $data['kp13'] = 0;
            }
            if ($kp14['four']['Planned'] != 0) {
                $data['kp14'] = ($kp14['four']['Actual'] / $kp14['four']['Planned']) * 100;
            } else {
                $data['kp14'] = 0;
            }
            if ($kp15['five']['Planned'] != 0) {
                $data['kp15'] = ($kp15['five']['Actual'] / $kp15['five']['Planned']) * 100;
            } else {
                $data['kp15'] = 0;
            }
            if ($kp16['six']['Planned'] != 0) {
                $data['kp16'] = ($kp16['six']['Actual'] / $kp16['six']['Planned']) * 100;
            } else {
                $data['kp16'] = 0;
            }
            $data['division'] = $this->User_model->ASM_division($this->VEEVA_Employee_ID);
            $data = array('title' => 'Main', 'content' => 'ASM/ASM_dashboard', 'view_data' => $data);
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
            $result2 = $this->Master_Model->BrandList($this->session->userdata('Division'));
            $data['product'] = $this->Master_Model->generateDropdown($result2, 'id', 'Brand_Name');
            if ($this->input->post()) {
                $this->Product_Id = $this->input->post('product_id');
                $data['product'] = $this->Master_Model->generateDropdown($result2, 'id', 'Brand_Name', $this->Product_Id);
                $data['result'] = $this->asm_model->getTarget();
            }
            $check = $this->User_model->ASM_division($this->VEEVA_Employee_ID);
            if (!empty($check)) {
                if ($check['division'] == 'Diabetes') {
                    $data['table'] = $this->asm_model->ASm($this->VEEVA_Employee_ID);
                    $data['ck'] = "Diabetes";
                } else {
                    $data['table'] = $this->asm_model->ASm($this->VEEVA_Employee_ID);
                    $data['ck'] = "Thrombi";
                }
            }
            $data = array('title' => 'Target', 'content' => 'ASM/target', 'backUrl' => 'ASM/dashboard', 'view_data' => $data);
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
            $id2 = $this->session->userdata('VEEVA_Employee_ID');
            $result = $this->asm_model->rx_view($id2);

            //BDM List
            $data['bdm'] = $this->Master_Model->generateDropdown($result, 'VEEVA_Employee_ID', 'Full_Name');
            $result2 = $this->Master_Model->BrandList($this->session->userdata('Division'));

            //ProductList Dropdown
            $data['product'] = $this->Master_Model->generateDropdown($result2, 'id', 'Brand_Name');
            $data['productlist'] = $result2;

            //POST ACTION
            if ($this->input->post()) {
                $product = $this->input->post('product_id');
                $id = $this->input->post('rx_id');

                $result = $this->asm_model->rx_view($id2);
                $data['bdm'] = $this->Master_Model->generateDropdown($result, 'VEEVA_Employee_ID', 'Full_Name', $id);
                $result2 = $this->Master_Model->BrandList($this->session->userdata('Division'));
                $data['productlist'] = NULL;
                $data['product'] = $this->Master_Model->generateDropdown($result2, 'id', 'Brand_Name', $product);
                $data['show'] = $this->User_model->getPlanningAproval($id, $product, $this->nextMonth);
            }
            $data = array('title' => 'Report', 'content' => 'ASM/Asm_rxplanning', 'backUrl' => 'ASM/dashboard', 'view_data' => $data);
            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    public function approveTarget() {
        if ($this->input->post()) {
            $VEEVA_Employee_ID = $this->input->post('VEEVA_Employee_ID');
            $target1 = $this->input->post('target1');
            $target2 = $this->input->post('target2');
            $target3 = $this->input->post('target3');
            for ($i = 0; $i < count($this->input->post('VEEVA_Employee_ID')); $i++) {
                $Status = $this->input->post('Status');

                if ($this->Division == 'Diabetes') {
                    $product_ids = array(4, 5, 6);
                    $count = 1;
                    foreach ($product_ids as $id) {
                        $data1 = array(
                            'target' => ${'target' . $count}[$i],
                            'VEEVA_Employee_ID' => $VEEVA_Employee_ID[$i],
                            'Product_Id' => $id,
                            'Month' => $this->nextMonth,
                            'Year' => $this->nextYear,
                            'created_at' => date('Y-m-d H:i:s'),
                            'Status' => $Status,
                        );

                        $check = $this->User_model->Set_Target_by_id($VEEVA_Employee_ID[$i], $id, $this->nextMonth);
                        if (empty($check)) {
                            $this->User_model->Set_Target($data1);
                        } elseif ($check['Status'] == 'Draft') {
                            $this->db->where(array('VEEVA_Employee_ID' => $VEEVA_Employee_ID[$i], 'Product_Id' => $id, 'month' => $this->nextMonth));
                            $this->db->update('Rx_Target', $data1);
                        }
                        $count++;
                    }
                } else {
                    $product_ids = array(1, 2, 3);
                    $count = 1;
                    foreach ($product_ids as $id) {
                        $data1 = array(
                            'target' => ${'target' . $count}[$i],
                            'VEEVA_Employee_ID' => $VEEVA_Employee_ID[$i],
                            'Product_Id' => $id,
                            'Month' => $this->nextMonth,
                            'Year' => $this->nextYear,
                            'created_at' => date('Y-m-d H:i:s'),
                            'Status' => $Status[$i],
                        );

                        $check = $this->User_model->Set_Target_by_id($VEEVA_Employee_ID[$i], $id, $this->nextMonth);
                        if (empty($check)) {
                            $this->User_model->Set_Target($data1);
                        } elseif ($check['Status'] == 'Draft') {
                            $this->db->where(array('VEEVA_Employee_ID' => $VEEVA_Employee_ID[$i], 'Product_Id' => $id, 'month' => $this->nextMonth));
                            $this->db->update('Rx_Target', $data1);
                        }
                        $count++;
                    }
                }
            }
        }
        redirect('ASM/target', 'refresh');
    }

    public function ApprovePlanning() {
        if ($this->input->post()) {
            for ($i = 0; $i < count($this->input->post('Doctor_Id')); $i++) {
                $doctorId = $this->input->post('Doctor_Id');
                $data = array(
                    'VEEVA_Employee_Id' => $this->input->post('BDM_ID'),
                );
                $data['Approve_Status'] = $this->input->post('approve_' . $doctorId[$i]);
                $this->db->where(array('VEEVA_Employee_ID' => $this->input->post('BDM_ID'), 'Doctor_Id' => $doctorId[$i], 'Product_Id' => $this->input->post('product')));
                $this->db->update('Rx_Planning', $data);
            }
            redirect('ASM/asm_rx_planning', 'refresh');
        }
    }

    public function activity_planning() {

        if ($this->is_logged_in()) {
            $id2 = $this->session->userdata('VEEVA_Employee_ID');
            $result = $this->asm_model->rx_view($id2);
            //BDM List
            $data['bdm'] = $this->Master_Model->generateDropdown($result, 'VEEVA_Employee_ID', 'Full_Name');

            //Productlist
            $result2 = $this->Master_Model->BrandList($this->session->userdata('Division'));

            //Generate Productlist Dropdown
            $data['product'] = $this->Master_Model->generateDropdown($result2, 'id', 'Brand_Name');
            $data['productlist'] = $result2;

            //POST ACTION
            if ($this->input->post()) {
                $product = $this->input->post('product_id');
                $id = $this->input->post('rx_id');
                $this->Product_Id = $product;

                //BDM List
                $result = $this->asm_model->rx_view($id2);
                $data['productlist'] = NULL;
                //BDM Dropdown
                $data['bdm'] = $this->Master_Model->generateDropdown($result, 'VEEVA_Employee_ID', 'Full_Name', $id);
                $result2 = $this->Master_Model->BrandList($this->session->userdata('Division'));

                $data['product'] = $this->Master_Model->generateDropdown($result2, 'id', 'Brand_Name', $product);
                $result = $this->User_model->getActivityDoctor2($id, $product, $this->nextMonth);
                $data['Doctorlist'] = $this->User_model->generateActivityTable2($result);
            }

            $data = array('title' => 'Report', 'content' => 'ASM/activity_planning', 'backUrl' => 'ASM/dashboard', 'view_data' => $data);

            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    public function ApproveActivity() {
        if ($this->input->post()) {
            for ($i = 0; $i < count($this->input->post('Doctor_Id')); $i++) {
                $doctorId = $this->input->post('Doctor_Id');
                $data = array(
                    'VEEVA_Employee_Id' => $this->input->post('BDM_ID'),
                );
                $data['Approve_Status'] = $this->input->post('approve_' . $doctorId[$i]);
                $this->db->where(array('VEEVA_Employee_ID' => $this->input->post('BDM_ID'), 'Doctor_Id' => $doctorId[$i], 'Product_Id' => $this->input->post('product')));
                $this->db->update('Activity_Planning', $data);

                // echo $this->db->last_query();
            }
            redirect('ASM/activity_planning', 'refresh');
        }
    }

    public function reporting_rx() {

        if ($this->is_logged_in()) {
            $id2 = $this->session->userdata('VEEVA_Employee_ID');
            $result = $this->asm_model->rx_view($id2);
            $data['bdm'] = $this->Master_Model->generateDropdown($result, 'VEEVA_Employee_ID', 'Full_Name');
            $result2 = $this->Master_Model->BrandList($this->session->userdata('Division'));
            $data['product'] = $this->Master_Model->generateDropdown($result2, 'id', 'Brand_Name');
            $data['productlist'] = $result2;
            if ($this->input->post()) {
                $product = $this->input->post('product_id');
                $id = $this->input->post('rx_id');
                $this->Product_Id = $product;
                $result = $this->asm_model->rx_view($id2);
                $data['bdm'] = $this->Master_Model->generateDropdown($result, 'VEEVA_Employee_ID', 'Full_Name', $id);
                $result2 = $this->Master_Model->BrandList($this->session->userdata('Division'));
                $data['productlist'] = NULL;
                $data['product'] = $this->Master_Model->generateDropdown($result2, 'id', 'Brand_Name', $product);
                $data['show'] = $this->User_model->getReporting2($id, $product,  $this->nextMonth);
            }

            $data = array('title' => 'Report', 'content' => 'ASM/reporting_rx', 'backUrl' => 'ASM/dashboard', 'view_data' => $data);

            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

    public function Approvereporting() {
        if ($this->input->post()) {
            for ($i = 0; $i < count($this->input->post('approve')); $i++) {
                $empid = $this->input->post('approve');
                $data = array(
                    'Approve_Status' => 'Approved'
                );
                $this->db->where(array('VEEVA_Employee_ID' => $this->input->post('BDM_ID'), 'Doctor_Id' => $empid[$i], 'Product_Id' => $this->input->post('product')));
                $this->db->update('Rx_Actual', $data);
                // echo $this->db->last_query();
            }
            redirect('ASM/reporting_rx', 'refresh');
        }
    }

    public function Approve_reporting_Activity() {
        if ($this->input->post()) {
            for ($i = 0; $i < count($this->input->post('Doctor_Id')); $i++) {
                $doctorId = $this->input->post('Doctor_Id');
                $data = array(
                    'VEEVA_Employee_Id' => $this->input->post('BDM_ID'),
                );
                $data['Approve_Status'] = $this->input->post('approve_' . $doctorId[$i]);
                $this->db->where(array('VEEVA_Employee_ID' => $this->input->post('BDM_ID'), 'Doctor_Id' => $doctorId[$i], 'Product_Id' => $this->input->post('product')));
                $this->db->update('Activity_Reporting', $data);

                // echo $this->db->last_query();
            }
            redirect('ASM/activity_planning', 'refresh');
        }
    }

    public function reporting_activity() {

        if ($this->is_logged_in()) {
            $id2 = $this->session->userdata('VEEVA_Employee_ID');
            $result = $this->asm_model->rx_view($id2);
            $data['bdm'] = $this->Master_Model->generateDropdown($result, 'VEEVA_Employee_ID', 'Full_Name');
            $result2 = $this->Master_Model->BrandList($this->session->userdata('Division'));
            $data['product'] = $this->Master_Model->generateDropdown($result2, 'id', 'Brand_Name');
            $data['productlist'] = $result2;
            if ($this->input->post()) {
                $product = $this->input->post('product_id');
                $id = $this->input->post('rx_id');
                //echo $id;
                $this->Product_Id = $product;
                $result = $this->asm_model->rx_view($id2);

                //BDM Dropdown
                $data['bdm'] = $this->Master_Model->generateDropdown($result, 'VEEVA_Employee_ID', 'Full_Name', $id);
                $result2 = $this->Master_Model->BrandList($this->session->userdata('Division'));
                //Product List
                $data['product'] = $this->Master_Model->generateDropdown($result2, 'id', 'Brand_Name', $product);

                $data['productlist'] = NULL;
                $result = $this->User_model->getPlannedActivityDoctor2($id, $product);
                $data['Doctorlist'] = $this->User_model->generateActivityTable2($result, 'Reporting');
            }

            $data = array('title' => 'Report', 'content' => 'ASM/reporting_activity', 'backUrl' => 'ASM/dashboard', 'view_data' => $data);

            $this->load->view('template2', $data);
        } else {
            $this->logout();
        }
    }

}
