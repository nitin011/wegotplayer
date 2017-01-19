<?php 

class Front_wall extends CI_Controller {

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
		$this->load->model('user_post');

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

  public function wallPost()
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
		    
			//fetch total posts of the login user
			$total_posts  = $this->user_post->total_posts($user_id);
			$user_data= array('title'=>'WeGotPlayer',
							  'email'=>$email,'user_id'=>$user_id,'name'=>$name,'total_posts'=>$total_posts);
							  
							  
			//$this->load->view("header-home",$user_data);
			//$this->load->view("sidebar");
	  		$this->load->view("front/front_wall_post",$user_data);
	  		//$this->load->view("footer"); 

	  }

	  public function loginView()
	  {
	  	   $this->load->view('front/login_view');
	  }

	public function wallView(){
		if (!$this->session->userdata('user_exist'))
		        {
		          //If no session, redirect to login page
		           redirect('user', 'refresh');
		           exit();
		        }
		      $session_data = $this->session->userdata('user_exist');
		      $user_id=$session_data['user_id'];

		      $privacy_data = $this->profile_model->getWallPrivacy($user_id);
		      //print_r($privacy_data);
		      if($privacy_data){
		      
		      if($privacy_data->anyone==1)
			  {
				 //echo "<div class=\"md-card-toolbar\"><h3 class=\"md-card-toolbar-heading-text\"> wallView </h3></div>";
			  		$this->wallPost();
			  }
			  if($privacy_data->nobody==1){
			  		echo "<div class=\"md-card-toolbar\"><h3 class=\"md-card-toolbar-heading-text\"> You are not authorize to view this information !</h3></div>";
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
			      	 echo "<div class=\"md-card-toolbar\"><h3 class=\"md-card-toolbar-heading-text\"> wallView </h3></div>";
			      }

		  		}else{

		  			$this->loginView();
		  		}
		  }
		  if($privacy_data->members==1){			  		
		  		$session_user = $this->session->userdata('logged_in');

	 		if($session_user){ 							
					
	 			$profile_user_id = $session_user['user_id'];
	 			$check_membership = $this->profile_model->checkMemberShip($profile_user_id);
	 			if($check_membership){
	 				$this->wallPost();
	 				//echo "<div class=\"md-card-toolbar\"><h3 class=\"md-card-toolbar-heading-text\"> wallView </h3></div>";
	 			}else{		  		
	  		       echo "<div class=\"md-card-toolbar\"><h3 class=\"md-card-toolbar-heading-text\"> Your are not member(recruiter) , Please register yourself !</h3></div>";
	  		       $this->loginView();
	  		     } 			
	 		}else{		  		
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
      					$this->wallPost();
	  					//echo "<div class=\"md-card-toolbar\"><h3 class=\"md-card-toolbar-heading-text\"> wallView </h3></div>";
	  				}else{
	      					$this->load->view('front/privacy_code_view');
	      			    }
	  			}else{
	      			$this->load->view('front/privacy_code_view');
	      		}
	 	 }
	 	}else{
	 		echo "<div class=\"md-card-toolbar\"><h3 class=\"md-card-toolbar-heading-text\"> Profile Privacy  still not set</h3></div>";
	 	}

       }

       public function fetchData()
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
			$group_no  = $this->input->post('group_no');
		   
			//fetch last 10 posts with their comments of the login user
			$Success  = $this->user_post->fetch_posts($user_id,$group_no);
			echo $Success;
			
			

	}
	
	public function checkData()
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
			
			$total_old_posts  = $this->input->post('total_posts');
		    $user_id_from_post  = $this->input->post('user_id');
			
			if($user_id!=$user_id_from_post){
					echo "Some error occur in the connection. Kindly refresh the page";			
			}else{
			//fetch new posts with their comments of the login user within 5 min
			$Success  = $this->user_post->fetch_new_posts($user_id,$total_old_posts);
			echo $Success;
			}
			

	}
	
	public function add_parent_post()
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
			$dp_url=$session_data['dp_url'];
		    
			$post_text  = $this->input->post('post_text');
			$user_id_from_post  = $this->input->post('user_id');
			
			if($post_text==''||$post_text==NULL){
			echo $error=1;
			exit;
			}
			
			if($user_id!=$user_id_from_post){
			echo $error=2;
			exit;
			}
			date_default_timezone_set("Asia/Kolkata"); 
			$post_date=date('Y-m-d H:i:s');							
			$Data= array(   'parent_post'  => 0,
					        'user_id'      => $user_id,
						    'poster_id'    => $user_id,						   
						    'content'      => base64_encode(strip_tags($post_text)),				   					   
					    );   
	 
			//insert parent post data in the database			
			$Success  = $this->user_post->add_parent_post($Data);
			if(!$Success){
			echo $error=2;
			exit;
			}else{
			//fetch commenter picture from the database	
			
			$parent_post_id=$Success;
			//encode the parent_post_id
					
			$data='<div class="uk-width-medium-player" id="div_'.$parent_post_id.'">
				        <ul class="got_players_wall">
				        	<li class="got-pl-left">
				        		<div class="sqil-profile">
								 <img class="img_thumb" src="'.base_url().$dp_url.'" alt="Profile Image">
								</div>
				        	</li>
				        	<li class="got-pl-right">
				        		<div class="all-dtls-sqil">
								  <span><a href="/">'.$name.'</a> <i>'.$post_date.'</i></span> 
								  <a onclick="delete_post('.$parent_post_id.')" class="icon_dlt icon_dlt_red"><i class="material-icons tedo"></i></a>
								  <a onclick="edit_post('.$parent_post_id.')" class="icon_dlt icon_dlt_green"><i class="material-icons tedo"></i></a>	
								  <div id="post_value_'.$parent_post_id.'"><p>'.strip_tags($post_text).'</p></div> 							  
								  <ul class="all-mini-dtls" id="sub_comments_'.$parent_post_id.'"></ul>
							      <ul class="post_cmnt_dashboard">
								    <li class="dshbrd-post-cmnt">
										<input type="text"  name="comment_value" id="comment_value_'.$parent_post_id.'" value="" placeholder="Write a comment">
										<input type="hidden"  name="post_user_id" id="post_user_id_'.$parent_post_id.'" value="'.$user_id.'">
									</li>
							        <li class="dshbrd-post-cmnt-right"><div class="comment_loader" id="comment_loader_'.$parent_post_id.'" style="display:none"><img src="'.base_url().'images/loader.gif" alt="loading..."></div><input type="button" name="submit_comment" id="submit_comment_'.$parent_post_id.'" onclick="add_comment('.$parent_post_id.')" value="Post"></li>
							      </ul>
								  <span class="parsley-errors-list" id="comment_error_'.$parent_post_id.'"></span>
								</div>
				        	</li>
				        </ul>    
			        </div>';
					
					
			echo $data;
			
			}

	    }
	  	 


    public function delete_parent_post()
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
		
		$user_id  = $this->input->post('user_id');
		$post_id  = $this->input->post('post_id');
		
		
		//check that user has right to delete it			
		$master  = $this->user_post->post_master($user_id,$post_id);
		if(!$master){
			echo $error=2;
			exit;
		}else{
			//delete the post
			$delete  = $this->user_post->delete_parent_post($post_id);
			if(!$delete){
				echo $error=3;
				exit;
			}else{
				echo 'post_deleted';
				exit;
			}
		}
		

	}
	
    public function edit_parent_post()
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
			$dp_url=$session_data['dp_url'];
		    
			$post_text  = $this->input->post('post_text');
			$post_id  = $this->input->post('post_id');
			if($post_text==''||$post_text==NULL){
			echo $error=1;
			exit;
			}
            if($post_id==''||$post_id==NULL){
			echo $error=3;
			exit;
			}			
			
			//check that user has right to delete it			
			$master  = $this->user_post->post_master($user_id,$post_id);
			if(!$master){
				echo $error=2;
				exit;
			}else{
				   //update parent post data in the database			
					$post_text_encoded=base64_encode(strip_tags($post_text));
					$Success  = $this->user_post->edit_parent_post($post_text_encoded,$post_id);
					if(!$Success){
					echo $error=3;
					exit;
					}else{								
					$data='<p>'.strip_tags($post_text).'</p>';					
					echo $data;					
					}

			}
			
	}
	  	 

    public function add_comment()
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
			$dp_url=$session_data['dp_url'];
			
		    $post_id  = $this->input->post('post_id');
			$post_user_id  = $this->input->post('post_user_id');
			$post_commenter_id  = $this->input->post('post_commenter_id');
			$comment_text  = $this->input->post('comment_text');
			
			if($comment_text==''||$comment_text==NULL)
			{
				echo $error=1;
				exit;
			}	
			
			if($post_commenter_id!=$user_id)
			{
				echo $error=2;
				exit;
			}
			//check that commenter post on right post	
            			
			$master  = $this->user_post->post_master($post_user_id,$post_id);
			if(!$master)
			{  
				echo $error=2;
				exit;
			}else
			{
				$date=date("M d, Y h:i:A");
				$Data= array(   'parent_post'  => $post_id,
								'user_id'      => $post_user_id,
								'poster_id'    => $user_id,								
								'content'      => base64_encode(strip_tags($comment_text)),				   					   
							);   
	 
				//insert parent post data in the database			
				$Success  = $this->user_post->add_comment($Data);
				if(!$Success)
				{
					echo $error=2;
					exit;
				}else
				{
					//fetch commenter picture from the database	
					
					$comment_id=$Success;
					
							
					$data='<li id="comment_'.$comment_id.'">
								<div class="sqil-profile-mini">
									<img alt="'.$name.' profile pic"  src="'.base_url().$dp_url.'" alt="Profile Image" width="25px" height="25px">
								</div>
								<div class="all-dtls-sqil-mini">
								<span>
									<a href="/">'.$name.'</a>
									<i>'.strip_tags($date).'</i>
								</span>
									<a onclick="delete_comment('.$comment_id.')"  class="icon_dlt icon_dlt_red"><i class="material-icons tedo"></i></a>
									<a onclick="edit_comment('.$comment_id.')" class="icon_dlt icon_dlt_green"><i class="material-icons tedo"></i></a>
								
									<div id="comment_value_'.$comment_id.'"><p>'.strip_tags($comment_text).'</p></div>									
								</div>
								<input type="hidden" id="commerter_user_id_'.$comment_id.'" value="'.$this->input->post('post_user_id').'">
						  </li>';
							
							
					echo $data;
				
				}
						
			}
			

	    }
	  	 

	public function delete_comment()
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
		
		$post_user_id  = $this->input->post('post_user_id');
		$post_commenter_id  = $this->input->post('post_commenter_id');
		$comment_id= $this->input->post('comment_id');
		
		//check that user has right to delete it			
		$master  = $this->user_post->comment_master($post_user_id,$post_commenter_id ,$comment_id);
		if(!$master){
			echo $error=2;
			exit;
		}else{
			//delete the post
			$delete  = $this->user_post->delete_comment($comment_id);
			if(!$delete){
				echo $error=3;
				exit;
			}else{
				echo 'comment_deleted';
				exit;
			}
		}
		

	}
	
     public function edit_comment()
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
			$dp_url=$session_data['dp_url'];
		    
			$comment_text  = $this->input->post('comment_text');
			$comment_id  = $this->input->post('comment_id');
			$commenter_id  = $this->input->post('commenter_id');
			
			if($comment_text==''||$comment_text==NULL){
			echo $error=1;
			exit;
			}
            if($commenter_id==''||$user_id==NULL){
			echo $error=2;
			exit;
			}
			if($comment_id==''||$comment_id==NULL){
			echo $error=3;
			exit;
			}			
			
			//check that user has right to delete it			
			$master  = $this->user_post->comment_edit_master($commenter_id,$comment_id);
			if(!$master){
				echo $error=2;
				exit;
			}else{
				   //update parent post data in the database			
					$comment_text_encoded=base64_encode(strip_tags($comment_text));
					$Success  = $this->user_post->edit_comment($comment_text_encoded,$comment_id);
					if(!$Success){
					echo $error=3;
					exit;
					}else{								
					$data='<p>'.strip_tags($comment_text).'</p>';					
					echo $data;					
					}

			}
			
	}



} ?>