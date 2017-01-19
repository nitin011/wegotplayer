	
	   <div class="row">
           <div class="col-md-12">
                <span id="invitation_status"> </span>
           </div>
	        <div class="col-md-12">
	        	<h1>Invite your friends!</h1>
	        	<h5>Enter the names and addresses of your friends you want to invite.</h5>
	        	</div>
		        	<div class="col-md-5">
						<div class="uk-form-row">
								<label for="name">Name</label>
								<input type="text" title="1" id="name_i" name="name" required class="form-control" placeholder="Name"/>
						</div>
					</div>
				  <div class="col-md-5">
					   <div class="uk-form-row">				
						   <label for="email">E-mail address</label>
							<input type="email" title="1" id="email_i"  name="email" required class="form-control" placeholder="Email"/>
						</div>
					</div>
			
          
				<div class="col-md-1">
					<button class="glyphicon glyphicon-plus icon_pusbig_orange mt25" id="add_another" type="button"></button>
				</div>
				<input id="count_i" type="hidden" value="1">				
				
				<div id="target"></div>				


    				<div class="col-md-10">
    					<br>
    	        	<button class="md-btn md-btn-primary adept-md-btn-primary pull-right" id="send_invitation" type="button">Send Invitation</button>
    	     </div>

	        </div>
	    </div>

<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>


<script>
 $(document).ready(function () { 

 	$("#send_invitation").click(function () { 

 		var email = $("#email_i").val(); 		
 		var name = $("#name_i").val();
 
 		var nameObj = {};
				$("input[id=name_i]").each(function() {
    			var id = $(this).attr("title");
    			var name = $(this).val();
    			nameObj[id] = name;
			});

 		var emailObj = {};
				$("input[id=email_i]").each(function() {
    			var id = $(this).attr("title");
    			var email = $(this).val();
    			emailObj[id] = email;
			});
 		console.log(nameObj);
    console.log(emailObj);
                $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>home/sendInvitation',
                      data: {email:emailObj,name:nameObj},
                  })
                .done(function(data){

                  var success_msg='<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Success!</strong> Invitation send Successfully.</div>';
                  var error_msg='<div class="alert alert-danger fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning!</strong> Problem in Invitation Sending!</div>';
                  if(data>0){
                     $('#invitation_status').empty();                  
                     $('#invitation_status').html(success_msg);
                   }else{
                   	   $('#invitation_status').empty();                  
                       $('#invitation_status').html(error_msg);
                   }

                    setTimeout(function() {
                       $('#invitation_status').slideUp('slow');
                     },5000);
                })
           });

   $("#add_another").click(function(){

   		var count = parseInt($("#count_i").val());   		
   		var next = count+1;
   		console.log(count);
   	    $("#count_i").empty();   		
   		  $("#count_i").val(next);

   	  		
   		$.ajax({
                  type: 'POST',
                  url: '<?php echo base_url(); ?>home/addMore',
                  data: {count:next},
                  })
                .done(function(data){
                	 $("#target").append(data);
                }); 

         });


});
</script>