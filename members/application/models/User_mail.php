<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_mail extends CI_Model {
	  
		public function __construct()
		{
		    parent::__construct();
		    date_default_timezone_set('Asia/Calcutta');
		    $this->load->database();		   
		}
		//constructor end

		public function fetch_friend_list($user_id)
		{	
		
		    $this->db->select('friend_id');
			$this->db->from('wgp_user_friends');			
			$this->db->where('user_id', $user_id );
			$this->db->where('status', 1,false );
			$this->db->order_by("friend_id","desc");
			$query = $this->db->get();
			
			if($query)
			{
			    if ( $query->num_rows() ==0 )
					{
						return '<option value="">OOPs! No friend found.</option>';				
						
					}
			    $data='';
				$data.='<ul id="friend_list">';		
				$results= $query->result_array();					
				foreach ($query->result() as $row)
				{
							$user_id= $row->friend_id;
							//START: fetching user details using his id
							$query_name = $this->db->query("SELECT name FROM users WHERE user_id='$user_id'");
							$row = $query_name->row_array();
							$user_name=$row['name'];
														
							if($user_name=='')
							{
								$user_name='Anomyous user';
							}
							//END: fetching user details using his id
							
							//START: fetching the profile image for session			
							$this->db->where("user_id", $user_id);
							$this->db->where("is_default",1);			
							$query2=$this->db->get("wgp_user_images");
							if(!$query2)
							{
								$image_url=base_url().'images/sports-football.png';
							}else
							{
								   if($query2->num_rows()!=1)
								   {
									 $image_url=base_url().'images/sports-football.png';
								   }else{
										   $row2=$query2->row();
										   if($row2->image_file==''){
												  $image_url=base_url().'images/sports-football.png';
										   }else{
												 $image_url=base_url().$row2->image_file;
										   }
								   }				   
							
							}
							//END: fetching the profile image for session	
							
						    $data.='<li id="list_'.$user_id.'" onClick="seleted_friend('.$user_id.')"><img src="'.$image_url.'" border="0" alt="'.$user_name.' image" height="auto">'.$user_name.'</li>';		
					}
					$data.='</ul>';
				 return  $data;	
			}
			else
			{
			 return  '<option value="">OOPs! Some error occur database connection.</option>';
			}
		}
		
		public function check_friend($friend_id,$user_id)
		{	
		
		    $this->db->select('friend_id');
			$this->db->from('wgp_user_friends');			
			$this->db->where('user_id', $user_id);
			$this->db->where('friend_id', $friend_id);
			$this->db->where('status', 1,false );
			$query = $this->db->get();			
			if($query)
			{
			    if ( $query->num_rows() >0 )
					{
						return true;				
						
					}else
					{
					 return  false;
					}
			    	
				
			}
			else
			{
			 return  false;
			}
			
		}
		
		public function friend_details($friend_id)
		{	
		    $this->db->select('*');
			$this->db->from('users');			
			$this->db->where('user_id', $friend_id);
			$query = $this->db->get();			
			if($query)
			{
			    if ( $query->num_rows() >0 )
					{
						return $query->row();				
						
					}else
					{
					 return  false;
					}
			    	
				
			}
			else
			{
			 return  false;
			}
		}
		
		public function msg($Data)
		{	
		     $result=$this->db->insert('wgp_user_mail', $Data);
   
			 if($result)
			 {
			  $last_id = $this->db->insert_id();
              return $last_id;
			 }
			 else
			 {
			   return false;
			 }
		}		
		
		public function unread_msg_count($user_id)
		{
			
			$this->db->select('*');
			$this->db->from('wgp_user_mail');			
			$this->db->where('mail_to', $user_id );
			$this->db->where('mail_status', 0,false );
			$this->db->order_by("mail_id","desc");
			$query = $this->db->get();
			
			if($query)
			{
			 return $query->num_rows();
			}
		}
			
		public function read_msg_count($user_id)
		{
			$this->db->select('*');
			$this->db->from('wgp_user_mail');			
			$this->db->where('mail_to', $user_id );
			$this->db->where('mail_status', 1,false );
			$this->db->order_by("mail_id","desc");
			$query = $this->db->get();
			
			if($query)
			{
			return $query->num_rows();
			}		
		}
		
		public function lastest_msg_date($user_id)
		{
			$query = $this->db->query("SELECT MAX( mail_date ) AS max FROM `wgp_user_mail` WHERE  `mail_to` =  $user_id
AND mail_status =0");
			
			if(!$query){ 
			 $lastest_date=date('Y-m-d H:i:s');
			 return $lastest_date; 			
			 }else{
			 $row = $query->row(); 
			 $lastest_date=$row->max;
			 if($lastest_date!=NULL||$lastest_date!=''){				 
			      return $lastest_date; 
				  }else{
				  $lastest_date=date('Y-m-d H:i:s');
			      return $lastest_date;
			       }
				
				 }
		}
		public function getUnreadMailList($user_id)
		{	
			$this->db->select('*');
			$this->db->where('mail_to', $user_id );
			$this->db->where('mail_status', 0,false );
			$this->db->order_by("mail_id","desc");	
			$query = $this->db->get('wgp_user_mail');

			if($query){
				if ( $query->num_rows() > 0 ){
					$mail_details = $query->result();

					$mail_data=array();
					foreach ($mail_details as  $mail_row) {
							
							 $sender_id=$mail_row->mail_from;
							 //fetching userDetails
							 $sender_name=$this->userName($sender_id);
							 $sender_pic=$this->userProfilePic($sender_id);
							 $mail_subject=base64_decode($mail_row->mail_subject);

							 $data = array('sender_name' => $sender_name,
											'sender_dp'=>$sender_pic,
											'subject'=>$mail_subject
											);
							 array_push($mail_data,$data);
						}
						 
									
					return $mail_data;
				}else{
					return false;
				}
			}else{
				return false;
			}

		}

		//START: fetching user details using his id
		public function userName($sender_id){
			
			$query_name = $this->db->query("SELECT name FROM users WHERE user_id='$sender_id'");
			$row = $query_name->row();


			$sender_name=$row->name;
										
			if($sender_name=='')
			{
				$sender_name='Anomyous user';
			}
			return $sender_name;
			//END: fetching user details using his id
		}
		
		public function userProfilePic($sender_id){	
			//START: fetching the profile image for session			
			$this->db->where("user_id", $sender_id);
			$this->db->where("is_default",1);			
			$query2=$this->db->get("wgp_user_images");
			if(!$query2)
			{
				return $image_url=base_url().'images/sports-football.png';
			}else
			{
				   if($query2->num_rows()!=1)
				   {
					return $image_url=base_url().'images/sports-football.png';
				   }else{
						   $row2=$query2->row();
						   if($row2->image_file==''){
								return  $image_url=base_url().'images/sports-football.png';
						   }else{
								return $image_url=base_url().$row2->image_file;
						   }
				   }				   
			
			}
			
		}
		
		public function CheckUnreadMsg($user_id,$load_time)
		{
			$this->db->select('*');
			$this->db->from('wgp_user_mail');			
			$this->db->where('mail_to', $user_id );
			$this->db->where('mail_status', 0,false );
			$this->db->where('mail_date >', $load_time );
			$this->db->order_by("mail_id","desc");			
			$query = $this->db->get();
			
			if($query)
			{
			   if ( $query->num_rows() > 0 )
				{
					
					$data="";
					$results= $query->result_array();					
					foreach ($query->result() as $mail)
					{
								
								$mail_id= $mail->mail_id;
								$sender_id= $mail->mail_from;
								$reciever_id= $mail->mail_to;
								$mail_status= $mail->mail_status;
								$mail_date= $mail->mail_date;

								$f_mail_date = date("M d, Y h:i:A", strtotime($mail_date));
								$mail_subject= htmlspecialchars_decode(base64_decode($mail->mail_subject), ENT_QUOTES);
								$mail_content= htmlspecialchars_decode(base64_decode($mail->mail_content), ENT_QUOTES);
								//START: fetching user details using his id
								$query_name = $this->db->query("SELECT name FROM users WHERE user_id='$sender_id'");
								$row = $query_name->row_array();
								$sender_name=$row['name'];
															
								if($sender_name=='')
								{
									$sender_name='Anomyous user';
								}
								//END: fetching user details using his id
								
								//START: fetching the profile image for session			
								$this->db->where("user_id", $sender_id);
								$this->db->where("is_default",1);			
								$query2=$this->db->get("wgp_user_images");
								if(!$query2)
								{
									$image_url=base_url().'images/sports-football.png';
								}else
								{
									   if($query2->num_rows()!=1)
									   {
										 $image_url=base_url().'images/sports-football.png';
									   }else{
											   $row2=$query2->row();
											   if($row2->image_file==''){
													  $image_url=base_url().'images/sports-football.png';
											   }else{
													 $image_url=base_url().$row2->image_file;
											   }
									   }				   
								
								}
								//END: fetching the profile image for session
	$parameter=$mail_id.'_'.$sender_id.'_'.$reciever_id;	
	$parameter=urlencode($parameter);
	$reply_url=base_url().'usermailbox/Mail_reply/'.$parameter;	
					
							
	$data.= "<li id=\"list_$mail_id\" >";
	$data.= "<div class=\"md-card-list-item-menu\" data-uk-dropdown=\"{mode:'click'}\"><a href=\"#\" class=\"md-icon material-icons\">&#xE5D4;</a><div class=\"uk-dropdown uk-dropdown-flip uk-dropdown-small\"><ul class=\"uk-nav\"><li><a href=\"$reply_url\"><i class=\"material-icons\">&#xE15E;</i> Reply</a></li><li><a onClick=\"delete_mail($mail_id)\"><i class=\"material-icons\">&#xE872;</i> Delete</a></li></ul></div></div>";
	$data.= "<span onClick=\"mail_read($mail_id)\" class=\"md-card-list-item-date\">$f_mail_date</span>";
	$data.= "<div onClick=\"mail_read($mail_id)\" class=\"md-card-list-item-select\"><input type=\"checkbox\" name=\"msg_name[]\" class=\"checkbox1\" id=\"msg_check_$mail_id\" value=\"$mail_id\" data-md-icheck /></div>";
	$data.= "<div onClick=\"mail_read($mail_id)\" class=\"md-card-list-item-avatar-wrapper\"><img src=\"$image_url\" class=\"md-card-list-item-avatar\" alt=\"\" /></div>";
	$data.= "<div onClick=\"mail_read($mail_id)\" class=\"md-card-list-item-sender\"><span>$sender_name</span></div>";
	$data.= "<div onClick=\"mail_read($mail_id)\" class=\"md-card-list-item-subject\"><div class=\"md-card-list-item-sender-small\"><span>$sender_name</span></div><span>$mail_subject</span></div>";
	$data.= "<div class=\"md-card-list-item-content-wrapper\"><div class=\"md-card-list-item-content\">$mail_content</div></div>";
	$data.= "</li>";
						}				
			return  $data;			
					
				
				
				}else{
					
					 return  false;	
					 
					}
			     					
			}else{
				 return  false;	
				}
		}
		
		public function fetch_unread_messages($user_id)
		{	
		    $this->db->select('*');
			$this->db->from('wgp_user_mail');			
			$this->db->where('mail_to', $user_id );
			$this->db->where('mail_status', 0,false );
			$this->db->order_by("mail_id","desc");
			$query = $this->db->get();
			
			if($query)
			{
			    if ( $query->num_rows() ==0 )
					{
						return "<div class=\"md-card-list-header heading_list\">Unread</div><div class=\"md-card-list-header md-card-list-header-combined heading_list\" style=\"display: none\">All Messages</div><ul><li id='zero_unread_msg'>Woohoo! You've read all the messages in your inbox.</li></ul>";				
						
					}
			       $data="";
				   $data.="<div class=\"md-card-list-header heading_list\">Unread</div><div class=\"md-card-list-header md-card-list-header-combined heading_list\" style=\"display: none\">All Messages</div>";	
                   $data.="<ul>";			
				   
				$results= $query->result_array();					
				foreach ($query->result() as $mail)
				{
							
							$mail_id= $mail->mail_id;
							$sender_id= $mail->mail_from;
							$reciever_id= $mail->mail_to;
							$mail_status= $mail->mail_status;
							$mail_date= $mail->mail_date;
							$f_mail_date = date("M d, Y h:i:A", strtotime($mail_date));
							$mail_subject= htmlspecialchars_decode(base64_decode($mail->mail_subject), ENT_QUOTES);
							$mail_content= htmlspecialchars_decode(base64_decode($mail->mail_content), ENT_QUOTES);
							//START: fetching user details using his id
							$query_name = $this->db->query("SELECT name FROM users WHERE user_id='$sender_id'");
							$row = $query_name->row_array();
							$sender_name=$row['name'];
														
							if($sender_name=='')
							{
								$sender_name='Anomyous user';
							}
							//END: fetching user details using his id
							
							//START: fetching the profile image for session			
							$this->db->where("user_id", $sender_id);
							$this->db->where("is_default",1);			
							$query2=$this->db->get("wgp_user_images");
							if(!$query2)
							{
								$image_url=base_url().'images/sports-football.png';
							}else
							{
								   if($query2->num_rows()!=1)
								   {
									 $image_url=base_url().'images/sports-football.png';
								   }else{
										   $row2=$query2->row();
										   if($row2->image_file==''){
												  $image_url=base_url().'images/sports-football.png';
										   }else{
												 $image_url=base_url().$row2->image_file;
										   }
								   }				   
							
							}
							//END: fetching the profile image for session
							
	$parameter=$mail_id.'_'.$sender_id.'_'.$reciever_id;	
	$parameter=urlencode($parameter);
	$reply_url=base_url().'usermailbox/Mail_reply/'.$parameter;	
										
	
	$data.= "<li id=\"list_$mail_id\" >";
	$data.= "<div class=\"md-card-list-item-menu\" data-uk-dropdown=\"{mode:'click'}\"><a href=\"#\" class=\"md-icon material-icons\">&#xE5D4;</a><div class=\"uk-dropdown uk-dropdown-flip uk-dropdown-small\"><ul class=\"uk-nav\"><li><a href=\"$reply_url\"><i class=\"material-icons\">&#xE15E;</i> Reply</a></li><li><a onClick=\"delete_mail($mail_id)\"><i class=\"material-icons\">&#xE872;</i> Delete</a></li></ul></div></div>";
	$data.= "<span onClick=\"mail_read($mail_id)\" class=\"md-card-list-item-date\">$f_mail_date</span>";
	$data.= "<div onClick=\"mail_read($mail_id)\" class=\"md-card-list-item-select\"><input type=\"checkbox\" name=\"msg_name[]\" class=\"checkbox1\" id=\"msg_check_$mail_id\" value=\"$mail_id\" data-md-icheck /></div>";
	$data.= "<div onClick=\"mail_read($mail_id)\" class=\"md-card-list-item-avatar-wrapper\"><img src=\"$image_url\" class=\"md-card-list-item-avatar\" alt=\"\" /></div>";
	$data.= "<div onClick=\"mail_read($mail_id)\" class=\"md-card-list-item-sender\"><span>$sender_name</span></div>";
	$data.= "<div onClick=\"mail_read($mail_id)\" class=\"md-card-list-item-subject\"><div class=\"md-card-list-item-sender-small\"><span>$sender_name</span></div><span>$mail_subject</span></div>";
	$data.= "<div class=\"md-card-list-item-content-wrapper\"><div class=\"md-card-list-item-content\">$mail_content</div></div>";
	$data.= "</li>";
					}
				  $data.="</ul>";
				
				 return  $data;	
			}
			else
			{
			 return  "<div class=\"md-card-list-header heading_list\">Unread</div><div class=\"md-card-list-header md-card-list-header-combined heading_list\" style=\"display: none\">All Messages</div><ul><li>OOPs! Some error occur database connection.</li></ul>";
			}
		}
		
		public function fetch_read_messages($user_id)
		{	$limit=10;
		    $start=0;
		    $this->db->select('*');
			$this->db->from('wgp_user_mail');			
			$this->db->where('mail_to', $user_id );
			$this->db->where('mail_status', 1,false );
			$this->db->order_by("mail_id","desc");
			$this->db->limit($limit, $start);			   
			$query = $this->db->get();
			
			if($query)
			{
			    if ( $query->num_rows() ==0 )
					{
						return "<div class=\"md-card-list-header heading_list\">Read</div><ul><li id='zero_read_msg'>Woohoo! You've no messages in your inbox.</li></ul>";				
						
					}
			    $data="";	
				$data.="<div class=\"md-card-list-header heading_list\">Read</div>";
                $data.="<ul>";
				
					$results= $query->result_array();					
					foreach ($query->result() as $mail)
					{
								
								$mail_id= $mail->mail_id;
								$sender_id= $mail->mail_from;
								$reciever_id= $mail->mail_to;
								$mail_status= $mail->mail_status;
								$mail_date= $mail->mail_date;	
								$f_mail_date = date("M d, Y h:i:A", strtotime($mail_date));						
								$mail_subject= htmlspecialchars_decode(base64_decode($mail->mail_subject), ENT_QUOTES);
								$mail_content= htmlspecialchars_decode(base64_decode($mail->mail_content), ENT_QUOTES);
								//START: fetching user details using his id
								$query_name = $this->db->query("SELECT name FROM users WHERE user_id='$sender_id'");
								$row = $query_name->row_array();
								$sender_name=$row['name'];
															
								if($sender_name=='')
								{
									$sender_name='Anomyous user';
								}
								//END: fetching user details using his id
								
								//START: fetching the profile image for session			
								$this->db->where("user_id", $sender_id);
								$this->db->where("is_default",1);			
								$query2=$this->db->get("wgp_user_images");
								if(!$query2)
								{
									$image_url=base_url().'images/sports-football.png';
								}else
								{
									   if($query2->num_rows()!=1)
									   {
										 $image_url=base_url().'images/sports-football.png';
									   }else{
											   $row2=$query2->row();
											   if($row2->image_file==''){
													  $image_url=base_url().'images/sports-football.png';
											   }else{
													 $image_url=base_url().$row2->image_file;
											   }
									   }				   
								
								}
								//END: fetching the profile image for session
								
	$parameter=$mail_id.'_'.$sender_id.'_'.$reciever_id;	
	$parameter=urlencode($parameter);
	$reply_url=base_url().'usermailbox/Mail_reply/'.$parameter;	
					
	$data.= "<li id=\"list_$mail_id\" >";
	$data.= "<div class=\"md-card-list-item-menu\" data-uk-dropdown=\"{mode:'click'}\"><a href=\"#\" class=\"md-icon material-icons\">&#xE5D4;</a><div class=\"uk-dropdown uk-dropdown-flip uk-dropdown-small\"><ul class=\"uk-nav\"><li><a href=\"$reply_url\"><i class=\"material-icons\">&#xE15E;</i> Reply</a></li><li><a onClick=\"delete_mail($mail_id)\"><i class=\"material-icons\">&#xE872;</i> Delete</a></li></ul></div></div>";
	$data.= "<span class=\"md-card-list-item-date\">$f_mail_date</span>";
	$data.= "<div class=\"md-card-list-item-select\"><input type=\"checkbox\" name=\"msg_name[]\" class=\"checkbox1\" id=\"msg_check_$mail_id\" value=\"$mail_id\" data-md-icheck /></div>";
	$data.= "<div class=\"md-card-list-item-avatar-wrapper\"><img src=\"$image_url\" class=\"md-card-list-item-avatar\" alt=\"\" /></div>";
	$data.= "<div class=\"md-card-list-item-sender\"><span>$sender_name</span></div>";
	$data.= "<div class=\"md-card-list-item-subject\"><div class=\"md-card-list-item-sender-small\"><span>$sender_name</span></div><span>$mail_subject</span></div>";
	$data.= "<div class=\"md-card-list-item-content-wrapper\"><div class=\"md-card-list-item-content\">$mail_content</div></div>";
	$data.= "</li>";
						}
					
				 $data.="</ul>";
				 $data.='<div class="uk-text-center uk-margin-top uk-margin-small-bottom"><a class="md-btn md-btn-flat md-btn-flat-primary adept-md-btn-primary js-uk-prevent load_more_click" id="load_more_2" onclick="onloadmore(2)">Load more...</a></div>';
				 return  $data;	
			}
			else
			{
			 return  "<div class=\"md-card-list-header heading_list\">Read</div><ul><li id='zero_read_msg'>OOPs! Some error occur database connection.</li></ul>";
			}
		}
		
		public function fetch_read_more_messages($user_id,$current_group=null)
		{	$limit=10;
		    $start=($current_group-1)*10;
		    $this->db->select('*');
			$this->db->from('wgp_user_mail');			
			$this->db->where('mail_to', $user_id );
			$this->db->where('mail_status', 1,false );
			$this->db->order_by("mail_id","desc");
			$this->db->limit($limit, $start);
			
			$query = $this->db->get();
			
			if($query)
			{
			    if ( $query->num_rows() ==0 )
					{
						return "";				
						
					}
			    $data="";	
			
				
					$results= $query->result_array();					
					foreach ($query->result() as $mail)
					{
								
								$mail_id= $mail->mail_id;
								$sender_id= $mail->mail_from;
								$reciever_id= $mail->mail_to;
								$mail_status= $mail->mail_status;
							    $mail_date= $mail->mail_date;	

							    $f_mail_date = date("M d, Y h:i:A", strtotime($mail_date));

								$mail_subject= htmlspecialchars_decode(base64_decode($mail->mail_subject), ENT_QUOTES);
								$mail_content= htmlspecialchars_decode(base64_decode($mail->mail_content), ENT_QUOTES);
								//START: fetching user details using his id
								$query_name = $this->db->query("SELECT name FROM users WHERE user_id='$sender_id'");
								$row = $query_name->row_array();
								$sender_name=$row['name'];
															
								if($sender_name=='')
								{
									$sender_name='Anomyous user';
								}
								//END: fetching user details using his id
								
								//START: fetching the profile image for session			
								$this->db->where("user_id", $sender_id);
								$this->db->where("is_default",1);			
								$query2=$this->db->get("wgp_user_images");
								if(!$query2)
								{
									$image_url=base_url().'images/sports-football.png';
								}else
								{
									   if($query2->num_rows()!=1)
									   {
										 $image_url=base_url().'images/sports-football.png';
									   }else{
											   $row2=$query2->row();
											   if($row2->image_file==''){
													  $image_url=base_url().'images/sports-football.png';
											   }else{
													 $image_url=base_url().$row2->image_file;
											   }
									   }				   
								
								}
								//END: fetching the profile image for session
	$parameter=$mail_id.'_'.$sender_id.'_'.$reciever_id;	
	$parameter=urlencode($parameter);
	$reply_url=base_url().'usermailbox/Mail_reply/'.$parameter;	
							
	$data.= "<li id=\"list_$mail_id\" >";
	$data.= "<div class=\"md-card-list-item-menu\" data-uk-dropdown=\"{mode:'click'}\"><a href=\"#\" class=\"md-icon material-icons\">&#xE5D4;</a><div class=\"uk-dropdown uk-dropdown-flip uk-dropdown-small\"><ul class=\"uk-nav\"><li><a href=\"$reply_url\"><i class=\"material-icons\">&#xE15E;</i> Reply</a></li><li><a onClick=\"delete_mail($mail_id)\"><i class=\"material-icons\">&#xE872;</i> Delete</a></li></ul></div></div>";
	$data.= "<span class=\"md-card-list-item-date\">$f_mail_date</span>";
	$data.= "<div class=\"md-card-list-item-select\"><input type=\"checkbox\" name=\"msg_name[]\" class=\"checkbox1\" id=\"msg_check_$mail_id\" data-md-icheck value=\"$mail_id\"/></div>";
	$data.= "<div class=\"md-card-list-item-avatar-wrapper\"><img src=\"$image_url\" class=\"md-card-list-item-avatar\" alt=\"\" /></div>";
	$data.= "<div class=\"md-card-list-item-sender\"><span>$sender_name</span></div>";
	$data.= "<div class=\"md-card-list-item-subject\"><div class=\"md-card-list-item-sender-small\"><span>$sender_name</span></div><span>$mail_subject</span></div>";
	$data.= "<div class=\"md-card-list-item-content-wrapper\"><div class=\"md-card-list-item-content\">$mail_content</div></div>";
	$data.= "</li>";
						}
					
				
				 return  $data;	
			}
			else
			{
			 return  "<li id='zero_read_msg'>OOPs! Some error occur database connection.</li>";
			}
		}
		
		public function updateMsgStatus($mail_id)
		{	
		   	$data=array('mail_status'=>1);
			$this->db->where('mail_id',$mail_id);
			$this->db->update('wgp_user_mail',$data);
			return  1;
			
			
		}
				
		public function Delete_mail($mail_id)
		{	
		  		
			$data=array('mail_status'=>3);
			$this->db->where('mail_id',$mail_id);
			$this->db->update('wgp_user_mail',$data);
			return  1;
			
			
		}
		
		public function Delete_all($ids)
		{
		
			$mail_ids = $ids;
			$count = 0;
			foreach ($mail_ids as $id){
				$mail_id = intval($id).'<br>';
				$data=array('mail_status'=>3);
			    $this->db->where('mail_id',$mail_id);
			    $this->db->update('wgp_user_mail',$data); 
				$count = $count+1;
			}
			if($count>0){
			echo "$count";
			}else{
			echo 0;	
				}
		


}
		
		public function check_mail_details($mail_id,$friend_id,$user_id)
		{	
		  		
			$this->db->select('mail_content');
			$this->db->from('wgp_user_mail');			
			$this->db->where('mail_to', $user_id);
			$this->db->where('mail_from', $friend_id);
			$this->db->where('mail_id', $mail_id);
			$query = $this->db->get();			
			if($query)
			{
			    if ( $query->num_rows() >0 )
					{
						return true;				
						
					}else
					{
					 return  false;
					}
			    	
				
			}
			else
			{
			 return  false;
			}
			
			
		}
		
		public function reply_mail($mail_id,$friend_id,$user_id)
		{	
		  		
			$this->db->select('*');
			$this->db->from('wgp_user_mail');			
			$this->db->where("(mail_from = $friend_id AND mail_to = $user_id) OR (mail_from = $user_id AND mail_to = $friend_id)");
			
			$this->db->where('mail_status !=', 3);
			$this->db->order_by("mail_date","asc");		
			$query = $this->db->get();			
			if($query)
			{       
			
			         $data='';
			    if ( $query->num_rows() >0 )
					{
						$reply_text= $query->result();
						
						
						$data.="<div class=\"md-card\">
						<div class=\"md-card-content\">
						<h3 class=\"heading_a\">Conservation Detail</h3>
						<div class=\"uk-width-1-1\">
						<div class=\"make_my_prog_main\"  id=\"msgs_section_id\">";

   if(is_array($reply_text))
                        {
							foreach($reply_text as $row)
							{ 
                                
								$mail_id= $row->mail_id; 
								$mail_from= $row->mail_from;  
								$mail_to= $row->mail_to;  
								$mail_status= $row->mail_status;  
								$mail_date= $row->mail_date;

								$f_mail_date = date("M d, Y h:i:A", strtotime($mail_date));
								$mail_subject= htmlspecialchars_decode(base64_decode($row->mail_subject), ENT_QUOTES);
								$mail_content= htmlspecialchars_decode(base64_decode($row->mail_content), ENT_QUOTES);
								
                                //START: fetching name of mail->to 
								$query_name = $this->db->query("SELECT name FROM users WHERE user_id='$mail_to'");
								$row = $query_name->row_array();
								$mail_to_name=ucwords($row['name']);
															
								if($mail_to_name=='')
								{
									$mail_to_name='Anomyous user';
								}
								//END: fetching name of mail->to 
								
								
								//START: fetching name of mail->from
								$query_name_2 = $this->db->query("SELECT name FROM users WHERE user_id='$mail_from'");
								$row_2 = $query_name_2->row_array();
								$mail_from_name=ucwords($row_2['name']);
															
								if($mail_from_name=='')
								{
									$mail_from_name='Anomyous user';
								}
								//END: fetching name of mail->from
								
								//START: fetching profile image of mail->from 			
								$this->db->where("user_id", $mail_from);
								$this->db->where("is_default",1);			
								$query_image=$this->db->get("wgp_user_images");
								if(!$query_image)
								{	
								     $image_url=base_url().'images/sports-football.png';
								}else
								{
									   if($query_image->num_rows()!=1)
									   {   
										 $image_url=base_url().'images/sports-football.png';
									   }else{
											  
											   $row_image=$query_image->row();
											  
											   if($row_image->image_file==''){
													  $image_url=base_url().'images/sports-football.png';
											   }else{
													 $image_url=base_url().$row_image->image_file;
											   }
									   }				   
								
								}
                              
                                
								if($mail_to==$user_id){	
									$data.="<div class=\"make_my_prog make_my_prog_left\" id=\"msd_id_$mail_id\">";									
								}else{
									$data.="<div class=\"make_my_prog make_my_prog_right\" id=\"msd_id_$mail_id\">";								
								}
									$data.="<div class=\"plyr_prof\">";
									$data.="<img src=\"$image_url\" alt=\"$mail_from\">";
									$data.="</div>";
									$data.="<div class=\"mail_info_tid\">";
								if($mail_to==$user_id){	
									$data.="<i><strong>To:</strong> $mail_to_name(You)</i>";
									$data.="<i><strong>From:</strong> $mail_from_name</i>";								
								}else{
									$data.="<i><strong>To:</strong> $mail_to_name</i>";
									$data.="<i><strong>From:</strong> $mail_from_name(You)</i>";							
								}
									
									$data.="<i><strong>Subject:</strong> $mail_subject</i>";
									$data.="</div>";
									$data.="<div class=\"my_mail_date\">";
									$data.=" <i>$f_mail_date</i>";
									$data.="</div>";
									$data.="<div class=\"msg_body_plyr\">";
									$data.="<p>$mail_content</p>";
									$data.="</div>";
									$data.="</div>";            	
	
							  }//end foreach loop
                        }else

                        {                       
							$data.="<div class=\"make_my_prog make_my_prog_left\">";
							$data.="<div class=\"msg_body_plyr\">";
							$data.="<p>No conservation started.</p>";
							$data.="</div>";
							$data.="</div>";
						} 
						
						
					$data.="</div>";
					$data.="<div class=\"make_my_prog_main\" id=\"reply_section_id\"><div id=\"reply_section\"><div class=\"\"><h3 class=\"uk-modal-title\">Write your reply.</h3></div><div class=\"uk-margin-large-bottom\"><div class=\"md-input-wrapper\" id=\"subject_div_Reply\"><input type=\"hidden\" data-parsley-id=\"4\" id=\"Friends_id\" value=\"$friend_id\"><input type=\"text\" data-parsley-id=\"4\" placeholder=\"Subject\" name=\"SubjectReply\" id=\"SubjectReply\" required=\"\" class=\"md-input\"><span class=\"md-input-bar\"></span></div><div class=\"parsley-errors-list filled\"><span class=\"md-input-bar\" id=\"subject_error_Reply\"></span></div></div><div class=\"uk-margin-large-bottom\"><div class=\"md-input-wrapper\" id=\"message_div_Reply\"><textarea placeholder=\"Write your message\" required=\"\" style=\"min-height:50px;\" id=\"MessageReply\" class=\"md-input\" rows=\"1\"></textarea></div><div class=\"parsley-errors-list filled\"><span class=\"md-input-bar\" id=\"message_error_Reply\"></span></div></div><div class=\"\"><span class=\"md-input-bar\" id=\"form_error_Reply\"></span><div class=\"uk-float-right\" id=\"loaderReply\" style=\"display: none;\"><img src=\"http://adept-testing.com/wegot/images/loader.gif\" alt=\"loading...\"></div><button onclick=\"sendreply()\" id=\"clickToSubmitReply\" class=\"uk-float-left md-btn md-btn-success\" type=\"button\">Submit</button></div></div></div>";
						$data.="</div></div></div>";
						
						
						return $data;             
										
						
					}else
					{
					 return  false;
					}
			    	
				
			}
			else
			{
			 return  false;
			}
			
			
		}
		
		
}