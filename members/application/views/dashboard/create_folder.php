   <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a">Create new folder</h3>
                    
                    <div data-uk-grid-margin="" class="uk-grid">
                        <div class="uk-width-large-1-3 uk-width-medium-1-3">
                            <div class="uk-input-group">
                                <div class="md-input-wrapper">
								<label>Folder name</label>
								<input type="text" id="foldername_id" name="folder_name" value =""  class="md-input" >
								</div>
                                
                            </div>
                        </div>
                        <div class="uk-width-large-1-3 uk-width-medium-1-3">
                            <div class="uk-input-group">
                                <div class="md-input-wrapper">
								<button type="button" id="save" value="save" onclick="addFoldername()" class="md-btn md-btn-primary adept-md-btn-primary right">Save</button> 
								</div>
                            </div>
                        </div>
                        <div class="uk-width-large-1-3 uk-width-medium-1-3">
                            <div class="uk-input-group">
                                <div class="md-input-wrapper">
								<button type="button" id="delete" value="delete" onclick="addTestScore()" class="md-btn md-btn-primary right">Delete</button> 
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
 function  addFoldername(){
	
    //$("#save").hide();
   var folder_val = $("#foldername_id").val();
	$.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>userimagefolder/createImageFolder',
			  
              data: {folder_val:folder_val},
            })
          .done(function(data){
			 $('#photo').empty();
             $('#photo').html(data);
          })
              } 
 
</script>  

