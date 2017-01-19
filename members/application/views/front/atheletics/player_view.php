<div class="uk-grid tab-section" data-uk-grid-margin>
  <div class="uk-width-medium-1">
    <div class="md-card ">
      <div class="user_content school-tab">
          <ul id="user_profile_tabs" class="uk-tab uk-tab-left" data-uk-tab="{connect:'#player_tabs', animation:'slide-horizontal'}" >
              <li class="uk-active"><a href="#">Technical</a></li>
              <li><a href="#">Tactical</a></li>
              <li><a href="#">Physical</a></li>
              <li><a href="#">Psyhosocial</a></li>  
              <li><a href="#">Stats</a></li> 
              <li><a href="#">Injuries</a></li>                          
          </ul>
              <ul id="player_tabs" class="uk-switcher uk-margin uk-switcher-ath">
                  <li id="technical">
                        
                  </li>
                  <li id="tactical">
                    
                  </li>
                   <li id="physical">
                    
                  </li>
                   <li id="psyhosocial">
                    
                  </li>  
                  <li id="stats">
                    
                  </li> 
                  <li id="injuries">
                    
                  </li>              
                  
              </ul>
          </div>              
        </div>
      </div>      
    </div>    
 </div>

<script src="<?php echo base_url(); ?>assets/js/common.min.js"></script>    
<script src="<?php echo base_url(); ?>assets/js/uikit_custom.min.js"></script>

<script>
     $(document).ready(function () {
        $("#user_profile_tabs li").click(function () {                
            var tab_value=$(this).text();
            console.log(tab_value); 
            if(tab_value=="Technical") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_atheletics/technicalView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#technical').html(data);
                })
              }//end technical function

              if(tab_value=="Tactical") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_atheletics/tacticalView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#tactical').html(data);
                })
              }//end Tactical function

              if(tab_value=="Physical") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_atheletics/physicalView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#physical').html(data);
                })
              }//end Physical function

              if(tab_value=="Psyhosocial") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_atheletics/psyhosocialView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#psyhosocial').html(data);
                })
              }//end Psyhosocial function
              if(tab_value=="Stats") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_atheletics/statsView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#stats').html(data);
                })
              }//end Stats function
              if(tab_value=="Injuries") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_atheletics/injurView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#injuries').html(data);
                })
              }//end Injuries function

          });
        });
     </script> 