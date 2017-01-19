<div class="md-card">
	<div class="md-card-content">
		<!-- <form class="uk-form-stacked" action="<?php //echo base_url()?>userpersonal/updateProfile" method="POST" accept-charset="utf-8"> -->
			<div class="uk-grid" data-uk-grid-margin>
			   <div class="uk-width-medium-1-2">
			   	
				   <div class="uk-form-row">
						<?php $name1=explode(' ', $name)?>
						<input type="hidden" name="user_id" value="<?php echo $user_id; ?>"> 
						<label for="fname">First Name<span class="req">*</span><span id="fname_error"></span></label>
						<input type="text"  value="<?php echo ucfirst($name1[0]); ?>" id="fname"  name="fname" required class="md-input" />
					</div>
					<div class="uk-form-row">
							<label for="lname">Last Name<span class="req">*</span><span id="lname_error"></span></label>
							<input type="text" value="<?php echo ucfirst($name1[1]); ?>" id="lname" name="lname" required class="md-input" />
					</div>

					<div class="uk-form-row">
							<label for="personal_link">Personal link:
								<span class="req">*</span>
								<span id="link_error"></span>								
							</label>
							<label><?php echo base_url();?></label>
							<input type="text" value="<?php echo $username->login_name; ?>" onblur="checkUserName()" id="personal_link" name="personal_link" required class="md-input" />
							<input type="hidden" value="<?php echo $username->login_name; ?>" id="old_username">
					</div>
								 
					<!-- <div class="uk-form-row">
							<label for="email">Email<span class="req">*</span></label>
							<?php //if(($acc_type=='PRO')||($acc_type=='PLUS')){ ?>	
							<input type="email" value="<?php //echo $email; ?>" name="email" id="email" data-parsley-trigger="change" required  class="md-input" />
							<?php //}else { 
	          				//echo "For PRO and PLUS account! !";} ?>
					</div> -->

					
					<div class="uk-form-row">
						<label for="gender" class="uk-form-label">Gender<span class="req">*</span><span id="gender_error"></span></label>
						<p>	
							<input type="radio" name="gender" id="male" value="1" <?php if($user_details->gender==1){echo "checked";
                                                            }?> data-md-icheck required />
							<label for="male" class="inline-label">Male</label>
						 	<input type="radio" name="gender" id="female" value="2" <?php if($user_details->gender==2){echo "checked";
                                                            } ?> data-md-icheck />
							<label for="female" class="inline-label">Female</label>
						</p>
					</div>
					<div class="uk-form-row">
						<label for="val_select" class="uk-form-label">Nationality*</label>
							 <select name="nationality" id="nationality" required data-md-selectize data-md-selectize-bottom>
								<option value="" selected="">Select Nationality</option>
									<?php foreach ($nation as  $value) {  ?>                                                                                                                            
										  <option value="<?php echo $value->id; ?>"
											<?php if($value->id==$user_details->nationality){
				                                  echo "selected";
				                             } ?>
											><?php echo $value->nationality; ?></option>
											<?php }   ?>                                      
							 </select>
							 <span id="nationality_error"></span>
					</div>
											
					<div class="uk-form-row">											
						<label for="kUI_datepicker_a" class="uk-form-label">Date of Birth</label>
						<?php $birth_date = $user_details->birth_day.'-'.$user_details->birth_month.'-'.$user_details->birth_year;?>
						<input id="dob" value="<?php echo $birth_date; ?>" name="dob" />
						<span id="dob_error"></span> 
				 	</div>
											 
					 <div class="uk-form-row">
							<label for="address">Address<span class="req">*</span></label>
							<input id="autocomplete" type="text" name="address" onFocus="geolocate()"  value="<?php echo $user_details->address;?>" required class="md-input" />
							<span id="address_error"></span>  
					</div>
					 <div class="uk-form-row">
					 	<input id="street_number" disabled="true" placeholder="Street Address" required class="md-input">
    				</div>
    				<div class="uk-form-row">
    					<input id="route" disabled="true" required class="md-input">
					</div>
					<div class="uk-form-row">	
						<label for="zip_code">Zip Code<span class="req">*</span></label>
							<input type="text" id="postal_code" disabled="true" name="zip_code" value="<?php echo $user_details->zip;?>" required class="md-input" />
					</div>
					 <div class="uk-form-row">
							<label for="city">City<span class="req">*</span></label>
							<input type="text" name="city" id="locality" disabled="true" value="<?php echo $user_details->city;?>" required class="md-input" />
					</div>
					 <div class="uk-form-row">
							<label for="state">State<span class="req">*</span></label>
							<input type="text" name="state" id="administrative_area_level_1" disabled="true" value="<?php echo $user_details->state;?>" required class="md-input" />
							<span id="state_error"></span>
					</div>
											
					<div class="uk-form-row">
						<label for="country" class="uk-form-label">Country*</label>
						 <input id="country" name="country" disabled="true" placeholder="Country" value="<?php echo $user_details->location;?>" required class="md-input">
						 <span id="country_error"></span>                                
					</div>
					</div> 
						 <div class="uk-width-medium-1-2">
						 <div class="uk-form-row">
								<label for="sport" class="uk-form-label">Sport*</label>
								<select name="sport" id="sport" required data-md-selectize onchange="selectLevel();selectPosition();">
										<option selected="" value="">Select Sport</option>
										<?php foreach ($sport as  $value) {  ?>                                                                                                                            
												 <option value="<?php echo $value->sportId; ?>"
												 		<?php if($value->sportId==$user_details->sport){
		                              							echo "selected";
		                              						} ?>
												 	><?php echo $value->sportName; ?></option>
										 <?php }   ?>                                                                      
								</select>   
								<span id="sport_error"></span>                                 
						</div>
						<div class="uk-form-row">
								<label for="val_select" class="uk-form-label">Level*</label>
								<select name="level" id="level" required class="form-control">
									 <?php foreach ($sport_level as  $row) {  ?> 
									 	 <option value="<?php echo $row->levelId; ?>"
										 	<?php if($row->levelId==$user_details->level){
                          							echo "selected";
                          						} ?>
										 	><?php echo $row->levelName; ?></option>

								<?php } ?>

								</select>
								 <span id="level_error"></span>  
                                    
						</div>
						<div class="uk-form-row">
								<label for="val_select" class="uk-form-label">Position / Speciality*</label>
								<select name="position" id="position" required class="form-control">
									<?php foreach ($sport_position as  $row) {  ?> 
									 	 <option value="<?php echo $row->positionId; ?>"
										 	<?php if($row->positionId==$user_details->position_speciality){
                          							echo "selected";
                          						} ?>
										 	><?php echo $row->positionName; ?></option>

								<?php } ?>   
								</select>  
								 <span id="position_error"></span>                                  
						</div>
						<div class="uk-form-row">
							<label for="hand" class="uk-form-label">Hand*</label>
							<select name="hand" id="hand" required data-md-selectize>                                    
								<option selected="" value="">Select Hand</option>
								<?php foreach ($hand as  $value) {  ?>                                                                                                                            
										 <option value="<?php echo $value->handId; ?>"
										 	<?php if($value->handId==$user_details->hand){
                          							echo "selected";
                          						} ?>
										 	><?php echo $value->handName; ?></option>

								<?php } ?>
							</select>
							<span id="hand_error"></span>                                          
						</div>
						<div class="uk-form-row">
							<label for="foot" class="uk-form-label">Foot*</label>
							<select id="foot" name="foot" required data-md-selectize>
								 <option selected="" value="">Select Foot</option>
									<?php foreach ($foot as  $value) {  ?>                                                                                                                            
										 <option value="<?php echo $value->footId; ?>"
										 	<?php if($value->footId==$user_details->hand){
                          							echo "selected";
                          						} ?>
                          						><?php echo $value->footName; ?></option>
											<?php } ?>
							</select> 
							<span id="foot_error"></span>  
						</div>
						 <div class="uk-form-row">
							<label for="height" class="uk-form-label">Height*</label>
							 <select name="height" id="height" required data-md-selectize>
									 <option selected="" value="">Select Height</option>
										<?php foreach ($height as  $value) {  ?>                                                                                                                            
									 <option value="<?php echo $value->id; ?>"
									 	<?php if($value->id==$user_details->height){
                              							echo "selected";
                              						} ?>
                              			><?php echo $value->height; ?></option>
									 <?php } ?>
								 </select> 
								 <span id="height_error"></span>              
						</div>
					<div class="uk-form-row">
						<label for="val_select" class="uk-form-label">Weight*</label>
						<select name="weight" id="weight" required data-md-selectize>
							 <option selected="" value="">Select weight</option>
								<?php foreach ($weight as  $value) {  ?>                                                                                                                            
									 <option value="<?php echo $value->id; ?>"
									 	<?php if($value->id==$user_details->weight){
                              							echo "selected";
                              						} ?>
                              						><?php echo $value->weight; ?></option>
									 <?php } ?>
								 </select>
								 <span id="weight_error"></span>  
						</div>
						 
			 <div class="uk-form-row" id="seking">
					<label for="seeking" class="uk-form-label">Seeking*</label><br/>
					<?php foreach ($seeking as $value) { ?>

					<span class="icheck-inline">
							<input type="checkbox" name="seek[]" id="seek_<?php echo $value->id;?>" value="<?php echo $value->id; ?>" class="seek"/>
							<label  class="inline-label"><?php echo $value->seekingName; ?></label>
					</span>
					<?php   }?>
				
					<div class="uk-input-group" id="clg-box" style="display:none;">
							<label>High School Graduation Date</label>
							<input class="md-input" type="text" id="graduation_date" name="graduation_date" value="<?php ?>" data-uk-datepicker="{format:'MMMM ,YYYY'}">
                          <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
					</div>

								
			</div>
			
			<div class="uk-form-row" id="con_u">
					<label for="Who can contact you?" class="uk-form-label">Who can contact you ? :</label><br/>
					<?php foreach ($contact as $value) { ?>
					<span class="icheck-inline">
							<input type="checkbox" name="contact_you[]" id="contact_you_<?php echo $value->id;?>" value="<?php echo $value->id; ?>" class="contact-you"/>
							<label  class="inline-label"><?php echo $value->contact_you; ?></label>
					</span>
					<?php   }?>
			</div>
			 
			 <div class="uk-form-row-find">
					<label for="val_select" class="uk-form-label">How did you find us ?*</label>
					<select name="find" id="find" required data-md-selectize>
							<option selected="" value="">Select..</option>															
							<?php foreach ($find as  $value) {  ?>                                                                                                                            
									 <option value="<?php echo $value->findId; ?>"
									 	<?php if($value->findId==$user_details->find){
                          							echo "selected";
                          						} ?>
                          						><?php echo $value->findName; ?></option>
							<?php } ?>
					</select>                                   
				</div>
						
				
			</div>
		</div>
		<br>
		<div class="uk-width-medium-1">
              <div class="uk-form-row" id="text_a" >
                    <label for="message">Personal Information(Enter Minimum 50 Character)</label>
                    <textarea class="md-input" name="personal_info" id="personal_info" onblur="checkMessage();" > <?php  echo $personal_info; ?> </textarea>
                    <span id="per_msg"></span>
              </div>

               <div class="uk-form-row" id="text_b" >
                    <label for="objective">Objective(Enter Minimum 50 Character)</label>
                    <textarea class="md-input" name="objective" id="objective"  > <?php  echo $objective;; ?> </textarea>
                    <span id="obj_msg"></span>
              </div>
               <div class="uk-form-row">
                    <label for="message">By Signing Up with WeGotPlayers.com and creating your sports player’s profile, you acknowledge that you have read, understood and agreed with our <a href="#" target="_blank">Terms</a> and <a href="#" target="_blank">Privacy</a>.</label>
                </div>  
              <div class="uk-form-row">
                  <button type="button" id="update_profile_btn" name="submit" class="md-btn md-btn-primary adept-md-btn-primary">Submit</button>
              </div>
          </div>
		<!-- </form> -->
	</div>
	</div>
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


