<?php 

class Front_vitals extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
	    $this->load->library(array('form_validation','session'));
		//$this->load->library('encrypt');
		$this->load->model('profile_model');
		$this->load->model('user_model');
		$this->load->model('fetch_model');

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

	  public function loginView()
	  {
	  	   $this->load->view('front/login_view');
	  }

	public function vitalView(){
		if (!$this->session->userdata('user_exist'))
		        {
		          //If no session, redirect to login page
		           redirect('user', 'refresh');
		           exit();
		        }
		      $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];
		      $username=$session_data['username'];

		      	$session_user = $this->session->userdata('logged_in');		
				$user_user_id = $session_user['user_id'];	

				
	  $privacy_data = $this->profile_model->getPrivacyData($user_id,9);
	  if($privacy_data){
		      
		      if($privacy_data->anyone==1)
			  {
				 $this->vitalsDataView();
			  }
			 else if($privacy_data->nobody==1){
			  		echo "<h4>Vitals</h4><h3 class=\"heading_b heading_b_c uk-margin-bottom\"> You are not authorize to view this information !</h3>";
			  }
			 else if($privacy_data->friends==1){
				  	$session_user = $this->session->userdata('logged_in');
					$session_profile = $this->session->userdata('user_exist');

					if($session_user && $session_profile)
					{
								$user_user_id = $session_user['user_id'];
								$profile_user_id = $session_profile['user_id'];

								$id_arry = array('user_id' =>$user_user_id ,
									             'friend_id'=>$profile_user_id); 

					      $check_friendship = $this->profile_model->checkFriendShip($id_arry);
						      if($check_friendship){
						      	  $this->vitalsDataView();
						      }else{
						      	echo "<h4>Vitals</h4>";
						      	$this->loginView();
						      }

				  	 }else{
				  	 	    echo "<h4>Vitals</h4>";
				  			$this->loginView();
				  	 }			  		
			  }
			 else if($privacy_data->members==1){			  		
			  		$session_user = $this->session->userdata('logged_in');

		 		if($session_user){ 							
						
		 			$profile_user_id = $session_user['user_id'];
		 			$check_membership = $this->profile_model->checkMemberShip($profile_user_id);
		 			if($check_membership){
		 				$this->vitalsDataView();
		 			}else{		
		 			   echo "<h4>Vitals</h4>";  		
		  		       echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Your are not member(recruiter) , Please register yourself !</h3>";
		  		       $this->loginView();
		  		     } 			
		 		}else{	
		 		    echo "<h4>Vitals</h4>";	  		
		  		    $this->loginView();
		  		}
			  }
			else if($privacy_data->code_receivers==1)
			  {
			  	    if(isset($session_data['privacy_code']))
			  			{	//rechecking privacy code
			  				  $data = array('user_id' => $user_id,'unique_code' =>$session_data['privacy_code']);
						      $verify_status = $this->profile_model->verifyCode($data);

		      				if($verify_status){
		      					  $this->vitalsDataView();
			  				}else{  
			  					    echo "<h4>Vitals</h4>";
			      					$this->load->view('front/privacy_code_view');
			      			    }
			  			}else{
			  				echo "<h4>Vitals</h4>";
			      			$this->load->view('front/privacy_code_view');
			      		}
			  } 
			}else{

				echo "<h4>Vitals</h4><h3 class=\"heading_b heading_b_c uk-margin-bottom\">Profile Privacy  still not set</h3>";
			  	
			  }

	   }

	 public function vitalsDataView()
	 {		
 	     $session_data = $this->session->userdata('user_exist');
	     $user_id=$session_data['user_id'];
	     

	 	 // Get Vital Data Technical ,Tactical, Physical, Psychosocial 
		  	$ranking = array(1,2,3,4,5,6,7,8,9,10);
		    $tech_details= $this->fetch_model->technical_details($user_id);
		    $tact_details= $this->fetch_model->tactical_details($user_id);
		    $physical= $this->fetch_model->physical_details($user_id);
		    $psy_details= $this->fetch_model->psyhosocial_details($user_id);


		     //Percentes of technical,techtiacal

		     $per_technical = $this->getTechnicalDetail($user_id);

			 $per_tachtical = $this->getTachticalDetail($user_id);

			 $per_physical = $this->getPhysicalDetail($user_id);

			 $per_psyhosocial = $this->getPsyhosocialDetail($user_id);


				$data = array('tech_details'=>$tech_details,'tact_details'=>$tact_details,
					   	  	 'physical'=>$physical,'psy_details'=>$psy_details,					   	  	 
					   	  	 'per_technical'=>$per_technical,'per_tachtical'=>$per_tachtical,
			   	  	 		 'per_physical'=>$per_physical,'per_psyhosocial'=>$per_psyhosocial
			   	  	 		 );
			    $this->load->view("front/vitals_view",$data);
		 

	 }//end Vitals view


	 public function getTechnicalDetail($user_id){
	  		//start geting technical details
			$tech_details= $this->fetch_model->technical_details($user_id);
			if($tech_details){
			
			$total=0;			
			$sum =0;
			$count=1;
			foreach ($tech_details as $key => $value) {
				if(($key=='wgp_table_id') || ($key=='wgp_user_id') ){
					continue;
				}else{
					 
					$total =  $count*10;					
					$sum +=$value;	
					$count++;				 				
				}
			}

			   $avg = $sum/($count-1);
			   $per =  ($sum/$total)*100;
			   $percent =number_format($per, 2);

			return $technical = array('total' =>$total,'percent' =>$percent,
							   'sum'=>$sum,'average'=>$avg
							  );

				}
				else{
					return	$technical= array('total' =>0,'percent' =>0,
							   'sum'=>0,'average'=>0
							  );
				}
			//end geting technical details	
	  }

	  public function getTachticalDetail($user_id){
	  		//start geting techtical details
			$tact_details= $this->fetch_model->tactical_details($user_id);
			if($tact_details){
			
			$total=0;			
			$sum =0;
			$count=1;
			foreach ($tact_details as $key => $value) {

				if(($key=='wgp_table_id') || ($key=='wgp_user_id') ){
					continue;
				}else{
					 
					$total =  $count*10;					
					$sum +=$value;	
					$count++;				 				
				}
			}

			   $avg = $sum/($count-1);
			   $per =  ($sum/$total)*100;
			   $percent =number_format($per, 2);

			return $techtical = array('total' =>$total,'percent' =>$percent,
							   'sum'=>$sum,'average'=>$avg
							  );	
				}else{
					return	$techtical= array('total' =>0,'percent' =>0,
							   'sum'=>0,'average'=>0
							  );
				}		
			//end geting techtical details
	  }

	  public function getPhysicalDetail($user_id){
	  		//start geting physical details
		$physical_details= $this->fetch_model->physical_details($user_id);
		if($physical_details){
			
			$total=0;			
			$sum =0;
			$count=1;
			foreach ($physical_details as $key => $value) {

				if(($key=='wgp_table_id') || ($key=='wgp_user_id') ){
					continue;
				}else{
					 
					$total =  $count*10;					
					$sum +=$value;	
					$count++;				 				
				}
			}

			   $avg = $sum/($count-1);
			   $per =  ($sum/$total)*100;
			   $percent =number_format($per, 2);

		return	$physical = array('total' =>$total,'percent' =>$percent,
							   'sum'=>$sum,'average'=>$avg
							  );
		}else{
			return	$physical= array('total' =>0,'percent' =>0,
							   'sum'=>0,'average'=>0
							  );
		   }										
			//end geting physical details
	  }

	  public function getPsyhosocialDetail($user_id){
	  			//start geting Psyhosocial details
			$psy_details= $this->fetch_model->psyhosocial_details($user_id);
			if($psy_details){
			
			$total=0;			
			$sum =0;
			$count=1;
			foreach ($psy_details as $key => $value) {

				if(($key=='wgp_table_id') || ($key=='wgp_user_id') ){
					continue;
				}else{
					 
					$total =  $count*10;					
					$sum +=$value;	
					$count++;				 				
				}
			}

			   $avg = $sum/($count-1);
			   $per =  ($sum/$total)*100;
			   $percent =number_format($per, 2);

			return $psyhosocial = array('total' =>$total,'percent' =>$percent,
							   'sum'=>$sum,'average'=>$avg
							  );
				}
				else{
			return	$psyhosocial= array('total' =>0,'percent' =>0,
							   'sum'=>0,'average'=>0
							  );
		   }										
			//end geting Psyhosocial  details
	  }



}?>