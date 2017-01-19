<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userdetail extends CI_Controller {

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

		  	$user_details= $this->fetch_model->user_details($user_id);
		  	if($user_details==false)
				   {

				   		$nation_list = $this->fetch_model->nation();
				   		$country_list = $this->fetch_model->country();
				   		$sport_list = $this->fetch_model->sport();
				   		$hand_list = $this->fetch_model->hand();
				   		$foot_list = $this->fetch_model->foot();
				   		$height_list = $this->fetch_model->height();
				   		$weight_list = $this->fetch_model->weight();
				   		$find_list = $this->fetch_model->find();
	
				   		$data = array('title' => 'Edit Profile', 'name' => $name,
				   			          'email' => $email,'user_id'=> $user_id,'nation'=>$nation_list,
				   			          'country'=>$country_list,'sport'=>$sport_list,'hand'=>$hand_list,
				   			          'foot'=>$foot_list,'height'=>$height_list,'weight'=>$weight_list,
				   			          'find'=>$find_list
				   			          );	
				   	  	   		
					$this->load->view('dashboard/edit_profile_view',$data);
				   }
				   else{		  
						$data = array('title'=>'WeGotPlayer',
						 				'user_id'=>$user_id,'name'=>$name			 			   
								 	  );

					  		$this->load->view("dashboard/about_view",$data); 		
						  }

	  }//Index function End

	  public function selectLevel(){
		 $id=$this->input->post('id');		 
		 $level_list= $this->fetch_model->user_selectLevel($id);

			$option = '';
					 foreach($level_list as $opt){
			$option = $option.'<option value="'.$opt->levelId.'">'.$opt->levelName.'</option>';
					 }	  

		  echo $option;


	}

	public function selectPosition(){
		 $id=$this->input->post('id');		 
		 $position_list= $this->fetch_model->user_selectPosition($id);

			$option = '';
					 foreach($position_list as $opt){
			$option = $option.'<option value="'.$opt->positionId.'">'.$opt->positionName.'</option>';
					 }
		
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
		
	$contact_id=$this->input->post('contact_you');
	$seeking_id=$this->input->post('seek');

	$graduation_date=$this->input->post('graduation_date');
	$graduation_date = date("F,Y",strtotime($graduation_date)); 
	
	if($graduation_date){
		$grd_data = explode(',', $graduation_date);
		$month =$grd_data[0];
		$year =$grd_data[1];
     }else{
     	$month =0;
     	$year =0;
     }

	
	 $fname=$this->input->post('fname');
	 $lname=$this->input->post('lname');
	 //$email=$this->input->post('email');
	 $gender=$this->input->post('gender');
	 $nationality=$this->input->post('nationality');

	 $dob=$this->input->post('dob');
	

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
	 
	$find=$this->input->post('find');

	// start add personal info of player
	$personal_info=$this->input->post('personal_info');

$rules = array(
			array('field'=>'fname','label'=>'Firstname','rules'=>'trim|required'),
			array('field' => 'lname','label' => 'Lastname','rules' => 'required'),
			array('field' => 'gender','label' => 'Gender','rules' => 'required|is_natural'),
			array('field' => 'nationality','label' => 'Nationality','rules' => 'required'),
			array('field' => 'address','label' => 'Address','rules' => 'required'),
			array('field' => 'dob','label' => 'date of birth','rules' => 'required'),
			array('field' => 'city','label' => 'City','rules' => 'required'),
			array('field' => 'state','label' => 'State','rules' => 'required'),
			array('field' => 'country','label' => 'Country','rules' => 'required'),
			array('field' => 'zip_code','label' => 'Zip Code','rules' => 'required'),
			array('field' => 'sport','label' => 'sport','rules' => 'required'),
			array('field' => 'level','label' => 'level','rules' => 'required'),
			array('field' => 'position','label' => 'position','rules' => 'required'),
			array('field' => 'hand','label' => 'hand','rules' => 'required'),
			array('field' => 'foot','label' => 'foot','rules' => 'required'),
			array('field' => 'height','label' => 'height','rules' => 'required'),
			array('field' => 'weight','label' => 'weight','rules' => 'required'),
			array('field' => 'find','label' => 'find','rules' => 'required'),
			array('field' => 'contact_you','contact you' => 'Contact you','rules' => 'required'),
			array('field' => 'seek','label' => 'seeking','rules' => 'required'),
		);
	$this->form_validation->set_rules($rules);
	if($this->form_validation->run() == false)
	{				
		echo validation_errors();
	}else{
		 $dob_array = explode("-", $dob);
		 $birth_year=$dob_array[2];
		 $birth_month=$dob_array[1];
		 $birth_day=$dob_array[0];

	    $contact_data = array('user_id' =>$user_id,'contact_id'=>$contact_id);
	    $seek_data = array('user_id' =>$user_id,'seeking_id'=>$seeking_id);
		$row = array('user_id'=>$user_id,'message' =>$personal_info);	
		//end add personal info of player

		$user_data=array(
	                     'user_id'=>$user_id,'first_name'=>$fname,'last_name'=>$lname,
	                     'gender'=>$gender, 'nationality'=>$nationality,
	                     'birth_year'=>$birth_year,'birth_month'=>$birth_month,
	                     'birth_day'=>$birth_day,'address'=>$address,'city'=>$city,
	                     'state'=>$state,'location'=>$country,'zip'=>$zip_code,
	                     'sport'=>$sport,'level'=>$level,'position_speciality'=>$position,
	                     'hand'=>$hand,'foot'=>$foot,'graduation_month'=>$month,
	                     'graduation_year'=>$year,'height'=>$height,
	                     'weight'=>$weight,'find'=>$find
	                     );

		$success= $this->user_model->updateAllPersonal($user_data,$row,$contact_data,$seek_data);

		if($success){			       
					echo "home";
		}else{
			echo "<p>Problem in Update . Please Try with fill all detail . </p>";
		}
		
		}
	}//else end of form validation


