<div class="row advance_search" id="profile-overview">
	       <div class="row">
	        <div class="col-md-12">
	        	<h1> Search players </h1>
	        	<div class="row">
	        		<div class="col-md-12 search_field">
	        		
	    				<input class="form-control" name="name" id="player_name" type="text" placeholder="Search Players by Name"/>
	    			 
	    				<!--<button type="button" class="search_btn btn btn-primary adept-md-btn-primary" id="srch_btn">
	       				   Search
	       				</button>-->
	        	</div>
	        </div>
	       </div>
	      </div>
				
	
	
	         <div class="row">
	         	<div class="col-md-4 search_field">
	         	<select required class="form-control" id="sport" onchange="selectLevel();selectPosition();">
	         		<option class="option" value="">Sport</option>
	         		<?php foreach ($sport as $key => $value) { ?>	         		
	         		<option  class="option" value="<?php print_r($value->sportId);?>">
	         			<?php print_r($value->sportName); ?>
	         		</option>
	         		<?php } ?>
	         	</select>
	         	</div>
	          <div class="col-md-4 search_field">
	         <select class="form-control" id="level">
	         	<option class="option" value="">Level</option>
	         </select>
	         </div>
	          <div class="col-md-4 search_field">
	         	<select required class="form-control" id="gender">
	         		<option class="option" value="1"> Male </option>
	         		<option class="option" value="2"> Female </option>
	         	</select>
	         	</div>
	          <div class="col-md-4 search_field">
	         <select class="form-control" id="position">
	         	<option class="option" value="">Position / Speciality</option>
	         </select>
	        </div>
	          <div class="col-md-4 search_field">
	         <select class="form-control" id="hand">
	         	<option class="option" value="">Hand</option>
	         	<?php foreach ($hand as $key => $value) { ?>	         		
	         		<option  class="option" value="<?php print_r($value->handId);?>">
	         			<?php print_r($value->handName); ?>
	         		</option>
	         		<?php } ?>
	         </select>
	        </div>
	         <div class="col-md-4 search_field">
	         <select class="form-control" id="foot">
	         	<option class="option" value="">Foot</option>
	         	<?php foreach ($foot as $key => $value) { ?>	         		
	         		<option  class="option" value="<?php print_r($value->footId);?>">
	         			<?php print_r($value->footName); ?>
	         		</option>
	         		<?php } ?>
	         </select>
	     </div>
	        <div class="col-md-4 search_field">
	        	<div class="row">
	         <div class="col-md-6">	           
	            <select class="form-control" id="min_age">
	         	<option class="option" value="">Min. Age</option>
	         	<?php for($age=18;$age<=70;$age++) { ?>	         		
	         		<option  class="option" value="<?php echo $age;?>">
	         			<?php print_r($age); ?>
	         		</option>
	         		<?php } ?>
	         </select>	        
	         </div>

	         <div class="col-md-6">	           
	            <select class="form-control" id="max_age">
	         	<option class="option" value="">Max. Age</option>
	         	<?php for($age=18;$age<=70;$age++) { ?>	         		
	         		<option  class="option" value="<?php echo $age;?>">
	         			<?php print_r($age); ?>
	         		</option>s
	         		<?php } ?>
	         </select>
	         </div>
	       </div>
	     </div>
	      <div class="col-md-4 search_field">
	      	<div class="row">
	          <div class="col-md-6">	           
	            <select class="form-control" id="min_height">
	         	<option class="option" value="">Min. Height</option>
	         	<?php foreach ($height as $key => $value) { ?>	         		
	         		<option  class="option" value="<?php print_r($value->id);?>">
	         			<?php print_r($value->height); ?>
	         		</option>
	         		<?php } ?>
	         </select>	         
	         </div>
	        
	         <div class="col-md-6">	           
	            <select class="form-control" id="max_height">
	         	<option class="option" value="">Max. Height</option>
	         	<?php foreach ($height as $key => $value) { ?>	         		
	         		<option  class="option" value="<?php print_r($value->id);?>">
	         			<?php print_r($value->height); ?>
	         		</option>
	         		<?php } ?>
	         </select>
	     </div>
	   </div>
	 </div>
	  <div class="col-md-4 search_field">
	   <div class="row">
	         <div class="col-md-6">	         	
	         	<select class="form-control" id="min_weight">
	         	<option class="option" value="">Min. Weight</option>
	         	<?php foreach ($weight as $key => $value) { ?>	         		
	         		<option  class="option" value="<?php print_r($value->id);?>">
	         			<?php print_r($value->weight); ?>
	         		</option>
	         		<?php } ?>
	         </select>	       
	         </div>

	         <div class="col-md-6">	         	
	         	<select class="form-control" id="max_weight">
	         	<option class="option" value="">Max. Weight</option>
	         	<?php foreach ($weight as $key => $value) { ?>	         		
	         		<option  class="option" value="<?php print_r($value->id);?>">
	         			<?php print_r($value->weight); ?>
	         		</option>
	         		<?php } ?>
	         </select>	         	      
	         </div>
	     </div>
		</div>
	                
		 <div class="col-md-4 search_field">
	         <select class="form-control" id="seeking">
	         	<option class="option" value="">Seeking</option>
	         	<?php foreach ($seeking as $key => $value) { ?>	         		
	         		<option  class="option" value="<?php print_r($value->id);?>">
	         			<?php print_r($value->seekingName); ?>
	         		</option>
	         		<?php } ?>
	         </select>
	         </div>
	         <div class="col-md-4 search_field">
	          <select class="form-control" id="nationality">
	         	<option class="option" value="">Nationality</option>
	         	<?php foreach ($nation as $key => $value) { ?>	         		
	         		<option  class="option" value="<?php print_r($value->id);?>">
	         			<?php print_r($value->nationality); ?>
	         		</option>
	         		<?php } ?>
	         </select>
	        </div>
	         <div class="col-md-4">
	          <select class="form-control" id="country">
	         	<option class="option" value="">Country</option>
	         	<?php foreach ($country as $key => $value) { ?>	         		
	         		<option  class="option" value="<?php print_r($value->countryName);?>">
	         			<?php print_r($value->countryName); ?>
	         		</option>
	         		<?php } ?>
	         </select>
	        </div>
	         </div>

	       <button type="button" id="search_button" class="btn btn-primary adept-md-btn-primary pull-right">Search</button>  
	</div> 
	   
			



