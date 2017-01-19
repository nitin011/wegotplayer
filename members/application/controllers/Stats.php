<?php 

class Stats extends CI_Controller {

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

	public function statsView(){
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

				
	  $privacy_data = $this->profile_model->getPrivacyData($user_id,5);
	  if($privacy_data){
		      
		      if($privacy_data->anyone==1)
			  {
				 $this->statsDataView();
			  }
			  if($privacy_data->nobody==1){
			  		echo "<h4>Stats</h4><h3 class=\"heading_b heading_b_c uk-margin-bottom\">You are not authorize to view this information !</h3>";
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
				      	  $this->statsDataView();
				      }

			  		}else{
			  			echo "<h4>Stats</h4>";
			  			$this->loginView();
			  		}

			  		
			  }
			  if($privacy_data->members==1){			  		
			  		$session_user = $this->session->userdata('logged_in');

		 		if($session_user){ 							
						
		 			$profile_user_id = $session_user['user_id'];
		 			$check_membership = $this->profile_model->checkMemberShip($profile_user_id);
		 			if($check_membership){
		 				$this->statsDataView();
		 			}else{	
		 			  echo "<h4>Stats</h4>";	  		
		  		       echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Your are not member(recruiter) , Please register yourself !</h3>";
		  		       $this->loginView();
		  		     } 			
		 		}else{		
		 		   echo "<h4>Stats</h4>";  		
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
		      					  $this->statsDataView();
			  				}else{
			  					    echo "<h4>Stats</h4>";
			      					$this->load->view('front/privacy_code_view');
			      			    }
			  			}else{
			  				echo "<h4>Stats</h4>";
			      			$this->load->view('front/privacy_code_view');
			      		}
			  } 
			}else{

				echo "<h4>Stats</h4><h3 class=\"heading_b heading_b_c uk-margin-bottom\">Profile Privacy  still not set</h3>";
			  	
			  }

	   }

	 public function statsDataView()
	 {		
 	     $session_data = $this->session->userdata('user_exist');
	     $user_id=$session_data['user_id'];
	     $username=$session_data['username'];

	     $season = array();
				   	for($i=2020;$i>1980;$i--){				   		
				   			array_push($season,$i);				   		
				   	}

	 	 $stats_row =array('wgp_table_id', 'wgp_user_id', 'level_name(level) level', 'season', 'games_played', 
				'games_started', 'goals', 'assists', 'points', 'total_points');
		 $stats_details= $this->fetch_model->stats_details($user_id,$stats_row);

		 if($stats_details){
				$data = array('stats_details'=>$stats_details,'seas'=>$season,);
			    $this->load->view("front/atheletics/stats_view",$data);
		 }else{
		 		echo "<h4>Stats</h4>";
		     	echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable.</h3>";					
	    }

	 }//end statsDataView view



}?>