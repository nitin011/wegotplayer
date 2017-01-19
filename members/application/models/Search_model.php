<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Search_model extends CI_Model {
	  
	  public function __construct()
	  {
	       parent::__construct();
		   $this->load->database();
	  }//function end

	  public function searchUser($field)
	  {
	  		$row = array('user_id','name','login_name');
	  		$this->db->like('name', $field);
			$this->db->or_like('email',$field);
			$this->db->or_like('login_name', $field);  
			$this->db->select($row);
			$query =$this->db->get('users');
	  		if(!$query){
	  			return false;
	  		} else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	  }

	  public function searchUserByName($name){
	 	$row = array('user_id','name','login_name','email');	 	
	 	$this->db->like('name', $name);
	 	$this->db->select($row);
	 	$query =$this->db->get('users');
	  		if(!$query){
	  			return false;
	  		} else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	 }

	 public function getUserDetail($user_id){
	    $row = array('name','login_name','email');	 	
	 	$this->db->where('user_id', $user_id);
	 	$this->db->select($row);
	 	$query =$this->db->get('users');
	  		if(!$query){
	  			return false;
	  		} else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	 }

	   public function sportList()
	   { 	  	  
		  $this->db->order_by("sportName", "asc"); 	  	  
		  $query=$this->db->get("wgp_sports");
	  	  if($query->num_rows()>0)
				{
				    return $query->result();
				}else{
				    return false;
				}
	  }//function end

	   public function handList()
	  	{ 	  	  
		  $query=$this->db->get("wgp_hand");
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
		 
	  }//function end

	   public function footList()
	  	{ 	  	  
		  $query=$this->db->get("wgp_foots");
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
		 
	  }//function end

	  public function heightList()
	  	{ 	  	  
		  $query=$this->db->get("wgp_heights");
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
		 
	  }//function end

	   public function weightList()
	  	{ 	  	  
		  $query=$this->db->get("wgp_weights");
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
		 
	  }//function end

	  public function getSeeking()
	  	{ 	  	  
		  $query=$this->db->get("master_seeking");
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
	public function nationList()
	  	{ 
		  $query=$this->db->get("nationalities");
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
		 
	  }//function 

	  public function countryList()
	  	{ 
		  $query=$this->db->query("SELECT idCountry,countryName FROM countries ORDER BY countryName ASC");
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
		 
	  }//function end


	  public function advanceSearchSport($row,$sport)
	  {  	
	  	
	  	 $max_age=$row['max_age'];
	  	 $min_age=$row['min_age'];

	  	 $min_age = isset($row['min_age']) ? $row['min_age'] : 18;
	  	 $max_age = isset($row['max_age']) ? $row['max_age'] : 70;
	  	 $min_height = isset($row['min_height']) ? $row['min_height'] : 1;
	  	 $max_height = isset($row['max_height']) ? $row['max_height'] : 48;
	  	 $min_weight = isset($row['min_weight']) ? $row['min_weight'] : 1;
	  	 $max_weight = isset($row['max_weight']) ? $row['max_weight'] : 121;
	  	 $max_year=(int)date('Y', strtotime('-'.$max_age.' year'));
	  	 $min_year=(int)date('Y', strtotime('-'.$min_age.' year'));
	 
	  	$this->db->select('user_id');	  	
	  	$this->db->like('first_name', $row['first_name'], 'both');
        $this->db->where('birth_year >', $min_year);
        $this->db->where('birth_year <', $max_year);
        $this->db->where('height >', $min_height);
        $this->db->where('height <', $max_height);
        $this->db->where('weight >',$min_weight);
        $this->db->where('weight <',$max_weight);
        $this->db->where('level', $row['level']);
        $this->db->where('gender', $row['gender']); 
        $this->db->where('position_speciality', $row['position_speciality']); 
        $this->db->where('hand', $row['hand']); 
        $this->db->where('foot', $row['foot']); 
        $this->db->where('nationality', $row['nationality']);
        $this->db->where('location', $row['location']); 
	  	$this->db->or_where_in('sport', $sport);
	  	$query=$this->db->get("wgp_player_data");

	  	if($query->num_rows()>0){
				  return $query->result();
		  }else{
				  return false;
			}

	  }
	  public function advanceSearch($row)
	  {	  
	  	
	  	 $max_age=$row['max_age'];
	  	 $min_age=$row['min_age'];

	  	 $min_age = isset($row['min_age']) ? $row['min_age'] : 18;
	  	 $max_age = isset($row['max_age']) ? $row['max_age'] : 70;
	  	 $min_height = isset($row['min_height']) ? $row['min_height'] : 1;
	  	 $max_height = isset($row['max_height']) ? $row['max_height'] : 48;
	  	 $min_weight = isset($row['min_weight']) ? $row['min_weight'] : 1;
	  	 $max_weight = isset($row['max_weight']) ? $row['max_weight'] : 121;
	  	 $min_year=(int)date('Y', strtotime('-'.$min_age.' year'));
	  	 $max_year=(int)date('Y', strtotime('-'.$max_age.' year'));
	  	 
	
	  	$this->db->select('user_id');	  	
	  	$this->db->like('first_name', $row['first_name'], 'both');
        $this->db->where('birth_year >', $min_year);
        $this->db->or_where('birth_year <', $max_year);
        $this->db->or_where('height >', $min_height);
        $this->db->or_where('height <', $max_height);
        $this->db->or_where('weight >',$min_weight);
        $this->db->or_where('weight <',$max_weight);
        $this->db->or_where('level', $row['level']);
        $this->db->where('sport', $row['sport']);
        $this->db->where('gender', $row['gender']); 
        $this->db->or_where('position_speciality', $row['position_speciality']); 
        $this->db->or_where('hand', $row['hand']); 
        $this->db->or_where('foot', $row['foot']); 
        $this->db->where('nationality', $row['nationality']);
        $this->db->where('location', $row['location']);	  
	  	$query=$this->db->get("wgp_player_data");
      //print_r($this->db->last_query());
      
	  	if($query->num_rows()>0)
				{
				   return $query->result();
				}else{
				   return false;
				}

	  }

	  public function advanceSearchSportName($name,$sport){
	  		$this->db->select('user_id');
	  		$this->db->like('first_name',$name);
	  		$this->db->or_where_in('sport', $sport);
	  		$query=$this->db->get("wgp_player_data");
	  		if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
	  }



}?>