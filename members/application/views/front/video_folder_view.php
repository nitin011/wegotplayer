<?php error_reporting(E_ALL); ?>
<div data-uk-grid-margin="" data-uk-sortable="" id="dashboard_sortable_cards" class="uk-grid uk-grid-width-small-1-2 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-5 uk-text-center uk-sortable sortable-handler">
	
	<?php if(is_array($folder))
		{
			foreach($folder as $row) {  ?>
			
			<div id="folder_div_<?php print_r( $row->folder_id); ?>">
				<div class="md-card">
					<div class="md-card-content">
						<a onclick="openVideoFolder(<?php print_r( $row->folder_id); ?>)">
							<span class="epc_chart_icon"><i class="uk-icon-folder-open"></i></span>
							<canvas height="50" width="50"></canvas>
							<p><?php print_r(ucwords($row->folder_path));?></p>
							
						</a>
					</div>		   
				</div>
			</div> 
			<?php 
			} 
			
		}else
		{ 
		?>
		
		<div id="folder_div">
			<div class="md-card">
				<div class="md-card-content">
					<p>No folder exits. Click on the botton to create folder.</p>
				</div>		   
			</div>
		</div> 
		
		<?php
		}
	?>	 
</div>

<script>
	
    function openVideoFolder(folder_id){
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>front_video/getFolderVideo',
			data: {folder_id:folder_id},
		})
		.done(function(data){					
			$('#video').empty();
			$('#video').html(data);
		});
	} 
</script>