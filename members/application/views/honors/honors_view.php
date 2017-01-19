  <div class="md-card" id="honn">
        <div class="md-card-content">
            <div class="uk-overflow-container">
                <table class="uk-table uk-text-nowrap adept-table">
                    <thead>
                    <tr>
                        <th>Awards & Honors Name</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>School / Organization Name</th>
                        <th>Level</th> 
                        <th>Date Received</th>                           
                        <th>Action</th>
                     </tr>
                    </thead>
                    
                    <tbody> 
                    <?php foreach($honors as $value) { ?>                          
                    <tr id="row_<?php echo $value->wgp_table_id; ?>">
                        <td><?php echo $value->awards_honors_name; ?></td>
                        <td><?php echo $value->type; ?></td>
                        <td><?php echo $value->description; ?></td>
                        <td><?php echo $value->school_organization_name; ?></td>
                        <td><?php echo $value->level; ?></td>  
                        <td><?php echo $value->date_Received; ?></td>                           
                        <td>
                          <a class="adept-edit" href="#" id="edit_<?php echo $value->wgp_table_id; ?>" onclick="editHonorRow(<?php echo $value->wgp_table_id; ?>);">
                               <i class="material-icons">&#xE150;</i>
                           </a>
                        <a class="adept-delete" href="#" id="delete_<?php echo $value->wgp_table_id; ?>" onclick="return deleteHonorRow(<?php echo $value->wgp_table_id; ?>);">
                            <i class="material-icons">&#xE872;</i>
                          </a>
                       </td>                           
                    </tr>
                    <?php  } ?>
                    
                    
                    
                    </tbody>
                </table>              
                                      
                    <div class="uk-form-row">
                    <button type="button" id="add" value="add" onclick="addHonor()" class="md-btn md-btn-primary adept-md-btn-primary right">Add new</button>
                    </div>
        </div>
    </div>
</div>


<script>
function addHonor() {

var add=$("#add").val();
if(add=="add") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userhonors/addHonors',
                      data: {add:add},
                  })
                .done(function(data){                  
                  $('#honors').html(data);
                })
              } 
        }
function editHonorRow(id){
    var row_id = id;
    console.log(row_id);
    $("#honn").hide();    
    $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>userhonors/editHonorRow',
              data: {edit:row_id},
            })
          .done(function(data){
             $('#honors').html(data);
          });
}

function deleteHonorRow(id){
    var row_id = id;
    console.log(row_id);
    var choice = confirm('Do you really want to delete this record?');
    if(choice === true) {         
     $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>userhonors/deleteHonorRow',
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
      return false;
}

</script>