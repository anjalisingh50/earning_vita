<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
   class Plan_Model extends CI_Model
   {
       public function __construct() 
      {
           parent::__construct();
           
      }
      public function getPlanList($id)
       {
            if($id!="")
                    $this->db->where('id',$id);
            return $this->db->select('*')->from('tbl_plan_master')->where(['status'=>1])->get()->result_array();
       }
      public function verifyRegisterExist($package_id,$package_name)
        {
        return $this->db->select('id')->from('tbl_plan_master')->where(['id'=>$package_id,'package_name'=>$package_name,'status'=>1])->get()->num_rows();
        }
      public function addPackage($data)
      {
         return $this->db->insert('tbl_plan_master',$data);

      }
      public function updatePackage($data,$where)
      {
         return $this->db->update('tbl_plan_master',$data,$where);
      }
      public function verifyPackage($id,$package_name)
	   {
	   		return $this->db->select('id')->from('tbl_plan_master')->where(['id!='=>$id,'package_name'=>$package_name,'status'=>1])->get()->num_rows();
	   }
     
      public function deletePlan($data,$where)
        {
            return $this->db->update('tbl_plan_master',$data,$where);
        }
   }
?>