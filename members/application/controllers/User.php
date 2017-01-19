<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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
	    

 public function index()
	  {	
	  	if ($this->session->userdata('logged_in')){
				  
				        $session_data = $this->session->userdata('logged_in');							
							 $user_type =$session_data['usertype'];
							 $activated =$session_data['activated'];
							 $user_id =$session_data['user_id'];
							 $email =$session_data['email'];
							 

					$pre_visit = $this->user_model->preVisit($email);
					 $visit = $pre_visit->last_visit_time;

				
					$last_visit=$this->user_model->lastVisit($email,$visit);


					if($last_visit){
						
							 if($user_type==1){
							 	if($activated==0){							 		
							 		$user_exist= $this->fetch_model->chechPlayerData($user_id);
							 		
							 		
							 		if($user_exist==false){							 			
							 			redirect(site_url('incomplete_profile'));
							 			exit();
							 		}else{
								       redirect(site_url('home'));
								       // redirect(site_url('wall'));
								        exit();
								    }
								}else{

								} 
							}
							if($user_type==2){
								redirect(site_url('recruiter')); 
								exit();
							}
						}
					else{
						$this->index();
					}		
 						if($user_type==1){
 							if($activated==0){
								 $user_exist= $this->fetch_model->chechPlayerData($user_id);
								 
							 		if($user_exist==false){							 			
							 			redirect(site_url('incomplete_profile'));
							 			exit();
							 		}else{
								        redirect(site_url('home'));
							 			//redirect(site_url('wall'));
								        exit();
								    }
								}else{
                                   redirect(site_url('useraccount/activate'));
                                   exit();
								} 
							}
							if($user_type==2){
								redirect(site_url('recruiter')); 
								exit();
							}   
				
				 
		  }else{
		  	$email = $this->input->cookie('email', TRUE);
	  		$password = $this->input->cookie('password', TRUE);
	  		$title= 'WeGotPlayer';

	  		$data = array('title' => $title,'email'=>$email,'password'=>$password );
	  		//print_r($data);
	  		$this->load->view("header",$data);
			$this->load->view("login_view",$data);
			$this->load->view('footer_out_view');			
			$this->load->view("footer");
		  }
	  			
	  }//Index function End

 public function register()
	  {    $data['title']= 'WeGotPlayers Registration';
	  	   $this->load->view("header",$data);
		   $this->load->view("register_view",$data);
		   $this->load->view('footer_out_view');			
		   $this->load->view("footer");	
	  }//Register function End

