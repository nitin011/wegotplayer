 <!-- start left side -->
     		 <input type="hidden" value="<?php echo $event_detail->wgp_event_id;?>" id="edit_wgp_event_id">
             <div class="col-md-12">
                <label for="fname" class="evn_col">Event Name<span class="req">*</span></label>
                    <input type="text"  value="<?php print_r(ucfirst($event_detail->wgp_event_name)); ?>" id="edit_event_name"  name="event_name" required class="form-control" />
             </div>
              <div class="col-md-6">
              		<label for="level" class="evn_col">Level<span class="req">*</span></label>
                  <select name="level" id="edit_level" required class="form-control">
                              <option value="" selected="">Select Level</option>
                                <?php foreach ($level_data as  $row) {  ?>                                                                                                                            
                                    <option value="<?php echo $row->levelId; ?>"
                                          <?php if($event_detail->wgp_event_level==$row->levelId)
                                          {
                                            echo "selected";
                                          }?>
                                      >
                                      <?php echo $row->levelName; ?></option>
                                <?php }   ?>                                      
                          </select>
             

  
               <?php $start_date = Date('n/j/Y h:i A',strtotime($event_detail->wgp_event_start));?>
                      <label for="range_start" class="evn_col">Event Start:</label>
                      <input id="edit_range_start1" value="<?php echo $start_date; ?>"/>
           
              		<label for="event_website" class="evn_col">Event Website<span class="req">*</span></label>
                    <input type="text"  value="<?php echo $event_detail->wgp_event_website; ?>" id="edit_event_website"  name="event_website" required class="form-control" />

             
            
              </div>
             <!-- end left side -->

 			<!-- start right side -->
              <div class="col-md-6">
              	 
              		<label for="event_type" class="evn_col">Event Type<span class="req">*</span></label>
                    	<select name="event_type" id="edit_event_type" required class="form-control">
                              <option value="" selected="">Select Event type</option>
                                <?php foreach ($event_type as  $event_row) {  ?>                                                                                                                            
                                    <option value="<?php echo $event_row->id; ?>"
                                      <?php if($event_detail->wgp_event_type==$event_row->id)
                                          {
                                            echo "selected";
                                          }?>
                                      >
                                      <?php echo $event_row->type; ?></option>
                                <?php }   ?>                                      
                          </select>
              
                      <?php  if ($event_detail->wgp_event_end!=''){
                       $start_end = Date('n/j/Y h:i A',strtotime($event_detail->wgp_event_end));
                       }else{ 
                          $start_end = '0/0/0000 00:00 AM';
                        }
                      ?>
                       <label for="range_end" class="evn_col">Event End:</label>
                       <input id="edit_range_end1" value="<?php echo $start_end; ?>"/>
              
                      <label for="event_importance" class="evn_col">Event Importance<span class="req">*</span></label>
                      <select name="event_importance" id="edit_event_importance" required data-md-selectize>
                              <option value="" selected="">Select Event Importance</option>
                                <?php foreach ($event_importance as  $row) {  ?>                                                                                                                            
                                    <option value="<?php echo $row->id; ?>"
                                      <?php if($event_detail->wgp_event_importance==$row->id)
                                          {
                                            echo "selected";
                                          }?>
                                      
                                      >
                                      <?php echo $row->name; ?></option>
                                <?php }   ?>                                      
                      </select>
              	

              </div>
              <!-- end right side -->

               <div class="col-md-12">
                    <label for="location" class="evn_col">Location<span class="req">*</span></label>
                    <input type="text"  value="<?php echo $event_detail->wgp_address; ?>" id="autocomplete3"  name="location" onFocus="geolocate()" required class="form-control" />
                   
                </div>
                <input type="hidden" id="street_number" disabled="true" placeholder="Street Address"  >
                 <input type="hidden" id="route" disabled="true" required class="md-input" >
                 <input type="hidden" id="postal_code" disabled="true" name="zip_code" />
                <input type="hidden" name="city" id="locality" disabled="true"  />
                <input type="hidden" name="state" id="administrative_area_level_1" disabled="true"   />
                <input type="hidden" id="country" name="country" disabled="true" placeholder="Country"  >

              <div class="col-md-12 btn">
                  
                   <button type="button" id="submit_event" class="btn_col btn btn-danger ac_save">Save</button>
                   <button type="button" id="delete_event" class="btn btn-primary ac_cancel">Delete</button>  
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
            (document.getElementById('autocomplete3')),
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

<script>
 $(document).ready(function () {
     $("#submit_event").click(function (){     	
       var wgp_event_id =$("#edit_wgp_event_id").val();
       var name =$("#edit_event_name").val();
       var level =$("#edit_level").val();
       var start_date =$("#edit_range_start1").val();
       var website =$("#edit_event_website").val();
       var event_type =$("#edit_event_type").val();
       var event_imp =$("#edit_event_importance").val();
       var end_date =$("#edit_range_end1").val();
       var address =$("#autocomplete3").val();

       console.log(name+' '+level+' '+start_date+' '+website+' '+event_type+' '+event_imp+' '+end_date+' '+address);
      //  alert(45);
         $.ajax({
	              type:'POST',
	              url:'<?php base_url() ?>usercalendar/updateEvent',
	              data:{name:name,level:level,start_date:start_date,
	              		website:website,event_type:event_type,
	              		event_imp:event_imp,end_date:end_date,
	              		address:address,wgp_event_id:wgp_event_id
	              	},
	          })
	        .done(function(data){
             var url = "<?php echo base_url(); ?>event";
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
$("#edit_range_start1").kendoDateTimePicker({
    format: "M/d/yyyy hh:mm tt"
});
$("#edit_range_end1").kendoDateTimePicker({
    format: "M/d/yyyy hh:mm tt"
});
</script>




