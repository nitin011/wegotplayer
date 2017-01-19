<div class="md-card">
    <div class="md-card-content">
    	<form id="form_validation" action="<?php echo base_url()?>userpsyhosocial/insertPsyhosocial" method="POST" accept-charset="utf-8" class="uk-form-stacked">
        	<div class="uk-grid" data-uk-grid-margin>            
            	<div class="uk-width-medium-1-2">
                  <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">                  
                    <div class="uk-form-row">
		                <label for="attitude" class="uk-form-label">Attitude</label>
		                <select id="attitude" name="attitude" required data-md-selectize>
                      <?php foreach ($data as $value) {
                        echo "<option value='$value'>$value<option>";
                      }?>                                       
		                 </select>
                     </div>
                                           
                      <div class="uk-form-row">
	                       <label for="self_confidence" class="uk-form-label">Self Confidence</label>
	                            <select id="self_confidence" name="self_confidence" required data-md-selectize>
	                               <?php foreach ($data as $value) {
                                     echo "<option value='$value'>$value<option>";
                                 }?>                              
                             </select>
                       </div>
                                           
                        <div class="uk-form-row">
                            <label for="honesty" class="uk-form-label">Honesty</label>
                                <select id="honesty" name="honesty" required data-md-selectize>
                                    <?php foreach ($data as $value) {
                                          echo "<option value='$value'>$value<option>";
                                        }?>
                                    
                   			     </select>
                         </div>
                                           
                         <div class="uk-form-row">
                             <label for="cooperation" class="uk-form-label">Cooperation</label>
                                <select id="cooperation" name="cooperation" required data-md-selectize>
                                    <?php foreach ($data as $value) {
                                        echo "<option value='$value'>$value<option>";
                                      }?>
                                   
                   			     </select>
                         </div>
                                           
                         <div class="uk-form-row">
	                           <label for="communication" class="uk-form-label">Communication</label>
	                                <select id="communication" name="communication" required data-md-selectize>
	                                    <?php foreach ($data as $value) {
                                        echo "<option value='$value'>$value<option>";
                                      }?>
	                                   
	                   			     </select>
                          </div>
                                           
                           <div class="uk-form-row">
	                           <label for="competitivness" class="uk-form-label">Competitivness</label>
	                                <select id="competitivness" name="competitivness" required data-md-selectize>
	                                    <?php foreach ($data as $value) {
                                          echo "<option value='$value'>$value<option>";
                                        }?>	                                   
	                   			     </select>
                   		   </div>
                                           
                            <div class="uk-form-row">
		                           <label for="passion" class="uk-form-label">Passion</label>
		                                <select id="passion" name="passion" required data-md-selectize>
		                                   <?php foreach ($data as $value) {
                                            echo "<option value='$value'>$value<option>";
                                          }?>		                                   
		                   			     </select>
		                   		   </div>
                               <div class="uk-form-row">
                                 <label for="discipline" class="uk-form-label">Discipline</label>
                                      <select id="discipline" name="discipline"  required data-md-selectize>
                                       <?php foreach ($data as $value) {
                                          echo "<option value='$value'>$value<option>";
                                        }?>
                                   </select>
                              </div>
                         </div>
                                           
                          <div class="uk-width-medium-1-2">
                            
                                <div class="uk-form-row">
                                    <label for="focus" class="uk-form-label">Focus</label>
	                                    <select id="focus" name="focus"  required data-md-selectize>
	                                       <?php foreach ($data as $value) {
                                              echo "<option value='$value'>$value<option>";
                                            }?>	                                        
	                       			     </select>
                                 </div>
                                           
                              <div class="uk-form-row">
                                   <label for="leadership" class="uk-form-label">Leadership</label>
                                        <select id="leadership" name="leadership" required data-md-selectize>
                                            <?php foreach ($data as $value) {
                                              echo "<option value='$value'>$value<option>";
                                            }?>
                                            
                           			     </select>
                           		   </div>
                                           
                                  <div class="uk-form-row">
                                       <label for="vision" class="uk-form-label">Vision</label>
                                            <select id="vision" name="vision" required data-md-selectize>
                                                <?php foreach ($data as $value) {
                                                      echo "<option value='$value'>$value<option>";
                                                    }?>
                                                
                               			     </select>
                               		   </div>
                                           
                                <div class="uk-form-row">
                                   <label for="respect" class="uk-form-label">Respect</label>
                                        <select id="respect" name="respect" required data-md-selectize>
                                            <?php foreach ($data as $value) {
                                                echo "<option value='$value'>$value<option>";
                                              }?>                                            
                           			     </select>
                           		   </div>
                                           
                                  <div class="uk-form-row">
	                                   <label for="character" class="uk-form-label">Character</label>
	                                        <select id="character" name="character" required data-md-selectize>
	                                            <?php foreach ($data as $value) {
                                                echo "<option value='$value'>$value<option>";
                                              }?>	                                           
	                           			     </select>
	                           		   </div>
                                           
                                    <div class="uk-form-row">
                                       <label for="motivation" class="uk-form-label">Motivation</label>
                                            <select id="motivation" name="motivation" required data-md-selectize>
                                               <?php foreach ($data as $value) {
                                                echo "<option value='$value'>$value<option>";
                                              }?>                                                
                               			     </select>
                               		   </div>
                                           
                                   <div class="uk-form-row">
                                       <label for="trustworthiness" class="uk-form-label">Trustworthiness</label>
                                            <select id="trustworthiness" name="trustworthiness" required data-md-selectize>
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

