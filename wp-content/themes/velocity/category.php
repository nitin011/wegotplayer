<?php require('archive-header.php'); ?>

 <!-- ******BLOG LIST****** --> 
  <div class="blog blog-category blog-archive container">	
				
					<h2 class="page-title text-center"><i class="fa fa-archive"></i><?php printf( __( 'Category : %s', '' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h2>
					<div class="row">
                <div id="blog-mansonry" class="blog-list">
							 <?php  while ( have_posts() ) : the_post(); ?>
            
               
								   <!--//post-->
                                   <article class="post col-md-4 col-sm-6 col-xs-12">
                        <div class="post-inner">
                             <?php if( has_post_thumbnail( $post_id ) ): ?>
                                           <figure class="post-thumb">
                                              <a href="<?php the_permalink(); ?>"><img class="img-responsive" src="<?=wp_get_attachment_url( get_post_thumbnail_id() ); ?>" style="width:100%; height:auto;" alt=""></a>
                                            </figure><!--//post-thumb-->
                                            <?php endif; ?> 
                            <div class="content">
                                <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(the_title(),4); ?></a></h3>
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
                                <div class="post-entry">
                                  <p><?php echo wp_trim_words($excerpt,10); ?></p>
                                   <a class="read-more" href="<?php the_permalink(); ?>">Read more <i class="fa fa-long-arrow-right"></i></a>
                                              
                                </div>                                
                            </div><!--//content-->
                        </div><!--//post-inner-->
                    </article>
                                  <!--//post-->
							 <?php endwhile; ?>
						</div><!--//blog-list--> 
            <div class="row">
               <div class="pagination">
                <?php wp_pagination(); ?>
              </div>
            </div>
						  
						  <?php wp_reset_postdata(); ?>
		                 </div><!--//row-->
        </div><!--//blog-->           
<?php include('footer.php'); ?>

                

