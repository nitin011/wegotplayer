<div class="md-card">
    <div class="md-card-content">
        <div class="uk-overflow-container">
            <div class="user_heading_menu" data-uk-dropdown>                              
                        <a class="md-fab md-fab-small md-fab-accent" id="edit_school" name="edit" href="#">
                            <i class="material-icons">&#xE150;</i>
                          </a>
                         </div>
    <form  class="uk-form-stacked" action="<?php echo base_url()?>userschool/editSchool" method="POST" accept-charset="utf-8">
        <table class="uk-table uk-table-hover">                
            <tbody>
            <tr> <input type="hidden" name="user_id" value="<?php echo $wgp_user_id; ?>">
                <td>High school name</td>                    
                <td><div class="md-input-wrapper md-input-filled">
                    <input type="text" name="high_school" id="high_school" value="<?php echo $school_name; ?>" class="md-input md-input-small">
                   <span class="md-input-bar"></span></div>
                </td>                                
            </tr>
            <tr>
                <td>School Type</td>
                <td>
                    <select name="schooltype" id="schooltype" data-md-selectize>
                              <option value="" selected="">School Type</option>
                              <option value="1" <?php if($school_type==1){echo "selected";} ?>>Public </option>
                              <option value="2" <?php if($school_type==2){echo "selected";} ?>>Private </option>
                    </select>
                </td>                                
            </tr> 
            <tr>
                <td>High School Graduation Date</td>
                <td><div class="md-input-wrapper md-input-filled">
                    <input type="text" name="graduation_date" value="<?php echo $high_school_graduation_date; ?>" class="md-input md-input-small" data-uk-datepicker="{format:'MMMM d,YYYY'}">
                   <span class="md-input-bar"></span></div>
             </td>                                
            </tr> 
            <tr>
                <td>Overall sat score / Out of</td>
                <td><div class="md-input-wrapper md-input-filled">
                    <input type="text" name="sat_score" value="<?php echo $overall_set_score; ?>" class="md-input md-input-small">
                   <span class="md-input-bar"></span></div>
             </td>                                
            </tr>
            <tr>
                <td>Overall act score / out of</td>
                <td><div class="md-input-wrapper md-input-filled">
                    <input type="text" name="act_score" value="<?php echo $overall_act_score; ?>" class="md-input md-input-small">
                   <span class="md-input-bar"></span></div>
             </td>                                
            </tr> 
            <tr>
                <td>TOEFL (International Students)</td>
                <td><div class="md-input-wrapper md-input-filled">
                    <input type="text" name="toefl" value="<?php echo $toefl;  ?>" class="md-input md-input-small">
                   <span class="md-input-bar"></span></div>
             </td>                                
            </tr>  
            <tr>
                <td>Overall GPA / out of</td>
                <td><div class="md-input-wrapper md-input-filled">
                    <input type="text" name="overall_gpa" value="<?php echo $overall_gpa;  ?>" class="md-input md-input-small">
                   <span class="md-input-bar"></span></div>
             </td>                                
            </tr> 
            <tr>
                <td>Class Ranked</td>
                <td><div class="md-input-wrapper md-input-filled">
                    <input type="text" name="class_rank" value="<?php echo $class_ranked; ?>" class="md-input md-input-small">
                   <span class="md-input-bar"></span></div>
             </td>                                
            </tr> 
            <tr>
                <td>College Enrolment Date</td>
                <td><div class="md-input-wrapper md-input-filled">
                    <input type="text" name="enrolment_date" value="<?php echo $college_enrolment_date;?>" class="md-input md-input-small" data-uk-datepicker="{format:'MMMM d,YYYY'}">
                   <span class="md-input-bar"></span></div>
             </td>                                
            </tr> 
            <tr>
                <td>Potential College Major</td>
                <td><div class="md-input-wrapper md-input-filled">
                    <input type="text" name="college_major" value="<?php echo $potential_college_major;?>" class="md-input md-input-small">
                   <span class="md-input-bar"></span></div>
             </td>                                
            </tr> 
            <tr>
                <td>Transferable College Credits</td>
                <td><div class="md-input-wrapper md-input-filled">
                    <input type="text" name="college_credit" value="<?php  echo $transferable_college_credits; ?>" class="md-input md-input-small">
                   <span class="md-input-bar"></span></div>
                </td>                                
            </tr> 
            <tr>
                <td>High School Counselor Fullname</td>
                <td><div class="md-input-wrapper md-input-filled">
                    <input type="text" name="counselor_name" value="<?php echo $high_school_counselor;  ?>" class="md-input md-input-small">
                   <span class="md-input-bar"></span></div>
             </td>                                
            </tr>                        
            <tr>
                <td>School Phone</td>
                <td><div class="md-input-wrapper md-input-filled">
                    <input type="text" name="school_phone" value="<?php echo $school_phone;?>" class="md-input md-input-small">
                   <span class="md-input-bar"></span></div>
             </td>                                
            </tr> 
            <tr>
                <td>School Website</td>
                <td><div class="md-input-wrapper md-input-filled">
                    <input type="text" name="school_website" value="<?php echo $school_website;  ?>" class="md-input md-input-small">
                   <span class="md-input-bar"></span></div>
                </td>                                
            </tr> 
            <tr>
                <td>School Location</td>
                <td><div class="md-input-wrapper md-input-filled">
                    <input type="text" name="school_loaction" value="<?php echo $school_location; ?>" class="md-input md-input-small">
                   <span class="md-input-bar"></span></div>
                 </td>                                
            </tr> 
            <tr>
                <td>Academic Goals</td>
                <td><div class="md-input-wrapper md-input-filled">
                    <input type="text" name="academic_goals" value="<?php echo $academic_goals;?>" class="md-input md-input-small">
                   <span class="md-input-bar"></span></div>
                </td>                                
            </tr> 
            <tr>
                <td>Clearing House Registration No</td>
                <td><div class="md-input-wrapper md-input-filled">
                    <input type="text" name="house_reg" value="<?php echo $clearing_house; ?>" class="md-input md-input-small">
                   <span class="md-input-bar"></span></div>
                </td>                                
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><button type="submit" id="submit" name="submit" class="md-btn md-btn-primary adept-md-btn-primary">Update</button></td>
            </tr>                
            </tbody>
        </table>
    </form>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>bower_components/moment/min/moment.min.js"></script> 
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



  <script>

   $(document).ready(function () {
       $("#edit_school").click(function () {                
       tab_value=$("#edit_school").attr("name");
       console.log(tab_value);      
       if(tab_value=="edit") {  

         $( "#high_school" ).focus();
         }         
                 
   });
  });

  </script>