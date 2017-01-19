<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usertranscripts extends CI_Controller {

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
		    $row = array('wgp_table_id','degree_level(degree_level) degree_level',
		    			'academic_grade(academic_grade) academic_grade', 
		    	         'school_year(school_year) school_year', 
		    	         'course_level(course_level) course_level', 
		    	         'course_name(course_name) course_name');

		  	$transcripts_details= $this->fetch_model->transcripts_details($user_id,$row);
		  	if($transcripts_details==false)
		  	   {	   				   		
				   	$degree = $this->fetch_model->degreeLevel();
				   	$course_name = $this->fetch_model->courseName();
				   	$course_level = $this->fetch_model->courseLevel();
				   	$school_year = $this->fetch_model->schoolYear();
				   	$academic = $this->fetch_model->academicYear();
				   	
				   	$data= array('user_id'=>$user_id,'degree'=>$degree,
				   				 'course_name'=>$course_name,
				   				 'course_level'=>$course_level,
				   				 'school_year'=>$school_year,'academic'=>$academic
				   				 );
				   	$this->load->view("transcripts/transcripts_edit",$data); 
				   }
			else{	
			
			$data = array('transcripts_details' => $transcripts_details);
						
	  		$this->load->view("transcripts/transcripts_view",$data); 		
		  	}

	  }//Index function End 

	  public function insertTranscript()
	  {
	  	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');

			$user_id=$session_data['user_id'];

		 	$degree_level =$this->input->post('degree_level');
		 	$course_name =$this->input->post('course_name');
		 	$course_level =$this->input->post('course_level');
		 	$school_year =$this->input->post('school_year');
		 	$academic_grade =$this->input->post('academic_grade');

		 	$data = array('wgp_user_id'=>$user_id,'degree_level'=>$degree_level,
		 					'course_name'=>$course_name,'course_level'=>$course_level,
		 					'school_year'=>$school_year ,'academic_grade' =>$academic_grade);
	  		
	  		 $success= $this->user_model->insertTranscript($data);

	  		 if($success)
	  		 {
	  		 	 redirect('home');
	  		 }	  		
	    }

	   public function addNew()
	  {
	  	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
		  	
		  	$row = array('wgp_table_id','degree_level(degree_level) degree_level',
		    			'academic_grade(academic_grade) academic_grade', 
		    	         'school_year(school_year) school_year', 
		    	         'course_level(course_level) course_level', 
		    	         'course_name(course_name) course_name');

		  	$transcripts_details= $this->fetch_model->transcripts_details($user_id,$row);
		  			$degree = $this->fetch_model->degreeLevel();
				   	$course_name = $this->fetch_model->courseName();
				   	$course_level = $this->fetch_model->courseLevel();
				   	$school_year = $this->fetch_model->schoolYear();
				   	$academic = $this->fetch_model->academicYear();
				   	
				   	$data= array('user_id'=>$user_id,'degree'=>$degree,
				   				 'course_name'=>$course_name,
				   				 'course_level'=>$course_level,
				   				 'school_year'=>$school_year,'academic'=>$academic
				   				 );
				   	$this->load->view("transcripts/transcripts_edit",$data); 
		  	
		  	
		}

		public function editTransRow(){
			 $wgp_row_id =$this->input->post('edit');		

			if (!$this->session->userdata('logged_in'))
				  {
					  //If no session, redirect to login page
					   redirect('user', 'refresh');
					   exit();
				  }
				$session_data = $this->session->userdata('logged_in');
				$user_id=$session_data['user_id'];

				$trans_row= $this->fetch_model->trasnscriptsRow($wgp_row_id,$user_id);

				    $degree = $this->fetch_model->degreeLevel();
				   	$course_name = $this->fetch_model->courseName();
				   	$course_level = $this->fetch_model->courseLevel();
				   	$school_year = $this->fetch_model->schoolYear();
				   	$academic = $this->fetch_model->academicYear();
				   	
				   	$data= array('user_id'=>$user_id,'degree'=>$degree,
				   				 'course_name'=>$course_name,
				   				 'course_level'=>$course_level,
				   				 'school_year'=>$school_year,
				   				 'academic'=>$academic,'trans_row'=>$trans_row
				   				 );		

			    $this->load->view("transcripts/edit_transcripts_row",$data); 
		}

		public function updateTransRow()
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
			$degree_level =$this->input->post('degree_level');
		 	$course_name =$this->input->post('course_name');
		 	$course_level =$this->input->post('course_level');
		 	$school_year =$this->input->post('school_year');
		 	$academic_grade =$this->input->post('academic_grade');

		 	$data = array('wgp_user_id'=>$user_id,'degree_level'=>$degree_level,
		 					'course_name'=>$course_name,'course_level'=>$course_level,
		 					'school_year'=>$school_year ,'academic_grade' =>$academic_grade);

		 	$success= $this->user_model->updateTransRow($user_id,$data,$wgp_table_id);
			if($success)
			{	$row = array('wgp_table_id','degree_level(degree_level) degree_level',
				         'academic_grade(academic_grade) academic_grade',
				         'school_year(school_year) school_year', 
				         'course_level(course_level) course_level', 
				         'course_name(course_name) course_name');			
				$transcripts_details= $this->fetch_model->transcripts_details($user_id,$row);
				$data = array('transcripts_details' => $transcripts_details);						
	  		    $this->load->view("transcripts/transcripts_view",$data); 
			}else{
				return false;
			}
		}

		public function deleteTransRow()
		{
			if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$wgp_table_id =$this->input->post('row_id');

			$delete_status= $this->user_model->deleteTransRow($user_id,$wgp_table_id);

			if($delete_status)
			{
				echo 1;
			}else{
				echo 0;
			}

		}


}