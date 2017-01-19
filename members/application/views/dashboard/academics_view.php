
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
              <li><a href="#">LANGUAGES</a></li>               
          </ul>
              <ul id="academic_tabs" class="uk-switcher uk-margin">
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
                   <li id="languages">
                    
                  </li>
                  
              </ul>
          </div>              
        </div>
      </div>      
    </div>    
 </div>

<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>

  <script>

     $(document).ready(function () {
            $("#user_profile_tabs li").click(function () {                
                var tab_value=$(this).text();
                console.log(tab_value);
                //fetch view of  School
                if(tab_value=="SCHOOL") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userschool',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  //$('#about').empty();
                  $('#school').html(data);
                })
              }
              //fetch view of test score
              if(tab_value=="TEST SCORES") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>usertestscore',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $('#testscore').html(data);
                })
              }
              //fetch view of TRANSCRIPTS
              if(tab_value=="TRANSCRIPTS") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>usertranscripts',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $('#transcripts').html(data);
                })
              }

               //fetch view of HONORS
              if(tab_value=="HONORS") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userhonors',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $('#honors').html(data);
                })
              }

                //fetch view of Leadership
              if(tab_value=="LEADERSHIP") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userleadership',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $('#leaderships').html(data);
                })
              }
               //fetch view of Leadership
              if(tab_value=="LANGUAGES") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>user_language',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $('#languages').html(data);
                })
              }

           });
         });
     </script>