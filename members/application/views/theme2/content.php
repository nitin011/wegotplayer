<div class="ac_am_user_update">

<div class="side_top">
<div class="col-md-9">
    <div class="ac_am_user_update_sport" id="first_section">
   <form id="profile_pic_form" class=" col-md-4">
   		<h4><?php echo ucwords($detail->first_name.' '.$detail->last_name); ?>	  
        <?php $location_short_name = isset($location_short->countryCode) ? $location_short->countryCode:0; ?>
        <i class="glyphicon bfh-flag-<?php echo $location_short_name;?>"></i>
    	</h4>
       <div class="ac_am_user_update_sport_left" id="dp_preview">
          <img src="<?php echo base_url().$dp_url; ?>" id="dp_url">
          <span class="ac_profileUpload glyphicon glyphicon-pencil ac_am_academic_icon" id="change_profile_text" style="display:none;"> <i>No File Selected</i></span>
          <input type="file" name="profile_pic" class="ac_am_user_update_sport_left_contact" id="change_profile" style="display:none;">
       </div>
   </form>

 <script>
$(document).ready(function(){
    $("#edit_basic_detail").hide();
    $("#edit_basic").click(function(){
        $("#basic_deatil").fadeOut();
         $("#edit_basic_detail").fadeIn();
       /*$.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>home/basicDetail',
            data: {},
          })
         
         .done(function(data){              
              $("#edit_basic_detail").html(data);
          });
           $("#edit_basic_detail").fadeIn();
           */
    });

    $("#cancel_basic").click(function(){
        $("#basic_deatil").fadeIn();
        $("#edit_basic_detail").fadeOut();
    });
 });

 $(document).ready(function()
 {
  $("#first_section").mouseenter(function(){
      $("#edit_basic").css({ display: "block" }); 
  })

   .mouseleave(function()    {  
       $("#edit_basic").css({ display: "none" }); 
    });


  $("#dp_preview").mouseenter(function(){ 
        $("#change_profile").css({ display: "block" });
		$("#change_profile_text").css({ display: "block" });
    })

  .mouseleave(function()
    {    
        $("#change_profile").css({ display: "none" });
		$("#change_profile_text").css({ display: "none" });
        $("#change_profile").mouseenter(function() {
           $("#change_profile").css({ display: "block" }); 
		   $("#change_profile_text").css({ display: "block" }); 
        })
        .mouseout(function() {
           $("#change_profile").css({ display: "none" }); 
		   $("#change_profile_text").css({ display: "none" }); 
        });
    });

  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();   
            reader.onload = function (e) {
                $('#dp_image').attr('src', e.target.result);
            }  
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile_pic").change(function(){
        readURL(this);
    });

 $("form#profile_pic_form").change(function(){  
        var formData = new FormData($(this)[0]);
         var url = "<?php echo base_url();?>userphotos/uploadProfilePic";
         // the script where you handle the form input.
         $.ajax({
           url: url,
           type: 'POST',
           data: formData,
           async: false,
         success: function (data) {
             location.reload();  
         },
         cache: false,
         contentType: false,
         processData: false
         })
      });
});
</script>

 <!--  Start Profile basic detail  -->

  <div class="col-md-8"> 

       <div class="ac_am_user_update_sport_right"> 
            <div id="basic_deatil">

            <?php if(!empty($detail)){ ?> 

              <a style="display:none" class="glyphicon glyphicon-pencil ac_am_academic_icon ac_am_academic_icon-content pull-right edbasic_absolute" id="edit_basic"></a>     
             
                  <ul>
                       <li><a href="#"><b>Sport</b><i>:</i>
                        <span><?php echo $detail->sport_name; ?></span></a></li>
                       <li><a href="#"><b>Level </b><i>:</i><span><?php echo $detail->level_name; ?></span></a></li>
                       <li><a href="#"><b>Position</b><i>:</i><span><?php echo $detail->position_name; ?></span></a></li>
                       <li><a href="#"><b>Foot</b><i>:</i><span><?php echo $detail->foot_name; ?></span></a></li>
                       <li><a href="#"><b>Hand</b><i>:</i><span><?php echo $detail->hand_name; ?></span></a></li>
                       <li><a href="#"><b>Height </b><i>:</i><span><?php echo $detail->height_name; ?></span></a></li>
                       <li><a href="#"><b>Weight</b><i>:</i><span><?php echo $detail->weight_name; ?></span></a></li>
                       <li>
                          <?php $dob_full= $detail->birth_day.'-'.$detail->birth_month.'-'.$detail->birth_year; ?>
                          <a href="#" title="<?php echo $dob_full; ?>"><b>Age </b><i>:</i>
                              <span>
                                  <?php $birth_year = $detail->birth_year;
                                        $current_year = date('Y');
                                        $dob = $current_year-$birth_year;
                                        echo $dob." years";
                                  ?>
                            </span>
                         </a>
                       </li>
                         <li><a href="#"><b>Seeking </b><i>:</i><span> <?php echo $seeking; ?> </span></a></li>                     
                      <li><a href="#"><b>Location </b><i>:</i><span><?php echo $detail->address; ?></span></a></li> 
                  </ul> 
                  <div class="gradution">
                    <?php if($seeking_id==1 || $seeking_id==2){
                           echo '<h4>Class</h4> <h6>'.$detail->graduation_month.', '.$detail->graduation_year.'</h6></a>';
                       } ?>
                  </div>
                       

                </div>




<!-- Start Edit Basic Detail  -->
        
         <div class="row ac_am_academic" id="edit_basic_detail" style="display:none;">
      <form action="<?php echo base_url()?>userdetail/updateBasic" method="POST">

          <div class="col-md-6">
               <label>Name :</label>
          </div>

          <div class="col-md-6">
            <input type="text" name="name" value="<?php echo $name; ?>" class="form-control">
          </div>

          <div class="col-md-6">
            <label>Sport :</label>
          </div>

          <div class="col-md-6">
             <select id="sport" name="sport" required class="form-control">
                      <?php foreach ($sport as $value) { ?>
                           <option value="<?php echo $value->sportId; ?>"
                                <?php if($value->sportId==$detail->sport){
                                              echo "selected";
                                            } ?>
                                        ><?php echo $value->sportName; ?></option>
                                 <?php  }?>                
            </select> 
          </div>



          <div class="col-md-6">
               <label>Level :</label>
         </div>

        <div class="col-md-6">
           <select id="level" name="level" required class="form-control">
                    <?php foreach ($level as $value) { ?>
                         <option value="<?php echo $value->levelId; ?>"
                              <?php if($value->levelId==$detail->level){
                                            echo "selected";
                                          } ?>
                                      ><?php echo $value->levelName; ?></option>
                               <?php  }?> 
                  </select> 
        </div>

         <div class="col-md-6">
                 <label>Position*</label>
          </div>

              <div class="col-md-6">
                          <select name="position" id="position" required class="form-control">
                             <option selected="" value="">Select Position</option>
                              <?php foreach ($position_data as  $value) {  ?>   
                                 <option value="<?php echo $value->positionId; ?>"
                              <?php 

                                   if($value->positionId==$detail->position_speciality){
                                            echo "selected";
                                          } ?>
                                  >
                                  <?php echo $value->positionName; ?>
                                 </option>
                                 <?php } ?>
                               </select>            

                      </div>


              <div class="col-md-6">

                          <label>Hand*</label>

              </div>

              <div class="col-md-6">

                          <select name="hand" id="hand" required class="form-control">

                             <option selected="" value="">Select Hand</option>

                              <?php foreach ($hand as  $value) {  ?>                                                                                                                            

                                 <option value="<?php echo $value->handId; ?>"

                              <?php 

                                   if($value->handId==$detail->hand){

                                            echo "selected";

                                          } ?>

                                  >

                                  <?php echo $value->handName; ?>

                                 </option>

                                 <?php } ?>

                               </select>             

                      </div>




              <div class="col-md-6">

                          <label>Foot*</label>

              </div>

              <div class="col-md-6">

                          <select name="foot" id="foot" required class="form-control">

                             <option selected="" value="">Select Foot</option>

                              <?php foreach ($foot as  $value) {  ?>                                                                                                                            

                                 <option value="<?php echo $value->footId; ?>"

                              <?php 

                                   if($value->footId==$detail->foot){

                                            echo "selected";

                                          } ?>

                                  >

                                  <?php echo $value->footName; ?>

                                 </option>

                                 <?php } ?>

                               </select>             

                      </div>



        <div class="col-md-6">

                          <label>Height*</label>

              </div>

              <div class="col-md-6">

                          <select name="height" id="height" required class="form-control">

                             <option selected="" value="">Select Height</option>

                              <?php foreach ($height as  $value) {  ?>                                                                                                                            

                                 <option value="<?php echo $value->id; ?>"

                              <?php 

                                   if($value->id==$detail->height){

                                            echo "selected";

                                          } ?>

                                  >

                                  <?php echo $value->height; ?>

                                 </option>

                                 <?php } ?>

                               </select>             

                      </div>

               <div class="col-md-6">

                          <label for="val_select" class="">Weight*</label>

                </div>

                <div class="col-md-6">

                          <select name="weight" id="weight" required class="form-control">

                             <option selected="" value="">Select weight</option>

                              <?php foreach ($weight as  $value) {  ?>                                                                                                                            

                                 <option value="<?php echo $value->id; ?>"

                                  <?php 

                                   if($value->id==$detail->weight){

                                            echo "selected";

                                          } ?>

                                  >

                                  <?php echo $value->weight; ?>

                                 </option>

                                 <?php } ?>

                               </select>

                      </div>



                  <div class="col-md-6">

                          <label for="val_select" class="">Date of Birth*</label>

                  </div>



                  <div class="col-md-6">

                    <?php $dob= $detail->birth_day.'-'.$detail->birth_month.'-'.$detail->birth_year; ?>

                      <input type="text" name="dob" id="dob" value="<?php echo $dob; ?>">

                  </div>

                  <div class="col-md-6">

                          <label for="val_select" class="">Seeking*</label>

                </div>

                <div class="col-md-6">

                          <select name="seeking" id="seeking" required class="form-control">

                             <option >Select Seeking</option>

                              <?php foreach ($seeking_list as  $value) {  ?>                                                                                                                            

                                 <option value="<?php echo $value->id; ?>"

                                  <?php 

                                   if($value->id==$seeking_id){

                                            echo "selected='selected'";

                                          } ?>

                                  >

                                  <?php echo $value->seekingName; ?>

                                 </option>

                                 <?php } ?>

                               </select>

                      </div>

                 <?php //print_r($seeking_id); ?>
          <?php if($seeking_id==1 || $seeking_id==2){
                      $g_date =date('F,Y',strtotime($detail->graduation_month.$detail->graduation_year));
                 } else{
                      $g_date =date('F,Y');
                 }
          ?>

        <div id="clg-box" >

            <div class="col-md-6">
              <label class="">High School Graduation Date</label>
            </div>
            <div class="col-md-6">
                <input  type="text" id="grade_date" name="graduation_date" value="<?php echo $g_date; ?>">
             
            </div>
          </div>

                 <div class="col-md-6">
                      <label for="nationality" class="">Nationality* </label>
                </div>

                  <div class="col-md-6">                                    

                          <select name="nationality" id="nationality" required class="form-control">

                              <option value="">Select Nationality</option>

                                <?php foreach ($nation as  $value) {  ?>                                                                                                                            

                                    <option value="<?php echo $value->id; ?>"

                                        <?php 
                                            if($detail->nationality==$value->id){
                                              echo "selected='selected'";
                                            }
                                         ?>

                                      >

                                      <?php echo $value->nationality; ?></option>

                                <?php }   ?>                                      

                          </select>

                 </div>



                  <div class="col-md-6">

                          <label for="val_select" class="">Location*</label>

                  </div>



                   <div class="col-md-6">                   

                      <textarea name="b_address"  id="autocomplete" onFocus="geolocate()" class="form-control"><?php echo $detail->address; ?> </textarea>

                  </div>


            <input id="street_number" disabled="true" type="hidden" placeholder="Street Number" required class="form-control">

            <input id="route" disabled="true"  type="hidden" placeholder="Street Address" required class="form-control">

      
          <div class="col-md-6"> 
            <label for="zip_code">Zip Code<span class="req">*</span></label>

            </div>

           <div class="col-md-6">

              <input type="text" id="postal_code" disabled="true" name="zip_code"  required class="form-control" />

          </div>

           <div class="col-md-6">

              <label for="city">City<span class="req">*</span></label>

          </div>

           <div class="col-md-6">

              <input type="text" name="city" id="locality" disabled="true"  required class="form-control" />

          </div>

           <div class="col-md-6">

              <label for="state">State<span class="req">*</span></label>

          </div>

           <div class="col-md-6">

           </div>

           <div class="col-md-6">

              <input type="text" name="state" id="administrative_area_level_1" disabled="true"  required class="form-control" />

          </div>

                      

          <div class="col-md-6">

            <label for="country" class="">Country*</label>

            </div>

           <div class="col-md-6">

             <input id="country" name="country" disabled="true"  value="<?php echo $detail->location; ?>" required class="form-control">

          </div>



               <div class="col-md-8">
               </div>
               <div class="col-md-4 ac_rightAlign">

                   <button type="submit" class="btn_col btn btn-danger ac_save"> Save </button>

               
                   <button type="button" id="cancel_basic" class="btn btn-primary ac_cancel"> Cancel </button>

              </div>

 </form>

</div>

<!-- End Edit Basic Detail -->


        <?php } ?>


             

        
     </div>     
  </div>   <!--  End col-md-9  -->
</div>

<!-- End Profile Basic Details -->

<!-- Start profile Url and Unique Code  -->

  <span id="link_error"></span>     
