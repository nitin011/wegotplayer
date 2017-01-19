
<div class="md-card profile-overview event_page setting_view2 col-md-12" >
    <div class="md-card-content">
        <div id="page_heading page_heading_leftnone">
            <h1>Account Setting</h1>           
        </div>
     <input type="hidden" id="clicked" value="<?php echo $clicked; ?>"> 

        <div class="row">
          <div class="col-md-3 col-sm-3 col-xs-12">

          <nav class="navbar navbar-inverse">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
              </button>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav nav-tabs">
                <li class="active" id="account_type_tab" name="account_type"><a data-toggle="tab" href="#account_type">Account Type</a></li>
                <li id="plus_fun_tab" name="plus_fun"><a data-toggle="tab" href="#plus_fun">Passcode</a></li>
                <li id="basic_set_tab" name="basic_set"><a data-toggle="tab" href="#basic_setting">Basic Settings</a></li>
                <li id="priv_set_tab" name="priv_set"><a data-toggle="tab" href="#privacy">Privacy settings</a></li>
                <li id="noti_set_tab" name="noti_set"><a data-toggle="tab" href="#notify_set">Notification Settings</a></li>
                <li id="deactivate_tab" name="deactivate"><a data-toggle="tab" href="#deactivate">Deactivate</a></li>
              </ul>
            </div>
          </nav>
          </div>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="tab-content">
              <div id="account_type" class="tab-pane fade in active">
                
              </div>
              <div id="plus_fun" class="tab-pane fade">
                
              </div>
              <div id="basic_setting" class="tab-pane fade">
                
              </div>
              <div id="privacy" class="tab-pane fade">
                
              </div>
              <div id="notify_set" class="tab-pane fade">
                
              </div>
              <div id="deactivate" class="tab-pane fade">
               
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

<?php 



      $count = 0;
if($profile_pic_status==true){
         $count += 5;
      }
      if(!empty($detail)){
          $count += 10;
      }

      if(!empty($personal_info)){
        $count += 5;
      }
     if(!empty($school)){
         $count += 10;  
      }
      if(!empty($teaminfo)){
        $count += 10;
      }

      if(!empty($transcripts_details)){
         $count += 5; 
      }
      if(!empty($stats_details)){
        $count += 5;
      }
      if($photo_album>=1)  {
         $count += 5;
      }
       if($video_count>=1)  {
        $count += 15;
      }    

      if( (!empty($reference)) || (!empty($asked_ref)) )  {
          $count += 10;  
      }
      if(!empty($events)){
        $count += 5;
      }
       if( (!empty($tech_details)) && (!empty($tact_details))
            && (!empty($physical)) && (!empty($psy_details)) )

       {
          $count += 5;
       }
       if(!empty($user_language)){
        $count +=5;
       }
      if(!empty($injur)){
          $count += 5;
      }

  ?>

 <div class="" style="display:none;"> 



 <!--  <div class="ac_am_upgrade_your_profile space">

    <a href="<?php //echo base_url(); ?>pricing" target="_blank" class="ac_am_upgrade_your_profile">

        Upgrade your profile

    </a>   

  </div> -->

  <div class="ac_am_upgrade_your_profile space">

   <a href="<?php echo base_url(); ?>home" class="ac_am_upgrade_your_profile">

        Go to profile

    </a>

  </div>



  <div class="ac_am_profile_strant">

    <h4>Profile Strength</h4>

        <div class="progress">

        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $count; ?>"

            aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $count; ?>%">

        </div>

      </div>



      <span class="sr-only"><?php echo $count; ?>%</span>

          <div class="meter_box">
            <div class="meter_counter" style="bottom: <?php echo ($count-17);?>px;">
              <p><?php 
                  if($count<=30){
                     echo "Starter";
                  }elseif($count>30 && $count<=60){
                   echo 'Star';
              }else if($count>60 && $count <= 80){
                   echo 'All Star';
              }else if($count >80 && $count <100){
                    echo "Super Star";
              }else if($count==100){
                     echo "Champion";
                  }

          ?></p>
              <span></span>
            </div>
          </div>


    

       

        </div>



      



         <ul class="sidebar_menugray" id="side_menu_ul">
  <li><a href="<?php echo base_url().'profile/'.$user_detail->login_name; ?>">View Your Public Profile</a></li>
  <li><a href="<?php echo base_url(); ?>search_controller/searchView">Search</a></li>
  <li><a href="#" onclick="invidePlayer()">Invite Players</a></li>
  <li><a href="#" onclick="shareProfile()">Share Profile</a></li>
