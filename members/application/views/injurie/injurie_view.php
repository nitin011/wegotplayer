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
                      <th>Action</th>                                                 
                  </tr>
                  </thead>                     
                  <tbody> 
                  <?php foreach($injur as $value) { ?>                                              
                  <tr id="row_<?php echo $value->wgp_table_id; ?>">
                      <td><?php echo $value->type_of_injury;?></td>
                      <td><?php echo $value->body_part;?></td>
                      <td><?php echo $value->body_area;?></td>
                      <td>
                        <?php foreach ($recovered as $key => $rec) 
                              {
                          			if($key==$value->recovered)
                          			echo $rec.'%';
                          		}
                        ?>
                      </td>
                      <td><?php echo $value->surgery;?></td>
                      <td><?php echo $value->when;?></td>                    
                      
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
                  <button type="button" id="add" value="add" onclick="addInjur()" class="md-btn md-btn-primary adept-md-btn-primary right">Add new</button>
                  </div>
            </div>
        </div>
    </div> 

<script>
function addInjur() {

var add=$("#add").val();
if(add=="add") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userinjur/addInjur',
                      data: {add:add},
                  })
                .done(function(data){                  
                  $('#injuries').html(data);
                })
              } 
    }// End addTestSCore Function


function  editRow(id){
    $("#injer-view").hide();

    var row_id= id;
    $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>userinjur/updateInjurView',
              data: {edit:row_id},
            })
          .done(function(data){
             $('#injuries').html(data);
          });
    }

function deleteRow(id){
    var row_id= id;
    var choice = confirm('Do you really want to delete this record?');
    if(choice === true) { 
     $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>userinjur/deleteInjur',
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