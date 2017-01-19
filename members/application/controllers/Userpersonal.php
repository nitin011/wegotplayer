<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userpersonal extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
	    $this->load->library(array('form_validation','session'));
		//$this->load->library('encrypt');
		$this->load->model('fetch_model');
		$this->load->model('user_model');
		$this->load->model('account_model');	
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
		  	$acc_type=$session_data['acc_type'];
		  	
		  	$unique_code = $this->account_model->getUniqueId($user_id);		  	

		  	$user_details= $this->fetch_model->user_details($user_id);
		  	$user_name = $this->fetch_model->getUseName($user_id);

		  	$seeking_id = $this->user_model->getSeekingId($user_id);
		  	$contact_id = $this->user_model->getContactId($user_id);
		  	
		  	

		  	if($user_details==false)
		  	{

				   		$nation_list = $this->fetch_model->nation();
				   		//$country_list = $this->fetch_model->country();
				   		$sport_list = $this->fetch_model->sport();
				   		$hand_list = $this->fetch_model->hand();
				   		$foot_list = $this->fetch_model->foot();
				   		$height_list = $this->fetch_model->height();
				   		$weight_list = $this->fetch_model->weight();
				   		$seeking = $this->fetch_model->getSeeking();
				   		$contact_you= $this->fetch_model->getContactYou();
				   		$find_list = $this->fetch_model->find();



	
				   		$data = array('title' => 'Edit Profile', 'name' => $name,
				   			          'email' => $email,'user_id'=> $user_id,'nation'=>$nation_list,
				   			          'sport'=>$sport_list,'hand'=>$hand_list,'username'=>$user_name,
				   			          'foot'=>$foot_list,'height'=>$height_list,'weight'=>$weight_list,
				   			          'find'=>$find_list,'seeking'=>$seeking,'contact'=>$contact_you
				   			          );				   		
				   		
				   		$this->load->view('dashboard/edit_profile_view',$data);
				   						   		
				   }
				   else{
					   $birth_day = $user_details->birth_day;
				   
				   	//Get Month of User
				       $month_id = $user_details->birth_month;
				  	   $month = $this->fetch_model->user_month($month_id);				  	 
				  	   $month_name = $month->monthName;

				  	   $birth_year = $user_details->birth_year;

				   $dob = $birth_day."/".$month_id."/".$birth_year;

			  //Get Sport of User
				   $nationality = $user_details->nationality;
				  	   $nation = $this->fetch_model->user_nationality($nationality);				  	 
				   $nation_name = $nation->nationality;
				   
				
					//Get Sport of User
				   $sport_id = $user_details->sport;
				  	   $sport = $this->fetch_model->user_sport($sport_id);				  	 
				   $sport_name = $sport->sportName;
				   

				  //Get Level of User
				   $level_id = $user_details->level;
				  	   $level = $this->fetch_model->user_level($level_id);				  	 
				   $level_name = $level->levelName;

				   

				   //Get position_speciality of User
				   $position_id = $user_details->position_speciality;
				  	   $position = $this->fetch_model->user_position($position_id);				  	 
				   $position_name = $position->positionName;
				   

				  //Get hand of User
				   $hand_id = $user_details->hand;
				  	   $hand = $this->fetch_model->user_hand($hand_id);				  	 
				   $hand_name = $hand->handName;
				   

				  //Get foot of User
				   $foot_id = $user_details->foot;
				  	   $foot = $this->fetch_model->user_foot($foot_id);				  	 
				   $foot_name = $foot->footName;
				   

				   //Get height of User
				   $height_id = $user_details->height;
				  	   $height = $this->fetch_model->user_height($height_id);				  	 
				   $height_name = $height->height;
				   

				   //Get height of User
				   $weight_id = $user_details->weight;
				  	   $weight = $this->fetch_model->user_weight($weight_id);				  	 
				   $weight_name = $weight->weight;
				   

				  //Get height of User
				   $find_id = $user_details->find;
				  	   $find = $this->fetch_model->user_find($find_id);				  	 
				   $find_name = $find->findName;
				   
				   $gender = $user_details->gender;

				  $address = $user_details->address;
				  $zip = $user_details->zip;
				  $state = $user_details->state;
				  $city = $user_details->city;
				  $country = $user_details->location;


				  $per_info = $this->fetch_model->getPersonalInfo($user_id);
				  if($per_info){
				  	$personal_info=$per_info->message;
				  	$objective=$per_info->objective;
				  }else{
				  	$personal_info="Personal Information!";
				  	$objective="";
				  }

				  

				 $data = array('title'=>'WeGotPlayer','user_id'=>$user_id,'name'=>$name,
				 			   'dob'=>$dob,'unique_code'=>$unique_code,'username'=>$user_name,
				 			   'email'=>$email,'nationality'=>$nation_name,'sport'=>$sport_name,
				 			   'level'=>$level_name,'position'=>$position_name,'hand'=>$hand_name,
				 			   'foot'=>$foot_name,'height'=>$height_name,'weight'=>$weight_name,
				 			   'country'=>$country,'address'=>$address,'city'=>$city,
				 			   'state'=>$state,'zip'=>$zip,'find'=>$find_name,'gender'=>$gender,
				 			   'seek'=>$seeking_id,'contact_arry'=>$contact_id,
				 			   'personal_info'=>$personal_info,'objective'=>$objective,
				 			   'acc_type'=>$acc_type
				 			   );

				
	  		$this->load->view("dashboard/personal_view",$data); 		
		  }

	  }//Index function End

	  public function selectLevel(){
		 $id=$this->input->post('id');		 
		 $level_list= $this->fetch_model->user_selectLevel($id);

			$option = '<select name="nlevel" id="levelis" required class="md-input">';
					 foreach($level_list as $opt){
			$option = $option.'<option value="'.$opt->levelId.'">'.$opt->levelName.'</option>';
					 }
		  $option.'</select>';

		  echo $option;


	}

	public function checkUserName()
	{
		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$username = $this->input->post('username');

			$data = array('login_name' =>$username);

			$check = $this->user_model->checkUserName($data);
			if($check){
				echo 1;
			}
			else{
				echo 0;
			}

	}

	public function selectPosition(){
		 $id=$this->input->post('id');		 
		 $position_list= $this->fetch_model->user_selectPosition($id);

			$option = '<select name="nposition" id="positionis" required class="md-input">';
					 foreach($position_list as $opt){
			$option = $option.'<option value="'.$opt->positionId.'">'.$opt->positionName.'</option>';
					 }
		  $option.'</select>';

		  echo $option;


	}


