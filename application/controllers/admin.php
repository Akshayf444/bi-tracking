<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function index() {
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));

            $validUser = $this->admin_model->login($username, $password);


            redirect('admin/dashboard', 'refresh');
        }
        $data = array('title' => 'Login', 'content' => 'admin/login', 'view_data' => 'blank');
        $this->load->view('template1', $data);
    }

    public function dashboard() {
        $data = array('title' => 'Main', 'content' => 'admin/Main', 'view_data' => 'blank');
        $this->load->view('template2', $data);
    }

    public function logout() {
        redirect('admin/index', 'refresh');
    }

    public function hq_master() {
        if ($_POST) {
            $data = array(
                'name' => $this->input->post('name'),
                'zone' => $this->input->post('zone')
            );
            $this->admin_model->insert($data);
            redirect('admin/insert_data', 'refresh');
        }
        $data = array('title' => 'Login', 'content' => 'admin/add_hq', 'view_data' => 'blank');
        $this->load->view('template2', $data);
    }

    public function manage() {
        if ($this->input->post()) {
            $team = $this->input->post('team');
            if ($team == 'asm') {
                $check['team1'] = $this->admin_model->asm();
            }
            elseif ($team == 'zsm') {
                $check['team2'] = $this->admin_model->zsm();
            }
            elseif ($team == 'bdm'){
                $check['team3'] = $this->admin_model->bdm();
            }
            else
            {
                $check['team4'] ='';
            }
        }

        $data = array('title' => 'Login', 'content' => 'admin/Manage', 'view_data' => $check);
        $this->load->view('template2', $data);
    }

}
