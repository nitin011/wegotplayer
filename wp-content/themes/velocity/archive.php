<?php require('archive-header.php'); ?>

 <!-- ******BLOG LIST****** --> 
        <div class="blog blog-category blog-archive container">
          <?php 

		  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
		
		  $custom_args = array(
			  'post_type' => 'post',
			  'posts_per_page' => 10,
			  'paged' => $paged
			);
		
		  $custom_query = new WP_Query( $custom_args ); ?>
		
		  <?php if ( $custom_query->have_posts() ) : ?>
				
					<h2 class="page-title text-center"><i class="fa fa-archive"></i><?php
								if ( is_archive() && is_day() ) :
									printf( __( 'Daily Archives: <span>%s</span>', '' ), get_the_date() );
		
								elseif ( is_archive() && is_month() ) :
									printf( __( 'Monthly Archives: <span>%s</span>', '' ), get_the_date( _x( 'F Y', 'monthly archives date format', '' ) ) );
		
								elseif ( is_archive() && is_year() ) :
									printf( __( 'Yearly Archives: <span>%s</span>', '' ), get_the_date( _x( 'Y', 'yearly archives date format', '' ) ) );
		
								else :
									_e( 'Archives', '' );
		
								endif;
							?></h2>
					<div class="row">
						<div class="blog-list blog-category-list">
							

							 <?php while ( have_posts() ) : the_post(); ?>
							        <?php print_r($the_post->post_date); ?>
							       
								   <article class="post col-md-10 col-sm-12 col-xs-12 col-md-offset-1 col-sm-offset-0 col-xs-offset-0">
								<div class="post-inner">
									<div class="content">
										<div class="date-label">
											<span class="month"><?php the_time('M'); ?></span>
											<span class="date-number"><?php the_time('j'); ?></span>
										</div>
										<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<div class="meta">
											<ul class="meta-list list-inline">                                       
												<li class="post-author"> by <?php the_author(); ?></li>
												<li class="post-comments-link">
													<i class="fa fa-comments"></i><?php							
                                                    if ( comments_open() ) {
                                                        comments_number( 'no comments', '1', '%' );
                                                    } else {
                                                        echo $write_comments =  __('Comments are off for this post.');
                                                    } 
                                                   ?>
												</li>
											</ul><!--//meta-list-->                           	
										</div><!--meta-->                               
										<div class="post-entry">
											<p><?php the_excerpt(); ?></p>
											<a class="read-more" href="<?php the_permalink(); ?>">Read more <i class="fa fa-long-arrow-right"></i></a>
										</div>                                
									</div><!--//content-->
								</div><!--//post-inner-->
							</article><!--//post-->
							 <?php endwhile; ?>
						</div><!--//blog-list--> 
						  
						  <div class="row">
				               <div class="pagination">
				                <?php wp_pagination(); ?>
				              </div>
           				 </div>
						  <?php wp_reset_postdata(); ?>
		
		  	</div><!--//row-->
		
		  <?php else:  ?>
                    <h2 class="page-title text-center"><i class="fa fa-archive"></i><?php
								if ( is_day() ) :
									printf( __( 'Daily Archives: <span>%s</span>', '' ), get_the_date() );
		
								elseif ( is_month() ) :
									printf( __( 'Monthly Archives: <span>%s</span>', '' ), get_the_date( _x( 'F Y', 'monthly archives date format', '' ) ) );
		
								elseif ( is_year() ) :
									printf( __( 'Yearly Archives: <span>%s</span>', '' ), get_the_date( _x( 'Y', 'yearly archives date format', '' ) ) );
		
								else :
									_e( 'Archives', '' );
		
								endif;
							?></h2>
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
