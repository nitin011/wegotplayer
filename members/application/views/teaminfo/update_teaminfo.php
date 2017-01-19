<div class="md-card">
    <div class="md-card-content">
    	<form  class="uk-form-stacked">
        	<div class="uk-grid" data-uk-grid-margin>            
            	<div class="uk-width-medium-1-2">
                
                                    
                    <div class="uk-form-row">
		                <label for="team_name" class="uk-form-label">Team name</label>
		                <input type="text" id="team_name" name="team_name" value="<?php echo $teaminfo[0]->team_name ;?>" required class="md-input" />
                     </div>
                                           
                      <div class="uk-form-row">
	                       <label for="level" class="uk-form-label">Level</label>
	                            <select id="level2" name="level" required data-md-selectize>
                                <?php foreach ($level as $value) { ?>
                                    <option value="<?php echo $value->levelId; ?>"
                                      <?php 
                                          if($value->levelId==$team_value[0]->level){
                                            echo "selected";
                                          } ?>
                                      ><?php echo $value->levelName; ?></option>
                               <?php  }?>                
                             </select>
                       </div>
                                           
                        <div class="uk-form-row">
                            <label for="competition" class="uk-form-label">Competition</label>
                                <select id="competition" name="competition" required data-md-selectize>
                                   <?php foreach ($competition as $value) { ?>
                                    <option value="<?php echo $value->id; ?>"
                                      <?php 
                                          if($value->id==$team_value[0]->competition){
                                            echo "selected";
                                          } ?>
                                          ><?php echo $value->competition; ?></option>';
                               <?php  }?> 
                   			     </select>
                         </div>
                                           
                         <div class="uk-form-row">
                             <label for="college_playing_eligibility" class="uk-form-label">College Playing Eligibility</label>
                                <select id="college_playing_eligibility" name="college_playing_eligibility" required data-md-selectize>
                                    <?php foreach ($playing_year as $value) { ?>
                                    <option value="<?php echo $value->id; ?>"
                                      <?php 
                                          if($value->id==$team_value[0]->college_playing_eligibility){
                                            echo "selected";
                                          } ?>
                                          ><?php echo $value->year; ?></option>
                               <?php  }?> 
                                   
                   			     </select>
                         </div>
                                           
                         <div class="uk-form-row">
	                           <label for="division" class="uk-form-label">Division</label>
	                                <select id="division" name="division" required data-md-selectize>
	                                   <?php foreach ($division as $value) { ?>
                                    <option value="<?php echo $value->id; ?>"
                                      <?php 
                                          if($value->id==$team_value[0]->division){
                                            echo "selected";
                                          } ?>
                                      ><?php echo $value->division; ?></option>';
                               <?php  }?> 
	                   			     </select>
                          </div>
                                           
                           <div class="uk-form-row">
	                           <label for="team_home_color_uniform" class="uk-form-label">Team home color uniform</label>
	                                <select id="team_home_color_uniform" name="team_home_color_uniform" required data-md-selectize>
	                             <?php foreach ($color as $value) { ?>
                                    <option value="<?php echo $value->id; ?>"
                                      <?php 
                                          if($value->id==$team_value[0]->team_home_uniform){
                                            echo "selected";
                                          } ?>
                                          ><?php echo $value->color; ?></option>';
                               <?php  }?>                                 
	                   			     </select>
                   		   </div>
                                           
                            <div class="uk-form-row">
		                           <label for="team_away_color_uniform" class="uk-form-label">Team away color uniform</label>
		                                <select id="team_away_color_uniform" name="team_away_color_uniform" required data-md-selectize>
		                                <?php foreach ($color as $value) { ?>
                                    <option value="<?php echo $value->id; ?>"
                                      <?php 
                                          if($value->id==$team_value[0]->team_away_color){
                                            echo "selected";
                                          } ?>
                                      ><?php echo $value->color; ?></option>';
                               <?php  }?>                                  
		                   			     </select>
		                   		   </div>
                               <div class="uk-form-row">
                                 <label for="head_coach_full_name" class="uk-form-label">Head Coach Full Name</label>
                                 <input type="text" id="head_coach_full_name" name="head_coach_full_name" value="<?php echo $teaminfo[0]->head_coach_full_name;?>" required class="md-input" />
                              </div>
                         </div>
                                           
                          <div class="uk-width-medium-1-2">
                            
                                <div class="uk-form-row">
                                    <label for="years_playing_for_this_team" class="uk-form-label">Years playing for this team</label>
	                                <select id="years_playing_for_this_team" name="years_playing_for_this_team"  required data-md-selectize>
	                               <?php foreach ($year as $value) { ?>
                                    <option value="<?php echo $value;?>"
                                      <?php 
                                          if($value==$team_value[0]->playing_years){
                                            echo "selected";
                                          } ?>
                                          ><?php echo $value;?></option>';
                               <?php  }?> 	                                        
	                       			     </select>
                                 </div>
                                           
                              <div class="uk-form-row">
                                   <label for="style_of_play" class="uk-form-label">Style of Play</label>
                                   <select id="style_of_play" name="style_of_play" required data-md-selectize>
                                  <?php foreach ($play_style as $value) { ?>
                                    <option value="<?php echo $value->id;?>"
                                      <?php 
                                          if($value->id==$team_value[0]->style_of_play){
                                            echo "selected";
                                          } ?>
                                          ><?php echo $value->play_style;?></option>';
                               <?php  }?>   
                                            
                           			     </select>
                           		   </div>
                                           
                                  <div class="uk-form-row">
                                       <label for="favorite_sports_ground" class="uk-form-label">Favorite Sports Ground</label>
                                       <select id="favorite_sports_ground" name="favorite_sports_ground" required data-md-selectize>
                                              <?php foreach ($sports_ground as $value) { ?>
                                           <option value="<?php echo $value->id;?>"
                                            <?php 
                                          if($value->id==$team_value[0]->favortite_sports_ground){
                                            echo "selected";
                                          } ?>
                                          ><?php echo $value->ground_name;?></option>';
                                            <?php  }?> 
                               			     </select>
                               		   </div>
                                           
                                <div class="uk-form-row">
                                   <label for="coach_phone" class="uk-form-label">Coach Phone</label>
                                   <input type="text" id="coach_phone" name="coach_phone" value="<?php echo $teaminfo[0]->coach_phone;?>" required class="md-input" />
                           		   </div>
                                           
                                  <div class="uk-form-row">
	                                   <label for="coach_email" class="uk-form-label">Coach Email</label>
	                                   <input type="text" id="coach_email" name="coach_email" value="<?php echo $teaminfo[0]->coach_email;?>" required class="md-input" />
	                           		   </div>
                                           
                                    <div class="uk-form-row">
                                       <label for="team_home_address" class="uk-form-label">Team home address</label>
                                       <input type="text" id="team_home_address" name="team_home_address" value="<?php echo $teaminfo[0]->team_home_address;?>"  required class="md-input" />
                               		   </div>
                                           
                                   <div class="uk-form-row">
                                       <label for="team_website" class="uk-form-label">Team Website</label>
                                       <input type="text" id="team_website" name="team_website" value="<?php echo $teaminfo[0]->team_website;?>" required class="md-input" />
                               		   </div>                               		                                             
                                         
                                     <div class="uk-form-row">
                                         <button type="button" id="submit" onclick="updadeTeaminfo()" class="md-btn md-btn-primary adept-md-btn-primary">Save</button>
                                     </div>
                        
                           </form>
                    </div>
                </div>
            </div>
 
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>
<script>
 function updadeTeaminfo(){                
            var team_name=$("#team_name").val();
            var level=$("#level2").val();
            var competition=$("#competition").val();
            var clg_play=$("#college_playing_eligibility").val();
            var division=$("#division").val();
            var home_color=$("#team_home_color_uniform").val();
            var away_color=$("#team_away_color_uniform").val();
            var head_coach=$("#head_coach_full_name").val();
            var years=$("#years_playing_for_this_team").val();
            var play_style=$("#style_of_play").val();
            var fav_sport=$("#favorite_sports_ground").val();
            var coach_phone=$("#coach_phone").val();
            var coach_email=$("#coach_email").val();
            var team_home_address=$("#team_home_address").val();
            var team_website=$("#team_website").val();

             $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>userteaminfo/updateTeaminfo',
              data: { team_name:team_name,level:level,competition:competition,
                      clg_play:clg_play,division:division,home_color:home_color,
                      away_color:away_color,head_coach:head_coach,years:years,
                      play_style:play_style,fav_sport:fav_sport,coach_phone:coach_phone,
                      coach_email:coach_email,team_home_address:team_home_address,
                      team_website:team_website
                    },
            })
          .done(function(data){
             $('#team_info').html(data);
             })
          
    }
</script>

 
