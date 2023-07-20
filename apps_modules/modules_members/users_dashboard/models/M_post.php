<?php

class M_post extends CI_Model
{

	function post($user_id)
	{
		$this->db->select('pfe_posts.*');
		$this->db->select('users.username');
		$this->db->select('users.file_path as file_path_user');
		$this->db->select('CONCAT(users.name_first, " ", users.name_middle, " ", users.name_last) as fullname');
		$this->db->select('users.file_name_original as file_name_original_user');
		$this->db->from('pfe_posts');
		$this->db->join('users', 'users.id = pfe_posts.users_id');
		$this->db->order_by('pfe_posts.id', 'desc');
		$query = $this->db->get();
		return $query;
	}

	function get_users()
	{
		$this->db->select('*');
		$this->db->from('users');
		$query = $this->db->get();
		return $query;
	}

	function post_all($limit,$start)
	{
		$offset='';
		if(!empty($start))
		{
			$offset = ' OFFSET ' . $start;
		}

		return $this->db->query(
			'(SELECT id,users_id,pbd_business_id,post_type,data_description, "" as data_name,
			file_image_path,file_image_name_original,file_video_path,file_video_name,"" as data_types,"" as date_open,file_image_url,users_id,created_at,file_video_url, "" as data_location,"" as status_buy_sells,"" as price_type,"" as price_low,"" as price_currency, "" as relate_id, "" as owner_post_id, "" AS post_liked FROM pfe_posts_lookfoor ORDER BY created_at desc LIMIT '.$limit.$offset.')
			UNION
			(SELECT id,users_id,pbd_business_id,post_type,data_description, "" as data_name,"" as date_open,
			file_image_path,file_image_name_original,file_video_path,file_video_name,"" as data_types,file_image_url,users_id,created_at,file_video_url, "" as data_location,"" as status_buy_sells,"" as price_type,"" as price_low,"" as price_currency, "" as relate_id, "" as owner_post_id, "" AS post_liked FROM pfe_posts ORDER BY created_at desc LIMIT '.$limit.$offset.')
			UNION
			(SELECT DISTINCT pfe_media_comments.id, pfe_media_comments.users_id, pfe_posts.pbd_business_id, pfe_posts.post_type, pfe_posts.data_description, "" as data_name, "" as date_open, pfe_posts.file_image_path, pfe_posts.file_image_name_original, pfe_posts.file_video_path, pfe_posts.file_video_name, "" as data_types, pfe_posts.file_image_url,users.id, pfe_media_comments.created_at, pfe_posts.file_video_url, "" as data_location, "" as status_buy_sells, "" as price_type, "" as price_low, "" as price_currency, pfe_media_comments.relate_id, pfe_posts.users_id AS owner_post_id, "" AS post_liked FROM users JOIN pfe_media_comments ON users.id = pfe_media_comments.users_id JOIN pfe_posts ON pfe_media_comments.relate_id = pfe_posts.id WHERE users.id != pfe_posts.users_id GROUP BY pfe_media_comments.users_id, pfe_media_comments.relate_id  ORDER BY pfe_media_comments.created_at DESC LIMIT '.$limit.$offset.')
			UNION
			(SELECT DISTINCT pfe_media_likes.id, pfe_media_likes.users_id, pfe_posts.pbd_business_id, pfe_posts.post_type, pfe_posts.data_description, "" as data_name, "" as date_open, pfe_posts.file_image_path, pfe_posts.file_image_name_original, pfe_posts.file_video_path, pfe_posts.file_video_name, "" as data_types, pfe_posts.file_image_url,users.id, pfe_media_likes.created_at, pfe_posts.file_video_url, "" as data_location, "" as status_buy_sells, "" as price_type, "" as price_low, "" as price_currency, pfe_media_likes.relate_id, pfe_posts.users_id AS owner_post_id, "true" AS post_liked FROM users JOIN pfe_media_likes ON users.id = pfe_media_likes.users_id JOIN pfe_posts ON pfe_media_likes.relate_id = pfe_posts.id WHERE users.id != pfe_posts.users_id ORDER BY pfe_media_likes.created_at DESC LIMIT '.$limit.$offset.')
			UNION
			(SELECT id,users_id,"" as pbd_business_id,post_type,"" as data_description, "" as data_name,
			file_image_path,file_image_name_original,"" as file_video_path,"" as file_video_name,"" as data_types,"" as date_open,"" as file_image_url,users_id,created_at,"" as file_video_url, "" as data_location,"" as status_buy_sells,"" as price_type,"" as price_low,"" as price_currency, "" as relate_id, "" as owner_post_id, "" AS post_liked FROM activities_users_photo_profile ORDER BY created_at desc LIMIT '.$limit.$offset.')
			UNION
			(SELECT id,users_id,pbd_business_id,post_type,data_description,data_name,file_path,file_name_original,file_name_thumbnail,data_categories,"" as data_types,"" as date_open,data_tags,users_id,created_at,published, "" as data_location,"" as status_buy_sells,"" as price_type,"" as price_low,"" as price_currency, "" as relate_id, "" as owner_post_id, "" AS post_liked FROM pfe_articles Order by created_at desc LIMIT '.$limit.$offset.')
			UNION
			(SELECT id,users_id,pbd_business_id,post_type,data_description,data_name,file_path,file_name_original,file_name_thumbnail,data_categories,data_types,date_open,"" as data_tags,users_id,created_at,published, "" as data_location,"" as status_buy_sells,"" as price_type,"" as price_low,"" as price_currency, "" as relate_id, "" as owner_post_id, "" AS post_liked FROM pbt_tender Order by created_at desc LIMIT '.$limit.$offset.')
			UNION
			(SELECT id,users_id,pbd_business_id,post_type,data_description,data_name,file_path,file_name_original,file_name_thumbnail,data_categories,jobs_types_id,"" as date_open,"" as data_tags,users_id,created_at,published, data_location,"" as status_buy_sells ,"" as price_type,"" as price_low,"" as price_currency, "" as relate_id, "" as owner_post_id, "" AS post_liked FROM pcj_jobs Order by created_at desc LIMIT '.$limit.$offset.')
			UNION
			(SELECT id,users_id,pbd_business_id,"" as post_type,data_description,data_name,file_path,file_name_original,file_name_thumbnail,data_categories,"" as jobs_types_id,"" as date_open,"" as data_tags,users_id,created_at,published, "" as data_location,status_buy_sells, price_type,price_low,price_currency, "" as relate_id, "" as owner_post_id, "" AS post_liked FROM pbd_items WHERE status_buy_sells = "1" Order by created_at desc LIMIT '.$limit.$offset.')
			ORDER BY created_at DESC'
		);
	}

	public function getPostsCount()
    {
        return $this->db->query(
			'(SELECT id,users_id,pbd_business_id,post_type,data_description, "" as data_name,
			file_image_path,file_image_name_original,file_video_path,file_video_name,"" as data_types,"" as date_open,file_image_url,users_id,created_at,file_video_url, "" as data_location,"" as status_buy_sells,"" as price_type,"" as price_low,"" as price_currency, "" as relate_id, "" as owner_post_id, "" AS post_liked FROM pfe_posts_lookfoor ORDER BY created_at desc)
			UNION
			(SELECT id,users_id,pbd_business_id,post_type,data_description, "" as data_name,"" as date_open,
			file_image_path,file_image_name_original,file_video_path,file_video_name,"" as data_types,file_image_url,users_id,created_at,file_video_url, "" as data_location,"" as status_buy_sells,"" as price_type,"" as price_low,"" as price_currency, "" as relate_id, "" as owner_post_id, "" AS post_liked FROM pfe_posts ORDER BY created_at desc)
			UNION
			(SELECT DISTINCT pfe_media_comments.id, pfe_media_comments.users_id, pfe_posts.pbd_business_id, pfe_posts.post_type, pfe_posts.data_description, "" as data_name, "" as date_open, pfe_posts.file_image_path, pfe_posts.file_image_name_original, pfe_posts.file_video_path, pfe_posts.file_video_name, "" as data_types, pfe_posts.file_image_url,users.id, pfe_media_comments.created_at, pfe_posts.file_video_url, "" as data_location, "" as status_buy_sells, "" as price_type, "" as price_low, "" as price_currency, pfe_media_comments.relate_id, pfe_posts.users_id AS owner_post_id, "" AS post_liked FROM users JOIN pfe_media_comments ON users.id = pfe_media_comments.users_id JOIN pfe_posts ON pfe_media_comments.relate_id = pfe_posts.id WHERE users.id != pfe_posts.users_id ORDER BY pfe_media_comments.created_at DESC)
			UNION
			(SELECT DISTINCT pfe_media_likes.id, pfe_media_likes.users_id, pfe_posts.pbd_business_id, pfe_posts.post_type, pfe_posts.data_description, "" as data_name, "" as date_open, pfe_posts.file_image_path, pfe_posts.file_image_name_original, pfe_posts.file_video_path, pfe_posts.file_video_name, "" as data_types, pfe_posts.file_image_url,users.id, pfe_media_likes.created_at, pfe_posts.file_video_url, "" as data_location, "" as status_buy_sells, "" as price_type, "" as price_low, "" as price_currency, pfe_media_likes.relate_id, pfe_posts.users_id AS owner_post_id, "true" AS post_liked FROM users JOIN pfe_media_likes ON users.id = pfe_media_likes.users_id JOIN pfe_posts ON pfe_media_likes.relate_id = pfe_posts.id WHERE users.id != pfe_posts.users_id ORDER BY pfe_media_likes.created_at DESC)
			UNION
			(SELECT id,users_id,"" as pbd_business_id,post_type,"" as data_description, "" as data_name,
			file_image_path,file_image_name_original,"" as file_video_path,"" as file_video_name,"" as data_types,"" as date_open,"" as file_image_url,users_id,created_at,"" as file_video_url, "" as data_location,"" as status_buy_sells,"" as price_type,"" as price_low,"" as price_currency, "" as relate_id, "" as owner_post_id, "" AS post_liked FROM activities_users_photo_profile ORDER BY created_at desc)
			UNION
			(SELECT id,users_id,pbd_business_id,post_type,data_description,data_name,file_path,file_name_original,file_name_thumbnail,data_categories,"" as data_types,"" as date_open,data_tags,users_id,created_at,published, "" as data_location,"" as status_buy_sells,"" as price_type,"" as price_low,"" as price_currency, "" as relate_id, "" as owner_post_id, "" AS post_liked FROM pfe_articles Order by created_at desc)
			UNION
			(SELECT id,users_id,pbd_business_id,post_type,data_description,data_name,file_path,file_name_original,file_name_thumbnail,data_categories,data_types,date_open,"" as data_tags,users_id,created_at,published, "" as data_location,"" as status_buy_sells,"" as price_type,"" as price_low,"" as price_currency, "" as relate_id, "" as owner_post_id, "" AS post_liked FROM pbt_tender Order by created_at desc)
			UNION
			(SELECT id,users_id,pbd_business_id,post_type,data_description,data_name,file_path,file_name_original,file_name_thumbnail,data_categories,jobs_types_id,"" as date_open,"" as data_tags,users_id,created_at,published, data_location,"" as status_buy_sells ,"" as price_type,"" as price_low,"" as price_currency, "" as relate_id, "" as owner_post_id, "" AS post_liked FROM pcj_jobs Order by created_at desc)
			UNION
			(SELECT id,users_id,pbd_business_id,"" as post_type,data_description,data_name,file_path,file_name_original,file_name_thumbnail,data_categories,"" as jobs_types_id,"" as date_open,"" as data_tags,users_id,created_at,published, "" as data_location,status_buy_sells, price_type,price_low,price_currency, "" as relate_id, "" as owner_post_id, "" AS post_liked FROM pbd_items WHERE status_buy_sells = "1" Order by created_at desc)
			ORDER BY created_at DESC'
		);
    }

	function business_list()
	{
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->from('pbd_business');
		$this->db->limit(200);
		$this->db->order_by('created_at','desc');
		$query = $this->db->get();
		return $query;
	}

	function jobs()
	{
		$this->db->select('pcj_jobs.*');
		$this->db->select('users.username');
		$this->db->where('pcj_jobs.status',1);
		$this->db->from('pcj_jobs');
		$this->db->join('users', 'users.id = pcj_jobs.users_id');
		$this->db->order_by('pcj_jobs.id', 'desc');
		$this->db->limit(4);
		$query = $this->db->get();
		return $query;
	}

	function tender_list()
	{
		$this->db->select('pbt_tender.*');
		$this->db->select('pbd_business.data_name as business_name');
		$this->db->select('pbd_business.data_username as business_username');
		$this->db->from('pbt_tender');
		$this->db->join('pbd_business', 'pbd_business.id = pbt_tender.pbd_business_id');
		$this->db->order_by('pbt_tender.id', 'desc');
		$this->db->limit(4);
		$query = $this->db->get();
		return $query;
	}
}
