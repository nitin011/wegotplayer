<div class="col-md-2 space-none">
  <a href="<?php echo base_url(); ?>pricing" target="_blank" class="upgrate_acc">Upgrade Profile</a>
  <div class="player_info">
    <ul>
      <li><span>Sport</span> <i><?php print_r($personal_info->sport); ?></i></li>
      <li><span>Level</span> <i><?php print_r($personal_info->level); ?></i></li>
      <li><span>Position</span> <i><?php print_r($position); ?></i></li>
      <li><span>Height</span> <i><?php print_r($personal_info->height); ?></i></li>
      <li><span>Weight</span> <i><?php print_r($personal_info->weight); ?></i></li>      
      <li><span>Gender</span> <i><?php if($personal_info->gender==1){echo "Male";}else{echo "Female";} ?></i></li>
      <li><span>Age</span> <i><?php $year=$personal_info->birth_year; $current_year= Date('Y'); echo $age= ($current_year-$year);?></i></li>
      <li><span>Nationality</span> <i><?php print_r($personal_info->nationality); ?></i></li>
      <li><span>Seeking</span> <i><?php echo $seeking; ?></i></li>
      <li><span>Location</span> <i><?php print_r($personal_info->location); ?></i></li>
    </ul>
    
  </div>

<div class="side_tab">
    <ul id="side_tab">
      <li id="side_search">Search</li>
      <li id="side_invite_player">Invite Players</li>
      <li id="side_share_profile">Share Profile</li>
      <li id="side_expert_advice">Expert Advice</li>     
    </ul>    
  </div>

</div>


<div class="col-md-10 space-none-right" data-uk-grid-margin>
  <div class="uk-width-medium-1">
    <div class="md-card">
      <div class="" id="main_tab_target">
          
              <ul id="user_tabs" class="uk-switcher uk-margin">
                  <li id="wall_post">
                    
                  </li>
                  <li id="personal">
                    
                  </li>
                   <li id="academics">
                    
                  </li>
                   <li id="atheletics">
                    
                  </li>
                   <li id="calendar" class="cal_space">
                    
                  </li>
                  <li id="photo" class="pho_space">
                     
                  </li>
                  <li id="video" class="pho_space">
                        
                  </li>
                   <li id="resume">
                        
                  </li>
                  <li id="references">
                    
                  </li>
              </ul>
                   
        </div>
        <div id="sidetab_destination"></div> 
      </div>      
    </div> 
    </div>   
    

</div>


  <script>
   
   $(document).ready(function () {  

      $.ajax({
          type: 'POST',
          url: '<?php echo base_url(); ?>userwallpost',
          data: {},
        })
        .done(function(data){
             $('#wall_post').html(data);            

         })      

            $("#user_profile_tabs li").click(function () {                
                var tab_value=$(this).text();
                console.log(tab_value); 
               
              if(tab_value=="Personal") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userpersonal',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $("#main_tab_target").css({ display: "block" });
                  $("#sidetab_destination").css({ display: "none" });
                  $('#personal').html(data);
                })
              }else if(tab_value=="WallPost") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userwallpost',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $("#main_tab_target").css({ display: "block" });
                  $("#sidetab_destination").css({ display: "none" });
                  $('#wall_post').html(data);
                  
                })
              }else if(tab_value=="Academics") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useracademics',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $("#main_tab_target").css({ display: "block" });
                  $("#sidetab_destination").css({ display: "none" });
                  $('#academics').html(data);
                })
              }else if(tab_value=="Academics") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userschool',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  //$('#about').empty();
                  $("#main_tab_target").css({ display: "block" });
                  $("#sidetab_destination").css({ display: "none" });
                  $('#school').html(data);
                })
              } else if(tab_value=="Athletics") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useratheletics',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $("#main_tab_target").css({ display: "block" });
                  $("#sidetab_destination").css({ display: "none" });
                  $('#atheletics').html(data);
                })
              }else if(tab_value=="Schedule") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>usercalendar',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $("#main_tab_target").css({ display: "block" });
                  $("#sidetab_destination").css({ display: "none" });
                  $('#calendar').html(data);
                })
              }else if(tab_value=="Photos") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userphotos',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $("#main_tab_target").css({ display: "block" });
                  $("#sidetab_destination").css({ display: "none" });
                  $('#photo').html(data);
                })
              }else if(tab_value=="Videos") {            
                 $.ajax({
                      type: 'POST',
                     // url: '<?php echo base_url(); ?>uservideos',
                       url: '<?php echo base_url(); ?>video_controller',
                      data: {},
                  })
                .done(function(data){
                  $("#main_tab_target").css({ display: "block" });
                  $("#sidetab_destination").css({ display: "none" });
                  $('#video').html(data);
                })
              }else if(tab_value=="Resume") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userresume',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $("#main_tab_target").css({ display: "block" });
                  $("#sidetab_destination").css({ display: "none" });
                  $('#resume').html(data);
                })
              }else if(tab_value=="References") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userreferences',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){   
                $("#main_tab_target").css({ display: "block" });
                  $("#sidetab_destination").css({ display: "none" });               
                  $('#references').html(data);
                })
              }

              });

            $("#side_search").click(function () {             
                $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>search_controller/searchView',
                      data: {},
                  })
                .done(function(data){
                  $('#sidetab_destination').empty();
                  $('#sidetab_destination').html(data);
                   $("#main_tab_target").css({ display: "none" });
                   $("#sidetab_destination").css({ display: "block" });
                })
            });
           $("#side_invite_player").click(function () {  
                $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>home/inviteFriends',
                      data: {},
                  })
                .done(function(data){
                  $('#sidetab_destination').empty();
                  $('#sidetab_destination').html(data);
                  $("#main_tab_target").css({ display: "none" });
                   $("#sidetab_destination").css({ display: "block" });
                })
           });

           $("#side_share_profile").click(function () {  
                $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>home/shareProfileView',
                      data: {},
                  })
                .done(function(data){
                  $('#sidetab_destination').empty();
                  $('#sidetab_destination').html(data);
                  $("#main_tab_target").css({ display: "none" });
                   $("#sidetab_destination").css({ display: "block" });
                })
           });

            $("#side_expert_advice").click(function () {  
                $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>home/expertAdviceView',
                      data: {},
                  })
                .done(function(data){
                  $('#sidetab_destination').empty();
                  $('#sidetab_destination').html(data);
                  $("#main_tab_target").css({ display: "none" });
                  $("#sidetab_destination").css({ display: "block" });
                })
           });
           


          });
              
              
  </script>

  
   