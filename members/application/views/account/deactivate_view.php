<div class="md-card">
   <div class="md-card-content">
		<h3>Deactivate Your Profile</h3>
		<div class="uk-grid" data-uk-grid-margin="" id="unique_section">
      <div class="uk-width-large-1 uk-width-medium-1">            
        <span class="deactivate_status" style="color:#444;"></span>
           <div class="uk-input-group">
              <div class="md-input-wrapper">
						     <button class="md-btn md-btn-danger" id="deactivate_button" type="button">Deactivate</button> 
					 </div>                
          </div>
         </div>           
        </div>
    </div>
</div>

<script>
  $(document).ready(function () {
    $("#deactivate_button").click(function () {                
          $.ajax({
                   type: 'POST',
                   url: '<?php echo base_url(); ?>useraccount/deactivateId',       
                   data: {},
                  })
            .done(function(data){  
              if(data==1){                          
                   $('.deactivate_status').show();
                   $('.deactivate_status').text("Your profile has been deactivated. You can enable your profile any time you login.");
                   setTimeout(function() {
                       $('.deactivate_status').slideUp('slow');
                     },5000); 
                      $.ajax({
                            type: 'POST',
                            url: '<?php echo base_url(); ?>user/logout',       
                           data: {},
                        })      
                      return false
                 }
                 else{

                 }
              })
        });
  });
</script>