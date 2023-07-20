<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {

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

}