<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userteaminfo extends CI_Controller {

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
			// Get sport id 
			$user_sport_data = $this->fetch_model->getSportId($user_id);
            $user_sport_id =$user_sport_data->sport;
			// Get level  of sport
			$level_data = $this->fetch_model->getLevel($user_sport_id);			
			//get competition
			$competition= $this->fetch_model->getCompetition();
			//Get playing Year
		    $playing_year= $this->fetch_model->getPlayingYear();
		    //Get Division
		    $division = $this->fetch_model->getDivision();
		    //Get Color
		    $color  = $this->fetch_model->getColor();

		   //Get Play Style
		    $play_style  = $this->fetch_model->getPlayStyle();

		    //get Sports Ground
		    $sports_ground  = $this->fetch_model->getSportGround();

		    $row = array('wgp_table_id', 'wgp_user_id', 'team_name',
		    			 'level_name(level) level','head_coach_full_name',
		    			 'coach_phone','coach_email', 
		    			 'team_website','competition_value(competition) competition', 
		    			 'uniform_color_name(team_home_uniform) team_home_uniform',
		    			 'uniform_color_name(team_away_color) team_away_color', 
		    			 'playing_year(college_playing_eligibility) college_playing_eligibility', 
		    			 'team_home_address',
		    			 'division_name(division) division',
		    			 'ground_name(favortite_sports_ground) favortite_sports_ground', 
		    			 'playing_years',
		    			 'play_style(style_of_play) style_of_play');

		    
			$teaminfo= $this->fetch_model->teamInfo($user_id,$row);

			//$team_status = $this->fetch_model->checkTeam($user_id);

		  	if($teaminfo==false)
				   {  
				   		$year= array();
				   		for($i=0;$i<=20;$i++){
				   			array_push($year,$i);
				   		}

				   	  $data = array('teaminfo' => $teaminfo,'user_id'=>$user_id,
				   	  	'level'=>$level_data,'competition'=>$competition,
				   	  	'playing_year'=>$playing_year,'division'=>$division,
				   	  	'color'=>$color,'year'=>$year,'play_style'=>$play_style,
				   	  	'sports_ground'=>$sports_ground);	

                      $this->load->view("teaminfo/edit_teaminfo_view",$data);
				   }
				   else{
				   	$data = array('teaminfo' => $teaminfo );				   					   	
				   	$this->load->view("teaminfo/teaminfo_view",$data);
				   }	

	}

	public function addTeamInfo(){				
		if (!$this->session->userdata('logged_in'))
			  {
			    //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

		$team_name=$this->input->post('team_name');
		$level=$this->input->post('level');
		$jersey_number=$this->input->post('jersey_number');	
		$competition=$this->input->post('competition');
		$college_playing=$this->input->post('college_playing_eligibility');
		$division=$this->input->post('division');
		$team_color_uniform=$this->input->post('team_home_color_uniform');
		$coach_name=$this->input->post('head_coach_full_name');
		$years_playing=$this->input->post('years_playing_for_this_team');
		$style_pay=$this->input->post('style_of_play');
		$sports_ground=$this->input->post('favorite_sports_ground');
		$coach_phone=$this->input->post('coach_phone');
		$coach_email=$this->input->post('coach_email');
		$team_home_address=$this->input->post('team_home_address');
		$team_website=$this->input->post('team_website');
		$team_away_color=$this->input->post('team_away_color_uniform');
	
		$data = array('wgp_user_id' => $user_id,'team_name'=>$team_name,
				 'level'=>$level,'head_coach_full_name'=>$coach_name,
				 'coach_phone'=>$coach_phone,'coach_email'=>$coach_email,
				 'team_website'=>$team_website,'competition'=>$competition,
				 'team_home_uniform'=>$team_color_uniform,
				 'playing_years'=>$years_playing,'jersey_number'=>$jersey_number,
				 'team_home_address'=>$team_home_address,
				 'division'=>$division,'favortite_sports_ground'=>$sports_ground,
				 'college_playing_eligibility'=>$college_playing,
				 'style_of_play'=>$style_pay,'team_away_color'=>$team_away_color);

	$success= $this->user_model->addTeamInfo($data);	
	if($success){
		redirect('home');
	}


	} 

	public function updateTeamView(){
		if (!$this->session->userdata('logged_in'))
			  {
			    //If no session, redirect to login page
				   redirect('user', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

			// Get sport id 
			$user_sport_data = $this->fetch_model->getSportId($user_id);
            $user_sport_id =$user_sport_data->sport;
			// Get level  of sport
			$level_data = $this->fetch_model->getLevel($user_sport_id);			
			//get competition
			$competition= $this->fetch_model->getCompetition();
			//Get playing Year
		    $playing_year= $this->fetch_model->getPlayingYear();
		    //Get Division
		    $division = $this->fetch_model->getDivision();
		    //Get Color
		    $color  = $this->fetch_model->getColor();

		   //Get Play Style
		    $play_style  = $this->fetch_model->getPlayStyle();

		    //get Sports Ground
		    $sports_ground  = $this->fetch_model->getSportGround();

			 $row = array('wgp_table_id', 'wgp_user_id', 'team_name',
		    			 'level_name(level) level','head_coach_full_name',
		    			 'coach_phone','coach_email', 'jersey_number',
		    			 'team_website','competition_value(competition) competition', 
		    			 'uniform_color_name(team_home_uniform) team_home_uniform',
		    			 'uniform_color_name(team_away_color) team_away_color', 
		    			 'playing_year(college_playing_eligibility) college_playing_eligibility', 
		    			 'team_home_address',
		    			 'division_name(division) division_name','division',
		    			 'ground_name(favortite_sports_ground) favortite_sports_ground', 
		    			 'playing_years',
		    			 'play_style(style_of_play) style_of_play');
			$teaminfo= $this->fetch_model->teamInfo($user_id,$row);
		  	 
				   		$year= array();
				   		for($i=0;$i<=20;$i++){
				   			array_push($year,$i);
				   		}

				   		$team_value = $this->fetch_model->getTeamValue($user_id);
				   		
				   	  $data = array('teaminfo' => $teaminfo,'user_id'=>$user_id,
				   	  	'level'=>$level_data,'competition'=>$competition,
				   	  	'playing_year'=>$playing_year,'division'=>$division,
				   	  	'color'=>$color,'year'=>$year,'play_style'=>$play_style,
				   	  	'sports_ground'=>$sports_ground,'team_value'=>$team_value);
				   	  
                      $this->load->view("teaminfo/update_teaminfo",$data);


			}
			public function updateTeaminfo()
			{
				
				if (!$this->session->userdata('logged_in'))
				  {
				    //If no session, redirect to login page
					   redirect('user', 'refresh');
					   exit();
				  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];

		$team_name=$this->input->post('team_name');
		$level=$this->input->post('level');
		$jersey_number=$this->input->post('jersey_number');		
		$competition=$this->input->post('competition');
		$college_playing=$this->input->post('clg_play');
		$division=$this->input->post('division');
		$team_color_uniform=$this->input->post('home_color');
		$coach_name=$this->input->post('head_coach');
		$years_playing=$this->input->post('years');
		$style_pay=$this->input->post('play_style');
		$sports_ground=$this->input->post('fav_sport');
		$coach_phone=$this->input->post('coach_phone');
		$coach_email=$this->input->post('coach_email');
		$team_home_address=$this->input->post('team_home_address');
		$team_website=$this->input->post('team_website');
		$team_away_color=$this->input->post('away_color');
	
		$data_info = array('team_name'=>$team_name,'jersey_number'=>$jersey_number,
				 'level'=>$level,'head_coach_full_name'=>$coach_name,
				 'coach_phone'=>$coach_phone,'coach_email'=>$coach_email,
				 'team_website'=>$team_website,'competition'=>$competition,
				 'team_home_uniform'=>$team_color_uniform,
				 'playing_years'=>$years_playing,
				 'team_home_address'=>$team_home_address,
				 'division'=>$division,'favortite_sports_ground'=>$sports_ground,
				 'college_playing_eligibility'=>$college_playing,
				 'style_of_play'=>$style_pay,'team_away_color'=>$team_away_color);

			$success= $this->user_model->updateTeaminfo($user_id,$data_info);
			if($success)
			{	
				 redirect('home');
			}

	}




}
