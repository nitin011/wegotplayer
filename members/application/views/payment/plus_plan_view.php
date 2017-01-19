

<div class="price-cols row">
    <div class="items-wrapper col-md-12 col-sm-12 col-xs-12">
         <div class="item price-1 col-md-8 col-sm-12 col-xs-12 text-center">
            <div class="item-inner">
                <div class="heading">
                <h3 class="highlight1">Plus Plan Offer</h3>
                    <p class="price-figure"><span class="price-figure-inner"></span></p>
                </div>
                <div class="content">
                    <ul class="list-unstyled feature-list plan_offer">
                      <li>
                        <div class="row">
							    <div class="col-xs-2 col-lg-1">
							        <input type="radio" class="pricing_radio" name="plus_radio" id="1">
							    </div>
							    <div class="col-xs-5 col-lg-3">
							        <div class="config-text-primary">1 Month</div>
							    </div>
							    <div class="col-xs-5 col-lg-4">
							        <div class="pricing-amount">$<?php $monthly=$yearly_amount/12;
							           echo sprintf("%01.2f", $monthly); ?></div>
							    </div>
							    <div class="col-xs-5 col-xs-offset-7 col-md-offset-0 col-lg-3 col-lg-offset-0">
							        <div class="pricing-offer">
							            <span></span>
							        </div>
							    </div>
							    
							</div>
					</li>
                        <li>
                        	<div class="row">
							    <div class="col-xs-2 col-lg-1">
							        <input type="radio" class="pricing_radio" name="plus_radio" id="3">
							    </div>
							    <div class="col-xs-5 col-lg-3">
							        <div class="config-text-primary">3 Months</div>
							    </div>
							    <div class="col-xs-5 col-lg-4">
							        <div class="pricing-amount">$
							        	<?php $quarterly=$yearly_amount/4;
							        	   $quarterly = $quarterly-(($quarterly*20)/100);
							           echo sprintf("%01.2f", $quarterly); ?></div>
							    </div>
							    <div class="col-xs-5 col-xs-offset-7 col-md-offset-0 col-lg-3 col-lg-offset-0">
							        <div class="pricing-offer">
							            <span> Save 20% </span>
							        </div>
							    </div>
							    
							</div>
					</li>
                        <li>
                        	<div class="row">
							    <div class="col-xs-2 col-lg-1">
							        <input type="radio" class="pricing_radio" name="plus_radio" id="6">
							    </div>
							    <div class="col-xs-5 col-lg-3">
							        <div class="config-text-primary">6 Months</div>
							    </div>
							    <div class="col-xs-5 col-lg-4">
							        <div class="pricing-amount">$
							        	<?php $half_yearly=$yearly_amount/2;
							        	   $half_yearly = $half_yearly-(($half_yearly*30)/100);
							           echo sprintf("%01.2f", $half_yearly); ?></div>
							    </div>
							    <div class="col-xs-5 col-xs-offset-7 col-md-offset-0 col-lg-3 col-lg-offset-0">
							        <div class="pricing-offer">
							            <span>Save 30%</span>
							        </div>
							    </div>
							  
							</div>
						</li>
                        <li>
                           <div class="row">
							    <div class="col-xs-2 col-lg-1">
							        <input type="radio" class="pricing_radio" name="plus_radio" id="12">
							    </div>
							    <div class="col-xs-5 col-lg-3">
							        <div class="config-text-primary">12 Months</div>
							    </div>
							    <div class="col-xs-5 col-lg-4">
							        <div class="pricing-amount">$
							        	<?php $yearly=$yearly_amount;
							        	   $yearly = $yearly-(($yearly*50)/100);
							           echo sprintf("%01.2f", $yearly); ?></div>
							    </div>
							    <div class="col-xs-5 col-xs-offset-7 col-md-offset-0 col-lg-3 col-lg-offset-0">
							        <div class="pricing-offer">
							            <span>Save 50%</span>
							        </div>
							    </div>
							   
							</div>
						</li>
                       
                    </ul>
                    <button type="button" id="pay_plus" class="md-btn md-btn-primary adept-md-btn-primary">Pay Now</a>
             </div><!--//content-->
            </div><!--//item-inner-->
        </div><!--//item-->
   	 </div>
	</div>


<script>
$(document).ready(function(){
      $("#pay_plus").click(function(){
      	  var account_type="PLUS";
			var id=$('input[name=plus_radio]:checked').attr('id');
			if(id.length>0){
				 $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url(); ?>payment',
                        data: {account_type:account_type,month:id},
                      })
                  .done(function(data){
                  	if($.trim(data)=='register'){               
              			var url ="<?php echo base_url();?>user/register";
               			 window.location = url; 
               		}else{
                       $("#pricing_status").empty().html(data); 
                   }
               })
			}


	});//end 
});//end ready function
</script>
              