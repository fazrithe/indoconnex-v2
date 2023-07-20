<?php

class M_favourite extends CI_Model
{

    function business_list($id){
        $this->db->select('pbd_business.*');
        $this->db->where('users_favorites.user_id',$id);
        $this->db->where('relation_table_name','pbd_business');
        $this->db->where('status',1);
        $this->db->from('pbd_business');
        $this->db->join('users_favorites', 'users_favorites.relation_table_id = pbd_business.id');
        $this->db->order_by('users_favorites.created_at','desc');
        $this->db->limit(4);
        $query = $this->db->get();
        return $query;
    }

    function business_all($id){
        $this->db->select('pbd_business.*');
        $this->db->where('users_favorites.user_id',$id);
        $this->db->where('relation_table_name','pbd_business');
        $this->db->where('status',1);
        $this->db->from('pbd_business');
        $this->db->join('users_favorites', 'users_favorites.relation_table_id = pbd_business.id');
        $this->db->order_by('users_favorites.created_at','desc');
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
		$this->db->where('pbd_items.status_buy_sells',0);
        $this->db->from('pbd_items');
        $this->db->join('users_favorites', 'users_favorites.relation_table_id = pbd_items.id');
        $this->db->order_by('users_favorites.created_at','desc');
        $this->db->limit(4);
        $query = $this->db->get();
        return $query;
    }

    function buy_list($id){
        $this->db->select('pbd_items.*');
        $this->db->where('users_favorites.user_id',$id);
        $this->db->where('users_favorites.relation_table_name','pbd_items');
        $this->db->where('pbd_items.status',1);
		$this->db->where('pbd_items.status_buy_sells',1);
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
		$this->db->where('pbd_items.status_buy_sells',0);
        $this->db->from('pbd_items');
        $this->db->join('users_favorites', 'users_favorites.relation_table_id = pbd_items.id');
        $this->db->order_by('users_favorites.created_at','desc');
        $query = $this->db->get();
        return $query;
    }

	function buy_all($id){
        $this->db->select('pbd_items.*');
        $this->db->where('users_favorites.user_id',$id);
        $this->db->where('users_favorites.relation_table_name','pbd_items');
        $this->db->where('pbd_items.status',1);
		$this->db->where('pbd_items.status_buy_sells',1);
        $this->db->from('pbd_items');
        $this->db->join('users_favorites', 'users_favorites.relation_table_id = pbd_items.id');
        $this->db->order_by('users_favorites.created_at','desc');
        $query = $this->db->get();
        return $query;
    }

    function community_list($id){
        $this->db->select('pcs_communities.*');
        $this->db->where('users_favorites.user_id',$id);
        $this->db->where('users_favorites.relation_table_name','pcs_communities');
        $this->db->where('pcs_communities.status',1);
        $this->db->from('pcs_communities');
        $this->db->join('users_favorites', 'users_favorites.relation_table_id = pcs_communities.id');
        $this->db->order_by('users_favorites.created_at','desc');
        $this->db->limit(4);
        $query = $this->db->get();
        return $query;
    }

    function community_all($id){
        $this->db->select('pcs_communities.*');
        $this->db->where('users_favorites.relation_table_name','pcs_communities');
        $this->db->where('pcs_communities.status',1);
        $this->db->from('pcs_communities');
        $this->db->join('users_favorites', 'users_favorites.relation_table_id = pcs_communities.id');
        $this->db->order_by('users_favorites.created_at','desc');
        $query = $this->db->get();
        return $query;
    }

	function tender_list($id)
	{
		$this->db->select('pbt_tender.*');
        $this->db->where('users_favorites.user_id',$id);
        $this->db->where('users_favorites.relation_table_name','pbt_tender');
        $this->db->where('pbt_tender.status',1);
        $this->db->from('pbt_tender');
        $this->db->join('users_favorites', 'users_favorites.relation_table_id = pbt_tender.id');
        $this->db->order_by('users_favorites.created_at','desc');
        $this->db->limit(4);
        $query = $this->db->get();
        return $query;
	}

	function tender_all($id)
	{
		$this->db->select('pbt_tender.*');
        $this->db->where('users_favorites.user_id',$id);
        $this->db->where('users_favorites.relation_table_name','pbt_tender');
        $this->db->where('pbt_tender.status',1);
        $this->db->from('pbt_tender');
        $this->db->join('users_favorites', 'users_favorites.relation_table_id = pbt_tender.id');
        $this->db->order_by('users_favorites.created_at','desc');
        $query = $this->db->get();
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
