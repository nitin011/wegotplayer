<?php /*
Template Name: Home Template
*/
?>
<?php include('header.php'); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php if (has_post_thumbnail( $post->ID ) ): ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
$image = $image[0]; ?>
<?php else :
$image = get_bloginfo( 'stylesheet_directory') . '/images/banner-ground.jpg'; ?>
<?php endif; ?>


<?php //the_content('<p>Read the rest of this page &raquo;</p>'); ?>


<section class="promo section section-on-bg">
<?php putRevSlider("home_slider") ?>

<!-- <div class="container text-center">
<h2 class="title">Do You Dream To Play At The Next Level?</h2>
<h3 class="intro">We empower players to build and promote their own identity to succeed.</h3>
<a class="btn btn-cta btn-cta-primary" href="signup.html">Try WeGotPlayers Free</a>

<button class="play-trigger btn-link " type="button" data-toggle="modal" data-target="#modal-video"><i class="fa fa-youtube-play"></i> Watch the video</button>

</div>-->

</section><!--//promo-->
<div class="sections-wrapper">

<!-- ******Why Section****** -->

<section id="why" class="section why">
<div class="container">
<h2 class="title text-center"><?php the_field('main_heading'); ?></h2>
<p class="intro text-center"> <?php the_field('main_sub_heading'); ?></p>

<div class="row item">
<div class="content col-md-4 col-sm-12 col-xs-12">
<h3 class="title"><?php the_field('title'); ?></h3>
<div class="desc">
<?php the_field('first-section-content'); ?>


</div>
<div class="quote">
<div class="quote-profile"><img class="img-responsive img-circle" src="<?php the_field('quote_profile_pic1'); ?>" alt="<?php the_field('quote_writer_name1'); ?>" width="140px" height="140px" /></div>
<!--//profile-->
<div class="quote-content">
<blockquote><?php the_field('quote_content1'); ?></blockquote>
<p class="source"><?php the_field('quote_writer_name1'); ?></p>

</div>
<!--//quote-content-->

</div>
<!--//quote-->

</div>
<!--//content-->

<figure class="figure col-md-7 col-sm-12 col-xs-12 col-md-offset-1 col-sm-offset-0 col-xs-offset-0">
    <img class="img-responsive" src="<?php the_field('first-section-image'); ?>" width="890px" height="1056px"  />
</figure></div>
<!--//item-->
<div class="row item">
<div class="content col-md-4 col-sm-12 col-xs-12 col-md-push-8 col-sm-push-0 col-xs-push-0">
<h3 class="title"><?php the_field('second-section-title'); ?></h3>
<div class="desc">

<?php the_field('second-section-content'); ?>

</div>
<div class="quote">
<div class="quote-profile"><img class="img-responsive img-circle" src="<?php the_field('quote_profile_pic2'); ?>" width="141px" height="140px"  alt="<?php the_field('quote_writer_name2'); ?>" /></div>
<!--//profile-->
<div class="quote-content">
<blockquote><?php the_field('quote_content2'); ?></blockquote>
<p class="source"><?php the_field('quote_writer_name2'); ?></p>

</div>
<!--//quote-content-->

</div>
<!--//quote-->

</div>
<!--//content-->

<figure class="figure col-md-7 col-sm-12 col-xs-12 col-md-pull-4 col-sm-pull-0 col-xs-pull-0"><img class="img-responsive" src="<?php the_field('second-section-image'); ?>" height="572px" width="800px" />
<div class="control text-center"></div>
<!--//control-->

</figure></div>
<!--//item-->
<div class="row item ">
<div class="content col-md-4 col-sm-12 col-xs-12">
<h3 class="title"><?php the_field('third-section-title'); ?></h3>
<div class="desc">

<?php the_field('third_section_content'); ?>

</div>
<div class="quote">
<div class="quote-profile"><img class="img-responsive img-circle" src="<?php the_field('quote_profile_pic3'); ?>" alt="<?php the_field('quote_writer3'); ?>" width="140px" height="154px" /></div>
<!--//profile-->
<div class="quote-content">
<blockquote><?php the_field('quote_content3'); ?></blockquote>
<p class="source"><?php the_field('quote_writer3'); ?></p>

</div>
<!--//quote-content-->

</div>
<!--//quote-->

</div>
<!--//content-->

