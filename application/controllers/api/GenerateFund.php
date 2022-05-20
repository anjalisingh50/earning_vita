<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class GenerateFund extends REST_Controller 
{
   public function __construct()
   {
       parent::__construct();
     $this->load->model('GenerateFund_model');
   }


   public function generate_fund_post()
   {
        if($this->input->post('package_id',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'package_id required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('qty',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'qty required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('c_by',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'c_by required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {
            $package_id = $this->GenerateFund_model->verifyPackageExist_m($this->input->post('package_id',true));
            if($package_id>0)
            {

                $package_amount = $this->GenerateFund_model->getPackageAmount_m($this->input->post('package_id',true));

                $package_available_exist = $this->GenerateFund_model->verifyPackageAlreadyGeneareted_m($this->input->post('package_id',true));
                if($package_available_exist>0)
                {
                    $package_total_fund = $this->GenerateFund_model->getPackageFund_m($this->input->post('package_id',true));
                    $mainData = [];
                    $whereData = [];
                    $whereData['package_id'] = $this->input->post('package_id',true);
                    $mainData['total_fund'] = $package_total_fund+($package_amount*$this->input->post('qty',true));
                    $mainData['d_by'] = $this->input->post('c_by',true);
                    $mainData['d_date'] = date('Y-m-d H:i:s');
                    $mainData['status'] = 1;
                    $this->GenerateFund_model->updateGenerateFundAvailable_m($mainData,$whereData);

                    $mainHistory = [];
                    $mainHistory['package_id'] = $this->input->post('package_id',true);
                    $mainHistory['qty'] = $this->input->post('qty',true);
                    $mainHistory['amount'] = $package_amount;
                    $mainHistory['total'] = ($package_amount*$this->input->post('qty',true));
                    $mainHistory['c_date'] = date('Y-m-d H:i:s');
                    $mainHistory['c_by'] = $this->input->post('c_by',true);
                    $mainHistory['status'] = 1;
                    $mainHistory['transaction_type'] = 'IN';
                    $this->GenerateFund_model->generateFundHistories_m($mainHistory);
                    $this->response(['status'=>false,'data'=>[],'msg'=>'Successfully Fund Added !','response_code' => REST_Controller::HTTP_OK]);
                }else
                {
                    $mainData = [];
                    $mainData['package_id'] = $this->input->post('package_id',true);
                    $mainData['total_fund'] = ($package_amount*$this->input->post('qty',true));
                    $mainData['d_by'] = $this->input->post('c_by',true);
                    $mainData['d_date'] = date('Y-m-d H:i:s');
                    $mainData['status'] = 1;
                    $this->GenerateFund_model->insertGenerateFundAvailable_m($mainData);

                    $mainHistory = [];
                    $mainHistory['package_id'] = $this->input->post('package_id',true);
                    $mainHistory['qty'] = $this->input->post('qty',true);
                    $mainHistory['amount'] = $package_amount;
                    $mainHistory['total'] = ($package_amount*$this->input->post('qty',true));
                    $mainHistory['c_date'] = date('Y-m-d H:i:s');
                    $mainHistory['c_by'] = $this->input->post('c_by',true);
                    $mainHistory['status'] = 1;
                    $mainHistory['transaction_type'] = 'IN';
                    $this->GenerateFund_model->generateFundHistories_m($mainHistory);
                    $this->response(['status'=>false,'data'=>[],'msg'=>'Successfully Fund Added !','response_code' => REST_Controller::HTTP_OK]);
                }

            }else
            {
                $this->response(['status'=>false,'data'=>[],'msg'=>'Invalid package Id !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
            }
        }

   }

   public function get_generate_fund_history_post()
   {
        $package_id = $this->input->post('package_id',true)!=''?$this->input->post('package_id',true):'';
        $resultData = $this->GenerateFund_model->getGeneratedFundHistory_m($package_id);
        if(!empty($resultData))
        {
            $this->response(['status'=>false,'data'=>['histories'=>$resultData],'msg'=>'Successfully Fetched !','response_code' => REST_Controller::HTTP_OK]);
        }else
        {
            $this->response(['status'=>false,'data'=>['histories'=>$resultData],'msg'=>'No Record Found !','response_code' => REST_Controller::HTTP_OK]);
        }
        
   }

   public function get_available_fund_post()
   {
        $package_id = $this->input->post('package_id',true)!=''?$this->input->post('package_id',true):'';
        $resultData = $this->GenerateFund_model->getAvailableFunds_m($package_id);
        if(!empty($resultData))
        {
            $this->response(['status'=>false,'data'=>['package_fund'=>$resultData],'msg'=>'Successfully Fetched !','response_code' => REST_Controller::HTTP_OK]);
        }else
        {
            $this->response(['status'=>false,'data'=>['package_fund'=>$resultData],'msg'=>'No Record Found !','response_code' => REST_Controller::HTTP_OK]);
        }
        
   }


	
}
?>