<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pricing extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper(array('url','security'));
		$this->load->library(array('form_validation','session'));	
		$this->load->model(array('user_model','fetch_model','payment_model'));

		 function isEmail($email)
				{
				//If the username input string is an e-mail, return true
				if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
					return true;
				} else {
					return false;
				}
	        }//function end
		
	 }//end of constructor
	    
    public function index(){ 
  		$this->load->view("header");
		$this->load->view("payment/pricing_view");
		$this->load->view('footer_out_view');			
		$this->load->view("footer");
    }//end of index function


 }//end of Pricing controller class
 ?>




