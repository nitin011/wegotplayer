<div class="md-card" id="comment-view">
     <div class="md-card-content">
         <h3 class="heading_a">Comment</h3>
         <?php foreach ($comments as $key => $value) { ?>        	
        
         <div class="uk-width-1-1">
			<div class="uk-form-row">
				<?php echo $value->comments; ?>
				<a class="adept-edit right" href="#" id="edit_<?php echo $value->wgp_table_id; ?>" onclick="editRow(<?php echo $value->wgp_table_id; ?>);">
                     <i class="material-icons">&#xE150;</i>
                 </a>
			</div>
			<hr class="uk-grid-divider">
		</div>
		<?php } ?>
      </div>
</div>

<script>
function editRow(id)
{
    var row_id = id;    
    //$("#comment-view").hide();    
    $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>usercomment/editComment',
              data: {edit:row_id},
            })
          .done(function(data){
             $('#comment').html(data);
          });
}
</script>