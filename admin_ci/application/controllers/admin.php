<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends CI_Controller {

    	public function index()
	{
		$this->load->view('admin_page');
	}
        
        
        public function getexcel()
        {
            //echo "test";
            //$this->load->view('excel');
            
            $this->load->library('export_excel');
            $this->load->model('admin_model');
            $db_data = $this->admin_model->getDBdata();
            $filename = "CRM=".date('d-m-Y ( H\ui\ms\s )') ;
            
            //echo $filename;
            
            $this->export_excel->to_excel($db_data, $filename); 
            //$this->load->view('');
        }
        
        public function sendMail() {
            $this->load->library('email');
            
            $this->email->from('Recruitment2016@planet-talent.com', 'Recruitment 2016');
            $this->email->reply_to('talent@planet-talent.com', 'Talent');
            $this->email->to('vandendriessche.janmarco@gmail.com');
            
            $this->email->subject('Email test');
            $this->email->message('Testing email class');
            
            echo "Send Mail!<br>";
            //$this->email->send();
            
            //echo $this->email->print_debugger();
            
        }
        
        
}