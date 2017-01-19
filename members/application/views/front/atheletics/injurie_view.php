 <h4>Injuries</h4> 
      <div class="md-card-content"> 
      <?php if(!empty($injur)) { ?>         
        <div class="table-responsive">
              <table class="uk-table uk-text-nowrap adept-table table">
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

                  <tr id="injur_row_<?php echo $value->wgp_table_id; ?>">

                      <td><?php echo $value->type_of_injury;?></td>
                      <td><?php echo $value->body_part;?></td>
                      <td><?php echo $value->body_area;?></td>
                      <td>
                        <?php foreach ($recovered as $key => $rec) {
                                if($key==$value->recovered){
                                  echo $rec.'%';
                                }
                            }
                        ?>
                      </td>
                      <td><?php echo $value->surgery;?></td>
                      <td><?php echo $value->when;?></td>                         

                  </tr>

                  <?php   } ?>                      

                  </tbody>

              </table>                   
              </div>
            <?php } else{
                echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable  </h3>";
            } ?>  
       </div> 