 <div class="md-card">
    <div class="md-card-content">
    	<h3>Notification Settings</h3>
    	<p>You can set up what notifications will be forwarder to your e-mail address.</p>
    		<div class="uk-grid" data-uk-grid-margin="">
          <from id="noti_form" class="uk-width-1">
           
              
              	   <?php    print_r($notifiy);  ?>                
					

                <div class="uk-width-1">
                   <div class="">
                 		  <button class="md-btn md-btn-primary adept-md-btn-primary" type="button" id="save_notifiy">Save</button> 
          			 </div>                
          	 </div>
        
       </form>
      </div>	
      <span id="noti_success_msg"> </span>
    </div>
  </div>

  <script>
  $(document).ready(function () {
      $("#save_notifiy").click(function () { 
       /* var yes = new Array();
        for(i=1;i<=14;i++)
        {
            var yes_data = $('input[type=radio][name='+i+']:checked').val();
            yes.push('notification_id_'+i+':'+yes_data);                 
        }  */

         var notification_id_1 = $('input[type=radio][name='+1+']:checked').val();
         var notification_id_2 = $('input[type=radio][name='+2+']:checked').val();
         var notification_id_3 = $('input[type=radio][name='+3+']:checked').val();
         var notification_id_4 = $('input[type=radio][name='+4+']:checked').val();
         var notification_id_5 = $('input[type=radio][name='+5+']:checked').val();
         var notification_id_6 = $('input[type=radio][name='+6+']:checked').val();
         var notification_id_7 = $('input[type=radio][name='+7+']:checked').val();
         var notification_id_8 = $('input[type=radio][name='+8+']:checked').val();
         var notification_id_9 = $('input[type=radio][name='+9+']:checked').val();
         var notification_id_10 = $('input[type=radio][name='+10+']:checked').val();
         var notification_id_11 = $('input[type=radio][name='+11+']:checked').val();
         var notification_id_12 = $('input[type=radio][name='+12+']:checked').val();
         var notification_id_13 = $('input[type=radio][name='+13+']:checked').val();
         var notification_id_14 = $('input[type=radio][name='+14+']:checked').val();
       
        $.ajax({
               type: 'POST',
               url: '<?php echo base_url(); ?>useraccount/updateNotification',
               data: {notification_id_1:notification_id_1,
                      notification_id_2:notification_id_2,
                      notification_id_3:notification_id_3,
                      notification_id_4:notification_id_4,
                      notification_id_5:notification_id_5,
                      notification_id_6:notification_id_6,
                      notification_id_7:notification_id_7,
                      notification_id_8:notification_id_8,
                      notification_id_9:notification_id_9,
                      notification_id_10:notification_id_10,
                      notification_id_11:notification_id_11,
                      notification_id_12:notification_id_12,
                      notification_id_13,notification_id_13,
                      notification_id_14,notification_id_14
                    },
               })
                .done(function(data){
                  $("#noti_success_msg").html(data);
            })
           
      });
   });
  </script>
