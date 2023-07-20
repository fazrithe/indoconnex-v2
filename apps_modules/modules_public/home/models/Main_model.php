<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {

   // Fetch users
   function getCountry($searchTerm=""){
      $priority_countries = [
         ['id' => 14, 'text' => 'Australia'],
         ['id' => 102, 'text' => 'Indonesia']
      ];

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

      if (! $searchTerm) {
         return array_merge($priority_countries, $data);
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

	function search_communities($search){
      $this->db->where('status',1);
      $this->db->like('data_name',$search['query']);
      $this->db->from('pcs_communities');
      $data['count'] = $this->db->count_all_results();

      $this->db->where('status',1);
      $this->db->like('data_name',$search['query']);
      $this->db->limit(10);
      $data['query'] = $this->db->get('pcs_communities')->result();
   	return $data;
   }

	function search_articles($search){
      $this->db->where('status',1);
      $this->db->like('data_name',$search['query']);
      $this->db->from('pfe_articles');
      $data['count'] = $this->db->count_all_results();

      $this->db->where('status',1);
      $this->db->like('data_name',$search['query']);
      $this->db->limit(10);
      $data['query'] = $this->db->get('pfe_articles')->result();
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

	function mission(){
		$this->db->select('*');
		$this->db->from('pub_profile');
		$this->db->like('data_section', 'section_mission_');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query;
 	}
}
