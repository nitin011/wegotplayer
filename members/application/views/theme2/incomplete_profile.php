<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>:: WeGotPlayer ::</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>css_1/bootstrap.css" rel="stylesheet">
     <link href="<?php echo base_url(); ?>css/datepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css_1/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>style-new.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css_1/animate.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>js/modernizr-2.0.6.js"></script>
    <script src="https://use.fontawesome.com/ba3772a294.js"></script>
    <!-- <link id="bsdp-css" href="bootstrap-datepicker/css/datepicker.css" rel="stylesheet"> -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900,100italic,300italic,400italic,500italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>

    <nav class="hed_nav">
      <div class="hed_inner">  
        <div class="logo">
          <?php  if (!$this->session->userdata('logged_in'))
                  {
                    //If no session, redirect to login page
                       redirect('user', 'refresh');
                       exit();
                  }
            $session_data = $this->session->userdata('logged_in');
            $dp_url=$session_data['dp_url'];    
            $usertype=$session_data['usertype'];   

            ?>

             <?php if($usertype==2){ ?>      
               <a href="<?php echo base_url(); ?>incomplete_profile">
             <?php }else {?>
                <a href="<?php echo base_url(); ?>incomplete_profile">
             <?php } ?>
                    <img src="<?php echo base_url(); ?>images/logo.png" align="logo.png">
              </a>
        </div>
        <div class="utility">
          <ul id="hide_on_search" style="display: block;">
            <li>
              <div class="dropdown header_avtar">
                  <button class="dropdown-toggle" type="button" data-toggle="dropdown">
                  <img src="<?php echo base_url().$dp_url; ?>" alt="ico_pro_img.png"></button>
                  <ul class="dropdown-menu">                 
                    <li><a href="<?php echo base_url(); ?>user/logout">Logout</a></li>
                  </ul>
              </div>                  
            </li>
         
        
        
          </ul>
          

        </div>
      </div>
    </nav>

    <section class="contact">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1">
            <div class="name">
              <h1><?php  echo $name;

              $name1 =explode(' ', $name)?></h1>
              <!-- <span><img src="<?php //echo base_url(); ?>images/india.png" alt="india.png"></span> -->
            </div>

            <div class="pro_bg">
              <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">                 

              
                  <div class="profile_picture">
                    <span>
                      <form id="profile_pic_form">
                        <div  id="dp_preview">
                           <img src="<?php echo $dp_url;?>" alt="<?php echo ucwords($name); ?>" title="<?php echo ucwords($name); ?>" id="dp_url"/>
                          <input type="file" name="profile_pic" class="ac_am_user_update_sport_left_contact" id="change_profile" style="display:none;">
                      </form>
                      </span>
                    <button>change picture</button>

                    <script type="text/javascript">
                       function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();   
            reader.onload = function (e) {
                $('#dp_image').attr('src', e.target.result);
            }  
            reader.readAsDataURL(input.files[0]);

        }

    }

    

    $("#profile_pic").change(function(){
        readURL(this);
    });

 $("form#profile_pic_form").change(function(){  
        var formData = new FormData($(this)[0]);
         var url = "<?php echo base_url();?>userphotos/uploadProfilePic";
         // the script where you handle the form input.
         $.ajax({
           url: url,
           type: 'POST',
           data: formData,
           async: false,
         success: function (data) {
             location.reload();  
         },
         cache: false,
         contentType: false,
         processData: false
         })
      });

});

                    </script>
                  </div>
                </div></div>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="fill_pro">  
                        <h3>fill profile</h3>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>first name<span>*</span><span id="fname_error"></span></h6>
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <input type="text" name="fname" value="<?php echo ucfirst($name1[0]); ?>" id="fname"> 
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>last name<span>*</span><span id="lname_error"></span></h6>
                        <input type="text" name="lname" value="<?php echo ucfirst($name1[1]); ?>" id="lname"> 
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>Email<span>*</span><span id="email_error"></span></h6>
                        <input type="email" value="<?php echo $email; ?>" name="email" id="email"> 
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>Gender<span>*</span><span id="gender_error"></span></h6>
                        <div class="btn_radio"> 
                            <ul class="todo-sqilloo">
                              <li><input name="gender" id="radio4" class="css-checkbox" value="1" checked="checked" type="radio">
                                <label for="radio4" class="css-label radGroup2">Male</label></li>

                              <li><input name="gender" id="radio5" class="css-checkbox" value="2" type="radio">
                                   <label for="radio5" class="css-label radGroup2">Female</label></li>
                            </ul>                          
                        </div> 
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>nationality<span>*</span></h6>                          
                          <select class="my_drop" name="nationality" id="nationality">
                            <option value="" selected="">Select Nationality</option>
                                <?php foreach ($nation as  $value) {  ?>                                                                                                                            
                                    <option value="<?php echo $value->id; ?>">
                                      <?php echo $value->nationality; ?></option>
                                <?php }   ?>       
                          </select>  
                          <span id="nationality_error"></span>          
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>DOB</h6>
                        <input type="text" id="dob" name="dob" placeholder="DD-MM-YYYY" data-date-format="dd-mm-yyyy"> 
                        <span id="dob_error"></span> 
                      </div>
                      
                    </div>
                  </div>
                  

                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>Enter a location</h6>
                        <input type="text" name="address" id="autocomplete" onFocus="geolocate()" placeholder="bulding name / office name"> 
                        <span id="address_error"></span> 
                      </div>

                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>Street address<span>*</span></h6>
                        <input type="text" id="street_number" name="street_number" placeholder="street name / number"> 
                     
                      </div>
                    </div>
                  </div>
                    <input id="route" type="hidden" disabled="true" required>
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>Zip code<span>*</span></h6>
                        <input type="text" id="postal_code" disabled="true" name="zip_code" value=""> 
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>City<span>*</span></h6>
                        <input type="text" name="city" id="locality" disabled="true" value=""> 
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>State<span>*</span></h6>
                        <input type="text" name="state" id="administrative_area_level_1" disabled="true" value=""> 
                        <span id="state_error"></span>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>Country<span>*</span></h6>
                        <input type="text" id="country" name="country" disabled="true" value=""> 
                        <span id="country_error"></span>
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>sports<span>*</span></h6>                          
                          <select class="my_drop" name="sport" id="sport" onchange="selectLevel();selectPosition();">
                             <option selected="" value="">Select Sport</option>
                              <?php foreach ($sport as  $value) {  ?>                                                                                                                            
                                   <option value="<?php echo $value->sportId; ?>"><?php echo $value->sportName; ?></option>
                               <?php }   ?>                                                                      
                          </select> 
                         <span id="sport_error"></span>             
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>level</h6>
                        <select class="my_drop" id="level" name="level">
                            
                        </select>
                        <span id="level_error"></span>  
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>Position / Speciality<span>*</span></h6>                          
                          <select class="my_drop" id="position" name="position" >
                           
                          </select> 
                           <span id="position_error"></span>            
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>Hand</h6>
                        <select class="my_drop" name="hand" id="hand">
                             <option selected="" value="">Select Hand</option>
                                <?php foreach ($hand as  $value) {  ?>                                                                                                                            
                                     <option value="<?php echo $value->handId; ?>"><?php echo $value->handName; ?></option>

                                <?php } ?>                           
                          </select> 
                           <span id="hand_error"></span> 
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>Foot<span>*</span></h6>                          
                          <select class="my_drop" id="foot" name="foot">
                            <option selected="" value="">Select Foot</option>
                              <?php foreach ($foot as  $value) {  ?>                                                                                                                            
                                     <option value="<?php echo $value->footId; ?>"><?php echo $value->footName; ?></option>

                                <?php } ?>
                          </select>   
                           <span id="foot_error"></span>         
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>Height</h6>
                        <select class="my_drop" name="height" id="height">
                           <option selected="" value="">Select Height</option>
                              <?php foreach ($height as  $value) {  ?>                                                                                                                            
                                 <option value="<?php echo $value->id; ?>"><?php echo $value->height; ?></option>
                                 <?php } ?>                           
                          </select> 
                           <span id="height_error"></span> 
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>Weight<span>*</span></h6>                          
                          <select class="my_drop" name="weight" id="weight">
                            <option selected="" value="">Select weight</option>
                              <?php foreach ($weight as  $value) {  ?>                                                                                                                            
                                 <option value="<?php echo $value->id; ?>"><?php echo $value->weight; ?></option>
                                 <?php } ?>
                          </select>   
                          <span id="weight_error"></span>         
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>How did you find us?</h6>
                        <select class="my_drop" name="find" id="find">
                            <option selected="" value="">Select..</option>
                              <option value="1" >Internet</option>
                              <?php foreach ($find as  $value) {  ?>                                                                                                                            
                                   <option value="<?php echo $value->findId; ?>"><?php echo $value->findName; ?></option>
                              <?php } ?>
                          </select> 
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>Seeking<span>*</span></h6>                          
                           <div class="check_box" id="seking">

                            <?php foreach ($seeking as $value) { ?>

                          <span>
                              <input type="checkbox" name="seek[]" id="seek_<?php echo $value->id;?>" value="<?php echo $value->id; ?>" class="seek"/>
                             <?php echo $value->seekingName; ?>
                          </span>
                          <?php   }?>
                          <span id="seeking_error"></span>                                                

                           </div>          
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="for_label">
                        <h6>Who can contact you?</h6>
                          <div class="check_box"  id="con_u">

                           <?php foreach ($contact as $value) { ?>
                            <span>
                                <input type="checkbox" name="contact_you[]" id="contact_you_<?php echo $value->id;?>" value="<?php echo $value->id; ?>" class="contact-you" />
                               <?php echo $value->contact_you; ?>
                            </span>
                            <?php   }?>
                            <span id="contact_error"></span>                                                   

                           </div>
                            
                          </div>
                      </div>
                    </div>   
                     <div class="col-md-12 col-sm-12 col-xs-12" id="clg-box" style="display:none;">
                         <div class="for_label">
                         <h6>High School Graduation Date</h6>
                             <input  type="text" id="graduation_date" name="graduation_date" readonly>
                          
                       </div> 
                    </div>         
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="for_label" id="text_a">
                        <h6>Personal information (enter mimimun 50 character)</h6>
                        <textarea name="personal_info" id="personal_info" onblur="checkMessage();"></textarea>
                         <span id="per_msg"></span>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="tearms">
                        <h4>By Signing Up with WeGotPlayers.com and creating your sports player’s profile, you acknowledge that you have read,understood and agreed with our <b>Terms</b> and <b>Privacy</b>.</h4>
                        <button type="button" id="btn_sumbit" name="submit">submit</button>                
                    </div>
                    <span id="profile_status"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

  <script src="<?php echo base_url();?>js/bootstrap-datepicker.js"></script>
