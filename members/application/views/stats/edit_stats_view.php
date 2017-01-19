<div class="edit_stats_view ">
      <form id="form_validation" action="<?php echo base_url()?>userstats/insertStats" method="POST" accept-charset="utf-8" class="uk-form-stacked">
      <div class="col-md-6">
              <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">                  
                    
		                <label for="level" class="uk-form-label">Level</label>
		                <select id="level" name="level" required class="form-control">
                      <?php foreach ($level_data as $value) { ?>
                          <option value="<?php echo $value->levelId;?>"><?php echo $value->levelName;?></option>
                     <?php } ?>
                      
                                                             
		                 </select>
        </div>
        <div class="col-md-6">                    
               <label for="season" class="uk-form-label">Season</label>
                    <select id="season" name="season" required class="form-control">
                       <?php foreach ($data as $key=>$value) {
                           echo "<option value='$key'>$value</option>";
                       }?>                              
                   </select>
        </div>
        <div class="col-md-6">                
            <label for="games_played" class="uk-form-label">Games played</label>
            <input type="text" name="games_played" required class="form-control"/>
        </div>
        <div class="col-md-6">        
             <label for="games_started" class="uk-form-label">Games started</label>
               <input type="text" name="games_started" required class="form-control"/>
        </div>
        <div class="col-md-6">
             <label for="goals" class="uk-form-label">Goals</label>
             <input type="text" name="goals" required class="form-control" />
        </div>
        <div class="col-md-6">                      
             <label for="assists" class="uk-form-label">Assists</label>
             <input type="text" name="assists" required class="form-control" />
        </div>
        <div class="col-md-6">   		  
           <label for="points" class="uk-form-label">Points</label>
           <input type="text" name="points" required class="form-control"/>
       </div>
        <div class="col-md-6">		                   		
           <label for="total_points" class="uk-form-label">Total points</label>
           <input type="text" name="total_points" required class="form-control" />
       </div>    
       <div class="col-md-3 pull-right right_content">             
                   <button type="submit" class="btn_col btn btn-danger ac_save">Save</button>
                    <button type="button" id="cancel_stats" class="btn btn-primary ac_cancel">Cancel </button> 
         
        </div>
   </form>
</div>

<script type="text/javascript">
  $("#cancel_stats").click(function(){
      $("#view_stats").fadeIn('slow');
      $(".edit_stats_view").fadeOut('slow');
  });

</script>
           