<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Video_controller extends CI_Controller {
		
		public function __construct()
		{
			parent::__construct();	
			$this->load->helper('url');
			$this->load->helper('security');
			$this->load->library(array('form_validation','session'));
			//$this->load->library('encrypt');
			$this->load->library('upload');			
			$this->load->model('video_model');
		}


public function index()
		{
			if (!$this->session->userdata('logged_in'))
			{
				//If no session, redirect to login page
				redirect('user', 'refresh');
				exit();
			}
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];	
			$acc_type=$session_data['acc_type'];

			$video_count =$this->video_model->videoCount($user_id);		
			
			$all_video = $this->video_model->getUserVideos($user_id);
			
			$data = array(
							'video_list'=>$all_video,
							'user_id'=>$user_id,
			            	'acc_type'=>$acc_type,
			            	'video_count'=>$video_count
			            );
			$this->load->view("video_new/videos_view",$data); 
			
		}//Index function End

		public function addVideoView(){
			if (!$this->session->userdata('logged_in'))
			{
				//If no session, redirect to login page
				redirect('user', 'refresh');
				exit();
			}
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$user_data= array(   
					'title'=>'WeGotPlayer',							
					'user_id'=>$user_id
				);

			$this->load->view("video_new/add_video_view",$user_data); 	
		}


		public function updateVideoName(){
			if (!$this->session->userdata('logged_in'))
			{
				//If no session, redirect to login page
				redirect('user', 'refresh');
				exit();
			}
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$video_id= $this->input->post('video_id');			
			$video_title= $this->input->post('title');


			$data = array('user_id' => $user_id, 
						  'video_id' =>$video_id,
						  'title'=>$video_title,
				      );

			$result = $this->video_model->updateVideoName($data);

			print_r($result);
		}

}//end of class Video_controller
?>