<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_page extends CI_Model {

   // Fetch users
   function getCountry($searchTerm=""){
      // Fetch users
      $this->db->select('id,name');
      $this->db->where("name like '%".$searchTerm."%' ");
      $fetched_records = $this->db->get('loc_countries');
      $users = $fetched_records->result_array();

      // Initialize Array with fetched data
      $data = array();
      foreach($users as $user){
         $data[] = array("id"=>$user['id'], "text"=>$user['name']);
      }
      return $data;
  }

  function getCountry_rows($searchTerm=""){

    // Fetch users
    $this->db->select('id,name');
    $this->db->where("name like '%".$searchTerm."%' ");
    $fetched_records = $this->db->get('loc_countries');
    $users = $fetched_records->row();

    return $users;
 }

 function getState($country_id, $searchTerm = "")
 {
    $this->db->select('id, name');
    $this->db->where('country_id', $country_id);
    $this->db->where("name like '%" . $searchTerm . "%' ");
    $fetched_records = $this->db->get('loc_states');
    $datakab = $fetched_records->result_array();

    $data = array();
    foreach ($datakab as $kab) {
       $data[] = array("id" => $kab['id'], "text" => $kab['name']);
    }
    return $data;
 }

 function getCity($state_id, $searchTerm = "")
 {
    $this->db->select('id, name');
    $this->db->where('state_id', $state_id);
    $this->db->where("name like '%" . $searchTerm . "%' ");
    $fetched_records = $this->db->get('loc_cities');
    $datakab = $fetched_records->result_array();

    $data = array();
    foreach ($datakab as $kab) {
       $data[] = array("id" => $kab['id'], "text" => $kab['name']);
    }
    return $data;
 }

   function search_business($search){

      $this->db->where('status',1);
      $this->db->like('data_name',$search['query']);
      $this->db->from('pbd_business');
      $data['count'] = $this->db->count_all_results();

      $this->db->where('status',1);
      $this->db->like('data_name',$search['query']);
      $this->db->limit(10);
      $data['query'] = $this->db->get('pbd_business')->result();
      return $data;
   }

   function search_connections($search){
      $this->db->where('status_privacy',0);
      $this->db->like('username',$search['query']);
      $this->db->or_like('name_first',$search['query']);
      $this->db->or_like('name_middle',$search['query']);
      $this->db->or_like('name_last',$search['query']);
      $this->db->from('users');
      $data['count'] = $this->db->count_all_results();

      $this->db->where('status_privacy',0);
      $this->db->like('username',$search['query']);
      $this->db->or_like('name_first',$search['query']);
      $this->db->or_like('name_middle',$search['query']);
      $this->db->or_like('name_last',$search['query']);
      $this->db->limit(10);
      $data['query'] = $this->db->get('users')->result();
      return $data;
   }

   function search_products($search){
      $this->db->where('status',1);
      $this->db->like('data_name',$search['query']);
      $this->db->from('pbd_items');
      $data['count'] = $this->db->count_all_results();

      $this->db->where('status',1);
      $this->db->like('data_name',$search['query']);
      $this->db->limit(10);
      $data['query'] = $this->db->get('pbd_items')->result();
   return $data;
   }

   function search_jobs($search){
      $this->db->where('status',1);
      $this->db->like('data_name',$search['query']);
      $this->db->from('pcj_jobs');
      $data['count'] = $this->db->count_all_results();

      $this->db->where('status',1);
      $this->db->like('data_name',$search['query']);
      $this->db->limit(10);
      $data['query'] = $this->db->get('pcj_jobs')->result();
   return $data;
   }

   function business_category()
   {
      $business_categories = $this->db->get('pbd_business_categories')->result();
      $temp = [];
      foreach ($business_categories as $key) {
         $temp[$key->id] = $key->data_name;
      }
      return $temp;
   }

   function product_category()
   {
      $business_categories = $this->db->get('pbd_items_categories')->result();
      $temp = [];
      foreach ($business_categories as $key) {
         $temp[$key->id] = $key->data_name;
      }
      return $temp;
   }

   function jobs_category()
   {

      $business_categories = $this->db->get('pcj_jobs_categories')->result();
      $temp = [];
      foreach ($business_categories as $key) {
         $temp[$key->id] = $key->data_name;
      }
      return $temp;
   }

	function business_list(){
		$this->db->select('pbd_business.*');
		$this->db->where('relation_table_name','pbd_business');
		$this->db->where('status',1);
		$this->db->from('pbd_business');
		$this->db->join('users_favorites', 'users_favorites.relation_table_id = pbd_business.id');
		$this->db->order_by('users_favorites.created_at','desc');
		$this->db->limit(6);
		$query = $this->db->get();
		return $query;
  }

  function data_jobs_users(){
	$this->db->select('users_jobs.*');
	$this->db->select('users.username');
	$this->db->select('users.file_path');
	$this->db->select('users.file_name_original');
	$this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
	$this->db->where('users_jobs.status_current_open_work',1);
	$this->db->from('users_jobs');
	$this->db->join('users','users.id = users_jobs.users_id');
	$this->db->limit(6);
	$query = $this->db->get();
	return $query;
	}

	function data_jobs(){
		$this->db->select('pcj_jobs.*');
		$this->db->select('users.username');
		$this->db->select('pcj_jobs.file_path');
		$this->db->select('pcj_jobs.file_name_original');
		$this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
		$this->db->where('pcj_jobs.status',1);
		$this->db->from('pcj_jobs');
		$this->db->join('users','users.id = pcj_jobs.users_id');
		$this->db->limit(6);
		$query = $this->db->get();
		return $query;
  }


	function widget($title){
		$this->db->select('*');
		$this->db->like('data_link_name',$title);
		$this->db->from('pub_widgets');
		$query = $this->db->get();
		return $query;
	}

	function business_cat($title = null){
		$this->db->select('id');
		$this->db->like('data_name',$title);
		$this->db->from('pbd_business_categories');
		$query = $this->db->get();
		return $query;
	}

	function business_cat_all($title = null){
		$this->db->select('id');
		$this->db->like('data_name',$title);
		$this->db->from('pbd_business_categories');
		$query = $this->db->get();
		return $query;
	}

	function data_business($category = null){
		$this->db->where('status',1);
		if ($category) $this->db->where("JSON_CONTAINS(data_categories, '[\"$category\"]')");
		$this->db->order_by('id','desc');
		$this->db->from('pbd_business');
		$query = $this->db->get();
		return $query;
	}

	function data_article($article_cat){
		$this->db->select('pfe_articles.*');
		$this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
		$this->db->where('pfe_articles.status',1);
		$this->db->where('pfe_articles.data_categories',$article_cat);
		$this->db->from('pfe_articles');
		$this->db->join('users', 'users.id = pfe_articles.users_id');
		$this->db->order_by('pfe_articles.id', 'desc');
		$this->db->limit(4);
		$query = $this->db->get()->result();
		return $query;
	}

	function article_cat($title){
		$this->db->select('*');
		$this->db->like('data_name',$title);
		$this->db->from('pfe_articles_categories');
		$query = $this->db->get();
		return $query;
	}

	function count_data_widget($widget_id){
		$this->db->where('status',1);
		$this->db->where('parent',$widget_id);
		$query = $this->db->get('pub_widgets')->num_rows();
		return $query;
	}

	function data_widget($widget_id,$number,$offset){
		$this->db->where('parent',$widget_id);
		  return $query = $this->db->get('pub_widgets',$number,$offset)->result();		
	  }

}
