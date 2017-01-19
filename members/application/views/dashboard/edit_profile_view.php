  <div class="md-card">
      <div class="md-card-content">
        <form id="form_validation" class="uk-form-stacked" action="<?php echo base_url()?>userdetail/updatePersonal" method="POST" accept-charset="utf-8">
          <div class="uk-grid" data-uk-grid-margin>
              <div class="uk-width-medium-1-2">
                  
                      <div class="uk-form-row">
                        <?php $name1=explode(' ', $name)?>
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"> 
                          <label for="fname">First Name<span class="req">*</span></label>
                          <input type="text"  value="<?php echo ucfirst($name1[0]); ?>" id="fname"  name="fname" required class="md-input" />
                      </div>
                      <div class="uk-form-row">
                          <label for="lname">Last Name<span class="req">*</span></label>
                          <input type="text" value="<?php echo ucfirst($name1[1]); ?>" id="lname" name="lname" required class="md-input" />
                      </div>
                     
                      <div class="uk-form-row">
                          <label for="email">Email<span class="req">*</span></label>
                          <input type="email" value="<?php echo $email; ?>" name="email" id="email" data-parsley-trigger="change" required  class="md-input" />
                      </div>
                      <div class="uk-form-row">
                          <label for="gender" class="uk-form-label">Gender<span class="req">*</span></label>
                          <p>
                              <input type="radio" name="gender" id="male" value="1" data-md-icheck required />
                              <label for="male" class="inline-label">Male</label>
                             <input type="radio" name="gender" id="female" value="2" data-md-icheck />
                          <label for="female" class="inline-label">Female</label>
                          </p>
                      </div>
                      <div class="uk-form-row">
                          <label for="val_select" class="uk-form-label">Nationality*
                                  </label>
                                    
                          <select name="nationality" id="nationality" required data-md-selectize>
                              <option value="" selected="">Select Nationality</option>
                                <?php foreach ($nation as  $value) {  ?>                                                                                                                            
                                    <option value="<?php echo $value->id; ?>">
                                      <?php echo $value->nationality; ?></option>
                                <?php }   ?>                                      
                          </select>
                      </div>
                      
                      <div class="uk-form-row">
                      
                            <label for="kUI_datepicker_a" class="uk-form-label">DOB</label>
                            <input id="kUI_datepicker_a" value=" " name="dob" />
                     
                       </div>
                       
          <div class="uk-form-row">
              
              <input id="autocomplete" type="text" name="address" onFocus="geolocate()"  value="" required class="md-input" />
          </div>
           <div class="uk-form-row">
            <input id="street_number" disabled="true" placeholder="Street Address" required class="md-input">
            </div>
            <div class="uk-form-row">
              <input id="route" disabled="true" required class="md-input">
          </div>
          <div class="uk-form-row"> 
            <label for="zip_code">Zip Code<span class="req">*</span></label>
              <input type="text" id="postal_code" disabled="true" name="zip_code" value="" required class="md-input" />
          </div>
           <div class="uk-form-row">
              <label for="city">City<span class="req">*</span></label>
              <input type="text" name="city" id="locality" disabled="true" value="" required class="md-input" />
          </div>
           <div class="uk-form-row">
              <label for="state">State<span class="req">*</span></label>
              <input type="text" name="state" id="administrative_area_level_1" disabled="true" value="" required class="md-input" />
          </div>
                      
          <div class="uk-form-row">
            <label for="country" class="uk-form-label">Country*</label>
             <input id="country" name="country" disabled="true"  value="" required class="md-input">
                                             
          </div>
        </div> 
                       <div class="uk-width-medium-1-2">
                       <div class="uk-form-row">
                          <label for="sport" class="uk-form-label">Sport*</label>
                          <select name="sport" id="sport" required data-md-selectize onchange="selectLevel();selectPosition();">
                              <option selected="" value="">Select Sport</option>
                              <?php foreach ($sport as  $value) {  ?>                                                                                                                            
                                   <option value="<?php echo $value->sportId; ?>"><?php echo $value->sportName; ?></option>
                               <?php }   ?>                                                                      
                          </select>                                   
                      </div>
                      <div class="uk-form-row">
                          <label for="val_select" class="uk-form-label">Level*</label>
                          <div id="leveldata">
                                 <input type="text" placeholder="Select Level" value="" id="level" required class="md-input" />
                           </div>                                    
                      </div>
                      <div class="uk-form-row">
                          <label for="val_select" class="uk-form-label">Position / Speciality*</label>
                          <div  id="positiondata">
                               
                           </div>                                    
                      </div>
                      <div class="uk-form-row">
                          <label for="hand" class="uk-form-label">Hand*</label>
                          <select name="hand" id="hand" required data-md-selectize>                                    
                                <option selected="" value="">Select Hand</option>
                                <?php foreach ($hand as  $value) {  ?>                                                                                                                            
                                     <option value="<?php echo $value->handId; ?>"><?php echo $value->handName; ?></option>

                                <?php } ?>
                              </select>                                        
                      </div>
                      <div class="uk-form-row">
                          <label for="foot" class="uk-form-label">Foot*</label>
                          <select id="foot" name="foot" required data-md-selectize>
                             <option selected="" value="">Select Foot</option>
                              <?php foreach ($foot as  $value) {  ?>                                                                                                                            
                                     <option value="<?php echo $value->footId; ?>"><?php echo $value->footName; ?></option>

                                <?php } ?>
                              </select> 
                      </div>
                       <div class="uk-form-row">
                          <label for="height" class="uk-form-label">Height*</label>
                          <select name="height" id="height" required data-md-selectize>
                             <option selected="" value="">Select Height</option>
                              <?php foreach ($height as  $value) {  ?>                                                                                                                            
                                 <option value="<?php echo $value->id; ?>"><?php echo $value->height; ?></option>
                                 <?php } ?>
                               </select>             
                      </div>
                    <div class="uk-form-row">
                          <label for="val_select" class="uk-form-label">Weight*</label>
                          <select name="weight" id="weight" required data-md-selectize>
                             <option selected="" value="">Select weight</option>
                              <?php foreach ($weight as  $value) {  ?>                                                                                                                            
                                 <option value="<?php echo $value->id; ?>"><?php echo $value->weight; ?></option>
                                 <?php } ?>
                               </select>
                      </div>
                       
                 <div class="uk-form-row">
                          <label for="seeking" class="uk-form-label">Seeking*</label><br/>
                          <?php foreach ($seeking as $value) { ?>

                          <span class="icheck-inline">
                              <input type="checkbox" name="seek[]" id="seek_<?php echo $value->id;?>" value="<?php echo $value->id; ?>" class="seek"/>
                              <label  class="inline-label"><?php echo $value->seekingName; ?></label>
                          </span>
                          <?php   }?>
                          
                          <div class="uk-form-row" id="clg-box" style="display:none;">
                              <label>College Scholarship</label>
                              <input type="text" class="md-input" />
                          </div>

                          
                      </div>
                      
                      <div class="uk-form-row">
                          <label for="Who can contact you?" class="uk-form-label">Who can contact you ? :</label><br/>
                          <?php foreach ($contact as $value) { ?>
                          <span class="icheck-inline">
                              <input type="checkbox" name="contact_you[]" id="contact_you_<?php echo $value->id;?>" value="<?php echo $value->id; ?>" class="contact-you" />
                              <label  class="inline-label"><?php echo $value->contact_you; ?></label>
                          </span>
                          <?php   }?>
                      </div>



                       
                       <div class="uk-form-row-find">
                          <label for="val_select" class="uk-form-label">How did you find us?*</label>
                          <select name="find" id="find" required data-md-selectize>
                              <option selected="" value="">Select..</option>
                              <option value="1" >Internet</option>
                              <?php foreach ($find as  $value) {  ?>                                                                                                                            
                                   <option value="<?php echo $value->findId; ?>"><?php echo $value->findName; ?></option>
                              <?php } ?>
                          </select>                                   
                      </div>
                 </div>
          </div>
          <div class="uk-width-medium-1">
              <div class="uk-form-row" id="text_a" >
                    <label for="message">Personal Information(Enter Minimum 50 Character)</label>
                    <textarea class="md-input" name="personal_info" id="personal_info" onblur="checkMessage();"><?php  echo $personal_info; ?></textarea>
                    <span id="per_msg"></span>
              </div>
               <div class="uk-form-row">
                    <label for="message">By Signing Up with WeGotPlayers.com and creating your sports player’s profile, you acknowledge that you have read, understood and agreed with our <a href="#" target="_blank">Terms</a> and <a href="#" target="_blank">Privacy</a>.</label>
                </div>  
              <div class="uk-form-row">
                  <button type="submit" id="submit" name="submit" class="md-btn md-btn-primary adept-md-btn-primary">Submit</button>
              </div>
          </div>
          </form>
      </div>
  </div>


