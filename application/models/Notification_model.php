<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
   class Notification_model extends CI_Model
   {
       public function __construct() 
      {
           parent::__construct();
           
      }
      public function addRemarks($data)
      {
         return $this->db->insert('tbl_notification_broadcasts',$data);

      }
      public function updateRemarks($data,$where)
      {
         return $this->db->update('tbl_notification_broadcasts',$data,$where);
      }
      public function getRemarks()
        {
            return $this->db->select('id,remarks')->from('tbl_notification_broadcasts')->where(['status'=>1])->get()->result_array();
        }
        public function getVisible()
        {
            return $this->db->select('*')->from('tbl_notification_broadcasts')->where(['visibility'=>1,'status'=>1])->get()->result_array();
        }
      public function deleteStage($data,$where)
        {
            return $this->db->delete('tbl_notification_broadcasts',$data,$where);
        }
   }
?>