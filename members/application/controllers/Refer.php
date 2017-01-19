<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Refer extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->helper('cookie');
	    $this->load->library(array('form_validation','session'));
		//$this->load->library('encrypt');
		$this->load->model('user_model');
		$this->load->model('fetch_model');
		 function isEmail($email)
				{
				//If the username input string is an e-mail, return true
				if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
					return true;
				} else {
					return false;
				}
	        }//function end
		
	 }


public function index($hash_key=NULL)
	  {
	  		
	  		$refer_data=$this->user_model->getReferData($hash_key);		
	  		
			$title= 'WeGotPlayers';
			$gender = array('1' =>'Male' ,'2'=>'Female');
			$occupation =$this->fetch_model->getOccupation();
			$level = $this->fetch_model->getCoachLevel();	

		    $data = array('title' => $title,'occupation'=>$occupation,
		    			'gender'=>$gender,'level'=>$level,'refer_data'=>$refer_data);	  	
	  		$this->load->view("header",$data);
			$this->load->view("refer_player_view",$data);
			$this->load->view('footer_out_view');			
			$this->load->view("footer");	
	  }//Index function End
  
  public function updateReference()
  {  		
  		$refer_user_id = $this->input->post('refer_user_id');
		$name  = $this->input->post('name');
		$email = strtolower($this->input->post('email'));		
		$level = $this->input->post('level');
		$occupation = $this->input->post('occupation');
		$organization  = $this->input->post('organization');
		$phone = $this->input->post('phone');
		$comment  = $this->input->post('comments');
		$registered_status = $this->input->post('registered_status');
		$password =md5(md5($this->input->post('password')));

		$data = array('refere_for_user_id' =>$refer_user_id, 'name'=>$name,
					  'phone'=>$phone,'level'=>$level,'occupation'=>$occupation,
					  'organization'=>$organization,'comment'=>$comment,'status'=>1);

		if($registered_status==0){	

		    $login_name_ary = explode('@',$email);	
		    $login_name = $login_name_ary[0];		    
			$reg_code  = md5(time());
			$id = mt_rand(100000, 999999);
			$id_u = mt_rand(100, 999);					
			$user_data=array('unique_code'=>$id,
                            'name'=>$name,														
							'email'=>$email,	
							'login_name'=>$login_name.'.'.$id_u,								 
							'password'=>$password,
							'registration_type'=>2,
							'verify_hash' => $reg_code,	
							'remote_addr'=>($_SERVER['REMOTE_ADDR']), 
							);
			
			//calling the registration module
			$success= $this->user_model->registerUser($user_data);
			if($success){

				$reg_email=$email;						    
				$url=base_url()."user/emailverification/".$reg_code;
									
				$to=$reg_email;
				$to =  strip_tags("$to");									
				$from='akhileshsingh91@gmail.com';
				$from =  strip_tags("$from");									
				$subject='Confirm your WeGotPlayer Account';	
									
				$headers = "from: WeGotPlayer<".$from.">\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";														  
				$message  = '<html><body>';
				$message .= '<p>Welcome '.ucwords($name).' to WeGotPlayer.</p>';								
				$message .= '<p>Please click the link below to confirm your email address  <a href="'.$url.'">'.$url.'</a>.</p>';
				$message .= "</body></html>";
									
				$sendmail=mail($to, $subject, $message, $headers);
					if ($sendmail) {
							$name=base64_encode($name); $name=urlencode($name);
							$reg_email=base64_encode($reg_email); $reg_email=urlencode($reg_email);
							$resend_mail_link=base_url().'user/resendEmailVerification/'.$name.'/'.$reg_email.'/'.$reg_code;
						    $this->session->set_flashdata('registration_done', 
						    								'Your Confirmation Link Has Been Sent To Your Email Address. 
						    								Click On The Link To Confirm Your Account. <br><br> 
						    								<a href="'.$resend_mail_link.'">Click here to resend the verification link.</a>');
			        }else{
			        	echo "Please Contact to WeGotPlayes Team for Support !";
			        }
			     }else{
			     	echo "Please check your mail.";
			     }       
		   }

			  $update_status = $this->user_model->updateReference($data,$email);
			  if($update_status){
			  		echo "Thanks For Refer !";
			  }else{
			  	echo "Not updated";
			  }
	
	}



}?>