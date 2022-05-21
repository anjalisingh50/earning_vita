<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Member extends REST_Controller 
{
   public function __construct()
   {
       parent::__construct();
     $this->load->model('Member_model');
   }

   public function addMember_post()
   {
     if($this->input->post('name',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'name required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('email_id',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'email_id required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('f_h_name',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'f_h_name required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
      }elseif($this->input->post('mobile_no',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'mobile_no required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
      }elseif($this->input->post('gender',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'gender required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
      }elseif($this->input->post('sponsor_id',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'sponsor_id required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
      }elseif($this->input->post('side',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'side required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
      }elseif($this->input->post('country',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'country required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
      }elseif($this->input->post('state',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'state required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
      }elseif($this->input->post('city',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'city required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
      }elseif($this->input->post('pin',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'pin required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('address',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'address required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }
      else{

         try{
            $num_rows = $this->Member_model->verifyRegisterExist($this->input->post('mobile',true),$this->input->post('email_id',true));
                if($num_rows>0)
               {
                  $this->response(['status'=>false,'data'=>[],'msg'=>'mobile or email already exist !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
                } 
                $number_rows = $this->Member_model->countSponser_Id($this->input->post('sponsor_id',true));
                
                if($number_rows==1)

                {
                  $dataArray=[];
                  if (isset($_POST['photo']) && !empty($_POST['photo'])) 
                  {
                           $photo_incoded = $this->input->post('photo',true);
                           // $inside_image = str_replace(' ', '+', $inside_image_incoded);
                           $imageData = base64_decode($photo_incoded);
                           $photo = uniqid() . '.jpg';

                     $photo_file = '../all-uploaded-img/img/' . $photo;
                     $success = file_put_contents(APPPATH . $photo_file, $imageData);
                     $dataArray['photo'] = $photo;
                  }


                  $pass = mt_rand(111111,999999);
                  $dataArray['member_id']=$this->Member_model->getNewId();
                  $dataArray['parent_id'] = $this->get_parent_id($this->input->post('sponsor_id',true),$this->input->post('side',true));
                  $dataArray['name'] = $this->input->post('name',true);
                  $dataArray['email_id'] = $this->input->post('email_id',true);
                  $dataArray['f_h_name'] = $this->input->post('f_h_name',true);
                  $dataArray['mobile_no'] = $this->input->post('mobile_no',true);
                  $dataArray['gender'] = $this->input->post('gender',true);
                  $dataArray['sponsor_id'] = $this->input->post('sponsor_id',true);
                  $dataArray['password'] = md5($pass);
                  $dataArray['side'] = $this->input->post('side',true);
                  $dataArray['title'] = $this->input->post('title',true);
                  $dataArray['country'] = $this->input->post('country',true);
                  $dataArray['state'] = $this->input->post('state',true);
                  $dataArray['city'] = $this->input->post('city',true);
                  $dataArray['address'] = $this->input->post('address',true);
                  $dataArray['pin'] = $this->input->post('pin',true);
                  $dataArray['registration_date'] = date('Y-m-d H:i:s');
                  $dataArray['c_by'] = $this->input->post('c_by',true);
                  $dataArray['c_date'] = date('Y-m-d H:i:s');
                  $dataArray['status'] = 1;
                  $this->Member_model->addUserData($dataArray);
                  $this->response(['status'=>true,'data'=>['password'=>$pass],'msg'=>'successfully registered','response_code' => REST_Controller::HTTP_OK]); 
                }else
                  {
                   $this->response(['status'=>false,'data'=>[],'msg'=>'sponser_id not exist !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
                 }
                
            }catch(Exception $e)
            {
                $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
            }
            

        }      
   }


   public function get_parent_id($parent_id,$side)
    {

        $tmp_parent_id = $parent_id;
        while(true)
        {
            $result = $this->Member_model->getparentId($tmp_parent_id,$side);
            if($result==200)
            {
                $parent_id = $parent_id;
                break;
            }else
            {
                $tmp_parent_id = $result;
            }
            
        }
        return $tmp_parent_id;
    }


   public function updateMember_post(){
    if($this->input->post('name',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'name required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('email_id',true)=='')
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'email_id required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('f_h_name',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'f_h_name required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
      }elseif($this->input->post('mobile_no',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'mobile_no required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
      }elseif($this->input->post('gender',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'gender required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
      }elseif($this->input->post('sponsor_id',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'sponsor_id required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
      }elseif($this->input->post('side',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'side required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
      }elseif($this->input->post('country',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'country required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
      }elseif($this->input->post('state',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'state required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
      }elseif($this->input->post('city',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'city required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
      }elseif($this->input->post('pin',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'pin required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('registration_date',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'registration_date required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('activation_date',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'activation_date required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('expiry_date',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'expiry_date required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('address',true)=='')
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'address required !',
            'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
      }
      else{

         try{
            $num_rows = $this->Member_model->verifyRegisterExist($this->input->post('mobile',true),$this->input->post('email_id',true));
                if($num_rows>0)
               {
                  $this->response(['status'=>false,'data'=>[],'msg'=>'mobile or email already exist !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
                } 
                $number_rows = $this->Member_model->countSponser_Id($this->input->post('sponsor_id',true));
                
                if($number_rows==1)

                {
                  $dataArray=[];
                  if (isset($_POST['photo']) && !empty($_POST['photo'])) 
                  {
                           $photo_incoded = $this->input->post('photo',true);
                           // $inside_image = str_replace(' ', '+', $inside_image_incoded);
                           $imageData = base64_decode($photo_incoded);
                           $photo = uniqid() . '.jpg';

                     $photo_file = '../all-uploaded-img/img/' . $photo;
                     $success = file_put_contents(APPPATH . $photo_file, $imageData);
                     $dataArray['photo'] = $photo;
                  }
                  $dataArray['name'] = $this->input->post('name',true);
                  $dataArray['email_id'] = $this->input->post('email_id',true);
                  $dataArray['f_h_name'] = $this->input->post('f_h_name',true);
                  $dataArray['mobile_no'] = $this->input->post('mobile_no',true);
                  $dataArray['gender'] = $this->input->post('gender',true);
                  $dataArray['sponsor_id'] = $this->input->post('sponsor_id',true);
                  $dataArray['side'] = $this->input->post('side',true);
                  $dataArray['title'] = $this->input->post('title',true);
                  $dataArray['country'] = $this->input->post('country',true);
                  $dataArray['state'] = $this->input->post('state',true);
                  $dataArray['city'] = $this->input->post('city',true);
                  $dataArray['address'] = $this->input->post('address',true);
                  $dataArray['pin'] = $this->input->post('pin',true);
                  $dataArray['registration_date'] = date('Y-m-d', strtotime($this->input->post('registration_date',true)));
                  $dataArray['activation_date'] = date('Y-m-d', strtotime($this->input->post('activation_date',true)));
                  $dataArray['expiry_date'] = date('Y-m-d', strtotime($this->input->post('expiry_date',true)));
                  $dataArray['d_by'] = $this->input->post('d_by',true);
                  $dataArray['d_date'] = date('Y-m-d H:i:s');
                  $dataArray['status'] = 1;
                  $this->Member_model->updateUser($dataArray,['id'=>$this->input->post('id',true)]);
                  $this->response(['status'=>true,'data'=>$dataArray,'msg'=>'successfully Updated','response_code' => REST_Controller::HTTP_OK]); 
                }else
                  {
                   $this->response(['status'=>false,'data'=>[],'msg'=>'sponser_id not exist !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
                 }
                
            }catch(Exception $e)
            {
                $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
            }
            

        }    
   }
   
   public function getRegisterData_post()
    {
        try{
            $regId = $this->input->post('id',true)!=""?$this->input->post('id',true):"";
            $result = $this->Member_model->getRegisterData($regId);
            $this->response(['status'=>true,'data'=>$result,'msg'=>'successfully','response_code' => REST_Controller::HTTP_OK]);
        }catch(Exception $e)
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
        }
    }
    public function deleteRegister_post()
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
                $this->Member_model->deleteRegister($dataArray,['id'=>$this->input->post('id',true)]);
                $this->response(['status'=>true,'data'=>$dataArray,'msg'=>'successfully deleted','response_code' => REST_Controller::HTTP_OK]);
                
            }catch(Exception $e)
            {
                $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
            }

        }
    }
    
    public function get_parent_id_post()
    {
      
      $result = $this->Member_model->countParentId_Id($this->input->post('sponsor_id',true));
      $this->response(['status'=>true,'data'=>$result,'msg'=>'successfully','response_code' => REST_Controller::HTTP_OK]);
    }


    public function verify_mobile_post()
    {
        if($this->input->post('mobile',true)=='')
        {
             $this->response(['status'=>false,'data'=>[],'msg'=>'mobile required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {
            $num_rows = $this->Member_model->verifyRegisterMobileExist($this->input->post('mobile',true));
            if($num_rows>0)
            {
                $this->response(['status'=>false,'data'=>[],'msg'=>'mobile already exist !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {
                $this->response(['status'=>true,'data'=>[],'msg'=>'Successfully verified !','response_code' => REST_Controller::HTTP_OK]);
            } 
        }
        
    }

    public function verify_email_post()
    {
        if($this->input->post('email',true)=='')
        {
             $this->response(['status'=>false,'data'=>[],'msg'=>'email required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {
            $num_rows = $this->Member_model->verifyRegisterEmailExist($this->input->post('email',true));
            if($num_rows>0)
            {
                $this->response(['status'=>false,'data'=>[],'msg'=>'email already exist !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {
                $this->response(['status'=>true,'data'=>[],'msg'=>'Successfully verified !','response_code' => REST_Controller::HTTP_OK]);
            } 
        }
        
    }

    public function verify_member_post()
    {
        if($this->input->post('member_id',true)=='')
        {
             $this->response(['status'=>false,'data'=>[],'msg'=>'member_id required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {
            $num_rows = $this->Member_model->verifyRegisterMemberExist($this->input->post('member_id',true));
            if($num_rows>0)
            {
                $this->response(['status'=>true,'data'=>[],'msg'=>'Successfully verified !','response_code' => REST_Controller::HTTP_OK]);
            }else
            {
                $this->response(['status'=>false,'data'=>[],'msg'=>'Invalid member Id !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
            } 
        }
        
    }


    


}
?>