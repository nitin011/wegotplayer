<div class="login_page_wrapper">
<div class="md-card" id="login_card">    
    <div class="md-card-content large-padding" id="login_form">
     
     
        <form action="<?php echo base_url()?>user/sendReVerification" method="post"  onSubmit="return validateForm();" accept-charset="utf-8">
            
            <div class="uk-form-row">
                <label for="email">Your email</label>               
                <input class="md-input" type="text" id="email" name="email"  onblur="checkEmailActive()" autocomplete="off"/>
                <span id="email_error"></span>
            </div>
           
            <div class="uk-margin-medium-top">
                <button class="md-btn md-btn-primary md-btn-block md-btn-large adept-md-btn-primary">Resend Link</button>
            </div>
           
        </form>
    </div>
  </div>
</div>


<script>

function validateForm(){
     
   var email =$("#email").val();
   //console.log(email+" "+password);
   if(email==null || email == "")
    {
       $('#email').focus();
       $('#email_error').css('color', 'red');
       $('#email_error').show();
       $('#email_error').text("Please Fill Email Address");
        setTimeout(function() {
          $('#email_error').slideUp('slow');
          },2000);        
        return false;
    }

    if(!ValidateEmail(email))
    {
        $('#email').focus();
        $('#email_error').css('color', 'red');
        $('#email_error').show();
        $('#email_error').text("Please Enter valid Email");
        setTimeout(function() {
          $('#email_error').slideUp('slow');
          },2000);        
        return false;
    }

    

}


function ValidateEmail(email) {
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
   }

   function checkEmailActive()
    {
    var email= $("#email").val();    
    if(!email==''){
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>user/checkEmailRegister',
                data: {email:email},
            })
          .done(function(data){
            if(data=="0"){
              $('#email').focus();
              $('#email_error').css('color', 'red');
              $('#email_error').show();
              $('#email_error').text("Email not Registered  ");
               setTimeout(function() {
               $('#email_error').slideUp('slow');
              },2000);        
                return false;              
            }
          });
  }

}

</script>