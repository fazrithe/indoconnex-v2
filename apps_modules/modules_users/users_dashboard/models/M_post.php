<?php 
 
class m_post extends CI_Model{	

	function post($user_id){		
        $this->db->select('*');
        $this->db->from('pfe_posts');
        $this->db->where('users_id', $user_id);	
        $this->db->order_by('id','desc');	
        $query = $this->db->get();
        return $query;
	}		

}