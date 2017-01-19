<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fetch_model extends CI_Model {
	  
	  public function __construct()
	  {
	       parent::__construct();
		   $this->load->database();
	  }//function end	  
	  
	  
	  public function user_details($user_id)
	  { 	       
	  	 $row = array('user_id','birth_year','birth_month','birth_day','graduation_year',
	  	 			'graduation_month','first_name','last_name','gender','nationality',
	  	 			'sport','level','position_speciality','hand','foot','height','weight',
	  	 			'location','address','zip','state','city','city'); 
	      $this->db->where("user_id",$user_id);
		  $query=$this->db->get("wgp_player_data");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
		 
	  }//function end



	  public function getPersonalInfo($user_id)
	  {		
	  	
	  	  $this->db->where("user_id",$user_id);
		  $query=$this->db->get("wgp_player_personal");		  
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   
	  }

	  public function chechPlayerData($user_id){
	  	$this->db->where("user_id",$user_id);
		  $query=$this->db->get("wgp_player_data");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return true;
				}else{
				  return false;
				}
		   }
	  }

	  public function getUseName($user_id)
	  { 	       
	  
	      $this->db->where("user_id",$user_id);
	      $this->db->select('login_name');
		  $query=$this->db->get("users");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	  public function userDetailForReset($email)
	  { 	       
	  
	      $this->db->where("email",$email);	      
		  $query=$this->db->get("users");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	  public function hashVerify($verify_hash){
	  	  $this->db->where("verify_hash",$verify_hash);	      
		  $query=$this->db->get("users");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
	  }

	  public function school_details($user_id)
	  { 	       
	  
	      $this->db->where("wgp_user_id",$user_id);
		  $query=$this->db->get("wgp_school");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	  public function technical_details($user_id)
	  { 	       
	  	  $this->checkTechnical($user_id);
	      $this->db->where("wgp_user_id",$user_id);
		  $query=$this->db->get("wgp_customform_technical");
		  if($query->num_rows()>0){
			   return $query->row();
		   }else{
			  return false;
			}		   
		 
	  }//function end

	   public function  checkTechnical($user_id){
	   	   $this->db->where("wgp_user_id",$user_id);
		   $query=$this->db->get("wgp_customform_technical");
		   if($query->num_rows()==0){
		   		$this->insertTechnical($user_id);
		   }else{
		     	return true;
		   }
	   }

	   public function insertTechnical($user_id){
	   	  $data = array('technique' => 1,'control' => 1,
	 					'accuracy' => 1,'dribbling' => 1,
	 					'finishing' => 1,'heading' => 1,
	 					'long_passing' => 1,'running' => 1,
	 					'shooting' => 1,'shielding' => 1,
	 					'turning' => 1,'defending' =>1,
	 					'receiving' => 1,'distribution' => 1,
	 					'aerial_control' => 1,
	 					'wgp_user_id' =>$user_id);
		  $this->db->insert('wgp_customform_technical',$data);
		   return true;
       }//function end



       public function tactical_details($user_id){
	  	  $this->checkTactical($user_id);
	      $this->db->where("wgp_user_id",$user_id);
		  $query=$this->db->get("wgp_customform_tactical");		  
		   if($query->num_rows()>0)
			{
			  return $query->row();
			}else{
			  return false;
			}		 
	  }

      public function  checkTactical($user_id){
	   	   $this->db->where("wgp_user_id",$user_id);
		   $query=$this->db->get("wgp_customform_tactical");
		   if($query->num_rows()==0){
		   		$this->insertTactical($user_id);
		   }else{
		     	return true;
		   }
	   }

	     public function insertTactical($user_id){
	     	$data = array('game_awarness' => 1,'support' =>1,
	 					'overlaps' => 1,'balance' => 1,
	 					'decissions_making' => 1,'marking' => 1,
	 					'pressing' => 1,'covering' => 1,
	 					'compactness' => 1,'recovery' => 1,
	 					'possesion' => 1,'transition' => 1,
	 					'responsivness'=> 1,
	 					'adaptability' => 1,
	 					'anticipation' => 1,
	 					'wgp_user_id' =>$user_id);
	     	$this->db->insert('wgp_customform_tactical',$data);
			  return true;
	     }

	    

	 



	  public function physical_details($user_id){
	  	 $this->checkPhysical($user_id);
	  	 $this->db->where("wgp_user_id",$user_id);
		  $query=$this->db->get("wgp_customform_psysical");	
		   if($query->num_rows()>0)
			{
			  return $query->row();
			}else{
			  return false;
			}

	  }

	   public function  checkPhysical($user_id){
	   	   $this->db->where("wgp_user_id",$user_id);
		   $query=$this->db->get("wgp_customform_psysical");
		   if($query->num_rows()==0){
		   		$this->insertPhysical($user_id);
		   }else{
		     	return true;
		   }
	   }


	   public function insertPhysical($user_id){
	   	    $data = array('acceleration' => 1,'agility' => 1,
	 					'balance' =>1,'coordination' => 1,
	 					'reaction' => 1,'speed' => 1,
	 					'jumping' => 1,'strength' => 1,
	 					'flexibility' => 1,'endurance' => 1,
	 					'quickness' =>1,'power' => 1,
	 					'basic_motor_skills'=> 1,'mobility' =>1,
	 					'explosivness' => 1,
	 					'wgp_user_id' =>$user_id);	   	   
	     	$this->db->insert('wgp_customform_psysical',$data);
			 return true;
	     }


	   public function psyhosocial_details($user_id){
	   	  $this->checkPsyhosocial($user_id);
	   	  $this->db->where("wgp_user_id",$user_id);
		  $query=$this->db->get("wgp_customform_psyhosocial");		 
		   if($query->num_rows()>0)
			{
			  return $query->row();
			}else{
			  return false;
			}

	   }

	    public function  insertPsyhosocial($user_id){
	    	$data = array('attitude' => 1,'self_confidence' => 1,
	 					'honesty' => 1,'cooperation' => 1,
	 					'communication' => 1,'competitivness' => 1,
	 					'passion' => 1,'discipline' => 1,
	 					'focus' => 1,'leadership' => 1,
	 					'vision' => 1,'respect' => 1,
	 					'character'=> 1,'motivation' => 1,
	 					'trustworthiness' => 1,
	 					'wgp_user_id' =>$user_id);
	     	$this->db->insert('wgp_customform_psyhosocial',$data);
			  return true;
	     }

	     public function  checkPsyhosocial($user_id){
	   	   $this->db->where("wgp_user_id",$user_id);
		   $query=$this->db->get("wgp_customform_psyhosocial");
		   if($query->num_rows()==0){
		   		$this->insertPsyhosocial($user_id);
		   }else{
		     	return true;
		   }
	   }

	   public function stats_details($user_id,$row)
	   {
	   	  $this->db->select($row);
	   	  $this->db->where("wgp_user_id",$user_id);	   	 
	   	  $this->db->order_by("season", "desc"); 
		  $query=$this->db->get("wgp_customform_stats");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	   }

	   public function getSportId($user_id){
	   	$this->db->where("user_id",$user_id);
	   	$this->db->select('sport');
		  $query=$this->db->get("wgp_player_data");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
	   }
	   public function getLevel($user_sport_id){
	   	$this->db->where("sportId",$user_sport_id);
	   	$this->db->select('	levelId');
	   	$this->db->select('	levelName');
		  $query=$this->db->get("wgp_levels");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	   }

	  public function getCompetition(){
	  	$query=$this->db->get("master_competition");
	  	 if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	  }

	  public function getPlayingYear(){
	  	$query=$this->db->get("master_playing_year");
	  	 if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	  }

	  public function getDivision(){
	  	$query=$this->db->get("master_division");
	  	 if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	  }

	  public function getColor(){
	  	$query=$this->db->get("master_uniform_color");
	  	 if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	  }

	  public function getPlayStyle(){
	  	$query=$this->db->get("master_play_style");
	  	 if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	  }

	  public function getSportGround(){
	  	$query=$this->db->get("master_sport_ground");
	  	 if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	  }
      public function checkTeam($user_id)
      {
      	$this->db->where("wgp_user_id",$user_id);
		$query=$this->db->get("wgp_teaminfo");
		if($query->num_rows()>0)
				{
				  return true;
				}else{
				  return false;
				}
      }

	   public function teamInfo($user_id,$row)
	   {
		   	$this->db->select($row);
		   	$this->db->where("wgp_user_id",$user_id);
		  	$query=$this->db->get("wgp_teaminfo");
		  	if(!$query){
			   return false;
		  	 }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }

	   }
	   public function getTeamValue($user_id)
	   {
		   	$this->db->where("wgp_user_id",$user_id);
		  	$query=$this->db->get("wgp_teaminfo");
		  	if(!$query){
			   return false;
		  	 }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	   }
	   public function referenceDetail($user_id,$row)
	   {
	   	   $this->db->select($row);
	   	  $this->db->where("wgp_user_id",$user_id);
		  $query=$this->db->get("wgp_customform_references");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	   }
	   public function getReferRow($user_id,$wgp_table_id){
	   	$this->db->where("wgp_user_id",$user_id);
	   	$this->db->where("wgp_table_id",$wgp_table_id);
		  $query=$this->db->get("wgp_customform_references");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	   }

	   public function getOccupation(){
	  	$query=$this->db->get("master_occupation");
	  	 if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	  }

	  public function getComment($user_id){
	  	$this->db->where("wgp_user_id",$user_id);
	  	$query=$this->db->get("wgp_customform_comments");
	  	 if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	  }
	  public function getCommentRow($user_id,$wgp_table_id){
	  	$this->db->where("wgp_user_id",$user_id);
	   	$this->db->where("wgp_table_id",$wgp_table_id);
		  $query=$this->db->get("wgp_customform_comments");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
	  }
/*
	  public function getHonors($user_id)
	  {	 
	  	$this->db->where("wgp_user_id",$user_id);
	  	$query=$this->db->get("wgp_customform_honors");

	  	 if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	  }*/

	  public function getHonors($user_id,$row){
	  	$this->db->select($row);
	  	$this->db->where("wgp_user_id",$user_id);
	  	$query=$this->db->get("wgp_customform_honors");
	  	 if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	  }
	  
	    
	  public function getHonorsType(){
	  	$query=$this->db->get("master_honor_type");
	  	 if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	  }

	  public function getAwardDescription(){
	  	$query=$this->db->get("master_award_description");
	  	 if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	  }

	  public function getExperiance($user_id){	  	
	  	$this->db->where("wgp_user_id",$user_id);
	  	$query=$this->db->get("wgp_customform_leadership");
	  	 if(!$query){	  	 	  
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	  }

	  public function getLeadershipRow($user_id,$wgp_table_id){
	  	$this->db->where("wgp_user_id",$user_id);
	  	$this->db->where("wgp_table_id",$wgp_table_id);
	  	$query=$this->db->get("wgp_customform_leadership");
	  	 if(!$query){	  	 	  
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
	  }
	  public function getStatsRow($user_id,$table_row){
	  	$this->db->where("wgp_user_id",$user_id);
	  	$this->db->where("wgp_table_id",$table_row);
	  	$query=$this->db->get("wgp_customform_stats");
	  	 if(!$query){	  	 	  
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
	  }

	  public function testscore_details($user_id)
	  {  
	  	$query=$this->db->query("SELECT wgp_table_id,wgp_user_id,test_score,out_of,
		  	                        test_subject(test_subject) test_subject,
		  	                        test_type(test_type) test_type,
		  	                        location_of_test,date_of_test 
		  	                        FROM wgp_customform_testscores 
		  	  						WHERE wgp_user_id=$user_id");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		 
	  }//function end
	  public function testrow_details($wgp_row_id,$user_id){
	  	$query =$this ->db->query("SELECT wgp_table_id,test_score,out_of,test_subject,
	  									  test_type,location_of_test,date_of_test 
	  								FROM wgp_customform_testscores 
		  	  						WHERE wgp_user_id=$user_id 
		  	  						AND wgp_table_id=$wgp_row_id");
	  	if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
	  }

	  public function transcripts_details($user_id,$data){
	  	  $this->db->select($data);
	  	  $this->db->where("wgp_user_id",$user_id);
		  $query=$this->db->get("wgp_customform_transcripts");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	  }
	  
	  public function trasnscriptsRow($wgp_row_id,$user_id){
	  	  $this->db->where("wgp_table_id",$wgp_row_id);
	  	  $this->db->where("wgp_user_id",$user_id);
		  $query=$this->db->get("wgp_customform_transcripts");
	  	if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }

	  }
	  public function getHonorRow($user_id,$wgp_row_id){
	  	 $this->db->where("wgp_table_id",$wgp_row_id);
	  	  $this->db->where("wgp_user_id",$user_id);
		  $query=$this->db->get("wgp_customform_honors");
	  	if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
	  }

	   public function user_month($month_id)
	  	{ 
	  	  $this->db->where("monthId",$month_id);
		  $query=$this->db->get("wgp_months");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	  public function user_nationality($nationality)
	  	{ 
	  	  $this->db->where("id",$nationality);
		  $query=$this->db->get("nationalities");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	  public function user_sport($sport_id)
	  	{ 
	  	  $this->db->where("sportId",$sport_id);
		  $query=$this->db->get("wgp_sports");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	  public function getSportLevel($sport_id){
	  	 $this->db->where("sportId",$sport_id);
		  $query=$this->db->get("wgp_levels");
		  if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
	  }
      public function getSportPosition($sport_id){
      	  $this->db->where("sportId",$sport_id);
		  $query=$this->db->get("wgp_positions");
		  if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
      }

	  public function user_level($level_id)
	  	{ 
	  	  $this->db->where("levelId",$level_id);
		  $query=$this->db->get("wgp_levels");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	  public function user_position($position_id)
	  	{ 
	  	  $this->db->where("positionId",$position_id);
		  $query=$this->db->get("wgp_positions");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	  public function user_hand($hand_id)
	  	{ 
	  	  $this->db->where("handId",$hand_id);
		  $query=$this->db->get("wgp_hand");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	  public function user_foot($foot_id)
	  	{ 
	  	  $this->db->where("footId",$foot_id);
		  $query=$this->db->get("wgp_foots");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	  
	  public function user_height($height_id)
	  	{ 
	  	  $this->db->where("id",$height_id);
		  $query=$this->db->get("wgp_heights");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	  public function user_weight($weight_id)
	  	{ 
	  	  $this->db->where("id",$weight_id);
		  $query=$this->db->get("wgp_weights");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
		 
	  }//function end


	  public function user_country($location_id)
	  	{ 
	  	  $this->db->where("idCountry",$location_id);
		  $query=$this->db->get("countries");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	  public function user_find($find_id)
	  	{ 
	  	  $this->db->where("findId",$find_id);
		  $query=$this->db->get("wgp_findings");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	  public function nation()
	  	{ 
		  $query=$this->db->get("nationalities");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		 
	  }//function 
	  public function country()
	  	{ 
		  $query=$this->db->query("SELECT idCountry,countryName FROM countries ORDER BY countryName ASC");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	  public function sport()
	  	{ 	  	  
		  
	  	  $this->db->order_by("sportName", "asc"); 	  	  
		  $query=$this->db->get("wgp_sports");
	  	//$query=$this->db->query("SELECT * FROM `wgp_sports` ORDER BY sportName ASC");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	  public function user_selectLevel($id)
	  	{ 
	  	  $this->db->where("sportId",$id);	  	  
		  $query=$this->db->get("wgp_levels");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		 
	  }//function end 

	  
	  public function user_selectPosition($id)
	  	{ 
	  	  $this->db->where("sportId",$id);	  	  
		  $query=$this->db->get("wgp_positions");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		 
	  }//function end 

	   public function hand()
	  	{ 	  	  
		  $query=$this->db->get("wgp_hand");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	   public function foot()
	  	{ 	  	  
		  $query=$this->db->get("wgp_foots");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	  public function height()
	  	{ 	  	  
		  $query=$this->db->get("wgp_heights");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	   public function weight()
	  	{ 	  	  
		  $query=$this->db->get("wgp_weights");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		 
	  }//function end
 	public function getSeeking()
	  	{ 	  	  
		  $query=$this->db->get("master_seeking");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		}
		public function getContactYou()
	  	{ 	  	  
		  $query=$this->db->get("master_contact_you");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		}
	   public function find()
	  	{ 	  	  
		  $query=$this->db->get("wgp_findings");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	    public function testType()
	  	{ 
		  $query=$this->db->get("master_test_type");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		 
	  }//function
	  public function subject()
	  	{ 
		  $query=$this->db->get("master_subject");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		 
	  }//function

public function subjectType($subject_type)
	  	{ 
	  	  $this->db->where("id",$subject_type);
		  $query=$this->db->get("master_subject");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		 
	  }//function

	   public function getTestType($test_type)
	  	{ 
	  	  $this->db->where("id",$test_type);
		  $query=$this->db->get("master_test_type");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		 
	  }//function

	   public function degreeLevel()
	  	{ 
		  $query=$this->db->query("SELECT id,degreeName 
		  						 FROM master_degree_level 
		  						 ORDER BY degreeName ASC");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		 
	  }//function end
	   public function courseName()
	  	{ 
		  $query=$this->db->query("SELECT id,courseName 
		  						 FROM master_course_name 
		  						 ORDER BY courseName ASC");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	  public function courseLevel()
	  	{ 
		  $query=$this->db->query("SELECT id,levelName 
		  						 FROM master_course_level 
		  						 ORDER BY levelName ASC");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		 
	  }//function end
	  

	  public function schoolYear()
	  	{ 
		  $query=$this->db->query("SELECT id,yearName 
		  						 FROM master_school_year");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	  public function academicYear()
	  	{ 
		  $query=$this->db->query("SELECT id,gradeValue 
		  						 FROM master_academic_grade");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
		 
	  }//function end

	  public function getInjur($user_id,$row)
	  {
	  	  $this->db->select($row);
	  	  $this->db->where("wgp_user_id",$user_id);
		  $query=$this->db->get("wgp_customform_injuries");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	  }

	  public function getInjuryType(){
	  	$query=$this->db->get("master_type_injury");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	  }

	  public function getBodyArea(){
	  	$query=$this->db->get("master_body_area");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	  }
	  public function getBodyPart(){
	  	$query=$this->db->get("master_body_part");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	  }

	  public function getSurgery(){
	  	$query=$this->db->get("master_surgery");
		  if(!$query){
			   return false;
		   }else{
			   if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
		   }
	  }

	  public function getInjurRow($user_id,$wgp_table_id)
	  {	
	  		$this->db->where("wgp_user_id",$user_id);
	  		$this->db->where("wgp_table_id",$wgp_table_id);
	  		$query=$this->db->get("wgp_customform_injuries");
		    if(!$query){
			   return false;
		     }else{
			   if($query->num_rows()>0)
				{
				  return $query->row();
				}else{
				  return false;
				}
		   }
	  }

	  public function getCoachLevel(){
	  	 $query=$this->db->get("coach_level");
	  	 if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
	    }

	   public function getAskedReference($user_id){
	   	 $row = array('id','name','refer_occupation(occupation) occupation',
	   	 			'organization','coach_level_name (level) level','phone','comment','status');
	   	 $this->db->select($row);
	   	 $this->db->where('refere_for_user_id',$user_id);
	   	 $this->db->where('status',1);
	   	 $this->db->or_where('status',2);
	   	 $this->db->or_where('status',3);
	   	 $query=$this->db->get("refer");
	  	 if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
	   }

	   public function getAskedReferenceActive($user_id){
	   		$row = array('name','refer_occupation(occupation) occupation',
	   	 			'organization','coach_level_name (level) level','phone','comment');
	   	 $this->db->select($row);
	   	 $this->db->where('refere_for_user_id',$user_id);
	   	 $this->db->where('status',1);	   	 
	   	 $this->db->or_where('status',3);
	   	 $query=$this->db->get("refer");
	  	 if($query->num_rows()>0)
				{
				  return $query->result();
				}else{
				  return false;
				}
	   }

	  







}