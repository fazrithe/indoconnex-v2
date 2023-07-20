<?php

class M_articles_public extends CI_Model{

  function count_data(){
		return $this->db->get('pfe_articles')->num_rows();
	}

  function count_data_list($id){
    $this->db->where('users_id',$id);
		return $this->db->get('pfe_articles')->num_rows();
	}

	function count_data_filter($id){
		$this->db->where('status',1);
		$this->db->where('pbd_business_id',$id);
		$query = $this->db->get('pfe_articles')->num_rows();
		return $query;
	}

  function data($user_id,$number,$offset){
    $this->db->where('users_id',$user_id);
		return $query = $this->db->get('pfe_articles',$number,$offset)->result();		
	}

  function count_data_search($name){
    $this->db->like('data_name',$name);
		return $query = $this->db->get('pfe_articles')->num_rows();	
	}

  function count_data_search_cat($category){
    $this->db->where('data_categories',$category);
		return $query = $this->db->get('pfe_articles')->num_rows();	
	}

  function count_data_search_filter($name,$category){
    $this->db->like('data_categories',$category);
    $this->db->like('data_name',$name);
		return $query = $this->db->get('pfe_articles')->num_rows();	
	}

  function data_search($name,$number,$offset){
    $this->db->select('id');
    $this->db->select('file_path');
    $this->db->select('file_name_original');
    $this->db->select('data_name');
    $this->db->select('published');
    $this->db->like('data_name',$name);
    $this->db->order_by('created_at', 'desc');
		return $query = $this->db->get('pfe_articles',$number,$offset)->result();		
	}

  function data_search_cat($category,$number,$offset){
    $this->db->select('id');
    $this->db->select('file_path');
    $this->db->select('file_name_original');
    $this->db->select('data_name');
    $this->db->select('published');
    $this->db->where('data_categories',$category);
    $this->db->order_by('created_at', 'desc');
		return $query = $this->db->get('pfe_articles',$number,$offset)->result();		
	}

  function data_search_filter($name,$category,$number,$offset){
    $this->db->select('id');
    $this->db->select('file_path');
    $this->db->select('file_name_original');
    $this->db->select('data_name');
    $this->db->select('published');
    $this->db->like('data_categories',$category);
    $this->db->like('data_name',$name);
    $this->db->order_by('created_at', 'desc');
		return $query = $this->db->get('pfe_articles',$number,$offset)->result();		
	}

	function data_filter($id,$number,$offset){
		$this->db->where('pbd_business_id',$id);
		return $query = $this->db->get('pfe_articles',$number,$offset)->result();		
	}

  function data_all($number,$offset){
    $this->db->select('id');
    $this->db->select('file_path');
    $this->db->select('file_name_original');
    $this->db->select('data_name');
    $this->db->select('published');
    $this->db->order_by('created_at', 'desc');
		return $this->db->get('pfe_articles',$number,$offset)->result();
	}

  function post_article($user_id){
        $this->db->select('*');
        $this->db->from('pfe_articles');
        $this->db->where('users_id', $user_id);
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        return $query;
	}

  function show_article($id){		
    $this->db->select('*');
    $this->db->where('users_id', $id);
    $this->db->from('pfe_articles');	
    $this->db->order_by('id','desc');	
    $query = $this->db->get();
    return $query;
  }	

  function show_article_business($id){		
    $this->db->select('*');
    $this->db->where('pbd_business_id', $id);
    $this->db->from('pfe_articles');	
    $this->db->order_by('id','desc');	
    $query = $this->db->get();
    return $query;
  }	

  function getCategory($str)
  {
      $this->db->select('id, data_name as text');
      $this->db->like('data_name', $str);
      $query = $this->db->get('pfe_articles_categories');
      return $query->result();
  }

  function getCategoryName($id)
  {
      $this->db->select('data_name');
      $this->db->where('id', $id);
      $query = $this->db->get('pfe_articles_categories');
      return $query->row()->data_name;
  }
}