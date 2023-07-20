<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']   = 'home';
$route['404_override']         = 'home/e404';
$route['translate_uri_dashes'] = FALSE;

$route['mod_login']  = 'mod_authentication/index';
$route['mod_logout'] = 'mod_authentication/logout';

$route['contact-us'] 	= 'home/contact_us';
$route['about-us'] 		= 'home/profile';
$route['email-success'] 	= 'home/email_success';
$route['partners'] 		= 'home/partners';
$route['terms'] 		= 'home/terms';
$route['privacy'] 		= 'home/privacy';
$route['infocenter'] 	= 'home/infocenter';
$route['home/directory'] = 'home/business_directory';
$route['home/trade'] = 'home/trade';
$route['home/investment'] = 'home/investment';
$route['home/country']                 = 'home/country';
$route['home/country/update/(:any)']   = 'home/country_update/$1';
$route['home/state']                   = 'home/state';
$route['home/city/(:any)']             = 'home/city/$1';


//page
// $route['page/business'] = 'page/business';
$route['page/business/(:any)'] = 'page/business/$1';

$route['page/jobs-employee/(:any)'] = 'page/jobs_employee/$1';

$route['page/jobs/(:any)'] = 'page/jobs/$1';

$route['page/hobbies/(:any)'] = 'page/hobbies/$1';

$route['page/personal/(:any)'] = 'page/personal/$1';

$route['page/(:any)'] 		= 'page/personal/$1';

//services
$route['service/(:any)']	= 'service/index/$1';

//public news
$route['news'] = 'news/index';
$route['news/(:any)'] = 'news/detail/$1';
$route['public/discover/news'] = 'news_public/discover';
$route['public/discover/news/(:any)'] = 'news_public/discover';

//public covid
$route['covid/info'] = 'covid/index';
// users
// Register
$route['user/register']               = 'users_auth/register';
$route['user/login']                  = 'users_auth/login';
$route['user/google/login']           = 'users_auth/login_google';
$route['user/google/auth']    		  = 'users_auth/google';
$route['user/logout']                 = 'users_auth/logout';
$route['user/security/update']        = 'users_auth/update_security';
$route['user/reset']                  = 'users_auth/reset';
$route['user/security/confirm']       = 'users_auth/security_confirm';

//Session
$route['user/session/online']                  = 'users_auth/session_online';
$route['user/session/offline']                  = 'users_auth/session_offline';

//
$route['user/dashboard/page/(:any)'] = 'users_dashboard/page/$1';

// user profile
$route['post/(:any)']           = 'users_profile/index';
$route['about/(:any)']          = 'users_profile/about';
$route['connection/(:any)']     = 'users_profile/connection';
$route['photo/(:any)']          = 'users_profile/photo';
$route['job/(:any)']            = 'users_profile/job';
$route['album/(:any)']          = 'users_profile/album';
$route['view/(:any)']     = 'users_profile/view';

//workexperience
$route['user/profile/add_work/(:any)']       = 'users_profile/work_process';
$route['user/profile/delete_work/(:any)']    = 'users_profile/work_delete';
$route['user/profile/edit_work/(:any)']      = 'users_profile/work_update';

//education
$route['user/profile/add_education/(:any)']     = 'users_profile/education_add';
$route['user/profile/delete_education/(:any)']  = 'users_profile/education_delete';
$route['user/profile/edit_education/(:any)']    = 'users_profile/education_update';

//education
$route['user/profile/add_license/(:any)']     = 'users_profile/license_add';
$route['user/profile/delete_license/(:any)']  = 'users_profile/license_delete';
$route['user/profile/edit_license/(:any)']    = 'users_profile/license_update';

//course
$route['user/profile/add_course/(:any)']      = 'users_profile/course_add';
$route['user/profile/delete_course/(:any)']   = 'users_profile/course_delete';
$route['user/profile/edit_course/(:any)']    = 'users_profile/course_update';

