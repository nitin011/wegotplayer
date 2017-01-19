<?php /*
Template Name: Contact Template
*/
?>

<?php include('header.php'); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>




<?php 
      if (has_post_thumbnail( $post->ID ) ): 
         $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') );
        
 else :
        $image = get_bloginfo( 'stylesheet_directory') . '/images/banner-ground.jpg'; 
 endif; 

   ?>


<section class="inner-banner inner-pages-banner">
      <div class="row nopadding">
      
        <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
        <div class="container">
          <h1><?php the_title() ?></h1>
          </div>
        </div><!-- END .col-xs-12 .col-sm-12 .col-md-12 -->
      </div><!-- END .row -->
</section>

 <div class="headline-bg about-headline-bg" style="background-image: url('<?php echo $image; ?>')">
    </div><!--//headline-bg-->         
    
    <!-- ******Video Section****** --> 
    <section class="story-section section section-on-bg">
        <h2 class="title container text-center">Contact Our Team</h2>
        <div class="story-container container text-center"> 
            <div class="story-container-inner" >                    
                <div class="about">
                <?php the_content('<p>Read the rest of this page &raquo;</p>'); ?>
                
                                  
                </div><!--//about-->
          
</div></div>

</section>



<?php endwhile; endif; ?>  

<?php include('footer.php'); ?>