<script type="text/javascript">

$('#dob').datepicker();
$('#graduation_date').datepicker({
    format: "dd-mm-yyyy"
});




$(document).ready(function(){
   $("#btn_sumbit").click(function(){

        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var gender = $('input[name="gender"]:checked').val();
        var dob= $('input[name="dob"]').val();
        var nationality = $("#nationality").val();
        var address = $("#autocomplete").val();
        var city = $("#locality").val();
        var state = $("#administrative_area_level_1").val();
        var country = $("#country").val();
        var zip_code = $("#postal_code").val();
        var sport = $("#sport").val();
        var level = $("#level").val();
        var position = $("#position").val();
        var hand = $("#hand").val();
        var foot = $("#foot").val();
        var height = $("#height").val();
        var weight = $("#weight").val();
        var find = $("#find").val();
        var personal_info=$("#personal_info").val();
        var contact_id = $("#con_u :checkbox:checked").val();        
        var seeking_id = $("#seking :checkbox:checked").val();

        var graduation_date = $("#graduation_date").val();


        console.log("fname => "+fname+" lname =>"+lname+" gender=>"+gender);
        console.log("dob => "+dob+" nationality =>"+nationality+" address=>"+address);
        console.log("city => "+city+" state =>"+state+" country=>"+country);
        console.log("zip_code => "+zip_code+" sport =>"+sport+" level=>"+level);
        console.log("position => "+position+" hand =>"+hand+" foot=>"+foot);
        console.log("height => "+height+" weight =>"+weight+" find=>"+find);
        console.log("personal_info => "+personal_info+" contact_id =>"+contact_id+" seeking_id=>"+seeking_id);
        console.log('graduation_date=>'+graduation_date);

        

        var error_div='<div class="alert alert-danger error"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        
        if(fname.length==0){
          var error_msg="Please fill first name </div>";
          $("#fname_error").html(error_div+error_msg);
        }
        if(lname.length==0){          
          var error_msg ='Please fill last name. </div>';
          $("#lname_error").html(error_div+error_msg);
        }
        if(email.length==0){          
          var error_msg ='Please fill Email Address. </div>';
          $("#dob_error").html(error_div+error_msg);
        }

        if(nationality==''){
           var error_msg ='Please select nationality.</div>';
          $("#nationality_error").html(error_div+error_msg);
        }
        if(dob==''){
          var error_msg ='Please Enter Date fo birth.</div>';
          $("#dob_error").html(error_div+error_msg);
        }
        if(address==''){
          var error_msg ='Please select Address.</div>';
          $("#address_error").html(error_div+error_msg);
        }
        if(state==''){
          var error_msg ='Please select state.</div>';
          $("#state_error").html(error_div+error_msg);
        }
        if(sport==''){
           var error_msg ='Please select sport.</div>';
          $("#sport_error").html(error_div+error_msg);
        }
        if(level==''){
           var error_msg ='Please select sport level.</div>';
          $("#level_error").html(error_div+error_msg);
        }

        if(position==''){
           var error_msg ='Please select sport position.</div>';
          $("#position_error").html(error_div+error_msg);
        }
        if(hand==''){
           var error_msg ='Please select Hand.</div>';
          $("#hand_error").html(error_div+error_msg);
        }

         if(foot==''){
           var error_msg ='Please select Foot.</div>';
          $("#foot_error").html(error_div+error_msg);
        }
         if(weight==''){
           var error_msg ='Please select Weight.</div>';
          $("#weight_error").html(error_div+error_msg);
        }
        if(height==''){
           var error_msg ='Please select Height.</div>';
          $("#height_error").html(error_div+error_msg);
        }


         else{
        
         $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>userdetail/updatePersonal',
                data: {fname:fname,lname:lname,gender:gender,dob:dob,nationality:nationality,
                       address:address,city:city,state:state,country:country,zip_code:zip_code,
                       sport:sport,level:level,position:position,hand:hand,foot:foot,height:height,
                       weight:weight,find:find,contact_you:contact_id,seek:seeking_id,
                       personal_info:personal_info,graduation_date:graduation_date},
                success :function(data){
                  if(data=="home"){
                    var url="<?php echo base_url(); ?>"+data;
                    window.location=url; 
                    return false;
                  }else{
                    $("#profile_status").html(data);
                  }
                }
            })
        }
  });
});


