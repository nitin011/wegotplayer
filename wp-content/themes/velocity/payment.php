<?php /* Template Name: Payment Form*/ ?>
<?php include('header.php');?>

<?php
    $paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
    $paypal_id='nitin@adeptcoders.com'; // Business email ID

    $item_name = "WeGotPlayer Account Payment";
    $item_number = "1";
    $amount = 0;
    $cpp_header_image = "http://www.wegotplayers.com/wp-content/uploads/2015/07/logo-white.png";
     $url="http://www.wegotplayers.com";
    $cancel_return = $url."/cancel.php";
    $return =$url."/success.php";
?>


<section style="margin-top:50px;">
    <div class="conatiner">
        <div class="row">
            <div class="name col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
                <div class="name col-md-5 col-sm-12 col-xs-12">
                     <form action="<?php echo $paypal_url; ?>" method="post" name="frmPayPal1" onsubmit="return validateForm();">
                     <label> WeGotPlayer Account Type </label>
                      <select name="account_type" id="account_type" class="form-control" onchange="changeType()">
                          <option value="BASIC">BASIC</option>
                          <option value="PLUS">PLUS</option>
                          <option value="PRO">PRO</option>                          
                     </select> 
                     <label> WeGotPlayer Account Type </label>
                     <input type="text" name="email" id="email" class="form-control" placeholder="Registered Email Id" required>

                     <div class="product">
                            <div class="btn">
                               
                                    <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
                                    <input type="hidden" name="cmd" value="_xclick">
                                    <input type="hidden" id="item_name" name="item_name" value="<?php echo $item_name; ?>">
                                    <input type="hidden" name="item_number" value="<?php echo $item_number; ?>">
                                    <input type="hidden" name="credits" value="510">
                                    <input type="hidden" id="userid" name="userid" value="1">
                                    <input type="hidden" id="amount" name="amount" value="<?php echo $amount; ?>">
                                    <input type="hidden" name="cpp_header_image" value="<?php echo $cpp_header_image;?>">
                                    <input type="hidden" name="no_shipping" value="1">
                                    <input type="hidden" name="currency_code" value="USD">
                                    <input type="hidden" name="handling" value="0">
                                    <input type="hidden" name="cancel_return" value="<?php echo $cancel_return; ?>">
                                    <input type="hidden" name="return" value="<?php echo $return; ?>">
                                    <button type="submit" name="submit" class="btn btn-primary">Pay Now</button>            
                              
                            </div>
                        </div>
               </form> 
               </div>
                <div class"col-md-5 col-sm-12 col-xs-12">
                      

                </div>  

            </div>
       </div>
    </div>
</section>

<script>
    function changeType(){
         var account_type= $("#account_type").val();
         var email= $("#email").val();
         var pro_amount =195;
         var plus_amount =99.95;
         if(account_type=='PRO'){           
            $("#amount").val(pro_amount); 
            $("#item_name").val('WeGotPlayer PRO Account');
            $("#userid").val(email);
         }
         if(account_type=='PLUS'){        
            $("#amount").val(plus_amount);
            $("#item_name").val('WeGotPlayer PLUS Account'); 
            $("#userid").val(email);
         }
         if(account_type=='BASIC'){
             $("#amount").val(0);
             $("#item_name").val('WeGotPlayer BASIC Account'); 
             $("#userid").val(email);
         }
        
    }

    function validateForm(){
        var account_type= $("#account_type").val();
        var email= $("#email").val();              
              if (email == null || email ==" ") {                
                document.forms["frmPayPal1"]["email"].focus();
                document.forms["frmPayPal1"]["email"].style.borderColor = "red";
                document.forms["frmPayPal1"]["email"].placeholder = "Please Enter Email";
                      return false;               
             }
        }
</script>




<?php include('footer.php');?>