//volunteer
$route['user/profile/add_volunteer/(:any)']     = 'users_profile/volunteer_add';
$route['user/profile/delete_volunteer/(:any)']  = 'users_profile/volunteer_delete';
$route['user/profile/edit_volunteer/(:any)']    = 'users_profile/volunteer_update';

// Hobby
$route['user/profile/add_hobby/(:any)']      = 'users_profile/hobby_add';
$route['user/profile/delete_hobby/(:any)/(:any)/(:any)']   = 'users_profile/hobby_delete';

// Skill
$route['user/profile/add_skill/(:any)']      = 'users_profile/skill_add';
$route['user/profile/delete_skill/(:any)/(:any)/(:any)']   = 'users_profile/skill_delete';

//albums photo
$route['user/profile/delete_photo/(:any)']      = 'users_profile/photo_delete';
$route['user/profile/delete_album/(:any)']      = 'users_profile/album_delete';
$route['album/(:any)/(:any)']                   = 'users_profile/photo_album/$1/$2';

//post text
$route['user/profile/add_post/(:any)']          = 'users_profile/post_add';
$route['user/profile/edit_post/(:any)']         = 'users_profile/post_edit';
$route['user/profile/delete_post/(:any)']         = 'users_profile/post_delete';
$route['user/profile/delete_post_lookfor/(:any)'] = 'users_profile/post_lookfor_delete';
$route['user/profile/delete_post_photo_profile/(:any)'] = 'users_profile/delete_post_photo_profile';

//post photo
$route['user/profile/add_photo_post/(:any)']    = 'users_profile/photo_post_add';

//post video
$route['user/profile/add_video_post/(:any)']    = 'users_profile/video_post_add';

//post looking
$route['user/profile/add_looking_post/(:any)']  = 'users_profile/looking_post_add';

//post likes
$route['user/profile/post_like']          = 'users_profile/post_like';

//post comment
$route['user/profile/post_comment']         = 'users_profile/post_comment';
$route['user/profile/show_comment/(:any)']  = 'users_profile/show_comment/$1';
$route['user/profile/show_comment_all']  = 'users_profile/show_comment_all';
$route['user/profile/delete_comment/(:any)']  = 'users_profile/delete_comment/$1';
$route['user/profile/pdf/(:any)']                    = 'users_profile/profile_pdf/$1';

// user settings
$route['user/activate/(:any)/(:any)']    = 'users_auth/activate';
$route['setting/general/(:any)']         = 'users_setting/index';
$route['profile/setting/(:any)']         = 'users_setting/profile';
$route['setting/security/(:any)']        = 'users_setting/settingSecurity';
$route['setting/privacy/(:any)']         = 'users_setting/settingPrivacy';
$route['user/setting/search']            = 'users_setting/searchCompany';
$route['user/setting/searcheducation']   = 'users_setting/searchEducation';
$route['user/setting/searchlicense']     = 'users_setting/searchLicense';
$route['user/setting/searchcourse']      = 'users_setting/searchCourse';
$route['user/setting/searchskill']       = 'users_setting/searchSkill';
$route['user/setting/searchhobby']      = 'users_setting/searchHobby';
$route['user/profile/delete_contact/(:any)']  = 'users_setting/contactDelete';
$route['setting/log/(:any)']             = 'users_setting/deleteLog';
$route['setting/question']               = 'users_setting/question';
$route['setting/email/store']            = 'users_setting/email_store';
$route['setting/email/delete/(:any)']    = 'users_setting/email_delete/$1';
$route['setting/website/store']          = 'users_setting/website_store';
$route['setting/website/delete/(:any)']  = 'users_setting/website_delete/$1';
$route['setting/phone/store']            = 'users_setting/phone_store';
$route['setting/phone/delete/(:any)']    = 'users_setting/phone_delete/$1';
$route['setting/socmed/store']           = 'users_setting/socmed_store';

//Dashboard
$route['user/dashboard']       = 'users_dashboard/index';
$route['user/profile']         = 'users_profile/index';
$route['user/profile/edit']    = 'users_profile/edit';
$route['user/change-password'] = 'users_password/index';