function checkMessage(){
    var personal_info=$("#personal_info").val();
    
    if(personal_info!=" "){       
     $("#per_msg").css('color', 'red'); 
     $("#per_msg").append('Enter Personal Information');
    setTimeout(function() {
          $('#per_msg').slideUp('slow');
          },2000);        
        return false;   
  }
  if(personal_info.length<=50){
       $("#per_msg").css('color', 'red'); 
       $("#per_msg").append('Enter Minimum 50 character');
    setTimeout(function() {
          $('#per_msg').slideUp('slow');
          },2000);        
        return false; 
  }
}


  function selectLevel()
  {
      sport_id = $("#sport").val();
      if(!sport_id==''){
      $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>userdetail/selectLevel',
                data: 'id='+sport_id,
                success :function(levelData){
                  
                  $('#level').html(levelData);
                  return false;
                }
            })

        }else{    
                  var data='<option value="" selected="">Select Level</option>';
                  $('#level').empty();
                  $('#position').empty();

                  $('#levelis').append(data);
                  var data1='<option value="" selected="">Select Position</option>';
                  $('#position').append(data1);
             }
  }

  function selectPosition()
  {

    sport_id = $("#sport").val();
          
      if(!sport_id==''){
      $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>userdetail/selectPosition',
                data: 'id='+sport_id,
                success :function(positionData){
                  
                  $('#position').html(positionData);
                  return false;
                }
            })

        }else{    
                  var data='<option value="" selected="">Select Position</option>';
                  $('#position').empty();
                  $('#position').append(data);
             }
      

  }


