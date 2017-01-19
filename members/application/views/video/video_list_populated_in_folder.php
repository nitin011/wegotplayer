<div id="user_profile_gallery" data-uk-check-display class="uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4" data-uk-grid="{gutter: 4}">
	
	<?php
        if(is_array($video_list_result))
		{
			foreach($video_list_result as $row)
			{	?>		
			<div id="video_id_<?php print_r( $row->video_id); ?>">
				
				<a href="<?php echo base_url(); ?><?php print_r( $row->video_file); ?>"><img src="<?php echo base_url(); ?><?php print_r( $row->video_file); ?>" alt="video<?php print_r( $row->video_id); ?>" width="200px" height="200px"/></a>
				
				<p id="action_on_this_video">
					<span class="delete_action button_action" onclick="delete_video(<?php echo $row->video_id; ?>)"><i class="uk-icon-trash"></i></span>
				</p>

			</div>		
			<?php 
			} 
		}else
		{ 
		?>
		
		<div id="videos_preview"></div>
		<div><p>No video exits. Click add video.</p></div> 
		<?php
		}
	?>	
</div>
<script>
	// delete the selected video
    function delete_video(video_id)	
    {
		var folder_id=$("#folder_id").val();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>uservideofolder/delete_video_in_folder',
			data: {video_id:video_id, folder_id:folder_id},
		})
		.done(function(data){					
			$('#video').empty();
			$('#video').html(data);
		})
	} 
</script>


<style>
	input.video-finder {
    background: url('videos/icon-video-finder.png') no-repeat;
    height: 131px;
    width: 108px;
    text-indent: 110px;
	outline: 5px auto -webkit-focus-ring-color;
    outline-offset: -2px;
	}
	#videoopen {
    width: 100px; 		
	}
	#videoopen img {
    max-width: 100%;
    height: auto;
	}
	
	#videoopen .item {
    width: 120px;    
    max-height: auto;
    float: left;
    margin: 3px;
    padding: 3px;
	}
	
	#videoopen .circle-icon {
	background: none repeat scroll 0 0 #217393;
	border: 1px solid #217393; 
	color: #FFF;
	text-decoration:none;
	font-size: 16px;
	height: 24px; 
	text-align: center; 
	width: 100%;
	margin-bottom: 7px;
	float: left;
	margin-left: 7px;
	cursor: pointer;
	width: 93%;
	font-family: "dekar";
	}
	
	#videoopen .btn-primary{
	bottom: 100%;
	position: relative;
	height: 21px; 
	max-width: 80px;
	color: #FFF;
	background-color: #217393;
	border-color: #217393;
	box-shadow: 0 4px #115a77;
	cursor: pointer;
	left: 0;
	opacity: 0;
	outline: 0 none;
	z-index: 99;
	}
	
	.choosefile {
	margin: 40px 0px 0px 0px;
	}
	
	
</style>
<form  class="uploadform" id="idForm" method="post" enctype="multipart/form-data"  name="photo" >
<div class="uk-grid" data-uk-grid-margin="">
    <div class="uk-width-large-1-6 uk-width-medium-1-6">
        <div class="uk-input-group">
           <div class="md-input-wrapper">
			  <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id;?>">
	<input type="hidden" id="folder_id" name="folder_id" value="<?php echo $folder_id;?>">
	<input class="choosefile" type="file" name="videofile1" id="newphoto" onChange="loadFile(event)">
	<span class="sidebar-inner-icon" style="display:none;" id="videoopen">
		<div class="item"><img  id="output"></div>
		<a class="file-input-wrapper  fileinput circle-icon">Change Video <input type="file" title="Browse file" name="videofile2" id="videofile" class="fileinput btn-primary" onChange="loadFile(event)"></a>
	</span>
	<span id="msg"></span>
</div>
                                
         <div class="md-input-wrapper">
            <button class="md-btn md-btn-primary " id="uploadImagebutton" type="submit"> Upload Video </button>  
         </div>
	</div>
  </div>
        <div class="uk-width-large-1-4 uk-width-medium-1-4">
            <div class="uk-input-group">
                <div class="md-input-wrapper">
				
				</div>
            </div>
        </div>
        <div class="uk-width-large-1-2 uk-width-medium-1-2">
            <div class="uk-input-group">
                <div class="md-input-wrapper">
				<?php if(isset($status)){echo $status;}?>
				</div>
            </div>
        </div>                        
    </div>

</form>

<script>
	
	var loadFile = function(event) {
		
		var filetype=event.target.files[0].type;	
		if(filetype=='video/wav' || filetype=='video/mkv'){		
			}else{
			$('#video_error').show();
			$('#video_error').text("*Only mkv or wav formats are acceptable");
			setTimeout(function() {
				$('#video_error').hide('slow');
			},5000);		
			return false;
		}
		
		var output = document.getElementById('output');	
		output.src = URL.createObjectURL(event.target.files[0]);	
		var newvideo= 'newvideo';
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
		altair_helpers.retina_videos();
	});
</script>




