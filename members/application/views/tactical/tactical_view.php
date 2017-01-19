 <div class="md-card">
  	<a class="md-fab md-fab-small md-fab-accent edit" id="edit_tact" name="edit" href="#">
           <i class="material-icons">&#xE150;</i>
    </a>
     <div class="md-card-content">     
		 <div class="uk-grid uk-grid-divider" data-uk-grid-margin>
            <div class="uk-width-large-1-3 uk-width-medium-1-2 uk-width-adept">
                <ul class="md-list md-list-adept">
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Game Awarness</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $game_awarness;?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Balance</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $balance; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Pressing</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $pressing; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Possesion</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $possesion; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Adaptability</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $adaptability; ?></span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="uk-width-large-1-3 uk-width-medium-1-2 uk-width-adept">
                <ul class="md-list md-list-adept">
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Support</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $support; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Decissions Making</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $decissions_making; ?>.</span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Compactness</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $compactness; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Transition</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $transition; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Anticipation</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $anticipation; ?></span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="uk-width-large-1-3 uk-width-medium-1-2 uk-width-adept">
                <ul class="md-list md-list-adept">
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Overlaps</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $overlaps; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Marking</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $marking; ?>.</span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Recovery</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $recovery;?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Responsivness</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $responsivness;  ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Covering</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $covering; ?></span>
                        </div>
                    </li>
                </ul>
            </div>
<input type="hidden" name="user_id" id="user_id" value="<?php echo $wgp_user_id; ?>">
                        
        </div>
                         
    </div>
</div>

<script>
   $(document).ready(function () {
       $("#edit_tact").click(function () {                
       tab_value=$("#edit_tact").attr("name");
       user_id=$("#user_id").val();
       console.log(tab_value);             
       if(tab_value=="edit") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>usertactical/updateView',
                      data: {user_id:user_id},
                  })
                .done(function(data){                  
                  $('#tactical').html(data);
                })
              }
    });
  });
 </script>