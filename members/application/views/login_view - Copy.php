<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="1013253489958-amqo59g84o5ob8l7dce1vj1jv5pr7f14.apps.googleusercontent.com">
<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '177842009346338',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use graph api version 2.8
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me',{ locale: 'en_US', fields: 'name,email' }, function(response) {
      var name = response.name;
      var email =  response.email;
     // var picture = response.picture;    


      console.log("name : "+name+ " email : "+email );
      $.ajax({
            type: 'POST',
                url: '<?php echo base_url(); ?>user/loginWithFacebook',
                data: {email:email,name:name,login_method:'facebook graph api'},
            })
          .done(function(data){
             console.log(data);
          });
    });
  }
</script>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->



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
     <?php    

require_once APPPATH.'third_party//Facebook/autoload.php';


$fb = new Facebook\Facebook([
  'app_id' => '1208372269240931',
  'app_secret' => '7a72c109ed70c5a5f5448754a72d0b3b',
  'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // optional

$call_back_url_fb = base_url().'user/loginWithFB';
$loginUrl = $helper->getLoginUrl($call_back_url_fb, $permissions);

echo '<a class="facebook_btn" href="' . $loginUrl . '">Log in with Facebook!</a>'; 

?>
          <button class="facebook_btn"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</button>
          <button class="plus_btn"><i class="fa fa-google-plus" aria-hidden="true"></i>Google</button>
          <button class="inst_btn"><i class="fa fa-facebook" aria-hidden="true"></i>Instagram</button>
          <button class="twi_btn"><i class="fa fa-google-plus" aria-hidden="true"></i>Twitter</button>
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
                    <div class="new_width_left">
                      <label class="we_join">join we got players</label>
                      <a class="rgstr_login_adept_got" href="<?php echo base_url()?>user/register">Register Now </a>
                    </div>
                    <div class="new_width_right">                 
                    
                    <a class="rgstr_login_adept_got rest_pass" href="<?php echo base_url()?>user/reset">Reset Password</a>
                     <a class="rgstr_login_adept_got rest_pass" href="<?php echo base_url()?>user/verify">Verify</a>
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