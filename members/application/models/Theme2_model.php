<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Theme2_model extends CI_Model {
	  
	  public function __construct()
	  {
	       parent::__construct();
		   $this->load->database();
	  }//function end


	  public function getUserDetails($user_id){
	  	 $row = array('user_id','unique_code','name','email','login_name'); 
	       $this->db->select($row);
	       $this->db->where("user_id",$user_id);
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


	  public function getPersonalDetails($user_id){
	  	$row = array('user_id','birth_year','birth_month','birth_day','first_name',
		      		  'last_name','gender','nation_value(nationality) nationality_n','nationality',
		      		   'sport_name(sport) sport_name','sport','address','graduation_month',
		      		   'graduation_year','hand_name(hand) hand_name','foot',
		      		   'foot_name(foot) foot_name','hand',
		      		   'position_value(position_speciality) position_name','position_speciality',
		      		   'height_value(height) height_name','height',
		      		   'weight_value(weight) weight_name','weight',
		      		   'level_name(level) level_name','level','location'
		      		); 
	       $this->db->select($row);
	       $this->db->where("user_id",$user_id);
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


	  public function getPersonalInfo($user_id){
	  	$this->db->select('message');	  	
	  	$this->db->where("user_id",$user_id);
		$query=$this->db->get("wgp_player_personal");
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

	  public function getShortLocationName($nationality){
	  		$this->db->select('countryCode');
	  		$this->db->where('id',$nationality);
		    $query = $this->db->get("nationalities");		  
		    if($query->num_rows()>0){
			    return $query->row();
			}else{
			    return false;
			}
	  }

	  public function getEvent($user_id){
	  	 $row = array('wgp_event_id','wgp_event_name','wgp_event_start');
	  	 $this->db->select($row);
	  	 $today=Date('d-F-Y H:i:s');
		 $this->db->where("wgp_user_id",$user_id);	
		 $this->db->where('wgp_event_start >=',$today);	
		 $this->db->order_by('wgp_event_start','ASC');
		 $this->db->limit(3);
		 $query=$this->db->get("wgp_user_events");
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

	  public function getAllEvent($user_id){	
	     $row =array('wgp_event_name','wgp_event_start','wgp_event_end',
	     			'event_imp_name(wgp_event_importance) wgp_event_importance',
	     			'wgp_address','wgp_event_website',
	     			'event_type_name(wgp_event_type) wgp_event_type',
	     			'wgp_event_id');  
	     $this->db->select($row);	
		 $this->db->where("wgp_user_id",$user_id);			
		 $this->db->order_by('wgp_event_start','ASC');		 
		 $query=$this->db->get("wgp_user_events");
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

	  public function getLatestPost($user_id){
	  	 $row = array('content','post_date');
	  	 $this->db->select($row);
	  	 $today=Date('d-F-Y H:i:s');
		 $this->db->where("user_id",$user_id);
		 $this->db->where('parent_post',0);	
		 $this->db->where('post_date <=',$today);	
		 $this->db->order_by('post_date','DESC');
		 $this->db->limit(3);
		 $query=$this->db->get("wgp_user_post");
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



	  public function getProfileViewCount($user_id){	  	   
			$this->db->where('notification_type', 9);
			$this->db->where('user_id',$user_id);
	  		$query = $this->db->get('wgp_user_notifications');
	  		if($query->num_rows()>0){
				return  $query->num_rows();
			}else{
				return 0;
			}
	  }


	  public function getFriends($user_id){
		     $this->db->where('user_id',$user_id);
		  	 $this->db->where('status',1);	      
			 $query=$this->db->get("wgp_user_friends");
			 if($query->num_rows()>0){
		  			return $query->num_rows();
		  	}else{
		  		return 0;
		  	}
	}
	  

	  

}?>