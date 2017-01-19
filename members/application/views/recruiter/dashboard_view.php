<div class="uk-grid" data-uk-grid-margin>
  <div class="uk-width-medium-1">
    <div class="md-card ">
      <div class="user_content">
          <ul id="profile_tabs" class="uk-tab" data-uk-tab="{connect:'#user_tabs', animation:'slide-horizontal'}" >
            
              <li class="uk-active"><a href="#">Personal</a></li>
              
    
          </ul>
              <ul id="user_tabs" class="uk-switcher uk-margin">
                  
                  <li id="personal">
                    
                  </li>                 
                  
              </ul>
          </div>              
        </div>
      </div>      
    </div>    
 </div>

  <script>
   window.onload = function() { 

             var tab_value="Personal";         
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>recruiter/profile',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $('#personal').html(data);
                })           
      }//end onload personal function



   $(document).ready(function () {
            $("#profile_tabs li").click(function () {                
                var tab_value=$(this).text();
                console.log(tab_value); 
               
              if(tab_value=="Personal") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>recruiter/profile',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $('#personal').html(data);
                })
              }

              

              });
          });
              
              
  </script>

  
   