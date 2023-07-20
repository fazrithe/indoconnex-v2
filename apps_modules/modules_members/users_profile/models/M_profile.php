<?php

class M_profile extends CI_Model {

	function join_album_profile(){
	  $this->db->select('users_albums.*');
      $this->db->from('users_albums');
      $this->db->join('users_albums_photo','users_albums.id = users_albums_photo.users_albums_id');
      $query = $this->db->get();
      return $query;
	}

    function join_album_photo_profile($id){
        $this->db->select('*');
        $this->db->from('users_albums_photo');
        $this->db->where('users_id',$id);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        return $query;
    }

    function albums($id){
        $this->db->select('*');
        $this->db->where('users_id',$id);
        $this->db->from('users_albums');
        $query = $this->db->get();
        return $query;
    }

    function join_album_photo_profile_id($id){
        $this->db->select('users_albums_photo.*');
        $this->db->from('users_albums_photo');
        $this->db->join('users_albums','users_albums.id = users_albums_photo.users_albums_id');
        $this->db->where('users_albums_photo.users_albums_id',$id);
        $query = $this->db->get();
        return $query;
    }

    function join_album_profile_id($id){
        $this->db->select('users_albums.*');
        $this->db->from('users_albums');
        $this->db->join('users_albums_photo','users_albums.id = users_albums_photo.users_albums_id');
        $this->db->where('users_albums.id',$id);
        $query = $this->db->get();
        return $query;
      }

    function post($user_id){
        return $this->db->query(
            "SELECT id,users_id,pbd_business_id,data_description, '' as data_name,
            file_image_path,file_image_name_original,file_video_path,file_video_name,file_image_url,users_id,created_at,file_video_url FROM pfe_posts_lookfoor
            UNION SELECT id,users_id,pbd_business_id,data_description, '' as data_name,
        file_image_path,file_image_name_original,file_video_path,file_video_name,file_image_url,users_id,created_at,file_video_url FROM pfe_posts
        UNION SELECT id,users_id,pbd_business_id,data_description,data_name,file_path,file_name_original,file_name_thumbnail,data_categories,data_tags,users_id,created_at,published FROM pfe_articles Order by created_at desc"
        );
        // $this->db->select('pfe_posts.*');
        // $this->db->select('users.username');
        // $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        // $this->db->from('pfe_posts');
        // $this->db->where('users_id', $user_id);
        // $this->db->where('pbd_business_id', 'undefined');
        // $this->db->join('users','users.id = pfe_posts.users_id');
        // $this->db->order_by('pfe_posts.id','desc');	
		// $this->db->limit(20);
        // $this->db->order_by('pfe_posts.created_at','desc');
        // $query = $this->db->get();
        // return $query;
	}

    function post_article($user_id){
        $this->db->select('*');
        $this->db->from('pfe_articles');
        $this->db->where('users_id', $user_id);
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        return $query;
	}

    function show_comment(){
        $this->db->select('*');
        $this->db->select('pfe_media_comments.id as comment_id');
        $this->db->select('pfe_media_comments.created_at as comment_created_at');
        $this->db->select('users.username as user_name');
        $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        $this->db->from('pfe_media_comments');
        $this->db->join('users','users.id = pfe_media_comments.users_id');
        $this->db->order_by('pfe_media_comments.created_at','asc');
        $query = $this->db->get();
        return $query;
	}

    function show_comment_where($id){
        $this->db->select('*');
        $this->db->select('pfe_media_comments.id as comment_id');
        $this->db->select('pfe_media_comments.created_at as comment_created_at');
        $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        $this->db->where('relate_id',$id);
        $this->db->from('pfe_media_comments');
        $this->db->join('users','users.id = pfe_media_comments.users_id');
        $this->db->order_by('pfe_media_comments.created_at','asc');
        $query = $this->db->get();
        return $query;
	}

    function show_connection($id){
        $this->db->select('users.*');
        $this->db->where('users_follows.user_id',$id);
        $this->db->where('users.status_privacy',0);
        $this->db->from('users_follows');
        $this->db->join('users','users.id = users_follows.user_follow_id');
        $query = $this->db->get();
        return $query;
      }

      function show_followers($id){
        $this->db->select('users.*');
        $this->db->where('users_follows.user_follow_id',$id);
        $this->db->where('users.status_privacy',0);
        $this->db->from('users_follows');
        $this->db->join('users','users.id = users_follows.user_id');
        $query = $this->db->get();
        return $query;
      }

    public function count_comment()
	{
		$all_users=$this->db->select()
						    ->get('pfe_media_comments');
		return $all_users->num_rows();
	}

    public function count_follow($id)
	{
		$this->db->select();
        $this->db->where('users_follows.user_follow_id',$id);
        $this->db->from('users_follows');
		$all_follows = $this->db->get();
		return $all_follows->num_rows();
	}

    function join_jobs($id){
        $this->db->select('pcj_jobs.*');
        $this->db->select('users.username');
        $this->db->where('pcj_jobs.users_id',$id);
        $this->db->from('pcj_jobs');
        $this->db->join('users','users.id = pcj_jobs.users_id');
        $query = $this->db->get();
        return $query;
      }

    function count_like($id)
    {
        $this->db->where('relate_id', $id);
        $this->db->from('pfe_media_likes');
        return $this->db->count_all_results();
    }

	function show_view($id){
        $this->db->select('users.*');
        $this->db->where('user_views.user_id',$id);
        $this->db->where('users.status_privacy',0);
        $this->db->from('user_views');
        $this->db->join('users','users.id = user_views.view_id');
        $query = $this->db->get();
        return $query;
      }
}
