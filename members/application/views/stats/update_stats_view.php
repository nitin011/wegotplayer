 <div class="edit_stats_view">       
        <div class="col-md-6">                                  
                    
		                <label for="level">Level</label>
      	                <select id="level" name="level" required class="form-control">
                          <?php foreach ($level_data as  $value) { ?>
                              <option value="<?php echo $value->levelId;?>"
                                <?php 
                                        if($value->levelId==$stats_row->level){
                                          echo "selected"; 
                                        } ?>
                                        ><?php echo $value->levelName;?></option>
                        <?php  } ?>
                       </select>
                    
	                       <label for="season">Season</label>
	                            <select id="season" name="season" required class="form-control">
	                             <?php foreach ($data as $key=>$value) { ?>
                                  <option value='<?php echo $key; ?>'
                                    <?php 
                                        if($key==$stats_row->season){
                                          echo "selected";
                                        } ?>
                                        ><?php echo $value; ?><option>
                                 <?php }?>                              
                             </select>
                       
                            <label for="games_played">Games played</label>
                            <input type="text" id="games_played" name="games_played" value="<?php echo $stats_row->games_played;?>" required class="form-control" />
                                    
                   			    
                               
                        <!--  <div class="uk-input-group"> -->
                             <label for="games_started" >Games started</label>
                             <input type="text" id="games_started" name="games_started" value="<?php echo $stats_row->games_started;?>" required class="form-control"/>
                             <!--  <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span> -->
                             <!--  data-uk-datepicker="{format:'MMMM DD, YYYY'}" -->
                       
            </div>
            <div class="col-md-6">           
	                           <label for="goals">Goals</label>
	                           <input type="text" id="goals" name="goals" value="<?php echo $stats_row->goals;?>" required class="form-control" />
                          
	                           <label for="assists">Assists</label>
	                           <input type="text" id="assists" name="assists" value="<?php echo $stats_row->assists;?>" required class="form-control" />
                   		   
		                           <label for="points">Points</label>
		                           <input type="text" id="points" name="points" value="<?php echo $stats_row->points;?>" required class="form-control" />
		                   		  

                                 <label for="total_points">Total points</label>
                                 <input type="text" id="total_points" name="total_points" value="<?php echo $stats_row->total_points;?>" required class="form-control" />
                                 <input type="hidden" id="wgp_table_id" value="<?php echo $stats_row->wgp_table_id;?>" >
             </div>
              <div class="col-md-3 pull-right right_content">
                       <button type="button" id="submit" onclick="updadeStats()" class="btn_col btn btn-danger ac_save">Save</button>
                       <button type="button" id="cancel_stats" class="btn btn-primary ac_cancel">Cancel </button> 
                  </div>                        
                        
                    </div>
  </div>
            


<!--<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script> -->
<script>
 function updadeStats(){                
            var level=$("#level").val();
            var season=$("#season").val();
            var games_played=$("#games_played").val();            
            var games_started=$("#games_started").val();
            var goals=$("#goals").val(); 
            var assists=$("#assists").val();
            var points=$("#points").val();  
            var total_points=$("#total_points").val();                       
            var wgp_table_id=$("#wgp_table_id").val();

       $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>userstats/updateStatsRow',
              data: {level:level,season:season,goals:goals,assists:assists,points:points,
                      games_played:games_played,games_started:games_started,
                      total_points:total_points,wgp_table_id:wgp_table_id
                    },
            })
          .done(function(data){
             var url = "<?php echo base_url(); ?>home";
            window.location= url; 
             })
          
    }
</script>

<script type="text/javascript">
  $("#cancel_stats").click(function(){
      $("#view_stats").fadeIn('slow');
      $(".edit_stats_view").fadeOut('slow');
  });

</script>
