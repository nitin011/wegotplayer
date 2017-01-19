
<html>
<head>
  <title>WEGOTPLAYERS</title>  
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap-formhelpers.min.css"> 
  <style type="text/css">

   
    body {
      background: #f5f5f5;
      }



    table.main {
      margin: 0px 0px 15px 0px;
      padding: 10px;
      background: #fff;
      border-bottom: 2px solid #ccc;
      border-radius: 6px;
      }

    td.bold {
      color: #333;
      font-size: 13px;
      padding: 4px;
      }

    td.thin {
      color: #8d8c8c;
      font-size: 11px;
      padding: 3px;
      }

    span.main-heading {
      border-bottom: 1px solid #ccc;
      color: #333;
      float: left;
      font-size: 20px;
      margin: 0 0 10px;
      padding: 0 0 7px;
      width: 100%;
      }

    span.sub-heading {
      border-bottom: 1px solid #ccc;
      color: #4e4e4e;
      float: left;
      font-size: 17px;
      margin: 0 0 10px;
      padding: 0 0 7px;
      width: 100%;
      }

.sub-heading {
      border-bottom: 1px solid #ccc;
      color: #4e4e4e;
      float: left;
      font-size: 17px;
      margin: 0 0 10px;
      padding: 0 0 7px;
      width: 100%;
      }

    p {
      margin: 0px;
      padding: 0px;
      font-size: 14px;
      font-weight: 300;
      color: #333;
      }

    .colored {
      background: #ededed;
      border:0px;
      padding: 7px 5px!important;
      }

    #flag{
      z-index: -999999;

    }


  </style>
</head>
<body>

<table width="100%" cellpadding="0" cellspacing="0" style="background:#000; margin-bottom:20px;">
  <tr>
    <td width="100%" style="text-align:center; padding:10px;">
    	<img src="http://adept-testing.com/players/images/logo.png">
    </td>
  </tr>
</table>

<table class="main" width="100%" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td colspan="2">
        <span class="main-heading"><?php echo ucwords($detail->first_name.' '.$detail->last_name); ?>
            <?php  $location_short_name = isset($location_short->countryCode)?$location_short->countryCode:0; 
                  
              ?>
              <span id="flag" class="glyphicon bfh-flag-<?php echo $location_short_name;?>">&nbsp;&nbsp;&nbsp;</span>
         </span>
      </td>
    </tr>
    <tr>
      <td width="25%" style="margin-bottom:0px;">
        <img style="width:100px;height:100px" src="<?php echo $dp_url; ?>">
      </td>
      <td width="75%" style="margin-top: 30px!important">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td width="50%">
              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="30%" class="bold">Sport:</td>
                  <td width="70%" class="thin"><?php echo $detail->sport_name; ?></td>
                </tr>
                <tr>
                  <td width="30%" class="bold">Position:</td>
                  <td width="70%" class="thin"><?php echo $detail->position_name; ?></td>
                </tr>
                <tr>
                  <td width="30%" class="bold">Hand:</td>
                  <td width="70%" class="thin"><?php echo $detail->hand_name; ?></td>
                </tr>
                <tr>
                  <td width="30%" class="bold">Weight:</td>
                  <td width="70%" class="thin"><?php echo $detail->weight_name; ?></td>
                </tr>
                <tr>
                  <td width="30%" class="bold">Seeking:</td>
                  <td width="70%" class="thin"><?php print_r($seeking); ?></td>
                </tr>
              </table>
            </td>
            <td width="50%">
              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="30%" class="bold">Level:</td>
                  <td width="70%" class="thin"><?php echo $detail->level_name; ?></td>
                </tr>
                <tr>
                  <td width="30%" class="bold">Foot:</td>
                  <td width="70%" class="thin"><?php echo $detail->foot_name; ?></td>
                </tr>
                <tr>
                  <td width="30%" class="bold">Height:</td>
                  <td width="70%" class="thin"><?php echo $detail->height_name; ?></td>
                </tr>
                <tr>
                  <td width="30%" class="bold">Age:</td>
                  <td width="70%" class="thin">
                                  <?php $birth_year = $detail->birth_year;
                                        $current_year = date('Y');
                                        $dob = $current_year-$birth_year;
                                        echo $dob." years";
                                  ?></td>
                </tr>
                <tr>
                  <td width="30%" class="bold">Location:</td>
                  <td width="70%" class="thin"><?php echo $detail->address; ?></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </tbody>
</table>

<table class="main" width="100%" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td colspan="2" class="sub-heading">Brief Bio</td>
    </tr>
    <tr>
      <td colspan="2"><p  class="thin"><?php echo ucfirst($personal_info->message); ?> </p></td>
    </tr>
  </tbody>
