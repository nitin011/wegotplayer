<div id="page_content">
        <div id="page_content_inner">
            <div class="md-card-list-wrapper" id="mailbox">
              <div id="top_bar">
                  <div class="md-top-bar">
                <div class="uk-width-large-10-10 uk-container-center">
                <div class="uk-clearfix">
                    <div class="md-top-bar-actions-left">

                        <div class="md-top-bar-checkbox">
                        	
                            <input type="checkbox" name="mailbox_select_all" id="mailbox_select_all" data-md-icheck />
                            <!-- <input type="button" name="del_all" id="del_all" value="Delete" class="md-btn delete_icon"/> -->
                              <a name="del_all" id="del_all" title="Delete" class="adept-delete"/> 
                          			<i class="fa fa-trash-o" aria-hidden="true"></i>
                          	 </a>
                              <a class="adept-edit" title="Compose Mail" href="#mailbox_new_message" data-uk-modal="{center:true}">
            						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
       						</a>
                            <span id="deleteallresult"></span>

                        </div> <!-- End: md-top-bar-checkbox -->
                        
                       
                    </div> <!-- End: md-top-bar-actions-left -->
                    <div class="md-top-bar-actions-right">
                        <div class="md-top-bar-icons">
                            <i id="mailbox_list_split" class=" md-icon material-icons">&#xE8EE;</i>
                            <i id="mailbox_list_combined" class="md-icon material-icons">&#xE8F2;</i>
                        </div> <!-- End: md-top-bar-icons -->
                    </div> <!-- End: md-top-bar-actions-right -->
                </div> <!-- End: uk-clearfix -->
            </div><!-- End: uk-width-large-10-10 uk-container-center -->
              </div><!-- End: md-top-bar -->
            </div>  <!-- End: #top_bar -->
                
                <div class="">
                   <div class="">
                       <div class="uk-width-large-10-10 uk-container-center">
                    <!-- Start: md-card-list-->
                   
                    <input type="hidden" id="lastest_date" value="<?php echo $lastest_date;?>">
                    <div class="md-card-list" id="unread_msg_list">                         
                          <div  id="loader" class="parsley-errors-list filled right"><img alt="loading..." src="http://adept-testing.com/wegot/images/loader.gif"></div>
                    </div>
                    <!-- End: #unread_msg_list -->
                    
                    <!-- Start: md-card-list-->
                   
                    <div class="md-card-list" id="read_msg_list">                   
                          <div  id="loader" class="parsley-errors-list filled right"><img alt="loading..." src="http://adept-testing.com/wegot/images/loader.gif"></div>
                    </div>
                    <!-- End: #read_msg_list -->
                    <div class="uk-text-center uk-margin-top uk-margin-small-bottom uk-width-medium" style="display:none;" id="loader_list">     <img alt="loading..." src="http://adept-testing.com/wegot/images/loader.gif">
                 </div>
                </div> <!-- End: uk-width-large-10-10 uk-container-center -->
                   </div>
                </div>
            </div> <!-- End: #mailbox -->
        </div> <!-- End: #page_content_inner -->
   </div>  <!-- End: #page_content -->

    

    <div class="uk-modal" id="mailbox_new_message">
        <div class="uk-modal-dialog">
               <button class="uk-modal-close uk-close" type="button" onClick="closeit()"></button>            
              <!-- Start: Section of the friends list -->
                <div id="select_friend_from_list">
                        <div class="uk-modal-header">
                            <h3 class="uk-modal-title">Select Friend</h3>                    
                        </div>                
                        <div class="uk-modal-footer">
                            <?php print_r($success);?> 
                        </div>
                </div>
                <!--End: Section of the friends list -->
                <!-- Start: Section for composing mail -->
                <div id="selected_friend_from_list"></div>                        
                <!-- End: Section for composing mail -->
        </div><!-- End: uk-modal-dialog -->
    </div>  <!-- End: #mailbox_new_message -->
