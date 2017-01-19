
<div id="confirmOverlay" style="display:none;">
    <div id="confirmBox">
                        		
    </div>	
</div>

<div class="md-card">
        <div class="md-card-content">
        	
            <h3 class="heading_a">Write on the wall</h3>
            
            <div class="uk-width-1-1">
                <div class="uk-form-row">			    
                     <textarea  rows="1" class="md-input" id="post_text" style="min-height:50px;" required  placeholder="Write your post"></textarea>
                </div>
                <div class="uk-form-row">
			        <div class="parsley-errors-list filled" id="error" style="display:none;"<span class="parsley-required">This value is required.</span></div>
			        <div class="parsley-errors-list filled" id="error_db" style="display:none;"<span class="parsley-required">OOPs! Please try again.</span></div>
			        <div class="parsley-errors-list filled" id="error_html" style="display:none;"><span class="parsley-required">No HTML Tag Allowed.</span></div>
                    <div class="parsley-errors-list filled right" id="loader" style="display:none;"><img src="http://adept-testing.com/wegot/images/loader.gif" alt="loading..."></div>
                    <button type="button" class="md-btn md-btn-primary adept-md-btn-primary right" id="add_post" onclick="add_post()">Send</button>
                </div>
            </div>
			
        </div>
                
          
    </div>
	<div id="commenting-section">
	    <div class="md-card">
	         <div class="md-card-content">
	         <div class="uk-grid" data-uk-grid-margin="">
	            <div class="uk-width-medium">
	            <div id="total_posts" style="display: none;"><?php echo $total_posts; ?></div>	                         
	            </div>
                 <div id="loader_list" style="display:none;" class="uk-text-center uk-margin-top uk-margin-small-bottom uk-width-medium"><img src="<?php echo base_url();?>images/loader.gif" alt="loading..."></div>
	        </div>
	    </div>
	    </div>
	</div>

    <script>


//variable initialization
var current_page    =   1;
var loading         =   false;
var oldscroll       =   0;
var user_id   = '<?php print_r($user_id);?>';
var total_posts='<?php print_r($total_posts);?>';
var total_pages=Math.ceil(parseInt(total_posts)/10);
$(document).ready(function(){
  
    $.post("<?php echo base_url();?>Userwallpost/fetchData/",
        {'group_no': current_page},
        function(data){	 
                         $( ".uk-width-medium" ).append(data);
						 current_page++;
						 data='<div class="uk-text-center uk-margin-top uk-margin-small-bottom"><a class="md-btn md-btn-flat md-btn-flat-primary js-uk-prevent" id="load_more_'+current_page+'" onclick="onloadmore('+current_page+')">Load more...</a></div>';
						  $( ".uk-width-medium" ).append(data);	
							
		             } 
		    ); 

 
});

 function onloadmore(current_page){
	      $('#load_more_'+current_page).hide();
          $('#loader_list').show();
		  loading = false;   
		  if( ! loading )
                   {
                        loading = true;
                        $('#loader_list').show();
                        $.post("<?php echo base_url();?>Userwallpost/fetchData/",
                        {'group_no': current_page},
                        function(data){	 
                                        $('#load_more_'+current_page).remove();
										$('#loader_list').hide();
										$( ".uk-width-medium" ).append(data);
                                        current_page++;										 
										data='<div class="uk-text-center uk-margin-top uk-margin-small-bottom"><a class="md-btn md-btn-flat md-btn-flat-primary js-uk-prevent" id="load_more_'+current_page+'" onclick="onloadmore('+current_page+')">Load more...</a></div>';		
						                $( ".uk-width-medium" ).append(data);				
                                        
                                         loading = false;      
                                     } 
                            ); 
                            
                          
                   }
	  }
