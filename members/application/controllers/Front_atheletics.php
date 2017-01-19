<?php 

class Front_atheletics extends CI_Controller {

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

				
	$privacy_data = $this->profile_model->getAtheleticsPrivacy($user_id);	
	if($privacy_data){    
		      if($privacy_data->anyone==1)
			  {
				 $this->load->view('front/atheletics/atheletics_view');
			  }
			  if($privacy_data->nobody==1){
			  		echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\"> You are not authorize to view this information !</h3>";
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
			      	 $this->load->view('front/atheletics/atheletics_view');
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
	 				$this->load->view('front/atheletics/atheletics_view');
	 			}else{		  		
	  		       echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Your are not member(recruiter) , Please register yourself !</h3>";
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
	  					$this->load->view('front/atheletics/atheletics_view');
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

	 public function playerView(){	 	
	 	$this->load->view('front/atheletics/player_view');
	 }

	 public function teaminfoView()
	 {	
	 	$session_data = $this->session->userdata('user_exist');
		$user_id=$session_data['user_id'];

	 	$row = array('wgp_table_id', 'wgp_user_id', 'team_name',
		    			 'level_name(level) level','head_coach_full_name',
		    			 'coach_phone','coach_email','team_website',
		    			 'competition_value(competition) competition', 
		    			 'uniform_color_name(team_home_uniform) team_home_uniform',
		    			 'uniform_color_name(team_away_color) team_away_color', 
		    			 'playing_year(college_playing_eligibility) college_playing_eligibility', 
		    			 'team_home_address',
		    			 'division_name(division) division',
		    			 'ground_name(favortite_sports_ground) favortite_sports_ground', 
		    			 'playing_years',
		    			 'play_style(style_of_play) style_of_play');
		$teaminfo= $this->fetch_model->teamInfo($user_id,$row);	
		if($teaminfo){
			  $data = array('teaminfo' => $teaminfo );	   					   	
			$this->load->view("front/atheletics/teaminfo_view",$data);
		}else{
			echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable.</h3>";
		}	 	
	 }

	 public function commentView()
	 {
	 	
	 	$session_data = $this->session->userdata('user_exist');
		$user_id=$session_data['user_id'];

		$comments = $this->fetch_model->getComment($user_id);
		if($comments){
			$data  = array('comments' =>$comments);				 
			$this->load->view("front/atheletics/comment_view",$data);
		}else{
			echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable.</h3>";
		}

	 }


	 public function technicalView()
	 {
	 	$session_data = $this->session->userdata('user_exist');
		$user_id=$session_data['user_id'];

		$tech_details= $this->fetch_model->technical_details($user_id);		
		if($tech_details){
          $this->load->view("front/atheletics/technical_view",$tech_details); 
         }else{
         	echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable.</h3>";
         }
	 }

	 public function tacticalView()
	 {
	 	$session_data = $this->session->userdata('user_exist');
		$user_id=$session_data['user_id'];
		$tact_details= $this->fetch_model->tactical_details($user_id);
		if($tact_details){
			$this->load->view("front/atheletics/tactical_view",$tact_details); 
		}else{
			echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable.</h3>";
		}
	 }

	 public function physicalView()
	 {
	 	$session_data = $this->session->userdata('user_exist');
		$user_id=$session_data['user_id'];

		$physical= $this->fetch_model->physical_details($user_id);
		if($physical){
			$this->load->view("front/atheletics/physical_view",$physical);
		}else{
			echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable.</h3>";
		}

	 }

	 public function psyhosocialView()
	 {
	 	$session_data = $this->session->userdata('user_exist');
		$user_id=$session_data['user_id'];
		$psy_details= $this->fetch_model->psyhosocial_details($user_id);
		if($psy_details){
			$this->load->view("front/atheletics/psyhosocial_view",$psy_details);
		}else{
			echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable.</h3>";
		}
	 }

	 public function statsView()
	 {
	 	$session_data = $this->session->userdata('user_exist');
		$user_id=$session_data['user_id'];

		$row =array('wgp_table_id', 'wgp_user_id', 'level_name(level) level', 
					'season', 'games_played','games_started', 'goals',
					'assists', 'points', 'total_points');
		$stats_details= $this->fetch_model->stats_details($user_id,$row);

		if($stats_details){
			$season = array();
				   	for($i=2020;$i>1980;$i--){				   		
				   			array_push($season,$i);				   		
				   	}				 
				$data = array('stats_details' => $stats_details,'seas'=>$season);				
	  		    $this->load->view("front/atheletics/stats_view",$data); 
	  		}else{
	  			echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable.</h3>";
	  		}
	 }

	 public function injurView()
	 {
	 	$session_data = $this->session->userdata('user_exist');
		$user_id=$session_data['user_id'];

		$row = array('wgp_table_id','wgp_user_id', 
						'injury_type(type_of_injury) type_of_injury',
					    'body_part(body_part) body_part', 
						'body_area(body_area) body_area','recovered', 
						'surgery_name(surgery) surgery', 
						'when');
			
			$injur = $this->fetch_model->getInjur($user_id,$row);
			if($injur){
				$recovered = array();
					for($i=5;$i<=100;$i+=5){				   		
						  array_push($recovered,$i);				   		
					}
				$data  = array('injur' =>$injur,'recovered'=>$recovered);				 
				$this->load->view("front/atheletics/injurie_view",$data);
			}else{
				echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable.</h3>";
			}
	 }

	 public function referencesView()
	 {
	 	$session_data = $this->session->userdata('user_exist');
		$user_id=$session_data['user_id'];

		$row = array('wgp_table_id', 'wgp_user_id', 
				      'refer_occupation(full_time_occupation) full_time_occupation',
				       'gender', 'level_name(level) level','organization',
				      'location', 'comment', 'full_name');
		$reference= $this->fetch_model->referenceDetail($user_id,$row);
		if($reference){

	 		  $data = array('reference' =>$reference);				  					  	
	          $this->load->view("front/atheletics/references_view",$data);
	      }else{
	      		echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable.</h3>";
	      }

	 }



}
?>