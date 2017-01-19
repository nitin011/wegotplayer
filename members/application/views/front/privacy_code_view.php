
     <div class="md-card-content">
         
       <div class="uk-width-2-5">
       	<h3 class="heading_a">Enter Privacy Code</h3>
       </div>
           <div class="uk-width-3-5">
              <div class="uk-form-row">
                 <input type="text" id="privacy_code" name="privacy_code"  class="md-input">
                	<span id="error" class="md-input-bar"></span>
                </div>
             <div class="uk-form-row">
              <button type="button" id="privacy_button" class="md-btn md-btn-primary pull-right">Send</button>
           </div>
         </div>
         </div>               
   

    <script>

    function isValidNumber(code) {
        var expr = /^([0-9]{1,6})$/;
        return expr.test(code);
   }

    $(document).ready(function () {
            $("#privacy_button").click(function () {                
                var privacy_code =$("#privacy_code").val(); 

        if((isValidNumber(privacy_code)) && (privacy_code.length == 6)){
                          
               
              if(privacy_code!='') {            
                 $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>front_controller/verifyCode',
                      data: {privacy_code:privacy_code},
                  })
                .done(function(data){
                  $('#personal').html(data);
                })
              }

            }else{
              $('#privacy_code').focus();
              $('#error').css('color', 'red');
              $('#error').show();
              $('#error').text("Please enter Only 6 digit privacy code of player");
               setTimeout(function() {
               $('#error').slideUp('slow');
              },2000);        
                return false;              
            }

        });
      });

    </script>