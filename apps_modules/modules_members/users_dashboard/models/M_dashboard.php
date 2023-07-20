<?php

class M_dashboard extends CI_Model{

    function search_business($search){

        $this->db->where('status',1);
        $this->db->like('data_name',$search);
        $this->db->from('pbd_business');
        $data['count'] = $this->db->count_all_results();

        $this->db->where('status',1);
        $this->db->like('data_name',$search);
        $this->db->limit(10);
        $data['query'] = $this->db->get('pbd_business')->result();
        return $data;
    }

    function search_connections($search){
        $this->db->where('status_privacy',0);
        $this->db->like('username',$search);
        $this->db->or_like('name_first',$search);
        $this->db->or_like('name_middle',$search);
        $this->db->or_like('name_last',$search);
        $this->db->from('users');
        $data['count'] = $this->db->count_all_results();

        $this->db->where('status_privacy',0);
        $this->db->like('username',$search);
        $this->db->or_like('name_first',$search);
        $this->db->or_like('name_middle',$search);
        $this->db->or_like('name_last',$search);
        $this->db->limit(10);
        $data['query'] = $this->db->get('users')->result();
        return $data;
    }

    function search_products($search){
        $this->db->where('status',1);
        $this->db->like('data_name',$search);
        $this->db->from('pbd_items');
        $data['count'] = $this->db->count_all_results();

        $this->db->where('status',1);
        $this->db->like('data_name',$search);
        $this->db->limit(10);
        $data['query'] = $this->db->get('pbd_items')->result();
		return $data;
	}

    function search_jobs($search){
        $this->db->where('status',1);
        $this->db->like('data_name',$search);
        $this->db->from('pcj_jobs');
        $data['count'] = $this->db->count_all_results();

        $this->db->where('status',1);
        $this->db->like('data_name',$search);
        $this->db->limit(10);
        $data['query'] = $this->db->get('pcj_jobs')->result();
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

	function search_communities($search){
		$this->db->where('status',1);
		$this->db->like('data_name',$search);
		$this->db->from('pcs_communities');
		$data['count'] = $this->db->count_all_results();
  
		$this->db->where('status',1);
		$this->db->like('data_name',$search);
		$this->db->limit(10);
		$data['query'] = $this->db->get('pcs_communities')->result();
		 return $data;
	 }

	 function search_articles($search){
		$this->db->where('status',1);
		$this->db->like('data_name',$search);
		$this->db->from('pfe_articles');
		$data['count'] = $this->db->count_all_results();
  
		$this->db->where('status',1);
		$this->db->like('data_name',$search);
		$this->db->limit(10);
		$data['query'] = $this->db->get('pfe_articles')->result();
		 return $data;
	 }

    function search_for_businesses($term)
    {	
        $this->db->select('id');
        $this->db->select('file_path');
        $this->db->select('file_name_original');
        $this->db->select('data_username');
        $this->db->select('data_name');
        $this->db->select('published');
        $this->db->where('status', 1);
        $this->db->like('data_name', $term);
        $this->db->order_by('created_at', 'desc');
        $this->db->limit(3);
		return $this->db->get('pbd_business')->result();		
    }

    function search_for_products($term)
    {
        $this->db->select('id');
        $this->db->select('file_path');
        $this->db->select('file_name_original');
        $this->db->select('data_name');
        $this->db->where('status', 1);
        $this->db->where('status_buy_sells', 0);
        $this->db->like('data_name', $term);
        $this->db->order_by('created_at', 'desc');
        $this->db->limit(3);
		return $this->db->get('pbd_items')->result();
    }

    function search_for_buysells($term)
    {
        $this->db->select('id');
        $this->db->select('file_path');
        $this->db->select('file_name_original');
        $this->db->select('data_name');
        $this->db->where('status', 1);
        $this->db->where('status_buy_sells', 1);
        $this->db->like('data_name', $term);
        $this->db->order_by('created_at', 'desc');
        $this->db->limit(3);
		return $this->db->get('pbd_items')->result();
    }

    function search_for_jobs($term)
    {
        $this->db->select('pcj_jobs.id');
        $this->db->select('pcj_jobs.data_name');
        $this->db->select('pcj_jobs.file_path');
        $this->db->select('pcj_jobs.file_name_original');
        $this->db->select('pcj_jobs.created_at');
        $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        $this->db->join('users', 'users.id = pcj_jobs.users_id');
        $this->db->like('pcj_jobs.data_name', $term);
        $this->db->where('pcj_jobs.status', 1);
        $this->db->limit(3);
        return $this->db->get('pcj_jobs')->result();	
    }

    function search_for_connections($term) {
        $this->db->select('id');
        $this->db->select('username');
        $this->db->select('file_path');
        $this->db->select('file_name_original');
        $this->db->select('name_full');
        $this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
        $this->db->where('status_privacy', 0);
        $this->db->like('username', $term);
        $this->db->or_like('name_first', $term);
        $this->db->or_like('name_middle', $term);
        $this->db->or_like('name_last', $term);
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit(3);
        return $this->db->get('users')->result();
    }

    function search_for_communities($term) 
    {
        $this->db->select('id');
        $this->db->select('file_path');
        $this->db->select('file_name_original');
        $this->db->select('data_name');
        $this->db->select('published');
        $this->db->where('status', 1);
        $this->db->like('data_name', $term);
        $this->db->order_by('created_at', 'desc');
        $this->db->limit(3);
		return $this->db->get('pcs_communities')->result();
    }

    function search_for_articles($term)
    {
        $this->db->select('id');
        $this->db->select('file_path');
        $this->db->select('file_name_original');
        $this->db->select('data_name');
        $this->db->select('published');
        $this->db->like('data_name', $term);
        $this->db->order_by('created_at', 'desc');
        $this->db->limit(3);
		return $this->db->get('pfe_articles')->result();		
    }

    function get_buy_and_sells()
    {
        $this->db->select('pbd_items.*, pbd_items_sells.data_status');
        $this->db->from('pbd_items');
        $this->db->where('status', 1);
        $this->db->where('status_buy_sells', 1);
        $this->db->join('pbd_items_sells', 'pbd_items_sells.pbd_items_id = pbd_items.id');
        $this->db->limit(4);
        return $this->db->get();
    }
}
