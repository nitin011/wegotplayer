 <h4>Academics </h4> 
 <?php if(!empty($school)){ ?>

    <div class="inner">
          <ul>
            <li><b>HIGH SCHOOL</b><i>:</i>
                <span><?php echo $school->school_name; ?></span>
            </li>
             <li><b>COUNSELOR NAME</b><i>:</i>
                <span><?php echo $school->high_school_counselor; ?></span>
            </li>
             <li><b>GRADUATION DATE</b><i>:</i>
                <span><?php echo $school->high_school_graduation_date; ?></span>
            </li>
             <li><b>GPA</b><i>:</i>
                <span><?php echo $school->overall_gpa; ?></span>
            </li>
             <li><b>SAT SCORE</b><i>:</i>
                <span><?php echo $school->overall_set_score; ?></span>
            </li>
             <li><b>ACT SCORE</b><i>:</i>
                <span><?php echo $school->overall_act_score; ?></span>
            </li>

              <li><b>CLASS RANK</b><i>:</i>
                <span><?php echo $school->class_ranked; ?></span>
            </li>
              <li><b>POTENTIAL MAJORS</b><i>:</i>
                <span><?php echo $school->potential_college_major; ?></span>
            </li>
              <li><b>CLEARING HOUSE NUMBER</b><i>:</i>
                <span><?php echo $school->clearing_house; ?></span>
            </li>
             <span id="academic_more_detail">
             <li><b>School Type</b><i>:</i>
                <span><?php if($school->school_type==1){echo "Public";}else{echo "Private";} ?></span>
            </li>
             <li><b>TOEFL (International Students)</b><i>:</i>
                <span><?php echo $school->toefl; ?></span>
            </li>
             <li><b>College Enrolment Date</b><i>:</i>
                <span><?php echo $school->college_enrolment_date; ?></span>
            </li>
             <li><b>Transferable College Credits</b><i>:</i>
                <span><?php echo $school->transferable_college_credits; ?></span>
            </li>

             <li><b>School Phone</b><i>:</i>
                <span><?php echo $school->school_phone; ?></span>
            </li>
              <li><b>School Website</b><i>:</i>
                <span><?php echo $school->school_website; ?></span>
            </li>
              <li><b>School Location</b><i>:</i>
                <span><?php echo $school->school_location; ?></span>
            </li>

             <li><b>Academic Goals</b><i>:</i>
                <span><?php echo $school->academic_goals; ?></span>
            </li>

             </span>


              <div class="ac_am_academic_info">
                  <a class="" id="academic_more">SHOW ADDITIONAL INFORMATION</a>
              </div>
        </ul>
    </div>


      <script type="text/javascript">
        $(document).ready(function(){
          $("#academic_more_detail").hide();

          $("#academic_more").click(function(){
            $("#academic_more_detail").fadeToggle( "slow", "linear" );
            var content =$("#academic_more").text();
            if(content=='HIDE ADDITIONAL INFORMATION') {
              $("#academic_more").text("SHOW ADDITIONAL INFORMATION");  
            }else{
              $("#academic_more").text("HIDE ADDITIONAL INFORMATION");
            }
            
          });
        });
      </script>

       <?php }else{

          echo "<h5>Don't have School Deatils  </h5>";
       } ?>