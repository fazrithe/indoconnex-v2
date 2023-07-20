<?php

if (!function_exists("theme_admin_locations")) {
    function theme_admin_locations($parameter_without_base_url = false)
    {
        $CI = &get_instance();
        //$theme_location = $CI->template_admin->get_theme_path();
        $theme_location = 'public/themes/admin/';
        if ($parameter_without_base_url == false) {
            $theme_location = base_url() . $theme_location;
        }
        return $theme_location;
    }
}

if (!function_exists("theme_user_locations")) {
    function theme_user_locations($parameter_without_base_url = false)
    {
        $CI =& get_instance();
        //$theme_location = $CI->template_admin->get_theme_path();
        $theme_location = 'public/themes/user/';
        if ($parameter_without_base_url == false) {
            $theme_location = base_url() . $theme_location;
        }
        return $theme_location;
    }
}

if (!function_exists("user_json")) {
    function user_json($parameter_without_base_url = false)
    {
        $CI =& get_instance();
        //$theme_location = $CI->template_admin->get_theme_path();
        $theme_location = 'public/json/geo.json';
        if ($parameter_without_base_url == false) {
            $theme_location = base_url() . $theme_location;
        }
        return $theme_location;
    }
}

if (!function_exists("crypto_rand_secure")) {
    function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) {
            return $min;
        }
        // not so random...
        $log    = ceil(log($range, 2));
        $bytes  = (int) ($log / 8) + 1; // length in bytes
        $bits   = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }
}

if (!function_exists("get_random_numeric")) {
    function get_random_numeric($length)
    {
        $token        = "";
        $codeAlphabet = "0123456789";
        $max          = strlen($codeAlphabet); // edited
        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[crypto_rand_secure(0, $max - 1)];
        }
        return $token;
    }
}

if (!function_exists("get_random_alphanumeric")) {
    function get_random_alphanumeric($length)
    {
        $token        = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet); // edited
        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[crypto_rand_secure(0, $max - 1)];
        }
        return $token;
    }
}

if (!function_exists("format_rupiah")) {
    function format_rupiah($nilai = 0)
    {
        return 'IDR ' . number_format($nilai, 0, ',', '.');
    }
}

if (!function_exists("format_rupiah_no_prefix")) {
    function format_rupiah_no_prefix($nilai = 0)
    {
        return number_format($nilai, 0, ',', '.');
    }
}

if (!function_exists("format_date")) {
    function format_date($tanggal, $use_day = false)
    {
        $hari = [
            '1' => 'Senin',
            '2' => 'Selasa',
            '3' => 'Rabu',
            '4' => 'Kamis',
            '5' => 'Jumat',
            '6' => 'Sabtu',
            '7' => 'Minggu',
        ];

        $hari_en = date('N', strtotime($tanggal));

        $bulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        /**
 * PECAH STRING
*/
        $tanggalan = explode('-', $tanggal);
        if ($use_day) {
            return $hari[$hari_en] . ', ' . $tanggalan[2] . ' ' . $bulan[$tanggalan[1]] . ' ' . $tanggalan[0];
        } else {
            return $tanggalan[2] . ' ' . $bulan[$tanggalan[1]] . ' ' . $tanggalan[0];
        }
    }
}

if (!function_exists('get_session_app_id')) {
    function get_session_app_id()
    {
        $CI             = &get_instance();
        $session_app    = $CI->session->userdata(APP_SESS_NAME);
        $session_app_id = uniqid();
        if (!empty($session_app[APP_SESS_ID])) {
            $session_app_id = func_decrypt($session_app[APP_SESS_ID]);
        }
        return $session_app_id;
    }
}

if (!function_exists('func_encrypt')) {
    function func_encrypt($plain_text = null)
    {
        $CI = &get_instance();
        $CI->encryption->initialize(
            [
                'cipher' => 'aes-256',
                'key'    => $CI->config->item('encryption_hash_key'),
            ]
        );
        return $CI->encryption->encrypt($plain_text);
    }
}

if (!function_exists('func_decrypt')) {
    function func_decrypt($cipher_text = null)
    {
        $CI = &get_instance();
        $CI->encryption->initialize(
            [
                'cipher' => 'aes-256',
                'key'    => $CI->config->item('encryption_hash_key'),
            ]
        );
        return $CI->encryption->decrypt($cipher_text);
    }
}

if (!function_exists('generate_cart_key')) {
    function generate_cart_key()
    {
        $string  = "";
        $letters = "ABCDEFGHJKLMNPQRTSVWXYZ";
        $numbers = "23456789";
        for ($i = 0; $i != 8; $i++) {
            if ($i < 2 || $i >= 6) {
                $string .= $letters[rand(0, strlen($letters) - 1)];
            } else {
                $string .= $numbers[rand(0, strlen($numbers) - 1)];
            }

        }
        return $string;
    }
}

/**
 * @return array A CSRF key-value pair
 */
