<?php 

class Front_photo extends CI_Controller {

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
		$this->load->model('photo_model');

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

	public function photoView(){
		if (!$this->session->userdata('user_exist'))
		        {
		          //If no session, redirect to login page
		           redirect('user', 'refresh');
		           exit();
		        }
		      $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];

		$privacy_data = $this->profile_model->getPrivacyData($user_id,7);
		 if($privacy_data){
		      if($privacy_data->anyone==1)
			  {
				 $this->getUserPhoto();
			  }
			  if($privacy_data->nobody==1){
			  		echo "<h4>Photos </h4><h3 class=\"heading_b heading_b_c uk-margin-bottom\"> You are not authorize to view this information !</h3>";
			  }
		  if($privacy_data->friends==1){
		  	    $session_user = $this->session->userdata('logged_in');
				$session_profile = $this->session->userdata('user_exist');

				if($session_user && $session_profile)
				{
							$user_user_id = $session_user['user_id'];
							$profile_user_id = $session_profile['user_id'];

							$id_arry = array('user_id' =>$user_user_id ,
								             'friend_id'=>$profile_user_id); 
                    $check_friendship=$this->profile_model->checkFriendShip($id_arry);
			      if($check_friendship){
			      		$this->getUserPhoto();
			      }

		  		}else{
		  			echo "<h4>Photos </h4>";
		  			$this->loginView();
		  		}
		  }
		  if($privacy_data->members==1){			  		
		  		$session_user = $this->session->userdata('logged_in');

	 		if($session_user){ 							
					
	 			$profile_user_id = $session_user['user_id'];
	 			$check_membership = $this->profile_model->checkMemberShip($profile_user_id);
	 			if($check_membership){
	 				$this->getUserPhoto();
	 			}else{	
	 			   echo "<h4>Photos </h4>";	  		
	  		       echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Your are not member(recruiter) , Please register yourself !</h3>";
	  		       $this->loginView();
	  		     } 			
	 		}else{	
	 		    echo "<h4>Photos </h4>";	  		
	  		    $this->loginView();
	  		}
		  }
	  if($privacy_data->code_receivers==1)
	  {
	  	    if(isset($session_data['privacy_code']))
	  			{	//rechecking privacy code
	  				  $data = array('user_id' => $user_id,'unique_code' =>$session_data['privacy_code']);
				      $verify_status = $this->profile_model->verifyCode($data);

      				if($verify_status){
	  					$this->getUserPhoto();
	  				}else{
	  					    echo "<h4>Photos </h4>";
	      					$this->load->view('front/privacy_code_view');
	      			    }
	  			}else{
	  				echo "<h4>Photos </h4>";
	      			$this->load->view('front/privacy_code_view');
	      		}
	 	 }
	 	}else{
	 		echo "<h4>Photos </h4><h3 class=\"heading_b heading_b_c uk-margin-bottom\">Profile Privacy  still not set</h3>";
	 	}

       }

       public function getPhotoFolder(){
       		if (!$this->session->userdata('user_exist'))
		        {
		          //If no session, redirect to login page
		           redirect('user', 'refresh');
		           exit();
		        }
		      $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];

		      $folder = $this->photo_model->getAlbum($user_id);	      

		      if($folder){
		      	$data = array('folder' =>$folder);
		      	$this->load->view("front/photo_folder_view",$data);
		      }
       }

      public function getFolderImages(){
      		if (!$this->session->userdata('user_exist'))
		        {
		          //If no session, redirect to login page
		           redirect('user', 'refresh');
		           exit();
		        }
		      $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];

		      $folder_id= $this->input->post('folder_id');	
			//fetch image in the folder.
			$image_result=$this->photo_model->getImage($folder_id);
            $image_data=array('image_result'=>$image_result,'folder_id'=>$folder_id,'user_id'=>$user_id);
			
			$this->load->view('front/image_list',$image_data);
      }

      public function getUserPhoto(){

      	if (!$this->session->userdata('user_exist'))
		        {
		          //If no session, redirect to login page
		           redirect('user', 'refresh');
		           exit();
		        }
		      $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];

         /* Getting  photo folder*/

		 //get all images of users 
		  $image_list=$this->photo_model->getAllImage($user_id);

		  $data = array('image_list'=>$image_list);
		 
		  $this->load->view('front/front_image_view',$data);



		}

  } ?>
