
            <form id="form_validation" class="uk-form-stacked" action="<?php echo base_url()?>usertranscripts/insertTranscript" method="POST">    
                   
            <div class="col-md-6">
                  <div class="uk-form-row">
                   <label for="degree_level" class="uk-form-label">Degree Level</label>
                        <select id="degree_level" name="degree_level" required data-md-selectize>
                            <option value="">Choose..</option>
                            <?php foreach ($degree as $value) { ?>
                            	<option value="<?php echo $value->id; ?>"><?php echo $value->degreeName; ?></option>                            	
                           <?php } ?>                           
                           </select>
           		   </div>
                   <div class="uk-form-row">
                   <label for="course_name" class="uk-form-label">Course Name</label>
                        <select id="course_name" name="course_name" required data-md-selectize>
                            <option value="">Choose..</option>
                           <?php foreach ($course_name as $value) { ?>
                            	<option value="<?php echo $value->id; ?>"><?php echo $value->courseName; ?></option>                            	
                           <?php } ?> 
           			     </select>
           		   </div>
                   
                  
                       <div class="uk-form-row">
                   <label for="course_level" class="uk-form-label">Course level</label>
                        <select id="course_level" name="course_level" required data-md-selectize>
                            <option value="">Choose..</option>
                            <?php foreach ($course_level as $value) { ?>
                            	<option value="<?php echo $value->id; ?>"><?php echo $value->levelName; ?></option>                            	
                           <?php } ?> 
           			     </select>
           		   </div>
            </div>
            <div class="col-md-6">
               
                       <div class="uk-form-row">
                   <label for="school_year" class="uk-form-label">School Year</label>
                        <select id="school_year" name="school_year" required data-md-selectize>
                            <option value="">Choose..</option>
                            <?php foreach ($school_year as $value) { ?>
                            	<option value="<?php echo $value->id; ?>"><?php echo $value->yearName; ?></option>                            	
                           <?php } ?> 
           			     </select>
           		   </div>
                   
                       <div class="uk-form-row">
                   <label for="academic_grade" class="uk-form-label">Academic Grade</label>
                        <select id="academic_grade" name="academic_grade" required data-md-selectize>
                            <option value="">Choose..</option>
                            	<?php foreach ($academic as $value) { ?>
                            	<option value="<?php echo $value->id; ?>"><?php echo $value->gradeValue; ?></option>                            	
                           <?php } ?> 
           			     </select>
           		   </div>
                   
                      
                      <br/>
                      <br/>
                     
                    
                      <div class="uk-form-row pull-right btn_down">
                         <button type="submit" class="btn_col btn btn-danger ac_save">Save</button>
                         <button type="button" id="cancel_transcript" class="btn btn-primary ac_cancel">Cancel </button> 
                      </div>
                 
                 
                    </div>
         
                    </form>
  
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>
<script type="text/javascript">
 $("#cancel_transcript").click(function(){
      $("#transcripts").slideToggle();
 });
</script>