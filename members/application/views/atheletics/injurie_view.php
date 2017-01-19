<div class="md-card" id="injer-view">
      <div class="md-card-content">
          <div class="uk-overflow-container">
              <table class="uk-table uk-text-nowrap adept-table">
                  <thead>
                  <tr>				
                      <th>Type of injury</th>
                      <th>Body Part</th>
                      <th>Body Area</th>
                      <th>Recovered</th>
                      <th>Surgery</th>
                      <th>If yes, when</th>                                                                      
                  </tr>
                  </thead>                     
                  <tbody> 
                  <?php foreach($injur as $value) { ?>                                              
                  <tr id="row_<?php echo $value->wgp_table_id; ?>">
                      <td><?php echo $value->type_of_injury;?></td>
                      <td><?php echo $value->body_part;?></td>
                      <td><?php echo $value->body_area;?></td>
                      <td><?php 
                      		foreach ($recovered as $key => $rec) {

                      			if($key==$value->recovered)
                      			echo $rec.'%';
                      		} ?>
                      </td>
                      <td><?php echo $value->surgery;?></td>
                      <td><?php echo $value->when;?></td>                   
                      
                                                
                  </tr>
                  <?php   } ?>                      
                  </tbody>
              </table>                   
          </div>
        </div>
    </div>



