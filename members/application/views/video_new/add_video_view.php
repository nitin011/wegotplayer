<script src="//fast.wistia.com/assets/external/api.js" async></script>
<link rel="stylesheet" href="//fast.wistia.com/assets/external/uploader.css" />

<div class="col-md-6">
         <div class="uk-form-row">
               <label>Video Title</label>
                <input type="text" class="form-control" name="video_title" placeholder="Video Title"/>
           </div>
<div id="wistia_uploader" style="height:auto;width:100%;;"></div>
<br>
     <button type="button" id="cancel_video" class="btn btn-primary ac_cancel">Back</button>

    </div>
<script type="text/javascript">
    $("#cancel_video").click(function(){
        $("#video_target_add").fadeOut('slow');
        $("#video_view").fadeIn('slow');
    });
</script>
<script>
window._wapiq = window._wapiq || [];
_wapiq.push(function(W) {
  window.wistiaUploader = new W.Uploader({
    accessToken: "a9bda8dad8b769abba4632b548494c4e4d0ff78c",
    dropIn: "wistia_uploader",
    projectId: "nb6rl20p8x"
  });
  wistiaUploader.bind('uploadsuccess', function(file, media) {            
                var id = media.id;
                
                var video_title = $("#video_title").val();               
      

              if(video_title==""){
                 var  name = video_title;
              }else{
                 var  name = media.name;
              }
                        console.log("The upload succeeded. Id", id);
                        console.log("The upload succeeded. name", name);
                $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url(); ?>uservideos/saveVideoDetail',
                          data: {gallery_id:1,video_title:name,video_id:id},
                        })

                      .done(function(data){             
                         var url = "<?php echo base_url(); ?>home";
                         window.location= url; 
                      });
          
   });
});
</script>

