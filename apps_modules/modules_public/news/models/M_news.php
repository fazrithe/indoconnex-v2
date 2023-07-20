<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_news extends CI_Model {

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

	function news_list(){
		$this->db->select('pnu_news.*');
		$this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
		$this->db->where('pnu_news.status',1);
		$this->db->from('pnu_news');
		$this->db->join('users', 'users.id = pnu_news.users_id');
		$this->db->order_by('pnu_news.id', 'desc');
		$query = $this->db->get()->result();
		return $query;
	}

	function news_detail($slug){
      $this->db->like('data_slug',$slug);
      $this->db->from('pnu_news');
     	$query = $this->db->get()->row();
		return $query;
	}
}
