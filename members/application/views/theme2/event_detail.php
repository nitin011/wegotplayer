<style>
.event_model{
		width: 400px;
}

</style>

<div class="event_model event_modeltod">
  <div class="col-md-6">
           <label>Event Name</label>
           <p>	<?php echo $event_detail->wgp_event_name; ?></p> 

           <label>Event Date</label>
           	  <p><?php	$date = strtotime($event_detail->wgp_event_start); 
	              		         echo date('d M, Y',$date);
	             ?>
           	  	</p>     

        
        
		   <label >Event Level</label>
       	 <p>	 <?php echo $event_detail->wgp_event_level;?></p>
       	
       	
        
      </div>

      <div class="col-md-6">
       

         <label>Event Importance</label>
            <p>  <?php echo $event_detail->wgp_event_importance;?></p>

            <label>Event Last Date</label>
             <p>  <?php $date1 = strtotime($event_detail->wgp_event_end); 
                             echo date('d M, Y',$date1);
               ?></p>
		
			 <label>Website</label>
       		  <p>	 <?php echo $event_detail->wgp_event_website;?> </p>
      


      </div>

      <div class="col-md-12">
          <label >Address</label>
             <p>  <?php echo $event_detail->wgp_address;?></p>
      </div> 

  </div>