<div class="ac_am_user_update_sport_userurl">
       <p>User URL :<span id="profile_url"><?php echo base_url().'profile/'.$user_detail->login_name; ?>
                          <a class="glyphicon glyphicon-pencil ac_am_academic_icon ac_am_academic_icon-content" id="edit_icon_profile_url"></a>
                     </span>

                      <span id="edit_profile_url" style="display:none;">
                            <input class="inpu_box" type="text" value="<?php echo $user_detail->login_name; ?>" id="personal_link" onblur="checkUserName()"> 
                            <input type="hidden" value="<?php echo $user_detail->login_name; ?>" id="old_username">
                            <button type="button" class="btn_col btn btn-danger" id="save_profile_url">
                                 <span class="glyphicon glyphicon-floppy-disk"></span>
                                 <i>Save</i>
                            </button>
                      </span>
       </p>



       <?php if(($acc_type=='PRO')||($acc_type=='PLUS')){ ?>
          <p class="ac_am_user_update_sport_userurl_id">User id :
            <?php 
                    echo "<span id='user_unique_code'>".$user_detail->unique_code."</p>";
                    echo "<span id='change_unique_code' class='glyphicons glyphicons-refresh'></span></span>";
          }  ?>               

      </div>  



  <script>

   $("#seeking").on('change',function(){
    var seeking = $(this).val();

    if(seeking==1 || seeking==2){
      $("#clg-box").fadeIn('slow');
    }else{
      $("#clg-box").fadeOut('slow');
    }
});

    $("#edit_icon_profile_url").click(function(){
          $("#edit_profile_url").toggle();
   });

    $('#save_profile_url').click(function(){
      var username = $("#personal_link").val();
       $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>home/updateProfileUrl',
              data: {username:username},
            })
          .done(function(data){
              var url = "<?php echo base_url(); ?>home";
              window.location= url; 
          })
    });

  function checkUserName() {

  var user_filter = /^[a-zA-Z0-9_.]+$/;
  var old_username = $("#old_username").val();
  var username = $("#personal_link").val();

  if(username.length >0){

    if(username.length < 6){

          $('#personal_link').focus();
          $('#link_error').show();
          $('#link_error').css('color', 'red'); 
          $('#link_error').text(" Username must be at least 6 characters");

           setTimeout(function() {
            $('#link_error').slideUp('slow');
            },2000); 
          return false;
     }

       if(!username.match(user_filter)){ 

             $('#personal_link').focus();
                    $('#link_error').show();
                    $('#link_error').css('color', 'red'); 
                    $('#link_error').text("Username can contain only characters, numeric digits");
                    setTimeout(function() {
                    $('#link_error').slideUp('slow');
                    },5000);   
                    return false;                   
       }

   }//end usename length o if 

    if(username==old_username){

          $('#link_error').show();
               $('#link_error').css('color', 'green'); 
               $('#link_error').text("Its Your Current Username");
               setTimeout(function() {
                 $('#link_error').slideUp('slow');
                 },2000); 
               return false;
    }else{

    if(!username==''){

        $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>userpersonal/checkUserName',
              data: {username:username},
            })

            .done(function(data){
              if(data==0){

                   $('#link_error').show();
                   $('#link_error').css('color', 'green'); 
                   $('#link_error').text(" Username Available");
                   setTimeout(function() {
                     $('#link_error').slideUp('slow');
                     },2000); 
                   return false;
             }

           if(data==1){
               $('#link_error').show();
               $('#link_error').css('color', 'red');
               $('#link_error').text(" Username Not Available");
               setTimeout(function() {
                 $('#link_error').slideUp('slow');
                 },2000); 
               return false;
           }

      })

    }
  } 

}

</script>

<!-- Start Bio Infomation -->

  
<div class="ac_am_brief_bio border_bottom" id="bio_section">

      <h4>Brief Bio <a style="display:none" class="glyphicon glyphicon-pencil ac_am_academic_icon ac_am_academic_icon-content pull-right" id="edit_brief_bio"></a>

</h4>

   <p id="brief_bio">   

        <?php echo $personal_info->message; ?></p>

   <div id="edit_personal_msg" style="display:none;">

  <form action="<?php echo base_url(); ?>userdetail/updatePersonalInfo" method="POST">

     <textarea class="form-control" name="personal_info"><?php echo $personal_info->message; ?></textarea>

      <br>


        <div class="col-md-3 pull-right space-none right_content">

           <button type="submit" class="btn_col btn btn-danger ac_save"> Save </button>

           <button type="button" id="cancel_personal" class="btn btn-primary ac_cancel">Cancel </button>

        </div>

      </form>

  </div>

</div>





<script>

 $("#edit_brief_bio").click(function(){
       $("#edit_personal_msg").fadeIn();
       $("#brief_bio").fadeOut();
 });

  $("#cancel_personal").click(function(){
        $("#edit_personal_msg").fadeOut();
        $("#brief_bio").fadeIn();
 });

  $(document).ready(function(){
      $("#bio_section").mouseenter(function(){
          $("#edit_brief_bio").css({ display: "block" }); 
      })

       .mouseleave(function()    {  
           $("#edit_brief_bio").css({ display: "none" }); 
        });

});//end redy document
 

</script>



<!-- End profile Url and Unique Code  -->

<!-- End Bio Information -->



<span id="event_edit_view"></span>

<script>

$(document).ready(function()
 {

  $("#academic_view").mouseenter(function(){
      $("#edit_academic").css({ display: "block" }); 
  })

   .mouseleave(function()    {  
       $("#edit_academic").css({ display: "none" }); 
    });


});//end redy document

</script>

<?php if(!empty($school)){ ?>



<div class="ac_am_academic border_bottom" id="academic_view">

		    <h4>Academics <a style="display:none" class="glyphicon glyphicon-pencil ac_am_academic_icon ac_am_academic_icon-content pull-right" id="edit_academic"></a></h4>
      
        <div class="inner">
          <ul>
            <li>
              <b>HIGH SCHOOL</b><i>:</i>
              <span><?php echo $school->school_name; ?></span>
            </li>
             <li>
              <b>COUNSELOR NAME</b><i>:</i>
              <span><?php echo $school->high_school_counselor; ?></span>
            </li>
             <li>
              <b>GRADUATION DATE </b><i>:</i>
              <span><?php echo $school->high_school_graduation_date; ?></span>
            </li>
            <li>
              <b>GPA </b><i>:</i>
              <span><?php echo $school->overall_gpa; ?></span>
            </li>
            <li>
              <b>SAT SCORE </b><i>:</i>
              <span><?php echo $school->overall_set_score; ?></span>
            </li>

             <li>
              <b>ACT SCORE </b><i>:</i>
              <span><?php echo $school->overall_act_score; ?></span>
            </li>

             <li>
              <b>CLASS RANK </b><i>:</i>
              <span><?php echo $school->class_ranked; ?></span>
            </li>
             <li>
              <b>POTENTIAL MAJORS </b><i>:</i>
              <span><?php echo $school->potential_college_major; ?></span>
            </li>

              <li>
              <b>CLEARING HOUSE NUMBER </b><i>:</i>
              <span><?php echo $school->clearing_house; ?></span>
            </li>
    <span id="academic_more_detail">
        <li><b>School Type </b><i>:</i><span><?php if($school->school_type==1){echo "Public";}else{echo "Private";} ?></span></li>

        <li><b>TOEFL (International Students)</b><i>:</i><span><?php echo $school->toefl; ?></span></li>

       <li><b>College Enrolment Date</b><i>:</i><span><?php echo $school->college_enrolment_date; ?></span></li>

       <li><b>Transferable College Credits</b><i>:</i><span><?php echo $school->transferable_college_credits; ?></span></li>

       <li><b>School Phone</b><i>:</i><span><?php echo $school->school_phone; ?></span></li>

       <li><b>School Website</b><i>:</i><span><?php echo $school->school_website; ?></span></li>

       <li><b>School Location</b><i>:</i><span><?php echo $school->school_location; ?></span></li>

       <li><b>Academic Goals</b><i>:</i><span><?php echo $school->academic_goals; ?></span></li>

     </span>

          </ul>
        </div>


			 
	   

	     <div class="ac_am_academic_info">

			   	<a class="" id="academic_more">SHOW ADDITIONAL INFORMATION</a>

		    </div>



	    <script type="text/javascript">
        $(document).ready(function(){
          $("#academic_more_detail").hide();

          $("#academic_more").click(function(){
            $("#academic_more_detail").toggle();
            var content =$("#academic_more").text();
            if(content=='HIDE ADDITIONAL INFORMATION') {
              $("#academic_more").text("SHOW ADDITIONAL INFORMATION");  
            }else{
              $("#academic_more").text("HIDE ADDITIONAL INFORMATION");
            }
            
          });
        });
      </script>

	    </div>





	    <div class="ac_am_academic border_bottom" id="academic_edit_view">

		    <h4>Academics</h4>

		  <form action="<?php echo base_url(); ?>userschool/editSchool" method="POST" accept-charset="utf-8">

		  	<input type="hidden" name="user_id" value="<?php echo $school->wgp_user_id; ?>"> 

		  <div class="row">

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>HIGH SCHOOL :</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="high_school" value="<?php echo $school->school_name; ?>" class="form-control">	

		    </div>

		 



		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>COUNSELOR NAME :</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="counselor_name" value="<?php echo $school->high_school_counselor; ?>" class="form-control">	

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>GRADUATION DATE :</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="graduation_date" id="graduation_date" value="<?php echo $school->high_school_graduation_date; ?>">	

		    </div>



		     <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>GPA :</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="overall_gpa" value="<?php echo $school->overall_gpa; ?>" class="form-control">	

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>SAT SCORE :</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="sat_score" value="<?php echo $school->overall_set_score; ?>" class="form-control">	

		    </div>



		     <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>ACT SCORE :</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="act_score" value="<?php echo $school->overall_act_score; ?>" class="form-control">	

		    </div>



		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>CLASS RANK :</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="class_rank" value="<?php echo $school->class_ranked; ?>" class="form-control">	

		    </div>





		     <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>POTENTIAL MAJORS :</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="college_major" value="<?php echo $school->potential_college_major; ?>" class="form-control">	

		    </div>

		     <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>CLEARING HOUSE NUMBER :</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="house_reg" value="<?php echo $school->clearing_house; ?>" class="form-control">	

		    </div>

		   <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>School Type:</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <select name="schooltype" class="form-control">

		    	 	<option value="1" <?php if($school->school_type==1){echo 'selected="selected"';} ?> >Public</option>

		    	 	<option value="2" <?php if($school->school_type==2){echo 'selected="selected"';} ?>>Private</option>		

		    	 </select>

		    </div>

		      <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>TOEFL (International Students):</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="toefl" value="<?php echo $school->toefl; ?>" class="form-control">	

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>College Enrolment Date :</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="enrolment_date" id="enrolment_date" value="<?php echo $school->college_enrolment_date; ?>">	

		    </div>



		     <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>Transferable College Credits :</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="college_credit" value="<?php echo $school->transferable_college_credits; ?>" class="form-control">	

		    </div>

		     <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>School Phone:</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="school_phone" value="<?php echo $school->school_phone; ?>" class="form-control">	

		    </div>



		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>School Website:</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="school_website" value="<?php echo $school->school_website; ?>" class="form-control">	

		    </div>

		      <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>School Location:</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="school_loaction" value="<?php echo $school->school_location; ?>" class="form-control">	

		    </div>

		      <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>Academic Goals:</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="academic_goals" value="<?php echo $school->academic_goals; ?>" class="form-control">	

		    </div>

		    <div class="col-md-3 pull-right right_content">

		    	 <button type="submit" class="btn_col btn btn-danger ac_save">	Save </button>

		    	 <button type="button" id="cancel_academic" class="btn btn-primary ac_cancel">	Cancel </button>

		    </div>



		  </form>



	</div>



</div> <!-- End ACADEMICS Section  -->

<script>

$(document).ready(function(){

 $("#academic_edit_view").hide();

 $("#academic_add_view").hide();

		$("#edit_academic").click(function(){

				$("#academic_view").fadeOut();

				$("#academic_edit_view").fadeIn();

		});



		$("#cancel_academic").click(function(){

			$("#academic_view").fadeIn();

				$("#academic_edit_view").fadeOut();

		});

 });

</script>



<?php }else{ ?>



<script>

$(document).ready(function(){



 $("#academic_add_view").hide();

		$("#add_academic").click(function(){			

				$("#academic_add_view").toggle();

		});

 });

</script>


<div class="ac_am_academic border_bottom">

           <h4>Academics</h4>
     <div id="academic_add_view">
		  <form action="<?php echo base_url()?>userschool/updateSchool" method="POST" accept-charset="utf-8">

		  <div class="row">

		    <div class="col-md-6">
		    	<label>HIGH SCHOOL :</label>
		    </div>
		    <div class="col-md-6">
		    	 <input type="text" name="schoolname"  class="form-control">
		    </div>

		 



		    <div class="col-md-6">

		    	<label>COUNSELOR NAME :</label>

		    </div>

		    <div class="col-md-6">

		    	 <input type="text" name="counselor_name"  class="form-control">	

		    </div>

		    <div class="col-md-6">

		    	<label>GRADUATION DATE :</label>

		    </div>

		    <div class="col-md-6">

		    	 <input type="text" name="graduation_date" id="graduation_date" >	

		    </div>



		     <div class="col-md-6">

		    	<label>GPA :</label>

		    </div>

		    <div class="col-md-6">

		    	 <input type="text" name="overall_gpa"  class="form-control">	

		    </div>

		    <div class="col-md-6">

		    	<label>SAT SCORE :</label>

		    </div>

		    <div class="col-md-6">

		    	 <input type="text" name="sat_score"  class="form-control">	

		    </div>



		     <div class="col-md-6">

		    	<label>ACT SCORE :</label>

		    </div>

		    <div class="col-md-6">

		    	 <input type="text" name="act_score"  class="form-control">	

		    </div>



		    <div class="col-md-6">

		    	<label>CLASS RANK :</label>

		    </div>

		    <div class="col-md-6">

		    	 <input type="text" name="class_rank"  class="form-control">	

		    </div>





		     <div class="col-md-6">

		    	<label>POTENTIAL MAJORS :</label>

		    </div>

		    <div class="col-md-6">

		    	 <input type="text" name="college_major"  class="form-control">	

		    </div>

		     <div class="col-md-6">

		    	<label>CLEARING HOUSE NUMBER :</label>

		    </div>

		    <div class="col-md-6">

		    	 <input type="text" name="house_reg" class="form-control">	

		    </div>

		   <div class="col-md-6">

		    	<label>School Type:</label>

		    </div>

		    <div class="col-md-6">

		    	 <select name="schooltype" class="form-control">

		    	 	<option value="1" >Public</option>

		    	 	<option value="2" >Private</option>		

		    	 </select>

		    </div>

		      <div class="col-md-6">

		    	<label>TOEFL (International Students):</label>

		    </div>

		    <div class="col-md-6">

		    	 <input type="text" name="toefl" class="form-control">	

		    </div>

		    <div class="col-md-6">

		    	<label>College Enrolment Date :</label>

		    </div>

		    <div class="col-md-6">

		    	 <input type="text" name="enrolment_date" id="enrolment_date">	

		    </div>



		     <div class="col-md-6">

		    	<label>Transferable College Credits :</label>

		    </div>

		    <div class="col-md-6">

		    	 <input type="text" name="college_credits"  class="form-control">	

		    </div>

		     <div class="col-md-6">

		    	<label>School Phone:</label>

		    </div>

		    <div class="col-md-6">

		    	 <input type="text" name="school_phone"  class="form-control">	

		    </div>



		    <div class="col-md-6">

		    	<label>School Website:</label>

		    </div>

		    <div class="col-md-6">

		    	 <input type="text" name="school_website" class="form-control">	

		    </div>

		      <div class="col-md-6">

		    	<label>School Location:</label>

		    </div>

		    <div class="col-md-6">

		    	 <input type="text" name="school_location"  class="form-control">	

		    </div>

		      <div class="col-md-6">

		    	<label>Academic Goals:</label>

		    </div>

		    <div class="col-md-6">

		    	 <input type="text" name="academic_goal" class="form-control">	

		    </div>



		    <div class="col-md-6">

		    </div>

		    <div class="col-md-6">
		    	 <button type="submit" class="btn_col btn btn-danger ac_save">	Save </button>
		    </div>

		  </form>
	   </div>
  </div>

<button type="button" id="add_academic" class="glyphicon glyphicon-plus icon_pusbig_orange"></button>

</div>


<?php } ?>

