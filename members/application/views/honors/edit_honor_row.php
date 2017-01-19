<div class="md-card" id="edit_honor">
    <div class="md-card-content">
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-2">
                <form  class="uk-form-stacked" >    
                   <div class="uk-form-row">
	                   <label for="award_name" class="uk-form-label">Awards & Honors Name</label>
	                   <input type="text" name="award_name" id="award_name" value="<?php echo $honor_row->awards_honors_name; ?>" required class="md-input" />
           		   </div>
                   <div class="uk-form-row">
                   		<label for="honor_type" class="uk-form-label">Type</label>
                        <select id="honor_type" name="honor_type" required data-md-selectize>
                            <?php foreach ($type as $value) { ?>
                               <option value="<?php echo $value->id; ?>"
                                <?php 
                                if($value->id==$honor_row->type){
                                  echo "selected";
                                } ?>
                                ><?php echo $value->type_name; ?></option>
                            <?php  }?>                           
           			     </select>
           		   </div>                               
                              
                   <div class="uk-form-row">
	                  <label for="description">Description</label>
	                  <select id="description" name="description" required data-md-selectize>
	                    <?php foreach ($description as $value) { ?>
                             <option value="<?php echo $value->id; ?>"
                              <?php 
                                if($value->id==$honor_row->description){
                                  echo "selected";
                                } ?>
                                ><?php echo $value->description; ?></option>
                        <?php  } ?>                       
	                    </select>
                   </div>
                               
                           
                   <div class="uk-form-row">
                      <label for="school_name">School / Organization Name</label>
                      <input type="text" id="school_name" name="school_name" value="<?php echo $honor_row->school_organization_name; ?>" required class="md-input" />
                    </div>

                    <div class="uk-form-row">
	                  <label for="level">Level</label>
	                  <select id="level" name="level" required data-md-selectize>
	                    <?php foreach ($level as $value) { ?>
                             <option value="<?php  echo $value->levelId; ?>"
                              <?php 
                                if($value->levelId==$honor_row->level){
                                  echo "selected";
                                } ?>
                              ><?php echo $value->levelName; ?></option>
                        <?php  } ?>                       
	                    </select>
                   </div>
                                   
                   <div class="uk-form-row">
                      <label for="date">Date Received</label>
                      <input type="text" name="date" id="date"  value="<?php echo $honor_row->date_Received; ?>"/>
                   </div>
                       <input type="hidden" name="wgp_table_id" id="wgp_table_id" value="<?php echo $honor_row->wgp_table_id; ?>">     
                    <div class="uk-form-row">
                        <button type="button"  id="submit" onclick="updadeHonor()" class="md-btn md-btn-primary adept-md-btn-primary">Save</button>
                    </div>             
               </form>
             </div>
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
$("#date").kendoDatePicker({
  format: "MMMM dd,yyyy"
});

</script>

<script>
 function updadeHonor()
    {                
        var award_name=$("#award_name").val();
        var honor_type=$("#honor_type").val();
        var description=$("#description").val();            
        var school_name=$("#school_name").val();
        var level=$("#level").val();
        var date=$("#date").val();
        var wgp_table_id=$("#wgp_table_id").val();

       $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>userhonors/updateHonorRow',
              data: {award_name:award_name,honor_type:honor_type,
                     description:description,school_name:school_name,
                     level:level,date:date,wgp_table_id:wgp_table_id
                    },
            })
          .done(function(data){
             $('#honors').html(data);
             })
          
    }
</script>