<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends CI_Controller {

    	public function index()
	{
		$this->load->view('admin_page');
	}
        
        
        public function getexcel()
        {
            //echo "test";
            $this->load->view('excel');
            
        }
}