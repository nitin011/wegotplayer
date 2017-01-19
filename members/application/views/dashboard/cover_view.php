 <?php  if (!$this->session->userdata('logged_in'))
      {
          //If no session, redirect to login page
           redirect('user', 'refresh');
           exit();
    }
        $session_data = $this->session->userdata('logged_in');
        $dp_url=$session_data['dp_url'];  
        $cover_url=$session_data['cover_url']; 

?>
<style>
#cropContainerEyecandy{
    /*border: 1px solid #ccc;*/
    height: 275px;
    position: relative;
    width: 100%;
    /*margin-top: 30px;*/
}
</style>

          
    <div class="row">     
      <div class="col-lg-12 col-md-12 ">
        <div id="cropContainerEyecandy" style="background-size:cover;background-image:url(<?php echo base_url(); ?><?php if($cover_url!=''){echo $cover_url;}?>);" ></div>
      </div>
    </div> 

    <script>
    $(document).ready(function(){
        $(".cropControlsUpload").hide();
    });

    $("#cropContainerEyecandy").mouseenter(function(){
        $(".cropControlsUpload").show();
    })

    .mouseleave(function()
    { 
        $(".cropControlsUpload").hide();
    });
    </script> 

    <script>

      var croppicHeaderOptions = {
        //uploadUrl:'img_save_to_file.php',
        cropData:{
          "dummyData":1,
          "dummyData2":"asdas"
        },
        cropUrl:'<?php echo base_url(); ?>cover_controller/img_crop_to_file',
        customUploadButtonId:'cropContainerHeaderButton',
        modal:false,
        processInline:true,
        loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
        onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
        onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
        onImgDrag: function(){ console.log('onImgDrag') },
        onImgZoom: function(){ console.log('onImgZoom') },
        onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
        onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
        onReset:function(){ console.log('onReset') },
        onError:function(errormessage){ console.log('onError:'+errormessage) }
    } 
    var croppic = new Croppic('croppic', croppicHeaderOptions);
    
    
    var croppicContainerModalOptions = {
        uploadUrl:'<?php echo base_url(); ?>cover_controller/img_save_to_file',
        cropUrl:'<?php echo base_url(); ?>cover_controller/img_crop_to_file',
        modal:true,
        imgEyecandyOpacity:0.4,
        loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
        onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
        onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
        onImgDrag: function(){ console.log('onImgDrag') },
        onImgZoom: function(){ console.log('onImgZoom') },
        onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
        onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
        onReset:function(){ console.log('onReset') },
        onError:function(errormessage){ console.log('onError:'+errormessage) }
    }
    var cropContainerModal = new Croppic('cropContainerModal', croppicContainerModalOptions);
    
    
    var croppicContaineroutputOptions = {
        uploadUrl:'<?php echo base_url(); ?>cover_controller/img_save_to_file',
        cropUrl:'<?php echo base_url(); ?>cover_controller/img_crop_to_file', 
        outputUrlId:'cropOutput',
        modal:false,
        loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
        onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
        onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
        onImgDrag: function(){ console.log('onImgDrag') },
        onImgZoom: function(){ console.log('onImgZoom') },
        onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
        onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
        onReset:function(){ console.log('onReset') },
        onError:function(errormessage){ console.log('onError:'+errormessage) }
    }
    
    var cropContaineroutput = new Croppic('cropContaineroutput', croppicContaineroutputOptions);
    
    var croppicContainerEyecandyOptions = {
        uploadUrl:'<?php echo base_url(); ?>cover_controller/img_save_to_file',
        cropUrl:'<?php echo base_url(); ?>cover_controller/img_crop_to_file',
        imgEyecandy:false,        
        loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
        onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
        onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
        onImgDrag: function(){ console.log('onImgDrag') },
        onImgZoom: function(){ console.log('onImgZoom') },
        onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
        onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
        onReset:function(){ console.log('onReset') },
        onError:function(errormessage){ console.log('onError:'+errormessage) }
    }
    
    var cropContainerEyecandy = new Croppic('cropContainerEyecandy', croppicContainerEyecandyOptions);
    
    var croppicContaineroutputMinimal = {
        uploadUrl:'<?php echo base_url(); ?>cover_controller/img_save_to_file',
        cropUrl:'<?php echo base_url(); ?>cover_controller/img_crop_to_file', 
        modal:false,
        doubleZoomControls:false,
          rotateControls: false,
        loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
        onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
        onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
        onImgDrag: function(){ console.log('onImgDrag') },
        onImgZoom: function(){ console.log('onImgZoom') },
        onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
        onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
        onReset:function(){ console.log('onReset') },
        onError:function(errormessage){ console.log('onError:'+errormessage) }
    }
    var cropContaineroutput = new Croppic('cropContainerMinimal', croppicContaineroutputMinimal);
    
    var croppicContainerPreloadOptions = {
        uploadUrl:'<?php echo base_url(); ?>cover_controller/img_save_to_file',
        cropUrl:'<?php echo base_url(); ?>cover_controller/img_crop_to_file',
        loadPicture:'images/night.jpg',
        enableMousescroll:true,
        loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
        onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
        onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
        onImgDrag: function(){ console.log('onImgDrag') },
        onImgZoom: function(){ console.log('onImgZoom') },
        onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
        onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
        onReset:function(){ console.log('onReset') },
        onError:function(errormessage){ console.log('onError:'+errormessage) }
    }
    var cropContainerPreload = new Croppic('cropContainerPreload', croppicContainerPreloadOptions);


    </script>    
 