</table>


<table class="main" width="100%" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td colspan="2" class="sub-heading">Academics</td>
    </tr>
    <tr>
      <td width="50%">
        <table width="100%">
          <tr>
            <td width="50%" class="bold">HIGH SCHOOL :</td>
            <td width="50%" class="thin"><?php echo $school->school_name; ?></td>
          </tr>
          
          <tr>
            <td width="50%" class="bold">GRADUATION DATE :</td>
            <td width="50%" class="thin"><?php echo $school->high_school_graduation_date; ?></td>
          </tr>
         
          <tr>
            <td width="50%" class="bold">SAT SCORE :</td>
            <td width="50%" class="thin"><?php echo $school->overall_set_score; ?></td>
          </tr>

           <tr>
            <td width="50%" class="bold">CLASS RANK :</td>
            <td width="50%" class="thin"><?php echo $school->class_ranked; ?></td>
          </tr>

           <tr>
            <td width="50%" class="bold">TOEFL (International Students)</td>
            <td width="50%" class="thin"><?php echo $school->toefl; ?></td>
          </tr>

           <tr>
            <td width="50%" class="bold">Transferable College Credits</td>
            <td width="50%" class="thin"><?php echo $school->transferable_college_credits; ?></td>
          </tr>
           <tr>
            <td width="50%" class="bold">School Website</td>
            <td width="50%" class="thin"><?php echo $school->school_website; ?></td>
          </tr>

          <tr>
            <td width="50%" class="bold">Academic Goals</td>
            <td width="50%" class="thin"><?php echo $school->academic_goals; ?></td>
          </tr>

         
        </table>
      </td>
      <td width="50%">
        <table width="100%">
        <tr>
            <td width="50%" class="bold">COUNSELOR NAME :</td>
            <td width="50%" class="thin"><?php echo $school->high_school_counselor; ?></td>
          </tr>
         <tr>
            <td width="50%" class="bold">GPA :</td>
            <td width="50%" class="thin"><?php echo $school->overall_gpa; ?></td>
          </tr>
          <tr>
            <td width="50%" class="bold">ACT SCORE :</td>
            <td width="50%" class="thin"><?php echo $school->overall_act_score; ?></td>
          </tr>
          <tr>
            <td width="50%" class="bold">POTENTIAL MAJORS :</td>
            <td width="50%" class="thin"><?php echo $school->potential_college_major; ?></td>
          </tr>
          <tr>
            <td width="50%" class="bold">School Type</td>
            <td width="50%" class="thin">
                      <?php if($school->school_type==1){
                              echo "Public";
                            }else{
                              echo "Private";
                            } ?>
            </td>
          </tr>        

            <tr>
            <td width="50%" class="bold">College Enrolment Date</td>
            <td width="50%" class="thin"><?php echo $school->college_enrolment_date; ?></td>
          </tr>
            <tr>
            <td width="50%" class="bold">School Phone</td>
            <td width="50%" class="thin"><?php echo $school->school_phone; ?></td>
          </tr>
            <tr>
            <td width="50%" class="bold">School Location</td>
            <td width="50%" class="thin"><?php echo $school->school_location; ?></td>
          </tr>
                
        </table>
      </td>
    </tr>
  </tbody>
</table>

<table class="main" width="100%" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td colspan="5" class="sub-heading">Transcripts</td>
    </tr>
    <tr>
      <td class="bold colored">Degree Level</td>
      <td class="bold colored">Course Name</td>
      <td class="bold colored">Course level</td>
      <td class="bold colored">School Year</td>
      <td class="bold colored">Academic Grade</td>
    </tr>
  <?php if(!empty($transcripts_details)){
      foreach ($transcripts_details as $row) {
       
    ?>
    <tr>
      <td class="thin"> <?php echo $row->degree_level;?></td>
      <td class="thin"><?php echo $row->course_name;?></td>
      <td class="thin"><?php echo $row->course_level;?></td>
      <td class="thin"><?php echo $row->school_year;?></td>
      <td class="thin"><?php echo $row->academic_grade;?></td>
    </tr>

    <?php }  
  }?>
    
  </tbody>
</table>