function generate_csrf_nonce($parameter_column = null)
{
    $CI = &get_instance();
    $CI->load->helper('string');
    $key   = random_string('alnum', 8);
    $value = random_string('alnum', 20);

    $CI->session->unset_userdata('csrfkey_' . $parameter_column, $key);
    $CI->session->unset_userdata('csrfvalue_' . $parameter_column, $value);

    if (!empty($parameter_column)) {
        $CI->session->set_userdata('csrfkey_' . $parameter_column, $key);
        $CI->session->set_userdata('csrfvalue_' . $parameter_column, $value);
        return ["{$parameter_column}_{$key}" => $value];
    } else {
        $CI->session->set_userdata('csrfkey', $key);
        $CI->session->set_userdata('csrfvalue', $value);
        return [$key => $value];
    }
}

/**
 * @return bool Whether the posted CSRF token matches
 */
function valdate_csrf_nonce($parameter_column = null, $parameter_data = null)
{
    $CI = &get_instance();
    if (!empty($parameter_column)) {
        $csrf_key_index = $CI->session->userdata('csrfkey_' . $parameter_column);
        if (!empty($csrf_key_index)) {
            if (!empty($parameter_data["{$parameter_column}_{$csrf_key_index}"])) {

                $csrfkey = $parameter_data["{$parameter_column}_{$csrf_key_index}"];
                if ($csrfkey && ($csrfkey == $CI->session->userdata('csrfvalue_' . $parameter_column))) {
                    return true;
                }
            }
        }
        return false;
    } else {
        $csrfkey = $CI->input->post($CI->session->userdata('csrfkey'));
        if ($csrfkey && $csrfkey === $CI->session->userdata('csrfvalue')) {
            return true;
        }
        return false;
    }
}

if (!function_exists("lang_text")) {
    function lang_text($parameter_key = null)
    {
        $CI = &get_instance();
        return (empty($parameter_key)) ? null : $CI->lang->line($parameter_key);
    }
}

if (!function_exists('devices_status')) {
    function devices_status($devices_status)
    {
        if($devices_status == 1) {
            return "Online";
        }else{
            return "Offline";
        }
    }
}

if (!function_exists('long_time')) {
    function long_time($date_start,$date_end)
    {
        $start      = strtotime($date_start);
        $end        = strtotime($date_end);
        $diff  = $end - $start;
        return  floor($diff / (60 * 60 * 24 * 365)) . ' years ';
    }
}

if (!function_exists('icon_default')) {
    function icon_default($file_path,$file_name_original)
    {
        if(empty($file_path)) {
            return "<img src='".base_url()."public/themes/user/images/icons/become-a-member.png' class='rounded-circle border work-experience-img' alt='img'>";
        }

        return "<img src='".base_url() . $file_path . $file_name_original."' class='rounded-circle border work-experience-img' alt='img'>";
    }
}

if (!function_exists('placeholder')) {
    function placeholder($file_path, $file_name_original, $default_for = 'user', $ratio = '1x1')
    {
        if(empty($file_name_original)) {
            return base_url()."public/themes/user/images/placehold/".$default_for."-".$ratio.".png";
        }
        return base_url(). $file_path . $file_name_original;
    }
}

if (!function_exists('carbon_human')) {
    /**
     * carbon_human
     * Generate Human Friendly Date
     *
     * @param  mixed $date
     * @param  mixed $locale
     * @return String datetime
     */
    function carbon_human($date, $locale = 'en_US')
    {
        $CI = &get_instance();
        $CI->load->library('Mcarbon');

        $human = Mcarbon::parse($date)->locale($locale);
        return $human->diffForHumans(['options' => Mcarbon::ONE_DAY_WORDS]);
    }
}

if (!function_exists('carbon_long')) {
    /**
     * carbon_long
     * Generate Long Date
     *
     * @param  mixed $date
     * @param  mixed $locale
     * @return String datetime
     */
    function carbon_long($date, $locale = 'en_US')
    {
        $CI = &get_instance();
        $CI->load->library('Mcarbon');

        $human = Mcarbon::parse($date)->locale($locale);
        return $human->format('l, F j, Y \a\t g:i a');
    }
}

if (!function_exists('number_amount')) {
    function number_amount($currency,$number)
    {
        return  "".$currency."" . number_format((float)$number, 2, ",", ".");
    }
}

if (!function_exists('d')) {
    /**
     * d
     * Dumper
     *
     * @param  mixed $var
     * @return void
     */
    function d($var)
    {
        echo '<pre style="color:black">';
        var_dump($var);
        echo '<pre>';
    }
}

if (!function_exists('dd')) {
    /**
     * dd
     * Dump and Die
     *
     * @param  mixed $var
     * @return void
     */
    function dd($var)
    {
        d($var);
        die();
    }
}

    /**
     * Generate a URL friendly "slug" from a given string.
     *
     * @param  string  $title
     * @param  string  $separator
     * @return string
     */
if (!function_exists('slug')) {
    function slug($title, $separator = '-')
    {
        // Convert all dashes/underscores into separator
        $flip = $separator === '-' ? '_' : '-';

        $title = preg_replace('!['.preg_quote($flip).']+!u', $separator, $title);

        // Replace @ with the word 'at'
        $title = str_replace('@', $separator.'at'.$separator, $title);

        // Remove all characters that are not the separator, letters, numbers, or whitespace.
        $title = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', strtolower($title));

        // Replace all separator characters and whitespace by a single separator
        $title = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $title);

        return trim($title, $separator);
    }
}

    /**
     * Convert the given string to title case.
     *
     * @param  string  $value
     * @return string
     */
