<table class="uk-table uk-text-nowrap adept-table">
                    <thead>
                    <tr>
                        <th>Degree Level</th>
                        <th>Course Name</th>
                        <th>Course level </th>
                        <th>School Year </th>
                        <th>Academic Grade</th>                            
                        <th>Edit</th>                        
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
                        <td>
                            <a class="adept-edit"  onclick="editTransRow(<?php echo $value->wgp_table_id; ?>);">
                                    <i class="material-icons">&#xE150;</i>
                                </a>

                                <a class="adept-delete" onclick="return deleteTransRow(<?php echo $value->wgp_table_id; ?>);">
                                    <i class="material-icons">&#xE872;</i>
                                </a>
                       </td>                           
                    </tr>
                    <?php  } ?>
                    </tbody>
                </table> 
                           
     <div class="uk-form-row">
              <span onclick="addTestScore()" class="glyphicon glyphicon-plus icon_pusbig_orange"></span>
      </div>