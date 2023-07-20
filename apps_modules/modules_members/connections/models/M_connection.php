<?php

use phpDocumentor\Reflection\Types\This;

class M_connection extends CI_Model {

      function show_connection($id){
        $this->db->select('users.*');
        $this->db->where('users_follows.user_id',$id);
        $this->db->where('users.status_privacy',0);
        $this->db->from('users_follows');
        $this->db->join('users','users.id = users_follows.user_follow_id');
        $query = $this->db->get();
        return $query;
      }

      function show_following($id,$number,$offset){
        $this->db->select('users.id, users.username, users.name_first, users.name_middle, users.name_last, users.file_path, users.file_name_original');
        $this->db->where('users_follows.user_id',$id);
        $this->db->where('users.status_privacy',0);
        $this->db->join('users','users.id = users_follows.user_follow_id');
        $query = $this->db->get('users_follows',$number,$offset);
        return $query;
      }

      function show_following_business($id,$number,$offset){
        $this->db->select('pbd_business.*');
        $this->db->where('users_follows.user_id',$id);
        $this->db->join('pbd_business','pbd_business.id = users_follows.user_follow_id');

        $query = $this->db->get('users_follows',$number,$offset);
        return $query;
      }

      function show_followers($id,$number,$offset){
        $this->db->select('users.*');
        $this->db->where('users_follows.user_follow_id',$id);
        $this->db->where('users.status_privacy',0);
        $this->db->join('users','users.id = users_follows.user_id');
        $query = $this->db->get('users_follows',$number,$offset);
        return $query;
      }

      function show_followers_business($id){
        $this->db->select('pbd_business.*');
        $this->db->where('users_follows.user_follow_id',$id);
        $this->db->join('pbd_business','pbd_business.id = users_follows.user_follow_id');
        $query = $this->db->get('users_follows');
        return $query;
      }

      function count_data_following($id){
        $this->db->where('users.status_privacy',0);
        $this->db->where('user_id',$id);
        $this->db->join('users','users.id = users_follows.user_follow_id');
        $query = $this->db->get('users_follows')->num_rows();
        return $query;
      }

      function count_data_followers($id){
        $this->db->where('users_follows.user_id',$id);
        $this->db->join('pbd_business','pbd_business.id = users_follows.user_follow_id');
        $query = $this->db->get('users_follows')->num_rows();
        return $query;
      }

      function count_data(){
        $this->db->where('status_privacy',0);
        $query = $this->db->get('users')->num_rows();
        return $query;
      }

      function count_data_business(){
        $this->db->where('status',1);
        $query = $this->db->get('pbd_business')->num_rows();
        return $query;
      }

      function count_data_filter($name){
        $this->db->where('status_privacy',0);
        $this->db->like('name_first',$name);
        $this->db->or_like('name_middle',$name);
        $this->db->or_like('name_last',$name);
        $query = $this->db->get('users')->num_rows();
        return $query;
      }

      function count_data_filter_business($name){
        $this->db->where('status_privacy',0);
        $this->db->like('data_name',$name);
        $query = $this->db->get('pbd_business')->num_rows();
        return $query;
      }

      // function data($number,$offset){
      //   $this->db->select('*');
      //   $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
      //   $this->db->where('status_privacy',0);
      //   return $query = $this->db->get('users',$number,$offset)->result();
      // }

      function get_people()
      {
        $this->db->select('id');
        $this->db->select('username');
        $this->db->select('file_path');
        $this->db->select('file_name_original');
        $this->db->select('name_full');
        $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        $this->db->where('status_privacy', 0);
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit(6);
        return $this->db->get('users')->result();
      }

      function get_all_people($number, $offset)
      {
        $this->db->select('id');
        $this->db->select('username');
        $this->db->select('file_path');
        $this->db->select('file_name_original');
        $this->db->select('name_full');
        $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        $this->db->where('status_privacy', 0);
        return $this->db->get('users', $number, $offset)->result();
      }

      function filter_people($name, $limit, $offset)
      {
        $this->db->select('id');
        $this->db->select('username');
        $this->db->select('file_path');
        $this->db->select('file_name_original');
        $this->db->select('name_full');
        $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        $this->db->where('status_privacy', 0);

        if ($name) {
          $this->db->like('name_full', $name);
          $this->db->or_like('name_first', $name);
          $this->db->or_like('name_middle', $name);
          $this->db->or_like('name_last', $name);
        }

        return $this->db->get('users', $limit, $offset)->result();
        
      }