if (!function_exists('title')) {
    function title($value)
    {
        return mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }
}

/**
 * Limit the number of words in a string.
 *
 * @param  string  $value
 * @param  int  $words
 * @param  string  $end
 * @return string
 */
if (!function_exists('words')) {
    function words($value, $words = 100, $end = '...')
    {
        if(empty($value)) {
            return 'No description';
        }
        preg_match('/^\s*+(?:\S++\s*+){1,'.$words.'}/u', $value, $matches);

        if (! isset($matches[0]) || mb_strlen($value) === mb_strlen($matches[0])) {
            return $value;
        }

        return rtrim($matches[0]).$end;
    }
}

/**
 * Limit the number of characters in a string.
 *
 * @param  string  $value
 * @param  int  $limit
 * @param  string  $end
 * @return string
 */

if (!function_exists('str_limit')) {
    function str_limit($value, $limit = 100, $end = '...')
    {
        if (mb_strwidth($value, 'UTF-8') <= $limit) {
            return $value;
        }

        return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')).$end;
    }
}

if (!function_exists('curent_work_followers')) {
    function current_work_followers($id)
    {
        $CI = &get_instance();
        $CI->db->select('users.*');
        $CI->db->where('users_follows.user_id',$id);
        $CI->db->where('users.status_privacy',0);
        $CI->db->from('users_follows');
        $CI->db->join('users','users.id = users_follows.user_id');
        $query = $CI->db->get();
        $data = $query->result();
        foreach($data as $work_val){
            if($work_val->data_exp_work){
                $current_work = json_decode($work_val->data_exp_work, true);
                $result_current_followers = [];
                if(!empty($current_work)){
                    foreach($current_work as $val){
                        $company2 = $CI->db->get_where('mst_works_experiences', array('id'=>$val['company_id']))->row();
                        if(!empty($company2)){
                             return $company2->data_name;

                        }
                    }
                }

            }
        }
    }
}

if (!function_exists('curent_work_following')) {
    function current_work_following($id)
    {
        $CI = &get_instance();
        $CI->db->select('users.*');
        $CI->db->where('users_follows.user_follow_id',$id);
        $CI->db->where('users.status_privacy',0);
        $CI->db->from('users_follows');
        $CI->db->join('users','users.id = users_follows.user_id');
        $query = $CI->db->get();
        $data = $query->result();
        foreach($data as $work_val){
            if($work_val->data_exp_work){
                $current_work = json_decode($work_val->data_exp_work, true);
                $result_current_followers = [];
                if(!empty($current_work)){
                    foreach($current_work as $val){
                        $company2 = $CI->db->get_where('mst_works_experiences', array('id'=>$val['company_id']))->row();
                        if(!empty($company2)){
                             return $company2->data_name;

                        }
                    }
                }

            }
        }
    }
}

if (!function_exists('url_users')) {
    function url_users($username)
    {
        if(!empty($username)){
            return site_url('post/'.$username);
        }else{
            return site_url('post/null');
        }
    }
}


if (!function_exists('url_business')) {
    function url_business($username)
    {
        if(!empty($username)){
            return site_url('business/post/'.urlencode($username));
        }else{
            return site_url('post/null');
        }
    }
}

if(!function_exists('img_post_users')) {
    function img_post_users($id)
    {
        $CI = &get_instance();
        $CI->db->select('users.*');
        $CI->db->where('id',$id);
        $CI->db->from('users');
        $query = $CI->db->get();
        $data = $query->row();
        if(empty($data->file_name_original)){
        return "<img src='".site_url()."public/themes/user/images/placehold/user-1x1.png' class='rounded-circle feed-user-img' alt='img'>";
        }else{
        return "<img src='".base_url().$data->file_path . $data->file_name_original."' class='rounded-circle feed-user-img' alt='img'>";
        }
    }
}

if(!function_exists('img_post_business')) {
    function img_post_business($id)
    {
        $CI = &get_instance();
        $CI->db->select('pbd_business.*');
        $CI->db->where('id',$id);
        $CI->db->from('pbd_business');
        $query = $CI->db->get();
        $data = $query->row();
        if(empty($data->file_name_original)){
        return "<img src='".site_url()."public/themes/user/images/placehold/business-16x9.png' class='rounded-circle feed-user-img' alt='img'>";
        }else{
        return "<img src='".base_url().$data->file_path . $data->file_name_original."' class='rounded-circle feed-user-img' alt='img'>";
        }
    }
}

if(!function_exists('name_post_users')) {
    function name_post_users($id)
    {
        $CI = &get_instance();
        $CI->db->select('users.*');
        $CI->db->where('id',$id);
        $CI->db->from('users');
        $query = $CI->db->get();
        $data = $query->row();
        return  "<a href='".site_url('post/'.$data->username)."'><span class='text-prussianblue fw-bold'>".$data->name_first." ".$data->name_middle. " " .$data->name_last."</span></a>";
    }
}

