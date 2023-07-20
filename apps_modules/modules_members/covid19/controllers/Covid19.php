<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_users.php';

class Covid19 extends Base_users
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Mcarbon');
        if(!empty($this->session->userdata('is_login') == FALSE)){
            // alert peringatan bahwa harus login
            $this->session->set_flashdata('failed','You are not logged in, please login first!');
            redirect(base_url('user/login'));
        }
    }

	/** Data World Covid 19 */
    public function world()
    {
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Partnership',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        $oldbegin   = date("Y-m-d");
        $begin = new DateTime(date("Y-m-d", strtotime($oldbegin.'- 30 days')));
        $end   = new DateTime(date("Y-m-d"));
        
        for($i = $begin; $i <= $end; $i->modify('+1 day')){
            $label[]= $i->format("d M Y");
        }
        $oldbegin1   = date("Y-m-d");
        $begin1 = new DateTime(date("Y-m-d", strtotime($oldbegin1.'- 30 days')));
        $end1   = new DateTime(date("Y-m-d"));
		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);  
        $datejson = 'https://api.covid19api.com/world?from='.$begin1->format("Y-m-d").'"&to='.$end1->format("Y-m-d").'';
        
		$response = json_decode(file_get_contents($datejson, false, stream_context_create($arrContextOptions)));

        foreach($response as $value){
            $datacovid_cases[]= $value->NewConfirmed;
            $datacovid_death[]= $value->NewDeaths;
            $datacovid_recovered[]= $value->NewRecovered;
        }
        $data['totalcountry_cases'] = '0';
        $data['totalcountry_death'] = '0';
        $data['totalcountry_recovered'] = '0';
        $data['country_name'] = null;
        $data['country']  = $this->db->get_where('loc_countries')->result();
        $data['datacovid_cases'] = $datacovid_cases;
        $data['datacovid_death'] = $datacovid_death; 
        $data['datacovid_recovered'] = $datacovid_recovered; 
        $data['label_cases'] = $label; 
        config('title', 'Covid-19 Informations - World');
        $this->display('index', $data);
    }

	/** Data Country Covid 19*/
    public function country()
    {
        $user_id = $_SESSION['user_id'];
        $data = [
            'title_web' => 'Partnership',
            'users'     => $this->db->get_where('users',array('id'=>$user_id))->row(),
			'promotions'  => $this->db->get_where('pub_promotions',array('data_position_portal' => 'user','data_position_type' => 'sidebar','status' => 1))->result(),
        ];
        $data['CSRF'] = [
            'id' => $user_id,
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        
        $name = $this->input->post('country');
        $oldbegin   = date("Y-m-d");
        $begin = new DateTime(date("Y-m-d", strtotime($oldbegin.'- 30 days')));
        $end   = new DateTime(date("Y-m-d"));
        
        for($i = $begin; $i <= $end; $i->modify('+1 day')){
            $label[]= $i->format("d M Y");
        }
        $oldbegin1   = date("Y-m-d");
        $begin1 = new DateTime(date("Y-m-d", strtotime($oldbegin1.'- 30 days')));
        $end1   = new DateTime(date("Y-m-d"));
        $datejson = 'https://api.covid19api.com/country/'.$name.'?from='.$begin1->format("Y-m-d").'&to='.$end1->format("Y-m-d").'';
		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		); 
	
		$response_country = json_decode(file_get_contents($datejson, false, stream_context_create($arrContextOptions)));
        foreach($response_country as $value){
            $datacovid_cases[]= $value->Confirmed;
            $datacovid_death[]= $value->Deaths;
            $datacovid_recovered[]= $value->Recovered;
        }
        $date_1 = new DateTime(date("Y-m-d", strtotime($oldbegin1.'- 1 days')));
        $datajsoncountry = 'https://api.covid19api.com/live/country/'.$name.'/status/confirmed/date/'.$date_1->format("Y-m-d").'';
		$response_country2 = json_decode(file_get_contents($datajsoncountry, false, stream_context_create($arrContextOptions)));
        if(!empty($response_country2)){
            foreach($response_country2 as $value){
                $totalcountry_cases= $value->Confirmed;
                $totalcountry_death= $value->Deaths;
                $totalcountry_recovered= $value->Recovered;
            }
            
                $data['totalcountry_cases'] = $totalcountry_cases;
                $data['totalcountry_death'] = $totalcountry_death;
                $data['totalcountry_recovered'] = $totalcountry_recovered;
                $data['country_name'] = $name;
                $data['country']  = $this->db->get_where('loc_countries')->result();
                $data['datacovid_cases'] = $datacovid_cases;
                $data['datacovid_death'] = $datacovid_death; 
                $data['datacovid_recovered'] = $datacovid_recovered; 
                $data['label_cases'] = $label; 
                config('title', 'Covid-19 Informations - Country');
                $this->display('country', $data);
        }else{
            redirect(base_url('covid/world'));
        }
    }

}