<!--  Start Transcript Section  -->

 <div class="ac_am_academic border_bottom">

        <h4>Transcripts</h4>

      <span id="trans_view">

  <?php if(!empty($transcripts_details)){ ?>
      <div class="table-responsive">
        <table class="uk-table uk-text-nowrap adept-table table">

                    <thead>

                    <tr>

                        <th>Degree Level</th>

                        <th>Course Name</th>

                        <th>Course level </th>

                        <th>School Year </th>

                        <th>Academic Grade</th>                            

                        <th>Edit</th>                        

                    </tr>

                    </thead>

                    

                    <tbody> 

                    <?php foreach($transcripts_details as $value) { ?>                          

                    <tr id="trans_row_<?php echo $value->wgp_table_id; ?>">

                        <td><?php echo $value->degree_level ;?></td>

                        <td><?php echo $value->course_name ;?></td>

                        <td><?php echo $value->course_level ;?></td>

                        <td><?php echo $value->school_year ;?></td>

                        <td><?php echo $value->academic_grade ;?></td>                            

                        <td>

                            <a class="adept-edit"  onclick="editTransRow(<?php echo $value->wgp_table_id; ?>);">

                                    <i class="material-icons">&#xE150;</i>

                                </a>



                                <a class="adept-delete" onclick="return deleteTransRow(<?php echo $value->wgp_table_id; ?>);">

                                    <i class="material-icons">&#xE872;</i>

                                </a>

                       </td>                           

                    </tr>

                    <?php  } ?>

                    </tbody>
        </table> 
      </div>

     <?php } ?>

                           

     <div class="uk-form-row">
              <span onclick="addTestScore()" class="glyphicon glyphicon-plus icon_pusbig_orange"></span>
      </div>


   </span>             

                       

                   <!-- Action Target  -->

                     <div id="transcripts"></div>

           

        </div>    

  

<script>

function addTestScore() {

     $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>usertranscripts/addNew',
              data: {},
          })
      .done(function(data){
        $('#transcripts').fadeIn();
        $('#transcripts').html(data);
      })  

}



function editTransRow(id){   

    $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>usertranscripts/editTransRow',
              data: {edit:id},
            })

          .done(function(data){
             $("#trans_view").fadeOut();             
             $('#transcripts').html(data).fadeIn();
          });

}



function deleteTransRow(id){

    var row_id = id;

    var choice = confirm('Do you really want to delete this record?');
    if(choice === true) {  
     $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>usertranscripts/deleteTransRow',
            data: {row_id:row_id},
            })

            .done(function(data){
               if(data==1){
                  var row_id='#trans_row_'+id;
                  $(row_id).fadeOut();
               }else{
                   alert('OOPs! some error occur');
               } 
            });

      }

      return false;

}



</script>



<!-- End Transcript Section  -->

<script>

$(document).ready(function()
 {

  $("#view_teaminfo").mouseenter(function(){
      $("#teaminfo_edit").css({ display: "block" }); 
  })

   .mouseleave(function()    {  
       $("#teaminfo_edit").css({ display: "none" }); 
    });


});//end redy document

</script>


<!-- Start Teaminfo Section  -->
<?php if(!empty($teaminfo)){ ?>
  <div class="ac_am_academic" id="view_teaminfo">
        <h4>Athletics <a style="display:none" class="glyphicon glyphicon-pencil ac_am_academic_icon ac_am_academic_icon-content pull-right" id="teaminfo_edit"></span></a></h4>
    
    <div class="inner">
        <ul>
            <li><b>TEAM NAME</b><i>:</i>
                <span><?php echo $teaminfo[0]->team_name; ?></span>
            </li>

             <li><b>LEVEL</b><i>:</i>
                <span><?php echo $teaminfo[0]->level_name; ?></span>
            </li>

             <li><b>Jersey Number</b><i>:</i>
                <span><?php echo $teaminfo[0]->jersey_number; ?></span>
            </li>

             <li><b>Competition</b><i>:</i>
                <span><?php echo $teaminfo[0]->competition_name; ?></span>
            </li>

              <li><b>Division</b><i>:</i>
                <span><?php echo $teaminfo[0]->division_name; ?></span>
            </li>

              <li><b>Team home color uniform</b><i>:</i>
                <span><?php echo $teaminfo[0]->team_home_uniform_name; ?></span>
            </li>
              <li><b>Team away color uniform</b><i>:</i>
                <span><?php echo $teaminfo[0]->team_away_color_name; ?></span>
            </li>
           <span id="teaminfo_more_detail">
              <li><b>STYLE OF PLAY</b><i>:</i>
                <span><?php echo $teaminfo[0]->style_of_play_name; ?></span>
            </li>
             <li><b>COLLEGE ELIGIBILITY</b><i>:</i>
                <span><?php echo $teaminfo[0]->playing_eligibility; ?></span>
            </li>
             <li><b>COACH NAME</b><i>:</i>
                <span><?php echo $teaminfo[0]->head_coach_full_name; ?></span>
            </li>
             <li><b>COACH EMAIL</b><i>:</i>
                <span><?php echo $teaminfo[0]->coach_email; ?></span>
            </li>
             <li><b>Favorite Sports Ground</b><i>:</i>
                <span><?php echo $teaminfo[0]->favortite_sports_ground_name; ?></span>
            </li>
             <li><b>Coach Phone </b><i>:</i>
                <span><?php echo $teaminfo[0]->coach_phone; ?></span>
            </li>
             <li><b>Team Address </b><i>:</i>
                <span><?php echo $teaminfo[0]->team_home_address; ?></span>
            </li>

             <li><b>Team Website </b><i>:</i>
                <span><?php echo $teaminfo[0]->team_website; ?></span>
            </li>

            
          </span>
          </ul>

           <div class="ac_am_academic_info">
               <a class="" id="teaminfo_more">
                   SHOW ADDITIONAL INFORMATION
                </a>
          </div>

    </div>  

</div>
  

   <script type="text/javascript">
        $(document).ready(function(){
          $("#teaminfo_more_detail").hide();

          $("#teaminfo_more").click(function(){
                $("#teaminfo_more_detail").toggle();
                  var content =$("#teaminfo_more").text();           
                  if(content=='HIDE ADDITIONAL INFORMATION') {
                    $("#teaminfo_more").text("SHOW ADDITIONAL INFORMATION");  
                  }else{
                    $("#teaminfo_more").text("HIDE ADDITIONAL INFORMATION");
                  }
            
          });
        });
      </script>

      <script>
$(document).ready(function(){
 $("#teaminfo_edit_view").hide();
 $("#teaminfo_add_view").hide();
    $("#teaminfo_edit").click(function(){
        $("#view_teaminfo").fadeOut();
        $("#teaminfo_edit_view").fadeIn();
    });

    $("#cancel_teaminfo").click(function(){
        $("#view_teaminfo").fadeIn();
        $("#teaminfo_edit_view").fadeOut();
    }); 

 });
</script>



 <div class="ac_am_academic" id="teaminfo_edit_view">

		    <h4>Athletics</h4>

		  <form action="<?php echo base_url()?>userteaminfo/updateTeaminfo" method="POST" accept-charset="utf-8">

		  	 

    		  <div class="row">

    		    <div class="col-md-6 col-sm-6 col-xs-12">
    		    	<label>TEAM NAME :</label>
    		    </div>

    		    <div class="col-md-6 col-sm-6 col-xs-12">
    		    	 <input type="text" name="team_name" value="<?php echo $teaminfo[0]->team_name ;?>" class="form-control">	
            </div>


            <div class="col-md-6 col-sm-6 col-xs-12">
              <label>Jersey Number :</label>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
               <input type="text" name="jersey_number" value="<?php echo $teaminfo[0]->jersey_number ;?>" class="form-control"> 
            </div>

    		    <div class="col-md-6 col-sm-6 col-xs-12">

    		    	<label>Level :</label>

    		    </div>

    		    <div class="col-md-6 col-sm-6 col-xs-12">		    	

    		    	 <select id="level" name="level" required class="form-control">

                        <?php foreach ($level as $value) { ?>

                             <option value="<?php echo $value->levelId; ?>"

                                  <?php 

                                       if($value->levelId==$teaminfo[0]->level){

                                                echo "selected";

                                              } ?>

                                          ><?php echo $value->levelName; ?></option>

                                   <?php  }?>                 

                      </select>

    		    </div>

    		    <div class="col-md-6 col-sm-6 col-xs-12">

    		    	<label>Competition :</label>

    		    </div>

    		    <div class="col-md-6 col-sm-6 col-xs-12">

    		    	 <select id="competition" name="competition" required class="form-control">

                          <?php foreach ($competition as $value) { ?>

                                        <option value="<?php echo $value->id; ?>"

                                          <?php 

                                              if($value->id==$teaminfo[0]->competition){

                                                echo "selected";

                                              } ?>

                                              ><?php echo $value->competition; ?></option>';

                                   <?php  }?>

                     </select>

    		    </div>



    		     <div class="col-md-6 col-sm-6 col-xs-12">

    		    	<label>College Playing Eligibility:</label>

    		    </div>

    		    <div class="col-md-6 col-sm-6 col-xs-12">

    		    	 <select id="clg_play" name="clg_play" required class="form-control">

                         <?php foreach ($playing_year as $value) { ?>

                                        <option value="<?php echo $value->id; ?>"

                                          <?php 

                                              if($value->id==$teaminfo[0]->college_playing_eligibility){

                                                echo "selected";

                                              } ?>

                                              ><?php echo $value->year; ?></option>

                                   <?php  }?> 

                     </select>	

    		    </div>

    		    <div class="col-md-6 col-sm-6 col-xs-12">

    		    	<label>Division :</label>

    		    </div>

    		    <div class="col-md-6 col-sm-6 col-xs-12">

    		    	<select id="division" name="division" required class="form-control">

                      <?php foreach ($division as $value) { ?>

                                        <option value="<?php echo $value->id; ?>"

                                          <?php 

                                              if($value->id==$teaminfo[0]->division){

                                                echo "selected";

                                              } ?>

                                          ><?php echo $value->division; ?></option>

                          <?php  }?>  

           		   </select>



    		    </div>



    		     <div class="col-md-6 col-sm-6 col-xs-12">

    		    	<label>Team home color uniform :</label>

    		    </div>

    		    <div class="col-md-6 col-sm-6 col-xs-12">

    		    	 <select id="home_color" name="home_color" required class="form-control">

                    <?php foreach ($color as $value) { ?>

                          <option value="<?php echo $value->id; ?>"

                                          <?php 

                                              if($value->id==$teaminfo[0]->team_home_uniform){

                                                echo "selected";

                                              } ?>

                                              ><?php echo $value->color; ?></option>

                                   <?php  }?>                                  

           			</select>

    		    </div>



    		    <div class="col-md-6 col-sm-6 col-xs-12">

    		    	<label>Team Away color uniform:</label>

    		    </div>

    		    <div class="col-md-6 col-sm-6 col-xs-12">

    		    	 <select id="away_color" name="away_color" required class="form-control">

    		             <?php foreach ($color as $value) { ?>

                                        <option value="<?php echo $value->id; ?>"

                                          <?php 

                                              if($value->id==$teaminfo[0]->team_away_color){

                                                echo "selected";

                                              } ?>

                                          ><?php echo $value->color; ?></option>

                                   <?php  }?>                                   

    		          </select>	

    		    </div>





    		     <div class="col-md-6 col-sm-6 col-xs-12">

    		    	<label>Head Coach Full Name :</label>

    		    </div>

    		    <div class="col-md-6 col-sm-6 col-xs-12">

    		    	 <input type="text" name="head_coach"  value="<?php echo $teaminfo[0]->head_coach_full_name;?>" class="form-control">	

    		    </div>

    		     <div class="col-md-6 col-sm-6 col-xs-12">

    		    	<label>Years playing for this team:</label>

    		    </div>

    		    <div class="col-md-6 col-sm-6 col-xs-12">		    	

    		    	 <select id="years" name="years"  required class="form-control">

    	                 <?php foreach ($year as $value) { ?>

                                        <option value="<?php echo $value;?>"

                                          <?php 

                                              if($value==$teaminfo[0]->playing_years){

                                                echo "selected";

                                              } ?>

                                              ><?php echo $value;?></option>

                                   <?php  }?>	                                        

    	               </select>	

    		    </div>

    		   <div class="col-md-6 col-sm-6 col-xs-12">

    		    	<label>Style of Play:</label>

    		    </div>

    		    <div class="col-md-6 col-sm-6 col-xs-12">

    		    	 <select id="play_style" name="play_style" required class="form-control">

                         <?php foreach ($play_style as $value) { ?>

                                        <option value="<?php echo $value->id;?>"

                                          <?php 

                                              if($value->id==$teaminfo[0]->style_of_play){

                                                echo "selected";

                                              } ?>

                                              ><?php echo $value->play_style;?></option>

                                   <?php  }?>     

                      </select>

    		    </div>

    		      <div class="col-md-6 col-sm-6 col-xs-12">

    		    	<label>Favorite Sports Ground:</label>

    		    </div>

    		    <div class="col-md-6 col-sm-6 col-xs-12">

    		    	 <select id="fav_sport" name="fav_sport" required class="form-control">

                          <?php foreach ($sports_ground as $value) { ?>

                                <option value="<?php echo $value->id;?>"

                          <?php if($value->id==$teaminfo[0]->favortite_sports_ground){

                                         echo "selected";

                            } ?>

                           ><?php echo $value->ground_name;?></option>

                       <?php  }?>  

           			     </select>	

    		    </div>

    		    <div class="col-md-6 col-sm-6 col-xs-12">

    		    	<label>Coach Phone :</label>

    		    </div>

    		    <div class="col-md-6 col-sm-6 col-xs-12">

    		    	 <input type="text" name="coach_phone" value="<?php echo $teaminfo[0]->coach_phone;?>" required class="form-control" />

    		    </div>



    		     <div class="col-md-6 col-sm-6 col-xs-12">

    		    	<label>Coach Email :</label>

    		    </div>

    		    <div class="col-md-6 col-sm-6 col-xs-12">

    		    	 <input type="text" name="coach_email"  value="<?php echo $teaminfo[0]->coach_email;?>" class="form-control">	

    		    </div>

    		     <div class="col-md-6 col-sm-6 col-xs-12">

    		    	<label>Team home address:</label>

    		    </div>

    		    <div class="col-md-6 col-sm-6 col-xs-12">

    		    	 <input type="text" name="team_home_address"  value="<?php echo $teaminfo[0]->team_home_address;?>" class="form-control">	

    		    </div>



    		    <div class="col-md-6 col-sm-6 col-xs-12">

    		    	<label>Team Website:</label>

    		    </div>

    		    <div class="col-md-6 col-sm-6 col-xs-12">

    		    	 <input type="text" name="team_website" value="<?php echo $teaminfo[0]->team_website;?>" class="form-control">	

    		    </div>

    		    <div class="col-md-3 pull-right right_content">

    		    	 <button type="submit" class="btn_col btn btn-danger ac_save">	Save </button>

    		    	 <button type="button" id="cancel_teaminfo" class="btn btn-primary ac_cancel">	Cancel </button>

    		    </div>



		  </form>



	</div>



</div>


	<?php }else{ ?>


<script>

$(document).ready(function(){



 $("#athletic_add_view").hide();

		$("#add_athletic").click(function(){			

				$("#athletic_add_view").toggle();

		});

 });

</script>

<div class="ac_am_academic">
      <h4>Athletics</h4>
         <div id="athletic_add_view">   

		       <form action="<?php echo base_url()?>userteaminfo/addTeamInfo" method="POST" accept-charset="utf-8">

		  	 

		  <div class="row">

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>TEAM NAME :</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="team_name"  class="form-control">	

		    </div>

		 



		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>Level :</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">		    	

		    	 <select id="level" name="level" required class="form-control">

                     <?php foreach ($level as $value) { ?>

                         <option value="<?php echo $value->levelId; ?>"><?php echo $value->levelName; ?></option>

                       <?php  }?>                

                  </select>

		    </div>

         <div class="col-md-6 col-sm-6 col-xs-12">
          <label>Jersey Number :</label>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
           <input type="text" name="jersey_number" value="" class="form-control"> 
        </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>Competition :</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <select id="competition" name="competition" required class="form-control">

                       <?php foreach ($competition as $value) { ?>

                        <option value="<?php echo $value->id; ?>"><?php echo $value->competition; ?></option>

                       <?php  }?> 

                 </select>

		    </div>



		     <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>College Playing Eligibility:</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <select id="college_playing_eligibility" name="college_playing_eligibility" required class="form-control">

                     <?php foreach ($playing_year as $value) { ?>

                         <option value="<?php echo $value->id; ?>"><?php echo $value->year; ?></option>

                      <?php  }?> 

                 </select>	

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>Division :</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	<select id="division" name="division" required class="form-control">

                 <?php foreach ($division as $value) { ?>

                    <option value="<?php echo $value->id; ?>"><?php echo $value->division; ?></option>

               <?php  }?> 

       		   </select>

		    </div>



		     <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>Team home color uniform :</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <select id="team_home_color_uniform" name="team_home_color_uniform" required class="form-control">

                 <?php foreach ($color as $value) { ?>

                    <option value="<?php echo $value->id; ?>"><?php echo $value->color; ?></option>

                  <?php  }?>                                 

       			</select>

		    </div>



		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>Team Away color uniform:</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <select id="team_away_color_uniform" name="team_away_color_uniform" required class="form-control">

		              <?php foreach ($color as $value) { ?>

                          <option value="<?php echo $value->id; ?>"><?php echo $value->color; ?></option>

                      <?php  }?>                                  

		          </select>	

		    </div>





		     <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>Head Coach Full Name :</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="head_coach_full_name"  class="form-control">	

		    </div>

		     <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>Years playing for this team:</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <select id="years_playing_for_this_team" name="years_playing_for_this_team"  required class="form-control">

	                 <?php foreach ($year as $value) { ?>

                        <option value="<?php echo $value;?>"><?php echo $value;?></option>

                      <?php  }?> 	                                        

	               </select>	

		    </div>

		   <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>Style of Play:</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <select id="style_of_play" name="style_of_play" required class="form-control">

                      <?php foreach ($play_style as $value) { ?>

                          <option value="<?php echo $value->id;?>"><?php echo $value->play_style;?></option>

                       <?php  }?>   

                  </select>

		    </div>

		      <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>Favorite Sports Ground:</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <select id="favorite_sports_ground" name="favorite_sports_ground" required class="form-control">

                      <?php foreach ($sports_ground as $value) { ?>

                   <option value="<?php echo $value->id;?>"><?php echo $value->ground_name;?></option>

                    <?php  }?> 

       			     </select>	

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>Coach Phone :</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="coach_phone" required class="form-control" />

		    </div>



		     <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>Coach Email :</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="coach_email"  class="form-control">	

		    </div>

		     <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>Team home address:</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="team_home_address"  class="form-control">	

		    </div>



		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	<label>Team Website:</label>

		    </div>

		    <div class="col-md-6 col-sm-6 col-xs-12">

		    	 <input type="text" name="team_website" class="form-control">	

		    </div>

		

      <div class="col-md-3 pull-right right_content">

               <button type="submit" class="btn_col btn btn-danger ac_save"> Save </button>

               <button type="button" id="cancel_teaminfo" class="btn btn-primary ac_cancel">  Cancel </button>

            </div>
		  </form>



	     </div>

    </div>
      <button type="button" id="add_athletic" class="glyphicon glyphicon-plus icon_pusbig_orange"></button>

</div>

<?php } ?>



