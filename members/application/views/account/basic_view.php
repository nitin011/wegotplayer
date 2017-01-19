<div class="md-card">
    <div class="md-card-content">
		<h3>Basic Setting (Change Password)</h3>

		<div class="uk-grid" data-uk-grid-margin="">
          <div class="uk-width-large-1 uk-width-medium-1"> 
          <label>Email Address</label>           
              <div class="md-input-wrapper">  				
  					<input type="email" class="md-input" value="<?php echo $email;?>" name="email" id="email" readonly>
  					<span id="email_error"> </span>
  				</div>

  				<div class="md-input-wrapper">
  				<label>Current Password </label>
  					<input type="password" class="md-input" value="" name="current_pass" id="current_pass" >
  					<span id="current_pass_error"> </span>
  				</div>

  				<div class="md-input-wrapper">
  				<label>Confirm Password</label>
  					<input type="password" class="md-input" value="" name="confirm_pass" id="confirm_pass" >
  					<span id="confirm_pass_error"> </span>
  				</div>
  				<span class="click_status"></span>

  				<div class="uk-input-group">
                  <div class="md-input-wrapper">
						<button class="md-btn md-btn-primary adept-md-btn-primary" onclick="changePassword()"  type="button">Save</button> 
					</div>
                </div>
             
           </div>
           
        </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>

<script>
function changePassword() 
{
	var current_pass = $("#current_pass").val();
	var confirm_pass = $("#confirm_pass").val();


   

	if(current_pass==null || current_pass == "")
    {
       $('#current_pass').focus();
       $('#current_pass_error').css('color', 'red');      
        $('#current_pass_error').show();
        $('#current_pass_error').text("Please Fill Password Field");
        setTimeout(function() {
          $('#current_pass_error').slideUp('slow');
          },2000);       
        return false;
    }
    if(confirm_pass==null || confirm_pass == "")
    {
       $('#confirm_pass').focus();
       $('#confirm_pass_error').css('color', 'red');      
        $('#confirm_pass_error').show();
        $('#confirm_pass_error').text("Please Fill Confirm Password Field");
        setTimeout(function() {
          $('#confirm_pass_error').slideUp('slow');
          },2000);       
        return false;
    }

    if (current_pass.length >0 ){      
       if($("#current_pass").val().length < 6){                       
        $('#current_pass').focus();
        $('#current_pass_error').show();
        $('#current_pass_error').css('color', 'red'); 
        $('#current_pass_error').text("Password must be at least 6 characters");
        setTimeout(function() {
          $('#current_pass_error').slideUp('slow');
          },2000);    
        return false;                            
        }   
             var password_allow= /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;
             if(!current_pass.match(password_allow)){ 
             $('#current_pass').focus();
                    $('#current_pass_error').show();
                    $('#current_pass_error').css('color', 'red'); 
                    $('#current_pass_error').text("Password can contain only characters, numeric digits, Symbols and first character must be a letter");
                    setTimeout(function() {
                    $('#current_pass_error').slideUp('slow');
                    },5000);    
                    return false;
                    
                    }
      }

      if (current_pass.length >0 ){      
       if($("#confirm_pass").val().length < 6){                       
        $('#confirm_pass').focus();
        $('#confirm_pass_error').show();
        $('#confirm_pass_error').css('color', 'red'); 
        $('#confirm_pass_error').text("Password must be at least 6 characters");
        setTimeout(function() {
          $('#confirm_pass_error').slideUp('slow');
          },2000);    
        return false;                            
        }   
             var password_allow= /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;
             if(!current_pass.match(password_allow)){ 
             $('#confirm_pass').focus();
                    $('#confirm_pass_error').show();
                    $('#confirm_pass_error').css('color', 'red'); 
                    $('#confirm_pass_error').text("Password can contain only characters, numeric digits, Symbols and first character must be a letter");
                    setTimeout(function() {
                    $('#confirm_pass_error').slideUp('slow');
                    },5000);    
                    return false;
                    
                    }
      }

      if(current_pass==confirm_pass){

      	$.ajax({
                  type: 'POST',
                  url: '<?php echo base_url(); ?>useraccount/changePassword',
                  data: {current_pass:current_pass,confirm_pass:confirm_pass},
                  })
                .done(function(data){
                    $('#click_status').show();
                    $('#click_status').css('color', 'green'); 
                    $('#click_status').html(data);
                    setTimeout(function() {
                    $('#click_status').slideUp('slow');
                    },5000);
                })
		
      }
      else{
      		$('#click_status').show();
            $('#click_status').css('color', 'red'); 
            $('#click_status').text("Password and Confirm Password Should be Same");
                  setTimeout(function() {
            		$('#click_status').slideUp('slow');
                    },5000);    
                return false;                    
            }


}

 
</script>