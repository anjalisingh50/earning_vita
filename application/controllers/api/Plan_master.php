<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Plan_master extends REST_Controller 
{
   public function __construct()
   {
       parent::__construct();
     $this->load->model('Plan_Model');
   }
   public function getPlanList_post()
    {
        try{
            $planId = $this->input->post('id',true)!=""?$this->input->post('id',true):"";
            $result = $this->Plan_Model->getPlanList($planId);
            $this->response(['status'=>true,'data'=>$result,'msg'=>'successfully','response_code' => REST_Controller::HTTP_OK]);
        }catch(Exception $e)
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
        }
    }
   public function addPackage_post()
   {
      if($this->input->post('package_name',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'package_name required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('package_amount',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'package_amount required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('profit_perc',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'profit_perc required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('roi_perc',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'roi_perc required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('sponsor_income',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'sponsor_income required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('matching_perc',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'matching_perc required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('capping',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'capping required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('effected_from',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'effected_from required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('effected_to',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'effected_to required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }else{
         try{
               $num_rows = $this->Plan_Model->verifyPackage($this->input->post('package_id',true),$this->input->post('package_name',true));
               if($num_rows>0)
               {
                    $this->response(['status'=>false,'data'=>[],'msg'=>'package_name already exist !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
               }else{ 
                  $data = [];
                  $profit_percentage = ($this->input->post('package_amount',true)*$this->input->post('profit_perc',true)/100);
                  $total_return = ($this->input->post('package_amount',true)+$profit_percentage);
                  $roi_amount = ($this->input->post('package_amount',true)*$this->input->post('roi_perc',true)/100);

                  $days = ($total_return/$roi_amount);
                  $data['package_name'] = $this->input->post('package_name',true);
                  $data['package_amount'] = $this->input->post('package_amount',true);
                  $data['profit_perc'] = $this->input->post('profit_perc',true);
                  $data['roi_perc'] = $this->input->post('roi_perc',true);
                  $data['roi_amount'] = $roi_amount;
                  $data['sponsor_income_perc'] = $this->input->post('sponsor_income',true);
                  $data['matching_perc'] = $this->input->post('matching_perc',true);
                  $data['capping'] = $this->input->post('capping',true);
                  $data['effected_from'] = date('Y-m-d',strtotime($this->input->post('effected_from',true)));
                  $data['effected_to'] = date('Y-m-d',strtotime($this->input->post('effected_to',true)));
                  $data['total_return'] = $total_return;
                  $data['days'] = $days;
                  $data['c_by'] = $this->input->post('c_by',true);
                  $data['c_date'] = date('Y-m-d H:i:s');
                  $data['status'] = 1;         
                  $this->Plan_Model->addPackage($data);
               $this->response(['status'=>true,'data'=>[],'msg'=>'successfully saved','response_code' => REST_Controller::HTTP_OK]);
               }
         }catch(Exception $e)
            {
               $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !'.$e->getMessage(),'response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
            }
      }
   
   }

   public function updatePackage_post()
   {
      if($this->input->post('package_name',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'package_name required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('package_amount',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'package_amount required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('profit_perc',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'profit_perc required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('roi_perc',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'roi_perc required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('sponsor_income',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'sponsor_income required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('matching_perc',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'matching_perc required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('capping',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'capping required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('effected_from',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'effected_from required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('effected_to',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'effected_to required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('id',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'id required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }
      else{

            try{
                $num_rows = $this->Plan_Model->verifyPackage($this->input->post('id',true),$this->input->post('package_name',true));
                if($num_rows>0)
                {
                    $this->response(['status'=>false,'data'=>[],'msg'=>'package_name already exist !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
                }else{
                     $data = [];
                     $profit_percentage = ($this->input->post('package_amount',true)*$this->input->post('profit_perc',true)/100);
                     $total_return = ($this->input->post('package_amount',true)+$profit_percentage);
                     $roi_amount = ($this->input->post('package_amount',true)*$this->input->post('roi_perc',true)/100);

                     $days = ($total_return/$roi_amount);
                     $data['package_name'] = $this->input->post('package_name',true);
                     $data['package_amount'] = $this->input->post('package_amount',true);
                     $data['profit_perc'] = $this->input->post('profit_perc',true);
                     $data['roi_perc'] = $this->input->post('roi_perc',true);
                     $data['roi_amount'] = $roi_amount;
                     $data['sponsor_income_perc'] = $this->input->post('sponsor_income',true);
                     $data['matching_perc'] = $this->input->post('matching_perc',true);
                     $data['capping'] = $this->input->post('capping',true);
                     $data['d_by'] = $this->input->post('d_by',true);
                     $data['effected_from'] = date('Y-m-d',strtotime($this->input->post('effected_from',true)));
                     $data['effected_to'] = date('Y-m-d',strtotime($this->input->post('effected_to',true)));
                     $data['total_return'] = $total_return;
                     $data['days'] = $days;
                     $data['d_date'] = date('Y-m-d H:i:s');
                     $data['status'] = 1;         
                     $this->Plan_Model->updatePackage($data,['id'=>$this->input->post('id',true)]);
                     
                  
                     $this->response(['status'=>true,'data'=>[],'msg'=>'successfully updated','response_code' => REST_Controller::HTTP_OK]);
                     
                  }
                  }catch(Exception $e)
                  {
                  $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !'.$e->getMessage(),'response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
                  }

        }
   }
  
   
     public function deletePlan_post()
    {

        if($this->input->post('id',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'id required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {

            try{
               $dataArray = [];
               $dataArray['id'] = $this->input->post('id',true);
               $dataArray['d_by'] = $this->input->post('d_by');
               $dataArray['d_date'] = date('Y-m-d H:i:s');
               $dataArray['status'] = 0;
                $this->Plan_Model->deletePlan($dataArray,['id'=>$this->input->post('id',true)]);
                $this->response(['status'=>true,'data'=>[],'msg'=>'successfully deleted','response_code' => REST_Controller::HTTP_OK]);
                
            }catch(Exception $e)
            {
                $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
            }

        }
    }
   

}
?>
