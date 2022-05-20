<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

   class Register_master_model extends CI_Model
   {
        public function __construct() 
        {
           parent::__construct();
           
        }
        public function verifyRegisterExist($mobile_no,$email_id)
        {
        return $this->db->select('id')->from('tbl_registration_master')->where(['mobile_no'=>$mobile_no,'email_id'=>$email_id,'status'=>1])->get()->num_rows();
        }
        public function getNewId()
        {
            $lastid="";
            $this->db->select('member_id')->from('tbl_registration_master')->order_by('id','desc');
             $qry = $this->db->get()->result_array();
            if($qry[0]["member_id"]!="")
            {
               $lastid= "EV".substr($qry[0]["member_id"], 2)+1;
               
            }
            else{
                $lastid="EV"."1000";
            }
            return $lastid;
        }
        public function countSponser_Id($sponsor_id)
        {
        $qry = $this->db->query("select count(id) as total from tbl_registration_master where member_id = '".$sponsor_id."' and status = 1")->result_array();
            if(empty($qry[0]['total']))
            {
               return 0;
            }else
            {
               return $qry[0]['total'];
            }
        }

        public function countParentId_Id($sponsor_id)
        {
            $qry = $this->db->query("select member_id from tbl_registration_master where sponsor_id = '".$sponsor_id."' and side = 'L' and status = 1")->result_array();
                if(empty($qry[0]['member_id']))
                {
                   return $sponsor_id;
                }else
                {
                   $this->countSponser_Id($qry[0]['member_id']);
                }
        }

        public function addUserData($data)
        {
            $this->db->insert('tbl_registration_master',$data);
            $id = $this->db->insert_id();
           return $id;

        }
        
        public function verifyMobileExist($id,$mobile_no,$email_id)
        {
            return $this->db->select('id')->from('tbl_registration_master')->where(['id!='=>$id,'mobile_no'=>$mobile_no,'email_id'=>$email_id,'status'=>1])->get()->num_rows();
        }
        
   
       public function updateUser($data,$where)
       {
           return $this->db->update('tbl_registration_master',$data,$where);
           // echo $this->db->last_query();die;
       }

       public function getRegisterData($regId)
       {
            if($regId!="")
                    $this->db->where('id',$regId);
            return $this->db->select('*')->from('tbl_registration_master')->where(['status'=>1])->get()->result_array();
       }
       public function deleteRegister($data,$where)
        {
            return $this->db->update('tbl_registration_master',$data,$where);
        }

    }
 ?>