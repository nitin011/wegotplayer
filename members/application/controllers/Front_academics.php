<?php 

class Front_academics extends CI_Controller {

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

	public function academicsView(){
		if (!$this->session->userdata('user_exist'))
		        {
		          //If no session, redirect to login page
		           redirect('user', 'refresh');
		           exit();
		        }
		      $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];
		      $username=$session_data['username'];

		      	$session_user = $this->session->userdata('logged_in');		
				$user_user_id = $session_user['user_id'];	

				
	  $privacy_data = $this->profile_model->getAcademicsPrivacy($user_id);
	  if($privacy_data){
		      
		      if($privacy_data->anyone==1)
			  {
				 $this->load->view('front/academic/academics_dashboard');
			  }
			  if($privacy_data->nobody==1){
			  		echo "<h2> You are not authorize to view this information !</h2>";
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

				      $check_friendship = $this->profile_model->checkFriendShip($id_arry);
				      if($check_friendship){
				      	  $this->load->view('front/academic/academics_dashboard');
				      }

			  		}else{

			  			$this->loginView();
			  		}

			  		
			  }
			  if($privacy_data->members==1){			  		
			  		$session_user = $this->session->userdata('logged_in');

		 		if($session_user){ 							
						
		 			$profile_user_id = $session_user['user_id'];
		 			$check_membership = $this->profile_model->checkMemberShip($profile_user_id);
		 			if($check_membership){
		 				$this->load->view('front/academic/academics_dashboard');
		 			}else{		  		
		  		       echo "<h2>Your are not member(recruiter) , Please register yourself !</h2>";
		  		       $this->loginView();
		  		     } 			
		 		}else{		  		
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

			  					$this->load->view('front/academic/academics_dashboard');
			  				}else{
			      					$this->load->view('front/privacy_code_view');
			      			    }
			  			}else{
			      			$this->load->view('front/privacy_code_view');
			      		}
			  } 
			}else{

				echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Profile Privacy  still not set</h3>";
			  	
			  }

	   }

	 public function schoolView()
	 {		
 	     $session_data = $this->session->userdata('user_exist');
	     $user_id=$session_data['user_id'];
	     $username=$session_data['username'];

	 	 $user_details= $this->fetch_model->school_details($user_id);
		  	if($user_details)
				{
				   $this->load->view("front/academic/school_view",$user_details);
				}else{

					echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">School Data Not Avilable.</h3>";
					
	  		}
	 }

	 public function testscoreView()
	 {
	 	 $session_data = $this->session->userdata('user_exist');
	     $user_id=$session_data['user_id'];

	     $testscore_details= $this->fetch_model->testscore_details($user_id);
	     if($testscore_details){
	     	$data = array('test_details' => $testscore_details);
	  	 	$this->load->view("front/academic/test_score_view",$data);
	  	 }else{
	  	 	 echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable.</h3>";
	  	 }
	 }

	 public function transcriptsView()
	 {
	 	$session_data = $this->session->userdata('user_exist');
	    $user_id=$session_data['user_id'];
	 	$row = array('wgp_table_id','degree_level(degree_level) degree_level',
		    			'academic_grade(academic_grade) academic_grade', 
		    	         'school_year(school_year) school_year', 
		    	         'course_level(course_level) course_level', 
		    	         'course_name(course_name) course_name');

		  	$transcripts_details= $this->fetch_model->transcripts_details($user_id,$row);
		  	if($transcripts_details){
		  		$data = array('transcripts_details' => $transcripts_details);
	 	 		$this->load->view("front/academic/transcripts_view",$data);
	 	 	}else{
	 	 		echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable.</h3>";
	 	 	}
	 }

	 public function honorsView()
	 {
	 	  $session_data = $this->session->userdata('user_exist');
	      $user_id=$session_data['user_id'];	

	      $row = array('wgp_table_id', 'wgp_user_id', 
				  'honor_type(type) type', 'level_name(level) level', 
				  'date_Received', 
				  'award_description(description) description',
				 'awards_honors_name','school_organization_name');
		  $honors = $this->fetch_model->getHonors($user_id,$row);
		  if($honors){
		  		$data  = array('honors' =>$honors);
				$this->load->view("front/academic/honors_view",$data);
		  }else{
	 	 		echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable.</h3>";
	 	 	}
	 }

	 public function leadershipView(){
	 	$session_data = $this->session->userdata('user_exist');
	    $user_id=$session_data['user_id'];

	    $exp = $this->fetch_model->getExperiance($user_id);	
	    if($exp){
			$data  = array('experiance' =>$exp);				 						 		
			$this->load->view("front/academic/leadership_view",$data);
		}else{
			echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable.</h3>";
		}
	 }




}

?>
