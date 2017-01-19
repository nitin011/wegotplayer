<div class="uk-width-medium-1">
    <div class="md-card md-card-hover md-card-overlay">        
       <div class="md-card-content truncate-text">
             <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
              <div class="uk-width-xLarge-8-10 ">              	
                 <div class="md-card">
                 	
                    <div class="md-card-toolbar">
                    	<div class="user_heading_menu" data-uk-dropdown>                              
                        <a class="md-fab md-fab-small md-fab-accent" id="edit_profile" name="edit" href="#">
                            <i class="material-icons">&#xE150;</i>
                          </a>
                         </div>
                     
                    </div>
                    <img src="<?php echo base_url();?>assets/img/spinners/spinner.gif" id="loader" alt="" width="32" height="32">
                    <div class="md-card-content large-padding">
                        <div class="uk-grid uk-grid-divider uk-grid-medium">
                           <div class="uk-width-large-1-2">
                             
                                    
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Name</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $coach->first_name.' '.$coach->last_name; ?></span>
                                        </div>
                                    </div>
                                    <hr class="">                                  
                                    
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">E-mail address</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <?php echo $email; ?>
                                        
                                        </div>
                                    </div>
                                     <hr class="">
                                     <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Address</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $coach->address; ?></a></span>
                                        </div>
                                    </div>                                
                                    <hr class="">
                                     <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">City</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <?php echo $coach->city; ?>
                                        
                                        </div>
                                    </div>
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">State</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <?php echo $coach->state; ?>
                                        
                                        </div>
                                    </div>
                                     <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Conuntry</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $coach->location; ?></span>
                                        </div>
                                    </div>                                
                                    <hr class="">
                                    <hr class="uk-grid-divider uk-hidden-large">
                                </div>
                                <div class="uk-width-large-1-2">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Sport</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $coach->sports; ?></span>
                                        </div>
                                    </div>                                
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Level</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $coach->level; ?></span>
                                        </div>
                                    </div>                                
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Your Org / Team Name</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $coach->team; ?></a></span>
                                        </div>
                                    </div>                                
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Recruiter’s Occupation</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $coach->occupation; ?></a></span>
                                        </div>
                                    </div>
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">What Gender You Coach</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle">
                                                <?php foreach ($gender as $key => $value) {                                                   
                                                    if($key==$coach->coaching_gender){
                                                        echo $value;
                                                    }
                                                }
                                                ?></span>
                                        </div>
                                    </div>                                
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Website</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $coach->website; ?></span>
                                        </div>
                                    </div>                                
                                    <hr class="">
                                    
                                    
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>                       

        </div>
                                  
    </div>

</div>

  <script>

   $(document).ready(function () {
    $('#loader').hide();
       $("#edit_profile").click(function () {                
       tab_value=$("#edit_profile").attr("name");
       console.log(tab_value);
       if(tab_value=="edit") {
            $('#loader').show();            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>recruiter/updateProfileView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $('#loader').hide();                  
                  $('#personal').html(data);
                })
              }
   });
  });

  </script>



