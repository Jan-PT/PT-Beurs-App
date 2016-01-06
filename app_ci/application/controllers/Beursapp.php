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
        
    // Constructor 
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

        # Een functie die gebruikt wordt om de sessie in te stellen
    public function set_session($session_data, $empty_field = FALSE) {
        $data = array (  );

        $field = array( 
            'naam',                 //info velden
            'voornaam',
            'gsm',
            'postcode',
            'gemeente',
            'email',

            'andere_school',        //school velden
            'provincie',
            'school',

            'diplomaLV',            //diploma velden
            'diploma',
            'diplomaSub',
            'grad_maand',
            'grad_jaar',

            'jobs',                 //extra velden
            'contact',
            'tdd'
        );

        foreach ($field as $val) {
            
            if( $empty_field == TRUE){
                $data[$val] = '';
            }
            elseif(isset($session_data[$val])){
                $data[$val] = $session_data[$val];   
            }
            else{
                //nothing happens
            }
            
        }

        $this->session->set_userdata('user_data', $data);
    }
    
    # Standaard functie van de Beursapp controller (verwijst in dit geval door naar de home functie)
    public function index()
    {
        $this->load->model('BeursappModel');
        $preload = $this->BeursappModel->getPreload();
        var_dump($preload);
        #maak de user data leeg
        $this->set_session(array(), TRUE);
        if(is_array($preload)){
            $this->set_session($preload[0]);
        }
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
        $this->form_validation->set_message('plus_num_space', 'Gsm mag alleen nummers en spaties bevatten.');
        $this->form_validation->set_message('val_post', 'Postcode moet van de vorm "1234-abcdfh" hebben.');

        $this->form_validation->set_rules("voornaam", "voornaam", "required|callback_alpha_dash_space|min_length[3]|max_length[50]school");
        $this->form_validation->set_rules("naam", "naam", "required|callback_alpha_dash_space|min_length[3]|max_length[50]school");
        $this->form_validation->set_rules("gsm", "gsm nummer", "required|callback_plus_num_space|min_length[11]|max_length[20]school");
        $this->form_validation->set_rules("postcode", "postcode", "required|callback_val_post|min_length[4]|max_length[70]school");
        $this->form_validation->set_rules("email", "email", "required|valid_email|min_length[5]|max_length[100]school");

        # Als de regels falen wordt de pagina opnieuw geladen en anders wordt de sessie aangemaakt en naar de volgende functie doorgegaan.
        if ($this->form_validation->run() == false)
        {
            $this->viewLoader('content/personal_info', $bc, $codes);      
        }
        else
        {
            $user_data = $this->session->userdata('user_data');

            #Postcode en gemeente veld splitsen op '-'
            $postcodegemeente = $this->input->post('postcode');
            if(strpos($postcodegemeente, "-") !== false)
            {
                $postcodeArr = explode("-",$postcodegemeente, 2);
                $postcode = $postcodeArr[0];
                if( isset($postcodeArr[1]) )
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

            $user_data['naam']  = $this->input->post('naam');
            $user_data['voornaam'] = $this->input->post('voornaam');
            $user_data['gsm'] = $this->input->post('gsm');
            $user_data['postcode'] = $postcode;
            $user_data['gemeente'] = $gemeente;
            $user_data['email'] = $this->input->post('email');
            $user_data['andere_school'] = false;


            $this->set_session($user_data);
            $this->region();
        }
    }

    # Functie die geladen wordt bij het verzenden van het form op region_selector
    public function regionForm(){
        $this->load->model('BeursappModel');
        $data['db_regions'] = $this->BeursappModel->getRegions();


        $user_data = $this->session->userdata('user_data');
        $temp_provincie = $this->input->post('provincie');

        if($temp_provincie != '')
        {
            if($temp_provincie != 'Andere')
            {
                $user_data['ander_school'] = FALSE;
                $user_data['provincie'] = $temp_provincie;

                $this->set_session($user_data);
                $this->school();
            }
            else
            {
                $user_data['andere_school'] = TRUE;

                if( !isset($user_data['provincie']) || $user_data['provincie'] == '')
                {
                    $user_data['provincie'] = '';
                }

                $this->set_session($user_data);
                unset( $_POST );
                $this->andere_school();
            }
        }
        else{
            $this->viewLoader('content/region_selector', array('state' => 'regionForm'), $data ); 
        }		
    }

    # Functie die geladen wordt bij het verzenden van het form op school_selector
    public function schoolForm(){
        $this->load->model('BeursappModel');

        $user_data = $this->session->userdata('user_data');
        $temp_school = $this->input->post('school');


        if($temp_school != '')
        {
            if($temp_school != 'Andere')
            {
                $user_data['ander_school'] = FALSE;
                $user_data['school'] = $temp_school;

                $this->set_session($user_data);
                $this->diploma();
            }
            else
            {
                $user_data['andere_school'] = TRUE;

                if( !isset($user_data['school']) || $user_data['school'] == '')
                {
                    $user_data['school'] = '';
                }

                $this->set_session($user_data);
                unset( $_POST );
                $this->andere_school();
            }
        }
        else{
            if( isset( $user_data['provincie']) 
                && $user_data['provincie'] != ''
                )
            {
                if( isset( $user_data['andere_school'] ) 
                    && $user_data['andere_school'] == false
                        ){

                    $data['db_schools'] = $this->BeursappModel->getSchools($user_data['provincie']);
                    $this->viewLoader('content/school_selector', array('state' => 'schoolForm'), $data);
                }
                else{
                    $this->andere_school();
                }
            }
            else{
                $this->region();
            }
        }		
    }

    public function andere_schoolForm(){
        $this->load->model('BeursappModel');

        $user_data = $this->session->userdata('user_data');
        $user_data['provincie'] = $this->input->post('provincie'); 
        $user_data['school'] = $this->input->post('school');

                    # Form validation regels
        $this->load->library("form_validation");

        $this->form_validation->set_message('alpha_dash', 'regio-veld mag alleen letters en - bevatten.');
        $this->form_validation->set_message('alpha_dash_space', 'school-veld mag alleen letters, - en spaties bevatten.');

        $this->form_validation->set_rules("provincie", "provincie", "required|callback_alpha_dash|min_length[3]|max_length[40]school");
        $this->form_validation->set_rules("school", "school", "required|callback_alpha_dash_space|min_length[3]|max_length[30]school");

        # Als de regels falen wordt de pagina opnieuw geladen en anders wordt de sessie aangemaakt en naar de volgende functie doorgegaan.
        if ($this->form_validation->run() == false)
        {
            $this->viewLoader('content/andere_school_selector', array('state' => 'andere_schoolForm'));      
        }
        else
        {
            $this->set_session($user_data);

            $this->diploma();
        }

    }


    # Functie die geladen wordt bij het verzenden van het form op diploma_selector
    public function diplomaForm(){

        $user_data = $this->session->userdata('user_data');

        $this->load->library("form_validation");

        $this->form_validation->set_message('alpha_dash_space', 'diploma mag geen nummers bevatten.');
        $this->form_validation->set_message('month_year', 'Kies een afstudeer maand en/of jaar.');

        $this->form_validation->set_rules("diplomaLV", "diploma level", "required|min_length[3]|max_length[20]");
        $this->form_validation->set_rules("diploma", "diploma", "required|min_length[3]|max_length[60]school");
        $this->form_validation->set_rules("grad_maand", "afstudeer maand", "required|numeric|callback_month_year|min_length[1]|max_length[2]");
        $this->form_validation->set_rules("grad_jaar", "afstudeer jaar", "required|numeric|callback_month_year|min_length[1]|max_length[4]");



        $this->load->model('BeursappModel');
        $data['db_diplomaLVs'] = $this->BeursappModel->getDiplomaLVs();

        if ($this->form_validation->run() == false)
        {
            if( isset($user_data['diplomaLV']) && $user_data['diplomaLV'] != '' ){
                $data['diplomas'] = $this->BeursappModel->getDiplomas($user_data['diplomaLV']);
            }
            $this->viewLoader('content/diploma_selector', array('state' => 'diplomaForm'), $data);      
        }
        else{
            $user_data = $this->session->userdata('user_data');

            $user_data['diplomaLV'] = urldecode($this->input->post('diplomaLV', false));
            
            $post_diploma = $this->input->post('diploma');
            $diploma = '';
            $diplomaSub = '';
            if(strpos($post_diploma, "_") !== false)
            {
                $diplomaArr = explode("_",$post_diploma, 2);
                $diploma = $diplomaArr[0];
                if( isset($diplomaArr[1]) )
                {
                    $diplomaSub = $diplomaArr[1];
                }
                else
                {
                    $diplomaSub = '';
                }
            }
            else
            {
                $diploma = $post_diploma;
                $diplomaSub = '';
            }
            
            $user_data['diploma'] = $diploma;
            $user_data['diplomaSub'] = $diplomaSub;
            
            $user_data['grad_maand'] = $this->input->post('grad_maand');
            $user_data['grad_jaar'] = $this->input->post('grad_jaar');

            $this->set_session($user_data);
            $this->job();
            //$this->viewLoader('content/diploma_selector', array('state' => 'diplomaForm'), $data);      

        }
    }

    # Functie die geladen wordt bij het verzenden van het form op job_selector
    public function jobForm(){
        $user_data = $this->session->userdata('user_data');
        $user_data['jobs']='';

        if($this->input->post('ict_applications')!=null){
            $user_data['jobs'] .= $this->input->post('ict_applications')."-";
        }
        if($this->input->post('ict_infrastructure')!=null){
            $user_data['jobs'] .= $this->input->post('ict_infrastructure'). "-";
        }
        if($this->input->post('ict_ba_fa')!=null){
            $user_data['jobs'] .= $this->input->post('ict_ba_fa'). "-";
        }
        if($this->input->post('management')!=null){
            $user_data['jobs'] .= $this->input->post('management')."-";
        }
        if($this->input->post('sales')!=null){
            $user_data['jobs'] .= $this->input->post('sales')."-";
        }


        if($user_data['jobs'] != ''){
            $this->set_session($user_data);
            $this->contact();
        }
        else{
            $this->viewLoader('content/job_selector', array('state' => 'jobForm')); 
        }		
    }

    # Functie die geladen wordt bij het verzenden van het form op contact pagina
    public function contactForm(){
        $this->load->model('BeursappModel');

        $user_data = $this->session->userdata('user_data');
        $data['db_data'] = $this->BeursappModel->getDatumTDD();

        $user_data['contact'] = $this->input->post('contact');
        $user_data['tdd'] = '';



        if($user_data['contact'] != ''){

            if($user_data['contact'] == 'tdd'){
                if($this->input->post('tdd3') != null){
                    $user_data['tdd'] .= $this->input->post('tdd3');
                }
                else{
                    if($this->input->post('tdd1') != null){
                        $user_data['tdd'] .= $this->input->post('tdd1')."_";
                    }
                    if($this->input->post('tdd2') != null){
                        $user_data['tdd'] .= $this->input->post('tdd2')."_";
                    }
                }
            }

            $this->set_session($user_data);
               $this->processed();

        }
        else{
            $this->viewLoader('content/contact_selector', array('state' => 'contactForm'), $data); 
        }
    }

    # Functie die geladen wordt bij het verzenden van het form op data_processed
    # Sessie wordt vernietigd bij het verzenden van dit form en na de timer voor de redirect 
    public function confirmationForm(){
        $this->load->model('BeursappModel');

        #Slaag gegevens op in data base
        $this->BeursappModel->setUserData();


        $this->session->sess_destroy();

        $this->personalLogo();
    }

    public function personalLogoForm(){
        $this->endpage();
    }
    public function endpageForm(){
        $this->index();
    }




    public function andere_school(){

        $this->viewLoader('content/andere_school_selector', array('state' => 'andere_school'));

    }
    # View met de verschillende provincies 
    public function region (){
        $this->load->model('BeursappModel');
        $data['db_regions'] = $this->BeursappModel->getRegions();
        $this->viewLoader('content/region_selector', array('state' => 'region'), $data );
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

        $this->load->model('BeursappModel');

        $data['db_data'] = $this->BeursappModel->getDatumTDD();

        $this->viewLoader('content/contact_selector', array('state' => 'contact'), $data);
    }


    # View met bedanking & melding succesvolle verwerking gegevens
    public function processed(){

        $this->viewLoader('content/data_processed', array('state' => 'processed'));
    }

    public function personalLogo(){
        $this->viewLoader('content/personal_logo', array('state' => 'personalLogo'));
    }
    public function endpage(){
        $this->viewLoader('content/end_page', array('state' => 'endpage'));
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



    function alpha_dash_space($str)
    {     
        return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
    } 
    function alpha_dash($str)
    {     
        return ( ! preg_match("/^([a-z-])+$/i", $str)) ? FALSE : TRUE;
    } 
    function plus_num_space($str)
    {     
        return ( ! preg_match("/[+]{1}[0-9 ]+$/", $str)) ? FALSE : TRUE;
    } 
    function val_post($str)
    {     
        return ( ! preg_match("/^[1-9]{1}[0-9]{3}[-][a-z \-\(\)\.]+$/i", $str)) ? FALSE : TRUE;
    } 

    function month_year($data){
        return $data > 0;

    }

    public function contactVerify($contact, $otherField) {
        return ($contact != '' || $this->input->post($otherField) != '');
    }

    public function getDiploma()
    {        
        if ($this->input->get('q') != NULL )
        {
            $this->load->model('BeursappModel');

            $diplomaLV = $this->input->get('q');
            $data['diplomas'] = $this->BeursappModel->getDiplomas($diplomaLV);

            $this->load->view('templates/diplomas',$data);

        }

    }

    public function testpage()
    {

        $this->viewLoader('content/testpage', array('state' => 'testpage'));

    }


}