//Notifications
$route['user/update_token'] = 'users_profile/update_token';
$route['user/get_token'] = 'users_profile/get_token';

//public user profile
$route['public/user/profile/about/(:any)']       = 'users_profile_public/about';

//Business
$route['business/list']                  = 'business/list';
$route['business/create']           = 'business/create';

$route['business/create/store']         = 'business/store';
$route['business/manage/setting/(:any)']          = 'business/setting/$1';
$route['business/manage/suggest/(:any)']          = 'business/suggest/$1';
$route['business/manage/claim/(:any)']          = 'business/claim/$1';
$route['business/categories']          = 'business/categories';
$route['business/get_category']               = 'business/get_category';

$route['business/post/(:any)']                   = 'business_profile/index';
$route['business/about/(:any)']          = 'business_profile/about';
$route['business/connection/(:any)']     = 'business_profile/connection';
$route['business/photo/(:any)']          = 'business_profile/photo';
$route['business/job/(:any)']            = 'business_profile/job';
$route['business/service/(:any)']        = 'business_profile/service';
$route['business/profile/album/(:any)']          = 'business_profile/album';
$route['business/profile/photo_album/(:any)']   = 'business_profile/photo_album/$1';
$route['business/profile/pdf/(:any)']           = 'business_profile/business_pdf/$1';

$route['business/profile/store']                  = 'business/store';
$route['business/profile/update']                 = 'business/update';
$route['business/profile/suggest']                = 'business/add_suggest';
$route['business/profile/claim'] 	              = 'business/add_claim';
$route['business/discover/filter']                = 'business/discover_filter';
$route['business/discover/filter/(:any)'] 		  = 'business/discover_filter';
$route['business/delete']                         = 'business/delete';

//Business Public
$route['public/business/post/(:any)']         = 'business_profile_public/index';
$route['public/business/service/(:any)']	  = 'business_profile_public/service';
$route['public/business/about/(:any)']		  = 'business_profile_public/about';
$route['public/business/connection/(:any)']	  = 'business_profile_public/connection';
$route['public/business/photo/(:any)']		  = 'business_profile_public/photo';
$route['public/business/job/(:any)']		  = 'business_profile_public/job';

//Business Discover Public
$route['public/business/discover']	= 'business_public/discover';
$route['public/business/discover/(:any)']	= 'business_public/discover';
$route['public/discover/business/filter'] = 'business_public/discover_filter';
$route['public/discover/business/filter/(:any)'] = 'business_public/discover_filter';

//place pages
$route['place/discover/filter']               = 'place/discover_filter';
$route['place/discover/filter/(:any)'] 		  = 'place/discover_filter';
$route['place/profile/store']                 = 'place/store';
$route['place/profile/update']                = 'place/update';
$route['place/manage/setting/(:any)']         = 'place/setting/$1';

//Jobs
$route['jobs/list']                 = 'jobs/list';
$route['jobs/list_filter/(:any)']   = 'jobs/list_filter/$1';
$route['jobs/applications']			= 'jobs/applications';
$route['jobs/applicant']            = 'jobs/applicant';
$route['jobs/applicant_filter/(:any)'] = 'jobs/applicant_filter/$1';
$route['jobs/create']               = 'jobs/create';
$route['jobs/store']                = 'jobs/store';
$route['jobs/edit/(:any)']          = 'jobs/edit/$1';
$route['jobs/update']               = 'jobs/update';
$route['jobs/discover/filter']      = 'jobs/discover_filter';
$route['jobs/employee/filter']      = 'jobs/employee_filter';
$route['jobs/categories']           = 'jobs/categories';
$route['jobs/apply']                = 'jobs/apply';
$route['jobs/detail/(:any)']        = 'jobs/detail/$1';
$route['jobs/delete']               = 'jobs/delete';
$route['preference_jobs/update']    = 'jobs/preference_update';
$route['jobs/download_cv/(:any)']   = 'jobs/download_cv/$1';

