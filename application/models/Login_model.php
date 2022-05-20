<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

   class Login_model extends CI_Model
   {
        public function __construct() 
        {
           parent::__construct();
           
        }
        public function verifyMemberIdExist($member_id)
      {
            return $this->db->select('id,member_id,password')->from('tbl_registration_master')->where(['member_id'=>$member_id,'status'=>1])->get()->result_array();
      }

      public function getUserData($regId)
      {
            if($regId!="")
                  $this->db->where('rm.id',$regId);
            return $this->db->select('rm.id,rm.member_id,rm.sponsor_id,rm.title,rm.name,rm.gender,rm.f_h_name,rm.country,rm.state,rm.city,rm.address,rm.pin,rm.mobile_no,rm.email_id,rm.photo,rm.registration_date,rm.activation_date')->from('tbl_registration_master rm')->where(['rm.status'=>1])->get()->result_array();
      }
      public function getMemberName($member_id)
      {
         if($member_id!='')
         $this->db->where('status',1,'member_id',$member_id);
         $this->db->select('name');
         $this->db->from('tbl_registration_master');
         $qry = $this->db->get();
         return $result = $qry->result_array();
      }
      public function countEmail_Id($email_id,$mobile_no)
      {
       $qry = $this->db->query("select count(id) as total from tbl_registration_master where (email_id = '$email_id' or mobile_no='$mobile_no') and status = 1")->result_array();
            if(empty($qry[0]['total']))
            {
               return 0;
            }else
            {
               return $qry[0]['total'];
            }
      }

      public function countSponser_Id($sponsor_id)
      {
       $qry = $this->db->query("select count(id) as total from tbl_registration_master where member_id = '$sponsor_id' and status = 1")->result_array();
            if(empty($qry[0]['total']))
            {
               return 0;
            }else
            {
               return $qry[0]['total'];
            }
      }
   
   }
   
?>