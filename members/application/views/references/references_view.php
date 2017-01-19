<div class="" id="refer-id">
    <div class="">
        <div class="uk-overflow-container">
            <table class="uk-table uk-text-nowrap adept-table">
                <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Occupation</th>
                    <th>Organization</th>
                    <th>Level</th>                    
                    <th>Contact</th>                  
                    <th>Location</th>
                    <th>Comments</th>
                    <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
               <?php foreach($reference as $key=>$value) { ?>

                <tr id="row_<?php echo $value->wgp_table_id; ?>">
                    <td><?php echo $value->full_name;?></td>
                    <td><?php echo $value->full_time_occupation;?></td>
                    <td><?php print_r($value->organization);?></td>
                    <td><?php print_r($value->level);?></td>                   
                    <td><?php echo $value->phone."<br>".$value->email; ?></td>               
                    <td><?php echo wordwrap($value->location,20,"<br>\n")?></td>
                    <td><?php echo wordwrap($value->comment,20,"<br>\n")?></td>
                    
                    <td>
                        <a class="adept-edit" href="#" id="edit_<?php echo $value->wgp_table_id; ?>" onclick="editRow(<?php echo $value->wgp_table_id; ?>);">
                             <i class="material-icons">&#xE150;</i>
                         </a>
                        <a class="adept-delete" href="#" id="delete_<?php echo $value->wgp_table_id; ?>" onclick="return deleteRow(<?php echo $value->wgp_table_id; ?>);">
                            <i class="material-icons">&#xE872;</i>
                        </a>
                   </td>                               
                </tr> 
                                       
                <?php }?>

                <?php if(isset($asked_ref) && ($asked_ref!='')){

                      foreach ($asked_ref as $key => $row) {   
                                          
                          echo "<tr id=\"aske_row_$row->id\"><td>".ucwords($row->name)."</td>";
                          echo "<td>".$row->occupation."</td>";
                          echo "<td>".ucwords($row->organization)."</td>";
                          echo "<td>".$row->level."</td>";
                          echo "<td>".$row->phone."</td>";
                          echo "<td></td>";
                          echo "<td>".$row->comment."</td>";                           
                          echo "<td class=\"verified_icon\">
                          <i class=\"material-icons\">&#xE8E8;</i>
                          <a class=\"adept-delete\" id=\"ask_row_$row->id\" onclick=\"deleteAskRefer($row->id)\"> <i class=\"material-icons\">&#xE872;</i></a>"; ?>
                        <?php  if($row->status==3) {
                           echo "<a onclick=\"hideAskRefer($row->id)\"><i class=\"material-icons\">&#xE8F4;</i></a>";
                         }if($row->status==2){
                          echo  "<a onclick=\"showAskRefer($row->id)\"><i class=\"material-icons\">&#xE8F5;</i></a>"; 
                        }else if($row->status==1){
                             echo "<a onclick=\"hideAskRefer($row->id)\"><i class=\"material-icons\">&#xE8F4;</i></a>";
                        } ?>
                      <?php   echo  "</td></tr>";
                          
                      }
                  }  ?>
               
                </tbody>
            </table>
           
               
                  <!-- <div class="uk-width-medium-1">                          
                            <button class="md-btn md-btn-primary adept-md-btn-primary" data-uk-modal="{target:'#modal_header_footer'}">Ask Coaches for references</button>
                             <button type="button"  id="add" value="add" onclick="addRefer();" class="md-btn md-btn-primary adept-md-btn-primary right">Add References yourself</button>
                             <p id="reference_invitation_status"></p>
                            <div class="uk-modal" id="modal_header_footer">
                                <div class="uk-modal-dialog">
                                    <div class="uk-modal-header">
                                        <h3 class="uk-modal-title">Ask coaches for references!</h3>
                                    </div>
                                    <p>Enter the name and E-mail address of coach you want to ask for Reference. </p>
                                    <div class="row">
                                          <div class="col-md-12">                                           
                                            <div class="col-md-5">
                                          <div class="uk-form-row">
                                              <label for="name">Name</label>
                                              <input type="text" id="name" name="name" required class="md-input" />
                                          </div>
                                        </div>
                                        <div class="col-md-7">
                                           <div class="uk-form-row">        
                                             <label for="email">E-mail address</label>
                                            <input type="email" id="email"  name="email" required class="md-input" />
                                          </div>
                                        </div>
                                        
                                    
                                          </div>
                                      </div>
                                    <div class="uk-modal-footer uk-text-right">
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                        <button type="button" onclick="sendReferenceForm();" id="send_refer" class="md-btn md-btn-primary adept-md-btn-primary">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    
             
                      
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
                  $('#reference_view').html(data);
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
             $('#reference_view').html(data);
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

function sendReferenceForm(){
   $("#send_refer").addClass("uk-modal-close");
  var name = $("#name").val();
  var email = $("#email").val();
    $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>userreferences/sendReferenceForm',
            data: {name:name,email:email},
          })
      .done(function(data){
         $('#reference_invitation_status').html(data);   
         $("#reference_invitation_status").delay(3000).fadeOut("slow");
      });
 }

 function deleteAskRefer(id){
    var choice = confirm('Do you really want to delete this Verified record ?');
    if(choice === true) { 

      $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>userreferences/deleteAskedRefer',
            data: {row_id:id},
            })
        .done(function(data){
               if(data==1){
                var row_id='#aske_row_'+id;
                $(row_id).fadeOut();
               }else{
                alert('OOPs! some error occur');
               }
              
            });

    }
 }

 function showAskRefer(id){
    $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>userreferences/showAskRefer',
            data: {row_id:id},
            })
        .done(function(data){

        });
 }

 function hideAskRefer(id){
    $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>userreferences/hideAskRefer',
            data: {row_id:id},
            })
        .done(function(data){

        });
 }
</script>
          