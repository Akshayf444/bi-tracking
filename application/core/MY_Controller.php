<?php

class MY_Controller extends CI_Controller {

    public $VEEVA_Employee_ID;
    public $Local_Employee_ID;
    public $Designation;
    public $Reporting_To;
    public $Reporting_VEEVA_ID;
    public $Reporting_Local_ID;
    public $Division;
    public $Full_Name;
    public $table_name;
    public $Product_Id = 0;
    public $nextMonth = 0;
    public $nextYear;

    function __construct() {
        parent::__construct();
        $this->VEEVA_Employee_ID = $this->session->userdata('VEEVA_Employee_ID');
        $this->Local_Employee_ID = $this->session->userdata('Local_Employee_ID');
        $this->Reporting_To = $this->session->userdata('Reporting_To');
        $this->Reporting_VEEVA_ID = $this->session->userdata('Reporting_VEEVA_ID');
        $this->Reporting_Local_ID = $this->session->userdata('Reporting_Local_ID');
        $this->Designation = $this->session->userdata('Designation');
        $this->Division = $this->session->userdata('Division');
        $this->Full_Name = $this->session->userdata('Full_Name');
        $this->Product_Id = $this->session->userdata('Product_Id');
        $this->nextMonth = date('n', strtotime('+1 month'));
        $this->nextYear = date('Y', strtotime('+1 month'));
    }

    function is_logged_in() {
        if (!is_null($this->VEEVA_Employee_ID) && $this->VEEVA_Employee_ID != '') {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function logout() {
        $this->session->unset_userdata('VEEVA_Employee_ID');
        $this->session->unset_userdata('Local_Employee_ID');
        $this->session->unset_userdata('Designation');
        $this->session->unset_userdata('Reporting');
        $this->session->unset_userdata('Reporting_VEEVA_ID');
        $this->session->unset_userdata('Reporting_Local_ID');
        redirect('User/login', 'refresh');
    }

}
