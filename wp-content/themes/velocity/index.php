<?php require('header.php'); ?>

        <section class="featured-blog-posts section">       
       
            <div class="flexslider blog-slider">
                <ul class="slides">
                  <?php
						query_posts('posts_per_page=4');
						if ( have_posts() ) : while ( have_posts() ) : the_post();
						
						if ( has_post_thumbnail() ): 
							 $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail'); 
							 $background_image= esc_url( $image[0] );
						else:
							 $background_image=get_bloginfo('template_directory')."/images/special-india-visitas.png";
						endif;
			  ?>
                    <li class="slide slide-1" style="background-image: url('<?php echo $background_image; ?>')">
                        <div class="flex-caption container">
                            <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="meta"><?php the_time('j M, Y'); ?></div>
                            <a class="more-link" href="<?php the_permalink(); ?>">Read more &rarr;</a>
                        </div><!--//flex-caption-->
                    </li>
                 <?php endwhile; ?> 
                 <?php endif; ?>
                </ul><!--//slides-->
            </div><!--//flexslider-->
                    
        </section><!--//featured-blog-posts-->
        
        <!-- ******BLOG LIST****** --> 
   
  <?php 

  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

  $custom_args = array(
      'post_type' => 'post',
      'posts_per_page' => 10,
      'paged' => $paged
    );

  $custom_query = new WP_Query( $custom_args ); ?>

  <?php if ( $custom_query->have_posts() ) : ?>
       <div class="blog container">
            <div class="row">
                <div id="blog-mansonry" class="blog-list">
                    <!-- the loop -->
               <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                    <article class="post col-md-4 col-sm-6 col-xs-12" >
                                      <div class="post-inner">
                                           <?php if( has_post_thumbnail( $post_id ) ): ?>
                                           <figure class="post-thumb">
                                              <a href="<?php the_permalink(); ?>"><img class="img-responsive" src="<?=wp_get_attachment_url( get_post_thumbnail_id() ); ?>" style="width:100%; height:auto;" alt=""></a>
                                            </figure><!--//post-thumb-->
                                            <?php endif; ?> 
                                          
                                          <div class="content">
                                              <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                 <p><?php the_excerpt(); ?></p>
                                                  <a class="read-more" href="<?php the_permalink(); ?>">Read more <i class="fa fa-long-arrow-right"></i></a>
                                              
                                              <div class="meta">
                                                  <ul class="meta-list list-inline">                                       
                                                      <li class="post-time post_date date updated"><?php the_time('j M, Y'); ?></li>
                                                      <li class="post-author"> by <?php the_author(); ?></li>
                                                      <li class="post-comments-link"><i class="fa fa-comments"></i><?php							
                                                    if ( comments_open() ) {
                                                        comments_number( 'no comments', '1', '%' );
                                                    } else {
                                                        echo $write_comments =  __('Comments are off for this post.');
                                                    } 
                                              ?></li>
                                                  </ul><!--//meta-list-->                           	
                                              </div><!--meta-->
                                          </div><!--//content-->
                                      </div><!--//post-inner-->
                                  </article>
                  
              <?php endwhile; ?>
              </div>
             <!-- end of the loop -->
  <div class="pagination-container text-center">
      <?php
      if (function_exists(custom_pagination)) {
        custom_pagination($custom_query->max_num_pages,"",$paged);
      }
       ?>
     </div>
     
       <div style="text-align:right;">
      <?php next_posts_link(); ?>
		<?php previous_posts_link(); ?>
				
					</div>
  <?php wp_reset_postdata(); ?>

  <?php else:  ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
  <?php endif; ?>
   
    <!-- pagination here -->
   
                </div><!--//blog-list-->  
            </div><!--//row-->
            
        </div><!--//blog-->  
         <!-- ****** END BLOG LIST****** --> 
         
         
 
<?php require('footer.php'); ?>
