<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Incomplete_profile extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
	    $this->load->library(array('form_validation','session'));
		//$this->load->library('encrypt');
		$this->load->model('user_model');
		$this->load->model('fetch_model');
		$this->load->model('account_model');

		 function isEmail($email)
				{
				//If the username input string is an e-mail, return true
				if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
					return true;
				} else {
					return false;
				}
	        }//function end
		
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

		  	$this->account_model->insertPrivacyDefault($user_id);

		  	$user_data = $this->profile_data();	 
		
	  		/*$this->load->view("header-incomplete",$user_data);	  		
	  		$this->load->view("dashboard/cover_view");	
	  		$this->load->view("dashboard/incomplete_profile_view");	
			$this->load->view("footer_out_view"); */ 
			$this->load->view("theme2/incomplete_profile",$user_data);	
				
	  }//Index function End

	 public function profile_data()
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

		 $user_name = $this->fetch_model->getUseName($user_id);

		$nation_list = $this->fetch_model->nation();	
		
		$sport_list = $this->fetch_model->sport();
		$hand_list = $this->fetch_model->hand();
		$foot_list = $this->fetch_model->foot();
		$height_list = $this->fetch_model->height();
		$weight_list = $this->fetch_model->weight();
		$seeking = $this->fetch_model->getSeeking();
		$contact_you= $this->fetch_model->getContactYou();
		$find_list = $this->fetch_model->find();		


		return	$data = array('title' => 'Edit Profile', 'name' => $name,
					   'profile_status'=>'incomplete',
			          'email' => $email,'user_id'=> $user_id,'nation'=>$nation_list,
			          'sport'=>$sport_list,'hand'=>$hand_list,'username'=>$user_name,
			          'foot'=>$foot_list,'height'=>$height_list,'weight'=>$weight_list,
			          'find'=>$find_list,'seeking'=>$seeking,'contact'=>$contact_you
			          );				   	
	  }


}