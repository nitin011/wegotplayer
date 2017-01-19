<form  class="uploadform" id="idForm" method="post" enctype="multipart/form-data"  name="photo" >
<div id="user_profile_gallery" data-uk-check-display class="uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4" data-uk-grid="{gutter: 4}">
	
	<?php if(is_array($image_list))
		{
			foreach($image_list as $row)
			{	?>		
			<div id="image_id_<?php echo $row->image_id; ?>">	
				<div class="md-card local_photo">
				<a href="<?php echo base_url(); ?><?php echo $row->image_file; ?>">
					<img src="<?php echo base_url(); ?><?php echo $row->image_file; ?>" alt="image<?php echo $row->image_id; ?>" width="200px" height="200px"/></a>
				
				<p id="action_on_this_image">
					<span class="action_delete button_action" onclick="deleteImage(<?php echo $row->image_id; ?>)"><i class="uk-icon-trash"></i></span>
					<span class="action_default button_action glyphicon glyphicon-plus" onclick="defaultImage(<?php echo $row->image_id; ?>)"></span>
					
				</p>
				</div>
			</div>		
			<?php 	}  }else {	?>

		<div id="images_preview"></div>
		<div><p>No image exits. Click add image.</p></div> 
		<?php  }	?>
	<div id="folder_div">
      <div class="md-card local_photo local_photo_add">
        <div class="md-input-wrapper">
		<input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id;?>">
		<input type="hidden" id="gallery_id" name="gallery_id" value="<?php echo $folder_id;?>">
		<input class="image-finder" type="file" name="imagefile1" id="newphoto1" onChange="loadFile(event)">
		<div class="sidebar-inner-icon" style="display:none;" id="imageopen1">
			<div class="item">
				<img  id="output_photo">
			</div>

		</div>
		<span id="msg"></span>
		</div> 
      </div>
	      <div class="input-wrapper-mds">
	    	<a class="file-input-wrapper  fileinput circle-icon" style="display:none;">Change Image 
					<input type="file" title="Browse file" name="imagefile2" id="imagefile" class="fileinput btn-primary" onChange="loadFile(event)">
				</a>
	          <button class="md-btn md-btn-primary adept-md-btn-primary" id="uploadImagebutton" type="submit"> Upload Image </button>  
	     </div>
	     </form>
    </div>	
</div>



<div class="uk-grid" data-uk-grid-margin="">
  <div class="uk-width-large-1-6 uk-width-medium-1-6">
    <div class="uk-input-group">
    
                                
    
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


	<img src="<?php echo base_url();?>images/loader.gif" alt="loading..." id="loader">

	

<script>
	// delete the selected image
    function deleteImage(image_id)	
    {
		var gallery_id=$("#gallery_id").val();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>userphotos/deleteImage',
			data: {image_id:image_id, gallery_id:gallery_id},
		})
		.done(function(data)
		{
			$('#photo').html(data);
		})
	} 
	//Making image default 
	
	function defaultImage(image_id)	
    {
		var gallery_id=$("#gallery_id").val();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>userphotos/defaultImage',
			data: {image_id:image_id, gallery_id:gallery_id},
		})
		.done(function(data){					
			if(data==0){
			  alert('Some error occurred. Please try again.');
			}else if(data==1){
			  alert('Image set as default successfully.');
			  var href="<?php echo base_url();?>home";
			  window.location=href;
			}
		})
	} 
</script>
<script>
	
	var loadFile = function(event) {
		
		var filetype=event.target.files[0].type;	
		if(filetype=='image/png' || filetype=='image/jpeg'){		
			}else{
			$('#photo_error').show();
			$('#photo_error').text("*Only PNG or JPEG formats are acceptable");
			setTimeout(function() {
				$('#photo_error').hide('slow');
			},5000);		
			return false;
		}
		
		var output = document.getElementById('output_photo');	
		output.src = URL.createObjectURL(event.target.files[0]);	
		var newphoto1 = 'newphoto1';
		document.getElementById(newphoto1).style.display = 'none';
		var imageopen1 = 'imageopen1';
		document.getElementById(imageopen1).style.display = 'block';
	};//function end
	
</script>


<script>
$(document).ready(function() {
	$("#loader").hide();
	$("form#idForm").submit(function(){
		$("#loader").show();	 
		 var formData = new FormData($(this)[0]);

		 var url = "<?php echo base_url();?>userphotos/insertAlbumImage";

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
		  $("#loader").hide();			
			$('#photo_view').empty();
			$('#photo_view').html(data);
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




