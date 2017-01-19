<div class="uk-grid" data-uk-grid-margin>
  <div class="uk-width-medium-1">
    <div class="md-card setting_view">
      <div class="user_content user_content_friend">
          <ul id="friend_tabs" class="uk-tab uk-tab-dark-mini uk-tab-dark-mini-adpt-loss" data-uk-tab="{connect:'#user_tabs', animation:'slide-horizontal'}" >
            
              <li class="uk-active"><a href="#">Friends</a></li>
              <li><a href="#">Friend Requests</a></li>
              <li><a href="#">My Request</a></li>             
    
          </ul>
              <ul id="user_tabs" class="uk-switcher uk-margin">
                  
                  <li id="frnd_list">
                    
                  </li>
                   <li id="frnd_req">
                    
                  </li>
                   <li id="my_request">
                    
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
               url: '<?php echo base_url(); ?>friendcontroller/showFriendView',
               data: {},
            })
         .done(function(data){
              $('#frnd_list').html(data);
         })

            $("#friend_tabs li").click(function () {                
                var tab=$(this).text();            
               
              if(tab=="Friends") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url();?>friendcontroller/showFriendView',
                      data: {tab_value:tab},
                  })
                .done(function(data){
                  $('#frnd_list').html(data);
                })
              }

              if(tab=="Friend Requests") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url();?>friendcontroller/showFriendRequestView',
                      data: {tab_value:tab},
                  })
                .done(function(data){
                  $('#frnd_req').html(data);
                })
              }

              if(tab=="My Request") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url();?>friendcontroller/showMyRequestView',
                      data: {tab_value:tab},
                  })
                .done(function(data){
                  $('#my_request').html(data);
                })
              }

            });
         });

 </script>