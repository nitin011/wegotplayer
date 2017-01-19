<div class="uk-width-medium-1">
    <div class="md-card md-card-hover md-card-overlay">        
       <div class="md-card-content truncate-text">
             <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
              <div class="uk-width-xLarge-8-10 ">              	
                 <div class="md-card">
                 	
                    <div class="md-card-toolbar">
                    	<div class="user_heading_menu" data-uk-dropdown>                              
                        <a class="md-fab md-fab-small md-fab-accent" id="edit_profile" name="edit" href="#">
                            <i class="material-icons">&#xE150;</i>
                          </a>
                         </div>
                      <h3 class="md-card-toolbar-heading-text">
                      	Personal Details
					</h3>
                    </div>
                    
                    <img style="display:none;" src="<?php echo base_url();?>assets/img/spinners/spinner.gif" id="loader" alt="loader" width="32" height="32">
                    <div class="md-card-content large-padding">                       
                        <div class="uk-grid uk-grid-divider uk-grid-medium">                           
                        
                           <div class="uk-width-large-1-2">
                              
                              <div class="uk-grid uk-grid-small">                                 
                                  <div class="uk-width-large-1-3">
                                      <span class="uk-text-muted uk-text-small">Unique User Identification Code:</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php if(($acc_type=='PRO')||($acc_type=='PLUS')){
                                                print_r($unique_code->unique_code); }
                                                else{ 
                                                    echo "For PRO and PLUS account !  ";
                                                    echo '<a href="'.base_url().'pricing/" target="_blank" class="uk-badge">Upgrade</a>';
                                                }?></a></span>
                                        </div>
                                    </div>
                                    <hr class="">                                   
                                    <div class="uk-grid uk-grid-small">
                                  <div class="uk-width-large-1-3">
                                      <span class="uk-text-muted uk-text-small">User URL :</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo base_url().'profile/'.$username->login_name; ?></a></span>
                                        </div>
                                    </div>
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Name</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $name ?></span>
                                        </div>
                                    </div>
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Gender</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                           <?php if($gender==1){echo "Male";
                                                            }else if($gender==2){
                                                              echo "Female"; 
                                                            } else { echo "Select Gender";}  ?>
                                        </div>
                                    </div>
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Date of Birth</span>
                                        </div>
                                        <div class="uk-width-large-2-3"> 
                                            <?php echo $dob; ?>
                                        </div>
                                    </div>
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Nationality</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <?php echo $nationality; ?>
                                        
                                        </div>
                                    </div>
                                     <hr class="">
                                     <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Conuntry</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <?php echo $country; ?>
                                        
                                        </div>
                                    </div>
                                     <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">City</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $city; ?></span>
                                        </div>
                                    </div>                                
                                    <hr class="">
                                    <hr class="uk-grid-divider uk-hidden-large">
                                </div>
                                <div class="uk-width-large-1-2">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Sport</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $sport; ?></span>
                                        </div>
                                    </div>                                
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Level</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $level; ?></span>
                                        </div>
                                    </div>                                
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Position</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $position; ?></a></span>
                                        </div>
                                    </div>                                
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Height</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $height; ?></span>
                                        </div>
                                    </div>                                
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Weight</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $weight; ?></span>
                                        </div>
                                    </div>                                
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Position</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php echo $position; ?></a></span>
                                        </div>
                                    </div>                                
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Seeking</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php print_r($seek);?></a></span>
                                        </div>
                                    </div>
                                    <hr class="">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Who can Contact you</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle"><?php print_r($contact_arry); ?></a></span>
                                        </div>
                                    </div>
                                    <hr class="">
                                    
                                </div>
                            </div>
                            <div class="md-card-content md-card-toolbar"> 
                                <div class="uk-width-large-1">
                                        Personal Information :<p> <?php  echo $personal_info; ?></p>
                                </div>
                                 </hr>
                                 <div class="uk-width-large-1">
                                        Objective :<p> <?php  echo $objective; ?></p>
                                </div>
                                 </hr>
                                 </div>
                        </div>
                    </div>
                   
                </div>
            </div>                       

        </div>
                                  
    </div>

</div>


  <script>

   $(document).ready(function () {
       
       $("#edit_profile").click(function () {                       
       tab_value=$("#edit_profile").attr("name");
       console.log(tab_value);
       if(tab_value=="edit") {
            $('#loader').show();            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>userpersonal/editProfile',
                      data: {tab_value:tab_value},
                  })
                .done(function(data){
                  $('#loader').hide(); 
                                  
                  $('#personal').html(data);
                })
              }
   });
  });

  </script>