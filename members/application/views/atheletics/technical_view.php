<div class="md-card">
  	<a class="md-fab md-fab-small md-fab-accent edit" id="edit_tech" name="edit" href="#">
           <i class="material-icons">&#xE150;</i>
    </a>
     <div class="md-card-content">     
		 <div class="uk-grid uk-grid-divider" data-uk-grid-margin>
		 	<input type="hidden" name="user_id" id="user_id" value="<?php echo $wgp_user_id; ?>">
            <div class="uk-width-large-1-3 uk-width-medium-1-2 uk-width-adept">
                <ul class="md-list md-list-adept">
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Game Awarness</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $technique;?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Dribbling</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $dribbling; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Long Passing</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $long_passing; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Shielding</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $shielding; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Receiving</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $receiving; ?></span>
                        </div>
                    </li>


                  </ul>
                  </div>

                  
               <div class="uk-width-large-1-3 uk-width-medium-1-2 uk-width-adept">
                <ul class="md-list md-list-adept">
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Control</span>
                            <span class="uk-text-small content-data content-data content-data-adept"><?php echo $control; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Finishing</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $finishing; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Running</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $running; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Defending</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $defending;  ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Distribution</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $distribution; ?></span>
                        </div>
                    </li>
                 </ul>
             </div>
            <div class="uk-width-large-1-3 uk-width-medium-1-2 uk-width-adept">
                <ul class="md-list md-list-adept">
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Accuracy</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $accuracy; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Heading</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $heading; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Shooting</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $shooting;?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Turning</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $turning; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Aerial Control</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $aerial_control; ?></span>
                        </div>
                    </li>
                 </ul>
             </div>
        </div>
   </div>
    </div>
   </div>




<script>
   $(document).ready(function () {
       $("#edit_tech").click(function () {                
       tab_value=$("#edit_tech").attr("name");
       user_id=$("#user_id").val();
       console.log(tab_value);             
       if(tab_value=="edit") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>usertechnical/updateView',
                      data: {user_id:user_id},
                  })
                .done(function(data){                  
                  $('#technical').html(data);
                })
              }
    });
  });
 </script>