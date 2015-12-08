<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    	public function index()
	{
		$this->load->view('admin_page');
	}
        
        
        public function getexel()
        {
            echo "test";
        }
}