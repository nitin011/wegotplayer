<?php include('header.php'); ?>

<!--<section class="inner-banner inner-pages-banner">
      <div class="row nopadding">
      
        <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
        <div class="container">
          <h1><?php //the_title() ?></h1>
          </div>
        </div> END .col-xs-12 .col-sm-12 .col-md-12 
      </div> END .row 
</section>-->

<div class="conterr">
 	<div class="wapper-404">   </div>
  
<div class="conter-left-404">
	<div class="center-404"> 
 		<img src="<?php echo get_bloginfo('template_directory'); ?>/images/error.png">
 	</div>
 	<div class="conter-left-heading-404">
 		<?php _e("It look like the page you're looking for doesn't exist, sorry",'WeGotPlayers'); ?>
 		<a href="<?php echo home_url(); ?>">Return Home ?<i class="fa fa-home"></i></a>
 	</div>
   <div class="center1-404">
		<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
			<input type="text" placeholder="<?php _e('Enter to search page', 'wegotplayers'); ?>" id="s" name="s" class="search-404">
		</form>
	</div>

 </div>
	<div class="conter-right-404">
		<img src="<?php echo get_bloginfo('template_directory'); ?>/images/icon.png" alt="Icon_image">
	</div>  

</div>


<?php include('footer.php'); ?>