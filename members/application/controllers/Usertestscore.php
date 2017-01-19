<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usertestscore extends CI_Controller {

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
		  	$name=$session_data['name'];
		  	$email=$session_data['email'];
		  
		  	$testscore_details= $this->fetch_model->testscore_details($user_id);
		  	if($testscore_details==false)
				   {
				   		$test_type = $this->fetch_model->testType();
				   		$subject = $this->fetch_model->subject();			   		
				   		
				   		$data= array('user_id'=>$user_id,'test_type'=>$test_type,'subject'=>$subject);
				   		$this->load->view("testscore/test_score_edit",$data); 
				   }
			else{	
			
			$data = array('test_details' => $testscore_details);
	  		$this->load->view("testscore/test_score_view",$data); 		
		  	}

	  }//Index function End


	  public function insertTestScore()
	  {	  	
	  	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

	  	 $test_type =$this->input->post('test_type');
		 $subject   =$this->input->post('subject');
		 $testscore =$this->input->post('testscore');
		 $out_of =$this->input->post('out_of');
		 $test_date	 =$this->input->post('test_date');
		 $test_location =$this->input->post('test_location');
		 

		 $test_data=array(
                     'wgp_user_id'=>$user_id,'test_score'=>$testscore,
                     'out_of'=>$out_of,'test_subject'=>$subject,
                     'test_type'=>$test_type,'location_of_test'=>$test_location,
                     'date_of_test'=>$test_date                     
                     );

			 $success= $this->user_model->insertTestRecord($test_data);

			if($success){			       
				redirect('home');
			}		 	
	    }

	  public function addNewScore()
	  {
	  	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
		  	$name=$session_data['name'];
		  	$email=$session_data['email'];
		  
		  	$testscore_details= $this->fetch_model->testscore_details($user_id);
		  	
		  	$test_type = $this->fetch_model->testType();
			$subject = $this->fetch_model->subject();
				   		
			$data= array('user_id'=>$user_id,'test_type'=>$test_type,'subject'=>$subject);
			$this->load->view("testscore/test_score_edit",$data); 
		}


	public function editTestView()
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
		  	$name=$session_data['name'];
		  	$email=$session_data['email'];
		  
		  	$testrow_details= $this->fetch_model->testrow_details($wgp_row_id,$user_id);
		  	
		  	$test_type = $this->fetch_model->testType();
			$subject = $this->fetch_model->subject();
				   		
			$data= array('user_id'=>$user_id,'test_type'=>$test_type,
						 'subject'=>$subject,'test_row'=>$testrow_details);
			
			$this->load->view("testscore/edit_test_row",$data); 

	}

	public function updateTestRow(){	
   
		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$wgp_table_id =$this->input->post('wgp_table_id');	
			$test_location =$this->input->post('test_location');
			$test_date =$this->input->post('test_date');
			$out_of =$this->input->post('out_of');
			$testscore =$this->input->post('testscore');
			$subject =$this->input->post('subject');
			$test_type =$this->input->post('test_type');

			$update_data=array('test_score'=>$testscore,
                     'out_of'=>$out_of,'test_subject'=>$subject,
                     'test_type'=>$test_type,'location_of_test'=>$test_location,
                     'date_of_test'=>$test_date                     
                     );
			$success= $this->user_model->updateTestRow($user_id,$update_data,$wgp_table_id);
			if($success)
			{				
				$testscore_details= $this->fetch_model->testscore_details($user_id);
				$data = array('test_details' => $testscore_details);
				$this->load->view("testscore/test_score_view",$data); 
			}else{
				return false;
			}
	  		
		}

		public function deleteTestRow(){
			if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$wgp_table_id =$this->input->post('row_id');

			$delete_status= $this->user_model->deleteTestRow($user_id,$wgp_table_id);

			if($delete_status)
			{
			echo 1;
			}else{
			echo 0;
			}

		}

	 


}