<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Login_c extends REST_Controller 
{
   public function __construct()
   {
       parent::__construct();
     $this->load->model('Login_model');
   }
   public function checkLogin_post()
   {
   	if($this->input->post('member_id',true)=='')
   	{
   		$this->response(['status'=>false,'data'=>[],'msg'=>'member_id required !',
   			'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
   	}elseif($this->input->post('password',true)=='')
   	{
   		$this->response(['status'=>false,'data'=>[],'msg'=>'password required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
   	}else{
   		try{
                $userLog = $this->Login_model->verifyMemberIdExist($this->input->post('member_id',true));
                 $pass=md5(trim($this->input->post('password',true)));  
                 
               if(empty($userLog))
               {
                    $this->response(['status'=>false,'data'=>[],'msg'=>'member_id Or Password Wrong 1 !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
               }else
               {
                    if($pass== md5(trim($userLog[0]['password'])))
                    {
                            
                        $userData = $this->Login_model->getUserData($userLog[0]['id']); 
                        $this->response(['status'=>true,'data'=>$userData,'msg'=>'successfully registered','response_code' => REST_Controller::HTTP_OK]);
                    }else
                    {
                        $this->response(['status'=>false,'data'=>[],'msg'=>'member_id Or Password Wrong 2 !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);                        
                    }  
                    
               }
                
            }catch(Exception $e)
            {
                $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !'.$e->getMessage(),'response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
            }

   	}
   }
 
    public function getMember_Name_post()
    {
        try{
            $member_id = $this->input->post('member_id',true)!=""?$this->input->post('member_id',true):"";
            $result = $this->Login_model->getMemberName($member_id);
            $this->response(['status'=>true,'data'=>$result,'msg'=>'successfully','response_code' => REST_Controller::HTTP_OK]);
        }catch(Exception $e)
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
        }
    }
    public function countReg_post()
    { 
        if($this->input->post('email_id',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'email_id required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif ($this->input->post('mobile_no',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'mobile_no required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }else{
            try{
               
                $email_id = $this->input->post('email_id');
                $mobile_no = $this->input->post('mobile_no');
                $result = $this->Login_model->countEmail_Id($email_id,$mobile_no);
                if($result>0)
                {
                    $this->response(['status'=>true,'data'=>$result,'msg'=>'Already Exist !','response_code' => REST_Controller::HTTP_OK]);
                }else
                {
                    $this->response(['status'=>true,'data'=>$result,'msg'=>'Not Available','response_code' => REST_Controller::HTTP_OK]);
                }
                

            }catch(Exception $e)
            {
                 $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !'.$e->getMessage(),'response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);


            }
            }
        
    }
	
}
?>