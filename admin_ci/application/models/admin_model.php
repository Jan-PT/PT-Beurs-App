<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Admin_Model extends CI_Model {
    
    
    
    public function getDBdata( $db = NULL ) {
        $sql = 'SELECT '
                . '`first_name`, '
                . '`contact_type`, '
                . '`account`, '
                . '`last_name`, '
                . '`owner`, '
                . '`source`, '
                . '`diploma_level`, '
                . '`diploma_type`, '
                . '`diploma_sub_type`, '
                . '`school`, '
                . '`graduation_month`, '
                . '`graduation_year`, '
                . '`home_phone`, '
                . '`mobile_phone`, '
                . '`private_email`, '
                . '`gender`, '
                . '`language`, '
                . '`description`, '
                . '`nationality`, '
                . '`birthday`, '
                . '`address_street`, '
                . '`address_country`, '
                . '`address_city_belgium`, '
                . '`address_postal_code`, '
                . '`address_city` '
                . 'FROM pt_crm';
        
        if( isset($db) ){
            $query = $db->query($sql);
        }
        else{
            $query = $this->db->query($sql);
        }
        //return $query->result();
        return $query;
    }
    
    function getDBextra(){
        $query = $this->db->query("SELECT "
                . "id, "
                . "first_name, "
                . "last_name, "
                . "jobs, "
                . "contact, "
                . "tdd "
                . "FROM "
                . "pt_extra e "
                . "JOIN "
                . "pt_crm c ON "
                . "e.id = c.index");
        
        return $query;
    }
    function getPreset(){
        $query = $this->db->query("SELECT "
                . "id, "
                . "beurs, "
                . "andere_school, "
                . "provincie, "
                . "school, "
                . "diplomaLV, "
                . "diploma, "
                . "diplomaSub, "
                . "grad_jaar "
                . "FROM "
                . "pt_presets "
                . "ORDER BY id DESC "
                . "LIMIT 0,1");
         

        return $query->row_array();
            
    }
    
    public function getDiplomaLVs(){
            $sql = 'SELECT id, name, crm_name
                    FROM pt_diploma_level';
            $query = $this->db->query( $sql );
            
            return $query->result();
        }
        
    public function getDiplomas( $diplomaLV = NULL ){
        if( isset( $diplomaLV ) ){
            $sql = "SELECT type, sub, crm_type, crm_sub
                    FROM pt_diploma_view 
                    WHERE crm_level = ?" ;

            $query = $this->db->query( $sql, $diplomaLV );

        }
        else{
            $sql = "SELECT type, sub, crm_type, crm_sub
                    FROM pt_diploma_view" ;

            $query = $this->db->query( $sql);

        }
        return $query->result();

    }
    public function getSchools( $provincie = NULL ){
            
            if( isset( $provincie ) ){
                $sql = "SELECT school, crm_school 
                        FROM pt_school_view 
                        WHERE crm_region = ?" ;
                $query = $this->db->query( $sql, $provincie );

            }
            else{
                $sql = "SELECT school, crm_school 
                        FROM pt_school_view" ;
                $query = $this->db->query( $sql );

            }

            return $query->result();
            
    }
    
    
    function clearDB(){
        
        $this->db->query("TRUNCATE pt_crm");
        $this->db->query("TRUNCATE pt_extra");
        //$this->db->query("TRUNCATE pt_presets");
        
    }




    
    
}