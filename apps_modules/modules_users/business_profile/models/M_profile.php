<?php 
 
class m_profile extends CI_Model{	

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
        $this->db->select('*');
        $this->db->from('pfe_posts');
        $this->db->where('users_id', $user_id);	
        $this->db->order_by('id','desc');	
        $query = $this->db->get();
        return $query;
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
        $this->db->from('pfe_media_comments');	
        $this->db->order_by('id','desc');	
        $query = $this->db->get();
        return $query;
	}	

    function show_comment_where($id){		
        $this->db->select('*');
        $this->db->where('relate_id',$id);
        $this->db->from('pfe_media_comments');	
        $this->db->order_by('id','desc');	
        $query = $this->db->get();
        return $query;
	}	

}