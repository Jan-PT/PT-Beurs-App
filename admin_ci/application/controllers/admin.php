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

                        //$this->email->from('Recruitment2016@planet-talent.com', 'Recruitment 2016');
            
            $this->email->from('zeroxlupin@gmail.com', 'Recruitment 2016');
            $this->email->reply_to('talent@planet-talent.com', 'Talent');
            
            $this->email->to('vandendriessche.janmarco@gmail.com');
            
            $this->email->subject('Email test');
            $this->email->message('Testing email class');
            
            echo "Send Mail!<br>";
            $this->email->send();
            
            echo $this->email->print_debugger();
            
        }
        
        public function preset(){
            $this->load->model('admin_model');
            //$this->load->helper('form');
            
            $db_preset = $this->admin_model->getPreset();
            $db_diplomaLV = $this->admin_model->getDiplomaLVs();
            $db_diploma = $this->admin_model->getDiplomas();
            $db_school = $this->admin_model->getSchools();
            
            $data['db_preset'] = $db_preset;
            $data['db_diplomaLV'] = $db_diplomaLV;
            $data['db_diploma'] = $db_diploma;
            $data['db_school'] = $db_school;

            $this->load->view('preset_view', $data);
        }
        public function presetForm(){
            
            $this->load->model('admin_model');
            //$this->load->helper('form');
            
            $db_preset = $this->admin_model->getPreset();
            $db_diplomaLV = $this->admin_model->getDiplomaLVs();
            $db_diploma = $this->admin_model->getDiplomas();
            $db_school = $this->admin_model->getSchools();
            
            
            
            
            
            $data['db_preset'] = $db_preset;
            $data['db_diplomaLV'] = $db_diplomaLV;
            $data['db_diploma'] = $db_diploma;
            $data['db_school'] = $db_school;

            $data['test_post'] = $this->input->post();
            
            
            
            $this->load->library("form_validation");

            $this->form_validation->set_rules("diplomaLV", "diploma level", "required|min_length[3]|max_length[20]");
            $this->form_validation->set_rules("diploma", "diploma", "required|min_length[3]|max_length[60]);");
            $this->form_validation->set_rules("grad_maand", "afstudeer maand", "required|numeric|callback_month_year|min_length[1]|max_length[2]");
            $this->form_validation->set_rules("grad_jaar", "afstudeer jaar", "required|numeric|callback_month_year|min_length[1]|max_length[4]");
            
            
            
            
            $this->load->view('preset_view', $data);
        }
        
        public function getDiploma()
        {        
            if ($this->input->get('q') != NULL )
            {
                $this->load->model('admin_model');

                $diplomaLV = $this->input->get('q');
                $data['diplomas'] = $this->admin_model->getDiplomas($diplomaLV);

                $this->load->view('templates/diplomas',$data);

            }

        }
        public function getSchools()
        {        
            if ($this->input->get('q') != NULL )
            {
                $this->load->model('admin_model');

                $diplomaLV = $this->input->get('q');
                $data['diplomas'] = $this->admin_model->getSchools($diplomaLV);

                $this->load->view('templates/schools',$data);

            }
        }

        
        public function clearDB() {
            $this->load->model('admin_model');   
            $this->admin_model->clearDB();
            echo "Cleared DB<br> ";
        }
        
        public function testDB()
        {
            $this->load->model('admin_model');

            
            $config['hostname'] = '192.168.50.28';
            $config['username'] = 'pt_admin';
            $config['password'] = 'T4l3nt$';
            $config['database'] = 'ptmdbpt';
            $config['dbdriver'] = 'mysqli';
  

            $tempDB = $this->load->database($config, TRUE);
            
            
            $db_data = $this->admin_model->getDBdata($tempDB);
            
            var_dump($db_data->result());
            
        }

        public function sendMailDB(){
       
            $this->load->model('admin_model');

            $filename = "PT_CRM=".date('d-m-Y ( H\ui\ms\s )') ;
            
            //echo $filename;
            $filelocal = 'temp/'.$filename . '.xlsx';
 
            $db_data = $this->admin_model->getDBdata();
            $db_extra = $this->admin_model->getDBextra();


            $this->make_excel($filelocal, $db_data, $db_extra);
            echo "Made excel!<br>";

            
            $this->load->library('email');
            
            //$this->email->from('Recruitment2016@planet-talent.com', 'Recruitment 2016');
            
            $this->email->from('zeroxlupin@gmail.com', 'Recruitment 2016');
            
            $this->email->reply_to('talent@planet-talent.com', 'Talent');
            $this->email->to('vandendriessche.janmarco@gmail.com');
            
            $this->email->subject('DB info');
            $this->email->message('Sending DB info');
            
            $this->email->attach($filelocal);  

//            $this->email->send();
//            echo "Send Mail!<br>";          
//            echo $this->email->print_debugger();
            

        }
        
        function make_excel( $filelocal, $crm_array, $extra_array = NULL ){
            
            //load our new PHPExcel library
            $this->load->library('excel');
            //activate worksheet number 1
            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('crm');
            
            $this->db_to_excelsheet($this->excel, $crm_array);
            
            $this->excel->createSheet(1);
            $this->excel->setActiveSheetIndex(1);
            $this->excel->getActiveSheet()->setTitle('extra');
            

            if( isset($extra_array) )
            {
              $this->db_to_excelsheet($this->excel, $extra_array);
            }
            
            
            
            //setAutoSize
            foreach ($this->excel->getWorksheetIterator() as $worksheet) {

                $this->excel
                        ->setActiveSheetIndex($this->excel->getIndex($worksheet));

                $sheet = $this->excel->getActiveSheet();
                $cellIterator = $sheet->getRowIterator()
                        ->current()->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(true);
                /** @var PHPExcel_Cell $cell */
                foreach ($cellIterator as $cell) {
                    $sheet->getColumnDimension($cell->getColumn())
                            ->setAutoSize(true);
                }
            }
            
            $this->excel->setActiveSheetIndex(0);
     
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
            $objWriter->save($filelocal);
            
        }
        
        function db_to_excelsheet($excelobj, $array){
            
            $h = array();
            foreach($array->result_array() as $row){
                foreach($row as $key=>$val){
                    if(!in_array($key, $h)){
                     $h[] = $key;   
                    }
                }
            }
            //echo the entire table headers
            $row_count = 1;
            $col_count = 'A';
            foreach($h as $key) {

                
                $excelobj->getActiveSheet()
                        ->setCellValue($col_count . $row_count, $key);
                
                
                $excelobj->getActiveSheet()
                        ->getStyle($col_count . $row_count)
                        ->getFont()
                        ->setBold(true);
                $excelobj->getActiveSheet()
                        ->getStyle($col_count . $row_count)
                        ->getAlignment()
                        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
                //$row_count++;
                $col_count++;
            }

            $row_count = 2;
            $col_count = 'A';
            foreach($array->result_array() as $row){
            
                foreach($row as $key=>$val){
                    if($key == 'graduation_month'){
                        $excelobj->getActiveSheet()
                            ->getStyle($col_count . $row_count)
                                ->getNumberFormat()
                                ->setFormatCode('0#');                        
                    }
                    
                        $excelobj->getActiveSheet()
                            ->setCellValue($col_count . $row_count, $val);
                    
                    $col_count++;
                }
                $col_count = 'A';
                $row_count++;
                
            }
        }
        
        
        
        
        
}