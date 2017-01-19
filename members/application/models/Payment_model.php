<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Payment_model extends CI_Model {
	  
	  public function __construct()
	  {
	       parent::__construct();
		   $this->load->database();
		   date_default_timezone_set('Asia/Kolkata');
	  }//function end

	  function insertTransaction($data){
	  	 $user_id=$data['user_id'];
	     $query=$this->db->insert('wgp_paypal_transactions',$data);
	     if($query){
	     	return true;	     
	     }else{
	     	return false;
	     }
	}


	public function checkSubscription($user_id){
	    $this->db->where('user_id',$user_id);
	    $query = $this->db->get('wgp_account_subscriptions');
	    if($query->num_rows()>0)
			{
				return $query->result();
			}else{
				return false;
			}
	}

	public function updateAccountValidity($validity){

		  $user_id =$validity['user_id'];

		  $subscription_validity_arry =$this->checkSubscription($user_id);
		  
		//get last row of subscription of user
		   $last_detail = end($subscription_validity_arry);
		   $last_date=$last_detail->valid_thru;
		   
		  $account_type=$validity['account_type'];
		  $today =date('Y-m-d H:i:s');		 
		  $month =$validity['month'];

		  	//compair date of expiry to today for upadate
        if(strtotime($today) > strtotime($last_date)){
        	 $valid_thru = date('Y-m-d H:i:s', strtotime("+$month months", strtotime($today)));
        	 $start_date = $today;
        }else{
        	 $valid_thru = date('Y-m-d H:i:s', strtotime("+$month months", strtotime($last_date)));
        	 $start_date = $last_date;
        }
 		
 		$detail = array('user_id' => $user_id, 'start_date'=>$start_date,
		  				  'valid_thru'=>$valid_thru,'account_type'=>$account_type);

		 
		  $query=$this->db->insert('wgp_account_subscriptions',$detail);
		  if($query){
		  	$update_acc=$this->updateUserAccountType($user_id,$account_type);
		  	return true;	     
	     }else{
	     	return false;
	     }
	}

	public function updateUserAccountType($user_id,$account_type){
		 $this->db->where('user_id', $user_id);	
		 $this->db->set('account_type',$account_type);
		 $this->db->update('users');
		 $affected_row=$this->db->affected_rows();	
	       if($affected_row>0){
	       		return true;
	       }else{
	       		return false;
	       }	
	}	

	public function getAccountPrice($account_type){
	   $this->db->where('id',$account_type);
	   $query = $this->db->get('master_account_type');
	    if($query->num_rows()>0)
			{
				return $query->row();
			}else{
				return false;
			}

	}


}//end of Payment model class
?>
	  