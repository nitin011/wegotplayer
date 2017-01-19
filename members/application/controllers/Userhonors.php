<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userhonors extends CI_Controller {

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

	public function index(){
		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			//Get honor
			$row = array('wgp_table_id', 'wgp_user_id', 
				  'honor_type(type) type', 'level_name(level) level', 
				  'date_Received', 
				  'award_description(description) description',
				 'awards_honors_name','school_organization_name');
			$honors = $this->fetch_model->getHonors($user_id,$row);
			$honors_type = $this->fetch_model->getHonorsType();
			$award_description = $this->fetch_model->getAwardDescription();

			// Get sport id 
			$user_sport_data = $this->fetch_model->getSportId($user_id);
			if($user_sport_data){
            		$user_sport_id =$user_sport_data->sport;           
					// Get level  of sport
					$level_data = $this->fetch_model->getLevel($user_sport_id);	

		     }

			if($honors==false){	
				
				 $data = array('type' => $honors_type,'level'=>$level_data,
				 			   'description'=>$award_description);				 
			     $this->load->view("honors/add_honors_view",$data);	
			}else{				
				 $data  = array('honors' =>$honors);
				 				 
				 $this->load->view("honors/honors_view",$data);
			}
		}//End Index Function 

		public function insertHonors()
		{			
			if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$award_name = $this->input->post('award_name');
			$honor_type = $this->input->post('honor_type');
			$description = $this->input->post('description');
			$school_name = $this->input->post('school_name');
			$level = $this->input->post('level');
			$date = $this->input->post('date');

			$honor_data = array('awards_honors_name' => $award_name,
								'wgp_user_id'=>$user_id,
								'school_organization_name'=>$school_name,
								'type'=>$honor_type,'level'=>$level,
								'date_Received'=>$date,'description'=>$description);
			
			$success= $this->user_model->insertHonor($honor_data);	
				if($success){
					redirect('home');
				}else{
					echo "false";
				}			 
			
		  }

		  public function addHonors()
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
			$row = array('wgp_table_id', 'wgp_user_id', 
				  'honor_type(type) type', 'level_name(level) level',
				   'date_Received', 
				  'award_description(description) description',
				 'awards_honors_name','school_organization_name');
			$honors = $this->fetch_model->getHonors($user_id,$row);
			$honors_type = $this->fetch_model->getHonorsType();
			$award_description = $this->fetch_model->getAwardDescription();

			// Get sport id 
			$user_sport_data = $this->fetch_model->getSportId($user_id);
            $user_sport_id =$user_sport_data->sport;
			// Get level  of sport
			$level_data = $this->fetch_model->getLevel($user_sport_id);

		  	$data = array('type' => $honors_type,'level'=>$level_data,
				 			   'description'=>$award_description);				 

			 $this->load->view("honors/add_honors_view",$data);	

		  }
		  public function editHonorRow()
		  {
			 $wgp_row_id =$this->input->post('edit');		

			if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			//Get User Comment 
			$row = array('wgp_table_id', 'wgp_user_id', 
				  'honor_type(type) type', 'level_name(level) level', 
				  'date_Received', 
				  'award_description(description) description',
				 'awards_honors_name','school_organization_name');
			$honors = $this->fetch_model->getHonors($user_id,$row);
			$honors_type = $this->fetch_model->getHonorsType();
			$award_description = $this->fetch_model->getAwardDescription();

			// Get sport id 
			$user_sport_data = $this->fetch_model->getSportId($user_id);
            $user_sport_id =$user_sport_data->sport;
			// Get level  of sport
			$level_data = $this->fetch_model->getLevel($user_sport_id);

			$honor_row = $this->fetch_model->getHonorRow($user_id,$wgp_row_id);

		  	$data = array('type' => $honors_type,'level'=>$level_data,
				 		  'description'=>$award_description,
				 		  'honor_row'=>$honor_row);

		  	//print_r($honor_row);		    
			$this->load->view("honors/edit_honor_row",$data); 
		}

		public function updateHonorRow()
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
			$award_name =$this->input->post('award_name');
			$honor_type =$this->input->post('honor_type');
			$description =$this->input->post('description');
			$school_name =$this->input->post('school_name');
			$level =$this->input->post('level');
			$date =$this->input->post('date');

			$honor_data = array('awards_honors_name' => $award_name,						  
						  'school_organization_name'=>$school_name,
						  'type'=>$honor_type,'level'=>$level,
						  'date_Received'=>$date,'description'=>$description);
			$success= $this->user_model->updateHonorRow($user_id,$honor_data,$wgp_table_id);
			if($success)
			{				
				 $honors = $this->fetch_model->getHonors($user_id,'');
				 $data  = array('honors' =>$honors);				 							 
				 $this->load->view("honors/honors_view",$data);
			}else{
				return false;
			}
    	}

		  public function deleteHonorRow(){
		  	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$wgp_table_id =$this->input->post('row_id');

			$delete_status= $this->user_model->deletehonorRow($user_id,$wgp_table_id);

			if($delete_status)
			{
				echo 1;
			}else{
				echo 0;
			}
		  }
}