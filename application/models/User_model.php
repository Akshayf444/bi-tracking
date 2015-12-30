<?php

class User_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function create($data) {
        $this->db->insert('authentication', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function log($email, $pass) {
        $query = $this->db->get_where('authentication', array('email' => $email, 'password' => $pass,));
        return $query->row_array();
    }

    public function find_by_id($id) {
        if ($id === FALSE) {
            $query = $this->db->get('authentication');
            return $query->result_array();
        }

        $query = $this->db->get_where('authentication', array('auth_id' => $id));
        return $query->row_array();
    }
    public function find_by_emp_id($id) {
        $query = $this->db->get_where('work_exp', array('emp_id' => $id));
        return $query->row_array();
    }
    public function find_by_mobile($mobile) {
        $query = $this->db->get_where('forgetpassword', array('mobile' => $mobile));
        return $query->row_array();
    }
    public function update_code($data,$id) {
        $this->db->where(array('id' => $id));
        return $this->db->update('forgetpassword', $data);
    }
    public function update_password($data,$mobile) {
        $this->db->where(array('mobile' => $mobile));
        return $this->db->update('authentication', $data);
    }
    public function insert_code($data) {
        return $this->db->insert('forgetpassword', $data);
    }

    public function find_by_email($id, $mobile) {
        $sql = "select * from authentication
        where email='$id' OR mobile='$mobile'";
//        $query = $this->db->get_where('authentication', array('email' => $id,'mobile'=>$mobile));
       // echo $sql;
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function find_by_user_id($id) {
        if ($id === FALSE) {
            $query = $this->db->get('user');
            return $query->result_array();
        }

        $query = $this->db->get_where('user', array('auth_id' => $id));
        return $query->row_array();
    }

    public function find_by_user_id2($id) {

        $query = "SELECT *FROM user u
                    WHERE u.auth_id=$id";
        $query = $this->db->query($query);

        return $query->row_array();
    }

    public function user_qualification_by_id($id) {

        $query = $this->db->get_where('user_qualification', array('auth_id' => $id));
        return $query->row_array();
    }

    public function Add_detail($id, $data) {
        $entryExist = $this->Show_profile($id);

        if (!empty($entryExist)) {
            $this->db->where(array('auth_id' => $id));
            return $this->db->update('user', $data);
        } else {
            $data['created_at'] = date('Y-m_d H:i:s');
            return $this->db->insert('user', $data);
        }
    }

    public function Show_profile($id) {

        $this->db->select('user.*,address_master.*');
        $this->db->from('user');
        $this->db->join('address_master', 'address_master.auth_id = user.auth_id', 'left');
        $this->db->where('user.auth_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function Show_profile2($id) {
        $query = $this->db->get_where('address_master', array('auth_id' => $id));
        return $query->row_array();
    }

    public function education_master() {
        $query = $this->db->get('education_master');
        return $query->result();
    }

    public function user_qualification($data) {
        return $this->db->insert('user_qualification', $data);
    }

    public function user_qualification_update($data, $id) {
//        $data = array(
//            'qualification' => $this->input->post('qualification'),
//            'specialization' => $this->input->post('specialization'),
//            'institute' => $this->input->post('institute'),
//            'year' => $this->input->post('year'),
//            'updated_at' => date('Y-m-d H:i:s'),
//            'auth_id' => $id,
//        );
        $this->db->where(array('id' => $id));
        return $this->db->update('user_qualification', $data);
    }
    public function user_workexp_update($data, $id) {
   
        $this->db->where(array('emp_id' => $id));
        return $this->db->update('work_exp', $data);
    }

    public function project_add($id) {
        $data = array(
            'client' => $this->input->post('client'),
            'auth_id' => $id,
            'projects_title' => $this->input->post('projects_title'),
            'to' => $this->input->post('to'),
            'from' => $this->input->post('from'),
            'location' => $this->input->post('location'),
            'site' => $this->input->post('site'),
            'type' => $this->input->post('type'),
            'detail' => $this->input->post('detail'),
            'role' => $this->input->post('role'),
            'role_description' => $this->input->post('role_description'),
            'team_size' => $this->input->post('team_size'),
            'skill' => $this->input->post('skill'),
        );
        return $this->db->insert('user_project', $data);
    }

    public function project_by_id($id) {
        $query = $this->db->get_where('user_project', array('auth_id' => $id));
        return $query->row_array();
    }

    public function project_update($id) {
        $data = array(
            'client' => $this->input->post('client'),
            'projects_title' => $this->input->post('projects_title'),
            'to' => $this->input->post('to'),
            'from' => $this->input->post('from'),
            'location' => $this->input->post('location'),
            'site' => $this->input->post('site'),
            'type' => $this->input->post('type'),
            'detail' => $this->input->post('detail'),
            'role' => $this->input->post('role'),
            'role_description' => $this->input->post('role_description'),
            'team_size' => $this->input->post('team_size'),
            'skill' => $this->input->post('skill'),
        );
        $this->db->where(array('auth_id' => $id));
        return $this->db->update('user_project', $data);
    }

    public function view($id) {
        $query = "SELECT *,(l.location) AS cuurentloc,(lmm.location) AS preloc,(up.location) AS ploc,(up.role) AS prole,(u.role) AS rol  FROM user u
                    LEFT JOIN work_exp we
                    ON u.auth_id=we.auth_id
                    LEFT JOIN `location_master`lm
                    ON lm.loc_id=u.current_location
                    LEFT JOIN user_qualification uq
                    ON uq.auth_id=u.auth_id
                    LEFT JOIN education_master em
                    ON em.edu_id=uq.qualification
                    LEFT JOIN location_master l
                    ON l.loc_id=u.`current_location`
                    LEFT JOIN `location_master`lmm
                    ON lmm.loc_id=u.`prefred_location`
                    LEFT JOIN functional_area fa
                    ON fa.fun_id=u.`function_area`
                    LEFT JOIN industry_master ind
                    ON ind.indus_id=u.`industry`
                    LEFT JOIN address_master am
                    ON am.`auth_id`=u.`auth_id`
                    LEFT JOIN user_project up
                    ON up.`auth_id`=u.`auth_id`
                    WHERE u.auth_id=$id
                    ORDER BY we.emp_id DESC  LIMIT 1";
        $query = $this->db->query($query);

        return $query->row_array();
    }

    public function view2($id) {
        $query = "SELECT * FROM user_project
                   WHERE auth_id=$id";
        $query = $this->db->query($query);

        return $query->result();
    }

    public function qualification_view($id) {
        $query = "SELECT *,(uq.id) AS idd FROM user u
                    LEFT JOIN `user_qualification` uq
                    ON uq.`auth_id`=u.`auth_id`
                    LEFT JOIN `specialization_master` sp
                    ON sp.spec_id=uq.`specialization`
                    LEFT JOIN `institute_master`ins
                    ON ins.id=uq.`institute`
                    LEFT JOIN `education_master` edu 
                    ON edu.`edu_id`=uq.`qualification`
                    WHERE u.auth_id=$id";
        $query = $this->db->query($query);

        return $query->result();
    }

    public function qualification_view2($id) {
        $query = "SELECT (uq.id) AS id ,(edu.`qualification`) AS qualification,(sp.`specialization`) AS specialization,(ins.`institute`)  AS institute,(uq.`year`) AS year FROM user u
                    INNER JOIN `user_qualification` uq
                    ON uq.`auth_id`=u.`auth_id`
                    LEFT JOIN `specialization_master` sp
                    ON sp.spec_id=uq.`specialization`
                    LEFT JOIN `institute_master`ins
                    ON ins.id=uq.`institute`
                    LEFT JOIN `education_master` edu 
                    ON edu.`edu_id`=uq.`qualification`
                    WHERE u.auth_id=$id";
        $query = $this->db->query($query);

        return $query->result();
    }

    public function resume($name, $id) {
        $data = array(
            'resume' => $name,
            'detail' => $this->input->post('detail'),
            'created' => date('Y-m-d H:i:s'),
            'auth_id' => $id,
        );
        return $query = $this->db->insert('user_resume', $data);
    }

    public function resume2($name, $id, $detail, $old) {
        $data = array(
            'resume' => $name,
            'detail' => $detail,
            'created' => date('Y-m-d H:i:s'),
            'auth_id' => $id,
            'old' => $old,
        );
        return $query = $this->db->insert('user_resume', $data);
    }

    public function resume_view($id) {
        $query = "SELECT * FROM user_resume 
                    WHERE auth_id=$id
                    ORDER BY auth_id DESC LIMIT 1
                    ";
        $query = $this->db->query($query);

        return $query->result();
    }

    public function project_by_id2($id) {
        $query = $this->db->get_where('user_project', array('id' => $id));
        return $query->row_array();
    }

    public function qualification_by_id($id) {
        $query = $this->db->get_where('user_qualification', array('id' => $id));
        return $query->row_array();
    }

    public function project_update2() {
        $data = array(
            'client' => $this->input->post('client'),
            'projects_title' => $this->input->post('projects_title'),
            'to' => $this->input->post('to'),
            'from' => $this->input->post('from'),
            'location' => $this->input->post('location'),
            'site' => $this->input->post('site'),
            'type' => $this->input->post('type'),
            'detail' => $this->input->post('detail'),
            'role' => $this->input->post('role'),
            'role_description' => $this->input->post('role_description'),
            'team_size' => $this->input->post('team_size'),
            'skill' => $this->input->post('skill'),
        );

        $this->db->where(array('id' => $this->input->post('id')));
        return $this->db->update('user_project', $data);
    }

    public function project_update3($id, $data) {
        $this->db->where(array('id' => $id));
        return $this->db->update('user_project', $data);
    }

    public function update_qualification($data, $id) {
        $this->db->where(array('id' => $id));
        return $this->db->update('user_qualification', $data);
    }

    public function all_job($id, $skill) {
        $skills = explode(",", $skill);
        $query = "SELECT * FROM jobs j
                LEFT JOIN emp_profile ep
                ON j.auth_id=ep.`auth_id`
                LEFT JOIN `location_master` lm
                ON lm.loc_id=j.location
                LEFT JOIN `functional_area` fa
                ON j.functional_area=fa.fun_id 
                LEFT JOIN `industry_master` im
                ON im.indus_id=j.industry
                WHERE j.functional_area=$id ";

        if (!empty($skills)) {
            foreach ($skills as $value) {
                $query .= " OR j.keyword LIKE '%$value%' ";
            }
        }

        $query = $this->db->query($query);

        return $query->result();
    }

    public function all_job3($id, $skill, $user_id = 0) {
        $skills = explode(",", $skill);
        $query = "SELECT *,(j.job_id) as job_id ,(fa.fun_area) AS functional_area,(im.industry) AS industry,(CASE WHEN ap.job_id IS NOT NULL THEN 1 ELSE 0 END) AS applied_status FROM jobs j
                LEFT JOIN emp_profile ep
                ON j.auth_id=ep.`auth_id`
                LEFT JOIN `location_master` lm
                ON lm.loc_id=j.location
                LEFT JOIN `functional_area` fa
                ON j.functional_area=fa.fun_id 
                LEFT JOIN `industry_master` im
                ON im.indus_id=j.industry ";
        if ($user_id > 0) {
            $query .= "LEFT JOIN apply_job ap ON ap.job_id = j.job_id AND ap.auth_id = '$user_id'";
        }
        $query .= " WHERE j.functional_area=$id";

        if (!empty($skills)) {
            foreach ($skills as $value) {
                $query .= " OR j.keyword LIKE '%$value%' ";
            }
        }

        //echo $query;

        $query = $this->db->query($query);

        return $query->result();
    }

    public function all_job2() {
        $query = "SELECT *FROM jobs j
                LEFT JOIN emp_profile ep
                ON j.auth_id=ep.`auth_id`
                LEFT JOIN `location_master` lm
                ON lm.loc_id=j.location";
        $query = $this->db->query($query);

        return $query->result();
    }

    public function view_search($id) {
        $query = "SELECT *,(lm.`location`) AS loc FROM jobs j
                LEFT JOIN emp_profile ep
                ON j.auth_id=ep.`auth_id`
                LEFT JOIN `location_master` lm
                ON lm.loc_id=j.location
                LEFT JOIN `functional_area` fa
                ON fa.`fun_id`=j.`functional_area`
                LEFT JOIN `industry_master` im
                ON j.`industry`=im.`indus_id`
                WHERE j.`job_id`=$id";
        $query = $this->db->query($query);

        return $query->row_array();
    }

    public function changepassword($data, $id) {
        $this->db->where(array('auth_id' => $id));
        return $this->db->update('authentication', $data);
    }

    public function application($id) {
        $query = "SELECT * FROM apply_job aj
                LEFT JOIN jobs j
                ON aj.`job_id`=j.`job_id`
                LEFT JOIN `emp_profile` ep
                ON ep.`auth_id` =j.`auth_id`
                LEFT JOIN `functional_area` fa
                ON j.functional_area=fa.fun_id 
                LEFT JOIN `industry_master` im
                ON im.indus_id=j.industry
                LEFT JOIN `location_master` lm
                ON lm.`loc_id`=j.`location`
                WHERE aj.auth_id=$id";
        $query = $this->db->query($query);
        return $query->result();
    }

    public function saved_jobs($job_id, $auth_id) {
        $data = array(
            'job_id' => $job_id,
            'auth_id' => $auth_id,
            'created' => date('Y-m-d H:i:s'),
        );
        return $query = $this->db->insert('saved_jobs', $data);
    }

    public function saved_jobs_by_id($job_id, $auth_id) {
        $query = "SELECT * FROM saved_jobs sj
                WHERE job_id=$job_id AND auth_id=$auth_id";
        $query = $this->db->query($query);
        return $query->row_array();
    }

    public function viewsavedjobs($id) {
        $query = "SELECT *,(aj.`created`)AS creat FROM saved_jobs aj
                LEFT JOIN jobs j
                ON aj.`job_id`=j.`job_id`
                LEFT JOIN `emp_profile` ep
                ON ep.`auth_id` =j.`auth_id`
                LEFT JOIN `location_master` lm
                ON lm.`loc_id`=j.`location`
                WHERE aj.auth_id=$id";
        $query = $this->db->query($query);
        return $query->result();
    }

    public function user_resume($id) {
        $query = "SELECT * FROM `user_resume`ur 
                    WHERE ur.auth_id=$id
                    ORDER BY ur.`id` DESC LIMIT 1";
        $query = $this->db->query($query);
        return $query->row_array();
    }

    public function Add_skill($data, $id) {

        $this->db->where(array('auth_id' => $id));
        return $this->db->update('user', $data);
//        $query = "update user set `key_skill`=[$skill]  WHERE auth_id=$id";
//       return  $query = $this->db->query($query);
        //return $query->row_array();
    }

    public function verification($data) {

        return $query = $this->db->insert('user_verification', $data);
    }

    public function verification_update($id, $data) {

        $this->db->where(array('auth_id' => $id));
        return $this->db->update('user_verification', $data);
    }

    public function verification_by_id($id) {

        $query = "SELECT *FROM user_verification u
                    WHERE u.auth_id=$id";
        $query = $this->db->query($query);

        return $query->row_array();
    }

    public function check_code($id, $data) {

        $this->db->where(array('auth_id' => $id));
        return $this->db->update('user_verification', $data);
    }

    public function project_add2($data) {

        return $this->db->insert('user_project', $data);
    }

    public function personal_detail($id, $data) {

        $this->db->where(array('auth_id' => $id));
        return $this->db->update('user', $data);
    }

    public function veiw3($id) {

        $query = "SELECT * FROM `user_verification`
                    WHERE auth_id=$id";
        $query = $this->db->query($query);

        return $query->row_array();
    }

    public function work_exp_show($id) {

        $query = "SELECT * FROM `work_exp`
                    WHERE auth_id=$id";
        $query = $this->db->query($query);

        return $query->row_array();
    }

    public function show_alljobs($data, $user_id) {

        $query = "SELECT * ,CASE  WHEN ap.`job_id` IS NOT NULL THEN 1 ELSE 0 END AS applied_status,(fa.fun_area) AS functional_area,(im.industry) AS industry FROM jobs j
                LEFT JOIN emp_profile ep
                ON j.auth_id=ep.`auth_id`
                LEFT JOIN `location_master` lm
                ON lm.loc_id=j.location
                LEFT JOIN apply_job ap
                ON ap.`job_id`=j.`job_id`
                LEFT JOIN `functional_area` fa
                ON j.functional_area=fa.fun_id 
                LEFT JOIN `industry_master` im
                ON im.indus_id=j.industry
                WHERE j.`job_id` IN($data) AND ap.auth_id=$user_id";
        $query = $this->db->query($query);

        return $query->result();
    }

    public function project_delete($id) {

        $this->db->where('id', $id);
        return $this->db->delete('user_project');
    }

    public function delete_qualification($id) {

        $this->db->where('id', $id);
        return $this->db->delete('user_qualification');
    }

    public function show_workexp($id) {

        $query = "SELECT * FROM `work_exp` we
                    WHERE auth_id=$id";
        $query = $this->db->query($query);

        return $query->result();
    }
    public function bdm_authentication($username,$password) {

        $query = "SELECT * FROM bdm
                    WHERE bdm_empid=$username AND password=$password";
        $query = $this->db->query($query);

        return $query->row_array();
    }

    public function view4($id) {
        $query = "SELECT u.user_id,u.name,
            (CASE WHEN u.resume_headline='0' THEN '' ELSE u.resume_headline END) AS resume_headline,
            u.exp_year,u.experince_month,u.mobile,u.email,
            (CASE WHEN fa.fun_area IS NULL THEN '' ELSE fa.fun_area END) AS FunctionArea,
            (CASE WHEN am.address1 IS NULL THEN '' ELSE am.address1 END) AS address1,
            (CASE WHEN u.role='0' THEN '' ELSE u.role END) AS role,(CASE WHEN ind.industry IS NULL THEN '' ELSE ind.industry END) AS industry,
            (CASE WHEN am.city IS NULL THEN '' ELSE am.city END) AS city,
            (CASE WHEN am.pincode IS NULL THEN '' ELSE am.pincode END) AS pincode,
            (CASE WHEN u.dob='0000-00-00' THEN '' ELSE u.dob END) AS dob,
            (CASE WHEN u.gender='0' THEN '' ELSE u.gender END) AS gender,u.key_skill,
            (CASE WHEN u.marital_status='0' THEN '' ELSE u.marital_status END) AS marital_status,u.auth_id,
            (CASE WHEN we.designation IS NULL THEN '' ELSE we.designation END)as Designation ,(l.location) AS cuurentloc,
            (CASE WHEN lmm.location IS NULL THEN '' ELSE lmm.location END) AS preloc  FROM user u
                    
                    LEFT JOIN `location_master`lm
                    ON lm.loc_id=u.current_location
                    LEFT JOIN work_exp we
                    ON we.auth_id=u.auth_id
                    LEFT JOIN location_master l
                    ON l.loc_id=u.`current_location`
                    LEFT JOIN `location_master`lmm
                    ON lmm.loc_id=u.`prefred_location`
                    LEFT JOIN functional_area fa
                    ON fa.fun_id=u.`function_area`
                    LEFT JOIN industry_master ind
                    ON ind.indus_id=u.`industry`
                    LEFT JOIN address_master am
                    ON am.`auth_id`=u.`auth_id`
                    
                    WHERE u.auth_id=$id
                    ORDER BY we.emp_id DESC  LIMIT 1";
        $query = $this->db->query($query);

        return $query->row_array();
    }

    public function device_id($id, $data) {

        $this->db->where('auth_id', $id);
        return $this->db->update('authentication', $data);
    }

    public function percentage($user_id) {
        $view['profile'] = $this->User_model->view4($user_id);
        $view['projects'] = array_shift($this->User_model->view2($user_id));
        $view['qualification'] = array_shift($this->User_model->qualification_view2($user_id));
        $view['workexperince'] = array_shift($this->User_model->show_workexp($user_id));
        $maximumn = 31;
        $count = 0;
        $exclude_profile = array('name', 'exp_year', 'mobile', 'email', 'FunctionArea', 'address1',
            'role', 'industry', 'pincode', 'dob', 'gender', 'key_skill', 'marital_status', 'Designation', 'cuurentloc', 'preloc');
        $exclude_projects = array('projects_title', 'to', 'from', 'client', 'detail');
        $exclude_qualification = array('qualification', 'specialization', 'institute', 'year');
        $exclude_workexperince = array('emp_name', 'to', 'from', 'designation', 'job_profile', 'type');
        if (!empty($view)) {
            foreach ($exclude_profile as $value) {
                if ($view['profile'][$value] == '' || $view['profile'][$value] == '0' || $view['profile'][$value] == '0000-00-00') {
                    
                } else {
                    $count++;
                }
            }
            foreach ($exclude_projects as $value1) {
                if (!isset($view['projects']->{$value1}) || $view['projects']->{$value1} == '' || $view['projects']->{$value1} == 'NULL') {
                    
                } else {
                    $count++;
                }
            }
            foreach ($exclude_qualification as $value2) {
                if (!isset($view['qualification']->{$value2 }) || $view['qualification']->{$value2 } == '') {
                    
                } else {
                    $count++;
                }
            }
            foreach ($exclude_workexperince as $value3) {
                if (!isset($view['workexperince']->{$value3}) || $view['workexperince']->{$value3} == '') {
                    
                } else {
                    $count++;
                }
            }

            $total = ($count / $maximumn) * 100;
           
            return $total;
        }
    }

}
