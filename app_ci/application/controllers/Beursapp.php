<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beursapp extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->home();
	}
	
	# View waarvan de studenten starten (moet nog aangepast worden)
	public function home (){
		$this->info();
	}
	
	# View met contact info van de student
	public function info (){
		$this->viewLoader('content/personal_info');
	}
	
	# View met de verschillende provincies 
	public function region (){
		$this->viewLoader('content/region_selector');
	}
	
	# View met de scholen binnen de gekozen provincie
	public function school(){
		$this->viewLoader('content/school_selector');
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
	
	public function viewLoader($content){
		$this->load->view('templates/header');
		$this->load->view($content);
		$this->load->view('templates/footer');
	}
	
}
