
	  <div class="row" id="edit_basic_detail">
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

                             <option selected="">Selecgt Seekin</option>

                              <?php foreach ($seeking_list as  $value) {  ?>                                                                                                                            

                                 <option value="<?php echo $value->id; ?>"

                                 	<?php 

                                   if($value->id==$seeking_id){

                                            echo "selected";

                                          } ?>

                                 	>

                                 	<?php echo $value->seekingName; ?>

                                 </option>

                                 <?php } ?>

                               </select>

                      </div>

                 <?php //print_r($seeking_id); ?>


        <div id="clg-box" style="display:none;">

            <div class="col-md-6">
              <label class="">High School Graduation Date</label>
            </div>
            <div class="col-md-6">
              
              <input  type="text" id="grade_date" name="graduation_date" value="<?php ?>">
             
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



               <div class="col-md-6">

        		    	 <button type="submit" class="btn_col btn btn-danger ac_save">	Save </button>

        		   
        		    	 <button type="button" id="cancel_basic" class="btn btn-primary ac_cancel">	Cancel </button>

		          </div>

 </form>

</div>

<script>

$("#seeking").on('change',function(){
    var seeking = $(this).val();

    if(seeking==1){
      $("#clg-box").fadeIn('slow');
    }else{
      $("#clg-box").fadeOut('slow');
    }
});



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

            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),

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

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtJQhvFVOJ7MB0QyM0bgcpAgn0SMgCYoY&libraries=places&callback=initAutocomplete"

        async defer></script>


     </div>

    </div> 
