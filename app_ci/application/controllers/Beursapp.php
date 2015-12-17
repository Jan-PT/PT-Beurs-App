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
	public function infoForm (){
            
            $this->load->model('BeursappModel');
            $codes['records'] = $this->BeursappModel->getPostcodes();
            $bc['state'] = 'infoForm';

            
            # Form validation regels
            $this->load->library("form_validation");
            
            $this->form_validation->set_message('alpha_dash_space', 'Naam mag geen nummers bevatten.');
            
            $this->form_validation->set_rules("voornaam", "voornaam", "required|callback_alpha_dash_space|min_length[3]|max_length[30]");
            $this->form_validation->set_rules("naam", "naam", "required|callback_alpha_dash_space|min_length[3]|max_length[30]);");
            $this->form_validation->set_rules("gsm", "gsm nummer", "required|numeric|min_length[11]|max_length[12]");
            $this->form_validation->set_rules("postcode", "postcode", "required|min_length[4]|max_length[50]");
            $this->form_validation->set_rules("email", "email", "required|valid_email|min_length[5]|max_length[96]");

            # Als de regels falen wordt de pagina opnieuw geladen en anders wordt de sessie aangemaakt en naar de volgende functie doorgegaan.
            if ($this->form_validation->run() == false)
            {
                $this->viewLoader('content/personal_info', $bc, $codes);      
            }
            else
            {
                #Postcode en gemeente veld splitsen op '-'
                $postcodegemeente = $this->input->post('postcode');
                if(strpos($postcodegemeente, "-") !== false)
                {
                    $postcodeArr = explode("-",$postcodegemeente, 2);
                    $postcode = $postcodeArr[0];
                    if( isset($postcode[1]) )
                    {
                        $gemeente = $postcodeArr[1];
                    }
                    else
                    {
                        $gemeente = '';
                    }
                }
                else
                {
                    $postcode = $postcodegemeente;
                    $gemeente = '';
                }
                $gsm = $this->input->post('gsm');
                
                if( strlen($gsm) == 11 )
                {
                    $gsmeerst = substr($gsm, 0, 3);
                    $gsmtweed = substr($gsm, 3, 1);
                    $gsmderde = substr($gsm, 4, 3);
                    $gsmvierd = substr($gsm, 7, 2);
                    $gsmvijfd = substr($gsm, 9, 2);
                    
                    $strGsm = $gsmeerst . " " . $gsmtweed . " " . $gsmderde . " " . $gsmvierd . " " . $gsmvijfd;
                    
                }
                else
                {
                    $gsmeerst = substr($gsm, 0, 3);
                    $gsmtweed = substr($gsm, 3, 3);
                    $gsmderde = substr($gsm, 6, 2);
                    $gsmvierd = substr($gsm, 8, 2);
                    $gsmvijfd = substr($gsm, 10, 2);
                
                    $strGsm = $gsmeerst . " " . $gsmtweed . " " . $gsmderde . " " . $gsmvierd . " " . $gsmvijfd;

                }
                
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
            $this->load->model('BeursappModel');
            $codes['db_regions'] = $this->BeursappModel->getRegions();
            
            
            $data = $this->session->userdata('user_data');
            $data['provincie'] = $this->input->post('provincie');
            
            $this->set_session($data);
            if($data['provincie'] != ''){
                //$this->set_session($data);
                if($data['provincie'] != 'Andere'){
                    $this->school();
                }
                else{
                    //If andere go to Andere
                }
                
                
            }
            else{
                $this->viewLoader('content/region_selector', array('state' => 'regionForm'), $codes ); 
            }		
	}
	
	# Functie die geladen wordt bij het verzenden van het form op school_selector
	public function schoolForm(){
            $this->load->model('BeursappModel');

            $user_data = $this->session->userdata('user_data');
            $user_data['school'] = $this->input->post('school');
            

            
            if($user_data['school'] != ''){
                $this->set_session($user_data);
                $this->diploma();
            }
            else{
                if( 
                    isset( $user_data['provincie']) 
                    && $user_data['provincie'] != ''
                    && $user_data['provincie'] != 'Andere')
                {
                    $code['db_schools'] = $this->BeursappModel->getSchools($user_data['provincie']);
                    $this->viewLoader('content/school_selector', array('state' => 'schoolForm'), $code);
                }
                else{
                    //If andere go to Andere
                }
            }		
	}
	
	# Functie die geladen wordt bij het verzenden van het form op diploma_selector
	public function diplomaForm(){
            
            $this->load->model('BeursappModel');
            $data['db_diplomaLVs'] = $this->BeursappModel->getDiplomaLVs();
            
            $user_data = $this->session->userdata('user_data');
            $user_data['diplomaLV'] = $this->input->post('diplomaLV');
            $user_data['diploma'] = $this->input->post('diploma');
            $user_data['grad_maand'] = $this->input->post('grad_maand');
            $user_data['grad_jaar'] = $this->input->post('grad_jaar');

            if($user_data['diplomaLV'] != '' 
                    && $user_data['diploma'] != ''
                    && $user_data['grad_maand'] != ''
                    && $user_data['grad_jaar'] != ''){
                $this->set_session($user_data);
                $this->job();
            }
            else{
                
                if( isset($user_data['diplomaLV']) && $user_data['diplomaLV'] != '' ){
                    $data['diplomas'] = $this->BeursappModel->getDiplomas($user_data['diplomaLV']);
                }
                $this->viewLoader('content/diploma_selector', array('state' => 'diplomaForm'), $data); 
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
                $this->contact();
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
	# Functie die geladen wordt bij het verzenden van het form op job_type
	public function contactForm(){
            $data = $this->session->userdata('user_data');

            
//            if($data['type'] != ''){
//                $this->set_session($data);
//                $this->processed();
//            }
//            else{
//                $this->viewLoader('content/contact_selector', array('state' => 'typeForm')); 
//            }
            $this->processed();
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
            $this->load->model('BeursappModel');
            $codes['db_regions'] = $this->BeursappModel->getRegions();
            $this->viewLoader('content/region_selector', array('state' => 'region'), $codes );
	}
	
	# View met de scholen binnen de gekozen provincie
	public function school(){
            $this->load->model('BeursappModel');
            $user_data = $this->session->userdata('user_data');
            if( isset( $user_data['provincie']) 
                    && $user_data['provincie'] != ''
                    && $user_data['provincie'] != 'Andere')
            {
                $data['db_schools'] = $this->BeursappModel->getSchools($user_data['provincie']);
                $this->viewLoader('content/school_selector', array('state' => 'school'), $data);
            }
            else{
                $this->viewLoader('content/school_selector', array('state' => 'school'));
            }
	}
	
	# View met de verschillende mogelijke diploma's 
	public function diploma(){
            //var_dump($this->session);
            $this->load->model('BeursappModel');
            
            $user_data = $this->session->userdata('user_data');
            
            $data['db_diplomaLVs'] = $this->BeursappModel->getDiplomaLVs();


            if( isset($user_data['diplomaLV']) && $user_data['diplomaLV'] != '' ) {
                    $data['diplomas'] = $this->BeursappModel->getDiplomas($user_data['diplomaLV']);
            }
            
            $this->viewLoader('content/diploma_selector', array('state' => 'diploma'), $data);
	}
	
	# View met de mogelijke jobs
	public function job(){
            $this->viewLoader('content/job_selector', array('state' => 'job'));
	}
	# View met de mogelijke jobs
	public function contact(){
            $this->viewLoader('content/contact_selector', array('state' => 'contact'));
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
        $data = array (  );
        
        $field = array( 
            'naam',
            'voornaam',
            'gsm',
            'postcode',
            'gemeente',
            'email',
            'provincie',
            'school',
            'andere_school',
            'diplomaLV',
            'diploma',
            'grad_maand',
            'grad_jaar',
            'jobs',
            'type'
        );
        
        foreach ($field as $val) {
            if(isset($session_data[$val])){
                $data[$val] = $session_data[$val];
            }
        }
        
        $this->session->set_userdata('user_data', $data);
    }
    
    function alpha_dash_space($str)
    {     
        return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
    } 
	
    public function contactVerify($contact, $otherField) {
        return ($contact != '' || $this->input->post($otherField) != '');
    }
    
    public function getDiploma()
    {
        
        if ($this->input->get('q') != NULL )
        {
            $this->load->model('BeursappModel');

            
            $diplomaLV = $this->input->get('q', false);
            echo $diplomaLV;
            echo $_GET['q'];
            $data['diplomas'] = $this->BeursappModel->getDiplomas($diplomaLV);
            
            $this->load->view('templates/diplomas',$data);

        }
    }
    
}
