<div class="md-card" id="refer-id">
    <div class="md-card-content">
        <div class="uk-overflow-container">
            <table class="uk-table uk-text-nowrap adept-table">
                <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Occupation</th>
                    <th>Organization</th>
                    <th>Level</th>
                    <th>Gender</th>
                    <th>Location</th>
                    <th>Comments</th>
                    <th>Edit</th>
                    </tr>
                </thead>
                
                <tbody>
               <?php foreach($reference as $key=>$value) { ?>
                <tr id="row_<?php echo $value->wgp_table_id; ?>">
                    <td><?php echo $value->full_name;?></td>
                    <td><?php echo $value->full_time_occupation;?></td>
                    <td><?php print_r($value->organization);?></td>
                    <td><?php print_r($value->level);?></td>
                    <td><?php if($value->gender==1){echo "Male"; }else{echo "Female";}?></td>
                    <td><?php echo wordwrap($value->location,20,"<br>\n")?></td>
                    <td><?php echo $value->comment;?></td>
                    
                    <td>
                        <a class="adept-save" href="#" id="edit_<?php echo $value->wgp_table_id; ?>" onclick="editRow(<?php echo $value->wgp_table_id; ?>);">
                             <i class="material-icons">&#xE150;</i>
                         </a>
                        <a class="adept-save" href="#" id="delete_<?php echo $value->wgp_table_id; ?>" onclick="return deleteRow(<?php echo $value->wgp_table_id; ?>);">
                            <i class="material-icons">&#xE872;</i>
                        </a>
                   </td>                               
                </tr>                         
                <?php }?>
                </tbody>
            </table>
            <br/>
                <br/>                                              
                <div class="uk-form-row">
                <button type="button"  id="add" value="add" onclick="addRefer();" class="md-btn md-btn-primary adept-md-btn-primary
 right">Add new</button>
                </div>
        </div>
    </div>
<script>
function addRefer() {

var add=$("#add").val();
if(add=="add") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url()?>userreferences/addRefer',
                      data: {add:add},
                  })
                .done(function(data){                  
                  $('#references').html(data);
                })
              } 
    }// End addRefer Function

    function  editRow(id){
    $("#refer-id").hide();
    var row_id= id;
    $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>userreferences/updateReferView',
              data: {edit:row_id},
            })
          .done(function(data){
             $('#references').html(data);
          });
    }

function deleteRow(id){
    var row_id= id;
    var choice = confirm('Do you really want to delete this record?');
    if(choice === true) { 
     $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>userreferences/deleteRefer',
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
          