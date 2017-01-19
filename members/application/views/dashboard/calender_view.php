<h3 class="heading_b heading_b_c uk-margin-bottom">Schedule</h3>
		
		<div class="md-card-content">
			<?php if(($acc_type=='PRO')||($acc_type=='PLUS')){ ?>
			<?php echo $mycal; ?>
			<?php } else{
					echo '<h3 class="heading_b heading_b_c uk-margin-bottom">For PRO and PLUS Account! Update your account type for view this feature.</h3>';
					echo '<a href="'.base_url().'pricing/" target="_blank" class="uk-badge">Upgrade</a>';
				} ?>
		</div>
<span id="cal_status"></span>


<div id="event-form" class="uk-modal" aria-hidden="true" style="display: none; overflow-y: auto;">
        <div class="uk-modal-dialog" style="top: 62px;">
               <button onclick="closeit()" type="button" class="uk-modal-close uk-close"></button>            
           
              <from >
				<label>Add New Event on <span id="selected_box_date"></span></label>
				<input type="text" id="event_name" class="md-input">
				<input type="hidden" id="event_date"  value="">
				<input type="hidden" id="event_month" value="">
				<input type="hidden" id="event_year"  value="">
				<span id="event_error"></span>
				<br/>
				<button type="button" id="submit_event" name="submit" class="btn_col btn btn-danger ac_save">Add Event</button>
			  </form>
                
         </div><!-- End: uk-modal-dialog -->
    </div>

 
   <script src="<?php echo base_url(); ?>assets/js/altair_admin_common.min.js"></script>
<script>

  $(document).ready(function () {
  	
    //start of open modal function
    $(".table-cell td .add_btn").click(function () 
            {                
                var event_date=$(this).attr('id');
                var heading= $(".cal-month").text();
                var event_year = heading.slice(-4);
                var event_month = heading.replace(event_year, "").trim();
               
               
	            if(event_date!="")
	            {
	               $("#event-form").css('display','block');
	               $("#event-form").css('aria-hidden','false');
				   $("#event-form").addClass( "uk-open");
                   $('#selected_box_date').empty().text(event_date+' '+event_month+' '+event_year);
	               $('#event_date').val(event_date);
	               $('#event_month').val(event_month);
	               $('#event_year').val(event_year);
		
		        }               
            });
    //end of open modal function
    //start of submit event function
     $("#submit_event").click(function () 
        {   
           var event_value=$("#event_name").val();
           var event_date=$("#event_date").val();
           var event_month=$("#event_month").val();
           var event_year=$("#event_year").val();

           if(event_value==null || event_value == "")
		    {
		       $('#event_name').focus();
		       $('#event_error').css('color', 'red');
		       $('#event_error').show();
		       $('#event_error').text("Please Enter Event ");
		        setTimeout(function() {
		          $('#event_error').slideUp('slow');
		          },2000);        
		        return false;
		    }//end validation of blank field
		    else{
			    $.ajax({
		              type: 'POST',
		              url: '<?php echo base_url(); ?>usercalendar/addEvent',
		              data: {event_date:event_date,
		              		 event_year:event_year,
		              		 event_value:event_value,
		              		 event_month:event_month},
		          })
		        .done(function(data){	         
		           if(data==1){		           		
		        		$("#event-form").hide();       
		        	
		           }else{

		           }
		        })
		    }//end post event	
	               
        });
    //end of submit event function
});
 



  function closeit(){
  	$("#event-form").hide();
  }
</script>

<script>

 $(document).ready(function () {
      
      $("#previous").click(function (){
         var url =$("#previous").attr('href');         
                 
	       $.ajax({
	              type:'POST',
	              url:'<?php base_url() ?>usercalendar/index/'+url,
	              data:{},
	          })
	        .done(function(data){
	          $('#calendar').html(data);
	          
	        })
         
      });

      $("#next").click(function (){
       	var url =$("#next").attr('href');
       	
       	$.ajax({
	              type: 'POST',
	              url:'<?php base_url() ?>usercalendar/index/'+url,
	              data: {},
	          })
	        .done(function(data){
	          $('#calendar').html(data);
	          
	        })

      });



   });

</script>

<script>
 $(document).ready(function () {
 	//
     $("td p").click(function (){
      	var event_string=$(this).attr('id');
        var heading= $(".cal-month").text();
        var event_year = heading.slice(-4);
        var event_month = heading.replace(event_year, "").trim();

        //get event number and day from string
        var event_string_arry = event_string.split("_", 3);
        var event_day =event_string_arry[1];
        var event_number =event_string_arry[2];

        // generrating date format 
        var event_date =event_day+'-'+event_month+'-'+event_year;
        
        
        console.log("event_string"+event_string);
        console.log("event_number"+event_number);   
        console.log("event_date"+event_date);

        $.ajax({
	              type:'POST',
	              url:'<?php base_url() ?>usercalendar/viewEventDetail',
	              data:{date:event_date,event_number:event_number},
	          })
	        .done(function(data){
	          $('#calendar').html(data);
	          
	        })

    });
  });

</script>

<script>

$(document).ready(function(){


	$(".event").mouseover(function(evt){		
		var event_string=$(this).attr('id');
        var heading= $(".cal-month").text();
        var event_year = heading.slice(-4);
        var event_month = heading.replace(event_year, "").trim();

        //get event number and day from string
        var event_string_arry = event_string.split("_", 3);
        var event_day =event_string_arry[1];
        var event_number =event_string_arry[2];

        // generrating date format 
        var event_date =event_day+'-'+event_month+'-'+event_year;
        
        
        console.log("event_string"+event_string);
        console.log("event_number"+event_number);   
        console.log("event_date"+event_date); 

        $.ajax({
	              type:'POST',
	              url:'<?php base_url() ?>usercalendar/getEventDetail',
	              data:{date:event_date,event_number:event_number},
	          })
	        .done(function(data){	 
	                     
	             $("#"+event_string).attr('title',data);				         
	        })
	});
});

</script>
