<div class="uk-grid tab-section" data-uk-grid-margin>
  <div class="uk-width-medium-1">
    <div class="md-card ">
      <div class="user_content school-tab">
          <ul id="user_profile_tabs" class="uk-tab uk-tab-dark-mini" data-uk-tab="{connect:'#academic_tabs', animation:'slide-horizontal'}" >
              <li class="uk-active"><a href="#">SCHOOL</a></li>
              <li><a href="#">TEST SCORES</a></li>
              <li><a href="#">TRANSCRIPTS</a></li>
              <li><a href="#">HONORS</a></li>
              <li><a href="#">LEADERSHIP</a></li>                
          </ul>
              <ul id="academic_tabs" class="uk-switcher uk-margin academic_tabs">
                  <li id="school">
                        
                  </li>
                  <li id="testscore"> 
                    
                  </li>
                   <li id="transcripts"> 

                  </li>
                   <li id="honors">
                    
                  </li>
                   <li id="leaderships"> 
                    
                  </li>
                  
              </ul>
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
                      url: '<?php echo base_url(); ?>front_academics/schoolView',
                      data: {},
                  })
                .done(function(data){
                  $('#school').html(data);
                  //$('#school').attr('display','block');
                }) 

            $("#user_profile_tabs li").click(function () {                
                var tab_value=$(this).text();
                console.log(tab_value); 
               
              if(tab_value=="SCHOOL") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_academics/schoolView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                 
                  $('#school').html(data);

                })
              }
              if(tab_value=="TEST SCORES") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_academics/testscoreView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#testscore').html(data);

                })
              }

              if(tab_value=="TRANSCRIPTS") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_academics/transcriptsView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#transcripts').html(data);

                })
              }
               if(tab_value=="HONORS") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_academics/honorsView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#honors').html(data);

                })
              }
              if(tab_value=="LEADERSHIP") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_academics/leadershipView',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){                  
                  $('#leaderships').html(data);

                })
              }

    });
  });
 </script>