<!-- End Teaminfo Section Start  -->

<!-- Start Stats Section  -->

  <div class="ac_am_academic">
      <h4>Stats</h4>
    <span id="view_stats">
        <?php if(!empty($stats_details)){ ?>
             <div class="table-responsive">
            <table class="uk-table uk-text-nowrap adept-table">
                    <thead>
                         <tr>
                              <th>Level</th>
                              <th>Season</th>
                              <th>Games played</th>
                              <th>Games started</th>
                              <th>Goals</th>
                              <th>Assists</th>
                              <th>Points</th>
                              <th>Total points</th>
                              <th>Edit</th>
                          </tr>
                       </thead>                

                        <tbody>

                       <?php foreach($stats_details as $key=>$value) { ?>



                        <tr id="stats_row_<?php echo $value->wgp_table_id; ?>">

                              <td><?php echo $value->level;?></td>
                              <td>
                                <?php foreach ($seas as $key => $sea) {
                                        if($value->season==$key){
                                            echo $sea;
                                        }
                                  } ?>

                              </td>
                              <td><?php echo $value->games_played;?></td>
                              <td><?php echo $value->games_started;?></td>
                              <td><?php echo $value->goals;?></td>
                              <td><?php echo $value->assists;?></td>
                              <td><?php echo $value->points;?></td>
                              <td><?php echo $value->total_points;?></td>                    
                              <td>
                                    <a class="adept-edit" href="#" id="edit_stats<?php echo $value->wgp_table_id; ?>" onclick="editStats(<?php echo $value->wgp_table_id; ?>)">
                                            <i class="material-icons">&#xE150;</i>
                                    </a>
                                    <a class="adept-delete" href="#" id="delete_stats<?php echo $value->wgp_table_id; ?>" onclick="deleteStats(<?php echo $value->wgp_table_id; ?>)">
                                          <i class="material-icons">&#xE872;</i>
                                    </a>                         
                              </td> 
                          </tr>

         <?php }  ?>
         </table>
        </div>
    <div class="">
        <button type="button" onclick="addStats()" class="glyphicon glyphicon-plus icon_pusbig_orange"></button>

    </div>
        <?php } else{ ?>

      <div class="">
        <button type="button" onclick="addStats()" class="glyphicon glyphicon-plus icon_pusbig_orange"></button>
      </div>

 </span>

 <?php }  ?>
 <div id="stats_status"> </div>
</div>

  

<script>
function addStats(){
     $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>userstats/addStats',
              data: {},
          })
        .done(function(data){        
               $('#stats_status').html(data);
        })
    }        

     // End addTestSCore Function
  function editStats(id){
     $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>userstats/updateStatsView',
              data: {edit:id},
            })

          .done(function(data){
             $("view_stats").fadeOut('slow');
             $('#stats_status').html(data).fadeIn('slow');
          });
  }

  function deleteStats(id){
    $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>userstats/deleteStats',
              data: {row_id:id},
           })
         .done(function(data){              
            $('#stats_row_'+id).fadeOut();
         })
  }

</script>
<!--  End Stats Section  -->

<!--  Start Record Section  -->

 <script type="text/javascript">

 $(document).ready(function(){

  $("#record_detail_section").mouseenter(function(){
      $("#edit-record").css({ display: "block" }); 
  })
   .mouseleave(function()    {  
       $("#edit-record").css({ display: "none" }); 
    });


});//end redy document
 

   

 </script>

  <?php if($record){ ?>
    <div class="ac_am_academic" id="record_detail_section">
      <h4>Records
        <a class="glyphicon glyphicon-pencil ac_am_academic_icon ac_am_academic_icon-content pull-right" id="edit-record" style="display:none"></a>
      </h4>

       <div class="inner" id="record_detail">

          <ul>
              <li><b>30 meters sprint</b><i>:</i>
                  <span><?php echo $record->run_30.' sec';?></span>
              </li>
              <li><b>100 meters sprint</b><i>:</i>
                  <span><?php echo $record->run_100.' sec';?></span>
              </li>
              <li><b>One Mile Run</b><i>:</i>
                  <span><?php echo $record->one_mile.' min';?></span>
              </li>

               <li><b>Max bench press/reps</b><i>:</i>
                  <span><?php echo $record->max_bench; ?></span>
              </li>
               <li><b>Vertical Jump</b><i>:</i>
                  <span><?php echo $record->vertical_jump." inches"; ?></span>
              </li>
               <li><b>Horizontal Jump</b><i>:</i>
                  <span><?php echo $record->horizontal_jump." inches"; ?></span>
              </li>

          </ul>
      
      </div>

        <div id="edit_record_view" style="display:none">
           
         
          <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="mile_run" class="">One Mile Run (minutes)</label>
              <input type="text" id="mile_run" name="mile_run" value="<?php echo $record->one_mile; ?>" required class="form-control" />
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="thirty_sprint" class="">30 Meters Sprint (seconds)</label>
              <input type="text" id="thirty_sprint" name="thirty_sprint" value="<?php echo $record->run_30; ?>" required class="form-control" />
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="hundred_sprint" class="">100 Meters Sprint  (seconds)</label>
              <input type="text" id="hundred_sprint" name="hundred_sprint"  value="<?php echo $record->run_100; ?>" required class="form-control" />
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="max_bench" class="">Max bench press/reps</label>
              <input type="text" name="max_bench" id="max_bench" value="<?php echo $record->max_bench; ?>" required class="form-control" />
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="vertical_jump" class="">Vertical Jump(inches)</label>
              <input type="text" name="vertical_jump" id="vertical_jump" value="<?php echo $record->vertical_jump; ?>" required class="form-control" />
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="horizontal_jump" class="">Horizontal Jump(inches)</label>
              <input type="text" name="horizontal_jump" id="horizontal_jump" value="<?php echo $record->horizontal_jump; ?>" required class="form-control" />
            </div>

                                         
             <div class="col-md-3 pull-right right_content">
                 <button type="button" onclick="updateRecord()" class="btn_col btn btn-danger ac_save">Save</button>
                 <button type="button" id="cancel_record" class="btn btn-primary ac_cancel">Cancel</button>
             </div>
    
  



<script>
    function updateRecord(){                
            var mile_run=$("#mile_run").val();
            var thirty_sprint=$("#thirty_sprint").val();
            var hundred_sprint=$("#hundred_sprint").val();            
            var max_bench=$("#max_bench").val();
            var vertical_jump=$("#vertical_jump").val();            
            var horizontal_jump=$("#horizontal_jump").val();

       $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>user_records/updateRecord',
              data: {mile_run:mile_run,thirty_sprint:thirty_sprint,
                      hundred_sprint:hundred_sprint,max_bench:max_bench,
                      vertical_jump:vertical_jump,horizontal_jump:horizontal_jump
                    },
            })
          .done(function(data){
             $("#record_detail").empty();
             $("#record_detail").html(data);
             $("#record_detail").slideToggle('slow');
             $("#edit_record_view").slideToggle('slow');
         })
          
    }
