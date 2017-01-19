<div class="md-card">
    <div class="md-card-content">
    <div class="uk-overflow-container">           
   <table class="uk-table uk-table-hover">                
            <tbody>
            <tr> 
                <td>High school name</td>                    
                <td>
                    <?php echo $school_name; ?>
                  
                </td>                                
            </tr>
            <tr>
                <td>School Type</td>
                <td> <?php 
                       if($school_type==1){echo "Public";} 
                          if($school_type==2){echo "Private";} 
                      ?>                  
                </td>                                
            </tr> 
            <tr>
                <td>High School Graduation Date</td>
                <td><?php echo $high_school_graduation_date; ?> </td>                                
            </tr> 
            <tr>
                <td>Overall sat score / Out of</td>
                <td><?php echo $overall_set_score; ?></td>                                
            </tr>
            <tr>
                <td>Overall act score / out of</td>
                <td><?php echo $overall_act_score; ?></td>                                
            </tr> 
            <tr>
                <td>TOEFL (International Students)</td>
                <td><?php echo $toefl;  ?> </td>                                
            </tr>  
            <tr>
                <td>Overall GPA / out of</td>
                <td><?php echo $overall_gpa;  ?></td>                                
            </tr> 
            <tr>
                <td>Class Ranked</td>
                <td><?php echo $class_ranked; ?></td>                                
            </tr> 
            <tr>
                <td>College Enrolment Date</td>
                <td><?php echo $college_enrolment_date;?></td>                                
            </tr> 
            <tr>
                <td>Potential College Major</td>
                <td><?php echo $potential_college_major;?></td>                                
            </tr> 
            <tr>
                <td>Transferable College Credits</td>
                <td><?php  echo $transferable_college_credits; ?></td>                                
            </tr> 
            <tr>
                <td>High School Counselor Fullname</td>
                <td><?php echo $high_school_counselor;  ?></td>                                
            </tr>                        
            <tr>
                <td>School Phone</td>
                <td><?php echo $school_phone;?>
             </td>                                
            </tr> 
            <tr>
                <td>School Website</td>
                <td><?php echo $school_website;  ?></td>                                
            </tr> 
            <tr>
                <td>School Location</td>
                <td><?php echo $school_location; ?></td>                                
            </tr> 
            <tr>
                <td>Academic Goals</td>
                <td><?php echo $academic_goals;?></td>                                
            </tr> 
            <tr>
                <td>Clearing House Registration No</td>
                <td><?php echo $clearing_house; ?></td>                                
            </tr>
                          
            </tbody>
        </table>
    </form>
        </div>
    </div>
</div>





