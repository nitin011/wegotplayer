<div class="md-card" id="exper">
     <div class="md-card-content">
         <h3 class="heading_a">Leadership</h3>
         <?php foreach ($experiance as $key => $value) { ?>     	
        
         <div class="uk-width-1-1">
			<div class="uk-form-row" id="row_<?php echo $value->wgp_table_id; ?>">
				<?php echo $value->Experience; ?>
				<a class="adept-save right" href="#" id="edit_<?php echo $value->wgp_table_id; ?>" onclick="editRow(<?php echo $value->wgp_table_id; ?>);">
                            <i class="material-icons">&#xE150;</i>
                 </a>
			</div>
			<hr>
		</div>
		<?php } ?>
      </div>
</div>

<script>
function editRow(id){
    var row_id = id;
    console.log(row_id);
    $("#exper").hide();    
    $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>userleadership/editRow',
              data: {edit:row_id},
            })
          .done(function(data){
             $('#leaderships').html(data);
          });
}
</script>