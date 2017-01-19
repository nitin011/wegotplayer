<?php 

class Atheletics extends CI_Controller {

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

	  public function atheleticsView()
	  {
	  	   $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];
		      $username=$session_data['username'];

		      	$session_user = $this->session->userdata('logged_in');		
				$user_user_id = $session_user['user_id'];	

				
	$privacy_data = $this->profile_model->getPrivacyData($user_id,4);	
	if($privacy_data){    
		      if($privacy_data->anyone==1)
			  {
				 $this->teaminfoView();
			  }
			  if($privacy_data->nobody==1){
			  		echo "<h4>Athletics</h4><h3 class=\"heading_b heading_b_c uk-margin-bottom\"> You are not authorize to view this information !</h3>";
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
			      	   $this->teaminfoView();
			      }

		  		}else{
		  			echo "<h4>Athletics</h4>";
		  			$this->loginView();
		  		}
		  }
		  if($privacy_data->members==1){			  		
		  		$session_user = $this->session->userdata('logged_in');

	 		if($session_user){ 							
					
	 			$profile_user_id = $session_user['user_id'];
	 			$check_membership = $this->profile_model->checkMemberShip($profile_user_id);
	 			if($check_membership){
	 				 $this->teaminfoView();
	 			}else{	
	 				echo "<h4>Athletics</h4>";	  		
	  		       echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Your are not member(recruiter) , Please register yourself !</h3>";
	  		       $this->loginView();
	  		     } 			
	 		}else{	
	 		    echo "<h4>Athletics</h4>";		  		
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
	  					$this->teaminfoView();
	  				}else{ 
	  						echo "<h4>Athletics</h4>";	
	      					$this->load->view('front/privacy_code_view');
	      			    }
	  			}else{
	  				echo "<h4>Athletics</h4>";	
	      			$this->load->view('front/privacy_code_view');
	      		}
	 	 }
	 	}else{
	 		echo "<h4>Athletics</h4><h3 class=\"heading_b heading_b_c uk-margin-bottom\">Profile Privacy  still not set</h3>";
	 	}
	  }

	 public function playerView(){	 	
	 	$this->load->view('front/atheletics/player_view');
	 }

	 public function teaminfoView()
	 {	
	 	$session_data = $this->session->userdata('user_exist');
		$user_id=$session_data['user_id'];

	 	$row = array('wgp_table_id', 'wgp_user_id', 'team_name','jersey_number',
	    			 'level_name(level) as level_name','level','head_coach_full_name',
	    			 'coach_phone','coach_email','team_website',
	    			 'competition_value(competition) competition_name', 
	    			 'uniform_color_name(team_home_uniform) team_home_uniform_name',
	    			 'uniform_color_name(team_away_color) team_away_color_name', 
	    			 'team_home_uniform','team_away_color',
	    			 'playing_year(college_playing_eligibility) playing_eligibility', 
	    			 'college_playing_eligibility','competition','division',
	    			 'team_home_address','division_name(division) division_name',
	    			 'ground_name(favortite_sports_ground) favortite_sports_ground_name',
	    			 'favortite_sports_ground' ,'style_of_play',
	    			 'playing_years','play_style(style_of_play) style_of_play_name');
	 	
		$teaminfo= $this->fetch_model->teamInfo($user_id,$row);	
		if($teaminfo){
			  $data = array('teaminfo' => $teaminfo );	   					   	
			$this->load->view("front/atheletics/teaminfo_view",$data);
		}else{
			echo "<h4>Athletics</h4>";
			echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable.</h3>";
		}	 	
	 }



}?>