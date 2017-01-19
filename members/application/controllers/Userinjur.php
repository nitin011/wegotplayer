<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userinjur extends CI_Controller {

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

	public function index(){
		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			//Get User Comment 
		    $row = array('wgp_table_id','wgp_user_id', 
						'injury_type(type_of_injury) type_of_injury',
					    'body_part(body_part) body_part', 
						'body_area(body_area) body_area','recovered', 
						'surgery_name(surgery) surgery', 
						'when');
			
			$injur = $this->fetch_model->getInjur($user_id,$row);

			$recovered = array();
				   	for($i=5;$i<=100;$i+=5){				   		
				   			array_push($recovered,$i);				   		
				   	}
			if($injur==false){
				 $injury_type=$this->fetch_model->getInjuryType();
				 $body_area=$this->fetch_model->getBodyArea();
				 $body_part=$this->fetch_model->getBodyPart();
				 $surgery=$this->fetch_model->getSurgery();

				 				   
				 $data = array('injury_type' => $injury_type,'body_area'=>$body_area,
				 				'body_part'=>$body_part,'surgery'=>$surgery,
				 				'recovered'=>$recovered
				 				);
				 
			     $this->load->view("injurie/add_injurie_view",$data);	
			}else{				
				 $data  = array('injur' =>$injur,'recovered'=>$recovered);				 				 				 
				 $this->load->view("injurie/injurie_view",$data);
			}
		}//End Index Function 

  public function insertInjur()
  {
  	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];			
			
  	        $injury_type =$this->input->post('injury_type');
  	        $body_area =$this->input->post('body_area');
  	        $body_part =$this->input->post('body_part');
  	        $recovered =$this->input->post('recovered');
  	        $surgery =$this->input->post('surgery');
  	        $when_yes =$this->input->post('when_yes');
  	       
  	        $injur_data = array('wgp_user_id'=>$user_id,'type_of_injury' => $injury_type,
  	        					'body_part'=>$body_part,'body_area'=>$body_area,
  	        					'recovered'=>$recovered,'surgery'=>$surgery,
  	        					'when'=>$when_yes);
  	        
  	        $success= $this->user_model->addInjurie($injur_data);

  	        if($success){
  	        	redirect('userinjur');
  	        }else{
  	        	return false;
  	        }
     }//End addComment function 

     public function addInjur(){
     	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

				 $injury_type=$this->fetch_model->getInjuryType();
				 $body_area=$this->fetch_model->getBodyArea();
				 $body_part=$this->fetch_model->getBodyPart();
				 $surgery=$this->fetch_model->getSurgery();

				 $recovered = array();
				   	for($i=5;$i<=100;$i+=5){				   		
				   			array_push($recovered,$i);				   		
				   	}				   
				 $data = array('injury_type' => $injury_type,'body_area'=>$body_area,
				 				'body_part'=>$body_part,'surgery'=>$surgery,
				 				'recovered'=>$recovered
				 				);
				 
			     $success=$this->load->view("injurie/add_injurie_view",$data);
			     if($success){
  	        			return true;
		  	        }else{
		  	        	return false;
		  	        }
      }

     public function updateInjurView(){
     	if (
     		!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$wgp_table_id = $this->input->post('edit');	

			$injur_row = $this->fetch_model->getInjurRow($user_id,$wgp_table_id);

			$injury_type=$this->fetch_model->getInjuryType();
				 $body_area=$this->fetch_model->getBodyArea();
				 $body_part=$this->fetch_model->getBodyPart();
				 $surgery=$this->fetch_model->getSurgery();

				 $recovered = array();
				   	for($i=5;$i<=100;$i+=5){				   		
				   			array_push($recovered,$i);				   		
				   	}		
			
			$data  = array('injur_row' =>$injur_row,'injury_type' => $injury_type,
							'body_area'=>$body_area,'body_part'=>$body_part,
				 			'surgery'=>$surgery,'recovered'=>$recovered
				 			);
				 										 						 		
			$this->load->view("injurie/edit_injur_row",$data);
			

     }
     public function updateInjurRow()
     {
     	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
					
			$wgp_table_id =$this->input->post('wgp_table_id');
			$injury_type =$this->input->post('injury_type');
  	        $body_area =$this->input->post('body_area');
  	        $body_part =$this->input->post('body_part');
  	        $recovered =$this->input->post('recovered');
  	        $surgery =$this->input->post('surgery');
  	        $when_yes =$this->input->post('when_yes');
  	       
  	        $injur_data = array('type_of_injury' => $injury_type,
  	        					'body_part'=>$body_part,'body_area'=>$body_area,
  	        					'recovered'=>$recovered,'surgery'=>$surgery,
  	        					'when'=>$when_yes);
  	          	        
  	        $success= $this->user_model->updateInjurie($user_id,$injur_data,$wgp_table_id);
		    if($success){
		    	return true;
		    }else{
		    	return false;
		    }
		
		}

		public function deleteInjur(){
			if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$wgp_table_id =$this->input->post('row_id');

			$delete_status= $this->user_model->deleteInjurRow($user_id,$wgp_table_id);

			if($delete_status)
			{
				echo 1;
			}else{
				echo 0;
			}
		}


}