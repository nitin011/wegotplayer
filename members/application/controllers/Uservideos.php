<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Uservideos extends CI_Controller {
		
		public function __construct()
		{
			parent::__construct();	
			$this->load->helper('url');
			$this->load->helper('security');
			$this->load->library(array('form_validation','session'));
			//$this->load->library('encrypt');
			$this->load->library('upload');			
			$this->load->model('video_model');
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

			
			
			$folder_list_result = $this->video_model->videosFolder_list($user_id);
			
			$user_data= array(   
			'title'=>'WeGotPlayer',							
			'user_id'=>$user_id,
			'folder_list_result'=>$folder_list_result
			);
			
			$this->load->view("video/video_folder_list",$user_data); 
			
		}//Index function End
		public function createVideosView()
		{
			
			$this->load->view('video/video_view');
			
		} 
		
		public function createVideosFolder()     
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
			$folder_id= $this->video_model->insertFolderDetails($data);
			$message='';
			
			if(!$folder_id){
				$message='Gallery not created';
				}else{
				$useridFolder = 'videos/'.$user_id;
				if (!file_exists ($useridFolder))
				{
					mkdir ($useridFolder);
				}
				$pathToUpload = 'videos/'.$user_id.'/'.$folder_id;
				if (!file_exists($pathToUpload))
				{
					$create = mkdir ($pathToUpload);
					$message='Gallery created successfully';
					}else{
					$message='Gallery not created';
				}
			}
			$folder_list_result = $this->video_model->videosFolder_list($user_id);
			
			$user_data=array('folder_list_result'=>$folder_list_result,'message'=>$message);
			$this->load->view('video/folder_list',$user_data );
			
		}		
		
		public  function getFolderVideo()     
		{ 
	        if (!$this->session->userdata('logged_in'))
			{
				//If no session, redirect to login page
				redirect('user', 'refresh');
				exit();
			}
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$acc_type=$session_data['acc_type'];
			$folder_id= $this->input->post('folder_id');	

			$video_count =$this->video_model->videoCount($user_id);

			//fetch video in the folder.
			$video_list_result=$this->video_model->getFolderVideo($folder_id);			
            $user_data=array(
            	'video_list_result'=>$video_list_result,
            	'folder_id'=>$folder_id,
            	'user_id'=>$user_id,
            	'acc_type'=>$acc_type,
            	'video_count'=>$video_count);
			
			$this->load->view('video/video_list',$user_data);			
		}
		
		public  function uploadeVideo()     
		{ 
			if (!$this->session->userdata('logged_in'))
			{
				//If no session, redirect to login page
				redirect('user', 'refresh');
				exit();
			}
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$acc_type=$session_data['acc_type'];
			$folder_id= $this->input->post('gallery_id');
			$video_title= $this->input->post('video_title');
			

			$video_count =$this->video_model->videoCount($user_id);
				
			
			if($_FILES['videofile2']['name']==''){
				$filename = "videofile1";	
				}else{
				$filename = "videofile2"; 
			}
		    $name =$_FILES[$filename]['name'];
			$size = $_FILES[$filename]['size'];	
			
		
			//Path to store files on server
		    $filepath = 'videos/'.$user_id.'/'.$folder_id.'/';
			
			$file_formats = array("mp4");
			//checking file available or not 	
			$status12="";
			if (strlen($name)) 
			{
				 $extension = pathinfo($name, PATHINFO_EXTENSION);
				
				if (in_array($extension, $file_formats))
				{ 
				// check it if it's a valid format or not
					if ($size < (20480 * 1024)) { // check it if it's bigger than 2 mb or no
						$videoname = md5(uniqid() . time()) . "." . $extension;
						$tmp = $_FILES[$filename]['tmp_name'];
					
						//Moving file to temporary location to upload path
						if (move_uploaded_file($tmp, $filepath . $videoname))
						{			
							//inserting details of the new image in the database.
							$wgp_video_type='1';
							$data12 = array(			
							'wgp_user_id'      => $user_id,	
							'wgp_video_title'  => $video_title,
							'wgp_video_type'   => $wgp_video_type,
							'wgp_video_source' => $filepath.$videoname,
							'wgp_video_gallery_id'  => $folder_id,
														
							);
							 
					  
							$return_result = $this->video_model->insertVideoData($data12);
							if(!$return_result){
								$status12="OOPs! some error occur in database connection.";
								}else{
								
								$status12="Video uploaded successfully";
							}	
						
						} else 
						{
							$status12= "Could not move the file";
						}
					} else
					{
						$status12= "Your video size is bigger than 20MB";
					}
				} else 
				{
					$status12= "Invalid file format Upload Only Mp4 File";
				}
				}else{
				//If file not selected displaying a message to choose a file 
				$status12= "Please choose a file";
			}
			//fetch all the videos of the folder.
			 		
			$video_list_result=$this->video_model->getFolderVideo($folder_id);
            $user_data=array(
            	'video_list_result'=>$video_list_result,
            	'folder_id'=>$folder_id,
            	'user_id'=>$user_id,
            	'status12'=>$status12,
            	'acc_type'=>$acc_type,
            	'video_count'=>$video_count);
			
			$this->load->view('video/video_list',$user_data);
			
		}

		public function deleteVideo()
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
			$video_id= $this->input->post('video_id');	

			$data = array('wgp_user_id'=>$user_id,'wgp_video_id'=>$video_id);

			$video_detail =  $this->video_model->videoDetail($data);
			
			 $video_name = $video_detail->wgp_video_title;
			 $folder_id =$video_detail->wgp_video_gallery_id;
			

			$pathToUpload = 'videos/'.$user_id.'/'.$folder_id;
			if (file_exists($pathToUpload))
				{
					$del = array_map('unlink', glob($pathToUpload."/".$video_name));
					
					if($del){
						echo "Video File deleted !";
					}
			    }
			 
			
			$delete_status = $this->video_model->deleteVideo($data);

			if($delete_status){
				echo "Video File deleted !";
			}else{
				echo "Problem In Delete !";
			}

		}

		public function insertVideoLink()
		{
			if (!$this->session->userdata('logged_in'))
			{
				//If no session, redirect to login page
				redirect('user', 'refresh');
				exit();
			}
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$gallery_id= $this->input->post('gallery_id');
			$url= $this->input->post('url');
			$name= $this->input->post('name');

			$data = array('wgp_user_id' =>$user_id,
						  'wgp_video_title'=>$name,
						  'wgp_video_type'=>2,
						  'wgp_video_source'=>$url,
						  'wgp_video_gallery_id'=>$gallery_id);

			$result = $this->video_model->insertVideoUrl($data);
			if($result){
				echo "Video added in your gallery ! ";
			}else{
				echo "Problem in Add ";
			}
		}


		public function uploadVideoWistia(){
			if (!$this->session->userdata('logged_in'))
			{
				//If no session, redirect to login page
				redirect('user', 'refresh');
				exit();
			}
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];			
			$gallery_id= $this->input->post('gallery_id');
			$acc_type=$session_data['acc_type'];
			$video_title= $this->input->post('video_title');

			 $video_file = $_FILES['wistia_video_upload']['name'];
			 $url= $_FILES['wistia_video_upload']['tmp_name'];	

			
			$result = $this->uploadVideo($url,$video_file,"nb6rl20p8x",$video_title, "Vidio test description");
          
			if($result){

				$id =$result->id;	
							
				$name =$result->name;
				$created =$result->created;
				$updated =$result->updated;
				$duration =$result->duration;
				$hashed_id =$result->hashed_id;
				$description =$result->description;
				$account_id =$result->account_id;	

			$data = array('wgp_user_id' => $user_id, 
						   'wgp_video_title'=>$name,
						   'wgp_video_type'=>2,
						   'wgp_video_source'=>'http://fast.wistia.net/embed/iframe/'.$hashed_id,				  
						   'wgp_video_gallery_id'=>$gallery_id
				);	


			$result = $this->video_model->insertVideoUrl($data);
			if($result){
				$video_list_result=$this->video_model->getFolderVideo($gallery_id);
            	$user_data=array('video_list_result'=>$video_list_result,
            		'folder_id'=>$gallery_id,'user_id'=>$user_id,
            		'acc_type'=>$acc_type);
			
					$this->load->view('video/video_list',$user_data);
			}else{
				echo "Problem in uploading Video .";

			}	
		}

	}  

		public static function uploadVideo($file_path, $file_name, $project, $name, $description='')
		    {
		        $url = WISTIA_UPLOAD_URL;
		        $ch = curl_init();
		        curl_setopt($ch, CURLOPT_URL, $url);
		        curl_setopt($ch, CURLOPT_POST, true);

		        $params = array
		        (
		            'project_id'   => $project,
		            'name'         => $name,
		            'description'  => $description,
		            'api_password' => API_KEY,
		            'file'         => new CurlFile($file_path, 'video/mp4', $file_name)
		        ); 
		          
		    
		        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		       //JSON result
		        $result = curl_exec($ch);
		        if(curl_errno($ch))
		        {
		           echo 'Curl error: ' . curl_error($ch);
		        }
		        //Object result
		        return json_decode($result);
		    }


	public function saveVideoDetail(){
		   		if (!$this->session->userdata('logged_in'))
			{
				//If no session, redirect to login page
				redirect('user', 'refresh');
				exit();
			}
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];	
			$acc_type=$session_data['acc_type'];

			$gallery_id = $this->input->post('gallery_id');			
			$video_title = $this->input->post('video_title');
			$video_id = $this->input->post('video_id');

			$data = array('wgp_user_id' => $user_id, 
						   'wgp_video_title'=>$video_title,
						   'wgp_video_type'=>2,
						   'wgp_video_source'=>'http://fast.wistia.net/embed/iframe/'.$video_id,				  
						   'wgp_video_gallery_id'=>$gallery_id
				);	


			$result = $this->video_model->insertVideoUrl($data);
			if($result){
				$video_list_result=$this->video_model->getFolderVideo($gallery_id);
            	$user_data=array('video_list_result'=>$video_list_result,
            		'folder_id'=>$gallery_id,'user_id'=>$user_id,
            		'acc_type'=>$acc_type);
			
					$this->load->view('video/video_list',$user_data);
			}else{
				echo "Problem in Saving Video Detail.";

			}	


		}

	}?>