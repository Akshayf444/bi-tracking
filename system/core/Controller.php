<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CI_Controller {

    private static $instance;
    protected $user_id;
    protected $user_type;

    /**
     * Constructor
     */
    public function __construct() {
        self::$instance = & $this;

        // Assign all the class objects that were instantiated by the
        // bootstrap file (CodeIgniter.php) to local class variables
        // so that CI can run as one big super object.
        foreach (is_loaded() as $var => $class) {
            $this->$var = & load_class($class);
        }

        $this->load = & load_class('Loader', 'core');

        $this->load->initialize();
        $this->user_id = $this->session->userdata('user_id');
        $this->user_type = $this->session->userdata('user_type');
        log_message('debug', "Controller Class Initialized");
    }

    public static function &get_instance() {
        return self::$instance;
    }

    function loadSidebar() {
        $menu;
        $user_type = $this->user_type;
        if ($user_type == 'Employee') {
            $menu['Sidebar'] = array(
//                'Inbox' => array(
//                ),
                'Profile' => array(
                    'View Profile' => 'Employee/profile'
                ),
                'Jobs & Application' => array(
                    'Add Jobs' => 'job/add',
                    ' View Jobs' => 'job/job_list',
                    ' Applied Jobs' => 'Job/view_applied_list'
                ),
                'Recruiters' => array(
                    'Search Resume' => 'Employee/resumesearch'
                ),
                'Settings' => array(
                     'Change Password' => 'Employee/changepassword'
                )
            );
        } elseif ($user_type == 'User') {
            $menu['Sidebar'] = array(
//                'Inbox' => array(
//                    'Message' => '#'
//                ),
                'Profile' => array(
                    'View Profile' => 'User/view',
                    'Project' => 'User/user_projects',
                    'Education' => 'User/user_qualification',
                    'Upload Resume' => 'User/resume',
                    'Enter Work Experince' => 'WorkExperince/work_exp',
                ),
                'Jobs & Application' => array(
                    'Saved Jobs' => 'User/viewsavedjobs',
                    'Application History' => 'User/Applicationhistory'
                ),
                'Recruiters' => array(
                    'Job & Updates' => 'User/SearchJob'
                ),
                'Settings' => array(
                    'Change Password' => 'User/changepassword'
                )
            );
        } else {
            
        }
        return $menu;
    }

    function loadNavigation() {
        $menu;
        $user_type = $this->user_type;
        if ($user_type == 'Employee') {
            $menu['Navbar'] = array(
                'About' => '#',
                'Company' => '#',
                'logout' => 'Employee/logout'
            );
        } elseif ($user_type == 'User') {
            $menu['Navbar'] = array(
                'About' => '#',
                'Company' => '#',
                'logout' => 'User/logout'
            );
        } else {
            
        }
        return $menu;
    }

}
