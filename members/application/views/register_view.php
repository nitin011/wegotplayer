<style type="text/css">
#password_info p{
   background-color: #ccc;
   padding: 3px 0 4px 12px;
}

#login_card{
   margin-top: 40px!important;
}

</style>
<div class="login_page_wrapper">
<div class="md-card" id="login_card">
    <div class="md-card-content large-padding" id="login_form">
        
        <form action="<?php echo base_url()?>user/doRegister" method="post" onSubmit="return validateForm()" accept-charset="utf-8">
            <div ><?php  
			          echo  validation_errors();
			         if($this->session->flashdata('registration_error')): 
                        echo "<h4 style='color:#F00;'>".$this->session->flashdata('registration_error')."</h4>";  
                   endif;
				  ?>  
              </div>
           
            <div class="uk-form-row">
                <label for="fname">First Name</label>
                <input class="md-input" type="text" id="fname" name="fname" value="<?=set_value('fname')?>"/>
                <span id="fname_error"></span>
            </div>
            <div class="uk-form-row">
                <label for="lname">Last Name</label>
                <input class="md-input" type="text" id="lname" name="lname" value="<?=set_value('lname')?>"/>
                <span id="lname_error"></span>
            </div>
            <div class="uk-form-row">
                <label for="email">Your Email </label>
                <input class="md-input" type="text" id="email" name="email" onblur="checkEmail();" value="<?=set_value('email')?>"/>
                <span id="email_error"></span>
            </div>
            
            <div class="uk-form-row">
                <label for="password">Your Password  </label> 

                <input class="md-input" type="password" id="password" name="password"  onfocus="showPasswordInfo()" onblur="hideMsg()"/ <?php echo set_value('password'); ?>>
                <span id="password_error"></span>
                <span id="password_info"></span>
            </div>

        

            <div class="uk-form-row">
                <label for="usertype" class="uk-form-label">User Type<span class="req">*</span></label>
                <input  type="radio" id="player" name="usertype" value="1"/> 
                <label for="Player" class="inline-label">Player</label>
                <input  type="radio" id="recruiter" name="usertype" value="2" />
                <label for="Recruiter" class="inline-label">Recruiter</label>
                <span id="player_error"></span>
            </div>
            <div class="uk-margin-medium-top">
                <button class="md-btn md-btn-primary md-btn-block md-btn-large adept-md-btn-primary">Register</button>
            </div>            
        </form>
        
    </div>
  </div>
</div>

<script>

function showPasswordInfo(){
    var msg = "<p>Password should contain characters, Numeric digits, <br>Symbols and first character should be a letter <br> i.e : Abcd@#123</p>";
    $("#password_info").html(msg).fadeIn();
}

function hideMsg(){
    $("#password_info").empty().fadeOut();

}



function validateForm(){

  var fname= $("#fname").val(); 
  var lname= $("#lname").val(); 
  var email= $("#email").val(); 
  var password= $("#password").val(); 

    if(fname==null || fname == "")
    {
       $('#fname').focus();
       $('#fname_error').css('color', 'red');        
       $('#fname_error').show();
       $('#fname_error').text("Please Fill Firstname");
        setTimeout(function() {
          $('#fname_error').slideUp('slow');
          },2000);    
        return false;         
     } 

    if(lname==null || lname == "")
    {
       $('#lname').focus();
       $('#lname_error').css('color', 'red'); 
       $('#lname_error').show();
       $('#lname_error').text("Please Fill Laststname");
        setTimeout(function() {
          $('#lname_error').slideUp('slow');
          },2000);        
        return false;
    }    

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
    if (password.length >0 ){      
       if($("#password").val().length < 6){                       
        $('#password').focus();
        $('#password_error').show();
        $('#password_error').css('color', 'red'); 
        $('#password_error').text("Password must be at least 6 characters");
        setTimeout(function() {
          $('#password_error').slideUp('slow');
          },2000);    
        return false;                            
        }   
            /* var password_allow= /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;
             if(!password.match(password_allow)){ 
             $('#password').focus();
                    $('#password_error').show();
                    $('#password_error').css('color', 'red'); 
                    $('#password_error').text("Password can contain only characters, numeric digits, Symbols and first character must be a letter");
                    setTimeout(function() {
                    $('#password_error').slideUp('slow');
                    },5000);    
                    return false;
                    
                    }
                  }*/

}
 function ValidateEmail(email) {
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
    }

function checkEmail()
{
    var email= $("#email").val();    
    if(!email==''){
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>user/checkEmail',
                data: {email:email},
            })
          .done(function(data){                       
             if(data==1)
                {
                  $("#email_error").css('color', 'red');
                  $('#email_error').show();
                  $('#email_error').text("This Email Address is Already Registerd");
                    setTimeout(function() {
                 $('#email_error').slideUp('slow');
                    },2000);                 
                }
              else
              {
                $("#email_error").css('color', 'green');
                $('#email_error').show();
                  $('#email_error').text("Email is valid");
                    setTimeout(function() {
                 $('#email_error').slideUp('slow');
                    },2000);
              }
          })
          .fail(function() {         
                // just in case posting your form failed                          
            });             
     }
}

</script>

    