</script>

        </div>


      </div>
    

    <script type="text/javascript">
      $("#edit-record").click(function(){
          $("#record_detail").slideToggle('slow');
          $("#edit_record_view").slideToggle('slow');
      });

       $("#cancel_record").click(function(){
          $("#record_detail").slideToggle('slow');
          $("#edit_record_view").slideToggle('slow');
      });

      
    </script>


  <?php } else{ ?>
    <div class="ac_am_academic">
      <h4>Records </h4>
        <div class="col-md-12">
           <button type="button" id="add_record" class="glyphicon glyphicon-plus icon_pusbig_orange lang_btn_div"></button>
        </div>
    </div>

     <script>

      $("#add_record").click(function(){
              $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>user_records',
                    data: {},
              })

            .done(function(data){
               $("#demo_model").trigger('click');              
               $("#model_content").empty().html(data);               

            });
      });

     </script>
  <?php } ?>
<!--  End Record Section  -->



<!-- Start Phpto Section Start  -->

<style>
  .local_photo {
    margin: 0px;
    padding: 0px;
    float: left;
    width: 25%;
    height: 158px;
    position: relative;
    }
</style>



<div class="ac_am_academic photo border_bottom" id="photo_view">

     <h4>Photos</h4> 





<button class="glyphicon glyphicon-plus icon_pusbig_orange" id="pluse_image"></button>

<script type="text/javascript">
  $("#pluse_image").click(function(){
     $("#idForm").slideToggle('slow');
  });

</script>

<form  class="uploadform" id="idForm" method="post" enctype="multipart/form-data"  name="photo" style="display:none;">

  <div id="folder_div">
      <img src="<?php echo base_url();?>images/loader.gif" alt="loading..." id="loader">
      <div class="md-card local_photo local_photo_add">
        <div class="md-input-wrapper">
            <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id;?>">  
            <input class="image-finder" type="file" name="imagefile1" id="newphoto1" onChange="loadFile(event)">

            <div class="sidebar-inner-icon" style="display:none;" id="imageopen1">
                <div class="item">
                    <img  id="output_photo">
                </div>
           </div>
            <span id="msg"></span>
        </div> 

      </div>
         <div class="input-wrapper-mds">
            <a class="file-input-wrapper  fileinput circle-icon" style="display:none;">Change Image 
              <input type="file" title="Browse file" name="imagefile2" id="imagefile" class="fileinput btn-primary" onChange="loadFile(event)">
          </a>
                <button disabled="disabled" class="btn btn-primary" id="uploadImagebutton" type="submit"> Upload Image </button>  
             </div>      

    </div> 
 </form> 





<script>

  function showImageAction(id){
    $("#action_on_this_image_"+id).fadeIn();
  }
   function hideImageAction(id){
    $("#action_on_this_image_"+id).fadeOut();
  }

	// delete the selected image

    function deleteImage(image_id)	{
		   //var gallery_id=$("#gallery_id").val();

		$.ajax({
			   type: 'POST',
			   url: '<?php echo base_url(); ?>userphotos/deleteImage',
			   data: {image_id:image_id},
		})
		.done(function(data){   
         $("#image_"+image_id).slideUp('slow'); 
        //var href="<?php echo base_url();?>home";
			 // window.location=href;
			//$('#photo').html(data);

		})

	} 

	//Making image default 

	

	function defaultImage(image_id)	{

		var gallery_id=$("#gallery_id").val();
		$.ajax({
			   type: 'POST',
			   url: '<?php echo base_url(); ?>userphotos/defaultImage',
			   data: {image_id:image_id, gallery_id:gallery_id},
		})

		.done(function(data){	
			if(data==0){
			  alert('Some error occurred. Please try again.');
			}else if(data==1){
			  alert('Image set as default successfully.');
			  var href="<?php echo base_url();?>home";
			  window.location=href;
			}

		})

	} 

</script>

<script>
	var loadFile = function(event) {		
		   var filetype=event.target.files[0].type;	
		  if(filetype=='image/png' || filetype=='image/jpeg'){		
          $("#uploadImagebutton").removeAttr('disabled');
			}else{
			   $('#photo_error').show();
			   $('#photo_error').text("*Only PNG or JPEG formats are acceptable");
			setTimeout(function() {
				 $('#photo_error').hide('slow');
			},5000);
			return false;
		}

		

		var output = document.getElementById('output_photo');	
		output.src = URL.createObjectURL(event.target.files[0]);
		var newphoto1 = 'newphoto1';
		document.getElementById(newphoto1).style.display = 'none';
		var imageopen1 = 'imageopen1';
		document.getElementById(imageopen1).style.display = 'block';
	};//function end

	

</script>





<script>

$(document).ready(function() {

	$("#loader").hide();

	$("form#idForm").submit(function(){

		 $("#loader").show();	
		 var formData = new FormData($(this)[0]);
   

		 var url = "<?php echo base_url();?>userphotos/insertAlbumImage";

		 // the script where you handle the form input.
     		 $.ajax({
              		 url: url,
              		 type: 'POST',
              		 data: formData,
              		 async: false,
              		 success: function (data) {
                     alert(data);
                     return false;
                   },
              		 cache: false,
              		 contentType: false,
              		 processData: false
		    })		   

	});	

 }); //End function  	

	

	

</script>

<div id="demo">
    <div id="owl-demo" class="owl-carousel">
        

          <?php          
 
   if(!empty($image_list)){
       foreach($image_list as $row){ ?> 

        <div class="item">
      <div class="mb_gal" id="image_<?php echo $row->image_id; ?>" onmouseover="showImageAction(<?php echo $row->image_id; ?>)" onmouseout="hideImageAction(<?php echo $row->image_id; ?>)">
           <a href="<?php echo base_url().$row->image_file; ?>">
                <img class="pho_high" src="<?php echo base_url().$row->image_file; ?>" alt=""/>
            </a>
            <p id="action_on_this_image_<?php echo $row->image_id; ?>" style="display:none;">
                <span class="btn_editndlt action_delete button_action button_action_dlt" onclick="deleteImage(<?php echo $row->image_id; ?>)"><i class="uk-icon-trash"></i></span>
                 <span class="btn_editndlt action_default button_action glyphicon glyphicon-plus button_action_dlt" onclick="defaultImage(<?php echo $row->image_id; ?>)"></span>
            </p>

       </div>
       </div>
<?php  } }else{ echo "<p>No Image in Gallery ! ";}  ?>
       
       

      </div>
  </div> 



 </div>

<!-- End Photo Section -->


<!-- Start Video Section -->
<div class="ac_am_academic photo border_bottom">
     <h4>Videos</h4> 

    <div id="video_view">
     <?php   if(is_array($video_list)){
           $video_count = count($video_list);
            foreach($video_list as $row){ 
              if($row->wgp_video_type==1) { ?>  

                <div class="col-md-6 space-left-none">
                  <div id="video_id_<?php print_r( $row->wgp_video_id); ?>" class="video_main_div"> 
                       <span style="display:none;" id="edit_video_<?php print_r( $row->wgp_video_id); ?>" class="delete_action button_action button_edit_video" onclick="editVideoTitle(<?php print_r( $row->wgp_video_id); ?>)">
                                   <i class="uk-icon-edit"></i>
                              </span> 

                          <p class="video-title" id="v_t_<?php print_r( $row->wgp_video_id); ?>"><?php echo $row->wgp_video_title; ?></p>    
                                <input type="text" style="display:none" id="video_title_<?php print_r( $row->wgp_video_id); ?>" value="<?php echo $row->wgp_video_title; ?>" onblur="changeVideoTitle(<?php print_r( $row->wgp_video_id); ?>)" class="form-control">
                

                     <?php $video_url=base_url().$row->wgp_video_source; ?>

                    <video width="100%" height="auto" controls >
                        <source src="<?php print_r( $video_url); ?>" type="video/mp4">
                        <source src="<?php print_r( $video_url); ?>" type="video/ogg">
                        Your browser does not support HTML5 video.
                      </video>   

                    
                  <span style="display:none;" id="delete_video_<?php print_r( $row->wgp_video_id); ?>" class="delete_action button_action button_action_video" onclick="deleteVideo( <?php print_r( $row->wgp_video_id); ?>)">
                      <i class="uk-icon-trash"></i>
                   </span>
                 </div> 
                </div>

      <?php  } if($row->wgp_video_type==2){ 
                 $video_url = $row->wgp_video_source; 
               if(strchr($video_url,'youtube')) {
                 if(strchr($video_url,'embed')) {
                  $coverted_url =$video_url;
                 } else{
                    $url = $video_url;
                   preg_match('/[\\?\\&]v=([^\\?\\&]+)/',$url,$matches);
                    $id = $matches[1];
                    $coverted_url= 'https://www.youtube.com/embed/'.$id;
                 }
            }

            if(strchr($video_url,'wistia')){
               if(strchr($video_url,'embed')){
                     $coverted_url =$video_url;
               } else{
                $coverted_url="wistia link";
              }
            }           

        ?>
       <div class="col-md-6 space-left-none">
        <div id="video_id_<?php print_r( $row->wgp_video_id); ?>" class="video_main_div">
                 <span style="display:none;" id="edit_video_<?php print_r( $row->wgp_video_id); ?>" class="delete_action button_action button_edit_video" onclick="editVideoTitle(<?php print_r( $row->wgp_video_id); ?>)">
                        <i class="uk-icon-edit"></i>
                  </span> 

                  <p class="video-title" id="v_t_<?php print_r( $row->wgp_video_id); ?>"><?php echo $row->wgp_video_title; ?></p>    
                  <input type="text" style="display:none" id="video_title_<?php print_r( $row->wgp_video_id); ?>" value="<?php echo $row->wgp_video_title; ?>" onblur="changeVideoTitle(<?php print_r( $row->wgp_video_id); ?>)" class="form-control">
          

                <iframe width="100%" height="auto" name="<?php echo $row->wgp_video_title; ?>" src="<?php  echo $coverted_url; ?>" frameborder="0" allowfullscreen></iframe>

                <span style="display:none;" id="delete_video_<?php print_r( $row->wgp_video_id); ?>" class="delete_action button_action button_action_video" onclick="deleteVideo(<?php print_r( $row->wgp_video_id); ?>)">
                    <i class="uk-icon-trash"></i> 
                </span>
          </div>
      </div>
         <?php } } 
        } else{ ?>      

         <div id="videos_preview"></div>
          <p>No video exits. Click add video.</p>

  <?php  }  ?>



  <span id="delete_status"> </span> 



<script>

  // delete the selected video

  function editVideoTitle(video_id){
    $("#v_t_"+video_id).fadeOut();
    $("#video_title_"+video_id).fadeIn();
  }

  function changeVideoTitle(video_id){
      var title = $.trim($("#video_title_"+video_id).val())   ;
      if(title.length>5){
         $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url(); ?>video_controller/updateVideoName',
                  data: {video_id:video_id,title:title},
            })

          .done(function(data){ 
              if(data){
                $("#video_title_"+video_id).fadeOut();
                $('#v_t_'+video_id).empty().append(title).fadeIn();
              }
          });

      }else{
         $("#video_title_"+video_id).css('border-bottom', 'solid 1px red');
      }

  }

    function deleteVideo(video_id)  {
            $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url(); ?>uservideos/deleteVideo',
                  data: {video_id:video_id},
                })

                .done(function(data){   
                        $('#delete_status').css('color', 'green'); 
                        $('#delete_status').show(); 
                        $('#delete_status').html(data);
                           setTimeout(function() {
                                $('#delete_status').slideUp('slow');
                                $('#video_id_'+video_id).slideUp('slow');                     
                            },2000);
                      return false; 

                  })
    } //End Delete Video functioon

</script>

<?php       if($acc_type=='PRO'){
                  $video_limit =10;
             }else if($acc_type=='PLUS'){
                   $video_limit =5;
              }else{
                  $video_limit =1;
              }     

           if( $video_limit > $video_count) {
?>

         <div class="col-md-12 space-none mt10">
          <button class="glyphicon glyphicon-plus icon_pusbig_orange" id="add_video" type="button"></button> 
        </div>



<?php }else{

          echo '<div class="col-md-12" ><h3 class=\"heading_b\">
                 Your video limit exceed. For upload more please
          Upgrade your account type!</h3>';
           
       echo '<a href="'.base_url().'pricing/" target="_blank" class="uk-badge uk-badge-player">Upgrade</a></div>';
    } ?>



</div>



<div id="video_target_add"></div>
</div>
<script>

$(document).ready(function(){

   $(".video_main_div").mouseenter(function(){
      var video_id = $(this).attr('id');
      var arry = video_id.split("_"); 
      var id = arry[2];
      $("#delete_video_"+id).fadeIn();
      $("#edit_video_"+id).fadeIn();
   });

   $(".video_main_div").mouseleave(function(){
      var video_id = $(this).attr('id');
      var arry = video_id.split("_"); 
      var id = arry[2];
      $("#delete_video_"+id).fadeOut();
      $("#edit_video_"+id).fadeOut();
   });

  $("#add_video").click(function(){
         $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>video_controller/addVideoView',
            data: {},
          })

         .done(function(data){
            $('#video_view').fadeOut('slow');
            $("#video_target_add").html(data).fadeIn('slow');
          })

  });

});

</script>
<!-- END OF VIDEO SECTION -->

<!--  Start Vital Section -->

