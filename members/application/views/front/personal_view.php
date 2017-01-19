

<div class="ac_am_user_update_sport_right">  
             <div id="basic_deatil">
              <?php if(!empty($personal)){ 

                
                ?> 
             <ul>

             <li><a href="#"><b>Sport</b><i>:</i><span><?php echo $personal->sport_name; ?></span></a></li>

             <li><a href="#"><b>Level </b><i>:</i><span><?php echo $personal->level_name; ?></span></a></li>

             <li><a href="#"><b>Position</b><i>:</i><span><?php echo $personal->position_name; ?></span></a></li>

              <li><a href="#"><b>Foot</b><i>:</i><span><?php echo $personal->foot_name; ?></span></a></li>

               <li><a href="#"><b>Hand</b><i>:</i><span><?php echo $personal->hand_name; ?></span></a></li>


             <li><a href="#"><b>Height </b><i>:</i><span><?php echo $personal->height_name; ?></span></a></li>

             <li><a href="#"><b>Weight</b><i>:</i><span><?php echo $personal->weight_name; ?></span></a></li>

             <li>
                <?php $dob_full= $personal->birth_day.'-'.$personal->birth_month.'-'.$personal->birth_year; ?>
              <a href="#" title="<?php echo $dob_full; ?>"><b>Age </b><i>:</i>       

              <span>

              <?php 

                    $birth_year = $personal->birth_year; 
                    $current_year = date('Y');
                    $dob = $current_year-$birth_year;
                    echo $dob." years";
              ?></span></a></li>
            <li><a href="#"><b>Seeking </b><i>:</i><span> <?php echo $seek; ?> </span></a></li> 
             <li><a href="#"><b>Location </b><i>:</i><span><?php echo $personal->address; ?></span></a></li>

             </ul>    

              <div class="gradution">
                    <?php if($seeking_id==1 || $seeking_id==2){
                           echo '<h4>Class</h4> <h6>'.$personal->graduation_month.', '.$personal->graduation_year.'</h6></a>';
                       } ?>
                  </div>   

            </div>

          <?php } ?>
        </div>


  <script>

   $(document).ready(function () {
    $('#loader').hide();
       $("#edit_profile").click(function () {                
       tab_value=$("#edit_profile").attr("name");
       console.log(tab_value);
       if(tab_value=="edit") {
            $('#loader').show();            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userpersonal/editProfile',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $('#loader').hide();                  
                  $('#personal').html(data);
                })
              }
   });
  });

  </script>