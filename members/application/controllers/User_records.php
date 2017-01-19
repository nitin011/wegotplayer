<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_records extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
	    $this->load->library(array('form_validation','session'));	
		$this->load->model('record_model');
		
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

			$record_data = $this->record_model->getRecord($user_id);
			if(!$record_data){

				$this->load->view('record/add_record');
			}else{			

				$data = array('data' =>$record_data);
				$this->load->view('record/record_view',$data);
			}


	  }

	  public function addRecord(){
	  	  if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

					
			$mile_run =$this->input->post('mile_run');
			$thirty_sprint =$this->input->post('thirty_sprint');
			$hundred_sprint =$this->input->post('hundred_sprint');
			$max_bench =$this->input->post('max_bench');
			$vertical_jump =$this->input->post('vertical_jump');
			$horizontal_jump =$this->input->post('horizontal_jump');
		
			$data = array('user_id' => $user_id,'one_mile'=>$mile_run,
						  'run_30'=>$thirty_sprint,'run_100'=>$hundred_sprint,
						  'max_bench'=>$max_bench,'vertical_jump'=>$vertical_jump,
						  'horizontal_jump'=>$horizontal_jump);

			$success= $this->record_model->addRecord($data);
			if($success){
				echo "success";
			}else{
				echo "Problem in Record Update!";
			}
	  }

	  public function updateView(){
	  	   if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$record_data = $this->record_model->getRecord($user_id);
			if($record_data){
				$data = array('data' =>$record_data);		   
				$this->load->view('record/update_view',$data);
			 }else{
			 	echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data not avilable !</h3>";
			 }
	  }

	  public function updateRecord(){
	  		 if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$mile_run =$this->input->post('mile_run');
			$thirty_sprint =$this->input->post('thirty_sprint');
			$hundred_sprint =$this->input->post('hundred_sprint');
			$max_bench =$this->input->post('max_bench');
			$vertical_jump =$this->input->post('vertical_jump');
			$horizontal_jump =$this->input->post('horizontal_jump');
		
			$data = array('one_mile'=>$mile_run,
						  'run_30'=>$thirty_sprint,'run_100'=>$hundred_sprint,
						  'max_bench'=>$max_bench,'vertical_jump'=>$vertical_jump,
						  'horizontal_jump'=>$horizontal_jump);

			$success= $this->record_model->updateRecord($data,$user_id);
			if($success){
				$this->index();
			}else{
				echo 'Error Occur in Update try Again.';
			}
	  }


}?>