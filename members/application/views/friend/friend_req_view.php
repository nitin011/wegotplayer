<div class="md-card">
   <div class="md-card-content tx-md-card-content-adept">
     <div class="friend_list friend_list_frnd">

     <?php foreach ($req_list as $key => $value) { ?>
   	
     <div class="md-card-head friend_box" id="friend_box_<?php echo $value['friend_id']; ?>">
        
        <div class="uk-text-center">
              <img alt="" src="<?php echo $value['pic_url'];?>" class="md-card-head-avatar">
           </div>
          <h3 class="md-card-head-text uk-text-center uk_adept_main">
               <?php echo ucwords($value['user']->name); ?>
          	<span><?php //echo $value['user']->email; ?></span>
           </h3>
           <a class="uk-text-danger" title="Accept Request" id="accept" onclick="acceptRequest(<?php echo $value['friend_id']; ?>)">
              <i class="material-icons md-24 md-light">&#xE7FE;</i>
            </a>  
     </div>
     
     <?php } ?>

     <span id="request_action"></span>

    <script>

  function acceptRequest(id) {
  			var friend_id=id;
           $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url();?>friendcontroller/acceptRequest',
                      data: {friend_id:friend_id},
                  })
                .done(function(data){
                  if(data==1){                    
                     $('#request_action').css('color', 'green');        
                     $('#request_action').show();
                     $('#request_action').text("Friend Request Accepted");
                        setTimeout(function() {
                      $('#request_action').slideUp('slow');
                      $('#friend_box_'+id).slideUp('slow');                      
                      },2000);
                      return false;                   
                  }
                  else{

                  }
                  
                })
  }
    </script>