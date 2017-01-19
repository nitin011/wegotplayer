<?php /*
Template Name: Blog
*/
?>
<?php require('blog-header.php'); ?>

         <section class="featured-blog-posts section">       
       
            <div class="flexslider blog-slider">
                <ul class="slides">
                  <?php
            query_posts('posts_per_page=4');
            if ( have_posts() ) : while ( have_posts() ) : the_post();
            
            if ( has_post_thumbnail() ): 
               $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');  
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
                 
                 <?php endif; wp_reset_query();?>
                 
                </ul><!--//slides-->
            </div><!--//flexslider-->
                    
        </section><!--//featured-blog-posts--> 
        
        <!-- ******BLOG LIST****** --> 
   



       <div class="blog container">
           
               <div class="row">
                <div id="blog-mansonry" class="blog-list">
                    <!-- the loop -->
               <?php query_posts('post_type=post&post_status=publish&posts_per_page=9&paged='. get_query_var('paged')); ?>

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
                                              <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words($post_title,4); ?></a></h3>
                                              <?php $excerpt = get_the_excerpt();  ?>
                                                 <p> <?php echo wp_trim_words($excerpt,10); //the_excerpt(); ?></p>
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
                 <?php endif; ?>
                   <!-- the loop -->
                 </div><!--//blog-list--> 
                   <div class="pagination-container text-center">

                
                   <?php //pagination_bar(); ?>
                  </div>
                 
               </div><!--//row-->
    
              <div class="row">
               <div class="pagination">
                <?php wp_pagination(); ?>
              
               <!--<span class="newer"><?php previous_posts_link() ;?></span><span class="newer">
               <?php posts_nav_link(); ?> -->
               <?php //echo $paged; ?>
              <!-- <span class="older"><?php next_posts_link();?></span>


               <?php echo $wp_query->max_num_pages; ?></span> 
                </div>  .navigation -->   
              

             </div>
          
          
        

        </div><!--//blog-->  
         <!-- ****** END BLOG LIST****** --> 
         
         
 
<?php require('footer.php'); ?>
