<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Second_controller extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
	    $this->load->library(array('form_validation','session'));
		$this->load->model('theme2_model');
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
			$user_id= $session_data['user_id'];
			$dp_url = $session_data['dp_url'];

		

		     $detail = $this->theme2_model->getPersonalDetails($user_id);


		     $school= $this->fetch_model->school_details($user_id);


		 

		     $data = array('detail'=>$detail,'dp_url'=>$dp_url,'school'=>$school);

	  	     $this->load->view('theme2/header');
	  		 $this->load->view('theme2/content',$data);
	  }
}?>