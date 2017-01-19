<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Friend_model extends CI_Model {
	  
	  public function __construct()
	  {
	       parent::__construct();
		   $this->load->database();
	  }//function end	  
	  
	  
	  public function checkEmail($email)
	  {  
	      $this->db->where('email',$email);	      
		  $query=$this->db->get("users");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return true;
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	  public function getFriendDetail($email)
	  {
	  	  $this->db->select('user_id');
	  	  $this->db->where('email',$email);	      
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

	  //send friend request
	  public function sendFriendRequest($data)
	  {     $this->db->set('date_modify','NOW()',false);
	        $this->db->set($data);
	  		$query=$this->db->insert("wgp_user_friends");
	  		if($query){
	  			return true;
	  		}else{
	  			return false;
	  		}
	  }

	  public function getPendingRequest($user_id)
	  {
	  	 $this->db->where('user_id',$user_id);
	  	 $this->db->where('status',0);	      
		 $query=$this->db->get("wgp_user_friends");
		 if($query){
	  			$result = $query->result();

	  			$req_data = array();
	  			foreach ($result as  $value) {
	  				$friend_id =$value->friend_id;

	  			    $user = $this->getFriendDetails($friend_id);
	  			    $dp = $this->getFriendImage($friend_id);	  			    
	  				$arry = array('friend_id' => $friend_id,'user'=>$user,
	  					'pic_url'=>base_url().$dp);

	  				array_push($req_data,$arry);               

	  			}
	  			return $req_data;
	  			
	  		}else{
	  			return false;
	  		}
	  }

	  public function getSportValue($friend_id){
	  	  $this->db->select('sport_name(sport)sport');	  	  
	  	  $this->db->where('user_id',$friend_id);	      
		  $query=$this->db->get("wgp_player_data");
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

	  public function getFriendDetails($friend_id)
	  {
	  	  $this->db->select('name');
	  	  $this->db->select('email');
	  	  $this->db->select('login_name');	  	  
	  	  $this->db->where('user_id',$friend_id);	      
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

	  public function getFriendImage($friend_id)
	  {
	  	  $this->db->select('image_file');
	  	  $this->db->where('user_id',$friend_id);
	  	  $this->db->where('is_default',1,false);	      
		  $query=$this->db->get('wgp_user_images');
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $image_url=$query->row('image_file');
				}else{
				  return $image_url='images/sports-football.png';
				}
		   }

	  }

	  public function getFriends($user_id){
	  	$this->db->where('user_id',$user_id);
	  	 $this->db->where('status',1);	      
		 $query=$this->db->get("wgp_user_friends");
		 if($query){
	  			$result = $query->result();

	  			$req_data = array();
	  			foreach ($result as  $value) {
	  				$friend_id =$value->friend_id;

	  			    $user = $this->getFriendDetails($friend_id);

	  			    $dp = $this->getFriendImage($friend_id);
	  				$arry = array('friend_id' => $friend_id,'user'=>$user,'pic_url'=>base_url().$dp);

	  				array_push($req_data,$arry);               

	  			}
	  			return $req_data;
	  			
	  		}else{
	  			return false;
	  		}
	  }

	  public function getRequestList($user_id)
	  {
	  	   $this->db->where('friend_id',$user_id);
	  	   $this->db->where('status',0);	      
		   $query=$this->db->get("wgp_user_friends");
		   if($query){
		   		$result = $query->result();

	  			$req_data = array();
	  			foreach ($result as  $value) {
	  				$friend_id =$value->user_id;

	  			    $user = $this->getFriendDetails($friend_id);
	  			    $dp = $this->getFriendImage($friend_id);
	  			    $sport =$this->getSportValue($friend_id);

	  				$arry = array('friend_id' => $friend_id,
	  					           'user'=>$user,'pic_url'=>base_url().$dp,
	  					           'sport'=>$sport);

	  				array_push($req_data,$arry);               

	  			}
	  			return $req_data;
	  		}else{
	  			return false;
	  		}

	  }

	  public function acceptRequest($friend_id,$user_id)
	  {	

	  	//$this->db->where('user_id', $user_id);
	  	//$this->db->where('friend_id',$friend_id);
	  	//$this->db->or_where('user_id', $friend_id);
	  	//$this->db->where('friend_id', $user_id); 
		//$this->db->set('status',1);
        //$query = $this->db->update('wgp_user_friends');
	     $qry1 ="SELECT `request_id` FROM `wgp_user_friends` WHERE `user_id`= $user_id AND `friend_id`= $friend_id ";
	     $query1 =$this->db->query($qry1);
	     if(!$query1){
				   $exist= 0;
			   }else{
				   if($query1->num_rows()>0)
					{
					  $exist= 1;
					}else{
					  $exist= 0;
					}
			   }
	     if($exist==1)
	     {
	        $qry ="UPDATE `wgp_user_friends` SET`status` = 1 
	     		  WHERE (`user_id` = $user_id  AND `friend_id` = $friend_id) 
	     		  OR (`user_id` = $friend_id AND `friend_id` = $user_id)";

	        $query=$this->db->query($qry);
		     if($query){
		    	 return true;
		    }else{
		    	return false;
		    }
		}else
		{
	        
			$qry2 ="INSERT INTO `wgp_user_friends`(`user_id`, `friend_id`, `date_modify`, `status`) 
			       VALUES ($user_id,$friend_id,NOW(),1)";
	        $query2=$this->db->query($qry2);

	        $qry3 ="UPDATE `wgp_user_friends` SET`status` = 1 
	     		  WHERE `user_id` = $friend_id AND `friend_id` = $user_id";

	        $query3=$this->db->query($qry3);
		     if($query3){
		    	 return true;
		    }else{
		    	return false;
		    }
		}
	}//end accept request


	public function deleteFriend($friend_id,$user_id)
	{
		$qry ="DELETE  `wgp_user_friends` 
	     	   WHERE (`user_id` = $user_id  AND `friend_id` = $friend_id) 
	     	   OR (`user_id` = $friend_id AND `friend_id` = $user_id)";
		$query=$this->db->query($qry);
		     if($query){
		    	 return true;
		    }else{
		    	return false;
		    }
	  }	

	public function cancelFriendRequest($friend_id,$user_id)
	{
		  $this->db->where('user_id', $user_id);
		  $this->db->where('friend_id', $friend_id);
		  $this->db->where('status',0);
		   $this->db->or_where('status',3);
     	  $query =$this->db->delete('wgp_user_friends'); 
     	  if($query){	  			
				  return true;
				}else{
				  return false;
				}
	}  

	 

} ?>