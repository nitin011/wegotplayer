<!doctype html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo $title; ?></title>
   
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/uikit/css/uikit.almost-flat.min.css" media="all">
    <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/kendo-ui-core/styles/kendo.common-material.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/kendo-ui-core/styles/kendo.material.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css" media="all">
    <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" media="all">
    <link href='<?php echo base_url(); ?>css/jquery-customselect.css' rel='stylesheet' />
   <script src="<?php echo base_url(); ?>js/jquery-2.1.4.js"></script> 
    

</head>
<body >
    <!-- main header -->
    <header id="header_main">
    <div class="header_main_content_advnc">
         
            <!-- main sidebar switch -->            
           <a href="<?php echo base_url(); ?>home">
              <img alt="" src="<?php echo base_url(); ?>images/logo.png" class="">
          </a>  
         
    </div>
        <div class="header_main_content">
            <nav class="uk-navbar">
                <!-- main sidebar switch -->
               
                </a>
                <?php  if (!$this->session->userdata('logged_in'))
                  {
                    //If no session, redirect to login page
                       redirect('user', 'refresh');
                       exit();
                  }
            $session_data = $this->session->userdata('logged_in');
            $dp_url=$session_data['dp_url'];    

            ?>
                <!-- secondary sidebar switch -->
                
                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions"> 
                     <li data-uk-dropdown="{mode:'click'}">
                            <a href="<?php echo base_url(); ?>home" class="user_action_image"><img class="md-user-image" src="<?php echo base_url().$dp_url; ?>" /></a>
                            <div class="uk-dropdown uk-dropdown-small uk-dropdown-flip">
                                <ul class="uk-nav js-uk-prevent" id="head-section">
                                    <li><a href="<?php echo base_url(); ?>home">Profile</a></li>
                                    <li><a href="#">Settings</a></li>
                                    <li><a href="<?php echo base_url(); ?>user/logout">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        
    </header><!-- main header end -->

  <script>
     $(document).ready(function () {
            $("#head-section li").click(function () {                
                var tab_value=$(this).text();
                console.log(tab_value);

                if(tab_value=="Settings"){
                    $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount',
                      data: {tab_value:tab_value},

                      })
                    .done(function(data){
                      $('#first-section').html(data);
                    })
                }
                });
            });
   </script> 
  
