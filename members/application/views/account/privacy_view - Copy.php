 <div class="md-card">
        <div class="md-card-content">
            <div class="uk-overflow-container">
                <table class="uk-table uk-text-nowrap privacy_table">
                    <thead>
                    <tr>
                        <th>Privacy </th>
                        <th>Anyone</th>
                        <th>Nobody</th>
                        <th>Friends</th>
                        <th>Members</th>
                        <th>Code Receivers</th>                                
                    </tr>
                    </thead>
                    
                    <tbody>
                     <?php foreach ($privacy_data as  $value) { 
                                

                        ?>                       

                    <tr id="privacy_<?php echo $value->privacy_id;?>">
                        <td class="title"><?php print_r($value->privacy_name); ?></td>
                        <td><input class="" type="checkbox" id="pr_<?php echo $value->privacy_id;?>_1" onclick="updatePrivacy(<?php echo $privacy_value[0]->anyone;?>)" value="1" checked="checked"></td>
                        <td><input class="" type="checkbox" id="pr_<?php echo $value->privacy_id;?>_2" value="2" ></td>
                        <td><input class="" type="checkbox" id="pr_<?php echo $value->privacy_id;?>_3" value="3" ></td>
                        <td><input class="" type="checkbox" id="pr_<?php echo $value->privacy_id;?>_4" value="4" ></td>
                        <td><input class="" type="checkbox" id="pr_<?php echo $value->privacy_id;?>_5" value="5" ></td> 
                    </tr>
                   
                   <?php   } ?>            
            
                    </tbody>
                </table>

                <span id="succes_msg"> </span>
                <div class="uk-input-group">
                    <div class="md-input-wrapper">
                        <button class="md-btn md-btn-primary" type="button" id="save_privacy">Save</button> 
                    </div>                
                  </div>
            </div>
        </div>
    </div>
<script>
$(document).ready(function () {   

    $("#save").click(function () { 
        var privacy = new Array();
        for (var i=1; i<=<?php echo count($privacy_data); ?>; i++ ) 
        {
            for(j=1;j<=5;j++)
            {
                var tab_selected=$("#pr_"+i+'_'+j).val();
                
                if($("#pr_"+i+'_'+j).prop("checked") == true){
                    privacy.push(i+':'+new Array(tab_selected));                                         
                   console.log("pr_"+i+'_'+j+' value =>'+tab_selected);                 
                }               
            }            
        }
        console.log(privacy) ; 

         $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount/privacySettingValue',
                      data: {privacy:privacy},
                  })
                .done(function(data){
                  $('#succes_msg').html(data);
                })


    });//end of clicked save button 


    $("#save_privacy").click(function () { 



    });




});