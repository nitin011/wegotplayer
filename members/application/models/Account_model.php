<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account_model extends CI_Model {
	  
	  public function __construct()
	  {
	       parent::__construct();
		   $this->load->database();
	  }//function end	  
	  
	  
	  public function updatePassword($data)
	  {  
	  	   $user_id = $data['user_id'];
	  	   $password =$data['password'];

	      $this->db->where('user_id',$user_id);
	      $this->db->set('password',$password);
	  	  $query = $this->db->update('users');
		  if( $query ){
				return true;
			}
		  else{
				return false;
			}		 
	  }//function end

	  public function getUniqueId($user_id)
	  {
	  	 $this->db->select('unique_code');
	  	 $this->db->where('user_id',$user_id);	      
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
	  }//End of getUniqueId

	  public function generateUniqueId($user_id)
	  {    
	  	  $unique_code = mt_rand(100000, 999999);
	  	  $this->db->where('user_id',$user_id);
	      $this->db->set('unique_code',$unique_code);
	  	  $query = $this->db->update('users');
		  if( $query ){
				return true;
			}
		  else{
				return false;
			}
	  }

	  public function deactivateProfile($user_id){
	  	  $this->db->where('user_id',$user_id);
	      $this->db->set('activated',1);
	  	  $query = $this->db->update('users');
		  if( $query ){
				return true;
			}
		  else{
				return false;
			}
	  }

	  public function getAccountDetail($user_id,$row)
	  {	  
	  	  $this->db->select($row);	 
	  	  $this->db->where('user_id',$user_id);	      
	  	  $query = $this->db->get('users');
	  	  if($query){
	  	  	 return $query->row();
	  	  }else{
	  	  	return false;
	  	  }
	  }

	   public function activateProfile($user_id){
	  	  $this->db->where('user_id',$user_id);
	      $this->db->set('activated',0);
	  	  $query = $this->db->update('users');
		  if( $query ){
				return true;
			}
		  else{
				return false;
			}
	  }

	  public function getPrivacySettings(){
	  	$query=$this->db->get("wgp_privacy_settings");
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

	  public function insertPrivacyDefault($user_id){	  		
	  	$this->db->where('user_id',$user_id);
	  	$q=$this->db->get("wgp_user_privacy");
	  	if($q->num_rows()>0)
				{
				  return true;
				}else{
					  for($i=1;$i<=12;$i++){
		  	 			 $data = array( 'user_id'=>$user_id,'privacy_id'=>$i);
		  	 			 $query = $this->db->insert('wgp_user_privacy',$data);		  	  	 	
		  	  		  }
		  	 			 if( $query ){
								return true;
						  }else{
								return false;
						  }
				}	  	
	  }

	  public function getPrivacyValue($user_id){
	  		$this->db->where('user_id',$user_id);
	  	    $query=$this->db->get("wgp_user_privacy");
	  	     if($query->num_rows()>0)
				{
				  $privacy_vale= $query->result();
				  $data="";
                  foreach ($privacy_vale as $key=> $value) { 

                  //Start: fetching name of setting
                  $privacy_id= $value->privacy_id;
                  $this->db->select('privacy_name');
                  $this->db->where('privacy_id',$privacy_id);
	  	          $query2=$this->db->get("wgp_privacy_settings");
                  $array2= $query2->row();                 
                  $privacy_setting_name=$array2->privacy_name;
                  //End: fetching name of setting
                  $row_id= $value->privacy_id;
                  $row_a= $value->anyone;
                  $row_b= $value->nobody;
                  $row_c= $value->friends;
                  $row_d= $value->members;
                  $row_e= $value->code_receivers;


                  if($row_a==1){$row_a_checked="checked";$row_a_selected="selected";}else{$row_a_checked="";$row_a_selected="";}
                  if($row_b==1){$row_b_checked="checked";$row_b_selected="selected";}else{$row_b_checked="";$row_b_selected="";}
                  if($row_c==1){$row_c_checked="checked";$row_c_selected="selected";}else{$row_c_checked="";$row_c_selected="";}
                  if($row_d==1){$row_d_checked="checked";$row_d_selected="selected";}else{$row_d_checked="";$row_d_selected="";}
                  if($row_e==1){$row_e_checked="checked";$row_e_selected="selected";}else{$row_e_checked="";$row_e_selected="";}
                  
                       if($this->session->userdata('logged_in')){
     
                            $session_data = $this->session->userdata('logged_in');
                            $account_type=$session_data['account_type']; 

	                         if($account_type==1) {
	                              if($key==0){

			                    	  $data.="<tr id=\"privacy\">";
			                          $data.="<td class=\"title\">$privacy_setting_name</td>";
									  $data.="<td class=\"td_".$row_id."_1 $row_a_selected\" ><input  type=\"checkbox\" id=\"pr_".$row_id."_1\" value=\"$row_a\" onchange=\"updatePrivacy($row_id,1)\" $row_a_checked></td>";
									  $data.="<td class=\"td_".$row_id."_2 $row_b_selected\" ><input  type=\"checkbox\" id=\"pr_".$row_id."_2\" value=\"$row_b\" disabled='disabled'></td>";
									  $data.="<td class=\"td_".$row_id."_3 $row_c_selected\" ><input  type=\"checkbox\" id=\"pr_".$row_id."_3\" value=\"$row_c\" disabled='disabled'></td>";
									  $data.="<td class=\"td_".$row_id."_4 $row_d_selected\" ><input  type=\"checkbox\" id=\"pr_".$row_id."_4\" value=\"$row_d\" disabled='disabled'></td>";
									  $data.="<td class=\"td_".$row_id."_5 $row_e_selected\" ><input  type=\"checkbox\" id=\"pr_".$row_id."_5\" value=\"$row_e\" disabled='disabled'></td>"; 
					                  $data.="</tr>";
				                  }else{

				                  	  $data.="<tr id=\"privacy\">";
					                  $data.="<td class=\"title\">$privacy_setting_name</td>";
									  $data.="<td class=\"td_".$row_id."_1 $row_a_selected\" ><input  type=\"checkbox\" id=\"pr_".$row_id."_1\" value=\"$row_a\" onchange=\"updatePrivacy($row_id,1)\" $row_a_checked></td>";
									  $data.="<td class=\"td_".$row_id."_2 $row_b_selected\" ><input  type=\"checkbox\" id=\"pr_".$row_id."_2\" value=\"$row_b\" onchange=\"updatePrivacy($row_id,2)\" $row_b_checked></td>";
									  $data.="<td class=\"td_".$row_id."_3 $row_c_selected\" ><input  type=\"checkbox\" id=\"pr_".$row_id."_3\" value=\"$row_c\" onchange=\"updatePrivacy($row_id,3)\" $row_c_checked></td>";
									  $data.="<td class=\"td_".$row_id."_4 $row_d_selected\" ><input  type=\"checkbox\" id=\"pr_".$row_id."_4\" value=\"$row_d\" onchange=\"updatePrivacy($row_id,4)\" $row_d_checked></td>";
									  $data.="<td class=\"td_".$row_id."_5 $row_e_selected\" ><input  type=\"checkbox\" id=\"pr_".$row_id."_5\" value=\"$row_e\" onchange=\"updatePrivacy($row_id,5)\" $row_e_checked></td>"; 
					                  $data.="</tr>";

				                  }                
	                          }else{
	                          	      $data.="<tr id=\"privacy\">";
					                  $data.="<td class=\"title\">$privacy_setting_name</td>";
									  $data.="<td class=\"td_".$row_id."_1 $row_a_selected\" ><input  type=\"checkbox\" id=\"pr_".$row_id."_1\" value=\"$row_a\" onchange=\"updatePrivacy($row_id,1)\" $row_a_checked></td>";
									  $data.="<td class=\"td_".$row_id."_2 $row_b_selected\" ><input  type=\"checkbox\" id=\"pr_".$row_id."_2\" value=\"$row_b\" onchange=\"updatePrivacy($row_id,2)\" $row_b_checked></td>";
									  $data.="<td class=\"td_".$row_id."_3 $row_c_selected\" ><input  type=\"checkbox\" id=\"pr_".$row_id."_3\" value=\"$row_c\" onchange=\"updatePrivacy($row_id,3)\" $row_c_checked></td>";
									  $data.="<td class=\"td_".$row_id."_4 $row_d_selected\" ><input  type=\"checkbox\" id=\"pr_".$row_id."_4\" value=\"$row_d\" onchange=\"updatePrivacy($row_id,4)\" $row_d_checked></td>";
									  $data.="<td class=\"td_".$row_id."_5 $row_e_selected\" ><input  type=\"checkbox\" id=\"pr_".$row_id."_5\" value=\"$row_e\" onchange=\"updatePrivacy($row_id,5)\" $row_e_checked></td>"; 
					                  $data.="</tr>";
	                          }
                         }
			                  
              

                   
                     } 
                 return $data;

				}else{
					return false;
				}
	  }

  public function updatePrivacy($condition,$data)
	{
		$this->db->where($condition);				
		$this->db->set($data);
        $this->db->update('wgp_user_privacy');	
	    return true;
	}

	public  function getNotificationSettings()
	{	
		$this->db->select('notification_type');
		$this->db->select('notification_name');
		$query=$this->db->get("wgp_notification_texts");
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



	public function insertNotificationDefault($user_id)
	{
	  	$this->db->where('user_id',$user_id);
	  	$q=$this->db->get("wgp_user_notification_settings");
	  	if($q->num_rows()>0)
				{
				  return true;
				}else{
					  
		  	 			 $data = array( 'user_id'=>$user_id);
		  	 			 $query = $this->db->insert('wgp_user_notification_settings',$data);		  	  	 	
		  	  		  
		  	 			 if( $query ){
								return true;
						  }else{
								return false;
						  }
				}	  	
	  }


	  public function getNotificationValue($user_id)
	  {
	  	  $this->db->where('user_id',$user_id);
	  	  $query=$this->db->get("wgp_user_notification_settings");
	  	     if($query->num_rows()>0)
			   {
				   $row = $query->row();
                 
					//print_r($row);
					$data="";
                   for ($i=1; $i <=14; $i++) { 
                     //Start: fetching name of notification setting            
				    
					$n = 'notification_id_'.$i;					
                    $row_value= $row->$n;
                 
                  $this->db->select('notification_name');
                  $this->db->where('notification_type',$i);
	  	          $query2=$this->db->get("wgp_notification_texts");
                  $array2= $query2->row(); 

                  $notification_setting_name=$array2->notification_name;
                 
                  if($row_value==1){$row_yes_checked="checked";}else{$row_yes_checked="";}
                  if($row_value==0){$row_no_checked="checked";}else{$row_no_checked="";}

				  $data.="<div class=\"col-md-6\">"; 
                  //$data.="<div class=\"uk-width-1\">";               	
                  $data.="<label class=\"noti-title\">$notification_setting_name</label> ";                  	                	
	              $data.="<input type=\"radio\" id=\"notification_yes_$i\" name=\"$i\" value=\"1\" $row_yes_checked />";
	              $data.="<label for=\"notification_yes_$i\" class=\"inline-label\">Yes</label>";
		          $data.="<input type=\"radio\"  id=\"notification_no_$i\" name=\"$i\" value=\"0\" $row_no_checked />";
	   			  $data.="<label for=\"notification_no_$i\" class=\"inline-label\">No</label>";
 				  //$data.="</div>";
				  $data.="</div>";
				  }
                 return $data;
			   }else{
			   	  return false;
			   } 

	  }

	  public function updateNotification($user_id,$data){  	
	  				
			$this->db->where('user_id',$user_id);	  		            
		    $this->db->set($data);
            $this->db->update('wgp_user_notification_settings');	
	       return true;
	  }

 

}