</ul>



<script>
$('#side_menu_ul > li').click(function () {
     $(this).addClass('active').siblings('li').removeClass('active');     
  });


function invidePlayer(){
  $.ajax({
          type: 'POST',
          url: '<?php echo base_url(); ?>home/inviteFriends',
          data: {},
      })

    .done(function(data){
          $("#demo_model").trigger('click');
           //$('#event_edit_view').empty().html(data);
          $("#model_content").empty().html(data);
    })
}

function shareProfile(){
    $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>home/shareProfileView',
              data: {},
          })
          .done(function(data){
             $("#demo_model").trigger('click');
               //$('#event_edit_view').empty().html(data);
              $("#model_content").empty().html(data);
        })
}


    $("#side_search").click(function () {             

                $.ajax({

                      type: 'POST',

                      url: '<?php echo base_url(); ?>search_controller/searchView',

                      data: {},

                  })

                .done(function(data){
                      $("#demo_model").trigger('click');
                       //$('#event_edit_view').empty().html(data);
                      $("#model_content").empty().html(data);                 

                })

            });

          


            $("#side_expert_advice").click(function () { 
                  $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>home/expertAdviceView',
                      data: {},
                  })

                .done(function(data){
                      $("#demo_model").trigger('click');
                       //$('#event_edit_view').empty().html(data);
                      $("#model_content").empty().html(data);
                })

           });



</script>




                

            <div class="ac_am_latest_event">

              <h4>Upcoming Events 

                <span type="button" class="glyphicon glyphicon-plus icon_pusbig_orange" data-uk-modal="{target:'#add_event'}"></span>

              </h4>



   <div class="uk-modal" id="add_event">

            <div class="uk-modal-dialog">

                <div class="uk-modal-header">

                    <h3 class="uk-modal-title">Add Event !</h3>

                </div>

          

                <div class="row">   

              <div class="col-md-12 col-sm-12 col-sx-12">            

                     <label class="evn_col" for="event_name">Event Name</label>

                      <input type="text" id="event_name" name="event_name" required class="form-control" />

                </div>

            <div class="col-md-6"> 

                  <label class="evn_col" for="level">Level<span class="event_sps req">*</span></label>

                      <select name="level" id="level" required data-md-selectize>

                              <option value="" selected="">Select Level</option>

                                <?php foreach ($level as  $row) {  ?>                                                                                                                            

                                    <option value="<?php echo $row->levelId; ?>">

                                      <?php echo $row->levelName; ?></option>

                                <?php }   ?>                                      

                          </select>

            </div>



            <div class="col-md-6"> 

                <label class="evn_col" for="event_importance">Event Importance<span class="event_sps req">*</span></label>

                      <select name="event_importance" id="event_importance" required data-md-selectize>

                              <option value="" selected="">Select Event Importance</option>

                                <?php foreach ($event_importance as  $row) {  ?>                                                                                                                            

                                  <option value="<?php echo $row->id; ?>">

                                      <?php echo $row->name; ?></option>

                                <?php }   ?>                                      

                    </select>

            </div>

             

             <div class="col-md-6">

                  <label for="range_start" class="uk-form-label">Event Start:</label>

                  <input id="range_start" />

            </div>



            <div class="col-md-6">

              <label for="range_end" class="uk-form-label">Event End:</label>

                <input id="range_end" />

            </div>

           <div class="col-md-12">

                  <label class="evn_col" for="event_website">Event Website<span class="event_sps req">*</span></label>

                    <input type="text"  id="event_website"  name="event_website" required class="form-control" />

             </div>

             
            <div class="col-md-12 col-sm-12 col-sx-12">

                  <label class="evn_col" for="event_type">Event Type<span class="event_sps req">*</span></label>

                      <select name="event_type" id="event_type" required data-md-selectize>

                              <option value="" selected="">Select Event type</option>

                                <?php foreach ($event_type as  $event_row) {  ?>                                                                                                                            

                                    <option value="<?php echo $event_row->id; ?>">

                                     

                                         <?php echo $event_row->type; ?></option>

                                <?php }   ?>                                      

                          </select>

            </div>

                 <div class="col-md-12">

                  <label class="evn_col" for="location">Location<span class="event_sps req">*</span></label>

                    <input type="text"  id="autocomplete2"  name="location" onFocus="geolocate()" required class="form-control" />

                   

                </div>

                <input type="hidden" id="street_number" disabled="true" placeholder="Street Address">

                 <input type="hidden" id="route" disabled="true" >

                 <input type="hidden" id="postal_code" disabled="true" name="zip_code"/>

                <input type="hidden" name="city" id="locality" disabled="true"  required class="md-input" />

                <input type="hidden" name="state" id="administrative_area_level_1" disabled="true" />

                <input type="hidden" id="country" name="country" disabled="true" placeholder="Country" >

    

                <br>



              </div>

              <!-- end right side -->

         

              <div class="uk-modal-footer uk-text-right">

                    <button type="button"  id="close_add_event" class="btn btn-primary ac_cancel">Close</button>

                    <button type="button" id="save_event" class="btn_col btn btn-danger ac_save">Send</button>

                </div>

            </div>

        </div>


