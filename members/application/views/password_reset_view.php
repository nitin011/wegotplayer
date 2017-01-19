<div class="login_page_wrapper">
    <div class="md-card" id="login_card"> 
        <div id="login_password_reset" class="md-card-content large-padding">
             <h2 class="heading_a uk-margin-large-bottom">Reset password</h2>
            <div class="uk-form-row">
                <div class="md-input-wrapper">
                    <label for="login_email_reset">Your email address</label>
                    <input type="text" name="email_reset" id="email_reset" class="md-input">
                    <span id="reset_status"></span>
                </div>                        
            </div>
             <div class="uk-margin-medium-top">
                 <button type="button" id="reset_password" class="md-btn md-btn-primary md-btn-block adept-md-btn-primary">Reset Password</button>
             </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
  $("#reset_password").click(function () { 
        var email =$("#email_reset").val();  
  
        if(email==null || email == "")
         {
            $('#email_reset').focus();
            $('#reset_status').css('color', 'red');
            $('#reset_status').show();
            $('#reset_status').text("Please Fill Email Address");
                setTimeout(function() {
                $('#reset_status').slideUp('slow');
                },2000);        
                return false;
        }

        if(!ValidateEmail(email))
        {
            $('#email_reset').focus();
            $('#reset_status').css('color', 'red');
            $('#reset_status').show();
            $('#reset_status').text("Please Enter valid Email");
            setTimeout(function() {
              $('#reset_status').slideUp('slow');
              },2000);        
            return false;
       } else{
         $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>user/resetPassword',
                data: {email:email},
            })
          .done(function(data){
             $('#reset_status').show();
             $('#reset_status').text(data);
               setTimeout(function() {
              $('#reset_status').slideUp('slow');
              },5000);        
            return false;
          });
       }

  });






function ValidateEmail(email) {
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
   }


});
</script>