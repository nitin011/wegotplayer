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
     <div  id="profile_photo" class="user_heading_avatar">
          <img src="<?php echo $dp_url;?>" alt="user avatar"/>
      </div>
      <div class="upper_save_tab">
          <span class="uk-text-truncate"><?php echo ucwords($name); ?></span>

          <ul id="user_profile_tabs" class="uk-tab uk-tab-dark" data-uk-tab="{connect:'#user_tabs', animation:'slide-horizontal'}" >
            
              <li class="uk-active"><a href="#">Wallpost</a></li>
              <li><a href="#">Personal</a></li>
              <li><a href="#">Academics</a></li>
              <li><a href="#">Atheletics</a></li>
              <li><a href="#">Schedule</a></li>
              <li><a href="#">Photos</a></li>                                
              <li><a href="#">Videos</a></li>
              <li><a href="#">Resume</a></li>
              <li><a href="#">References</a></li>
    
          </ul>

      </div>
    </div>
    
       
     </div>     
   </div>  
  </div>
</div>

 
 <style type="text/css">
.cover-image {
  height: 320px;
  width: 100%;
  position: relative; 
  background-color:#ffffff;
}
</style>







        