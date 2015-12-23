<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Admin_Model extends CI_Model {
    
    
    
    public function getDBdata() {
        
        $query = $this->db->query('SELECT * FROM pt_crm');
            
        //return $query->result();
        return $query;
    }

    
}