setInterval(CheckData, 30000);  
function CheckData() {
        var user_id   = '<?php print_r($user_id);?>'; 
        var total_posts   = $( "#total_posts" ).text(); 		
		$.post("<?php echo base_url();?>Userwallpost/checkData/",
        {user_id:user_id,total_posts:total_posts},
        function(data){		
						if( data != '' )
						{
							$( "#total_posts" ).remove();                            							
							$( ".uk-width-medium" ).prepend(data); 					 			
						}				
								
		             } 
		    ); 
		
}



  function add_post() 
    {
	 
	         var post_text = $( "#post_text" ).val();
             if (post_text == null || post_text == "") {                
				$('.uk-form-row .md-input-wrapper ').addClass('md-input-wrapper-danger ');
						$('#post_text').addClass('md-input-danger');
						$('#error').show();		
						$('#error_html').hide();
						$('#post_text').focus();
						return false;
                }else if(post_text.match(/([\<])([^\>]{1,})*([\>])/i)){
						$('#error').hide();	
						$('#error_html').show();
						$('#post_text').val('');				
						$('#post_text').focus();
				}else{
				        $('.uk-form-row .md-input-wrapper ').removeClass('md-input-wrapper-danger ');
						$('#post_text').removeClass( "md-input-danger" );
						$('#error').hide();
						$('#error_html').hide();
						$('#add_post').hide();
						$('#loader').show();
			 	        var user_id   = '<?php print_r($user_id);?>';                        						
						$.post("<?php echo base_url();?>Userwallpost/add_parent_post/",
						{post_text:post_text,user_id:user_id},
						function(data){	
										
											if( data ==1 ){
													$('.uk-form-row .md-input-wrapper ').addClass('md-input-wrapper-danger ');
													$('#post_text').addClass('md-input-danger');
													$('#error').show();				
													$('#post_text').focus();	
											}else if( data ==2 ){
													$('.uk-form-row .md-input-wrapper ').addClass('md-input-wrapper-danger ');
													$('#post_text').addClass('md-input-danger');
													$('#error_db').show();				
													$('#post_text').focus();
											
											}else{												 		
												    var current_total_post=parseInt($('#total_posts').text());
												    current_total_post=current_total_post+1;
												    
												    $('#total_posts').empty().text(current_total_post);
												    $('.uk-width-medium').prepend( data );
													$('#post_text').val('');
													$('.uk-form-row .md-input-wrapper ').removeClass('md-input-wrapper-danger ');
													$('#post_text').removeClass('md-input-danger');
													$('#error').hide();	
													$('#error_db').hide();
																	
																									 
												}	
												
											$('#add_post').show();
						                    $('#loader').hide();	
									 } 
							); 
				}
				
				
   }
    
	function delete_post(post_id)
    {
		$('#confirmOverlay').show();
		$('#question').show();
		$('#msg_return').text('');
		var text='<div id="question"><p id="msg">Do you want to continue?</p><div id="confirmButtons"><a class="button blue"  id="true_press" onclick="delete_it('+post_id+')">Yes</a><a class="button gray"  id="false_press" onclick="leave_it('+post_id+')">No</a></div></div>';
		$('#confirmBox').empty();
		$('#confirmBox').append(text);					
					
	  
    }
 	
	
	function leave_it(post_id)
	{
		$('#confirmOverlay').hide();
		return false;					
	}
					
	
	function delete_it(post_id)
	{						   
			
		var user_id   = '<?php print_r($user_id);?>';
		$.post("<?php echo base_url();?>Userwallpost/delete_parent_post/",		
		{user_id:user_id,post_id:post_id},
		function(data){	
						
						if( data ==1 ){
								var result= '<p class="uk-badge uk-badge-danger">Sorry. Not able not delete it.</p>';
								$('#confirmBox').empty();
		                        $('#confirmBox').append(result);	
								setTimeout(function() { $('#confirmOverlay').hide('fast');}, 2000);
								return false;
						}else if( data ==2 ){							
								var result= '<p class="uk-badge uk-badge-danger">We have not right to delete it.</p>';
								$('#confirmBox').empty();
		                        $('#confirmBox').append(result);
								setTimeout(function() { $('#confirmOverlay').hide('fast');}, 2000);
								return false;
						}else if( data ==3 ){								
                                var result= '<p class="uk-badge uk-badge-danger">Sorry. Please try again after refreshing the page once.</p>';
								$('#confirmBox').empty();
		                        $('#confirmBox').append(result);								
								setTimeout(function() { $('#confirmOverlay').hide('fast');}, 2000);
								return false;
						}else{												 		
								var row_id='#div_'+post_id;
								$(row_id).hide();
								var result= '<p class="uk-badge uk-badge-success">Post deleted successfully.</p>';
								$('#confirmBox').empty();
		                        $('#confirmBox').append(result);																
								setTimeout(function() { $('#confirmOverlay').hide('fast');}, 2000);				
								return false;												 
							}				

						} 
			  ); 


	}

			      
    function edit_post(post_id)
    {       
		 var post_value=$('#post_value_'+post_id).text();	
		 var data='<div class="uk-grid"><div class="uk-width-large-3-4 uk-width-medium-1-1"><div class="md-input-wrapper"><input type="text" name="edit_parent_post_'+post_id+'"  id="edit_parent_post_'+post_id+'"  value="'+post_value+'" class="k-textbox new_css"></div></div><div class="uk-width-large-1-4 uk-width-medium-1-1"><div class="md-input-wrapper"><button type="button" class="md-btn md-btn-primary md-btn-small" id="edit_post_'+post_id+'" onclick="save_edit_post('+post_id+')">Save</button></div></div></div><span id="edit_error_'+post_id+'" class="error_red"></span>';
		 $('#post_value_'+post_id).empty();
		 $('#post_value_'+post_id).append(data);	
    }
 

	function save_edit_post(post_id)
    { 
	    var edited_id='#edit_parent_post_'+post_id;
	    var post_text=$(edited_id).val();
		alert(post_text);alert(edited_id);
	    if (post_text == null || post_text == "") {               
				$('#edit_error_'+post_id).text('');	
				$('#edit_error_'+post_id).text('This value is required.');	
				$(edited_id).focus();
                return false;
                }else if(post_text.match(/([\<])([^\>]{1,})*([\>])/i)){
				$('#edit_error_'+post_id).text('');	
				$('#edit_error_'+post_id).text('No HTML Tag Allowed.');	
				$(edited_id).focus();
                return false;
				}else{
				        
			 	        var user_id   = '<?php print_r($user_id);?>';						
						$.post("<?php echo base_url();?>Userwallpost/edit_parent_post/",
						{post_text:post_text,post_id:post_id,user_id:user_id},
						function(data){	
										
											if( data ==1 ){
													$('#edit_error_'+post_id).text('');	
				                                    $('#edit_error_'+post_id).text('This value is required.').css('color', 'red');	
				                                    $(edited_id).focus();
											}else if( data ==2 ){
													$('#edit_error_'+post_id).text('');	
				                                    $('#edit_error_'+post_id).text('We have not right to delete it.').css('color', 'red');		
				                                    $(edited_id).focus();											
											}else if( data ==3 ){
													$('#edit_error_'+post_id).text('');	
				                                    $('#edit_error_'+post_id).text('Sorry. Please try again after refreshing the page once.').css('color', 'red');
				                                    $(edited_id).focus();											
											}else{												 		
												    $('#edit_error_'+post_id).text('');					                                   
				                                    $('#post_value_'+post_id).empty();			
													$('#post_value_'+post_id).append(data);												 
												}	
												
									    } 
							); 
				}
	 
	
	}

	function add_comment(post_id)
	{
			var post_user_id=$('#post_user_id_'+post_id).val();
			var post_commenter_id   = '<?php print_r($user_id);?>';	
			var comment_text = $('#comment_value_'+post_id).val();
			
			if (comment_text == null || comment_text == "") { 
			$('#comment_error_'+post_id).text('');
			$('#comment_error_'+post_id).text('This value is required.');
			$('#comment_value_'+post_id).val('');
			$('#comment_value_'+post_id).focus();
			return false;
			}else if(comment_text.match(/([\<])([^\>]{1,})*([\>])/i)){
			$('#comment_error_'+post_id).text('');
			$('#comment_error_'+post_id).text('No HTML Tag Allowed.');
			$('#comment_value_'+post_id).val('');
			$('#comment_value_'+post_id).focus();
			}else{
					$('#comment_error_'+post_id).text('');					
					$('#submit_comment_'+post_id).hide();
					$('#comment_loader_'+post_id).show();										
					$.post("<?php echo base_url();?>Userwallpost/add_comment/",
					{post_id:post_id,post_user_id:post_user_id,post_commenter_id:post_commenter_id,comment_text:comment_text},
					function(data){	
									
										if( data ==1 ){
										$('#comment_error_'+post_id).text('');
										$('#comment_error_'+post_id).text('This value is required.').css('color', 'red');	
										$('#comment_value_'+post_id).val('');
										$('#comment_value_'+post_id).focus();	
										}else if( data ==2 ){
										$('#comment_error_'+post_id).text('');
										$('#comment_error_'+post_id).text('Sorry. Please try again after refreshing the page once.').css('color', 'red');	
										$('#comment_value_'+post_id).val('');
										$('#comment_value_'+post_id).focus();										
										}else{												 		
										$('#sub_comments_'+post_id).prepend( data );
										$('#comment_error_'+post_id).text('');
										$('#comment_value_'+post_id).val('');														 
										}	
											
										$('#comment_loader_'+post_id).hide();
										$('#submit_comment_'+post_id).show();
					                    	
								 } 
						); 
			}
		
				
	}
	
	function delete_comment(comment_id)
    {
		$('#confirmOverlay').show();
		$('#question').show();
		$('#msg_return').text('');
		var text='<div id="question"><p id="msg">Do you want to continue?</p><div id="confirmButtons"><a class="button blue"  id="true_press" onclick="delete_comment_value('+comment_id+')">Yes</a><a class="button gray"  id="false_press" onclick="leave_comment_value('+comment_id+')">No</a></div></div>';
		$('#confirmBox').empty();
		$('#confirmBox').append(text);					
					
	  
    }
 	
	
	function leave_comment_value(comment_id)
	{
		$('#confirmOverlay').hide();
		return false;					
	}
					
	
	function delete_comment_value(comment_id)
	{	 
			
		var post_user_id=$('#commerter_user_id_'+comment_id).val();
		var post_commenter_id   = '<?php print_r($user_id);?>';	
		$.post("<?php echo base_url();?>Userwallpost/delete_comment/",		
		{post_user_id:post_user_id, post_commenter_id:post_commenter_id, comment_id:comment_id},
		function(data){	
						
						if( data ==1 ){
								var result= '<p class="uk-badge uk-badge-danger">Sorry. Not able not delete it.</p>';
								$('#confirmBox').empty();
		                        $('#confirmBox').append(result);	
								setTimeout(function() { $('#confirmOverlay').hide('fast');}, 2000);
								return false;
						}else if( data ==2 ){							
								var result= '<p class="uk-badge uk-badge-danger">We have not right to delete it.</p>';
								$('#confirmBox').empty();
		                        $('#confirmBox').append(result);
								setTimeout(function() { $('#confirmOverlay').hide('fast');}, 2000);
								return false;
						}else if( data ==3 ){								
                                var result= '<p class="uk-badge uk-badge-danger">Sorry. Please try again after refreshing the page once.</p>';
								$('#confirmBox').empty();
		                        $('#confirmBox').append(result);								
								setTimeout(function() { $('#confirmOverlay').hide('fast');}, 2000);
								return false;
						}else{												 		
								var row_id='#comment_'+comment_id;
								$(row_id).hide();
								var result= '<p class="uk-badge uk-badge-success">Comment deleted successfully.</p>';
								$('#confirmBox').empty();
		                        $('#confirmBox').append(result);																
								setTimeout(function() { $('#confirmOverlay').hide('fast');}, 2000);				
								return false;												 
							}				

						} 
			  ); 


	}

	function edit_comment(comment_id)
    {       
		 var comment_value=$('#comment_value_'+comment_id).text();	
         var data='<div class="uk-grid"><div class="uk-width-large-3-4 uk-width-medium-1-1"><div class="md-input-wrapper"><input type="text" name="edit_comment_'+comment_id+'"  id="edit_comment_'+comment_id+'"  value="'+comment_value+'" class="k-textbox new_css"></div></div><div class="uk-width-large-1-4 uk-width-medium-1-1"><div class="md-input-wrapper"><button type="button" class="md-btn md-btn-primary adept-md-btn-primary md-btn-small" onclick="save_edit_comment('+comment_id+')">Save</button></div></div></div><span id="edit_error_'+comment_id+'" class="error_red"></span>'; 
		 
		 $('#comment_value_'+comment_id).empty();
		 $('#comment_value_'+comment_id).append(data);
    }
 

	function save_edit_comment(comment_id)
    { 
	    var edited_id='#edit_comment_'+comment_id;
	    var comment_text=$(edited_id).val();
		
	    if (comment_text == null || comment_text == "") {               
				$('#edit_error_'+comment_id).text('');	
				$('#edit_error_'+comment_id).text('This value is required.').css('color', 'red');
                $(edited_id).val('');				
				$(edited_id).focus();
                return false;
                }else if(comment_text.match(/([\<])([^\>]{1,})*([\>])/i)){
				$('#edit_error_'+comment_id).text('');	
				$('#edit_error_'+comment_id).text('No HTML Tag Allowed.').css('color', 'red');	
				$(edited_id).val('');
				$(edited_id).focus();
                return false;
				}else{
			 	        var commenter_id   = '<?php print_r($user_id);?>';						
						$.post("<?php echo base_url();?>Userwallpost/edit_comment/",
						{comment_text:comment_text,comment_id:comment_id,commenter_id:commenter_id},
						function(data){	
										
											if( data ==1 ){
													$('#edit_error_'+comment_id).text('');	
				                                    $('#edit_error_'+comment_id).text('This value is required.').css('color', 'red');	
				                                    $(edited_id).val(comment_text);	
													$(edited_id).focus();
											}else if( data ==2 ){
													$('#edit_error_'+comment_id).text('');	
				                                    $('#edit_error_'+comment_id).text('We have not right to delete it.').css('color', 'red');		
				                                    $(edited_id).val(comment_text);	
													$(edited_id).focus();											
											}else if( data ==3 ){
													$('#edit_error_'+comment_id).text('');	
				                                    $('#edit_error_'+comment_id).text('Sorry. Please try again after refreshing the page once.').css('color', 'red');
				                                    $(edited_id).val(comment_text);	
													$(edited_id).focus();											
											}else{												 		
												    $('#edit_error_'+comment_id).text('');					                                   
				                                    $('#comment_value_'+comment_id).empty();			
													$('#comment_value_'+comment_id).append(data);												 
												}	
												
									    } 
							); 
				}
	 
	
	}
		      
	</script>