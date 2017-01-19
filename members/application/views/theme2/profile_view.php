
<div class="ac_am_user_update">
<div class="col-md-9">

		<div class="ac_am_user_update_sport" id="first_section">
       <div class="col-md-4">
        <h4><?php echo ucwords($detail->first_name.' '.$detail->last_name); 
            $location_short_name = isset($location_short->countryCode) ? $location_short->countryCode:0; ?>
          <i class="glyphicon bfh-flag-<?php echo $location_short_name;?>"></i>
        </h4>
         <div class="ac_am_user_update_sport_left" id="dp_preview">
            <img src="<?php echo $dp_url; ?>" id="dp_url">
        </div>
       </div>


        <div class="col-md-8"> 
            <span id="profile_personal_view" class="wow flipInY animate animated"></span>
      </div>
   </div>

   <script type="text/javascript">
    $(document).ready(function(){      

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>front_controller/personalView',
            data: {},
          })
         
         .done(function(data){              
              $("#profile_personal_view").html(data);
          }); 

      });
  </script>

   <!--  End personal details Section  -->


  <!--  Start personal messgae view -->
   <div class="ac_am_brief_bio border_bottom" id="bio_section">
       <h4>Brief Bio  </h4>
       <p id="brief_bio"> <?php echo ucfirst($personal_info->message); ?></p>
  </div>
<!--  End personal messgae view -->



 <!-- Start Academics Section  -->
<img style="display:block;" src="<?php echo base_url();?>images/loader1.gif" id="loader" alt="loader" width="60" height="60">
 

<!--   End Academics Section -->
 
    <div class="ac_am_academic  border_bottom" id="academics_view">


  </div>

 <script type="text/javascript">
    $(document).ready(function(){      

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>academics/academicsView',
            data: {},
          })
         
         .done(function(data){              
              $("#academics_view").html(data);
          }); 

      });
  </script>







<!--  Start Transcript Section  -->

 <div class="ac_am_academic border_bottom" id="transcript_data_view">


   </div>


   <script type="text/javascript">
         
  $(document).ready(function(){
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>front_transcript/transcriptView',
            data: {},
          })
         
         .done(function(data){              
              $("#transcript_data_view").html(data);
          }); 

      });

</script>


    <!--  End Transcript Section  -->





<!-- Start Teaminfo Section  -->

  <div class="ac_am_academic" id="view_teaminfo">
       


  </div>

 <script type="text/javascript">
    $(document).ready(function(){     

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>atheletics/atheleticsView',
            data: {},
          })
         
         .done(function(data){              
              $("#view_teaminfo").html(data);
               showPhotoGallery();
          }); 

      });
  </script>




<!-- Start Stats Section  -->

  <div class="ac_am_academic" id="stats_detail">
   


  </div>

  <script type="text/javascript">

   $(document).ready(function(){
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>stats/statsView',
            data: {},
          })
         
         .done(function(data){              
              $("#stats_detail").html(data);
          }); 

      });

  </script>

<!--  End of Stats View -->


<!--  Start Record Section -->

   <div class="ac_am_academic" id="record_data_view">


  </div>

<script type="text/javascript">

 $(document).ready(function(){
    $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>front_record/recordView',
            data: {},
          })
         
         .done(function(data){              
              $("#record_data_view").html(data);
          }); 
 });
</script>


<!--   End Record Section  -->


<!-- Start Photo Gallery Section -->
  
  <div class="ac_am_academic" id="view_gallery">

 </div>

 <script type="text/javascript">
         
function showPhotoGallery(){
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>front_photo/photoView',
            data: {},
          })
         
         .done(function(data){              
              $("#view_gallery").html(data);
              showAllVideo();
          }); 

      }

</script>

<!-- End Photo Gallery Section -->



<!-- Start Video Section -->
  
  <div class="ac_am_academic" id="video_data">
    
 </div>

 <script type="text/javascript">
         
  function showAllVideo(){
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>front_video/videoView',
            data: {},
          })
         
         .done(function(data){              
              $("#video_data").html(data);
          }); 

      }

