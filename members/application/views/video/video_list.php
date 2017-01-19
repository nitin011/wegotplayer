	
<div id="user_profile_gallery" data-uk-check-display class="uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4" data-uk-grid="{gutter: 4}">
	
	<?php
        if(is_array($video_list_result))
		{
			$video_count = count($video_list_result);
			foreach($video_list_result as $row)
			{	
			  if($row->wgp_video_type==1) {?>		
		<div class="uk-width-medium-1-2">
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
			 	
			 <div class="uk-width-medium-1-2">
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
		  
		 if( $video_limit > $video_count) {
			?>
<form  class="uploadform" id="idForm" method="post" enctype="multipart/form-data"  name="photo" >
	<div class="col-md-12" data-uk-grid-margin="">
			<div class="col-md-4">	
				<div class="md-input-wrapper">
					<input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id;?>">
					<input type="hidden" id="gallery_id" name="gallery_id" value="<?php echo $folder_id;?>">
		            <div class="myLabel">
						<input type="file" name="videofile1" id="newphoto" onChange="loadFile(event)">
		            	<span>Browse Video</span>
		          	</div>
					<span class="sidebar-inner-icon" style="display:none;" id="videoopen">
						<div class="item"><img  id="output_video"></div>
						<a class="file-input-wrapper  fileinput circle-icon"><input type="file" title="Browse file" name="videofile2" id="videofile" class="fileinput btn-primary" onChange="loadFile(event)"></a>
					</span>
					<span id="msg"></span>				
			
							
				<div class="md-input-wrapper md-input-wrapper-btn">
					<button class="md-btn md-btn-primary adept-md-btn-primary" id="uploadImagebutton" type="submit"> Upload Video</button>  
				</div>	
			</div>			
		</div>	

<div class="col-md-4">    
    <a class="md-btn md-btn-primary adept-md-btn-primary" data-uk-modal="{target:'#modal_header_footer'}">Upload Video Link</a>
</div>		
<span><?php if(isset($status12)){echo $status12;}?> </span>
<div class="uk-modal" id="modal_header_footer">
        <div class="uk-modal-dialog">
            <div class="uk-modal-header">
                <h3 class="uk-modal-title">Submit Youtube or other Website Video URL </h3>
            </div>
            <div class="uk-width-medium-1">
                <div class="uk-form-row">
                     <label>Video Name</label>
                         <input type="text" class="md-input" id="video_name" />
                   </div>
                  <div class="uk-form-row">
                        <label>URL</label>
                        <input type="text" class="md-input"  id="video_url"/>
                    </div>
              </div>
            <div class="uk-modal-footer uk-text-right">
                <button type="button" class="md-btn md-btn-danger uk-modal-close">Cancel</button>
                <button type="button" class="md-btn md-btn-primary adept-md-btn-primary" id="video_link_submit">Submit</button>
            </div>
        </div>
    </div>

</form>

<div class="col-md-4">
	<div class="md-input-wrapper">
	<form  id="wistia_form" method="POST" enctype="multipart/form-data"  name="wistia_form" >		
		<input type="hidden" id="gallery_id" name="gallery_id" value="<?php echo $folder_id;?>">
		<div class="myLabel myLabel-long">
			<input type="file" name="wistia_video_upload">
	    	<span>Browse Video</span>
	  	</div>
	  	<div class="md-input-wrapper md-input-wrapper-btn">
			<button type="submit" name="upload_video" class="md-btn md-btn-primary adept-md-btn-primary">Upload on  Wistia</button>
		</div>
	 </form>

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
	
	var loadFile = function(event) {
		
		var filetype=event.target.files[0].type;	
		if(filetype=='video/mp4'){		
			}else{
			$('#video_error').show();
			$('#video_error').text("*Try different video format");
			setTimeout(function() {
				$('#video_error').hide('slow');
			},5000);		
			return false;
		}
		
		var output = document.getElementById('output_video');	
		output.src = URL.createObjectURL(event.target.files[0]);	
		var newvideo = 'newvideo';
		document.getElementById(newphoto).style.display = 'none';
		var videoopen = 'videoopen';
		document.getElementById(videoopen).style.display = 'block';
	};//function end
	
</script>

<script>
	$(document).ready(function() {
		
		$("form#idForm").submit(function(){

			
			var formData = new FormData($(this)[0]);
			
			var url = "<?php echo base_url();?>uservideos/uploadeVideo"; 
			// the script where you handle the form input.
			$.ajax({
				url: url,
				type: 'POST',
				data: formData,
				async: false,
				success: function (data) {},
				cache: false,
				contentType: false,
				processData: false
			})
			.done(function(data){					
				$('#video').empty();
				$('#video').html(data);
			});
		});
		
	}); //End function  	
	
</script>

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

<script>

$(document).ready(function() {		
		$("#video_link_submit").click(function(){

	var video_name=$("#video_name").val();
	var	video_url=$("#video_url").val();
	var	gallery_id=$("#gallery_id").val();
	

	if((video_name!='')&&(video_url!=''))
	$.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>uservideos/insertVideoLink',
              data: {name:video_name,url:video_url,gallery_id:gallery_id},
            })
          .done(function(data){
             $('#msg').html(data);
             $('#modal_header_footer').hide();
          });
	});
});

</script>

<script>
$("form#wistia_form").submit(function(){
			altair_helpers.content_preloader_show('regular');
			var formData = new FormData($(this)[0]);
			

			var url = "<?php echo base_url();?>uservideos/uploadVideoWistia"; 
			$("#loader").show();
			// the script where you handle the form input.
			$.ajax({
				url: url,
				type: 'POST',
				data: formData,
				async: false,
				success: function (data) {},
				cache: false,
				contentType: false,
				processData: false
			})
			.done(function(data){	
					altair_helpers.content_preloader_hide();				
				$('#video').empty();
				$('#video').html(data);
			});
			

});
</script>


