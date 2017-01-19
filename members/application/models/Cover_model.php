<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Cover_model extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
			
		}//function end	

		public function uploadCover($data)
		{	
		
			 $user_id= $data['wgp_user_id'];

			

			 $status=$this->updateStatus($user_id);
			

			$query = $this->db->insert('cover_image',$data);
			  if( $query ){
					return true;
				}
			  else{
					return false;
				}

		}
		public function updateStatus($user_id){
					
			$this->db->where('wgp_user_id',$user_id);
			$this->db->set('status',0);
			$query = $this->db->update('cover_image');
			return true;
		}



}

?>