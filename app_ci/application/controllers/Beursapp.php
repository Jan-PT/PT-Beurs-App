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
//      if (!isset($this->dataCollector)){
//  	    $this->dataCollector = array();
//      }
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
            $bc['state'] = 'info';
            
            $this->viewLoader('content/personal_info', $bc, $codes);
            
	}
	
	# Form voor contact info van de student (op de input velden gebeurt form_validation via de form_validation library
	public function infoForm(){
            
            $this->load->model('BeursappModel');
            $codes['records'] = $this->BeursappModel->getPostcodes();
            $bc['state'] = 'infoForm';

            
            # Form validation regels
            $this->load->library("form_validation");
            
            $this->form_validation->set_message('contactVerify', 'Email of gsm-nummer is verplicht.');
            $this->form_validation->set_message('alpha_dash_space', 'Naam mag geen nummers bevatten.');
            
            $this->form_validation->set_rules("naam", "naam", "required|callback_alpha_dash_space|min_length[3]|max_length[30]);");
            $this->form_validation->set_rules("gsm", "gsm nummer", "numeric|min_length[10]|max_length[15]|callback_contactVerify[email]");
            $this->form_validation->set_rules("voornaam", "voornaam", "required|callback_alpha_dash_space|min_length[3]|max_length[30]");
            $this->form_validation->set_rules("postcode", "postcode", "required|min_length[4]|max_length[50]");
            $this->form_validation->set_rules("email", "email", "valid_email|min_length[5]|max_length[96]|callback_contactVerify[gsm]");

            # Als de regels falen wordt de pagina opnieuw geladen en anders wordt de sessie aangemaakt en naar de volgende functie doorgegaan.
            if ($this->form_validation->run() == false){
                    $this->viewLoader('content/personal_info', $bc, $codes);      
            } else {
                #Postcode en gemeente veld splitsen op '-'
                $postcodegemeente = $this->input->post('postcode');
                $postcodeArr = explode("-",$postcodegemeente, 2);
                $postcode = $postcodeArr[0];
                $gemeente = $postcodeArr[1];
                
                $gsm = $this->input->post('gsm');
                
                $gsmeerst = substr($gsm, 0, 3);
                $gsmtweed = substr($gsm, 3, 3);
                $gsmderde = substr($gsm, 6, 2);
                $gsmvierd = substr($gsm, 8, 2);
                $gsmvijfd = substr($gsm, 10, 2);
                
                $strGsm = $gsmeerst . " " . $gsmtweed . " " . $gsmderde . " " . $gsmvierd . " " . $gsmvijfd;
                
                $data = array (
                    'naam'  => $this->input->post('naam'),
                    'voornaam' => $this->input->post('voornaam'),
                    'gsm' => $strGsm,
                    'postcode' => $postcode,
                    'gemeente' => $gemeente,
                    'email' => $this->input->post('email'),
                    'provincie' => '',
                    'school' => '',
                    'diplomaLV' => '',
                    'diploma' => '',
                    'grad_maand' => '',
                    'grad_jaar' => '',
                    'jobs' => '',
                    'type' => '',
                );

                $user_data = $this->session->userdata('user_data');
                if ($user_data){
                    $data['provincie'] = $user_data['provincie'];
                    $data['school'] = $user_data['school'];
                    $data['diplomaLV'] = $user_data['diplomaLV'];
                    $data['diploma'] = $user_data['diploma'];
                    $data['jobs'] = $user_data['jobs'];
                    $data['type'] = $user_data['type'];
                }

                //$this->session->set_userdata('user_data', $data);
                $this->set_session($data);

                //Poging tot toevoegen van data aan datacollector-
                //$this->dataCollector = $data;
                $this->region();
            }
	}
	
	# Functie die geladen wordt bij het verzenden van het form op region_selector
	public function regionForm(){
            $data = $this->session->userdata('user_data');
            $data['provincie'] = $this->input->post('provincie');
            if($data['provincie'] != ''){
                $this->set_session($data);
                $this->school();
            }
            else{
                $this->viewLoader('content/region_selector', array('state' => 'regionForm') ); 
            }		
	}
	
	# Functie die geladen wordt bij het verzenden van het form op school_selector
	public function schoolForm(){
            $data = $this->session->userdata('user_data');
            $data['school'] = $this->input->post('school');
            if($data['school'] != ''){
                $this->set_session($data);
                $this->diploma();
            }
            else{
                $this->viewLoader('content/school_selector', array('state' => 'schoolForm')); 
            }		
	}
	
	# Functie die geladen wordt bij het verzenden van het form op diploma_selector
	public function diplomaForm(){
            $data = $this->session->userdata('user_data');
            $data['diplomaLV'] = $this->input->post('diplomaLV');
            $data['diploma'] = $this->input->post('diploma');
            $data['grad_maand'] = $this->input->post('grad_maand');
            $data['grad_jaar'] = $this->input->post('grad_jaar');

            if($data['diplomaLV'] != '' && $data['diploma'] != ''&& $data['grad_maand'] != ''&& $data['grad_jaar'] != ''){
                $this->set_session($data);
                $this->job();
            }
            else{
                $this->viewLoader('content/diploma_selector', array('state' => 'diplomaForm')); 
            }		
	}
	
	# Functie die geladen wordt bij het verzenden van het form op job_selector
	public function jobForm(){
            $data = $this->session->userdata('user_data');
            $data['jobs']='';
            if($this->input->post('management')!=null){
                $data['jobs'] .= $this->input->post('management')."-";
            }
            if($this->input->post('sales')!=null){
                $data['jobs'] .= $this->input->post('sales')."-";
            }
            if($this->input->post('ict_applications')!=null){
                $data['jobs'] .= $this->input->post('ict_applications')."-";
            }
            if($this->input->post('ict_development')!=null){
                $data['jobs'] .= $this->input->post('ict_development');
            }

            if($data['jobs'] != ''){
                $this->set_session($data);
                $this->type();
            }
            else{
                $this->viewLoader('content/job_selector', array('state' => 'jobForm')); 
            }		
	}
	
	# Functie die geladen wordt bij het verzenden van het form op job_type
	public function typeForm(){
            $data = $this->session->userdata('user_data');
            $data['type']='';
            if($this->input->post('vaste_job')!=null){
                $data['type'] .= $this->input->post('vaste_job')."-";
            }
            if($this->input->post('stage')!=null){
                $data['type'] .= $this->input->post('stage')."-";
            }
            if($this->input->post('andere')!=null){
                $data['type'] .= $this->input->post('andere');
            }

            if($data['type'] != ''){
                $this->set_session($data);
                $this->processed();
            }
            else{
                $this->viewLoader('content/job_type', array('state' => 'typeForm')); 
            }		
	}
	
	# Functie die geladen wordt bij het verzenden van het form op data_processed
	# Sessie wordt vernietigd bij het verzenden van dit form en na de timer voor de redirect 
	public function confirmationForm(){
            $this->load->model('BeursappModel');
            $this->BeursappModel->setUserData();
            $this->session->sess_destroy();
            $this->home();
	}
	
	# View met de verschillende provincies 
	public function region (){
            $data = $this->session->userdata('user_data');			
            $this->viewLoader('content/region_selector', array('state' => 'region') );
	}
	
	# View met de scholen binnen de gekozen provincie
	public function school(){            
            $this->viewLoader('content/school_selector', array('state' => 'school'));
	}
	
	# View met de verschillende mogelijke diploma's 
	public function diploma(){
            //var_dump($this->session);
            $this->viewLoader('content/diploma_selector', array('state' => 'diploma'));
	}
	
	# View met de mogelijke jobs
	public function job(){
            $this->viewLoader('content/job_selector', array('state' => 'job'));
	}
	
	# View met de type jobs (stage, vaste job)
	public function type(){
            $this->viewLoader('content/job_type', array('state' => 'type'));
	}
	
	# View met bedanking & melding succesvolle verwerking gegevens
	public function processed(){
            
            $this->viewLoader('content/data_processed', array('state' => 'processed'));
	}
	
	# Een functie om de header, meegegeven content en footer in één keer te laden.
	public function viewLoader($content, $bc, $data = NULL){
            if (isset($data)){
                $this->load->view('templates/header');
                $this->load->view($content, $data);
                $this->load->view('templates/breadcrumbs',$bc);
                $this->load->view('templates/footer');
            } else {
                $this->load->view('templates/header');
                $this->load->view($content);
                $this->load->view('templates/breadcrumbs',$bc);
                $this->load->view('templates/footer');
            }
	}
        
	# Een functie die gebruikt wordt om de sessie in te stellen
    public function set_session($session_data) {
        $data = array (
            'naam'  => $session_data['naam'],
            'voornaam' => $session_data['voornaam'],
            'gsm' => $session_data['gsm'],
            'postcode' => $session_data['postcode'],
            'gemeente' => $session_data['gemeente'],
            'email' => $session_data['email'],
            'provincie' => $session_data['provincie'],
            'school' => $session_data['school'],
            'diplomaLV' => $session_data['diplomaLV'],
            'diploma' => $session_data['diploma'],
            'grad_maand' => $session_data['grad_maand'],
            'grad_jaar' => $session_data['grad_jaar'],
            'jobs' => $session_data['jobs'],
            'type' => $session_data['type']
        );
        $this->session->set_userdata('user_data', $data);
    }
    
    function alpha_dash_space($str)
    {     
        return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
    } 
	
    public function contactVerify($contact, $otherField) {
        return ($contact != '' || $this->input->post($otherField) != '');
    }
}
