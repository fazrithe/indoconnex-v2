<?php 
 
class M_sharing extends CI_Model{	

        function post($user_id){		
                $this->db->select('pfe_posts.*');
                $this->db->select('users.username');
                $this->db->select('users.file_path as file_path_user');
                $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
                $this->db->select('users.file_name_original as file_name_original_user');
                $this->db->from('pfe_posts');
                $this->db->join('users','users.id = pfe_posts.users_id');
                $this->db->order_by('pfe_posts.id','desc');	
                $query = $this->db->get();
                return $query;
	}		

        function get_users(){	
                $this->db->select('*');	
                $this->db->from('users');
                $query = $this->db->get();
                return $query;
	}		

        function post_all($post){		
                return $this->db->query('SELECT id,users_id,pbd_business_id,post_type,data_description, "" as data_name,"" as date_open,
		file_image_path,file_image_name_original,file_video_path,file_video_name,"" as data_types,file_image_url,users_id,created_at,file_video_url, "" as data_location,"" as status_buy_sells,"" as price_type,"" as price_low,"" as price_currency, "" as relate_id, "" as owner_post_id, "" AS post_liked FROM pfe_posts
                WHERE id LIKE "'.$post.'"
                UNION SELECT id,users_id,pbd_business_id,post_type,data_description,data_name,file_path,file_name_original,file_name_thumbnail,data_categories,"" as data_types,"" as date_open,data_tags,users_id,created_at,published, "" as data_location,"" as status_buy_sells,"" as price_type,"" as price_low,"" as price_currency, "" as relate_id, "" as owner_post_id, "" AS post_liked FROM pfe_articles
                WHERE data_name LIKE "'.$post.'"
                Order by created_at desc');
	}		

}
