<h4>Videos</h4> 

      <div id="video_view">

     <?php  

     if(is_array($video_list)) {

        $video_count = count($video_list);

                  foreach($video_list as $row) {  

               if($row->wgp_video_type==1) {
      ?>    

    <div class="col-md-6 space-left-none">
      <div class="video_main_div"> 

          <p class="video-title" id="v_t_<?php print_r( $row->wgp_video_id); ?>"><?php echo $row->wgp_video_title; ?></p>    
                    <?php $video_url=base_url().$row->wgp_video_source; ?>
                  <video width="100%" height="auto" controls >
                     <source src="<?php print_r( $video_url); ?>" type="video/mp4">
              <source src="<?php print_r( $video_url); ?>" type="video/ogg">
              Your browser does not support HTML5 video.
            </video>
         </div> 
     </div> 

    <?php  } 
         if($row->wgp_video_type==2){ 

         $video_url = $row->wgp_video_source; 

            if(strchr($video_url,'youtube')){

              if(strchr($video_url,'embed')){

                  $coverted_url =$video_url;

              } else{
                  $url = $video_url;
                  preg_match('/[\\?\\&]v=([^\\?\\&]+)/',$url,$matches);
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

        
        <div class="col-md-6 space-left-none">
              <div id="video_id_<?php print_r( $row->wgp_video_id); ?>" class="video_main_div">
                    <p class="video-title" id="v_t_<?php print_r( $row->wgp_video_id); ?>"><?php echo $row->wgp_video_title; ?></p>    
                <iframe width="100%" height="auto" name="<?php echo $row->wgp_video_title; ?>" src="<?php  echo $coverted_url; ?>" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>



  <?php }  } } else{ ?>

          <h3 class="heading_b heading_b_c uk-margin-bottom">Data Not Avilable.</h3>

    <?php

    }

  ?>

</div>