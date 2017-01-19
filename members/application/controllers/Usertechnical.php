<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usertechnical extends CI_Controller {

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

		  	$tech_details= $this->fetch_model->technical_details($user_id);
		  	if($tech_details==false)
				   {
				   	$data = array(1,2,3,4,5,6,7,8,9,10);
				   	$user_details =  array('data' => $data,'user_id'=>$user_id);
                    $this->load->view("atheletics/edit_technical_view",$user_details);	  	
				   }
			else{
						
	  		    $this->load->view("atheletics/technical_view",$tech_details); 
		  }
	  }//Index function End 

	  public function insertTechnical()
	  {	   	   	   
	   	   $user_id=$this->input->post('user_id');
	   	   $technique=$this->input->post('technique');
	   	   $accuracy=$this->input->post('accuracy');
	   	   $control=$this->input->post('control');
	   	   $dribbling=$this->input->post('dribbling');
	   	   $finishing=$this->input->post('finishing');
	   	   $heading=$this->input->post('heading');
	   	   $long_passing=$this->input->post('long_passing');
	   	   $running=$this->input->post('running');
	   	   $shooting=$this->input->post('shooting');
	   	   $shielding=$this->input->post('shielding');
	   	   $turning=$this->input->post('turning');   
    	   $defending=$this->input->post('defending'); 
    	   $receiving=$this->input->post('receiving'); 
    	   $distribution=$this->input->post('distribution'); 
    	   $aerial_control=$this->input->post('aerial_control'); 
    
 		$tech_data = array('technique' => $technique,'control' => $control,
	 					'accuracy' => $accuracy,'dribbling' => $dribbling,
	 					'finishing' => $finishing,'heading' => $heading,
	 					'long_passing' => $long_passing,'running' => $running,
	 					'shooting' => $shooting,'shielding' => $shielding,
	 					'turning' => $turning,'defending' => $defending,
	 					'receiving' => $receiving,'distribution' => $distribution,
	 					'aerial_control' => $aerial_control,
	 					'wgp_user_id' =>$user_id);
 		 
 		 $success= $this->user_model->technicalRecord($tech_data);

		if($success){			       
				redirect('home');
				exit();	
			}	   	   
	  }

	  public function editTechnical()
	  {  
	  	   $user_id=$this->input->post('user_id');   
	   	   $technique=$this->input->post('technique');
	   	   $accuracy=$this->input->post('accuracy');
	   	   $control=$this->input->post('control');
	   	   $dribbling=$this->input->post('dribbling');
	   	   $finishing=$this->input->post('finishing');
	   	   $heading=$this->input->post('heading');
	   	   $long_passing=$this->input->post('long_passing');
	   	   $running=$this->input->post('running');
	   	   $shooting=$this->input->post('shooting');
	   	   $shielding=$this->input->post('shielding');
	   	   $turning=$this->input->post('turning');   
    	   $defending=$this->input->post('defending'); 
    	   $receiving=$this->input->post('receiving'); 
    	   $distribution=$this->input->post('distribution'); 
    	   $aerial_control=$this->input->post('aerial_control');


	    $tech_data = array('technique' => $technique,'control' => $control,
		 					'accuracy' => $accuracy,'dribbling' => $dribbling,
		 					'finishing' => $finishing,'heading' => $heading,
		 					'long_passing' => $long_passing,'running' => $running,
		 					'shooting' => $shooting,'shielding' => $shielding,
		 					'turning' => $turning,'defending' => $defending,
		 					'receiving' => $receiving,
		 					'distribution' => $distribution,
		 					'aerial_control' => $aerial_control);

	    $success= $this->user_model->updateTech($tech_data,$user_id);
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
	  	 $tech_details= $this->fetch_model->technical_details($user_id);
	  	 if($tech_details==true)
	  	 {
	  	 	$data = array(1,2,3,4,5,6,7,8,9,10);
			$user_details =  array('data' => $data,'user_id'=>$user_id,
									'tech_data'=>$tech_details);			
	  	 	$this->load->view("atheletics/update_technical",$user_details);
	  	}

	  }


}