<?php if(!empty($teaminfo)){ ?>
<table class="main" width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" class="sub-heading">Athletics</td>
    </tr>

    
    <tr>
      <td width="50%">
        <table width="100%">
          <tr>
            <td width="50%" class="bold">TEAM NAME :</td>
            <td width="50%" class="thin"><?php echo $teaminfo[0]->team_name;?></td>
          </tr>

          <tr>
            <td width="50%" class="bold">Jersey Number :</td>
            <td width="50%" class="thin"><?php echo $teaminfo[0]->jersey_number;?></td>
          </tr>
          <tr>
            <td width="50%" class="bold">Division :</td>
            <td width="50%" class="thin"><?php echo $teaminfo[0]->division_name;?></td>
          </tr>
          <tr>
            <td width="50%" class="bold">Team home color uniform :</td>
            <td width="50%" class="thin"><?php echo $teaminfo[0]->team_home_uniform_name;?></td>
          </tr>
          <tr>
            <td width="50%" class="bold">STYLE OF PLAY :</td>
            <td width="50%" class="thin"><?php echo $teaminfo[0]->style_of_play_name;?></td>
          </tr>
          <tr>
            <td width="50%" class="bold">COACH EMAIL :</td>
            <td width="50%" class="thin"><?php echo $teaminfo[0]->coach_email;?></td>
          </tr>
          <tr>
            <td width="50%" class="bold"> Coach Phone :</td>
            <td width="50%" class="thin"><?php echo $teaminfo[0]->coach_phone;?></td>
          </tr>

           <tr>
            <td width="50%" class="bold"> Team Website:</td>
            <td width="50%" class="thin"><?php echo $teaminfo[0]->team_website;?></td>
          </tr>
        
        </table>
      </td>

      <td width="50%">
        <table width="100%">
       
          <tr>
            <td width="50%" class="bold">LEVEL :</td>
            <td width="50%" class="thin"><?php echo $teaminfo[0]->level_name;?></td>
          </tr>

          <tr>
            <td width="50%" class="bold">Competition :</td>
            <td width="50%" class="thin"><?php echo $teaminfo[0]->competition_name;?></td>
          </tr>
          <tr>
            <td width="50%" class="bold">Team away color uniform :</td>
            <td width="50%" class="thin"><?php echo $teaminfo[0]->team_away_color_name;?></td>
          </tr>
          <tr>
            <td width="50%" class="bold">COLLEGE ELIGIBILITY :</td>
            <td width="50%" class="thin"><?php echo $teaminfo[0]->playing_eligibility;?></td>
          </tr>
          <tr>
            <td width="50%" class="bold">COACH NAME :</td>
            <td width="50%" class="thin"><?php echo $teaminfo[0]->head_coach_full_name;?></td>
          </tr>
          <tr>
            <td width="50%" class="bold">Favorite Sports Ground :</td>
            <td width="50%" class="thin"><?php echo $teaminfo[0]->favortite_sports_ground_name;?></td>
          </tr>

           <tr>
            <td width="50%" class="bold">Team Address :</td>
            <td width="50%" class="thin"><?php echo $teaminfo[0]->team_home_address;?></td>
          </tr>
            
        </table>
      </td>
    </tr>

</table>
   <?php } ?>

<table class="main" width="100%" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td colspan="8" class="sub-heading">Stats</td>
    </tr>
    <tr>
      <td class="bold colored">Level</td>
      <td class="bold colored">Season</td>
      <td class="bold colored">Games played</td>
      <td class="bold colored">Games started</td>
      <td class="bold colored">Goals</td>
      <td class="bold colored">Assists</td>
      <td class="bold colored">Points</td>
      <td class="bold colored">Total points</td>
    </tr>
  <?php if(!empty($stats_details)){
      foreach ($stats_details as $row) {
       
    ?>
    <tr>  
          <td class="thin"><?php echo $row->level;?></td>
          <td class="thin">
            <?php foreach ($seas as $key => $sea) {
                if($row->season==$key){
                echo $sea;
              }
              } ?>
          </td>
          <td class="thin"><?php echo $row->games_played;?></td>
          <td class="thin"><?php echo $row->games_started;?></td>
          <td class="thin"><?php echo $row->goals;?></td>
          <td class="thin"><?php echo $row->assists;?></td>
          <td class="thin"><?php echo $row->points;?></td>
          <td class="thin"><?php echo $row->total_points;?></td>
    </tr>

    <?php }  
  }?>
    
  </tbody>
</table>



<table class="main" width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" class="sub-heading">Records</td>
    </tr>

    <?php if(!empty($record)) { ?>

          
    <tr>
      <td width="50%">
        <table width="100%">
          <tr>
            <td width="50%" class="bold">30 meters sprint</td>
            <td width="50%" class="thin"><?php echo $record->run_30.' sec';?></td>
          </tr>

          <tr>
            <td width="50%" class="bold">100 meters sprint </td>
            <td width="50%" class="thin"><?php echo $record->run_100.' sec';?></td>
          </tr>
          <tr>
            <td width="50%" class="bold">One Mile Run </td>
            <td width="50%" class="thin"><?php echo $record->one_mile.' min';?></td>
          </tr>
          
         
        </table>
      </td>

      <td width="50%">
        <table width="100%">
          <tr>
            <td width="50%" class="bold">Max Bench Press/Reps </td>
            <td width="50%" class="thin"><?php echo $record->max_bench; ?></td>
          </tr>

          <tr>
            <td width="50%" class="bold">Vertical Jump :</td>
            <td width="50%" class="thin"><?php echo $record->vertical_jump." inches"; ?></td>
          </tr>
          <tr>
            <td width="50%" class="bold">Horizontal Jump : </td>
            <td width="50%" class="thin"><?php echo $record->horizontal_jump." inches"; ?></td>
          </tr>
          
        </table>
      </td>
    </tr>
      <?php } ?>