<figure class="figure col-md-7 col-sm-12 col-xs-12 col-md-offset-1 col-sm-offset-0 col-xs-offset-0"><img class="img-responsive" src="<?php the_field('third_section_image'); ?>" width="995" height="445" />
</figure></div>
<!--//item-->
<div class="row item last-item">
<div class="content col-md-4 col-sm-12 col-xs-12 col-md-push-8 col-sm-push-0 col-xs-push-0">
<h3 class="title"><?php the_field('fourth_section_title'); ?></h3>
<div class="desc">
<?php the_field('fourth_section_content'); ?>
</div>
<div class="quote">
<div class="quote-profile"><img class="img-responsive img-circle" src="<?php the_field('quote_profile_pic4'); ?>" width="140px" height="140px"  alt="<?php the_field('quote_writer4'); ?>" /></div>
<!--//profile-->
<div class="quote-content">
<blockquote><?php the_field('quote_content4'); ?></blockquote>
<p class="source"><?php the_field('quote_writer4'); ?></p>

</div>
<!--//quote-content-->

</div>
<!--//quote-->

</div>
<!--//content-->

<figure class="figure col-md-7 col-sm-12 col-xs-12 col-md-pull-4 col-sm-pull-0 col-xs-pull-0"><img class="img-responsive" src="<?php the_field('fourth_section_image'); ?>" width="713px" height="302px" /></figure></div>
<!--//item
<div class="feature-lead text-center">
<h4 class="title">Want to discover all the features?</h4>
<a class="btn btn-cta btn-cta-secondary" href="features.html">Take a Tour</a>

</div>
-->
</div>
<!--//container-->

</section><!--//why-->

<div class="blog container whyBlog">
           <h3 class="title text-center">From Our Blog</h3>
               <div class="row">
                <div id="blog-mansonry" class="blog-list">
                    <!-- the loop -->
               <?php query_posts('post_type=post&post_status=publish&posts_per_page=6&paged='. get_query_var('paged')); ?>

                <?php if( have_posts() ): ?>



                     <?php while( have_posts() ): the_post(); ?>

                    <article class="post col-md-4 col-sm-6 col-xs-12" >
                                      <div class="post-inner">
                                           <?php if( has_post_thumbnail( $post_id ) ): ?>
                                           <figure class="post-thumb">
                                              <a href="<?php the_permalink(); ?>"><img class="img-responsive" src="<?=wp_get_attachment_url( get_post_thumbnail_id() ); ?>" style="width:100%; height:240px;" alt=""></a>
                                            </figure><!--//post-thumb-->
                                            <?php endif; ?> 
                                          
                                         <?php  $post_title = get_the_title(); ?>
                                          <div class="content">
                                              <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words($post_title,5); ?></a></h3>
                                              <?php $excerpt = get_the_excerpt();  ?>
                                                 <p> <?php echo wp_trim_words($excerpt,10); //the_excerpt(); ?></p>
                                                  <a class="read-more" href="<?php the_permalink(); ?>">Read more <i class="fa fa-long-arrow-right"></i></a>
                                              
                                          </div><!--//content-->
                                      </div><!--//post-inner-->
                    </article>                                  
                <?php endwhile; ?>
                 <?php endif; ?>
                   <!-- the loop -->
                 </div><!--//blog-list--> 
                 
               </div><!--//row-->
