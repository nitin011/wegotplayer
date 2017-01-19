<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Event_model extends CI_Model {
	  
	  public function __construct()
	  {
	       parent::__construct();
	       date_default_timezone_set('Asia/Calcutta');
		   $this->load->database();
	  }//function end	

	public function addEvent($data){
		$query = $this->db->insert('wgp_user_events',$data);
		  if( $query ){
				return true;
			}
		  else{
				return false;
			}
	}

	public function getEvent($user_id){
		  $this->db->select('wgp_event_name');
		  $this->db->select('wgp_event_start');
		  $this->db->where("wgp_user_id",$user_id);
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

	public function getEventDetail($user_id,$event_date,$row_number){

		$this->db->where("wgp_user_id",$user_id);
		$this->db->like('wgp_event_start', $event_date);
		$query=$this->db->get("wgp_user_events");
		if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row_array($row_number);
				}else{
				  return false;
				}
		   }
		}

	public function getEventDataDetail($user_id,$event_id){
		$row = array('wgp_event_name','wgp_event_start','level_name(wgp_event_level) wgp_event_level','wgp_event_importance',
					  'wgp_event_end','wgp_event_website','wgp_address');
		$this->db->select($row);
		$this->db->where("wgp_user_id",$user_id);
		$this->db->like('wgp_event_id', $event_id);
		$query=$this->db->get("wgp_user_events");
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

public function getEventData($user_id,$event_id){

		$this->db->where("wgp_user_id",$user_id);
		$this->db->like('wgp_event_id', $event_id);
		$query=$this->db->get("wgp_user_events");
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

	public function getEventType(){
		$query=$this->db->get("wgp_event_types");
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

	public function getEventImportance(){		
		$query=$this->db->get("master_event_importance");
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

	public function updateEvent($wgp_event_id,$user_id,$row)
	{		
		$this->db->where('wgp_event_id',$wgp_event_id);
		$this->db->where('wgp_user_id',$user_id);		
		$query = $this->db->update('wgp_user_events',$row);
		  if( $query ){
				return true;
			}else{
				return false;
			}
	}

	public function deleteEvent($user_id,$wgp_event_id){
		$this->db->where('wgp_event_id', $wgp_event_id);
    	$this->db->where('wgp_user_id', $user_id);	
    	$query = $this->db->delete('wgp_user_events');
    	if( $query ){
				return true;
		 }else{
				return false;
		}
	}

	public function getEventSchedule($user_id){	
	         		 
		 $today=Date('d-F-Y H:i:s');
		 $this->db->where("wgp_user_id",$user_id);	
		 $this->db->where('wgp_event_start >=',$today);	
		 $this->db->order_by('wgp_event_start','DESE');
		 $this->db->limit(5);
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



} ?>