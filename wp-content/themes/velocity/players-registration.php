<?php /*
Template Name: Players Registration
*/
?>

<?php include('header-signup.php'); 
      include('secondConnection.php');
      ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>




<?php 
      if (has_post_thumbnail( $post->ID ) ): 
         $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') );
        
 else :
        $image = get_bloginfo( 'stylesheet_directory') . '/images/banner-ground.jpg'; 
 endif; 

   ?>

<!-- ******Signup Section****** --> 
<section class="resetpass-section access-section section">
            <div class="container">
                <div class="row">
                    <div class="form-box col-md-10 col-sm-10 col-xs-12 col-md-offset-1">     
                        <div class="form-box-inner">
                            <h2 class="title text-center"><?php the_title(); ?></h2>    
                            <p class="intro">Please enter your details.</p>             
                            <div class="row">
                                <div class="form-container">
                                    <form class="resetpass-form" action="" method="post">              
                                        <div class="form-group">
                                            <label class="form-label">First Name <span>*<span></label>
                                            <input type="text" class="form-control" name="firstname" placeholder="First Name">
                                        </div><!--//form-group-->  
                                        <div class="form-group">
                                            <label class="form-label">Last Name <span>*<span></label>
                                            <input type="text" class="form-control" name="lastname" placeholder="Last Name">
                                        </div><!--//form-group--> 
                                        <div class="form-group">
                                            <label class="form-label">E-mail Address <span>*<span></label>
                                            <input type="email" class="form-control" name="email_address"placeholder="E-mail Address" autocomplete="off">
                                        </div><!--//form-group--> 
                                        <div class="form-group">
                                            <label class="form-label">Password<span>*<span></label>
                                            <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
                                        </div><!--//form-group--> 
                                        <div class="form-group">
                                            <label class="form-label">Password Confirmation <span>*<span></label>
                                            <input type="password" class="form-control" name="confirm_password"placeholder="Password Confirmation">
                                        </div><!--//form-group--> 
                                        <div class="form-group">
                                            <label class="form-label">Gender <span>*<span></label>
                                            <select class="form-control" id="gender" name="gender" onchange="selectGender()">
                                                <option value="" selected>Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                
                                            </select>
                                        </div>

                                         <div class="form-group">
                                            <label class="form-label">Nationality <span>*<span></label>

                                            <?php $newdb = new wpdb( 'weplayer' , 'WegotPlayer!@#$' , 'backall' , 'mysql.wegotplayers.com' );
                                                  $results = $newdb->get_results("SELECT id,nationality FROM  nationalities ORDER BY nationality ASC" );
                                                  
                                                  ?>
                                                  <select class="form-control" id="nationality" name="nationality" >
                                                    <option value="" selected>Select Nationality</option>
                                                  <?php
                                                  foreach ( $results as $na ) {
                                                      echo "<option value=".$na->id.">".$na->nationality."</option>";
                                                }
                                                ?>
                                                                                          
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label">Sport <span>*<span></label>

                                            <?php 
                                                  $results = $newdb->get_results("SELECT sportId,sportName FROM wgp_sports ORDER BY sportName ASC" );

                                                  ?>
                                                  <select class="form-control" name="sports" id="sports" onchange="selectPosition();selectLevel();">
                                                    <option value="" selected>Select Sport</option>
                                                  <?php
                                                  foreach ( $results as $result ) {
                                                      echo "<option value=".$result->sportId.">".$result->sportName."</option>";
                                                }
                                                ?>
                                              </select>
                                                                                           
                                        </div>
                                            <div class="form-group">
                                            <label class="form-label">Level <span>*<span></label>
                                            <select class="form-control" id="level_list" name="level">
                                                <option value="">Select Level</option>
                                                
                                            </select>
                                       </div>
                                            <div class="form-group">
                                            <label class="form-label">Position / Speciality <span>*<span></label>
                                            <select class="form-control" id="position_list" name="position">
                                                <option value="">Position / Speciality</option>
                                            </select> 
                                            </div>

                                              <div class="form-group">
                                            <label class="form-label">Hand <span>*<span></label>
                                            <select class="form-control" name="hand">
                                                <option value=""></option>
                                                <option value="Right">Right</option>
                                                <option value="Left">Left</option>
                                                <option value="Both">Both</option>
                                                

                                            </select> 
                                            </div>

                                              <div class="form-group">
                                            <label class="form-label">Foot <span>*<span></label>
                                            <select class="form-control" name="foot">
                                                <option value=""></option>
                                                <option value="Right">Right</option>
                                                <option value="Left">Left</option>
                                                <option value="Both">Both</option>

                                            </select> 
                                            </div>

                                              <div class="form-group">
                                            <label class="form-label">Height <span>*<span></label>

                                            <?php $newdb = new wpdb( 'weplayer' , 'WegotPlayer!@#$' , 'backall' , 'mysql.wegotplayers.com' );
                                                  $results = $newdb->get_results("SELECT id,height FROM  wgp_heights ORDER BY id ASC" );
                                                  
                                                  ?>
                                                  <select class="form-control" name="height">
                                                    <option value="" selected></option>
                                                  <?php
                                                  foreach ( $results as $height ) {
                                                      echo "<option value=".$height->id.">".$height->height."</option>";
                                                }
                                                ?>
                                              </select> 
                                            </div>

                                              <div class="form-group">
                                            <label class="form-label">Weight <span>*<span></label>
                                            <?php $newdb = new wpdb( 'weplayer' , 'WegotPlayer!@#$' , 'backall' , 'mysql.wegotplayers.com' );
                                                  $results = $newdb->get_results("SELECT id,weight FROM  wgp_weights ORDER BY id ASC" );
                                                  
                                                  ?>
                                                  <select class="form-control" name="weight">
                                                    <option value="" selected></option>
                                                  <?php
                                                  foreach ( $results as $weight ) {
                                                      echo "<option value=".$weight->id.">".$weight->weight."</option>";
                                                }
                                                ?>

                                            </select> 
                                            </div>
                                            <div class="form-group">
                                            <label class="form-label">Seeking <span>*<span></label>
                                                <input type="checkbox" class="checkbox-control" name="seeking" value="1">College scholarship
                                                <input type="checkbox" class="checkbox-control" name="seeking" value="2">Club
                                                <input type="checkbox" class="checkbox-control" name="seeking" value="3">Agent
                                                <input type="checkbox" class="checkbox-control" name="seeking" value="4">Scout
                                                <input type="checkbox" class="checkbox-control" name="seeking" value="5">Team / Organization 
                                                <input type="checkbox" class="checkbox-control" name="seeking" value="6">Lawyer
                                                <input type="checkbox" class="checkbox-control" name="seeking" value="7">Sponsor
                                                <input type="checkbox" class="checkbox-control" name="seeking" value="8">Media
                                             </div><!--//form-group-->
                                             <div class="form-group">
                                            <label class="form-label">Who can contact you? <span>*<span></label>
                                                <input type="checkbox" class="checkbox-control" name="seeking" value="1">College coaches
                                                <input type="checkbox" class="checkbox-control" name="seeking" value="2">Club coaches
                                                <input type="checkbox" class="checkbox-control" name="seeking" value="3">Agents
                                                <input type="checkbox" class="checkbox-control" name="seeking" value="4">Scouts
                                                <input type="checkbox" class="checkbox-control" name="seeking" value="5">Team / Organizations 
                                                <input type="checkbox" class="checkbox-control" name="seeking" value="6">Lawyers
                                                <input type="checkbox" class="checkbox-control" name="seeking" value="7">Sponsors
                                                <input type="checkbox" class="checkbox-control" name="seeking" value="8">Medias
                                                <input type="checkbox" class="checkbox-control" name="seeking" value="8">Event planners
                                                <input type="checkbox" class="checkbox-control" name="seeking" value="8">No One
                                             </div><!--//form-group-->
          
                    <div id="locationField" class="form-group">
                      <label class="form-label">Address<span>*<span></label>
                        <input id="autocomplete" class="form-control" name="address" placeholder="Address" onFocus="geolocate()" type="text"></input>
                   </div>

