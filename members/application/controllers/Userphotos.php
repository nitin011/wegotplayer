<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userphotos extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
	    $this->load->library(array('form_validation','session'));
		//$this->load->library('encrypt');
		$this->load->model('photo_model');
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

		$folder_result = $this->photo_model->getAlbum($user_id);		
		$user_data= array(
						   'user_id'=>$user_id,'name'=>$name,
						   'folder_result'=>$folder_result
						 );
		//print_r($user_data);
        $this->load->view("dashboard/photos_view",$user_data); 
	  }//Index function End

	//Start Gallery view
	public function createGalleryView()
	{
		if (!$this->session->userdata('logged_in'))
			{
				//If no session, redirect to log
				redirect('user', 'refresh');
			}
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$name=$session_data['name'];	  	
			
			$user_data= array('user_id'=>$user_id,'name'=>$name);	  			
	  		$this->load->view('dashboard/create_album',$user_data);
	}//End Gallery view

	//Start Create Gallery 
	public function createAlbum()
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
	        $folder_name= $this->input->post('album_name');	
			
			$data = array('folder_path'=>$folder_name, 'user_id'=>$user_id);			
			$folder_id= $this->photo_model->insertFolderDetails($data);
			$message='';
			if(!$folder_id){
			    $message='Gallery not created';
				}else{
				//creating user id folder if not exists
				$useridFolder = 'images/'.$user_id;
				if (!file_exists($useridFolder))
				{
				 	mkdir ($useridFolder);					
				}
				//creating folder with returned id from database.
				$pathToUpload = 'images/'.$user_id.'/'.$folder_id;
				if (!file_exists($pathToUpload))
				{
					$create = mkdir ($pathToUpload);
					$message='Gallery created successfully';
					}else{
					$message='Gallery not created';
				}
			}

			
			$folder_result = $this->photo_model->getAlbum($user_id);		
			$user_data= array(
						   		'user_id'=>$user_id,'name'=>$name,
						   		'folder_result'=>$folder_result
						 	 );
       		 $this->load->view("dashboard/photos_view",$user_data);
	}//End Create Gallery 

	  // Start Fetch images of current folder
	public function getFolderImage()
	{
		if (!$this->session->userdata('logged_in'))
			{
				//If no session, redirect to login page
				redirect('user', 'refresh');
				exit();
			}
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$folder_id= $this->input->post('folder_id');	
			//fetch image in the folder.
			$image_list=$this->photo_model->getImage($folder_id);
            $user_data=array(
            				 'image_list'=>$image_list,
            				 'folder_id'=>$folder_id,
            				 'user_id'=>$user_id
            				 );	
  			$this->load->view('dashboard/image_list',$user_data);

	} //End Fetch images of current folder

	

	public function insertAlbumImage()
	{
		if (!$this->session->userdata('logged_in'))
		{
			//If no session, redirect to login page
			redirect('user', 'refresh');
			exit();
		}
		$session_data = $this->session->userdata('logged_in');
		$user_id=$session_data['user_id'];
		
		if(isset($_FILES['imagefile2']['name'])){
			    $filename = "imagefile1";	
		}else if(isset($_FILES['imagefile1']['name'])){
			   $filename = "imagefile2"; 
		}

 		
		 $name =$_FILES[$filename]['name'];
		 $size = $_FILES[$filename]['size'];	
	
		 //Path to store files on server
		 $filepath = 'images/'.$user_id.'/';

			if (!file_exists($filepath)){
			 	 mkdir ($filepath);					
			}
			
		 $file_formats = array("jpg", "jpeg", "png", "gif", "bmp");
		//checking file available or not 		
		if (strlen($name)) {
				$extension = pathinfo($name, PATHINFO_EXTENSION);
				if (in_array($extension, $file_formats)) { // check it if it's a valid format or not
					if ($size < (2048 * 1024)) { // check it if it's bigger than 2 mb or no
						$imagename = md5(uniqid() . time()) . "." . $extension;
						$tmp = $_FILES[$filename]['tmp_name'];
						//Moving file to temporary location to upload path
							if (move_uploaded_file($tmp, $filepath . $imagename))
							{			
		                        //inserting details of the new image in the database.
								$data = array(	
											'user_id'=>$user_id,									
											'image_file' => $filepath.$imagename																						
											);
								
								$insert_result = $this->photo_model->insertImage($data);
								
								if($insert_result){
								   $status="Image uploaded successfully";
								}else{
								$status="OOPs! some error occur in database connection.";
								}		
							} else 
							{
								$status= "Could not move the file";
							}
					} else
					{
						$status= "Your image size is bigger than 2MB";
					}
				} else 
				{
						$status= "Invalid file format";
				}
			}else{
			//If file not selected displaying a message to choose a file 
			$status= "Please choose a file";
		}


	}	//End Uploading Image in Album  

	//Start Set Profile  Picture
	public  function defaultImage()     
	{ 
		if (!$this->session->userdata('logged_in'))
		{
			redirect('user', 'refresh');
			exit();
		}
		$session_data = $this->session->userdata('logged_in');
		$user_id=$session_data['user_id'];
		$image_id= $this->input->post('image_id');
		$folder_id= $this->input->post('gallery_id');
		//set image as default image
		$default_image=$this->photo_model->setDefaultImage($user_id,$image_id);
		if(!$default_image){		
			  echo 0;
			}else{

			//set image as default image
		    $default_image_details=$this->photo_model->getDefaultImage($user_id,$image_id);
			$dp_url=$default_image_details->image_file;
			
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$unique_code=$session_data['unique_code'];
			$name=$session_data['name'];
			$email=$session_data['email'];
			$cover_url=$session_data['cover_url'];
			$password=$session_data['password'];
			$usertype=$session_data['usertype'];
			$acc_type=$session_data['acc_type'];
			$dp_url=$dp_url;
			
		     $userdata = array(    
                'user_id'  => $user_id,'unique_code'=>$unique_code,    
                'name'     => $name,'email' => $email,
                'password' => $password,'usertype' => $usertype,
                'dp_url'   => $dp_url,'cover_url' =>$cover_url,
                'acc_type' =>$acc_type          
                );
                        
            $this->session->set_userdata('logged_in',$userdata);	
			
			    echo 1;
		}
	}//End Set Profile  Picture

	public function deleteImage()
	{
		if (!$this->session->userdata('logged_in'))
			{
				redirect('user', 'refresh');
				exit();
				
			}
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$image_id = $this->input->post('image_id');				
			$d = $this->photo_model->deleteImage($user_id, $image_id);
			
			if($d) {				
				$status="Image Deleted.";
			}
			else {
				$status= "oops! Something is Wrong";
			}

			echo $status;		
	}



	public function uploadProfilePic()
	{
	  if (!$this->session->userdata('logged_in'))
		{
			//If no session, redirect to login page
			redirect('user', 'refresh');
			exit();
		}
		$session_data = $this->session->userdata('logged_in');
		$user_id=$session_data['user_id'];
		$profile_pic= $this->input->post('profile_pic');
		$useridFolder = 'images/'.$user_id;
				if (!file_exists($useridFolder))
				{
				 	mkdir ($useridFolder);					
				}
		
			 $name =$_FILES['profile_pic']['name'];
			 $size = $_FILES['profile_pic']['size'];

		//Path to store files on server
		$filepath = 'images/'.$user_id.'/';
		$file_formats = array("jpg", "jpeg", "png");
		//checking file available or not 		
		if (strlen($name)) {
				$extension = pathinfo($name, PATHINFO_EXTENSION);
				if (in_array($extension, $file_formats)) { // check it if it's a valid format or not
					if ($size < (2048 * 1024)) { // check it if it's bigger than 2 mb or no
						$imagename = md5(uniqid() . time()) . "." . $extension;
						$tmp = $_FILES['profile_pic']['tmp_name'];
						//Moving file to temporary location to upload path
							if (move_uploaded_file($tmp, $filepath . $imagename))
							{			
		                        //inserting details of the new image in the database.
								$data = array(			
											'user_id' => $user_id,
											'image_file' => $filepath.$imagename,
											);
								
								 $result = $this->photo_model->uploadProfilePic($data);
								
								if($result){
								    echo $status="Image set successfully";
								}else{
									echo $status="OOPs! some error occur in database connection.";
								}		
							} else{
								echo $status= "Could not move the file";
							}
					} else {
						echo $status= "Your image size is bigger than 2MB";
					}
				} else {
						echo $status= "Invalid file format";
				}
			}else{
			//If file not selected displaying a message to choose a file 
			echo $status= "Please choose a file";
		}
	} 


}