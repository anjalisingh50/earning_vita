<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Side_List extends REST_Controller 
{
   public function __construct()
   {
       parent::__construct();
     $this->load->model('Side_model');
   }
   public function getLeftList_post()
    {
        try{
            $parent_id = $this->input->post('parent_id',true)!=""?$this->input->post('parent_id',true):"";
            $data=[];
            $data['parent_id'] = $parent_id;
            $data['left']= $this->Side_model->getLeft_List($parent_id);
            $data['total_Left']= $this->Side_model->get_Leftside_m();
            $data['right']= $this->Side_model->getRight_List($parent_id);
            $data['total_right']= $this->Side_model->get_Rightside_m(); 
            $this->response(['status'=>true,'data'=>$data, 'msg'=>'successfully','response_code' => REST_Controller::HTTP_OK]);
        }catch(Exception $e)
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
        }
    }
}