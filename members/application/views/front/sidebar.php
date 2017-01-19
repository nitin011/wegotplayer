   <?php if (!$this->session->userdata('user_exist'))
        {
          //If no session, redirect to login page
           redirect('user', 'refresh');
           exit();
        }
      $session_data = $this->session->userdata('user_exist');
      $username=$session_data['username'];
?>
   <!-- main sidebar -->
    <aside id="sidebar_main">
        <a href="<?php echo base_url(); ?>" class="uk-close sidebar_main_close_button"></a>
        <div class="sidebar_main_header">
            <div class="sidebar_logo"><a href="<?php echo base_url(); ?>profile/<?php echo $username;?>"><img src="<?php echo base_url(); ?>images/logo.png" alt="" height="15" width="71"/></a></div>
            
        </div>
        <div class="menu_section">
            <ul id="side_bar">                
                <li>
                    <a href="<?php echo base_url(); ?>profile/<?php echo $username;?>">
                        <span class="menu_icon uk-icon-th-large"></span>
                        Profile
                    </a>
                </li>
               
                <li>
                    <a id="front_wall">
                        <span class="menu_icon uk-icon-envelope-o"></span>
                        Wall-Post
                    </a>
                </li>
               

                
            </ul>
        </div>
    </aside><!-- main sidebar end -->
<script>
$(document).ready(function () {
     $("#front_wall").click(function () {                
           $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_wall/wallView',
                      data: {},
                  })
                .done(function(data){
                  $('#personal').html(data);
                })            
      });
});


</script>

