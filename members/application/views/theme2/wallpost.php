<div class="col-md-9"> 

	<span id="event_edit_view"></span>


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

	                    <button type="button" class="md-btn md-btn-primary adept-md-btn-primary pull-right" id="add_post" onclick="add_post()">Post</button>

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





 

 </div>



<?php 
	 $count = 0;

	if($profile_pic_status==true){
         $count += 5;
      }
      if(!empty($detail)){
          $count += 10;
      }

      if(!empty($personal_info)){
        $count += 5;
      }
     if(!empty($school)){
      	 $count += 10;  
      }
      if(!empty($teaminfo)){
        $count += 10;
      }

      if(!empty($transcripts_details)){
         $count += 5; 
      }
      if(!empty($stats_details)){
        $count += 5;
      }
      if($photo_album>=1)  {
         $count += 5;
      }
       if($video_count>=1)  {
        $count += 15;
      }    

      if( (!empty($reference)) || (!empty($asked_ref)) )  {
          $count += 10;  
      }
      if(!empty($events)){
      	$count += 5;
      }
       if( (!empty($tech_details)) && (!empty($tact_details))
            && (!empty($physical)) && (!empty($psy_details)) )

       {
          $count += 5;
       }
       if(!empty($user_language)){
        $count +=5;
       }
      if(!empty($injur)){
          $count += 5;
      }

  ?>

 <div class="col-md-3"> 



 <!--  <div class="ac_am_upgrade_your_profile space">

    <a href="<?php //echo base_url(); ?>pricing" target="_blank" class="ac_am_upgrade_your_profile">

        Upgrade your profile

    </a>   

  </div> -->

  <div class="ac_am_upgrade_your_profile space">

   <a href="<?php echo base_url(); ?>home" class="ac_am_upgrade_your_profile">

        Go to profile

    </a>

  </div>



  <div class="ac_am_profile_strant">

    <h4>Profile Strength</h4>

        <div class="progress">

        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $count; ?>"

            aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $count; ?>%">

        </div>

      </div>



      <span class="sr-only"><?php echo $count; ?>%</span>

      		<div class="meter_box">
      			<div class="meter_counter" style="bottom: <?php echo ($count-17);?>px;">
      				<p><?php 
				          if($count<=30){
				             echo "Starter";
				          }elseif($count>30 && $count<=60){
								   echo 'Star';
							}else if($count>60 && $count <= 80){
								   echo 'All Star';
							}else if($count >80 && $count <100){
								    echo "Super Star";
							}else if($count==100){
				       			 echo "Champion";
				          }

					?></p>
      				<span></span>
      			</div>
      		</div>


    

       

        </div>

<ul class="sidebar_menugray" id="side_menu_ul">
  <li><a href="<?php echo base_url().'profile/'.$user_detail->login_name; ?>">View Your Public Profile</a></li>
  <li><a href="<?php echo base_url(); ?>search_controller/searchView">Search</a></li>
  <li><a href="#" onclick="invidePlayer()">Invite Players</a></li>
  <li><a href="#" onclick="shareProfile()">Share Profile</a></li>
</ul>



<script>
$('#side_menu_ul > li').click(function () {
     $(this).addClass('active').siblings('li').removeClass('active');     
  });


function invidePlayer(){
  $.ajax({
          type: 'POST',
          url: '<?php echo base_url(); ?>home/inviteFriends',
          data: {},
      })

    .done(function(data){
          $("#demo_model").trigger('click');
           //$('#event_edit_view').empty().html(data);
          $("#model_content").empty().html(data);
    })
}

