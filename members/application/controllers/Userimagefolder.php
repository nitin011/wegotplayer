<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Userimagefolder extends CI_Controller {
		
		public function __construct()
		{
			parent::__construct();	
			$this->load->helper('url');
			$this->load->helper('security');
			$this->load->library(array('form_validation','session'));
			//$this->load->library('encrypt');
            $this->load->library('upload');
			$this->load->model('fetch_model');
			$this->load->model('User_model');
			$this->load->model('folder_model');
		}
		
		public function index()
		{
			if (!$this->session->userdata('logged_in'))
			{
				//If no session, redirect to log
				redirect('user', 'refresh');
			}
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
		  	$name=$session_data['name'];
		  	$email=$session_data['email'];
			
			$user_data= array('title'=>'WeGotPlayer', 'email'=>$email,'user_id'=>$user_id,'name'=>$name);	  			
	  		$this->load->view('dashboard/create_folder');		
			
		}//Index function End
		
		public function createImageFolder()     
		{ 
			if (!$this->session->userdata('logged_in'))
			{
				//If no session, redirect to login page
				redirect('user', 'refresh');
				exit();
			}
			$session_data = $this->session->userdata('logged_in');
			//print_r($session_data);
			$user_id=$session_data['user_id'];
	        $folder_name= $this->input->post('folder_val');	
			
			$data = array('folder_path'=>$folder_name, 'user_id'=>$user_id);			
			$folder_id= $this->folder_model->insertFolderDetails($data);
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
			$folder_list_result = $this->folder_model->imageFolder_list($user_id);
			
			$user_data=array('folder_list_result'=>$folder_list_result,'message'=>$message);
			$this->load->view('dashboard/folder_list',$user_data );
			
			//return true;
			
			
		}
		public  function fetch_images_of_this_folder()     
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
			$image_list_result=$this->folder_model->fetch_images_in_folder($folder_id);
            $user_data=array('image_list_result'=>$image_list_result,'folder_id'=>$folder_id,'user_id'=>$user_id);
			
			$this->load->view('dashboard/image_list',$user_data);
		}
		
		public  function delete_image_in_folder()
		{
			if (!$this->session->userdata('logged_in'))
			{
				redirect('user', 'refresh');
				exit();
				
			}
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$image_id = $this->input->post('image_id');	
			$folder_id= $this->input->post('gallery_id');	
			$d = $this->folder_model->delete_image($user_id, $image_id, $folder_id);
			
			
			if($d) {
				
				$status="Image deleted.";
			}
			else {
				$status= "oops! something is wrong";
			}
			
			
			//fetch image in the folder.
			$image_list_result=$this->folder_model->fetch_images_in_folder($folder_id);
            $user_data=array('image_list_result'=>$image_list_result,'folder_id'=>$folder_id,'user_id'=>$user_id,'status'=>$status);
			
			$this->load->view('dashboard/image_list',$user_data);
		}	
		
		
	public  function insert_new_images_in_folder()     
	{ 
		if (!$this->session->userdata('logged_in'))
		{
			//If no session, redirect to login page
			redirect('user', 'refresh');
			exit();
		}
		$session_data = $this->session->userdata('logged_in');
		$user_id=$session_data['user_id'];
		$folder_id= $this->input->post('gallery_id');
		
		if($_FILES['imagefile2']['name']==''){
			$filename = "imagefile1";	
			}else{
			$filename = "imagefile2"; 
		}
		$name =$_FILES[$filename]['name'];
		$size = $_FILES[$filename]['size'];			
					
		//Path to store files on server
		$filepath = 'images/'.$user_id.'/'.$folder_id.'/';
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
											'user_id'    => $user_id,				
											
											'image_file' => $filepath.$imagename,
											'gallery_id'  => $folder_id
											);
											
								$insert_result = $this->folder_model->insert_image($data);	
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
		//fetch all the images of the folder.
		$image_list_result=$this->folder_model->fetch_images_in_folder($folder_id);
		$user_data=array('image_list_result'=>$image_list_result,'folder_id'=>$folder_id,'user_id'=>$user_id,'status'=>$status);
		
		$this->load->view('dashboard/image_list',$user_data);
			
	}
	
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
		$default_image=$this->photo_model->set_default_image($user_id,$image_id);
		if(!$default_image){		
			echo 0;
			}else{
			//set image as default image
		$default_image_details=$this->photo_model->fetch_default_image($user_id,$image_id);
			$dp_url=$default_image_details->image_file;
			
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$unique_code=$session_data['unique_code'];
			$name=$session_data['name'];
			$email=$session_data['email'];
			$password=$session_data['password'];
			$usertype=$session_data['usertype'];
			$dp_url=$dp_url;
			
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
			
			
			echo 1;
			}
	}	
}					