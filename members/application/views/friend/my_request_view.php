<div class="md-card">
   <div class="md-card-content tx-md-card-content-adept">
     <div class="friend_list friend_list_frnd">

   <?php  if(count($pending_req)>0){
   foreach ($pending_req as $key => $value) { ?>
   	
     <div class="md-card-head friend_box friend_box_black">       
          
          <div class="uk-text-center">
              <img alt="" src="<?php echo $value['pic_url'];?>" class="md-card-head-avatar">
           </div>
          <h3 class="md-card-head-text uk-text-center uk_adept_main">
               <?php echo ucwords($value['user']->name); ?>
          	<span><?php //echo $value['user']->email;?></span>
           </h3>
          <a class="uk-text-plain">
           <i class="md-icon material-icons md-icon-light" title="Cancel Request" >&#xE14C;</i>
           
         </a>
     </div>

     <?php }  }?>
     



    </div>

<h3 class="">Invite your friends! </h3>
<p>Enter the email addresses of your friends you want to invite.</p>
  <div class="uk-grid" data-uk-grid-margin="">
     <div class="uk-width-large-1-2 uk-width-medium-1-2">            
        <div class="md-input-wrapper">  				
  				 <input type="email" class="md-input" value="" name="email" id="email" placeholder="Friend Email" onblur="checkEmail()">
  					<span id="email_error"> </span>
  			 </div>
      </div>
  <div class="uk-width-large-1-2 uk-width-medium-1-2">
     <div class="uk-input-group">
        <div class="md-input-wrapper">
						<button class="md-btn md-btn-primary adept-md-btn-primary" onclick="addFriend()" value="add" id="add" type="button">Send Invitation</button> 
				</div>
      </div>
   </div>
  </div>
 </div>
</div>

<script>
//chech email registered or Not
function checkEmail()
{
	var email = $('#email').val();
	if(!email==''){
    	$.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>friendcontroller/checkEmailRegistered',
                data: {email:email},
            })
          .done(function(data){
          	if(data==1){          		
              $('#email_error').css('color', 'green');
              $('#email_error').show();
              $('#email_error').text("valid email ");
               setTimeout(function() {
               $('#email_error').slideUp('slow');
              },2000);

          	} else if(data==0) {          	  
	              $('#email_error').css('color', 'red');
	              $('#email_error').show();
	              $('#email_error').text("Email not Registered ");
	               setTimeout(function() {
	               $('#email_error').slideUp('slow');
	              },2000);
          	}
          })
       }  
  }
//Start Sending Request
function addFriend()
{
	var email = $('#email').val();	
	if(!email==''){
    	$.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>friendcontroller/sendRequest',
                data: {email:email},
            })
          .done(function(data){

          })
      }
} //End Sending Request


</script>