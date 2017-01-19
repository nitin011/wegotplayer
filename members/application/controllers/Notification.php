<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
	    $this->load->library(array('form_validation','session'));				
		$this->load->model('notification_model');     
		
		
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


			$frnd_req_noti_list = $this->getUnreadNotification($user_id);
			if($frnd_req_noti_list){
					$data = '';				
				foreach ($frnd_req_noti_list as $key => $row) {

					$notifier_id = $row->notification_assets;
					if($notifier_id==0){
						$name= "Guest";
					}else{

						$notifier_row = $this->notification_model->getNotifierName($notifier_id);
						$name= ucwords($notifier_row->name);
					}

					$id=$row->id;
					$notification_type=$row->notification_type;
					$notification_date=date("M d, Y h:i:A", strtotime($row->notification_date));

					$master_format=$this->getNotificationText($notification_type);

					$notification_name = $master_format->notification_name;
					$notification_text = $master_format->notification_text;

					$message=sprintf($notification_text,$name);

									
                    $data .="<li><a onclick=\"showNotiDate($id)\"><div class=\"md-list-content\">";
                    $data .="<span class=\"md-list-heading md-list-heading-adept\">$notification_name <div class=\"noti_date\" id=\"noti_date_id_$id\" style=\"display:none\">$notification_date</div></span>";
                    $data .="<span class=\"uk-text-small uk-text-muted uk-text-truncate uk-text-muted-adept\">$message</span>";
                    $data .="</div></a></li>";

                    
				}echo $data;
			}else{
				echo "<li>No notification !</li>";
			}

    }
    public function view(){
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
		  	$data = '';	
		  		$frnd_req_noti_list = $this->getNotification($user_id);
			if($frnd_req_noti_list){
								
				foreach ($frnd_req_noti_list as $key => $row) {

					$notifier_id = $row->notification_assets;
					if($notifier_id==0){
						$name= "Guest";
					}else{

						$notifier_row = $this->notification_model->getNotifierName($notifier_id);
						$name= ucwords($notifier_row->name);
					}

					$notification_type=$row->notification_type;

					$master_format=$this->getNotificationText($notification_type);

					$notification_name = $master_format->notification_name;
					$notification_text = $master_format->notification_text;
					$notification_date =$row->notification_date;
					$n_date = date("M d, Y h:i:A", strtotime($notification_date));
					$message=sprintf($notification_text,$name);
					$number =$key+1;
    				$data .="<li><span class=\"number\">$number</span>";
                    $data .="<span class=\"noti_name\">$notification_name</span>";
                    $data .="<span class=\"noti_msg\">$message</span>";
                     $data .="<span class=\"noti_date\">$n_date</span>";
                    $data .="</li>";

                    
				} 
			}else{
				$data .= "<li>No notification !</li>";
			}

			
            
				//geting pending friend request count 
		  	$f_count=$this->getPendingReqestCount($user_id);
		  	//geting unread mail count 
		  	$m_count=$this->getUnreadMailCount($user_id);

		  	$n_count = $this->getPendingNotificationCount($user_id);

			
			$user_data= array('title'=>'WeGotPlayer', 'data'=>$data,
							  'email'=>$email,'user_id'=>$user_id,
							  'f_count'=>$f_count,'m_count'=>$m_count,
							  'n_count'=>$n_count,'name'=>$name);
	  		$this->load->view("header-home",$user_data);
	  		$this->load->view("notification_view");
	  		$this->load->view("footer_out_view");
	  		$this->load->view("footer");
	  		
    }



    //start get Friend Request Notification
	public function getUnreadNotification($user_id){
		 		$frnd_req_result=$this->notification_model->getUnreadNotification($user_id);
		 		if($frnd_req_result){
		 			return $frnd_req_result;
		 		}else{
		 			return false;
		 		}
		 }//start get Friend Request Notification

	public function getNotificationText($notification_type){
					return $this->notification_model->getNotificationText($notification_type);
				}

		//start get Friend Request Notification
	public function getNotification($user_id){
		 		$frnd_req_result=$this->notification_model->getNotification($user_id);
		 		if($frnd_req_result){
		 			return $frnd_req_result;
		 		}else{
		 			return false;
		 		}
		 }//start get Friend Request Notification

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

		public function updateNotificationStatus()
		{			
			if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$this->notification_model->updateNotificationStatus($user_id);
		}






}


