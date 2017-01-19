<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserCalendar extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->model('event_model');
		$this->load->model('fetch_model');
	 }

	  public function index($year = null, $month = null)
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
		  	  $data = array('mycal' => $mycal,'acc_type'=>$acc_type);		  	
		  	  $this->load->view("dashboard/calender_view",$data); 
		  	}
		  			  	   	
		
	  }//Index function End

		 public function generateCal($year, $month,$events)
		 {
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

	

	  public function addEvent(){
	  	 if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			
			 $month = $this->input->post('event_month');			
			 $year = $this->input->post('event_year'); 
			 $event_day = $this->input->post('event_date'); 
			 $event_value = $this->input->post('event_value');

			 date_default_timezone_set('Asia/Calcutta');

		    $event_date = $event_day.'-'.$month.'-'.$year.' '.date("H:i:s");

			$data  = array('wgp_user_id' =>$user_id , 
							'wgp_event_name'=>$event_value,
							'wgp_event_start'=>$event_date);

			$status=$this->event_model->addEvent($data);
			if($status){
				echo 1;
			}else{
				echo 0;
			}
			
			
	  }


	  public function addNewEvent(){
	  	 if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];


			$name = $this->input->post('name');
			$level = $this->input->post('level');
			$start_date = strtotime($this->input->post('start_date'));
			$website = $this->input->post('website');
			$event_type = $this->input->post('event_type');
			$event_imp = $this->input->post('event_imp');
			$end_date = strtotime($this->input->post('end_date'));
			$address = $this->input->post('address');			
			
		    $event_start_date=date("j-F-Y H:i:s", $start_date); 
		    $event_end_date=date("j-F-Y H:i:s", $end_date); 
					

			$data = array('wgp_event_name' =>$name,'wgp_event_type'=>$event_type,
						 'wgp_event_start'=>$event_start_date,'wgp_event_end'=>$event_end_date,
						 'wgp_event_level'=>$level,'wgp_event_importance'=>$event_imp,
						 'wgp_address'=>$address,'wgp_event_website'=>$website,
						 'wgp_user_id'=>$user_id);		
		
			$status=$this->event_model->addEvent($data);

	  }


	  public function viewEventDetail(){
	  		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			
			$event_date = $this->input->post('date');
			$row_number = $this->input->post('event_number');

			$event_type = $this->event_model->getEventType();
			$event_importance = $this->event_model->getEventImportance();

			//get sport id
			$user_sport_data = $this->fetch_model->getSportId($user_id);
             $user_sport_id =$user_sport_data->sport;
			// Get level  of sport
			$level_data = $this->fetch_model->getLevel($user_sport_id);	


			$event_detail = $this->event_model->getEventDetail($user_id,$event_date,$row_number);
			
			if($event_detail){
				$data = array('event_detail' => $event_detail,
							  'event_type'=>$event_type,
							  'level_data'=>$level_data,
							  'event_importance'=>$event_importance);
							  	
		  		$this->load->view("dashboard/edit_event_view",$data); 
		  	}else{
		  		echo "Event not Avilable.";
		  	}
	  }

	  public function getEventDetail(){
	  	 if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			
			$event_date = $this->input->post('date');
		    $row_number = $this->input->post('event_number');

		    $event_detail = $this->event_model->getEventDetail($user_id,$event_date,$row_number);
		   // print_r($event_detail);
		      $data ='';	
		    if($event_detail){
		    	$event_name= ucwords($event_detail['wgp_event_name']);		    	
		    	$event_start= $event_detail['wgp_event_start'];
		    	$evt_ary = explode(' ', $event_start);
		    	 $event_date =$evt_ary[0];
		    	 $event_time =$evt_ary[1];

		    	$data .= "Event :$event_name ,Date :$event_date, Time :$event_time";	    	
		    	
		    }
		    echo $data;
	  }

	  
	public  function updateEvent()
	 {
	 	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			
			$wgp_event_id = $this->input->post('wgp_event_id');

			$condition = array('wgp_event_id' =>$wgp_event_id,
								'wgp_user_id'=>$user_id);
			
			$name = $this->input->post('name');
			$level = $this->input->post('level');
			$start_date = strtotime($this->input->post('start_date'));
			$website = $this->input->post('website');
			$event_type = $this->input->post('event_type');
			$event_imp = $this->input->post('event_imp');
			$end_date = strtotime($this->input->post('end_date'));
			$address = $this->input->post('address');			
			
		    $event_start_date=date("j-F-Y H:i:s", $start_date); 
		    $event_end_date=date("j-F-Y H:i:s", $end_date); 
					

			$row = array(
						 'wgp_event_name' =>$name,
						 'wgp_event_type'=>$event_type,
						 'wgp_event_start'=>$event_start_date,
						 'wgp_event_end'=>$event_end_date,
						 'wgp_event_level'=>$level,
						 'wgp_event_importance'=>$event_imp,
						 'wgp_address'=>$address,						 
						 'wgp_event_website'=>$website);
			//print_r($condition);
			//print_r($row);
			

		$update_status = $this->event_model->updateEvent($wgp_event_id,$user_id,$row);

		if($update_status){			
			$this->index();
		}else{
			return false;
		}
	 	
	 }

	 public function deleteEvent()
	 {
	 	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			
			$wgp_event_id = $this->input->post('wgp_event_id');

			$delete_status = $this->event_model->deleteEvent($user_id,$wgp_event_id);
			if($delete_status){
				echo "Succesfully Deleted";
			}else{
				return false;
			}
	 }


	 public function editEventView(){
	  		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			
			$event_id = $this->input->post('event_id');
			

			$event_type = $this->event_model->getEventType();
			$event_importance = $this->event_model->getEventImportance();

			//get sport id
			$user_sport_data = $this->fetch_model->getSportId($user_id);
             $user_sport_id =$user_sport_data->sport;
			// Get level  of sport
			$level_data = $this->fetch_model->getLevel($user_sport_id);	


			$event_detail = $this->event_model->getEventData($user_id,$event_id);
			
			if($event_detail){
				$data = array('event_detail' => $event_detail,
							  'event_type'=>$event_type,
							  'level_data'=>$level_data,
							  'event_importance'=>$event_importance);
							  	
		  		$this->load->view("dashboard/edit_event_view",$data); 
		  	}else{
		  		echo "Event not Avilable.";
		  	}
	  }

	  public function getEvent(){
	  		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			
			$event_id = $this->input->post('event_id');

			$event_detail = $this->event_model->getEventDataDetail($user_id,$event_id);
			
			if($event_detail){
				    $data = array('event_detail' => $event_detail);

				    $this->load->view('theme2/event_detail',$data);

		     }
	  }



}?>