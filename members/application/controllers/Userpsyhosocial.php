<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userpsyhosocial extends CI_Controller {

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

		  	$psy_details= $this->fetch_model->psyhosocial_details($user_id);
		  	
		  	if($psy_details==false)
				   {				   	
				   	$data = array(1,2,3,4,5,6,7,8,9,10);
				   	$user_details =  array('data' => $data,'user_id'=>$user_id);
                    $this->load->view("psyhosocial/edit_psyhosocial_view",$user_details);	  	
				   }
			else{
				
	  		    $this->load->view("psyhosocial/psyhosocial_view",$psy_details); 
		  }
	  }//Index function End 

	  public function insertPsyhosocial()
	  {	 	  	 	   	   
	   	   $user_id=$this->input->post('user_id');
	   	   $attitude=$this->input->post('attitude');
	   	   $self_confidence=$this->input->post('self_confidence');
	   	   $honesty=$this->input->post('honesty');
	   	   $cooperation=$this->input->post('cooperation');
	   	   $communication=$this->input->post('communication');
	   	   $competitivness=$this->input->post('competitivness');
	   	   $passion=$this->input->post('passion');
	   	   $discipline=$this->input->post('discipline');
	   	   $focus=$this->input->post('focus');
	   	   $leadership=$this->input->post('leadership');
	   	   $vision=$this->input->post('vision');   
    	   $respect=$this->input->post('respect'); 
    	   $character=$this->input->post('character'); 
    	   $motivation=$this->input->post('motivation'); 
		   $trustworthiness=$this->input->post('trustworthiness'); 
    
 		$psy_data = array('attitude' => $attitude,'self_confidence' => $self_confidence,
	 					'honesty' => $honesty,'cooperation' => $cooperation,
	 					'communication' => $communication,'competitivness' => $competitivness,
	 					'passion' => $passion,'discipline' => $discipline,
	 					'focus' => $focus,'leadership' => $leadership,
	 					'vision' => $vision,'respect' => $respect,
	 					'character'=> $character,'motivation' => $motivation,
	 					'trustworthiness' => $trustworthiness,
	 					'wgp_user_id' =>$user_id);

 		 $success= $this->user_model->insertPsyhosocial($psy_data);

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
	  	 $psy_details= $this->fetch_model->psyhosocial_details($user_id);
	  	 if($psy_details==true)
	  	 {
	  	 	$data = array(1,2,3,4,5,6,7,8,9,10);	  	 	
			$user_details =  array('data' => $data,'user_id'=>$user_id,
									'psy_data'=>$psy_details);			
	  	 	$this->load->view("psyhosocial/update_psyhosocial",$user_details);
	  	}

	  }

	  public function updatePsyhosocial()
	  {	  		  	
	  		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
		   $session_data = $this->session->userdata('logged_in');
		   $user_id=$session_data['user_id'];
		   $attitude=$this->input->post('attitude');

	   	   $self_confidence=$this->input->post('self_confidence');
	   	   $honesty=$this->input->post('honesty');
	   	   $cooperation=$this->input->post('cooperation');
	   	   $communication=$this->input->post('communication');
	   	   $competitivness=$this->input->post('competitivness');
	   	   $passion=$this->input->post('passion');
	   	   $discipline=$this->input->post('discipline');
	   	   $focus=$this->input->post('focus');
	   	   $leadership=$this->input->post('leadership');
	   	   $vision=$this->input->post('vision');   
    	   $respect=$this->input->post('respect'); 
    	   $character=$this->input->post('character'); 
    	   $motivation=$this->input->post('motivation'); 
		   $trustworthiness=$this->input->post('trustworthiness'); 
    
 		$psy_data = array('attitude' => $attitude,'self_confidence' => $self_confidence,
	 					'honesty' => $honesty,'cooperation' => $cooperation,
	 					'communication' => $communication,'competitivness' => $competitivness,
	 					'passion' => $passion,'discipline' => $discipline,
	 					'focus' => $focus,'leadership' => $leadership,
	 					'vision' => $vision,'respect' => $respect,
	 					'character'=> $character,'motivation' => $motivation,
	 					'trustworthiness' => $trustworthiness);
 		
 		$success= $this->user_model->updatePsyhosocial($psy_data,$user_id);
	    if($success){
	    		redirect('home');	       
			}
	  }


}