<?php

#In het model wordt de noodzakelijke data opgeroepen bv. aan de hand van query's. De controller zorgt er dan voor dat deze info op de view weergegeven wordt.
class BeursappModel extends CI_Model {

	#Query gaat de zipcode en naam opvragen van de postcodes (voor de postcode lijst op personal_info page)
	public function getPostcodes(){
            #$query = $this->db->get('pt_postcodes');
            $query = $this->db->query('SELECT zipcode,name FROM pt_postcodes');
            return $query->result();
	}


        public function setUserData(){
            if ($this->session->userdata('user_data')){
                $user_data = $this->session->userdata('user_data');

                $data = array(
                    'first_name' => $user_data['voornaam'],
                    'last_name' => $user_data['naam'],
                    'diploma_level' => $user_data['diplomaLV'],
                    'diploma_type' => $user_data['diploma'],
                    'school' => $user_data['school'],
                    'graduation_month' => $user_data['grad_maand'],
                    'graduation_year' => $user_data['grad_jaar'],
                    'mobile_phone' => $user_data['gsm'],
                    'private_email' => $user_data['email'],
                    'address_postal_code' => $user_data['postcode'],
                    'address_city_belgium' => $user_data['gemeente']                        
                    );
            
                $query = $this->db->insert_string('pt_crm', $data); 
                $this->db->query($query);
                
            }
        }
}