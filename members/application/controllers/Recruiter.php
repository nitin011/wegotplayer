<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recruiter extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
	    $this->load->library(array('form_validation','session'));		
		$this->load->model('coach_model');
		$this->load->model('fetch_model');
		$this->load->model('theme2_model');

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
		  	$dp_url = $session_data['dp_url'];	

		   $user_data =['name'=>$name,'email'=>$email,'title'=>'WeGotPlayers'];
			

		   $recruiter_row = array('coach_id','first_name','last_name',
		   				'recruiter_occupation(occupation) occupation_name',
		   				 'occupation','team','sport_name(sports) sport','sports',
						'level_name(level) level_name','level', 'website',
						'zip', 'city', 'state', 'location', 
						'address','user_id','coaching_gender');		  	

		  	$coach_details= $this->coach_model->coach_details($user_id,$recruiter_row); 

		  

		  	if($coach_details){
		    	$nationality = $detail->nationality;
		    	$location_short = $this->theme2_model->getShortLocationName($nationality);
		    	$sport_id = $coach_details->sports;
		  	    $level_list= $this->fetch_model->user_selectLevel($sport_id);
		    }else{
		    	$location_short ='';
		    	$level_list =0;
		    }

		  	$user_name = $this->fetch_model->getUseName($user_id);

		  	$gender_list =array('No one','Men','Women','Both');
		  	$sport_list = $this->fetch_model->sport();


		  	$occupation_data = $this->coach_model->getOccupation();	
			$nation_list = $this->fetch_model->nation();
			$hand_list = $this->fetch_model->hand();
			$foot_list = $this->fetch_model->foot();
			$height_list = $this->fetch_model->height();
			$weight_list = $this->fetch_model->weight();
			$seeking = $this->fetch_model->getSeeking();
			$contact_you= $this->fetch_model->getContactYou();
			$find_list = $this->fetch_model->find();
			



			$data = ['name'=>$name,'user_id'=>$user_id,
					'email'=>$email,'dp_url'=>$dp_url,'location_short'=>$location_short,				
					'coach_details'=>$coach_details,'gender'=>$gender_list,
					'user_id'=> $user_id,'nation'=>$nation_list,'level'=>$level_list,
		            'sport'=>$sport_list,'hand'=>$hand_list,'username'=>$user_name,
		            'foot'=>$foot_list,'height'=>$height_list,'weight'=>$weight_list,
		            'find'=>$find_list,'seeking'=>$seeking,'contact'=>$contact_you,
		            'occupation'=>$occupation_data,
			      ]; 
				
	  		$this->load->view("header-incomplete",$user_data);	  		
	  		//$this->load->view("dashboard/cover_view");	
	  		$this->load->view("theme2/recruiter",$data);	
			//$this->load->view("footer");

		  }

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


		return	$data = array('title' => 'Profile', 'name' => $name,
			          'email' => $email,'user_id'=> $user_id,'nation'=>$nation_list,
			          'sport'=>$sport_list,'hand'=>$hand_list,'username'=>$user_name,
			          'foot'=>$foot_list,'height'=>$height_list,'weight'=>$weight_list,
			          'find'=>$find_list,'seeking'=>$seeking,'contact'=>$contact_you
			          );				   	
	  }

	 public function profile(){
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
		  	$unique_code=$session_data['unique_code'];

		  	$data = array('coach_id','first_name','last_name','recruiter_occupation(occupation) occupation','team', 
		  		'sport_name(sports) sports', 'level_name(level) level', 'website', 'zip', 'city', 'state', 'location', 
		  		'address','user_id','coaching_gender');
		  	$gender_list =array('No one','Men','Women','Both');	
		  	$coach_details= $this->coach_model->coach_details($user_id,$data);
		  
		  		$sport_list = $this->fetch_model->sport();
		  		$find_list = $this->fetch_model->find();

		  		$occupation_data = $this->coach_model->getOccupation();		

		  			  		

		  return $data = array('sport'=>$sport_list,'gender'=>$gender_list,
		  					  'find'=>$find_list,'occupation'=>$occupation_data,
		  					  'unique_code'=>$unique_code);
		  	

	 }

	 public function addProfile(){
	 	
	 	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$email=$session_data['email'];
			$name=$session_data['name'];

	 	$fname = $this->input->post('fname');
	 	$lname = $this->input->post('lname');	 	
	 	$address = $this->input->post('address');
	 	$zip = $this->input->post('pincode');
	 	$city = $this->input->post('city');
	 	$state = $this->input->post('state');
	 	$location = $this->input->post('country');
	 	$website = $this->input->post('website');
	 	$sport = $this->input->post('sport');
	 	$level = $this->input->post('level');
	 	$team = $this->input->post('team');
	 	$coach_gender = $this->input->post('coach_gender');
	 	$country = $this->input->post('country');
	 	$occupation = $this->input->post('occupation');
	 	
	 	$data = array('first_name' => $fname,'last_name' =>$lname ,
		 			  'team' =>$team ,'sports' =>$sport ,'level' =>$level ,
		 			  'occupation' => $occupation,
		 			  'website' => $website,
		 			  'zip' => $zip =!empty($zip) ? $zip :000000,
		 			  'city' =>$city =!empty($city) ? $city : '', 
		 			  'state'=>$state = !empty($state) ? $state : '',
		 			  'location'=>$country = !empty($country) ? $country : '',
		 			  'address'=>$address,
		 			  'user_id'=>$user_id,'coaching_gender'=>$coach_gender);
	 	$success= $this->coach_model->insertCoach($data);
	 	$gender_list =array('No one','Men','Women','Both');	
		if($success){			       
		    redirect('recruiter');
		}else{
			echo "Basic Detail Not Saved .";
		}
	
	}

	

	 public function getLevel(){
	 	$sport_id = $this->input->post('sport_id');
	 	$level_list= $this->fetch_model->user_selectLevel($sport_id);
	 	$option='';
	 	foreach($level_list as $opt){
				$option = $option.'<option value="'.$opt->levelId.'">'.$opt->levelName.'</option>';
			} 		
		echo $option;

	 }

	public function updateProfileView(){
		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];	
			$unique_code=$session_data['unique_code'];

			$sport_list = $this->fetch_model->sport();
		  	$find_list = $this->fetch_model->find();
			$occupation_data = $this->coach_model->getOccupation();		

		  			  				

			$data = array('coach_id','first_name','last_name','occupation','team', 
		  		'sports', 'level', 'website', 'zip', 'city', 'state', 'location', 
		  		'address','user_id','coaching_gender');
			$gender_list =array('No one','Men','Women','Both');	
		  	$coach_details= $this->coach_model->coach_details($user_id,$data);
		  	//print_r($coach_details);
		  	$data = array('coach'=>$coach_details,'sport'=>$sport_list,
		  					'gender'=>$gender_list,'find'=>$find_list,
		  					'occupation'=>$occupation_data);
		  	
			$this->load->view("rs_personal/update_profile_view",$data);


	}

	public function updateProfileData()
	{		
		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$unique_code=$session_data['unique_code'];
			$name=$session_data['name'];
			$email=$session_data['email'];
			$password=$session_data['password'];
			$usertype =$session_data['usertype'];
			$dp_url=$session_data['dp_url'];


			$fname = $this->input->post('fname');
		 	$lname = $this->input->post('lname');	 	
		 	$address = $this->input->post('address');
		 	$zip = $this->input->post('pincode');
		 	$city = $this->input->post('city');
		 	$state = $this->input->post('state');
		 	$location = $this->input->post('country');
		 	$website = $this->input->post('website');
		 	$sport = $this->input->post('sport');
		 	$level = $this->input->post('level');
		 	$team = $this->input->post('team');
		 	$coach_gender = $this->input->post('coach_gender');		 	
		 	$occupation = $this->input->post('occupation');
		 	
		 	$data = array('first_name' => $fname,'last_name' =>$lname ,
		 			  'team' =>$team ,'sports' =>$sport ,'level' =>$level ,
		 			  'state'=>$state,'occupation' => $occupation,
		 			  'website' => $website,'zip' => $zip,'city' =>$city , 
		 			  'location'=>$location,'address'=>$address,
		 			  'user_id'=>$user_id,'coaching_gender'=>$coach_gender);

		 	$name =$fname.' '.$lname;	 	

		 	$user_data = array('name' =>$name);

		 	$user=$this->coach_model->updateUserName($user_id,$user_data);
		 	if($user){
		 	$userdata = array(	
				'user_id'  => $user_id,
				'unique_code'=>$unique_code,	
				'name'     => $name,				
				'email'    => $email,
				'password' => $password,
				'usertype' => $usertype,
	            'dp_url'   => $dp_url,			
				);
						
			$this->session->set_userdata('logged_in',$userdata);
		 		
		 	}

		 	$success= $this->coach_model->updateCoach($data,$user_id);
		 	if($success){
		 		redirect('recruiter');

		 	}
		 	else{
		 		return false;
		 	}



	}




}