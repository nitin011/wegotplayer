<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Folder_model extends CI_Model
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
		
		public function imageFolder_list($user_id)
	  	{ 
			$this->db->select("*");
			$this->db->from("image_folder"); 
			$this->db->order_by('time', 'DESC');
			$this->db->where("user_id",$user_id);
			
			$query=$this->db->get();
			
			if(!$query){
				return false;
				}else{
				if( $query->num_rows() > 0)
				{
					return $query->result();
					} else{
					return false;
				}
			}
		}//function end
		
		public function fetch_images_in_folder($folder_id)
		{
			$this->db->select("*");
			$this->db->from("wgp_user_images"); 
			$this->db->order_by('image_id', 'DESC');
			$this->db->where("gallery_id",$folder_id);
			$query=$this->db->get();
			
			if(!$query)
			{
				return false;
				}else{
				if( $query->num_rows() > 0)
				{
					return $query->result();
					} else{
					return "<p>no images found the folder</p>";
				}
			}
		}

	
		
		public function insert_image($data){
			$tableName  = "wgp_user_images";					
			$this->db->insert($tableName, $data); 
			return true;
		}
		
		public function delete_image($user_id, $image_id, $gallery_id)
		{
			$sql = "DELETE FROM wgp_user_images WHERE user_id=$user_id AND image_id=$image_id AND gallery_id=$gallery_id";
			
			$rs1 = $this->db->query($sql); 
			if ($rs1)
			{
				return true;
			}
			else
			{
				return false;
				
			}
			
		}
		
		
		public function set_default_image($user_id,$image_id)
		{
			$data=array('is_default'=>0);
			$this->db->where('user_id',$user_id);
			$this->db->update('wgp_user_images',$data);
			
			$data=array('is_default'=>1);
			$this->db->where('image_id',$image_id);
			$this->db->where('user_id',$user_id);
			$bd=$this->db->update('wgp_user_images',$data);			
			if($bd){			
			
			return true;
			}else{
			return flase;
			}
						
		}
		
		public function fetch_default_image($user_id,$image_id)
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
	
?>		