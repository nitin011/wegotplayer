<div id="user_profile_gallery" data-uk-check-display class="uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4" data-uk-grid="{gutter: 4}">
	<?php if(is_array($image_result))
		{
			foreach($image_result as $row)
			{	?>		
			<div id="image_id_<?php echo $row->image_id; ?>">				
				<a href="<?php echo base_url(); ?><?php echo $row->image_file; ?>">
					<img src="<?php echo base_url(); ?><?php echo $row->image_file; ?>" alt="image<?php echo $row->image_id; ?>" width="200px" height="200px"/></a>
				
			</div>		
			<?php 	}  }else {	?>

		<div id="images_preview"></div>
		<div><p>No image exits.</p></div> 
		<?php  }	?>	
</div>




<script src="<?php echo base_url(); ?>assets/js/common.min.js"></script>    
<script src="<?php echo base_url(); ?>assets/js/uikit_custom.min.js"></script>   
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/page_user_profile.min.js"></script>
<script src="<?php echo base_url(); ?>bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url(); ?>bower_components/magnific-popup/dist/jquery.magnific-popup.min.js"></script>

<script>
	$(function() {
		altair_helpers.retina_images();
	});
</script>




