<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_front.php';

class Covid extends Base_front
{
    protected $module_base                  = 'dahboard';
    protected $apps_title_module            = 'Dashboard';
    private   $_table                       = "users";
    protected $apps_output_message = array(
        'status'  => '',
        'title'   => '',
        'message' => ''
    );
    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        $this->lang->load('output_message');
        $this->load->helper(array('form', 'url','string'));
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('Mcarbon');
        $this->load->model('M_covid');
    }

	/** Data Covid 19 public */
    public function index()
    {

            $data         = array(
                'apps_title_module' => $this->apps_title_module,
                'meta_position' => 1,
				'meta_type' => 'covid'
            );
            $data['CSRF'] = [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            ];
            if(!empty($this->session->userdata('is_login'))){
                $id = $this->session->userdata('user_id');
                $data["users"] = $this->db->get_where('users',array('id'=>$id))->row();
            }
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
            // $datejson = 'https://api.covid19api.com/world?from='.$begin1->format("Y-m-d").'"&to='.$end1->format("Y-m-d").'';
			// $response = json_decode(file_get_contents($datejson, false, stream_context_create($arrContextOptions)));

            // foreach($response as $value){
            //     $datacovid_cases[]= $value->NewConfirmed;
            //     $datacovid_death[]= $value->NewDeaths;
            //     $datacovid_recovered[]= $value->NewRecovered;
            // }
			$datejson = 'https://covid19.mathdro.id/api';
			$response = json_decode(file_get_contents($datejson, false, stream_context_create($arrContextOptions)));

			$datacovid_cases = $response->confirmed->value;
			$datacovid_death = $response->deaths->value;
			$datacovid_recovered = $response->recovered->value;
			
            $datejson_indo = 'https://covid19.mathdro.id/api/countries/indonesia';
			$response_indo = json_decode(file_get_contents($datejson_indo, false, stream_context_create($arrContextOptions)));
          
            $datacovid_cases_indo = $response_indo->confirmed->value;
			$datacovid_death_indo = $response_indo->deaths->value;
			$datacovid_recovered_indo = $response_indo->recovered->value;
            
			$datejson_usa = 'https://covid19.mathdro.id/api/countries/australia';
			$response_usa = json_decode(file_get_contents($datejson_usa, false, stream_context_create($arrContextOptions)));
          
            $datacovid_cases_usa = $response_usa->confirmed->value;
			$datacovid_death_usa = $response_usa->deaths->value;
			$datacovid_recovered_usa = $response_usa->recovered->value;

            // $end1   = new DateTime(date("Y-m-d", strtotime($oldbegin1.'- 2 days')));
            // $datejson_indo = 'https://api.covid19api.com/live/country/indonesia/status/confirmed/date/'.$end1->format("Y-m-d").'';
			// $response_indo = json_decode(file_get_contents($datejson_indo, false, stream_context_create($arrContextOptions)));
            // foreach($response_indo as $value){
            //     $datacovid_cases_indo = $value->Confirmed;
            //     $datacovid_death_indo = $value->Deaths;
            //     $datacovid_recovered_indo = $value->Recovered;
            // }

            // $end1   = new DateTime(date("Y-m-d", strtotime($oldbegin1.'- 2 days')));
            // $datejson_usa = 'https://api.covid19api.com/live/country/australia/status/confirmed/date/'.$end1->format("Y-m-d").'';
			// $response_usa = json_decode(file_get_contents($datejson_usa, false, stream_context_create($arrContextOptions)));
            // foreach($response_usa as $value){
            //     $datacovid_cases_usa = $value->Confirmed;
            //     $datacovid_death_usa = $value->Deaths;
            //     $datacovid_recovered_usa = $value->Recovered;
            // }
            $data['totalcountry_cases'] = '0';
            $data['totalcountry_death'] = '0';
            $data['totalcountry_recovered'] = '0';
            $data['country_name'] = null;
            $data['country']  = $this->db->get_where('loc_countries')->result();
            $data['datacovid_cases'] = $datacovid_cases;
            $data['datacovid_death'] = $datacovid_death; 
            $data['datacovid_recovered'] = $datacovid_recovered; 
            $data['datacovid_cases_indo'] = $datacovid_cases_indo;
            $data['datacovid_death_indo'] = $datacovid_death_indo; 
            $data['datacovid_recovered_indo'] = $datacovid_recovered_indo; 
            $data['datacovid_cases_usa'] = $datacovid_cases_usa;
            $data['datacovid_death_usa'] = $datacovid_death_usa; 
            $data['datacovid_recovered_usa'] = $datacovid_recovered_usa; 
            $data['label_cases'] = $label; 
			$data['work']			=  $this->db->get_where('pub_works',array('status'=>1))->result();
            $data["partners"] = $this->db->get_where('pub_partners',array('status'=>1))->result();
			$data["supports"] = $this->db->get_where('pub_supports',array('status'=>1))->result();
			$data['footer_menu1']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,7)->result();
			$data['footer_menu2']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,14)->result();
			$data['footer_menu3']	= $this->db->get_where('pub_widgets',array('status'=>1,'parent !='=> 0), 7,21)->result();

            config('title', 'Covid-19 Cases');

			$this->display('index', $data);
    }

}
