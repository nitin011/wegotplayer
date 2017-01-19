<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usercomment extends CI_Controller {

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

	public function index(){
		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			//Get User Comment 
			$comments = $this->fetch_model->getComment($user_id);
			if($comments==false){
			     $this->load->view("comment/add_comment_view");	
			}else{				
				 $data  = array('comments' =>$comments);				 
				 $this->load->view("comment/comment_view",$data);
			}
		}//End Index Function 

  public function addComment()
  {
  	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
  	        $comment =$this->input->post('comment');
  	        $comment_data = array('wgp_user_id'=>$user_id,'comments' => $comment);
  	        $success= $this->user_model->addComment($comment_data);

  	        if($success){
  	        	return true;
  	        }else{
  	        	return false;
  	        }
     }//End addComment function 

     public function editComment(){
     	if (
     		!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$wgp_table_id = $this->input->post('edit');	

			$comment_row = $this->fetch_model->getCommentRow($user_id,$wgp_table_id);		
			
			$data  = array('comment_row' =>$comment_row);								 						 		
			$this->load->view("comment/edit_comment_row",$data);
			

     }
     public function updateRow(){
     	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$wgp_table_id =$this->input->post('wgp_table_id');
			$comment =$this->input->post('comment');

			$data_com = array('comments' => $comment);

			$success= $this->user_model->updateComment($user_id,$data_com,$wgp_table_id);
			if($success)
			{				
				 $comments = $this->fetch_model->getComment($user_id);
				 $data  = array('comments' =>$comments);				 
				 $this->load->view("comment/comment_view",$data);
			}else{
				return false;
			}


     }
}