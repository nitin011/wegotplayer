<div class="ac_am_academic">
     <h4>Psyhosocial</h4>  
    <div class="md-card-content">
    	<form id="form_validation" action="<?php echo base_url()?>userpsyhosocial/updatePsyhosocial" method="POST" accept-charset="utf-8" class="uk-form-stacked">
        	<div class="uk-grid" data-uk-grid-margin>           
            	<div class="uk-width-medium-1-4">
                  <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">                  
                   
		                <label for="attitude" >Attitude</label>
		                <select id="attitude" name="attitude" required data-md-selectize>
                      <?php foreach ($data as $value) { ?>
                           <option value='<?php echo $value; ?>' <?php if(($psy_data->attitude)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                      <?php }?>                                       
		                 </select>
                
                             <label for="self_confidence" >Self Confidence</label>
                                <select id="self_confidence" name="self_confidence" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($psy_data->self_confidence)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                   
                             <label for="honesty" >Honesty</label>
                                <select id="honesty" name="honesty" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($psy_data->honesty)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                  
                             <label for="cooperation" >Cooperation</label>
                                <select id="cooperation" name="cooperation" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($psy_data->cooperation)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                       
                      </div>
                    <div class="uk-width-medium-1-4">       	   
                    
                             <label for="communication" >Communication</label>
                                <select id="communication" name="communication" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($psy_data->communication)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                      
                             <label for="competitivness" >Competitivness</label>
                                <select id="competitivness" name="competitivness" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($psy_data->competitivness)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                
                             <label for="passion" >Passion</label>
                                <select id="passion" name="passion" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($psy_data->passion)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                         
                             <label for="discipline" >Discipline</label>
                                <select id="discipline" name="discipline" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($psy_data->discipline)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                        
                    </div>
                    <div class="uk-width-medium-1-4">
                                                             
                      
                             <label for="focus" >Focus</label>
                                  <select id="focus" name="focus" required data-md-selectize>
                                     <?php foreach ($data as $value) { ?>
                                      <option value='<?php echo $value; ?>' <?php if(($psy_data->focus)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                    <?php }?>                               
                                 </select>
                       
                            <label for="leadership" >Leadership</label>
                                <select id="leadership" name="leadership" required data-md-selectize>
                                   <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($psy_data->leadership)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?>                                    
                             </select>
                 
                            <label for="vision" >Vision</label>
                                <select id="vision" name="vision" required data-md-selectize>
                                   <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($psy_data->vision)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?>                                    
                             </select>
                     
                             <label for="respect" >Respect</label>
                                <select id="respect" name="respect" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($psy_data->respect)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                        
                    </div>
                    <div class="uk-width-medium-1-4">
                       
                             <label for="character" >Character</label>
                                <select id="character" name="character" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($psy_data->character)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                    
                             <label for="motivation" >Motivation</label>
                                <select id="motivation" name="motivation" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($psy_data->motivation)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                      
                             <label for="trustworthiness" >Trustworthiness</label>
                                <select id="trustworthiness" name="trustworthiness" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($psy_data->trustworthiness)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                             </select>
                               
                           <div class="uk-form-row pull-right btn_down">
                               <button type="submit" class="btn_col btn btn-danger ac_save">Save</button>
                              <button class="btn btn-primary ac_cancel" id="cancel_psyhosoical" type="button"> Cancel </button>
                           </div>
                         
                           </form>
                    </div>
                </div>

</div>
    
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>

<script>
  $("#cancel_psyhosoical").click(function(){
      $("#psychosocial_view").fadeIn();
      $('#psychosocial_div').fadeOut();
 });
</script>