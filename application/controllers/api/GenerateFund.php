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
        }elseif($this->input->post('qty',true))
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'member_id required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('c_by',true))
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'member_id required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }
   }
   


	
}
?>