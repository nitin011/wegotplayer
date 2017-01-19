 <div class="headline-bg pricing-headline-bg">
    </div>
 <!-- ******Pricing Section****** -->
    <section class="pricing">
        <div class="container">
      <!-- <h2 class="title text-center">Sign Up  <span class="highlight1">FREE</span> and Upgrade Your Sports Experience !</h2> -->
      <h2 class="title text-center">Upgrade Your Sports Experience To Get Ahead</h2>
            <p class="intro text-center">Our pricing is simple and players can cancel or change their plan at any time.</p>
             <div class="price-cols row">
                <div class="items-wrapper col-md-12 col-sm-12 col-xs-12 col-md-offset-2">
                	<!--panel--> 
                	<div id="pricing_status">
                   <!--  <div class="item price-1 col-md-4 col-sm-4 col-xs-12 text-center">
                        <div class="item-inner">
                            <div class="heading">
                            <h3 class="title">BASIC</h3>
                                <p class="price-figure"><span class="price-figure-inner"><h3 class="highlight1">FREE</h3></span></p>
                            </div>
                            <div class="content">
                                <ul class="list-unstyled feature-list">
                                    <li><i class="fa fa-check"></i>Custom Sports Profile</li>
                                    <li><i class="fa fa-check"></i>Email</li>
                                    <li><i class="fa fa-check"></i>Notifications</li>
                                    <li><i class="fa fa-check"></i>Personal Link</li>
                                    <li><i class="fa fa-check"></i>1 Video</li>
                                </ul>
                                <a class="md-btn md-btn-primary adept-md-btn-primary" href="<?php echo base_url(); ?>user/register">Sign Up FREE</a>
   
                          </div>
                        </div>
                    </div> --><!--//item--> 
                    
                    <div class="item price-2 col-md-4 col-sm-4 col-xs-12 text-center best-buy">
                        <div class="item-inner">
                            <div class="heading">
                            <h3 class="title" style="color: #ff6600;">PLUS</h3>
                                <p class="price-figure">
                                	<span class="price-figure-inner">
                                	<strong>$16.66 <span style="color: #000000;">/</span>
                                	</strong></span>
                                     <strong>
                                		<span style="color: #000000;">&nbsp;month</span>
                               		 </strong>
                               	</p>
                               	<h3 class="price-figure"><span style="color: #000000;">
                               		<strong>$99.95&nbsp;/</strong>&nbsp;year</span> 
                               		<span style="color: #ff6600;"><strong>SAVE 50%</strong>
                               	</span></h3>                          

                            </div>
                            <div class="content">
                                <ul class="list-unstyled feature-list">
                                    <li><i class="fa fa-check"></i>Custom Sports Profile</li>
                                    <li><i class="fa fa-check"></i>Email</li>
                                    <li><i class="fa fa-check"></i>Notifications</li>
                                    <li><i class="fa fa-check"></i>Personal Link</li>
                                    <li><i class="fa fa-check"></i>5 Videos</li>
                                    <li><i class="fa fa-check"></i>Schedule</li>
                                   <!--  <li><i class="fa fa-check"></i>Resume</li> -->
                                    <li><i class="fa fa-check"></i>Code For Private Sharing</li>
                                </ul>
                                <button type="button" id="pay_plus_button" class="md-btn md-btn-primary adept-md-btn-primary">Pay Now</a>
                            </div><!--//content-->
                            <div class="ribbon">
                                <div class="text">Popular</div>
                            </div><!--//ribbon-->
                        </div><!--//item-inner-->
                    </div><!--//item-->  
                    
                    <div class="item price-3 col-md-4 col-sm-4 col-xs-12 text-center">
                        <div class="item-inner">
                            <div class="heading">
                                <h3 class="title"><span style="color: #ff00ff;">PRO</span></h3>
                                <p class="price-figure">
                                	<span style="color: #000000;">
                                		<strong><span class="price-figure-inner">$32.50 /<span class="unit">&nbsp;month</span></span></strong></span></p>
								<h3 class="price-figure">
									<span style="color: #000000;">
										<strong>$195 /</strong>&nbsp;year</span> 
										<span style="color: #ff00ff;"><strong>SAVE 50%</strong>
										</span></h3>
								</div>
               <div class="content">
                    <ul class="list-unstyled feature-list">
                        <li><i class="fa fa-check"></i>Custom Sports Profile</li>
                        <li><i class="fa fa-check"></i>Email</li>
                        <li><i class="fa fa-check"></i>Notifications</li>
                        <li><i class="fa fa-check"></i>Personal Link</li>
                        <li><i class="fa fa-check"></i>10 Videos</li>
                        <li><i class="fa fa-check"></i>Schedule</li> 
                       <!--  <li><i class="fa fa-check"></i>Resume</li>  -->
                        <li><i class="fa fa-check"></i>Code For Private Sharing</li> 
                       <!--  <li><i class="fa fa-check"></i>Expert Advise </li> -->                                   
								  </ul>
                                <button type="button" id="pay_pro_button" class="md-btn md-btn-primary adept-md-btn-primary">Pay Now</a>
                                
                            </div><!--//content-->
                        </div><!--//item-inner-->
                    </div><!--//item--> 
                </div> <!--panel--> 
                </div><!--items-wrapper-->                   
            </div><!--//row-->
        </div><!--//container-->
    </section><!--//pricing-->


<script>
$(document).ready(function(){
  $("#pay_plus_button").click(function(){
    var account_type="PLUS";
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>payment/plusPlan',
                data: {},
               })
           .done(function(data){            
                $("#pricing_status").empty().html(data);  
            })
  });


  $("#pay_pro_button").click(function(){
    var account_type="PRO";
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>payment/proPlan',
                data: {},
               })
           .done(function(data){            
                $("#pricing_status").empty().html(data);  
            })
  });


	$("#pay_plus").click(function(){
		var account_type="PLUS";
		$.ajax({
               	type: 'POST',
               	url: '<?php echo base_url(); ?>payment',
               	data: {account_type:account_type},
               })
           .done(function(data){           	
           	if($.trim(data)=='register'){           		
           		var url ="<?php echo base_url();?>user/register";
                window.location = url;  
           	}else{
           		$("#pricing_status").empty().html(data);	
           	}
              
          })
	});

	$("#pay_pro").click(function(){
		var account_type="PRO";
		$.ajax({
               	type: 'POST',
               	url: '<?php echo base_url(); ?>payment',
               	data: {account_type:account_type},
               })
           .done(function(data){
             	if($.trim(data)=='register'){
	           		var url ="<?php echo base_url();?>user/register";
	                window.location = url;  
	           	}else{
	           		$("#pricing_status").empty().html(data);	
	           	}	
         })
	});

});
</script>