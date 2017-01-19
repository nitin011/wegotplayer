<div id="update_refer">
    <div class="">
        <div class="uk-grid" data-uk-grid-margin>
            <div class="col-md-6">
                <form  class="uk-form-stacked">    
                   <div class="uk-form-row">
	                   <label for="full_name" class="uk-form-label">Full Name</label>
	                   <input type="text" name="full_name" id="full_name" value="<?php echo $refer_row[0]->full_name;?>" required class="md-input" />
           		   </div>
                   <div class="uk-form-row">
                   		<label for="occupation" class="uk-form-label">Occupation</label>
                        <select id="occupation" name="occupation" required data-md-selectize>
                            <?php foreach ($occupation as $value) { ?>
                               <option value="<?php echo $value->id; ?>"
                                <?php 
                                    if($value->id==$refer_row[0]->full_time_occupation){
                                      echo "selected";
                                    }
                                ?>

                                ><?php echo $value->occupation; ?></option>';
                            <?php  }?>                           
           			     </select>
           		   </div>  

                  <div class="uk-form-row">
                      <label for="organization" class="uk-form-label">Organization </label>
                        <input type="text" id="organization" name="organization"  
                        value="<?php if($refer_row[0]->organization!='null')
                        {
                          print_r($refer_row[0]->organization);
                        }
                        ?>" required class="md-input" /> 
                 </div>

                  <div class="uk-form-row">
                      <label for="level" class="uk-form-label">Level</label>
                        <select id="level" name="level" required data-md-selectize>
                           <?php 
                          foreach ($level as  $value) { ?>
                            <option value="<?php echo $value->levelId; ?>"
                              <?php if($value->levelId==$refer_row[0]->level)
                              echo "selected";
                              ?>
                              ><?php print_r($value->levelName); ?></option>
                        <?php  } ?>                            
                        </select>
                 </div>                             
                        
        </div>

        <div class="col-md-6">      
                   <div class="uk-form-row">
	                  <label for="gender">Gender</label>
	                  <select id="gender" name="gender" required data-md-selectize>
	                    <?php foreach ($gender as $key=>$value) { ?>
                             <option value="<?php echo $key; ?>"><?php echo $value; ?></option>';
                        <?php  } ?>                       
	                    </select>
                   </div>
                   <div class="uk-form-row">
                      <label for="phone" class="uk-form-label">Phone </label>
                        <input type="text" id="phone" name="phone" value="<?php echo $refer_row[0]->phone;?>" required class="md-input" /> 
                 </div>
                 <div class="uk-form-row">
                      <label for="email" class="uk-form-label">Email </label>
                        <input type="text" id="email" name="email" value="<?php echo $refer_row[0]->email;?>" required class="md-input" /> 
                 </div>
                               
                           
                   <div class="uk-form-row">
                      <label for="location">Location</label>
                      <input type="text" id="autocomplete_u" name="location" value="<?php echo $refer_row[0]->location;?>" required class="md-input" />
                    </div>

                        <input type="hidden" id="street_number" >
                        <input type="hidden" id="route" >
                        <input type="hidden" id="postal_code" name="zip_code" class="md-input" />
                        <input type="hidden" name="city" id="locality" />
                        <input type="hidden" name="state" id="administrative_area_level_1" class="md-input"/>
                        <input type="hidden" id="country" name="country" />
    
                                   
                   
                    <div class="uk-form-row">
                        <textarea class="md-input" name="comments" id="comments"><?php echo $refer_row[0]->comment;?></textarea>
                    </div>
                   <input type="hidden" id="wgp_table_id" value="<?php echo $refer_row[0]->wgp_table_id;?>">
                           
                    <div class="uk-form-row pull-right mt10">
                        <button type="button" id="submit" onclick="updateRow()" class="btn_col btn btn-danger ac_save">Save</button>
                        <button type="button" id="cancel_refer" class="btn btn-primary ac_cancel">Cancel </button> 
                    </div>             
               </form>
             </div>
         </div>
     </div>
</div>

  
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>

<script>
function updateRow() {
  		var full_name=$("#full_name").val();
        var occupation=$("#occupation").val();
        var organization=$("#organization").val();
        var level=$("#level").val();
        var email=$("#email").val(); 
        var phone=$("#phone").val();
        var gender=$("#gender").val();
        var location=$("#autocomplete_u").val();
        var comments=$("#comments").val();                                       
        var wgp_table_id=$("#wgp_table_id").val();

       $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>userreferences/updateReferRow',
              data: {full_name:full_name,occupation:occupation,email:email,
                      gender:gender,location:location,comments:comments,
                      wgp_table_id:wgp_table_id,level:level,
                      organization:organization,phone:phone
                    },
            })
          .done(function(data){
             $('#reference_view').html(data).fadeIn();
             $('#reference_target').fadeOut();
          })
	}

</script>
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
            (document.getElementById('autocomplete_u')),
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