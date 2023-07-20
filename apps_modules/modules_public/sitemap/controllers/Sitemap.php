<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_front.php';

class Sitemap extends Base_front
{
    protected $module_base                  = 'sitemap/index';
    protected $apps_title_module            = 'sitemap';

    public function __construct()
    {
		parent::__construct();
        $this->load->database();
		$this->load->model('M_sitemap');
    }

    public function index()
    {
        $data['sitemaps'] = $this->M_sitemap->get();
        $data['business_post_sitemaps'] = $this->getBusinessPostSitemap();
        $data['business_service_sitemaps'] = $this->getBusinessServiceSitemap();
        $data['business_about_sitemaps'] = $this->getBusinessAboutSitemap();
        $data['business_connection_sitemaps'] = $this->getBusinessConnectionSitemap();
        $data['business_photo_sitemaps'] = $this->getBusinessPhotoSitemap();
        $data['business_job_sitemaps'] = $this->getBusinessJobSitemap();
		$data['users_sitemaps'] = $this->getUserSitemap();
		$data['news_sitemaps'] = $this->getNewsSitemap();
        $this->load->view('index', $data);
    }

    // protected function getPublicSitemaps()
    // {
    //     $business_public_sitemaps = [];
    //     foreach ($this->M_sitemap->getBusinessUsername() as $business) {
    //         if (str_contains($business->data_username, '&')) {
    //             continue;
    //         }

    //         $business_public_sitemaps[] = $this->M_sitemap->get();
    //     }

    //     return $business_public_sitemaps;
    // }

    protected function getBusinessPostSitemap()
    {
        $business_post_sitemaps = [];

        foreach ($this->M_sitemap->getBusinessUsername() as $business) {
            if (str_contains($business->data_username, '&')) {
                continue;
            }

            $business_post_sitemaps[] = [
                'slug_business_post_url' => "/public/business/post/$business->data_username",
            ];
        }

        return $business_post_sitemaps;
    }

    protected function getBusinessServiceSitemap()
    {
        $business_service_sitemaps = [];

        foreach ($this->M_sitemap->getBusinessUsername() as $business) {
            if (str_contains($business->data_username, '&')) {
                continue;
            }

            $business_service_sitemaps[] = [
                'slug_business_service_url' => "/public/business/service/$business->data_username",
            ];
        }

        return $business_service_sitemaps;
    }

    protected function getBusinessAboutSitemap()
    {
        $business_about_sitemaps = [];

        foreach ($this->M_sitemap->getBusinessUsername() as $business) {
            if (str_contains($business->data_username, '&')) {
                continue;
            }

            $business_about_sitemaps[] = [
                'slug_business_about_url' => "/public/business/about/$business->data_username",
            ];
        }

        return $business_about_sitemaps;
    }

    protected function getBusinessConnectionSitemap()
    {
        $business_connection_sitemaps = [];

        foreach ($this->M_sitemap->getBusinessUsername() as $business) {
            if (str_contains($business->data_username, '&')) {
                continue;
            }

            $business_connection_sitemaps[] = [
                'slug_business_connection_url' => "/public/business/connection/$business->data_username",
            ];
        }

        return $business_connection_sitemaps;
    }

    protected function getBusinessPhotoSitemap()
    {
        $business_photo_sitemaps = [];

        foreach ($this->M_sitemap->getBusinessUsername() as $business) {
            if (str_contains($business->data_username, '&')) {
                continue;
            }

            $business_photo_sitemaps[] = [
                'slug_business_photo_url' => "/public/business/photo/$business->data_username",
            ];
        }

        return $business_photo_sitemaps;
    }

    protected function getBusinessJobSitemap()
    {
        $business_job_sitemaps = [];

        foreach ($this->M_sitemap->getBusinessUsername() as $business) {
            if (str_contains($business->data_username, '&')) {
                continue;
            }

            $business_job_sitemaps[] = [
                'slug_business_job_url' => "/public/business/job/$business->data_username",
            ];
        }

        return $business_job_sitemaps;
    }

	protected function getUserSitemap()
    {
        $user_sitemaps = [];

        foreach ($this->M_sitemap->getUsername() as $users) {
            if (str_contains($users->username, '&')) {
                continue;
            }

            $user_sitemaps[] = [
                'slug_users_url' => "/public/user/profile/about/$users->username",
            ];
        }
        return $user_sitemaps;
    }

	protected function getNewsSitemap()
    {
        $news_sitemaps = [];

        foreach ($this->M_sitemap->getNews() as $news) {
            if (str_contains($news->data_slug, '&')) {
                continue;
            }

            $news_sitemaps[] = [
                'slug_news_url' => "/news/$news->data_slug",
            ];
        }
        return $news_sitemaps;
    }
}