//Reset password function Start
 public function reset(){
	 	$data['title']= 'WeGotPlayer Registration';
		$this->load->view("header",$data);
		$this->load->view("password_reset_view");
		$this->load->view('footer_out_view');			
		$this->load->view("footer");
 }//Reset password function End

 public function checkEmail()
	 {
	 	 $email=$this->input->post('email');
	 	 $check_email = isEmail($email);
	     if($check_email)
			{
				$email_exist = $this->user_model->checkEmailExist($email);
				if($email_exist==true){
					 echo 1;
			  	 }else{
			  	     echo 0;
			  	 }
			}else{
				echo 0;;
			}
	  }//checkEmail function End

	


	public function resetPassword(){
		$email=$this->input->post('email');
	    $status = $this->checkRegisterEmail($email);
	    if($status==1){
	    	$mail_status = $this->sendResetPasswordMail($email);
	    	if($mail_status){
	    		echo "Check Your Email and follow the link to reset your password.";
	    	}else{
	    		echo "Problem in mailing!";
	    	}
	    }else{
	    	echo "Wrong Email !";
	    }
	}

	 public function checkRegisterEmail($email)
	 {	 
	 	 $check_email = isEmail($email);
	     if($check_email)
			{
				$email_exist = $this->user_model->checkEmailExist($email);
				if($email_exist==true){
					 return 1;
			  	 }else{
			  	     return 0;
			  	 }
			}else{
				return 0;
			}
	  }//checkEmail function End


	public function verify(){
		   $title= 'WeGotPlayer';

	  		$data = array('title' => $title);
	  		//print_r($data);
	  		$this->load->view("header",$data);
			$this->load->view("resend_verification",$data);
			$this->load->view('footer_out_view');			
			$this->load->view("footer");
	}

	public function sendResetPasswordMail($email){
		$user_detail=$this->fetch_model->userDetailForReset($email);		
		  if($user_detail){
			$name = $user_detail->name;
		  	$verify_hash = $user_detail->verify_hash;
		  	$url = base_url()."user/reset_password/".$verify_hash;

		        $to=$email;
				$to =  strip_tags("$to");									
				$from='support@wegotplayers.com';
				$from =  strip_tags("$from");									
				$subject='WeGotPlayers link to reset your password';	
									
				$headers = "from: WeGotPlayers<".$from.">\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";														  
				$message  = '<html><body style="background-color:#f6f6f6;">';				
				$message .= '<table style="margin:0px auto;" width="600px" cellpadding="0" cellspacing="0" border="0px">
							<tr><td><h1 style="text-align:left;">Hi '.ucwords($name).',</h1></td></tr>
							<tr><td><p style="text-align:center; margin:5px">There was recently a request to change the password for your account.</p></td></tr>
							<tr><td><p style="text-align:center; margin:5px">If you requested this password change, please reset your password here:</p></td></tr>
							<tr><td><a href="'.$url.'" style="max-width: 125px; padding: 8px; display: block!important; border: 2px solid; outline: none; text-decoration: none; margin-left: auto;
							margin-right: auto; text-align: center; border-radius: 10px; background-color: #f47921; color: #fff; font-size: 16px;" />Reset Password</a></td></tr>
							<tr><td><p style="text-align:center; margin:5px">If you did not make this request, you can ignore this message and your password will remain the same.</p></td></tr>
							</table>';
				$message .='<td style="font-family:Arial,Helvetica,sans-serif;line-height:22px"><span style="font-size:16px;color:#594f47">
							<strong>Regards</strong><br>WeGotPlayer Team</span></td>';			
				$message .= "</body></html>";
									
				$sendmail=mail($to, $subject, $message, $headers);
				if($sendmail){
					
					return true;				
				}else{
					
					return false;
				}
		 }
	}

	public function sendReVerification(){
		$email=$this->input->post('email');

		$user_detail=$this->fetch_model->userDetailForReset($email);		
		  if($user_detail){
				$name = $user_detail->name;
			  	$verify_hash = $user_detail->verify_hash;

				$url=base_url()."user/emailverification/".$verify_hash;
									
				$to=$email;
				$to =  strip_tags("$to");									
				$from='support@wegotplayers.com';
				$from =  strip_tags("$from");									
				$subject='Welcome to WeGotPlayers';	
									
				$headers = "from: WeGotPlayers<".$from.">\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";														  
				$message  = '<html><body>';
				$message .= '<p>Welcome '.ucwords($name).' .</p>';								
				$message .= '<p>Please click the link below to confirm your email address  <a href="'.$url.'">'.$url.'</a>.</p>';
				$message .= "</body></html>";
									
				$sendmail=mail($to, $subject, $message, $headers);

				if ($sendmail) {
					$this->session->set_flashdata('registration_done', 
						    				'Your Confirmation Link Has Been Sent To Your Email Address. 
						    				Click On The Link To Confirm Your Account');
						 redirect('user');
					} else {
						$this->session->set_flashdata('registration_error', 'Sorry some error occur! Cannot send Confirmation link to your e-mail address');
						     redirect('user');										   
          			}

         }else{
         	$this->session->set_flashdata('registration_error', 'Sorry! Your e-mail address is not Register');
				redirect('user/register');
         }
	}

	public function reset_password($verify_hash=NULL){
		 $hashverify=$this->fetch_model->hashVerify($verify_hash);
		 if($hashverify){
		    $user_id = $hashverify->user_id;
		    $this->setNewPassword($user_id);
		 }		 	
	}

	//set new password function Start
 	public function setNewPassword($user_id){
	 	$data['title']= 'WeGotPlayer Registration';
	 	$data['user_id'] = $user_id;
		$this->load->view("header",$data);
		$this->load->view("set_new_password_view",$data);		
		$this->load->view("footer");
	 }//set new password function End

	 public function submitNewPassword(){
	 	$user_id=$this->input->post('user_id');			
		$password =md5(md5($this->input->post('new_password')));

			$status = $this->user_model->updateNewPassword($user_id,$password);
			if($status){				
				echo "Password Change Successfully.";
			}else{
				echo "Problem in Password Change . Contact To Admin";
			}
	 }

	 public function doRegister()
	  {  
	  		$fname=strtolower($this->input->post('fname'));
			$lname=strtolower($this->input->post('lname'));
			$email=strtolower($this->input->post('email'));
			$password =md5(md5($this->input->post('password')));
			$usertype=$this->input->post('usertype');
			
	  	  	$rules = array(
			array('field'=>'fname','label'=>'first name','rules'=>'trim|required|min_length[2]|max_length[50]|xss_clean'),
			array('field'=>'lname','label'=>'last name','rules'=>'trim|required|min_length[2]|max_length[20]|xss_clean'),			
			array('field'=>'email','rules'=>'trim|required|valid_email|is_unique[users.email]'),			
			array('field'=>'password','rules'=>'trim|required|min_length[6]'),
		    array('field' =>'usertype','rules'=>'required'),		
			);			

			$this->form_validation->set_rules($rules);
			
			
			
			if($this->form_validation->run() == FALSE)
			{  
				//redirect('user/register');
				$this->register();
			}
			else
			{ 			
			$name =$fname." ".$lname;
			$reg_code  = md5(time());
			$id = mt_rand(100000, 999999);
			$id_u = mt_rand(100, 999);					
			$user_data=array('unique_code'=>$id,
                            'name'=>$name,														
							'email'=>$email,	
							'login_name'=>trim($fname).'.'.$id_u,								 
							'password'=>$password,
							'registration_type'=>$usertype,
							'verify_hash' => $reg_code,	
							'remote_addr'=>($_SERVER['REMOTE_ADDR']), 
							);
			//print_r($user_data);
			//calling the registration module
			$success= $this->user_model->registerUser($user_data);
			if($success){

				$reg_email=$email;						    
				$url=base_url()."user/emailverification/".$reg_code;
									
				$to=$reg_email;
				$to =  strip_tags("$to");									
				$from='support@wegotplayers.com';
				$from =  strip_tags("$from");									
				$subject='Welcome to WeGotPlayers';	
									
				$headers = "from: WeGotPlayers<".$from.">\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";														  
				$message  = '<html><body>';
				$message .= '<p>Welcome '.ucwords($name).' .</p>';								
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
			                
			                redirect('user');
							} else {
								$this->session->set_flashdata('registration_error', 'Sorry some error occur! Cannot send Confirmation link to your e-mail address');
						         
						         redirect('user/register');										   
          					  }
			   
		    }else{
				$this->session->set_flashdata('registration_error', 'OOPs! some error occur. Please try again.');
				 redirect('user/register'); 
				}
		  }
		}//doRegister function End
		
		
	public function checkEmailActive(){
		$email=$this->input->post('email');
		$auth=$this->user_model->isVerified($email);
		if($auth){
			echo 1;
		}else{
			echo 0;
		}

	}

	public function checkEmailRegister(){
		$email=$this->input->post('email');
		$auth=$this->user_model->checkEmailExist($email);
		if($auth){
			echo 1;
		}else{
			echo 0;
		}

	}

	public function doLogin()
	  {     
	  	   $email=$this->input->post('email');
	  	   $password = md5(md5($this->input->post('password')));
	  	   $rememberme = $this->input->post('rememberme');
	  	   if($rememberme=='on'){
	  	  		 $cook_email = array('name'=>'email',
	  	   				   'value'  => $email,
	  	   				   'expire' => time()+'86500',
    					   'domain' => '.'.base_url(),
    					   'path'   => '/',			    		   
			    		   'secure' => TRUE
						);
				$cook_password = array('name'=>'password',
	  	   				   'value'  => $this->input->post('password'),
	  	   				   'expire' => time()+'86500',
    					   'domain' => '.'.base_url(),
    					   'path'   => '/',			    		   
			    		   'secure' => TRUE
						);			
			
				$this->input->set_cookie($cook_email);		
				$this->input->set_cookie($cook_password);		
		 	}else{
		 		$cook_email = array('name'=>'email',
	  	   				   'value'  => $email,
	  	   				   'expire' => '',
    					   'domain' => '.'.base_url(),
    					   'path'   => '/',			    		   
			    		   'secure' => TRUE
						);
				$cook_password = array('name'=>'password',
	  	   				   'value'  => $this->input->post('password'),
	  	   				   'expire' => '',
    					   'domain' => '.'.base_url(),
    					   'path'   => '/',			    		   
			    		   'secure' => TRUE
						);
		 		 delete_cookie($cook_email); 
		 		 delete_cookie($cook_password);
		 	}
	  	  
	  	    
	  	   $check_email = isEmail($email);
	        if($check_email)
			{
				// email & password combination
				$rules = array(array('field'=>'email','rules'=>'trim|required|valid_email'),
			                   array('field'=>'password','rules'=>'trim|required')
						       );

			} else {
				// username & password combination
				$rules = array(array('field'=>'email','rules'=>'trim|required'),
			                   array('field'=>'password','rules'=>'trim|required')
						       );
			}

			$this->form_validation->set_rules($rules);
			if($this->form_validation->run() == false)
			{				
				$this->index();
			}

			else
			{	
				$auth=$this->user_model->login($email,$password);
				if (!$this->session->userdata('logged_in'))
			  				{
				  				//If no session, redirect to login page
				   				redirect('user', 'refresh');
				  				 exit();
			 				 }
							$session_data = $this->session->userdata('logged_in');							
							 $user_type =$session_data['usertype'];
							 $activated =$session_data['activated'];
							 $user_id =$session_data['user_id'];
							 

				if($auth)
				{	
					$pre_visit = $this->user_model->preVisit($email);
					 $visit = $pre_visit->last_visit_time;

				
					$last_visit=$this->user_model->lastVisit($email,$visit);


					if($last_visit){
						
							 if($user_type==1){
							 	if($activated==0){							 		
							 		$user_exist= $this->fetch_model->chechPlayerData($user_id);
							 		
							 		
							 		if($user_exist==false){							 			
							 			redirect(site_url('incomplete_profile'));
							 			exit();
							 		}else{
								       redirect(site_url('home'));
								       // redirect(site_url('wall'));
								        exit();
								    }
								}else{

								} 
							}
							if($user_type==2){
								redirect(site_url('recruiter')); 
								exit();
							}
						}
					else{
						$this->index();
					}		
 						if($user_type==1){
 							if($activated==0){
								 $user_exist= $this->fetch_model->chechPlayerData($user_id);
								 
							 		if($user_exist==false){							 			
							 			redirect(site_url('incomplete_profile'));
							 			exit();
							 		}else{
								        redirect(site_url('home'));
							 			//redirect(site_url('wall'));
								        exit();
								    }
								}else{
                                   redirect(site_url('useraccount/activate'));
                                   exit();
								} 
							}
							if($user_type==2){
								redirect(site_url('recruiter')); 
								exit();
							}   
				}
				else
				{
				 $this->session->set_flashdata('login_error', 'Wrong login details. Please try again.');
				 $this->index();  
				}
			}
	  }//doLogin function end 

	  public function loginAction(){
	  	  $email=$this->input->post('email');
	  	  $password = md5(md5($this->input->post('password')));

	  	  $check_email = isEmail($email);
	        if($check_email)
			{
				// email & password combination
				$rules = array(array('field'=>'email','rules'=>'trim|required|valid_email'),
			                   array('field'=>'password','rules'=>'trim|required')
						       );

			} else {
				// username & password combination
				$rules = array(array('field'=>'email','rules'=>'trim|required'),
			                   array('field'=>'password','rules'=>'trim|required')
						       );
			}

			$this->form_validation->set_rules($rules);
			if($this->form_validation->run() == false)
			{				
				echo "OOPS! Please Fill Valid fields.";
			}else{
				$auth=$this->user_model->login($email,$password);

				if($auth)
				{	
					$pre_visit = $this->user_model->preVisit($email);
					 $visit = $pre_visit->last_visit_time;				
					$last_visit=$this->user_model->lastVisit($email,$visit);
					echo 1;
				}else{
					echo "login_error', 'Wrong login details. Please try again.";
				}
			}
	  }



		 public function emailverification($reg_code=NULL)
	  	  {
	  		  $emailverify=$this->user_model->emailverification($reg_code);
		      if($emailverify)
		 	  {
		 	     $this->session->set_flashdata('registration_done', 'Thank you for verify your account with us. Verification Successful.');
		  		 redirect("user"); 
		  		 exit();
			  }else{
		  	     $this->session->set_flashdata('registration_done', 'Some error occur. Your account is not active.');
		  	     redirect("user/register"); 
		 	   } 			
		   }


	  public function logout()
	  {
		  $session_data = $this->session->userdata('logged_in');
		  $user_id=$session_data['user_id'];
				   
		  $last_activity=$this->user_model->lastActivity($user_id);
		   if($last_activity)
		   {
		   		$this->session->unset_userdata('logged_in');
		   		session_destroy();
		   		redirect('user', 'refresh');
		   		exit();
		   	}else{
		   		
		   	}
		 }

		 public function loginAuth(){
		 	 $email=$this->input->post('email');		 	
		 	 $name=$this->input->post('name');
		 	 $image=$this->input->post('image');
		 	 $login_method=$this->input->post('login_method');

		 	 $data = array('email' =>$email ,'name'=>$name,
		 	 			'image'=>$image,'login_method'=>$login_method);

		 	 $auth=$this->user_model->checkEmailExist($email);
			if($auth){
				$login_status = $this->user_model->authLogin($email);

				if (!$this->session->userdata('logged_in'))
			  				{
				  				//If no session, redirect to login page
				   				redirect('user', 'refresh');
				  				 exit();
			 				 }
							$session_data = $this->session->userdata('logged_in');							
							 $user_type =$session_data['usertype'];
							 $activated =$session_data['activated'];
							 $user_id =$session_data['user_id'];
							 

				if($login_status)
				{	
					$pre_visit = $this->user_model->preVisit($email);
					 $visit = $pre_visit->last_visit_time;

				
					$last_visit=$this->user_model->lastVisit($email,$visit);


					if($last_visit){
						
							 if($user_type==1){
							 	if($activated==0){							 		
							 		$user_exist= $this->fetch_model->chechPlayerData($user_id);
							 	
							 		if($user_exist==false){							 			
							 			redirect(site_url('incomplete_profile'));
							 			exit();
							 		}else{
							 			
								       redirect(site_url('home'));
								       // redirect(site_url('wall'));
								        exit();
								    }
								}else{

								} 
							}
							if($user_type==2){
								redirect(site_url('recruiter')); 
								exit();
							}
						}
					else{
						$this->index();
					}		
 						if($user_type==1){
 							if($activated==0){
								 $user_exist= $this->fetch_model->chechPlayerData($user_id);
								 	
							 		if($user_exist==false){							 			
							 			redirect(site_url('incomplete_profile'));
							 			exit();
							 		}else{
							 			
								        redirect(site_url('home'));
							 			//redirect(site_url('wall'));
								        exit();
								    }
								}else{
                                   redirect(site_url('useraccount/activate'));
                                   exit();
								} 
							}
							if($user_type==2){
								redirect(site_url('recruiter')); 
								exit();
							}   
				}
			}else{
					
					// if email is not register then register email and activate


					$resiter_status = $this->user_model->registerBySocial($data);

			}

		 }




		 public  function loginWithFacebook($data=NULL)
		 {
			 $decode_it= base64_decode($data);
			
			// your code goes here
			$decode_array=explode('__',$decode_it);
			$facebookusername=$decode_array[0];
			$facebookEmail=$decode_array[1];

		 	 $email=$facebookEmail;		 	 
		 	 $name=$facebookusername;		 	
		 	 $login_method='login_with_fb';

		 	 $data = array('email' =>$email ,'name'=>$name,'login_method'=>$login_method);

		 	 $auth=$this->user_model->checkEmailExist($email);
			if($auth){
				$login_status = $this->user_model->authLogin($email);

				if (!$this->session->userdata('logged_in'))
			  				{
				  				//If no session, redirect to login page
				   				redirect('user', 'refresh');
				  				 exit();
			 				 }
							$session_data = $this->session->userdata('logged_in');							
							 $user_type =$session_data['usertype'];
							 $activated =$session_data['activated'];
							 $user_id =$session_data['user_id'];
							 

				if($login_status)
				{	
					$pre_visit = $this->user_model->preVisit($email);
					 $visit = $pre_visit->last_visit_time;

				
					$last_visit=$this->user_model->lastVisit($email,$visit);


					if($last_visit){
						
							 if($user_type==1){
							 	if($activated==0){							 		
							 		$user_exist= $this->fetch_model->chechPlayerData($user_id);
							 	
							 		if($user_exist==false){							 			
							 			redirect(site_url('incomplete_profile'));
							 			exit();
							 		}else{
							 			
								       redirect(site_url('home'));
								       // redirect(site_url('wall'));
								        exit();
								    }
								}else{

								} 
							}
							if($user_type==2){
								redirect(site_url('recruiter')); 
								exit();
							}
						}
					else{
						$this->index();
					}		
 						if($user_type==1){
 							if($activated==0){
								 $user_exist= $this->fetch_model->chechPlayerData($user_id);
								 	
							 		if($user_exist==false){							 			
							 			redirect(site_url('incomplete_profile'));
							 			exit();
							 		}else{
							 			
								        redirect(site_url('home'));
							 			//redirect(site_url('wall'));
								        exit();
								    }
								}else{
                                   redirect(site_url('useraccount/activate'));
                                   exit();
								} 
							}
							if($user_type==2){
								redirect(site_url('recruiter')); 
								exit();
							}   
				}
			}else{
					
					// if email is not register then register email and activate


					$resiter_status = $this->user_model->registerBySocial($data);

			}
		 }




		 public function loginWithFB()
		 {}


		public function twitterProcess(){
		 	include_once("application/third_party/twitter/config.php");
			include_once("application/third_party/twitter/inc/twitteroauth.php");
			

			if(isset($_REQUEST['oauth_token']) && $_SESSION['token']  !== $_REQUEST['oauth_token']) {
				echo "first";
				//If token is old, distroy session and redirect user to index.php
				//session_destroy();
				//header('Location: index.php');
				
			}elseif(isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) {
					echo "second";
				//Successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
				$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token'] , $_SESSION['token_secret']);
				$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
				if($connection->http_code == '200')
				{
					//Redirect user to twitter
					$_SESSION['status'] = 'verified';
					$_SESSION['request_vars'] = $access_token;
					
					//Insert user into the database
					echo "third";
					$user_info = $connection->get('account/verify_credentials'); 
					$name = explode(" ",$user_info->name);
					$fname = isset($name[0])?$name[0]:'';
					$lname = isset($name[1])?$name[1]:'';
			          print_r($user_info);
			          die;
			          print_r($name);
					 print_r($fname);
					 print_r($lname);
					
					$user_data = array($user_info->id,$user_info->screen_name,$fname,$lname,$user_info->lang,$access_token['oauth_token'],$access_token['oauth_token_secret'],$user_info->profile_image_url);
					
					//Unset no longer needed request tokens
					unset($_SESSION['token']);
					unset($_SESSION['token_secret']);
					//header('Location: index.php');
				}else{

					die("error, try again later!");
				}
					
			}else{

				if(isset($_GET["denied"]))
				{

					echo "fourth";
					//header('Location: index.php');
					die();
				}

				//Fresh authentication
				$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
				$request_token = $connection->getRequestToken(OAUTH_CALLBACK);
				
				//Received token info from twitter
				$_SESSION['token'] 			= $request_token['oauth_token'];
				$_SESSION['token_secret'] 	= $request_token['oauth_token_secret'];
				
				//Any value other than 200 is failure, so continue only if http code is 200
				if($connection->http_code == '200')
				{
					echo "fifth";
					//redirect user to twitter
					$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);


					header('Location: ' . $twitter_url); 
				}else{
					
					die("error connecting to twitter! try again later!");
				}
			}


		 }


}