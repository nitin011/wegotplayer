   <!-- main sidebar -->
    <aside id="sidebar_main">
        <a href="<?php echo base_url(); ?>" class="uk-close sidebar_main_close_button"></a>
        <div class="sidebar_main_header">
            <div class="sidebar_logo"><a href="<?php echo base_url(); ?>home"><img src="<?php echo base_url(); ?>images/logo.png" alt="" height="15" width="71"/></a></div>
            
        </div>
        <div class="menu_section">
            <ul id="side_bar">                
                <li>
                    <a href="<?php echo base_url(); ?>home">
                        <span class="menu_icon uk-icon-th-large"></span>
                        Profile
                    </a>
                </li>
                <li>
                    <a href="#" id="account_side" name="account">
                        <span class="menu_icon uk-icon-th-large"></span>
                        Account
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>userwallpost">
                        <span class="menu_icon uk-icon-envelope-o"></span>
                        Wall-Post
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>usermailbox">
                        <span class="menu_icon uk-icon-envelope-o"></span>
                        Mailbox
                    </a>
                </li>

                 <li>
                    <a href="#" id="friend_side" name="friend">
                        <span class="menu_icon uk-icon-th-large"></span>
                        Friends
                    </a>
                </li>
                
            </ul>
        </div>
    </aside><!-- main sidebar end -->

<script>

    $(document).ready(function () {
            $("#account_side").click(function () {                
                var tab_value=$(this).attr('name');
                console.log(tab_value);

                if(tab_value=="account"){
                    $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount/accountView',
                      data: {tab_value:tab_value},

                      })
                    .done(function(data){
                      $('#first-section').html(data);
                    })
                }
                });

            $("#friend_side").click(function () {                
                var tab_value=$(this).attr('name');
                console.log(tab_value);

                if(tab_value=="friend"){
                    $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>friendcontroller/index',
                      data: {tab_value:tab_value},

                      })
                    .done(function(data){
                      $('#first-section').html(data);
                    })
                }
                });
            });

</script>