<div class="ac_am_academic">

     <h4>Vitals</h4>

        <!-- Start Technical Section -->

        <div class="sub_section"> 
       <?php if(!empty($tech_details)){ ?>
                    <div class="vital_con" id="technical_view">
            <div id="container_tech" style="min-width: 270px; height: 270px; max-width: 600px; margin: 0 auto"></div>

            </div>

            <div class="sub_title"> 
              <a class="glyphicon glyphicon-pencil ac_am_academic_icon ac_am_academic_icon-content pull-right" id="edit_technical"></a>
            </div>
         
           
        </div>

        <script type="text/javascript">

        $(function () {
    $('#container_tech').highcharts({
        colors: ['#f36e0e', '#f47921', '#f58433', '#f69046', '#f79b59', '#f8a66b', 
             '#f9b17e', '#fabd91', '#fac8a3','#fbd3b6','#fcdec9','#fdeadc','#fef5ee'],
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'Technical <br>'+ <?php echo $per_technical['percent'];?>+'%',
            align: 'center',
            verticalAlign: 'middle',
            y: 60
        },
        tooltip: {
            pointFormat: ' <b>{point.y}/10</b>'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: false,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -180,
                endAngle: 180,
                center: ['50%', '75%']
            }
        },
        series: [{
            type: 'pie',
            name: ' ',
            innerSize: '50%',
            data: [{name: 'Technique',y: <?php echo $tech_details->technique;?>},
                   {name: 'Finishing',y: <?php echo $tech_details->finishing;?>},
                   {name: 'Shooting',y: <?php echo $tech_details->shooting;?>},
                   {name: 'Receiving',y: <?php echo $tech_details->receiving;?>},
                   {name: 'Control',y: <?php echo $tech_details->control;?>},
                   {name: 'Heading', y: <?php echo $tech_details->heading;?>},
                   {name: 'Shielding',y: <?php echo $tech_details->shielding;?>},
                   {name: 'Distribution',y: <?php echo $tech_details->distribution;?>},
                   {name: 'Accuracy',y: <?php echo $tech_details->accuracy;?>},
                   {name: 'Long Passing',y: <?php echo $tech_details->long_passing;?>},
                   {name: 'Turning',y: <?php echo $tech_details->turning;?>},
                   {name: 'Aerial Control',y: <?php echo $tech_details->aerial_control;?>},
                   {name: 'Dribbling',y: <?php echo $tech_details->dribbling;?>},
                   {name: 'Running',y: <?php echo $tech_details->running;?>},
                   {name: 'Defending',y: <?php echo $tech_details->defending;?>}
                ]
        }]
    });
});

     
    </script>
          <?php } ?>

            
         


        <script>

           $("#edit_technical").click(function(){
              $("#technical_view").fadeOut();
                $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>usertechnical/updateView',
                      data: {},
                  })

                .done(function(data){ 
                  $('#technical_div').html(data);
                  $('#technical_div').fadeIn();
                })
           });



           $("#add_technical").click(function(){
              $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>usertechnical',
                      data: {},
                  })

                .done(function(data){  
                  $('#technical_div').html(data);
                })

           });

        </script>

        <!-- End Technical Section -->







        <!-- Start Tactical Section -->

        <div class="sub_section">

                    



            <?php if(!empty($tact_details)){ ?>

            <div class="vital_con" id="tactical_view">
                  <div id="container_tactical" style="min-width: 270px; height: 270px; max-width: 600px; margin: 0 auto"></div>
            </div>
            <div class="sub_title">
              <a class="glyphicon glyphicon-pencil ac_am_academic_icon ac_am_academic_icon-content pull-right" id="edit_tactical"></a>
            </div> 

<script type="text/javascript">
      

 $(function () {
    $('#container_tactical').highcharts({
        colors: ['#27d97e','#38dc88','#49df92','#5ae29c','#6ae5a6','#7be8b0','#8cebba','#9ceec4',
                  '#adf1ce','#bef4d8','#cff7e2','#dff9ec','#f0fcf6'],
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'Tactical <br>'+ <?php echo $per_tachtical['percent'];?>+'%',
            align: 'center',
            verticalAlign: 'middle',
            y: 60
        },
        tooltip: {
            pointFormat: ' <b>{point.y}/10</b>'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: false,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -180,
                endAngle: 180,
                center: ['50%', '75%']
            }
        },
        series: [{
            type: 'pie',
            name: ' ',
            innerSize: '50%',
            data: [{name: 'Game Awarness',y: <?php echo $tact_details->game_awarness;?>},  
                   {name: 'Balance',y: <?php echo $tact_details->balance;?>}, 
                   {name: 'Pressing',y: <?php echo $tact_details->pressing;?>}, 
                   {name: 'Possesion',y: <?php echo $tact_details->possesion;?>}, 
                   {name: 'Adaptability',y: <?php echo $tact_details->adaptability;?>},
                   {name: 'Support',y: <?php echo $tact_details->support;?>},
                   {name: 'Decissions Making',y: <?php echo $tact_details->decissions_making;?>},
                   {name: 'Compactness',y: <?php echo $tact_details->compactness;?>},
                   {name: 'Transition',y: <?php echo $tact_details->transition;?>},
                   {name: 'Anticipation',y: <?php echo $tact_details->anticipation;?>},
                   {name: 'Overlaps', y: <?php echo $tact_details->overlaps;?>},
                   {name: 'Marking',y: <?php echo $tact_details->marking;?>},
                   {name: 'Recovery',y: <?php echo $tact_details->recovery;?>},
                   {name: 'Responsivness',y: <?php echo $tact_details->responsivness;?>},
                   {name: 'Covering',y: <?php echo $tact_details->covering;?>}
                ]
        }]
    });
});

    </script>

             

           

            <?php } ?>



          


        
        

        </div>

    

         <script>

           $("#edit_tactical").click(function(){

              $("#tactical_view").fadeOut();

                $.ajax({

                      type: 'POST',

                      url: '<?php echo base_url(); ?>usertactical/updateView',

                      data: {},

                  })

                .done(function(data){                  

                  $('#tactical_div').html(data);

                })

           });



           $("#add_tactical").click(function(){

              $.ajax({

                      type: 'POST',

                      url: '<?php echo base_url(); ?>usertactical',

                      data: {},

                  })

                .done(function(data){                  

                  $('#tactical_div').html(data);

                })

           });

        </script>

        <!-- End Tactical Section -->



        <!-- Start Physical Section -->

        <div class="sub_section">

        

        <?php if(!empty($physical)){ ?>

            <div class="vital_con" id="physical_view">
                <div id="container_physical" style="min-width: 270px; height: 270px; max-width: 600px; margin: 0 auto"></div>
            </div>

             <div class="sub_title">
              <a class="glyphicon glyphicon-pencil ac_am_academic_icon ac_am_academic_icon-content pull-right" id="edit_physical"></a>
            </div>
<script type="text/javascript">

$(function () {
    $('#container_physical').highcharts({
      colors :['#ff4323','#ff5436','#ff644a','#ff755d','#ff8671','#ff9785','#ffa798','#ffb8ac',
                '#ffc9c0','#ffdad3'],
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'Physical <br>'+ <?php echo $per_physical['percent'];?>+'%',
            align: 'center',
            verticalAlign: 'middle',
            y: 60
        },
        tooltip: {
            pointFormat: ' <b>{point.y}/10</b>'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: false,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -180,
                endAngle: 180,
                center: ['50%', '75%']
            }
        },
        series: [{
            type: 'pie',
            name: ' ',
            innerSize: '50%',
            data: [{name: 'Acceleration',y: <?php echo $physical->acceleration;?>},  
                   {name: 'Coordination',y: <?php echo $physical->coordination;?>}, 
                   {name: 'Jumping',y: <?php echo $physical->jumping;?>}, 
                   {name: 'Strength',y: <?php echo $physical->strength;?>}, 
                   {name: 'Quickness',y: <?php echo $physical->quickness;?>},
                   {name: 'Agility',y: <?php echo $physical->agility;?>},
                   {name: 'Reaction',y: <?php echo $physical->reaction;?>},
                   {name: 'Flexibility',y: <?php echo $physical->flexibility;?>},
                   {name: 'Power',y: <?php echo $physical->power;?>},
                   {name: 'Basic Motor Skills',y: <?php echo $physical->basic_motor_skills;?>},
                   {name: 'Balance', y: <?php echo $physical->balance;?>},
                   {name: 'Speed',y: <?php echo $physical->speed;?>},
                   {name: 'Endurance',y: <?php echo $physical->endurance;?>},
                   {name: 'Mobility',y: <?php echo $physical->mobility;?>},
                   {name: 'Explosivness',y: <?php echo $physical->explosivness;?>}
                ]
        }]
    });
});

      
    </script>


              

            </div>

            <?php } ?>









         <script>

           $("#edit_physical").click(function(){

              $("#physical_view").fadeOut();

              $("#physical_div").fadeIn();

                $.ajax({

                      type: 'POST',

                      url: '<?php echo base_url(); ?>userphysical/updateView',

                      data: {},

                  })

                .done(function(data){                  

                  $('#physical_div').html(data);

                })

           });



           $("#add_physical").click(function(){

              $.ajax({

                      type: 'POST',

                      url: '<?php echo base_url(); ?>userphysical',

                      data: {},

                  })

                .done(function(data){                  

                  $('#physical_div').html(data);

                })

           });

        </script>

        <!-- End Physical Section -->



        <!-- Start Psychosocial Section -->

        <div class="sub_section">

            <?php if(!empty($psy_details)){ ?>

            <div class="vital_con" id="psychosocial_view">

                 <div id="container_psy_details" style="min-width: 270px; height: 270px; max-width: 600px; margin: 0 auto"></div>

                   </div>
                   <div class="sub_title">
                               <a class="glyphicon glyphicon-pencil ac_am_academic_icon ac_am_academic_icon-content pull-right" id="edit_psychosocial"></a>

            </div>
            </div>
 <script type="text/javascript">


 $(function () {
    $('#container_psy_details').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'Psychosocial <br>'+ <?php echo $per_psyhosocial['percent'];?>+'%',
            align: 'center',
            verticalAlign: 'middle',
            y: 60
        },
        tooltip: {
            pointFormat: '<b>{point.y}/10</b>'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: false,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -180,
                endAngle: 180,
                center: ['50%', '75%']
            }
        },
        series: [{
            type: 'pie',
            name: ' ',
            innerSize: '50%',
            data: [{name: 'Attitude',y: <?php echo $psy_details->attitude;?>},  
                   {name: 'Cooperation',y: <?php echo $psy_details->cooperation;?>}, 
                   {name: 'Passion',y: <?php echo $psy_details->passion;?>}, 
                   {name: 'Respect',y: <?php echo $psy_details->respect;?>}, 
                   {name: 'Trustworthiness',y: <?php echo $psy_details->trustworthiness;?>},
                   {name: 'Self Confidence',y: <?php echo $psy_details->self_confidence;?>},
                   {name: 'Communication',y: <?php echo $psy_details->communication;?>},
                   {name: 'Discipline',y: <?php echo $psy_details->discipline;?>},
                   {name: 'Leadership',y: <?php echo $psy_details->leadership;?>},
                   {name: 'Honesty',y: <?php echo $psy_details->honesty;?>},
                   {name: 'Competitivness', y: <?php echo $psy_details->competitivness;?>},
                   {name: 'Focus',y: <?php echo $psy_details->focus;?>},
                   {name: 'Vision',y: <?php echo $psy_details->vision;?>},
                   {name: 'Motivation',y: <?php echo $psy_details->motivation;?>}
                ]
        }]
    });
});
      
    </script>
            

            <?php }  ?>
        



        </div>
          <div id="technical_div">

          </div>
           <div id="tactical_div">

              </div> 

         <div id="physical_div">

          </div> 

           <div id="psychosocial_div">

          </div>




        <script>

           $("#edit_psychosocial").click(function(){

              $("#psychosocial_view").fadeOut();

                $.ajax({

                      type: 'POST',

                      url: '<?php echo base_url(); ?>userpsyhosocial/updateView',

                      data: {},

                  })

                .done(function(data){                                   

                  $('#psychosocial_div').html(data);

                  $("#psychosocial_div").fadeIn();

                })

           });



           $("#add_psychosocial").click(function(){

              $.ajax({

                      type: 'POST',

                      url: '<?php echo base_url(); ?>userpsyhosocial',

                      data: {},

                  })

                .done(function(data){                  

                  $('#psychosocial_div').html(data);

                })

           });


  $(document).ready(function(){
      $(".highcharts-container").css('oveflow','visible');
  });

        </script>

    

        <!-- End Psychosocial Section -->



 <!-- End Vital div -->




<!--  Start Languages Section -->

<div class="ac_am_academic">

		    <h4>Languages   </h4>



<span id="languages">

    <div class="col-md-12">

       <ul class="md-list md-list-language">      

      <?php if(!empty($user_language)){

           foreach ($user_language as $row) {  ?>

            <li id="lan_row_<?php echo $row->id;?>">

               <div class="md-list-content">                    

                    <span class="md-list-heading md-list-heading-tod">

                         <div id="value_<?php echo $row->id; ?>"><?php echo $row->language; ?> </div>

                        <input type="text" value="<?php echo $row->language; ?>" id="language_<?php echo $row->id;?>" onblur="saveLanguage(<?php echo $row->id;?>)" class="form-control" style="display:none;">

                    </span>

                     

                    <span class="uk-text-small content-data content-data-tod">

                      <b id="language_fill_star_<?php echo $row->id;?>"><?php for($i=1;$i<=$row->level; $i++) {?>

                          <img src="<?php echo base_url(); ?>images/icon-star-fill.png">

                        <?php } ?>

                      </b>

                      <b id="language_blank_star_<?php echo $row->id;?>" style="display:none;"><?php for($i=1;$i<=5; $i++) {?>

                          <a onclick="updateStar(<?php echo $i.','.$row->id;?>)" id="edit_star_<?php echo $i.'_'.$row->id;?>"><img src="images/icon-star.png"></a>

                        <?php } ?>

                      </b>



                      <i><?php echo $row->level_name; ?> 

                          <span class="adept-delete" title="delete" onclick="deleteLanguage(<?php echo $row->id;?>)">

                             <i class="material-icons md-24">&#xE872;</i>

                         </span>


                        <span class="adept-edit" title="edit" onclick="editLanguage(<?php echo $row->id;?>)">

                           <i class="material-icons md-24">&#xE254;</i>

                       </span>

                      
                      </i>



                      

                    </span>

                   

                </div>

            </li>            

          <?php  }  } ?>
   
          </ul>


    </div>


   </span> 

   <div class="col-md-12 space-none mt10">
      <button type="button" onclick="addOneLangauge()" class="glyphicon glyphicon-plus icon_pusbig_orange lang_btn_div"></button>


   </div>
                       
    

   

    </div>



    


<script src="https://use.fontawesome.com/d81c5e82f9.js"></script>

