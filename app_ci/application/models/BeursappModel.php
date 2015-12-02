<?php

#In het model wordt de noodzakelijke data opgeroepen bv. aan de hand van query's. De controller zorgt er dan voor dat deze info op de view weergegeven wordt.
class BeursappModel extends CI_Model {

	#Query gaat de zipcode en naam opvragen van de postcodes (voor de postcode lijst op personal_info page)
	public function getPostcodes(){
		#$query = $this->db->get('pt_postcodes');
		$query = $this->db->query('SELECT zipcode,name FROM pt_postcodes');
		return $query->result();
	}

}