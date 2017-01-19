<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title><?php wp_title(''); ?></title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="author" content="">    
    <!--<link rel="shortcut icon" href="favicon.ico">  -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,700italic,900,900italic,300italic,300' rel='stylesheet' type='text/css'> 
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100' rel='stylesheet' type='text/css'>
    <!-- Global CSS -->
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/assets/plugins/bootstrap/css/bootstrap.min.css">   
    <!-- Plugins CSS -->    
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/assets/plugins/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/assets/plugins/flexslider/flexslider.css">
    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
     <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<?php wp_head(); ?>
<script>
  function goHome() {
                window.location='http://www.wegotplayers.com/';

            }
        </script>
</head> 

<body class="signup-page access-page has-full-screen-bg">
    <div class="upper-wrapper">
    

    <!-- ******HEADER****** --> 
    <header id="header" class="header navbar-fixed-top scrolled">  
        <div class="container">         
            <h1 class="logo">
                
           <a href="/" border="0" alt="wegotplayers">We got players</a>
          </h1><!--//logo-->
            <nav class="main-nav navbar-right" role="navigation">
                <div class="navbar-header">
                    <i class="fa fa-home home-icon" onClick="goHome()"></i>
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button><!--//nav-toggle-->
            </div><!--//navbar-header-->
                <div id="navbar-collapse" class="navbar-collapse collapse">
 <?php if (is_page('blog')){ ?>
        <div id="page-info"><?php the_content(); ?></div>
    <?php } ?>
                <?php   
                       wp_nav_menu( array( 'theme_location' => 'primary' ,'menu_class'=>'nav navbar-nav' ) ); //}
                   ?>
                                   
                                                                  
                     
                </div><!--//navabr-collapse-->
            </nav><!--//main-nav-->                     
        </div><!--//container-->
    </header><!--//header--> 
        
        