public	function updatePersonal()
{	
	if (!$this->session->userdata('logged_in'))
	   {
		    //If no session, redirect to login page
			redirect('user', 'refresh');
				exit();
		}
		$session_data = $this->session->userdata('logged_in');
		$user_id=$session_data['user_id'];

		//print_r($_REQUEST);

	 $fname=$this->input->post('fname');
	 $lname=$this->input->post('lname');
	 //$email=$this->input->post('email');
	 $gender=$this->input->post('gender');
	 $nationality=$this->input->post('nationality');

	 $dob=$this->input->post('dob');
	 $dob_array = explode("-", $dob);
	 $birth_year=$dob_array[2];
	 $birth_month=$dob_array[1];
	 $birth_day=$dob_array[0];

	 $address=$this->input->post('address');
	 $city=$this->input->post('city');
	 $state=$this->input->post('state');
	 $country=$this->input->post('country');
	 $zip_code=$this->input->post('zip_code');
	 $sport=$this->input->post('sport');
	 $level=$this->input->post('level');
	 $position=$this->input->post('position');
	 $hand=$this->input->post('hand');
	 $foot=$this->input->post('foot');
	 $height=$this->input->post('height');
	 $weight=$this->input->post('weight');
	 //$seeking=$this->input->post('seeking');
	 //$whocan=$this->input->post('whocan');
	$find=$this->input->post('find');

	// start update personal info of player
	$personal_info=$this->input->post('personal_info');
	$row = array('message' =>$personal_info);
	$status=$this->user_model->updatePersonalInfo($row ,$user_id);	
	//end update personal info of player	

	$user_data=array(
                     'user_id'=>$user_id,'first_name'=>$fname,'last_name'=>$lname,'gender'=>$gender,
                     'nationality'=>$nationality,'birth_year'=>$birth_year,'birth_month'=>$birth_month,
                     'birth_day'=>$birth_day,'address'=>$address,'city'=>$city,
                     'state'=>$state,'location'=>$country,'zip'=>$zip_code,'sport'=>$sport,
                     'level'=>$level,'position_speciality'=>$position,'hand'=>$hand,'foot'=>$foot,
                     'height'=>$height,'weight'=>$weight,'find'=>$find
                     );

	$success= $this->user_model->playerRecord($user_data);

	if($success){			       
				redirect('home','refresh');
				exit();
			}
	
	}

 public function editProfile()
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
		  	$acc_type=$session_data['acc_type'];

		  	$user_details= $this->fetch_model->user_details($user_id);
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


	   		$sport_id = $user_details->sport;
	   		if($sport_id){
	        	$sport_level = $this->fetch_model->getSportLevel($sport_id);
	         	$sport_position = $this->fetch_model->getSportPosition($sport_id);
	         }

	   		

	   		 $per_info = $this->fetch_model->getPersonalInfo($user_id);
				  if($per_info){
				  	$personal_info=$per_info->message;
				  	$objective=$per_info->objective;
				  }else{
				  	$personal_info="No Personal information !";
				  	$objective="";
				  }

	   		$data = array('title' => 'Edit Profile', 'name' => $name,'objective'=>$objective,
	   			          'email' => $email,'user_id'=> $user_id,'nation'=>$nation_list,
	   			          'sport'=>$sport_list,'hand'=>$hand_list,'username'=>$user_name,
	   			          'foot'=>$foot_list,'height'=>$height_list,'weight'=>$weight_list,
	   			          'find'=>$find_list,'seeking'=>$seeking,'contact'=>$contact_you,
	   			          'user_details'=>$user_details,'personal_info'=>$personal_info,
	   			          'acc_type'=>$acc_type,'sport_level'=>$sport_level,
	   			          'sport_position'=>$sport_position);	
	   				   			         			   		

	   		$this->load->view('dashboard/update_profile',$data);
}

