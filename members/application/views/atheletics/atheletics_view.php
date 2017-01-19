<div class="uk-grid tab-section" data-uk-grid-margin>
  <div class="uk-width-medium-1">
    <div class="md-card ">
      <div class="user_content school-tab">
          <ul id="user_profile_tabs" class="uk-tab" data-uk-tab="{connect:'#atheletics_tabs', animation:'slide-horizontal'}" >
              <li class="uk-active"><a href="#">PLAYER</a></li>
              <li><a href="#">TEAM INFO</a></li>
              <li><a href="#">COMMENTS</a></li>                             
          </ul>
              <ul id="atheletics_tabs" class="uk-switcher uk-margin">
                  <li id="player">
                        
                  </li>
                  <li id="team_info">
                    
                  </li>
                   
                   <li id="comment">
                    
                  </li>                 
                  
              </ul>
          </div>              
        </div>
      </div>      
    </div>    
 </div>

  <script>
     $(document).ready(function () {
            $("#user_profile_tabs li").click(function () {                
                var tab_value=$(this).text();
                console.log(tab_value);                
                if(tab_value=="PLAYER") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_atheletics/playerView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#player').html(data);
                })
              }

              if(tab_value=="TEAM INFO") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_atheletics/teaminfoView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#team_info').html(data);
                })
              }

             

               if(tab_value=="COMMENTS") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_atheletics/commentView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#comment').html(data);
                })
              }

           });
         });
     </script> 