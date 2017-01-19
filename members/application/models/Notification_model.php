<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notification_model extends CI_Model {
	  
	  public function __construct()
	  {
	       parent::__construct();
		   $this->load->database();
	  }//function end	


  //set friend request  
  public function setNotiFriendRequest($data){
  		$user_id   = $data['user_id'];
  		$friend_id = $data['friend_id'];
  		$field = array(
  					   'user_id' => $user_id,
  					   'notification_type'=>1,
  					   'notification_status'=>0,
  					   'notification_assets'=>$friend_id
  					  );

  		$this->db->set('notification_date', 'NOW()', FALSE);
  		$query = $this->db->insert('wgp_user_notifications',$field);
		  if( $query ){
				return true;
			}
		  else{
				return false;
			}
  }//set friend request
  //set friend request accepted
  public function setNotiAcceptRequest($user_id,$friend_id){
  		$field = array(
  					   'user_id' => $user_id,
  					   'notification_type'=>6,
  					   'notification_status'=>0,
  					   'notification_assets'=>$friend_id
  					  );

  		$this->db->set('notification_date', 'NOW()', FALSE);
  		$query = $this->db->insert('wgp_user_notifications',$field);
		  if( $query ){
				return true;
			}
		  else{
				return false;
			}
  }
  public function setNotiProfileView($user_id,$friend_id,$ip){
  	  $field = array(
  					   'user_id' => $user_id,
  					   'notification_type'=>9,
  					   'notification_status'=>0,
  					   'notification_assets'=>$friend_id,
  					   'ip'=>$ip
  					  );

  		$this->db->set('notification_date', 'NOW()', FALSE);
  		$query = $this->db->insert('wgp_user_notifications',$field);
		  if( $query ){
				return true;
			}
		  else{
				return false;
			}
  }
  public function setNotiProfileSearch($id_arry){
  		$user_id   = $id_arry['user_id'];
  		$friend_id = $id_arry['friend_id'];
  		$field = array(
  					   'user_id' => $friend_id,
  					   'notification_type'=>10,
  					   'notification_status'=>0,
  					   'notification_assets'=>$user_id
  					  );

  		$this->db->set('notification_date', 'NOW()', FALSE);
  		$query = $this->db->insert('wgp_user_notifications',$field);
		  if( $query ){
				return true;
			}
		  else{
				return false;
			}
  }

  public function checkProfileSearchByUser($id_arry){
  		$friend_id   = $id_arry['user_id'];
  		$user_id = $id_arry['friend_id'];
  		$this->db->where("user_id",$user_id); 
  		$this->db->where('notification_status',0);
  		$this->db->where("notification_assets",$friend_id);
		$query=$this->db->get("wgp_user_notifications");
		if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}

  }

  public function checkProfileVisitedByIpToday($ip){
 
  	    $this->db->where('ip',$ip);  	
		$query=$this->db->get("wgp_user_notifications");

		   if($query->num_rows()>0){
				  return true;
		    }else{
				  return false;
			}
  }


  public function getUnreadNotification($user_id)
  {  		
  		 $this->db->where("user_id",$user_id);
  		 $this->db->where("notification_status",0);	     
		 $query=$this->db->get("wgp_user_notifications");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
  }

  public function updateNotificationStatus($user_id){
   		 $this->db->where("user_id",$user_id);
  		 $this->db->set("notification_status",1);	     
		 $query=$this->db->update("wgp_user_notifications");
		  if($query){
			   return true;
		   }else{
			   return false;
		   }
   }

  public function getNotification($user_id){
  	   $this->db->where("user_id",$user_id);  	
  	   $this->db->order_by("notification_date","desc");	     
		$query=$this->db->get("wgp_user_notifications");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
  }


  public function getNotificationText($notification_type){
  		$this->db->where("notification_type",$notification_type);  			     
		$query=$this->db->get("wgp_notification_texts");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
  }

  public function getNotifierName($notifier_id)
	  {
	  	  $this->db->select('name');
	  	  $this->db->where('user_id',$notifier_id);	      
		  $query=$this->db->get("users");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }

	  }
	  public function getPendingRequestCount($user_id)
	  {
	  	 $this->db->where('friend_id',$user_id);
	  	 $this->db->where('status',0);	      
		 $query=$this->db->get("wgp_user_friends");
		 if($query){
		 	return $query->num_rows();		 	
		 }else{
		 	return false;
		 }
      }


	  public function getUnreadMailCount($user_id){
			$this->db->where('mail_to', $user_id );
			$this->db->where('mail_status', 0);				
			$query = $this->db->get('wgp_user_mail');
			if($query){
				return $query->num_rows();
			}else{
				return false;
			}
	  }

	  public function getPendingNotificationCount($user_id){
	  		 $this->db->where("user_id",$user_id);
  		 	$this->db->where("notification_status",0);	     
		 	$query=$this->db->get("wgp_user_notifications");
		 	if($query){
				return $query->num_rows();
			}else{
				return false;
			}
	  }

}?>