     <div class="col-md-6">
        <label for="mile_run" class="uk-form-label">One Mile Run (minutes)</label>
        <input type="text" id="mile_run" name="mile_run" required class="form-control" />
      </div>
      <div class="col-md-6">
        <label for="thirty_sprint" class="uk-form-label">30 Meters Sprint (seconds)</label>
        <input type="text" id="thirty_sprint" name="thirty_sprint" required class="form-control" />
      </div>
      <div class="col-md-6">
        <label for="hundred_sprint" class="uk-form-label">100 Meters Sprint  (seconds)</label>
        <input type="text" id="hundred_sprint" name="hundred_sprint" required class="form-control" />
      </div>
      <div class="col-md-6">
        <label for="max_bench" class="uk-form-label">Max bench press/reps</label>
        <input type="text" name="max_bench" id="max_bench" required class="form-control" />
      </div>

      <div class="col-md-6">
        <label for="vertical_jump" class="uk-form-label">Vertical Jump(inches)</label>
        <input type="text" name="vertical_jump" id="vertical_jump" required class="form-control" />
      </div>

      <div class="col-md-6">
        <label for="horizontal_jump" class="uk-form-label">Horizontal Jump(inches)</label>
        <input type="text" name="horizontal_jump" id="horizontal_jump" required class="form-control" />
      </div>

        <br>                           
       <div class="col-md-12 space">
           <button type="button" onclick="addRecord()" class="md-btn md-btn-primary adept-md-btn-primary pull-right">Save</button>
       </div>


<script>
    function addRecord(){                
            var mile_run=$("#mile_run").val();
            var thirty_sprint=$("#thirty_sprint").val();
            var hundred_sprint=$("#hundred_sprint").val();            
            var max_bench=$("#max_bench").val();
            var vertical_jump=$("#vertical_jump").val();            
            var horizontal_jump=$("#horizontal_jump").val();

       $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>user_records/addRecord',
              data: {mile_run:mile_run,thirty_sprint:thirty_sprint,
                      hundred_sprint:hundred_sprint,max_bench:max_bench,
                      vertical_jump:vertical_jump,horizontal_jump:horizontal_jump
                    },
            })
          .done(function(data){                    
               $("#demo_model_close").trigger("click");
               var href="<?php echo base_url();?>home";
               window.location=href;
           })
          
    }
</script>

 
