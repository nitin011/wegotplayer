<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front_friend_controller extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
	    $this->load->library(array('form_validation','session'));
		//$this->load->library('encrypt');
		$this->load->model('friend_model');	
		$this->load->model('notification_model');
		
	 }
	    

	// Start Show Friends Dashboard
	public function showFriendView()
	{
	          $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];

			$friend_list = $this->friend_model->getFriends($user_id);
			if($friend_list){			
				$data = array('friends' =>$friend_list,'user_id'=>$user_id); 
				$this->load->view('front/friend_list_view',$data);                                    
             }else{
             	echo "<li>No Friends Found </li>";
             }          
            
    }// End Show Friends Dashboard

	



	// Start Friends Request List for header
	public function friendRequestList()
	{
		      $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];

			$req_list = $this->friend_model->getRequestList($user_id);	

			if(!$req_list){		
				       echo $data="<li>No friend request pending.</li>";   

			               }else{
			               	 $data='';
                         foreach ($req_list as $rowdata) {
				       //	print_r($rowdata);
				         $image_url=$rowdata['pic_url'];
				         if ($image_url!='') {
							   $image_url=$image_url;
							} else {
							   $image_url=base_url().'images/sports-football.png';
							}
				         $friend_name=ucwords($rowdata['user']->name);
				
				         $sport_name=ucwords($rowdata['sport']->sport);
				         $friend_id= $rowdata['friend_id'];

				        
				        $data.="<li id=\"friend_row_$friend_id\">";
				        $data.="<div class=\"md-list-addon-element\"><img class=\"md-user-image md-list-addon-avatar\" src=\"$image_url\" alt=\"\"/></div>";
				        $data.="<div class=\"md-list-content\"><span class=\"md-list-heading md-list-heading-adept\"><a>$friend_name</a></span><span class=\"uk-text-small uk-text-muted uk-text-muted-adept\">$sport_name</span></div>";
                        
                        $data.="<div class=\"friend_list\"><button onclick=\"addFriend($friend_id)\" type=\"button\" class=\"add_button md-btn md-btn-primary adept-md-btn-primary\"><i class=\"material-icons md-24 md-light\">&#xE7FE;</i></button></div>";
                        $data.="</li>";
                                } 
                         echo $data;
                 }


	}// Start Friends Request List for header

	// Start Check Email 
	public function checkEmailRegistered()
	{
		   $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];
		    $email = $this->input->post('email');
		 
		    $status = $this->friend_model->checkEmail($email);
		    if($status){
		    	echo 1;
		    }else{
		    	echo 0;
		    }
	 }// End Check Email 

	// Start Send Friend Request
	 public function sendRequest()
	 {
	 	 	$session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];

		    $email = $this->input->post('email');

		    $status = $this->friend_model->getFriendDetail($email);
		    if($status){
		    	$friend_id= $status->user_id;
		    	$data = array(
		    					'user_id' =>$user_id,'friend_id'=>$friend_id
		    				 );
		    	$req_sent = $this->friend_model->sendFriendRequest($data);
		    	if($req_sent){
		    		return true;
		    	}else{
		    		return false;
		    	}

		    	//set notification data  for setting
		    	$noti_status=$this->notification_model->setNotiFriendRequest($data);
		    	
		    	//end notification setting

		    }
	 }//End Send Friend Request


	 // Start Send Friend Request
	 public function sendFriendRequest()
	 {
	 	 	$session_data = $this->session->userdata('user_exist');
		     $user_id=$session_data['user_id'];

		    $friend_id = $this->input->post('friend_id');
		    
		    
		    $data = array(
		    			'user_id' =>$user_id,'friend_id'=>$friend_id
		    			);
		    $req_sent = $this->friend_model->sendFriendRequest($data);
		    	if($req_sent){
		    		echo 1;
		    	}else{
		    		echo 0;
		    	}
		    //set notification data for setting
		    $this->notification_model->setNotiFriendRequest($data);
		    //end notification setting

	 }//End Send Friend Request

	 public function acceptRequest(){
	 		$session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];

			$friend_id = $this->input->post('friend_id');
			//$data = array('friend_id'=>$friend_id);

			$status = $this->friend_model->acceptRequest($friend_id,$user_id);
			if($status){
				echo 1;
					//set notification data for setting
		    		$this->notification_model->setNotiAcceptRequest($user_id,$friend_id);
		    		//end notification setting
			}else{
				echo 0;
			}
	   }// End Accept Request

	   



  }//End of  Friend Controller Class