</script>

<!-- END OF VIDEO SECTION -->



<!--  Start vital Section -->
  
  <div class="ac_am_academic" id="vital_data_view">


  </div>

<script type="text/javascript">

 $(document).ready(function(){
    $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>front_vitals/vitalView',
            data: {},
          })
         
         .done(function(data){              
              $("#vital_data_view").html(data);
          }); 
 });
</script>
 <!-- End Vital Section  -->




<!--  Start Language Section -->
  
  <div class="ac_am_academic" id="language_data_view">


  </div>

<script type="text/javascript">

 $(document).ready(function(){
    $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>front_language/languageView',
            data: {},
          })
         
         .done(function(data){              
              $("#language_data_view").html(data);
          }); 
 });
</script>
 <!-- End Language Section  -->



 <!--  Start Injuries Section -->
  
  <div class="ac_am_academic" id="injuries_data_view">


  </div>

<script type="text/javascript">

 $(document).ready(function(){
    $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>front_injury/injuryView',
            data: {},
          })
         
         .done(function(data){              
              $("#injuries_data_view").html(data);
          }); 
 });
</script>
 <!-- End Injuries Section  -->


 <!--  Start References Section -->
  
  <div class="ac_am_academic" id="references_data_view">


  </div>

<script type="text/javascript">

 $(document).ready(function(){
    $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>front_reference/referenceView',
            data: {},
          })
         
         .done(function(data){              
              $("#references_data_view").html(data);
          }); 
 });
</script>
 <!-- End References Section -->






</div>
<!-- End left side section -->









<!--   Start  Side Section  -->
 <div class="col-md-3"> 


   <?php   $count = 0;
      if($profile_pic_status==true){
         $count += 5;
      }
      if(!empty($detail)){
          $count += 10;
      }

      if(!empty($personal_info)){
        $count += 5;
      }
     if(!empty($school)){
         $count += 10;  
      }
      if(!empty($teaminfo)){
        $count += 10;
      }

      if(!empty($transcripts_details)){
         $count += 5; 
      }
      if(!empty($stats_details)){
        $count += 5;
      }
      if($photo_album>=1)  {
         $count += 5;
      }
       if($video_count>=1)  {
        $count += 15;
      }    

      if( (!empty($reference)) || (!empty($asked_ref)) )  {
          $count += 10;  
      }
      if(!empty($events)){
        $count += 5;
      }
       if( (!empty($tech_details)) && (!empty($tact_details))
            && (!empty($physical)) && (!empty($psy_details)) )

       {
          $count += 5;
       }
       if(!empty($user_language)){
        $count +=5;
       }
      if(!empty($injur)){
          $count += 5;
      }

  ?>  

  <div  class="ac_am_upgrade_your_profile space new_space" id="contact_me_btn">
       <a class="ac_am_upgrade_your_profile" data-toggle="modal" data-target="#contactMeModel"> Contact Me</a>
  </div>  



  <div class="ac_am_profile_strant">
      <h4>Profile Strength</h4>
        <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $count; ?>"
            aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $count; ?>%">
        </div>
      </div>


      <span class="sr-only"><?php echo $count; ?>%</span>

          <div class="meter_box">
            <div class="meter_counter" style="bottom: <?php echo ($count-17);?>px;">
              <p><?php 
                  if($count<=30){
                     echo "Starter";
                  }elseif($count>30 && $count<=60){
                   echo 'Star';
              }else if($count>60 && $count <= 80){
                   echo 'All Star';
              }else if($count >80 && $count <100){
                    echo "Super Star";
              }else if($count==100){
                     echo "Champion";
                  }

          ?></p>
              <span></span>
            </div>
          </div>
       

        </div>

      <div class="ac_am_upgrade_your_see" onclick="printPdf(<?php echo $user_id; ?>)">Print Pdf Profile</div>
      <div  class="ac_am_upgrade_your_see" data-toggle="modal" data-target="#modal_forword_profile">Forward Profile</div>     

         
          <div class="ac_am_latest_event">
              <h4>Upcoming Events </h4>          

            
         <ul class="events">

         <?php if(empty($events)){ ?>
                 <li> No Upcoming event</li>
    <?php } 
        else if(count($events)>0) 
          { 
              foreach ($events as $key => $row) 
              { 
    ?>
      <li id="<?php echo $row->wgp_event_id;?>"><img src="<?php echo base_url(); ?>images/img.jpg">  </li>

                  <b><?php echo ucwords($row->wgp_event_name); ?></b>
                  <span> 

                    <?php $date = strtotime($row->wgp_event_start); 
                           echo date('d M, Y',$date);
                    ?>
                  </span>
         <?php    } 
              } 
        ?>
      </ul>
        <i><a class="md-btn md-btn-primary pull-right" href="<?php echo base_url(); ?>event">View All</a></i>
     </div>

  </div>

        <!-- end right side -->

