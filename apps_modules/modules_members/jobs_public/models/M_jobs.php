<?php

class M_jobs extends CI_Model{	

    function list($id,$limit,$offset){
        $this->db->select('pcj_jobs.*');
        $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        $this->db->where('pcj_jobs.users_id',$id);
        $this->db->join('users','users.id = pcj_jobs.users_id');
        $query = $this->db->get('pcj_jobs',$limit,$offset);
        return $query;
    }

    function list_filter($id,$limit,$offset){
        $this->db->select('pcj_jobs.*');
        $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        $this->db->where('pcj_jobs.pbd_business_id',$id);
        $this->db->join('users','users.id = pcj_jobs.users_id');
        $query = $this->db->get('pcj_jobs');
        return $query;
    }

    
    function list_applicant($id){
        $this->db->select('pcj_jobs.*');
        $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        $this->db->where('pcj_jobs.users_id',$id);
        $this->db->join('users','users.id = pcj_jobs.users_id');
        $query = $this->db->get('pcj_jobs');
        return $query;
    }

    function list_applicant_business($id){
        $this->db->select('pcj_jobs.*');
        $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        $this->db->where('pcj_jobs.pbd_business_id',$id);
        $this->db->join('users','users.id = pcj_jobs.users_id');
        $query = $this->db->get('pcj_jobs');
        return $query;
    }

    function detail($id){
        $this->db->select('pcj_jobs.*');
        $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        $this->db->where('pcj_jobs.id',$id);
        $this->db->from('pcj_jobs');
        $this->db->join('users','users.id = pcj_jobs.users_id');
        $query = $this->db->get();
        return $query;
    }

    function applicant(){
        $this->db->select('pcj_jobs_applicants.*');
        $this->db->select('users.file_path');
        $this->db->select('users.file_name_original');
        $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        $this->db->select('users.username');
        $this->db->from('pcj_jobs_applicants');
        $this->db->join('users','users.id = pcj_jobs_applicants.users_id');
        $query = $this->db->get();
        return $query;
    }

    function data($limit,$offset){
        $this->db->select('*');
        $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        $this->db->where('status_privacy',0);
        return $query = $this->db->get('users',$limit,$offset);	
    }

    function data_jobs_users_search($name,$limit,$offset){
        $this->db->select('users_jobs.*');
        $this->db->select('users.username');
        $this->db->select('users.file_path');
        $this->db->select('users.file_name_original');
        $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        $this->db->like('users.name_first',$name);
        $this->db->like('users.name_middle',$name);
        $this->db->like('users.name_last',$name);
        $this->db->where('users_jobs.status_current_open_work',1);
        $this->db->join('users','users.id = users_jobs.users_id');
        return $query = $this->db->get('users_jobs',$limit,$offset);	
    }

    function data_jobs($limit,$offset){
        $this->db->select('pcj_jobs.*');
        $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        $this->db->join('users','users.id = pcj_jobs.users_id');
        $this->db->where('pcj_jobs.status',1);
        return $query = $this->db->get('pcj_jobs',$limit,$offset);	
    }

    function data_jobs_filter($name,$type,$salary_min,$salary_max){
        $this->db->select('*');
        $this->db->like('data_name',$name);
        $this->db->like('jobs_types_id',$type);
        $this->db->where_in('jb_salary_min BETWEEN "'.$salary_min.'" and "'.$salary_max.'"');
        $this->db->where('status',1);
        return $query = $this->db->get('pcj_jobs');	
    }

    function count_data_filter($name,$type,$salary_min,$salary_max){
        $this->db->select('*');
        $this->db->like('data_name',$name);
        $this->db->like('jobs_types_id',$type);
        $this->db->where_in('jb_salary_min BETWEEN "'.$salary_min.'" and "'.$salary_max.'"');
        $this->db->where('status',1);
        return $query = $this->db->get('pcj_jobs');	
    }

    function count_data(){
        $this->db->where('status',1);
        $query = $this->db->get('pcj_jobs')->num_rows();
        return $query;
    }

