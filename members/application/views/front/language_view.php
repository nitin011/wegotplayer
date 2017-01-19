<h4>Languages   </h4>


<span id="languages">

    <div class="col-md-12">
       <ul class="md-list md-list-language">    

      <?php if(!empty($user_language)){

           foreach ($user_language as $row) {  ?>

            <li id="lan_row_<?php echo $row->id;?>">
               <div class="md-list-content"> 
                    <span class="md-list-heading md-list-heading-tod">
                         <div id="value_<?php echo $row->id; ?>"><?php echo $row->language; ?> </div>                       
                    </span>

                    <span class="uk-text-small content-data content-data-tod">
                      <b id="language_fill_star_<?php echo $row->id;?>">
                        <?php for($i=1;$i<=$row->level; $i++) {?>
                            <img src="<?php echo base_url(); ?>images/icon-star-fill.png">
                          <?php } ?>
                      </b>
                      <i><?php echo $row->level_name; ?> </i>
                    </span>

                </div>
            </li>           

          <?php  }  } else{

               echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable.  </h3>";
          }?>   
          </ul>
    </div>
   </span> 
   