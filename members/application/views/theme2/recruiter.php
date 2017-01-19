<style type="text/css">
.ac_am_user_update_sport_right {
    float: right;
    margin: 10px;
    width: 75%;
}
</style>


<div class="ac_am_user_update">
   <h4><?php echo ucwords($name); ?> 
    <?php  $location_short_name = isset($location_short->countryCode)?$location_short->countryCode:0; ?>
    <i class="glyphicon bfh-flag-<?php echo $location_short_name;?>"></i>
  </h4>


  <div class="col-md-9">
    
    <div class="ac_am_user_update_sport"> 

      <!--  profile Image  -->
       <form id="profile_pic_form">
           <div class="ac_am_user_update_sport_left" id="dp_preview">
              <img src="<?php echo $dp_url; ?>" id="dp_url">
              <input type="file" name="profile_pic" class="ac_am_user_update_sport_left_contact" id="change_profile" style="display:none;">
          </div>
        </form>

     
   


        <?php if(!empty($coach_details)){ ?>        

           <div class="ac_am_user_update_sport_right" >


                <div id="basic_deatil">           
                    <a class="glyphicon glyphicon-pencil ac_am_academic_icon pull-right" id="edit_basic"></a> 
                    <ul>
                     <li><a href="#"><b>Sport</b><i>:</i><span><?php echo $coach_details->sport; ?></span></a></li>
                     <li><a href="#"><b>Level </b><i>:</i><span><?php echo $coach_details->level_name; ?></span></a></li>
                     <li><a href="#"><b>Occupation</b><i>:</i><span><?php echo $coach_details->occupation_name; ?></span></a></li>
                     <li><a href="#"><b>Team</b><i>:</i><span><?php echo $coach_details->team; ?></span></a></li>
                     <li><a href="#"><b>Gender </b><i>:</i>
                                <span><?php 

                                        if($coach_details->coaching_gender==1){
                                          echo "Men";
                                        }else if($coach_details->coaching_gender==2){
                                          echo "Women";
                                        }else if($coach_details->coaching_gender==3){
                                          echo "Both";
                                        }else if($coach_details->coaching_gender==0){
                                          echo "No one";
                                        }
                                        ?></span>
                                  </a></li>
                     <li><a href="#"><b>Website</b><i>:</i><span><?php echo $coach_details->website; ?></span></a></li>
                   
                     <li><a href="#"><b>Location </b><i>:</i><span><?php echo $coach_details->location; ?></span></a></li>
                     <li><a href="#"><b>Address </b><i>:</i><span><?php echo $coach_details->address.' '.$coach_details->city.' '.$coach_details->state;?></span></a></li>  
                </ul>
             </div>

            <!--  End Show Basic Detail  -->

           <!--  Start Edit Basic Detail -->

            <div  id="edit_basic_detail" class="ac_am_academic basic-informatio" style="display:block">
               <div class="row">
                <form action="<?php echo base_url()?>recruiter/updateProfileData" method="POST">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"> 
                    <div class="col-md-6">
                      <label>Sport :</label>
                    </div>
                    <div class="col-md-6">
                       <select id="sport" name="sport" required class="form-control">
                                <?php foreach ($sport as $value) { ?>
                                     <option value="<?php echo $value->sportId; ?>"
                                          <?php 
                                               if($value->sportId==$coach_details->sports){
                                                        echo "selected='selected'";
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
                                        <?php 
                                             if($value->levelId==$coach_details->level){
                                                      echo "selected='selected'";
                                                    } ?>
                                                ><?php echo $value->levelName; ?></option>
                                         <?php  }?>                 
                            </select> 
                  </div>

                  
                     <div class="col-md-6">
                         <label>Seeking :</label>
                      </div>
                          <div class="col-md-6">
                               <select name="seeking" id="seeking" required class="form-control">
                                    <option selected="">Select Seeking</option>
                                        <?php foreach ($seeking as  $value) {  ?>                                                                                                                            
                                           <option value="<?php echo $value->id; ?>">
                                          
                                            <?php echo $value->seekingName; ?>
                                           </option>
                                           <?php } ?>
                                         </select>
                        </div>
                          
                    <div class="col-md-6">
                      <label for="occupation" class="">Recruiter’s Occupation*</label>
                    </div>
                  <div class="col-md-6">
                      <select name="occupation" id="occupation" class="form-control">
                          <option selected="" value="">Select Occupation</option>
                          <?php foreach ($occupation as  $value) {  ?>                                                                                                                            
                             <option value="<?php echo $value->occupationId; ?>"
                                <?php if($value->occupationId==$coach_details->occupation){
                                    echo "selected";
                                  }?>
                              ><?php echo $value->occupationName; ?></option>
                        <?php } ?>
                      </select>                                    
                  </div>   

                   <div class="col-md-6">
                        <label for="team">Your Org / Team Name<span class="req">*</span></label>
                      </div>
                     <div class="col-md-6">
                        <input type="text" value="<?php echo $coach_details->team; ?>" id="team" name="team" required class="form-control" />
                    </div>

                  <div class="col-md-6">
                        <label for="coach_gender">What Gender You Coach<span class="req">*</span></label>
                    </div>
                  <div class="col-md-6">
                        <select name="coach_gender" id="coach_gender" required class="form-control">
                            <?php foreach ($gender as $key => $value) {  ?>                                                 
                               <option value='<?php echo $key; ?>'
                                  <?php  if($key==$coach_details->coaching_gender){ 
                                       echo "selected='selected'";  } ?>
                                      ><?php echo $value; ?>
                                 </option>                           
                                
                              <?php  } ?>
                        </select>
                    </div>
                  <div class="col-md-6"> 
                      <label for="zip_code">Website<span class="req">*</span></label>
                        </div>
                     <div class="col-md-6">
                        <input type="text" name="website"   value="<?php echo $coach_details->website;?>" required class="form-control"/>
                    </div>
                     <div class="col-md-6"> 
                      <label for="address">Address<span class="req">*</span></label>
                        </div>
                     <div class="col-md-6">
                        <input id="autocomplete" type="text" name="address" onFocus="geolocate()"  value="<?php echo $coach_details->address;?>" required class="form-control"/>
                    </div>
                     
                    
                      <input id="street_number" disabled="true" type="hidden" placeholder="Street Number" required class="form-control">
                      <input id="route" disabled="true"  type="hidden" placeholder="Street Address" required class="form-control">
                   
                    <div class="col-md-6"> 
                      <label for="zip_code">Zip Code<span class="req">*</span></label>
                      </div>
                     <div class="col-md-6">
                        <input type="text" id="postal_code" disabled="true" name="zip_code" value="<?php echo $coach_details->zip; ?>" required class="form-control" />
                    </div>
                     <div class="col-md-6">
                        <label for="city">City<span class="req">*</span></label>
                    </div>
                     <div class="col-md-6">
                        <input type="text" name="city" id="locality" disabled="true" value="<?php echo $coach_details->city; ?>" required class="form-control" />
                    </div>
                     <div class="col-md-6">
                        <label for="state">State<span class="req">*</span></label>
                    </div>
                     <div class="col-md-6">
                     </div>
                     <div class="col-md-6">
                        <input type="text" name="state" id="administrative_area_level_1" disabled="true" value="<?php echo $coach_details->state; ?>" required class="form-control" />
                    </div>
                                
                    <div class="col-md-6">
                      <label for="country" class="">Country*</label>
                      </div>
                     <div class="col-md-6">
                       <input id="country" name="country" disabled="true"  value="<?php echo $coach_details->location; ?>" required class="form-control">
                    </div>

                         <div class="col-md-6">
                     <button type="submit" class="md-btn md-btn-primary adept-md-btn-primary "> Save </button>
                  </form>
                     <button type="button" id="cancel_basic" class="btn btn-default"> Cancel </button>
                  </div>
                </div>
            <!--  End  Edit Basic Detail -->

          </div> 


        
             

             





        <?php }else{ ?>


              <!-- Start Add Coach Basic Detail  -->

                  <div  id="add_basic_detail" class="ac_am_academic basic-informatio" style="display:block">
                     <div class="row">
                        <form action="<?php echo base_url()?>recruiter/addProfile" method="POST">
                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"> 
                              <?php $name_arry = explode(' ', $name); 
                                    $fname = $name_arry[0];
                                    $lname = $name_arry[1];
                                    foreach ($name_arry as $key => $value) {
                                      if($key>1){
                                        $lname .= ' '.$value;
                                      }
                                    }
                                
                              ?> 
                             <div class="col-md-6">
                              <label>First Name :</label>
                            </div>
                               <div class="col-md-6">
                                   <input id="fname" name="fname" value="<?php echo $fname; ?>" required class="form-control">
                              </div>


                             <div class="col-md-6">
                              <label>Last Name :</label>
                            </div>

                            <div class="col-md-6">
                                   <input id="lname" name="lname" value="<?php echo $lname; ?>" required class="form-control">
                              </div>


                            <div class="col-md-6">
                              <label>Sport :</label>
                            </div>
                            <div class="col-md-6">
                               <select id="sport" name="sport" required class="form-control">
                                    <?php foreach ($sport as $value) { ?>
                                         <option value="<?php echo $value->sportId; ?>">
                                              <?php echo $value->sportName; ?>
                                          </option> 
                                    <?php } ?>                                                             
                                </select> 
                            </div>

                            <div class="col-md-6">
                            <label>Level :</label>
                           </div>
                          <div class="col-md-6">
                             <select id="level" name="level" required class="form-control">
                                                
                              </select> 
                          </div>

                          
                             <div class="col-md-6">
                                 <label>Seeking :</label>
                              </div>
                                  <div class="col-md-6">
                                       <select name="seeking" id="seeking" required class="form-control">
                                              <option selected="">Select Seeking</option>
                                                <?php foreach ($seeking as  $value) {  ?>                                                                                                                            
                                                   <option value="<?php echo $value->id; ?>">                                                  
                                                    <?php echo $value->seekingName; ?>
                                                   </option>
                                                <?php } ?>
                                       </select>
                                </div>
                                  
                            <div class="col-md-6">
                              <label for="occupation" class="">Recruiter’s Occupation*</label>
                            </div>
                          <div class="col-md-6">
                              <select name="occupation" id="occupation" class="form-control">
                                  <option selected="" value="">Select Occupation</option>
                                  <?php foreach ($occupation as  $value) {  ?>                                                                                                                            
                                     <option value="<?php echo $value->occupationId; ?>">
                                      <?php echo $value->occupationName; ?>
                                    </option>
                                <?php } ?>
                              </select>                                    
                          </div>   

                           <div class="col-md-6">
                                <label for="team">Your Org / Team Name<span class="req">*</span></label>
                              </div>
                             <div class="col-md-6">
                                <input type="text"  id="team" name="team" required class="form-control" />
                            </div>

                          <div class="col-md-6">
                                <label for="coach_gender">What Gender You Coach<span class="req">*</span></label>
                            </div>
                          <div class="col-md-6">
                                <select name="coach_gender" id="coach_gender" required class="form-control">
                                    <?php foreach ($gender as $key => $value) {  ?>                                                 
                                       <option value='<?php echo $key; ?>'>
                                           <?php echo $value; ?>
                                         </option>
                                      <?php  } ?>
                                </select>
                            </div>
                          <div class="col-md-6"> 
                              <label for="zip_code">Website<span class="req">*</span></label>
                                </div>
                             <div class="col-md-6">
                                <input type="text" name="website"  required class="form-control"/>
                            </div>
                             <div class="col-md-6"> 
                              <label for="address">Address<span class="req">*</span></label>
                                </div>
                             <div class="col-md-6">
                                <input id="autocomplete" type="text" name="address" onFocus="geolocate()"   required class="form-control"/>
                            </div>
                             
                            
                              <input id="street_number" disabled="true" type="hidden" placeholder="Street Number" required class="form-control">
                              <input id="route" disabled="true"  type="hidden" placeholder="Street Address" required class="form-control">
                           
                            <div class="col-md-6"> 
                              <label for="zip_code">Zip Code<span class="req">*</span></label>
                              </div>
                             <div class="col-md-6">
                                <input type="text" id="postal_code" disabled="true" name="zip_code" required class="form-control" />
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
                               <input id="country" name="country" disabled="true"   required class="form-control">
                            </div>

                                 <div class="col-md-6">
                             <button type="submit" class="md-btn md-btn-primary adept-md-btn-primary "> Save </button>
                          </form>
                             <button type="button" id="cancel_basic" class="btn btn-default"> Cancel </button>
                          </div>
                  </div>

              <!-- End Coach Basic Detail -->

              <script>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

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
      /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
      {types: ['geocode']});

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

// [START region_fillform]
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
// [END region_fillform]

// [START region_geolocation]
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
// [END region_geolocation]

 </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtJQhvFVOJ7MB0QyM0bgcpAgn0SMgCYoY&libraries=places&callback=initAutocomplete"
        async defer></script>

            <button type="button" id="add_basic" class="glyphicon glyphicon-plus icon_pusbig_orange"></button>
        <?php } ?>

   

  

      </div>

   </div>

