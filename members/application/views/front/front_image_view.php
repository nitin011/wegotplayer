<h4>Photos</h4> 

   <div id="user_profile_gallery" data-uk-check-display class="uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4" data-uk-grid="{gutter: 4}">
     
   <?php if(!empty($image_list)){
        foreach($image_list as $row)
        {
   ?> 
      <div>
           <a href="<?php echo base_url().$row->image_file; ?>">
           <img class="pho_high" src="<?php echo base_url().$row->image_file; ?>" alt=""/>
      </a>
     </div>

    <?php  } 

      }else{

           echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable.</h3>";
      } ?>
  </div>
  <script src="<?php echo base_url(); ?>assets/js/pages/page_user_profile.min.js"></script>
