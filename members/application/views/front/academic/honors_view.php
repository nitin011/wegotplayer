  <div class="md-card" id="honn">
        <div class="md-card-content">
            <div class="uk-overflow-container">
                <table class="uk-table uk-text-nowrap adept-table">
                    <thead>
                    <tr>
                        <th>Awards & Honors Name</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>School / Organization Name</th>
                        <th>Level</th> 
                        <th>Date Received</th>                          
                     </tr>
                    </thead>
                    
                    <tbody> 
                    <?php foreach($honors as $value) { ?>                          
                    <tr id="row_<?php echo $value->wgp_table_id; ?>">
                        <td><?php echo $value->awards_honors_name; ?></td>
                        <td><?php echo $value->type; ?></td>
                        <td><?php echo $value->description; ?></td>
                        <td><?php echo $value->school_organization_name; ?></td>
                        <td><?php echo $value->level; ?></td>  
                        <td><?php echo $value->date_Received; ?></td>                           
                                                   
                    </tr>
                    <?php  } ?>
                    
                    
                    
                    </tbody>
                </table>              
               
        </div>
    </div>
</div>