<script>

   function addOneLangauge(){

    var count =$(".lan_new").length;

      var html ='<li id="lan_new" class="lan_new">'+
               '<div class="md-list-content">'+
                 '<span class="md-list-heading md-list-heading-tod">'+                         
                    '<input type="text"  class="form-control" id="language_new" placeholder="Enter language">'+
                  '</span>'+
                  '<span class="uk-text-small content-data content-data-tod">'+
                  '<input type="hidden" id="lang_star_count" value="0">'+
                    '<b id="language_add_rating">'+
                          '<a onclick="addStar(1)"><img src="<?php echo base_url(); ?>images/icon-star.png"></a>'+
                          '<a onclick="addStar(2)"><img src="<?php echo base_url(); ?>images/icon-star.png"></a>'+
                          '<a onclick="addStar(3)"><img src="<?php echo base_url(); ?>images/icon-star.png"></a>'+
                          '<a onclick="addStar(4)"><img src="<?php echo base_url(); ?>images/icon-star.png"></a>'+
                          '<a onclick="addStar(5)"><img src="<?php echo base_url(); ?>images/icon-star.png"></a>'+
                      '</b><i><span title="Save Language" onclick="addLanguage()">'+
                        '<i class="save_lang fa fa-floppy-o" aria-hidden="true"></i>'+
                        '</span><span title="Cancel"><i onclick="removeNewLang()" class="cancel_lang fa fa-times" aria-hidden="true"></i></span></i>'+
                    '</span>'+
                '</div>'+
            '</li>';
    if(count==0){
      $("#languages ul").append(html);
    }
   }


function addStar (id) {
  $("#lang_star_count").val(id);
  var html ='';

  for (var i = 1; i <= id; i++) {
     html +='<a onclick="addStar('+i+')"><img src="images/icon-star-fill.png"></a>';
  }
  if(id<=5){
     for (var i = id+1; i <=5 ; i++) {
           html +='<a onclick="addStar('+i+')"><img src="images/icon-star.png"></a>';
       }
    
  }
  $("#language_add_rating").empty().append(html);
 
}

function removeNewLang(){
  $("li#lan_new").fadeOut().remove();
}

    function addLanguage(){                

            var language =$("#language_new").val();

            var id =$("#lang_star_count").val();



            if(language==""){              

              $('#language_new').focus();

              $('#error_language').css('color', 'red');

              $('#error_language').show();

              $("#error_language").text('Please fill Language ');

                 setTimeout(function() {

                    $('#error_language').slideUp('slow');

                },2000);        

                return false;

            }

            

            else if(language!=""){

                
               $.ajax({

                      type: 'POST',

                      url: '<?php echo base_url(); ?>user_language/addLanguage',

                      data: {language:language,level:id},

                    })

                  .done(function(data){

                          $("#languages").html(data);

                     })

              }

              

            

       

          

    }



function deleteLanguage(id){

  $.ajax({

              type: 'POST',

              url: '<?php echo base_url(); ?>user_language/deleteLanguage',

              data: {id:id},

            })

          .done(function(data){            

             $("#lan_row_"+id).fadeOut();

        })

 }



function editLanguage(id){

  $("#language_"+id).css({ display: "block" });

  $("#value_"+id).hide();  

  $('#language_fill_star_'+id).hide(); 

  $('#language_blank_star_'+id).css({ display: "block" });

 }



 function saveLanguage(id){



    var language=$("#language_"+id).val();

    $.ajax({

          type: 'POST',

              url: '<?php echo base_url(); ?>user_language/saveLanguage',

              data: {id:id,language:language},

            })

          .done(function(data){            

            $("#language_"+id).css({ display: "none" });

            $("#value_"+id).text(language);

            $("#value_"+id).show();            

            $('#language_fill_star_'+id).show();

            $('#language_blank_star_'+id).css({ display: "none" });

    })

 }

function updateStar(level,id){  

  $.ajax({

          type: 'POST',

              url: '<?php echo base_url(); ?>user_language/updateStar',

              data: {level:level,id:id},

            })

          .done(function(data){ 

             $("#languages").html(data);

          })

}



</script>

<!-- End Languages Section -->





<!-- Start Injuries Section -->

<div class="ac_am_academic">

 	<h4>Injuries</h4> 



   <div id="injer-view">

      <div class="md-card-content">  

      <?php if(!empty($injur)) { ?>         
        <div class="table-responsive">
              <table class="uk-table uk-text-nowrap adept-table table">

                  <thead>
                  <tr>
                      <th>Type of injury</th>
                      <th>Body Part</th>
                      <th>Body Area</th>
                      <th>Recovered</th>
                      <th>Surgery</th>
                      <th>If yes, when</th>
                      <th>Action</th>                                                

                  </tr>

                  </thead>                     

                  <tbody> 

                  <?php foreach($injur as $value) { ?>                                              

                  <tr id="injur_row_<?php echo $value->wgp_table_id; ?>">

                      <td><?php echo $value->type_of_injury;?></td>

                      <td><?php echo $value->body_part;?></td>

                      <td><?php echo $value->body_area;?></td>

                      <td>
                        <?php foreach ($recovered as $key => $rec){
                          			 if($key==$value->recovered){
                          			     echo $rec.'%';
                                  }
                          		}
                        ?>
                      </td>
                      <td><?php echo $value->surgery;?></td>
                      <td><?php echo $value->when;?></td> 

                      <td>
                            <a class="adept-edit" href="#" id="edit_injur_<?php echo $value->wgp_table_id; ?>" onclick="editInjurRow(<?php echo $value->wgp_table_id; ?>);">
                                    <i class="material-icons">&#xE150;</i>

                                </a>



                                <a class="adept-delete" href="#" id="delete_injur_<?php echo $value->wgp_table_id; ?>" onclick="return deleteInjurRow(<?php echo $value->wgp_table_id; ?>);">

                                    <i class="material-icons">&#xE872;</i>

                                </a>

                     </td>                           

                  </tr>

                  <?php   } ?>                      

                  </tbody>

              </table>                   
              </div>
            <?php } ?>                   

                  <div class="uk-form-row">

                  <button type="button" onclick="addInjur()" class="glyphicon glyphicon-plus icon_pusbig_orange"></button>

                  </div>

       </div>

   </div>

   <div id="edit_injur_view">

   </div>

</div> 

<!-- START REFERENCES SECTION -->

<div class="ac_am_academic">

     <h4>References</h4> 

     <div id="reference_view">
      
    <div class="table-responsive">
           <table class="uk-table uk-text-nowrap adept-table table">
                <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Occupation</th>
                    <th>Organization</th>
                    <th>Level</th>  
                    <th>Contact</th> 
                    <th>Location</th>
                    <th>Comments</th>
                    <th>Action</th>
                    </tr>
                </thead>               

                <tbody>

        <?php if(!empty($reference)) 

                      { 

                   foreach($reference as $key=>$value) { ?>



                <tr id="row_<?php echo $value->wgp_table_id; ?>">

                    <td><?php echo $value->full_name;?></td>

                    <td><?php echo $value->full_time_occupation;?></td>

                    <td><?php print_r($value->organization);?></td>

                    <td><?php print_r($value->level);?></td>                   

                    <td><?php echo $value->phone."<br>".$value->email; ?></td>               

                    <td><?php echo wordwrap($value->location,20,"<br>\n");?></td>

                    <td><?php echo wordwrap($value->comment,20,"<br>\n"); ?></td>

                    

                    <td>

                        <a class="adept-edit" href="#" id="edit_<?php echo $value->wgp_table_id; ?>" onclick="editRow(<?php echo $value->wgp_table_id; ?>);">

                             <i class="material-icons">&#xE150;</i>

                         </a>

                        <a class="adept-delete" href="#" id="delete_<?php echo $value->wgp_table_id; ?>" onclick="return deleteRow(<?php echo $value->wgp_table_id; ?>);">

                            <i class="material-icons">&#xE872;</i>

                        </a>

                   </td>                               

                </tr> 

                                       

                <?php }  //end foreach

                   }//end if 

              ?>



                <?php if(isset($asked_ref) && (!empty($asked_ref))){



                      foreach ($asked_ref as $key => $row) {   

                                          

                          echo "<tr id=\"aske_row_$row->id\"><td>".ucwords($row->name)."</td>";

                          echo "<td>".$row->occupation."</td>";

                          echo "<td>".ucwords($row->organization)."</td>";

                          echo "<td>".$row->level."</td>";

                          echo "<td>".$row->phone."</td>";

                          echo "<td></td>";

                          echo "<td>".wordwrap($row->comment,20,"<br>\n")."</td>";                           

                          echo "<td class=\"verified_icon\">

                          <i title=\"Verified\" class=\"material-icons\">&#xE8E8;</i>

                          <a class=\"adept-delete\" id=\"ask_row_$row->id\"  onclick=\"deleteAskRefer($row->id)\"> <i class=\"material-icons\">&#xE872;</i></a>"; ?>

                        <?php  if($row->status==3) {

                           echo "<a onclick=\"hideAskRefer($row->id)\" title=\"Hide Comment On Public Profile \"><i id=\"hide_ref_icon_$row->id\" class=\"material-icons\">&#xE8F4;</i></a>";

                         }if($row->status==2){

                          echo  "<a onclick=\"showAskRefer($row->id)\" title=\"Show Comment On Public Profile \"><i id=\"show_ref_icon_$row->id\" class=\"material-icons\">&#xE8F5;</i></a>"; 

                        }else if($row->status==1){

                             echo "<a onclick=\"hideAskRefer($row->id)\" title=\"Hide Comment On Public Profile \"><i class=\"material-icons\">&#xE8F4;</i></a>";

                        } ?>

                      <?php   echo  "</td></tr>";

                          

                      }//end foreach

                  }//end if  ?>

               

                </tbody>

            </table>

       </div>
 </div>


       <div id="reference_target"></div>
        

        <div class="uk-form-row">
             <button class="glyphicon glyphicon-plus icon_pusbig_orange" id="show_ref_btns" type="button"></button>
        </div>

  <script>
    $("#show_ref_btns").click(function(){
      $("#ref_btns").slideToggle( "slow" );
    });
  </script>


    <div class="uk-width-medium-1 refer_div" id="ref_btns" style="display:none">                          

        <button class="btn btn-primary" data-uk-modal="{target:'#modal_header_footer'}">Ask Coaches for references</button>

         <button type="button"  id="add" value="add" onclick="addRefer();" class="btn btn-primary">Add References yourself</button>

         <p id="reference_invitation_status"></p>

        <div class="uk-modal" id="modal_header_footer">

            <div class="uk-modal-dialog">

                <div class="uk-modal-header">

                    <h3 class="uk-modal-title">Ask coaches for Reference!</h3>

                </div>

                <p>Enter the name and E-mail address of coach you want to ask for Reference. </p>

                <div class="row">

                      <div class="col-md-12">                                           

                        <div class="col-md-5">

                      <div class="uk-form-row">

                          <label for="name">Name</label>

                          <input type="text" id="name" name="name" required class="md-input" />

                      </div>

                    </div>

                    <div class="col-md-7">

                       <div class="uk-form-row">        

                         <label for="email">E-mail address</label>

                        <input type="email" id="email"  name="email" required class="md-input" />

                      </div>

                    </div>

                    

                

                      </div>

                  </div>

                <div class="uk-modal-footer uk-text-right">

                    <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>

                    <button type="button" onclick="sendReferenceForm();" id="send_refer" class="btn btn-primary">Send</button>

                </div>

            </div>

        </div>
    </div>                    

   </div>

<script>
function addInjur() {
      $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>userinjur/addInjur',
            data: {},
        })
        .done(function(data){ 
          $('#edit_injur_view').html(data).fadeIn();
        })
}// End addTestSCore Function


function  editInjurRow(id){    
     var row_id= id;
    $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>userinjur/updateInjurView',
              data: {edit:row_id},
            })

          .done(function(data){             
             $("#injer-view").fadeOut('slow');
             $('#edit_injur_view').html(data).fadeIn('slow');
          });
    }



function deleteInjurRow(id){

    var row_id= id;

    var choice = confirm('Do you really want to delete this record?');

    if(choice === true) { 

     $.ajax({

            type: 'POST',

            url: '<?php echo base_url(); ?>userinjur/deleteInjur',

            data: {row_id:row_id},

            })

            .done(function(data){

               if(data==1){

                var row_id='#injur_row_'+id;

                $(row_id).fadeOut();

               }else{

                alert('OOPs! some error occur');

               }

              

            });

          }

}

</script>



 </div>

  <!-- End Injuries Section -->



  </div>

 </div> 

 <!-- End left side --> 





<div class="col-md-3 strength_space">

<?php if($acc_type!='PRO'){ ?>
	<div class="ac_am_upgrade_your_profile">
		<a href="<?php echo base_url(); ?>pricing" target="_blank" class="ac_am_upgrade_your_profile">
		    Upgrade Profile
		</a>
	</div> 

<?php } ?>


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
                    }else if($count > 80 && $count < 100){
                          echo "Super Star";
                    }else if($count==100){
                           echo "Champion";
                        }

                ?></p>
              <span></span>
            </div>
          </div>

		    </div> 


<!--  Start Profile View Stats -->
  <div class="ac_home_tips ac_pro-sts">
       <h4>Profile Stats :</h4>          
   
          <ul> 
            <li>
                <div class="ac_msg">Profile Views</div>
                <span class="ac_wall_date"><?php  echo $profile_view_count; ?></span>
            </li>

            <li>
                <div class="ac_msg">Friends</div>
                <span class="ac_wall_date"> <?php  echo $friend_count; ?></span>
            </li>
          </ul>         
              
          
 </div>

 <!--  Start Profile View Stats -->


<!--   <div id="side_expert_advice" class="ac_am_upgrade_your_see">Expert Advice</div>   -->   

<ul class="sidebar_menugray" id="side_menu_ul">
  <li><a href="<?php echo base_url().'profile/'.$user_detail->login_name; ?>">View Your Public Profile</a></li>
  <li><a href="<?php echo base_url(); ?>search_controller/searchView">Search</a></li>
  <li><a href="#" onclick="invidePlayer()">Invite Players</a></li>
  <li><a href="#" onclick="shareProfile()">Share Profile</a></li>
</ul>



<script>
$('#side_menu_ul > li').click(function () {
     $(this).addClass('active').siblings('li').removeClass('active');     
  });


function invidePlayer(){
  $.ajax({
          type: 'POST',
          url: '<?php echo base_url(); ?>home/inviteFriends',
          data: {},
      })

    .done(function(data){
          $("#demo_model").trigger('click');
           //$('#event_edit_view').empty().html(data);
          $("#model_content").empty().html(data);
    })
}

