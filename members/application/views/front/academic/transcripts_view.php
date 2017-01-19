 <h4>Transcripts</h4>
      <?php if(!empty($transcripts_details)){ ?>

      <div class="table-responsive">
      <table class="uk-table uk-text-nowrap adept-table table">
          <thead>
            <tr>
                <th>Degree Level</th>
                <th>Course Name</th>
                <th>Course level </th>
                <th>School Year </th>
                <th>Academic Grade</th>  
            </tr>
          </thead>

              <tbody> 

                    <?php foreach($transcripts_details as $value) { ?>                          

                    <tr id="trans_row_<?php echo $value->wgp_table_id; ?>">
                        <td><?php echo $value->degree_level ;?></td>
                        <td><?php echo $value->course_name ;?></td>
                        <td><?php echo $value->course_level ;?></td>
                        <td><?php echo $value->school_year ;?></td>
                        <td><?php echo $value->academic_grade ;?></td> 
                    </tr>

                    <?php  } ?>

                    </tbody>

                </table> 
      </div>

          <?php }else{

          echo "<h5>Don't have Transcript Deatils  </h5>";
       } ?>