<!-- Demo Content Trigger the modal with a button -->
<button type="button" id="demo_model"  data-toggle="modal" data-target="#myModal" style="display:none;"></button>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <span id="model_content"></span>
      </div>
    </div>

  </div>
</div>
</div>

<style type="text/css">
.modal-body{
  background-color: #fff;
}
.uk-modal-header{
  margin: 0px;
  padding: 10px 0px 0px 20px;
}
.uk-form-row label
{
	margin-top:15px;
	margin-bottom:0px;
}
.modal-header .close
{
	    margin: 10px;
	    opacity: 1;
}

.modal-header {   
    margin: -13px;  
}

.fwd_pro{
  background-color: #fff;
}

.fwd_pro_img{
  width: 100%!important;
  float:  left;
}


</style>
<div id="contactMeModel" class="modal fade" role="dialog">
        <div class="modal-dialog">

               <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                 <div class="uk-modal-header">
                        <h3 class="uk-modal-title">Login</h3>
                        <span id="login_status"></span>
                  </div>
                <div class="modal-body">
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
                              <span id="password_error"></span>
                          </div>
                       
                    <div class="uk-text-right">
                        <div class="uk-margin-medium-top">
                         <button class="md-btn md-btn-primary adept-md-btn-primary" id="login_button">Sign In</button>
                         <a class="md-btn md-btn-primary adept-md-btn-primary" href="<?php echo base_url()?>user/register">Register Now </a>
                         </div> 
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

                   
       <div id="modal_forword_profile" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header model_logo">
        <img src="<?php echo base_url();?>images/wegotplayers.png" alt="Logo">
        <button type="button" class="close"  id=close_fwd_profile"" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body modal-body-profile">
        <h3 class="uk-modal-title">Forward Profile: <?php echo ucwords($detail->first_name.' '.$detail->last_name);  ?></h3>
        <span id="login_status"></span>
        <div class="row">
          <div class="col-md-12 fwd_profile">                                                      
              <div class="col-md-6">        
                  <label for="name">Name of Recipient:</label>
                   <input type="text" id="name_f" name="name"  required class="form-control"/><span id="nameerror"></span>
                </div>
                <div class="col-md-6">
                    <label for="name"> Email of Recipient:</label>
                    <input type="email" id="email_f"  name="email" required class="form-control"><span id="emailerror"></span>
                     
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-12 fwd_profile">                                                      
              <div class="col-md-6">        
                  <label for="your_name">Your Name:</label>
                   <input type="text" id="your_name" name="your_name"  value="<?php echo ucwords($detail->first_name.' '.$detail->last_name);  ?>" class="form-control"> <span id="your_nameerror"></span>
                </div>
                <div class="col-md-6">
                    <label for="your_email">Your Email:</label>
                    <input type="email" id="your_email"  name="your_email" value="<?php echo $email;?>" class="form-control"><span id="your_emailerror"></span>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-12 fwd_profile">
            <div class="col-md-12">
            <label for="your_name">Subject:</label>
               <input type="text" id="subject_f" name="subject"  class="form-control"><span id="subjecterror"></span>                         
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 fwd_profile">
            <div class="col-md-12">
            <label for="your_name">Message:</label>
                   <textarea cols="30" rows="4" class="form-control fwd_msg" id="f_message">Hello,
