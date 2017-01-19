<?php 

class Front_controller extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
	    $this->load->library(array('form_validation','session'));
		//$this->load->library('encrypt');
		$this->load->model('profile_model');
		$this->load->model('user_model');

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

	 public function profileView()
		{

			if (!$this->session->userdata('user_exist'))
		        {
		          //If no session, redirect to login page
		           redirect('user', 'refresh');
		           exit();
		        }
		      $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];
		      $username=$session_data['username'];
		      $row = array(
		      				'user_id','birth_year','birth_month','birth_day','first_name',
		      		     'last_name','gender','nation_value(nationality) nationality_n','nationality',
		      		   'sport_name(sport) sport_name','sport','address','graduation_month',
		      		   'graduation_year','hand_name(hand) hand_name','foot',
		      		   'foot_name(foot) foot_name','hand',
		      		   'position_value(position_speciality) position_name','position_speciality',
		      		   'height_value(height) height_name','height',
		      		   'weight_value(weight) weight_name','weight',
		      		   'level_name(level) level_name','level','location'		      				
		      	          );
		      $personal_detail = $this->profile_model->getPersonal($user_id,$row);
		      if($personal_detail){

		      

		      $seeking_id = $this->user_model->seekingId($user_id);
		      $seeking = $this->user_model->getSeekingId($user_id);

		  	  $contact_id = $this->user_model->getContactId($user_id);
		      
		      $data = array('personal' => $personal_detail,'username'=>$username,
		      				'seek'=>$seeking,'seeking_id'=>$seeking_id,
		      				'contact'=>$contact_id);

		      $this->load->view('front/personal_view',$data);
		  }else{
		  	echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\"> Data not avilable !</h3>";
		  }

		}


	 public function personalView()
		{
			if (!$this->session->userdata('user_exist'))
		        {
		          //If no session, redirect to login page
		           redirect('user', 'refresh');
		           exit();
		        }
		      $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];
		      $username=$session_data['username'];



    $privacy_data = $this->profile_model->getPrivacyData($user_id,1);

	if($privacy_data){
		    
		      //check for anyone
			if($privacy_data->anyone==1)
			  {
		          $this->profileView();
		  	}else{
		  		//check for code receivers
		  	  if($privacy_data->code_receivers==1)
			      {		
			  			if(isset($session_data['privacy_code']))
			  			{	//rechecking privacy code
			  				  $data = array('user_id' => $user_id,'unique_code' =>$session_data['privacy_code']);
						      $verify_status = $this->profile_model->verifyCode($data);

		      				if($verify_status){

			  					$this->profileView();
			  				}else{
			      					$this->load->view('front/privacy_code_view');
			      			    }
			  			}else{
			      			$this->load->view('front/privacy_code_view');
			      		}
			      }
		  }
		  //check for friends
		 if($privacy_data->friends==1){
		  		$session_user = $this->session->userdata('logged_in');
				$session_profile = $this->session->userdata('user_exist');
				if($session_user && $session_profile)
				{
							$user_user_id = $session_user['user_id'];
							$profile_user_id = $session_profile['user_id'];

							$id_arry = array('user_id' =>$user_user_id ,
								             'friend_id'=>$profile_user_id);

							$check_friendship = $this->profile_model->checkFriendShip($id_arry);
							$this->profileView();
				}else{
		  		    $this->loginView();
		  		}

		  	}

		 //check for members
		 if($privacy_data->members==1){

		 		$session_user = $this->session->userdata('logged_in');

		 		if($session_user){ 							
						
		 			$profile_user_id = $session_user['user_id'];
		 			$check_membership = $this->profile_model->checkMemberShip($profile_user_id);
		 			if($check_membership){
		 				$this->profileView();
		 			}else{		  		
		  		       $this->loginView();
		  		     } 			
		 		}else{		  		
		  		    $this->loginView();
		  		}
		  	}

		 //check for members
		 if($privacy_data->nobody==1){
		 	 echo "<div class=\"md-card-toolbar\"><h3 class=\"md-card-toolbar-heading-text\"> You are not authorize to view this information !</h3></div>";	
		 }

		}else{
			echo "<h4>Personal</h4><div class=\"md-card-toolbar\"><h3 class=\"md-card-toolbar-heading-text\">Profile Privacy  still not Set</h3></div>";
		}
		  
	}

	public function loginView(){

		$this->load->view('front/login_view');
	}

	public function verifyCode()
	{
		if (!$this->session->userdata('user_exist'))
		        {
		          //If no session, redirect to login page
		           redirect('user', 'refresh');
		           exit();
		        }
		      $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];
		      $username=$session_data['username'];     
		     

		      $code = $this->input->post('privacy_code');

		      $data = array('user_id' => $user_id,'unique_code' =>$code);
		      $verify_status = $this->profile_model->verifyCode($data);

		      if($verify_status){		      	

		      	$ses_array = array('user_id' => $user_id, 
		      					   'name'=>$session_data['name'],
		      					   'email'=>$session_data['email'],
		      					   'dp_url'=>$session_data['dp_url'],
		      					   'acc_type'=>$session_data['acc_type'],
		      					   'cover_url'=>$session_data['cover_url'],
		      					   'username'=>$session_data['name'],
		      					   'privacy_code'=>$code);
		      	$this->session->set_userdata('user_exist',$ses_array);		      	

		      	$row = array(
		      				'birth_year','birth_month','birth_day','first_name',
		      				'last_name','gender','nation_value(nationality) nationality',
		      				'level_name(level) level',
		      				'hand_name(hand) hand','foot_name(foot) foot',
		      				'height_value(height) height','weight_value(weight) weight'		      				
		      	          );
		      $personal_detail = $this->profile_model->getPersonal($user_id,$row);
		      if($personal_detail){

		      $seeking_id = $this->user_model->getSeekingId($user_id);
		  	  $contact_id = $this->user_model->getContactId($user_id);
		      
		      $data = array('personal' => $personal_detail,'username'=>$username,
		      				'seek'=>$seeking_id,'contact'=>$contact_id);

		      $this->load->view('front/personal_view',$data);
		  }else{
		  	echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable !</h3>";
		  }

		      }



		
	}


	public function doLogin()
	  {     
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

				$this->loginView();
			}

			else
			{	
				$auth=$this->user_model->login($email,$password);
				
				if($auth)
				{	
					$pre_visit = $this->user_model->preVisit($email);
					 $visit = $pre_visit->last_visit_time;

				
					$last_visit=$this->user_model->lastVisit($email,$visit);
					if($last_visit){

						$session_user = $this->session->userdata('logged_in');
						$session_profile = $this->session->userdata('user_exist');

							$user_user_id = $session_user['user_id'];
							$profile_user_id = $session_profile['user_id'];

							$id_arry = array('user_id' =>$user_user_id ,
								             'friend_id'=>$profile_user_id);

							$check_friendship = $this->profile_model->checkFriendShip($id_arry);
							$this->personalView();
							
						}
					else{
						   $this->loginView();
					}	   
				}
				else
				{
				 $this->session->set_flashdata('login_error', 'Wrong login details. Please try again.');
				 $this->loginView();  
				}
			}
	  }//doLogin function end




	  public function forwardProfile()
	  {

	  	  $name = $this->input->post('name');
	  	  $email = $this->input->post('email');
	  	  $your_name = $this->input->post('your_name');
	  	  $your_email = $this->input->post('your_email');
	  	  $subject = $this->input->post('subject');
	  	  $message = $this->input->post('message');
             

             $this->load->library('email'); 
   
	         $this->email->from($your_email,  $your_name); 
	         $this->email->to($email);
	         $this->email->subject( $subject); 
	         $this->email->message( $message); 
	   
	         if($this->email->send()) {
	         	
	        
	       		  echo 1; 
	        } else  {
	         echo '<div class="alert alert-danger">Error in sending Email.</div>';
	        }
	 }


 
        
}
?>