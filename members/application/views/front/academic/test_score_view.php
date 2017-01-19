        <div class="md-card" id="test_score">
            <div class="md-card-content">
                <div class="uk-overflow-container">
                    <table class="uk-table uk-text-nowrap adept-table">
                        <thead>
                        <tr>
                            <th>Test Type</th>
                            <th>Subject</th>
                            <th>Test Score</th>
                            <th>Out Of</th>
                            <th>Date Of Test</th>
                            <th>Location Of Test</th>                           
                            
                        </tr>
                        </thead>
                        
                        <tbody> 
                        <?php foreach($test_details as $value) { ?>                          
                        <tr id="row_<?php echo $value->wgp_table_id; ?>">
                            <td><?php echo $value->test_type ;?></td>
                            <td><?php echo $value->test_subject ;?></td>
                            <td><?php echo $value->test_score ;?></td>
                            <td><?php echo $value->out_of ;?></td>
                            <td><?php echo $value->date_of_test ;?></td>
                            <td><?php echo $value->location_of_test ;?></td>                                                     
                        </tr>
                        <?php   } ?>                      
                        </tbody>
                    </table>                 
            </div>
        </div>
    </div>
  
