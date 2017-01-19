 <h4>Athletics </h4>

 <?php if(!empty($teaminfo)){ ?>
     <div class="inner">
        <ul>
            <li><b>TEAM NAME</b><i>:</i>
                <span><?php echo $teaminfo[0]->team_name; ?></span>
            </li>
            <li><b>LEVEL</b><i>:</i>
                <span><?php echo $teaminfo[0]->level_name; ?></span>
            </li>
            <li><b>Jersey Number</b><i>:</i>
                <span><?php echo $teaminfo[0]->jersey_number; ?></span>
            </li>
            <li><b>Competition</b><i>:</i>
                <span><?php echo $teaminfo[0]->competition_name; ?></span>
            </li>

             <li><b>Division</b><i>:</i>
                <span><?php echo $teaminfo[0]->division_name; ?></span>
            </li>
             <li><b>Team home color uniform</b><i>:</i>
                <span><?php echo $teaminfo[0]->team_home_uniform_name; ?></span>
            </li>
             <li><b>Team away color uniform</b><i>:</i>
                <span><?php echo $teaminfo[0]->team_away_color_name; ?></span>
            </li>
            
           <span id="teaminfo_more_detail">
                <li><b>STYLE OF PLAY</b><i>:</i>
                <span><?php echo $teaminfo[0]->style_of_play_name; ?></span>
            </li>
            <li><b>COLLEGE ELIGIBILITY</b><i>:</i>
                <span><?php echo $teaminfo[0]->playing_eligibility; ?></span>
            </li>
            <li><b>COACH NAME</b><i>:</i>
                <span><?php echo $teaminfo[0]->head_coach_full_name; ?></span>
            </li>
              <li><b>COACH EMAIL</b><i>:</i>
                <span><?php echo $teaminfo[0]->coach_email; ?></span>
            </li>
              <li><b>Favorite Sports Ground</b><i>:</i>
                <span><?php echo $teaminfo[0]->favortite_sports_ground_name; ?></span>
            </li>
              <li><b>Coach Phone </b><i>:</i>
                <span><?php echo $teaminfo[0]->coach_phone; ?></span>
            </li>
              <li><b>Favorite Sports Ground</b><i>:</i>
                <span><?php echo $teaminfo[0]->favortite_sports_ground_name; ?></span>
            </li>
              <li><b>Coach Phone </b><i>:</i>
                <span><?php echo $teaminfo[0]->coach_phone; ?></span>
            </li>
              <li><b>Team Address</b><i>:</i>
                <span><?php echo $teaminfo[0]->team_home_address; ?></span>
            </li>
              <li><b>Team Website </b><i>:</i>
                <span><?php echo $teaminfo[0]->team_website; ?></span>
            </li>

           </span>

           <div class="ac_am_academic_info">
               <a class="" id="teaminfo_more">
                   SHOW ADDITIONAL INFORMATION
                </a>
            </div>
        </ul>
      </div>
       
       
 


   <script type="text/javascript">
        $(document).ready(function(){
          $("#teaminfo_more_detail").hide();

          $("#teaminfo_more").click(function(){
                $("#teaminfo_more_detail").fadeToggle( "slow", "linear" );
                  var content =$("#teaminfo_more").text();           
                  if(content=='HIDE ADDITIONAL INFORMATION') {
                    $("#teaminfo_more").text("SHOW ADDITIONAL INFORMATION");  
                  }else{
                    $("#teaminfo_more").text("HIDE ADDITIONAL INFORMATION");
                  }
            
          });
        });
      </script>
          <?php }else{

          echo "<h5>Don't have Teaminfo Deatils  </h5>";
       } ?>