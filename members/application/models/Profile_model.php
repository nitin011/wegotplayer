<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile_model extends CI_Model {
	  
	  public function __construct()
	  {
	       parent::__construct();
		   $this->load->database();
	  }//function end

	  public function checkUsername($username)
	  {
	  		$this->db->where('login_name',$username);
	  		$query = $this->db->get('users');
	  		if(!$query){
	  			return false;
	  		} else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
	  }
	  public function getCodeAndUsername($user_id){
	  	  	$row = array('login_name','unique_code');	  	  	
	  	    $this->db->select($row);
	  	    $this->db->where('user_id',$user_id);
	  		$query = $this->db->get('users');
	  		if(!$query){
	  			return false;
	  		} else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
	  }

	  public function getCoverImage($user_id)
	  {
	  		$this->db->where('wgp_user_id',$user_id);
	  		$this->db->where('status',1);
	  		$query=$this->db->get("cover_image");
		     if(!$query){
			     return  $cover_url=base_url().'images/cover-image.png';
			  }else{
			       if($query->num_rows()!=1)
		           {
				       return  $cover_url=base_url().'images/cover-image.png';
                   }else{
						   $row=$query->row();
						   if($row->url==''){
							 return  $cover_url=base_url().'images/cover-image.png';
						   }else{
								 return $cover_url=base_url().$row->url;
						   }
				   }				   
			
			}
	  }

	  public function getProfileImage($user_id)
	  {
	  		$this->db->where("user_id", $user_id);
            $this->db->where("is_default",1);			
		    $query=$this->db->get("wgp_user_images");
			if(!$query){
			return $image_url=base_url().'images/sports-football.png';
			}else{
			       if($query->num_rows()!=1)
		           {
				    return  $image_url=base_url().'images/sports-football.png';
                   }else{
						   $row=$query->row();
						   if($row->image_file==''){
								return  $image_url=base_url().'images/sports-football.png';
						   }else{
								return $image_url=base_url().$row->image_file;
						   }
				   }				   
			
			}
	  }

	  public function getPersonal($user_id,$row)
	  {	  
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

	  public function getPrivacy($user_id){
	  	  $this->db->where("user_id",$user_id);	  	 
		  $query=$this->db->get("wgp_user_privacy");
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
	 

	  public function getPrivacyData($user_id,$privacy_id){
	  	 $this->db->where("user_id",$user_id);
	  	  $this->db->where('privacy_id',$privacy_id);
		  $query=$this->db->get("wgp_user_privacy");
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

	  

	  public function verifyCode($data)
	  {
	  		$this->db->where($data);
	  		$query = $this->db->get('users');
	  		if(!$query){
	  			return false;
	  		} else{
			   if($query->num_rows()>0)
				{
				  return true;
				}else{
				  return false;
				}
		   }
	  }

	  public function checkFriendShip($id_arry){
	  		
  			 $friend_id=$id_arry['user_id']; 
  			 $user_id=$id_arry['friend_id'];  			 

  			$xx="((user_id=$user_id AND friend_id=$friend_id) OR (user_id=$friend_id AND friend_id=$user_id))";

  			 $swap_id = array('user_id' => $user_id,'friend_id'=> $friend_id);
  	         
	  		$this->db->where($xx);	  		
	  		$this->db->where('status',1);
	  	    $query = $this->db->get('wgp_user_friends');	  	
	  		if(!$query){
	  			echo 0;
	  		} else{
			   if($query->num_rows()>0)
				{
				 return $result = $query->num_rows();			  

				}else{
				 return $result = $query->num_rows();
				}
		   }

	  }

	  public function getFriendStatus($id_arry)
	  {
	  		$this->db->select('status');
	  		$this->db->where($id_arry);
	  		$query = $this->db->get('wgp_user_friends');	  	
	  		if(!$query){
	  			return false;
	  		} else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
	  }

	  public function checkMemberShip($profile_user_id){

	  	$this->db->where('user_id',$profile_user_id);
	  	$this->db->where('registration_type',2);
	  		$query = $this->db->get('users');
	  		if(!$query){
	  			return false;
	  		} else{
			   if($query->num_rows()>0)
				{
				  return true;
				}else{
				  return false;
				}
		   }

	  }

	  public function updateProfileUrl($user_id,$data)
	  { 
			 $this->db->where('user_id', $user_id);
		     $this->db->update('users', $data);
			  $affected_row=$this->db->affected_rows();	
		        if($affected_row>0){
		        	return true;
		        }else{
		        	return false;
		      }
	  }




}  ?>