<div class="md-card">
    <div class="md-card-content">
    	<form id="form_validation" action="<?php echo base_url()?>usertechnical/insertTechnical" method="POST" accept-charset="utf-8" class="uk-form-stacked">
        	<div class="uk-grid" data-uk-grid-margin>            
            	<div class="uk-width-medium-1-2">
                  <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">                  
                    <div class="uk-form-row">
		                <label for="technique" class="uk-form-label">Technique</label>
		                <select id="technique" name="technique" required data-md-selectize>
                      <?php foreach ($data as $value) {
                        echo "<option value='$value'>$value<option>";
                      }?>                                       
		                 </select>
                     </div>
                                           
                      <div class="uk-form-row">
	                       <label for="control" class="uk-form-label">Control</label>
	                            <select id="control" name="control" required data-md-selectize>
	                               <?php foreach ($data as $value) {
                                     echo "<option value='$value'>$value<option>";
                                 }?>                              
                             </select>
                       </div>
                                           
                        <div class="uk-form-row">
                            <label for="accuracy" class="uk-form-label">Accuracy</label>
                                <select id="accuracy" name="accuracy" required data-md-selectize>
                                    <?php foreach ($data as $value) {
                                          echo "<option value='$value'>$value<option>";
                                        }?>
                                    
                   			     </select>
                         </div>
                                           
                         <div class="uk-form-row">
                             <label for="dribbling" class="uk-form-label">Dribbling</label>
                                <select id="dribbling" name="dribbling" required data-md-selectize>
                                    <?php foreach ($data as $value) {
                                        echo "<option value='$value'>$value<option>";
                                      }?>
                                   
                   			     </select>
                         </div>
                                           
                         <div class="uk-form-row">
	                           <label for="finishing" class="uk-form-label">Finishing</label>
	                                <select id="finishing" name="finishing" required data-md-selectize>
	                                    <?php foreach ($data as $value) {
                                        echo "<option value='$value'>$value<option>";
                                      }?>
	                                   
	                   			     </select>
                          </div>
                                           
                           <div class="uk-form-row">
	                           <label for="heading" class="uk-form-label">Heading</label>
	                                <select id="heading" name="heading" required data-md-selectize>
	                                    <?php foreach ($data as $value) {
                                          echo "<option value='$value'>$value<option>";
                                        }?>	                                   
	                   			     </select>
                   		   </div>
                                           
                            <div class="uk-form-row">
		                           <label for="long_passing" class="uk-form-label">Long Passing</label>
		                                <select id="long_passing" name="long_passing" required data-md-selectize>
		                                   <?php foreach ($data as $value) {
                                            echo "<option value='$value'>$value<option>";
                                          }?>		                                   
		                   			     </select>
		                   		   </div>
                         </div>
                                           
                          <div class="uk-width-medium-1-2">
                              <div class="uk-form-row">
	                               <label for="val_select" class="uk-form-label">Running</label>
	                                    <select id="running" name="running"  required data-md-selectize>
	                                     <?php foreach ($data as $value) {
                                          echo "<option value='$value'>$value<option>";
                                        }?>
	                       			     </select>
	                       	    </div>
                                <div class="uk-form-row">
                                    <label for="shooting" class="uk-form-label">Shooting</label>
	                                    <select id="shooting" name="shooting"  required data-md-selectize>
	                                       <?php foreach ($data as $value) {
                                              echo "<option value='$value'>$value<option>";
                                            }?>	                                        
	                       			     </select>
                                 </div>
                                           
                              <div class="uk-form-row">
                                   <label for="shielding" class="uk-form-label">Shielding</label>
                                        <select id="shielding" name="shielding" required data-md-selectize>
                                            <?php foreach ($data as $value) {
                                              echo "<option value='$value'>$value<option>";
                                            }?>
                                            
                           			     </select>
                           		   </div>
                                           
                                  <div class="uk-form-row">
                                       <label for="turning" class="uk-form-label">Turning</label>
                                            <select id="turning" name="turning" required data-md-selectize>
                                                <?php foreach ($data as $value) {
                                                      echo "<option value='$value'>$value<option>";
                                                    }?>
                                                
                               			     </select>
                               		   </div>
                                           
                                <div class="uk-form-row">
                                   <label for="defending" class="uk-form-label">Defending</label>
                                        <select id="defending" name="defending" required data-md-selectize>
                                            <?php foreach ($data as $value) {
                                                echo "<option value='$value'>$value<option>";
                                              }?>                                            
                           			     </select>
                           		   </div>
                                           
                                  <div class="uk-form-row">
	                                   <label for="receiving" class="uk-form-label">Receiving</label>
	                                        <select id="receiving" name="receiving" required data-md-selectize>
	                                            <?php foreach ($data as $value) {
                                                echo "<option value='$value'>$value<option>";
                                              }?>	                                           
	                           			     </select>
	                           		   </div>
                                           
                                    <div class="uk-form-row">
                                       <label for="distribution" class="uk-form-label">Distribution</label>
                                            <select id="distribution" name="distribution" required data-md-selectize>
                                               <?php foreach ($data as $value) {
                                                echo "<option value='$value'>$value<option>";
                                              }?>                                                
                               			     </select>
                               		   </div>
                                           
                                   <div class="uk-form-row">
                                       <label for="aerial_control" class="uk-form-label">Aerial Control</label>
                                            <select id="aerial_control" name="aerial_control" required data-md-selectize>
                                                <?php foreach ($data as $value) {
                                                echo "<option value='$value'>$value<option>";
                                              }?>
                               			     </select>
                               		   </div>                               		                                             
                                         
                                     <div class="uk-form-row">
                  <button type="submit" class="md-btn md-btn-primary adept-md-btn-primary">Save</button>
                                     </div>
                         
                           </form>
                    </div>
                </div>
            </div>



<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>

