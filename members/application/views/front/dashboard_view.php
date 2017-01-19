

<div class="col-md-2 space-none">
  <?php if($personal_info!=''){?>
  <div class="player_info">
    <ul>
      <li><span>Sport</span> <i><?php print_r($personal_info->sport); ?></i></li>
      <li><span>Level</span> <i><?php print_r($personal_info->level); ?></i></li>
      <li><span>Position</span> <i><?php print_r($position); ?></i></li>
      <li><span>Height</span> <i><?php print_r($personal_info->height); ?></i></li>
      <li><span>Weight</span> <i><?php print_r($personal_info->weight); ?></i></li>      
      <li><span>Gender</span> <i><?php if($personal_info->gender==1){echo "Male";}else{echo "Female";} ?></i></li>
      <li><span>Age</span> <i><?php $year=$personal_info->birth_year; $current_year= Date('Y'); echo $age= ($current_year-$year);?></i></li>
      <li><span>Nationality</span> <i><?php print_r($personal_info->nationality); ?></i></li>
      <li><span>Seeking</span> <i><?php echo $seeking; ?></i></li>
      <li><span>Location</span> <i><?php print_r($personal_info->location); ?></i></li>
    </ul>    
  </div>
 <?php  } ?>

<div class="side_tab">
    <ul id="side_tab">         
      <li id="side_friends">Friends</li>      
      <li id="side_pdf_profile" onclick="genratePdf(<?php echo $user_id; ?>)">Print Pdf Profile</li>
      <li id="side_forward_profile" data-uk-modal="{target:'#modal_forword_profile'}">Forward Profile</li>
      <li id="side_contact_me" data-uk-modal="{target:'#modal_login'}">Contact Me</li>  
        
    </ul>    
  </div>
</div>

<div class="uk-width-medium-1">                       
        <div class="uk-modal" id="modal_login">
           <div class="uk-modal-dialog login-model">
              <button id="close_model" class="uk-modal-close uk-close" type="button"></button>
                 <div class="uk-modal-header">
                        <h3 class="uk-modal-title">Login</h3>
                        <span id="login_status"></span>
                  </div>
                <div class="row">
                    <div class="col-md-12">                                          
                        <div class="uk-form-row">        
                            <label for="email">Your Email</label>
                             <input type="text" id="email" name="email" onblur="checkEmailActive()" required class="md-input" />
                             <span id="email_error"> </span>                                           
                          </div>

                          <div class="uk-form-row">
                              <label for="name">Your Password</label>
                              <input type="password" id="password"  name="password" required class="md-input" />
                              <span id="password_error"> </span>
                          </div>
                       
                    <div class="uk-modal-footer uk-text-right">
                        <div class="uk-margin-medium-top">
                         <button class="md-btn md-btn-primary adept-md-btn-primary" id="login_button">Sign In</button>
                         <a class="md-btn md-btn-primary adept-md-btn-primary" href="<?php echo base_url()?>user/register">Register Now </a>
                         </div> 
                      </div>
                 </div>
            </div>
        </div>  
    </div>

    <?php 
        $session_data = $this->session->userdata('logged_in');
        $user_id=$session_data['user_id'];
        $name=$session_data['name'];
        $email=$session_data['email'];
        $session_user_exist=$this->session->userdata('user_exist');  
            
        ?>

        <div class="uk-modal" id="modal_forword_profile">
           <div class="uk-modal-dialog login-model forword_profile">
              <button id="close_model" class="uk-modal-close uk-close" type="button"></button>
                 <div class="uk-modal-header">
                        <img src="<?php echo base_url();?>images/logo.png" alt="Logo">
                        <h3 class="uk-modal-title">Forward Profile: <?php print_r(ucwords($name)); ?></h3>
                        <span id="login_status"></span>
                  </div>
                <div class="row">
                    <div class="col-md-12 fwd_profile">                                                      
                        <div class="col-md-6">        
                            <label for="name">Name of Recipient:</label>
                             <input type="text" id="name" name="name"  required class="md-input" />
                                                                      
                          </div>

                          <div class="col-md-6">
                              <label for="name"> Email of Recipient:</label>
                              <input type="email" id="email"  name="email" required class="md-input" />
                               <span id="email_error"> </span> 
                          </div>
                      </div>
                  </div>

                   <div class="row">
                    <div class="col-md-12 fwd_profile">                                                      
                        <div class="col-md-6">        
                            <label for="your_name">Your Name:</label>
                             <input type="text" id="your_name" name="your_name"  value="<?php print_r(ucwords($name)); ?>" class="md-input" />
                          </div>

                          <div class="col-md-6">
                              <label for="your_email">Your Email:</label>
                              <input type="email" id="your_email"  name="your_email" value="<?php echo $email;?>" class="md-input" />
                          </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 fwd_profile">
                      <div class="col-md-12">
                      <label for="your_name">Subject :</label>
                             <input type="text" id="subject" name="subject"  class="md-input" />                          
                      </div>
                    </div>
                  </div>

                   <div class="row">
                    <div class="col-md-12 fwd_profile">
                      <div class="col-md-12">
                      <label for="your_name">Message :</label>
                             <textarea cols="30" rows="4" class="form-control fwd_msg">Hello,
