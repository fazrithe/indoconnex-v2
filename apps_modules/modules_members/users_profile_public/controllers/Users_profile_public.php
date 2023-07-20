<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Users_profile_public extends Base_users
{
    protected $module_base                  = 'user/profile/post';
    protected $apps_title_module            = 'profile';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Mcarbon');
        $this->load->model('M_profile');
    }


    public function about()
    {
        $username =  $this->uri->segment(5);
        $user_data = $this->db->get_where('users', array('username'=>$username))->row();
        if(empty($user_data->username)){
            redirect('user/dashboard');
        }
        $id = $user_data->id;
            $data         = array(
				'meta_position' => $username,
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
        $data["users"]          = $this->db->get_where('users')->row();
        $data["users_profile"]          = $this->db->get_where('users',array('id'=>$id))->row();
        $data["data_work_experiences"] = $this->db->get_where('mst_works_experiences',array('status'=>1))->result();
        $data["data_educations"] = $this->db->get_where('mst_educations',array('status'=>1))->result();
        $data["data_licenses"] = $this->db->get_where('mst_licenses',array('status'=>1))->result();
        $data["data_courses"] = $this->db->get_where('mst_courses_privates',array('status'=>1))->result();
        $result =  $this->db->select('user_follow_id')->get_where('users_follows')->result();

		$friends = [];
		foreach ($result as $key) {
			$friends[] = $key->user_follow_id;
		}
        $data['friends'] = $friends;
        config('title', $user_data->name_first . ' ' . $user_data->name_middle . ' ' . $user_data->name_last);
        $this->display('about', $data);
        }
    
}
