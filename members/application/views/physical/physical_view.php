 <div class="md-card">
  	<a class="md-fab md-fab-small md-fab-accent edit" id="edit_physical" name="edit" href="#">
           <i class="material-icons">&#xE150;</i>
    </a>
     <div class="md-card-content">     
		 <div class="uk-grid uk-grid-divider" data-uk-grid-margin>
		 	<input type="hidden" name="user_id" id="user_id" value="<?php echo $wgp_user_id; ?>">
            <div class="uk-width-large-1-3 uk-width-medium-1-2 uk-width-adept">
                <ul class="md-list md-list-adept">
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Acceleration</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $acceleration;?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Coordination</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $coordination; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Jumping</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $jumping; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Strength</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $strength; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Quickness</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $quickness; ?></span>
                        </div>
                    </li>


                  </ul>
                  </div>

                  
               <div class="uk-width-large-1-3 uk-width-medium-1-2 uk-width-adept">
                <ul class="md-list md-list-adept">
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Agility</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $agility; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Reaction</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $reaction; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Flexibility</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $flexibility;?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Power</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $power;  ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Basic Motor Skills</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $basic_motor_skills; ?></span>
                        </div>
                    </li>
                 </ul>
             </div>
            <div class="uk-width-large-1-3 uk-width-medium-1-2 uk-width-adept">
                <ul class="md-list md-list-adept">
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Balance</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $balance; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Speed</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $speed; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Endurance</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $endurance; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Mobility</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $mobility; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Explosivness</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $explosivness; ?></span>
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
       $("#edit_physical").click(function () {                
       tab_value=$("#edit_physical").attr("name");
       user_id=$("#user_id").val();
       console.log(tab_value);             
       if(tab_value=="edit") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userphysical/updateView',
                      data: {user_id:user_id},
                  })
                .done(function(data){                  
                  $('#physical').html(data);
                })
              }
    });
  });
 </script>