function shareProfile(){
    $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>home/shareProfileView',
              data: {},
          })
          .done(function(data){
             $("#demo_model").trigger('click');
               //$('#event_edit_view').empty().html(data);
              $("#model_content").empty().html(data);
        })
}


		$("#side_search").click(function () {             

                $.ajax({

                      type: 'POST',

                      url: '<?php echo base_url(); ?>search_controller/searchView',

                      data: {},

                  })

                .done(function(data){
                      $("#demo_model").trigger('click');
                       //$('#event_edit_view').empty().html(data);
                      $("#model_content").empty().html(data);                 

                })

            });

          


            $("#side_expert_advice").click(function () { 
                  $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>home/expertAdviceView',
                      data: {},
                  })

                .done(function(data){
                      $("#demo_model").trigger('click');
                       //$('#event_edit_view').empty().html(data);
                      $("#model_content").empty().html(data);
                })

           });



</script>



                

            <div class="ac_am_latest_event">

              <h4>Upcoming Events 

              	<span type="button" class="glyphicon glyphicon-plus icon_pusbig_orange md_bttn_wth" data-uk-modal="{target:'#add_event'}"></span>

              </h4>



      <div class="uk-modal" id="add_event">

            <div class="uk-modal-dialog">

                <div class="uk-modal-header">

                    <h3 class="uk-modal-title">Add Event !</h3>

                </div>

           <?php if(($acc_type=='PRO')||($acc_type=='PLUS')){ ?>

             <div class="row">   

             	<div class="col-md-12 col-sm-12 col-sx-12">            

                     <label class="evn_col" for="event_name">Event Name</label>

                      <input type="text" id="event_name" name="event_name" required class="form-control" />

              	</div>

            <div class="col-md-6"> 

                  <label class="evn_col" for="level">Level<span class="event_sps req">*</span></label>

                      <select name="level" id="level" required data-md-selectize>

                              <option value="" selected="">Select Level</option>

                                <?php foreach ($level as  $row) {  ?>                                                                                                                            

                                    <option value="<?php echo $row->levelId; ?>">

                                      <?php echo $row->levelName; ?></option>

                                <?php }   ?>                                      

                          </select>

            </div>



            <div class="col-md-6"> 

                <label class="evn_col" for="event_importance">Event Importance<span class="event_sps req">*</span></label>

                      <select name="event_importance" id="event_importance" required data-md-selectize>

                              <option value="" selected="">Select Event Importance</option>

                                <?php foreach ($event_importance as  $row) {  ?>                                                                                                                            

                                  <option value="<?php echo $row->id; ?>">

                                      <?php echo $row->name; ?></option>

                                <?php }   ?>                                      

                    </select>

            </div>

             

             <div class="col-md-6">

                  <label for="range_start" class="uk-form-label">Event Start:</label>

                  <input class="evn_edt" id="range_start" />

            </div>



            <div class="col-md-6">

              <label for="range_end" class="uk-form-label">Event End:</label>

                <input class="evn_edt" id="range_end" />

            </div>

           <div class="col-md-12">

                  <label class="evn_col" for="event_website">Event Website<span class="event_sps req">*</span></label>

                    <input type="text"  id="event_website"  name="event_website" required class="form-control" />

             </div>

             
            <div class="col-md-12 col-sm-12 col-sx-12">

                  <label class="evn_col" for="event_type">Event Type<span class="event_sps req">*</span></label>

                      <select name="event_type" id="event_type" required data-md-selectize>

                              <option value="" selected="">Select Event type</option>

                                <?php foreach ($event_type as  $event_row) {  ?>                                                                                                                            

                                    <option value="<?php echo $event_row->id; ?>">

                                     

                                         <?php echo $event_row->type; ?></option>

                                <?php }   ?>                                      

                          </select>

          	</div>

                 <div class="col-md-12">

                  <label class="evn_col" for="location">Location<span class="event_sps req">*</span></label>

                    <input type="text"  id="autocomplete"  name="location" onFocus="geolocate()" required class="form-control" />

                   

                </div>

                <input type="hidden" id="street_number" disabled="true" placeholder="Street Address">

                 <input type="hidden" id="route" disabled="true" >

                 <input type="hidden" id="postal_code" disabled="true" name="zip_code"/>

                <input type="hidden" name="city" id="locality" disabled="true"  required class="md-input" />

                <input type="hidden" name="state" id="administrative_area_level_1" disabled="true" />

                <input type="hidden" id="country" name="country" disabled="true" placeholder="Country" >

    

                <br>



              </div>

              <!-- end right side -->
               <?php } else{
                  echo "Upgrade Account type to use this feature.";
              } ?>
         

              <div class="uk-modal-footer uk-text-right">

                    <button type="button"  id="close_add_event" class="btn btn-primary ac_cancel">Close</button>
                     <?php if(($acc_type=='PRO')||($acc_type=='PLUS')){ ?>
                    <button type="button" id="save_event" class="btn_col btn btn-danger ac_save">Send</button>
                    <?php } ?>
                </div>

            </div>

        </div>