if(!function_exists('name_post_business')) {
    function name_post_business($id)
    {
        $CI = &get_instance();
        $CI->db->select('pbd_business.*');
        $CI->db->where('id',$id);
        $CI->db->from('pbd_business');
        $query = $CI->db->get();
        $data = $query->row();
        return  "<a href='".site_url('business/post/'.urlencode($data->data_username))."'><span class='text-prussianblue fw-bold'>".$data->data_name."</span></a>";
    }
}

if(!function_exists('category_article')) {
    function category_article($id)
    {
        $CI = &get_instance();
        $CI->db->select('pfe_articles_categories.data_name');
        $CI->db->where('pfe_articles.id',$id);
        $CI->db->from('pfe_articles');
        $CI->db->join('pfe_articles_categories','pfe_articles_categories.id = pfe_articles.data_categories');
        $query = $CI->db->get();
        $data = $query->row();
        if(!empty( $data->data_name)){
        return $data->data_name;
        }
    }
}

function encode_img_base64( $img_path ){
    if( $img_path ){
        $path = 'https://localhost/indoconnex-backend/public/themes/user/images/placehold/user-1x1.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        return $base64;
    }

    return false;
}

if(!function_exists('check_apply')) {
    function check_apply($id)
    {
        $CI = &get_instance();
        $CI->db->select('pcj_jobs_applicants.*');
        $CI->db->where('jobs_id',$id);
        $CI->db->from('pcj_jobs_applicants');
        $query = $CI->db->get();
        $data = $query->row();
        if($data){
            return $data->id;
        }
    }
}

if(!function_exists('count_applicant')) {
    function count_applicant($id)
    {
        $CI = &get_instance();
        $CI->db->select('jobs_id');
        $CI->db->where('jobs_id',$id);
        $CI->db->from('pcj_jobs_applicants');
        $query = $CI->db->get();
        $data = $query->num_rows();
        return $data;

    }
}

if(!function_exists('active_favourite')) {
    function active_favourite($id,$tbl)
    {
        $CI = &get_instance();
        $CI->db->select('user_id');
        $CI->db->where('relation_table_id',$id);
        $CI->db->where('relation_table_name',$tbl);
        $CI->db->from('users_favorites');
        $query = $CI->db->get();
        $data = $query->num_rows();
        if($data > 0){
            return 'active';
        }else{
            return '';
        }

    }
}

if(!function_exists('active_favourite_home')) {
    function active_favourite_home($id,$tbl)
    {
        $CI = &get_instance();
        $CI->db->select('user_id');
        $CI->db->where('user_id',$_SESSION['user_id']);
        $CI->db->where('relation_table_id',$id);
        $CI->db->where('relation_table_name',$tbl);
        $CI->db->from('users_favorites');
        $query = $CI->db->get();
        $data = $query->num_rows();
        if($data > 0){
            return 'active';
        }else{
            return '';
        }

    }
}


//META
if(!function_exists('meta_public_description')) {
    function meta_public_description($id,$type = null)
    {
		if($type == 'news'){
			$CI = &get_instance();
			$CI->db->like('data_slug',$id);
			$CI->db->from('pnu_news');
			$query = $CI->db->get();
			$data = $query->result();
			foreach($data as $value){
				return $value->data_short_description;
			}
		}else{
			$CI = &get_instance();
			$CI->db->select('data_description');
			$CI->db->where('data_position',$id);
			$CI->db->from('csg_meta');
			$query = $CI->db->get();
			$data = $query->result();
			foreach($data as $value){
				return $value->data_description;
			}
		}
    }
}

if(!function_exists('meta_public_title')) {
    function meta_public_title($id,$type = null)
    {
		if($type == 'news'){
			$CI = &get_instance();
			$CI->db->like('data_slug',$id);
			$CI->db->from('pnu_news');
			$query = $CI->db->get();
			$data = $query->result();
			foreach($data as $value){
				return $value->data_name;
			}
		}else{
			$CI = &get_instance();
			$CI->db->select('data_title');
			$CI->db->where('data_position',$id);
			$CI->db->from('csg_meta');
			$query = $CI->db->get();
			$data = $query->result();
			foreach($data as $value){
				return $value->data_title;
			}
		}
        
    }
}

if(!function_exists('meta_public_name')) {
    function meta_public_name($id)
    {
        $CI = &get_instance();
        $CI->db->select('data_name');
        $CI->db->where('data_position',$id);
        $CI->db->from('csg_meta');
        $query = $CI->db->get();
        $data = $query->result();
        foreach($data as $value){
            return $value->data_name;
        }
    }
}

if(!function_exists('meta_public_image')) {
    function meta_public_image($id,$type = null)
    {
		if($type == 'news'){
			$CI = &get_instance();
			$CI->db->like('data_slug',$id);
			$CI->db->from('pnu_news');
			$query = $CI->db->get();
			$data = $query->result();
			foreach($data as $value){
				return site_url($value->file_path.''.$value->file_name_original);
			}
		}else{
			$CI = &get_instance();
			$CI->db->select('file_path,file_name_original');
			$CI->db->where('data_position',$id);
			$CI->db->from('csg_meta');
			$query = $CI->db->get();
			$data = $query->result();
			foreach($data as $value){
				return site_url($value->file_path.''.$value->file_name_original);
			}
		}
    }
}

