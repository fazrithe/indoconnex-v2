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

}