<div class="uk-grid tab-section" data-uk-grid-margin>
  <div class="uk-width-medium-1">
    <div class="md-card ">
      <div class="user_content school-tab">
        <div class="area_slide_sec">
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
</div>


<script src="<?php echo base_url(); ?>assets/js/common.min.js"></script>    
<script src="<?php echo base_url(); ?>assets/js/uikit_custom.min.js"></script>   
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>


<script>
     $(document).ready(function () {
          $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>usertechnical',
                      data: {},
                  })
                .done(function(data){                  
                  $('#technical').html(data);
                })

        $("#user_profile_tabs li").click(function () {                
            var tab_value=$(this).text();
           
            if(tab_value=="Technical") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>usertechnical',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#technical').html(data);
                })
              }//end technical function

              if(tab_value=="Tactical") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>usertactical',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#tactical').html(data);
                })
              }//end Tactical function

              if(tab_value=="Physical") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userphysical',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#physical').html(data);
                })
              }//end Physical function

              if(tab_value=="Psyhosocial") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userpsyhosocial',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#psyhosocial').html(data);
                })
              }//end Psyhosocial function
              if(tab_value=="Stats") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userstats',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#stats').html(data);
                })
              }//end Stats function
              if(tab_value=="Injuries") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userinjur',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#injuries').html(data);
                })
              }//end Injuries function

          });
        });
     </script> 