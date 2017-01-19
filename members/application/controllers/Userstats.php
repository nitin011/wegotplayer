<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userstats extends CI_Controller {

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
			$row =array('wgp_table_id', 'wgp_user_id', 'level_name(level) level', 'season', 'games_played', 
				'games_started', 'goals', 'assists', 'points', 'total_points');
		  	$stats_details= $this->fetch_model->stats_details($user_id,$row);
		  	
		  	if($stats_details==false)
				   {				   	
				   	$data = array();
				   	for($i=2020;$i>1980;$i--){				   		
				   			array_push($data,$i);				   		
				   	}
				   	$user_sport_data = $this->fetch_model->getSportId($user_id);
            		$user_sport_id =$user_sport_data->sport;
					// Get level  of sport
					$level_data = $this->fetch_model->getLevel($user_sport_id);	

				   	$user_details =  array('data' => $data,'user_id'=>$user_id,
				   							'level_data'=>$level_data
				   		                   );				   	
                    $this->load->view("stats/edit_stats_view",$user_details);	  	
				   }
			else{
				$season = array();
				   	for($i=2020;$i>1980;$i--){				   		
				   			array_push($season,$i);				   		
				   	}				 
				$data = array('stats_details' => $stats_details,'seas'=>$season);				
	  		    $this->load->view("stats/stats_view",$data); 
		  }
	  }//Index function End 

	  public function insertStats()
	  {	 	      	   
	   	   $user_id=$this->input->post('user_id');
	   	   $level=$this->input->post('level');
	   	   $season=$this->input->post('season');
	   	   $games_played=$this->input->post('games_played');
	   	   $games_started=$this->input->post('games_started');
	   	   $goals=$this->input->post('goals');
	   	   $assists=$this->input->post('assists');
	   	   $points=$this->input->post('points');
	   	   $total_points=$this->input->post('total_points');
	   	   
    
 		$stats_data = array('level'=> $level,'season'=> $season,
	 					'games_played'=> $games_played,
	 					'games_started'=> $games_started,
	 					'goals' => $goals,'assists' => $assists,
	 					'points' => $points,'total_points' => $total_points,
	 					'wgp_user_id' =>$user_id);

 		 $success= $this->user_model->insertStats($stats_data);

		if($success){			       
				redirect('home');	
			}	   	   
	  }

	 

	 public function addStats()
	 {
	 	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];		  	

		  	$row =array('wgp_table_id', 'wgp_user_id', 'level_name(level) level', 'season', 'games_played', 
				'games_started', 'goals', 'assists', 'points', 'total_points');
		  	$stats_details= $this->fetch_model->stats_details($user_id,$row);
		  	$data = array();
				for($i=2020;$i>1980;$i--){				   		
				   	array_push($data,$i);				   		
				}
					$user_sport_data = $this->fetch_model->getSportId($user_id);
            		$user_sport_id =$user_sport_data->sport;
					// Get level  of sport
					$level_data = $this->fetch_model->getLevel($user_sport_id);	

				   	$user_details =  array('data' => $data,'user_id'=>$user_id,
				   							'level_data'=>$level_data
				   		                   );
	        $this->load->view("stats/edit_stats_view",$user_details);

	 }

	  public function updateStatsView()
	  {
	  	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$table_row= $this->input->post('edit');		

		  	$stats_row= $this->fetch_model->getStatsRow($user_id,$table_row);
		  	$data = array();
				for($i=2020;$i>1980;$i--){				   		
				   	array_push($data,$i);				   		
				}
			

			$user_sport_data = $this->fetch_model->getSportId($user_id);
            $user_sport_id =$user_sport_data->sport;
           
			// Get level  of sport
			$level_data = $this->fetch_model->getLevel($user_sport_id);	

		   	$stats_data =  array('data' => $data,'user_id'=>$user_id,'level_data'=>$level_data,'stats_row'=>$stats_row);
		  	
	  		$this->load->view("stats/update_stats_view",$stats_data); 
	 	 }

	 public function updateStatsRow()
	 {	 	
	 	if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			$level= $this->input->post('level');	
			$season= $this->input->post('season');	
			$goals= $this->input->post('goals');	
			$assists= $this->input->post('assists');	
			$points= $this->input->post('points');	
			$games_played= $this->input->post('games_played');	
			$games_started= $this->input->post('games_started');	
			$total_points= $this->input->post('total_points');
			$wgp_table_id= $this->input->post('wgp_table_id');

			$stats_data = array('level'=> $level,'season'=> $season,
	 					'games_played'=> $games_played,
	 					'games_started'=> $games_started,
	 					'goals' => $goals,'assists' => $assists,
	 					'points' => $points,'total_points' => $total_points,
	 					);

			$success= $this->user_model->updateStatsRow($user_id,$stats_data,$wgp_table_id);
			if($success)
			{	
				$row =array('wgp_table_id', 'wgp_user_id', 'level_name(level) level', 'season', 'games_played', 
				'games_started', 'goals', 'assists', 'points', 'total_points');
		  		$stats_details= $this->fetch_model->stats_details($user_id,$row);
		  		$season = array();
				   	for($i=2020;$i>1980;$i--){				   		
				   			array_push($season,$i);				   		
				   	}				 
				$data = array('stats_details' => $stats_details,'seas'=>$season);		
								
	  		    $this->load->view("stats/stats_view",$data); 
			}else{
				return false;
			}
	   }

	   public function deleteStats()
	   {
	   		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
			$wgp_table_id =$this->input->post('row_id');

			$delete_status= $this->user_model->deleteStatsRow($user_id,$wgp_table_id);

			if($delete_status)
			{
				echo 1;
			}else{
				echo 0;
			}

	   }


}