<?php 

class Front_reference extends CI_Controller {

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

	public function referenceView(){
		if (!$this->session->userdata('user_exist'))
		        {
		          //If no session, redirect to login page
		           redirect('user', 'refresh');
		           exit();
		        }
		      $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];

		     $privacy_data = $this->profile_model->getPrivacyData($user_id,12);

		   if($privacy_data){
		      if($privacy_data->anyone==1)
			  {
				 $this->referencesView();
			  }
			  if($privacy_data->nobody==1){
			  		echo "<h4>References </h4><h3 class=\"heading_b heading_b_c uk-margin-bottom\">You are not authorize to view this information !</h3>";
			  }
		  if($privacy_data->friends==1){
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
			      	 $this->referencesView();
			      }

		  		}else{
		  			echo "<h4>References </h4>";
		  			$this->loginView();
		  		}
		  }
		  if($privacy_data->members==1){			  		
		  		$session_user = $this->session->userdata('logged_in');

	 		if($session_user){ 							
					
	 			$profile_user_id = $session_user['user_id'];
	 			$check_membership = $this->profile_model->checkMemberShip($profile_user_id);
	 			if($check_membership){
	 				$this->referencesView();
	 			}else{		  		
	  		       echo "<h4>References </h4><h3 class=\"heading_b heading_b_c uk-margin-bottom\">Your are not member(recruiter) , Please register yourself !</h3>";
	  		       $this->loginView();
	  		     } 			
	 		}else{	
	 		     echo "<h4>References </h4><h3 class=\"heading_b heading_b_c uk-margin-bottom\">Your are not member(recruiter) , Please register yourself !</h3>";	  		
	  		    $this->loginView();
	  		}
		  }
	  if($privacy_data->code_receivers==1)
	  {
	  	    if(isset($session_data['privacy_code']))
	  			{	//rechecking privacy code
	  				  $data = array('user_id' => $user_id,'unique_code' =>$session_data['privacy_code']);
				      $verify_status = $this->profile_model->verifyCode($data);

      				if($verify_status){
	  					$this->referencesView();
	  				}else{
	  					    echo "<h4>References </h4>";
	      					$this->load->view('front/privacy_code_view');
	      			    }
	  			}else{
	  				echo "<h4>References </h4>";
	      			$this->load->view('front/privacy_code_view');
	      		}
	 	 }
	 	}else{
	 		echo "<h4>References </h4><h3 class=\"heading_b heading_b_c uk-margin-bottom\">Profile Privacy  still not set</h3>";
	 	}

       }

     public function referencesView()
	 {
	 	$session_data = $this->session->userdata('user_exist');
		$user_id=$session_data['user_id'];

		 /*Getting Reference Detail */

	       $ref_row = array('wgp_table_id', 'wgp_user_id','phone','email',
				      'refer_occupation(full_time_occupation) full_time_occupation',
				       'gender', 'level_name(level)  level','organization',
				      'location', 'comment', 'full_name');
			$reference= $this->fetch_model->referenceDetail($user_id,$ref_row);

			$asked_ref=$this->fetch_model->getAskedReference($user_id);

		  if($reference){

	 		  $data = array('reference' =>$reference,'asked_ref'=>$asked_ref);				  					  	
	          $this->load->view("front/atheletics/references_view",$data);
	      }else{
	      	     echo "<h4>References </h4>";
	      		echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable.</h3>";
	      }
	   }

  } ?>
