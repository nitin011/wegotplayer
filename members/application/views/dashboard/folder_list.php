<div data-uk-grid-margin="" data-uk-sortable="" id="dashboard_sortable_cards" class="uk-grid uk-grid-width-small-1-2 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-5 uk-text-center uk-sortable sortable-handler">
	
	<?php if(is_array($folder_list_result))
		{			
		  foreach($folder_list_result as $row)
			{
			?>
			
			<div id="folder_div_<?php print_r( $row->folder_id); ?>">
				<div class="md-card">
					<div class="md-card-content">
						<a onclick="openImageFolder(<?php print_r( $row->folder_id); ?>)">
							<span class="epc_chart_icon"><i class="uk-icon-folder-open"></i></span>
							<canvas height="50" width="50"></canvas>
							<p><?php print_r( $row->folder_path);?></p>
							
							
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




<div class="uk-form-row">						
	<button type="button" id="add" value="add" onclick="addGallery()" class="md-btn md-btn-primary right">Add Gallery</button> 
</div>


<script>
	
    function openImageFolder(folder_id){
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>userimagefolder/fetch_images_of_this_folder',
			data: {folder_id:folder_id},
		})
		.done(function(data){					
			$('#photo').empty();
			$('#photo').html(data);
		});
	} 
	
	function addGallery(){
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>userimagefolder',
			data: {},
		})
		.done(function(data){			
			$('#photo').html(data);
		});
	} 
</script>


