 <h4>References</h4> 
     
    <div class="table-responsive">
       <table class="uk-table uk-text-nowrap adept-table table">
          <thead>
             <tr>
                <th>Full Name</th>
                <th>Occupation</th>
                <th>Organization</th>
                <th>Level</th>                  
                <th>Contact</th>                  
                <th>Location</th>
                <th>Comments</th>               
               </tr>
            </thead>

           <tbody>

                <?php if(!empty($reference)) {  
                  foreach($reference as $key=>$value) { ?>

                        <tr id="row_<?php echo $value->wgp_table_id; ?>">
                            <td><?php echo $value->full_name;?></td>
                            <td><?php echo $value->full_time_occupation;?></td>
                            <td><?php print_r($value->organization);?></td>
                            <td><?php print_r($value->level);?></td> 
                            <td><?php echo $value->phone."<br>".$value->email; ?></td>
                            <td><?php echo wordwrap($value->location,20,"<br>\n")?></td>
                            <td><?php echo wordwrap($value->comment,20,"<br>\n")?></td> 
                        </tr> 

                <?php }  //end foreach

                  }//end if 

                if(isset($asked_ref) && (!empty($asked_ref))){

                      foreach ($asked_ref as $key => $row) {  
                                  if($row->status==3) {       ?> 

                              <tr>
                                <td><?php echo  ucwords($row->name);?></td>
                                <td><?php echo $row->occupation;?></td>
                                <td><?php echo ucwords($row->organization);?></td>
                                <td><?php echo $row->level;?></td> 
                                <td><?php echo $row->phone?></td>
                                <td> </td>
                                <td><?php echo wordwrap($row->comment,20,"<br>\n")?></td> 

                              </tr> 

                     <?php    } //end if condition
                          }  //end foreach

                  }//end if 
               ?> 
            </tbody>
        </table>
     </div>

     <?php //echo "<pre>";print_r($asked_ref); echo "</pre>";?>