<script>

$("#sport-cat li").click(function () { 
	var id=$(this).attr('id');
	$("#"+id).toggleClass( "selected");
});

function selectLevel(){
	var sport_id = $("#sport").val();
			if(!sport_id==''){
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url()?>userdetail/selectLevel',
				data:{id:sport_id},
				success :function(levelData){
					$('#level').empty();
					$('#level').html(levelData);
					return false;
				}
			})
		}else{
			$('#level').empty();
			var data='<option class="option" value="" selected="">Level</option>';		
			$('#level').append(data);
		}
   }


 function selectPosition () {
 	var sport_id = $("#sport").val();
					
			if(!sport_id==''){
			$.ajax({
					type: 'POST',
					url: '<?php echo base_url()?>userdetail/selectPosition',
					data: 'id='+sport_id,
					success :function(positionData){
						$('#position').empty();
						$('#position').html(positionData);
						return false;
					}
						})

				}else{  
						$('#position').empty();  
						var data='<option value="" class="option" selected="">Position / Speciality</option>';
						$('#position').append(data);
					}
      }

</script>

<script>
$(document).keypress(function (e) {
    if (e.which == 13) {
    	var name= $("#player_name").val();		
        if(name.length>3){
			$.ajax({
					type: 'POST',
					url: '<?php echo base_url()?>search_controller/searchUserByName',
					data:{name:name},
					success :function(data){
						
						$('#search_list_view').html(data);
						return false;
					}
				})
		}
    }
});

</script>



<script>
$("#search_button").click(function () { 
	var name= $("#player_name").val();		
	var sport= $("#sport").val();
	var level= $("#level").val();
	var gender= $("#gender").val();
	var position= $("#position").val();
	var hand= $("#hand").val();
	var foot= $("#foot").val();
	var min_weight= $("#min_weight").val();
	var max_weight= $("#max_weight").val();

	var min_height= $("#min_height").val();
	var max_height= $("#max_height").val();
	var min_age= $("#min_age").val();
	var max_age= $("#max_age").val();
	var country= $("#country").val();
	var nationality= $("#nationality").val();
	var seeking= $("#seeking").val();

	$.ajax({
			 type: 'POST',
		     url: '<?php echo base_url()?>search_controller/advanceSearch',
		     data:{name:name,sport:sport,level:level,gender:gender,position:position,
		     		hand:hand,foot:foot,min_age:min_age,max_age:max_age,
		     		min_height:min_height,max_height:max_height,min_weight:min_weight,
		     		max_weight:max_weight,country:country,nationality:nationality,seeking:seeking},
				success :function(data){
					
					$('#search_list_view').html(data);
					return false;
				}
			})

});

</script>

<div id="search_list_view"> </div>








