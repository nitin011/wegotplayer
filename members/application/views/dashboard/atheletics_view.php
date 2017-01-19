<div class="uk-grid tab-section" data-uk-grid-margin>
  <div class="uk-width-medium-1">
    <div class="md-card ">
      <div class="user_content school-tab">
          <ul id="user_profile_tabs" class="uk-tab uk-tab-dark-mini" data-uk-tab="{connect:'#atheletics_tabs', animation:'slide-horizontal'}" >
              <li class="uk-active"><a href="#">PLAYER</a></li>
              <li><a href="#">RECORDS</a></li>
              <li><a href="#">TEAM INFO</a></li>              
              <li><a href="#">COMMENTS</a></li>                             
          </ul>
              <ul id="atheletics_tabs" class="uk-switcher uk-margin">
                  <li id="player">
                        
                  </li>

                  <li id="records_tab">
                        
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
             $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userplayer',
                      data: {},
                  })
                .done(function(data){                  
                  $('#player').html(data);
                })
            $("#user_profile_tabs li").click(function () {                
                var tab_value=$(this).text();
                               
                if(tab_value=="PLAYER") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userplayer',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#player').html(data);
                })
              }
              
                if(tab_value=="RECORDS") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>user_records',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#records_tab').html(data);
                })
              }


              if(tab_value=="TEAM INFO") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userteaminfo',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#team_info').html(data);
                })
              }

             

               if(tab_value=="COMMENTS") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>usercomment',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#comment').html(data);
                })
              }

           });
         });
     </script> 