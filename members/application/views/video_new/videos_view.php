<div id="user_profile_gallery" data-uk-check-display class="col-md-12" data-uk-grid="{gutter: 4}">
	
	<?php
        if(is_array($video_list))
		{
			$video_count = count($video_list);
			foreach($video_list as $row)
			{	
			  if($row->wgp_video_type==1) {?>		
		<div class="col-md-6">
			<div id="video_id_<?php print_r( $row->wgp_video_id); ?>">
				
				<?php $video_url=base_url().$row->wgp_video_source; ?>
				<video width="100%" height="350px" controls>
				  <source src="<?php print_r( $video_url); ?>" type="video/mp4">
				  <source src="<?php print_r( $video_url); ?>" type="video/ogg">
				  Your browser does not support HTML5 video.
				</video>		  
				
			<span class="delete_action button_action" onclick="deleteVideo( <?php print_r( $row->wgp_video_id); ?>)">
				<i class="uk-icon-trash"></i>
		  </span>				 
		 </div>		</div>	
			
			<?php  }
			 if($row->wgp_video_type==2){ 

			 	 $video_url = $row->wgp_video_source; 

						if(strchr($video_url,'youtube')){
							if(strchr($video_url,'embed')){
									$coverted_url =$video_url;
							} else{
								$url = $video_url;
								preg_match(
        								'/[\\?\\&]v=([^\\?\\&]+)/',
        								$url,
        								$matches
    								);
								 $id = $matches[1];
								$coverted_url= 'https://www.youtube.com/embed/'.$id;
							}
						}
						if(strchr($video_url,'wistia')){
							 if(strchr($video_url,'embed')){
									$coverted_url =$video_url;
							} else{
								$coverted_url="wistia link";
							}
						}	
						 	
				?>
			 	
			 <div class="col-md-6">
			 	<div id="video_id_<?php print_r( $row->wgp_video_id); ?>">
				<iframe width="100%" height="350px" name="<?php echo $row->wgp_video_title; ?>" src="<?php  echo $coverted_url; ?>" frameborder="0" allowfullscreen></iframe>

				<span class="delete_action button_action" onclick="deleteVideo( <?php print_r( $row->wgp_video_id); ?>)">
				<i class="uk-icon-trash"></i>
		  </span>
		</div>
			</div>

		<?php } else{ 

			} 

	   } } else{ ?>
			
		<div id="videos_preview"></div>
		<p>No video exits. Click add video.</p>
		<?php
		}
	?>

	<span id="delete_status"> </span>	
</div>
<script>
	// delete the selected video
    function deleteVideo(video_id)	
    {
		
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>uservideos/deleteVideo',
			data: {video_id:video_id},
		})
		.done(function(data){							 
				
				 $('#delete_status').css('color', 'green');        
                     $('#delete_status').show();
                     $('#delete_status').html(data);
                        setTimeout(function() {
                      $('#delete_status').slideUp('slow');
                      $('#video_id_'+video_id).slideUp('slow');                      
                      },2000);
                      return false; 
		})
	} 
</script>

<img style="display:none;" src="<?php echo base_url();?>assets/img/spinners/spinner.gif" id="loader" alt="loader" width="32" height="32">
<?php  
		   if($acc_type=='PRO'){
		      		$video_limit =10;
		      	}
		      else if($acc_type=='PLUS'){
		      	 $video_limit =5;
		       }
		       else{
		       	 $video_limit =1;
		       }
		  
		 if( $video_limit > $video_count) { ?>
		 	<div class="col-md-12" >
		 		<div class="row">
		 			<div class="col-md-4 add_video_div" >
		 			<button class="md-btn md-btn-primary adept-md-btn-primary" id="add_video" type="submit">Add Video</button> 
		 	   	</div>
		 	   </div>
		 </div>

	    <?php }else{
				echo "<h3 class=\"heading_b\">
				Your video limit exceed. For upload more please
			    Upgrade your account type!</h3>";
			     echo '<a href="'.base_url().'pricing/" target="_blank" class="uk-badge">Upgrade</a></div>';
			} ?>


<script>

$(document).ready(function(){
	$("#add_video").click(function(){
		$.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>video_controller/addVideoView',
            data: {},
          })
         .done(function(data){
              $("#main_tab_target").css({ display: "block" });
	          $("#sidetab_destination").css({ display: "none" });
	          $('#video').html(data);
	        })
	});
});
</script>