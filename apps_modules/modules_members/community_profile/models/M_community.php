<?php

class M_community extends CI_Model{

    function post($id){
        return $this->db->query(
            "SELECT id,users_id,pcs_communities_id,data_description, '' as data_name,
            file_image_path,file_image_name_original,file_video_path,file_video_name,file_image_url,users_id,created_at,file_video_url FROM pcs_posts_lookfoor WHERE pcs_communities_id='".$id."'
            UNION SELECT id,users_id,pcs_communities_id,data_description, '' as data_name,
        file_image_path,file_image_name_original,file_video_path,file_video_name,file_image_url,users_id,created_at,file_video_url FROM pcs_posts WHERE pcs_communities_id='".$id."' Order by created_at desc"
        );
        // $this->db->select('pcs_posts.*');
        // $this->db->select('users.username');
        // $this->db->select('users.file_path as file_path_users');
        // $this->db->select('users.file_name_original as file_name_original_users');
        // $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        // $this->db->from('pcs_posts');
        // $this->db->where('pcs_posts.pcs_communities_id', $id);
        // $this->db->join('users','users.id = pcs_posts.users_id');
        // $this->db->order_by('pcs_posts.id','desc');
		// $this->db->limit(20);
        // $this->db->order_by('pcs_posts.created_at','desc');
        // $query = $this->db->get();
        // return $query;
	}

    function show_members($id){
        $this->db->select('users.*');
        $this->db->where('pcs_communities_follows.pcs_communities_id',$id);
        $this->db->where('users.status_privacy',0);
        $this->db->join('users','users.id = pcs_communities_follows.user_follow_id');
        $query = $this->db->get('pcs_communities_follows');
        return $query;
      }

      function join_album_photo_community($id){
        $this->db->select('*');
        $this->db->from('pcs_communities_albums');
        $this->db->where('pcs_communities_id',$id);
        $this->db->order_by('pcs_communities_albums.id','DESC');
        $query = $this->db->get();
        return $query;
    }

    function join_album_photo_community_($id){
        $this->db->select('*');
        $this->db->from('pcs_communities_albums');
        $this->db->where('id',$id);
        $this->db->order_by('pcs_communities_albums.id','DESC');
        $query = $this->db->get();
        return $query;
    }

    public function count_member($id)
	{
        $this->db->where('pcs_communities_follows.pcs_communities_id',$id);
        $this->db->from('pcs_communities_follows');
		$all_follows = $this->db->get();
		return $all_follows->num_rows();
	}
}
