<div class="md-card">
    <div class="md-card-content">
		
		<div class="uk-grid" data-uk-grid-margin="" id="unique_section">
        <div class="uk-width-large-1-2 uk-width-medium-1-2">            
            <span class="click_status"></span>

  				<div class="uk-input-group">
                  <div class="md-input-wrapper">
						     <button class="md-btn md-btn-primary adept-md-btn-primary" id="unique_id_url" type="button" title="Show Private Code">Private Code</button> 
					</div>
                
          </div>

         </div> 
            <div class="unique_code uk-width-large-1-2 uk-width-medium-1-2">
              
                <div id="id_generate" >  
                 <?php if(($acc_type=='PRO')||($acc_type=='PLUS')){ ?>   
                 
                <h4>Unique user identification code</h4>
            <div class="md-input-wrapper">
                <label>Your unique id: <span id="unique_id"><?php print_r($unique_id->unique_code); ?></span></label>          
           </div>
          <span class="click_status"></span>

          <div class="uk-input-group">
              <div class="md-input-wrapper">
                 <button class="md-btn md-btn-primary adept-md-btn-primary" type="button" id="generate" title="Generate Private Code">Generate</button> 
          </div>                
          </div>
            <?php } else{
              echo "Upgrade to Plus or PRO account to use this feature. ";
              echo '<a href="'.base_url().'pricing/" target="_blank" class="uk-badge up_acc">Upgrade</a>';
            }?>       
        </div>         
          </div>          
        </div>   

 

  </div>
</div>


<script>
$(document).ready(function () {
      
     $("#generate").click(function () {                
                 $.ajax({
                   type: 'POST',
                   url: '<?php echo base_url(); ?>useraccount/generateUniqueId',       
                   data: {},
                  })
                .done(function(data){
                   $("#unique_id").empty();     
                   $('#unique_id').append(data);
                 })

                });
          });
</script>

