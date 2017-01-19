<div id="add_refer">
  <form  method="POST" action="<?php echo base_url()?>userreferences/insertRefer">    
    <div class="col-md-6">  
        <div class="uk-form-row">
           <label for="full_name" >Full Name</label>
           <input type="text" name="full_name" id="full_name" required class="form-control" />
 		     </div>
          <div class="uk-form-row">
       		<label for="occupation" class="uk-form-label">Occupation</label>
            <select id="occupation" name="occupation" required data-md-selectize>
                <?php foreach ($occupation as $value) { ?>
                   <option value="<?php echo $value->id; ?>"><?php echo $value->occupation; ?></option>';
                <?php  }?>                           
			     </select>
	        </div>
          <div class="uk-form-row">
            <label for="organization" >Organization </label>
              <input type="text" id="organization" name="organization"  required class="form-control" /> 
             </div>
          <div class="uk-form-row">
            <label for="level" >Level</label>
             <select id="level" name="level" required data-md-selectize>
              <?php 
                foreach ($level as  $value) { ?>
                  <option value="<?php echo $value->levelId; ?>"><?php print_r($value->levelName); ?></option>
              <?php  } ?>
                                            
            </select>
           </div>
          <div class="uk-form-row">
          <label for="gender">Gender</label>
          <select id="gender" name="gender" required data-md-selectize>
            <?php foreach ($gender as $key=>$value) { ?>
                   <option value="<?php echo $key; ?>"><?php echo $value; ?></option>';
              <?php  } ?>                       
            </select>
           </div>       

  </div>
  <div class="col-md-6">
       <div class="uk-form-row">
          <label for="phone" >Phone </label>
            <input type="text" id="phone" name="phone"  required class="form-control" /> 
        </div> 
        <div class="uk-form-row">
          <label for="email" class="uk-form-label">Email </label>
            <input type="text" id="email" name="email"  required class="form-control" /> 
        </div> 
        <div class="uk-form-row">          
     
          <label for="location" class="uk-form-label">Location</label>
          <input type="text" id="autocomplete_r" name="location" onFocus="geolocate()" required class="form-control" />
       
        </div> 
      
   
         <input type="hidden" id="street_number" disabled="true">
         <input type="hidden" id="route" disabled="true">
         <input type="hidden" id="postal_code" disabled="true" name="zip_code" />
        <input type="hidden" name="city" id="locality" disabled="true" />
        <input type="hidden" name="state" id="administrative_area_level_1" disabled="true" />
        <input type="hidden" id="country" name="country" disabled="true">
    
        <div class="uk-form-row">
            <label for="comments">Comments</label>
            <textarea class="form-control" name="comments" id="comments"></textarea>
        </div>
                           
       <div class="col-md-6 col-md-offset-6">
            <button type="submit" class="md-btn md-btn-primary adept-md-btn-primary">Save</button>
             <button type="button" id="cancel_refer" class="btn btn-default">Cancel </button> 
        </div>             
   </div>
  </form>
</div>


  
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>
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
            (document.getElementById('autocomplete_r')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);       
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
<script type="text/javascript">

$("#cancel_refer").click(function(){
   $("#reference_view").fadeIn();
   $("#reference_target").fadeOut();
});
</script>