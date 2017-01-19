<section class="pricing">
  <div class="container">
    <div class="item price-1 col-md-12 col-sm-12 col-xs-12 text-center">
        <div class="heading">
         <h2 class="intro text-center">Dear  Member<?php //echo ucwords($name); ?></h2>
                <p class="intro text-center">Your payment was successful, Thank You for Payment.<br/>
                
                <br/>
                   TXN ID : <strong><?php echo $txid; ?></strong>
                <br/>
                Amount Paid : 
                    <strong>$<?php echo $amount.' '.$currency; ?></strong>
                <br/>
               Payment Status : 
                    <strong><?php echo $status; ?></strong>
               <br/>
    
        </div>
    </div>
  </div>
</section>
