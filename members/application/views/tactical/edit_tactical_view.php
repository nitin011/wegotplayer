<div class="md-card">
    <div class="md-card-content">
    	<form id="form_validation" action="<?php echo base_url()?>usertactical/insertTactical" method="POST" accept-charset="utf-8" class="uk-form-stacked">
        	<div class="uk-grid" data-uk-grid-margin>            
            	<div class="uk-width-medium-1-2">
                  <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">                  
                    <div class="uk-form-row">
		                <label for="game_aware" class="uk-form-label">Game Awarness</label>
		                <select id="game_aware" name="game_aware" required data-md-selectize>
                      <?php foreach ($data as $value) {
                        echo "<option value='$value'>$value<option>";
                      }?>                                       
		                 </select>
                     </div>
                                           
                      <div class="uk-form-row">
	                       <label for="support" class="uk-form-label">Support</label>
	                            <select id="support" name="support" required data-md-selectize>
	                               <?php foreach ($data as $value) {
                                     echo "<option value='$value'>$value<option>";
                                 }?>                              
                             </select>
                       </div>
                                           
                        <div class="uk-form-row">
                            <label for="overlaps" class="uk-form-label">Overlaps</label>
                                <select id="overlaps" name="overlaps" required data-md-selectize>
                                    <?php foreach ($data as $value) {
                                          echo "<option value='$value'>$value<option>";
                                        }?>
                                    
                   			     </select>
                         </div>
                                           
                         <div class="uk-form-row">
                             <label for="balance" class="uk-form-label">Balance</label>
                                <select id="balance" name="balance" required data-md-selectize>
                                    <?php foreach ($data as $value) {
                                        echo "<option value='$value'>$value<option>";
                                      }?>
                                   
                   			     </select>
                         </div>
                                           
                         <div class="uk-form-row">
	                           <label for="decissions" class="uk-form-label">Decissions Making</label>
	                                <select id="decissions" name="decissions" required data-md-selectize>
	                                    <?php foreach ($data as $value) {
                                        echo "<option value='$value'>$value<option>";
                                      }?>
	                                   
	                   			     </select>
                          </div>
                                           
                           <div class="uk-form-row">
	                           <label for="marking" class="uk-form-label">Marking</label>
	                                <select id="marking" name="marking" required data-md-selectize>
	                                    <?php foreach ($data as $value) {
                                          echo "<option value='$value'>$value<option>";
                                        }?>	                                   
	                   			     </select>
                   		   </div>
                                           
                            <div class="uk-form-row">
		                           <label for="pressing" class="uk-form-label">Pressing</label>
		                                <select id="pressing" name="pressing" required data-md-selectize>
		                                   <?php foreach ($data as $value) {
                                            echo "<option value='$value'>$value<option>";
                                          }?>		                                   
		                   			     </select>
		                   		   </div>
                               <div class="uk-form-row">
                                 <label for="covering" class="uk-form-label">Covering</label>
                                      <select id="covering" name="covering"  required data-md-selectize>
                                       <?php foreach ($data as $value) {
                                          echo "<option value='$value'>$value<option>";
                                        }?>
                                   </select>
                              </div>
                         </div>
                                           
                          <div class="uk-width-medium-1-2">
                            
                                <div class="uk-form-row">
                                    <label for="compactness" class="uk-form-label">Compactness</label>
	                                    <select id="compactness" name="compactness"  required data-md-selectize>
	                                       <?php foreach ($data as $value) {
                                              echo "<option value='$value'>$value<option>";
                                            }?>	                                        
	                       			     </select>
                                 </div>
                                           
                              <div class="uk-form-row">
                                   <label for="recovery" class="uk-form-label">Recovery</label>
                                        <select id="recovery" name="recovery" required data-md-selectize>
                                            <?php foreach ($data as $value) {
                                              echo "<option value='$value'>$value<option>";
                                            }?>
                                            
                           			     </select>
                           		   </div>
                                           
                                  <div class="uk-form-row">
                                       <label for="possesion" class="uk-form-label">Possesion</label>
                                            <select id="possesion" name="possesion" required data-md-selectize>
                                                <?php foreach ($data as $value) {
                                                      echo "<option value='$value'>$value<option>";
                                                    }?>
                                                
                               			     </select>
                               		   </div>
                                           
                                <div class="uk-form-row">
                                   <label for="transition" class="uk-form-label">Transition</label>
                                        <select id="transition" name="transition" required data-md-selectize>
                                            <?php foreach ($data as $value) {
                                                echo "<option value='$value'>$value<option>";
                                              }?>                                            
                           			     </select>
                           		   </div>
                                           
                                  <div class="uk-form-row">
	                                   <label for="responsivness" class="uk-form-label">Responsivness</label>
	                                        <select id="responsivness" name="responsivness" required data-md-selectize>
	                                            <?php foreach ($data as $value) {
                                                echo "<option value='$value'>$value<option>";
                                              }?>	                                           
	                           			     </select>
	                           		   </div>
                                           
                                    <div class="uk-form-row">
                                       <label for="adaptability" class="uk-form-label">Adaptability</label>
                                            <select id="adaptability" name="adaptability" required data-md-selectize>
                                               <?php foreach ($data as $value) {
                                                echo "<option value='$value'>$value<option>";
                                              }?>                                                
                               			     </select>
                               		   </div>
                                           
                                   <div class="uk-form-row">
                                       <label for="anticipation" class="uk-form-label">Anticipation</label>
                                            <select id="anticipation" name="anticipation" required data-md-selectize>
                                                <?php foreach ($data as $value) {
                                                echo "<option value='$value'>$value<option>";
                                              }?>
                               			     </select>
                               		   </div>                               		                                             
                                         
                                     <div class="uk-form-row">
                                         <button type="submit" class="md-btn md-btn-primary  adept-md-btn-primary">Save</button>
                                     </div>
                         
                           </form>
                    </div>
                </div>
            </div>

<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>