if(!function_exists('meta_public_keyword')) {
    function meta_public_keyword($id)
    {
        $CI = &get_instance();
        $CI->db->select('data_keywords');
        $CI->db->where('data_position',$id);
        $CI->db->from('csg_meta');
        $query = $CI->db->get();
        $data = $query->result();
        foreach($data as $value){
            return $value->data_keywords;
        }
    }
}

// Meta profile user
if(!function_exists('meta_profile_user_name')) {
    function meta_profile_user_name($id)
    {
		$meta_id = substr($id, 0, 2); 
		if($meta_id == 'b_'){ 
			$meta_business = substr($id, 2);
			$CI = &get_instance();
			$CI->db->select('data_name');
			$CI->db->where('data_username',$meta_business);
			$CI->db->from('pbd_business');
			$query = $CI->db->get();
			$data2 = $query->row();
			return $data2->data_name;
		}else{
			$CI = &get_instance();
			$CI->db->select('username');
			$CI->db->where('username',$id);
			$CI->db->from('users');
			$query = $CI->db->get();
			$data = $query->result();
			foreach($data as $value){
				return $value->username;
			}
		}
    }
}

if(!function_exists('meta_profile_user_title')) {
    function meta_profile_user_title($id)
    {
        return 'Visit my profile on Indoconnex';
    }
}

if(!function_exists('meta_profile_user_description')) {
    function meta_profile_user_description($id)
    {
		$meta_id = substr($id, 0, 2); 
		if($meta_id == 'b_'){  
			$meta_business = substr($id, 2);
			$CI = &get_instance();
			$CI->db->select('data_description');
			$CI->db->where('data_username',$meta_business);
			$CI->db->from('pbd_business');
			$query = $CI->db->get();
			$data2 = $query->row();
			return $data2->data_description;
		}else{
			$CI = &get_instance();
			$CI->db->select('data_exp_work');
			$CI->db->select('data_locations');
			$CI->db->where('id',$id);
			$CI->db->from('users');
			$query = $CI->db->get();
			$data = $query->result();
			foreach($data as $value){
				if($value->data_exp_work){
					$current_work = json_decode($value->data_exp_work, true);
					$result_current = [];
					if(!empty($current_work)){
						foreach($current_work as $val){
							$CI = &get_instance();
							$CI->db->select('data_name');
							$CI->db->where('id',$val['company_id']);
							$CI->db->from('mst_works_experiences');
							$query = $CI->db->get();
							$data2 = $query->row();
							if(!empty($data2)){
									$company = $data2->data_name;

							}
						}
					}

				}
				if($value->data_locations){
					$locations = json_decode($value->data_locations, true);
					if(!empty($locations)){
						foreach($locations as $val){
							$location = $val['country_name'];
						}
					}
				}
			}
			if (!empty($company) && !empty($location))
				return 'Im work at '.$company. ' From '.$location;

			if (!empty($company) && empty($location))
				return 'Im work at '.$company;

			if (!empty($company) && !empty($location))
				return 'Im From '.$location;

			return '';
		}
    }
}

if(!function_exists('meta_profile_user_image')) {
    function meta_profile_user_image($id)
    {
        $CI = &get_instance();
        $CI->db->select('name_first, name_middle, name_last, file_path,file_name_original');
        $CI->db->where('id',$id);
        $CI->db->from('users');
        $query = $CI->db->get();
        $data = $query->result();
        foreach($data as $value){
            if ($value->file_path == null || $value->file_name_original == null) {
                return 'https://ui-avatars.com/api/?size=60&name=' . $value->name_first . ' ' . $value->name_middle . ' ' . $value->name_last;
            } else {
                return site_url($value->file_path.''.$value->file_name_original);
            }
            
        }
    }
}


if(!function_exists('meta_profile_user_keyword')) {
    function meta_profile_user_keyword($id)
    {
        return 'integrated platform, indonesian international platform, unified source';
    }
}

if(!function_exists('meta_login_name')) {
    function meta_login_name($name)
    {
        return 'Indoconnex';
    }
}

if(!function_exists('meta_login_description')) {
    function meta_login_description($name)
    {
        return 'Please log in or create an account at indoconnex';
    }
}

if(!function_exists('meta_login_keyword')) {
    function meta_login_keyword($name)
    {
        return 'indoconnex, integrated platform, indonesian international platform, unified source';
    }
}

if(!function_exists('meta_login_image')) {
    function meta_login_image($name)
    {
        return site_url('public/themes/user/images/logo/indoconnex-logo-square.png');
    }
}

if(!function_exists('name_user')) {
    function name_user($id)
    {
        $CI = &get_instance();
        $CI->db->select('name_first,name_middle');
        $CI->db->where('id',$id);
        $CI->db->from('users');
        $query = $CI->db->get();
        $data = $query->result();
        foreach($data as $value){
            return $value->name_first;
        }
    }
}

if(!function_exists('username_user')) {
    function username_user($id)
    {
        $CI = &get_instance();
        $CI->db->select('username');
        $CI->db->where('id',$id);
        $CI->db->from('users');
        $query = $CI->db->get();
        $data = $query->result();
        foreach($data as $value){
            return $value->username;
        }
    }
}

