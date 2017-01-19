<div class="md-card" id="comment-pan">
     <div class="md-card-content">
         <h3 class="heading_a">Comments</h3>
       
           <div class="uk-width-1-1">
              <div class="uk-form-row">
                  <textarea cols="30" rows="1" id="comment" name="comment"  class="md-input" style="min-height:50px;"></textarea>
                	<span id="error" class="md-input-bar"></span>
                </div>
             <div class="uk-form-row">
              <button type="button" class="md-btn md-btn-primary adept-md-btn-primary" onclick="addComment()">Send</button>
           </div>
         </div>
         </div>               
    </div>


<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>

<script>

function addComment(){

	var comment = $("textarea#comment").val();
	if(!comment){
		$("textarea").addClass('md-input-danger');
    $("#error").show();
		$("#error").append('Enter Comment');
		setTimeout(function() {
          $('#error').slideUp('slow');
          },2000);        
        return false;		
	}else{
		$.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>usercomment/addComment',
                data: {comment:comment},
            })
		.done(function(data){ 
			if(data==true){
				$("#comment-pan").hide();
			} 
		})

	}	
}

</script>

