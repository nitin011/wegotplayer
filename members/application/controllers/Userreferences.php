<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userreferences extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
	    $this->load->library(array('form_validation','session'));
		//$this->load->library('encrypt');
		$this->load->model('fetch_model');
		$this->load->model('user_model');
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

	public function index(){
		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$row = array('wgp_table_id', 'wgp_user_id','phone','email',
				      'refer_occupation(full_time_occupation) full_time_occupation',
				       'gender', 'level_name(level)  level','organization',
				      'location', 'comment', 'full_name');
			$reference= $this->fetch_model->referenceDetail($user_id,$row);

			$asked_ref=$this->fetch_model->getAskedReference($user_id);
	
			// Get sport id 
			$user_sport_data = $this->fetch_model->getSportId($user_id);

			if($user_sport_data){
           		 $user_sport_id =$user_sport_data->sport;           
					// Get level  of sport
				 $level_data = $this->fetch_model->getLevel($user_sport_id);					
		    } 

			$occupation =$this->fetch_model->getOccupation();
		  	if($reference==false)
				  { 	
				  	$gender = array('1' =>'Male' ,'2'=>'Female');			  	
				  	$data = array('occupation' =>$occupation,'gender'=>$gender,
				  		           'level'=>$level_data);
				  	
				  	$this->load->view("references/add_refer_view",$data);
				  }else{ 
				  	
				  	$data = array('reference' =>$reference,'asked_ref'=>$asked_ref);
				  					  	
					$this->load->view("references/references_view",$data);
				}
		}//end Index Function

		public function insertRefer()
		{			
			if (!$this->session->userdata('logged_in'))
			  {
			    //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }

			  
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$full_name=$this->input->post('full_name');
			$occupation=$this->input->post('occupation');
			$organization=$this->input->post('organization');
			$phone=$this->input->post('phone');
			$email=$this->input->post('email');
			$level=$this->input->post('level');
			$gender=$this->input->post('gender');
			$location=$this->input->post('location');
			$comments=$this->input->post('comments');

			$data = array('wgp_user_id' =>$user_id,'level'=>$level,'email'=>$email,
				          'full_time_occupation'=>$occupation,'organization'=>$organization,
			 			  'gender'=>$gender,'location'=>$location,'phone'=>$phone,
			 			  'comment'=>$comments,'full_name'=>$full_name
			 			  );			
			$success= $this->user_model->insertRefer($data);	
				if($success){
					redirect('home');
				}else{
					echo "false";
				}
			
		}

		public function addRefer(){
			if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$row = array('wgp_table_id', 'wgp_user_id', 'phone','email',
				      'refer_occupation(full_time_occupation) full_time_occupation',
				       'gender', 'level_name(level) level','organization',
				      'location', 'comment', 'full_name');
			$reference= $this->fetch_model->referenceDetail($user_id,$row);

			$occupation =$this->fetch_model->getOccupation();
			$gender = array('1' =>'Male' ,'2'=>'Female');
			// Get sport id 
			$user_sport_data = $this->fetch_model->getSportId($user_id);

			if($user_sport_data){
           		 $user_sport_id =$user_sport_data->sport;           
					// Get level  of sport
				 $level_data = $this->fetch_model->getLevel($user_sport_id);					
		    } 			  	
			$data = array('occupation' =>$occupation,'gender'=>$gender,
							'level'=>$level_data);
			$this->load->view("references/add_refer_view",$data);
		}

		public function updateReferView()
		{
			if (!$this->session->userdata('logged_in'))
			  {	 //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }			  
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$wgp_table_id=$this->input->post('edit');
			$row = array('wgp_table_id', 'wgp_user_id', 'phone','email',
				      'refer_occupation(full_time_occupation) full_time_occupation', 
				      'gender', 'level_name(level) level','organization',
				      'location', 'comment', 'full_name');
			$reference= $this->fetch_model->referenceDetail($user_id,$row);

			$refer_row =$this->fetch_model->getReferRow($user_id,$wgp_table_id);
			$user_sport_data = $this->fetch_model->getSportId($user_id);
				if($user_sport_data){
           		 $user_sport_id =$user_sport_data->sport;           
					// Get level  of sport
				 $level_data = $this->fetch_model->getLevel($user_sport_id);					
		    } 
			$occupation =$this->fetch_model->getOccupation();
			$gender = array('1' =>'Male' ,'2'=>'Female');			  	
			$data = array('occupation' =>$occupation,'gender'=>$gender,
				'refer_row'=>$refer_row,'level'=>$level_data);
							
			$this->load->view("references/update_refer_row",$data);
		}

		public function updateReferRow()
		{			
			if (!$this->session->userdata('logged_in'))
			  {	 //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }			  
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$wgp_table_id=$this->input->post('wgp_table_id');
			$full_name=$this->input->post('full_name');
			$occupation=$this->input->post('occupation');
			$level=$this->input->post('level');
			$phone=$this->input->post('phone');
			$email=$this->input->post('email');
			$organization=$this->input->post('organization');
			$gender=$this->input->post('gender');
			$location=$this->input->post('location');
			$comments=$this->input->post('comments');

			$refer_data = array(
				          'full_time_occupation'=>$occupation,
			 			  'gender'=>$gender,'location'=>$location,
			 			  'comment'=>$comments,'full_name'=>$full_name,
			 			  'level'=>$level,'organization'=>$organization,
			 			  'phone'=>$phone,'email'=>$email
			 			  );			 			 			
			$success= $this->user_model->updateReferRow($refer_data,$wgp_table_id,$user_id);
			if($success)
			{	
				$row = array('wgp_table_id', 'wgp_user_id','phone','email', 
				      'refer_occupation(full_time_occupation) full_time_occupation',
				       'gender', 'level_name(level) level','organization',
				      'location', 'comment', 'full_name');
				$reference= $this->fetch_model->referenceDetail($user_id,$row);		
				$data = array('reference' =>$reference);		

				$this->load->view("references/references_view",$data); 
			}else{
				return false;
			}
		}

		public function deleteRefer()
	    {
	   		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$wgp_table_id =$this->input->post('row_id');

			$delete_status= $this->user_model->deleteReferRow($user_id,$wgp_table_id);

			if($delete_status)
			{
				echo 1;
			}else{
				echo 0;
			}

	     }

	  public function deleteAskedRefer(){
	  		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$table_id =$this->input->post('row_id');

			$delete_status= $this->user_model->deleteAskedRow($user_id,$table_id);

			if($delete_status)
			{
				echo 1;
			}else{
				echo 0;
			}

	  }

	  public function sendReferenceForm(){
	  	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$email = $this->input->post('email');
			$name  = $this->input->post('name');

			$check_email = isEmail($email);
	    	 if($check_email){
				 $register_status=$this->checkEmailRegister($email);
					 if($register_status){	
					 	print_r($register_status);
					 		$status =1;				 		
					 		$this->sendFormUrl($name,$email,$status);
					 }else{
					 	$status=0;
					 	$this->sendFormUrl($name,$email,$status);
					 }
			  }else{
			  	echo "Email not in valid format !";
			  }


	  }

	  public function checkEmailRegister($email){ 		
		 $email_exist = $this->user_model->checkEmailExist($email);
		 if($email_exist){
			  return true;
		 }else{
			  return false;
			}			
	 }

	
	 public function sendFormUrl($name,$email,$status)
	 {
	 	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$user_email=$session_data['email'];
			$user_name=$session_data['name'];

			$hash_key = md5(time());

			$row = array('refere_for_user_id' => $user_id,'name'=>$name ,
						'email'=>$email,'hash_key'=>$hash_key,'registered_status'=>$status);

			 $this->user_model->addReferData($row);
			
			$url =base_url().'refer/index/'.$hash_key;

	 	$to=$email;
		$to =  strip_tags("$to");									
		//$from= $user_email;
		$from= 'help@wegotplayers.com';
		$from =  strip_tags("$from");									
		$subject=ucwords($user_name).' requested a player recommendation on WeGotPlayers';	
							
		$headers = "from: WeGotPlayers<".$from.">\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";														  
		$message  = '<html><body style="background-color:#f6f6f6;">';				
		$message .= '<table style="margin:0px auto;" width="600px" cellpadding="0" cellspacing="0" border="0px">
					<tr><td><h3 style="text-align:left;">Hello '.ucwords($name).',</h3></td></tr>
					<tr><td><p style="margin:8px 8px 8px 20px">'.ucwords($user_name).' is using WeGotPlayers to stay organized and play at the next level. He would like you to complete a short recommendation for coaches to see.</p></td></tr>					
					<tr><td><a href="'.$url.'" style="max-width: 300px; padding: 8px; display: block!important; border: 2px solid; outline: none; text-decoration: none; margin-left: auto;
					margin-right: auto; text-align: center; border-radius: 10px; background-color: #f47921; color: #fff; font-size: 16px;" />Please click this link to fill it out</a></td></tr>
					<tr><td><p style="text-align:center; margin:5px">Thanks for helping '.ucwords($user_name).' getting closer in reaching the next level!</p></td></tr>
					</table>';
		$message .='<td style="font-family:Arial,Helvetica,sans-serif;line-height:22px"><span style="font-size:16px;color:#594f47">
					<strong>Sincerely,</strong><br>The WeGotPlayers Team</span></td>';			
		$message .= "</body></html>";
							
		$sendmail=mail($to, $subject, $message, $headers);
		if($sendmail){
			return true;				
		}else{
			return false;
		}
	 }

	 public function showAskRefer(){
	 		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$table_id =$this->input->post('row_id');

			$delete_status= $this->user_model->showAskRefer($user_id,$table_id);

			if($delete_status)
			{
				echo 1;
			}else{
				echo 0;
			}

	 }

	 public function hideAskRefer(){
	 		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$table_id =$this->input->post('row_id');

			$delete_status= $this->user_model->hideAskRefer($user_id,$table_id);

			if($delete_status)
			{
				echo 1;
			}else{
				echo 0;
			}


	 }




}