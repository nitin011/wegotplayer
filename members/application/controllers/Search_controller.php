<?php 

class Search_controller extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
	    $this->load->library(array('form_validation','session'));
		//$this->load->library('encrypt');
		$this->load->model('search_model');
		$this->load->model('profile_model');
		$this->load->model('notification_model');	
		

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

	  public function searchUser()
	  {
	  	$field = $this->input->post('field');
	  	if(isset($field)){  

	  		  $search_data =$this->search_model->searchUser($field);
	  		  if($search_data){	  		  	
	  		  	$data  ='';
	  		  	$data.="<ul id=\"search_data\" class=\"item\">";
	  		  	foreach ($search_data as $key=>$value) { 
					$data.="<li id=\"search_item_$key\" onclick=\"selectName($key)\" class=\"search_item\">$value->name
					        <input type=\"hidden\" id=\"field_$key\" value=\"$value->login_name\" ></li>";
						
	  		    }
	  		    $data.="</ul>";

	  		  	echo $data;

	  		  }else{
	  		  	echo "<ul class=\"item\"><li class=\"search_item\">";	  		  	
	  		  	echo "User not found ! Search by another name / email / username .</li></ul>";
	  		  }

	  	  }	  	 
	  	}

  public function searchView()
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
		  	$dp_url = $session_data['dp_url'];
		  	//geting pending friend request count 
		  	$f_count=$this->getPendingReqestCount($user_id);
		  	//geting unread mail count 
		  	$m_count=$this->getUnreadMailCount($user_id);

		  	$n_count = $this->getPendingNotificationCount($user_id);


		  
			$user_data= array('title'=>'WeGotPlayer','f_count'=>$f_count,
							  'm_count'=>$m_count,'n_count'=>$n_count,'acc_type'=>$acc_type,
							  'email'=>$email,'user_id'=>$user_id,'name'=>$name);
		
		$sport_list = $this->search_model->sportList();
		$hand_list = $this->search_model->handList();
		$foot_list = $this->search_model->footList();
		$height_list = $this->search_model->heightList();
		$weight_list = $this->search_model->weightList();
		$seek_list = $this->search_model->getSeeking();
		$nation_list = $this->search_model->nationList();
		$country_list = $this->search_model->countryList();		

		$data = array('sport' => $sport_list,
			          'hand'=>$hand_list,
			          'foot'=>$foot_list,
			          'weight'=>$weight_list,
			          'height'=>$height_list,
			          'seeking'=>$seek_list,
			          'country'=>$country_list,
			          'nation'=>$nation_list);
		$this->load->view("header-home",$user_data);

		$this->load->view('recruiter/search_advance',$data);
	}

   public function player()
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
		  	$dp_url = $session_data['dp_url'];
		  	//geting pending friend request count 
		  	$f_count=$this->getPendingReqestCount($user_id);
		  	//geting unread mail count 
		  	$m_count=$this->getUnreadMailCount($user_id);

		  	$n_count = $this->getPendingNotificationCount($user_id);


		  
			$user_data= array('title'=>'WeGotPlayer','f_count'=>$f_count,
							  'm_count'=>$m_count,'n_count'=>$n_count,'acc_type'=>$acc_type,
							  'email'=>$email,'user_id'=>$user_id,'name'=>$name);
		
		$sport_list = $this->search_model->sportList();
		$hand_list = $this->search_model->handList();
		$foot_list = $this->search_model->footList();
		$height_list = $this->search_model->heightList();
		$weight_list = $this->search_model->weightList();
		$seek_list = $this->search_model->getSeeking();
		$nation_list = $this->search_model->nationList();
		$country_list = $this->search_model->countryList();		

		$data = array('sport' => $sport_list,
			          'hand'=>$hand_list,
			          'foot'=>$foot_list,
			          'weight'=>$weight_list,
			          'height'=>$height_list,
			          'seeking'=>$seek_list,
			          'country'=>$country_list,
			          'nation'=>$nation_list);
	$this->load->view("header-incomplete",$user_data);	

		$this->load->view('recruiter/search_advance',$data);
	}


	 public function searchUserByName()
	 {
	  	$name = $this->input->post('name');

	  	if(isset($name)){  

	  		  $search_data =$this->search_model->searchUserByName($name);
	  		 
	  		  $data = "<div class=\"md-card\"><div class=\"md-card-content search_list tx-md-card-content-adept\"><h3>Search Results : $name</h3>";
	  		
	  		  if($search_data){	
	  		 	 foreach ($search_data as $key => $row) {
	  		 	 	 
				      $user_id = $row->user_id;
				      $u_name = ucwords($row->name);
				      $email = $row->email;
				      $username = $row->login_name;
				      $url=base_url()."profile/".$username;
					  $dp_url = $this->profile_model->getProfileImage($user_id);

		$data .= "<a href=\"$url\"><div class=\"md-card-head search_profile friend_box_black\" id=\"search_profile\"><div class=\"uk-text-center\">";
		$data .= "<img alt=\"$u_name\" src=\"$dp_url\" class=\"md-card-head-avatar\"></div><h3 class=\"md-card-head-text uk-text-center uk_adept_main\">";
        $data .= "$u_name<span></span> </h3></div></a>";                     
      	}
	  $data .= "</div></div>";
	  echo $data;  	
	  	  }

	    }

   }
	 public function advanceSearch()
	 { 
	 	
	 	$name = $this->input->post('name');
	 	$sport = $this->input->post('sport');
	 	$level = $this->input->post('level');
	 	$gender = $this->input->post('gender');
	 	$position = $this->input->post('position');
	 	$hand = $this->input->post('hand');
	 	$foot = $this->input->post('foot');
	 	$min_age = $this->input->post('min_age');
	 	$max_age = $this->input->post('max_age');

	 	$min_height = $this->input->post('min_height');
	 	$max_height = $this->input->post('max_height');

	 	$min_weight = $this->input->post('min_weight');
	 	$max_weight = $this->input->post('max_weight');

	 	$country = $this->input->post('country');
	 	$nationality = $this->input->post('nationality');
	 	$seeking = $this->input->post('seeking');

	 	$row = array('first_name' => $name,'sport'=>$sport ,'level'=>$level,'gender'=>$gender,
	 				 'position_speciality'=>$position,'hand'=>$hand,'foot'=>$foot,
	 				 'nationality'=>$nationality,'location'=>$country,
	 				 'min_age'=>$min_age,'max_age'=>$max_age,
	 				 'max_height'=>$max_height,'min_height'=>$min_height,
	 				 'min_weight'=>$min_weight,'max_weight'=>$max_weight);	
        	
	 	
	    $search_result =$this->search_model->advanceSearch($row);	    	
	   


	 	$data = "<div class=\"md-card\"><div class=\"md-card-content search_list tx-md-card-content-adept\"><h3>Search Results within your Criteria</h3>";
	  		
	  		  if($search_result){	
	  		 	 foreach ($search_result as $key => $row) {
	  		 	 	 
				      $user_id = $row->user_id;
				      $user_detail = $this->getUserDetail($user_id);
				    
				      if($user_detail){				      
				      	$u_name = ucwords($user_detail['0']->name);
				      	$email = $user_detail['0']->email;
				     	$username = $user_detail['0']->login_name;
				      	$url=base_url()."profile/".$username;
					  	$dp_url = $this->profile_model->getProfileImage($user_id);

			$data .= "<a href=\"$url\"><div class=\"md-card-head search_profile friend_box friend_box_black\" id=\"search_profile\"><div class=\"uk-text-center\">";
			$data .= "<img alt=\"$u_name\" src=\"$dp_url\" class=\"md-card-head-avatar\"></div><h3 class=\"md-card-head-text uk-text-center uk_adept_main\">";
        	$data .= "$u_name<span></span> </h3></div></a>";   
        	}                  
      	}
	  $data .= "</div></div>";
	  echo $data;  	
	  	 
	    	}else{
	    		echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Oops ! No Search Result within Criteria.</h3>";
	    	}

	 	
	 }

	 public function getUserDetail($user_id)
	 {
	 		return $user =$this->search_model->getUserDetail($user_id);	
	 }

	 public function searchBySport(){
	 	 $ids = $this->input->post('ids');
	 	if($ids!=''){
	 		$sport =array();
	 		foreach ($ids as $key => $value) {
	 	 	 	array_push($sport,$value);
	 		}	 		
	 	}
	 	$name = $this->input->post('name');	 	
	 	if($ids!=''){
	 		$search_result =$this->search_model->advanceSearchSportName($name,$sport);	 		
	    }else{
	    	$search_result =$this->search_model->searchUserByName($name);	    	
	    }
	    $data = "<div class=\"md-card\"><div class=\"md-card-content search_list tx-md-card-content-adept\"><h3>Search Results within your Criteria</h3>";
	  		
	  		  if($search_result){	
	  		 	 foreach ($search_result as $key => $row) {
	  		 	 	 
				      $user_id = $row->user_id;
				      $user_detail = $this->getUserDetail($user_id);
				    
				      if($user_detail){				      
				      	$u_name = ucwords($user_detail['0']->name);
				      	$email = $user_detail['0']->email;
				     	$username = $user_detail['0']->login_name;
				      	$url=base_url()."profile/".$username;
					  	$dp_url = $this->profile_model->getProfileImage($user_id);

			$data .= "<a href=\"$url\"><div class=\"md-card-head search_profile friend_box friend_box_black\" id=\"search_profile\"><div class=\"uk-text-center\">";
			$data .= "<img alt=\"$u_name\" src=\"$dp_url\" class=\"md-card-head-avatar\"></div><h3 class=\"md-card-head-text uk-text-center uk_adept_main\">";
        	$data .= "$u_name<span> </span> </h3></div></a>";   
        	}                  
      	}
	  $data .= "</div></div>";
	  echo $data;  	
	  	 
	    	}else{
	    		echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Oops ! No Search Result within Criteria.</h3>";
	    	}



	 } 

	  public function getPendingReqestCount($user_id){
			$pending_frd_req = $this->notification_model->getPendingRequestCount($user_id);
		  			if($pending_frd_req){		  			
		  				return $f_count=$pending_frd_req;
		  			}else{
		  				return $f_count=0;
		  			}
		}


	  public function getUnreadMailCount($user_id){
			$unread_mail_count = $this->notification_model->getUnreadMailCount($user_id);
			if($unread_mail_count){		  			
		  				return $m_count=$unread_mail_count;
		  			}else{
		  				return $m_count=0;
		  			}	
		}

		public function	getPendingNotificationCount($user_id){
		$pending_noti_count = $this->notification_model->getPendingNotificationCount($user_id);
			if($pending_noti_count){		  			
		  				return $n_count=$pending_noti_count;
		  			}else{
		  				return $n_count=0;
		  			}
		}

} ?>