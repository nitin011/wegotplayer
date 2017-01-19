 <div class="ac_am_academic">
     <h4>Physical</h4> 
    <div class="md-card-content">
      <form id="form_validation" action="<?php echo base_url()?>userphysical/updatePhysical" method="POST" accept-charset="utf-8" class="uk-form-stacked">
          <div class="uk-grid" data-uk-grid-margin>            
              <div class="uk-width-medium-1-4">
                  <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">                  
               
                    <label for="acceleration" >Acceleration</label>
                    <select id="acceleration" name="acceleration" required data-md-selectize>
                      <?php foreach ($data as $value) { ?>
                           <option value='<?php echo $value; ?>' <?php if(($phys_data->acceleration)==$value){ echo "selected";} ?>><?php echo $value; ?></option>
                      <?php }?>                                       
                     </select>
                  
                             <label for="agility" >Agility</label>
                                <select id="agility" name="agility" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($phys_data->agility)==$value){ echo "selected";} ?>><?php echo $value; ?></option>
                                  <?php }?> 
                             </select>
                    
                             <label for="balance" >Balance</label>
                                <select id="balance" name="balance" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($phys_data->balance)==$value){ echo "selected";} ?>><?php echo $value; ?></option>
                                  <?php }?> 
                             </select>
                        
                             <label for="coordination" >Coordination</label>
                                <select id="coordination" name="coordination" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($phys_data->coordination)==$value){ echo "selected";} ?>><?php echo $value; ?></option>
                                  <?php }?> 
                             </select>
                        
              </div>
                <div class="uk-width-medium-1-4">

                             <label for="reaction" >Reaction</label>
                                <select id="reaction" name="reaction" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($phys_data->reaction)==$value){ echo "selected";} ?>><?php echo $value; ?></option>
                                  <?php }?> 
                             </select>
                        
                             <label for="speed" >Speed</label>
                                <select id="speed" name="speed" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($phys_data->speed)==$value){ echo "selected";} ?>><?php echo $value; ?></option>
                                  <?php }?> 
                             </select>
                        
                             <label for="jumping" >Jumping</label>
                                <select id="jumping" name="jumping" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($phys_data->jumping)==$value){ echo "selected";} ?>><?php echo $value; ?></option>
                                  <?php }?> 
                             </select>
                        
                             <label for="strength" >Strength</label>
                                <select id="strength" name="strength" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($phys_data->strength)==$value){ echo "selected";} ?>><?php echo $value; ?></option>
                                  <?php }?> 
                             </select>
                       
                         
                               
                </div>
                <div class="uk-width-medium-1-4">

                             <label for="flexibility" >Flexibility</label>
                                  <select id="flexibility" name="flexibility" required data-md-selectize>
                                     <?php foreach ($data as $value) { ?>
                                      <option value='<?php echo $value; ?>' <?php if(($phys_data->flexibility)==$value){ echo "selected";} ?>><?php echo $value; ?></option>
                                    <?php }?>                               
                                 </select>
                        
                            <label for="explosivness" >Explosivness</label>
                                <select id="explosivness" name="explosivness" required data-md-selectize>
                                   <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($phys_data->explosivness)==$value){ echo "selected";} ?>><?php echo $value; ?></option>
                                  <?php }?>                                    
                             </select>
                      
                            <label for="endurance" >Endurance</label>
                                <select id="endurance" name="endurance" required data-md-selectize>
                                   <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($phys_data->endurance)==$value){ echo "selected";} ?>><?php echo $value; ?></option>
                                  <?php }?>                                    
                             </select>
                     
                             <label for="quickness" >Quickness</label>
                                <select id="quickness" name="quickness" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($phys_data->quickness)==$value){ echo "selected";} ?>><?php echo $value; ?></option>
                                  <?php }?> 
                             </select>
                        

                   </div>
                <div class="uk-width-medium-1-4">
                     
                             <label for="power" >Power</label>
                                <select id="power" name="power" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($phys_data->power)==$value){ echo "selected";} ?>><?php echo $value; ?></option>
                                  <?php }?> 
                             </select>
                     
                             <label for="basic_motor_skills" >Basic Motor Skills</label>
                                <select id="basic_motor_skills" name="basic_motor_skills" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($phys_data->basic_motor_skills)==$value){ echo "selected";} ?>><?php echo $value; ?></option>
                                  <?php }?> 
                             </select>
                       
                             <label for="mobility" >Mobility</label>
                                <select id="mobility" name="mobility" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($phys_data->mobility)==$value){ echo "selected";} ?>><?php echo $value; ?></option>
                                  <?php }?> 
                             </select>
                               
                           <div class="uk-form-row pull-right btn_down">
                               <button type="submit" class="btn_col btn btn-danger ac_save">Save</button>
                               <button class="btn btn-primary ac_cancel" id="cancel_physical" type="button"> Cancel </button>
                           </div>
                         
                           </form>
                    </div>
                </div>

</div>

<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>

<script>
  $("#cancel_physical").click(function(){
              $("#physical_view").fadeIn();
              $('#physical_div').fadeOut();
 });
</script>