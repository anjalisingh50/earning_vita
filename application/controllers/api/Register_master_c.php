<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Register_master_c extends REST_Controller 
{
   public function __construct()
   {
       parent::__construct();
     $this->load->model('Register_master_model');
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
            $num_rows = $this->Register_master_model->verifyRegisterExist($this->input->post('mobile',true),$this->input->post('email_id',true));
                if($num_rows>0)
               {
                  $this->response(['status'=>false,'data'=>[],'msg'=>'mobile or email already exist !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
                } 
                $number_rows = $this->Register_master_model->countSponser_Id($this->input->post('sponsor_id',true));
                
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
                  // $pin = mt_rand(1111,9999);
                  $dataArray['member_id']=$this->Register_master_model->getNewId();
                  $dataArray['name'] = $this->input->post('name',true);
                  $dataArray['email_id'] = $this->input->post('email_id',true);
                  $dataArray['f_h_name'] = $this->input->post('f_h_name',true);
                  $dataArray['mobile_no'] = $this->input->post('mobile_no',true);
                  $dataArray['gender'] = $this->input->post('gender',true);
                  $dataArray['sponsor_id'] = $dataArray['member_id'];
                  $dataArray['password'] = $pass;
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
                  $dataArray['c_by'] = $this->input->post('c_by',true);
                  $dataArray['c_date'] = date('Y-m-d H:i:s');
                  $dataArray['status'] = 1;
                  $this->Register_master_model->addUserData($dataArray);
                  $this->response(['status'=>true,'data'=>[],'msg'=>'successfully registered','response_code' => REST_Controller::HTTP_OK]); 
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
            $num_rows = $this->Register_master_model->verifyRegisterExist($this->input->post('mobile',true),$this->input->post('email_id',true));
                if($num_rows>0)
               {
                  $this->response(['status'=>false,'data'=>[],'msg'=>'mobile or email already exist !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
                } 
                $number_rows = $this->Register_master_model->countSponser_Id($this->input->post('sponsor_id',true));
                
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
                  $this->Register_master_model->updateUser($dataArray,['id'=>$this->input->post('id',true)]);
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
   
   // public function memberView_List_post()
   // {
   //    if($this->input->post('sponsor_id',true)=='')
   //    {
   //       $this->response(['status'=>false,'data'=>[],'msg'=>'sponsor_id required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
   //    }elseif($this->input->post('parent_id',true)=='')
   //    {
   //       $this->response(['status'=>false,'data'=>[],'msg'=>'parent_id required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
   //    }elseif($this->input->post('name',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'name required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('email_id',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'email_id required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('f_h_name',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'f_h_name required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('side',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'side required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('mobile_no',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'mobile_no required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('gender',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'gender required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('country',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'country required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('state',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'state required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('city',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'city required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('address',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'address required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('pin',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'pin required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('registration_date',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'registration_date required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('activation_date',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'activation_date required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('expiry_date',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'expiry_date required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('nominee_name',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'nominee_name required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('nominee_gender',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'nominee_gender required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('nominee_relation',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'nominee_relation required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('nominee_pan',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'nominee_pan required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('nominee_pan_img',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'nominee_pan_img required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('pan',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'pan required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('pan_img',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'pan_img required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('adhar',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'adhar required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('adhar_img_front',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'adhar_img_front required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('adhar_img_back',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'adhar_img_back required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('bank_name',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'bank_name required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('transaction_pin',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'transaction_pin required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('bank_ac',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'bank_ac required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('bank_ifsc',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'bank_ifsc required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('bank_passcheque_img',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'bank_passcheque_img required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('photo',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'photo required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('otp',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'otp required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('kyc_done_at',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'kyc_done_at required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }
   //    elseif($this->input->post('c_by',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'c_by required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }else{

   //       try{
   //          $num_rows = $this->Register_master_model->verifyRegisterExist($this->input->post('mobile',true),$this->input->post('email_id',true));
   //              if($num_rows>0)
   //             {
   //                $this->response(['status'=>false,'data'=>[],'msg'=>'mobile or email already exist !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
   //              }
   //                  $dataArray = [];
   //                  if (isset($_POST['nominee_pan_img']) && !empty($_POST['nominee_pan_img'])) 
   //                      {
   //                          $nominee_pan_img_incoded = $this->input->post('nominee_pan_img',true);
   //                          $imageData = base64_decode($nominee_pan_img_incoded);
   //                          $nominee_pan = uniqid() . '.jpg';

   //                          $nominee_pan_img_file = '../all-uploaded-img/img/' . $nominee_pan;
   //                          $success = file_put_contents(APPPATH . $nominee_pan_img_file, $imageData);
   //                          $dataArray['nominee_pan_img'] = $nominee_pan;
   //                      }
   //                  if (isset($_POST['pan_img']) && !empty($_POST['pan_img'])) 
   //                      {
   //                          $inside_image_incoded = $this->input->post('pan_img',true);
   //                          $imageData = base64_decode($inside_image_incoded);
   //                          $inside_image = uniqid() . '.jpg';

   //                          $inside_image_file = '../all-uploaded-img/img/' . $inside_image;
   //                          $success = file_put_contents(APPPATH . $inside_image_file, $imageData);
   //                          $dataArray['pan_img'] = $inside_image;
   //                      }

   //                  if (isset($_POST['adhar_img_front']) && !empty($_POST['adhar_img_front'])) 
   //                      {
   //                          $adhar_img_front_incoded = $this->input->post('adhar_img_front',true);
   //                          $imageData = base64_decode($adhar_img_front_incoded);
   //                          $adhar_image = uniqid() . '.jpg';

   //                          $adhar_image_file = '../all-uploaded-img/img/' . $adhar_image;
   //                          $success = file_put_contents(APPPATH . $adhar_image_file, $imageData);
   //                          $dataArray['adhar_img_front'] = $adhar_image;
   //                      }

   //                  if (isset($_POST['adhar_img_back']) && !empty($_POST['adhar_img_back'])) 
   //                      {
   //                          $adhar_img_back_incoded = $this->input->post('adhar_img_back',true);
   //                          $imageData = base64_decode($adhar_img_back_incoded);
   //                          $adhar_back_image = uniqid() . '.jpg';

   //                          $adhar_back_image_file = '../all-uploaded-img/img/' . $adhar_back_image;
   //                          $success = file_put_contents(APPPATH . $adhar_back_image_file, $imageData);
   //                          $dataArray['adhar_img_back'] = $adhar_back_image;
   //                      }

   //                  if (isset($_POST['bank_passcheque_img']) && !empty($_POST['bank_passcheque_img'])) 
   //                      {
   //                          $bank_passcheque_img_incoded = $this->input->post('bank_passcheque_img',true);
   //                          $imageData = base64_decode($bank_passcheque_img_incoded);
   //                          $bank_passcheque_img= uniqid() . '.jpg';

   //                          $bank_passcheque_img_file = '../all-uploaded-img/img/' . $bank_passcheque_img;
   //                          $success = file_put_contents(APPPATH . $bank_passcheque_img_file, $imageData);
   //                          $dataArray['bank_passcheque_img'] = $bank_passcheque_img;
   //                      }

   //                  if (isset($_POST['photo']) && !empty($_POST['photo'])) 
   //                      {
   //                          $photo_incoded = $this->input->post('photo',true);
   //                         // $inside_image = str_replace(' ', '+', $inside_image_incoded);
   //                          $imageData = base64_decode($photo_incoded);
   //                          $photo = uniqid() . '.jpg';

   //                          $photo_file = '../all-uploaded-img/img/' . $photo;
   //                          $success = file_put_contents(APPPATH . $photo_file, $imageData);
   //                          $dataArray['photo'] = $photo;
   //                      }
   //                /*Upload phpto*/

   //                $pass = mt_rand(111111,999999);
   //                $pin = mt_rand(1111,9999);
   //                $dataArray['member_id']=$this->Register_master_model->getNewId();
   //                $dataArray['parent_id'] = $this->input->post('parent_id',true);
   //                $dataArray['side'] = $this->input->post('side',true);
   //                $dataArray['sponsor_id'] = $dataArray['member_id'];
   //                $dataArray['title'] = $this->input->post('title',true);
   //                $dataArray['name'] = $this->input->post('name',true);
   //                $dataArray['gender'] = $this->input->post('gender',true);
   //                $dataArray['password'] = $pass;
   //                $dataArray['f_h_name'] = $this->input->post('f_h_name',true);
   //                $dataArray['country'] = $this->input->post('country',true);
   //                $dataArray['state'] = $this->input->post('state',true);
   //                $dataArray['city'] = $this->input->post('city',true);
   //                $dataArray['address'] = $this->input->post('address',true);
   //                $dataArray['pin'] = $pin;
   //                $dataArray['mobile_no'] = $this->input->post('mobile_no',true);
   //                $dataArray['email_id'] = $this->input->post('email_id',true);
   //                $dataArray['nominee_name'] = $this->input->post('nominee_name',true);
   //                $dataArray['nominee_gender'] = $this->input->post('nominee_gender',true);
   //                $dataArray['nominee_relation'] = $this->input->post('nominee_relation',true);
   //                $dataArray['nominee_pan'] = $this->input->post('nominee_pan',true);
   //                $dataArray['pan'] = $this->input->post('pan',true);
                  
   //                $dataArray['adhar'] = $this->input->post('adhar',true);
   //                $dataArray['bank_name'] = $this->input->post('bank_name',true);
   //                $dataArray['transaction_pin'] = $this->input->post('transaction_pin',true);
   //                $dataArray['bank_ac'] = $this->input->post('bank_ac',true);
   //                $dataArray['bank_ifsc'] = $this->input->post('bank_ifsc',true);
   //                $dataArray['registration_date'] = date('Y-m-d', strtotime($this->input->post('registration_date',true)));
   //                $dataArray['activation_date'] = date('Y-m-d', strtotime($this->input->post('activation_date',true)));
   //                $dataArray['expiry_date'] = date('Y-m-d', strtotime($this->input->post('expiry_date',true)));
   //                $dataArray['otp'] = date('Y-m-d',strtotime($this->input->post('otp',true)));
   //                $dataArray['c_by'] = $this->input->post('c_by',true);
   //                $dataArray['c_date'] = date('Y-m-d H:i:s');
   //                $dataArray['status'] = 1;
   //                $this->Register_master_model->addUserData($dataArray);
   //                $this->response(['status'=>true,'data'=>[],'msg'=>'successfully registered','response_code' => REST_Controller::HTTP_OK]);
   //               }else
   //                {
   //                 $this->response(['status'=>false,'data'=>[],'msg'=>'sponser_id not exist !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
   //               }
                
                
   //          }catch(Exception $e)
   //          {
   //              $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !'.$e->getMessage(),'response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
   //          }

   //      }
   //   }

   // public function updateUser_post()
   // {
   //    if($this->input->post('parent_id',true)=='')
   //    {
   //       $this->response(['status'=>false,'data'=>[],'msg'=>'parent_id required !','response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
   //    }elseif($this->input->post('side',true)=='')
   //    {
   //       $this->response(['status'=>false,'data'=>[],'msg'=>'side required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
   //    }elseif($this->input->post('sponsor_id',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'sponsor_id required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('name',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'name required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('gender',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'gender required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('f_h_name',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'f_h_name required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('country',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'country required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('state',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'state required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('city',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'city required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('address',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'address required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('mobile_no',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'mobile_no required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('email_id',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'email_id required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('nominee_name',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'nominee_name required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('nominee_gender',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'nominee_gender required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('nominee_relation',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'nominee_relation required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('nominee_pan',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'nominee_pan required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('nominee_pan_img',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'nominee_pan_img required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('pan',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'pan required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('pan_img',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'pan_img required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('adhar',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'adhar required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('adhar_img_front',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'adhar_img_front required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('adhar_img_back',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'adhar_img_back required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('bank_name',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'bank_name required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('transaction_pin',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'transaction_pin required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('bank_ac',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'bank_ac required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('bank_ifsc',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'bank_ifsc required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('bank_passcheque_img',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'bank_passcheque_img required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('photo',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'photo required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('registration_date',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'registration_date required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('activation_date',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'activation_date required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('expiry_date',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'expiry_date required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('otp',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'otp required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('otp_expire',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'otp_expire required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('kyc_status',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'kyc_status required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('kyc_done_at',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'kyc_done_at required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('log_status',true)=='')
   //    {
   //      $this->response(['status'=>false,'data'=>[],'msg'=>'log_status required !',
   //          'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
   //    }elseif($this->input->post('reg_id',true)=='')
   //      {
   //          $this->response(['status'=>false,'data'=>[],'msg'=>'reg_id required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
   //      }else{

   //       try{
   //          $num_rows = $this->Register_master_model->verifyMobileExist($this->input->post('reg_id',true),$this->input->post('mobile_no',true),$this->input->post('email_id',true));
   //              if($num_rows>0)
   //             {
   //                $this->response(['status'=>false,'data'=>[],'msg'=>'mobile or email already exist !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
   //              }
   //              $number_rows = $this->Register_master_model->countSponser_Id($this->input->post('sponsor_id',true));
                
   //              if($number_rows==1)

   //              {
   //                $dataArray = [];
   //                if (isset($_POST['nominee_pan_img']) && !empty($_POST['nominee_pan_img'])) 
   //                {
   //                         $nominee_pan_img_incoded = $this->input->post('nominee_pan_img',true);
   //                         // $inside_image = str_replace(' ', '+', $inside_image_incoded);
   //                         $imageData = base64_decode($nominee_pan_img_incoded);
   //                         $nominee_pan = uniqid() . '.jpg';

   //                   $nominee_pan_img_file = '../all-uploaded-img/img/' . $nominee_pan;
   //                   $success = file_put_contents(APPPATH . $nominee_pan_img_file, $imageData);
   //                   $dataArray['nominee_pan_img'] = $nominee_pan;
   //                }
   //                if (isset($_POST['pan_img']) && !empty($_POST['pan_img'])) 
   //                {
   //                         $inside_image_incoded = $this->input->post('pan_img',true);
   //                         // $inside_image = str_replace(' ', '+', $inside_image_incoded);
   //                         $imageData = base64_decode($inside_image_incoded);
   //                         $inside_image = uniqid() . '.jpg';

   //                   $inside_image_file = '../all-uploaded-img/img/' . $inside_image;
   //                   $success = file_put_contents(APPPATH . $inside_image_file, $imageData);
   //                   $dataArray['pan_img'] = $inside_image;
   //                }

   //                /*Upload Pan Image*/
   //                /*Upload Adhar_img_front*/
   //                if (isset($_POST['adhar_img_front']) && !empty($_POST['adhar_img_front'])) 
   //                {
   //                         $adhar_img_front_incoded = $this->input->post('adhar_img_front',true);
   //                         // $inside_image = str_replace(' ', '+', $inside_image_incoded);
   //                         $imageData = base64_decode($adhar_img_front_incoded);
   //                         $adhar_image = uniqid() . '.jpg';

   //                   $adhar_image_file = '../all-uploaded-img/img/' . $adhar_image;
   //                   $success = file_put_contents(APPPATH . $adhar_image_file, $imageData);
   //                   $dataArray['adhar_img_front'] = $adhar_image;
   //                }
   //                /*Upload Adhar_img_front*/

   //                /*Upload Adhar_img_back*/
   //                if (isset($_POST['adhar_img_back']) && !empty($_POST['adhar_img_back'])) 
   //                {
   //                         $adhar_img_back_incoded = $this->input->post('adhar_img_back',true);
   //                         // $inside_image = str_replace(' ', '+', $inside_image_incoded);
   //                         $imageData = base64_decode($adhar_img_back_incoded);
   //                         $adhar_back_image = uniqid() . '.jpg';

   //                   $adhar_back_image_file = '../all-uploaded-img/img/' . $adhar_back_image;
   //                   $success = file_put_contents(APPPATH . $adhar_back_image_file, $imageData);
   //                   $dataArray['adhar_img_back'] = $adhar_back_image;
   //                }
   //                if (isset($_POST['bank_passcheque_img']) && !empty($_POST['bank_passcheque_img'])) 
   //                {
   //                         $bank_passcheque_img_incoded = $this->input->post('bank_passcheque_img',true);
   //                         // $inside_image = str_replace(' ', '+', $inside_image_incoded);
   //                         $imageData = base64_decode($bank_passcheque_img_incoded);
   //                         $bank_passcheque_img= uniqid() . '.jpg';

   //                   $bank_passcheque_img_file = '../all-uploaded-img/img/' . $bank_passcheque_img;
   //                   $success = file_put_contents(APPPATH . $bank_passcheque_img_file, $imageData);
   //                   $dataArray['bank_passcheque_img'] = $bank_passcheque_img;
   //                }
   //                /*Upload Adhar_img_back*/

   //                /*Upload phpto*/
   //                if (isset($_POST['photo']) && !empty($_POST['photo'])) 
   //                {
   //                         $photo_incoded = $this->input->post('photo',true);
   //                         $imageData = base64_decode($photo_incoded);
   //                         $photo = uniqid() . '.jpg';

   //                   $photo_file = '../all-uploaded-img/img/' . $photo;
   //                   $success = file_put_contents(APPPATH . $photo_file, $imageData);
   //                   $dataArray['photo'] = $photo;
   //                }
   //                /*Upload phpto*/
   //                $pass = mt_rand(111111,999999);
   //                $pin = mt_rand(1111,9999);
   //                $dataArray['member_id']=$this->Register_master_model->getNewId();
   //                $dataArray['parent_id'] = $this->input->post('parent_id',true);
   //                $dataArray['side'] = $this->input->post('side',true);
   //                $dataArray['sponsor_id'] = $this->input->post('sponsor_id',true);
   //                $dataArray['title'] = $this->input->post('title',true);
   //                $dataArray['name'] = $this->input->post('name',true);
   //                $dataArray['gender'] = $this->input->post('gender',true);
   //                $dataArray['password'] = $pass;
   //                $dataArray['f_h_name'] = $this->input->post('f_h_name',true);
   //                $dataArray['country'] = $this->input->post('country',true);
   //                $dataArray['state'] = $this->input->post('state',true);
   //                $dataArray['city'] = $this->input->post('city',true);
   //                $dataArray['address'] = $this->input->post('address',true);
   //                $dataArray['pin'] = $pin;
   //                $dataArray['mobile_no'] = $this->input->post('mobile_no',true);
   //                $dataArray['email_id'] = $this->input->post('email_id',true);
   //                $dataArray['nominee_name'] = $this->input->post('nominee_name',true);
   //                $dataArray['nominee_gender'] = $this->input->post('nominee_gender',true);
   //                $dataArray['nominee_relation'] = $this->input->post('nominee_relation',true);
   //                $dataArray['nominee_pan'] = $this->input->post('nominee_pan',true);
   //                $dataArray['pan'] = $this->input->post('pan',true);
   //                $dataArray['adhar'] = $this->input->post('adhar',true);
   //                $dataArray['bank_name'] = $this->input->post('bank_name',true);
   //                $dataArray['transaction_pin'] = $this->input->post('transaction_pin',true);
   //                $dataArray['bank_ac'] = $this->input->post('bank_ac',true);
   //                $dataArray['bank_ifsc'] = $this->input->post('bank_ifsc',true);
   //                $dataArray['registration_date'] = date('Y-m-d', strtotime($this->input->post('registration_date',true)));
   //                $dataArray['activation_date'] = date('Y-m-d', strtotime($this->input->post('activation_date',true)));
   //                $dataArray['expiry_date'] = date('Y-m-d', strtotime($this->input->post('expiry_date',true)));
   //                $dataArray['otp'] = date('Y-m-d',strtotime($this->input->post('otp',true)));
   //                $dataArray['otp_expire'] = date('Y-m-d',strtotime($this->input->post('otp_expire',true)));
   //                $dataArray['kyc_status'] = $this->input->post('kyc_status',true);
   //                $dataArray['kyc_done_at'] = date('Y-m-d',strtotime($this->input->post('kyc_done_at',true)));
   //                $dataArray['log_status'] = $this->input->post('log_status',true);
   //                $dataArray['d_by'] = $this->input->post('c_by',true);
   //                $dataArray['d_date'] = date('Y-m-d H:i:s');
   //                $dataArray['status'] = 1;
   //                $this->Register_master_model->updateUser($dataArray,['id'=>$this->input->post('reg_id',true)]);
   //                }else
   //                {
   //                 $this->response(['status'=>false,'data'=>[],'msg'=>'sponser_id not exist !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
   //               }
                
   //          }catch(Exception $e)
   //          {
   //              $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
   //          }

   //      }

   // }
   public function getRegisterData_post()
    {
        try{
            $regId = $this->input->post('id',true)!=""?$this->input->post('id',true):"";
            $result = $this->Register_master_model->getRegisterData($regId);
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
                $this->Register_master_model->deleteRegister($dataArray,['id'=>$this->input->post('id',true)]);
                $this->response(['status'=>true,'data'=>$dataArray,'msg'=>'successfully deleted','response_code' => REST_Controller::HTTP_OK]);
                
            }catch(Exception $e)
            {
                $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
            }

        }
    }

    public function get_parent_id_post()
    {
      
      $result = $this->Register_master_model->countParentId_Id($this->input->post('sponsor_id',true));
      $this->response(['status'=>true,'data'=>$result,'msg'=>'successfully','response_code' => REST_Controller::HTTP_OK]);

    }
    


}
?>