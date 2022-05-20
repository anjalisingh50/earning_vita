<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

   class Withdrawal_Model extends CI_Model
   {
        public function __construct() 
        {
           parent::__construct();
           
        }
        public function countMember_Id($member_id)
        {
        $qry = $this->db->query("select count(id) as total from tbl_registration_master where member_id = '".$member_id."' and status = 1")->result_array();
            if(empty($qry[0]['total']))
            {
               return 0;
            }else
            {
               return $qry[0]['total'];
            }
        }
        public function insertWithdrawal($data)
        {
            $this->db->insert('tbl_withdrawal_transaction',$data);
            $id = $this->db->insert_id();
            $request_id = "REQ00".$id;
            $this->db->update('tbl_withdrawal_transaction',['request_id'=>$request_id],['id'=>$id]);
            return $request_id;
        
        }
        public function countverifyMember_Id($withdrawal_id,$member_id)
        {
        	return $this->db->select('id')->from('tbl_registration_master')->where(['id!='=>$withdrawal_id,'member_id!='=>$member_id,'status'=>1])->get()->num_rows();
        }
        public function updateWithdrawal($data,$where)
        {
        	return $this->db->update('tbl_withdrawal_transaction',$data,$where);
        }
    }
?>