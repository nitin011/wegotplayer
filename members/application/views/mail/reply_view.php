<div id="page_content">
       <div id="page_content_inner">

			<?php echo $reply_text; ?>

	</div>
</div>
<script>
function sendreply(){	
	     var Subject = $( "#SubjectReply" ).val();
		 var Message = $( "#MessageReply" ).val();
		 if (Subject == null || Subject == "") {                
			        $('#subject_div_Reply').addClass('md-input-wrapper-danger ');
					$('#SubjectReply').addClass('md-input-danger');
					$('#subject_error_Reply').text('This value is required.').css('color','#F00');		
					$('#SubjectReply').focus();
					return false;
			}else if (Message == null || Message == "") {  
			        $('#subject_div_Reply').removeClass('md-input-wrapper-danger ');
					$('#SubjectReply').removeClass('md-input-danger');      
					$('#subject_error_Reply').empty();	
			        $('#message_div_Reply').addClass('md-input-wrapper-danger ');
					$('#MessageReply').addClass('md-input-danger');
					$('#message_error_Reply').text('This value is required.').css('color','#F00');		
					$('#MessageReply').focus();
					return false;
			}else{
				    $('#message_div_Reply').removeClass('md-input-wrapper-danger ');
					$('#MessageReply_Reply').removeClass('md-input-danger');      
					$('#message_error_Reply').empty();
					$('#clickToSubmitReply').hide();
					$('#loaderReply').show();
					var user_id    = '<?php echo $user_id; ?>';
					var friend_id  = $('#Friends_id').val();
					var subject    = Subject;
					var message    = Message;                       						
					$.post("<?php echo base_url();?>Usermailbox/send_reply_to_friend/",
					{user_id:user_id,friend_id:friend_id,subject:subject,message:message},
					function(data){	
									
									if( data ==1 ){									
											$('#subject_div_Reply').addClass('md-input-wrapper-danger ');
											$('#Subject').addClass('md-input-danger');
											$('#subject_error_Reply').text('This value is required.').css('color','#F00');		
											$('#Subject').focus();
									}else if( data ==2 ){
											$('#subject_div_Reply').removeClass('md-input-wrapper-danger ');
											$('#Subject').removeClass('md-input-danger');      
											$('#subject_error_Reply').empty();	
											$('#message_div_Reply').removeClass('md-input-wrapper-danger ');
											$('#Message').removeClass('md-input-danger');      
											$('#message_error').empty();	
											$('#Message').focus();
									
									}else if( data ==3 ){											    
											$('#form_error_Reply').text('OOPs! some error occur. Kindly refresh the page.').css('color','#F00');	
											
									}else{												 		
											 $('#subject_div_Reply').removeClass('md-input-wrapper-danger ');
											 $('#Subject_Reply').removeClass('md-input-danger');
											 $('#subject_error_Reply').empty();
											 
											 $('#message_div_Reply').removeClass('md-input-wrapper-danger ');
											 $('#Message').removeClass('md-input-danger');      
											 $('#message_error_Reply').empty();
											 
											 $('#form_error_Reply').empty();
											 $('#loaderReply').hide();	
											 $('#clickToSubmitReply').show();
											 $( "#SubjectReply" ).val('');
		                                     $( "#MessageReply" ).val('');
											 $('#msgs_section_id').append(data);
											 
					                         											 
										}									
							
								 } 
						); 
			}
				
		}	
</script>
<script src="<?php echo base_url(); ?>bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/common.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/uikit_custom.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/page_mailbox.min.js"></script>
