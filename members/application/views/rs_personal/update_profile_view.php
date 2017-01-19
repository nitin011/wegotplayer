<div class="md-card">
  <div class="md-card-content">
    <form id="form_validation" class="uk-form-stacked">
      <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-medium-1-2">
          <div class="uk-form-row">
            
             <input type="hidden" name="user_id" value="<?php echo $coach->user_id; ?>"> 
                <label for="fname">First Name<span class="req">*</span></label>
                <input type="text"  value="<?php echo ucfirst($coach->first_name); ?>" id="fname"  name="fname" required class="md-input" />
            </div>
                                
          <div class="uk-form-row">              
              <input id="autocomplete" type="text" name="address" onFocus="geolocate()"  value="<?php echo $coach->address;?>" required class="md-input" />
          </div>
           <div class="uk-form-row">
            <input id="street_number" disabled="true" placeholder="Street Number" required class="md-input">
            </div>
            <div class="uk-form-row">
              <input id="route" disabled="true" placeholder="Street Address" required class="md-input">
          </div>
          <div class="uk-form-row"> 
            <label for="zip_code">Zip Code<span class="req">*</span></label>
              <input type="text" id="postal_code" disabled="true" name="zip_code" value="<?php echo $coach->zip; ?>" required class="md-input" />
          </div>
           <div class="uk-form-row">
              <label for="city">City<span class="req">*</span></label>
              <input type="text" name="city" id="locality" disabled="true" value="<?php echo $coach->city; ?>" required class="md-input" />
          </div>
           <div class="uk-form-row">
              <label for="state">State<span class="req">*</span></label>
              <input type="text" name="state" id="administrative_area_level_1" disabled="true" value="<?php echo $coach->state; ?>" required class="md-input" />
          </div>
                      
          <div class="uk-form-row">
            <label for="country" class="uk-form-label">Country*</label>
             <input id="country" name="country" disabled="true"  value="<?php echo $coach->location; ?>" required class="md-input">
                                             
          </div>
        </div> 
      <div class="uk-width-medium-1-2">
          <div class="uk-form-row">
              <label for="lname">Last Name<span class="req">*</span></label>
              <input type="text" value="<?php echo ucfirst($coach->last_name); ?>" id="lname" name="lname" required class="md-input" />
          </div>

          <div class="uk-form-row">
              <label for="website">Website<span class="req">*</span></label>
              <input type="text" value="<?php echo $coach->website;?>" id="website" name="website" required class="md-input" />
          </div>
          <div class="uk-form-row">
              <label for="team">Your Org / Team Name<span class="req">*</span></label>
              <input type="text" value="<?php echo $coach->team; ?>" id="team" name="team" required class="md-input" />
          </div>

          <div class="uk-form-row">
              <label for="coach_gender">What Gender You Coach<span class="req">*</span></label>
              <select name="coach_gender" id="coach_gender" required data-md-selectize>
                  <?php foreach ($gender as $key => $value) {  ?>                                                 
                     <option value='<?php echo $key; ?>'
                        <?php  if($key==$coach->coaching_gender){ 
                        		 echo "selected";  } ?>
                        		><?php echo $value; ?>
                       </option>                           
                      
                    <?php  } ?>
              </select>
          </div>
         <div class="uk-form-row">
            <label for="sport" class="uk-form-label">Sport*</label>
            <select name="sport" id="sport" required data-md-selectize onchange="selectLevel()">
                <option selected="" value="">Select Sport</option>
                <?php foreach ($sport as  $value) {  ?>                                                                                                                            
                     <option value="<?php echo $value->sportId; ?>"
                     		<?php if($value->sportId==$coach->sports){
                     			echo "selected";
                     		}?>
                     	><?php echo $value->sportName; ?></option>
                 <?php }   ?>                                                                      
            </select>                                   
        </div>
        <div class="uk-form-row">
            <label for="level" class="uk-form-label">Level*</label>
                <div id="leveldata">
                    <input type="text" placeholder="Select Level" value="<?php echo $coach->level; ?>" id="level" required class="md-input" />
                </div>                                    
         </div>
        <div class="uk-form-row">
            <label for="occupation" class="uk-form-label">Recruiter’s Occupation*</label>
            <select name="occupation" id="occupation" required data-md-selectize>
                <option selected="" value="">Select Occupation</option>
                <?php foreach ($occupation as  $value) {  ?>                                                                                                                            
                   <option value="<?php echo $value->occupationId; ?>"
                   		<?php if($value->occupationId==$coach->occupation){
                     			echo "selected";
                     		}?>
                   	><?php echo $value->occupationName; ?></option>
              <?php } ?>
            </select>                                    
        </div>                                        

      
                  
      </div>
      <div class="uk-form-row">
          <label for="message">By Signing Up with WeGotPlayers.com and creating your sports player’s profile, you acknowledge that you have read, understood and agreed with our <a href="#" target="_blank">Terms</a> and <a href="#" target="_blank">Privacy</a>.</label>
      </div>
       
      <div class="uk-form-row">
          <button type="button" id="update" class="md-btn md-btn-primary">Update</button>
      </div>
     </div>
  </form>
 </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/common.min.js"></script>    
<script src="<?php echo base_url(); ?>assets/js/uikit_custom.min.js"></script>   
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>
<script>
function selectLevel()
  {
      var sport_id = $("#sport").val();
      if(!sport_id==''){
      $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>recruiter/getLevel',
                data: {sport_id:sport_id},
              })
              .done(function(data){
                $('#leveldata').empty();
                $('#leveldata').append(data);
               // $('#leveldata').html(data);               
               
            })
       }
   }
</script>

  <script>
   $(document).ready(function () {
      $("#update").click(function () { 

              var fname =$("#fname").val();
              var lname =$("#lname").val();              
              var street_no =$("#street_number").val();
              var route =$("#route").val();
              var pincode =$("#postal_code").val();
              var city =$("#locality").val();
              var state =$("#administrative_area_level_1").val();
              var country =$("#country").val();
              var website =$("#website").val();
              var sport =$("#sport").val();
              var level =$("#level").val();
              var occupation =$("#occupation").val();      
              var team =$("#team").val();
              var coach_gender =$("#coach_gender").val();              
              var address =street_no+' '+route; 
              $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>recruiter/updateProfileData',
                      data: {fname:fname,lname:lname,address:address,
                              pincode:pincode,city:city,state:state,country:country,
                              website:website,sport:sport,level:level,
                              occupation:occupation,coach_gender:coach_gender,
                              team:team},
                    })
                  .done(function(data){                  
                     $('#personal').html(data);
                })
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

    <script src="https://maps.googleapis.com/maps/api/js?signed_in=true&libraries=places&callback=initAutocomplete" async defer></script>