</div>

 

<!-- Start  Right Side Section -->
 <div class="col-md-3">

           <a href="<?php echo base_url(); ?>search_controller/player"  class="ac_am_upgrade_your_see">Search</a>

          <div id="side_invite_player" class="ac_am_upgrade_your_see">Invite Players</div>

          <div id="side_share_profile" class="ac_am_upgrade_your_see">Share Profile</div>

           
 </div>
 <!-- End  Right Side Section -->



<script>

           
 $(document).ready(function(){

          // Edit Basic Detail 
          $("#edit_basic_detail").hide();
          $("#edit_basic").click(function(){
              $("#basic_deatil").fadeOut();
              $("#edit_basic_detail").fadeIn();
          });

          $("#cancel_basic").click(function(){
              $("#basic_deatil").fadeIn();
              $("#edit_basic_detail").fadeOut();
          });
      //profile image events
      $("#dp_preview").mouseenter(function(){ 
          $("#change_profile").css({ display: "block" });        
      })
     .mouseleave(function(){    
          $("#change_profile").css({ display: "none" });

          $("#change_profile").mouseenter(function() {
             $("#change_profile").css({ display: "block" });          
          })

          .mouseout(function() {
             $("#change_profile").css({ display: "none" });            
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
            //alert(data);
         },
         cache: false,
         contentType: false,
         processData: false
         })

        });

});



$("#sport").on("change",function(){ 
      var sport_id = $("#sport").val();
      if(!sport_id==''){
      $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>recruiter/getLevel',
                data: {sport_id:sport_id},
              })
              .done(function(data){                           
                 $("#level").empty().append(data);  
            })
       }
  });

</script>

 <script src="<?php echo base_url(); ?>assets/js/common.min.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/uikit_custom.min.js"></script> 
 <script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script> 
<!--<script src="<?php //echo base_url(); ?>bower_components/moment/min/moment.min.js"></script> 
  
   
 -->

</body>
</html>   