<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_language extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
	    $this->load->library(array('form_validation','session'));	
		$this->load->model('record_model');
		
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
			$row = array('id','lang_level_name(level) level_name','level','language');
			$language_data = $this->record_model->getLanguage($user_id,$row);

			
			$language_level = $this->record_model->getLanguageLevel();	

				$data1 = array(
							  'language_level'=>$language_level ,
							  'user_language'=>$language_data
							  );
				
				$this->load->view('language/add_language',$data1);
		
	  }

	  public function addLanguage(){
	  	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$language =$this->input->post('language');
			$level =$this->input->post('level');

			$row = array( 'user_id' => $user_id,
				          'language'=>$language,
				          'level'=>$level 
				         );

			$success=$this->record_model->addLanguage($row);
			if($success){
				$this->index();
			}
			

	  }
	   public function deleteLanguage(){
	  		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$id =$this->input->post('id');

			$row = array( 'user_id' => $user_id,'id'=>$id);

			$success=$this->record_model->deleteLanguage($row);
			if($success){
				echo 1;
			}else{
				echo 0;
			}
	  }

	  public function saveLanguage(){
	  	 if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$id =$this->input->post('id');
			$language =$this->input->post('language');

			$row = array( 'user_id' => $user_id,'id'=>$id);

			$data = array('language' => $language);

			$success=$this->record_model->saveLanguage($row,$data);
			if($success){
				return true;
			}else{
				return false;
			}
	  }
	  public function updateStar(){
	  	     if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

	  	    $level =$this->input->post('level');
			$id =$this->input->post('id');

			$row = array( 'user_id' => $user_id,'id'=>$id);	

			$data  = array('level' =>$level);		

			$success=$this->record_model->updateStar($row,$data);
			if($success){
				$this->index();
			}else{
				return false;
			}

	  }


}?>