    function count_data_user($users_id){
        $this->db->where('users_id',$users_id);
        $this->db->where('status',1);
        $query = $this->db->get('pcj_jobs')->num_rows();
        return $query;
    }

    function count_data_business($id){
        $this->db->where('pbd_business_id',$id);
        $this->db->where('status',1);
        $query = $this->db->get('pcj_jobs')->num_rows();
        return $query;
    }

    function count_data_jobs_user($limit,$offset){
        $this->db->where('status_current_open_work',1);
        $query = $this->db->get('users_jobs',$limit,$offset)->num_rows();
        return $query;
    }

    function data_jobs_users($limit,$offset){
        $this->db->select('users_jobs.*');
        $this->db->select('users.username');
        $this->db->select('users.file_path');
        $this->db->select('users.file_name_original');
        $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        $this->db->where('users_jobs.status_current_open_work',1);
        $this->db->join('users','users.id = users_jobs.users_id');
        return $query = $this->db->get('users_jobs',$limit,$offset);	
    }

    function count_data_jobs_user_filter($name,$limit,$offset){
        $this->db->select('users_jobs.*');
        $this->db->select('users.username');
        $this->db->select('users.file_path');
        $this->db->select('users.file_name_original');
         $this->db->like('users.name_first',$name);
        $this->db->or_like('users.name_middle',$name);
        $this->db->or_like('users.name_last',$name);
        $this->db->where('users_jobs.status_current_open_work',1);
        $this->db->join('users','users.id = users_jobs.users_id');
        return $query = $this->db->get('users_jobs',$limit,$offset)->num_rows();	
    }

    function data_jobs_users_filter($name,$limit,$offset){
        $this->db->select('users_jobs.*');
        $this->db->select('users.username');
        $this->db->select('users.file_path');
        $this->db->select('users.file_name_original');
        $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        $this->db->like('users_jobs.data_name',$name);
        $this->db->where('users_jobs.status_current_open_work',1);
        $this->db->join('users','users.id = users_jobs.users_id');
        return $query = $this->db->get('users_jobs',$limit,$offset);	
    }

	function filter($name,$type,$category,$salary_min,$salary_max)
	{
        $this->db->select('pcj_jobs.*');
        $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        $this->db->join('users','users.id = pcj_jobs.users_id');
		$this->db->where('pcj_jobs.status', 1);
		if ($name) $this->db->like('data_name', $name);
		if ($type) $this->db->where('jobs_types_id', $type);
		if ($salary_min) $this->db->where('jb_salary_min <',$salary_min);
		if ($salary_max) $this->db->where('jb_salary_max >', $salary_max);
		if ($category) $this->db->where("JSON_CONTAINS(data_categories, '[\"$category\"]')");
		return $this->db->get('pcj_jobs')->result();
	}

	function employee_filter($name,$type,$category,$salary_min,$salary_max)
	{	
		$this->db->select('users_jobs.*');
        $this->db->select('users.username');
        $this->db->select('users.file_path');
        $this->db->select('users.file_name_original');
        $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
		$this->db->where('users_jobs.status', 1);
		if ($name) $this->db->like('data_name', $name);
		if ($type) $this->db->where('jobs_types_id', $type);
		if ($salary_min) $this->db->where('jb_salary_min <',$salary_min);
		if ($salary_max) $this->db->where('jb_salary_max >', $salary_max);
		if ($category) $this->db->where("JSON_CONTAINS(data_categories, '[\"$category\"]')");
		$this->db->join('users','users.id = users_jobs.users_id');
		return $this->db->get('users_jobs')->result();
		
	}

    function getJobTypeName($id)
	{
		$this->db->select('data_name');
      	$this->db->where('id', $id);
     	return $this->db->get('pcj_jobs_types')->row()->data_name;
	}

	function getJobCategoryName($id)
	{
		$this->db->select('data_name');
      	$this->db->where('id', $id);
     	return $this->db->get('pcj_jobs_categories')->row()->data_name;
	}

	function getJobLocationName($id)
	{
		$this->db->select('name');
      	$this->db->where('id', $id);
     	return $this->db->get('loc_countries')->row()->name;
	}
}