<script>
$.noConflict();
jQuery(document).ready(function(){
   	var user_id='<?php print_r($user_id);?>';
    $.post("<?php echo base_url();?>Usermailbox/fetchUnreadMsg/",
        {user_id:user_id},
        function(data){	 
                         $( "#unread_msg_list" ).empty();
						 $( "#unread_msg_list" ).append(data);
		             } 
		    ); 
  var current_group=1;
  $.post("<?php echo base_url();?>Usermailbox/fetchReadMsg/",
        {user_id:user_id,current_group:current_group},
        function(data){	 
                         $( "#read_msg_list" ).empty();
                         $( "#read_msg_list" ).append(data);
						 //current_group++;
						 //var data_load_more='<div class="uk-text-center uk-margin-top uk-margin-small-bottom"><a class="md-btn md-btn-flat md-btn-flat-primary js-uk-prevent" id="load_more_'+current_group+'" onclick="onloadmore('+current_group+')">Load more...</a></div>';
						
						// $( "#read_msg_list" ).append(data_load_more);
		             } 
		    ); 
});

function onloadmore(current_group){
	      var user_id='<?php print_r($user_id);?>';
		  $('#load_more_'+current_group).hide();
          $('#loader_list').show();
		  loading = false; 		  
		  if( ! loading )
                   {
                        loading = true;
                        $('#loader_list').show();
                          $.post("<?php echo base_url();?>Usermailbox/fetchReadMoreMsg/",
						   {user_id:user_id,current_group:current_group},
                           function(data){	
						                if(data!='') 
										{
                                        $('#load_more_'+current_group).remove();
										$('#loader_list').hide();
										
										$( "#read_msg_list ul" ).append(data);
                                        current_group++;										 
										data_load_more='<div class="uk-text-center uk-margin-top uk-margin-small-bottom"><a class="md-btn md-btn-flat adept-md-btn-primary md-btn-flat-primary js-uk-prevent load_more_click" id="load_more_'+current_group+'" onclick="onloadmore('+current_group+')">Load more...</a></div>';		
						                $( "#read_msg_list" ).append(data_load_more);				
                                        
                                         loading = false;
										}else{
										      $('#load_more_'+current_group).remove();
										      $('#loader_list').hide();
											  data_load_more='<div class="uk-text-center uk-margin-top uk-margin-small-bottom">No more messages to load.</div>';		
						                $( "#read_msg_list" ).append(data_load_more);
											}
                                     } 
                            ); 
                            
                          
                   }
	  }
setInterval(CheckUnreadMsg, 30000);  
function CheckUnreadMsg() {
        var user_id='<?php print_r($user_id);?>';		
		var lastest_date= $( "#lastest_date" ).val();
		loading = false; 
		if(!loading){
		loading = true;
		$.post("<?php echo base_url();?>Usermailbox/CheckUnreadMsg/",
        {user_id:user_id,lastest_date:lastest_date},
        function(data){		
						if( data != '' )
						{
													
							$.post("<?php echo base_url();?>Usermailbox/lastest_msg_date/",
							{user_id:user_id},
							function(data2){		
												if( data2 != '' )
												{ 
													if($("#zero_unread_msg").length){
													   $("#zero_unread_msg").remove();
													}
													$( "#lastest_date" ).val(data2);
													$( "#unread_msg_list ul" ).prepend(data); 											
													loading = false;  
												}
										   }
										   
							); 			 			
						}				
								
		             } 
		    ); 
		}
		
}


function mail_read(mail_id){	
	    $.post("<?php echo base_url();?>Usermailbox/updateMsgStatus/",
		 {mail_id:mail_id},
        function(data){	 
                        
		              } 
		    ); 
		}
		
	
