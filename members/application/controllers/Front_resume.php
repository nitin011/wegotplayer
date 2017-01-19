<?php 

class Front_resume extends CI_Controller {

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
		$this->load->model('record_model');
		$this->load->model('event_model');


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

	public function resumeView(){
		if (!$this->session->userdata('user_exist'))
		        {
		          //If no session, redirect to login page
		           redirect('user', 'refresh');
		           exit();
		        }
		      $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];

		      $privacy_data = $this->profile_model->getResumePrivacy($user_id);
		      if($privacy_data){
		      if($privacy_data->anyone==1)
			  {
				 $this->resume();
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
			      	 $this->resume();
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
	 				$this->resume();
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
	  					$this->resume();
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

       public function resume(){

       	if (!$this->session->userdata('user_exist'))
		        {
		          //If no session, redirect to login page
		           redirect('user', 'refresh');
		           exit();
		        }
		      $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];

       		$name=$session_data['name'];
		  	$email=$session_data['email'];
		  	$dp_url=$session_data['dp_url'];
       	//start geting data from users
		  	$row = array(
		      				'birth_year','birth_month','birth_day','first_name',
		      				'last_name','gender','nation_value(nationality) nationality',
		      				'sport_name(sport) sport','address','graduation_month','graduation_year',
		      				'hand_name(hand) hand','foot_name(foot) foot','position_speciality',
		      				'height_value(height) height','weight_value(weight) weight',
		      				'level_name(level) level'		      				
		      	          );
		    $personal_detail = $this->profile_model->getPersonal($user_id,$row);
		    //start geting data from users

		     //start geting data from users
		    $position_id = $personal_detail->position_speciality;
				  	   $position = $this->fetch_model->user_position($position_id);				  	 
				   $position_name = $position->positionName;

		   //start geting data from stats
		    $stats_row =array('wgp_table_id', 'wgp_user_id', 'level_name(level) level', 'season', 'games_played', 
				'games_started', 'goals', 'assists', 'points', 'total_points');
		  	$stats_details= $this->fetch_model->stats_details($user_id,$stats_row);		  	
		  	$season = array();
				   	for($i=2020;$i>1980;$i--){				   		
				   			array_push($season,$i);				   		
				   	}
		    //end geting data from stats

			//start geting honor
			$row = array('wgp_table_id', 'wgp_user_id', 
				  'honor_type(type) type', 'level_name(level) level', 
				  'date_Received', 
				  'award_description(description) description',
				 'awards_honors_name','school_organization_name');
			$honors = $this->fetch_model->getHonors($user_id,$row);
			//end geting honor

			//start get personal info  data
		  $per_info = $this->fetch_model->getPersonalInfo($user_id);
		   if($per_info){

				  	$personal_info=$per_info->message;
				  	$obj=$per_info->objective;
				  	if($obj){
				  		$objective =$obj;
				  	}else{
				  		$objective ="Objective";
				  	}

				  }else{
				  	$personal_info="Personal Information!";
				  	$objective = "Objective";
				  }
			//end get personal info  data		


			$technical = $this->getTechnicalDetail($user_id);

			$tachtical = $this->getTachticalDetail($user_id);

			$physical = $this->getPhysicalDetail($user_id);

			$psyhosocial = $this->getPsyhosocialDetail($user_id);

			//geting seeking and contact you data
			 $seeking_id = $this->user_model->getSeekingId($user_id);
		  	 $contact_id = $this->user_model->getContactId($user_id);


			//get records detail 
		  	 $record_data = $this->record_model->getRecord($user_id);
			 //get Language Detail
		  	 $language_data = $this->record_model->getUserLanguage($user_id);			
			 $language_level = $this->record_model->getLanguageLevel();	

		     $event_detail = $this->event_model->getEventSchedule($user_id);
		     $asked_ref=$this->fetch_model->getAskedReferenceActive($user_id);

			 $row = array('wgp_table_id', 'wgp_user_id','phone','email',
				      'refer_occupation(full_time_occupation) full_time_occupation',
				       'gender', 'level_name(level)  level','organization',
				      'location', 'comment', 'full_name');
			$reference= $this->fetch_model->referenceDetail($user_id,$row);


		   
			$user_data= array('title'=>'WeGotPlayer','dp_url'=>$dp_url,
							  'email'=>$email,'user_id'=>$user_id,'objective'=>$objective,
							  'name'=>$name,'user_detail'=>$personal_detail,
							  'stats_details'=>$stats_details,'season'=>$season,
							  'honors'=>$honors,'personal_info'=>$personal_info,
							  'technical'=>$technical,'tachtical'=>$tachtical,
							  'physical'=>$physical,'psyhosocial'=>$psyhosocial,
							  'record'=>$record_data,'language_data'=>$language_data,
							  'language_level'=>$language_level,'asked_ref'=>$asked_ref,
							  'event_detail'=>$event_detail,'reference'=>$reference,
							  'position'=>$position_name,'seeking'=>$seeking_id,
							  'contact_you'=>$contact_id,);
			
	  		$this->load->view("front/resume_view",$user_data); 
       }


       //genrate resume pdf
       public function resumePdf(){
  			ob_start();
       	if (!$this->session->userdata('user_exist'))
		        {
		          //If no session, redirect to login page
		           redirect('user', 'refresh');
		           exit();
		        }
		      $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];

       		$name=$session_data['name'];
		  	$email=$session_data['email'];
		  	$dp_url=$session_data['dp_url'];

       	//start geting data from users
		  	$row = array(
		      				'birth_year','birth_month','birth_day','first_name',
		      				'last_name','gender','nation_value(nationality) nationality',
		      				'sport_name(sport) sport','address','graduation_month','graduation_year',
		      				'hand_name(hand) hand','foot_name(foot) foot','position_speciality',
		      				'height_value(height) height','weight_value(weight) weight',
		      				'level_name(level) level'		      				
		      	          );
		     $personal_detail = $this->profile_model->getPersonal($user_id,$row);
		    if($personal_detail){
		   		 //start geting data from users
		    		$position_id = $personal_detail->position_speciality;
				  	   $position = $this->fetch_model->user_position($position_id);				  	 
				   $position_name = $position->positionName;
			}else{
				$position_name ='';
			}

		   //start geting data from stats
		    $stats_row =array('wgp_table_id', 'wgp_user_id', 'level_name(level) level', 'season', 'games_played', 
				'games_started', 'goals', 'assists', 'points', 'total_points');
		  	$stats_details= $this->fetch_model->stats_details($user_id,$stats_row);		  	
		  	$season = array();
				   	for($i=2020;$i>1980;$i--){				   		
				   			array_push($season,$i);				   		
				   	}
		    //end geting data from stats

			//start geting honor
			$row = array('wgp_table_id', 'wgp_user_id', 
				  'honor_type(type) type', 'level_name(level) level', 
				  'date_Received', 
				  'award_description(description) description',
				 'awards_honors_name','school_organization_name');
			$honors = $this->fetch_model->getHonors($user_id,$row);
			//end geting honor

				//start get personal info  data
		  $per_info = $this->fetch_model->getPersonalInfo($user_id);
		   if($per_info){

				  	$personal_info=$per_info->message;
				  	$obj=$per_info->objective;
				  	if($obj){
				  		$objective =$obj;
				  	}else{
				  		$objective ="Objective";
				  	}

				  }else{
				  	$personal_info="Personal Information!";
				  	$objective = "Objective";
				  }
			//end get personal info  data	


			$technical = $this->getTechnicalDetail($user_id);

			$tachtical = $this->getTachticalDetail($user_id);

			$physical = $this->getPhysicalDetail($user_id);

			$psyhosocial = $this->getPsyhosocialDetail($user_id);

			//geting seeking and contact you data
			 $seeking_id = $this->user_model->getSeekingId($user_id);
		  	 $contact_id = $this->user_model->getContactId($user_id);

		  	 //get records detail 
		  	 $record_data = $this->record_model->getRecord($user_id);

		  	 //get Language Detail
		  	 $language_data = $this->record_model->getUserLanguage($user_id);			
			 $language_level = $this->record_model->getLanguageLevel();	

			  $asked_ref=$this->fetch_model->getAskedReferenceActive($user_id);
			 $event_detail = $this->event_model->getEventSchedule($user_id);

			 $row = array('wgp_table_id', 'wgp_user_id','phone','email',
				      'refer_occupation(full_time_occupation) full_time_occupation',
				       'gender', 'level_name(level)  level','organization',
				      'location', 'comment', 'full_name');
			$reference= $this->fetch_model->referenceDetail($user_id,$row);
		   
			$user_data= array('title'=>'WeGotPlayer','dp_url'=>$dp_url,
							  'email'=>$email,'user_id'=>$user_id,
							  'position'=>$position_name,'seeking'=>$seeking_id,
							  'contact_you'=>$contact_id,'objective'=>$objective,
							  'name'=>$name,'user_detail'=>$personal_detail,
							  'stats_details'=>$stats_details,'season'=>$season,
							  'honors'=>$honors,'personal_info'=>$personal_info,
							  'technical'=>$technical,'techtical'=>$tachtical,
							  'physical'=>$physical,'psyhosocial'=>$psyhosocial,
							  'record'=>$record_data,'language_data'=>$language_data,
							  'language_level'=>$language_level,'asked_ref'=>$asked_ref,
							  'event_detail'=>$event_detail,'reference'=>$reference);
 				
	     $html =$this->load->view("front/pdf_resume_view",$user_data,true);
			
        //this the the PDF filename that user will get to download
		$pdfFilePath = "resume_".$user_id.".pdf";

       
		require_once APPPATH.'/third_party/pdf/dompdf_config.inc.php';
		require_once APPPATH.'/third_party/pdf/include/dompdf.cls.php';
		$dompdf = new DOMPDF();
		
		$dompdf->set_paper("A4");
		
		//$font = Font_Metrics::get_font("Roboto");
		//$dompdf->set_paper(array(0, 0, 595, 841), 'portrait');
		$url ="/home/adepttes/public_html/wegot/pdf/uploads/".$pdfFilePath;
		
		
		$dompdf->load_html($html);
		$dompdf->render(); 		
		$dompdf->stream();		
		$output = $dompdf->output();

		file_put_contents($url, $output);

		
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


  } ?>
