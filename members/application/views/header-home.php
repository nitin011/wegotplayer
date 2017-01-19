

<!DOCTYPE html>
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap-formhelpers.min.css">
       
    
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,300' rel='stylesheet' type='text/css'>
   
    <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/uikit/css/uikit.almost-flat.min.css" media="all">
    <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/kendo-ui-core/styles/kendo.common-material.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/kendo-ui-core/styles/kendo.material.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css" media="all">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/croppic.css">
    <link href="<?php echo base_url(); ?>css/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/owl.theme.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" media="all">
    <script src="<?php echo base_url(); ?>js/jquery-2.1.4.js"></script> 
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script> 
     <script type="text/javascript">
      $(document).ready(function(){
            $("#show_search").click(function(){
              $("#hide_on_search").css("display","none");
              $("#search_bar").css("display", "block");
           }); 

            $("#close_btn").click(function(){
              $("#search_bar").css("display", "none");
              $("#hide_on_search").css("display","block");
              
           });
      });
      </script>
    <script src="<?php echo base_url(); ?>js/modernizr-2.0.6.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.mousewheel.min.js"></script>
    <script src="<?php echo base_url(); ?>js/croppic.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.form.js"></script>
    <script src="https://use.fontawesome.com/ba3772a294.js"></script>

 <script src="<?php echo base_url(); ?>bower_components/moment/min/moment.min.js"></script> 
  <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-datetimepicker.min.js"></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-datetimepicker.min.css" />

   
   
   
    
