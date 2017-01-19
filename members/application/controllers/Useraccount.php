<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Useraccount extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
	    $this->load->library(array('form_validation','session'));
		//$this->load->library('encrypt');
		$this->load->model('account_model');
		$this->load->model('user_model');
		$this->load->model('photo_model');
		$this->load->model('notification_model');
		$this->load->model('theme2_model');
		$this->load->model('fetch_model');
		$this->load->model('record_model');
		$this->load->model('video_model');	
		
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

		  	 $user_detail = $this->theme2_model->getUserDetails($user_id);


		  	$profile_pic_status = $this->photo_model->checkProfilePic($user_id);

		  	$detail = $this->theme2_model->getPersonalDetails($user_id);

		  	 $personal_info = $this->theme2_model->getPersonalInfo($user_id);

		  	  $school= $this->fetch_model->school_details($user_id);

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
   			$ref_row = array('wgp_table_id', 'wgp_user_id','phone','email',
				      'refer_occupation(full_time_occupation) full_time_occupation',
				       'gender', 'level_name(level)  level','organization',
				      'location', 'comment', 'full_name');
			$reference= $this->fetch_model->referenceDetail($user_id,$ref_row);

			$asked_ref=$this->fetch_model->getAskedReference($user_id);
			$stats_row =array('wgp_table_id', 'wgp_user_id', 'level_name(level) level', 'season', 'games_played', 
				'games_started', 'goals', 'assists', 'points', 'total_points');
		  	$stats_details= $this->fetch_model->stats_details($user_id,$stats_row);
			
			$lang_row = array('id','lang_level_name(level) level_name','level','language');
			$language_data = $this->record_model->getLanguage($user_id,$lang_row);
			
			//Get User Injur 
		    $injur_row = array('wgp_table_id','wgp_user_id', 
						'injury_type(type_of_injury) type_of_injury',
					    'body_part(body_part) body_part', 
						'body_area(body_area) body_area','recovered', 
						'surgery_name(surgery) surgery', 
						'when');
			
			$injur = $this->fetch_model->getInjur($user_id,$injur_row);


			$trans_row = array('wgp_table_id','degree_level(degree_level) degree_level',
		    			'academic_grade(academic_grade) academic_grade', 
		    	         'school_year(school_year) school_year', 
		    	         'course_level(course_level) course_level', 
		    	         'course_name(course_name) course_name');

		  	$transcripts_details= $this->fetch_model->transcripts_details($user_id,$trans_row);

		  	 $photo_album = $this->photo_model->getAlbum($user_id);

		  	 $video_count =$this->video_model->videoCount($user_id);

		  	 $events = $this->theme2_model->getEvent($user_id);

		  	 $tech_details= $this->fetch_model->technical_details($user_id);

		  	  $tech_details= $this->fetch_model->technical_details($user_id);
		    $tact_details= $this->fetch_model->tactical_details($user_id);
		    $physical= $this->fetch_model->physical_details($user_id);
		    $psy_details= $this->fetch_model->psyhosocial_details($user_id);


		    // Get latest three wall
		     $latest_wall = $this->theme2_model->getLatestPost($user_id);

		  	$clicked=$this->input->post('clicked');
		  	if($clicked!=''){
		  		$data = array('clicked' => $clicked,'profile_pic_status'=>$profile_pic_status,
		  			          'detail'=>$detail,'personal_info'=>$personal_info,
		  			          'school'=>$school,'teaminfo'=>$teaminfo,
		  			          'transcripts_details'=>$transcripts_details,
		  			          'stats_details'=>$stats_details,'photo_album'=>$photo_album,
		  			          'video_count'=>$video_count,'reference' =>$reference,'asked_ref'=>$asked_ref,
		  			          'events'=>$events,'injur' =>$injur,
		  			          'tech_details'=>$tech_details,'tact_details'=>$tact_details,
			   	  	 		  'physical'=>$physical,'psy_details'=>$psy_details,
			   	  	 		  'latest_wall'=>$latest_wall,'user_language'=>$language_data,);
		  	}else{
		  		$clicked ='account_type_tab';
		  		$data = array('clicked' => $clicked,'profile_pic_status'=>$profile_pic_status,
		  					'detail'=>$detail,'personal_info'=>$personal_info,
		  					'school'=>$school,'teaminfo'=>$teaminfo,
		  					'transcripts_details'=>$transcripts_details,
		  					'stats_details'=>$stats_details,'photo_album'=>$photo_album,
		  					'video_count'=>$video_count,'reference' =>$reference,
		  					'asked_ref'=>$asked_ref,'events'=>$events,'injur' =>$injur,
		  					'tech_details'=>$tech_details,'tact_details'=>$tact_details,
			   	  			'physical'=>$physical,'psy_details'=>$psy_details,
			   	  			'latest_wall'=>$latest_wall,'user_language'=>$language_data,
			   	  			'user_detail'=>$user_detail);
		  	}		  
		  
			//geting pending friend request count 
		  	$f_count=$this->getPendingReqestCount($user_id);
		  	//geting unread mail count 
		  	$m_count=$this->getUnreadMailCount($user_id);

		  	$n_count = $this->getPendingNotificationCount($user_id);

		  
			$user_data= array('title'=>'WeGotPlayer','f_count'=>$f_count,
							  'm_count'=>$m_count,'n_count'=>$n_count,'acc_type'=>$acc_type,
							  'email'=>$email,'user_id'=>$user_id,'name'=>$name);
		  //start geting data from users
			$this->load->view("header-home",$user_data);
	  		$this->load->view("account/account_view",$data);
	  		//$this->load->view("footer"); 
		  

	  }//Index function End


	  public function activate()
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
		  
			$user_data= array('title'=>'WeGotPlayer',
							  'email'=>$email,'user_id'=>$user_id,'name'=>$name);	  
			$this->load->view("activate/header" ,$user_data);
			
	  		$this->load->view("activate/activate_view");
	  		$this->load->view("footer"); 
	  		
		  

	  }//Index function End

	  public function basicSetingView()
	  {
	  	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$email=$session_data['email'];

			$data = array('email'=>$email);

			$this->load->view("account/basic_view",$data);

	  }

	  public function accountTypeView(){
	  		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			 $user_id=$session_data['user_id'];
			 $email=$session_data['email'];
			 $dp_url=$session_data['dp_url'];

			
			$row = array('name','reg_time','account_type_name(account_type) acc_type','account_type' );

			
			$account_detail = $this->account_model->getAccountDetail($user_id,$row);			
			
			if($account_detail){
				
			  $data  = array('user_detail' =>$account_detail,'email'=>$email,'dp_url'=>$dp_url);	
			  		
				$this->load->view("account/account_type_view",$data);
			}else{
				echo "User Detail not avilable !";
			}

			
	  }

	  public function changePassword()
	  {
	  	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$email=$session_data['email'];

		    $password = md5(md5($this->input->post('current_pass')));
			$confirm_pass = md5(md5($this->input->post('confirm_pass')));

			if($password == $confirm_pass)
			{       
		   		 $data = array('password' => $password,'user_id'=>$user_id);
		  		$success= $this->account_model->updatePassword($data);
		  		if($success){
		  			echo "Password Saved";
		  		}else{
		  			echo "Try Again";
		  		}
		    }else{
		  		echo "Password Should be Same";
		  	}
	  }//end of change password function 


	  public function privacySettingView()
	  {
	  	  if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$privacy_data = $this->account_model->getPrivacySettings();
			$create_privacy =$this->account_model->insertPrivacyDefault($user_id);

			if($create_privacy){	
			     $privacy_value=$this->account_model->getPrivacyValue($user_id);
			    	
				 $data = array('privacy_data' => $privacy_data ,'privacy_value'=>$privacy_value);
				 $this->load->view("account/privacy_view",$data);
		    }else{
		    	echo "Privacy data not avilable";
		    }
	  }

	  public function accountView(){
	  	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$this->load->view("sidebar");			
			$this->load->view("account/account_view");
			$this->load->view("footer");
	  }

	  public function notifySettingView(){
	  	  if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			//$notification_data = $this->account_model->getNotificationSettings();

			$create_noti = $this->account_model->insertNotificationDefault($user_id);

			if($create_noti)
			{	 
			     $noti_value=$this->account_model->getNotificationValue($user_id);	
			     	
			     $data = array('notifiy'=>$noti_value);
			     $this->load->view("account/notification_view",$data);
			}
	  }

	  public function plusFunctions()
	  {
	  	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$acc_type=$session_data['acc_type'];

			$unique_id= $this->account_model->getUniqueId($user_id);
			
			
			 $data = array('unique_id'=>$unique_id,'acc_type' => $acc_type);
			$this->load->view("account/plus_function_view",$data);

	  }

	  public function generateUniqueId(){

	  	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

	  	$result= $this->account_model->generateUniqueId($user_id);
	  	if($result){
	  		$unique_id= $this->account_model->getUniqueId($user_id);
	  		return print_r($unique_id->unique_code);
	  	}         
	  }

	  public function deactivateView()
	  {
	  	 if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$this->load->view("account/deactivate_view");

	  }

	  public function deactivateId(){
	  	  if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$success= $this->account_model->deactivateProfile($user_id);

			if($success){
				echo 1;				
			}
			else{
				echo 0;
			}
	  }

	  public function activateProfile(){
	  		 if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$success= $this->account_model->activateProfile($user_id);

			if($success){
				redirect(site_url('user'));
			}
			else{
				echo 0;
			}
	  }

	  public function privacySettingValue(){
	  	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$privacy = $this->input->post('privacy');

		
			
			$privacy_data = array(
				                   'user_id' => $user_id
				                 );
			$row_val=array();	

			for($i = 1; $i <= count($privacy); $i++){
			

				    foreach ($privacy as $key => $value) {

				    	if($value==$i){	

				    	   $arr=explode(",",$value);

				    	     $row = $arr[0]; 

				    	     $row_val = explode(':', $row)	;	    	    

				    	   echo "<pre>";
					    	print_r($row_val);
					     
				    	}
				    	
				    }				   		

					$array = array('privacy_id' => $i);
			        array_push($privacy_data,$array);
			    }	

	  }

	  public function updatePrivacy(){
	  	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
		      $user_id=$session_data['user_id'];

		    $privacy_id = $this->input->post('privacy_id');
		    $col_id = $this->input->post('col_id');		   

		    $anyone = $this->input->post('anyone');
		    $nobody = $this->input->post('nobody');
		    $friends = $this->input->post('friends');
		    $members = $this->input->post('members');
		    $code_receivers = $this->input->post('code_receivers');
		     

            $condition =array('user_id' =>$user_id,'privacy_id'=>$privacy_id);

		    $data  = array('anyone'=>$anyone,'nobody'=>$nobody,
		    	           'friends'=>$friends,'members'=>$members,
		    	           'code_receivers'=>$code_receivers);
		    //print_r($condition);
		    //print_r($data);
		  $update = $this->account_model->updatePrivacy($condition,$data);

	  }

	  public function updateNotification()
	  {
	  	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
		    $user_id=$session_data['user_id'];

		    $notification_id_1 = $this->input->post('notification_id_1');
		    $notification_id_2 = $this->input->post('notification_id_2');
		    $notification_id_3 = $this->input->post('notification_id_3');
		    $notification_id_4 = $this->input->post('notification_id_4');
		    $notification_id_5 = $this->input->post('notification_id_5');
		    $notification_id_6 = $this->input->post('notification_id_6');
		    $notification_id_7 = $this->input->post('notification_id_7');
		    $notification_id_8 = $this->input->post('notification_id_8');
		    $notification_id_9 = $this->input->post('notification_id_9');
		    $notification_id_10 = $this->input->post('notification_id_10');
		    $notification_id_11 = $this->input->post('notification_id_11');
		    $notification_id_12 = $this->input->post('notification_id_12');
		    $notification_id_13 = $this->input->post('notification_id_13');
		    $notification_id_14 = $this->input->post('notification_id_14');

		    $data = array(  'notification_id_1'=>$notification_id_1,
					    	'notification_id_2'=>$notification_id_2,
					    	'notification_id_3'=>$notification_id_3,
					    	'notification_id_4'=>$notification_id_4,
					    	'notification_id_5'=>$notification_id_5,
					    	'notification_id_6'=>$notification_id_6,
					    	'notification_id_7'=>$notification_id_7,
					    	'notification_id_8'=>$notification_id_8,
					    	'notification_id_9'=>$notification_id_9,
					    	'notification_id_10'=>$notification_id_10,
					    	'notification_id_11'=>$notification_id_11,
					    	'notification_id_12'=>$notification_id_12,
					    	'notification_id_13'=>$notification_id_13,
					    	'notification_id_14'=>$notification_id_14
					    	);
			//print_r($data); 
		    $status=$this->account_model->updateNotification($user_id,$data);		
			        

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


}