<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
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
<script src="<?php echo base_url(); ?>js/jquery-2.1.4.js"></script> 
    
</head>
<body class="sidebar_main_open">
    <!-- main header -->
    <header id="header_main">

        <div class="header_main_content_advnc">             
                <!-- main sidebar switch -->            
               <a href="<?php echo base_url(); ?>/home">
                  <img alt="" src="<?php echo base_url(); ?>images/logo.png" class="">
              </a>
             
        </div>
        <div class="header_main_content">
            <nav class="uk-navbar">
                <!-- main sidebar switch -->
                <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                    <span class="sSwitchIcon"></span>
                </a>
                <!-- secondary sidebar switch -->
                <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">
                    <span class="sSwitchIcon"></span>
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
                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions"> 
                     <li data-uk-dropdown="{mode:'click'}">
                            <a href="" class="user_action_image"><img class="md-user-image" src="<?php echo base_url().$dp_url; ?>" /></a>
                            <div class="uk-dropdown uk-dropdown-small uk-dropdown-flip">
                                <ul class="uk-nav js-uk-prevent" id="head-section">
                                    <li><a href="<?php echo base_url(); ?>recruiter">My Profile</a></li>
                                    
                                    <li><a href="<?php echo base_url(); ?>user/logout">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="header_main_search_form">
            <i class="md-icon header_main_search_close material-icons">&#xE5CD;</i>
            <form class="uk-form">
                <input type="text" class="header_main_search_input" />
                <button class="header_main_search_btn uk-button-link"><i class="md-icon material-icons">&#xE8B6;</i></button>
            </form>
        </div>
    </header><!-- main header end -->
    
  
  

    <div id="page_content">
        <div id="page_content_inner">
            <div id="first-section">

 