<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="1013253489958-amqo59g84o5ob8l7dce1vj1jv5pr7f14.apps.googleusercontent.com">

<?php
require 'application/src/facebook.php';

$facebook = new Facebook(array(
 //'appId'  => '394648744053651',
 //'secret' => 'a579c0cf8cb1826bb9014263a854e829',
 'appId'  => '1208372269240931',
 'secret' => '7a72c109ed70c5a5f5448754a72d0b3b',
));

// See if there is a user from a cookie
$user = $facebook->getUser();

if ($user) {
 try {
   // Proceed knowing you have a logged in user who's authenticated.
   $user_profile = $facebook->api('/me?locale=en_US&fields=name,email');
 } catch (FacebookApiException $e) {
   echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
   $user = null;
 }
session_destroy();

$fb_data = $user_profile['name'].'__'.$user_profile['email'];
 header('location:'.base_url().'user/loginWithFacebook/'.base64_encode($fb_data));
 exit;
}
else
{
$loginUrl = $facebook->getLoginUrl(array(
       'scope'         => 'email',
       'redirect_uri'  => base_url().'user',
       ));

}
//echo $loginUrl; exit;
?>
<?php
$fb_user_donot_exist = (isset($fb_user_donot_exist)) ? 1 : 0;
      if($fb_user_donot_exist==1){
?>
 <h4 style=" margin-top: 0;  font-weight: bold; text-align:center; color:#F00;">Wrong Facebook login details.</h4>
 
                                 <?php }    ?>
                                 
                                 
 
  
<div class="login_page_wrapper new_login_card">
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

           <?php if($this->session->flashdata('registration_error')){ ?>
                      <div class="row">
                            <div class="col-xs-12 col-md-12 col-sm-12">
                      <?php   echo "<h6 style='color:#F00'>".$this->session->flashdata('registration_error')."</h6>";  ?> 
                            </div>
                       </div>
         <?php } ?>

          
       </div>

        <div class="new_width_left">

           
              <label class="we_join">Not a member yet?</label>
              <a class="rgstr_login_adept_got signfree" href="<?php echo base_url()?>user/register">Sign Up Free</a>
            

          <a href="<?=$loginUrl?>" class="facebook_btn"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a>






          <button class="plus_btn"><i class="fa fa-google-plus" aria-hidden="true"></i>Google</button>
          
          <button class="inst_btn"><i class="fa fa-facebook" aria-hidden="true"></i>Instagram</button>
          <a href="<?=base_url().'user/twitterProcess'?>" class="twi_btn"><i class="fa fa-google-plus" aria-hidden="true"></i>Twitter</a>
        </div>

        <form class="new_width_right" action="<?php echo base_url()?>user/doLogin" method="post"  onSubmit="return validateForm();" accept-charset="utf-8">
            
            <div class="uk-form-row">
                <label for="email">Your email</label>               
                <input class="md-input" type="text" id="email" name="email" value="<?php echo $email;?>" onblur="checkEmailActive()" autocomplete="off"/>
                <span id="email_error"></span>
            </div>
            <div class="uk-form-row">
                <label for="password">Your Password</label>               
                <input class="md-input" type="password" id="password" name="password" value="<?php echo $password;?>" autocomplete="off"/> 
                <span id="password_error"></span>               
            </div>
            <input type="checkbox" name="rememberme" <?php if($password!=''){echo "checked";}?> id="rememberme" data-md-icheck />
            <label for="login_page_stay_signed" class="inline-label">Remember Me</label>
            <div class="uk-margin-medium-top">
                <button class="md-btn md-btn-primary md-btn-block md-btn-large adept-md-btn-primary">Sign In</button>
            </div>

            <a class="rgstr_login_adept_got rest_pass" href="<?php echo base_url()?>user/reset">Reset Password</a>
                     <a class="rgstr_login_adept_got rest_pass" href="<?php echo base_url()?>user/verify">Verify Email</a>
            

          <!--   <div class="social_col">
            <span class="fb" id="login_facebook">Login with facebook</span>
            <span class="gplus" id="login_gplus">Login with Google+</span>
          </div> -->

        </form>

        

        <style type="text/css">
        ._51mz {
            height: 36px!important;
            line-height: 36px!important;
            width: 195px!important;
            }
        </style>
          
       
            <!-- <div id="hide_g_plus" class="g-signin2"  data-onsuccess="onSignIn"></div>

        
          <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
          </fb:login-button>

          <div id="status" style="display:none;">
          </div> -->


         
    </div>
</div>
<div class="cus_foot">
          <div class="uk-margin-top">
                <!-- <span class="icheck-inline"> -->
                   
                    <div class="new_width_right">                 
                    
                    
                    </div>
                 <!-- </span> -->
            </div>
        </div>
</div>

 <?php 
      $session_register = $this->session->userdata('register');
      if($session_register){
         echo "Registered";
      }
 ?>


<script>


/*$("#login_gplus").click(function () {
      $('#hide_g_plus').trigger('click');
        alert('click gp'); 
});

$("#login_facebook").click(function () { 
      alert('click fb');    
      $('#hide_facebook').trigger('click');
});*/
  
</script>

<script>

window.onbeforeunload = function(e){
  gapi.auth2.getAuthInstance().signOut();
};

function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  
    $.ajax({
            type: 'POST',
                url: '<?php echo base_url(); ?>user/loginAuth',
                data: {email:profile.getEmail(),token:profile.getId(),
                      name:profile.getName(),image:profile.getImageUrl(),
                      login_method:'google_plus'},
            })
          .done(function(data){
              console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
              console.log('Name: ' + profile.getName());
              console.log('Image URL: ' + profile.getImageUrl());
              console.log('Email: ' + profile.getEmail());
          });
}


function validateForm(){
     
   var email =$("#email").val();
   var password =$("#password").val();
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

    if(password==null || password == "")
    {
       $('#password').focus();
       $('#password_error').css('color', 'red');      
        $('#password_error').show();
        $('#password_error').text("Please Enter Password");
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

   function checkEmailActive()
    {
    var email= $("#email").val();    
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

}

</script>