<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Coach_model extends CI_Model {
	  
	  public function __construct()
	  {
	       parent::__construct();
		   $this->load->database();
	  }//function end	  
	  
	  
	  public function coach_details($user_id,$data)
	  {  
	      $this->db->where("user_id",$user_id);
	      $this->db->select($data);
		  $query=$this->db->get("wgp_coach_data");
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
		 
	  }//function end

	  public function getOccupation(){
	  	  $query=$this->db->get("wgp_occupations");
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

	  public function insertCoach($data){
	  	$query = $this->db->insert('wgp_coach_data',$data);
		  if( $query ){
				return true;
			}
		  else{
				return false;
			}
	  }

	  public function updateCoach($data,$user_id)
	  {
	  	 $this->db->where('user_id', $user_id);
	  	 $query = $this->db->update('wgp_coach_data',$data);
		  if( $query ){
				return true;
			}
		  else{
				return false;
			}
	  }

	  public function updateUserName($user_id,$user_data){
	  	 $this->db->where('user_id', $user_id);
	  	 $query = $this->db->update('users',$user_data);
		  if( $query ){
				return true;
			}
		  else{
				return false;
			}
	  }

}