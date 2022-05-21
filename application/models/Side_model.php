<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
   class Side_model extends CI_Model
    {
        public function __construct() 
        {
           parent::__construct();
           
        }
        public function getLeft_List($parent_id)
        {
            if($parent_id!="")
                $this->db->where(['pl.parent_id'=>$parent_id,'pl.status'=>1]);
                $this->db->select('pl.m_level,pl.member_id,rm.name,pl.side');
                $this->db->from('tbl_parent_level pl');
                $this->db->join('tbl_registration_master rm','pl.member_id=rm.member_id','left');
                $this->db->where(['pl.side'=>'L']);
                $qry = $this->db->get();
            if($qry->num_rows()>0)
            {
                return $qry->result_array();
            }else
            {
                return [];
            }
            
        }
        public function get_Leftside_m()
        {
        $Total="SELECT COUNT(member_id)as total_Left FROM tbl_parent_level where side= 'L' and status='1'";
        return $query1 = $this->db->query($Total)->result_array();
        }
        public function getRight_List($parent_id)
        {
            if($parent_id!="")
                $this->db->where(['pl.parent_id'=>$parent_id,'pl.status'=>1]);
                $this->db->select('pl.m_level,pl.member_id,rm.name,pl.side');
                $this->db->from('tbl_parent_level pl');
                $this->db->join('tbl_registration_master rm','pl.member_id=rm.member_id','left');
                $this->db->where(['pl.side'=>'R']);
                $qry = $this->db->get();
            if($qry->num_rows()>0)
            {
                return $qry->result_array();
            }else
            {
                return [];
            }
            
        }
        
        public function get_Rightside_m()
        {
        $Total="SELECT COUNT(member_id)as total_right FROM tbl_parent_level where side= 'R' and status='1'";
        return $query1 = $this->db->query($Total)->result_array();
        }
        

  }
