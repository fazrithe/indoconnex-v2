<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Users_profile extends Base_users
{
    protected $module_base                  = 'user/profile/post';
    protected $apps_title_module            = 'profile';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Mcarbon');
        $this->load->model('M_profile');
        if(!empty($this->session->userdata('is_login') == FALSE)){
            // alert peringatan bahwa harus login
            $this->session->set_flashdata('failed','You are not logged in, please login first!');
            redirect(base_url('user/login'));
        }
    }

    public function index()
    {
        $username =  $this->uri->segment(2);
        $user_data = $this->db->get_where('users', array('username'=>$username))->row();
        if(empty($user_data->username)){
            redirect('user/dashboard');
        }
        $id = $user_data->id;
        if ($this->input->post()) {
            $this->set_form_validation();
            switch ($this->input->post('form')) {
                case 'cover':
                    $this->cover_process($this->input->post('id'));
                    break;
                case 'photo':
                    $this->photo_process($this->input->post('id'));
                    break;
                case 'skill':
                    $this->skill_process($this->input->post('id'));
                    break;
                case 'hobby':
                    $this->hobby_add($this->input->post('id'));
                    break;
                default:
                    echo "Isi variabel tidak di temukan";
                    break;
            }
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module
            );
            $data['CSRF'] = [
                'id' => $_SESSION['user_id'],
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
            $data_old = $this->db->get_where('users', array('id'=>$id))->row();
            $result2 = json_decode($data_old->data_exp_work, true);
            $result = [];
            if(!empty($result2)){
                foreach($result2 as $val){
                    $company2 = $this->db->get_where('mst_works_experiences', array('id'=>$val['company_id']))->row();
                    if(!empty($company2)){
						$result[] = array(
							'id' => $val['id'],
							'specialization' => $val['specialization'],
							'company' => $company2->data_name,
							'file_path' => $company2->file_path,
							'file_name_original' => $company2->file_name_original,
							'date_start' => $val['date_start'],
							'date_end' => $val['date_end'],
							'status' => !empty($val['status']) ? $val['status'] : 0,
						);
                    }
                }
            }

            $result3 = json_decode($data_old->data_pro_hobby, true);
            $result4 = [];
            if(!empty($result3)){
                foreach($result3 as $val2){
                    $hobby = $this->db->get_where('mst_hobbies', array('id'=>$val2['hobby_id']))->row();
                    if(!empty($hobby)){
                        $result4[] = array(
                            'hobby_id' => $hobby->id,
                            'name' => $hobby->data_name,
                            'file_name' => $hobby->file_name_original,
                            'file_path' => $hobby->file_path,
                        );
                    }
                }
            }

            $result5 = json_decode($data_old->data_pro_skills, true);
            $result6 = [];
            if(!empty($result5)){
                foreach($result5 as $val3){
                    $skill = $this->db->get_where('mst_skills', array('id'=>$val3['skill_id']))->row();
                    if(!empty($skill)){
                        $result6[] = array(
                            'skill_id' => $skill->id,
                            'name' => $skill->data_name,
                            'file_name' => $skill->file_name_original,
                            'file_path' => $skill->file_path,
                        );
                    }
                }
            }

            $result_edu_1 = json_decode($data_old->data_education, true);
            $result_edu_2 = [];
            if(!empty($result_edu_1)){
                foreach($result_edu_1 as $val){
                    $education = $this->db->get_where('mst_educations', array('id'=>$val['education_id']))->row();
                    if(!empty($education)){
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
                }
            }

            $result_lic_1 = json_decode($data_old->data_license, true);
            $result_lic_2 = [];
            if(!empty($result_lic_1)){
                foreach($result_lic_1 as $val){
                    $license = $this->db->get_where('mst_licenses', array('id'=>$val['license_id']))->row();
                    if(!empty($license)){
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
                }
            }

            $result_crs_1 = json_decode($data_old->data_crs_private, true);
            $result_crs_2 = [];
            if(!empty($result_crs_1)){
                foreach($result_crs_1 as $val){
                    $course = $this->db->get_where('mst_courses_privates', array('id'=>$val['course_id']))->row();
                    if(!empty($course)){
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
                }
            }

            $result_vol_1 = json_decode($data_old->data_exp_volunteer, true);
            $result_vol_2 = [];
            if(!empty($result_vol_1)) {
                foreach($result_vol_1 as $val){
                    $result_vol_2[] = array(
                    'id' => $val['id'],
                    'volunteer_name' => $val['volunteer'],
                    'date_start' => $val['date_start'],
                    'date_end' => $val['date_end'],
                    );
                }
            }
            if($data_old->data_exp_work){
                $current_work = json_decode($data_old->data_exp_work, true);
                $result_current = [];
                if(!empty($current_work)){
                    foreach($current_work as $val){
                        $company2 = $this->db->get_where('mst_works_experiences', array('id'=>$val['company_id']))->row();
                        if(!empty($company2)){
                            $result_current[] = array(
                                'company' => $company2->data_name,
                                'status' => !empty($val['status']) ? $val['status'] : 0,
                            );
                        }
                    }
                }

            }
        $data['current_work']  = !empty($result_current) ? $result_current : '';
        $user_id =  $_SESSION['user_id'];
        $check_like = $this->db->get_where('pfe_media_likes')->result();
        $checklikes = $this->db->query('select * from pfe_media_likes');
        $resultchecklikes = $checklikes->num_rows();
        $data["hobby"]          = $this->db->get_where('mst_hobbies',array('status'=>1))->result();
        $data["list_hobby"]     = $result4;
        $data["skill"]          = $this->db->get_where('mst_skills',array('status'=>1))->result();
        $data["list_skill"]     = $result6;
        $data["skills"]         = $this->db->get_where('mst_skills',array('status'=>1))->result();
        $data["works"]          = $result;
        $data["educations"]     = $result_edu_2;
        $data["licenses"]       = $result_lic_2;
        $data["courses"]        = $result_crs_2;
        $data["volunteers"]        = $result_vol_2;
        $data["users"]          = $this->db->get_where('users',array('id'=>$user_id))->row();
        $data["users_profile"]          = $this->db->get_where('users',array('id'=>$id))->row();
        $data['posts']          = $this->M_profile->post($id)->result();
        $data['post_articles']  = $this->M_profile->post_article($id)->result();
        $data["all_likes"]      = $this->db->get_where('pfe_media_likes')->result();
        $data['likes']          = $resultchecklikes;
        $data['comments']       = $this->M_profile->show_comment()->result();
        $data['count_comment']  = $this->M_profile->count_comment();
        $data['count_follows']  = $this->M_profile->count_follow($id);
        $data['business_categories'] = $this->db->get_where('pbd_business_categories',array('status' => 1))->result();
        $data['business_types'] = $this->db->get('pbd_business_types')->result();
        $data['community']  = $this->db->get_where('pcs_communities',array('users_id'=>$id))->result();
        $data['business_list']     = $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result();
        $data['jobs_categories']  = $this->db->get_where('pcj_jobs_categories',array('status' => 1))->result();
        $data['jobs_types']  = $this->db->get_where('pcj_jobs_types',array('status' => 1))->result();
        $data['distributor_types']  = $this->db->get_where('pbd_business_distributor_types',array('status' => 1))->result();
        $data['meta_position']	= $id;
		$result =  $this->db->select('user_follow_id')->get_where('users_follows', array('user_id' => $user_id))->result();

		$friends = [];
		foreach ($result as $key) {
			$friends[] = $key->user_follow_id;
		}
        $data['friends'] = $friends;
        if($data['users_profile']->id == $_SESSION['user_id']){
            $data['checkusers_profile'] = 1;
        }else{
            $data['checkusers_profile'] = '';
        }

		if($id != $_SESSION['user_id']){
			$check  = $this->db->get_where('user_views',['view_id' => $id]);
			if($check->num_rows() < 1){
				$user['user_id']  	= $id;
				$user['view_id'] 	= $_SESSION['user_id'];
				$user['created_at'] = date('Y-m-d H:i:s'); 
				$this->db->insert('user_views', $user);
			}
		}

        config('title', $data["users_profile"]->name_first . ' ' . $data["users_profile"]->name_middle . ' ' . $data["users_profile"]->name_last);
        $this->display('index', $data);
        }
    }

    protected function set_form_validation($ID = FALSE)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '<br/>');
        /* SET FORM VALIDATION RULES FOR COLUMN */
        $this->form_validation->set_rules("__file", "Cover {$this->apps_title_module}", 'required');
    }

	/** process photo cover */
    public function cover_process($parameter_id = null)
    {
		// var_dump(123);exit;
        $parameter_url_source = $this->module_url_default . '/user/post/' . $parameter_id;
        $this->action_edit_process_cover($parameter_url_source, $parameter_id);
    }

	/** process photo cover */
    public function photo_process($parameter_id = null)
    {
        $parameter_upload_destination = null;
        $parameter_upload_size_maximum = array(
            'original'  => 1136,
            'thumbnail' => 160
        );

        /**
         *  1. Process upload image to server
         *  2. validate file type and size
         *  3. create multiple file for other dimension proportional
         */

        $path_original  = 'public/uploads/users_photo_profile/photo';
        $parameter_upload_column_name = '__photo_files';
        $this->load->library('image_upload_resize');
        $config["generate_image_file"]          = true;
        $config["image_max_size"]               = $parameter_upload_size_maximum['original'];                    // MAXIMUM IMAGE SIZE (HEIGHT AND WIDTH)                                                    // NORMAL THUMB PREFIX
        $config["destination_folder"]           = "{$path_original}/";                                           // UPLOAD DIRECTORY ENDS WITH / (SLASH)                                      // UPLOAD DIRECTORY ENDS WITH / (SLASH)
        $config["quality"]                      = 90;                                                            // JPEG QUALITY
        $config["random_file_name"]             = TRUE;                                                          // RANDOMIZE EACH FILE NAME
        $config["upload_url"]                   = base_url($path_original) . '/';

        $config["file_data"]    = $_FILES[$parameter_upload_column_name];
        $upload_image_responses = $this->image_upload_resize->resize($config);

        if (!empty($upload_image_responses['images'])) {
            foreach ($upload_image_responses["images"] as $index => $response) {
                $config["destination_folder"] = str_replace('//', '/', $config["destination_folder"]);
                    $name_original_photo  = $response;
                    $file_path_photo      = $config["destination_folder"];
            }
        }

        $post['id'] = $this->generate_new_id_string() . get_random_alphanumeric(5);
        $post['users_id'] = $_SESSION['user_id'];
        $post['file_image_name_original'] = $name_original_photo;
        $post['file_image_path'] = $file_path_photo;
        $post['created_at'] = date('Y-m-d H:i:s');

        $this->db->insert('activities_users_photo_profile', $post);

        $parameter_url_source = $this->module_url_default . '/user/post/' . $parameter_id;
        $this->action_edit_process_photo($parameter_url_source, $parameter_id);

    }

    public function skill_process($parameter_id = null)
    {
        $url =  $this->uri->segment(3);
        $this->form_validation->set_rules('skills[]', 'Skills', 'trim|required');

        $skills = $this->input->post('skills');

        $result = [];
        foreach($skills AS $key => $val){
            $skill = $this->db->get_where('mst_skills', array('id'=>$skills[$key]))->row();
             $result[] = array(
              'name' => $skill->data_name,
              'file_name' => $skill->file_name_original,
              'file_path' => $skill->file_path,
             );
        }

        $this->db->where('users.id', $parameter_id);
        $contact['data_pro_skills'] = json_encode($result);
        $update = $this->db->update('users', $contact);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        $data['CSRF'] = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];

        $data         = array(
            'apps_title_module' => $this->apps_title_module
        );
        $data['CSRF'] = [
            'id' => $parameter_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        $data["hobby"] = $this->db->get_where('mst_hobbies',array('status'=>1))->result();
        $data["skills"] = $this->db->get_where('mst_skills',array('status'=>1))->result();
        $data["users"] = $this->db->get_where('users',array('id'=>$parameter_id))->row();
        redirect($url.'/'.$data["users"]->username);
    }


	/** add hobby */
    public function hobby_add()
    {
        $this->set_form_validation();
        $this->form_validation->set_rules('hobbies[]', 'hobby', 'trim|required');

        $user_id    = $this->input->post('id');
        $user_data = $this->db->get_where('users', array('id'=>$user_id))->row();
        $hobbies    = $this->input->post('hobbies');
        $url           = $this->input->post('form');
		if(!empty($hobbies)){
        foreach($hobbies AS $key => $val){
			
            $check_skill = $this->db->get_where('mst_hobbies', array('id'=>$hobbies[$key]));
            }
            if($check_skill->num_rows() < 1){
                $post['id']          = random_string('alnum',20);
                $post['data_name']   = $val;
                $post['published']   = date('Y-m-d H:i:s');
                $post['status']      = 1;
                $post['created_by']  = $_SESSION['user_id'];
                $post['created_at']  = date('Y-m-d H:i:s');
                $post['updated_by']  = $_SESSION['user_id'];
                $post['updated_at']  = date('Y-m-d H:i:s');
                $this->db->insert('mst_hobbies', $post);
                $result = [];
                foreach($hobbies AS $key => $val){
                 $result[] = array(
                    'hobby_id'          => $post['id'],
                );
                }
                $data_old = $this->db->get_where('users', array('id'=>$user_id))->row();
                $result2 = json_decode($data_old->data_pro_skills, true);
                foreach($result2 as $val){
                    $hobby2 = $this->db->get_where('mst_hobbies', array('id'=>$val['hobby_id']))->row();
                    if(!empty($hobby2)){
                        $result[] = array(
                            'hobby_id' => $hobby2->id,
                        );
                    }else{
                        $result[] = array(
                            'hobby_id' => $hobby2->id,
                        );
                    }
                }
            }else{

                $result = [];
                foreach($hobbies AS $key => $val){
                $hobby = $this->db->get_where('mst_hobbies', array('id'=>$hobbies[$key]))->row();
                $result[] = array(
                    'hobby_id'          => $hobby->id,
                );
                }
                $data_old = $this->db->get_where('users', array('id'=>$user_id))->row();
                $result2 = json_decode($data_old->data_pro_hobby, true);
                foreach($result2 as $val){
                    $hobby2 = $this->db->get_where('mst_hobbies', array('id'=>$val['hobby_id']))->row();
                    $result[] = array(
                        'hobby_id' => $hobby2->id,
                    );
                }
            }
		}else{
	        redirect(''.$url.'/'.$user_data->username);
		}
        $this->db->where('users.id', $user_id);
        $contact['data_pro_hobby'] = json_encode($result, true);
        $update = $this->db->update('users', $contact);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect(''.$url.'/'.$user_data->username);
    }

	/** add Skill */
    public function skill_add()
    {
        $this->set_form_validation();
        $this->form_validation->set_rules('skills[]', 'Skill', 'trim|required');

        $user_id    = $this->input->post('id');
		$user_data = $this->db->get_where('users', array('id'=>$user_id))->row();
        $skills    = $this->input->post('skills');
        $url           = $this->input->post('form');
		if(!empty($skills)){
        foreach($skills AS $key => $val){
        $check_skill = $this->db->get_where('mst_skills', array('id'=>$skills[$key]));
        }
        if($check_skill->num_rows() < 1){
            $post['id']          = random_string('alnum',20);
            $post['data_name']   = $val;
            $post['published']   = date('Y-m-d H:i:s');
            $post['status']      = 1;
            $post['created_by']  = $_SESSION['user_id'];
            $post['created_at']  = date('Y-m-d H:i:s');
            $post['updated_by']  = $_SESSION['user_id'];
            $post['updated_at']  = date('Y-m-d H:i:s');
            $this->db->insert('mst_skills', $post);
            $result = [];
            foreach($skills AS $key => $val){
             $result[] = array(
                'skill_id'          => $post['id'],
            );
            }
            $data_old = $this->db->get_where('users', array('id'=>$user_id))->row();
            $result2 = json_decode($data_old->data_pro_skills, true);
            foreach($result2 as $val){
                $skill2 = $this->db->get_where('mst_skills', array('id'=>$val['skill_id']))->row();
                if(!empty($hobby2)){
                    $result[] = array(
                        'skill_id' => $skill2->id,
                    );
                }else{
                    $result[] = array(
                        'skill_id' => $skill2->id,
                    );
                }
            }
        }else{

            $result = [];
            foreach($skills AS $key => $val){
            $skill = $this->db->get_where('mst_skills', array('id'=>$skills[$key]))->row();
            $result[] = array(
                'skill_id'          => $skill->id,
            );
            }
            $data_old = $this->db->get_where('users', array('id'=>$user_id))->row();
            $result2 = json_decode($data_old->data_pro_skills, true);
            foreach($result2 as $val){
                $skill2 = $this->db->get_where('mst_skills', array('id'=>$val['skill_id']))->row();
                $result[] = array(
                    'skill_id' => $skill2->id,
                );
            }
        }
		}else{
			redirect(''.$url.'/'.$user_data->username);
		}
            $this->db->where('users.id', $user_id);
            $contact['data_pro_skills'] = json_encode($result, true);
            $update = $this->db->update('users', $contact);
            if($update == true){
                $this->session->set_flashdata('success', 'Account has been saved');
            }
        redirect($url.'/'.$data_old->username);
        
    }

	/** Work Experience prcess */
    public function work_process()
    {
        $url =  $this->uri->segment(3);
        $id =  $this->uri->segment(4);
        $this->set_form_validation();
        $this->form_validation->set_rules('specilaization', 'Specialization', 'trim|required');
        $this->form_validation->set_rules('company', 'Company', 'trim|required');

        $work_id       = random_string('alnum',20);
        $sp            = $this->input->post('specialization');
        $companies     = $this->input->post('company');
        $date_start    = $this->input->post('date_start');
        $date_end      = $this->input->post('date_end');
        $url           = $this->input->post('form');
        $current       = $this->input->post('current');
        if(!empty($current)){
            $checkcurrent = 1;
        }else{
            $checkcurrent = 0;
        }
        $check_company = $this->db->get_where('mst_works_experiences', array('id'=>$companies));

        if($check_company->num_rows() < 1){
            $post['id']          = random_string('alnum',20);
            $post['data_name']   = $companies;
            $post['published']   = date('Y-m-d H:i:s');
            $post['status']      = 1;
            $post['created_by']  = $_SESSION['user_id'];
            $post['created_at']  = date('Y-m-d H:i:s');
            $post['updated_by']  = $_SESSION['user_id'];
            $post['updated_at']  = date('Y-m-d H:i:s');
            $this->db->insert('mst_works_experiences', $post);
            $result = [];
                $company = $this->db->get_where('mst_works_experiences', array('id'=>$companies))->row();
                $result[] = array(
                    'id'             => random_string('alnum',20),
                    'company_id'     => $post['id'],
                    'specialization' => $sp,
                    'date_start'     => $date_start,
                    'date_end'       => $date_end,
                    'status'         => $checkcurrent,
                );
            $data_old = $this->db->get_where('users', array('id'=>$id))->row();
            $result2 = json_decode($data_old->data_exp_work, true);
            foreach($result2 as $val){
                $company2 = $this->db->get_where('mst_works_experiences', array('id'=>$val['company_id']))->row();
                if(!empty($company2) && $checkcurrent == 1){
                    $result[] = array(
                        'id' => $val['id'],
                        'company_id' => $company2->id,
                        'specialization' => $val['specialization'],
                        'date_start' => $val['date_start'],
                        'date_end' => $val['date_end'],
                        'status'  => 0,
                    );
                }else{
                    $result[] = array(
                        'id' => $val['id'],
                        'company_id' => $company2->id,
                        'specialization' => $val['specialization'],
                        'date_start' => $val['date_start'],
                        'date_end' => $val['date_end'],
                        'status'  => $val['status'],
                    );
                }
            }
        }else{
            $result = [];
                $company = $this->db->get_where('mst_works_experiences', array('id'=>$companies))->row();
                $result[] = array(
                    'id'             => $work_id,
                    'company_id'     => $company->id,
                    'specialization' => $sp,
                    'date_start'     => $date_start,
                    'date_end'       => $date_end,
                    'status'         => $current,
                );
            $data_old = $this->db->get_where('users', array('id'=>$id))->row();
            $result2 = json_decode($data_old->data_exp_work, true);
            foreach($result2 as $val){
                $company2 = $this->db->get_where('mst_works_experiences', array('id'=>$val['company_id']))->row();
                if($checkcurrent == 1){
                    $result[] = array(
                        'id' => $val['id'],
                        'company_id' => $company2->id,
                        'specialization' => $val['specialization'],
                        'date_start' => $val['date_start'],
                        'date_end' => $val['date_end'],
                        'status'  => 0,
                    );
                }else{
                    $result[] = array(
                        'id' => $val['id'],
                        'company_id' => $company2->id,
                        'specialization' => $val['specialization'],
                        'date_start' => $val['date_start'],
                        'date_end' => $val['date_end'],
                        'status'  => $val['status'],
                    );
                }
            }
        }
        $this->db->where('users.id', $id);
        $contact['data_exp_work'] = json_encode($result, true);
        $update = $this->db->update('users', $contact);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect($url.'/'.$data_old->username);
    }

    public function education_add()
    {
        $url =  $this->uri->segment(3);
        $id =  $this->uri->segment(4);
        $this->set_form_validation();
        $this->form_validation->set_rules('campus', 'Specialization', 'trim|required');
        $this->form_validation->set_rules('mayor', 'Company', 'trim|required');

        $edu_id        = random_string('alnum',20);
        $mayor         = $this->input->post('mayor');
        $campus        = $this->input->post('campus');
        $date_start    = $this->input->post('date_start');
        $date_end      = $this->input->post('date_end');
        $url           = $this->input->post('form');
        $check_education = $this->db->get_where('mst_educations', array('id'=>$campus));

        if($check_education->num_rows() < 1){
            $post['id']          = random_string('alnum',20);
            $post['data_name']   = $campus;
            $post['published']   = date('Y-m-d H:i:s');
            $post['status']      = 1;
            $post['created_by']  = $_SESSION['user_id'];
            $post['created_at']  = date('Y-m-d H:i:s');
            $post['updated_by']  = $_SESSION['user_id'];
            $post['updated_at']  = date('Y-m-d H:i:s');
            $this->db->insert('mst_educations', $post);
            $result = [];
            $education = $this->db->get_where('mst_educations', array('id'=>$campus))->row();
            $result[] = array(
                'id'             => random_string('alnum',20),
                'education_id'   => $post['id'],
                'mayor'          => $mayor,
                'date_start'     => $date_start,
                'date_end'       => $date_end,
            );
        $data_old = $this->db->get_where('users', array('id'=>$id))->row();
        $result2 = json_decode($data_old->data_education, true);
        foreach($result2 as $val){
            $education2 = $this->db->get_where('mst_educations', array('id'=>$val['education_id']))->row();
            if(!empty($education2)){
                $result[] = array(
                    'id'                => $val['id'],
                    'education_id'      => $education2->id,
                    'mayor'             => $val['mayor'],
                    'date_start'        => $val['date_start'],
                    'date_end'          => $val['date_end'],
                );
            }
        }
        }else{
                $result = [];
                $education = $this->db->get_where('mst_educations', array('id'=>$campus))->row();
                $result[] = array(
                    'id'             => $edu_id,
                    'education_id'   => $education->id,
                    'mayor'          => $mayor,
                    'date_start'     => $date_start,
                    'date_end'       => $date_end,
                );
            $data_old = $this->db->get_where('users', array('id'=>$id))->row();
            $result2 = json_decode($data_old->data_education, true);
            foreach($result2 as $val){
                $education2 = $this->db->get_where('mst_educations', array('id'=>$val['education_id']))->row();
                $result[] = array(
                    'id'                => $val['id'],
                    'education_id'      => $education2->id,
                    'mayor'             => $val['mayor'],
                    'date_start'        => $val['date_start'],
                    'date_end'          => $val['date_end'],
                );
            }
        }
        $this->db->where('users.id', $id);
        $contact['data_education'] = json_encode($result, true);
        $update = $this->db->update('users', $contact);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect($url.'/'.$data_old->username);
    }

    public function license_add()
    {
        $url =  $this->uri->segment(3);
        $id =  $this->uri->segment(4);
        $this->set_form_validation();
        $this->form_validation->set_rules('school', 'Study', 'trim|required');
        $this->form_validation->set_rules('study', 'Study', 'trim|required');

        $lic_id        = random_string('alnum',20);
        $study         = $this->input->post('study');
        $school        = $this->input->post('school');
        $date_start    = $this->input->post('date_start');
        $date_end      = $this->input->post('date_end');
        $url           = $this->input->post('form');
        $check_license = $this->db->get_where('mst_licenses', array('id'=>$school));

        if($check_license->num_rows() < 1){
            $post['id']          = random_string('alnum',20);
            $post['data_name']   = $school;
            $post['published']   = date('Y-m-d H:i:s');
            $post['status']      = 1;
            $post['created_by']  = $_SESSION['user_id'];
            $post['created_at']  = date('Y-m-d H:i:s');
            $post['updated_by']  = $_SESSION['user_id'];
            $post['updated_at']  = date('Y-m-d H:i:s');
            $this->db->insert('mst_licenses', $post);
            $result = [];
            $license = $this->db->get_where('mst_licenses', array('id'=>$school))->row();
             $result[] = array(
                'id'             => random_string('alnum',20),
                'license_id'     => $post['id'],
                'study'          => $study,
                'date_start'     => $date_start,
                'date_end'       => $date_end,
             );
            $data_old = $this->db->get_where('users', array('id'=>$id))->row();
            $result2 = json_decode($data_old->data_license, true);
            foreach($result2 as $val){
                $license2 = $this->db->get_where('mst_licenses', array('id'=>$val['license_id']))->row();
                if(!empty($licencse2)){
                $result[] = array(
                    'id'                => $val['id'],
                    'license_id'        => $license2->id,
                    'study'             => $val['study'],
                    'date_start'        => $val['date_start'],
                    'date_end'          => $val['date_end'],
                );
                }
            }
        }else{
            $result = [];
            $license = $this->db->get_where('mst_licenses', array('id'=>$school))->row();
             $result[] = array(
                'id'             => $lic_id,
                'license_id'     => $license->id,
                'study'          => $study,
                'date_start'     => $date_start,
                'date_end'       => $date_end,
             );
            $data_old = $this->db->get_where('users', array('id'=>$id))->row();
            $result2 = json_decode($data_old->data_license, true);
            foreach($result2 as $val){
                $license2 = $this->db->get_where('mst_licenses', array('id'=>$val['license_id']))->row();
                $result[] = array(
                    'id'                => $val['id'],
                    'license_id'        => $license2->id,
                    'study'             => $val['study'],
                    'date_start'        => $val['date_start'],
                    'date_end'          => $val['date_end'],
                );
            }
        }
        $this->db->where('users.id', $id);
        $contact['data_license'] = json_encode($result, true);
        $update = $this->db->update('users', $contact);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect($url.'/'.$data_old->username);
    }

    public function course_add()
    {
        $url =  $this->uri->segment(3);
        $id =  $this->uri->segment(4);
        $this->set_form_validation();
        $this->form_validation->set_rules('school', 'Study', 'trim|required');
        $this->form_validation->set_rules('study', 'Study', 'trim|required');

        $lic_id        = random_string('alnum',20);
        $study         = $this->input->post('study');
        $school        = $this->input->post('school');
        $date_start    = $this->input->post('date_start');
        $date_end      = $this->input->post('date_end');
        $url           = $this->input->post('form');
        $check_courses = $this->db->get_where('mst_courses_privates', array('id'=>$school));

        if($check_courses->num_rows() < 1){
            $post['id']          = random_string('alnum',20);
            $post['data_name']   = $school;
            $post['published']   = date('Y-m-d H:i:s');
            $post['status']      = 1;
            $post['created_by']  = $_SESSION['user_id'];
            $post['created_at']  = date('Y-m-d H:i:s');
            $post['updated_by']  = $_SESSION['user_id'];
            $post['updated_at']  = date('Y-m-d H:i:s');
            $this->db->insert('mst_courses_privates', $post);
            $result = [];
            $course = $this->db->get_where('mst_courses_privates', array('id'=>$school))->row();
             $result[] = array(
                'id'             => random_string('alnum',20),
                'course_id'      => $post['id'],
                'study'          => $study,
                'date_start'     => $date_start,
                'date_end'       => $date_end,
             );
            $data_old = $this->db->get_where('users', array('id'=>$id))->row();
            $result2 = json_decode($data_old->data_crs_private, true);
            foreach($result2 as $val){
                $course2 = $this->db->get_where('mst_courses_privates', array('id'=>$val['course_id']))->row();
                if(!empty($course)){
                $result[] = array(
                    'id'                => $val['id'],
                    'course_id'         => $course2->id,
                    'study'             => $val['study'],
                    'date_start'        => $val['date_start'],
                    'date_end'          => $val['date_end'],
                );
                }
            }
        }else{
            $result = [];
            $course = $this->db->get_where('mst_courses_privates', array('id'=>$school))->row();
             $result[] = array(
                'id'             => $lic_id,
                'course_id'      => $course->id,
                'study'          => $study,
                'date_start'     => $date_start,
                'date_end'       => $date_end,
             );
            $data_old = $this->db->get_where('users', array('id'=>$id))->row();
            $result2 = json_decode($data_old->data_crs_private, true);
            foreach($result2 as $val){
                $course2 = $this->db->get_where('mst_courses_privates', array('id'=>$val['course_id']))->row();
                $result[] = array(
                    'id'                => $val['id'],
                    'course_id'         => $course2->id,
                    'study'             => $val['study'],
                    'date_start'        => $val['date_start'],
                    'date_end'          => $val['date_end'],
                );
            }
        }
        $this->db->where('users.id', $id);
        $contact['data_crs_private'] = json_encode($result, true);
        $update = $this->db->update('users', $contact);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect($url.'/'.$data_old->username);
    }

    public function volunteer_add()
    {
        $url =  $this->uri->segment(3);
        $id =  $this->uri->segment(4);
        $this->set_form_validation();
        $this->form_validation->set_rules('volunter_name', 'Name', 'trim|required');

        $lic_id        = random_string('alnum',20);
        $volunteer     = $this->input->post('volunteer_name');
        $date_start    = $this->input->post('date_start');
        $date_end      = $this->input->post('date_end');
        $url           = $this->input->post('form');
        $result = [];
             $result[] = array(
                'id'             => $lic_id,
                'volunteer'          => $volunteer,
                'date_start'     => $date_start,
                'date_end'       => $date_end,
             );
        $data_old = $this->db->get_where('users', array('id'=>$id))->row();
        $result2 = json_decode($data_old->data_exp_volunteer, true);
        foreach($result2 as $val){
             $result[] = array(
                'id'                => $val['id'],
                'volunteer'    => $volunteer,
                'date_start'        => $val['date_start'],
                'date_end'          => $val['date_end'],
             );
        }
        $this->db->where('users.id', $id);
        $contact['data_exp_volunteer'] = json_encode($result, true);
        $update = $this->db->update('users', $contact);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect($url.'/'.$data_old->username);
    }

    public function volunteer_update()
    {
        $url =  $this->uri->segment(3);
        $this->set_form_validation();
        $this->form_validation->set_rules('volunteer_name', 'Name', 'trim|required');
        $id            = $this->input->post('id');
        $volunteer_id  = $this->input->post('volunteer_id');
        $volunteer         = $this->input->post('volunteer_name');
        $date_start    = $this->input->post('date_start');
        $date_end      = $this->input->post('date_end');
        $url           = $this->input->post('form');
        $data_old = $this->db->get_where('users', array('id'=>$id))->row();
        $result = json_decode($data_old->data_exp_volunteer, true);
        foreach($result as $key => $val){
            if ($val['id'] === $volunteer_id) {
                $result[$key]['volunteer'] = $volunteer;
                $result[$key]['date_start'] = $date_start;
                $result[$key]['date_end'] = $date_end;
            }
        }

        $this->db->where('users.id', $id);
        $license['data_exp_volunteer'] = json_encode($result, true);
        $update = $this->db->update('users', $license);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect($url.'/'.$data_old->username);
    }

    public function volunteer_delete()
    {
        $id                 = $this->input->post('id');
        $volunteer_id       = $this->input->post('volunteer_id');
        $url                = $this->input->post('form');
        $data_old = $this->db->get_where('users', array('id'=>$id))->row();
        $result = json_decode($data_old->data_exp_volunteer, true);
        foreach($result as $key => $val){
            if ($val['id'] === $volunteer_id) {
                array_splice($result, $key, 1);
            }
        }
        $this->db->where('users.id', $id);
        $contact['data_exp_volunteer'] = json_encode($result, true);
        $update = $this->db->update('users', $contact);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect($url.'/'.$data_old->username);
    }

    public function work_update()
    {
        $url =  $this->uri->segment(3);
        $this->set_form_validation();
        $this->form_validation->set_rules('specilaization', 'Specialization', 'trim|required');
        $this->form_validation->set_rules('company', 'Company', 'trim|required');
        $id            = $this->input->post('id');
        $experience_id = $this->input->post('experience_id');
        $sp            = $this->input->post('specialization');
        $companies     = $this->input->post('company');
        $date_start    = $this->input->post('date_start');
        $date_end      = $this->input->post('date_end');
        $url           = $this->input->post('form');
        $current       = $this->input->post('current');
        if(!empty($current)){
            $checkcurrent = 1;
        }else{
            $checkcurrent = 0;
        }
        $data_old = $this->db->get_where('users', array('id'=>$id))->row();
        $result = json_decode($data_old->data_exp_work, true);
        foreach($result as $key => $val){
            if ($val['id'] === $experience_id) {
                $result[$key]['specialization'] = $sp;
                $result[$key]['date_start'] = $date_start;
                $result[$key]['date_end'] = $date_end;
                $result[$key]['date_end'] = $date_end;
                $result[$key]['status']  = $checkcurrent;
            }else{
                $result[$key]['company_id'] = $val['company_id'];
                $result[$key]['specialization'] = $sp;
                $result[$key]['date_start'] = $date_start;
                $result[$key]['date_end'] = $date_end;
                $result[$key]['date_end'] = $date_end;
                $result[$key]['status']  = 0;
            }

        }
        $this->db->where('users.id', $id);
        $contact['data_exp_work'] = json_encode($result, true);
        $update = $this->db->update('users', $contact);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect($url.'/'.$data_old->username);
    }

    public function education_update()
    {
        $url =  $this->uri->segment(3);
        $this->set_form_validation();
        $this->form_validation->set_rules('mayor', 'Mayor', 'trim|required');
        $id            = $this->input->post('id');
        $education_id  = $this->input->post('education_id');
        $mayor         = $this->input->post('mayor');
        $date_start    = $this->input->post('date_start');
        $date_end      = $this->input->post('date_end');
        $url           = $this->input->post('form');
        $data_old = $this->db->get_where('users', array('id'=>$id))->row();
        $result = json_decode($data_old->data_education, true);
        foreach($result as $key => $val){
            if ($val['id'] === $education_id) {
                $result[$key]['mayor'] = $mayor;
                $result[$key]['date_start'] = $date_start;
                $result[$key]['date_end'] = $date_end;
            }
        }

        $this->db->where('users.id', $id);
        $education['data_education'] = json_encode($result, true);
        $update = $this->db->update('users', $education);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect($url.'/'.$data_old->username);
    }

    public function license_update()
    {
        $url =  $this->uri->segment(3);
        $this->set_form_validation();
        $this->form_validation->set_rules('study', 'Study', 'trim|required');
        $id            = $this->input->post('id');
        $license_id    = $this->input->post('license_id');
        $study         = $this->input->post('study');
        $date_start    = $this->input->post('date_start');
        $date_end      = $this->input->post('date_end');
        $url           = $this->input->post('form');
        $data_old = $this->db->get_where('users', array('id'=>$id))->row();
        $result = json_decode($data_old->data_license, true);
        foreach($result as $key => $val){
            if ($val['id'] === $license_id) {
                $result[$key]['study'] = $study;
                $result[$key]['date_start'] = $date_start;
                $result[$key]['date_end'] = $date_end;
            }
        }

        $this->db->where('users.id', $id);
        $license['data_license'] = json_encode($result, true);
        $update = $this->db->update('users', $license);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect($url.'/'.$data_old->username);
    }

    public function course_update()
    {
        $url =  $this->uri->segment(3);
        $this->set_form_validation();
        $this->form_validation->set_rules('study', 'Study', 'trim|required');
        $id            = $this->input->post('id');
        $course_id     = $this->input->post('course_id');
        $study         = $this->input->post('study');
        $date_start    = $this->input->post('date_start');
        $date_end      = $this->input->post('date_end');
        $url           = $this->input->post('form');
        $data_old = $this->db->get_where('users', array('id'=>$id))->row();
        $result = json_decode($data_old->data_crs_private, true);
        foreach($result as $key => $val){
            if ($val['id'] === $course_id) {
                $result[$key]['study'] = $study;
                $result[$key]['date_start'] = $date_start;
                $result[$key]['date_end'] = $date_end;
            }
        }

        $this->db->where('users.id', $id);
        $license['data_crs_private'] = json_encode($result, true);
        $update = $this->db->update('users', $license);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect($url.'/'.$data_old->username);
    }

	/** Work experience delete */
    public function work_delete()
    {
        $id                 = $this->input->post('id');
        $experience_id      = $this->input->post('experience_id');
        $url      = $this->input->post('form');
        $data_old = $this->db->get_where('users', array('id'=>$id))->row();
        $result = json_decode($data_old->data_exp_work, true);
        foreach($result as $key => $val){
            if ($val['id'] === $experience_id) {
                array_splice($result, $key, 1);
            }
        }
        $this->db->where('users.id', $id);
        $contact['data_exp_work'] = json_encode($result, true);
        $update = $this->db->update('users', $contact);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect($url.'/'.$data_old->username);
    }

    public function education_delete()
    {
        $id                 = $this->input->post('id');
        $education_id       = $this->input->post('education_id');
        $url      = $this->input->post('form');
        $data_old = $this->db->get_where('users', array('id'=>$id))->row();
        $result = json_decode($data_old->data_education, true);
        foreach($result as $key => $val){
            if ($val['id'] === $education_id) {
                array_splice($result, $key, 1);
            }
        }
        $this->db->where('users.id', $id);
        $education['data_education'] = json_encode($result, true);
        $update = $this->db->update('users', $education);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect($url.'/'.$data_old->username);
    }

    public function license_delete()
    {
        $id             = $this->input->post('id');
        $license_id     = $this->input->post('license_id');
        $url            = $this->input->post('form');
        $data_old       = $this->db->get_where('users', array('id'=>$id))->row();
        $result = json_decode($data_old->data_license, true);
        foreach($result as $key => $val){
            if ($val['id'] === $license_id) {
                array_splice($result, $key, 1);
            }
        }
        $this->db->where('users.id', $id);
        $license['data_license'] = json_encode($result, true);
        $update = $this->db->update('users', $license);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect($url.'/'.$data_old->username);
    }

    public function course_delete()
    {
        $id             = $this->input->post('id');
        $course_id      = $this->input->post('course_id');
        $url            = $this->input->post('form');

        $data_old       = $this->db->get_where('users', array('id'=>$id))->row();
        $result = json_decode($data_old->data_crs_private, true);
        foreach($result as $key => $val){
            if ($val['id'] === $course_id) {
                array_splice($result, $key, 1);
            }
        }
        $this->db->where('users.id', $id);
        $course['data_crs_private'] = json_encode($result, true);
        $update = $this->db->update('users', $course);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        redirect($url.'/'.$data_old->username);
    }

	/** Delete Hobby */
    public function hobby_delete()
    {
        $url1 =  $this->uri->segment(2);
        $url2 =  $this->uri->segment(6);
        $id =  $this->uri->segment(4);
        $hobby_id =  $this->uri->segment(5);
        $data_old = $this->db->get_where('users', array('id'=>$id))->row();
        $result = json_decode($data_old->data_pro_hobby, true);
        foreach($result as $key => $val){
            if ($val['hobby_id'] === $hobby_id) {
                array_splice($result, $key, 1);
            }
        }
        $this->db->where('users.id', $id);
        $hobby['data_pro_hobby'] = json_encode($result, true);
        $update = $this->db->update('users', $hobby);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        if($url2 == 'setting'){
            redirect('profile/'.$url2.'/'.$data_old->username);
        }else{
            redirect($url2.'/'.$data_old->username);
        }
    }

	/** Delete Skill */
    public function skill_delete()
    {
        $url1 =  $this->uri->segment(2);
        $url2 =  $this->uri->segment(6);
        $id =  $this->uri->segment(4);
        $skill_id =  $this->uri->segment(5);
        $data_old = $this->db->get_where('users', array('id'=>$id))->row();
        $result = json_decode($data_old->data_pro_skills, true);
        foreach($result as $key => $val){
            if ($val['skill_id'] === $skill_id) {
                array_splice($result, $key, 1);
            }
        }
        $this->db->where('users.id', $id);
        $skill['data_pro_skills'] = json_encode($result, true);
        $update = $this->db->update('users', $skill);
        if($update == true){
            $this->session->set_flashdata('success', 'Account has been saved');
        }
        if($url2 == 'setting'){
            redirect('profile/'.$url2.'/'.$data_old->username);
        }else{
            redirect($url2.'/'.$data_old->username);
        }
    }


    public function about()
    {
        $username =  $this->uri->segment(2);
        $user_data = $this->db->get_where('users', array('username'=>$username))->row();
        if(empty($user_data->username)){
            redirect('user/dashboard');
        }
        $id = $user_data->id;
        if ($this->input->post()) {
            $this->set_form_validation();
            switch ($this->input->post('form')) {
                case 'cover':
                    $this->cover_process($this->input->post('id'));
                    break;
                case 'photo':
                    $this->photo_process($this->input->post('id'));
                    break;
                case 'skill':
                    $this->skill_process($this->input->post('id'));
                    break;
                case 'hobby':
                    $this->hobby_add($this->input->post('id'));
                    break;
                case 'work':
                    $this->work_process($this->input->post('id'));
                    break;
                default:
                    echo "Isi variabel tidak di temukan";
                    break;
            }
        } else {

            $data         = array(
                'apps_title_module' => $this->apps_title_module
            );
            $data['CSRF'] = [
                'id' => $id,
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];

            $data_old = $this->db->get_where('users', array('id'=>$id))->row();
            $result = [];
            if($data_old->data_exp_work){
                $result2 = json_decode($data_old->data_exp_work, true);
                if(!empty($result2)){
                    foreach($result2 as $val){
                        $company2 = $this->db->get_where('mst_works_experiences', array('id'=>$val['company_id']))->row();
                        if(!empty($val['date_start'])) {
                            $start =  MCarbon::createMidnightDate(MCarbon::createFromFormat('d/m/Y', $val['date_start'])->format('Y-m-d'));
                        }
                        if(!empty($val['date_end'])) {
                            $end = MCarbon::createMidnightDate(MCarbon::createFromFormat('d/m/Y', $val['date_end'])->format('Y-m-d'));
                            if($start->diffInYears($end) == 0){
                                $daterange = $start->diffInMonths($end).' month';
                            }else{
                                $daterange = $start->diffInYears($end).' years';
                            }
                        }else{
                            $daterange = null;
                        }
                        if(!empty($company2)){
                            $result[] = array(
                                'id' => $val['id'],
                                'specialization' => $val['specialization'],
                                'company' => $company2->data_name,
                                'file_path' => $company2->file_path,
                                'file_name_original' => $company2->file_name_original,
                                'date_start' => $val['date_start'],
                                'date_end' => $val['date_end'],
                                'status' => !empty($val['status']) ? $val['status'] : 0,
                                'rangedate' => $daterange,
                            );
                        }
                    }
                }

            }

            $result4 = [];
            if($data_old->data_pro_hobby){
                $result3 = json_decode($data_old->data_pro_hobby, true);
                foreach($result3 as $val2){
                    if($val2['hobby_id']){
                    $hobby = $this->db->get_where('mst_hobbies', array('id'=>$val2['hobby_id']))->row();
                    $result4[] = array(
                        'hobby_id' => $hobby->id,
                        'name' => $hobby->data_name,
                        'file_name' => $hobby->file_name_original,
                        'file_path' => $hobby->file_path,
                    );
                    }
                }
            }
            $result6 = [];
            if($data_old->data_pro_skills){
                $result5 = json_decode($data_old->data_pro_skills, true);
                foreach($result5 as $val3){
                    if($val3['skill_id']){
                    $skill = $this->db->get_where('mst_skills', array('id'=>$val3['skill_id']))->row();
                    $result6[] = array(
                        'skill_id' => $skill->id,
                        'name' => $skill->data_name,
                        'file_name' => $skill->file_name_original,
                        'file_path' => $skill->file_path,
                    );
                     }
                }
            }
            $result_edu_2 = [];
            if($data_old->data_education){
                $result_edu_1 = json_decode($data_old->data_education, true);
                foreach($result_edu_1 as $val){
                    $education = $this->db->get_where('mst_educations', array('id'=>$val['education_id']))->row();
                    if (!empty($val['date_start'])) {
                        $start =  MCarbon::createMidnightDate(MCarbon::createFromFormat('d/m/Y', $val['date_start'])->format('Y-m-d'));
                    }
                    if (!empty($val['date_end'])) {
                        $end = MCarbon::createMidnightDate(MCarbon::createFromFormat('d/m/Y', $val['date_end'])->format('Y-m-d'));
                        if($start->diffInYears($end) == 0){
                            $daterange = $start->diffInMonths($end).' month';
                        }else{
                            $daterange = $start->diffInYears($end).' years';
                        }
                    }else{
                        $daterange = null;
                    }
                    $result_edu_2[] = array(
                    'id' => $val['id'],
                    'mayor' => $val['mayor'],
                    'campus' => $education->data_name,
                    'file_path' => $education->file_path,
                    'file_name_original' => $education->file_name_original,
                    'date_start' => $val['date_start'],
                    'date_end' => $val['date_end'],
                    'rangedate' => $daterange,
                    );
                }
            }

            $result_lic_2 = [];
            if($data_old->data_license){
                $result_lic_1 = json_decode($data_old->data_license, true);
                foreach($result_lic_1 as $val){
                    $license = $this->db->get_where('mst_licenses', array('id'=>$val['license_id']))->row();
                    if (!empty($val['date_start'])) {
                        $start =  MCarbon::createMidnightDate(MCarbon::createFromFormat('d/m/Y', $val['date_start'])->format('Y-m-d'));
                    }
                    if (!empty($val['date_end'])) {
                        $end = MCarbon::createMidnightDate(MCarbon::createFromFormat('d/m/Y', $val['date_end'])->format('Y-m-d'));
                        if($start->diffInYears($end) == 0){
                            $daterange = $start->diffInMonths($end).' month';
                        }else{
                            $daterange = $start->diffInYears($end).' years';
                        }
                    }else{
                        $daterange = null;
                    }
                    $result_lic_2[] = array(
                    'id' => $val['id'],
                    'study' => $val['study'],
                    'school' => $license->data_name,
                    'file_path' => $license->file_path,
                    'file_name_original' => $license->file_name_original,
                    'date_start' => $val['date_start'],
                    'date_end' => $val['date_end'],
                    'rangedate' => $daterange,
                    );
                }
            }

            $result_crs_1 = json_decode($data_old->data_crs_private, true);
            $result_crs_2 = [];
            if (!empty($result_crs_1)) {
                foreach($result_crs_1 as $val){
                    $course = $this->db->get_where('mst_courses_privates', array('id'=>$val['course_id']))->row();
                    if (!empty($val['date_start'])) {
                        $start =  MCarbon::createMidnightDate(MCarbon::createFromFormat('d/m/Y', $val['date_start'])->format('Y-m-d'));
                    }
                    if (!empty($val['date_end'])) {
                        $end = MCarbon::createMidnightDate(MCarbon::createFromFormat('d/m/Y', $val['date_end'])->format('Y-m-d'));
                        if($start->diffInYears($end) == 0){
                            $daterange = $start->diffInMonths($end).' month';
                        }else{
                            $daterange = $start->diffInYears($end).' years';
                        }
                    }else{
                        $daterange = null;
                    }
                    $result_crs_2[] = array(
                    'id' => $val['id'],
                    'study' => $val['study'],
                    'school' => $course->data_name,
                    'file_path' => $course->file_path,
                    'file_name_original' => $course->file_name_original,
                    'date_start' => $val['date_start'],
                    'date_end' => $val['date_end'],
                    'rangedate' => $daterange,
                    );
                }
            }

            $result_vol_1 = json_decode($data_old->data_exp_volunteer, true);
            $result_vol_2 = [];
            if (!empty($result_vol_1)) {
                foreach($result_vol_1 as $val){
                    if (!empty($val['date_start'])) {
                        $start =  MCarbon::createMidnightDate(MCarbon::createFromFormat('d/m/Y', $val['date_start'])->format('Y-m-d'));
                    }
                    if (!empty($val['date_end'])) {
                        $end = MCarbon::createMidnightDate(MCarbon::createFromFormat('d/m/Y', $val['date_end'])->format('Y-m-d'));
                        }
                        if($start->diffInYears($end) == 0){
                            $daterange = $start->diffInMonths($end).' month';
                        }else{
                            $daterange = $start->diffInYears($end).' years';
                        }
                    $result_vol_2[] = array(
                    'id' => $val['id'],
                    'volunteer_name' => $val['volunteer'],
                    'date_start' => $val['date_start'],
                    'date_end' => $val['date_end'],
                    'rangedate' => $daterange,
                    );
                }
            }

        $result_current = [];
        if($data_old->data_exp_work){
            $current_work = json_decode($data_old->data_exp_work, true);
            if(!empty($current_work)){
                foreach($current_work as $val){
                    $company2 = $this->db->get_where('mst_works_experiences', array('id'=>$val['company_id']))->row();
                    if(!empty($company2)){
                        $result_current[] = array(
                            'company' => $company2->data_name,
                            'status' => !empty($val['status']) ? $val['status'] : 0,
                        );
                    }
                }
            }
        }

        $data['current_work']  = !empty($result_current) ? $result_current : '';
        $user_id = $_SESSION['user_id'];
        $data["hobby"] = $this->db->get_where('mst_hobbies',array('status'=>1))->result();
        $data["list_hobby"] = $result4;
        $data["skill"] = $this->db->get_where('mst_skills',array('status'=>1))->result();
        $data["list_skill"] = $result6;
        $data["skills"] = $this->db->get_where('mst_skills',array('status'=>1))->result();
        $data["works"] = $result;
        $data["educations"] = $result_edu_2;
        $data["licenses"] = $result_lic_2;
        $data["courses"] = $result_crs_2;
        $data["volunteers"] = $result_vol_2;
        $data["users"]          = $this->db->get_where('users',array('id'=>$user_id))->row();
        $data["users_profile"]          = $this->db->get_where('users',array('id'=>$id))->row();
        $data["data_work_experiences"] = $this->db->get_where('mst_works_experiences',array('status'=>1))->result();
        $data["data_educations"] = $this->db->get_where('mst_educations',array('status'=>1))->result();
        $data["data_licenses"] = $this->db->get_where('mst_licenses',array('status'=>1))->result();
        $data["data_courses"] = $this->db->get_where('mst_courses_privates',array('status'=>1))->result();
        $result =  $this->db->select('user_follow_id')->get_where('users_follows', array('user_id' => $user_id))->result();

		$friends = [];
		foreach ($result as $key) {
			$friends[] = $key->user_follow_id;
		}
        $data['friends'] = $friends;
        if($data['users_profile']->id == $_SESSION['user_id']){
            $data['checkusers_profile'] = 1;
        }else{
            $data['checkusers_profile'] = '';
        }
        config('title', $data["users_profile"]->name_first . ' ' . $data["users_profile"]->name_middle . ' ' . $data["users_profile"]->name_last);
        $this->display('about', $data);
        }
    }

	/** List Connection */
    public function connection()
    {
        $username =  $this->uri->segment(2);
        $user_data = $this->db->get_where('users', array('username'=>$username))->row();
        if(empty($user_data->username)){
            redirect('user/dashboard');
        }
        $id = $user_data->id;
        if ($this->input->post()) {
            $this->set_form_validation();
            switch ($this->input->post('form')) {
                case 'cover':
                    $this->cover_process($this->input->post('id'));
                    break;
                case 'photo':
                    $this->photo_process($this->input->post('id'));
                    break;
                default:
                    echo "Isi variabel tidak di temukan";
                    break;
            }
        } else {
            $data         = array(
                'apps_title_module' => $this->apps_title_module
            );
            $data['CSRF'] = [
                'id' => $id,
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
        }
        $user_id     = $_SESSION['user_id'];
        if( $user_data->data_exp_work){
            $current_work = json_decode( $user_data->data_exp_work, true);
            $result_current = [];
            if(!empty($current_work)){
                foreach($current_work as $val){
                    $company2 = $this->db->get_where('mst_works_experiences', array('id'=>$val['company_id']))->row();
                    if(!empty($company2)){
                        $result_current[] = array(
                            'company' => $company2->data_name,
                            'status' => !empty($val['status']) ? $val['status'] : 0,
                        );
                    }
                }
            }

        }
        $data['current_work']  = !empty($result_current) ? $result_current : '';
        $data["skills"] = $this->db->get('mst_skills')->result();
        $data["users"]          = $this->db->get_where('users',array('id'=>$user_id))->row();
        $data["users"]          = $this->db->get_where('users',array('id'=>$user_id))->row();
        $data["users_profile"]          = $this->db->get_where('users',array('id'=>$id))->row();
        $data["connections"] = $this->M_profile->show_connection($id)->result();
        $data["count_connection"] = $this->M_profile->show_connection($id)->num_rows();
        $data["followers"] = $this->M_profile->show_followers($id)->result();
        $data["count_followers"] = $this->M_profile->show_followers($id)->num_rows();
        $result =  $this->db->select('user_follow_id')->get_where('users_follows', array('user_id' => $user_id))->result();

		$friends = [];
		foreach ($result as $key) {
			$friends[] = $key->user_follow_id;
		}
        $data['friends'] = $friends;
        if($data['users_profile']->id == $_SESSION['user_id']){
            $data['checkusers_profile'] = 1;
        }else{
            $data['checkusers_profile'] = '';
        }
        config('title', $data["users_profile"]->name_first . ' ' . $data["users_profile"]->name_middle . ' ' . $data["users_profile"]->name_last);
        $this->display('connection', $data);
    }

	
	/** List Connection */
    public function view()
    {
        $username =  $this->uri->segment(2);
        $user_data = $this->db->get_where('users', array('username'=>$username))->row();
        if(empty($user_data->username)){
            redirect('user/dashboard');
        }
        $id = $user_data->id;
        if ($this->input->post()) {
            $this->set_form_validation();
            switch ($this->input->post('form')) {
                case 'cover':
                    $this->cover_process($this->input->post('id'));
                    break;
                case 'photo':
                    $this->photo_process($this->input->post('id'));
                    break;
                default:
                    echo "Isi variabel tidak di temukan";
                    break;
            }
        } else {
            $data         = array(
                'apps_title_module' => $this->apps_title_module
            );
            $data['CSRF'] = [
                'id' => $id,
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
        }
        $user_id     = $_SESSION['user_id'];
        if( $user_data->data_exp_work){
            $current_work = json_decode( $user_data->data_exp_work, true);
            $result_current = [];
            if(!empty($current_work)){
                foreach($current_work as $val){
                    $company2 = $this->db->get_where('mst_works_experiences', array('id'=>$val['company_id']))->row();
                    if(!empty($company2)){
                        $result_current[] = array(
                            'company' => $company2->data_name,
                            'status' => !empty($val['status']) ? $val['status'] : 0,
                        );
                    }
                }
            }

        }
        $data['current_work']  = !empty($result_current) ? $result_current : '';
        $data["skills"] = $this->db->get('mst_skills')->result();
        $data["users"]          = $this->db->get_where('users',array('id'=>$user_id))->row();
        $data["users_profile"]  = $this->db->get_where('users',array('id'=>$id))->row();
		$data["user_views"]		= $this->M_profile->show_view($id)->result();
		$result =  $this->db->select('user_follow_id')->get_where('users_follows', array('user_id' => $user_id))->result();

		$friends = [];
		foreach ($result as $key) {
			$friends[] = $key->user_follow_id;
		}
        $data['friends'] = $friends;
        if($data['users_profile']->id == $_SESSION['user_id']){
            $data['checkusers_profile'] = 1;
        }else{
            $data['checkusers_profile'] = '';
        }
        config('title', $data["users_profile"]->name_first . ' ' . $data["users_profile"]->name_middle . ' ' . $data["users_profile"]->name_last);
        $this->display('view', $data);
    }

    public function photo()
    {
        $username =  $this->uri->segment(2);
        $user_data = $this->db->get_where('users', array('username'=>$username))->row();
        if(empty($user_data->username)){
            redirect('user/dashboard');
        }
        $id = $user_data->id;
        if ($this->input->post()) {
            $this->set_form_validation();
            switch ($this->input->post('form')) {
                case 'cover':
                    $this->cover_process($this->input->post('id'));
                    break;
                case 'photo':
                    $this->photo_process($this->input->post('id'));
                    break;
                case 'album':
                    $this->album_process($this->input->post('id'));
                    break;
                case 'photo_album':
                    $this->photo_album_process($this->input->post('id'));
                    break;
                default:
                    echo "Isi variabel tidak di temukan";
                    break;
            }
        } else {
            $data         = array(
                'apps_title_module' => $this->apps_title_module
            );
            $data['CSRF'] = [
                'id' => $id,
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
        }
        $user_id = $_SESSION['user_id'];
        // echo $user_id;
        // exit;
        if( $user_data->data_exp_work){
            $current_work = json_decode( $user_data->data_exp_work, true);
            $result_current = [];
            if(!empty($current_work)){
                foreach($current_work as $val){
                    $company2 = $this->db->get_where('mst_works_experiences', array('id'=>$val['company_id']))->row();
                    if(!empty($company2)){
                        $result_current[] = array(
                            'company' => $company2->data_name,
                            'status' => !empty($val['status']) ? $val['status'] : 0,
                        );
                    }
                }
            }

        }
       $data['current_work']  = !empty($result_current) ? $result_current : '';
        $data["albums_photo"]  = $this->M_profile->join_album_photo_profile($id)->result();
        $data["category_albums"] = $this->db->get_where('users_albums_categories',array('status'=>1))->result();
        $data["albums"] = $this->M_profile->albums($id)->result();
        $data["users"]          = $this->db->get_where('users',array('id'=>$user_id))->row();
        $data["users_profile"]          = $this->db->get_where('users',array('id'=>$id))->row();
        $data["data_users"] = $this->db->get('users')->result();
        $result =  $this->db->select('user_follow_id')->get_where('users_follows', array('user_id' => $user_id))->result();

		$friends = [];
		foreach ($result as $key) {
			$friends[] = $key->user_follow_id;
		}
        $data['friends'] = $friends;
        if($data['users_profile']->id == $_SESSION['user_id']){
            $data['checkusers_profile'] = 1;
        }else{
            $data['checkusers_profile'] = '';
        }
        config('title', $data["users_profile"]->name_first . ' ' . $data["users_profile"]->name_middle . ' ' . $data["users_profile"]->name_last);
        $this->display('photo', $data);
    }

	/** process album photo */
    public function album_process($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/user/profile/photo/' . $parameter_id;
        $this->action_edit_process_album($parameter_url_source, $parameter_id);
    }

	/** process photo */
    public function photo_album_process($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/user/profile/photo/' . $parameter_id;
        $this->action_edit_process_photo_album($parameter_url_source, $parameter_id);
    }

    public function photo_delete()
    {
        $parameter_id = $this->input->post('id');
        $photo_id = $this->input->post('photo_id');
        $url      = $this->input->post('form');

        $query=$this->db->get_where('users_albums_photo',array('id'=>$photo_id));

        $img_name=$query->result()[0]->file_name_original;
        $img_name_thumbnail=$query->result()[0]->file_name_thumbnail;
        $img_path=$query->result()[0]->file_path;
        $this->load->helper("file");

        if(file_exists($img_path.'/'.$img_name))
        {
            unlink(FCPATH . $img_path.'/'.$img_name);
            unlink(FCPATH . $img_path.'/thumb/'.$img_name_thumbnail);
        }

        $this->db->where('id',$photo_id);
        $this->db->delete('users_albums_photo');

        redirect('user/'.$url.'/'.$parameter_id);

    }

    public function album_delete()
    {
        $parameter_id = $this->input->post('id');
        $album_id = $this->input->post('album_id');
        $url      = $this->input->post('form');

        $query=$this->db->get_where('users_albums',array('id'=>$album_id));
        $img_name=$query->result()[0]->file_name_original;
        $img_name_thumbnail=$query->result()[0]->file_name_thumbnail;
        $img_path=$query->result()[0]->file_path;
        $this->load->helper("file");

            if(file_exists($img_path.'/'.$img_name))
            {
                unlink(FCPATH . $img_path.'/'.$img_name);
                unlink(FCPATH . $img_path.'/thumb/'.$img_name_thumbnail);
            }

        $query_photo=$this->db->get_where('users_albums_photo',array('users_albums_id'=>$album_id));
        $img_name_photo=$query_photo->result()[0]->file_name_original;
        $img_name_thumbnail_photo=$query_photo->result()[0]->file_name_thumbnail;
        $img_path_photo=$query_photo->result()[0]->file_path;
            if(file_exists($img_path_photo.'/'.$img_name_photo))
            {
                $count = $query_photo->num_rows();
                for($i=0;$i<$count;$i++){
                    unlink(FCPATH . $img_path_photo.'/'.$img_name_photo);
                    unlink(FCPATH . $img_path_photo.'/thumb/'.$img_name_thumbnail_photo);
                }
            }

        $this->db->where('id',$album_id);
        $this->db->delete('users_albums');

        redirect('user/'.$url.'/'.$parameter_id);

    }

    public function photo_album($id,$username)
    {
        $user_data = $this->db->get_where('users',array('username'=>$username))->row();
        if ($this->input->post()) {
            $this->set_form_validation();
            switch ($this->input->post('form')) {
                case 'cover':
                    $this->cover_process($this->input->post('id'));
                    break;
                case 'photo':
                    $this->photo_process($this->input->post('id'));
                    break;
                case 'album':
                    $this->album_process($this->input->post('id'));
                    break;
                case 'photo_album':
                    $this->photo_album_process($this->input->post('id'));
                    break;
                default:
                    echo "Isi variabel tidak di temukan";
                    break;
            }
        } else {
            $data = array(
                'apps_title_module' => $this->apps_title_module
            );

            $data['CSRF'] = [
                'id' => $user_data->id,
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
            $user_id = $_SESSION['user_id'];
            if( $user_data->data_exp_work){
                $current_work = json_decode( $user_data->data_exp_work, true);
                $result_current = [];
                if(!empty($current_work)){
                    foreach($current_work as $val){
                        $company2 = $this->db->get_where('mst_works_experiences', array('id'=>$val['company_id']))->row();
                        if(!empty($company2)){
                            $result_current[] = array(
                                'company' => $company2->data_name,
                                'status' => !empty($val['status']) ? $val['status'] : 0,
                            );
                        }
                    }
                }

            }
            $data['current_work']  = !empty($result_current) ? $result_current : '';
            $check_like = $this->db->get_where('pfe_media_likes')->result();
            $checklikes = $this->db->query('select * from pfe_media_likes');
            $resultchecklikes = $checklikes->num_rows();
            $data["albums"] = $this->db->get('users_albums')->result();
            $data["photo_albums"] = $this->M_profile->join_albuM_profile_id($id)->row();
            $data["albums_photo"]  = $this->M_profile->join_album_photo_profile_id($id)->result();
            $data["category_albums"] = $this->db->get('users_albums_categories')->result();
            $data["users"] = $this->db->get_where('users',array('username'=>$username))->row();
            $data["users_profile"]          = $this->db->get_where('users',array('username'=>$username))->row();
            $data["data_users"] = $this->db->get('users')->result();
            $data["all_likes"]      = $this->db->get_where('pfe_media_likes')->result();
            $data['likes']          = $resultchecklikes;
            $result =  $this->db->select('user_follow_id')->get_where('users_follows', array('user_id' => $user_id))->result();

            $friends = [];
            foreach ($result as $key) {
                $friends[] = $key->user_follow_id;
            }
            $data['friends'] = $friends;
            if($data['users_profile']->id == $_SESSION['user_id']){
                $data['checkusers_profile'] = 1;
            }else{
                $data['checkusers_profile'] = '';
            }
            config('title', $data["users_profile"]->name_first . ' ' . $data["users_profile"]->name_middle . ' ' . $data["users_profile"]->name_last);
            $this->display('photo_album',$data);
        }
    }


    public function job()
    {
        $username =  $this->uri->segment(2);
        $user_data = $this->db->get_where('users', array('username'=>$username))->row();
        if(empty($user_data->username)){
            redirect('user/dashboard');
        }
        $id = $user_data->id;
        if ($this->input->post()) {
            $this->set_form_validation();
            switch ($this->input->post('form')) {
                case 'cover':
                    $this->cover_process($this->input->post('id'));
                    break;
                case 'photo':
                    $this->photo_process($this->input->post('id'));
                    break;
                default:
                    echo "Isi variabel tidak di temukan";
                    break;
            }
        } else {
            $data         = array(
                'apps_title_module' => $this->apps_title_module
            );
            $data['CSRF'] = [
                'id' => $id,
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
        }
        $user_id    = $_SESSION['user_id'];
        if( $user_data->data_exp_work){
            $current_work = json_decode( $user_data->data_exp_work, true);
            $result_current = [];
            if(!empty($current_work)){
                foreach($current_work as $val){
                    $company2 = $this->db->get_where('mst_works_experiences', array('id'=>$val['company_id']))->row();
                    if(!empty($company2)){
                        $result_current[] = array(
                            'company' => $company2->data_name,
                            'status' => !empty($val['status']) ? $val['status'] : 0,
                        );
                    }
                }
            }

        }
        $data['current_work']  = !empty($result_current) ? $result_current : '';
        $data["skills"] = $this->db->get('mst_skills')->result();
        $data["users"]          = $this->db->get_where('users',array('id'=>$user_id))->row();
        $data["users_profile"]          = $this->db->get_where('users',array('id'=>$id))->row();
        $data["jobs"]          = $this->M_profile->join_jobs($id)->result();
        $data["users_jobs"]          = $this->db->get_where('users_jobs',array('users_id'=>$id))->row();
        $data['jobs_type']  = $this->db->get_where('pcj_jobs_types',array('status'=>1))->result();
        $data['jobs_categories'] = $this->db->get_where('pcj_jobs_categories',array('status'=>1))->result();
        $data['jobs_salary_period'] = $this->db->get_where('pcj_jobs_salary_period',array('status'=>1))->result();
        $data["check_jobs"]          = $this->db->get_where('pcj_jobs_applicants',array('users_id'=>$user_id))->result();
        $result =  $this->db->select('user_follow_id')->get_where('users_follows', array('user_id' => $user_id))->result();

		$friends = [];
		foreach ($result as $key) {
			$friends[] = $key->user_follow_id;
		}
        $data['friends'] = $friends;
        if($data['users_profile']->id == $_SESSION['user_id']){
            $data['checkusers_profile'] = 1;
        }else{
            $data['checkusers_profile'] = '';
        }
        config('title', $data["users_profile"]->name_first . ' ' . $data["users_profile"]->name_middle . ' ' . $data["users"]->name_last);
        $this->display('job', $data);
    }

	/** add simple post */
    public function post_add(){
        $form   = $this->input->post('form');
        $id     = $this->input->post('id');
        $username = $this->input->post('username');
        $business_id = $this->input->post('business_id');
        $business_username = $this->input->post('business_username');
        $user_id     = $this->input->post('id');
        if($business_id == 'undefined'){
            $username = $username;
        }else{
            $username = $business_username;
        }
        $post['id']                 = $this->generate_new_id_string() . get_random_alphanumeric(5);
        $post['users_id']           = $this->input->post('id');
        $post['pbd_business_id']    = $business_id;
        $post['data_description']   = $this->input->post('data_description');
        $post['published']          = date('Y-m-d H:i:s');
        $post['created_by']         = 1;
        $post['created_at']         = date('Y-m-d H:i:s');
        $post['updated_by']         = 1;
        $post['updated_at']         = date('Y-m-d H:i:s');
        $this->db->insert('pfe_posts', $post);
        if($form=='dashboard'){
            redirect(base_url('user/'.$form));
        }else{
            redirect(base_url($form.'/'.'post/'.$username));
        }
    }

	/** edit simple post */
    public function post_edit(){
        $form   = $this->input->post('form');
        $business_id = $this->input->post('business_id');
        $user_id     = $this->input->post('id');
        $username     = $this->input->post('username');
        $business_username = $this->input->post('business_username');
        if($business_id == 'undefined'){
            $username = $username;
        }else{
            $username = $business_username;
        }
        $post_text_id   = $this->input->post('post_text_id');
        $post['users_id']           = $this->input->post('id');
        $post['data_description']   = $this->input->post('data_description');
        $post['published']          = date('Y-m-d H:i:s');
        $post['created_by']         = 1;
        $post['created_at']         = date('Y-m-d H:i:s');
        $post['updated_by']         = 1;
        $post['updated_at']         = date('Y-m-d H:i:s');
        $this->db->where('pfe_posts.id', $post_text_id);
        $update = $this->db->update('pfe_posts', $post);
        if($form=='dashboard'){
            redirect(base_url('user/'.$form));
        }else{
            redirect(base_url($form.'/'.'post/'.$username));
        }
    }

	/** delete simple post */
    public function post_delete(){
        $form           = $this->input->post('form');
        $id             = $this->input->post('id');
        $business_id    = $this->input->post('business_id');
        $username       = $this->input->post('username');
        $post_text_id   = $this->input->post('post_text_id');
        $this->db->where('pfe_posts.id',$post_text_id);
        $this->db->delete('pfe_posts');
        if(empty($business_id)){
            $username = $username;
        }else{
            $username = $_SESSION['business_username'];
        }
        if($form == 'dashboard'){
            redirect(base_url('user/dashboard'));
        }else{
            redirect(base_url($form.$username));
        }
    }

	/** delete simple post lookfor */
    public function post_lookfor_delete(){
        $form           = $this->input->post('form');
        $id             = $this->input->post('id');
        $business_id    = $this->input->post('business_id');
        $username       = $this->input->post('username');
        $post_text_id   = $this->input->post('post_text_id');
        $this->db->where('pfe_posts_lookfoor.id',$post_text_id);
        $this->db->delete('pfe_posts_lookfoor');
        if(empty($business_id)){
            $username = $username;
        }else{
            $username = $_SESSION['business_username'];
        }
        if($form == 'dashboard'){
            redirect(base_url('user/dashboard'));
        }else{
            redirect(base_url($form.$username));
        }
    }

	/** delete simple post lookfor */
    public function delete_post_photo_profile(){
        $form = $this->input->post('form');
        $business_id = $this->input->post('business_id');
        $username = $this->input->post('username');
        $post_updated_photo_profile_id = $this->input->post('post_updated_photo_profile_id');
        $this->db->where('activities_users_photo_profile.id', $post_updated_photo_profile_id);
        $this->db->delete('activities_users_photo_profile');
        if (empty($business_id)) {
            $username = $username;
        } else {
            $username = $_SESSION['business_username'];
        }
        if ($form == 'dashboard') {
            redirect(base_url('user/dashboard'));
        } else {
            redirect(base_url($form.$username));
        }
    }

	/** add photo post */
    public function photo_post_add(){
        $parameter_id =  $this->uri->segment(4);
        $parameter_url_source = $this->module_url_default . '/user/dashboard';
        $this->action_photo_post($parameter_url_source, $parameter_id);
    }

	/** add video post */
    public function video_post_add(){
        $parameter_id =  $this->uri->segment(4);
        $parameter_url_source = $this->module_url_default . '/user/dashboard';
        $this->action_video_post($parameter_url_source, $parameter_id);
    }

	/** add lookfor post */
    public function looking_post_add(){
        $form = $this->input->post('form');
        if ($form == 'business'){
            $business_id = $this->input->post('select_business_id_business');
            $description = $this->input->post('description_business');
            $data_type = $this->input->post('s_business_types');
            $tbl_type = 'pbd_business_types'; 
            $post['id']                 = $this->generate_new_id_string() . get_random_alphanumeric(5);
            $post['users_id']           = $_SESSION['user_id'];
            $post['pbd_business_id']    = $business_id;
            $post['data_type_table']    = $tbl_type;
            $post['data_type_value']    = $data_type;
            $post['data_description']   = $description;
            $post['status']             = 1;
            $post['published']          = date('Y-m-d H:i:s');
            $post['created_by']         = $_SESSION['user_id'];
            $post['created_at']         = date('Y-m-d H:i:s');
            $post['updated_by']         = $_SESSION['user_id'];
            $post['updated_at']         = date('Y-m-d H:i:s');
            $this->db->insert('pfe_posts_lookfoor', $post);
        } elseif ($form == 'jobs'){
            $description = $this->input->post('description_job');
            $data_type = $this->input->post('s_type_job');
            $data_category = $this->input->post('s_category_job');
            $tbl_type = 'pcj_jobs_types'; 
            $tbl_category = 'pcj_jobs_categories'; 
            $post['id']                 = $this->generate_new_id_string() . get_random_alphanumeric(5);
            $post['users_id']           = $_SESSION['user_id'];
            $post['data_type_table']    = $tbl_type;
            $post['data_type_value']    = $data_type;
            $post['data_categories_table']    = $tbl_category;
            $post['data_categories_value']    = $data_category;
            $post['data_description']   = $description;
            $post['status']             = 1;
            $post['published']          = date('Y-m-d H:i:s');
            $post['created_by']         = $_SESSION['user_id'];
            $post['created_at']         = date('Y-m-d H:i:s');
            $post['updated_by']         = $_SESSION['user_id'];
            $post['updated_at']         = date('Y-m-d H:i:s');
            $this->db->insert('pfe_posts_lookfoor', $post);
        } else {
            $business_id = $this->input->post('select_business_id_business');
            $description = $this->input->post('description_distributor');
            $data_type = $this->input->post('s_type_distributor');
            $tbl_type = 'pbd_business_distributor_types'; 
            $post['id']                 = $this->generate_new_id_string() . get_random_alphanumeric(5);
            $post['users_id']           = $_SESSION['user_id'];
            $post['pbd_business_id']    = $business_id;
            $post['data_type_table']    = $tbl_type;
            $post['data_type_value']    = $data_type;
            $post['data_description']   = $description;
            $post['status']             = 1;
            $post['published']          = date('Y-m-d H:i:s');
            $post['created_by']         = $_SESSION['user_id'];
            $post['created_at']         = date('Y-m-d H:i:s');
            $post['updated_by']         = $_SESSION['user_id'];
            $post['updated_at']         = date('Y-m-d H:i:s');
            $this->db->insert('pfe_posts_lookfoor', $post);
        }
        redirect(base_url('user/dashboard'));
    }


    public function post_like()
    {
        $id = $this->input->post('id');
        $user_id = $this->input->post('user_id');
        $table = 'pfe_posts';
        $checklikes =  $this->db->query('select * from pfe_media_likes
        where users_id="'.$user_id.'" and relate_id="'.$id.'"');
        $resultchecklikes = $checklikes->num_rows();
        if($resultchecklikes == null ){
            $post['users_id']           = $user_id;
            $post['relate_id']          = $id;
            $post['relate_table']       = $table;
            $post['created_at']         = date('Y-m-d H:i:s');
            $post['updated_at']         = date('Y-m-d H:i:s');
            $this->db->insert('pfe_media_likes', $post);
        }else{
            $this->db->where('users_id',$user_id);
            $this->db->delete('pfe_media_likes');
        }
        $this->db->select('*');
        $this->db->where('relate_id',$id);
        $query = $this->db->get('pfe_media_likes');
        $num = $query->num_rows();
        $data['token'] = $this->security->get_csrf_hash();
        $data['id'] = $id;
        $data['likes'] = $num;
        $data['change_likes'] = $resultchecklikes;
        echo json_encode($data);
    }

    public function post_comment()
    {
        $post_id = $this->input->post('post_id');
        $user_id = $this->input->post('user_id');
        $comment = $this->input->post('comment');
        $table = 'pfe_posts';
            $set = '123456789';
            $post['id'] = substr(str_shuffle($set), 0, 12);
            $post['users_id']           = $user_id;
            $post['relate_id']          = $post_id;
            $post['relate_table']       = $table;
            $post['data_description']   = $comment;
            $post['created_at']         = date('Y-m-d H:i:s');
            $post['updated_at']         = date('Y-m-d H:i:s');
            $this->db->insert('pfe_media_comments', $post);
        $data['token'] = $this->security->get_csrf_hash();
        $data['post_id'] = $post_id;
        $data['comment'] = $comment;
        echo json_encode($data);
    }

    function show_comment($id){
        $like = $this->M_profile->count_like($id);
        $data['data'] = $this->M_profile->show_comment_where($id)->result();
        $data['like'] = empty($like) ? '' : $like;
        echo json_encode($data);
    }


    function show_comment_all(){
        $data=$this->M_profile->show_comment()->result();
        echo json_encode($this->M_profile->show_comment()->result());
    }

    function delete_comment($id){
        $this->db->where('id',$id);
        $query = $this->db->delete('pfe_media_comments');
        echo json_encode('success');
    }

    public function profile_pdf($id){
        $username =  $this->uri->segment(4);
        $user_data = $this->db->get_where('users', array('username'=>$username))->row();
        if(empty($user_data->username)){
            redirect('user/dashboard');
        }
        $id = $user_data->id;
            $data         = array(
                'apps_title_module' => $this->apps_title_module
            );
            $data['CSRF'] = [
                'id' => $_SESSION['user_id'],
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
            $data_old = $this->db->get_where('users', array('id'=>$id))->row();
            $result2 = json_decode($data_old->data_exp_work, true);
            $result = [];
            if(!empty($result2)){
                foreach($result2 as $val){
                    $company2 = $this->db->get_where('mst_works_experiences', array('id'=>$val['company_id']))->row();
                    if(!empty($val['date_start'])) {
                        $start =  MCarbon::createMidnightDate(MCarbon::createFromFormat('d/m/Y', $val['date_start'])->format('Y-m-d'));
                    }
                    if(!empty($val['date_end'])) {
                        $end = MCarbon::createMidnightDate(MCarbon::createFromFormat('d/m/Y', $val['date_end'])->format('Y-m-d'));
                        if($start->diffInYears($end) == 0){
                            $daterange = $start->diffInMonths($end).' month';
                        }else{
                            $daterange = $start->diffInYears($end).' years';
                        }
                    }else{
                        $daterange = null;
                    }
                    if(!empty($company2)){
						$result[] = array(
							'id' => $val['id'],
							'specialization' => $val['specialization'],
							'company' => $company2->data_name,
							'file_path' => $company2->file_path,
							'file_name_original' => $company2->file_name_original,
							'date_start' => $val['date_start'],
							'date_end' => $val['date_end'],
							'status' => !empty($val['status']) ? $val['status'] : 0,
                            'rangedate' => $daterange,
						);
                    }
                }
            }

            $result3 = json_decode($data_old->data_pro_hobby, true);
            $result4 = [];
            if(!empty($result3)){
                foreach($result3 as $val2){
                    $hobby = $this->db->get_where('mst_hobbies', array('id'=>$val2['hobby_id']))->row();
                    if(!empty($hobby)){
                        $result4[] = array(
                            'hobby_id' => $hobby->id,
                            'name' => $hobby->data_name,
                            'file_name' => $hobby->file_name_original,
                            'file_path' => $hobby->file_path,
                        );
                    }
                }
            }

            $result5 = json_decode($data_old->data_pro_skills, true);
            $result6 = [];
            if(!empty($result5)){
                foreach($result5 as $val3){
                    $skill = $this->db->get_where('mst_skills', array('id'=>$val3['skill_id']))->row();
                    if(!empty($skill)){
                        $result6[] = array(
                            'skill_id' => $skill->id,
                            'name' => $skill->data_name,
                            'file_name' => $skill->file_name_original,
                            'file_path' => $skill->file_path,
                        );
                    }
                }
            }

            $result_edu_1 = json_decode($data_old->data_education, true);
            $result_edu_2 = [];
            if(!empty($result_edu_1)){
                foreach($result_edu_1 as $val){
                    $education = $this->db->get_where('mst_educations', array('id'=>$val['education_id']))->row();
                    if(!empty($val['date_start'])) {
                        $start =  MCarbon::createMidnightDate(MCarbon::createFromFormat('d/m/Y', $val['date_start'])->format('Y-m-d'));
                    }
                    if(!empty($val['date_end'])) {
                        $end = MCarbon::createMidnightDate(MCarbon::createFromFormat('d/m/Y', $val['date_end'])->format('Y-m-d'));
                        if($start->diffInYears($end) == 0){
                            $daterange = $start->diffInMonths($end).' month';
                        }else{
                            $daterange = $start->diffInYears($end).' years';
                        }
                    }else{
                        $daterange = null;
                    }
                    if(!empty($education)){
                        $result_edu_2[] = array(
                        'id' => $val['id'],
                        'mayor' => $val['mayor'],
                        'campus' => $education->data_name,
                        'file_path' => $education->file_path,
                        'file_name_original' => $education->file_name_original,
                        'date_start' => $val['date_start'],
                        'date_end' => $val['date_end'],
                        'rangedate' => $daterange,
                    );
                    }
                }
            }

            $result_lic_1 = json_decode($data_old->data_license, true);
            $result_lic_2 = [];
            if(!empty($result_lic_1)){
                foreach($result_lic_1 as $val){
                    $license = $this->db->get_where('mst_licenses', array('id'=>$val['license_id']))->row();
                    if(!empty($val['date_start'])) {
                        $start =  MCarbon::createMidnightDate(MCarbon::createFromFormat('d/m/Y', $val['date_start'])->format('Y-m-d'));
                    }
                    if(!empty($val['date_end'])) {
                        $end = MCarbon::createMidnightDate(MCarbon::createFromFormat('d/m/Y', $val['date_end'])->format('Y-m-d'));
                        if($start->diffInYears($end) == 0){
                            $daterange = $start->diffInMonths($end).' month';
                        }else{
                            $daterange = $start->diffInYears($end).' years';
                        }
                    }else{
                        $daterange = null;
                    }
                    if(!empty($license)){
                        $result_lic_2[] = array(
                        'id' => $val['id'],
                        'study' => $val['study'],
                        'school' => $license->data_name,
                        'file_path' => $license->file_path,
                        'file_name_original' => $license->file_name_original,
                        'date_start' => $val['date_start'],
                        'date_end' => $val['date_end'],
                        'rangedate' => $daterange,
                        );
                    }
                }
            }

            $result_crs_1 = json_decode($data_old->data_crs_private, true);
            $result_crs_2 = [];
            if(!empty($result_crs_1)){
                foreach($result_crs_1 as $val){
                    $course = $this->db->get_where('mst_courses_privates', array('id'=>$val['course_id']))->row();
                    if(!empty($val['date_start'])) {
                        $start =  MCarbon::createMidnightDate(MCarbon::createFromFormat('d/m/Y', $val['date_start'])->format('Y-m-d'));
                    }
                    if(!empty($val['date_end'])) {
                        $end = MCarbon::createMidnightDate(MCarbon::createFromFormat('d/m/Y', $val['date_end'])->format('Y-m-d'));
                        if($start->diffInYears($end) == 0){
                            $daterange = $start->diffInMonths($end).' month';
                        }else{
                            $daterange = $start->diffInYears($end).' years';
                        }
                    }else{
                        $daterange = null;
                    }
                    if(!empty($course)){
                    $result_crs_2[] = array(
                        'id' => $val['id'],
                        'study' => $val['study'],
                        'school' => $course->data_name,
                        'file_path' => $course->file_path,
                        'file_name_original' => $course->file_name_original,
                        'date_start' => $val['date_start'],
                        'date_end' => $val['date_end'],
                        'rangedate' => $daterange,
                    );
                    }
                }
            }

            $result_vol_1 = json_decode($data_old->data_exp_volunteer, true);
            $result_vol_2 = [];
            if(!empty($result_vol_1)) {
                foreach($result_vol_1 as $val){
                    if(!empty($val['date_start'])) {
                        $start =  MCarbon::createMidnightDate(MCarbon::createFromFormat('d/m/Y', $val['date_start'])->format('Y-m-d'));
                    }
                    if(!empty($val['date_end'])) {
                        $end = MCarbon::createMidnightDate(MCarbon::createFromFormat('d/m/Y', $val['date_end'])->format('Y-m-d'));
                        if($start->diffInYears($end) == 0){
                            $daterange = $start->diffInMonths($end).' month';
                        }else{
                            $daterange = $start->diffInYears($end).' years';
                        }
                    }else{
                        $daterange = null;
                    }
                    $result_vol_2[] = array(
                    'id' => $val['id'],
                    'volunteer_name' => $val['volunteer'],
                    'date_start' => $val['date_start'],
                    'date_end' => $val['date_end'],
                    'rangedate' => $daterange,
                    );
                }
            }
            if($data_old->data_exp_work){
                $current_work = json_decode($data_old->data_exp_work, true);
                $result_current = [];
                if(!empty($current_work)){
                    foreach($current_work as $val){
                        $company2 = $this->db->get_where('mst_works_experiences', array('id'=>$val['company_id']))->row();
                        if(!empty($company2)){
                            $result_current[] = array(
                                'company' => $company2->data_name,
                                'status' => !empty($val['status']) ? $val['status'] : 0,
                            );
                        }
                    }
                }

            }
        $data['current_work']  = !empty($result_current) ? $result_current : '';
        $user_id =  $_SESSION['user_id'];
        $data["hobby"]          = $this->db->get_where('mst_hobbies',array('status'=>1))->result();
        $data["list_hobby"]     = $result4;
        $data["skill"]          = $this->db->get_where('mst_skills',array('status'=>1))->result();
        $data["list_skill"]     = $result6;
        $data["skills"]         = $this->db->get_where('mst_skills',array('status'=>1))->result();
        $data["works"]          = $result;
        $data["educations"]     = $result_edu_2;
        $data["licenses"]       = $result_lic_2;
        $data["courses"]        = $result_crs_2;
        $data["volunteers"]        = $result_vol_2;
        $data["users"]          = $this->db->get_where('users',array('id'=>$user_id))->row();
        $data["users_profile"]          = $this->db->get_where('users',array('id'=>$id))->row();

        $data['community']  = $this->db->get_where('pcs_communities',array('users_id'=>$id))->result();

        $this->load->library('pdf');
		$INDCNX_ROOT = dirname(__DIR__, 4);

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->set_option('isRemoteEnabled', true);
		$this->pdf->set_option('chroot', [
            $INDCNX_ROOT.'\public\themes\user\images\placehold',
            $INDCNX_ROOT.$data_old->file_path
        ]);

        $this->pdf->filename = "profile.pdf";
        $this->pdf->load_view('profile_pdf', $data);

    }

    public function update_token(){
        $id                        = $_SESSION['user_id'];
        $post['fcm_token']         = $this->input->post('token');
        $this->db->where('users.id', $id);
        $update = $this->db->update('users', $post);
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function get_token()
    {
        $id                        = $_SESSION['user_id'];
        $this->db->select("fcm_token as notify");
        $data['notify'] = $this->db->get_where('users', ['users.id'=> $id])->row()->notify;
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    
	public function upload_gallery()
	{
		$user_id     = $_SESSION['user_id'];
		$config['upload_path']   = 'public/uploads/profile/gallery';
        $config['allowed_types'] = 'gif|jpg|png|ico';
        $this->load->library('upload',$config);

        if($this->upload->do_upload('userfile')){
			$secret_id = $this->input->post('secret_id');
			$album_id = $this->input->post('album_id');
        	$name = $this->upload->data('file_name');
			$this->session->set_userdata('token_photo', $secret_id);
        	$this->db->insert('users_album',array('user_id'=>$user_id,'users_albums_categories_id'=>$album_id,'data_name'=>$name,'secret_id'=>$secret_id));
        }
	}
}
