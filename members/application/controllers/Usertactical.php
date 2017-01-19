<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usertactical extends CI_Controller {

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

		  	$tact_details= $this->fetch_model->tactical_details($user_id);
		  	if($tact_details==false)
				   {
				   	$data = array(1,2,3,4,5,6,7,8,9,10);
				   	$user_details =  array('data' => $data,'user_id'=>$user_id);
                    $this->load->view("tactical/edit_tactical_view",$user_details);	  	
				   }
			else{					
	  		    $this->load->view("tactical/tactical_view",$tact_details); 
		  }
	  }//Index function End 

	  public function insertTactical()
	  {		  	   	   	   
	   	   $user_id=$this->input->post('user_id');
	   	   $game_aware=$this->input->post('game_aware');
	   	   $support=$this->input->post('support');
	   	   $overlaps=$this->input->post('overlaps');
	   	   $balance=$this->input->post('balance');
	   	   $decissions=$this->input->post('decissions');
	   	   $marking=$this->input->post('marking');
	   	   $pressing=$this->input->post('pressing');
	   	   $covering=$this->input->post('covering');
	   	   $compactness=$this->input->post('compactness');
	   	   $recovery=$this->input->post('recovery');
	   	   $possesion=$this->input->post('possesion');
	   	   $transition=$this->input->post('transition');   
    	   $responsivness=$this->input->post('responsivness'); 
    	   $adaptability=$this->input->post('adaptability'); 
    	   $anticipation=$this->input->post('anticipation');     	   
    
 		$tact_data = array('game_awarness' => $game_aware,'support' => $support,
	 					'overlaps' => $overlaps,'balance' => $balance,
	 					'decissions_making' => $decissions,'marking' => $marking,
	 					'pressing' => $pressing,'covering' => $covering,
	 					'compactness' => $compactness,'recovery' => $recovery,
	 					'possesion' => $possesion,'transition' => $transition,
	 					'responsivness'=> $responsivness,
	 					'adaptability' => $adaptability,
	 					'anticipation' => $anticipation,
	 					'wgp_user_id' =>$user_id);
 		  		 
 		 $success= $this->user_model->insertTactical($tact_data);

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
	  	// $user_id=$this->input->post('user_id');
	  	 $tact_details= $this->fetch_model->tactical_details($user_id);
	  	 if($tact_details==true)
	  	 {
	  	 	$data = array(1,2,3,4,5,6,7,8,9,10);
			$user_details =  array('data' => $data,'user_id'=>$user_id,
									'tact_data'=>$tact_details);		
	  	 	$this->load->view("tactical/update_tactical",$user_details);
	  	}

	  }

	  public function editTactical()
	  {   
	  	   $user_id=$this->input->post('user_id');   
	   	   $game_awarness=$this->input->post('game_awarness');
	   	   $overlaps=$this->input->post('overlaps');
	   	   $support=$this->input->post('support');
	   	   $decissions_making=$this->input->post('decissions_making');
	   	   $pressing=$this->input->post('pressing');
	   	   $compactness=$this->input->post('compactness');
	   	   $possesion=$this->input->post('possesion');
	   	   $responsivness=$this->input->post('responsivness');
	   	   $anticipation=$this->input->post('anticipation');
	   	   $balance=$this->input->post('balance');
	   	   $covering=$this->input->post('covering'); 
	   	   $marking=$this->input->post('marking'); 
	   	   $recovery=$this->input->post('recovery');	   	     
    	   $transition=$this->input->post('transition'); 
    	   $adaptability=$this->input->post('adaptability');  	 

	    $tact_data = array('game_awarness' => $game_awarness,'overlaps' => $overlaps,
		 					'decissions_making' => $decissions_making,
		 					'pressing' => $pressing,'transition' => $transition,
		 					'compactness' => $compactness,'possesion' => $possesion,
		 					'responsivness' => $responsivness,
		 					'anticipation' => $anticipation,'support'=>$support,
		 					'balance' => $balance,'covering' => $covering,
		 					'marking' => $marking,'recovery' => $recovery,
		 					'adaptability' => $adaptability);
	    

	    $success= $this->user_model->updateTact($tact_data,$user_id);
	    if($success){
	    		redirect('home');	       
			}	  		
	  }


}