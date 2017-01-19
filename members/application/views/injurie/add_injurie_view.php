<?php ini_set('memory_limit', '256M');?>

<div class="row">
         <div class="col-md-6">                                 
            <div class="uk-form-row">
                <label for="type_of_injury" class="uk-form-label">Type of injury</label>
                <select id="type_of_injury" name="type_of_injury" required data-md-selectize>
                  <?php foreach ($injury_type as $value) {
                    echo "<option value='$value->id'>$value->injury<option>";
                  }?>                                       
                 </select>
             </div>
                                           
              <div class="uk-form-row">
                 <label for="body_area" class="uk-form-label">Body Area</label>
                      <select id="body_area" name="body_area" required data-md-selectize>
                         <?php foreach ($body_area as $value) {
                             echo "<option value='$value->id'>$value->body_area<option>";
                         }?>                              
                     </select>
               </div>
                                           
                <div class="uk-form-row">
                    <label for="body_part" class="uk-form-label">Body part</label>
                    <select id="body_part" name="body_part" required data-md-selectize>
                         <?php foreach ($body_part as $value) {
                             echo "<option value='$value->id'>$value->body_part<option>";
                         }?>                              
                     </select> 
                 </div>

            </div>
            <div class="col-md-6">                                           
                   <div class="uk-form-row">
                       <label for="recovered" class="uk-form-label">Recovered</label>
                       <select id="recovered" name="recovered" required data-md-selectize>
                           <?php foreach ($recovered as $key => $value) {
                               echo "<option value='$key'>$value%<option>";
                           }?>                              
                       </select>
                   </div>
                                           
                   <div class="uk-form-row">
                       <label for="surgery" class="uk-form-label">Surgery</label>
                       <select id="surgery" name="surgery" required data-md-selectize>
                           <?php foreach ($surgery as $value) {
                               echo "<option value='$value->id'>$value->surgery<option>";
                           }?>                              
                       </select>
                    </div>
                       
                     <label for="if_yes_when" class="uk-form-label">If yes, when</label>                    
                     <div class="uk-input-group">                      
                       <input type="text" id="if_yes_when" name="if_yes_when" required class="md-input" data-uk-datepicker="{format:'MMMM DD, YYYY'}"/>
             		         <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                   </div>
              </div>
            <div class="col-md-3 pull-right right_content">
                  <div class="uk-form-row">
                       <button type="button" onclick="insertInjur()" class="btn_col btn btn-danger ac_save">Save</button>
                         <button class="btn btn-primary ac_cancel" id="cancel_injur" type="button"> Cancel </button>
                  </div>
            </div>
</div>


<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>

<script>

function insertInjur() {
  var  injury_type =$('#type_of_injury').val();
  var  body_area =$('#body_area').val();
  var  body_part =$('#body_part').val();
  var  recovered =$('#recovered').val();
  var  surgery =$('#surgery').val();
  var  when_yes =$('#if_yes_when').val();
  $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>userinjur/insertInjur',
              data: {injury_type:injury_type, body_area:body_area,
                     body_part:body_part,recovered:recovered, 
                    surgery:surgery,when_yes:when_yes},
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