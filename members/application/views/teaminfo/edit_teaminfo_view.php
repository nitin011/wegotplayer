<div class="md-card">
    <div class="md-card-content">
    	<form  action="<?php echo base_url()?>userteaminfo/addTeamInfo" method="POST" accept-charset="utf-8" class="uk-form-stacked">
        	<div class="uk-grid" data-uk-grid-margin>            
            	<div class="uk-width-medium-1-2">
                  <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">                  
                    <div class="uk-form-row">
		                <label for="team_name" class="uk-form-label">Team name</label>
		                <input type="text" name="team_name" required class="md-input" />
                     </div>
                                           
                      <div class="uk-form-row">
	                       <label for="level" class="uk-form-label">Level</label>
	                            <select id="level" name="level" required data-md-selectize>
                                <?php foreach ($level as $value) { ?>
                                    <option value="<?php echo $value->levelId; ?>"><?php echo $value->levelName; ?></option>';
                               <?php  }?>                
                             </select>
                       </div>
                                           
                        <div class="uk-form-row">
                            <label for="competition" class="uk-form-label">Competition</label>
                                <select id="competition" name="competition" required data-md-selectize>
                                   <?php foreach ($competition as $value) { ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->competition; ?></option>';
                               <?php  }?> 
                   			     </select>
                         </div>
                                           
                         <div class="uk-form-row">
                             <label for="college_playing_eligibility" class="uk-form-label">College Playing Eligibility</label>
                                <select id="college_playing_eligibility" name="college_playing_eligibility" required data-md-selectize>
                                    <?php foreach ($playing_year as $value) { ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->year; ?></option>';
                               <?php  }?> 
                                   
                   			     </select>
                         </div>
                                           
                         <div class="uk-form-row">
	                           <label for="division" class="uk-form-label">Division</label>
	                                <select id="division" name="division" required data-md-selectize>
	                                   <?php foreach ($division as $value) { ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->division; ?></option>';
                               <?php  }?> 
	                   			     </select>
                          </div>
                                           
                           <div class="uk-form-row">
	                           <label for="team_home_color_uniform" class="uk-form-label">Team home color uniform</label>
	                                <select id="team_home_color_uniform" name="team_home_color_uniform" required data-md-selectize>
	                                   	 <?php foreach ($color as $value) { ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->color; ?></option>';
                               <?php  }?>                                 
	                   			     </select>
                   		   </div>
                                           
                            <div class="uk-form-row">
		                           <label for="team_away_color_uniform" class="uk-form-label">Team away color uniform</label>
		                                <select id="team_away_color_uniform" name="team_away_color_uniform" required data-md-selectize>
		                                   	 <?php foreach ($color as $value) { ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->color; ?></option>';
                               <?php  }?>                                  
		                   			     </select>
		                   		   </div>
                               <div class="uk-form-row">
                                 <label for="head_coach_full_name" class="uk-form-label">Head Coach Full Name</label>
                                 <input type="text" name="head_coach_full_name" required class="md-input" />
                              </div>
                         </div>
                                           
                          <div class="uk-width-medium-1-2">
                            
                                <div class="uk-form-row">
                                    <label for="years_playing_for_this_team" class="uk-form-label">Years playing for this team</label>
	                                <select id="years_playing_for_this_team" name="years_playing_for_this_team"  required data-md-selectize>
	                                       <?php foreach ($year as $value) { ?>
                                    <option value="<?php echo $value;?>"><?php echo $value;?></option>
                               <?php  }?> 	                                        
	                       			     </select>
                                 </div>
                                           
                              <div class="uk-form-row">
                                   <label for="style_of_play" class="uk-form-label">Style of Play</label>
                                   <select id="style_of_play" name="style_of_play" required data-md-selectize>
                                         <?php foreach ($play_style as $value) { ?>
                                    <option value="<?php echo $value->id;?>"><?php echo $value->play_style;?></option>
                               <?php  }?>   
                                            
                           			     </select>
                           		   </div>
                                           
                                  <div class="uk-form-row">
                                       <label for="favorite_sports_ground" class="uk-form-label">Favorite Sports Ground</label>
                                       <select id="favorite_sports_ground" name="favorite_sports_ground" required data-md-selectize>
                                              <?php foreach ($sports_ground as $value) { ?>
                                           <option value="<?php echo $value->id;?>"><?php echo $value->ground_name;?></option>';
                                            <?php  }?> 
                               			     </select>
                               		   </div>
                                           
                                <div class="uk-form-row">
                                   <label for="coach_phone" class="uk-form-label">Coach Phone</label>
                                   <input type="text" name="coach_phone" required class="md-input" />
                           		   </div>
                                           
                                  <div class="uk-form-row">
	                                   <label for="coach_email" class="uk-form-label">Coach Email</label>
	                                   <input type="text" name="coach_email" required class="md-input" />
	                           		   </div>
                                           
                                    <div class="uk-form-row">
                                       <label for="team_home_address" class="uk-form-label">Team home address</label>
                                       <input type="text" name="team_home_address" required class="md-input" />
                               		   </div>
                                           
                                   <div class="uk-form-row">
                                       <label for="team_website" class="uk-form-label">Team Website</label>
                                       <input type="text" name="team_website" required class="md-input" />
                               		   </div>                               		                                             
                                         
                                     <div class="uk-form-row">
                                         <button type="submit" class="md-btn md-btn-primary adept-md-btn-primary">Save</button>
                                     </div>
                         
                           </form>
                    </div>
                </div>
            </div>

  
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>

 