<table class="player-table">
       <tr>
        <td class="table-lebel">Street address</td>
        <td class=""><input class="" id="street_number" disabled="true" placeholder="Street Address"></input></td>
        <td class=""><input class="field" id="route" disabled="true"></input></td>
      </tr>
      <tr>
        <td class="table-lebel">City</td>
        <td class="" ><input class="field" name="city" id="locality" disabled="true" placeholder="City"></input></td>
      </tr>
      <tr>
        <td class="table-lebel">State</td>
        <td class=""><input class="field" id="administrative_area_level_1" name="state" disabled="true" placeholder="State"></input></td>
       </tr>
      <tr>
        <td class="table-lebel">Zip Code</td>
        <td class=""><input class="field" id="postal_code" name="zip_code" disabled="true" placeholder="Zip Code"></input></td>
      </tr>
      <tr>
        <td class="table-lebel">Country</td>
        <td class="" colspan="3"><input class="field" id="country" name="country" disabled="true" placeholder="Country"></input></td>
      </tr>
</table>

                                            <div class="form-group">
                                            <label class="form-label">Date of Birth <span>*<span></label>
                                            <input type="text" class="form-control" id="calendar" name="dob" placeholder="Date of Birth">
                                        </div><!--//form-group-->

                                     
                                            <div class="form-group">
                                            <label class="form-label">How did you find us? <span>*<span></label>
                                            <?php $newdb = new wpdb( 'weplayer' , 'WegotPlayer!@#$' , 'backall' , 'mysql.wegotplayers.com' );
                                                  $findusResults = $newdb->get_results("SELECT findId,findName FROM  wgp_findings ORDER BY findName ASC" );
                                                  
                                                  ?>
                                                  <select class="form-control" name="findus">
                                                    <option value="" selected></option>
                                                  <?php
                                                  foreach ( $findusResults as $findus ) {
                                                      echo "<option value=".$findus->findId.">".$findus->findName."</option>";
                                                }
                                                ?></select> 
                                            </div>
                                            <p class="lead text-center"> By Signing Up with WeGotPlayers.com and creating your sports recruiter’ profile, you acknowledge that you have read, understood and agreed with our Terms and Privacy.  </p>
                                        <button type="submit" class="btn btn-block btn-cta-primary">Submit</button>
                                    </form>
                                    <p class="lead text-center">Already have an account? <a href="http://www.wegotplayers.com/login">login</a> page</p>
                                </div><!--//form-container-->
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>

