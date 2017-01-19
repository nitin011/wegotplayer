        <div class="md-card" id="test_score">
            <div class="md-card-content">
                <div class="uk-overflow-container">
                    <table class="uk-table uk-text-nowrap adept-table">
                        <thead>
                        <tr>
                            <th>Test Type</th>
                            <th>Subject</th>
                            <th>Test Score</th>
                            <th>Out Of</th>
                            <th>Date Of Test</th>
                            <th>Location Of Test</th>
                            <th>Edit</th>
                            
                        </tr>
                        </thead>
                        
                        <tbody> 
                        <?php foreach($test_details as $value) { ?>                          
                        <tr id="row_<?php echo $value->wgp_table_id; ?>">
                            <td><?php echo $value->test_type ;?></td>
                            <td><?php echo $value->test_subject ;?></td>
                            <td><?php echo $value->test_score ;?></td>
                            <td><?php echo $value->out_of ;?></td>
                            <td><?php echo $value->date_of_test ;?></td>
                            <td><?php echo $value->location_of_test ;?></td>
                            <td>
                                <a class="adept-edit" href="#" id="edit_<?php echo $value->wgp_table_id; ?>" onclick="editRow(<?php echo $value->wgp_table_id; ?>);">
                                    <i class="material-icons">&#xE150;</i>
                                </a>

                                <a class="adept-delete" href="#" id="delete_<?php echo $value->wgp_table_id; ?>" onclick="return deleteRow(<?php echo $value->wgp_table_id; ?>);">
                                    <i class="material-icons">&#xE872;</i>
                                </a>

                                <div id="confirmOver" style="display:none;">
                               <div id="confirmBox">      
                                   <p id="msg">Are you sure want to Delete.</p>
                                      <div id="confirmButtons">
                                       <a class="button blue" href="#" id="truebtn" onclick="deleteRow(<?php echo $value->wgp_table_id; ?>);">Yes</a>
                                       <a class="button gray" href="#" id="falsebtn" onclick="dismiss();">No</a>
                                   </div>
                               </div>
                            </div>
                           </td>                           
                        </tr>
                        <?php   } ?>                      
                        </tbody>
                    </table>                   
                                          
                        <div class="uk-form-row">
                        <button type="button" id="add" value="add" onclick="addTestScore()" class="md-btn md-btn-primary adept-md-btn-primary right">Add new</button>
                        </div>
            </div>
        </div>
    </div>


<script>
$(document).ready(function () {
            $("#delete").click(function () { 
                $('#confirmOver').css('display','block');                
                });
        });
function dismiss(){
    $('#confirmOver').css('display','none');
}

function addTestScore() {

var add=$("#add").val();
if(add=="add") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>usertestscore/addNewScore',
                      data: {add:add},
                  })
                .done(function(data){
                  //$('#about').empty();
                  $('#testscore').html(data);
                })
              } 
    }// End addTestSCore Function


function  editRow(id){
    $("#test_score").hide();

    var row_id= id;
    $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>usertestscore/editTestView',
              data: {edit:row_id},
            })
          .done(function(data){
             $('#testscore').html(data);
          });
}

function deleteRow(id){
    var row_id= id; 
    var choice = confirm('Do you really want to delete this record?');
    if(choice === true) {         
     $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>usertestscore/deleteTestRow',
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