if(!function_exists('data_exp_user')) {
    function data_exp_user($id)
    {
        $CI = &get_instance();
        $CI->db->select('data_exp_work');
        $CI->db->where('id',$id);
        $CI->db->from('users');
        $query = $CI->db->get();
        $data = $query->result();
        foreach($data as $value){
            return $value->data_exp_work;
        }
    }
}

if(!function_exists('data_edu_user')) {
    function data_edu_user($id)
    {
        $CI = &get_instance();
        $CI->db->select('data_education');
        $CI->db->where('id',$id);
        $CI->db->from('users');
        $query = $CI->db->get();
        $data = $query->result();
        foreach($data as $value){
            return $value->data_education;
        }
    }
}

if (!function_exists('placeholder_business')) {
    function placeholder_business($file_path, $file_name_original, $default_for = 'business', $ratio = '1x1')
    {
        if(empty($file_name_original)) {
            return base_url()."public/themes/user/images/placehold/".$default_for."-".$ratio.".png";
        }
        return base_url(). $file_path . $file_name_original;
    }
}

if (!function_exists('placeholder_jobs')) {
    function placeholder_jobs($file_path, $file_name_original, $default_for = 'user', $ratio = '1x1')
    {
        if(empty($file_name_original)) {
            return base_url()."public/themes/user/images/placehold/".$default_for."-".$ratio.".png";
        }
        return base_url(). $file_path . $file_name_original;
    }
}

if (!function_exists('placeholder_users')) {
    function placeholder_users($file_path, $file_name_original, $default_for = 'user', $ratio = '1x1')
    {
        if(empty($file_name_original)) {
            return base_url()."public/themes/user/images/placehold/".$default_for."-".$ratio.".png";
        }
        return base_url(). $file_path . $file_name_original;
    }
}

if (!function_exists('placeholder_communities')) {
    function placeholder_communities($file_path, $file_name_original, $default_for = 'community', $ratio = '1x1')
    {
        if(empty($file_name_original)) {
            return base_url()."public/themes/user/images/placehold/".$default_for."-".$ratio.".png";
        }
        return base_url(). $file_path . $file_name_original;
    }
}

/** for generate slug */
if (!function_exists('utf8_uri_encode')) {
    function utf8_uri_encode( $utf8_string, $length = 0 ) {
        $unicode = '';
        $values = array();
        $num_octets = 1;
        $unicode_length = 0;

        $string_length = strlen( $utf8_string );
        for ($i = 0; $i < $string_length; $i++ ) {

            $value = ord( $utf8_string[ $i ] );

            if ( $value < 128 ) {
                if ( $length && ( $unicode_length >= $length ) )
                    break;
                $unicode .= chr($value);
                $unicode_length++;
            } else {
                if ( count( $values ) == 0 ) $num_octets = ( $value < 224 ) ? 2 : 3;

                $values[] = $value;

                if ( $length && ( $unicode_length + ($num_octets * 3) ) > $length )
                    break;
                if ( count( $values ) == $num_octets ) {
                    if ($num_octets == 3) {
                        $unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]) . '%' . dechex($values[2]);
                        $unicode_length += 9;
                    } else {
                        $unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]);
                        $unicode_length += 6;
                    }

                    $values = array();
                    $num_octets = 1;
                }
            }
        }

        return $unicode;
    }
}

if (!function_exists('seems_utf8')) {
    function seems_utf8($str) {
        $length = strlen($str);
        for ($i=0; $i < $length; $i++) {
            $c = ord($str[$i]);
            if ($c < 0x80) $n = 0; # 0bbbbbbb
            elseif (($c & 0xE0) == 0xC0) $n=1; # 110bbbbb
            elseif (($c & 0xF0) == 0xE0) $n=2; # 1110bbbb
            elseif (($c & 0xF8) == 0xF0) $n=3; # 11110bbb
            elseif (($c & 0xFC) == 0xF8) $n=4; # 111110bb
            elseif (($c & 0xFE) == 0xFC) $n=5; # 1111110b
            else return false; # Does not match any model
            for ($j=0; $j<$n; $j++) { # n bytes matching 10bbbbbb follow ?
                if ((++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80))
                    return false;
            }
        }
        return true;
    }
}

if (!function_exists('sanitize_title_with_dashes')) {
    function sanitize_title_with_dashes($title) {
        $title = strip_tags($title);
        // Preserve escaped octets.
        $title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
        // Remove percent signs that are not part of an octet.
        $title = str_replace('%', '', $title);
        // Remove ’ signs that are not part of an octet.
        $title = str_replace('’', '', $title);
        // Restore octets.
        $title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);

        if (seems_utf8($title)) {
            if (function_exists('mb_strtolower')) {
                $title = mb_strtolower($title, 'UTF-8');
            }
            $title = utf8_uri_encode($title, 200);
        }

        $title = strtolower($title);
        $title = preg_replace('/&.+?;/', '', $title); // kill entities
        $title = str_replace('.', '-', $title);
        $title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
        $title = preg_replace('/\s+/', '-', $title);
        $title = preg_replace('|-+|', '-', $title);
        $title = trim($title, '-');

        return $title;
    }
}
/** /for generate slug */

if (!function_exists('config')) {
    function config($val, $set = FALSE) {
        $CI = &get_instance();
        if ($set) {
            $CI->config->set_item($val, $set);
        }
        else
            return $CI->config->item($val);
    }
}

