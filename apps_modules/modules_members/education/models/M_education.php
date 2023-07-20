<?php

class M_education extends CI_Model
{

    function business_list(){
        $this->db->select('*');
        $this->db->where('status',1);
        $this->db->from('pbd_business');
        $this->db->order_by('created_at','desc');
        $query = $this->db->get();
        return $query;
    }

    function business_all($number,$offset){
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->order_by('id','desc');
		return $query = $this->db->get('pbd_business')->result();	
    }

	function count_data_business(){
		$this->db->where('status',1);
		$query = $this->db->get('pbd_business')->num_rows();
		return $query;
	}

	function business_all_count(){
        $this->db->select('*');
        $this->db->where('status',1);
        $this->db->from('pbd_business');
        $this->db->order_by('created_at','desc');
        $query = $this->db->get();
        return $query;
    }

    function job_list($id)
    {
        $this->db->select('pcj_jobs.*');
        $this->db->select('users.username');
        $this->db->where('users_favorites.user_id',$id);
        $this->db->where('relation_table_name','pcj_jobs');
        $this->db->where('pcj_jobs.status',1);
        $this->db->from('pcj_jobs');
        $this->db->join('users', 'users.id = pcj_jobs.users_id');
        $this->db->join('users_favorites', 'users_favorites.relation_table_id = pcj_jobs.id');
        $this->db->order_by('pcj_jobs.id', 'desc');
        $this->db->limit(4);
        $query = $this->db->get();
        return $query;
    }

    function job_all($id)
    {
        $this->db->select('pcj_jobs.*');
        $this->db->select('users.username');
        $this->db->where('users_favorites.user_id',$id);
        $this->db->where('relation_table_name','pcj_jobs');
        $this->db->where('pcj_jobs.status',1);
        $this->db->from('pcj_jobs');
        $this->db->join('users', 'users.id = pcj_jobs.users_id');
        $this->db->join('users_favorites', 'users_favorites.relation_table_id = pcj_jobs.id');
        $this->db->order_by('pcj_jobs.id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    function market_list($id){
        $this->db->select('pbd_items.*');
        $this->db->where('users_favorites.user_id',$id);
        $this->db->where('users_favorites.relation_table_name','pbd_items');
        $this->db->where('pbd_items.status',1);
        $this->db->from('pbd_items');
        $this->db->join('users_favorites', 'users_favorites.relation_table_id = pbd_items.id');
        $this->db->order_by('users_favorites.created_at','desc');
        $this->db->limit(4);
        $query = $this->db->get();
        return $query;
    }

    function market_all($id){
        $this->db->select('pbd_items.*');
        $this->db->where('users_favorites.user_id',$id);
        $this->db->where('users_favorites.relation_table_name','pbd_items');
        $this->db->where('pbd_items.status',1);
        $this->db->from('pbd_items');
        $this->db->join('users_favorites', 'users_favorites.relation_table_id = pbd_items.id');
        $this->db->order_by('users_favorites.created_at','desc');
        $query = $this->db->get();
        return $query;
    }

    function community_list($category){
		$this->db->select('pcs_communities.*');
		$this->db->select('pcs_communities_categories.data_name as category_name');
		$this->db->where('pcs_communities_categories.data_name',$category);
        $this->db->where('pcs_communities.status',1);
        $this->db->from('pcs_communities');
        $this->db->join('pcs_communities_categories', 'pcs_communities_categories.id = pcs_communities.data_categories');
        $this->db->order_by('pcs_communities.created_at','desc');
        $this->db->limit(4);
        $query = $this->db->get();
        return $query;
    }

    function community_all($category,$number,$offset){
        $this->db->select('pcs_communities.*');
		$this->db->select('pcs_communities_categories.data_name as category_name');
		$this->db->where('pcs_communities_categories.data_name',$category);
        $this->db->where('pcs_communities.status',1);
        $this->db->join('pcs_communities_categories', 'pcs_communities_categories.id = pcs_communities.data_categories');
        $this->db->order_by('pcs_communities.created_at','desc');
        return $query = $this->db->get('pcs_communities',$number,$offset)->result();	
        return $query;
    }

	function count_data_community($category){
		$this->db->select('pcs_communities.*');
		$this->db->select('pcs_communities_categories.data_name as category_name');
		$this->db->where('pcs_communities_categories.data_name',$category);
        $this->db->where('pcs_communities.status',1);
        $this->db->join('pcs_communities_categories', 'pcs_communities_categories.id = pcs_communities.data_categories');
        $this->db->order_by('pcs_communities.created_at','desc');
		$query = $this->db->get('pcs_communities')->num_rows();
		return $query;
	}

    function article_list($id){
        $this->db->select('pfe_articles.*');
        $this->db->where('users_favorites.user_id',$id);
        $this->db->where('users_favorites.relation_table_name','pfe_articles');
        $this->db->where('pfe_articles.status',1);
        $this->db->from('pfe_articles');
        $this->db->join('users_favorites', 'users_favorites.relation_table_id = pfe_articles.id');
        $this->db->order_by('users_favorites.created_at','desc');
        $this->db->limit(4);
        $query = $this->db->get();
        return $query;
    }

    function article_all($id){
        $this->db->select('pfe_articles.*');
        $this->db->where('users_favorites.user_id',$id);
        $this->db->where('users_favorites.relation_table_name','pfe_articles');
        $this->db->where('pfe_articles.status',1);
        $this->db->from('pfe_articles');
        $this->db->join('users_favorites', 'users_favorites.relation_table_id = pfe_articles.id');
        $this->db->order_by('users_favorites.created_at','desc');
        $query = $this->db->get();
        return $query;
    }

}
