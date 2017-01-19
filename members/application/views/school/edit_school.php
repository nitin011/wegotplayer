
<div class="md-card">
   <div class="md-card-content">
   	<form id="form_validation" class="uk-form-stacked" action="<?php echo base_url()?>userschool/updateSchool" method="POST" accept-charset="utf-8"> 
      <div class="uk-grid" data-uk-grid-margin>
          <div class="uk-width-medium-1-2"> 
          		<input type="hidden" value="<?php echo $user_id; ?>" name="user_id">            
                 <div class="uk-form-row">
                  	<label for="schoolname">High School Name</label>
                   	<input type="text" name="schoolname" required class="md-input" />
                 </div> 
                
                <div class="uk-form-row">                      
                            <label for="graduation_date" class="uk-form-label">High School Graduation Date</label>
                            <input id="graduation_date" value=" " name="graduation_date" />                     
                       </div>
                 <div class="uk-form-row">
                  	<label for="act_score">Overall act score / out of</label>
                   	<input type="text" name="act_score" required class="md-input" />                   
                </div> 
                 <div class="uk-form-row">
                  	<label for="overall_gpa">Overall GPA / out of</label>
                   	<input type="text" name="overall_gpa" required class="md-input" />
                </div> 
                
                <div class="uk-form-row">                      
                            <label for="enrolment_date" class="uk-form-label">College Enrolment Date</label>
                            <input id="enrolment_date" value=" " name="enrolment_date" />                     
                       </div>
                <div class="uk-form-row">
                  	<label for="college_credits">Transferable college credits</label>
                   	<input type="text" name="college_credits" required class="md-input" />
                </div>
                <div class="uk-form-row">
                  	<label for="school_phone">School Phone</label>
                   	<input type="text" name="school_phone" required class="md-input" />
                </div>
                <div class="uk-form-row">
                  	<label for="school_location">School Location</label>
                   	<input type="text" name="school_location" required class="md-input" />
                </div>
                <div class="uk-form-row">
                  	<label for="house_reg">Clearing house registration No</label>
                   	<input type="text" name="house_reg" required class="md-input" />
                </div>

            </div> 

            <div class="uk-width-medium-1-2">              
                 <div class="uk-form-row">
                  	<label for="schooltype">School Type</label>
                  	<select name="schooltype" id="schooltype" required data-md-selectize>                                    
                         <option selected="" value="">School Type</option>
                         <option value="1">Public</option>
                         <option value="2">Private</option>
                     </select>                   
                </div> 
                <div class="uk-form-row">
                  	<label for="sat_score">Overall sat score / Out of</label>
                   	<input type="text" name="sat_score" required class="md-input" />
                </div>
                <div class="uk-form-row">
                  	<label for="toefl">TOEFL (International Students)</label>
                   	<input type="text" name="toefl" required class="md-input" />
                </div>
                <div class="uk-form-row">
                  	<label for="class_rank">Class ranked</label>
                   	<input type="text" name="class_rank" required class="md-input" />
                </div>
                <div class="uk-form-row">
                  	<label for="college_major">Potential college major</label>
                   	<input type="text" name="college_major" required class="md-input" />
                </div>
                <div class="uk-form-row">
                  	<label for="counselor_name">High school counselor full name</label>
                   	<input type="text" name="counselor_name" required class="md-input" />
                </div>
                <div class="uk-form-row">
                  	<label for="school_website">School website</label>
                   	<input type="text" name="school_website" required class="md-input" />
                </div>
                <div class="uk-form-row">
                  	<label for="academic_goal">Academic Goals</label>
                   	<input type="text" name="academic_goal" required class="md-input" />
                </div>
                <div class="uk-form-row">
                     <button type="submit" class="md-btn md-btn-primary adept-md-btn-primary">Save</button>
                </div>

            </div> 
          </div> 
        </form>
      </div> 
   </div> 

<script src="<?php echo base_url(); ?>assets/js/common.min.js"></script>    
<script src="<?php echo base_url(); ?>assets/js/uikit_custom.min.js"></script>   
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/kendoui.custom.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/kendoui.min.js"></script>
<script>
$("#graduation_date").kendoDatePicker({
  format: "MMMM d,yyyy"
});

$("#enrolment_date").kendoDatePicker({
  format: "MMMM d,yyyy"
});
</script>