if (!function_exists('chat_date_request')) {
    function chat_date_request($id) {
		$CI = &get_instance();
        $CI->db->select('chat_messages_datetime');
        $CI->db->where('receiver_id',$id);
        $CI->db->from('chat_messages');
		$CI->db->order_by('chat_messages_datetime');
        $query = $CI->db->get();
        $data = $query->result();
        foreach($data as $value){
			$originalDate = $value->chat_messages_datetime;
            return  date("H:i:s", strtotime($originalDate));
        }
    }
}

if (!function_exists('chat_message_request')) {
    function chat_message_request($id) {
		$CI = &get_instance();
        $CI->db->select('chat_messages_text','chat_messages_datetime');
        $CI->db->where('receiver_id',$id);
        $CI->db->from('chat_messages');
		$CI->db->order_by('chat_messages_datetime', 'desc');
        $query = $CI->db->get();
        $data = $query->result();
        foreach($data as $value){
            return $value->chat_messages_text;
        }
    }
}

if ( ! function_exists('google_translate'))
{
function google_translate($text,$d = '',$s = 'en',$f='text')
{
	if($d=='') $d = $s;
	if($d != $s){
		$curlSession = curl_init(); 
		curl_setopt($curlSession, CURLOPT_URL, 'https://translate.googleapis.com/translate_a/single?client=at&sl=en&tl=id&dt=t&q='.urlencode($text));
		curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlSession, CURLOPT_REFERER,  base_url());
		curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curlSession);
		$jsonData = json_decode($response);
		curl_close($curlSession);
	
		if(isset($jsonData[0][0][0])){
			return $jsonData[0][0][0];
		}else{
			return false;
		}
	} else {
	echo $text;
	}
}
}

if (! function_exists('get_buy_and_sells_category_by_id')) {
    function get_buy_and_sells_category($value)
    {
        $CI = &get_instance();

        return $CI->db->from('pbd_items_categories_buys')
            ->where_in('id', json_decode($value))
            ->get()
            ->row()
            ->data_name;
    }
}

if (! function_exists('get_tender_category_name_by_id')) {
    function get_tender_category_name_by_id($id)
    {
        $CI = &get_instance();

        return $CI->db->from('pbt_tender_categories')
            ->where('id', $id)
            ->get()
            ->row()
            ->data_name;
    }
}

if (! function_exists('get_tender_type_name_by_id')) {
    function get_tender_type_name_by_id($id)
    {
        $CI = &get_instance();

        return $CI->db->from('pbt_tender_types')
            ->where('id', $id)
            ->get()
            ->row()
            ->data_name;
    }
}

if (! function_exists('get_job_name_by_id')) {
    function get_job_name_by_id($id)
    {
        $CI = &get_instance();

        return $CI->db->from('pcj_jobs ')
            ->where('id', $id)
            ->get()
            ->row()
            ->data_name;
    }
}

if (! function_exists('get_job_type_by_id')) {
    function get_job_type_by_id($id)
    {
        $CI = &get_instance();

        return $CI->db->from('pcj_jobs_types  ')
            ->where('id', $id)
            ->get()
            ->row()
            ->data_name;
    }
}

if (! function_exists('get_buy_sells_status')) {
    function get_buy_sells_status($id)
    {
        $CI = &get_instance();

        return $CI->db->from('pbd_items_sells')
            ->where('pbd_items_id', $id)
            ->get()
            ->row()
            ->data_status;
    }
}

if (! function_exists('get_buy_sells_category')) {
    function get_buy_sells_category($categories)
    {
        $CI = &get_instance();

        return $CI->db->from('pbd_items_categories_buys')
            ->where_in('id', json_decode($categories))
            ->get()
            ->row()
            ->data_name;
    }
}

if( !function_exists('share_check') ){
	/**
	 * Check type of share and return $URL or FALSE
	 * 
	 * @param	string $type	type of share
	 * @return	string|bool
	 */
	function share_check( $type='' ){
		$url = array(
			'twitter'	=> 'http://twitter.com/share',
			'facebook'	=> 'http://facebook.com/sharer.php',
			'buzz'		=> 'http://www.google.com/buzz/post',
			'vkontakte'	=> 'http://vkontakte.ru/share.php',
		);
		return (isset($url[$type])) ? $url[$type] : FALSE;
	}
}

if( !function_exists('share_url') ){
	/**
	 * Generate url for share at some social networks
	 *
	 * @param	string $type	type of share
	 * @param	array $args		parameters for share
	 * @return	string
	 */
	function share_url( $type='', $args=array() ){
		$url = share_check( $type );
		if( $url === FALSE ){
			log_message( 'debug', 'Please check your type share_url('.$type.')' );
			return "#ERROR-check_share_url_type";
		}

		$params = array();
		if( $type == 'twitter' ){
			foreach( explode(' ', 'url via text related count lang counturl') as $v ){
				if( isset($args[$v]) ) $params[$v] = $args[$v];
			}
		}elseif( $type == 'facebook' ){
			$params['u']		= $args['url'];
			$params['t']		= $args['text'];
		}elseif( $type == 'buzz'){
			$params['url']		= $args['url'];
			$params['imageurl']	= $args['image'];
			$params['message']	= $args['text'];
		}elseif( $type == 'vkontakte'){
			$params['url']		= $args['url'];
		}

		$param = '';
		foreach( $params as $k=>$v ) $param .= '&'.$k.'='.urlencode($v);
		return $url.'?'.trim($param, '&');
	}
}

