<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Useratheletics extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
	    $this->load->library(array('form_validation','session'));
		//$this->load->library('encrypt');
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
		  
			$user_data= array('title'=>'WeGotPlayer',
							  'email'=>$email,'user_id'=>$user_id,'name'=>$name);
	  		$this->load->view("dashboard/atheletics_view"); 		
		  

	  }//Index function End


}