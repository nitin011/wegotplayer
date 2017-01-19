<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  
class Home extends CI_Controller{

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
		$this->load->model('event_model');
		$this->load->model('record_model');	

		   function isEmail($email){
				//If the username input string is an e-mail, return true
				if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
					return true;
				} else {
					return false;
				}
	        }//function end		
	 }
	    

 public function index(){
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

		  	$profile_view_count = $this->theme2_model->getProfileViewCount($user_id);	
		  	$friend_count = $this->theme2_model->getFriends($user_id);	

		  
			$user_data= array('title'=>'WeGotPlayer','f_count'=>$f_count,
							  'm_count'=>$m_count,'n_count'=>$n_count,'acc_type'=>$acc_type,
							  'email'=>$email,'user_id'=>$user_id,'name'=>$name);
		  //start geting data from users

			$profile_pic_status = $this->photo_model->checkProfilePic($user_id);	  

		    $detail = $this->theme2_model->getPersonalDetails($user_id);


		    if($detail){
		    	$nationality = $detail->nationality;
		    	$location_short = $this->theme2_model->getShortLocationName($nationality);
		    }

		    $user_detail = $this->theme2_model->getUserDetails($user_id);
		    $seeking_id = $this->user_model->seekingId($user_id);
		    $seeking = $this->user_model->getSeekingId($user_id);
		    $seeking_list = $this->fetch_model->getSeeking();
		    $personal_info = $this->theme2_model->getPersonalInfo($user_id);

		    $school= $this->fetch_model->school_details($user_id);

		   // Get sport id 
			$user_sport_data = $this->fetch_model->getSportId($user_id);
            $user_sport_id =$user_sport_data->sport;
			// Get level  of sport
			$level_data = $this->fetch_model->getLevel($user_sport_id);

			//get position 
			$position_data = $this->fetch_model->getSportPosition($user_sport_id);

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


			$sport_list = $this->fetch_model->sport();
	   		$hand_list = $this->fetch_model->hand();
	   		$foot_list = $this->fetch_model->foot();
	   		$height_list = $this->fetch_model->height();
	   		$weight_list = $this->fetch_model->weight();
	   		$nation_list = $this->fetch_model->nation();

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


		  	//get records detail 
		  	 $record_data = $this->record_model->getRecord($user_id);


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

		    


		    $new_wall = array();

		    if(!empty($latest_wall)){
			    foreach ($latest_wall as $key => $row) {
			    	$new_wall[$key]['content'] = base64_decode($row->content);
			    	$new_wall[$key]['post_date'] = $row->post_date;
			    }
			}

		    

		     //Percentes of technical,techtiacal

		     $per_technical = $this->getTechnicalDetail($user_id);

			 $per_tachtical = $this->getTachticalDetail($user_id);

			 $per_physical = $this->getPhysicalDetail($user_id);

			 $per_psyhosocial = $this->getPsyhosocialDetail($user_id);


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
			   	  	 'height'=>$height_list,'weight'=>$weight_list,'nation'=>$nation_list,
			   	  	 'event_type'=>$event_type,'event_importance'=>$event_importance,
			   	  	 'profile_pic_status'=>$profile_pic_status,'location_short'=>$location_short,
			   	  	 'stats_details'=>$stats_details,'seas'=>$season,
			   	  	 'language_level'=>$language_level ,'user_language'=>$language_data,
			   	  	 'injur' =>$injur,'recovered'=>$recovered,'image_list'=>$image_list,
			   	  	 'transcripts_details'=>$transcripts_details,
			   	  	 'tech_details'=>$tech_details,'tact_details'=>$tact_details,
			   	  	 'physical'=>$physical,'psy_details'=>$psy_details,
			   	  	 'latest_wall'=>$new_wall,'position_data'=>$position_data,
			   	  	 'per_technical'=>$per_technical,'per_tachtical'=>$per_tachtical,
			   	  	 'per_physical'=>$per_physical,'per_psyhosocial'=>$per_psyhosocial,
			   	  	 'record'=>$record_data,'profile_view_count'=>$profile_view_count,
			   	  	 'friend_count'=>$friend_count
			   	  	 ];

	  	     //$this->load->view('theme2/header');
	  		 $this->load->view('theme2/content',$data);
	  		/*$this->load->view('footer_view');	*/
			//$this->load->view("footer");
		
	  }//Index function End


	 

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

		public function inviteFriends(){
			$this->load->view("dashboard/invite_friend_view");
		}

		public function sendInvitation(){
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

		  	$f_name =$this->input->post('name');
		  	$f_email =$this->input->post('email');  	
		  	$mail_status =0;
		  for ($i=1; $i<=count($f_name) ; $i++) { 
		  	   
		  	   	$friend_name= $f_name[$i];
		  	   	$friend_email= $f_email[$i];
		  
		  		$url=base_url()."user/register";

		  	  //  $to=$friend_email;
		  	  
		  	    $to=$friend_email;
				$to =  strip_tags("$to");									
				//$from=$email;
				$from='noreply@wegotplayers.com';
				$from =  strip_tags("$from");									
				$subject=' Invitation from '.ucwords($name).' to join WeGotPlayers';	
									
				$headers = "from: WeGotPlayers <".$from.">\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";														  
				$message  = '<html><body>';
				$message .= '<h3>Hello '.ucwords($friend_name).',</h3>';								
				$message .= '<p> '.ucwords($name).' would like you to join WeGotPlayers.com to build and promote yourself with a powerful resume so you can compete at the next level </p><br>';
				$message .= '<p>Please click the link below to register for FREE<br><a href="'.$url.'">'.$url.'</a>.</p>';
				$message .= "<p>Good luck in your sports journey and don't forget to thank '.ucwords($name).' for helping you out. </p>";
				$message .= '<p>Thanks!<br><br>The WeGotPlayers Team</p>';
				$message .= "<br><span>P.S This message was sent using the WeGotPlayers platform. Please don't replay to this email address.</span>";
				//$message .= '<p>Thanks!<br><br>'.ucwords($name).'</p>';
				$message .= "</body></html>";
									
				$sendmail=mail($to, $subject, $message, $headers);
			   if ($sendmail) {
			   	   $mail_status +=1;
			   }else{
			   	   $mail_status +=0;
			   }
			}
			if($mail_status==count($f_name)){
				echo $mail_status;
			}else{
				echo 0;
			}
		}

		public function shareProfileView(){
			if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$acc_type=$session_data['acc_type'];
			$data = array('acc_type' => $acc_type);
			$this->load->view("dashboard/share_profile_view",$data);
		}

		public function shareProfile(){
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

		    $f_name =$this->input->post('name');
		  	$f_email =$this->input->post('email');
		  	$f_code =$this->input->post('code');

		  	$profile_detail = $this->profile_model->getCodeAndUsername($user_id);

		  if($profile_detail){		  
		  	    $username = $profile_detail->login_name;
		  	    $unique_code = $profile_detail->unique_code;
		  	$mail_status =0;
		  for($i=1; $i <=count($f_name) ; $i++) { 
		  	   	$friend_name= $f_name[$i];
		  	   	$friend_email= $f_email[$i];
		  	   	if($f_code[$i]==1){
					$msg= '<p>Unique Code :'.$unique_code.' (this code will allow you to view more information)</p>';
				 }else {

				 	$msg="";
				 }

		  		$url=base_url()."profile/".$username;

		  	    $to=$friend_email;
				$to =  strip_tags("$to");									
				//$from=$email;
				$from='noreply@wegotplayers.com';
				$from =  strip_tags("$from");									
				$subject=ucwords($name).' would like share their WeGotPlayers profile with you';	
									
				$headers = "from: WeGotPlayers<".$from.">\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";														  
				$message  = '<html><body>';
				$message .= '<h3>Hello '.ucwords($friend_name).',</h3>';

				$message .= '<h4>'.ucwords($name).'  would like to share their WeGotPlayers.com sports profile with you. You can view the profile using the following details:</h4>';								
				$message .= '<p>Profile URL : <a href="'.$url.'">'.$url.'</a>.</p>';
				$message .= $msg;
				$message .= '<p>Thanks!<br><br>The WeGotPlayers Team</p>';
				$message .= "<br><span>P.S This message was sent using the WeGotPlayers platform. Please don't replay to this email address.</span>";
				//$message .= '<p>Thanks! <br><br>'.ucwords($name).'</p>';
				$message .= "</body></html>";
									
				$sendmail=mail($to, $subject, $message, $headers);
			   if ($sendmail) {
			   	   $mail_status +=1;
			   }else{
			   	  $mail_status +=0;
			   }
			}
			if($mail_status==count($f_name)){
				echo $mail_status;
			}else{
				echo 0;
			}
		  }
		}


		public function updateProfileUrl(){
			if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$username =$this->input->post('username');
			$data = array('login_name'=>$username);
			$this->profile_model->updateProfileUrl($user_id,$data);
		}
		public function expertAdviceView(){
			if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$acc_type=$session_data['acc_type'];
			$data = array('acc_type' => $acc_type);
			$this->load->view("dashboard/expert_advice_view",$data);
		}

		public function sendExpertAdvice(){
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

		    $sub =$this->input->post('subject');
		  	$msg =$this->input->post('message');


		  	    $to='support@wegotplayers.com';
				$to =  strip_tags("$to");									
				$from=$email;
				$from =  strip_tags("$from");									
				$subject='WeGotPlayers Expert Advice '.$sub;	
									
				$headers = "from: WeGotPlayer<".$from.">\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";														  
				$message  = '<html><body>';
				$message .= '<h3>Hello,</h3>';								
				$message .= '<p>Message : '.$msg.'.</p>';
				$message .= '<p>Thanks Regard <br>'.ucwords($name).'</p>';
				$message .= "</body></html>";
									
				$sendmail=mail($to, $subject, $message, $headers);
			   if ($sendmail) {
			   	   echo 1;
			   }else{
			   	  echo 0;
			   }

		}


		public function addMoreField(){	
			if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$acc_type=$session_data['acc_type'];


		  $count = $this->input->post('count');		

			$data ='<div class="row"><div class="col-md-4">
						<div class="uk-form-row">
								<label for="name"></label>
								<input type="text" title="'.$count.'" id="name_i" name="name" required class="form-control" placeholder="Name"/>
						</div>
					</div>
				  <div class="col-md-4">
					   <div class="uk-form-row">				
						   <label for="email"></label>
							<input type="email" title="'.$count.'" id="email_i"  name="email" required class="form-control" placeholder="Email"/>
						</div>
					</div>
					<div class="col-md-4 share_radio">';
					if(($acc_type=='PRO')||($acc_type=='PLUS')){ 
				$data .='<span class="label_command"><input type="radio" title="'.$count.'" id="private" name="private_code_'.$count.'" value="1" >
						<label class="inline-label">Yes</label></span>

						<span class="label_command"><input type="radio" title="'.$count.'" id="private" name="private_code_'.$count.'" value="0" checked>
						<label class="inline-label">No</label></span>';				    
                       }
                 $data .= '</div></div>';				

			echo $data;
		}

		public function addMore(){	
			
		  $count = $this->input->post('count');		

			$data ='
			<div class="col-md-5">
						<div class="uk-form-row">
								<label for="name"></label>
								<input type="text" title="'.$count.'" id="name_i" name="name" required class="form-control" placeholder="Name"/>
						</div>
					</div>
				  <div class="col-md-5">
					   <div class="uk-form-row">				
						   <label for="email"></label>
							<input type="email" title="'.$count.'" id="email_i"  name="email" required class="form-control" placeholder="Email"/>
						</div>
					</div>
					<div class="col-md-2">';
					
				echo '</div>';

			echo $data;
		}

		 public function getTechnicalDetail($user_id){
	  		//start geting technical details
			$tech_details= $this->fetch_model->technical_details($user_id);
			if($tech_details){
			
			$total=0;			
			$sum =0;
			$count=1;
			foreach ($tech_details as $key => $value) {
				if(($key=='wgp_table_id') || ($key=='wgp_user_id') ){
					continue;
				}else{
					 
					$total =  $count*10;					
					$sum +=$value;	
					$count++;				 				
				}
			}

			   $avg = $sum/($count-1);
			   $per =  ($sum/$total)*100;
			   $percent =number_format($per, 2);

			return $technical = array('total' =>$total,'percent' =>$percent,
							   'sum'=>$sum,'average'=>$avg
							  );

				}
				else{
					return	$technical= array('total' =>0,'percent' =>0,
							   'sum'=>0,'average'=>0
							  );
				}
			//end geting technical details	
	  }

	  public function getTachticalDetail($user_id){
	  		//start geting techtical details
			$tact_details= $this->fetch_model->tactical_details($user_id);
			if($tact_details){
			
			$total=0;			
			$sum =0;
			$count=1;
			foreach ($tact_details as $key => $value) {

				if(($key=='wgp_table_id') || ($key=='wgp_user_id') ){
					continue;
				}else{
					 
					$total =  $count*10;					
					$sum +=$value;	
					$count++;				 				
				}
			}

			   $avg = $sum/($count-1);
			   $per =  ($sum/$total)*100;
			   $percent =number_format($per, 2);

			return $techtical = array('total' =>$total,'percent' =>$percent,
							   'sum'=>$sum,'average'=>$avg
							  );	
				}else{
					return	$techtical= array('total' =>0,'percent' =>0,
							   'sum'=>0,'average'=>0
							  );
				}		
			//end geting techtical details
	  }

	  public function getPhysicalDetail($user_id){
	  		//start geting physical details
		$physical_details= $this->fetch_model->physical_details($user_id);
		if($physical_details){
			
			$total=0;			
			$sum =0;
			$count=1;
			foreach ($physical_details as $key => $value) {

				if(($key=='wgp_table_id') || ($key=='wgp_user_id') ){
					continue;
				}else{
					 
					$total =  $count*10;					
					$sum +=$value;	
					$count++;				 				
				}
			}

			   $avg = $sum/($count-1);
			   $per =  ($sum/$total)*100;
			   $percent =number_format($per, 2);

		return	$physical = array('total' =>$total,'percent' =>$percent,
							   'sum'=>$sum,'average'=>$avg
							  );
		}else{
			return	$physical= array('total' =>0,'percent' =>0,
							   'sum'=>0,'average'=>0
							  );
		   }										
			//end geting physical details
	  }

	  public function getPsyhosocialDetail($user_id){
	  			//start geting Psyhosocial details
			$psy_details= $this->fetch_model->psyhosocial_details($user_id);
			if($psy_details){
			
			$total=0;			
			$sum =0;
			$count=1;
			foreach ($psy_details as $key => $value) {

				if(($key=='wgp_table_id') || ($key=='wgp_user_id') ){
					continue;
				}else{
					 
					$total =  $count*10;					
					$sum +=$value;	
					$count++;				 				
				}
			}

			   $avg = $sum/($count-1);
			   $per =  ($sum/$total)*100;
			   $percent =number_format($per, 2);

			return $psyhosocial = array('total' =>$total,'percent' =>$percent,
							   'sum'=>$sum,'average'=>$avg
							  );
				}
				else{
			return	$psyhosocial= array('total' =>0,'percent' =>0,
							   'sum'=>0,'average'=>0
							  );
		   }										
			//end geting Psyhosocial  details
	  }



	  public function basicDetail(){

	  	   if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$name=$session_data['name'];

            $detail = $this->theme2_model->getPersonalDetails($user_id);
	        $seeking_id = $this->user_model->seekingId($user_id);

		    $seeking = $this->user_model->getSeekingId($user_id);

	  	    $user_detail = $this->theme2_model->getUserDetails($user_id);

		    $seeking_list = $this->fetch_model->getSeeking();

		    $sport_list = $this->fetch_model->sport();
	   		$hand_list = $this->fetch_model->hand();
	   		$foot_list = $this->fetch_model->foot();
	   		$height_list = $this->fetch_model->height();
	   		$weight_list = $this->fetch_model->weight();
	   		$nation_list = $this->fetch_model->nation();


	   		$data = ['name'=>$name,'detail'=>$detail,'seeking'=>$seeking,
	   		         'seeking_list'=>$seeking_list,'seeking_id'=>$seeking_id,
	  				 'user_detail'=>$user_detail,	  				 
			   	  	 'sport'=>$sport_list,'hand'=>$hand_list,'foot'=>$foot_list,
			   	  	 'height'=>$height_list,'weight'=>$weight_list,'nation'=>$nation_list,			   	  	 
			   	  	 ];

	  	     //$this->load->view('theme2/header');
	  		 $this->load->view('home/edit_basic_detail',$data);
	  }


}
