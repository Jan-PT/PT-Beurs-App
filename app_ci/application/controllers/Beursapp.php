<?php
defined('BASEPATH') OR exit('No direct script access allowed');

# Eigen controller die de CI_Controller uitbreidt. Dit is het controller deel van MVC en zorgt ervoor dat de data uit het model deel in de views weergegeven kan worden.
class Beursapp extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/beursapp
	 *	- or -
	 * 		http://example.com/index.php/beursapp/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
         // publieke variabele om gegevens in te verzamelen
        //public $dataCollector;
        
        // Constructor 
        public function __construct() {
            parent::__construct();
            //$CI =& get_instance();
            $this->load->library('session');
//            if (!isset($this->dataCollector)){
//                $this->dataCollector = array();
//            }
        }
        
	# Standaard functie van de Beursapp controller (verwijst in dit geval door naar de home functie)
	public function index()
	{
		$this->home();
	}
	
	# View waarvan de studenten starten
	public function home (){
        $this->load->view('content/start_page');
	}
	
	# View met contact info van de student. De postcodes worden uit de database geladen via het BeursappModel
	public function info (){
		$this->load->model('BeursappModel');
		$codes['records'] = $this->BeursappModel->getPostcodes();
		$this->viewLoader('content/personal_info',$codes);
	}
	
	# Form voor contact info van de student (op de input velden gebeurt form_validation via de form_validation library
	public function infoForm(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("naam", "naam", "required|alpha|min_length[3]|max_length[30]);");
		$this->form_validation->set_rules("gsm", "gsm nummer", "required|numeric|min_length[10]|max_length[15]");
		$this->form_validation->set_rules("voornaam", "voornaam", "required|alpha|min_length[3]|max_length[30]");
		$this->form_validation->set_rules("postcode", "postcode", "required|min_length[4]|max_length[50]");
		$this->form_validation->set_rules("email", "email", "required|valid_email|min_length[10]|max_length[50]");
	
		if ($this->form_validation->run() == false){
			$this->viewLoader('content/personal_info');      
		} else {
                        
                    //postcode value fixen
                        $postcodegemeente = $this->input->post('postcode');
                        $postcodeArr = explode("-", $postcodegemeente);
                        $postcode = $postcodeArr[0];
                        
                        $data = array (
                            'naam'  => $this->input->post('naam'),
                            'voornaam' => $this->input->post('voornaam'),
                            'gsm' => $this->input->post('gsm'),
                            'postcode' => $postcode,
                            'email' => $this->input->post('email')
                        );
                         
                        //$this->session->set_userdata('user_data', $data);
                        $this->set_session($data);
                        
                        //Poging tot toevoegen van data aan datacollector-
                        //$this->dataCollector = $data;

			$this->region();
		}
	}
	
	# View met de verschillende provincies 
	public function region (){
            //hier zit data nog in $datacollector
            //$this->dataCollector =$data;
            $this->viewLoader('content/region_selector');
	}
	
	# View met de scholen binnen de gekozen provincie
	public function school($provincie){
  
            //var_dump($this->session) ."<br/>";

            //$data = $this->dataCollector;
            
            $this->viewLoader('content/school_selector');
	}
	
	# View met de verschillende mogelijke diploma's 
	public function diploma(){
            //var_dump($this->session);
		$this->viewLoader('content/diploma_selector');
	}
	
	# View met de mogelijke jobs
	public function job(){
		$this->viewLoader('content/job_selector');
	}
	
	# View met de type jobs (stage, vaste job)
	public function type(){
		$this->viewLoader('content/job_type');
	}
	
	# View met bedanking & melding succesvolle verwerking gegevens
	public function processed(){
		$this->viewLoader('content/data_processed');
	}
	
	# Een functie om de header, meegegeven content en footer in één keer te laden.
	public function viewLoader($content, $data = NULL){
            if (isset($data)){
				$this->load->view('templates/header');
				$this->load->view($content, $data);
				$this->load->view('templates/footer');
            } else {
                $this->load->view('templates/header');
				$this->load->view($content);
				$this->load->view('templates/footer');
            }
	}
        
        public function set_session($session_data) {
            $session_data = array (
                            'naam'  => $session_data['naam'],
                            'voornaam' => $session_data['voornaam'],
                            'gsm' => $session_data['gsm'],
                            'postcode' => $session_data['postcode'],
                            'email' => $session_data['email']
                        );
            $this->session->set_userdata('user_data', $session_data);
        }
	
}
