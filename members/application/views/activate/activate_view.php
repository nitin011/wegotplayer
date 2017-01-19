<div class="md-card" id="log-view">
    <div class="md-card-content">

     <h2>Your profile is deactivated!</h2>
     <div class="uk-grid" data-uk-grid-margin="" id="unique_section">
      <div class="uk-width-large-1 uk-width-medium-1">            
        <p> The main functions of the site is unavailable for you until you re-activate your profile. Please click on the button below to activate your profile. </p>

           <div class="uk-input-group">
              <div class="md-input-wrapper">
				  <button class="md-btn md-btn-primary adept-md-btn-primary" id="activate_button" type="button">Activate</button> 
			</div>                
          </div>
         </div>           
        </div>

    </div>
 </div>
 <script>
  $(document).ready(function () {
    $("#activate_button").click(function () {                
          $.ajax({
                   type: 'POST',
                   url: '<?php echo base_url(); ?>useraccount/activateProfile',       
                   data: {},
                  })
            .done(function(data){
            	$("#log-view").html(data);
            })
        });
});

 </script>