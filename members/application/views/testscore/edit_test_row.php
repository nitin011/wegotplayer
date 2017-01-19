<div class="md-card">
   <div class="md-card-content" id="update_form">
      <div class="uk-grid" data-uk-grid-margin>
         <div class="uk-width-medium-1-2">
            <form id="form_validation" class="uk-form-stacked">  
               <div class="uk-form-row">
                   <label for="test_type" class="uk-form-label">Test Type</label>
                        <select id="test_type" name="test_type" required data-md-selectize>                               
                        <?php foreach ($test_type as  $value) {  ?>                                                                                                                            
                                <option value="<?php echo $value->id; ?>"
                                <?php 
                                if($value->id==$test_row->test_type){
                                  echo "selected";
                                } ?>
                                ><?php echo $value->test_type_name; ?></option>
                            <?php }   ?>                 
                        </select>
               		   </div>
                    <div class="uk-form-row">
                         <label for="subject" class="uk-form-label">Subject</label>
                              <select id="subject" name="subject" required data-md-selectize>
                                  <option value="">Choose..</option>
                                  <?php foreach ($subject as  $value) {  ?>                                                                                                                            
                                    <option value="<?php echo $value->id; ?>"
                                      <?php 
                                    if($value->id==$test_row->test_subject){
                                      echo "selected";
                                    } ?>
                                    ><?php echo $value->subject_name; ?></option>
                                <?php }   ?> 
                 			     </select>
                 		   </div>
                                 
                                
                      <div class="uk-form-row">
                          <label for="testscore" >Test Score</label>
                          <input type="text" name="testscore" id="testscores" value="<?php echo $test_row->test_score; ?>" required class="md-input" />
                       </div>
                                 
                             
                        <div class="uk-form-row">
                            <label for="out_of">Out Of</label>
                            <input type="text" name="out_of" id="out_of" value="<?php echo $test_row->out_of; ?>" required class="md-input" />
                        </div>
                                     
                        <div class="uk-form-row">
                            <label for="test_date">Date Of Test</label>
                            <input type="text" id="test_date" name="test_date" value="<?php echo $test_row->date_of_test; ?>" />
                        </div>
                             
                       <div class="uk-form-row">
                          <label for="test_location">Location Of Test</label>
                          <input type="text" name="test_location" id="autocomplete" value="<?php echo $test_row->location_of_test; ?>" required class="md-input" />
                           <input type="hidden" id="street_number" >
                       <input type="hidden" id="route" >
                      <input type="hidden" id="postal_code" name="zip_code" class="md-input" />
                      <input type="hidden" name="city" id="locality" />
                      <input type="hidden" name="state" id="administrative_area_level_1" class="md-input"/>
                      <input type="hidden" id="country" name="country" class="md-input"/>
                       </div>
                          <input type="hidden" name="wgp_table_id" id="wgp_table_id" value="<?php echo $test_row->wgp_table_id; ?>">
                                    
                    <div class="uk-form-row">
                      <button type="button" id="submit" onclick="updadeTest()" class="md-btn md-btn-primary adept-md-btn-primary">Save</button>
                     </div>                      
                 </form>
          </div>
      </div>
  </div>


<script src="<?php echo base_url(); ?>bower_components/moment/min/moment.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/common.min.js"></script>    
<script src="<?php echo base_url(); ?>assets/js/uikit_custom.min.js"></script>   
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/kendoui.custom.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/kendoui.min.js"></script>
<script>
$("#test_date").kendoDatePicker({
  format: "MMMM dd,yyyy"
});

</script>

<script>
$.noConflict();
 function updadeTest(){                
            var test_type=$("#test_type").val();
            var subject=$("#subject").val();
            var testscore=$("#testscores").val();            
            var out_of=$("#out_of").val();
            var test_date=$("#test_date").val();
            var test_location=$("#autocomplete").val();
            var wgp_table_id=$("#wgp_table_id").val();

       $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>usertestscore/updateTestRow',
              data: {test_type:test_type,subject:subject,testscore:testscore,
                     out_of:out_of, test_date:test_date,test_location:test_location,
                     wgp_table_id:wgp_table_id
                    },
            })
          .done(function(data){
             $('#testscore').html(data);
             })
          
    }
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


