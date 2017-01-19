<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Video_model extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
			
		}//function end	  
		
		public function videosFolder_list($user_id)
	  	{ 
			$this->db->select("*");
			$this->db->from("video_folder"); 
			$this->db->order_by('time', 'DESC');
			$this->db->where("user_id",$user_id);
			
			$query=$this->db->get();
			
			if(!$query){
				return false;
				}else{
				if( $query->num_rows() > 0)
				{
					$result=$query->result();
					
					$folder_detail =array();
					foreach ($result as $row) {
						$folder_id = $row->folder_id;
						$folder_path = $row->folder_path;
						$video_in_folder= $this->getFolderVideoCount($user_id,$folder_id);
					    $result = array('folder_id' => $folder_id,
					    				'folder_path' => $folder_path,
					    				'folder_video_count'=>$video_in_folder);
						array_push($folder_detail, $result);						

					}
						return $folder_detail;
					} else{
						return false;
				}
			}
		}//function end

		public function getFolderVideoCount($user_id,$folder_id)
		{
			$this->db->where('wgp_user_id',$user_id);
			$this->db->where('wgp_video_gallery_id',$folder_id);
			$query = $this->db->get('wgp_user_videos');
			if($query){
			 	return $query->num_rows();
			 }else{
			 	return false;
			 }
		}
		
		public function insertFolderDetails($data)
		{
			$this->db->set('time', 'NOW()', false);
			$query = $this->db->insert('video_folder',$data);
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
		
	public function getFolderVideo($folder_id)
		{
			
			$this->db->order_by('wgp_video_id', 'DESC');
			$this->db->where("wgp_video_gallery_id",$folder_id);
			$query=$this->db->get('wgp_user_videos');
			
			if(!$query)
			{
				return false;
				}else{
				if( $query->num_rows() > 0)
				{
					return $query->result();
					} else{
					return "<p>No Video found in the folder.</p>";
				}
			}
		}
		
		
		public function insertVideoData($data){	
	
			$this->db->set('wgp_video_added','NOW()',false);
			$this->db->insert('wgp_user_videos', $data);
		    return true;
		}

		public function deleteVideo($data){
			 $this->db->where($data);
			 $query = $this->db->delete('wgp_user_videos');

			 if($query){
			 	return true;
			 }else{
			 	return false;
			 }
		}

		public function videoDetail($data){
			$this->db->where($data);
			$query = $this->db->get('wgp_user_videos');
			if($query){
			 	return $query->row();
			 }else{
			 	return false;
			 }
		}

		public function insertVideoUrl($data)
		{	$this->db->set('wgp_video_added','NOW()',false);
			$query=$this->db->insert('wgp_user_videos', $data);
		    if($query){
			 	return true;
			 }else{
			 	return false;
			 }

		}

	public function videoCount($user_id){
		   $this->db->where('wgp_user_id',$user_id);
			$query = $this->db->get('wgp_user_videos');
			if($query){
			 	return $query->num_rows();
			 }else{
			 	return false;
			 }
	}



	public function getUserVideos($user_id){
		$this->db->where('wgp_user_id',$user_id);
		$query = $this->db->get('wgp_user_videos');
		if($query->num_rows()>0){
		 	return $query->result();
		 }else{
		 	return false;
		 }
	}


	public function updateVideoName($data){

		
		 $user_id = $data['user_id'];
		 $video_id = $data['video_id'];		
		 $video_data = ['wgp_video_title'=>$data['title']];
		 $this->db->where('wgp_video_id',$video_id);
		 $this->db->where('wgp_user_id',$user_id);
		 $this->db->update('wgp_user_videos',$video_data);
		 $afftectedRows = $this->db->affected_rows();

			if($afftectedRows>0){
				return true;
			}else{
				return false;
			}
	}
	
}	