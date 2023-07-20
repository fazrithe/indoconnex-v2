<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Users_dashboard extends Base_users
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('M_post');
		$this->load->model('M_dashboard');
		if(!empty($this->session->userdata('is_login') == FALSE)){
			// alert peringatan bahwa harus login
			$this->session->set_flashdata('failed','You are not logged in, please login first!');
			redirect(base_url('user/login'));
		}
	}

	/** User Dashboard */
	public $perPage = 3;
	public function index()
	{
		$user_id = $_SESSION['user_id'];
		// $per_page = 1;
		// $start = 0;

		// if(!empty($this->input->get("page")))
		// {
		// 	$start = $this->perPage * $this->input->get('page');
		// }
		$totalPosts = $this->M_post->getPostsCount()->num_rows();
            $start =0;
			$data = [
				'title_web' => 'Dashboard',
				'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
				'users_all' => $this->M_post->get_users()->result(),
				'posts'     => $this->M_post->post_all($this->perPage,$start)->result(),
				'business_list'     => $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result(),
				'business'  => $this->M_post->business_list()->result(),
				'business_categories' => $this->db->get_where('pbd_business_categories',array('status' => 1))->result(),
				'business_types' => $this->db->get('pbd_business_types')->result(),
				'product'  => $this->db->get_where('pbd_items',array('status' => 1,'status_buy_sells' => 0), 4)->result(),
				'product_categories'  => $this->db->get_where('pbd_items_categories',array('status' => 1))->result(),
				'product_buy'  => $this->M_dashboard->get_buy_and_sells()->result(),
				'jobs'  => $this->M_post->jobs()->result(),
				'jobs_categories'  => $this->db->get_where('pcj_jobs_categories',array('status' => 1))->result(),
				'jobs_types'  => $this->db->get_where('pcj_jobs_types',array('status' => 1))->result(),
				'article'  => $this->db->get_where('pfe_articles',array('status' => 1), 4)->result(),
				'article_categories'  => $this->db->get_where('pfe_articles_categories')->result(),
				'communities'  => $this->db->get_where('pcs_communities',array('status' => 1), 4)->result(),
				'communities_categories'  => $this->db->get_where('pcs_communities')->result(),
				'post_articles' => $this->db->get('pfe_articles')->result(),
				'post_tenders' => $this->db->get('pbt_tender')->result(),
				'post_jobs' => $this->db->get('pcj_jobs ')->result(),
				'post_buysells' => $this->db->get_where('pbd_items ', ['status_buy_sells' => '1'])->result(),
				'distributor_types'  => $this->db->get_where('pbd_business_distributor_types',array('status' => 1))->result(),
				'favourites' => $this->db->get('users_favorites')->result(),
				'tender'  => $this->M_post->tender_list()->result(),
				'tender_categories'  => $this->db->get_where('pbt_tender_categories',array('status' => 1))->result(),
				'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
				'total_pages' => ceil($totalPosts/$this->perPage),
			];
			// dd($data['jobs']);
			$data['CSRF'] = [
				'id' => $user_id,
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash(),
			];
			$this->display('index', $data);
        
		// $data['total_pages']  = 10; // hard limit. good for cache
		// $this->display('index', $data);
	}

	public function page($page){
		$user_id = $_SESSION['user_id'];
		$start = $this->perPage * $page;
		$totalPosts = $this->M_post->getPostsCount()->num_rows();
		$data = [
			'title_web' => 'Dashboard',
			'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
			'users_all' => $this->M_post->get_users()->result(),
			'posts'     => $this->M_post->post_all($this->perPage,$start)->result(),
			'business_list'     => $this->db->get_where('pbd_business',array('users_id'=>$user_id))->result(),
			'business'  => $this->M_post->business_list()->result(),
			'business_categories' => $this->db->get_where('pbd_business_categories',array('status' => 1))->result(),
			'business_types' => $this->db->get('pbd_business_types')->result(),
			'product'  => $this->db->get_where('pbd_items',array('status' => 1), 4)->result(),
			'product_categories'  => $this->db->get_where('pbd_items_categories',array('status' => 1))->result(),
			'jobs'  => $this->M_post->jobs()->result(),
			'jobs_categories'  => $this->db->get_where('pcj_jobs_categories',array('status' => 1))->result(),
			'jobs_types'  => $this->db->get_where('pcj_jobs_types',array('status' => 1))->result(),
			'article'  => $this->db->get_where('pfe_articles',array('status' => 1), 4)->result(),
			'article_categories'  => $this->db->get_where('pfe_articles_categories')->result(),
			'communities'  => $this->db->get_where('pcs_communities',array('status' => 1), 4)->result(),
			'communities_categories'  => $this->db->get_where('pcs_communities')->result(),
			'post_articles' => $this->db->get('pfe_articles')->result(),
			'distributor_types'  => $this->db->get_where('pbd_business_distributor_types',array('status' => 1))->result(),
			'favourites' => $this->db->get('users_favorites')->result(),
			'total_pages' => ceil($this->input->get("page") * $this->perPage),
		];
		$data['CSRF'] = [
			'id' => $user_id,
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash(),
		];
		$result = $this->display('index_load', $data);
	}

	/** Search Dashboard Users */
	public function search()
	{
		$user_id = $_SESSION['user_id'];
		$search  = $this->input->get('q');
		$data = [
			'title_web' => 'Dashboard',
			'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),

		];
		$data['business'] = $this->M_dashboard->search_business($search);
		$data['business_categories']  = $this->M_dashboard->business_category();
		$data['business_types'] = $this->db->get('pbd_business_types')->result();
		$data['promotions']  = $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result();
		$data['connections'] = $this->M_dashboard->search_connections($search);
		$data['product_categories']  = $this->M_dashboard->product_category();
		$data['products'] = $this->M_dashboard->search_products($search);
		$data['jobs'] = $this->M_dashboard->search_jobs($search);
		$data['jobs_categories']  =$this->db->get_where('pcj_jobs_categories',array('status'=>1))->result();
		$data['jobs_types']  = $this->db->get_where('pcj_jobs_types',array('status'=>1))->result();
		$data['communities']  = $this->M_dashboard->search_communities($search);
		$data['communities_categories']  = $this->db->get_where('pcs_communities')->result();
		$data['articles']  = $this->M_dashboard->search_articles($search);
		$data['articles_categories']  = $this->db->get_where('pfe_articles_categories')->result();
		$result =  $this->db->select('user_follow_id')->get_where('users_follows', array('user_id' => $user_id))->result();
		$friends = [];
		foreach ($result as $key) {
			$friends[] = $key->user_follow_id;
		}
		$data['friends'] = $friends;
		$this->display('search', $data);
	}

	/** API Search Dashboard Users */
	public function live_search()
	{
		$term = $this->input->get('search');

		$businesses = $this->M_dashboard->search_for_businesses($term);
		$products = $this->M_dashboard->search_for_products($term);
		$buysells = $this->M_dashboard->search_for_buysells($term);
		$jobs = $this->M_dashboard->search_for_jobs($term);
		$connections = $this->M_dashboard->search_for_connections($term);
		$communities = $this->M_dashboard->search_for_communities($term);
		$articles = $this->M_dashboard->search_for_articles($term);

		$total_businesses = count($businesses);
		$total_articles = count($articles);
		$total_connections = count($connections);
		$total_communities = count($communities);
		$total_jobs = count($jobs);
		$total_products = count($products);
		$total_buysells = count($buysells);

		$total = [
			$total_businesses, 
			$total_articles, 
			$total_connections, 
			$total_communities, 
			$total_jobs, 
			$total_products, 
			$total_buysells
		];

		$total_search = array_sum($total);

		$html = '';

		if (empty($term)) {
			$html .= '';
		} else {
			if (! empty($term)) {
				$html .= '<div class="list-group shadow-sm" style="z-index: 999;left: 20%;position: fixed;height: 300px; overflow-y: auto;">';
				$html .= '<div class="list-group-item active" style="background-color: #002452;"><strong>Search Results</strong> ('. $total_search .')</div>';
				// businesses
				if (count($businesses)) {
					$html .= '<div class="list-group-item"><strong>Business</strong></div>';
					foreach ($businesses as $business) {
						$html .= '<a href="'. site_url('business/about/'.urlencode($business->data_username)) .'" class="list-group-item list-group-item-action">';
						$html .= '<img class="avatar-tiny" src="'. placeholder($business->file_path, $business->file_name_original, 'business', '16x9') .'" /> <strong>'. str_limit($business->data_name, 90) .'</strong>';	
						$html .= '</a>';
						$html .= '</a>';
					}
				}

				// products & Services
				if (count($products)) {
					$html .= '<div class="list-group-item"><strong>Product & Services</strong></div>';
					foreach ($products as $product) {
						$html .= '<a href="#product-detail" data-bs-toggle="modal" class="list-group-item list-group-item-action" role="button" data-bs-productid="'.$product->id.'">';
						$html .= '<img class="avatar-tiny" src="'. placeholder($product->file_path, $product->file_name_original, 'product', '16x9') .'" /> <strong>'. str_limit($product->data_name, 90) .'</strong>';	
						$html .= '</a>';
						$html .= '</a>';
					}
				}

				// buy & sells
				if (count($buysells)) {
					$html .= '<div class="list-group-item"><strong>Buy & Sells</strong></div>';
					foreach ($buysells as $item) {
						$html .= '<a href="#product-detail" data-bs-toggle="modal" class="list-group-item list-group-item-action" role="button" data-bs-productid="'.$item->id.'">';
						$html .= '<img class="avatar-tiny" src="'. placeholder($item->file_path, $item->file_name_original, 'product', '16x9') .'" /> <strong>'. str_limit($item->data_name, 90) .'</strong>';	
						$html .= '</a>';
						$html .= '</a>';
					}
				}

				// jobs
				if (count($jobs)) {
					$html .= '<div class="list-group-item"><strong>Job</strong></div>';
					foreach ($jobs as $job) {
						$html .= '<a href="'. site_url('jobs/detail/'.$job->id) .'" class="list-group-item list-group-item-action">';
						$html .= '<img class="avatar-tiny" src="'. placeholder($job->file_path, $job->file_name_original, 'job', '16x9') .'" /> <strong>'. str_limit($job->data_name, 90) .'</strong>';
						$html .= '<span class="text-muted small"> post by: '. $job->fullname . ' on ' . date('d F Y', strtotime($job->created_at)) .'</span>';
						$html .= '</a>';
						$html .= '</a>';
					}
				}

				// connections
				if (count($connections)) {
					$html .= '<div class="list-group-item"><strong>Connection</strong></div>';
					foreach ($connections as $connection) {
						$html .= '<a href="'. site_url('post/'.$connection->username) .'" class="list-group-item list-group-item-action">';
						$html .= '<img class="avatar-tiny" src="'. placeholder($connection->file_path, $connection->file_name_original, 'user', '16x9') .'" /> <strong>'. $connection->fullname .'</strong>';	
						$html .= '</a>';
						$html .= '</a>';
					}
				}

				// communities
				if (count($communities)) {
					$html .= '<div class="list-group-item"><strong>Community</strong></div>';
					foreach ($communities as $community) {
						$html .= '<a href="'. site_url('community/post/'.$community->id) .'" class="list-group-item list-group-item-action">';
						$html .= '<img class="avatar-tiny" src="'. placeholder($community->file_path, $community->file_name_original, 'community', '16x9') .'" /> <strong>'. str_limit($community->data_name, 90) .'</strong>';	
						$html .= '</a>';
						$html .= '</a>';
					}
				}

				// articles
				if (count($articles)) {
					$html .= '<div class="list-group-item"><strong>Article</strong></div>';
					foreach ($articles as $article) {
						$html .= '<a href="'. site_url('articles/detail/'.$article->id) .'" class="list-group-item list-group-item-action">';
						$html .= '<img class="avatar-tiny" src="'. placeholder($article->file_path, $article->file_name_original, 'article', '16x9') .'" /> <strong>'. str_limit($article->data_name, 90) .'</strong>';
						$html .= '<span class="text-muted small"> posted '. carbon_human($article->published) .'</span>';
						$html .= '</a>';
						$html .= '</a>';
					}
				}
				$html .= '</div>';
			} else {
				$html .= '<div class="list-group shadow-sm" style="left: 15%; position: fixed; z-index: 1000000;">';
				$html .= '<div class="list-group-item active"><strong>Search Results</strong> (0 items found)</div>';
				$html .= '</div>';
			}
		}

		echo $html;
	}
}
