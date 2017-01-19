<?php 

class Front_transcript extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
	    $this->load->library(array('form_validation','session'));
		$this->load->model('profile_model');		
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

	public function transcriptView(){
		if (!$this->session->userdata('user_exist'))
		        {
		          //If no session, redirect to login page
		           redirect('user', 'refresh');
		           exit();
		        }
		      $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];

		 $privacy_data = $this->profile_model->getPrivacyData($user_id,3);
		 if($privacy_data){
		      if($privacy_data->anyone==1)
			  {	 			  	
			  	$this->transcriptDataView();
			  }
			  if($privacy_data->nobody==1){
			  		echo "<h4>Transcripts</h4><h3 class=\"heading_b heading_b_c uk-margin-bottom\"> You are not authorize to view this information !</h3>";
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

			      	 	$this->transcriptDataView();
			      }

		  		}else{
                    echo "<h4>Transcripts</h4>";
		  			$this->loginView();
		  		}
		  }
		  if($privacy_data->members==1){			  		
		  		$session_user = $this->session->userdata('logged_in');

	 		if($session_user){ 							
					
	 			$profile_user_id = $session_user['user_id'];
	 			$check_membership = $this->profile_model->checkMemberShip($profile_user_id);
	 			if($check_membership){
	 					$this->transcriptDataView();
	 			}else{	
	 			   echo "<h4>Transcripts</h4>";	  		
	  		       echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Your are not member(recruiter) , Please register yourself !</h3>";
	  		       $this->loginView();
	  		     } 			
	 		}else{		
	 		    echo "<h4>Transcripts</h4>";	  		
	  		    echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Your are not member(recruiter) , Please register yourself !</h3>";  		
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
	  					$this->transcriptDataView();
	  				}else{
	  					     echo "<h4>Transcripts</h4>";
	      					$this->load->view('front/privacy_code_view');
	      			    }
	  			}else{
	  				  echo "<h4>Transcripts</h4>";
	      			$this->load->view('front/privacy_code_view');
	      		}
	 	 }
	 	}else{
	 		echo "<h4>Transcripts</h4><h3 class=\"heading_b heading_b_c uk-margin-bottom\">Profile Privacy  still not set</h3>";
	 	}

       }



     public function transcriptDataView(){
     	 $session_data = $this->session->userdata('user_exist');
	     $user_id=$session_data['user_id'];
	     $username=$session_data['username'];

	       $trans_row = array('wgp_table_id','degree_level(degree_level) degree_level',
		    			'academic_grade(academic_grade) academic_grade', 
		    	         'school_year(school_year) school_year', 
		    	         'course_level(course_level) course_level', 
		    	         'course_name(course_name) course_name');

		  	$transcripts_details= $this->fetch_model->transcripts_details($user_id,$trans_row);

		 if($transcripts_details){
				$data = array('transcripts_details'=>$transcripts_details);
			    $this->load->view("front/academic/transcripts_view",$data);
		 }else{
		 	    echo "<h4>Transcripts</h4>";
		     	echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable.</h3>";					
	    }

     }


    public function calendar($year = null, $month = null)
	  {	  	
			if (!$this->session->userdata('user_exist'))
		        {
		          //If no session, redirect to login page
		           redirect('user', 'refresh');
		           exit();
		        }
		      $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];
		  	
		     
		    $event_list=$this->event_model->getEvent($user_id);
			$loop=0;
		    $events = array();
		    if(is_array($event_list)){
		    	foreach ($event_list as $row) {	
		    	     // explode start date for get event day , month  and year		    	  
			    	  $explode_day= explode('-', $row->wgp_event_start);
		    		  //$explode_day= explode('-','10-December-2015-18:41:02');
		    		  		    		  
			    	  if(is_array($explode_day))
			    	  {		    	
		    		   	$day = $explode_day['0'];
		    		   	$event_month = $explode_day['1'];

		    		   	$ex_year = $explode_day['2'];
		    		   	$explode_year = explode(' ', $ex_year);

		    		   	$event_year	= $explode_year['0'];

     		            $event_month =$this->getMonthValue($event_month);
     		           }

		    		 if($month=='')
		    		 {
		    		    $month = date('m');
		    	     }
		    	     if($year=='')
		    	     {
		    		   $year = date('Y');
		    	     }
		        
					
                      if(($event_month==$month)&&($event_year==$year)){
			    		    
			    		    $event_name=$row->wgp_event_name;
			    		   
			    		    if(isset($events[$day]['0'])){	
			    		        ++$loop;			    		        					
			    		    	$events[$day][$loop] = $event_name;				            
			    		    }else{
					         	$events[$day]=array();					         		                                                    	                           
	                            $events[$day]['0']=$event_name;
					         }  		
                      }else{
                       $events[$day]=array();                                             
                      } 

		    	} 
                
		    }

		   		     
		   $mycal =$this->generateCal($year, $month, $events);  	
		  	if($mycal){		  		
		  	  $data = array('mycal' => $mycal);		  	
		  	  $this->load->view("front/calendar_view",$data); 
		  	}
		  			  	   	
		
	  }//Index function End

 public function generateCal($year, $month,$events){
	  	$this->load->library('calendar');
		return	$mycal =$this->calendar->generate($year,$month,$events);	
		    
	  }
function getMonthValue($m){
    if($m=="January"){
        return 1;
    }else if($m=="February"){
        return 2;
    }else if($m=="March"){
        return 3;
    }else if($m=="April"){
        return 4;
    }else if($m=="May"){
        return 5;
    }else if($m=="June"){
        return 6;
    }else if($m=="July"){
        return 7;
    }else if($m=="August"){
        return 8;
    }else if($m=="September"){
        return 9;
    }else if($m=="October"){
        return 10;
    }else if($m=="November"){
        return 11;
    }else if($m=="December"){
        return 12;
    }
}

  } ?>
