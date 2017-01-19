<div class="login_page_wrapper">
<div class="md-card" id="login_card">
    <div class="md-card-content large-padding" id="refer_form">
              <input type="hidden" name="refer_user_id" id="refer_user_id" value="<?php print_r($refer_data->refere_for_user_id);?>"/>
               <input type="hidden" name="refer_user_id" id="refer_id" value="<?php print_r($refer_data->id);?>"/>
           <div class="uk-form-row">
                  <span id="refer_status"></span>
           </div>
            <div class="uk-form-row">
                     <label for="full_name" class="uk-form-label">Full Name</label>
                     <input type="text" name="full_name" id="full_name" value="<?php print_r($refer_data->name);?>" required class="md-input" />
                 </div>

                  <div class="uk-form-row">
                      <label for="organization" class="uk-form-label">Occupation</label>                   
                        <select id="occupation" name="occupation" class="form-control">
                        <?php 
                          foreach ($occupation as  $value) { ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->occupation; ?></option>
                        <?php  } ?>                                                      
                      </select>
                  </div>
                  
                  <div class="uk-form-row">
                      <label for="organization" class="uk-form-label">Organizatio</label>
                        <input type="text" id="organization" name="organization"  required class="md-input" /> 
                 </div>
                 <div class="uk-form-row">
                      <label for="organization" class="uk-form-label">Level </label>                       
                        <select id="level" name="level" class="form-control" required >
                        <?php 
                          foreach ($level as  $value) { ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->level; ?></option>
                        <?php  } ?>                                                      
                      </select>
                  </div>

                   <div class="uk-form-row">
                      <label for="phone" class="uk-form-label">Phone </label>
                        <input type="text" id="phone" name="phone"  required class="md-input" /> 
                 </div>
                 <div class="uk-form-row">
                      <label for="email" class="uk-form-label">Email </label>
                        <input type="text" id="email" name="email"  value="<?php print_r($refer_data->email);?>" readonly class="md-input" /> 
                 </div>
                  <input type="hidden" id="registered_status" value="<?php echo $refer_data->registered_status;?>"/>
                 <?php if($refer_data->registered_status==0) {?>
                 <br>
                 <div class="uk-form-row">
                      <label for="password" class="uk-form-label">Password </label>
                        <input type="password" id="password" name="password" required class="md-input" /> 
                 </div>
                 <?php } ?>
                               
            <div class="uk-form-row">
                      <label for="comments" class="uk-form-label">Comments</label>
                      <textarea class="md-input" name="comments" id="comments"></textarea>
                   </div>
                           
                    <div class="uk-form-row">
                        <button type="button"  onclick="submitRefer();" class="md-btn md-btn-primary adept-md-btn-primary">Save</button>
                    </div>          
        </form>
    </div>
  </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>

<script>
   function  submitRefer(){     
        var refer_user_id = $("#refer_user_id").val();
        var refer_id = $("#refer_id").val();
        var name = $("#full_name").val();
        var level = $("#level").val();
        var occupation = $("#occupation").val();
        var email = $("#email").val();
        var registered_status = $("#registered_status").val();
        var organization = $("#organization").val();
        var phone  = $("#phone").val();        
        var comments = $("#comments").val();

        if(registered_status==0){
          var password = $("#password").val(); 

           $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url(); ?>refer/updateReference',
                  data: { refer_user_id:refer_user_id,refer_id:refer_id,
                          name:name,organization:organization,phone:phone,
                          comments:comments,email:email,level:level,
                          registered_status:registered_status,
                          occupation:occupation,password:password},
                })
            .done(function(data){              
                      $('#refer_status').html(data);
               });
        }else{
            $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url(); ?>refer/updateReference',
                  data: { refer_user_id:refer_user_id,refer_id:refer_id,
                          name:name,organization:organization,phone:phone,
                          comments:comments,email:email,level:level,
                          registered_status:registered_status,
                          occupation:occupation},
                })
            .done(function(data){              
                      $('#refer_status').html(data);
                      var url = "<?php echo base_url(); ?>";
                      window.location= url;   
               });            
      }
  }

</script>