$("#update_profile_btn").click(function(){
   		
        var fname = $("#fname").val();        
        var lname = $("#lname").val();
        var username = $("#personal_link").val();
        var gender = $('input[name="gender"]:checked').val();
        var dob= $('input[name="dob"]').val();
        var nationality = $("#nationality").val();
        var address = $("#autocomplete").val();
        var city = $("#locality").val();
           
        var state = $("#administrative_area_level_1").val();
        var country = $("#country").val();
        var zip_code = $("#postal_code").val();

        var sport = $("#sport").val();
        var level = $("#level").val();
        var position = $("#position").val();

        var hand = $("#hand").val();
        var foot = $("#foot").val();
        var height = $("#height").val();
        var weight = $("#weight").val();

        var find = $("#find").val();
        var personal_info=$("#personal_info").val();
        var contact_id = $("#con_u :checkbox:checked").val();        
        var seeking_id = $("#seking :checkbox:checked").val();
        	
        var error_div='<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        
        if(fname.length==0){
          var error_msg="Please fill first name </div>";
          $("#fname_error").html(error_div+error_msg);
        }
        if(lname.length==0){          
          var error_msg ='Please fill last name. </div>';
          $("#lname_error").html(error_div+error_msg);
        }

        if(username.length==0){
        	 var error_msg ='Username field required . </div>';
          $("#link_error").html(error_div+error_msg);
        }
       

        if(nationality==''){
           var error_msg ='Please select nationality.</div>';
          $("#nationality_error").html(error_div+error_msg);
        }
        if(dob==''){
          var error_msg ='Please Enter Date fo birth.</div>';
          $("#dob_error").html(error_div+error_msg);
        }
        if(address==''){
          var error_msg ='Please select Address.</div>';
          $("#address_error").html(error_div+error_msg);
        }
        if(state==''){
          var error_msg ='Please select state.</div>';
          $("#state_error").html(error_div+error_msg);
        }
        if(sport==''){
           var error_msg ='Please select sport.</div>';
          $("#sport_error").html(error_div+error_msg);
        }
        if(level==''){
           var error_msg ='Please select sport level.</div>';
          $("#level_error").html(error_div+error_msg);
        }

        if(position==''){
           var error_msg ='Please select sport position.</div>';
          $("#position_error").html(error_div+error_msg);
        }
        if(hand==''){
           var error_msg ='Please select Hand.</div>';
          $("#hand_error").html(error_div+error_msg);
        }

         if(foot==''){
           var error_msg ='Please select Foot.</div>';
          $("#foot_error").html(error_div+error_msg);
        }
         if(weight==''){
           var error_msg ='Please select Weight.</div>';
          $("#weight_error").html(error_div+error_msg);
        }
        if(height==''){
           var error_msg ='Please select Height.</div>';
          $("#height_error").html(error_div+error_msg);
        }
         else{
        
	         $.ajax({
	                type: 'POST',
	                url: '<?php echo base_url()?>userpersonal/updateProfile',
	                data: {fname:fname,lname:lname,username:username,gender:gender,dob:dob,nationality:nationality,
	                       address:address,city:city,state:state,country:country,zip_code:zip_code,
	                       sport:sport,level:level,position:position,hand:hand,foot:foot,height:height,
	                       weight:weight,find:find,contact_you:contact_id,seek:seeking_id,personal_info:personal_info},
	                success :function(data){
	                	$("#main_tab_target").css({ display: "block" });
                  		$("#sidetab_destination").css({ display: "none" });
                  		$('#personal').html(data);	                  
	                    //var url="<?php echo base_url(); ?>home";
	                    //window.location=url; 
	                    //return false;
	                  }	               
	            })
        	}
  });

