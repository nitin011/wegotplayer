<div class="edit_stats_view">
  <div class="col-md-6">     
  		<label for="type_of_injury">Type of injury</label>
        <select id="type_of_injury" name="type_of_injury" required class="form-control">
          <?php foreach ($injury_type as $value) { ?>
            <option value='<?php echo $value->id; ?>' 
              <?php if($value->id==$injur_row->type_of_injury){
                              echo "selected";
                            } ?>
                          ><?php echo $value->injury; ?><option>
             <?php  }?>                                       
         </select>
          
        <label for="body_area" >Body Area</label>
            <select id="body_area" name="body_area" required class="form-control">
             <?php foreach ($body_area as $value) {  ?>                                 
                 <option value='<?php echo $value->id; ?>' 
                 <?php if($value->id==$injur_row->body_area){
                        echo "selected";
                      } ?>
                    ><?php echo $value->body_area; ?><option>
             <?php  }?>                             
           </select>
      
            <label for="body_part">Body part</label>
            <select id="body_part" name="body_part" required class="form-control">
                 <?php foreach ($body_part as $value) { ?>
                    <option value='<?php echo $value->id; ?>' 
                   <?php if($value->id==$injur_row->body_part){
                          echo "selected";
                        } ?>
                      ><?php echo $value->body_part; ?><option>
               <?php  }?>                             
             </select>
      </div>
      <div class="col-md-6">   

                 <label for="recovered" >Recovered</label>
                 <select id="recovered" name="recovered" required class="form-control">
                     <?php foreach ($recovered as $key => $value) { ?>
                      <option value='<?php echo $key; ?>' 
                       <?php if($key==$injur_row->recovered){
                              echo "selected";
                            } ?>
                          ><?php echo $value.'%'; ?><option>
                   <?php  }?>                              
                 </select>
          
                 <label for="surgery" >Surgery</label>
                 <select id="surgery" name="surgery" required class="form-control">
                     <?php foreach ($surgery as $value) { ?>
                        <option value='<?php echo $value->id; ?>' 
                       <?php if($value->id==$injur_row->surgery){
                              echo "selected";
                            } ?>
                          ><?php echo $value->surgery; ?><option>
                   <?php  }?>                             
                 </select>
                        <label for="if_yes_when">If yes, when</label>
                        <div class="uk-input-group">                          
                            <input  type="text" class="md-input" id="if_yes_when" name="if_yes_when" value="<?php echo $injur_row->when;?>" data-uk-datepicker="{format:'MMMM DD,YYYY'}">
                            <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                    
                  <input type="hidden" id="wgp_table_id" value="<?php echo $injur_row->wgp_table_id;?>" >            
              </div>
                <div class="col-md-offset-8">
                      <button type="button" onclick="updateInjurRow()" class="btn_col btn btn-danger ac_save">Save</button>
                       <button class="btn btn-primary ac_cancel" id="cancel_injur" type="button"> Cancel </button>
                  </div>
         </div>
</div>                         
   
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>        


<script>

function updateInjurRow() {
  var  injury_type =$('#type_of_injury').val();
  var  body_area =$('#body_area').val();
  var  body_part =$('#body_part').val();
  var  recovered =$('#recovered').val();
  var  surgery =$('#surgery').val();
  var  when_yes =$('#if_yes_when').val();
  var  wgp_table_id =$('#wgp_table_id').val();
  $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>userinjur/updateInjurRow',
              data: {injury_type:injury_type, body_area:body_area,
                     body_part:body_part,recovered:recovered, 
                     surgery:surgery,when_yes:when_yes,
                     wgp_table_id:wgp_table_id},
            })
          .done(function(data){
             var url = "<?php echo base_url(); ?>home";
              window.location= url; 
          })
}


</script>


<script type="text/javascript">
  $("#cancel_injur").click(function(){
       $("#edit_injur_view").fadeOut('slow');
       $("#injer-view").fadeIn('slow');
  });
</script>