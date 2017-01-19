<?php 

class Front_video extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
	    $this->load->library(array('form_validation','session'));
		//$this->load->library('encrypt');
		$this->load->model('profile_model');
		$this->load->model('user_model');
		$this->load->model('fetch_model');
		$this->load->model('video_model');

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

	  public function loginView()
	  {
	  	   $this->load->view('front/login_view');
	  }

	public function videoView(){
		if (!$this->session->userdata('user_exist'))
		        {
		          //If no session, redirect to login page
		           redirect('user', 'refresh');
		           exit();
		        }
		      $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];

		      $privacy_data = $this->profile_model->getPrivacyData($user_id,8);
		      
		 if($privacy_data){		      

			      if($privacy_data->anyone==1)
				  {
					 $this->showAllVideo();
				  }

				 else if($privacy_data->nobody==1){
				  		echo "<h4>Videos</h4><h3 class=\"heading_b heading_b_c uk-margin-bottom\"> You are not authorize to view this information !</h3>";
				  }

				  else if($privacy_data->friends==1){
				  	    $session_user = $this->session->userdata('logged_in');
						$session_profile = $this->session->userdata('user_exist');

						if($session_user && $session_profile)
						{
								$user_user_id = $session_user['user_id'];
								$profile_user_id = $session_profile['user_id'];

									$id_arry = array('user_id' =>$user_user_id ,
										             'friend_id'=>$profile_user_id);  	 		
				  		  
				  		   $check_friendship=$this->profile_model->checkFriendShip($id_arry);
		                  
					       if($check_friendship){
					      		$this->showAllVideo();
					       }
				  	   } else{
				  	   	     echo "<h4>Videos </h4>";
				  			 $this->loginView();
				  	   }
				  }


		 else if($privacy_data->members==1){			  		
		  		$session_user = $this->session->userdata('logged_in');

		 		if($session_user){ 
		 			$profile_user_id = $session_user['user_id'];
		 			$check_membership = $this->profile_model->checkMemberShip($profile_user_id);
		 			if($check_membership){
		 				$this->showAllVideo();
		 			}else{		  		
		  		       echo "<h4>Videos</h4><h3 class=\"heading_b heading_b_c uk-margin-bottom\">Your are not member(recruiter) , Please register yourself !</h3>";
		  		       $this->loginView();
		  		     } 			
		 		}else{	
		 		    echo "<h4>Videos</h4>";	  		
		  		    $this->loginView();
		  		}
		  }

		 else if($privacy_data->code_receivers==1)
		  {
		  	    if(isset($session_data['privacy_code']))
		  			{	//rechecking privacy code
		  				  $data = array('user_id' => $user_id,'unique_code' =>$session_data['privacy_code']);
					      $verify_status = $this->profile_model->verifyCode($data);

		      				if($verify_status){
			  						$this->showAllVideo();
			  				}else{
			  					    echo "<h4>Videos</h4>";
			      					$this->load->view('front/privacy_code_view');
			      			 }
		  			}else{
		  				echo "<h4>Videos</h4>";
		      			$this->load->view('front/privacy_code_view');
		      		}
		 	}

	  }else{
		 		echo "<h4>Videos</h4><h3 class=\"heading_b heading_b_c uk-margin-bottom\">Profile Privacy  still not set</h3>";
		 	}
	     
      }

		public function  showAllVideo(){

		 if (!$this->session->userdata('user_exist'))
		        {
		          //If no session, redirect to login page
		           redirect('user', 'refresh');
		           exit();
		        }
		      $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];

		  /* Getting videos */
		     $video_count =$this->video_model->videoCount($user_id);	
			
		     $all_video = $this->video_model->getUserVideos($user_id);

		     $data=array('video_count'=>$video_count,'video_list'=>$all_video);
			
		     $this->load->view('front/video_list',$data);	
		}

  } ?>
