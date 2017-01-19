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
                      <th>Edit</th>                            
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
                      
                      <td>
                            <a class="adept-edit" href="#" id="edit_<?php echo $value->wgp_table_id; ?>" onclick="editRow(<?php echo $value->wgp_table_id; ?>);">
                                    <i class="material-icons">&#xE150;</i>
                                </a>

                                <a class="adept-delete" href="#" id="delete_<?php echo $value->wgp_table_id; ?>" onclick="return deleteRow(<?php echo $value->wgp_table_id; ?>);">
                                    <i class="material-icons">&#xE872;</i>
                                </a>

                          
                     </td>                           
                  </tr>
                  <?php   } ?>                      
                  </tbody>
              </table>                   
                                    
                  <div class="uk-form-row">
                  <button type="button" id="add" value="add" onclick="addStats()" class="md-btn md-btn-primary  adept-md-btn-primary right">Add new</button>
                  </div>
            </div>
        </div>
    </div>


<script>



function addStats() {

var add=$("#add").val();
if(add=="add") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userstats/addStats',
                      data: {add:add},
                  })
                .done(function(data){
                  //$('#about').empty();
                  $('#stats').html(data);
                })
              } 
    }// End addTestSCore Function


function  editRow(id){
    $("#statss").hide();

    var row_id= id;
    $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>userstats/updateStatsView',
              data: {edit:row_id},
            })
          .done(function(data){
             $('#stats').html(data);
          });
    }

function deleteRow(id){
    var row_id= id;
    var choice = confirm('Do you really want to delete this record?');
    if(choice === true) { 
     $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>userstats/deleteStats',
            data: {row_id:row_id},
            })
            .done(function(data){
               if(data==1){
                var row_id='#row_'+id;
                $(row_id).fadeOut();
               }else{
                alert('OOPs! some error occur');
               }
              
            });
          }

}





</script>
