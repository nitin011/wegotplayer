<span id="personal_target">
<div style="margin-left:200px;">

<div class="login_page_wrapper" style="width:500px;">
<div class="md-card" id="login_card">    
    <div class="md-card-content large-padding" id="login_form">
        <div style="color:#F00" id="error">
         <p style="color:#F00;"><?php if(validation_errors()){ echo validation_errors(); }?></p>
       </div>
       <div id="activation">
     <?php if($this->session->flashdata('registration_done')): ?>
                      <div class="row">
                            <div class="col-xs-12 col-md-12 col-sm-12">
                      <?php   echo "<h6 style='color:green'>".$this->session->flashdata('registration_done')."</h6>";  ?> 
                            </div>
                       </div>
         <?php endif; ?> 
         <?php if($this->session->flashdata('login_error')){ ?>
                      <div class="row">
                            <div class="col-xs-12 col-md-12 col-sm-12">
                      <?php   echo "<h6 style='color:#F00'>".$this->session->flashdata('login_error')."</h6>";  ?> 
                            </div>
                       </div>
         <?php } ?> 
       </div>

        <form onSubmit="return validateForm();" accept-charset="utf-8">
            
            <div class="uk-form-row">
                <label for="email">Your email</label>
                <input class="md-input" type="text" id="email" name="email" autocomplete="off"/>
                <span id="email_error"></span>
            </div>
            <div class="uk-form-row">
                <label for="password">Your Password</label>
                <input class="md-input" type="password" id="password" name="password" autocomplete="off"/> 
                <span id="password_error"></span>               
            </div>
            <div class="uk-margin-medium-top">
                <button type="button" class="md-btn md-btn-primary md-btn-block md-btn-large" id="login">Sign In</button>
            </div>
            
        </form>
    </div>
  </div>
</div>

</div>

</div>

<script>

function validateForm(){
     
   var email =$("#email").val();
   var password =$("#password").val();  
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

    if(password==null || password == "")
    {
       $('#password').focus();
       $('#password_error').css('color', 'red');      
        $('#password_error').show();
        $('#password_error').text("Please Enter valid Email");
        setTimeout(function() {
          $('#password_error').slideUp('slow');
          },2000);       
        return false;
    }    

}

$( document ).ready(function() {
     setTimeout(function() {
                    $('#error').slideUp('slow');
                    $('#activation').slideUp('slow');
                    },5000); 

    });

function ValidateEmail(email) {
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
   }

   $("#email").keyup(function(){

    var email= $("#email").val();  

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

    if(!email==''){
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>user/checkEmailActive',
                data: {email:email},
            })
          .done(function(data){
            if(data=="0"){
              $('#email').focus();
              $('#email_error').css('color', 'red');
              $('#email_error').show();
              $('#email_error').text("Email not Registered/Activated ");
               setTimeout(function() {
               $('#email_error').slideUp('slow');
              },2000);        
                return false;              
            }

          });
  }

});


   $("#login").click(function () {                
                var email =$("#email").val(); 
                var password =$("#password").val(); 

          $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url()?>front_controller/doLogin',
                      data: {email:email,password:password},
                  })
                .done(function(data){
                 // $('#personal_target').empty().html(data).fadeIn();

                window.location.reload();
                })
    });




</script>