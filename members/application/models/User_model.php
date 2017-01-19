<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {
	  
	  public function __construct()
	  {
	       parent::__construct();
		   $this->load->database();		   
	  }//constructor end

	  public function checkEmailExist($email)
	  {		
		   $this->db->where('email',strtolower($email));
		   $query=$this->db->get("users");
		   if($query->num_rows()>0){
				return true;
		   }else{
				return false;
		   }
	  }//checkEmailExist function end 

	  public function registerUser($user_data)
	  {	 	  	 
		  $this->db->set('reg_time', 'NOW()', FALSE);		  
		  $query = $this->db->insert('users',$user_data);
		  if( $query ){
				return true;
			}
		  else{
				return false;
			}
      }//registerUser function end 

     //Register by social media


     
    public function registerBySocial($data){

    	$reg_code  = md5(time());
    	$id = mt_rand(100000, 999999);
		$id_u = mt_rand(100, 999);
    	$user_data = array('unique_code'=>$id,
    					   'name' =>$data['name'] ,
    		               'email'=>$data['email'] ,    		               
    		               'register_by'=>$data['login_method'],
    		               'verified'=>1,
    		               'registration_type'=>1,
    		               'verify_hash' => $reg_code,	
						   'remote_addr'=>($_SERVER['REMOTE_ADDR']));
    	 $this->db->set('reg_time', 'NOW()', FALSE);		  
		 $this->db->insert('users',$user_data);
		 return ($this->db->affected_rows() != 1) ? false : true;
		  
    }

      public function isVerified($email)
      {
      	 $this->db->where('email',$email);
		 $this->db->where("verified",1);
      	 $query = $this->db->get('users');
      	 if($query->num_rows()>0)
		  {
		  	return true;
		  }else{
		  	return false;
		  }
      }

      public function isUnique($id)
      {
      	 $this->db->where('unique_code',$id);
      	 $query = $this->db->get('users');
      	  if($query->num_rows()>0)
		  {
		  	return true;
		  }else{
		  	return false;
		  }
      }

      function login($login,$password)
	  {    
	      $email=strtolower($login);
	      $row = array('user_id','account_type','unique_code','name','email','password','registration_type','activated','account_type_name(account_type) acc_type');		  
		  $this->db->select($row);
		  $this->db->where("email = '$email'");
		  $this->db->where("password",$password);
		  $this->db->where("verified",1);	  
		  $query=$this->db->get("users");
		  
		  if($query->num_rows()>0)
		  { 
		    
			$row=$query->row();		
			// fetching the profile image for session			
		    $this->db->where("user_id", $row->user_id);
            $this->db->where("is_default",1);			
		    $query2=$this->db->get("wgp_user_images");
			if(!$query){
			$image_url='images/sports-football.png';
			}else{
			       if($query2->num_rows()!=1)
		           {
				     $image_url='images/sports-football.png';
                   }else{
						   $row2=$query2->row();
						   if($row2->image_file==''){
								  $image_url='images/sports-football.png';
						   }else{
								 $image_url=$row2->image_file;
						   }
				   }				   
			
			}
			 $this->db->where("wgp_user_id", $row->user_id); 
			 $this->db->where("status", 1);             			
		     $query3=$this->db->get("cover_image");
		     if(!$query3){
			  $cover_url='images/cover-image.png';
			  }else{
			       if($query3->num_rows()!=1)
		           {
				     $cover_url='images/cover-image.png';
                   }else{
						   $row3=$query3->row();
						   if($row3->url==''){
								  $cover_url='images/cover-image.png';
						   }else{
								 $cover_url=$row3->url;
						   }
				   }				   
			
			}
		    
			$userdata = array(	
			'user_id'  => $row->user_id,
			'unique_code'=>$row->unique_code,	
			'name'     => $row->name,				
			'email'    => $row->email,
			'password' => $row->password,
			'usertype' => $row->registration_type,
            'dp_url'   => $image_url,
            'activated'=> $row->activated,
            'cover_url'=> $cover_url,
            'acc_type' => $row->acc_type,
            'account_type'=>$row->account_type          	
			);
						
			$this->session->set_userdata('logged_in',$userdata);
			return true;
		  }
		    return false;
	  }//function end



	  public function authLogin($email)
	  {
	  	  $email=strtolower($email);
	      $row = array('user_id','account_type','unique_code','name','email','password','registration_type','activated','account_type_name(account_type) acc_type');		  
		  $this->db->select($row);
		  $this->db->where("email = '$email'");	
		  $query=$this->db->get("users");
		  
		  if($query->num_rows()>0)
		  { 
		    
			$row=$query->row();	

			// fetching the profile image for session			
		    $this->db->where("user_id", $row->user_id);
            $this->db->where("is_default",1);			
		    $query2=$this->db->get("wgp_user_images");
			if(!$query){
			$image_url='images/sports-football.png';
			}else{
			       if($query2->num_rows()!=1)
		           {
				     $image_url='images/sports-football.png';
                   }else{
						   $row2=$query2->row();
						   if($row2->image_file==''){
								  $image_url='images/sports-football.png';
						   }else{
								 $image_url=$row2->image_file;
						   }
				   }				   
			
			}
			 $this->db->where("wgp_user_id", $row->user_id); 
			 $this->db->where("status", 1);             			
		     $query3=$this->db->get("cover_image");
		     if(!$query3){
			  $cover_url='images/cover-image.png';
			  }else{
			       if($query3->num_rows()!=1)
		           {
				     $cover_url='images/cover-image.png';
                   }else{
						   $row3=$query3->row();
						   if($row3->url==''){
								  $cover_url='images/cover-image.png';
						   }else{
								 $cover_url=$row3->url;
						   }
				   }				   
			
			}
		    
			$userdata = array(	
			'user_id'  => $row->user_id,
			'unique_code'=>$row->unique_code,	
			'name'     => $row->name,				
			'email'    => $row->email,
			'password' => $row->password,
			'usertype' => $row->registration_type,
            'dp_url'   => $image_url,
            'activated'=> $row->activated,
            'cover_url'=> $cover_url,
            'acc_type' => $row->acc_type,
            'account_type'=>$row->account_type          	
			);
						
			$this->session->set_userdata('logged_in',$userdata);
			return true;
		  }
		    return false;	



	  }



	  public function emailverification($reg_code){

	  	$this->db->where('verify_hash', $reg_code);
		$this->db->set('verified', 1, FALSE);
        $this->db->update('users');	
	     return true;

	  }

	  public function checkUserName($data){
	  		$this->db->where($data);
	  		$query = $this->db->get('users');
	      	  if($query->num_rows()>0)
			  {
			  	return true;
			  }else{
			  	return false;
			  }

	  }

	  public function lastVisit($email,$visit){

		$query=$this->db->query("UPDATE users SET last_visit_time=now(),previous_visit_time='$visit' where email='$email'");
		if( $query )
			return true;
		else
			return false;

	}

	public function lastActivity($user_id){

		$query=$this->db->query("UPDATE users SET last_activity=now() where user_id='$user_id'");
		if( $query )
			return true;
		else
			return false;

	}

	public function preVisit($email)
	  	{ 
	  	 
		  $query=$this->db->query("SELECT last_visit_time FROM users WHERE email='$email'");
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
	  public function playerRecord($user_data)
	  {  
		  $this->db->insert('wgp_player_data',$user_data);
		  return true;
      }//function end 

      //inser player personal info
      public function  playerPersonal($row){
      	$this->db->insert('wgp_player_personal',$row);
		  return true;
      } 

      public function updatePersonalInfo($row ,$user_id){

      	 $status=$this->checkPersonalData($user_id);
      	 if(!$status){
      	 	   $row1 = array('message' => $row['message'],
      	 	   				'user_id'=>$user_id,
      	 	   				'objective' => $row['objective']);
      	 	   $this->db->insert('wgp_player_personal',$row1);
		  		return true;

      	 }else{
	      	 $this->db->where('user_id',$user_id);	      	 
	      	 $this->db->update('wgp_player_personal',$row);
	      	 return true;
	      	}
      }

      public function checkPersonalData($user_id){
      		$this->db->where('user_id',$user_id);
      		$query = $this->db->get('wgp_player_personal');
      		if($query->num_rows()>0){
      			return true;
      		}else{
      			return false;
      		}

      }

      public function insertSeekId($seek_data){
      	$this->db->insert('wgp_player_seekings',$seek_data);
		  return true;
      }    
      public function insertContactId($contact_data){
      	 $this->db->insert('wgp_player_contacts',$contact_data);
		  return true;
      }

      public function updateSeekId($user_id,$seek_data)
       { 	
          $this->db->where('user_id', $user_id);      	   
      	  $query=$this->db->get('wgp_player_seekings');      	 
			
      	  if($query->result_id->num_rows==0){
      	  	    $data = array(
						   'user_id' =>$user_id,
						   'seeking_id' => $seek_data['seeking_id'] 						   
						); 
      	  	    $this->db->insert('wgp_player_seekings',$data); 	  	    
      	  	    return true;

      	  }else{

		     $query2=$this->db->update('wgp_player_seekings',$seek_data);		     
		     return true;
         } 
      } 
      public function updateContactId($user_id,$contact_data)
      {  
      	  $this->db->where('user_id', $user_id);      	   
      	  $query=$this->db->get('wgp_player_contacts');      	 

      	  if($query->result_id->num_rows==0){     	  	    
      	  		
      	  		$data = array(
						   'user_id' =>$user_id,
						   'contact_id' => $contact_data['contact_id'] 						   
						);
      	  		
      	  	    $this->db->insert('wgp_player_contacts',$data); 	  	    
      	  	    return true;

      	  }else{

		     $query2=$this->db->update('wgp_player_contacts',$contact_data);		     
		     return true;
         } 
      
      }

      public function seekingId($user_id)
	   {
	   		$this->db->where('user_id', $user_id);
	   		$query=$this->db->get('wgp_player_seekings');
	   		if($query->num_rows()>0)
				{
				  $result = $query->row();
				  return $seeking_id = $result->seeking_id;
				}else{
					return false;
				}
	   }
	   public function getSeekingId($user_id)
	   {
	   		$this->db->where('user_id', $user_id);
	   		$query=$this->db->get('wgp_player_seekings');
	   		if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  $result = $query->row();
				  //fetch name from master table
				  $seeking_id = $result->seeking_id;
				  $this->db->select('seekingName');
				  $this->db->where('id', $seeking_id);
	   		      $qry2=$this->db->get('master_seeking');
		   		      if($qry2->num_rows()>0)
					  {
					  	$rs =$qry2->row();
					  	return $seeking_name=$rs->seekingName;
					  }else{
					  	return false;
					  }

				}else{
				  return false;
				}
		   }

	   }
	   public function getContactId($user_id)
	   {
	   		$this->db->where('user_id', $user_id);
	   		$query=$this->db->get('wgp_player_contacts');
	   		if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  $result = $query->row();
				 
				  //fetch name from master table
				  $contact_id = $result->contact_id;
				  $this->db->select('contact_you');
				  $this->db->where('id', $contact_id);
	   		      $qry2=$this->db->get('master_contact_you');
		   		      if($qry2->num_rows()>0)
					  {
					  	$rs =$qry2->row();
					  	return $contact_name=$rs->contact_you;
					  }else{
					  	return false;
					  }
				}else{
				  return false;
				}
		   }
	   }
      

      public function updateProfile($user_data,$user_id)
	  {  
	  	  $this->db->where('user_id', $user_id);		 
		  $this->db->update('wgp_player_data',$user_data);
		  return true;
      }//function end

      public function updateBasicRecord($user_id,$data){
      	  $this->db->where('user_id', $user_id);		 
		  $this->db->update('wgp_player_data',$data);
		  $affected_row=$this->db->affected_rows();	
	        if($affected_row>0){
	        	return true;	        	
	        }else{
	        	return false;
	        }
      }

      public function updateUserName($user_name,$user_id){
      	  $this->db->where('user_id', $user_id);		 
		  $this->db->update('users',$user_name);
		  return true;
      }

      public function schoolRecord($school_data)
	  {  
		  $this->db->insert('wgp_school',$school_data);
		  return true;
      }//function end

      public function updateSchool($school_data,$user_id)
	  {  
	  	  $this->db->where('wgp_user_id', $user_id);		 
		  $this->db->update('wgp_school',$school_data);
		  return true;
      }//function end

      public function technicalRecord($tech_data)
	  {  
		  $this->db->insert('wgp_customform_technical',$tech_data);
		  return true;
      }//function end

     public function insertTactical($tact_data){
     	$this->db->insert('wgp_customform_tactical',$tact_data);
		  return true;
     }

     public function insertPhysical($physical_data){
     	$this->db->insert('wgp_customform_psysical',$physical_data);
		  return true;
     }
     public function updatePhysical($physical_data,$user_id){
     	$this->db->where('wgp_user_id', $user_id);		 
		$this->db->update('wgp_customform_psysical',$physical_data);
		  return true;
     }

     public function  insertPsyhosocial($psy_data){
     	$this->db->insert('wgp_customform_psyhosocial',$psy_data);
		  return true;
     }
     public function updatePsyhosocial($psy_data,$user_id){
     	$this->db->where('wgp_user_id', $user_id);		 
		$this->db->update('wgp_customform_psyhosocial',$psy_data);
		  return true;
     }
     public function insertStats($stats_data){
     	$this->db->insert('wgp_customform_stats',$stats_data);
		 return true;
     }
     public function addInjurie($injur_data){
     	$this->db->insert('wgp_customform_injuries',$injur_data);
		 return true;
     }
     public function updateInjurie($user_id,$injur_data,$wgp_table_id){
     	$this->db->where('wgp_table_id', $wgp_table_id);
    	$this->db->where('wgp_user_id', $user_id);		 
		$this->db->update('wgp_customform_injuries',$injur_data);
		return true;	
     }

     public function deleteInjurRow($user_id,$wgp_table_id){
     	$this->db->where('wgp_table_id', $wgp_table_id);
    	$this->db->where('wgp_user_id', $user_id);	
    	$this->db->delete('wgp_customform_injuries');
    	return true;
     }

     public function updateStatsRow($user_id,$stats_data,$wgp_table_id){
     	$this->db->where('wgp_table_id', $wgp_table_id);
    	$this->db->where('wgp_user_id', $user_id);		 
		$this->db->update('wgp_customform_stats',$stats_data);
		return true;
     }

     public function deleteStatsRow($user_id,$wgp_table_id){
     	$this->db->where('wgp_table_id', $wgp_table_id);
    	$this->db->where('wgp_user_id', $user_id);	
    	$this->db->delete('wgp_customform_stats');
    	return true;

     }

     public function insertTestRecord($test_data){
     	$this->db->insert('wgp_customform_testscores',$test_data);
		  return true;
     }

      public function updateTech($tech_data,$user_id)
      {
      	  $this->db->where('wgp_user_id', $user_id);		 
		  $this->db->update('wgp_customform_technical',$tech_data);
		  return true;
      }

      public function updateTact($tact_data,$user_id){
      	 $this->db->where('wgp_user_id', $user_id);		 
		  $this->db->update('wgp_customform_tactical',$tact_data);
		  return true;
      }

      public function insertTranscript($data){
     	$this->db->insert('wgp_customform_transcripts',$data);
		  return true;
     }

    public function updateTestRow($user_id,$update_data,$wgp_table_id){    	
    	$this->db->where('wgp_table_id', $wgp_table_id);
    	$this->db->where('wgp_user_id', $user_id);		 
		$this->db->update('wgp_customform_testscores',$update_data);
		return true;
    }

    public function deleteTestRow($user_id,$wgp_table_id){
    	$this->db->where('wgp_table_id', $wgp_table_id);
    	$this->db->where('wgp_user_id', $user_id);	
    	$this->db->delete('wgp_customform_testscores');
    	return true;
    }
    public function updateTransRow($user_id,$data,$wgp_table_id){
    	$this->db->where('wgp_table_id', $wgp_table_id);
    	$this->db->where('wgp_user_id', $user_id);		 
		$this->db->update('wgp_customform_transcripts',$data);
		return true;
    }

    public function deleteTransRow($user_id,$wgp_table_id){
    	$this->db->where('wgp_table_id', $wgp_table_id);
    	$this->db->where('wgp_user_id', $user_id);	
    	$this->db->delete('wgp_customform_transcripts');
    	return true;
    }

    public function addTeamInfo($data){
    	$query = $this->db->insert('wgp_teaminfo',$data);
		 if($query){
    		return true;
    	}else{
    		return false;
    	}
    }
    public function updateTeaminfo($user_id,$data_info){    	
    	$this->db->where('wgp_user_id', $user_id);		 
		$query =$this->db->update('wgp_teaminfo',$data_info);
		if($query){
    		return true;
    	}else{
    		return false;
    	}
    }

    public function insertRefer($data){
    	$query =$this->db->insert('wgp_customform_references',$data);
    	if($query){
    		return true;
    	}else{
    		return false;
    	}
		  
    }
    public function updateReferRow($refer_data,$wgp_table_id,$user_id){
    	$this->db->where('wgp_table_id', $wgp_table_id);
    	$this->db->where('wgp_user_id', $user_id);		 
		$this->db->update('wgp_customform_references',$refer_data);
		return true;
    }
    public function deleteReferRow($user_id,$wgp_table_id){
    	$this->db->where('wgp_table_id', $wgp_table_id);
    	$this->db->where('wgp_user_id', $user_id);	
    	$this->db->delete('wgp_customform_references');
    	return true;
    }

    public function addReferData($row){
    	$this->db->set('refer_time', 'NOW()', FALSE);
    	$query =$this->db->insert('refer',$row);
    	if($query){
    		return true;
    	}else{
    		return false;
    	}
    }

    public function getReferData($hash_key){
    	$this->db->where('hash_key',$hash_key);
    	$query =$this->db->get('refer');
    	if($query->num_rows()>0){
    		return $query->row();
    	}else{
    		return false;
    	}
    }

    public function updateReference($data,$email){
    	$this->db->where('email',$email);
    	$this->db->update('refer',$data);
		return true;
    }

    public function addComment($comment_data){
    	$this->db->insert('wgp_customform_comments',$comment_data);
		  return true;
    }
    public function updateComment($user_id,$data_com,$wgp_table_id){
    	$this->db->where('wgp_table_id', $wgp_table_id);
    	$this->db->where('wgp_user_id', $user_id);		 
		$this->db->update('wgp_customform_comments',$data_com);
		return true;
    }

    public function deleteAskedRow($user_id,$table_id){
    	$this->db->where('id', $table_id);
    	$this->db->where('refere_for_user_id', $user_id);
    	$this->db->delete('refer');
    	return true;

    }

    public function showAskRefer($user_id,$table_id){
    	$data = array('status' => 3);
    	$this->db->where('id', $table_id);
    	$this->db->where('refere_for_user_id', $user_id);		 
		$this->db->update('refer',$data);
		return true;

    }

    public function hideAskRefer($user_id,$table_id){
    	$data = array('status' => 2);
    	$this->db->where('id', $table_id);
    	$this->db->where('refere_for_user_id', $user_id);		 
		$this->db->update('refer',$data);
		return true;
    }



    public function insertHonor($honor_data){
    	$this->db->insert('wgp_customform_honors',$honor_data);
		  return true;
    }

    public function deletehonorRow($user_id,$wgp_table_id){
    	$this->db->where('wgp_table_id', $wgp_table_id);
    	$this->db->where('wgp_user_id', $user_id);	
    	$this->db->delete('wgp_customform_honors');
    	return true;
    }

    public function updateHonorRow($user_id,$honor_data,$wgp_table_id){
    	$this->db->where('wgp_table_id', $wgp_table_id);
    	$this->db->where('wgp_user_id', $user_id);		 
		$this->db->update('wgp_customform_honors',$honor_data);
		return true;
    }

   public function addExperiance($exp_data){
   	$this->db->insert('wgp_customform_leadership',$exp_data);
		  return true;
   }

   public function updateLeadership($user_id,$data,$wgp_table_id){  		
   		
   	    $this->db->where('wgp_table_id', $wgp_table_id);
    	$this->db->where('wgp_user_id', $user_id);		 
		$this->db->update('wgp_customform_leadership',$data);
		return true;
   }

   public function updateNewPassword($user_id,$password){
   	    $data = array('password' => $password );
   		$this->db->where('user_id', $user_id);
		$this->db->update('users',$data);
		return true;
   }


   public function updateAllPersonal($user_data,$row,$contact_data,$seek_data){
   		$this->db->trans_begin();
		$this->db->insert('wgp_player_data',$user_data);
		$this->db->insert('wgp_player_personal',$row);
		$this->db->insert('wgp_player_contacts',$contact_data);
		$this->db->insert('wgp_player_seekings',$seek_data);

		if ($this->db->trans_status() === FALSE){
		        $this->db->trans_rollback();
		        return false;
		}else{
		        $this->db->trans_commit();
		        return true;
		}
   }
	  
}