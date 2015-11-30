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
		#$this->info();
                $this->load->view('templates/header');
                $this->load->view('content/start_page');
	}
	
	# View met contact info van de student
	public function info (){
		$this->viewLoader('content/personal_info');
	}
	
	# Form voor contact info van de student
	public function infoForm(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("naam", "naam", "required|alpha|min_length[3]|max_length[30]);");
		$this->form_validation->set_rules("straat", "straat", "required|alpha|min_length[5]|max_length[50]");
		$this->form_validation->set_rules("bus", "bus", "alpha_numeric|max_length[5]");
		$this->form_validation->set_rules("gsm", "gsm nummer", "required|numeric|min_length[10]|max_length[15]");
		$this->form_validation->set_rules("voornaam", "voornaam", "required|alpha|min_length[3]|max_length[30]");
		$this->form_validation->set_rules("huisnr", "huisnummer", "required|max_length[5]|alpha_numeric");
		$this->form_validation->set_rules("postcode", "postcode", "required|numeric|min_length[4]|max_length[10]");
		$this->form_validation->set_rules("email", "email", "required|valid_email|min_length[10]|max_length[50]");
	
		if ($this->form_validation->run() == false){
			$this->viewLoader('content/personal_info');
		}
		else {
			$this->region();
		}
	}
	
	# View met de verschillende provincies 
	public function region (){
		$this->viewLoader('content/region_selector');
	}
	
	# View met de scholen binnen de gekozen provincie
	public function school(){
		$this->viewLoader('content/school_selector');
	}
	
	# View met de verschillende mogelijke diploma's 
	public function diploma(){
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
	
	public function viewLoader($content){
		$this->load->view('templates/header');
		$this->load->view($content);
		$this->load->view('templates/footer');
	}
	
}
