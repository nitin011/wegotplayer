<div class="md-card" id="comment-view">
     <div class="md-card-content">
         <h3 class="heading_a">Comment</h3>
         <?php foreach ($comments as $key => $value) { ?>        	
        
         <div class="uk-width-1-1">
			<div class="uk-form-row">
				<?php echo $value->comments; ?>
				
			</div>
			<hr class="uk-grid-divider">
		</div>
		<?php } ?>
      </div>
</div>