function delete_mail(mail_id){	
	    $.post("<?php echo base_url();?>Usermailbox/Delete_mail/",
		 {mail_id:mail_id},
        function(data){	 
                        if( data ==1 ){	
						      $('#list_'+mail_id).remove();							 
							  $( "#read_msg_list" ).empty();
							  var data1="<div class=\"md-card-list-header heading_list\">Read</div><ul><li id='zero_read_msg'>No mail exits in your inbox</li></ul>";
						       $( "#read_msg_list" ).append(data1);								   
							   $( "#unread_msg_list" ).empty();
							  var data2="<div class=\"md-card-list-header heading_list\">Unread</div><div class=\"md-card-list-header md-card-list-header-combined heading_list\" style=\"display: none\">All Messages</div><ul><li id='zero_unread_msg'>Woohoo! You've read all the messages in your inbox.</li></ul>";
						      $( "#unread_msg_list" ).append(data2);						
							 
						}else if( data ==2 ){
							 // if read mails are zero
						      $('#list_'+mail_id).remove();
							  $( "#read_msg_list" ).empty();
							  var data1="<div class=\"md-card-list-header heading_list\">Read</div><ul><li id='zero_read_msg'>No mail exits in your inbox</li></ul>";
						       $( "#read_msg_list" ).append(data1);								 	
							  
						}else if( data ==3 ){
							  // if unread mails are zero
						      $('#list_'+mail_id).remove();
							  $( "#unread_msg_list" ).empty();
							  var data2="<div class=\"md-card-list-header heading_list\">Unread</div><div class=\"md-card-list-header md-card-list-header-combined heading_list\" style=\"display: none\">All Messages</div><ul><li id='zero_unread_msg'>Woohoo! You've read all the messages in your inbox.</li></ul>";
						      $( "#unread_msg_list" ).append(data2);	
							  
						}else if( data ==4 ){
						      $('#list_'+mail_id).remove();
						}else{
							alert('Mail not deleted. Please try again.');
							}
		              } 
		    ); 
		}
		
		
		
		
function mail_reply(mail_id,friend_id,user_id){	
	     $.post("<?php echo base_url();?>Usermailbox/Mail_reply/",
				{mail_id:mail_id,friend_id:friend_id,user_id:user_id},
				function(data){
							  if( data !='' ){								  
								     $('#page_content').empty();
									 $('#page_content').append(data);
								  }
							  }
		      );
}
		
		
function seleted_friend(friend_id){	
	
	    var friend_name=$('#list_'+friend_id).text(); 
	    var user_name='<?php echo $name; ?>';
		var data='<div class="uk-modal-header"><h3 class="uk-modal-title">Compose Mail</h3></div><div class="uk-margin-small-bottom"><div class="md-input-wrapper"><p>Mail To <i class="uk-icon-angle-double-right"></i> '+friend_name+'</p><p>Mail From <i class="uk-icon-angle-double-right"></i> '+user_name+'</p><input type="hidden"  id="friend_id" name="friend_id" value="'+friend_id+'"></div></div><div class="uk-margin-large-bottom"><div id="subject_div"  class="md-input-wrapper"><input type="text" class="md-input" required="" id="Subject" name="Subject" placeholder="Subject" data-parsley-id="4"><span class="md-input-bar"></span></div><div class="parsley-errors-list filled"><span id="subject_error" class="md-input-bar"></span></div></div><div class="uk-margin-large-bottom"><div id="message_div"  class="md-input-wrapper"><textarea  rows="1" class="md-input" id="Message" style="min-height:50px;" required placeholder="Write your message"></textarea></div><div class="parsley-errors-list filled"><span id="message_error" class="md-input-bar"></span></div></div><div class="uk-modal-footer"><span id="form_error" class="md-input-bar"></span><div style="display: none;" id="loader" class="uk-float-right"><img alt="loading..." src="<?php echo base_url();?>images/loader.gif"></div><button type="button" class="uk-float-right md-btn adept-md-btn-primary md-btn-success" id="clickToSubmit" onClick="sendmail()">Send mail</button></div>';

		$('#select_friend_from_list').hide();
		$('#selected_friend_from_list').empty();
		$('#selected_friend_from_list').append(data);
		}
		
function closeit(){	
	    $('#select_friend_from_list').show();
		$('#selected_friend_from_list').empty();
		}
		
