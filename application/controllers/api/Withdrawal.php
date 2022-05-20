<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Withdrawal extends REST_Controller 
{
   public function __construct()
   {
       parent::__construct();
     $this->load->model('Withdrawal_Model');
   }
   public function createWithdrawal_post(){
      if($this->input->post('member_id',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'member_id required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('request_date',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'request_date required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('available_balance',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'available_balance required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('allowed_balance',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'allowed_balance required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('requested_amount',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'requested_amount required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('requested_by',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'requested_by required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('admin_charge',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'admin_charge required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('withdrawal_amount',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'withdrawal_amount required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('transfer_status',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'transfer_status required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('transfer_date',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'transfer_date required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('transfer_amount',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'transfer_amount required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('transfer_mode',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'transfer_mode required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('transfer_address',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'transfer_address required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('transaction_rcpt_no',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'transaction_rcpt_no required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('transfer_description',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'transfer_description required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('transfer_by',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'transfer_by required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('final_balance',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'final_balance required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('c_by',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'c_by required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }else{
         try{
            $num_rows = $this->Withdrawal_Model->countMember_Id($this->input->post('member_id',true));
                if($num_rows==1)
                {
                  $data = [];
                  $data['member_id'] = $this->input->post('member_id',true);
                  $data['request_date'] = date('Y-m-d',strtotime($this->input->post('request_date',true)));
                  $data['available_balance'] = $this->input->post('available_balance',true);
                  $data['allowed_balance'] = $this->input->post('allowed_balance',true);
                  $data['requested_amount'] = $this->input->post('requested_amount',true);
                  $data['requested_by'] = $this->input->post('requested_by',true);
                  $data['admin_charge'] = $this->input->post('admin_charge',true);
                  $data['withdrawal_amount'] = $this->input->post('withdrawal_amount',true);
                  $data['transfer_status'] = 1;
                  $data['transfer_date'] = date('Y-m-d',strtotime($this->input->post('transfer_date',true)));
                  $data['transfer_amount'] = $this->input->post('transfer_amount',true);
                  $data['transfer_mode'] = $this->input->post('transfer_mode',true);
                  $data['transfer_address'] = $this->input->post('transfer_address',true);
                  $data['transaction_rcpt_no'] = $this->input->post('transaction_rcpt_no',true);
                  $data['transfer_description'] = $this->input->post('transfer_description',true);
                  $data['transfer_by'] = $this->input->post('transfer_by',true);
                  $data['final_balance'] = $this->input->post('final_balance',true);
                  $data['c_by'] = $this->input->post('c_by',true);
                  $data['c_date'] = date('Y-m-d H:i:s');
                  $data['status'] = 1;
                  $result = $this->Withdrawal_Model->insertWithdrawal($data);
                  $this->response(['status'=>true,'data'=>$result,'msg'=>'successfully Withdrawal','response_code' => REST_Controller::HTTP_OK]);
                 }else
                  {
                  $this->response(['status'=>false,'data'=>[],'msg'=>'sponser_id already exist !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
                }
            }catch(Exception $e)
            {
                $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !'.$e->getMessage(),'response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
            }
      }
   }
   public function updateWithdrawal_post(){
      if($this->input->post('member_id',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'member_id required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('request_date',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'request_date required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('available_balance',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'available_balance required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('allowed_balance',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'allowed_balance required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('requested_amount',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'requested_amount required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('requested_by',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'requested_by required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('admin_charge',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'admin_charge required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('withdrawal_amount',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'withdrawal_amount required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('transfer_status',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'transfer_status required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('transfer_date',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'transfer_date required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('transfer_amount',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'transfer_amount required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('transfer_mode',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'transfer_mode required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('transfer_address',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'transfer_address required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('transaction_rcpt_no',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'transaction_rcpt_no required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('transfer_description',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'transfer_description required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('transfer_by',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'transfer_by required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('final_balance',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'final_balance required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('withdrawal_id',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'withdrawal_id required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }
      elseif($this->input->post('d_by',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'d_by required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }else{
         try{
            $num_rows = $this->Withdrawal_Model->countverifyMember_Id($this->input->post('member_id',true),$this->input->post('withdrawal_id',true));
                if($num_rows==1)
                  {
                  $this->response(['status'=>false,'data'=>[],'msg'=>'member_id already exist !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
                }else
                {
                  $data = [];
                  $data['member_id'] = $this->input->post('member_id',true);
                  $data['request_date'] = date('Y-m-d',strtotime($this->input->post('request_date',true)));
                  $data['available_balance'] = $this->input->post('available_balance',true);
                  $data['allowed_balance'] = $this->input->post('allowed_balance',true);
                  $data['requested_amount'] = $this->input->post('requested_amount',true);
                  $data['requested_by'] = $this->input->post('requested_by',true);
                  $data['admin_charge'] = $this->input->post('admin_charge',true);
                  $data['withdrawal_amount'] = $this->input->post('withdrawal_amount',true);
                  $data['transfer_status'] = 1;
                  $data['transfer_date'] = date('Y-m-d',strtotime($this->input->post('transfer_date',true)));
                  $data['transfer_amount'] = $this->input->post('transfer_amount',true);
                  $data['transfer_mode'] = $this->input->post('transfer_mode',true);
                  $data['transfer_address'] = $this->input->post('transfer_address',true);
                  $data['transaction_rcpt_no'] = $this->input->post('transaction_rcpt_no',true);
                  $data['transfer_description'] = $this->input->post('transfer_description',true);
                  $data['transfer_by'] = $this->input->post('transfer_by',true);
                  $data['final_balance'] = $this->input->post('final_balance',true);
                  $data['d_by'] = $this->input->post('d_by',true);
                  $data['d_date'] = date('Y-m-d H:i:s');
                  $data['status'] = 1;
                  $result = $this->Withdrawal_Model->updateWithdrawal($data,['id'=>$this->input->post('withdrawal_id',true)]);
                  $this->response(['status'=>true,'data'=>$result,'msg'=>'successfully updated','response_code' => REST_Controller::HTTP_OK]);
                 }
            }catch(Exception $e)
            {
                $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !'.$e->getMessage(),'response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
            }
      }
   }
   public function deleteUser_post()
    {
        if($this->input->post('d_by',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'d_by required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('withdrawal_id',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'withdrawal_id required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {

            try{
                $dataArray = [];
                $dataArray['d_by'] = $this->input->post('d_by',true);
                $dataArray['d_date'] = date('Y-m-d H:i:s');
                $dataArray['status'] = 0;
                $this->Withdrawal_Model->updateWithdrawal($dataArray,['id'=>$this->input->post('withdrawal_id',true)]);
                $this->response(['status'=>true,'data'=>[],'msg'=>'successfully deleted','response_code' => REST_Controller::HTTP_OK]);
                
            }catch(Exception $e)
            {
                $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
            }

        }
    }
}
?>