//jobs public
$route['public/jobs/employee']     		 = 'jobs_public/employee';
$route['public/jobs/employee/filter'] 	 = 'jobs_public/employee_filter';
$route['public/jobs/employee/(:any)']    = 'jobs_public/employee';
$route['public/jobs']		     		 = 'jobs_public/jobs';
$route['public/jobs/(:any)']		     		 = 'jobs_public/jobs';
$route['public/jobs/discover/filter']	 = 'jobs_public/jobs_filter';
$route['public/jobs/detail/(:any)']      = 'jobs_public/jobs_detail/$1';

$route['market/list']                 = 'market/list';
$route['market/list_filter/(:any)']   = 'market/list_filter/$1';
$route['market/manage_filter/(:any)']   = 'market/manage_filter/$1';
$route['market/create']               = 'market/create';
$route['market/store']                = 'market/store';
$route['market/edit/(:any)']           = 'market/edit/$1';
$route['market/update']                = 'market/update';
$route['market/show/(:any)']               = 'market/show/$1';
$route['market/discover/search']      = 'market/discover_filter';
$route['market/discover/search/(:any)'] = 'market/discover_filter';
$route['market/categories']          = 'market/categories';
$route['market/delete']               = 'market/delete';
$route['market/upload/gallery']			= 'market/upload_gallery';
$route['market/upload/gallery/delete']	= 'market/delete_photo';

$route['community/list']                 = 'community/list';
$route['community/list_filter/(:any)']   = 'community/list_filter/$1';
$route['community/manage_filter/(:any)'] = 'community/manage_filter/$1';
$route['community/create']               = 'community/create';
$route['community/store']                = 'community/store';
$route['community/update']               = 'community/update';
$route['community/show/(:any)']          = 'community/show/$1';
$route['community/discover/search']      = 'community/discover';
$route['community/categories']           = 'community/categories';
$route['community/delete']               = 'community/delete';
$route['community/discover/search']      = 'community/search';
$route['community/delete']               = 'community/delete';
$route['community/categories/all']        = 'community/categories_all';

$route['community/post/(:any)']          = 'community_profile/index/$1';
$route['community/about/(:any)']         = 'community_profile/about/$1';
$route['community/topic/(:any)']         = 'community_profile/topic/$1';
$route['community/member/(:any)']        = 'community_profile/member/$1';
$route['community/photo/(:any)']         = 'community_profile/photo/$1';

$route['community/add_post']             = 'community_profile/post_add';
$route['community/edit_post']            = 'community_profile/post_edit';
$route['community/delete_post']          = 'community_profile/post_delete';

$route['community/add_photo_post']       = 'community_profile/photo_post_add';
$route['community/edit_photo_post']      = 'community_profile/photo_post_edit';

$route['community/add_video_post']       = 'community_profile/video_post_add';
$route['community/edit_video_post']      = 'community_profile/video_post_edit';

$route['community/add_lookfor_post/(:any)'] = 'community_profile/lookfor_post_add/$1';

$route['community/profile/photo']        = 'community_profile/profile_photo';

$route['community/add_albums']           = 'community_profile/albums_add';
$route['community/add_photo']           = 'community_profile/photo_add';
$route['community/photo_album/(:any)']   = 'community_profile/photo_album/$1';

$route['community/follow']              = 'community_profile/follow';

$route['connections/discover/people/filter']   = 'connections/discover_filter_people';
$route['connections/discover/people/filter/(:any)']   = 'connections/discover_filter_people';
$route['connections/discover/people']   = 'connections/discover_people';
$route['connections/discover/people/(:any)']   = 'connections/discover_people';
$route['connections/discover/pages/filter']   = 'connections/discover_filter_pages';
$route['connections/discover/pages/filter/(:any)']   = 'connections/discover_filter_pages';
$route['connections/discover/pages']   = 'connections/discover_pages';
$route['connections/discover/pages/(:any)']   = 'connections/discover_pages';
$route['connections/discover/filter']   = 'connections/discover_filter';
$route['connections/list']              = 'connections/list';
$route['connections/list_filter/(:any)'] = 'connections/list_filter/$1';
$route['connections/show/following']    = 'connections/show_following';
$route['connections/invite']            = 'connections/invite';
$route['connections/follow']            = 'connections/follow';
$route['connections/unfollow']          = 'connections/unfollow';
$route['connections/fcm']               = 'connections/fcm';

