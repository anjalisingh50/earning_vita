<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Activation_Master extends REST_Controller 
{
   public function __construct()
   {
       parent::__construct();
     $this->load->model('Activation_Master_M');
   }
   public function addActivation_post()
   {
      if($this->input->post('package_id',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'package_id required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('parent_id',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'parent_id required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('side',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'side required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('activation_date_time',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'activation_date_time required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('package_amount',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'package_amount required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('maturity_amount',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'maturity_amount required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('daily_roi',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'daily_roi required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('days_roi',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'days_roi required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('sponsor_income_id',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'sponsor_income_id required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('sponsor_income_amount',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'sponsor_income_amount required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('effect_from',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'effect_from required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('effect_to',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'effect_to required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('effect_to',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'effect_to required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }else{
         $dataArray = [];
         $dataArray['package_id'] = $this->input->post('package_id',true);
         $dataArray['parent_id'] = $this->input->post('parent_id',true);
         $dataArray['side'] = $this->input->post('side',true);
         $dataArray['activation_date_time'] = date('Y-m-d',strtotime($this->input->post('activation_date_time',true)));
         $dataArray['package_amount'] = $this->input->post('package_amount',true);
         $dataArray['maturity_amount'] = $this->input->post('maturity_amount',true);
         $dataArray['daily_roi'] = $this->input->post('daily_roi',true);
         $dataArray['days_roi'] = $this->input->post('days_roi',true);
         $dataArray['sponsor_income_id'] = $this->input->post('sponsor_income_id',true);
         $dataArray['sponsor_income_amount'] = $this->input->post('sponsor_income_amount',true);
         $dataArray['effect_from'] = date('Y-m-d',strtotime($this->input->post('effect_from',true)));
         $dataArray['effect_to'] = date('Y-m-d',strtotime($this->input->post('effect_to',true)));
         $dataArray['c_by'] = $this->input->post('c_by',true);
         $dataArray['c_date'] = date('Y-m-d h:i:s');
         $dataArray['status'] = 1;
         $this->Activation_Master_M->addActivation($dataArray);
         {
         $this->response(['status'=>true,'data'=>$dataArray,'msg'=>'successfully saved','response_code'=>REST_Controller::HTTP_OK]);
         }
         {
         $this->response(['status'=>false,'data'=>[],'msg'=>[],'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
         }
   }
}
public function updateActivation_post()
   {
      if($this->input->post('package_id',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'package_id required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('parent_id',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'parent_id required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('side',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'side required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('activation_date_time',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'activation_date_time required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('package_amount',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'package_amount required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('maturity_amount',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'maturity_amount required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('daily_roi',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'daily_roi required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('days_roi',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'days_roi required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('sponsor_income_id',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'sponsor_income_id required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('sponsor_income_amount',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'sponsor_income_amount required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('effect_from',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'effect_from required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('effect_to',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'effect_to required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('effect_to',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'effect_to required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('id',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'id required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
      }
      else{
         $dataArray = [];
         $dataArray['package_id'] = $this->input->post('package_id',true);
         $dataArray['parent_id'] = $this->input->post('parent_id',true);
         $dataArray['side'] = $this->input->post('side',true);
         $dataArray['id'] = $this->input->post('id',true);
         $dataArray['activation_date_time'] = date('Y-m-d',strtotime($this->input->post('activation_date_time',true)));
         $dataArray['package_amount'] = $this->input->post('package_amount',true);
         $dataArray['maturity_amount'] = $this->input->post('maturity_amount',true);
         $dataArray['daily_roi'] = $this->input->post('daily_roi',true);
         $dataArray['days_roi'] = $this->input->post('days_roi',true);
         $dataArray['sponsor_income_id'] = $this->input->post('sponsor_income_id',true);
         $dataArray['sponsor_income_amount'] = $this->input->post('sponsor_income_amount',true);
         $dataArray['effect_from'] = date('Y-m-d',strtotime($this->input->post('effect_from',true)));
         $dataArray['effect_to'] = date('Y-m-d',strtotime($this->input->post('effect_to',true)));
         $dataArray['c_by'] = $this->input->post('c_by',true);
         $dataArray['c_date'] = date('Y-m-d h:i:s');
         $dataArray['status'] = 1;
         $this->Activation_Master_M->updateActivation($dataArray,['id'=>$this->input->post('id',true)]);
         {
         $this->response(['status'=>true,'data'=>$dataArray,'msg'=>'successfully updated','response_code'=>REST_Controller::HTTP_OK]);
         }
         {
         $this->response(['status'=>false,'data'=>[],'msg'=>[],'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
         }
      }
   }
   public function getActivation_post()
   {
        try{
            $id = $this->input->post('id',true)!=""?$this->input->post('id',true):"";
            $data = $this->Activation_Master_M->getActivation($id);
            $this->response(['status'=>true,'data'=>$data,'msg'=>'successfully','response_code' => REST_Controller::HTTP_OK]);
        }catch(Exception $e)
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
        }
   }
   public function deleteActivation_post()
    {

        if($this->input->post('id',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'id required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('d_by',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'d_by required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }
        else
        {

            try{
                $dataArray = [];
                $dataArray['d_by'] = $this->input->post('d_by',true);
                $dataArray['status'] = 0;
                $this->Activation_Master_M->deleteActivation($dataArray,['id'=>$this->input->post('id',true)]);
                $this->response(['status'=>true,'data'=>$dataArray,'msg'=>'successfully deleted','response_code' => REST_Controller::HTTP_OK]);
                
            }catch(Exception $e)
            {
                $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
            }

        }
    }
}
?>