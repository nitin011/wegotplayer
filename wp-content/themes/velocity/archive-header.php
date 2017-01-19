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
    <meta name="description" content="">
    <meta name="author" content="">    
    <!--<link rel="shortcut icon" href="favicon.ico"> --> 
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,700italic,900,900italic,300italic,300' rel='stylesheet' type='text/css'> 
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100' rel='stylesheet' type='text/css'>
    <!-- Global CSS -->
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/assets/plugins/bootstrap/css/bootstrap.min.css">   
    <!-- Plugins CSS -->    
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/assets/plugins/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/assets/plugins/flexslider/flexslider.css">
    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/style.css">
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
<body class="blog-page">
    <div class="wrapper adept_tinku">
    
<header id="header" class="header archive navbar-fixed-top scrolled ">  
        <div class="container">       
            <h1 class="logo">
                <a href="/" border="0" alt="wegotplayers">We got players</a>
          </h1><!--//logo-->
                <nav class="main-nav navbar-right" role="navigation">
                    <div class="navbar-header">
                      <img src="<?php echo get_bloginfo('template_directory'); ?>/logo.png"class="home-icon" onClick="goHome()">
                        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button><!--//nav-toggle-->
                  </div><!--//navbar-header-->
                    <div id="navbar-collapse" class="navbar-collapse collapse">
                          <ul class="nav navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Categories <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu">
                                   <?php 
                                      $args = array(
                                      'show_option_all'    => '',
                                      'orderby'            => 'name',
                                      'order'              => 'ASC',
                                      'style'              => 'list',
                                      'show_count'         => 0,
                                      'hide_empty'         => 1,
                                      'use_desc_for_title' => 1,
                                      'child_of'           => 0,
                                      'feed'               => '',
                                      'feed_type'          => '',
                                      'feed_image'         => '',
                                      'exclude'            => '',
                                      'exclude_tree'       => '',
                                      'include'            => '',
                                      'hierarchical'       => 1,
                                      'title_li'           => '',
                                      'show_option_none'   => __( '' ),
                                      'number'             => null,
                                      'echo'               => 1,
                                      'depth'              => 0,
                                      'current_category'   => 0,
                                      'pad_counts'         => 0,
                                      'taxonomy'           => 'category',
                                      'walker'             => null
                                      );
                                      wp_list_categories( $args ); 
                                  ?>
                                                                                 
                                </ul>                            
                            </li><!--//dropdown-->
                            <li class="nav-item dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Archives <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu">
                                  <?php wp_get_archives( array( 'type' => 'monthly', 'show_post_count' => 1 ) ); ?> 
                                 
                                </ul>                            
                            </li><!--//dropdown-->

                            <li class="nav-item">
                                
                                  <a href="http://www.wegotplayers.com/blog/"><i class="fa fa-home"></i> Blog</a>
                                                      
                            </li><!--//dropdown-->
                            
                        </ul><!--//nav-->
                        
                          <div class="searchbox-container">
                   
                            <form class="searchbox" role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <!-- <label class="sr-only" for="s">Search</label> -->
                                <input id="s" class="form-control searchbox-input"  type="text" value="" name="s">
                                <!-- <input class="searchbox-submit" type="submit" name="submit" id="searchsubmit"> -->
                                <i class="fa fa-search searchbox-icon"></i>
                            </form>
                        </div><!--//searchbox-container-->                                                
                     
                    </div><!--//navabr-collapse-->
                </nav><!--//main-nav-->         
            </div><!--//container-->
        </header><!--//header--> 
        
        
        