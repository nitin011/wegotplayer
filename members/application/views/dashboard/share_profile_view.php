<div class="row">
	        <div class="col-md-12" id="share_status">
	        </div>
	        <div class="col-md-12">
        		<h1>Share your profile with the following recipient!</h1>
        	</div>	

			 <div class="col-md-4">
					<div class="uk-form-row">
							<label for="name">Name</label>
							<input type="text" title="1" id="name_i" name="name" required class="form-control" placeholder="Name"/>
					</div>
				</div>
			  <div class="col-md-4">
				   <div class="uk-form-row">				
					   <label for="email">E-mail address</label>
						<input type="email" title="1" id="email_i"  name="email" required class="form-control" placeholder="Email"/>
					</div>
				</div>
				<div class="col-md-4">
					<div class="uk-form-row">
						<label>Share Private Code</label><br>
						<?php if(($acc_type=='PRO')||($acc_type=='PLUS')){ ?>
						<span class="label_command">
							<input type="radio" title="1" id="private" name="private_code_1" value="1" >
							<label class="inline-label">Yes</label>
						</span>
						<span class="label_command">
							<input type="radio" title="1" id="private" name="private_code_1" value="0" checked>
							<label class="inline-label">No</label>
						</span>
						<?php } else{
							echo "Upgrade to Plus or PRO account to use this feature. ";
							echo '<a href="'.base_url().'pricing/" target="_blank" class="uk-badge up_acc">Upgrade</a>';
						}?>
				    </div>
				</div>	
			  </div>
				<div id="target"></div>
			</div>
			<div class="row space-top-form modol_btn">
			   
				<div class="col-md-11">
	        		<button class="md-btn md-btn-primary adept-md-btn-primary pull-right" id="share_profile" type="button">Share Profile</button>
	            </div>
	          	
				<div class="col-md-1 share_more_plus">
					<button class="glyphicon glyphicon-plus icon_pusbig_orange mt10" id="add_another" type="button"></button>
				</div>
				<input id="count_i" type="hidden" value="1">				
				
	        </div>
	    </div>
	


<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>


<script>
 $(document).ready(function () { 

 	$("#share_profile").click(function () { 

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

		var codeObj = {};
				$("input[id=private]:checked").each(function() {
    			var id = $(this).attr("title");
    			var code = $(this).val();
    			codeObj[id] = code;
			});

				$.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>home/shareProfile',
                      data: {email:emailObj,name:nameObj,code:codeObj},
                  })
                .done(function(data){

                  var success_msg='<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Success!</strong> Profile Shared Successfully to ';
                  var error_msg='<div class="alert alert-danger fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning!</strong> Problem in Profile Sharing!</div>';
                  if(data>=0){
                     $('#share_status').empty();                  
                     $('#share_status').html(success_msg+' '+data+' Member </div>');
                   }else{
                   	   $('#share_status').empty();                  
                       $('#share_status').html(error_msg);
                   }
                   setTimeout(function() {
                       $('#share_status').slideUp('slow');
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
                  url: '<?php echo base_url(); ?>home/addMoreField',
                  data: {count:next},
                  })
                .done(function(data){
                	 $("#target").append(data);
                }); 

         });

});
</script>