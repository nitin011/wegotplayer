<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {

	public function __construct()
	  {
		parent::__construct();	
		$this->load->helper(array('url','security'));
		$this->load->library(array('form_validation','session','paypal_lib'));		
		$this->load->model(array('user_model','fetch_model','payment_model'));

		 function isEmail($email)
				{
				//If the username input string is an e-mail, return true
				if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
					return true;
				} else {
					return false;
				}
	        }//function end
		
	 }//end of constructor
  public function index(){ 
  	if (!$this->session->userdata('logged_in'))
			  {
			  	echo "register";
				  //If no session, redirect to login page
				  redirect('user/register', 'refresh');
				  exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
		  	$name=$session_data['name'];
		  	$email=$session_data['email'];
		  	$acc_type=$session_data['acc_type'];

		  	$type= $this->input->post('account_type');
		  	$month= $this->input->post('month');

		  		//paypal variable
		  	    $paypal_url='https://www.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
		  	   // $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
    			$paypal_id='info@wegotplayers.com'; // Business email ID
    			//$paypal_id='nitin@adeptcoders.com'; // Business email ID

			    $item_name = "WeGotPlayer ".$type." Account Payment";		    
			   
			    $logo =base_url().'images/logo.png';			    
			    $notifyURL = base_url().'payment/ipn'; //ipn url
			    $cancel_return = base_url()."payment/cancel";
			    $return =base_url()."payment/success";
			  
		  	if($type==$acc_type){
		  		echo '<p class="intro text-center">Your account is already "'.$type.'" account </p>';
		  	}else{
		  		if($type=="PRO"){
		  			$amount_detail =$this->payment_model->getAccountPrice(3);

		  		}
		  		if($type=="PLUS"){
		  			$amount_detail =$this->payment_model->getAccountPrice(2);		  			
		  		}

		  	$yearly_amount = $amount_detail->price;
		  	 			//calculate paid amount with discount
		  	 $amount = $this->paidAmount($month,$yearly_amount);

	        $this->paypal_lib->add_field('business', $paypal_id);
	        $this->paypal_lib->add_field('return', $return);
	        $this->paypal_lib->add_field('cancel_return', $cancel_return);
	        $this->paypal_lib->add_field('notify_url', $notifyURL);
	        $this->paypal_lib->add_field('item_name', $item_name);
	        $this->paypal_lib->add_field('custom', $user_id);
	        $this->paypal_lib->add_field('item_number', $month.'_month_'.$type);
	        $this->paypal_lib->add_field('amount',  $amount);        
	        $this->paypal_lib->image($logo);        

	        $this->paypal_lib->paypal_auto_form();

		}//else end
		
    }//end of index function

    public function paidAmount($month,$yearly_amount){
    	if($month ==1){
		  		$monthly=$yearly_amount/12;
				return $amount= sprintf("%01.2f", $monthly);
		  	}//for one month
		  	if($month ==3){
		  		$quarterly=$yearly_amount/4;
				$quarterly = $quarterly-(($quarterly*20)/100);
				return $amount =sprintf("%01.2f", $quarterly);
		  	}//for 3 month

		  	if($month ==6){
		  		$half_yearly=$yearly_amount/2;
        	   $half_yearly = $half_yearly-(($half_yearly*30)/100);
                return $amount = sprintf("%01.2f", $half_yearly);
		  	}
		  	if($month ==12){
		  		$yearly=$yearly_amount;
				$yearly = $yearly-(($yearly*50)/100);
				return $amount = sprintf("%01.2f", $yearly);
		  	}
    }//end amount function 

    
    public function plusPlan(){
    	$amount_detail =$this->payment_model->getAccountPrice(2);
    	$yearly_amount=$amount_detail->price;
    	$data = array('yearly_amount' => $yearly_amount);
    	$this->load->view('payment/plus_plan_view',$data);
    }

    public function proPlan(){
        $amount_detail =$this->payment_model->getAccountPrice(3);
    	$yearly_amount=$amount_detail->price;
    	$data = array('yearly_amount' => $yearly_amount);
    	$this->load->view('payment/pro_plan_view',$data);
    }

    function ipn(){
        //paypal return transaction details array
        $paypalInfo    = $this->input->post();

        $data['user_id'] = $paypalInfo['custom'];
        $data['product_id']    = $paypalInfo["item_number"];
        $data['txn_id']    = $paypalInfo["txn_id"];
        $data['payment_gross'] = $paypalInfo["payment_gross"];
        $data['currency_code'] = $paypalInfo["mc_currency"];
        $data['payer_email'] = $paypalInfo["payer_email"];
        $data['payment_status']    = $paypalInfo["payment_status"];

        $paypalURL = $this->paypal_lib->paypal_url;        
        $result    = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
       
        
    }
 	public function cancel(){
 		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user/register', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
		  	$name=$session_data['name'];
		  	$data = array('name' => $name);
 		  $this->load->view("header");		
 		  $this->load->view("payment/cancel_view",$data);
		  $this->load->view('footer_out_view');			
		  $this->load->view("footer");
 	}

 	public function success(){
 		if (!$this->session->userdata('logged_in'))
			  {
				  //If no session, redirect to login page
				   redirect('user/register', 'refresh');
				   exit();
			  }
			$session_data = $this->session->userdata('logged_in');
			$user_id=$session_data['user_id'];
		  	$name=$session_data['name'];
		  

 		//get the transaction data
        $paypalInfo = $this->input->get();

        print_r($paypalInfo);

         if($paypalInfo) {
	        $item_detail = $paypalInfo['item_number']; 
	        $txn_id = $paypalInfo["tx"];
	        $payment_amt = $paypalInfo["amt"];
	        $currency_code = $paypalInfo["cc"];
	        $status = $paypalInfo["st"];
	        $userid = $paypalInfo["cm"];
	       
	       $data = array('user_id'=>$userid,'txid'=>$txn_id,'amount'=>$payment_amt,
		        		  'currency'=>$currency_code,'status'=>$status);

	       		$detail_arry = explode('_', $item_detail);
	       		
	       		$month = $detail_arry[0];
	       		$ac_type = $detail_arry[2];

	       		if($ac_type=="PLUS"){
	       			$ac_type=2;
	       		}
	       		else if($ac_type=='PRO'){
	       			$ac_type=3;
	       		}else{
	       			$ac_type=1;
	       		}
	       		
	       		$validity = array('user_id'=>$userid,'account_type'=>$ac_type,'month'=>$month);

	       		$update_validity = $this->payment_model->updateAccountValidity($validity);
		        //check whether the payment is verified
		      
	            //insert the transaction data into the database
	            $result=$this->payment_model->insertTransaction($data);
	            if($result){
	            	 redirect('user', 'refresh');
				      exit();	
	            }
		        //pass the transaction data to view
		        $this->load->view("header");
		        $this->load->view('payment/success_view', $data);
		        $this->load->view('footer_out_view');			
				$this->load->view("footer");

		
		}
 	}//end success function

 }//end of Payment controller class
 ?>