/*public	function updatePersonal()
{
	if (!$this->session->userdata('logged_in'))
	   {
		    //If no session, redirect to login page
			redirect('user', 'refresh');
				exit();
		}
		$session_data = $this->session->userdata('logged_in');
		$user_id=$session_data['user_id'];
		
	$contact_id=$this->input->post('contact_you');
	$seeking_id=$this->input->post('seek');

	$graduation_date=$this->input->post('graduation_date');
	if($graduation_date){
		$grd_data = explode(',', $graduation_date);
		$month =$grd_data[0];
		$year =$grd_data[1];
     }else{
     	$month =0;
     	$year =0;
     }

	
	 $fname=$this->input->post('fname');
	 $lname=$this->input->post('lname');
	 //$email=$this->input->post('email');
	 $gender=$this->input->post('gender');
	 $nationality=$this->input->post('nationality');

	 $dob=$this->input->post('dob');
	

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
	 
	$find=$this->input->post('find');

	// start add personal info of player
	$personal_info=$this->input->post('personal_info');

$rules = array(
			array('field'=>'fname','label'=>'Firstname','rules'=>'trim|required'),
			array('field' => 'lname','label' => 'Lastname','rules' => 'required'),
			array('field' => 'gender','label' => 'Gender','rules' => 'required|is_natural'),
			array('field' => 'nationality','label' => 'Nationality','rules' => 'required'),
			array('field' => 'address','label' => 'Address','rules' => 'required'),
			array('field' => 'dob','label' => 'date of birth','rules' => 'required'),
			array('field' => 'city','label' => 'City','rules' => 'required'),
			array('field' => 'state','label' => 'State','rules' => 'required'),
			array('field' => 'country','label' => 'Country','rules' => 'required'),
			array('field' => 'zip_code','label' => 'Zip Code','rules' => 'required'),
			array('field' => 'sport','label' => 'sport','rules' => 'required'),
			array('field' => 'level','label' => 'level','rules' => 'required'),
			array('field' => 'position','label' => 'position','rules' => 'required'),
			array('field' => 'hand','label' => 'hand','rules' => 'required'),
			array('field' => 'foot','label' => 'foot','rules' => 'required'),
			array('field' => 'height','label' => 'height','rules' => 'required'),
			array('field' => 'weight','label' => 'weight','rules' => 'required'),
			array('field' => 'find','label' => 'find','rules' => 'required'),
			array('field' => 'contact_you','contact you' => 'Contact you','rules' => 'required'),
			array('field' => 'seek','label' => 'seeking','rules' => 'required'),
		);
	$this->form_validation->set_rules($rules);
	if($this->form_validation->run() == false)
	{				
		echo validation_errors();
	}else{
		 $dob_array = explode("-", $dob);
		 $birth_year=$dob_array[2];
		 $birth_month=$dob_array[1];
		 $birth_day=$dob_array[0];

	    $contact_data = array('user_id' =>$user_id,'contact_id'=>$contact_id);
	    $seek_data = array('user_id' =>$user_id,'seeking_id'=>$seeking_id);

		$seek_status=$this->user_model->insertSeekId($seek_data);
   		$contact_status =$this->user_model->insertContactId($contact_data);

		$row = array('user_id'=>$user_id,'message' =>$personal_info);
		$this->user_model->playerPersonal($row);
		//end add personal info of player

		$user_data=array(
	                     'user_id'=>$user_id,'first_name'=>$fname,'last_name'=>$lname,
	                     'gender'=>$gender, 'nationality'=>$nationality,
	                     'birth_year'=>$birth_year,'birth_month'=>$birth_month,
	                     'birth_day'=>$birth_day,'address'=>$address,'city'=>$city,
	                     'state'=>$state,'location'=>$country,'zip'=>$zip_code,
	                     'sport'=>$sport,'level'=>$level,'position_speciality'=>$position,
	                     'hand'=>$hand,'foot'=>$foot,'graduation_month'=>$month,
	                     'graduation_year'=>$year,'height'=>$height,'weight'=>$weight,'find'=>$find
	                     );

		$success= $this->user_model->playerRecord($user_data);


		if($success){			       
					echo "home";
				}
		
		}
	}//else end of form validation*/

 public function updateBasic(){
 	if (!$this->session->userdata('logged_in'))
	   {
		    //If no session, redirect to login page
			redirect('user', 'refresh');
				exit();
		}
		$session_data = $this->session->userdata('logged_in');
		$user_id=$session_data['user_id'];

		 $seeking=$this->input->post('seeking');
		 $name=$this->input->post('name');
		 $name_arry = explode(' ', $name);
		 $fname = $name_arry['0'];
		 $lname = $name_arry['1'];


	$graduation_date=$this->input->post('graduation_date');
	if($graduation_date){
		$grd_data = explode(',', $graduation_date);
		$month =$grd_data[0];
		$year =$grd_data[1];
     }else{
     	$month =0;
     	$year =0;
     }


 	 $dob = $this->input->post('dob');
	 $address = $this->input->post('b_address');	
	 $city = $this->input->post('city');
	 $state = $this->input->post('state');
	 $zip_code = $this->input->post('zip_code');
	 $country = $this->input->post('country');
	
 	 $sport = $this->input->post('sport');
 	 $position = $this->input->post('position');
 	 $hand = $this->input->post('hand');
 	 $foot = $this->input->post('foot');
	 $level = $this->input->post('level');
	 $nationality = $this->input->post('nationality');	
	 $height = $this->input->post('height');
	 $weight = $this->input->post('weight');


	 $dob_array = explode("-", $dob);
		 $birth_year=$dob_array[2];
		 $birth_month=$dob_array[1];
		 $birth_day=$dob_array[0];



	$data=array( 'first_name'=>$fname,'last_name'=>$lname,
				 'birth_year'=>$birth_year,'birth_month'=>$birth_month,
	              'birth_day'=>$birth_day,'address'=>$address,'sport'=>$sport,
	              'level'=>$level,'height'=>$height,'weight'=>$weight,
	              'nationality'=>$nationality,'location'=>$country,
	              'zip'=>$zip_code,'city'=>$city,'state'=>$state,
	              'foot'=>$foot,'hand'=>$hand,'position_speciality'=>$position,
	              'graduation_month'=>$month,'graduation_year'=>$year
	      );
	$seek_data = array('seeking_id'=>$seeking);

    $this->user_model->updateSeekId($user_id,$seek_data);

		$success= $this->user_model->updateBasicRecord($user_id,$data);
		

				 redirect('home');
		
 }

	 public function updatePersonalInfo(){
	 	if (!$this->session->userdata('logged_in'))
	   {
		    //If no session, redirect to login page
			redirect('user', 'refresh');
				exit();
		}
		$session_data = $this->session->userdata('logged_in');
		$user_id=$session_data['user_id'];
	 	$personal_info=$this->input->post('personal_info');	
		$row = array('message' =>$personal_info);
		$status=$this->user_model->updatePersonalInfo($row,$user_id);	
		if($status)
		{	
			redirect('home');
		}
	}

}