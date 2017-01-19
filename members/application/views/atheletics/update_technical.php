<div class="ac_am_academic">
     <h4>Technical</h4>    
     <div class="md-card-content">
    	<form id="form_validation" action="<?php echo base_url()?>usertechnical/editTechnical" method="POST" accept-charset="utf-8" class="uk-form-stacked">
        	<div class="uk-grid" data-uk-grid-margin>            
            	<div class="uk-width-medium-1-4">
                  <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">                  
                
		                <label for="technique" >Technique</label>
		                <select id="technique" name="technique" required data-md-selectize>
                      <?php foreach ($data as $value) { ?>
                           <option value='<?php echo $value; ?>' <?php if(($tech_data->technique)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                      <?php }?>                                       
		                 </select>
                   
	                       <label for="control" >Control</label>
	                            <select id="control" name="control" required data-md-selectize>
	                               <?php foreach ($data as $value) { ?>
                                  <option value='<?php echo $value; ?>' <?php if(($tech_data->control)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                <?php }?>                               
                             </select>
                      
                            <label for="accuracy" >Accuracy</label>
                                <select id="accuracy" name="accuracy" required data-md-selectize>
                                   <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($tech_data->accuracy)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?>                                    
                   			     </select>
                     
                             <label for="dribbling" >Dribbling</label>
                                <select id="dribbling" name="dribbling" required data-md-selectize>
                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($tech_data->dribbling)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
                   			     </select>
                         
                      </div>
                <div class="uk-width-medium-1-4">
                                           
                        
	                           <label for="finishing" >Finishing</label>
	                                <select id="finishing" name="finishing" required data-md-selectize>
	                                    <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($tech_data->finishing)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
	                   			     </select>
                       
	                           <label for="heading" >Heading</label>
	                                <select id="heading" name="heading" required data-md-selectize>
	                                    <?php foreach ($data as $value) { ?>
                                     <option value='<?php echo $value; ?>' <?php if(($tech_data->heading)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 	                                   
	                   			     </select>
                   		 
		                           <label for="long_passing" >Long Passing</label>
		                                <select id="long_passing" name="long_passing" required data-md-selectize>
		                                   <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($tech_data->long_passing)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 	                                   
		                   			     </select>
		                   		
	                               <label for="val_select" >Running</label>
	                                    <select id="running" name="running"  required data-md-selectize>
	                                     <?php foreach ($data as $value) { ?>
                                    <option value='<?php echo $value; ?>' <?php if(($tech_data->running)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                  <?php }?> 
	                       			     </select>
	                       	  
                          </div>
                <div class="uk-width-medium-1-4">
                     
                                    <label for="shooting" >Shooting</label>
	                                    <select id="shooting" name="shooting"  required data-md-selectize>
	                                       <?php foreach ($data as $value) { ?>
                                              <option value='<?php echo $value; ?>' <?php if(($tech_data->shooting)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                        <?php }?>                                        
	                       			     </select>
                         
                                   <label for="shielding" >Shielding</label>
                                        <select id="shielding" name="shielding" required data-md-selectize>
                                            <?php foreach ($data as $value) { ?>
                                              <option value='<?php echo $value; ?>' <?php if(($tech_data->shielding)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                        <?php }?> 
                                            
                           			     </select>
                         
                                       <label for="turning" >Turning</label>
                                            <select id="turning" name="turning" required data-md-selectize>
                                                <?php foreach ($data as $value) { ?>
                                                   <option value='<?php echo $value; ?>' <?php if(($tech_data->turning)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                              <?php }?> 
                               			     </select>
                          
                                   <label for="defending" >Defending</label>
                                        <select id="defending" name="defending" required data-md-selectize>
                                           <?php foreach ($data as $value) { ?>
                                              <option value='<?php echo $value; ?>' <?php if(($tech_data->defending)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                        <?php }?>                                            
                           			     </select>
                           	
                 </div>
                <div class="uk-width-medium-1-4">
                         
	                                   <label for="receiving" >Receiving</label>
	                                        <select id="receiving" name="receiving" required data-md-selectize>
	                                           <?php foreach ($data as $value) { ?>
                                              <option value='<?php echo $value; ?>' <?php if(($tech_data->receiving)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                             <?php }?>                                            
	                           			     </select>
	                        
                                       <label for="distribution" >Distribution</label>
                                            <select id="distribution" name="distribution" required data-md-selectize>
                                              <?php foreach ($data as $value) { ?>
                                                   <option value='<?php echo $value; ?>' <?php if(($tech_data->distribution)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                              <?php }?>                                                 
                               			     </select>
                           
                                       <label for="aerial_control" >Aerial Control</label>
                                            <select id="aerial_control" name="aerial_control" required data-md-selectize>
                                               <?php foreach ($data as $value) { ?>
                                                  <option value='<?php echo $value; ?>' <?php if(($tech_data->aerial_control)==$value){ echo "selected";} ?>><?php echo $value; ?><option>
                                              <?php }?> 
                               			     </select>
                                                             		                                             
                                         
                <div class="uk-form-row pull-right btn_down">
                   <button type="submit" class="btn_col btn btn-danger ac_save">Save</button>
                 <button class="btn btn-primary ac_cancel" id="cancel_technical" type="button"> Cancel </button>
               </div>
                         
                           </form>
                    </div>
                </div>

</div>

<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>

<script>
  $("#cancel_technical").click(function(){
              $("#technical_view").fadeIn();
              $('#technical_div').fadeOut();
 });
</script>


