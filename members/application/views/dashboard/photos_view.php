ata-uk-grid-margin="" data-uk-sortable="" id="dashboard_sortable_cards" class="uk-grid uk-grid-width-small-1-2 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-5 uk-text-center uk-sortable sortable-handler">
    
    <div id="folder_div">
      <div class="md-card local_photo local_photo_add">
        <button type="button" id="add" value="add" onclick="addGallery()" class="md-btn md-btn-primary button_local_photo_add">Add Gallery</button> 
      </div>
    </div>
    <?php if(is_array($folder_result))
            {     
              foreach($folder_result as $row){ //print_r($row); ?>      
      
      <div id="folder_div_<?php print_r($row['folder_id']); ?>">
        <span class="action_delete button_action" onclick="deleteFolder(<?php print_r($row['folder_id']); ?>))"></span>
        <div class="md-card local_photo">
            <a onclick="openImageFolder(<?php print_r($row['folder_id']); ?>)">
              <img src="<?php echo base_url(); ?>images/gallery.png">
              <p>
                <span><?php print_r(ucwords($row['folder_path']));?></span>
                <i><?php print_r($row['folder_image_count']);?> Photos</i></p>             
            </a>      
        </div>
      </div> 

      <?php }  } else  {  ?>

    <div id="folder_div">
      <div class="md-card">
        <div class="md-card-content">
          <p>No folder exits. Click on the botton to create folder.</p>
        </div>       
      </div>
    </div> 
    
    <?php   }  ?>   
</div>




<script>
 function openImageFolder(folder_id){
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>userphotos/getFolderImage',
      data: {folder_id:folder_id},
    })
    .done(function(data){         
      $('#photo').empty();
      $('#photo').html(data);
    });
  }

  function deleteFolder(folder_id){
    alert(folder_id);
  } 
  
  function addGallery(){
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>userphotos/createGalleryView',
      data: {},
    })
    .done(function(data){     
      $('#photo').html(data);
    });
  } 
</script>