</head>
<!--<body class="sidebar_main_open"> -->
    <body>
    <!-- main header -->
    <nav class="hed_nav">
      <div class="hed_inner">  
        <div class="logo">
          <a href="<?php echo base_url(); ?>home">
              <img alt="" src="<?php echo base_url(); ?>images/logo.png" class="">
          </a>
        </div>
        <div class="utility">
          <?php  if (!$this->session->userdata('logged_in'))
            {
              //If no session, redirect to login page
                 redirect('user', 'refresh');
                 exit();
            }
              $session_data = $this->session->userdata('logged_in');
              $dp_url=$session_data['dp_url'];
              $acc_type=$session_data['acc_type']; 
               


              ?>



                <script src="https://apis.google.com/js/platform.js?onload=onLoadCallback" async defer></script>
                <script type="text/javascript">

                  function signOut() {
                    var auth2 = gapi.auth2.getAuthInstance();
                    auth2.signOut().then(function () {
                      console.log('User signed out.');
                    });
                  }

                 window.onLoadCallback = function(){
                    gapi.auth2.init({
                        client_id: '1013253489958-amqo59g84o5ob8l7dce1vj1jv5pr7f14.apps.googleusercontent.com'
                      });
                  }

                  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '177842009346338',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use graph api version 2.8
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me',{ locale: 'en_US', fields: 'name,email' }, function(response) {
      var name = response.name;
      var email =  response.email;
     // var picture = response.picture;    


      console.log("name : "+name+ " email : "+email );    
    });
  }
    function LogOut() {
      FB.logout(function(response) {
          // user is now logged out
          console.log(response.name+" logout ");
        });
    }
                 
              </script>
          <ul id="hide_on_search" style="display: block;">
            <li>
              <div class="dropdown">
                  <button class="dropdown-toggle" type="button" data-toggle="dropdown">
                    <img class="md-user-image" src="<?php echo base_url().$dp_url; ?>" alt="ico_pro_img.png">
                    <span class="uk-badge"> 
                      <a class="ac_pricing" href="<?php echo base_url().'pricing';?>" target="_blank">
                        <?php print_r($acc_type); ?>
                      </a>
                    </span>
                  </button>
                  <ul class="dropdown-menu" id="head-section">
                    <li><a href="<?php echo base_url(); ?>home">Profile</a></li>
                    <!-- <li><a>Settings</a></li>  -->
                    <li><a href="<?php $_SERVER['HTTP_HOST']; ?>/help/" target="_blank">Help</a></li>  
                    <?php if(($acc_type=='BASIC')||($acc_type=='PLUS')){ ?>  
                    <li><a href="<?php echo base_url(); ?>pricing" target="_blank">Upgrade Profile</a></li> 
                    <?php } ?>                                                                 
                    <li><a href="<?php echo base_url(); ?>user/logout" onclick="signOut();LogOut();">Logout</a></li> 
                  </ul>
              </div>                  
            </li>
            <!-- End Profile -->

          
             
            <li>
              <div class="dropdown">
                <button class="dropdown-toggle" type="button" data-toggle="dropdown">
                  <i class="fa fa-cog adept_cog" aria-hidden="true"></i>
                </button>
                <ul class="dropdown-menu top43" id="setting_dropdown">
                  <li id="set_account_li"><a href="<?php echo base_url(); ?>useraccount">Account Type</a></li>
                   <li id="set_plus_li"><a href="<?php echo base_url(); ?>useraccount">Passcode</a></li>
                   <li id="set_basic_li"><a href="<?php echo base_url(); ?>useraccount">Basic</a></li>
                   <li id="set_privacy_li"><a href="<?php echo base_url(); ?>useraccount">Privacy</a></li>
                   <li id="set_notification_li" ><a href="<?php echo base_url(); ?>useraccount">Notification</a></li>
                   <li id="set_activation"><a href="<?php echo base_url(); ?>useraccount">Deactivate</a></li>    
                </ul> 
              </div>              
            </li>
            <!-- End setting -->
            <li>
              <div class="dropdown">
                <button class="dropdown-toggle" type="button" data-toggle="dropdown" id="get_notification_list">
                  <i class="fa fa-bell adept_bell" aria-hidden="true"></i>
                  <?php if($n_count!=0) {?>
                   <span class="uk-badge"><?php print_r($n_count); ?></span>
                  <?php } ?>
                </button>
                <ul class="dropdown-menu dropdown-menu2 top43">
                  <li>
                    <div class="dop_con">
                      <ul class="md-list" id="notification_list">                                   
                                   
                      </ul>
                      <script>
                        function showNotiDate(id){
                                $('#noti_date_id_'+id).css({ display: "block" });
                          } 
                      </script>
                      <a href="<?php echo base_url(); ?>notification/view" id="noti_read" class="md-btn md-btn-flat md-btn-flat-primary md-btn-block js-uk-prevent uk-margin-small-top btn-adept-md-btn-primary">All Notification</a>
                    </div>
                  </li>              
                </ul> 
              </div>              
            </li>
            <!-- End notification -->
            <li>
              <div class="dropdown">
                <button class="dropdown-toggle" type="button" data-toggle="dropdown" id="get_mail_list">
                  <i class="fa fa-envelope ac_envelope" aria-hidden="true"></i>
                  <?php if($m_count!=0) {?>
                   <span class="uk-badge"><?php print_r($m_count); ?></span>
                  <?php } ?>
                </button>
                <ul class="dropdown-menu dropdown-menu2 dropdown-menu2_varu top43">
                   <div class="dop_con">
                    <ul class="md-list" id="mail_list">                                   
                                   
                    </ul>
                    <a href="<?php echo base_url(); ?>usermailbox" class="md-btn md-btn-flat md-btn-flat-primary md-btn-block js-uk-prevent uk-margin-small-top btn-adept-md-btn-primary">Check All Mail</a>
                   </div>             
                </ul> 
              </div>
            </li>
            <!-- End envelope -->
            <li>
              <a class="ac_vtwall" href="<?php echo base_url(); ?>wall"><i class="fa fa-pencil-square-o ac_envelope" aria-hidden="true"></i></a>
            </li>
            <!-- End wall -->
            <li>
              <div class="dropdown">
                <button class="dropdown-toggle" type="button" data-toggle="dropdown" id="frnd_req_list">
                  <i class="fa fa-user-plus adept_userplus" aria-hidden="true"></i>
                  <?php if($f_count!=0) {?>
                      <span class="uk-badge"><?php print_r($f_count); ?></span>
                  <?php } ?>
                </button>
                <ul class="dropdown-menu dropdown-menu2 dropdown-menu2_varu top43">
                   <div class="dop_con">
                    <ul class="md-list" id="li_list">                                   
                                   
                    </ul>
                    <a id="friend_side" name="friend" class="md-btn md-btn-flat md-btn-flat-primary md-btn-block js-uk-prevent uk-margin-small-top btn-adept-md-btn-primary">Show All Friend</a>
                   </div>             
                </ul> 
              </div>              
            </li>
            <li><a href="#" id="show_search"><img src="<?php echo base_url(); ?>images/ico_search.png" alt="ico_search.png"></a></li>
          </ul>
          <div class="search_bar" id="search_bar" style="display: none;">
            <span>
              <button id="close_btn"><i class="fa fa-times" aria-hidden="true"></i></button>
              <input type="text" id="search_box" autocomplete="off" placeholder="Search via Player Name/ Username/ Email"/>
              <button type="button" id="search_user"><i class="fa fa-search" aria-hidden="true"></i></button>
            </span>
          </div>
          <div id="search_list"></div>
        </div>
      </div>
    </nav>
  
  <script>
     $(document).ready(function () {
            $("#head-section li").click(function () {                
                var tab_value=$(this).text();              

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
            
     $("#friend_side").click(function () {                
                var tab_value=$(this).attr('name');               

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
            $("#frnd_req_list").click(function () { 
                
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>friendcontroller/friendRequestList',
                      data: {},
                      })
                    .done(function(data){
                      $('#li_list').empty().html(data);
                      
                    })
             });


            
             $("#get_mail_list").click(function () { 
                  $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>usermailbox/getUnreadMailList',
                      data: {},
                      })
                    .done(function(data){
                      $('#mail_list').empty().html(data);
                      
                    })
              });

             $("#get_notification_list").click(function () { 
                  $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>notification',
                      data: {},
                      })
                    .done(function(data){
                      $('#notification_list').empty().html(data);
                      
                    })
              });               


              /*$("#head_setting").click(function (){
                  $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount',
                      data: {},

                      })
                    .done(function(data){
                      $('#first-section').html(data);
                    })
              });  */


              $("#set_account_li").click(function (){
                var clicked = 'account_type_tab';
                  $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount',
                      data: {clicked:clicked},

                      })
                    .done(function(data){
                    $("#main_tab_target").css({ display: "none" });
                    $("#sidetab_destination").css({ display: "block" });
                      $('#sidetab_destination').html(data);                         
                    })
              });

              $("#set_plus_li").click(function (){

                var clicked = 'plus_fun_tab';
                  $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount',
                      data: {clicked:clicked},

                      })
                    .done(function(data){
                      $("#main_tab_target").css({ display: "none" });
                      $("#sidetab_destination").css({ display: "block" });
                      $('#sidetab_destination').html(data);                          
                    })
              });

              $("#set_basic_li").click(function (){

                var clicked = 'basic_set_tab';
                  $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount',
                      data: {clicked:clicked},
                      })
                    .done(function(data){
                      $("#main_tab_target").css({ display: "none" });
                      $("#sidetab_destination").css({ display: "block" });
                      $('#sidetab_destination').html(data);                          
                    })
              });

            $("#set_privacy_li").click(function (){
                var clicked = 'priv_set_tab';
                  $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount',
                      data: {clicked:clicked},
                      })
                    .done(function(data){
                      $("#main_tab_target").css({ display: "none" });
                      $("#sidetab_destination").css({ display: "block" });
                      $('#sidetab_destination').html(data);                          
                    })
              });
          $("#set_notification_li").click(function (){
                var clicked = 'noti_set_tab';
                  $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount',
                      data: {clicked:clicked},
                      })
                    .done(function(data){
                      $("#main_tab_target").css({ display: "none" });
                      $("#sidetab_destination").css({ display: "block" });
                      $('#sidetab_destination').html(data);                          
                    })
              });
             $("#set_activation").click(function (){
                var clicked = 'deactivate_tab';
                  $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>useraccount',
                      data: {clicked:clicked},
                      })
                    .done(function(data){
                      $("#main_tab_target").css({ display: "none" });
                      $("#sidetab_destination").css({ display: "block" });
                      $('#sidetab_destination').html(data);                          
                    })
              });

           
              $("#noti_read").click(function() {           
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>notification/updateNotificationStatus',
                      data: {},
                      })
                    .done(function(data){                      
                      
                    })
              });

    });


//$('#accordion li').children('ul').slideUp('fast');
  $('#accordion > li').click(function () {
     $(this).addClass('active').siblings('li').removeClass('active');
     //$(this).siblings('li').find('ul').slideUp('fast');
  });
    
   </script> 



    <script>

function selectName(id){

   var username = $("#field_"+id).val();           

    if(username!=''){
        window.location.replace("<?php echo base_url(); ?>search_user/"+username);
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
function addFriend(id){
  $.ajax({
           type: 'POST',
           url: '<?php echo base_url();?>friendcontroller/acceptRequest',
           data: {friend_id:id},
         })
      .done(function(data){
            if(data==1){ 
                setTimeout(function() {            
                    $('#friend_row_'+id).slideUp('slow');                      
                 },1000);
                 return false;
            }else{

            }        
      })

}

</script>

  

    <div id="page_content">
        <div id="page_content_inner">
            <div id="first-section" class="profile-overview">
             

 