function shareProfile(){
    $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>home/shareProfileView',
              data: {},
          })
          .done(function(data){
             $("#demo_model").trigger('click');
               //$('#event_edit_view').empty().html(data);
              $("#model_content").empty().html(data);
        })
}


		$("#side_search").click(function () {             

                $.ajax({

                      type: 'POST',

                      url: '<?php echo base_url(); ?>search_controller/searchView',

                      data: {},

                  })

                .done(function(data){
                      $("#demo_model").trigger('click');
                       //$('#event_edit_view').empty().html(data);
                      $("#model_content").empty().html(data);                 

                })

            });

          


            $("#side_expert_advice").click(function () { 
                  $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>home/expertAdviceView',
                      data: {},
                  })

                .done(function(data){
                      $("#demo_model").trigger('click');
                       //$('#event_edit_view').empty().html(data);
                      $("#model_content").empty().html(data);
                })

           });



</script>

                
<div class="ac_am_latest_event">
     <h4>Upcoming Events 
        	<!-- <span class="md_bttn_wth glyphicon glyphicon-plus icon_pusbig_orange" data-uk-modal="{target:'#add_event'}"></span> -->
      </h4>


          <div class="uk-modal" id="add_event">

            <div class="uk-modal-dialog">

                <div class="uk-modal-header">

                    <h3 class="uk-modal-title">Add Event !</h3>

                </div>

          <?php if(($acc_type=='PRO')||($acc_type=='PLUS')){ ?>

          <div class="row">   

              <div class="col-md-12 col-sm-12 col-sx-12">            

                     <label class="evn_col" for="event_name">Event Name</label>

                      <input type="text" id="event_name" name="event_name" required class="form-control" />

                </div>

            <div class="col-md-6"> 

                  <label class="evn_col" for="level">Level<span class="event_sps req">*</span></label>

                      <select name="level" id="level" required data-md-selectize>

                              <option value="" selected="">Select Level</option>

                                <?php foreach ($level as  $row) {  ?>                                                                                                                            

                                    <option value="<?php echo $row->levelId; ?>">

                                      <?php echo $row->levelName; ?></option>

                                <?php }   ?>                                      

                          </select>

            </div>



            <div class="col-md-6"> 

                <label class="evn_col" for="event_importance">Event Importance<span class="event_sps req">*</span></label>

                      <select name="event_importance" id="event_importance" required data-md-selectize>

                              <option value="" selected="">Select Event Importance</option>

                                <?php foreach ($event_importance as  $row) {  ?>                                                                                                                            

                                  <option value="<?php echo $row->id; ?>">

                                      <?php echo $row->name; ?></option>

                                <?php }   ?>                                      

                    </select>

            </div>

             

             <div class="col-md-6">

                  <label for="range_start" class="">Event Start:</label>

                  <input class="evn_edt" id="range_start" />

            </div>



            <div class="col-md-6">

              <label for="range_end" class="">Event End:</label>

                <input class="evn_edt" id="range_end" />

            </div>

           <div class="col-md-12">

                  <label class="evn_col" for="event_website">Event Website<span class="event_sps req">*</span></label>

                    <input type="text"  id="event_website"  name="event_website" required class="form-control" />

             </div>

             
            <div class="col-md-12 col-sm-12 col-sx-12">

                  <label class="evn_col" for="event_type">Event Type<span class="event_sps req">*</span></label>

                      <select name="event_type" id="event_type" required data-md-selectize>

                              <option value="" selected="">Select Event type</option>

                                <?php foreach ($event_type as  $event_row) {  ?>                                                                                                                            

                                    <option value="<?php echo $event_row->id; ?>">

                                     

                                         <?php echo $event_row->type; ?></option>

                                <?php }   ?>                                      

                          </select>

            </div>

                 <div class="col-md-12">

                  <label class="evn_col" for="location">Location<span class="event_sps req">*</span></label>

                    <input type="text"  id="autocomplete2"  name="location" onFocus="geolocate()" required class="form-control" />

                   

                </div>

                <input type="hidden" id="street_number" disabled="true" placeholder="Street Address">

                 <input type="hidden" id="route" disabled="true" >

                 <input type="hidden" id="postal_code" disabled="true" name="zip_code"/>

                <input type="hidden" name="city" id="locality" disabled="true"  required class="md-input" />

                <input type="hidden" name="state" id="administrative_area_level_1" disabled="true" />

                <input type="hidden" id="country" name="country" disabled="true" placeholder="Country" >

    

                <br>



              </div>

              <!-- end right side -->
              <?php } else{
                  echo "Upgrade Account type to use this feature.";
              } ?>
         

              <div class="uk-modal-footer uk-text-right">

                    <button type="button"  id="close_add_event" class="md-btn md-btn-flat uk-modal-close">Close</button>
                    <?php if(($acc_type=='PRO')||($acc_type=='PLUS')){ ?>
                    <button type="button" id="save_event" class="btn btn-primary">Send</button>

                    <?php } ?>
                </div>

            </div>

        </div>

                

<!-- Demo Content Trigger the modal with a button -->
<button type="button" id="demo_model"  data-toggle="modal" data-target="#myModal" style="display:none;"></button>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="demo_model_close" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <span id="model_content"></span>
      </div>
    </div>

  </div>
</div>


<script>

 $(document).ready(function () {

     $("#save_event").click(function (){  
       var name =$("#event_name").val();
       var level =$("#level").val();
       var start_date =$("#range_start").val();
       var website =$("#event_website").val();
       var event_type =$("#event_type").val();
       var event_imp =$("#event_importance").val();
       var end_date =$("#range_end").val();
       var address =$("#autocomplete2").val();

         $.ajax({

                type:'POST',
                url:'<?php base_url() ?>usercalendar/addNewEvent',
                data:{name:name,level:level,start_date:start_date,
                    website:website,event_type:event_type,
                    event_imp:event_imp,end_date:end_date,
                    address:address
                  },

            })

          .done(function(data){             
              var url = "<?php echo base_url(); ?>home";
              window.location= url;           

          })



    });

    

    //delete event 

    $("#delete_event").click(function (){      

       var wgp_event_id =$("#wgp_event_id").val();



       $.ajax({

                type:'POST',

                url:'<?php base_url() ?>usercalendar/deleteEvent',

                data:{wgp_event_id:wgp_event_id},

            })

          .done(function(data){

            $('#calendar').html(data);

            

          })



     });



 });



</script>



<script>

$("#range_start").kendoDateTimePicker({
    format: "M/d/yyyy hh:mm tt"

});

$("#range_end").kendoDateTimePicker({

    format: "M/d/yyyy hh:mm tt"

});

</script>










     <ul class="events events_left">

         <?php if(empty($events)){?>          

              <li> No Upcoming event</li>
        <?php } 

              else if(count($events)>0) 

               {  

              		foreach ($events as $key => $row) 

              		{              		

         ?>

	             <li id="<?php echo $row->wgp_event_id;?>" onclick="getEventDetail(<?php echo $row->wgp_event_id;?>)">
                   <div class="title_titleimage">
                      <img clas="event_image" src="<?php echo base_url(); ?>images/img.jpg"> 
                   </div>
	              	  <div class="title_titlesystm">
                      <p><?php echo ucwords($row->wgp_event_name); ?></p>
                      <span><?php $date = strtotime($row->wgp_event_start); 
                             echo date('d M, Y',$date);
                       ?> </span>
                       <!-- <a class="event_edit glyphicon glyphicon-pencil ac_am_academic_icon ac_am_academic_icon-content event_editblock" id="edit_event_<?php //echo $row->wgp_event_id;?>" onclick="editEvent(<?php //echo $row->wgp_event_id;?>)"></span></a> -->
                    </div>
                   
	             </li>

        <?php  } }  ?>

     </ul>

      <i><a class="md-btn md-btn-primary pull-right" href="<?php echo base_url(); ?>event">View All</a></i>

     </div>

 <script type="text/javascript">

     $(document).ready(function(){

     	/*$(".event_edit").hide();
     	   $("ul.events li").mouseenter(function(){
     		         var event_id = $(this).attr('id');
     	           $("#edit_event_"+event_id).show();

        	}); 
          $("ul.events li").mouseleave(function()    { 
             var event_id = $(this).attr('id'); 
             $("#edit_event_"+event_id).css({ display: "none" }); 
         });   	*/

     	

     });

  function getEventDetail(id){
        $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>usercalendar/getEvent',
                data: {event_id:id},
            })

            .done(function(data){
              $("#demo_model").trigger('click');
                       //$('#event_edit_view').empty().html(data);
               $("#model_content").empty().html(data);   
            });

  }



     function editEvent(id){
       	$.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>usercalendar/editEventView',
                data: {event_id:id},
            })

            .done(function(data){
            	$("#demo_model").trigger('click');
                       //$('#event_edit_view').empty().html(data);
               $("#model_content").empty().html(data);   
            });

     }

</script>





	</div>









</div>



<script>

function addRefer() {

      $.ajax({

                type: 'POST',

                url: '<?php echo base_url()?>userreferences/addRefer',

                data: {},

            })

          .done(function(data){ 
            $("#reference_target").html(data).fadeIn('slow');
            $('#reference_view').fadeOut('slow');

          })

    }// End addRefer Function



 function  editRow(id){
    $("#refer-id").hide();
      var row_id= id;
    $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>userreferences/updateReferView',
              data: {edit:row_id},
            })

          .done(function(data){
            $("#reference_target").html(data).fadeIn('slow');
            $('#reference_view').fadeOut('slow');
          });

    }



function deleteRow(id){

    var choice = confirm('Do you really want to delete this record?');

    if(choice === true) { 

     $.ajax({

            type: 'POST',

            url: '<?php echo base_url(); ?>userreferences/deleteRefer',

            data: {row_id:id},

            })

            .done(function(data){

               if(data==1){

                var row_id='#row_'+id;

                $(row_id).fadeOut();

               }else{

                alert('OOPs! some error occur');

               }

              

            });

      }

 }



function sendReferenceForm(){

   $("#send_refer").addClass("uk-modal-close");

  var name = $("#name").val();

  var email = $("#email").val();

    $.ajax({

            type: 'POST',

            url: '<?php echo base_url(); ?>userreferences/sendReferenceForm',

            data: {name:name,email:email},

          })

      .done(function(data){

         $('#reference_invitation_status').html(data);   

         $("#reference_invitation_status").delay(3000).fadeOut("slow");

      });

 }



 function deleteAskRefer(id){

    var choice = confirm('Do you really want to delete this Verified record ?');

    if(choice === true) { 
       $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>userreferences/deleteAskedRefer',
            data: {row_id:id},
            })

        .done(function(data){
               if(data==1){ 
                    $('#aske_row_'+id).fadeOut();
               }else{
                alert('OOPs! some error occur');
               }
          });



    }

 }



 function showAskRefer(id){
    $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>userreferences/showAskRefer',
            data: {row_id:id},
            })
        .done(function(data){
          var href="<?php echo base_url();?>home";
          window.location=href;
        });
 }

 function hideAskRefer(id){
    $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>userreferences/hideAskRefer',
            data: {row_id:id},
            })

        .done(function(data){
            var href="<?php echo base_url();?>home";
            window.location=href;
        });

 }

</script>

<!-- END REFERENCES SECTION -->


</div>












<!-- Start footer -->

<div class="footer">

    <div class="footer-logo" id="foot-inner">

       <!--  <img src="<?php //echo base_url(); ?>images/wgp-logo.png" style="width:100%">

    </div> -->

    <div class="footer-box">

        <ul> 

            <li class="copyright"><a href="<?php echo base_url(); ?>/home"> © 2016 WeGotPlayers, LLC.</a></li> </ul>      

            </div>

            <div class="footer-box1">

        <ul> 

            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/about/">About</a></li>            

            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/blog/">Blog</a></li>

            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/terms/">Terms</a></li>

            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/privacy-policy/">Privacy</a></li> 

            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/sitemap/">Sitemap</a></li>

            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/help/">Help</a></li>

            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/contact/">Contact</a></li>           

        </ul></div>

    </div>

</div>



<!-- End footer -->



</div>





<script src="<?php echo base_url(); ?>bower_components/moment/min/moment.min.js"></script> 

<script src="<?php echo base_url(); ?>assets/js/common.min.js"></script>  

<script src="<?php echo base_url(); ?>assets/js/uikit_custom.min.js"></script>   

<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/kendoui.custom.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/pages/kendoui.min.js"></script>

<script>

 
 var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};

if(isMobile.any()) {
    // alert('Do something touchy');
}else{
  //alert('Do something clicky');
 }
 </script>

<!-- Datepicker -->

    <script>

        $("#grade_date").kendoDatePicker({
             format: "MMMM ,yyyy"
        });

        $("#graduation_date").kendoDatePicker({
             format: "MMMM d,yyyy"
        });



        $("#enrolment_date").kendoDatePicker({
          format: "MMMM d,yyyy"
        });

        $("#event_date").kendoDatePicker({
           format: "d-MMMM-yyyy"
        });



        $("#dob").kendoDatePicker({
           format: "d-MM-yyyy"
        });



        $("#range_start").kendoDateTimePicker({

              format: "M/d/yyyy hh:mm tt"

          });

          $("#range_end").kendoDateTimePicker({

              format: "M/d/yyyy hh:mm tt"

          });

    </script>

  <!-- Datepicker -->



  

<script src="<?php echo base_url(); ?>bower_components/magnific-popup/dist/jquery.magnific-popup.min.js"></script>

 <!--  user profile functions -->

<script src="<?php echo base_url(); ?>assets/js/pages/page_user_profile.min.js"></script>

<script>

  $(function() {

    altair_helpers.retina_images();

  });

</script>
<script src="<?php echo base_url(); ?>js/highcharts.js"></script>
<script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */
            (document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);

        autocomplete2 = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */
            (document.getElementById('autocomplete2')), {
              types: ['geocode']
            });
            autocomplete2.addListener('place_changed', function() {
              fillInAddress(autocomplete2, "2");
            });
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9R7iIzjhlAhsRIAcTM0f-Kxf-nUvvfc8&libraries=places&callback=initAutocomplete"
        async defer></script>
<script src="<?php echo base_url(); ?>js/owl.carousel.js"></script>
<script>
      $(document).ready(function() {
        var owl = $("#owl-demo");
        owl.owlCarousel({
          
          itemsCustom : [
            [0, 2],
            [450, 2],
            [600, 3],
            [700, 3],
            [1000, 4],
            [1200, 4],
            [1400, 4],
            [1600, 4]
          ],
          navigation : true

        });
      });
    </script>
</body>

</html>		