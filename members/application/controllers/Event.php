<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
	    $this->load->library(array('form_validation','session'));		
		$this->load->model('user_model');
		$this->load->model('notification_model');
		$this->load->model('profile_model');
		$this->load->model('fetch_model');
		$this->load->model('photo_model');
		$this->load->library('upload');			
		$this->load->model('video_model');
		$this->load->model('theme2_model');		
		$this->load->model('user_post');
		$this->load->model('event_model');
		$this->load->model('record_model');	
		

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

	  		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
		  	$name=$session_data['name'];
		  	$email=$session_data['email'];
		  	$acc_type=$session_data['acc_type'];
		  	$dp_url = $session_data['dp_url'];
		  	//geting pending friend request count 
		  	$f_count=$this->getPendingReqestCount($user_id);
		  	//geting unread mail count 
		  	$m_count=$this->getUnreadMailCount($user_id);

		  	$n_count = $this->getPendingNotificationCount($user_id);


			//fetch total posts of the login user
			$total_posts  = $this->user_post->total_posts($user_id);

			$profile_pic_status = $this->photo_model->checkProfilePic($user_id);


		  
			$user_data= array('title'=>'WeGotPlayer','f_count'=>$f_count,
							  'm_count'=>$m_count,'n_count'=>$n_count,'acc_type'=>$acc_type,
							  'email'=>$email,'user_id'=>$user_id,'name'=>$name);

		  //start geting data from users
		  

		    $detail = $this->theme2_model->getPersonalDetails($user_id);
		    if($detail){
		    	$nationality = $detail->nationality;
		    	$location_short = $this->theme2_model->getShortLocationName($nationality);
		    }
		    //get seeking

		    $seeking_id = $this->user_model->seekingId($user_id);

		    $seeking = $this->user_model->getSeekingId($user_id);

		    $seeking_list = $this->fetch_model->getSeeking();

		    $user_detail = $this->theme2_model->getUserDetails($user_id);

		    $personal_info = $this->theme2_model->getPersonalInfo($user_id);

		    $school= $this->fetch_model->school_details($user_id);

		   // Get sport id 
			$user_sport_data = $this->fetch_model->getSportId($user_id);
            $user_sport_id =$user_sport_data->sport;
			// Get level  of sport
			$level_data = $this->fetch_model->getLevel($user_sport_id);			
			//get competition
			$competition= $this->fetch_model->getCompetition();
			//Get playing Year
		    $playing_year= $this->fetch_model->getPlayingYear();
		    //Get Division
		    $division = $this->fetch_model->getDivision();
		    //Get Color
		    $color  = $this->fetch_model->getColor();

		   //Get Play Style
		    $play_style  = $this->fetch_model->getPlayStyle();

		    //get Sports Ground
		    $sports_ground  = $this->fetch_model->getSportGround();

		    $row = array('wgp_table_id', 'wgp_user_id', 'team_name',
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

		    // getting team info detail
			$teaminfo= $this->fetch_model->teamInfo($user_id,$row);

			$year= array();
				for($i=0;$i<=20;$i++)
				{
				   	array_push($year,$i);
				}


		 /* Getting  photo folder*/

		 $photo_album = $this->photo_model->getAlbum($user_id);


		 /* Getting videos */
		 $video_count =$this->video_model->videoCount($user_id);	
			
		 $all_video = $this->video_model->getUserVideos($user_id);


	 /*Getting Reference Detail */

	       $ref_row = array('wgp_table_id', 'wgp_user_id','phone','email',
				      'refer_occupation(full_time_occupation) full_time_occupation',
				       'gender', 'level_name(level)  level','organization',
				      'location', 'comment', 'full_name');
			$reference= $this->fetch_model->referenceDetail($user_id,$ref_row);

			$asked_ref=$this->fetch_model->getAskedReference($user_id);

			$occupation =$this->fetch_model->getOccupation();

			$gender = array('1' =>'Male' ,'2'=>'Female');

			$events = $this->theme2_model->getEvent($user_id);

			$all_events = $this->theme2_model->getAllEvent($user_id);


			$sport_list = $this->fetch_model->sport();
	   		$hand_list = $this->fetch_model->hand();
	   		$foot_list = $this->fetch_model->foot();
	   		$height_list = $this->fetch_model->height();
	   		$weight_list = $this->fetch_model->weight();



	   		//Event add detail

	   		$event_type = $this->event_model->getEventType();
			$event_importance = $this->event_model->getEventImportance();

			// Stats Detail 

			$season = array();
				   	for($i=2020;$i>1980;$i--){				   		
				   			array_push($season,$i);				   		
				   	}

			$stats_row =array('wgp_table_id', 'wgp_user_id', 'level_name(level) level', 'season', 'games_played', 
				'games_started', 'goals', 'assists', 'points', 'total_points');
		  	$stats_details= $this->fetch_model->stats_details($user_id,$stats_row);


		  	$lang_row = array('id','lang_level_name(level) level_name','level','language');
			$language_data = $this->record_model->getLanguage($user_id,$lang_row);

			
			$language_level = $this->record_model->getLanguageLevel();	


			//Get User Injur 
		    $injur_row = array('wgp_table_id','wgp_user_id', 
						'injury_type(type_of_injury) type_of_injury',
					    'body_part(body_part) body_part', 
						'body_area(body_area) body_area','recovered', 
						'surgery_name(surgery) surgery', 
						'when');
			
			$injur = $this->fetch_model->getInjur($user_id,$injur_row);

			$recovered = array();
				for($i=5;$i<=100;$i+=5){				   		
				   			array_push($recovered,$i);				   		
				}

			$trans_row = array('wgp_table_id','degree_level(degree_level) degree_level',
		    			'academic_grade(academic_grade) academic_grade', 
		    	         'school_year(school_year) school_year', 
		    	         'course_level(course_level) course_level', 
		    	         'course_name(course_name) course_name');

		  	$transcripts_details= $this->fetch_model->transcripts_details($user_id,$trans_row);



		  	//get all images of users 
		  	$image_list=$this->photo_model->getAllImage($user_id);

		  	// Get Vital Data Technical ,Tactical, Physical, Psychosocial 
		  	$ranking = array(1,2,3,4,5,6,7,8,9,10);
		    $tech_details= $this->fetch_model->technical_details($user_id);
		    $tact_details= $this->fetch_model->tactical_details($user_id);
		    $physical= $this->fetch_model->physical_details($user_id);
		    $psy_details= $this->fetch_model->psyhosocial_details($user_id);


		    // Get latest three wall
		     $latest_wall = $this->theme2_model->getLatestPost($user_id);
			

			$this->load->view("header-home",$user_data);

	  		$data = ['detail'=>$detail,'seeking'=>$seeking,'seeking_list'=>$seeking_list,
	  				 'dp_url'=>$dp_url,'school'=>$school,'seeking_id'=>$seeking_id,
	  				 'user_detail'=>$user_detail,'personal_info'=>$personal_info,
	  				 'teaminfo'=>$teaminfo,'level'=>$level_data,'competition'=>$competition,
			   	  	 'playing_year'=>$playing_year,'division'=>$division,
			   	  	 'color'=>$color,'year'=>$year,'play_style'=>$play_style,
			   	  	 'sports_ground'=>$sports_ground,'photo_album'=>$photo_album,
			   	  	 'video_count'=>$video_count,'video_list'=>$all_video,
			   	  	 'reference' =>$reference,'asked_ref'=>$asked_ref,
			   	  	 'occupation' =>$occupation,'gender'=>$gender,'events'=>$events,
			   	  	 'sport'=>$sport_list,'hand'=>$hand_list,'foot'=>$foot_list,
			   	  	 'height'=>$height_list,'weight'=>$weight_list,'total_posts'=>$total_posts,
			   	  	 'event_type'=>$event_type,'event_importance'=>$event_importance,
			   	  	 'profile_pic_status'=>$profile_pic_status,
			   	  	 'location_short'=>$location_short,
			   	  	 'stats_details'=>$stats_details,'seas'=>$season,
			   	  	 'language_level'=>$language_level ,'user_language'=>$language_data,
			   	  	 'injur' =>$injur,'recovered'=>$recovered,'image_list'=>$image_list,
			   	  	 'transcripts_details'=>$transcripts_details,
			   	  	 'tech_details'=>$tech_details,'tact_details'=>$tact_details,
			   	  	 'physical'=>$physical,'psy_details'=>$psy_details,
			   	  	 'latest_wall'=>$latest_wall,'all_events'=>$all_events];

	  	     //$this->load->view('theme2/header');
	  		 $this->load->view('theme2/event_view',$data);
	  		

	  }
	   
	   public function getPendingReqestCount($user_id){
			$pending_frd_req = $this->notification_model->getPendingRequestCount($user_id);
		  			if($pending_frd_req){		  			
		  				return $f_count=$pending_frd_req;
		  			}else{
		  				return $f_count=0;
		  			}
		}


	  public function getUnreadMailCount($user_id){
			$unread_mail_count = $this->notification_model->getUnreadMailCount($user_id);
			if($unread_mail_count){		  			
		  				return $m_count=$unread_mail_count;
		  			}else{
		  				return $m_count=0;
		  			}	
		}

		public function	getPendingNotificationCount($user_id){
		$pending_noti_count = $this->notification_model->getPendingNotificationCount($user_id);
			if($pending_noti_count){		  			
		  				return $n_count=$pending_noti_count;
		  			}else{
		  				return $n_count=0;
		  			}
		}

}?>