//post article
$route['articles/list']             = 'articles/list';
$route['articles/list_filter/(:any)']   = 'articles/list_filter/$1';
$route['articles/create']           = 'articles/create';
$route['articles/store']            = 'articles/store';
$route['articles/edit/(:any)/(:any)'] = 'articles/edit/$1/$2';
$route['articles/update']           = 'articles/update';
$route['articles/discover/search']  = 'articles/discover';
$route['articles/show/(:any)']      = 'articles/show_article/$1';
$route['articles/categories']       = 'articles/categories';
$route['articles/detail/(:any)']    = 'articles/detail/$1';
$route['articles/categories/all']   = 'articles/categories_all';

//post article public
$route['public/discover/articles'] = 'articles_public/discover';
$route['public/discover/articles/(:any)'] = 'articles_public/discover';
$route['public/articles/detail/(:any)'] = 'articles_public/detail/$1';

//Buy & sells
$route['buysells/list']                 = 'buys/list';
$route['buysells/list_filter/(:any)']   = 'buys/list_filter/$1';
$route['buysells/manage_filter/(:any)'] = 'buys/manage_filter/$1';
$route['buysells/manage']               = 'buys/manage';
$route['buysells/manage/(:any)']        = 'buys/edit/$1';
$route['buysells/create']               = 'buys/create';
$route['buysells/store']                = 'buys/store';
$route['buysells/update']               = 'buys/update';
$route['buysells/show/(:any)']          = 'buys/show/$1';
$route['buysells/discover/search']      = 'buys/discover';
$route['buysells/discover']             = 'buys/discover';
$route['buysells/discover/(:any)']      = 'buys/discover';
$route['buysells/categories']           = 'buys/categories';
$route['buysells/delete']               = 'buys/delete';
$route['buysells/get_category']               = 'buys/get_category';
$route['buysells/get_sub_category']               = 'buys/get_sub_category';

//Partnership
$route['tender/discover'] = 'tender/discover';

//Partnership
$route['education'] 	= 'education/index';

//favourite
$route['favourite/store'] = 'favourite/store';
$route['favourite'] = 'favourite/index';
$route['favourite/business'] = 'favourite/business';
$route['favourite/market'] = 'favourite/market';
$route['favourite/job'] = 'favourite/job';
$route['favourite/community'] = 'favourite/community';
$route['favourite/article'] = 'favourite/article';
$route['favourite/tender'] = 'favourite/tender';


//message
$route['message/inbox'] = 'message/inbox';

//Public Covid
$route['public/covid/world'] = 'covid19_public/world';
$route['public/covid/country'] = 'covid19_public/country';

//Covid
$route['covid/world'] = 'covid19/world';
$route['covid/country'] = 'covid19/country';

// JSON Country
$route['api/country']                 = 'api/country';
$route['api/country/update/(:any)']   = 'api/country_update/$1';
$route['api/state']                   = 'api/state';
$route['api/city/(:any)']             = 'api/city/$1';
$route['api/business']                = 'api/business';
$route['api/business/type/(:any)']    = 'api/business_type/$1';
$route['api/job/category/(:any)']     = 'api/job_category/$1';
$route['api/job/type/(:any)']     = 'api/job_type/$1';
$route['api/distributor/type/(:any)'] = 'api/distributor_type/$1';

//cron
$route['cron/session']                = 'cron/run';

//share
$route['sharing/(:any)']               = 'sharing/index/$1';

//search
$route['users_dashboard/live_search'] = 'users_dashboard/live_search';
$route['search']                 = 'users_dashboard/search';
$route['query']                 = 'home/search';

//sitemaps
$route['sitemap\.xml'] = "sitemap";

//Message
$route['message/send'] = 'message/message_send';
$route['message/load_chat_data'] = 'message/load_chat_data';