<div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
  
  
  <div class="uk-width-large-7-10 profile-overview">

      <div class="md-card" >
     
        
      <div class="user_heading_avatar" id="profile_photo">
          <img src="<?php echo $dp_url;?>" alt="<?php echo ucwords($name); ?>" title="<?php echo ucwords($name); ?>" id="dp_image"/>
          <span id="change_profile" class="change_profile" style="display:none">
            <div class="profile_upload_btn">
            <p>Change Profile Pic</p>
            <form id="profile_pic_form">
              <input type="file" class="profile_pic_uploder" id="profile_pic" name="profile_pic"/>
           </form>
          </div>
          
          </span>
      </div>
      <div class="upper_save_tab">
        <span class="uk-text-truncate"><?php echo ucwords($name); ?></span>
        <?php if(!$profile_status=='incomplete'){ ?>
        <i class="uk-text-truncate-min"><?php print_r($personal_info->sport);?></i>

        
        <ul id="user_profile_tabs" class="uk-tab uk-tab-dark main_heading" data-uk-tab="{connect:'#user_tabs', animation:'slide-horizontal'}" >
            <li class="uk-active"><a href="#">WallPost</a></li>
            <li id="personal_tab"><a href="#">Personal</a></li>
            <li id="academics_tab"><a href="#">Academics</a></li>
            <li id="atheletics_tab"><a href="#">Athletics</a></li>
            <li id="calendar_tab"><a href="#">Schedule</a></li>
            <li id="photo_tab"><a href="#">Photos</a></li>                                
            <li id="video_tab"><a href="#">Videos</a></li>
            <li id="resume_tab"><a href="#">Resume</a></li>
            <li id="references_tab"><a href="#">References</a></li>
        </ul>
        <?php } ?>
      </div>
       
     </div>
   </div>
 </div>
<script>

$(document).ready(function(){ 

  $("#save-cover").click(function()
  {      

     var formData = new FormData($('#bgimageform')[0]);

  
     var url = "<?php echo base_url();?>cover_controller/imageUpload"; 
     // the script where you handle the form input.
     $.ajax({
         url: url,
         type: 'POST',
         data: formData,
         async: false,
         success: function (data) {},
         cache: false,
         contentType: false,
         processData: false
         })
     .done(function(data){         
       
        $('#cover_status').html(data);
      });

    });

       
  });

$(document).ready(function()
 {
  $("#profile_photo").mouseenter(function()
    { 
        $("#change_profile").css({ display: "block" });        
    })
  .mouseleave(function()
    {    
        $("#change_profile").css({ display: "none" });

        $("#change_profile").mouseenter(function() 
        {
           $("#change_profile").css({ display: "block" });          
        })
        .mouseout(function() {
           $("#change_profile").css({ display: "none" });            
        });
    });

});

</script>

<script>

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
            alert(data);
         },
         cache: false,
         contentType: false,
         processData: false
         })

        });
</script>
        