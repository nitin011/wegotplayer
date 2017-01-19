<div class="col-md-12">
       <ul class="md-list md-list-language">      
      <?php if($user_language){
           foreach ($user_language as $row) {  ?>
            <li id="lan_row_<?php echo $row->id;?>">
               <div class="md-list-content">                    
                    <span class="md-list-heading md-list-heading-tod">
                         <div id="value_<?php echo $row->id; ?>"><?php echo $row->language; ?> </div>
                        <input type="text" value="<?php echo $row->language; ?>" id="language_<?php echo $row->id;?>" onblur="saveLanguage(<?php echo $row->id;?>)" class="form-control" style="display:none;">
                    </span>
                     
                    <span class="uk-text-small content-data content-data-tod">
                      <b id="language_fill_star_<?php echo $row->id;?>"><?php for($i=1;$i<=$row->level; $i++) {?>
                          <img src="<?php echo base_url(); ?>images/icon-star-fill.png">
                        <?php } ?>
                      </b>
                      <b id="language_blank_star_<?php echo $row->id;?>" style="display:none;"><?php for($i=1;$i<=5; $i++) {?>
                          <a onclick="updateStar(<?php echo $i.','.$row->id;?>)" id="edit_star_<?php echo $i.'_'.$row->id;?>"><img src="images/icon-star.png"></a>
                        <?php } ?>
                      </b>

                      <i><?php echo $row->level_name; ?> 
                        <span class="edit_icon" title="edit" onclick="editLanguage(<?php echo $row->id;?>)">
                         <i class="material-icons md-24">&#xE254;</i>
                       </span>
                        <span class="delete_icon" title="delete" onclick="deleteLanguage(<?php echo $row->id;?>)">
                         <i class="material-icons md-24">&#xE872;</i>
                       </span>
                      </i>

                      
                    </span>
                   
                </div>
            </li>            
          <?php  }  } ?>
          </ul>
    </div>
    
             