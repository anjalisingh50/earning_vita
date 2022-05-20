<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Notification extends REST_Controller 
{
   public function __construct()
   {
       parent::__construct();
     $this->load->model('Notification_model');
   }
   public function addNotic_post()
   {
      if($this->input->post('remarks',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'remarks required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('from_date',true)==''){
         $this->response(['status'=>false,'data'=>[],'msg'=>'from_date required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('to_date',true)==''){
         $this->response(['status'=>false,'data'=>[],'msg'=>'to_date required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('visibility',true)==''){
         $this->response(['status'=>false,'data'=>[],'msg'=>'visibility required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
      }
      else{
         try{
            $data = [];
            $data['remarks'] = $this->input->post('remarks',true);
            $data['from_date'] = date('Y-m-d',strtotime($this->input->post('from_date',true)));
            $data['to_date'] = date('Y-m-d',strtotime($this->input->post('from_date',true)));
            $data['visibility'] = $this->input->post('visibility',true);
            $data['status'] = 1;
            $this->Notification_model->addRemarks($data);
            $this->response(['status'=>true,'data'=>$data,'msg'=>'successfully saved','response_code' => REST_Controller::HTTP_OK]);
                
         }catch(Exception $e)
            {
            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
            }

      }
   }
   public function updateNotic_post()
   {
      if($this->input->post('remarks',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'remarks required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('id',true)==''){
         $this->response(['status'=>false,'data'=>[],'msg'=>'id required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('from_date',true)==''){
         $this->response(['status'=>false,'data'=>[],'msg'=>'from_date required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('to_date',true)==''){
         $this->response(['status'=>false,'data'=>[],'msg'=>'to_date required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('visibility',true)==''){
         $this->response(['status'=>false,'data'=>[],'msg'=>'visibility required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
      }
      else{
         try{
            $data = [];
            $data['remarks'] = $this->input->post('remarks',true);
            $data['id'] = $this->input->post('id',true);
            $data['from_date'] = date('Y-m-d',strtotime($this->input->post('from_date',true)));
            $data['to_date'] = date('Y-m-d',strtotime($this->input->post('from_date',true)));
            $data['visibility'] = $this->input->post('visibility',true);
            $data['status'] = 1;
            $this->Notification_model->updateRemarks($data,['id'=>$this->input->post('id',true)]);
            $this->response(['status'=>true,'data'=>$data,'msg'=>'update successfully','response_code' => REST_Controller::HTTP_OK]);
                
         }catch(Exception $e)
            {
            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
            }

      }
   }
   public function getNotification_post()
    {
        try{
            $remarks = $this->input->post('remarks',true)!=""?$this->input->post('remarks',true):"";
            $data = $this->Notification_model->getRemarks($remarks);
            $this->response(['status'=>true,'data'=>$data,'msg'=>'successfully','response_code' => REST_Controller::HTTP_OK]);
        }catch(Exception $e)
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
        }
    }
     public function deleteNotification_post()
    {

        if($this->input->post('id',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'id required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {

            try{
                $dataArray = [];
                $dataArray['id'] = $this->input->post('id',true);
                $dataArray['status'] = 1;
                $this->Notification_model->deleteStage($dataArray,['id'=>$this->input->post('id',true)]);
                $this->response(['status'=>true,'data'=>$dataArray,'msg'=>'successfully deleted','response_code' => REST_Controller::HTTP_OK]);
                
            }catch(Exception $e)
            {
                $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
            }

        }
    }
    public function getVisible_post()
    {
        try{
            $remarks = $this->input->post('remarks',true)!=""?$this->input->post('remarks',true):"";
            $data = $this->Notification_model->getVisible($remarks);
            $this->response(['status'=>true,'data'=>$data,'msg'=>'successfully','response_code' => REST_Controller::HTTP_OK]);
        }catch(Exception $e)
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
        }
    }

}
?>
