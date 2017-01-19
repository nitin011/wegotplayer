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
                     <?php echo $privacy_value; ?>            
            
                    </tbody>
                </table>

                <span id="succes_msg"> </span>
           
            </div>
        </div>
    </div>



 <script>

 function updatePrivacy(id,col){
    var privacy_id = id;
    var col_id =col;
    var value = $("#pr_"+privacy_id+'_'+col_id).val();

    
    if(value==0){        
       $("#pr_"+privacy_id+'_'+col_id).val(1);
       $(".td_"+privacy_id+'_'+col_id).addClass("selected");
    } else{
        $("#pr_"+privacy_id+'_'+col_id).val(0);
        $(".td_"+privacy_id+'_'+col_id).removeClass("selected");
    }
   console.log(col_id);
     if(col_id==1){
        for(var i=2; i <= 5; i++)   
        {
           $("#pr_"+privacy_id+'_'+i).val(0);
           $(".td_"+privacy_id+'_'+i).removeClass("selected");
           $("#pr_"+privacy_id+'_'+i).removeAttr("checked");
        }
     } 
     if(col_id==2){
       for(var i=3; i <= 5; i++)   
        {
           $("#pr_"+privacy_id+'_'+i).val(0);
           $(".td_"+privacy_id+'_'+i).removeClass("selected");
           $("#pr_"+privacy_id+'_'+i).removeAttr("checked");
           $("#pr_"+privacy_id+'_'+1).val(0);
           $(".td_"+privacy_id+'_'+1).removeClass("selected");
           $("#pr_"+privacy_id+'_'+1).removeAttr("checked");
        }
     }
     if(col_id==3){
      for(var i=1; i <= 2; i++)   
        {
           $("#pr_"+privacy_id+'_'+i).val(0);
           $(".td_"+privacy_id+'_'+i).removeClass("selected");
           $("#pr_"+privacy_id+'_'+i).removeAttr("checked");
        }
     }
     if(col_id==4){
      for(var i=1; i <= 2; i++)   
        {
           $("#pr_"+privacy_id+'_'+i).val(0);
           $(".td_"+privacy_id+'_'+i).removeClass("selected");
           $("#pr_"+privacy_id+'_'+i).removeAttr("checked");
        }
     }
     if(col_id==5){
      for(var i=1; i <= 2; i++)   
        {
           $("#pr_"+privacy_id+'_'+i).val(0);
           $(".td_"+privacy_id+'_'+i).removeClass("selected");
           $("#pr_"+privacy_id+'_'+i).removeAttr("checked");
        }

     }

    var anyone= $("#pr_"+privacy_id+'_'+1).val();              
    var nobody= $("#pr_"+privacy_id+'_'+2).val();         
    var friends= $("#pr_"+privacy_id+'_'+3).val();
    var members= $("#pr_"+privacy_id+'_'+4).val();
    var code_receivers= $("#pr_"+privacy_id+'_'+5).val();

    
    $.ajax({
               type: 'POST',
               url: '<?php echo base_url(); ?>useraccount/updatePrivacy',
               data: {privacy_id:privacy_id,col_id:col_id,anyone:anyone,
                      nobody:nobody,friends:friends,members:members,
                      code_receivers:code_receivers},
               })
                .done(function(data){
                  $("#succes_msg").html(data);
            })
    }

 </script>