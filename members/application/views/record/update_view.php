<div class="md-card">
   <div class="md-card-content">
    <form  class="uk-form-stacked">
       <div class="uk-grid" data-uk-grid-margin>            
         <div class="uk-width-medium-1-2">
          <div class="uk-form-row">
              <label for="mile_run" class="uk-form-label">One Mile Run (minutes)</label>
              <input type="text" id="mile_run" name="mile_run" value="<?php echo $data->one_mile; ?>" required class="md-input" />
            </div>
            <div class="uk-form-row">
		          <label for="thirty_sprint" class="uk-form-label">30 Meters Sprint (seconds)</label>
		          <input type="text" id="thirty_sprint" name="thirty_sprint" value="<?php echo $data->run_30; ?>" required class="md-input" />
            </div>
            <div class="uk-form-row">
              <label for="hundred_sprint" class="uk-form-label">100 Meters Sprint  (seconds)</label>
              <input type="text" id="hundred_sprint" name="hundred_sprint"  value="<?php echo $data->run_100; ?>" required class="md-input" />
            </div>
            <div class="uk-form-row">
              <label for="max_bench" class="uk-form-label">Max bench press/reps</label>
              <input type="text" name="max_bench" id="max_bench" value="<?php echo $data->max_bench; ?>" required class="md-input" />
            </div>

            <div class="uk-form-row">
              <label for="vertical_jump" class="uk-form-label">Vertical Jump(inches)</label>
              <input type="text" name="vertical_jump" id="vertical_jump" value="<?php echo $data->vertical_jump; ?>" required class="md-input" />
            </div>

            <div class="uk-form-row">
              <label for="horizontal_jump" class="uk-form-label">Horizontal Jump(inches)</label>
              <input type="text" name="horizontal_jump" id="horizontal_jump" value="<?php echo $data->horizontal_jump; ?>" required class="md-input" />
            </div>

                                         
             <div class="uk-form-row">
                 <button type="button" onclick="updateRecord()" class="md-btn md-btn-primary adept-md-btn-primary">Save</button>
             </div>
        </form>
      </div>
  </div>
</div>

 
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>

<script>
    function updateRecord(){                
            var mile_run=$("#mile_run").val();
            var thirty_sprint=$("#thirty_sprint").val();
            var hundred_sprint=$("#hundred_sprint").val();            
            var max_bench=$("#max_bench").val();
            var vertical_jump=$("#vertical_jump").val();            
            var horizontal_jump=$("#horizontal_jump").val();

       $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>user_records/updateRecord',
              data: {mile_run:mile_run,thirty_sprint:thirty_sprint,
                      hundred_sprint:hundred_sprint,max_bench:max_bench,
                      vertical_jump:vertical_jump,horizontal_jump:horizontal_jump
                    },
            })
          .done(function(data){
             $('#records_tab').html(data);
             })
          
    }
</script>

 
