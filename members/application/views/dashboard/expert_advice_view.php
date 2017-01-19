	 	
	   <div class="row">
	        <div class="col-md-12">
	        	<h1>Expert Advice</h1>	
	        	<?php if($acc_type=='PRO'){ ?>        	
			 <div class="col-md-12">
					
					<div class="uk-form-row">
						<label for="subject" class="uk-form-label">Subject:</label>
							 <select name="subject" id="subject" required data-md-selectize multiple data-md-selectize-bottom>
								<option value="" selected="">Select Subject</option>
								 <option value="0">College Recruiting</option>
								 <option value="1">Professional Team</option>
								 <option value="2">Gaining More Exposure</option>
								 <option value="3">How To Improve My Sports Profile</option>
								 <option value="4">Other</option> 
							</select>
					 </div>
				</div>
			
			  <div class="col-md-12">
				   <div class="uk-form-row">				
					   <label for="message" class="uk-form-label">Message: </label>
						<textarea id="message" class="md-input" required="" style="min-height:150px;" rows="4"></textarea>
					
					</div>
				</div>
				<div class="col-md-4">
					<span id="advice_status"></span>
			    </div>
				

				<div class="col-md-12">
					<br>
	        	<button class="md-btn md-btn-primary adept-md-btn-primary" id="send_advice" type="button">Send</button>
	          </div>

	          <?php }else { 
	          	echo "This feature only for PRO Account  ! ";
	            echo '<a href="'.base_url().'pricing/" target="_blank" class="uk-badge">Upgrade</a>';
	      } ?>
	        </div>
	    </div>
	

<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>


<script>
 $(document).ready(function () { 

 	$("#send_advice").click(function () { 

 		var subject = $("#subject").val();
 		var message = $("#message").val();

 		if (message == null || message == "") {                
				$('.uk-form-row .md-input-wrapper').addClass('md-input-wrapper-danger ');
						$('#message').addClass('md-input-danger');						
						$('#message').focus();
						return false;
                }else if(message.match(/([\<])([^\>]{1,})*([\>])/i)){						
						$('#message').val('');				
						$('#message').focus();
				}else{
				        $('.uk-form-row .md-input-wrapper ').removeClass('md-input-wrapper-danger ');
						$('#message').removeClass( "md-input-danger" );					


                $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>home/sendExpertAdvice',
                      data: {subject:subject,message:message},
                  })
                .done(function(data){

                  var success_msg='<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Success ! </strong> Advice Send Successfully.</div>';
                  var error_msg='<div class="alert alert-danger fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Check Message ! </strong> Advice not Sent!</div>';
                  if(data==1){
                     $('#advice_status').empty();                  
                     $('#advice_status').html(success_msg);
                   }else{
                   	   $('#advice_status').empty();                  
                       $('#advice_status').html(error_msg);
                   }
                })
              }
           });

});
</script>