<!-- Demo Content Trigger the modal with a button -->
<button type="button" id="demo_model"  data-toggle="modal" data-target="#myModal" style="display:none;"></button>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <span id="model_content"></span>
      </div>
    </div>

  </div>
</div>

 



<script src="<?php echo base_url(); ?>bower_components/moment/min/moment.min.js"></script> 

<script src="<?php echo base_url(); ?>assets/js/common.min.js"></script>    

<script src="<?php echo base_url(); ?>assets/js/uikit_custom.min.js"></script>   

<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/kendoui.custom.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/pages/kendoui.min.js"></script>



<script>

 $(document).ready(function () {

     $("#save_event").click(function (){

   

       var name =$("#event_name").val();

       var level =$("#level").val();

       var start_date =$("#range_start").val();

       var website =$("#event_website").val();

       var event_type =$("#event_type").val();

       var event_imp =$("#event_importance").val();

       var end_date =$("#range_end").val();

       var address =$("#autocomplete").val();



         $.ajax({

                type:'POST',

                url:'<?php base_url() ?>usercalendar/addNewEvent',

                data:{name:name,level:level,start_date:start_date,

                    website:website,event_type:event_type,

                    event_imp:event_imp,end_date:end_date,

                    address:address

                  },

            })

          .done(function(data){

             var url = "<?php echo base_url(); ?>home";

            window.location= url;           

          })



    });

    

    //delete event 

    $("#delete_event").click(function (){      

       var wgp_event_id =$("#wgp_event_id").val();



       $.ajax({

                type:'POST',

                url:'<?php base_url() ?>usercalendar/deleteEvent',

                data:{wgp_event_id:wgp_event_id},

            })

          .done(function(data){

            $('#calendar').html(data);

            

          })



     });



 });



</script>



<script>

$("#range_start").kendoDateTimePicker({

    format: "M/d/yyyy hh:mm tt"

});

$("#range_end").kendoDateTimePicker({

    format: "M/d/yyyy hh:mm tt"

});

</script>





<script>

// This example displays an address form, using the autocomplete feature

// of the Google Places API to help users fill in the information.



var placeSearch, autocomplete;

var componentForm = {

  street_number: 'short_name',

  route: 'long_name',

  locality: 'long_name',

  administrative_area_level_1: 'short_name',

  country: 'long_name',

  postal_code: 'short_name'

};



function initAutocomplete() {

  // Create the autocomplete object, restricting the search to geographical

  // location types.

  autocomplete = new google.maps.places.Autocomplete(

      (document.getElementById('autocomplete')),

      {types: ['geocode']});



  // When the user selects an address from the dropdown, populate the address

  // fields in the form.

  autocomplete.addListener('place_changed', fillInAddress);

}



// [START region_fillform]