</table>


<table class="main" width="100%" cellpadding="0" cellspacing="0">

    <tr>
      <td colspan="2" class="sub-heading">Languages</td>
    </tr>
    <tr>
      <td width="50%" style="padding-right:10px;float:left;">
         <?php if($user_language){
                   foreach ($user_language as $row) {  ?>

                <table width="100%" cellpadding="0" cellspacing="0" style="background:#eaeaea; margin-bottom:10px;">
                  <tr>                    
                    <td style="background:#f47921; text-transform:uppercase; padding:6px;" width="40%"><?php echo $row->language; ?></td>
                    <td width="30%">   
                      <?php for($i=1;$i<=$row->level; $i++) {?>
                        <img src="<?php echo base_url(); ?>images/icon-star-fill.png">                            
                      <?php } ?>
                    </td> 
                    <td style="text-align:right; vertical-align:middle; padding:0px 5px; font-size:14px;" width="30%"><?php echo $row->level_name; ?></td>
                  </tr>
                </table>
             
                 <?php  }  } ?>
          </td>
        </tr>
  </tbody>
</table>



<table class="main" width="100%" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td colspan="6" class="sub-heading">Injuries</td>
    </tr>
    <tr>
      <td class="bold colored">Type of injury</td>
      <td class="bold colored">Body Part</td>
      <td class="bold colored">Body Area</td>
      <td class="bold colored">Recovered</td>
      <td class="bold colored">Surgery</td>
      <td class="bold colored">If yes, when</td>     
    </tr>
  <?php if(!empty($injur)){
          foreach($injur as $value) { ?> 
                  <tr>
                      <td class="thin"><?php echo $value->type_of_injury;?></td>
                      <td class="thin"><?php echo $value->body_part;?></td>
                      <td class="thin"><?php echo $value->body_area;?></td>
                      <td class="thin">
                        <?php foreach ($recovered as $key => $rec) {
                                if($key==$value->recovered){
                                    echo $rec.'%';
                                }
                         }?>
                      </td>
                      <td class="thin"><?php echo $value->surgery;?></td>
                      <td><?php echo $value->when;?></td> 
              </tr> 

  <?php }  }?>
    
  </tbody>
</table>


<table class="main" width="100%" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td colspan="7" class="sub-heading">References</td>
    </tr>
    <tr>
      
      <td class="bold colored">Full Name</td>
      <td class="bold colored">Occupation</td>
      <td class="bold colored">Organization</td>
      <td class="bold colored">Level</td>                    
      <td class="bold colored">Contact</td>                  
      <td class="bold colored">Location</td>
      <td class="bold colored">Comments</td>   
    </tr>
 <?php if(!empty($reference)) { 
                foreach($reference as $key=>$value) { ?>
                <tr>
                    <td class="thin"><?php echo $value->full_name;?></td>
                    <td class="thin"><?php echo $value->full_time_occupation;?></td>
                    <td class="thin"><?php echo $value->organization;?></td>
                    <td class="thin"><?php echo $value->level;?></td> 
                    <td class="thin"><?php echo $value->phone."<br>".$value->email; ?></td> 
                    <td class="thin"><?php echo wordwrap($value->location,20,"<br>\n")?></td>
                    <td class="thin"><?php echo wordwrap($value->comment,20,"<br>\n")?></td>
                </tr>

  <?php }  }
        if(isset($asked_ref) && (!empty($asked_ref))){
            foreach ($asked_ref as $key => $row) { 

             echo "<tr><td class=\"thin\">".ucwords($row->name)."</td>";
             echo "<td class=\"thin\">".$row->occupation."</td>";
             echo "<td class=\"thin\">".ucwords($row->organization)."</td>";
             echo "<td class=\"thin\">".$row->level."</td>";
             echo "<td class=\"thin\">".$row->phone."</td>";
             echo "<td class=\"thin\"></td>";
              echo "<td class=\"thin\">".$row->comment."</td></tr>"; 
  } } ?>
    
  </tbody>
</table>

  

</body>

</html>