</script>

<script>
$(document).ready(function () {
    $(".seek").click(function () {                 
      var tab=$(this).attr('id');     
      //var value=$(this).val();      
      for(var j=1;j<=9;j++){
      if(tab=='seek_'+j){
        if(tab=='seek_1' || tab=='seek_2'){
          $("#clg-box").show();
        }
          
        //$("#contact_you_"+j).attr('checked', true); 
        document.getElementById("contact_you_"+j).checked = true;
        if ($(this).is(':checked')) {
          for(var i=1;i<=9;i++){
          
          $("#contact_you_"+i).attr('disabled', true);
          $("#contact_you_"+j).attr('disabled', false);
                          
            $("#seek_"+i).attr('disabled',true);
            $("#seek_"+j).attr('disabled',false);
            }
        }else{
          $("#clg-box").hide();
          
          $("#contact_you_"+j).removeAttr('checked');

          for(var i=1;i<=9;i++){
            $("#contact_you_"+i).removeAttr('disabled');
            $("#seek_"+i).attr('disabled',false);
            //$("#seek_"+j).attr('disabled',true);
            }
        }
      }
    }

                
  });

$("#contact_you_10").click(function(){
      
       if ($(this).is(':checked')) {
           for (var i =1 ; i <= 9; i++) {
              $("#seek_"+i).attr('disabled', true);
              $("#seek_"+i).removeAttr('checked');
               $("#contact_you_"+i).removeAttr('checked');
              $("#contact_you_"+i).attr('disabled', true);
            }
       }
       else{
         for(var j=1;j<=9;j++)
          {
            $("#contact_you_"+j).attr('disabled', false);           
            $("#seek_"+j).attr('disabled', false);
            }
       }
});

  $(".contact-you").click(function () {                  
    var tab2=$(this).attr('id');
    
    for(var s=1;s<=9;s++){
    if(tab2=='contact_you_'+s){
      if(tab2=='contact_you_1' || tab2=='contact_you_2'){        
          $("#clg-box").show();         
        }
        document.getElementById("seek_"+s).checked = true;
      
        if ($(this).is(':checked')) {                 
          
            
          for (var i =1 ; i <= 9; i++) {
          $("#seek_"+i).attr('disabled', true);
          $("#contact_you_"+i).attr('disabled', true);
          $("#contact_you_"+s).attr('disabled', false);
          $("#seek_"+s).attr('disabled', false);
        }
          
          
        }else{
          $("#clg-box").hide();         
          $("#seek_"+s).removeAttr('checked');

          $("#contact_you_"+s).removeAttr('checked');
          for(var j=1;j<=9;j++)
          {
            $("#contact_you_"+j).attr('disabled', false);
            $("#seek_"+s).removeAttr('checked');
            $("#seek_"+j).attr('disabled', false);
            }         
        }
      }      
        
      }     
    });


});

</script>

 <script>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
      {types: ['geocode']});

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
// [END region_geolocation]

 </script>

    <script src="https://maps.googleapis.com/maps/api/js?signed_in=true&libraries=places&callback=initAutocomplete" async defer></script>

 <!-- Include all compiled plugins (below), or include individual files as needed -->
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
  </body>
</html>