if( !function_exists('share_button') ){
	/**
	 * Generate buttons for share at some social networks
	 *
	 * @param	string $type	type of share
	 * @param	array $args		parameters for share
	 * @return string
	 */
	function share_button( $type='', $args=array() ){
		$url = share_check( $type );
		if( $url === FALSE ){
			log_message( 'debug', 'Please check your type share_button('.$type.')' );
			return "#ERROR-check_share_button_type";
		}

		$params = array();
		$param	= '';

		if( $type == 'twitter'){
			if( isset($args['iframe']) ){
				$url = share_url( $type, $args );
				list($url, $param) = explode('?', $url);
				$button = <<<DOT
				<iframe allowtransparency="true" frameborder="0" scrolling="no" style="width:130px; height:50px;"
				src="http://platform.twitter.com/widgets/tweet_button.html?{$param}"></iframe>
DOT;
			}else{
				foreach( explode(' ', 'url via text related count lang counturl') as $v ){
					if( isset($args[$v]) ) $params[] = 'data-'.$v.'="'.$args[$v].'"';
				}
				$param = implode( ' ', $params );
				$button = <<<DOT
				<a href="http://twitter.com/share" data-size="small" class="twitter-share-button" {$param}>Tweet</a>
				<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
DOT;
			}
		}elseif( $type == 'facebook' ){
			if( !isset($args['type']) ) $args['type'] = 'button_count';
			if( isset($args['fb']) ){
				$params = array( 'type'=>'type');
				foreach( $params as $k=>$v ){
					if( isset($args[$v]) ) $param .= $k.'="'.$args[$v].'"';
				}
				$button = "<fb:share-button {$param}></fb:share-button>";
			}else{
				$params = array( 'data-href'=>'url' );
				foreach( $params as $k=>$v ){
					if( isset($args[$v]) ) $param .= $k.'="'.$args[$v].'"';
				}
				if( !isset($args['button_text']) ) $args['button_text'] = 'Share to Facebook';
				$button = <<<DOT
				<div class="fb-share-button" 
				{$param}
				data-layout="button" data-size="small">
				</div>
				<script>(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
					fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>

DOT;
			}
		}
		return $button;
	}

}


if (! function_exists('user_online')) {
	function user_online($id)
		{
			$CI = &get_instance();
			$CI->db->select('status');
			$CI->db->where('user_id',$id);
			$CI->db->from('users_devices_sess');
			$query = $CI->db->get();
			$data = $query->row();
			if(!empty($data)){
				if($data->status == 1){
					return "background-color: #4cd137;";
				}else{
					return "background-color: #787878;";
				}
			}else{
				return "background-color: #787878;";
			}
		}
}

if (! function_exists('get_news_category_by_id')) {
    function get_news_category_by_id($id)
    {
        $CI = &get_instance();

        return $CI->db->from('pnu_news_categories')
            ->where('id', $id)
            ->get()
            ->row()
            ->data_name;
    }
}

if (! function_exists('get_job_category_by_id')) {
    function get_job_category_by_id($id)
    {
        $CI = &get_instance();

        return $CI->db->from('pcj_jobs_categories')
            ->where('id', $id)
            ->get()
            ->row()
            ->data_name;
    }
}


if (! function_exists('status_verification')) {
	function status_verification($id)
		{
			$CI = &get_instance();
			$CI->db->select('status_verification');
			$CI->db->where('id',$id);
			$CI->db->from('pbd_business');
			$query = $CI->db->get();
			$data = $query->row();
			if(!empty($data)){
				if($data->status_verification == 1){
					return "<span class='material-icons mx-2 text-verified align-middle'>check_circle</span>";
				}else{
					return "";
				}
			}else{
				return "";
			}
		}
}

if (! function_exists('total_followers')) {
	function total_followers($id)
		{
			$CI = &get_instance();
			$CI->db->select('*');
			$CI->db->where('pcs_communities_id',$id);
			$CI->db->from('pcs_communities_follows');
			$query = $CI->db->get();
			$data = $query->num_rows();
			if(!empty($data)){
				return $data;
			}else{
				return 0;
			}
		}
}

if (! function_exists('total_followers')) {
	function total_followers($id)
		{
			$CI = &get_instance();
			$CI->db->select('*');
			$CI->db->where('pcs_communities_id',$id);
			$CI->db->from('pcs_communities_follows');
			$query = $CI->db->get();
			$data = $query->num_rows();
			if(!empty($data)){
				return $data;
			}else{
				return 0;
			}
		}
}

if (! function_exists('total_view')) {
	function total_view($id){
		$CI = &get_instance();
		$CI->db->select('user_id');
		$CI->db->where('user_id',$id);
		$CI->db->from('user_views');
		$query = $CI->db->get();
		$data = $query->num_rows();
		if(!empty($data)){
			return $data;
		}else{
			return 0;
		}
	}
}