<script>
  function selectLevel()
  {
      sport_id = $("#sport").val();
      if(!sport_id==''){
      $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>userdetail/selectLevel',
                data: 'id='+sport_id,
                success :function(levelData){
                  
                  $('#leveldata').html(levelData);
                  return false;
                }
            })

        }else{    
                  var data='<option value="" selected="">Select Level</option>';
                  $('#levelis').empty();
                  $('#positionis').empty();

                  $('#levelis').append(data);
                  var data1='<option value="" selected="">Select Position</option>';
                  $('#positionis').append(data1);
             }
  }

  function selectPosition()
  {

    sport_id = $("#sport").val();
          
      if(!sport_id==''){
      $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>userdetail/selectPosition',
                data: 'id='+sport_id,
                success :function(positionData){
                  
                  $('#positiondata').html(positionData);
                  return false;
                }
            })

        }else{    
                  var data='<option value="" selected="">Select Position</option>';
                  $('#positionis').empty();
                  $('#positionis').append(data);
             }
      

  }

 

</script>

  
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>

<script>
$(document).ready(function () {
    $(".seek").click(function () {                 
      var tab=$(this).attr('id');     
      //var value=$(this).val();      
      for(var j=1;j<=8;j++){
      if(tab=='seek_'+j){
        if(tab=='seek_1'){
          $("#clg-box").show();
        }
          
        //$("#contact_you_"+j).attr('checked', true); 
        document.getElementById("contact_you_"+j).checked = true;
        if ($(this).is(':checked')) {
          for(var i=1;i<=8;i++){
          
          $("#contact_you_"+i).attr('disabled', true);
          $("#contact_you_"+j).attr('disabled', false);
                          
            $("#seek_"+i).attr('disabled',true);
            $("#seek_"+j).attr('disabled',false);
            }
        }else{
          $("#clg-box").hide();
          
          $("#contact_you_"+j).removeAttr('checked');

          for(var i=1;i<=8;i++){
            $("#contact_you_"+i).removeAttr('disabled');
            $("#seek_"+i).attr('disabled',false);
            //$("#seek_"+j).attr('disabled',true);
            }
        }
      }
    }

                
  });

  $(".contact-you").click(function () {                  
    var tab2=$(this).attr('id');
    
    for(var s=1;s<=8;s++){
    if(tab2=='contact_you_'+s){
      if(tab2=='contact_you_1'){        
          $("#clg-box").show();         
        }
        document.getElementById("seek_"+s).checked = true;
      
        if ($(this).is(':checked')) {                 
          
            
          for (var i =1 ; i <= 8; i++) {
          $("#seek_"+i).attr('disabled', true);
          $("#contact_you_"+i).attr('disabled', true);
          $("#contact_you_"+s).attr('disabled', false);
          $("#seek_"+s).attr('disabled', false);
        }
          
          
        }else{
          $("#clg-box").hide();         
          $("#seek_"+s).removeAttr('checked');

          $("#contact_you_"+s).removeAttr('checked');
          for(var j=1;j<=8;j++)
          {
            $("#contact_you_"+j).attr('disabled', false);
            $("#seek_"+s).removeAttr('checked');
            $("#seek_"+j).attr('disabled', false);
            }         
        }
      }      
        
      }     
    });


});

</script>

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

   
   <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtJQhvFVOJ7MB0QyM0bgcpAgn0SMgCYoY&libraries=places"></script>