</div>
 <!-- ******Testimonials Section****** -->
        <section class="section testimonials">
            <div class="container">
                <h2 class="title text-center">  <?php the_field('testimonial_title'); ?></h2>
                <div id="testimonials-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#testimonials-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#testimonials-carousel" data-slide-to="1"></li>
                        <li data-target="#testimonials-carousel" data-slide-to="2"></li>
                    </ol><!--//carousel-indicators-->
                    <div class="carousel-inner">
                        <?php $this_page_id=545; ?>

    	<?php query_posts(array('post_parent' => $this_page_id, 'post_type' => 'page',  'order_by' => 'title',
        'order' => 'ASC',)); $count=0;
        while (have_posts()) { 	
        	the_post(); 

        	?>

                        <div class="item <?php if( $count==0){echo "active";} ?>">
                     <?php 
	                if(get_field( 'testimonial_image' )):
					      $testimonial_image=  get_field( 'testimonial_image' );
				    else:
					      $testimonial_image='';
			        endif;
			        ?>
                            <figure class="profile"><img src="<?php echo $testimonial_image; ?>" weight="150px" height="100px" /></figure>
                            <div class="content">
                                <blockquote>
                                	<?php 
                                    if(get_field( 'testimonial_content' )):
					                 $testimonial_content=  get_field( 'testimonial_content' );
				                    else:
					                  $testimonial_content='';
			                        endif;
			                         ?>
                                <i class="fa fa-quote-left"></i>
                                <p><?php echo $testimonial_content; ?></p>
                                </blockquote>
                                 <?php
                                 if(get_field( 'name' )):
					               $name=  get_field( 'name' );
				                 else:
					               $name='';
			                     endif;
			                     ?>
            
                                 <?php  if(get_field( 'desination' )):
					               $desination=  get_field( 'desination' );
				                  else:
					               $desination='';
			                     endif;
			                       ?>
                                <p class="source"><?php echo $name; ?><br /><span class="title"><?php echo $desination; ?></span></p>
                            </div><!--//content-->

                            </div><!--//item--> 

                        <?php ++$count;} wp_reset_query();?>                       
                                                              
                    </div><!--//carousel-inner-->
                    
                </div><!--//carousel-->
            </div><!--//container-->
        </section><!--//testimonials-->          
        

<!-- ******Press Section****** -->

<!--

<section class="section press">
<div class="container text-center">
<h2 class="title">Press Coverage</h2>
<ul class="press-list list-inline row">
	<li class="col-md-2 col-sm-2 col-xs-4"><a href="#"><img class="img-responsive" src="assets/images/press/press-1.png" alt="" /></a></li>
	<li class="col-md-2 col-sm-2 col-xs-4"><a href="#"><img class="img-responsive" src="assets/images/press/press-2.png" alt="" /></a></li>
	<li class="col-md-2 col-sm-2 col-xs-4 xs-break"><a href="#"><img class="img-responsive" src="assets/images/press/press-3.png" alt="" /></a></li>
	<li class="col-md-2 col-sm-2 col-xs-4"><a href="#"><img class="img-responsive" src="assets/images/press/press-4.png" alt="" /></a></li>
	<li class="col-md-2 col-sm-2 col-xs-4"><a href="#"><img class="img-responsive" src="assets/images/press/press-5.png" alt="" /></a></li>
	<li class="col-md-2 col-sm-2 col-xs-4"><a href="#"><img class="img-responsive" src="assets/images/press/press-6.png" alt="" /></a></li>
</ul>
<ul class="press-list list-inline row last">
	<li class="col-md-2 col-sm-2 col-xs-4"><a href="#"><img class="img-responsive" src="assets/images/press/press-7.png" alt="" /></a></li>
	<li class="col-md-2 col-sm-2 col-xs-4"><a href="#"><img class="img-responsive" src="assets/images/press/press-8.png" alt="" /></a></li>
	<li class="col-md-2 col-sm-2 col-xs-4 xs-break"><a href="#"><img class="img-responsive" src="assets/images/press/press-9.png" alt="" /></a></li>
	<li class="col-md-2 col-sm-2 col-xs-4"><a href="#"><img class="img-responsive" src="assets/images/press/press-10.png" alt="" /></a></li>
	<li class="col-md-2 col-sm-2 col-xs-4"><a href="#"><img class="img-responsive" src="assets/images/press/press-11.png" alt="" /></a></li>
	<li class="col-md-2 col-sm-2 col-xs-4"><a href="#"><img class="img-responsive" src="assets/images/press/press-12.png" alt="" /></a></li>
</ul>
<div class="press-lead text-center">
<h3 class="title">Have press inquires?</h3>
<p class="press-links"><a href="#">Download our press kit</a> or <a href="contact.html">Get in touch</a></p>

</div>
</div>
</section>-->

<!-- ******CTA Section****** -->

<section id="cta-section" class="section cta-section text-center home-cta-section" style="background-image:url(<?php the_field('join_us_background'); ?>);">

<h2 class="title"><?php the_field('join_us_title'); ?></h2>
<h3 class="intro"><?php the_field('join_us_sub_title'); ?></h3>
&nbsp;

<a href="http://www.wegotplayers.com/members/user/register" class="tp-button orange small" target="_blank">Join Us Free</a>

</div>
<!--//container-->

</section><!--//cta-section-->

</div>
<!--//section-wrapper-->
                

<?php endwhile; endif; ?>  

<?php include('footer.php'); ?>