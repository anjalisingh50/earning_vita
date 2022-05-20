<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

class GenerateFund_model extends CI_Model
{
  public function __construct() 
  {
     parent::__construct();
     
  }


  public function verifyPackageAlreadyGeneareted_m($package_id)
  {
      $result = $this->db->select('count(id) as total ')->from('tbl_package_available_fund')->where(['status'=>1,'package_id'=>$package_id])->get()->result_array();
      if(!empty($result))
      {
         return $result[0]['total'];
      }else
      {
         return 0;
      }
  }


  public function verifyPackageExist_m($package_id)
  {
      $result = $this->db->select('count(id) as total ')->from('tbl_plan_master')->where(['status'=>1,'package_id'=>$package_id])->get()->result_array();
      if(!empty($result))
      {
         return $result[0]['total'];
      }else
      {
         return 0;
      }
  }

  public function getPackageAmount_m($package_id)
  {
      $result = $this->db->select('package_amount')->from('tbl_plan_master')->where(['status'=>1,'package_id'=>$package_id])->get()->result_array();
      if(!empty($result))
      {
         return $result[0]['package_amount'];
      }else
      {
         return 0;
      }
      
  }

  public function getPackageFund_m($package_id)
  {
      $result = $this->db->select('total_fund')->from('tbl_package_available_fund')->where(['status'=>1,'package_id'=>$package_id])->get()->result_array();
      if(!empty($result))
      {
         return $result[0]['total_fund'];
      }else
      {
         return 0;
      }
      
  }

  public function generateFundHistories_m($data)
  {
      return $this->db->insert('tbl_generate_fund_histories',$data);
  }

  public function updateGenerateFundAvailable_m($data,$where)
  {
      return $this->db->update('tbl_package_available_fund',$data,$where);
  }

  public function insertGenerateFundAvailable_m($data)
  {
      return $this->db->insert('tbl_package_available_fund',$data);
  }

  public function getGeneratedFundHistory_m($package_id)
  {
        if($package_id!="")
               $this->db->where(['h.package_id'=>$package_id]);

         return $this->db->select('p.package_name,h.package_id,h.qty,h.amount,h.total,DATE_FORMAT(h.c_date,"%d-%m-%Y %H:%i:%s") as gen_date,h.transaction_type')
         ->from('tbl_generate_fund_histories h')
         ->join('tbl_plan_master p','p.package_id = h.package_id','left')
         ->where(['h.status'=>1])->get()->result_array();
  }

  public function getAvailableFunds_m($package_id)
  {
        if($package_id!="")
               $this->db->where(['h.package_id'=>$package_id]);

         return $this->db->select('p.package_name,h.package_id,h.total_fund,DATE_FORMAT(h.d_date,"%d-%m-%Y %H:%i:%s") as last_update_date')
         ->from('tbl_package_available_fund h')
         ->join('tbl_plan_master p','p.package_id = h.package_id','left')
         ->where(['h.status'=>1])->get()->result_array();
  }




}
   
?>