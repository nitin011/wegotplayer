<div class="edit_stats_view">
    <div class="col-md-6">
          <label for="degree_level">Degree Level</label>
                        <select id="degree_level" name="degree_level" required class="form-control">
                            <?php foreach ($degree as $value) { ?>
                            	<option value="<?php echo $value->id; ?>"
                               <?php 
                                if($value->id==$trans_row->degree_level){
                                  echo "selected";
                                } ?>
                                ><?php echo $value->degreeName; ?></option>
                                 <?php }   ?>                           	
                                                     
                           </select>
           		
                   <label for="course_name">Course Name</label>
                        <select id="course_name" name="course_name" required class="form-control">
                           <?php foreach ($course_name as $value) { ?>
                            	<option value="<?php echo $value->id; ?>"
                                <?php 
                                if($value->id==$trans_row->course_name){
                                  echo "selected";
                                } ?>
                                ><?php echo $value->courseName; ?></option>                            	
                           <?php } ?> 
           			     </select>
           		
                   <label for="course_level">Course level</label>
                        <select id="course_level" name="course_level" required class="form-control">
                           <?php foreach ($course_level as $value) { ?>
                            	<option value="<?php echo $value->id; ?>"
                                <?php 
                                if($value->id==$trans_row->course_level){
                                  echo "selected";
                                } ?>
                                ><?php echo $value->levelName; ?></option>                            	
                           <?php } ?> 
           			     </select>

                </div>
                 <div class="col-md-6">
           		
                   <label for="school_year">School Year</label>
                        <select id="school_year" name="school_year" required class="form-control">
                           <?php foreach ($school_year as $value) { ?>
                            	<option value="<?php echo $value->id; ?>"
                                <?php 
                                if($value->id==$trans_row->school_year){
                                  echo "selected";
                                } ?>
                                ><?php echo $value->yearName; ?></option>                            	
                           <?php } ?> 
           			     </select>
         
                   <label for="academic_grade" >Academic Grade</label>
                        <select id="academic_grade" name="academic_grade" required class="form-control">
                            <?php foreach ($academic as $value) { ?>
                            	<option value="<?php echo $value->id; ?>"
                                <?php 
                                if($value->id==$trans_row->academic_grade){
                                  echo "selected";
                                } ?>
                                ><?php echo $value->gradeValue; ?></option>                            	
                           <?php } ?> 
           			     </select>
           		   
                    <input type="hidden" name="wgp_table_id" id="wgp_table_id" value="<?php echo $trans_row->wgp_table_id; ?>">
                   
                       <div class="uk-form-row pull-right btn_down">
                           <button type="button" onclick="updadeTrans()" class="btn_col btn btn-danger ac_save">Save</button>
                            <button type="button" id="cancel_transcript" class="btn btn-primary ac_cancel">Cancel </button> 
                       </div>
                 
                   </form>
          </div>
</div>
             

   
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>
<script>
 function updadeTrans(){                
            var degree_level=$("#degree_level").val();
            var course_name=$("#course_name").val();
            var course_level=$("#course_level").val();            
            var academic_grade=$("#academic_grade").val();
            var school_year=$("#school_year").val();            
            var wgp_table_id=$("#wgp_table_id").val();

       $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>usertranscripts/updateTransRow',
              data: {degree_level:degree_level,course_name:course_name,
                      course_level:course_level,school_year:school_year,
                      academic_grade:academic_grade,wgp_table_id,wgp_table_id
                    },
            })
          .done(function(data){
             $('#transcripts').html(data);
             })
          
    }
</script>

<script type="text/javascript">
 $("#cancel_transcript").click(function(){
      $("#transcripts").slideToggle();
      $("#trans_view").fadeIn();
 });
</script>