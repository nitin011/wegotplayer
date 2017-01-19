<div class="uk-width-medium-1" id="team-info">
    <div class="md-card md-card-hover md-card-overlay">        
       <div class="md-card-content truncate-text">
             <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
              <div class="uk-width-xLarge-8-10 ">               
                 <div class="md-card">
                  
                    <div class="md-card-toolbar">
                      <div class="user_heading_menu" data-uk-dropdown>                              
                        <a class="md-fab md-fab-small md-fab-accent" id="edit_teaminfo" onclick="editRow(<?php echo $teaminfo[0]->wgp_user_id; ?>)" name="edit" href="#">
                            <i class="material-icons">&#xE150;</i>
                          </a>
                         </div>
                      <h3 class="md-card-toolbar-heading-text"> TEAM INFO </h3>
                    </div>
                    <div class="md-card-content large-padding">
                        <div class="uk-grid uk-grid-divider uk-grid-medium">
                           <div class="uk-width-large-1-2">
                              <div class="uk-grid uk-grid-small">
                                  <div class="uk-width-large-1-3">
                                      <span class="uk-text-muted uk-text-small">Team name</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $teaminfo[0]->team_name ;?></a></span>
                                        </div>
                                    </div>
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                  <div class="uk-width-large-1-3">
                                      <span class="uk-text-muted uk-text-small">Competition</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $teaminfo[0]->competition; ?></a></span>
                                        </div>
                                    </div>
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Division</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $teaminfo[0]->division ?></span>
                                        </div>
                                    </div>
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Team away color uniform</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                           <span class="uk-text-large uk-text-middle"><?php echo $teaminfo[0]->team_away_color ?></span>
                                        </div>
                                    </div>
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Years playing for this team</span>
                                        </div>
                                        <div class="uk-width-large-2-3"> 
                                            <span class="uk-text-large uk-text-middle"><?php echo $teaminfo[0]->playing_years; ?></span>
                                        </div>
                                    </div>
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Favorite Sports Ground</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                           <span class="uk-text-large uk-text-middle"> <?php echo $teaminfo[0]->favortite_sports_ground; ?></span>
                                        
                                        </div>
                                    </div>
                                     <hr class="">
                                     <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Coach Email</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <?php echo $teaminfo[0]->coach_email; ?>
                                        
                                        </div>
                                    </div>
                                     <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Team Website</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $teaminfo[0]->team_website; ?></span>
                                        </div>
                                    </div>                                
                                    <hr class="">
                                    <hr class="uk-grid-divider uk-hidden-large">
                                </div>
                                <div class="uk-width-large-1-2">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Level</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $teaminfo[0]->level; ?></span>
                                        </div>
                                    </div>                                
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">College Playing Eligibility</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $teaminfo[0]->college_playing_eligibility; ?></span>
                                        </div>
                                    </div>                                
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Team home color uniform</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $teaminfo[0]->team_home_uniform; ?></a></span>
                                        </div>
                                    </div>                                
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Head Coach Full Name</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $teaminfo[0]->head_coach_full_name; ?></span>
                                        </div>
                                    </div>                                
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Style of Play</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $teaminfo[0]->style_of_play; ?></span>
                                        </div>
                                    </div>                                
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Coach Phone</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $teaminfo[0]->coach_phone; ?></a></span>
                                        </div>
                                    </div>                                
                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Team home address</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $teaminfo[0]->team_home_address; ?></a></span>
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
 function  editRow(id){
    $("#team-info").hide();
    
    var row_id= id;
    $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>userteaminfo/updateTeamView',
              data: {edit:row_id},
            })
          .done(function(data){
             $('#team_info').html(data);
          });
    }

    </script>