function sendmail(){	
	     var Subject = $( "#Subject" ).val();
		 var Message = $( "#Message" ).val();
		 if (Subject == null || Subject == "") {                
			        $('#subject_div').addClass('md-input-wrapper-danger ');
					$('#Subject').addClass('md-input-danger');
					$('#subject_error').text('This value is required.').css('color','#F00');		
					$('#Subject').focus();
					return false;
			}else if (Message == null || Message == "") {  
			        $('#subject_div').removeClass('md-input-wrapper-danger ');
					$('#Subject').removeClass('md-input-danger');      
					$('#subject_error').empty();	
			        $('#message_div').addClass('md-input-wrapper-danger ');
					$('#Message').addClass('md-input-danger');
					$('#message_error').text('This value is required.').css('color','#F00');		
					$('#Message').focus();
					return false;
			}else{
				    $('#message_div').removeClass('md-input-wrapper-danger ');
					$('#Message').removeClass('md-input-danger');      
					$('#message_error').empty();
					$('#clickToSubmit').hide();
					$('#loader').show();
					var user_id    = '<?php echo $user_id; ?>';
					var friend_id  = $('#friend_id').val();
					var subject    = Subject;
					var message    = Message;                       						
					$.post("<?php echo base_url();?>Usermailbox/send_mail/",
					{user_id:user_id,friend_id:friend_id,subject:subject,message:message},
					function(data){	
									
									if( data ==1 ){									
											$('#subject_div').addClass('md-input-wrapper-danger ');
											$('#Subject').addClass('md-input-danger');
											$('#subject_error').text('This value is required.').css('color','#F00');		
											$('#Subject').focus();
									}else if( data ==2 ){
											$('#subject_div').removeClass('md-input-wrapper-danger ');
											$('#Subject').removeClass('md-input-danger');      
											$('#subject_error').empty();	
											$('#message_div').removeClass('md-input-wrapper-danger ');
											$('#Message').removeClass('md-input-danger');      
											$('#message_error').empty();	
											$('#Message').focus();
									
									}else if( data ==3 ){											    
											$('#form_error').text('OOPs! some error occur. Kindly refresh the page.').css('color','#F00');	
											
									}else if(data =='send'){												 		
											 $('#subject_div').removeClass('md-input-wrapper-danger ');
											 $('#Subject').removeClass('md-input-danger');
											 $('#subject_error').empty();
											 
											 $('#message_div').removeClass('md-input-wrapper-danger ');
											 $('#Message').removeClass('md-input-danger');      
											 $('#message_error').empty();
											 
											 $('#form_error').empty();
											 
											 $('#selected_friend_from_list').empty();				
											 $('#selected_friend_from_list').html('<h3>Mail Sent successfully.</h3>').css('color','#090');													 
										}									
							
								 } 
						); 
			}
				
		}	
		
jQuery(document).ready(function() {		
		 $("#del_all").on('click', function(e) {
                    e.preventDefault();
                    var checkValues = $('.checkbox1:checked').map(function()
                    {
                        return $(this).val();
                    }).get();
                    console.log(checkValues);
                     
                
                    $.ajax({
                        url: '<?php echo base_url() ?>usermailbox/delete',
                        type: 'post',
                        data: 'ids=' + checkValues
                    }).done(function(data) {
						//removing row of the deleted msg
                        $.each( checkValues, function( i, val ) {
                        $("#list_"+val).remove();
                        });
                        //displaying total number of rows deleted
						if(data>0){var msg =data+' mail deleted.';}
						
						$('#deleteallresult').text(data).css('color','red').fadeOut(5000);
  
  //checking if all unread msgs are deleted
  if( ($("#unread_msg_list ul").has("li").length === 0) ) {
	$("#unread_msg_list ul").html("<li id='zero_unread_msg'>Woohoo! You've read all the messages in your inbox..</li>");
  }

//checking if all read msgs are deleted
if( ($("#read_msg_list ul").has("li").length === 0) ) {
  $("#read_msg_list ul").html("<li id='zero_read_msg'>You've read all the messages in your inbox.</li>");
		}
 			 
						
						 //unchecked button
                        $('#mailbox_select_all').attr('checked', false);
                    });
                });
  });
</script>   
<script src="<?php echo base_url(); ?>bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/common.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/uikit_custom.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/page_mailbox.min.js"></script>
<script src='<?php echo base_url(); ?>js/jquery-customselect.js'></script>
