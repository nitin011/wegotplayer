<?php if (!$this->session->userdata('user_exist'))
        {
          //If no session, redirect to login page
           redirect('user', 'refresh');
           exit();
        }
      $session_data = $this->session->userdata('user_exist');
      $cover_url=$session_data['cover_url'];
      $dp_url=$session_data['dp_url'];

      $friend_user_id=$session_data['user_id'];
     if(isset($session_data['friendship_status'])){
         $friendship_status=$session_data['friendship_status'];
      }
     $session_login = $this->session->userdata('logged_in');
     $login_user_id=$session_login['user_id'];


?>

<div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
  <div class="uk-width-large-7-10 profile-overview">
      <div class="md-card cover-image"  style="background-image:url(<?php echo $cover_url;?>); background-size: cover; background-position: 100% center;" id="cover">
          <div id="mail_sent_status"><div> 

     <div class="user_heading_avatar">
          <img src="<?php echo $dp_url;?>" alt="<?php echo ucwords($name); ?>"/>
        </div>
      <div class="upper_save_tab">
          <span class="uk-text-truncate"><?php echo ucwords($name); ?></span>
          <i class="uk-text-truncate-min"><?php //print_r($personal_info->sport);?></i>

           <ul id="user_profile_tabs" class="uk-tab uk-tab-dark" data-uk-tab="{connect:'#user_tabs', animation:'slide-horizontal'}" >
            <li class="uk-active"><a href="#">WallPost</a></li>
            <li><a href="#">Personal</a></li>
            <li><a href="#">Academics</a></li>
            <li><a href="#">Athletics</a></li>
            <li><a href="#">Schedule</a></li>
            <li><a href="#">Photos</a></li>                                
            <li><a href="#">Videos</a></li>
            <li><a href="#">Resume</a></li>
            <li><a href="#">References</a></li>
        </ul>
      </div>

      <div class="add_friend"> 
        <?php  //print_r($req_current_status);
                //print_r($friendship_status);
         if(($friendship_status==0) && ($req_current_status->status==4)){ ?>
           <button type="button" id="add_friend" onclick="sendFriendRequest(<?php echo $friend_user_id;?>)" class="md-btn md-btn-primary adept-md-btn-primary">Add Friend</button>
       <?php } 
                 
        if($friendship_status==2 && $req_current_status->status==1){ ?>        
        <button type="button" id="delete_friend" onclick="unfriend(<?php echo $friend_user_id;?>)" class="md-btn md-btn-primary adept-md-btn-primary">Unfriend</button>
        <a class="md-btn md-btn-primary adept-md-btn-primary" href="#mailbox_div" data-uk-modal="{center:true}">
           Send Message<i class="material-icons">&#xE150;</i>
        </a>
        <?php } 
         
        if($friendship_status==0 && $req_current_status->status==0){ 
         ?>
           <button type="button" id="cancel_req" onclick="cancelFriendRequest(<?php echo $friend_user_id;?>)" class="md-btn md-btn-primary adept-md-btn-primary">Cancel Request</button>
      <?php } ?>
       
      </div>
       
     </div>     
   </div>  
  </div>
</div>
</div>
  
     


<div class="uk-modal" id="mailbox_div">
        <div class="uk-modal-dialog">
            <button class="uk-modal-close uk-close" type="button"></button>
            <form>
              <span id="form_error"></span>
                <div class="uk-modal-header">
                    <h3 class="uk-modal-title">Compose Message</h3>
                </div>
                <div class="uk-margin">
                    <label for="mail_to">To</label>
                    <span class="to"> <?php echo ucwords($name); ?></span>
                    <input type="hidden" id="login_user_id" value="<?php echo $login_user_id;?>"/>
                    <input type="hidden" id="friend_user_id" value="<?php echo $friend_user_id;?>"/>
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
                    <button type="button" id="sent_button" class="uk-float-right md-btn md-btn-primary" onclick="sendMail()">Send</button>
                </div>
            </form>
        </div>
    </div>

<script>
function sendMail(){  
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
          $('#loader').show();
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
                       $('#mailbox_div').hide();
                       
                       $('#mail_sent_status').empty();       
                       $('#mail_sent_status').append('<h3>Mail Sent successfully.</h3>').css('color','#090');                           
                    }                 
              
                 } 
            ); 
      }
        
    } 
</script>

<script>

function sendFriendRequest(friend_id)
{
    if(!friend_id==''){
      $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>friendcontroller/sendFriendRequest',
                data: {friend_id:friend_id},
            })
          .done(function(data){
            if(data)
            {
                window.location.reload();
            }

          })
      }
}

function cancelFriendRequest(friend_id){
     if(!friend_id==''){
      $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>friendcontroller/cancelFriendRequest',
                data: {friend_id:friend_id},
            })
          .done(function(data){
            if(data)
            {
                window.location.reload();
            }
          })
      }
}

function unfriend(friend_id){
  if(!friend_id==''){
      $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>friendcontroller/deleteFriend',
                data: {friend_id:friend_id},
            })
          .done(function(data){
            if(data)
            {
                window.location.reload();
            }
          })
      }
}
</script>



        