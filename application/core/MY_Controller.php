<?php

class MY_Controller extends CI_Controller {

    public $VEEVA_Employee_ID;
    public $Local_Employee_ID;
    public $Designation;
    public $Reporting;
    public $Reporting_VEEVA_ID;
    public $Reporting_Local_ID;

    function __construct() {
        parent::__construct();
        $this->user_id = $this->session->userdata('VEEVA_Employee_ID');
        $this->user_type = $this->session->userdata('Local_Employee_ID');
        $this->level = $this->session->userdata('Reporting');
        $this->repname = $this->session->userdata('Reporting_VEEVA_ID');
        $this->repcode = $this->session->userdata('Reporting_Local_ID');
    }

    function is_logged_in() {
        if (!is_null($this->user_id) && $this->user_id > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_type');
        $this->session->unset_userdata('level');
        $this->session->unset_userdata('repname');
        $this->session->unset_userdata('repcode');
        $this->session->unset_userdata('div_id');
        redirect('User/login', 'refresh');
    }

}