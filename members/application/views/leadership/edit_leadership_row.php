<div class="md-card" id="edit-leader">
     <div class="md-card-content">
     <form>        
         <div class="uk-width-1-1">                 
           <div class="uk-form-row" id="row_<?php echo $experiance->wgp_table_id; ?>">
				<label for="comment" class="uk-form-label">Leadersip</label>
                 
				<input type="text" name="comment" id="comment" value="<?php echo $experiance->Experience; ?>" class="md-input">
			
			</div>
			<div class="uk-form-row">
                      <button type="button" id="submit" onclick="updadeLeadership(<?php echo $experiance->wgp_table_id; ?>)" class="md-btn md-btn-primary adept-md-btn-primary">Save</button>
                     </div>                      
            </form>
			<hr>
		</div>
      </div>
</div>

  
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>

<script>
function updadeLeadership(id){

	  var comment=$("#comment").val();
  
     $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>userleadership/updateRow',
              data: {comment:comment, wgp_table_id:id},
            })
          .done(function(data){
             $('#leaderships').html(data);
          })


}
</script>