<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class News_public extends Base_users
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation','pagination');
        $this->load->model('M_news_public', 'M_news');
    }

    public function discover()
	{
        $user_id = $_SESSION['user_id'] ?? 0;

        if ($user_id) {
            $user = $this->db->get_where('users',array('id'=>$user_id))->row();
        } else {
            $user = [];
        }

		$name = trim($this->input->get('news-name'));
        $category = $this->input->get('news-category');
		$page = (int) $this->uri->segment(4);  

		$data = [
			'title_web' => 'Dashboard',
            'users'     => $user,
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user',
            'data_position_type' => 'sidebar','status' => 1))->result(),
		];

		$data['CSRF'] = [
            'id' => $user_id,
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash(),
		];

		$limit = 6;
		$offset = 0;

		if ($page > 0) {
			$offset = ($limit * $page) - $limit;
        }
        
        if ($name || $category) {
            $config['base_url'] = site_url('public/discover/news');
            if ($category && $name) {
				$countdata = $this->M_news->count_data_search_filter($name, $category);
                $config['total_rows'] = $countdata;
            } else if ($name) {
				$countdata = $this->M_news->count_data_search($name);
                $config['total_rows'] = $countdata;
            } else if ($category) {
				$countdata = $this->M_news->count_data_search_category($category);
                $config['total_rows'] = $countdata;
            }

            if (count($this->input->get()) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
            if (count($this->input->get()) > 0) $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);

            $config['per_page']         = $limit;
			$config['use_page_numbers'] = true;
            $config['first_link']       = 'First';
            $config['last_link']        = 'Last';
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
			$config['attributes']       = ['class' => 'page-link'];
            $config['full_tag_open']    = '<div class="text-center"><nav><ul class="pagination fw-semi fs-14 justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item">';
            $config['num_tag_close']    = '</li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
            $config['next_tag_open']    = '<li class="page-item neighbour">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';
            $config['prev_tag_open']    = '<li class="page-item neighbour">';
            $config['prev_tagl_close']  = 'Next</li>';
            $config['first_tag_open']   = '<li class="page-item neighbour">';
            $config['first_tagl_close'] = '</li>';
            $config['last_tag_open']    = '<li class="page-item neighbour">';
            $config['last_tagl_close']  = '</li>';
            $this->pagination->initialize($config);

			$data['news'] = $this->M_news->filter($name, $category, $limit, $offset);

            $data['pagination'] = $this->pagination->create_links();
            $data['total_rows'] = $countdata;
            $data["categories_news"] = $this->M_news->getCategories();
            $data['data_filter'] = ['category' => $category];
            $data['news_name'] = $name;          

            if ($category) {
                config('title', 'Discover News & Events' . ' - ' . $this->M_news->getCategoryName($category));
            } else {
                config('title', 'Discover News & Events' . ' - ' . $name);
            }

            $this->display('discover_filter', $data);
        } else {
            $countdata = $this->M_news->count_data();
            $config['base_url'] = site_url('public/discover/news');
            $config['total_rows'] = $countdata;
            $config['per_page'] = $limit;
			$config['use_page_numbers'] = true;
            $config['first_link']       = 'First';
            $config['last_link']        = 'Last';
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
			$config['attributes'] = ['class' => 'page-link'];
            $config['full_tag_open']    = '<div class="text-center"><nav><ul class="pagination fw-semi fs-14 justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item">';
            $config['num_tag_close']    = '</li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
            $config['next_tag_open']    = '<li class="page-item neighbour">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';
            $config['prev_tag_open']    = '<li class="page-item neighbour">';
            $config['prev_tagl_close']  = 'Next</li>';
            $config['first_tag_open']   = '<li class="page-item neighbour">';
            $config['first_tagl_close'] = '</li>';
            $config['last_tag_open']    = '<li class="page-item neighbour">';
            $config['last_tagl_close']  = '</li>';

            $this->pagination->initialize($config);

            $data['news'] = $this->M_news->data_all($limit, $offset);
            $data['pagination'] = $this->pagination->create_links();
            $data['total_rows'] = $countdata;
            $data["categories_news"] = $this->M_news->getCategories();

            config('title', 'Discover News & Events');

           $this->display('discover', $data);
		}
	}
}
