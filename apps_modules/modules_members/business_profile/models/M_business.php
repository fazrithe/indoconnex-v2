<?php

class M_business extends CI_Model{

	function join_album_profile()
	{
	  $this->db->select('users_albums.*');
	  $this->db->from('users_albums');
	  $this->db->join('users_albums_photo','users_albums.id = users_albums_photo.users_albums_id');
	  $query = $this->db->get();
	  return $query;
	}

	function join_album_photo_business($id)
	{
		$this->db->select('*');
		$this->db->from('pbd_business_photo');
		$this->db->where('pbd_business_id',$id);
	   $this->db->order_by('pbd_business_photo.id','DESC');
		$query = $this->db->get();
		return $query;
	}

	function join_photo_business($id)
	{
		$this->db->select('*');
		$this->db->from('pbd_business_photo');
		$this->db->where('pbd_business_photo.pbd_business_categories_id',$id);
		$this->db->order_by('pbd_business_photo.id','DESC');
		$query = $this->db->get();
		return $query;
	}

	function join_album_photo_profile_id($id)
	{
		$this->db->select('users_albums_photo.*');
		$this->db->from('users_albums_photo');
		$this->db->join('users_albums','users_albums.id = users_albums_photo.users_albums_id');
		$this->db->where('users_albums_photo.users_albums_id',$id);
		$query = $this->db->get();
		return $query;
	}

	function join_album_profile_id($id)
	{
		$this->db->select('users_albums.*');
		$this->db->from('users_albums');
		$this->db->join('users_albums_photo','users_albums.id = users_albums_photo.users_albums_id');
		$this->db->where('users_albums.id',$id);
		$query = $this->db->get();
		return $query;
	}

	function post($business_id)
	{
		return $this->db->query(
			"SELECT id,users_id,pbd_business_id,data_description, '' as data_name,
			file_image_path,file_image_name_original,file_video_path,file_video_name,file_image_url,users_id,created_at,file_video_url FROM pfe_posts_lookfoor WHERE pbd_business_id='".$business_id."'
			UNION SELECT id,users_id,pbd_business_id,data_description, '' as data_name,
		file_image_path,file_image_name_original,file_video_path,file_video_name,file_image_url,users_id,created_at,file_video_url FROM pfe_posts WHERE pbd_business_id='".$business_id."'
		UNION SELECT id,users_id,pbd_business_id,data_description,data_name,file_path,file_name_original,file_name_thumbnail,data_categories,data_tags,users_id,created_at,published FROM pfe_articles WHERE pbd_business_id='".$business_id."' Order by created_at desc"
		);
	}

	function post_article($user_id)
	{
		$this->db->select('*');
		$this->db->from('pfe_articles');
		$this->db->where('users_id', $user_id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query;
	}

	function show_comment()
	{
		$this->db->select('*');
		$this->db->from('pfe_media_comments');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query;
	}

	function show_comment_where($id)
	{
		$this->db->select('*');
		$this->db->where('relate_id',$id);
		$this->db->from('pfe_media_comments');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query;
	}

	public function count_follow($id)
	{
		$this->db->where('users_follows.user_follow_id',$id);
		$this->db->from('users_follows');
		$all_follows = $this->db->get();
		return $all_follows->num_rows();
	}

	function show_follow($id)
	{
		$this->db->select('users.*');
		$this->db->where('users_follows.user_follow_id',$id);
		$this->db->where('users.status_privacy',0);
		$this->db->from('users_follows');
		$this->db->join('users','users.id = users_follows.user_id');
		$query = $this->db->get();
		return $query;
	}

	function join_jobs($id)
	{
		$this->db->select('pcj_jobs.*');
		$this->db->select('pbd_business.data_username');
		$this->db->select('pbd_business.data_name');
		$this->db->select('pbd_business.users_id');
		$this->db->where('pcj_jobs.pbd_business_id',$id);
		$this->db->from('pcj_jobs');
		$this->db->join('pbd_business','pbd_business.id = pcj_jobs.pbd_business_id');
		$query = $this->db->get();
		return $query;
	}

	function data_product($user_id)
	{
		$this->db->where('users_id',$user_id);
		$this->db->where('data_type','product');
		return $query = $this->db->get('pbd_items')->result();
	}

	function data_service($user_id)
	{
		$this->db->where('users_id',$user_id);
		$this->db->where('data_type','service');
		return $query = $this->db->get('pbd_items')->result();
	}
}
