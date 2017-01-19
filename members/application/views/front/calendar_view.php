<h3 class="heading_b heading_b_c uk-margin-bottom">Schedule</h3>
     <div class="md-card-content">
        <?php echo $mycal; ?>
    </div>


<script>

 $(document).ready(function () {
      
      $("#previous").click(function (){
         var url =$("#previous").attr('href');         
                 
	       $.ajax({
	              type:'POST',
	              url:'<?php echo base_url() ?>front_calendar/calendar/'+url,
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
	              url:'<?php echo base_url() ?>front_calendar/calendar/'+url,
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
	$(".add_btn").hide();
});

</script>
