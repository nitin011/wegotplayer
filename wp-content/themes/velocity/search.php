<?php include('header.php'); ?>

 <!-- ******BLOG LIST****** --> 
        <div class="blog blog-category blog-archive container">
           <?php if ( have_posts() ) : ?>
 
				
					<h2 class="page-title text-center"><?php printf( __( 'Search Results for: %s', '' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
					<div class="row">
						<div class="blog-list blog-category-list">
							 <?php while ( have_posts() ) : the_post(); ?>
 	   <!--//post-->
                                   <article class="post col-md-10 col-sm-12 col-xs-12 col-md-offset-1 col-sm-offset-0 col-xs-offset-0">
                        <div class="post-inner">
                             <?php if( has_post_thumbnail( $post_id ) ): ?>
                                           <figure class="post-thumb">
                                              <a href="<?php the_permalink(); ?>"><img class="img-responsive" src="<?=wp_get_attachment_url( get_post_thumbnail_id() ); ?>" style="width:100%; height:auto;" alt=""></a>
                                            </figure><!--//post-thumb-->
                                            <?php endif; ?> 
                            <div class="content">
                                <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
                                  <p><?php the_excerpt(); ?></p>
                                                  <a class="read-more" href="<?php the_permalink(); ?>">Read more <i class="fa fa-long-arrow-right"></i></a>
                                              
                                </div>                                
                            </div><!--//content-->
                        </div><!--//post-inner-->
                    </article>
                                  <!--//post-->
							 <?php endwhile; ?>
						</div><!--//blog-list--> 
					</div><!--//row-->
		
		  <?php else:  ?>
          <h2 class="page-title text-center"><?php printf( __( 'Search Results for: %s', '' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
					<div class="row">
						<div class="blog-list blog-category-list">
							 <article class="post col-md-10 col-sm-12 col-xs-12 col-md-offset-1 col-sm-offset-0 col-xs-offset-0">
                                 <div class="post-inner">
                            <div class="content">
                                <h3 class="post-title"><?php _e( 'Sorry, no posts matched your criteria.' ); ?></h3>
                            </div><!--//content-->
                        </div><!--//post-inner-->
                            </article>
						</div><!--//blog-list--> 
					</div><!--//row-->
			
		  <?php endif; ?>
          
        </div><!--//blog-->           
<?php include('footer.php'); ?>