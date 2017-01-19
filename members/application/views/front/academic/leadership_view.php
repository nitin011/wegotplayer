<div class="md-card" id="exper">
     <div class="md-card-content">
         <h3 class="heading_a">Academics - Leadership</h3>
         <br>
         <?php foreach ($experiance as $key => $value) { ?>     	
        
         <div class="uk-width-1-1">
			<div class="uk-form-row" id="row_<?php echo $value->wgp_table_id; ?>">
				<?php echo $value->Experience; ?>
				
			</div>
			<hr>
		</div>
		<?php } ?>
      </div>
</div>