<!-- Demo Content Trigger the modal with a button -->
<button type="button" id="demo_model"  data-toggle="modal" data-target="#myModal" style="display:none;"></button>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <span id="model_content"></span>
      </div>
    </div>

  </div>
</div>

 



<script src="<?php echo base_url(); ?>bower_components/moment/min/moment.min.js"></script> 

<script src="<?php echo base_url(); ?>assets/js/common.min.js"></script>    

<script src="<?php echo base_url(); ?>assets/js/uikit_custom.min.js"></script>   

<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/kendoui.custom.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/pages/kendoui.min.js"></script>

<SCRIPT TYPE="text/javascript">

$(document).ready(function () {

     $("#save_event").click(function (){  
       var name =$("#event_name").val();
       var level =$("#level").val();
       var start_date =$("#range_start").val();
       var website =$("#event_website").val();
       var event_type =$("#event_type").val();
       var event_imp =$("#event_importance").val();
       var end_date =$("#range_end").val();
       var address =$("#autocomplete2").val();

         $.ajax({

                type:'POST',
                url:'<?php base_url() ?>usercalendar/addNewEvent',
                data:{name:name,level:level,start_date:start_date,
                    website:website,event_type:event_type,
                    event_imp:event_imp,end_date:end_date,
                    address:address
                  },

            })

          .done(function(data){             
              var url = "<?php echo base_url(); ?>useraccount";
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

$("#range_start").kendoDateTimePicker({

    format: "M/d/yyyy hh:mm tt"

});

$("#range_end").kendoDateTimePicker({

    format: "M/d/yyyy hh:mm tt"

});

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
            (document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);

        autocomplete2 = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */
            (document.getElementById('autocomplete2')), {
              types: ['geocode']
            });
            autocomplete2.addListener('place_changed', function() {
              fillInAddress(autocomplete2, "2");
            });
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



     <ul class="events">
         <?php if(empty($events)){?>        

           <li> No Upcoming event</li>
        <?php } else if(count($events)>0) {  

             foreach ($events as $key => $row) {                 

         ?>
           <li id="<?php echo $row->wgp_event_id;?>" onclick="getEventDetail(<?php echo $row->wgp_event_id;?>)">
                   <div class="title_titleimage">
                      <img clas="event_image" src="<?php echo base_url(); ?>images/img.jpg"> 
                   </div>
                    <div class="title_titlesystm">
                      <p><?php echo ucwords($row->wgp_event_name); ?></p>
                      <span><?php $date = strtotime($row->wgp_event_start); 
                             echo date('d M, Y',$date);
                       ?> </span>
                       
                    </div>
                   
               </li>

        <?php  } }  ?>

     </ul>

      <i><a href="<?php echo base_url(); ?>event">View All</a></i>

     </div>

 <script type="text/javascript">

     $(document).ready(function(){

      $(".event_edit").hide();

       $("ul.events li").mouseenter(function(){

        var event_id = $(this).attr('id');

           $("#edit_event_"+event_id).show();

      });     

      

     });





     function editEvent(id){

      $.ajax({

            type: 'POST',

            url: '<?php echo base_url(); ?>usercalendar/editEventView',

            data: {event_id:id},

            })

            .done(function(data){

              $("#event_edit_view").html(data);

            });

     }


function getEventDetail(id){
        $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>usercalendar/getEvent',
                data: {event_id:id},
            })

            .done(function(data){
              $("#demo_model").trigger('click');
                       //$('#event_edit_view').empty().html(data);
               $("#model_content").empty().html(data);   
            });

  }
</script>





  

  </div>

   <!-- End of col-md-3 -->

</div>



<!-- Start footer -->

<div class="footer">

    <div class="footer-logo" id="foot-inner">

       <!--  <img src="<?php //echo base_url(); ?>images/wgp-logo.png" style="width:100%">

    </div> -->

    <div class="footer-box">

        <ul> 

            <li class="copyright"><a href="<?php echo base_url(); ?>/home"> © 2016 WeGotPlayers, LLC.</a></li> </ul>      

            </div>

            <div class="footer-box1">

        <ul> 

            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/about/">About</a></li>            

            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/blog/">Blog</a></li>

            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/terms/">Terms</a></li>

            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/privacy-policy/">Privacy</a></li> 

            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/sitemap/">Sitemap</a></li>

            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/help/">Help</a></li>

            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/contact/">Contact</a></li>           

        </ul></div>

    </div>

</div>



<!-- End footer -->







<script>

$("#graduation_date").kendoDatePicker({

  format: "MMMM d,yyyy"

});



$("#enrolment_date").kendoDatePicker({

  format: "MMMM d,yyyy"

});

$("#event_date").kendoDatePicker({

  format: "d-MMMM-yyyy"

});



$("#dob").kendoDatePicker({

  format: "d-MM-yyyy"

});





</script>


<script src="<?php echo base_url(); ?>assets/js/common.min.js"></script>    
<script src="<?php echo base_url(); ?>assets/js/uikit_custom.min.js"></script>   
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>
<script>

$(document).ready(function () { 

         $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url(); ?>useraccount/accountTypeView',
                  data: {},
              })
                .done(function(data){                  
                  $('#account_type').html(data);
                })


      var clicked = $("#clicked").val();
       console.log(clicked);

 
   $("li#account_type_tab").click(function(){
	   
	   $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url(); ?>useraccount/accountTypeView',
                  data: {},
              })
                .done(function(data){                  
                  $('#account_type').html(data);
                })  ;
	   
   });
                
           
            $("li#plus_fun_tab").click(function(){
				 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount/plusFunctions',
                      data: {},
                  })
                .done(function(data){                  
                  $('#plus_fun').html(data);
                })  

			});
          
              
            $("#basic_set_tab").click(function(){
            $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount/basicSetingView',
                      data: {},
                  })
                .done(function(data){
                  $('#basic_setting').html(data);
                }) 
      });
               
            $("#priv_set_tab").click(function(){
            $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount/privacySettingView',
                      data: {},
                  })
                .done(function(data){
                 
                  $('#privacy').html(data);
                })  
     });
              
            $("#noti_set_tab").click(function(){
            $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount/notifySettingView',
                      data: {},
                  })
                .done(function(data){                
                  $('#notify_set').html(data);
                })  
      });
            
            $("#deactivate_tab").click(function(){
             $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount/deactivateView',
                      data: {},
                  })
                .done(function(data){                  
                  $('#deactivate').html(data);
                }) 
      });
	  /*else{
          $("#account_type_tab").trigger("click"); 
      }*/

         $("#account_setting li").click(function () {                
                var tab_value=$(this).attr('name');
              

              if(tab_value=="account_type") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount/accountTypeView',
                      data: {},
                  })
                .done(function(data){
                  
                  $('#account_type').html(data);
                })
              }

              if(tab_value=="plus_fun") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount/plusFunctions',
                      data: {},
                  })
                .done(function(data){                  
                  $('#plus_fun').html(data);
                })
              }

               if(tab_value=="basic_set") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount/basicSetingView',
                      data: {},
                  })
                .done(function(data){
                  $('#basic-setting').html(data);
                })
              }

              if(tab_value=="priv_set") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount/privacySettingView',
                      data: {},
                  })
                .done(function(data){
                 
                  $('#privacy').html(data);
                })
              }
              if(tab_value=="noti_set") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount/notifySettingView',
                      data: {},
                  })
                .done(function(data){                
                  $('#notify_set').html(data);
                })
              }
              if(tab_value=="deactivate") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount/deactivateView',
                      data: {},
                  })
                .done(function(data){                  
                  $('#deactivate').html(data);
                })
              }
              
   });
}); 
</script>