function checkMessage(){
    var personal_info=$("#personal_info").val();
    
    if(personal_info!=" "){       
     $("#per_msg").css('color', 'red'); 
     $("#per_msg").append('Enter Personal Information');
    setTimeout(function() {
          $('#per_msg').slideUp('slow');
          },2000);        
        return false;   
  }
  if(personal_info.length<=50){
       $("#per_msg").css('color', 'red'); 
       $("#per_msg").append('Enter Minimum 50 character');
    setTimeout(function() {
          $('#per_msg').slideUp('slow');
          },2000);        
        return false; 
  }
}

function checkUserName()
{
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
				}
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
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/kendoui.custom.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/kendoui.min.js"></script>

 <script>

 $("#dob").kendoDatePicker({
 		 format: "MMMM dd,yyyy"
});



function selectLevel()
  {
      var sport_id = $("#sport").val();
      if(!sport_id==''){
      $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>userdetail/selectLevel',
                data: 'id='+sport_id,
                success :function(levelData){
                  
                  $('#level').html(levelData);
                  return false;
                }
                
            })

        }else{    
                  var data='<option value="" selected="">Select Level</option>';
                  $('#level').empty();
                  $('#position').empty();

                  $('#level').append(data);
                  var data1='<option value="" selected="">Select Position</option>';
                  $('#position').append(data1);
             }
  }

  function selectPosition()
  {
		var sport_id = $("#sport").val();
       	if(!sport_id==''){
      		$.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>userdetail/selectPosition',
                data: 'id='+sport_id,
                success :function(positionData){
                  			$('#position').html(positionData);
                  		return false;
                	}
           		 })
			 }else{    
                  var data='<option value="" selected="">Select Position</option>';
                  $('#position').empty();
                  $('#position').append(data);
             }     

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