      function filter_people_count($name)
      {
        $this->db->select('id');
        $this->db->select('username');
        $this->db->select('file_path');
        $this->db->select('file_name_original');
        $this->db->select('name_full');
        $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        $this->db->where('status_privacy', 0);

        if ($name) {
          $this->db->like('name_full', $name);
          $this->db->or_like('name_first', $name);
          $this->db->or_like('name_middle', $name);
          $this->db->or_like('name_last', $name);
        }

        return $this->db->get('users')->num_rows();
      }

      // function data_business($number,$offset){
      //   $this->db->select('*');
      //   $this->db->where('status',1);
      //   return $query = $this->db->get('pbd_business',$number,$offset)->result();
      // }

      function get_pages()
      {
        $this->db->select('id');
        $this->db->select('data_username');
        $this->db->select('data_name');
        $this->db->select('file_path');
        $this->db->select('file_name_original');
        $this->db->where('status', 1);
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit(6);
        return $this->db->get('pbd_business')->result();
      }

      function get_all_pages($number, $offset)
      {
        $this->db->select('id');
        $this->db->select('data_username');
        $this->db->select('data_name');
        $this->db->select('file_path');
        $this->db->select('file_name_original');
        $this->db->where('status', 1);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('pbd_business', $number, $offset)->result();
      }

      function filter_pages($name, $limit, $offset)
      {
        $this->db->select('id');
        $this->db->select('data_username');
        $this->db->select('data_name');
        $this->db->select('file_path');
        $this->db->select('file_name_original');
        $this->db->where('status', 1);

        if ($name) {
          $this->db->like('data_name', $name);
        }

        return $this->db->get('pbd_business', $limit, $offset)->result();
        
      }

      function filter_pages_count($name)
      {
        $this->db->select('id');
        $this->db->select('data_username');
        $this->db->select('data_name');
        $this->db->select('file_path');
        $this->db->select('file_name_original');
        $this->db->where('status', 1);

        if ($name) {
          $this->db->like('data_name', $name);
        }

        return $this->db->get('pbd_business')->num_rows();
      }

      function data_filter_business($name,$number,$offset){
        $this->db->select('*');
        $this->db->where('status',1);
        $this->db->like('data_name',$name);
        return $query = $this->db->get('pbd_business',$number,$offset)->result();
      }

      // function data($number, $offset){
      //   return $this->db->query(
      //     '(SELECT id,username,file_path,file_name_original,CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as data_name FROM users WHERE status_privacy=0 LIMIT '.$number.','.$offset.')
      //     UNION ALL
      //     (SELECT id,data_username,file_path,file_name_original,data_name FROM pbd_business WHERE status=1 LIMIT '.$number.','.$offset.')'
      //     );
      // }

      // function count_data(){
      //   return $this->db->query(
      //     '(SELECT username FROM users WHERE status_privacy=0 )
      //     UNION
      //     (SELECT data_username FROM pbd_business WHERE status=1)'
      //     );
      // }

      function data_filter($name,$number,$offset){
        $this->db->select('*');
        $this->db->select('CONCAT(name_first, " ",name_middle, " ",name_last) as fullname');
        $this->db->where('status_privacy',0);
        $this->db->like('name_first',$name);
        $this->db->or_like('name_middle',$name);
        $this->db->or_like('name_last',$name);
        return $query = $this->db->get('users',$number,$offset)->result();
      }

      function data_sugest(){
        $this->db->where('status_privacy',0);
        $this->db->order_by('id', 'random');
        return $query = $this->db->get('users')->result();
      }

    function get_current_user_community_ids()
    {
        $this->db->select('pcs_communities_id, user_follow_id');
        $this->db->join('pcs_communities', 'pcs_communities.id = pcs_communities_follows.pcs_communities_id');
        $this->db->where('pcs_communities.status', 1);
        $this->db->where('user_follow_id', $_SESSION['user_id']);
        return $this->db->get('pcs_communities_follows');
    }

    function get_community_ids_by_user_id($user_id)
    {
        $this->db->select('pcs_communities_id, user_follow_id');
        $this->db->join('pcs_communities', 'pcs_communities.id = pcs_communities_follows.pcs_communities_id');
        $this->db->where('pcs_communities.status', 1);
        $this->db->where('user_follow_id', $user_id);
        return $this->db->get('pcs_communities_follows');
    }
}
