<?php

#In het model wordt de noodzakelijke data opgeroepen bv. aan de hand van query's. De controller zorgt er dan voor dat deze info op de view weergegeven wordt.
class BeursappModel extends CI_Model {

	#Query gaat de zipcode en naam opvragen van de postcodes (voor de postcode lijst op personal_info page)
	public function getPostcodes(){
            #$query = $this->db->get('pt_postcodes');
            $sql = 'SELECT zipcode, name
                    FROM pt_postcodes';
            
            $query = $this->db->query( $sql );
            return $query->result();
	}
        public function getRegions(){
            $sql =  'SELECT id, name, crm_name 
                     FROM pt_school_region';
            
            $query = $this->db->query( $sql );
            
            return $query->result();
            
        }
        public function getSchools( $region ){
            
            if( isset( $region ) ){
                $sql = "SELECT school, crm_school 
                        FROM pt_school_view 
                        WHERE crm_region = ?" ;
                
                $query = $this->db->query( $sql, $region );
                
                return $query->result();
            }                        
            
        }
        
        public function getDiplomaLVs(){
            $sql = 'SELECT id, name, crm_name
                    FROM pt_diploma_level';
            $query = $this->db->query( $sql );
            
            return $query->result();
        }
        
        public function getDiplomas( $diplomaLV ){
            if( isset( $diplomaLV ) ){
                $sql = "SELECT type, sub, crm_type, crm_sub
                        FROM pt_diploma_view 
                        WHERE crm_level = ?" ;

                $query = $this->db->query( $sql, $diplomaLV );

                return $query->result();
            }

        }
        
        public function getDatumTDD(){
            $sql = "SELECT datum 
                    FROM pt_tdd WHERE datum > CURDATE()
                    ORDER BY datum
                    LIMIT 2";
            
            $query = $this->db->query( $sql );
            return $query->result();
        }
        
        public function getPreload(){
            $sql = "SELECT beurs, "
                    . "andere_school, "
                    . "provincie, "
                    . "school, "
                    . "diplomaLV, "
                    . "diploma, "
                    . "diplomaSub, "
                    . "grad_jaar "
                    . "FROM pt_presets "
                    . "ORDER BY id DESC "
                    . "LIMIT 0,1";
            
            $query = $this->db->query( $sql );
            
            return $query->row_array();
        }


        
        public function setUserData(){
            $user_data = $this->session->userdata('user_data');

            if ($user_data !== false){

                $data = array(
                    'first_name' => $user_data['voornaam'],
                    'last_name' => $user_data['naam'],
                    'diploma_level' => $user_data['diplomaLV'],
                    'diploma_type' => $user_data['diploma'],
                    'diploma_sub_type' => $user_data['diplomaSub'],
                    'school' => $user_data['school'],
                    'graduation_month' => $user_data['grad_maand'],
                    'graduation_year' => $user_data['grad_jaar'],
                    'mobile_phone' => $user_data['gsm'],
                    'private_email' => $user_data['email'],
                    'address_postal_code' => $user_data['postcode'],
                    'address_city' => $user_data['gemeente']                        
//                    'address_city_belgium' => $user_data['gemeente']  //werkt niet in crm                      
                    );
            
                $query = $this->db->insert_string('pt_crm', $data); 
                $this->db->query( $query );
                
                $temp_id = $this->db->insert_id();
                //echo $temp_id;
                
                $extra_data = array(
                    'id' => $temp_id,
                    'jobs' => $user_data['jobs'],
                    'contact' => $user_data['contact'],
                    'tdd' => $user_data['tdd']
                    
                );
                
                $extra_query = $this->db->insert_string('pt_extra', $extra_data); 
                $this->db->query( $extra_query );
                
            }
        }
}