I came across <?php print_r(ucwords($name)); ?>'s profile on WeGotPlayers and I thought that it might interest you and be a great fit. Click on the link below to view the full profile.
<?php echo base_url(); ?>profile/<?php print_r($session_user_exist['username']);?>

Thanks!

PS: WeGotPlayers is a powerful sports resumes tool designed to empower players build and promote their own identity to play at the next level.Sign Up for a FREE profile to see where your sports journey takes you.

This email was sent using WeGotPlayers to help you promote yourself and identify the best fit.
 2015 WeGotPlayers, LLC.</textarea>
                                                   
                      </div>
                    </div>
                  </div>
                       <br>
                    <div class="uk-modal-footer">
                        <div class="uk-margin-medium-top">
                         <button class="md-btn md-btn-primary adept-md-btn-primary" id="send_forword_profile">Send</button>
                         </div> 
                      </div>

                 </div>            
            </div>



</div>
               



<div class="col-md-10 space-none-right" data-uk-grid-margin>
  <div class="uk-width-medium-1">
    <div class="md-card ">
      <div class="" id="main_tab_target">
          
              <ul id="user_tabs" class="uk-switcher uk-margin">
                  <li id="wall_post">
                    
                  </li>
                  <li id="personal">
                    
                  </li>
                   <li id="academics">
                    
                  </li>
                   <li id="atheletics">
                    
                  </li>
                   <li id="calendar" class="cal_space">
                    
                  </li>
                  <li id="photo" class="pho_space">
                     
                  </li>
                  <li id="video" class="pho_space">
                        
                  </li>
                   <li id="resume">
                        
                  </li>
                  <li id="references">
                    
                  </li>
              </ul>
          </div> 
          <div id="sidetab_destination"></div>              
        </div>
      </div>      
    </div>    
 </div>


  <script>
  $(document).ready(function () {
       $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>front_wall/wallView',
                data: {},
             })
          .done(function(data){
            $('#wall_post').html(data);
          })

            $("#user_profile_tabs li").click(function () {                
                var tab_value=$(this).text();
               
               if(tab_value=="Wallpost") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_wall/wallView',
                      data: {},
                  })
                .done(function(data){
                  $("#main_tab_target").css({ display: "block" });
                  $("#sidetab_destination").css({ display: "none" });
                  $('#wall_post').html(data);
                })
              }
              
              if(tab_value=="Personal") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_controller/personalView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                    $("#main_tab_target").css({ display: "block" });
                  $("#sidetab_destination").css({ display: "none" });
                  $('#personal').html(data);
                })
              }

              if(tab_value=="Academics") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_academics/academicsView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $("#main_tab_target").css({ display: "block" });
                  $("#sidetab_destination").css({ display: "none" });
                  $('#academics').html(data);
                })
              }
              
              
              if(tab_value=="Athletics") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_atheletics/atheleticsView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $("#main_tab_target").css({ display: "block" });
                  $("#sidetab_destination").css({ display: "none" });
                  $('#atheletics').html(data);
                })
              }

              if(tab_value=="Schedule") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_calendar/calendarView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $("#main_tab_target").css({ display: "block" });
                  $("#sidetab_destination").css({ display: "none" });
                  $('#calendar').html(data);
                })
              }

              if(tab_value=="Photos") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_photo/photoView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $("#main_tab_target").css({ display: "block" });
                  $("#sidetab_destination").css({ display: "none" });
                  $('#photo').html(data);
                })
              }

              if(tab_value=="Videos") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_video/videoView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $("#main_tab_target").css({ display: "block" });
                  $("#sidetab_destination").css({ display: "none" });
                  $('#video').html(data);
                })
              }

               if(tab_value=="Resume") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_resume/resumeView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $("#main_tab_target").css({ display: "block" });
                  $("#sidetab_destination").css({ display: "none" });
                  $('#resume').html(data);
                })
              }
               if(tab_value=="References") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_reference/referenceView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){ 
                  $("#main_tab_target").css({ display: "block" });
                  $("#sidetab_destination").css({ display: "none" });                 
                  $('#references').html(data);
                })
              }

              });
          });
              
              
  </script>

  <script>

    $("#side_friends").click(function () {             
                $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_friend_controller/showFriendView',
                      data: {},
                  })
                .done(function(data){
                  $('#sidetab_destination').empty();
                  $('#sidetab_destination').html(data);
                   $("#main_tab_target").css({ display: "none" });
                   $("#sidetab_destination").css({ display: "block" });
                })
            });

  </script>

  <script>
$(document).ready(function() {
    $("#login_button").click(function(){
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

   if(!email==''){
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>user/loginAction',
                data: {email:email,password:password},
          })
         .done(function(data){
          if(data==1){
              var msg ="Login Successfully !";
              $("#login_status").html(msg); 
              setTimeout(function() {
                  $('#login_status').slideUp('slow');
                },2000); 
                $("#close_model").trigger("click");      
                return false;
          }else{
              $("#login_status").html(data);
          }

         });

    }



    });
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

<script>
  function genratePdf(user_id){
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>front_resume/resumePdf',
                data: {},
             })
          .done(function(data){   
                  
             var url= '<?php echo base_url(); ?>pdf/uploads/resume_'+user_id+'.pdf';           
             window.location=url; 
             target="_blank"
             return false;
      })
  }

</script>



  
   