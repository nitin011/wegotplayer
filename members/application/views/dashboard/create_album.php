<div class="md-card">
    <div class="md-card-content">
      <h3 class="heading_a"><?php echo ucwords($name)."'s ";?>Album</h3>
       <div data-uk-grid-margin="" class="uk-grid">
          <div class="uk-width-large-1-3 uk-width-medium-1-3">
            <div class="uk-input-group">
              <div class="md-input-wrapper">
  								<label>Album Name</label>
  								<input type="text" id="album" name="album" value =""  class="md-input" >
  						</div>
             </div>
           </div>
            <div class="uk-width-large-1-3 uk-width-medium-1-3">
                <div class="uk-input-group">
                  <div class="md-input-wrapper">
								     <button type="button" id="save" value="save" onclick="addAlbum()" class="md-btn md-btn-primary adept-md-btn-primary right">Save</button> 
								  </div>
                </div>
            </div>
            <div class="uk-width-large-1-3 uk-width-medium-1-3">
               <div class="uk-input-group">
                 <div class="md-input-wrapper">
								    <button type="button" id="delete" value="delete" onclick="deleteAlbum()" class="md-btn md-btn-primary adept-md-btn-primary right">Delete</button> 
								  </div>
                </div>
            </div>
         </div>
      </div>
  </div>                        
 <script src="<?php echo base_url(); ?>assets/js/common.min.js"></script>    
<script src="<?php echo base_url(); ?>assets/js/uikit_custom.min.js"></script>   
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>

<script>
 function addAlbum()
 {	
    var album_name = $("#album").val();
	   $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>userphotos/createAlbum',			  
              data: {album_name:album_name},
            })
            .done(function(data){			
                $('#photo').html(data);
            })
  }  
</script>  

