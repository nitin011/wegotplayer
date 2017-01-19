<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userschool extends CI_Controller {

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
		  
		  	$user_details= $this->fetch_model->school_details($user_id);
		  	if($user_details==false)
				   {
				   		$data= array('user_id'=>$user_id);
				   		$this->load->view("school/edit_school",$data); 
				   }
			else{			
	  			$this->load->view("school/school_view",$user_details); 		
		  	}

	  }//Index function End


	  public function updateSchool()
	  {	  
	  if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

	  	 //$user_id        =$this->input->post('user_id');
		 $schoolname     =$this->input->post('schoolname');
		 $graduation_date=$this->input->post('graduation_date');
		 $act_score      =$this->input->post('act_score');
		 $overall_gpa	 =$this->input->post('overall_gpa');
		 $enrolment_date =$this->input->post('enrolment_date');
		 $college_credits=$this->input->post('college_credits');
		 $school_phone   =$this->input->post('school_phone');
		 $school_location=$this->input->post('school_location');
		 $house_reg      =$this->input->post('house_reg');
		 $schooltype     =$this->input->post('schooltype');
		 $sat_score      =$this->input->post('sat_score');
		 $toefl          =$this->input->post('toefl');
		 $class_rank     =$this->input->post('class_rank');
		 $college_major	 =$this->input->post('college_major');
		 $counselor_name =$this->input->post('counselor_name');
		 $school_website =$this->input->post('school_website');
		 $academic_goal  =$this->input->post('academic_goal');

		 $school_data=array(
                     'wgp_user_id'=>$user_id,'school_name'=>$schoolname,
                     'high_school_graduation_date'=>$graduation_date,
                     'college_enrolment_date'=>$enrolment_date,
                     'potential_college_major'=>$college_major,
                     'high_school_counselor'=>$counselor_name,
                     'overall_set_score'=>$sat_score,'overall_act_score'=>$act_score,
                     'toefl'=>$toefl,'overall_gpa'=>$overall_gpa,
                     'class_ranked'=>$class_rank,'academic_goals'=>$academic_goal,
                     'transferable_college_credits'=>$college_credits,'clearing_house'=>$house_reg,
                     'school_type'=>$schooltype,'school_phone'=>$school_phone,
                     'school_location'=>$school_location,'school_website'=>$school_website
                     );

			 $success= $this->user_model->schoolRecord($school_data);

			if($success){			       
				redirect('home');
				exit;
			}		 	
	    }

	  public function editSchool()
	  { 
	  	 $user_id        =$this->input->post('user_id');
		 $schoolname     =$this->input->post('high_school');
		 $graduation_date=$this->input->post('graduation_date');
		 $act_score      =$this->input->post('act_score');
		 $overall_gpa	 =$this->input->post('overall_gpa');
		 $enrolment_date =$this->input->post('enrolment_date');
		 $college_credits=$this->input->post('college_credit');
		 $school_phone   =$this->input->post('school_phone');
		 $school_location=$this->input->post('school_loaction');
		 $house_reg      =$this->input->post('house_reg');
		 $schooltype     =$this->input->post('schooltype');
		 $sat_score      =$this->input->post('sat_score');
		 $toefl          =$this->input->post('toefl');
		 $class_rank     =$this->input->post('class_rank');
		 $college_major	 =$this->input->post('college_major');
		 $counselor_name =$this->input->post('counselor_name');
		 $school_website =$this->input->post('school_website');
		 $academic_goal  =$this->input->post('academic_goals');

		 $school_data=array(
                     'school_name'=>$schoolname,
                     'high_school_graduation_date'=>$graduation_date,
                     'college_enrolment_date'=>$enrolment_date,
                     'potential_college_major'=>$college_major,
                     'high_school_counselor'=>$counselor_name,
                     'overall_set_score'=>$sat_score,'overall_act_score'=>$act_score,
                     'toefl'=>$toefl,'overall_gpa'=>$overall_gpa,
                     'class_ranked'=>$class_rank,'academic_goals'=>$academic_goal,
                     'transferable_college_credits'=>$college_credits,'clearing_house'=>$house_reg,
                     'school_type'=>$schooltype,'school_phone'=>$school_phone,
                     'school_location'=>$school_location,'school_website'=>$school_website
                     );
		
		 $success= $this->user_model->updateSchool($school_data,$user_id);
		 if($success){			       
				redirect('home');
				exit;
			}
	  	
	  }	


}