<script>   
    $(function() {
         $( "#calendar" ).datepicker();   
    }); 
</script>    
  <script type="text/javascript">
    function selectPosition()
      {
      var sports = document.getElementById("sports").value;
       if(sports!=''){
         
         $.post("<?php echo get_bloginfo('template_directory'); ?>/jquery-fetch-position.php",
          {sports:sports},
          function(data){   
                            if( data != '' ){
                             $( "#position_list" ).empty();                           
                             $( "#position_list" ).append(data);                                 
                            } 
                         }
            );
         
        }else{
           var data=' <div><p>No Position available here.</p></div> ';
           $( "#position_list" ).empty(); 
           $( "#position_list" ).append(data);
        }
 }
</script>
<script type="text/javascript">
    function selectLevel()
      {
      var sports = document.getElementById("sports").value;
       if(sports!=''){
         
         $.post("<?php echo get_bloginfo('template_directory'); ?>/jquery-fetch-level.php",
          {sports:sports},
          function(data){   
                            if( data != '' ){
                             $( "#level_list" ).empty();                           
                             $( "#level_list" ).append(data);                                 
                            }
                         }
            );
         
        }else{
          
           var data=' <div><p>No service center available here.</p></div> ';
           $( "#level_list" ).empty(); 
           $( "#level_list" ).append(data);
        }

     
 }
