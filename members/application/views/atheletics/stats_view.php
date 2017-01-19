<div class="md-card" id="statss">
      <div class="md-card-content">
          <div class="uk-overflow-container">
              <table class="uk-table uk-text-nowrap adept-table">
                  <thead>
                  <tr>
                      <th>Level</th>
                      <th>Season</th>
                      <th>Games played</th>
                      <th>Games started</th>
                      <th>Goals</th>
                      <th>Assists</th>
                      <th>Points</th>
                      <th>Total points</th>                                                  
                  </tr>
                  </thead>                     
                  <tbody> 
                  <?php foreach($stats_details as $value) { ?>                                              
                  <tr id="row_<?php echo $value->wgp_table_id; ?>">
                      <td><?php echo $value->level;?></td>
                      <td>
                        <?php foreach ($seas as $key => $sea) {
                            if($value->season==$key){
                            echo $sea;
                          }
                          } ?>
                      </td>
                      <td><?php echo $value->games_played;?></td>
                      <td><?php echo $value->games_started;?></td>
                      <td><?php echo $value->goals;?></td>
                      <td><?php echo $value->assists;?></td>
                      <td><?php echo $value->points;?></td>
                      <td><?php echo $value->total_points;?></td>
                                            
                  </tr>
                  <?php   } ?>                      
                  </tbody>
              </table>                   
          </div>
        </div>
    </div>
