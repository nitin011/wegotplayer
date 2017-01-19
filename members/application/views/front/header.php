

<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo $title; ?></title>
      <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet">     
    <link href="<?php echo base_url(); ?>css/theme2.css" rel="stylesheet">        
     <link rel="stylesheet" href="<?php echo base_url(); ?>css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap-formhelpers.min.css">     
    <script src="<?php echo base_url(); ?>js/modernizr-2.0.6.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900,100italic,300italic,400italic,500italic,700italic,900italic' rel='stylesheet' type='text/css'>
   
   <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/uikit/css/uikit.almost-flat.min.css" media="all">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css" media="all">
    <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" media="all">
 
   <script src="<?php echo base_url(); ?>js/jquery-2.1.4.js"></script> 
   <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script> 
        
             <?php  if (!$this->session->userdata('user_exist'))
                  {
                    //If no session, redirect to login page
                       redirect('user', 'refresh');
                       exit();
                  }
            $session_data = $this->session->userdata('user_exist');
            $dp_url=$session_data['dp_url'];    
            //$usertype=$session_data['usertype'];   

            ?>  
    
</head>
<body>
    <!-- main header -->
    <header id="header_main">
         <div class="header_main_content_advnc">
         
      
             
                <!-- main sidebar switch -->      

                <?php //if($usertype==2){ ?>      
               <!-- <a href="<?php //echo base_url(); ?>recruiter"> -->
                <?php //}else {?>
               <a href="<?php echo base_url(); ?>home"> 
                <?php //} ?>
                  <img alt="" src="<?php echo base_url(); ?>images/logo.png" class="">
              </a>
              
         
        </div>
        
        <div class="header_main_content">
            <nav class="uk-navbar">             
                 
               
                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions"> 
                      <!--  <li><a href="#" id="main_search_btn" class="user_action_icon"><i class="material-icons md-24 md-light">&#xE8B6;</i></a></li>-->
                     <li data-uk-dropdown="{mode:'click'}">
                            <a href="<?php echo base_url(); ?>home" class="user_action_image">
                              <img class="md-user-image" src="<?php echo $dp_url; ?>" /></a>
                            <div class="uk-dropdown uk-dropdown-small uk-dropdown-flip">
                                <ul class="uk-nav js-uk-prevent" id="head-section">
                                    <li><a href="<?php echo base_url(); ?>profile">My Profile</a></li>                                
                                    
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="header_main_search_form">
            <i id="close_list" class="md-icon header_main_search_close material-icons">&#xE5CD;</i>
            <form class="uk-form">
                <input type="text" class="header_main_search_input" id="search_box" autocomplete="off" placeholder="Search via Player Name/ Username/ Email"/>
                <button type="button" class="header_main_search_btn uk-button-link" id="search_user"><i class="md-icon material-icons">&#xE8B6;</i></button>
            </form>
        </div>
        <div id="search_list"></div>
    </header><!-- main header end -->
   
     
 <script>

function selectName(id){

   var username = $("#field_"+id).val();
            

    if(username!=''){
        window.location.replace("<?php echo base_url(); ?>profile/"+username);
     }
 }

</script>
  <script>
  $(document).ready(function () {
       $("#search_box").keypress(function () { 

            var search_field= $("#search_box").val();
             // post field to search data
            if((search_field!='') && (search_field.length>=2)){                
                $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>search_controller/searchUser',
                      data: {field:search_field},
                  })
                .done(function(data){
                  $('#search_list').html(data);                    
                })
            }else{
              $('#search_list').empty(); 
            }
            
       });

$("#close_list").click(function () { 
         $('#search_list').empty(); 
      });


    });   
/*
    $(document).keypress(function(e) {
    if(e.which == 13) {
        var search_field= $("#search_box").val();
        alert(search_field);
    }
}); */

</script>



  

    <div id="page_content">
        <div id="page_content_inner">       
            <div id="first-section">


 