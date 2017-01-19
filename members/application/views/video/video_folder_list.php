<?php
error_reporting(E_ALL);
?>
<div data-uk-grid-margin="" data-uk-sortable="" id="dashboard_sortable_cards" class="uk-grid uk-grid-width-small-1-2 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-5 uk-text-center uk-sortable sortable-handler">
	<div id="folder_div">
      <div class="md-card local_photo local_photo_add">
        <button type="button" id="add" value="add" onclick="addVideoGallery()" class="md-btn md-btn-primary button_local_photo_add">Add New folder</button>
      </div>
    </div>
	<?php if(is_array($folder_list_result))
		{
			foreach($folder_list_result as $row)
			{ 
				
			?>
			
			<div id="folder_div_<?php print_r( $row['folder_id']); ?>">
				<div class="md-card local_photo">
					<a onclick="openVideoFolder(<?php print_r($row['folder_id']); ?>)">
						<img src="<?php echo base_url();?>images/video_icon.png">
						<p><span><?php print_r(ucwords($row['folder_path']));?></span><i><?php print_r($row['folder_video_count']); ?> Videos</i></p>
					</a>		   
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
			url: '<?php echo base_url(); ?>uservideos/getFolderVideo',
			data: {folder_id:folder_id},
		})
		.done(function(data){					
			$('#video').empty();
			$("#main_tab_target").css({ display: "block" });
            $("#sidetab_destination").css({ display: "none" });
            $('#video').html(data);
		});
	} 
	
	function addVideoGallery(){
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>uservideos/createVideosView',
			data: {},
		})
		.done(function(data){	
			$("#main_tab_target").css({ display: "block" });
            $("#sidetab_destination").css({ display: "none" });
            $('#video').html(data);	
			$("#video").html(data);
		});


		
	} 
</script>


