<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Users_setting extends Base_users
{
    private   $module_page         = array(
        'index'        => 'index',
        'user_setting' => 'user_setting',
        'index_footer' => 'footer_index',
    );
    protected $module_base                  = 'user/register';
    protected $apps_title_module_setting    = 'Setting';
    private   $_table                       = "users";
    protected $apps_output_message = array(
        'status'  => '',
        'title'   => '',
        'message' => ''
    );

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->lang->load('output_message');
        $this->load->helper(array('form', 'url','string'));
        $this->load->library('form_validation');
        $this->load->library('session');

        if(!empty($this->session->userdata('is_login') == FALSE)){
            // alert peringatan bahwa harus login
            $this->session->set_flashdata('failed','You are not logged in, please login first!');
            redirect(base_url('user/login'));
        }

    }


    protected function set_form_validation_setting($ID = FALSE)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '<br/>');
        /* SET FORM VALIDATION RULES FOR COLUMN */
        $this->form_validation->set_rules("name_full", "Full Name {$this->apps_title_module_setting}", 'required');
        $this->form_validation->set_rules("username", "Username {$this->apps_title_module_setting}", 'required');
        $this->form_validation->set_rules("email", "Email {$this->apps_title_module_setting}", 'required');
    }

    public function index()
    {
        $username =  $this->uri->segment(3);
        if ($this->input->post()) {
            $this->set_form_validation_setting();
            $this->update_setting_general();
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module_setting
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
			$data['promotions']  = $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result();
            $data["users"] = $this->db->get_where('users',["username" => $username])->row();
            if(empty($data["users"]->username) || $username != $_SESSION['username']){
                redirect('user/dashboard');
            }
            config('title', 'Settings - General');
            $this->display('user_setting', $data);
        }

    }

	/** General account setting */
    private function update_setting_general()
    {
        $username =  $this->uri->segment(3);
        if ($this->input->post('username') == true){
                $ids       = $this->input->post('id');
                $username  = $this->input->post('username');
                $country   = $this->input->post('country');
				$result_locations = [];
				if (!empty($country)) {
					$rows = $this->db->get_where('loc_countries', array('id'=>$country))->row();
					$result_locations[] = [
						'country_id' => $country,
						'country_name' => $rows->name,
					];
				}
                $user['username'] = $username;
				$user['data_locations'] = json_encode($result_locations);
                $this->db->where('users.id', $ids);
                $update = $this->db->update('users', $user);
                $this->session->set_userdata('username', $username);
                if($update == true){
                $this->session->set_flashdata('success', 'Account has been saved');
                }
        }
        $data['CSRF'] = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
		$data['promotions']  = $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result();
        $data["users"] = $this->db->get_where('users',["username" => $username])->row();
        $this->display('user_setting', $data);

    }

    public function settingSecurity()
    {
        $username =  $this->uri->segment(3);
        $checkuser = $this->db->get_where('users',["username" => $username])->row();
        if(empty($checkuser->username) || $username != $_SESSION['username']){
            redirect('user/dashboard');
        }
        if ($this->input->post()) {
            $this->set_form_validation_security();
            $this->update_setting_security();
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module_setting
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
		$data['promotions']  = $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result();
        $data["users"]      = $this->db->get_where('users',["username" => $username])->row();
        $data["user_session"]    = $this->db->get_where('users_devices_sess',["user_id" => $data["users"]->id])->result();
        if(!empty($data["users"]->data_secure_quest)){
            $quest = func_decrypt($data["users"]->data_secure_quest);
            foreach(json_decode($quest) as $value){
                $data["question"] = $value->question;
                $data["answare"] = $value->answare;
            }
        }
        config('title', 'Settings - Security & Login');
        $this->display('user_setting_security', $data);
        }

    }

    protected function set_form_validation_security($ID = FALSE)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '<br/>');
        /* SET FORM VALIDATION RULES FOR COLUMN */
        $this->form_validation->set_rules("old_pass", "New Password {$this->apps_title_module_setting}", 'required');
        $this->form_validation->set_rules("new_pass", "New Password {$this->apps_title_module_setting}", 'required');
    }

	/** update password login*/
    private function update_setting_security()
    {
        $user_id    = $this->input->post('user_id');
        $new_pass       = $this->input->post('new_pass');
        $confirm_pass = $this->input->post('confirm_pass');
        $old_pass   = $this->input->post('old_pass');
        $check = $this->db->get_where('users',['id' => $user_id])->row();
        if(password_verify($old_pass, $check->password) &&  (!strcmp($new_pass, $confirm_pass))){
                $user['password'] = password_hash($new_pass,PASSWORD_DEFAULT);
                $this->db->where('users.id', $user_id);
                $update = $this->db->update('users', $user);
                $this->session->set_flashdata('success', 'Account has been saved');
        }else{
            $update = 'Error';
            $this->session->set_flashdata('error', 'Passsword not match');
        }
        if($update){
            $data         = array(
                'apps_title_module' => $this->apps_title_module_setting
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
		$data['promotions']  = $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result();
        $data['token'] = $this->security->get_csrf_hash();
        $data["users"]      = $this->db->get_where('users',["id" => $user_id])->row();
        $data["user_session"]    = $this->db->get_where('users_devices_sess',["user_id" => $user_id])->result();
        if(!empty($data["users"]->data_secure_quest)){
            $quest = func_decrypt($data["users"]->data_secure_quest);
            foreach(json_decode($quest) as $value){
                $data["question"] = $value->question;
                $data["answare"] = $value->answare;
            }
        }
        $this->display('user_setting_security', $data);
        }

    }

	/** update setting privacy (Private / public) */
    public function settingPrivacy()
    {
        $username =  $this->uri->segment(3);
        $checkuser = $this->db->get_where('users',["username" => $username])->row();
        if(empty($checkuser->username) || $username != $_SESSION['username']){
            redirect('user/dashboard');
        }
        if ($this->input->post()) {
            $this->set_form_validation_privacy();
            $this->update_setting_privacy();
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module_setting
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
		$data['promotions']  = $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result();
        $data["users"] = $this->db->get_where('users',["username" => $username])->row();
        config('title', 'Settings - Privacy Setting & Tools');
        $this->display('user_setting_privacy', $data);
        }
    }

    protected function set_form_validation_privacy($ID = FALSE)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '<br/>');
        /* SET FORM VALIDATION RULES FOR COLUMN */
        $this->form_validation->set_rules("privacy", "Privacy {$this->apps_title_module_setting}", 'required');
    }

    private function update_setting_privacy()
    {
        $username =  $this->uri->segment(3);
        if ($this->form_validation->run() === false) {
                /** Scenario State Error from Form Validation */
                $this->session->set_flashdata('Error', 'Privacy not saved');
        }else{
            $ids       = $this->input->post('id');
            $privacy   = $this->input->post('privacy');
            $user['status_privacy'] = $privacy;
            $this->db->where('users.id', $ids);
            $update = $this->db->update('users', $user);
            if($update == true){
            $this->session->set_flashdata('success', 'Privacy has been saved');
            }
        }
        $data['CSRF'] = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];

        $data["users"] = $this->db->get_where('users',["username" => $username])->row();
        $this->display('user_setting_privacy', $data);
    }

    public function profile()
    {
        $username =  $this->uri->segment(3);
        $checkuser = $this->db->get_where('users',["username" => $username])->row();
        if(empty($checkuser->username) || $username != $_SESSION['username']){
            redirect('user/dashboard');
        }
        if ($this->input->post()) {
            $this->set_form_validation_setting_profile();
            $this->update_setting_profile();
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module_setting
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];

            $data_old = $this->db->get_where('users', array('username'=>$username))->row();
            $result2 = json_decode($data_old->data_exp_work, true);
            $result = array();
            foreach($result2 as $val){
                $company2 = $this->db->get_where('mst_works_experiences', array('id'=>$val['company_id']))->row();

                $result[] = array(
                   'id' => $val['id'],
                   'specialization' => $val['specialization'],
                   'company' => empty($company2->data_name) ? 'noname' : $company2->data_name,
                   'file_path' => empty($company2->file_path) ? '' : $company2->file_path,
                   'file_name_original' => empty($company2->file_name_original) ? '' : $company2->file_name_original,
                   'date_start' => $val['date_start'],
                   'date_end' => $val['date_end'],
                   'status' => !empty($val['status']) ? $val['status'] : 0,
                );
            }

            $result3 = json_decode($data_old->data_pro_hobby, true);
            $result4 = array();
            foreach($result3 as $val2){
                if(!empty($val2['hobby_id'])){
                    $hobby = $this->db->get_where('mst_hobbies', array('id'=>$val2['hobby_id']))->row();
                    $result4[] = array(
                        'hobby_id' => $hobby->id,
                        'name' => $hobby->data_name,
                        'file_name' => $hobby->file_name_original,
                        'file_path' => $hobby->file_path,
                    );
                }
            }
            $result5 = json_decode($data_old->data_pro_skills, true);
            $result6 = array();
            foreach($result5 as $val3){
                if(!empty($val3['skill_id'])){
                $skill = $this->db->get_where('mst_skills', array('id'=>$val3['skill_id']))->row();
                $result6[] = array(
                    'skill_id' => $skill->id,
                    'name' => $skill->data_name,
                    'file_name' => $skill->file_name_original,
                    'file_path' => $skill->file_path,
                );
                }
            }
            $result_edu_1 = json_decode($data_old->data_education, true);
            $result_edu_2 = array();
            foreach($result_edu_1 as $val){
                $education = $this->db->get_where('mst_educations', array('id'=>$val['education_id']))->row();
                $result_edu_2[] = array(
                   'id' => $val['id'],
                   'mayor' => $val['mayor'],
                   'campus' => $education->data_name,
                   'file_path' => $education->file_path,
                   'file_name_original' => $education->file_name_original,
                   'date_start' => $val['date_start'],
                   'date_end' => $val['date_end'],
                );
            }

            $result_lic_1 = json_decode($data_old->data_license, true);
            $result_lic_2 = array();
            foreach($result_lic_1 as $val){
                $license = $this->db->get_where('mst_licenses', array('id'=>$val['license_id']))->row();
                $result_lic_2[] = array(
                'id' => $val['id'],
                'study' => $val['study'],
                'school' => $license->data_name,
                'file_path' => $license->file_path,
                'file_name_original' => $license->file_name_original,
                'date_start' => $val['date_start'],
                'date_end' => $val['date_end'],
                );
            }

            $result_crs_1 = json_decode($data_old->data_crs_private, true);
            $result_crs_2 = array();
            foreach($result_crs_1 as $val){
                $course = $this->db->get_where('mst_courses_privates', array('id'=>$val['course_id']))->row();
                $result_crs_2[] = array(
                'id' => $val['id'],
                'study' => $val['study'],
                'school' => $course->data_name,
                'file_path' => $course->file_path,
                'file_name_original' => $course->file_name_original,
                'date_start' => $val['date_start'],
                'date_end' => $val['date_end'],
                );
            }

            $result_vol_1 = json_decode($data_old->data_exp_volunteer, true);
            $result_vol_2 = array();
            foreach($result_vol_1 as $val){
                $result_vol_2[] = array(
                'id' => $val['id'],
                'volunteer_name' => $val['volunteer'],
                'date_start' => $val['date_start'],
                'date_end' => $val['date_end'],
                );
            }


        $data["hobby"] = $this->db->get_where('mst_hobbies',array('status'=>1))->result();
        $data["list_hobby"] = $result4;
        $data["skill"] = $this->db->get_where('mst_skills',array('status'=>1))->result();
        $data["list_skill"] = $result6;
        $data["works"] = $result;
        $data["educations"] = $result_edu_2;
        $data["licenses"] = $result_lic_2;
        $data["courses"] = $result_crs_2;
        $data["volunteers"] = $result_vol_2;
		$data['promotions']  = $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result();
        $data["users"] = $this->db->get_where('users',["username" => $username])->row();
        $data["data_work_experiences"] = $this->db->get_where('mst_works_experiences',array('status'=>1))->result();
        $data["data_educations"] = $this->db->get_where('mst_educations',array('status'=>1))->result();
        $data["data_licenses"] = $this->db->get_where('mst_licenses',array('status'=>1))->result();
        $data["data_courses"] = $this->db->get_where('mst_courses_privates',array('status'=>1))->result();
        config('title', 'Settings - Edit Profile');
        $this->display('user_setting_profile', $data);
        }

    }

	/** Update setting profile */
    public function update_setting_profile(){
        $username =  $this->uri->segment(3);
		
        if ($this->form_validation->run() === false) {
                /** Scenario State Error from Form Validation */
                $this->session->set_flashdata('Error', 'Privacy not saved');
        }else{
            $ids         = $this->input->post('id');
            $this->photo_process($this->input->post('id'));
            $this->cover_process($this->input->post('id'));
            $name_first  = $this->input->post('name_first');
            $name_middle = $this->input->post('name_middle');
            $name_last   = $this->input->post('name_last');
            $about       = $this->input->post('about');
            $country   = $this->input->post('country');
            $result_locations = [];
            if (!empty($country)) {
                $rows = $this->db->get_where('loc_countries', array('id'=>$country))->row();
                $result_locations[] = [
                    'country_id' => $country,
                    'country_name' => $rows->name,
                ];
            }
            $user['data_locations'] = json_encode($result_locations);
            $user['name_first']      = $name_first;
            $user['name_middle']     = $name_middle;
            $user['name_last']       = $name_last;
            $user['data_status']     = $about;
            $this->db->where('users.id', $ids);
            $update = $this->db->update('users', $user);
            if($update == true){
            $this->session->set_flashdata('success', 'Profle has been saved');
            }
			redirect('profile/setting/'.$username);
        }
        $data['CSRF'] = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        $data_old = $this->db->get_where('users', array('username'=>$username))->row();
        $result2 = json_decode($data_old->data_exp_work, true);
        $result = array();
        foreach($result2 as $val){
            $company2 = $this->db->get_where('mst_works_experiences', array('id'=>$val['company_id']))->row();
            $result[] = array(
               'id' => $val['id'],
               'specialization' => $val['specialization'],
               'company' => $company2->data_name,
               'file_path' => $company2->file_path,
               'file_name_original' => $company2->file_name_original,
               'date_start' => $val['date_start'],
               'date_end' => $val['date_end'],
            );
        }

        $result3 = json_decode($data_old->data_pro_hobby, true);
        $result4 = array();
        foreach($result3 as $val2){
            $hobby = $this->db->get_where('mst_hobbies', array('id'=>$val2['hobby_id']))->row();
            $result4[] = array(
                'hobby_id' => $hobby->id,
                'name' => $hobby->data_name,
                'file_name' => $hobby->file_name_original,
                'file_path' => $hobby->file_path,
            );
        }
        $result5 = json_decode($data_old->data_pro_skills, true);
        $result6 = array();
        foreach($result5 as $val3){
            $skill = $this->db->get_where('mst_skills', array('id'=>$val3['skill_id']))->row();
            $result6[] = array(
                'skill_id' => $skill->id,
                'name' => $skill->data_name,
                'file_name' => $skill->file_name_original,
                'file_path' => $skill->file_path,
            );
        }

        $result_edu_1 = json_decode($data_old->data_education, true);
        $result_edu_2 = array();
        foreach($result_edu_1 as $val){
            $education = $this->db->get_where('mst_educations', array('id'=>$val['education_id']))->row();
            $result_edu_2[] = array(
               'id' => $val['id'],
               'mayor' => $val['mayor'],
               'campus' => $education->data_name,
               'file_path' => $education->file_path,
               'file_name_original' => $education->file_name_original,
               'date_start' => $val['date_start'],
               'date_end' => $val['date_end'],
            );
        }

        $result_lic_1 = json_decode($data_old->data_license, true);
        $result_lic_2 = array();
        foreach($result_lic_1 as $val){
            $license = $this->db->get_where('mst_licenses', array('id'=>$val['license_id']))->row();
            $result_lic_2[] = array(
               'id' => $val['id'],
               'study' => $val['study'],
               'school' => $license->data_name,
               'file_path' => $license->file_path,
               'file_name_original' => $license->file_name_original,
               'date_start' => $val['date_start'],
               'date_end' => $val['date_end'],
            );
        }

        $result_crs_1 = json_decode($data_old->data_crs_private, true);
        $result_crs_2 = array();
        foreach($result_crs_1 as $val){
            $course = $this->db->get_where('mst_courses_privates', array('id'=>$val['course_id']))->row();
            $result_crs_2[] = array(
               'id' => $val['id'],
               'study' => $val['study'],
               'school' => $course->data_name,
               'file_path' => $course->file_path,
               'file_name_original' => $course->file_name_original,
               'date_start' => $val['date_start'],
               'date_end' => $val['date_end'],
            );
        }

            $result_vol_1 = json_decode($data_old->data_exp_volunteer, true);
            $result_vol_2 = array();
            foreach($result_vol_1 as $val){
                $result_vol_2[] = array(
                'id' => $val['id'],
                'volunteer_name' => $val['volunteer'],
                'date_start' => $val['date_start'],
                'date_end' => $val['date_end'],
                );
            }
        $data["hobby"] = $this->db->get_where('mst_hobbies',array('status'=>1))->result();
        $data["list_hobby"] = $result4;
        $data["skill"] = $this->db->get_where('mst_skills',array('status'=>1))->result();
        $data["list_skill"] = $result6;
        $data["works"] = $result;
        $data["volunteers"] = $result_vol_2;
        $data["educations"] = $result_edu_2;
        $data["licenses"] = $result_lic_2;
        $data["courses"] = $result_crs_2;
        $data["users"] = $this->db->get_where('users',["username" => $username])->row();
        $this->display('user_setting_profile', $data);
    }

    protected function set_form_validation_setting_profile($ID = FALSE)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '<br/>');
        /* SET FORM VALIDATION RULES FOR COLUMN */
        $this->form_validation->set_rules("name_first", "First Name {$this->apps_title_module_setting}", 'required');
    }

    public function photo_process($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/user/profile/post/' . $parameter_id;
        $this->action_edit_process_photo($parameter_url_source, $parameter_id);
    }

    public function cover_process($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/user/profile/post/' . $parameter_id;
        $this->action_edit_process_cover($parameter_url_source, $parameter_id);
    }

    function searchCompany()
    {
        $q = $this->input->get('q');
        $this->load->model('M_setting');
        echo json_encode($this->M_setting->getCompany($q));
    }

    function searchEducation()
    {
        $q = $this->input->get('q');
        $this->load->model('M_setting');
        echo json_encode($this->M_setting->getEducation($q));
    }

    function searchLicense()
    {
        $q = $this->input->get('q');
        $this->load->model('M_setting');
        echo json_encode($this->M_setting->getLicense($q));
    }

    function searchCourse()
    {
        $q = $this->input->get('q');
        $this->load->model('M_setting');
        echo json_encode($this->M_setting->getCourse($q));
    }

    function searchSkill()
    {
        $q = $this->input->get('q');
        $this->load->model('M_setting');
        echo json_encode($this->M_setting->getSkill($q));
    }

    function searchHobby()
    {
        $q = $this->input->get('q');
        $this->load->model('M_setting');
        echo json_encode($this->M_setting->getHobby($q));
    }

    public function contactDelete()
    {
        $id                 = $this->input->post('id');
        $contact_id         = $this->input->post('contact_id');
        $url                = $this->input->post('form');
        $data_old           = $this->db->get_where('users', array('id'=>$id))->row();
        $result = json_decode($data_old->data_contact_info, true);
        foreach($result as $key => $val){
            if ($val['id'] === $contact_id) {
                array_splice($result, $key, 1);
            }
        }
        $this->db->where('users.id', $id);
        $contact['data_contact_info'] = json_encode($result, true);
        $update = $this->db->update('users', $contact);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect($url.'/'. $data_old->username);
    }

	/** Delete login session */
    function deleteLog()
    {
        $id = $this->input->post('id');
        $this->db->where('user_id',$id);
        $this->db->delete('users_devices_sess');
        $user   = $this->db->get_where('users', array('id'=>$id))->row();
        redirect('setting/security/'.$user->username);
    }

	/** Security Question */
    function question()
    {
        $id         = $this->input->post('user_id');
        $question   = $this->input->post('sec_quest');
        $answare    = $this->input->post('sec_answ');
        $result = array();
        $result[] = array(
           "question"   => $question,
           "answare"    => $answare
        );
        $quest['data_secure_quest'] = func_encrypt(json_encode($result, true));
        $update = $this->db->update('users', $quest);
        if($update == true){
            $this->session->set_flashdata('success', 'Question has been saved');
        }
        $user   = $this->db->get_where('users', array('id'=>$id))->row();
        redirect('setting/security/'.$user->username);
    }

	/** Email info setting */
    function email_store()
    {
        $username = $_SESSION['username'];
        $email_contact     = $this->input->post('email');
        $result = array();
        foreach($email_contact AS $key => $val){
			if(!empty($email_contact[$key])){
             $result[] = array(
              'id'              => random_string('alnum',20),
              'email_contact'   => $email_contact[$key],
             );
			}else{
				$this->session->set_flashdata('error', 'Data Not Null');
			}
        }
        $this->db->where('users.username', $username);
        $contact['data_contact_info'] = json_encode($result);
        $update = $this->db->update('users', $contact);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect('setting/general/'.$username);
    }
	
	/** setting phone number info */
    function phone_store()
    {
        $username = $_SESSION['username'];
        $phone_contact     = $this->input->post('phone');
        $result = array();
        foreach($phone_contact AS $key => $val){
			if(!empty($phone_contact[$key])){
             $result[] = array(
              'id'              => random_string('alnum',20),
              'phone_number'   => $phone_contact[$key],
             );
			}else{
				$this->session->set_flashdata('error', 'Data Not Null');
			}
        }
        $this->db->where('users.username', $username);
        $contact['phone'] = json_encode($result);
        $update = $this->db->update('users', $contact);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect('setting/general/'.$username);
    }

	/** Social Media Process */
    function website_store()
    {
        $username          = $_SESSION['username'];
        $website           = $this->input->post('website');
        $result = array();
        foreach($website AS $key => $val){
			if(!empty($website[$key])){
				$result[] = array(
				'id'        => random_string('alnum',20),
				'website'   => $website[$key],
				);
			}else{
				$this->session->set_flashdata('error', 'Data Not Null');
			}
        }
        $this->db->where('users.username', $username);
        $contact['data_contact_website'] = json_encode($result);
        $update = $this->db->update('users', $contact);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect('setting/general/'.$username);
    }

    public function website_delete($id)
    {
        $user_id    = $_SESSION['user_id'];
        $username   = $_SESSION['username'];
        $data_old           = $this->db->get_where('users', array('id'=>$user_id))->row();
        $result = json_decode($data_old->data_contact_website, true);
        foreach($result as $key => $val){
            if ($val['id'] === $id) {
                array_splice($result, $key, 1);
            }
        }
        $this->db->where('users.id', $user_id);
        $contact['data_contact_website'] = json_encode($result, true);
        $update = $this->db->update('users', $contact);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect('setting/general/'.$username);
    }

    public function email_delete($id)
    {
        $user_id    = $_SESSION['user_id'];
        $username   = $_SESSION['username'];
        $data_old           = $this->db->get_where('users', array('id'=>$user_id))->row();
        $result = json_decode($data_old->data_contact_info, true);
        foreach($result as $key => $val){
            if ($val['id'] === $id) {
                array_splice($result, $key, 1);
            }
        }
        $this->db->where('users.id', $user_id);
        $contact['data_contact_info'] = json_encode($result, true);
        $update = $this->db->update('users', $contact);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect('setting/general/'.$username);
    }

    public function phone_delete($id)
    {
        $user_id    = $_SESSION['user_id'];
        $username   = $_SESSION['username'];
        $data_old           = $this->db->get_where('users', array('id'=>$user_id))->row();
        $result = json_decode($data_old->phone, true);
        foreach($result as $key => $val){
            if ($val['id'] === $id) {
                array_splice($result, $key, 1);
            }
        }
        $this->db->where('users.id', $user_id);
        $contact['phone'] = json_encode($result, true);
        $update = $this->db->update('users', $contact);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect('setting/general/'.$username);
    }

	/** Social media Setting */
    function socmed_store()
    {
        $username          = $_SESSION['username'];
        $facebook           = $this->input->post('facebook');
        $linkedin           = $this->input->post('linkedin');
        $instagram          = $this->input->post('instagram');
        $result = array();
             $result[] = array(
              'facebook'    => $facebook,
              'linkedin'    => $linkedin,
              'instagram'   => $instagram
             );

        $this->db->where('users.username', $username);
        $contact['data_contact_socialmedia'] = json_encode($result);
        $update = $this->db->update('users', $contact);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect('setting/general/'.$username);
    }
}