public	function updateProfile()
{  
	
	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

	$graduation_date=$this->input->post('graduation_date');
	if($graduation_date){
		$grd_data = explode(',', $graduation_date);
		$month =$grd_data[0];
		$year =$grd_data[1];
     }else{
     	$month =0;
     	$year =0;
     }

	
	$contact_arry=$this->input->post('contact_you');
	$seek_arry=$this->input->post('seek');

	$contact_id = $contact_arry[0];
	$seeking_id = $seek_arry[0];

   $contact_data = array('contact_id'=>$contact_id);
   $seek_data = array('seeking_id'=>$seeking_id);

   $seek_status = $this->user_model->updateSeekId($user_id,$seek_data);
   $contact_status = $this->user_model->updateContactId($user_id,$contact_data);
	


	 $fname=$this->input->post('fname');
	 $lname=$this->input->post('lname');

	 //$email=$this->input->post('email');
	 $gender=$this->input->post('gender');
	 $nationality=$this->input->post('nationality');

	 $dob=$this->input->post('dob');
	 $dob_array = explode("-", $dob);
	 $birth_year=$dob_array[2];
	 $birth_month=$dob_array[1];
	 $birth_day=$dob_array[0];

	 $address=$this->input->post('address');
	 $city=$this->input->post('city');
	 $state=$this->input->post('state');
	 $country=$this->input->post('country');
	 $zip_code=$this->input->post('zip_code');
	 $sport=$this->input->post('sport');
	 $level=$this->input->post('level');
	 $position=$this->input->post('position');
	 $hand=$this->input->post('hand');
	 $foot=$this->input->post('foot');

	 $height=$this->input->post('height');
	 $weight=$this->input->post('weight');	
	 $user_name=$this->input->post('username');
	 $find=$this->input->post('find');	

	$user_data=array(
                     'first_name'=>$fname,'last_name'=>$lname,'gender'=>$gender,
                     'nationality'=>$nationality,'birth_year'=>$birth_year,'birth_month'=>$birth_month,
                     'birth_day'=>$birth_day,'address'=>$address,'city'=>$city,
                     'state'=>$state,'location'=>$country,'zip'=>$zip_code,'sport'=>$sport,
                     'level'=>$level,'position_speciality'=>$position,'hand'=>$hand,'foot'=>$foot,
                     'height'=>$height,'weight'=>$weight,'find'=>$find,
                     'graduation_month'=>$month,'graduation_year'=>$year
                     );

	$username = array('login_name' =>$user_name);

	// start update personal info and objective of player
	$personal_info=$this->input->post('personal_info');
	$objective=$this->input->post('objective');
	$row = array('message' =>$personal_info,'objective'=>$objective);
	$status=$this->user_model->updatePersonalInfo($row ,$user_id);	
	//end update personal info of player


	

	$user_status = $this->user_model->updateUserName($username,$user_id);
	
	$success= $this->user_model->updateProfile($user_data,$user_id);

	if($success){			       
				$this->index();
			}
    }


}