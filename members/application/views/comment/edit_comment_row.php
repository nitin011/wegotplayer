<div class="md-card">
     <div class="md-card-content">
         <h3 class="heading_a">Comments</h3>
       
           <div class="uk-width-1-1">
              <div class="uk-form-row">
                  <input type="text" id="comm" name="comm"  value="<?php echo $comment_row->comments;?>" class="md-input">
                	<input type="hidden" name="wgp_table_id" id="wgp_table_id" value="<?php echo $comment_row->wgp_table_id; ?>">
                </div>
             <div class="uk-form-row">
              <button type="button" onclick="updateComment()"class="md-btn md-btn-primary adept-md-btn-primary" >Send</button>
           </div>
         </div>
         </div>               
    </div>

<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>
<script>
function updateComment(){

  var comment=$("#comm").val();
    var wgp_table_id=$("#wgp_table_id").val();

     $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>usercomment/updateRow',
              data: {comment:comment, wgp_table_id:wgp_table_id},
            })
          .done(function(data){
             $('#comment').html(data);
          })


}
</script>