function fillInAddress() {

  // Get the place details from the autocomplete object.

  var place = autocomplete.getPlace();



  for (var component in componentForm) {

    document.getElementById(component).value = '';

    document.getElementById(component).disabled = false;

  }



  // Get each component of the address from the place details

  // and fill the corresponding field on the form.

  for (var i = 0; i < place.address_components.length; i++) {

    var addressType = place.address_components[i].types[0];

    if (componentForm[addressType]) {

      var val = place.address_components[i][componentForm[addressType]];

      document.getElementById(addressType).value = val;

    }

  }

}

// [END region_fillform]



// [START region_geolocation]

// Bias the autocomplete object to the user's geographical location,

// as supplied by the browser's 'navigator.geolocation' object.

function geolocate() {

  if (navigator.geolocation) {

    navigator.geolocation.getCurrentPosition(function(position) {

      var geolocation = {

        lat: position.coords.latitude,

        lng: position.coords.longitude

      };

      var circle = new google.maps.Circle({

        center: geolocation,

        radius: position.coords.accuracy

      });

      autocomplete.setBounds(circle.getBounds());

    });

  }

}

// [END region_geolocation]



 </script>



    <script src="https://maps.googleapis.com/maps/api/js?signed_in=true&libraries=places&callback=initAutocomplete" async defer></script>





     <ul class="events">

         <?php if(empty($events)){?>

          

           <li> No Upcoming event</li>



        <?php } 

              else if(count($events)>0) 

               {  

              		foreach ($events as $key => $row) 

              		{              		

         ?>

	             <li id="<?php echo $row->wgp_event_id;?>"><img src="<?php echo base_url(); ?>images/img.jpg">  </li>

	              	<b><?php echo ucwords($row->wgp_event_name); ?></b>

	              	<span> 

	              		<?php $date = strtotime($row->wgp_event_start); 

	              		   echo date('d M, Y',$date);

	              	     ?>

	              	  <a class="glyphicon glyphicon-pencil ac_am_academic_icon event_edit" id="edit_event_<?php echo $row->wgp_event_id;?>" onclick="editEvent(<?php echo $row->wgp_event_id;?>)"></span></a>

	              	</span>

	           



        <?php    } 

              } 

        ?>

     </ul>



             <i><a href="<?php echo base_url(); ?>event">View All</a></i>

     </div>

 <script type="text/javascript">

     $(document).ready(function(){

     	$(".event_edit").hide();

     	 $("ul.events li").mouseenter(function(){

     		var event_id = $(this).attr('id');

     	     $("#edit_event_"+event_id).show();

     	});    	

     	

     });





     function editEvent(id){

     	$.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>usercalendar/editEventView',
            data: {event_id:id},
            })
            .done(function(data){
            	$("#demo_model").html(data);
            });

     }

</script>





	

	</div>

	 <!-- End of col-md-3 -->

</div>



<!-- Start footer -->

<div class="footer">

    <div class="footer-logo" id="foot-inner">

       <!--  <img src="<?php //echo base_url(); ?>images/wgp-logo.png" style="width:100%">

    </div> -->

    <div class="footer-box">

        <ul> 

            <li class="copyright"><a href="<?php echo base_url(); ?>/home"> © 2016 WeGotPlayers, LLC.</a></li> </ul>      

            </div>

            <div class="footer-box1">

        <ul> 

            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/about/">About</a></li>            

            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/blog/">Blog</a></li>

            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/terms/">Terms</a></li>

            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/privacy-policy/">Privacy</a></li> 

            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/sitemap/">Sitemap</a></li>

            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/help/">Help</a></li>

            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/contact/">Contact</a></li>           

        </ul></div>

    </div>

</div>



<!-- End footer -->







<script>

$("#graduation_date").kendoDatePicker({

  format: "MMMM d,yyyy"

});



$("#enrolment_date").kendoDatePicker({

  format: "MMMM d,yyyy"

});

$("#event_date").kendoDatePicker({

  format: "d-MMMM-yyyy"

});



$("#dob").kendoDatePicker({

  format: "d-MM-yyyy"

});





</script>



</body>

</html>		