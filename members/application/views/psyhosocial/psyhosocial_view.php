 <div class="md-card">
  	<a class="md-fab md-fab-small md-fab-accent edit" id="edit_psy" name="edit" href="#">
           <i class="material-icons">&#xE150;</i>
    </a>
     <div class="md-card-content">     
		 <div class="uk-grid uk-grid-divider" data-uk-grid-margin>
		 	<input type="hidden" name="user_id" id="user_id" value="<?php echo $wgp_user_id; ?>">
            <div class="uk-width-large-1-3 uk-width-medium-1-2 uk-width-adept">
                <ul class="md-list md-list-adept">
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Attitude</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $attitude;?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Cooperation</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $cooperation; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Passion</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $passion; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Respect</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $respect;  ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Trustworthiness</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $trustworthiness; ?></span>
                        </div>
                    </li>


                  </ul>
                  </div>

                  
               <div class="uk-width-large-1-3 uk-width-medium-1-2 uk-width-adept">
                <ul class="md-list md-list-adept">
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Self Confidence</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $self_confidence; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Communication</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $communication; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Discipline</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $discipline; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Leadership</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $leadership; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Character</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $character; ?></span>
                        </div>
                    </li>
                 </ul>
             </div>
            <div class="uk-width-large-1-3 uk-width-medium-1-2 uk-width-adept">
                <ul class="md-list md-list-adept">
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Honesty</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $honesty; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Competitivness</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $competitivness; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Focus</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $focus;?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Vision</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $vision; ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading md-list-heading-adept">Motivation</span>
                            <span class="uk-text-small content-data content-data-adept"><?php echo $motivation; ?></span>
                        </div>
                    </li>
                 </ul>
             </div>
        </div>
   </div>
    </div>
   </div>

<script>
   $(document).ready(function () {
       $("#edit_psy").click(function () {                
       tab_value=$("#edit_psy").attr("name");
       user_id=$("#user_id").val();
       console.log(tab_value);             
       if(tab_value=="edit") {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userpsyhosocial/updateView',
                      data: {user_id:user_id},
                  })
                .done(function(data){                  
                  $('#psyhosocial').html(data);
                })
              }
    });
  });
 </script>