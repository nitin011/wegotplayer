<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userleadership extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
	    $this->load->library(array('form_validation','session'));
		//$this->load->library('encrypt');
		$this->load->model('fetch_model');
		$this->load->model('user_model');
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
			
			//Get User Comment 
			$exp = $this->fetch_model->getExperiance($user_id);			
			if($exp==false)
				{
			     	$this->load->view("leadership/add_leadership_view");	
				}else{				
				 		$data  = array('experiance' =>$exp);				 						 		
				 		$this->load->view("leadership/leadership_view",$data);
			         }
		 }  //End Index Function 

		public function addExp()
		{
			if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			 $experience =$this->input->post('experience');
  	        $exp_data = array('wgp_user_id'=>$user_id,
  	        					  'Experience' => $experience);
  	       
  	        $success= $this->user_model->addExperiance($exp_data);

  	        if($success){
  	        	return true;
  	        }else{
  	        	return false;
  	        }
		}

	public function editRow()
	{
		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$wgp_table_id =$this->input->post('edit');
			$exp = $this->fetch_model->getLeadershipRow($user_id,$wgp_table_id);
			$data  = array('experiance' =>$exp);	
					 						 		
			$this->load->view("leadership/edit_leadership_row",$data);

	}

	public function updateRow()
	{
		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$wgp_table_id =$this->input->post('wgp_table_id');
			$comment =$this->input->post('comment');

			$data = array('Experience' => $comment);


			$success= $this->user_model->updateLeadership($user_id,$data,$wgp_table_id);
			if($success)
			{				
				 $exp = $this->fetch_model->getExperiance($user_id);	
				 $data  = array('experiance' =>$exp);	
				 			 						 		
				 $this->load->view("leadership/leadership_view",$data);
			}else{
				return false;
			}

	}

  
}