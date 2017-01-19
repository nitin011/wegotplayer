<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Record_model extends CI_Model {
	  
	  public function __construct()
	  {
	       parent::__construct();
		   $this->load->database();
	  }//function end	

   public function getRecord($user_id){
   	$this->db->where('user_id',$user_id);
   	$query = $this->db->get('wgp_records');
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

   public function addRecord($data){
	  $query = $this->db->insert('wgp_records',$data);
		  if($query){
				return true;
			}else{
				return false;
			}
	  }

	  public function updateRecord($data,$user_id){
	  		$this->db->where('user_id',$user_id);
	  		$this->db->set($data);
			$query = $this->db->update('wgp_records');
			if($query){
				return true;
			}else{
				return false;
			}

	  }

	  // get user language
	  public function getLanguage($user_id,$row){
	  		$this->db->select($row);
	  		$this->db->where('user_id',$user_id);
		   	$query = $this->db->get('wgp_user_language');
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

	  public function getUserLanguage($user_id){
	  		$this->db->where('user_id',$user_id);
		   	$query = $this->db->get('wgp_user_language');
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

	 

	 public function getLanguageLevel(){
	 	 $query = $this->db->get('master_language_level');
	  		if($query->num_rows()>0){
				  return $query->result();
			}else{
				 return false;
			}
	 }

	 public function addLanguage($row){
	 	$query = $this->db->insert('wgp_user_language',$row);
		  if($query){
				return true;
			}else{
				return false;
			}
	 }

	 public function deleteLanguage($row)
	  {
	  	$this->db->where($row);
	  	$query = $this->db->delete('wgp_user_language');
	  	if( $query ){
				return true;
		 }else{
				return false;
		}
	  }

	  public function saveLanguage($row,$data){
	  	 $this->db->where($row);
	  	 $query = $this->db->update('wgp_user_language',$data);
	  	 if( $query ){
				return true;
		 }else{
				return false;
		 }
	  }

	  public function updateStar($row,$data){
	  	 $this->db->where($row);
	  	 $query = $this->db->update('wgp_user_language',$data);
	  	 if( $query ){
				return true;
		 }else{
				return false;
		 }
	  }



}?>