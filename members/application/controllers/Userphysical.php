<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userphysical extends CI_Controller {

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

		  	$physical= $this->fetch_model->physical_details($user_id);
		  	if($physical==false)
				   {
				   	$data = array(1,2,3,4,5,6,7,8,9,10);
				   	$user_details =  array('data' => $data,'user_id'=>$user_id);
                    $this->load->view("physical/edit_physical_view",$user_details);	  	
				   }
			else{
				
	  		    $this->load->view("physical/physical_view",$physical); 
		  }
	  }//Index function End 

	  public function insertPhysical()
	  {		    	   	   
	   	   $user_id=$this->input->post('user_id');
	   	   $acceleration=$this->input->post('acceleration');
	   	   $agility=$this->input->post('agility');
	   	   $balance=$this->input->post('balance');
	   	   $coordination=$this->input->post('coordination');
	   	   $reaction=$this->input->post('reaction');
	   	   $speed=$this->input->post('speed');
	   	   $jumping=$this->input->post('jumping');
	   	   $strength=$this->input->post('strength');
	   	   $flexibility=$this->input->post('flexibility');
	   	   $endurance=$this->input->post('endurance');
	   	   $quickness=$this->input->post('quickness');   
    	   $power=$this->input->post('power'); 
    	   $basic_motor_skills=$this->input->post('basic_motor_skills'); 
    	   $mobility=$this->input->post('mobility'); 
		   $explosivness=$this->input->post('explosivness'); 
    
 		$physical_data = array('acceleration' => $acceleration,'agility' => $agility,
	 					'balance' => $balance,'coordination' => $coordination,
	 					'reaction' => $reaction,'speed' => $speed,
	 					'jumping' => $jumping,'strength' => $strength,
	 					'flexibility' => $flexibility,'endurance' => $endurance,
	 					'quickness' => $quickness,'power' => $power,
	 					'basic_motor_skills'=> $basic_motor_skills,'mobility' => $mobility,
	 					'explosivness' => $explosivness,
	 					'wgp_user_id' =>$user_id);		
 		 
 		 $success= $this->user_model->insertPhysical($physical_data);

		if($success){			       
				redirect('home');	
			}	   	   
	  }

	  public function updatePhysical()
	  { 	  	
	  	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
		   $session_data = $this->session->userdata('logged_in');
		   $user_id=$session_data['user_id'];

	   	   $acceleration=$this->input->post('acceleration');
	   	   $agility=$this->input->post('agility');
	   	   $balance=$this->input->post('balance');
	   	   $coordination=$this->input->post('coordination');
	   	   $reaction=$this->input->post('reaction');
	   	   $speed=$this->input->post('speed');
	   	   $jumping=$this->input->post('jumping');
	   	   $strength=$this->input->post('strength');
	   	   $flexibility=$this->input->post('flexibility');
	   	   $endurance=$this->input->post('endurance');
	   	   $quickness=$this->input->post('quickness');   
    	   $power=$this->input->post('power'); 
    	   $basic_motor_skills=$this->input->post('basic_motor_skills'); 
    	   $mobility=$this->input->post('mobility'); 
		   $explosivness=$this->input->post('explosivness'); 
    
 		$physical_data = array('acceleration' => $acceleration,'agility' => $agility,
	 					'balance' => $balance,'coordination' => $coordination,
	 					'reaction' => $reaction,'speed' => $speed,
	 					'jumping' => $jumping,'strength' => $strength,
	 					'flexibility' => $flexibility,'endurance' => $endurance,
	 					'quickness' => $quickness,'power' => $power,
	 					'basic_motor_skills'=> $basic_motor_skills,'mobility' => $mobility,
	 					'explosivness' => $explosivness);


	    $success= $this->user_model->updatePhysical($physical_data,$user_id);
	    if($success){
	    		redirect('home');	       
			}
	  	 
	    
	  }

	  public function updateView()
	  {
	  		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
	  	 //$user_id=$this->input->post('user_id');
	  	 $physical= $this->fetch_model->physical_details($user_id);
	  	 if($physical==true)
	  	 {
	  	 	$data = array(1,2,3,4,5,6,7,8,9,10);
			$user_details =  array('data' => $data,'user_id'=>$user_id,
									'phys_data'=>$physical);		
	  	 	$this->load->view("physical/update_physical",$user_details);
	  	}

	  }


}