I came across <?php echo ucwords($detail->first_name.' '.$detail->last_name); ?>'s profile on WeGotPlayers and I thought that it might interest you and be a great fit. Click on the link below to view the full profile.
<?php echo base_url(); ?>profile/<?php print_r($session_user_exist['username']);?>

Thanks!

PS: WeGotPlayers is a powerful sports resumes tool designed to empower players build and promote their own identity to play at the next level.Sign Up for a FREE profile to see where your sports journey takes you.

This email was sent using WeGotPlayers to help you promote yourself and identify the best fit.
<?php echo date('Y');?> WeGotPlayers, LLC.</textarea>
                                         
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
      <span id="status"></span>
      <button type="button" id="send_forword_profile" class="md-btn md-btn-primary adept-md-btn-primary">Send</button>
                    
        
      </div>
    </div>

  </div>
</div>

<script>
  $("#send_forword_profile").click(function(){
    var name= $("#name_f").val();
    var your_name = $("#your_name").val();
    var your_email = $("#your_email").val();
    var email= $("#email_f").val();
    var subject= $("#subject_f").val();
    var f_message= $("#f_message").val();


     if(name.length==0){
        $("#nameerror").text("Please enter name of recipient . ");
        $("#nameerror").show();
        return false;
    }
   else if(email.length==0){
  
        $("#emailerror").text("Please enter your recipient email .");
        $("#nameerror").hide();
        $("#emailerror").show();
        return false;
    }

    else if(!ValidateEmail(email)){
          alert(2);
         $("#emailerror").empty().append("Email is not valid format.");
         $("#emailerror").show();
        return false;
    }
    
    else if(your_name.length==0){
      alert(3);
        $("#your_nameerror").text("Please enter your name .");
        $("#emailerror").empty();
        $("#your_nameerror").show();
        return false;
    }
else if(your_email.length==0){
        $("#your_emailerror").text("Please enter your email .");
        $("#your_nameerror").empty();
        $("#your_emailerror").show();
        return false;
    }


else if(subject.length==0){
        $("#subjecterror").text("Please enter subject .");
        $("#your_emailerror").empty();
        $("#subjecterror").show();
        return false;
    }
else if(f_message.length==0){
        $("#f_messageerror").text("Please enter your messgae");
        $("#subjecterror").hide();
        $("#f_messageerror").show();
        return false;
    }
 else{
      $.ajax({
                type:'POST',
                url: '<?php echo base_url(); ?>front_controller/forwardProfile',
                data:{name:name,email:email,
                      your_name:your_name,
                      your_email:your_email,
                      subject:subject,
                      message:f_message},        
           })  
           .done( function(data, status){

               if(data==1){
                    $('#modal_forword_profile').modal('toggle');
                    
               }else{                 
                 $("#status").html(data);
                    setTimeout(function() {              
                    $('#status').slideUp('slow');
                   },3000); 
                }
            });
         }
      
});
</script>s
   <!-- End of col-md-3 -->

 </div>

 <script src="<?php echo base_url(); ?>bower_components/magnific-popup/dist/jquery.magnific-popup.min.js"></script>

 <!--  user profile functions -->

<script src="<?php echo base_url(); ?>assets/js/pages/page_user_profile.min.js"></script>

<script src="<?php echo base_url(); ?>js/highcharts.js"></script>


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




function printPdf(user_id){
    $("#loader").fadeIn('slow');
     $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>pdf_controller',
                data: {},
            })
          .done(function(data){
              $("#loader").fadeOut('slow');
              window.open('<?php echo base_url();?>pdf/uploads/resume_'+user_id+'.pdf');
            });
}
</script>

  </body>
</html> 