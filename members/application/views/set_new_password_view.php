<div class="login_page_wrapper">
    <div class="md-card" id="login_card"> 
        <div id="login_password_reset" class="md-card-content large-padding">
             <h2 class="heading_a uk-margin-large-bottom">Reset Password</h2>
             <input type="hidden" id="user_id" value="<?php echo $user_id; ?>">
            <div class="uk-form-row">
                <div class="md-input-wrapper">
                    <label for="login_email_reset">New Password</label>
                    <input type="password" name="password" id="new_password" class="md-input">
                    <span id="new_password_error"></span>
                </div>                        
            </div>
             <div class="uk-form-row">
                <div class="md-input-wrapper">
                    <label for="confirm_password">Confirm New Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="md-input">
                    <span id="confirm_password_error"></span>
                </div>                        
            </div>
             <div class="uk-margin-medium-top">
                 <button type="button" id="set_new_password" class="md-btn md-btn-primary md-btn-block adept-md-btn-primary">Reset Password</button>
             </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
  $("#set_new_password").click(function () { 
        var user_id =$("#user_id").val();
        var new_password =$("#new_password").val(); 
        var confirm_password =$("#confirm_password").val();  
  
        if(new_password==null || new_password == "")
         {
            $('#new_password').focus();
            $('#new_password_error').css('color', 'red');
            $('#new_password_error').show();
            $('#new_password_error').text("Enter New Password.");
                setTimeout(function() {
                $('#new_password_error').slideUp('slow');
                },2000);        
                return false;
        }

        if(confirm_password==null || confirm_password == "")
         {
            $('#confirm_password').focus();
            $('#confirm_password_error').css('color', 'red');
            $('#confirm_password_error').show();
            $('#confirm_password_error').text("Enter Confirm Password.");
                setTimeout(function() {
                $('#confirm_password_error').slideUp('slow');
                },2000);        
                return false;
        }
        if(new_password==confirm_password) {
         $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>user/submitNewPassword',
                data: {user_id:user_id,new_password:new_password},
            })
          .done(function(data){
             var url ="<?php echo base_url();?>";
             window.location = url;            
          });
       }else{
            $('#confirm_password_error').show();
            $('#confirm_password_error').text("Enter same password in both field .");
                setTimeout(function() {
                $('#confirm_password_error').slideUp('slow');
                },2000);        
                return false;
       }
    });

  });
  </script>