</script>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

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

    <form method="post">
          <?php   
          global $wpdb;
                  $firstname = $_POST["firstname"];
                  $lastname = $_POST["lastname"];
                  $email_address = $_POST["email_address"];
				  
				
                  $password = $_POST["password"];
                  $confirm_password = $_POST["confirm_password"];
                  $gender = $_POST["gender"];

                  $newdb = new wpdb( 'weplayer' , 'WegotPlayer!@#$' , 'backall' , 'mysql.wegotplayers.com' );
                  $nationality =$_POST['nationality'];
                  $results = $newdb->get_results("SELECT * FROM  `nationalities` where id='$nationality'" );
                  $national = $results[0]->nationality;


                  $sports =$_POST['sports'];
                  $sportsdb = new wpdb( 'weplayer' , 'WegotPlayer!@#$' , 'backall' , 'mysql.wegotplayers.com' );
                  $sportResults = $sportsdb->get_results("SELECT * FROM wgp_sports where sportId='$sports'" );
                  $sportName = $sportResults[0]->sportName;
                
                  $level =$_POST['level'];
                  $leveldb = new wpdb( 'weplayer' , 'WegotPlayer!@#$' , 'backall' , 'mysql.wegotplayers.com' );
                  $levelResults= $leveldb->get_results("SELECT * FROM `wgp_levels` where levelId='$level'"); 
                  $levelName = $levelResults[0]->levelName;

                  $position =$_POST['position'];
                  $positiondb = new wpdb( 'weplayer' , 'WegotPlayer!@#$' , 'backall' , 'mysql.wegotplayers.com' );
                  $positionResults= $positiondb->get_results("SELECT * FROM `wgp_positions` where positionId='$position'"); 
                  $positionValue = $positionResults[0]->positionName;

                  $hand = $_POST["hand"];
                  $foot = $_POST["foot"];

                  $height = $_POST["height"];
                  $heightdb = new wpdb( 'weplayer' , 'WegotPlayer!@#$' , 'backall' , 'mysql.wegotplayers.com' );
                  $heightResults= $heightdb->get_results("SELECT * FROM `wgp_heights` where id='$height'"); 
                 // echo $heightValue = utf8_encode_deep($heightResults[0]->height);
				 // echo $heightValue = base64_encode($heightResults[0]->height);
				  $heightValue =  mysql_real_escape_string($heightResults[0]->height);

                  $weight = $_POST["weight"];
                  $weightdb = new wpdb( 'weplayer' , 'WegotPlayer!@#$' , 'backall' , 'mysql.wegotplayers.com' );
                  $weightResults= $weightdb->get_results("SELECT * FROM `wgp_weights` where id='$weight'"); 
                  $weightValue = $weightResults[0]->weight;

                  $address = $_POST["address"];
                  $zip_code = $_POST["zip_code"];
                  $city = $_POST["city"];
                  $state = $_POST["state"];
                  $country =$_POST['country'];
                  $dob = $_POST["dob"];
				  
                  $findus = $_POST["findus"];
                  $findusdb = new wpdb( 'weplayer' , 'WegotPlayer!@#$' , 'backall' , 'mysql.wegotplayers.com' );
                  $findusResults= $findusdb->get_results("SELECT * FROM `wgp_findings` where findId='$findus'"); 
                  $findusValue = $findusResults[0]->findName;

                  $now = current_time('mysql', false);
                  $epassword = md5($password);
				  
				  
			$sql = "INSERT INTO wp_playerinfo (`firstname`,`lastname`,`email_address`,`password`,`gender`,`nationality`,`sport`,`level`,`position`,`hand`,`foot`,`height`,`weight`,`address`,`pincode`,`city`,`state`,`country`,`dob`,`findus`,create_time)
                VALUES ('$firstname','$lastname','$email_address','$epassword','$gender','$national','$sportName','$levelName','$positionValue','$hand','$foot','$heightValue','$weightValue','$address','$zip_code','$city','$state','$country','$dob','$findusValue','$now');";
             if(!$email_address==""){
					 $wpdb->query($sql);
				  }
           

     ?>
</form>
                            </div><!--//row-->
                        </div><!--//form-box-inner-->
                    </div><!--//form-box-->
                </div><!--//row-->
            </div><!--//container-->
        </section><!--//contact-section-->
    </div><!--//upper-wrapper--><!--//signup-section-->
                

<?php endwhile; endif; ?>  

<?php include('footer.php'); ?>