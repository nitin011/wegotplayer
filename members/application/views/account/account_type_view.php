<div class="md-card">
    <div class="md-card-content">
    <div class="md-card md-card-hover acount_box">
		<div class="md-card-head head_green ">
		     <div class="uk-text-center">
		          <img alt="" src="<?= base_url().$dp_url ?>" class="md-card-head-avatar">
		    </div>
		   <h3 class="md-card-head-text uk-text-center">
		          <?php echo ucwords($user_detail->name);?>     
                 
		        (<?php echo $user_detail->acc_type;?>) 
                <?php if($user_detail->acc_type!='PRO'){?>
               <a href="<?php echo base_url(); ?>pricing/" target="_blank" class="md-btn md-btn-warning">Upgrade</a>
		      <?php } ?>
           </h3>
		</div>
		<div class="md-card-content">
            <ul class="md-list">
                <li>
                    <div class="md-list-content">
                        <span class="md-list-heading">Account Type</span>
                        <span class="uk-text-small uk-text-muted"><?php echo $user_detail->acc_type;?></span>
                        
                    </div>
                </li>
                <li>
                    <div class="md-list-content">
                        <span class="md-list-heading">Email</span>
                        <span class="uk-text-small uk-text-muted"><?= $email ?></span>
                    </div>
                </li>
                <li>
                    <div class="md-list-content">
                        <span class="md-list-heading">Registration Date</span>
                        <span class="uk-text-small uk-text-muted">(<?php echo $user_detail->reg_time;?>)</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    </div>
</div>