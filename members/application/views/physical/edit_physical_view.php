<div class="col-md-12 edit_stats_view">
<form id="form_validation" action="<?php echo base_url()?>userphysical/insertPhysical" method="POST" accept-charset="utf-8" class="uk-form-stacked">
        	           
            	<div class="col-md-6">
                  <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">                
                    
		                <label for="acceleration">Acceleration</label>
		                <select id="acceleration" name="acceleration" required class="form-control">
                      <?php foreach ($data as $value) {
                        echo "<option value='$value'>$value<option>";
                      }?>                                       
		                 </select>
                  
                      <label for="agility">Agility</label>
                      <select id="agility" name="agility" required class="form-control">
                         <?php foreach ($data as $value) {
                             echo "<option value='$value'>$value<option>";
                         }?>                              
                     </select>
                   
                    <label for="balance">Balance</label>
                                <select id="balance" name="balance" required class="form-control">
                                    <?php foreach ($data as $value) {
                                          echo "<option value='$value'>$value<option>";
                                        }?>
                                    
                   			     </select>
                
                  <label for="coordination">Coordination</label>
                      <select id="coordination" name="coordination" required class="form-control">
                          <?php foreach ($data as $value) {
                              echo "<option value='$value'>$value<option>";
                            }?>
                         
         			     </select>
                    
                     <label for="reaction">Reaction</label>
                          <select id="reaction" name="reaction" required class="form-control">
                              <?php foreach ($data as $value) {
                                echo "<option value='$value'>$value<option>";
                              }?>
                             
             			     </select>
                   
                     <label for="speed">Speed</label>
                          <select id="speed" name="speed" required class="form-control">
                              <?php foreach ($data as $value) {
                                  echo "<option value='$value'>$value<option>";
                                }?>	                                   
             			     </select>
           	
                       <label for="jumping">Jumping</label>
                            <select id="jumping" name="jumping" required class="form-control">
                               <?php foreach ($data as $value) {
                                    echo "<option value='$value'>$value<option>";
                                  }?>		                                   
               			     </select>
               	
                         <label for="strength">Strength</label>
                              <select id="strength" name="strength"  required class="form-control">
                               <?php foreach ($data as $value) {
                                  echo "<option value='$value'>$value<option>";
                                }?>
                           </select>
                      
                 </div>
                                   
                  <div class="col-md-6">
                    
                            <label for="flexibility">Flexibility</label>
                              <select id="flexibility" name="flexibility"  required class="form-control">
                                 <?php foreach ($data as $value) {
                                      echo "<option value='$value'>$value<option>";
                                    }?>	                                        
                 			     </select>
                     
                           <label for="endurance" >Endurance</label>
                                <select id="endurance" name="endurance" required class="form-control">
                                    <?php foreach ($data as $value) {
                                      echo "<option value='$value'>$value<option>";
                                    }?>
                                    
                   			     </select>
                   	
                               <label for="quickness">Quickness</label>
                                    <select id="quickness" name="quickness" required class="form-control">
                                        <?php foreach ($data as $value) {
                                              echo "<option value='$value'>$value<option>";
                                            }?>
                                        
                       			     </select>
                       
                           <label for="power">Power</label>
                                <select id="power" name="power" required class="form-control">
                                    <?php foreach ($data as $value) {
                                        echo "<option value='$value'>$value<option>";
                                      }?>                                            
                   			     </select>
            
                             <label for="basic_motor_skills">Basic Motor Skills</label>
                                  <select id="basic_motor_skills" name="basic_motor_skills" required class="form-control">
                                      <?php foreach ($data as $value) {
                                        echo "<option value='$value'>$value<option>";
                                      }?>	                                           
                     			     </select>
                     
                               <label for="mobility">Mobility</label>
                                    <select id="mobility" name="mobility" required class="form-control">
                                       <?php foreach ($data as $value) {
                                        echo "<option value='$value'>$value<option>";
                                      }?>                                                
                       			     </select>
                     
                               <label for="explosivness">Explosivness</label>
                                    <select id="explosivness" name="explosivness" required class="form-control">
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