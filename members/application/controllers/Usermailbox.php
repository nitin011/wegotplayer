<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usermailbox extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
	    $this->load->library(array('form_validation','session'));
		//$this->load->library('encrypt');
		$this->load->model('fetch_model');
		$this->load->model('user_model');
		$this->load->model('user_mail');
		$this->load->model('notification_model');
		$this->load->model('user_post');
		
		
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

			

		  
		

			//fetch login user friends list with their images
			$success  = $this->user_mail->fetch_friend_list($user_id);
						
			//fetch login user lastest unread messages mail_date
			$lastest_date  = $this->user_mail->lastest_msg_date($user_id);
			
	  	$user_data= array(
		                  'title'=>'WeGotPlayer',
						  'email'=>$email,
						  'user_id'=>$user_id,
						  'name'=>$name,
						  'success'=>$success,
						  'lastest_date'=>$lastest_date,
						  'f_count'=>$f_count,'m_count'=>$m_count,
						  'n_count'=>$n_count,'acc_type'=>$acc_type,
						  ); 
			//$this->load->view("header-mail", $user_data);
	  		$this->load->view("header-home", $user_data);
			//$this->load->view("sidebar");
	  		$this->load->view("mail/inbox_view", $user_data); 
	  		//$this->load->view("footer");
	  }
	  
	  	  
	  public function unread_msg_count()
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
			
			$user_id  = $this->input->post('user_id');		
			//fetch unread msg count
			echo $unread_msg_count  = $this->user_mail->unread_msg_count($user_id);
			
				
	  }
	  
	    public function lastest_msg_date()
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
			
			$user_id  = $this->input->post('user_id');		
			//fetch login user lastest unread messages mail_date
			echo $lastest_date  = $this->user_mail->lastest_msg_date($user_id);	
			
				
	  }
	    public function CheckUnreadMsg()
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
			
			$user_id  = $this->input->post('user_id');
			$lastest_date  = $this->input->post('lastest_date');
			
			//fetch login user unread messages
			$success  = $this->user_mail->CheckUnreadMsg($user_id,$lastest_date);		
			if($success){				
				echo $success;
				}else{
				echo '';	
					}
				
	  }
	  
	  
	   public function send_mail()
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
			
			$user_id_from_post  = $this->input->post('user_id');
			$friend_id  = $this->input->post('friend_id');			
			$subject  = htmlspecialchars(strip_tags($this->input->post('subject')), ENT_QUOTES);
			$message  = nl2br(htmlspecialchars($this->input->post('message'), ENT_QUOTES, 'UTF-8'));
			
			//check if user id is genunine			
			if($user_id!=$user_id_from_post ){
				echo 3;
				exit;
				}
				
			//check if friend id is genunine			
			$friend  = $this->user_mail->check_friend($friend_id,$user_id);
			if(!$friend){
				echo 3;	
				exit;			
			   }else{
				 
				  //check if subject is blank
				  if (!isset($subject) || trim($subject)===''){
				   echo 1;
				   exit;						
					}
			     //check if message is blank
				  if (!isset($message) || trim($message)===''){ 
				   echo 2;
				   exit;						
					}
				 //insert message value in the database.
				 $subject  = base64_encode($subject);
			     $message  = base64_encode($message);
				 
				  $Data  = array(
				                 'mail_from'  => $user_id,
								 'mail_to'  => $friend_id,
								 'mail_subject'  => $subject,
								 'mail_content'  => $message,
								 'mail_date'  => date('Y-m-d H:i:s')
								 );
			  
			     $result  = $this->user_mail->msg($Data);
               
				 if(!$result){
					     echo 3;	
				         exit;	
					}else{
							echo "send";	
				             exit;	
						 }
					
			   }
					
	  }
	  
	  public function send_reply_to_friend()
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
			$dp_url=base_url().$session_data['dp_url'];
			
			$user_id_from_post  = $this->input->post('user_id');
			$friend_id  = $this->input->post('friend_id');			
			$subject  = htmlspecialchars(strip_tags($this->input->post('subject')), ENT_QUOTES);
			$message  = nl2br(htmlspecialchars($this->input->post('message'), ENT_QUOTES, 'UTF-8'));
			
			//check if user id is genunine			
			if($user_id!=$user_id_from_post ){
				echo 3;
				exit;
				}
				
			//check if friend id is genunine			
			$friend  = $this->user_mail->check_friend($friend_id,$user_id);
			if(!$friend){
				echo 3;	
				exit;			
			   }else{
				 
				  //check if subject is blank
				  if (!isset($subject) || trim($subject)===''){
				   echo 1;
				   exit;						
					}
			     //check if message is blank
				  if (!isset($message) || trim($message)===''){ 
				   echo 2;
				   exit;						
					}
				 //insert message value in the database.
				 $subject  = base64_encode($subject);
			     $message  = base64_encode($message);
				 $date=date('Y-m-d H:i:s');
				  $Data  = array(
				                 'mail_from'  => $user_id,
								 'mail_to'  => $friend_id,
								 'mail_subject'  => $subject,
								 'mail_content'  => $message,
								 'mail_date'  => $date
								 );
			  
			     $result  = $this->user_mail->msg($Data);
               
				 if(!$result){
					     echo 3;	
				         exit;	
					}else{
                            //fetch friends name			
			                $friend  = $this->user_mail->friend_details($friend_id);
							$friend_name=ucwords($friend->name);	
							$mail_subject= htmlspecialchars_decode(base64_decode($subject), ENT_QUOTES);
							$mail_content= htmlspecialchars_decode(base64_decode($message), ENT_QUOTES);					
							$data='';
							$data.="<div id=\"msd_id_218\" class=\"make_my_prog make_my_prog_right\">";
							$data.="<div class=\"plyr_prof\"><img alt=\"$name\" src=\"$dp_url\"></div>";
							$data.="<div class=\"mail_info_tid\"><i><strong>To:</strong> $friend_name</i><i><strong>From:</strong> $name(You)</i><i><strong>Subject:</strong> $mail_subject</i></div>";
							$data.="<div class=\"my_mail_date\"> <i>$date</i></div>";
							$data.="<div class=\"msg_body_plyr\">$mail_content</div>";
							$data.="</div>";
							echo $data;
				            exit;	
						 }
					
			   }
					
	  }
	  
	  
	  
	   public function fetchUnreadMsg()
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
			
			//fetch login user unread messages
			echo $success  = $this->user_mail->fetch_unread_messages($user_id);
					
	  }

	  public function getUnreadMailList(){
	  		 if (!$this->session->userdata('logged_in'))
			    {    
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			    }
			$session_data = $this->session->userdata('logged_in');
		     $user_id=$session_data['user_id'];

			$mail_list = $this->user_mail->getUnreadMailList($user_id);			
			
			if(!$mail_list){
				echo "<li>No unread mail .</li>";
			}else{

				 $data ="";
				foreach ($mail_list as $mail_row) {
					
					$sender_name=ucwords($mail_row['sender_name']);
					$sender_dp=$mail_row['sender_dp'];
					$subject=ucwords($mail_row['subject']);

					$data .="<li><div class=\"md-list-addon-element\">";
                    $data .="<img class=\"md-user-image md-list-addon-avatar\" src=\"$sender_dp\" alt=\"$sender_name\"/>";
                    $data .="</div><div class=\"md-list-content\">";
                    $data .="<span class=\"md-list-heading md-list-heading-adept\">";
                    $data .="<a>$sender_name</a></span>";
                    $data .="<span class=\"uk-text-small uk-text-muted uk-text-muted-adept\">$subject</span></div></li>"; 

				}
				echo $data;
			}
	  }

	  public function fetchReadMsg()
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
			$current_group  = $this->input->post('current_group');
			//fetch login user unread messages
			echo $success  = $this->user_mail->fetch_read_messages($user_id,$current_group);
					
	  }
	   public function fetchReadMoreMsg()
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
			$current_group  = $this->input->post('current_group');
			
			//fetch read msg count
			$read_msg_count  = $this->user_mail->read_msg_count($user_id);
			//fetch login user unread messages
			echo $success  = $this->user_mail->fetch_read_more_messages($user_id,$current_group);
					
	  }
	  
	   public function updateMsgStatus()
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
			
			$mail_id  = $this->input->post('mail_id');
			
			//fetch login user unread messages
			echo $success  = $this->user_mail->updateMsgStatus($mail_id);
					
	  }


      public function Delete_mail()
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
			
			$mail_id  = $this->input->post('mail_id');
			//fetch login user unread messages
			$success  = $this->user_mail->Delete_mail($mail_id);
			if($success==1){
				
				//fetch unread msg count
				$unread_msg_count  = $this->user_mail->unread_msg_count($user_id);
				
				//fetch read msg count
				$read_msg_count  = $this->user_mail->read_msg_count($user_id);
				
				if($unread_msg_count==0 && $read_msg_count==0){
					echo 1;
					}else if($unread_msg_count>0 && $read_msg_count==0){
					echo 2;
					}else if($unread_msg_count==0 && $read_msg_count>0){
					echo 3;
					} if($unread_msg_count>0 && $read_msg_count>0){
					echo 4;
					}
				
				
				
				}		
	  }





  public function Mail_reply($parameter)
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
	        $parameter=rawurldecode($parameter);
			$array=explode('_',$parameter);


				$acc_type=$session_data['acc_type'];
		  	$dp_url = $session_data['dp_url'];
		  	//geting pending friend request count 
		  	$f_count=$this->getPendingReqestCount($user_id);
		  	//geting unread mail count 
		  	$m_count=$this->getUnreadMailCount($user_id);

		  	$n_count = $this->getPendingNotificationCount($user_id);


			//fetch total posts of the login user
			$total_posts  = $this->user_post->total_posts($user_id);

			

		  
		

			//fetch login user friends list with their images
			$success  = $this->user_mail->fetch_friend_list($user_id);
						
			//fetch login user lastest unread messages mail_date
			$lastest_date  = $this->user_mail->lastest_msg_date($user_id);
			
	  	$user_data= array(
		                  'title'=>'WeGotPlayer',
						  'email'=>$email,
						  'user_id'=>$user_id,
						  'name'=>$name,
						  'success'=>$success,
						  'lastest_date'=>$lastest_date,
						  'f_count'=>$f_count,'m_count'=>$m_count,
						  'n_count'=>$n_count,'acc_type'=>$acc_type,
						  ); 
			//$this->load->view("header-mail", $user_data);
	  		$this->load->view("header-home", $user_data);
			
			
			$mail_id  = $array[0];
			$friend_id  = $array[1];
		    $user_id_from_post  = $array[2];
			
			if($user_id_from_post!=$user_id){
				 $this->index();			
				}
			
			//check details are genuine.
			$correct  = $this->user_mail->check_mail_details($mail_id,$friend_id,$user_id);
			if(!$correct){
				  $this->index();	
				}else{
			           					
					$reply_text  = $this->user_mail->reply_mail($mail_id,$friend_id,$user_id);
					if(!$reply_text){
						 $this->index();				          					
						}else{
								     $user_data= array(
								                  'title'=>'WeGotPlayer',
												  'email'=>$email,
												  'user_id'=>$user_id,
												  'name'=>$name,'reply_text'=>$reply_text,
												  'success'=>$success,
												  'lastest_date'=>$lastest_date,
												  'f_count'=>$f_count,'m_count'=>$m_count,
												  'n_count'=>$n_count,'acc_type'=>$acc_type,
												  ); 
								//$this->load->view("header-mail", $user_data);
						  		$this->load->view("header-home", $user_data);
								
								$this->load->view("mail/reply_view", $user_data);
								$this->load->view("footer");					
							}	
				
				
				}
	
	
	 }



public function delete(){
            $ids = ( explode( ',', $this->input->get_post('ids') ));
            $result= $this->user_mail->Delete_all($ids);
			return $result;
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