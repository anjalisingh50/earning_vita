<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

   class Activation_Master_M extends CI_Model
   {
        public function __construct() 
        {
           parent::__construct();
           
        }
        public function addActivation($data)
        {
        	return $this->db->insert('tbl_activation_master',$data);
        }
        public function updateActivation($data,$where)
        {
        	return $this->db->update('tbl_activation_master',$data,$where);
        }
        public function getActivation()
        {
        	return $this->db->select('*')->from('tbl_activation_master')->where(['status'=>1])->get()->result_array();
        }
        public function deleteActivation($data,$where)
        {
        	return $this->db->update('tbl_activation_master',$data,$where);
        }

    } 
?>