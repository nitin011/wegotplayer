   <div class="ac_am_academic">
     <h4>Tactical</h4>
    <div class="md-card-content">
    	<form id="form_validation" action="<?php echo base_url()?>usertactical/editTactical" method="POST" accept-charset="utf-8" class="uk-form-stacked">
        	<div class="uk-grid" data-uk-grid-margin>            
            	<div class="uk-width-medium-1-4">
                  <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">                  
                   
		                <label for="game_awarness" class="uk-form-label">Game Awarness</label>
		                <select id="game_awarness" name="game_awarness" required data-md-selectize>
                      <?php foreach ($data as $value) { ?>
                           <option value='<?php echo $value; ?>' <?php if(($tact_data->game_awarness)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                      <?php }?>                                       
		                 </select>
                  
                             <label for="overlaps" class="uk-form-label">Overlaps</label>
                                <select id="overlaps" name="overlaps" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($tact_data->overlaps)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                         
                             <label for="decissions_making" class="uk-form-label">Decissions Making</label>
                                <select id="decissions_making" name="decissions_making" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($tact_data->decissions_making)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                       
                             <label for="pressing" class="uk-form-label">Pressing</label>
                                <select id="pressing" name="pressing" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($tact_data->pressing)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                       
                </div>
                <div class="uk-width-medium-1-4">

                             <label for="compactness" class="uk-form-label">Compactness</label>
                                <select id="compactness" name="compactness" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($tact_data->compactness)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                         
                             <label for="possesion" class="uk-form-label">Possesion</label>
                                <select id="possesion" name="possesion" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($tact_data->possesion)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                  
                             <label for="responsivness" class="uk-form-label">Responsivness</label>
                                <select id="responsivness" name="responsivness" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($tact_data->responsivness)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                       
                             <label for="anticipation" class="uk-form-label">Anticipation</label>
                                <select id="anticipation" name="anticipation" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($tact_data->anticipation)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                     </div>
                <div class="uk-width-medium-1-4">                                            
                        
                             <label for="support" class="uk-form-label">Support</label>
                                  <select id="support" name="support" required data-md-selectize>
                                     <?php foreach ($data as $value) { ?>
                                      <option value='<?php echo $value; ?>' <?php if(($tact_data->support)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                    <?php }?>                               
                                 </select>
               
                            <label for="balance" class="uk-form-label">Balance</label>
                                <select id="balance" name="balance" required data-md-selectize>
                                   <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($tact_data->balance)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?>                                    
                             </select>
                       
                            <label for="marking" class="uk-form-label">Marking</label>
                                <select id="marking" name="marking" required data-md-selectize>
                                   <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($tact_data->marking)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?>                                    
                             </select>
                     
                             <label for="covering" class="uk-form-label">Covering</label>
                                <select id="covering" name="covering" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($tact_data->covering)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                         
                 </div>
                <div class="uk-width-medium-1-4">
                    
                             <label for="" class="uk-form-label">Recovery</label>
                                <select id="recovery" name="recovery" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($tact_data->recovery)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                       
                             <label for="transition" class="uk-form-label">Transition</label>
                                <select id="transition" name="transition" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($tact_data->transition)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                
                             <label for="adaptability" class="uk-form-label">Adaptability</label>
                                <select id="adaptability" name="adaptability" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($tact_data->adaptability)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                      
                                                            		                                             
                                         
                                     <div class="uk-form-row">
                                         <button type="submit" class="btn_col btn btn-danger ac_save">Save</button>
                                      <button class="btn btn-primary ac_cancel" id="cancel_tactical" type="button"> Cancel </button>
                                     </div>
                         </div>
                           </form>
                    </div>
                </div>

<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>
<script>
  $("#cancel_tactical").click(function(){
              $("#tactical_view").fadeIn();
              $('#tactical_div').fadeOut();
 });
</script>
