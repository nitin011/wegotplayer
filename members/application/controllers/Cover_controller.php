<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cover_controller extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('security');
	    $this->load->library(array('form_validation','session'));
		$this->load->model('cover_model');
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

	  }


	public function img_save_to_file()
	{
		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

	 $imagePath = "images/banner/";

	$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
	$temp = explode(".", $_FILES["img"]["name"]);
	$extension = end($temp);
	
	//Check write Access to Directory

	if(!is_writable($imagePath)){
		$response = Array(
			"status" => 'error',
			"message" => 'Can`t upload File; no write Access'
		);
		print json_encode($response);
		return;
	}
	
	if ( in_array($extension, $allowedExts))
	  {
	  if ($_FILES["img"]["error"] > 0)
		{
			 $response = array(
				"status" => 'error',
				"message" => 'ERROR Return Code: '. $_FILES["img"]["error"],
			);			
		}
	  else
		{
			
	      $filename = $_FILES["img"]["tmp_name"];
		  list($width, $height) = getimagesize( $filename );

		  move_uploaded_file($filename,  $imagePath . $_FILES["img"]["name"]);

		  $response = array(
			"status" => 'success',
			"url" => $imagePath.$_FILES["img"]["name"],
			"width" => $width,
			"height" => $height
		  );
		  
		}
	  }
	else
	  {
	   $response = array(
			"status" => 'error',
			"message" => 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini',
		);
	  }
	  
	  print json_encode($response);
	 }



	 public function img_crop_to_file()
	 {
	 	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];



	 	$imgUrl = $_POST['imgUrl'];
		// original sizes
		$imgInitW = $_POST['imgInitW'];
		$imgInitH = $_POST['imgInitH'];
		// resized sizes
		$imgW = $_POST['imgW'];
		$imgH = $_POST['imgH'];
		// offsets
		$imgY1 = $_POST['imgY1'];
		$imgX1 = $_POST['imgX1'];
		// crop box
		$cropW = $_POST['cropW'];
		$cropH = $_POST['cropH'];
		// rotation angle
		$angle = $_POST['rotation'];

		$jpeg_quality = 100;

		$useridFolder = 'images/'.$user_id;
		if (!file_exists($useridFolder))
			{
				 mkdir ($useridFolder);					
			}

		$output_filename = "images/".$user_id."/".md5(uniqid() . time());

		$what = getimagesize($imgUrl);

		switch(strtolower($what['mime']))
		{
		    case 'image/png':
		        $img_r = imagecreatefrompng($imgUrl);
				$source_image = imagecreatefrompng($imgUrl);
				$type = '.png';
		        break;
		    case 'image/jpeg':
		        $img_r = imagecreatefromjpeg($imgUrl);
				$source_image = imagecreatefromjpeg($imgUrl);
				error_log("jpg");
				$type = '.jpeg';
		        break;
		    case 'image/gif':
		        $img_r = imagecreatefromgif($imgUrl);
				$source_image = imagecreatefromgif($imgUrl);
				$type = '.gif';
		        break;
		    default: die('image type not supported');
		}


		//Check write Access to Directory

		if(!is_writable(dirname($output_filename))){
			$response = Array(
			    "status" => 'error',
			    "message" => 'Can`t write cropped File'
		    );	
		}else{

		    // resize the original image to size of editor
		    $resizedImage = imagecreatetruecolor($imgW, $imgH);
			imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
		    // rotate the rezized image
		    $rotated_image = imagerotate($resizedImage, -$angle, 0);
		    // find new width & height of rotated image
		    $rotated_width = imagesx($rotated_image);
		    $rotated_height = imagesy($rotated_image);
		    // diff between rotated & original sizes
		    $dx = $rotated_width - $imgW;
		    $dy = $rotated_height - $imgH;
		    // crop rotated image to fit into original rezized rectangle
			$cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
			imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
			imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
			// crop image into selected area
			$final_image = imagecreatetruecolor($cropW, $cropH);
			imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
			imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
			// finally output png image
			//imagepng($final_image, $output_filename.$type, $png_quality);
			imagejpeg($final_image, $output_filename.$type, $jpeg_quality);

			$data = array(			
						'wgp_user_id'=> $user_id,
						'name'  => $imgUrl,
						'url' => $output_filename.$type,
						'status'=>1,											
					);

			$insert_result = $this->cover_model->uploadCover($data);

			$userdata = array(	
			'user_id'  => $session_data['user_id'],
			'unique_code'=>$session_data['unique_code'],	
			'name'     => $session_data['name'],				
			'email'    => $session_data['email'],
			'password' => $session_data['password'],
			'usertype' => $session_data['usertype'],
            'dp_url'   => $session_data['dp_url'],
            'activated'=> $session_data['activated'],
            'acc_type' => $session_data['acc_type'],
            'cover_url'=> $output_filename.$type,		
			);
						
			$this->session->set_userdata('logged_in',$userdata);


			$response = Array(
			    "status" => 'success',
			    "url" => $output_filename.$type
		    );


		}
		print json_encode($response);

	}


	  public function imageUpload()
	  {	
	  	if (!$this->session->userdata('logged_in'))
		{
			//If no session, redirect to login page
			redirect('user', 'refresh');
			exit();
		}
		$session_data = $this->session->userdata('logged_in');
		$user_id=$session_data['user_id'];

	  	if($_FILES['photoimg']['name']==''){
			$filename = "photoimg";	
			}else{
			$filename = "photoimg"; 
		}
	    	$name =$_FILES[$filename]['name'];
			$size = $_FILES[$filename]['size'];	

			$file_formats = array("jpg", "jpeg", "png", "gif", "bmp");
			$filepath = 'images/'.$user_id.'/';
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
											'wgp_user_id'=> $user_id,
											'name'  => $name,
											'url' => $filepath.$imagename,
											'status'=>1,											
											);											
								
								$insert_result = $this->cover_model->uploadCover($data);	
								if($insert_result){
									echo $status="Image uploaded successfully";
								}else{
									echo $status="OOPs! some error occur in database connection.";
								}		
							} else 
							{
							echo $status= "Could not move the file";
							}
					} else
					{
						echo 
						$status= "Your image size is bigger than 2MB";
					}
				}

			}



			$userdata = array(	
			'user_id'  => $session_data['user_id'],
			'unique_code'=>$session_data['unique_code'],	
			'name'     => $session_data['name'],				
			'email'    => $session_data['email'],
			'password' => $session_data['password'],
			'usertype' => $session_data['usertype'],
            'dp_url'   => $session_data['dp_url'],
            'activated'=> $session_data['activated'],
            'cover_url'=> $filepath.$imagename,		
			);
						
			$this->session->set_userdata('logged_in',$userdata);

	  }


}