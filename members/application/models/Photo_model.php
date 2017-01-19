<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');	
	class Photo_model extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
			
		}//function end	  
		
		public function insertFolderDetails($data)
		{
			$this->db->set('time','NOW()', FALSE);
			$query = $this->db->insert('image_folder',$data);
			if($query)
			{
				$insert_id = $this->db->insert_id();
				
                return  $insert_id;
			}
			else
			{
				return false;
			}
		}
		
		public function getAlbum($user_id)
	  	{ 			
			$this->db->order_by('time', 'DESC');
			$this->db->where("user_id",$user_id);			
			$query=$this->db->get('image_folder');
			
			if(!$query){
				return false;
				}else{
				if( $query->num_rows() > 0)
				{
					$result = $query->result();
					$folder_detail = array();
					foreach ($result as $row) {						
						$folder_id = $row->folder_id;
						$folder_path = $row->folder_path; 
						$folder_image_count = $this->getFolderImageCount($user_id,$folder_id);

						 $result = array('folder_id' => $folder_id,
					    				'folder_path' => $folder_path,
					    				'folder_image_count'=>$folder_image_count);
						array_push($folder_detail, $result);	
					}
					
					return $folder_detail;
					} else{
					return false;
				}
			}
		}//function end

		public function getFolderImageCount($user_id,$folder_id){

			$this->db->where("gallery_id",$folder_id);
			$this->db->where("user_id",$user_id);
			$query=$this->db->get('wgp_user_images');
			if($query){
			 	return $query->num_rows();
			 }else{
			 	return false;
			 }
		}

		public function checkProfilePic($user_id){
			$this->db->where("user_id",$user_id);
			$this->db->where('is_default',1);
			$query=$this->db->get('wgp_user_images');
			if($query->num_rows() > 0){
				return true;
			}else{
				return false;
			}
		}
		
		public function getAllImage($user_id){
			$this->db->where('user_id', $user_id);
			$this->db->order_by('image_id', 'DESC');
			$query =$this->db->get('wgp_user_images');
			if( $query->num_rows() > 0){					
				return $query->result();
			} else{
				return false;
			}					
		}
		public function getImage($folder_id){			
			
			$this->db->order_by('image_id', 'DESC');
			$this->db->where("gallery_id",$folder_id);
			$query=$this->db->get('wgp_user_images');
			
			if(!$query)
			{
				return false;
				}else{
				if( $query->num_rows() > 0)
				{
					return $query->result();
					} else{
					return "<p>No Images found in this Album</p>";
				}
			}
		}	
		
		public function insertImage($data)
		{	
		    $this->db->set('date_added','NOW()', FALSE);					
			$query = $this->db->insert('wgp_user_images', $data); 
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function uploadProfileImage($data)
		{	
			$this->db->set('is_default',1);
		    $this->db->set('date_added','NOW()', FALSE);					
			$query = $this->db->insert('wgp_user_images', $data); 
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function uploadProfilePic($data)
		{

			$user_id = $data['user_id'];
			$photo_status = $this->checkProfileImage($user_id);

			if($photo_status){
				$update_status = $this->setDataZero($user_id);

			
					$result = $this->uploadProfileImage($data);				

					if($result){
						$session_data = $this->session->userdata('logged_in');
									$user_id=$session_data['user_id'];
									$unique_code=$session_data['unique_code'];
									$name=$session_data['name'];
									$email=$session_data['email'];
									$cover_url=$session_data['cover_url'];
									$password=$session_data['password'];
									$usertype=$session_data['usertype'];
									$acc_type=$session_data['acc_type'];

									$dp_url=$data['image_file'];									
									
								     $userdata = array(    
						                'user_id'  => $user_id,
						                'unique_code'=>$unique_code,    
						                'name'     => $name,                
						                'email'    => $email,
						                'password' => $password,
						                'usertype' => $usertype,
						                'dp_url'   => $dp_url,
						                'cover_url' =>$cover_url,
						                'acc_type' =>$acc_type          
						                );					             
						              
						            $this->session->set_userdata('logged_in',$userdata);
						            return true;
					}else{
						return false;
					}				
				
			}else{
				$result = $this->uploadProfileImage($data);
				
				if($result){
						$session_data = $this->session->userdata('logged_in');
									$user_id=$session_data['user_id'];
									$unique_code=$session_data['unique_code'];
									$name=$session_data['name'];
									$email=$session_data['email'];
									$cover_url=$session_data['cover_url'];
									$password=$session_data['password'];
									$usertype=$session_data['usertype'];
									$acc_type=$session_data['acc_type'];

									$dp_url=$data['image_file'];									
									
								     $userdata = array(    
						                'user_id'  => $user_id,
						                'unique_code'=>$unique_code,    
						                'name'     => $name,                
						                'email'    => $email,
						                'password' => $password,
						                'usertype' => $usertype,
						                'dp_url'   => $dp_url,
						                'cover_url' =>$cover_url,
						                'acc_type' =>$acc_type          
						                );					             
						              
						            $this->session->set_userdata('logged_in',$userdata);
						            return true;
					}else{
						return false;
					}									
			}
			  					    
		}

		public  function setDataZero($user_id)
		{
			$zero=array('is_default'=>0);
			$this->db->where('user_id',$user_id);
			$this->db->update('wgp_user_images',$zero);
			$affected_row=$this->db->affected_rows();	
	        if($affected_row>0){
	        	return true;
	        }else{
	        	return false;
	        }
		}

		public function checkProfileImage($user_id)
		{			
			$this->db->where("user_id",$user_id);							
			$query=$this->db->get('wgp_user_images');
			if($query->num_rows() > 0){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteImage($user_id, $image_id)
		{
			$sql = "DELETE FROM wgp_user_images WHERE user_id=$user_id AND image_id=$image_id";
			$rs1 = $this->db->query($sql); 
			if ($rs1){
				return true;
			}
			else{
				return false;				
			}
			
		}
		
		
		public function setDefaultImage($user_id,$image_id)
		{
			$data=array('is_default'=>0);
			$this->db->where('user_id',$user_id);
			$this->db->update('wgp_user_images',$data);
			
			$data=array('is_default'=>1);
			$this->db->where('image_id',$image_id);
			$this->db->where('user_id',$user_id);
			$query=$this->db->update('wgp_user_images',$data);			
			if($query){		
				return true;
			}else{
				return flase;
			}
						
		}
		
		public function getDefaultImage($user_id,$image_id)
		{
			$this->db->select("*");
			$this->db->from("wgp_user_images"); 
			$this->db->where("user_id",$user_id);
			$this->db->where("image_id",$image_id);
			$query=$this->db->get();
			
			if(!$query)
			{
				return false;
			}else{
				if( $query->num_rows() > 0)
				{
					return $query->row();
					} else{
						return false;
				}
			}
	    }		
}	