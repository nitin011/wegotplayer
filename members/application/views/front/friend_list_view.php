<div class="md-card">
   <div class="md-card-content tx-md-card-content-adept">
     <div class="friend_list friend_list_frnd">
     
     <?php foreach ($friends as $key => $value) { ?>  	
    

    <div class="md-card-head friend_box friend_box_black">
          <?php   $frnd_id =$value['friend_id'];
                  $name =$value['user']->name;
           ?>

              <input type="hidden"  id="friend_<?php echo $frnd_id; ?>_name"  value="<?php echo ucwords($name); ?>"/>

     <a data-uk-modal="{target:'#mailbox_div_modal'}"  onclick="appendInModel(<?php echo $frnd_id; ?>)" class="uk-text-plain"> 
        <i class="md-icon material-icons md-icon-light" title="Send Message">&#xE150;</i>
      </a>
           <div class="uk-text-center"><img alt="<?php echo ucwords($value['user']->name); ?>" src="<?php echo $value['pic_url'];?>" class="md-card-head-avatar">
              </div>
            <h3 class="md-card-head-text uk-text-center uk_adept_main"><?php echo ucwords($value['user']->name); ?> </h3>
      </div>

     <span id="friend_action" ></span>

   
     <?php } ?>
  </div>
</div>
</div>

<script>
function appendInModel(friend_id){
  var friend_name =$("#friend_"+friend_id+'_name').val();
  $('#mail_to_name').text(friend_name);
  $('#friend_user_id').val(friend_id);
}

</script>

<div class="uk-modal" id="mailbox_div_modal">
        <div class="uk-modal-dialog">
            <button class="uk-modal-close uk-close" type="button"></button>     
              <span id="form_error"></span>
                <div class="uk-modal-header">
                    <h3 class="uk-modal-title">Compose Message</h3>
                </div>
                <div class="uk-margin">
                    <label for="mail_to">To</label>
                    <span class="to" id="mail_to_name"> </span>
                    <input type="hidden"  id="login_user_id" value="<?php echo $user_id; ?>">
                    <input type="hidden" id="friend_user_id" value=""/>
                </div>
                <div class="uk-margin" id="subject_div">
                    <label for="subject">Subject</label>
                    <input type="text" class="md-input" id="subject"/> 
                    <span id="subject_error"><span>                   
                </div>
                <div class="uk-margin-large-bottom" id="message_div">
                    <label for="mail_new_message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="6" class="md-input"></textarea>
                    <span  id="message_error"></span>
                </div>             
                
                <div class="uk-modal-footer">                    
                    <button type="button" id="sent_button" class="uk-float-right md-btn md-btn-primary adept-md-btn-primary">Send</button>
                </div>          
        </div>
    </div>
<script>




 $("#sent_button").click(function () {
 
       var Subject = $("#subject" ).val();
     var Message = $("#message" ).val();
     if (Subject == null || Subject == "") {                
          $('#subject_div').addClass('md-input-wrapper-danger ');
          $('#message').addClass('md-input-danger');
          $('#subject_error').text('This value is required.').css('color','#F00');    
          $('#subject').focus();
          return false;
      }else if (Message == null || Message == "") {  
              $('#subject_div').removeClass('md-input-wrapper-danger ');
          $('#subject').removeClass('md-input-danger');      
          $('#subject_error').empty();  
          $('#message_div').addClass('md-input-wrapper-danger ');
          $('#message').addClass('md-input-danger');
          $('#message_error').text('This value is required.').css('color','#F00');    
          $('#message').focus();
          return false;
      }else{
            $('#message_div').removeClass('md-input-wrapper-danger ');
          $('#message').removeClass('md-input-danger');      
          $('#message_error').empty();
          $('#sent_button').hide();
         
          var user_id    = $('#login_user_id').val();
          var friend_id  = $('#friend_user_id').val();
          var subject    = Subject;
          var message    = Message;                                   
          $.post("<?php echo base_url(); ?>usermailbox/send_mail/",
          {user_id:user_id,friend_id:friend_id,subject:subject,message:message},
          function(data){ 
                  
                  if( data ==1 ){                 
                      $('#subject_div').addClass('md-input-wrapper-danger ');
                      $('#subject').addClass('md-input-danger');
                      $('#subject_error').text('This value is required.').css('color','#F00');    
                      $('#subject').focus();
                  }else if( data ==2 ){
                      $('#subject_div').removeClass('md-input-wrapper-danger ');
                      $('#subject').removeClass('md-input-danger');      
                      $('#subject_error').empty();  
                      $('#message_div').removeClass('md-input-wrapper-danger ');
                      $('#message').removeClass('md-input-danger');      
                      $('#message_error').empty();  
                      $('#message').focus();
                  
                  }else if( data ==3 ){                         
                      $('#form_error').text('OOPs! some error occur. Kindly refresh the page.').css('color','#F00');  
                      
                  }else if(data =='send'){                            
                       $('#subject_div').removeClass('md-input-wrapper-danger ');
                       $('#subject').removeClass('md-input-danger');
                       $('#subject_error').empty();
                       
                       $('#message_div').removeClass('md-input-wrapper-danger ');
                       $('#message').removeClass('md-input-danger');      
                       $('#message_error').empty();
                       
                       $('#form_error').empty();
                       $('#mailbox_div_modal').hide();
                       
                       $('#mail_sent_status').empty();       
                       $('#mail_sent_status').append('<h3>Mail Sent successfully.</h3>').css('color','#090');                           
                    }                 
              
                 } 
            ); 
      }
        
    } );
</script>
