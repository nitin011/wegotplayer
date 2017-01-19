<div class="md-card" id="exp-pan">
     <div class="md-card-content">
         <h3 class="heading_a">Leadership</h3>
       
           <div class="uk-width-1-1">
              <div class="uk-form-row">
                  <textarea cols="30" rows="1" id="experience" name="experience"  class="md-input" style="min-height:50px;"></textarea>
                	<span id="error" class="md-input-bar"></span>
                </div>
             <div class="uk-form-row">
              <button type="button" class="md-btn md-btn-primary adept-md-btn-primary right" onclick="addExperience()">Send</button>
           </div>
         </div>
         </div>               
    </div>


<script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>

<script>

function addExperience(){
	var experience = $("#experience").val();
 
	if(!experience){
		$("textarea").addClass('md-input-danger');
		$("#error").append('Enter Comment');
		setTimeout(function() {
          $('#error').slideUp('slow');
          },2000);        
        return false;		
	}else{
		$.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>userleadership/addExp',
                data: {experience:experience},
            })
		.done(function(data){ 
			if(data==true){
				//$("#exp-pan").hide();
			} 
		})

	}	
}

</script>

