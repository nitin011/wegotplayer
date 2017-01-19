<?php include('blog-page-header.php'); ?>
 <!-- ******BLOG****** -->         
        <div class="blog-entry-wrapper"> 
            <!--
            <div class="blog-headline-bg">
            </div><!--//blog-headline-bg-->
            <div class="blog-entry">                 
                     <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <article class="post">
                <?php
										
						if ( has_post_thumbnail() ): 
							 $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full'); 
							 $background_image = esc_url( $image[0] );
						else:
							 $background_image = get_bloginfo('template_directory')."/images/special-india-visitas.png";
						endif;
			  ?>
                    <header class="blog-entry-heading"  style="background-image: url('<?php echo $background_image; ?>')">
                        <div class="container text-center">                        
                            <h2 class="title"><?php the_title(); ?></h2>
                            <div class="meta">
                                <ul class="meta-list list-inline">                                       
                                	<li class="post-time"><?php the_time('j M, Y'); ?></li>
                                	<li class="post-author"> by <?php the_author(); ?></li>
                             	</ul><!--//meta-list-->    	
                            </div><!--meta-->
                        </div><!--//container-->
                        <nav class="post-nav post-nav-top">
    						<span class="nav-previous"><?php previous_post_link('%link', '<i class="fa fa-long-arrow-left"></i>Previous Post' ); ?> </span>
    						<span class="nav-next"><?php next_post_link('%link', 'Next Post <i class="fa fa-long-arrow-right"></i>'); ?></span>
    				    </nav><!--//post-nav-->
                    </header><!--//blog-entry-heading-->

                    <div class="container">
                        <div class="row">
                            <div class="blog-entry-content col-md-8 col-sm-10 col-xs-12 col-md-offset-2 col-sm-offset-1 col-xs-offset-0">
                             <p><?php the_content(); ?></p>

                             <p class="author-name">Author @<?php the_author().'<br>'; ?> </p>                                
                               <span class="author-info"> <?php echo $description =  get_the_author_meta('description'); ?></span>
                             </div>
                             <!--//blog-entry-content-->
                            
                            <!--//Soical media buttons: https://github.com/kni-labs/rrssb (More examples) -->
                            <div class="share-container col-md-8 col-sm-10 col-xs-12 col-md-offset-2 col-sm-offset-1 col-xs-offset-0"><!--//Soical media buttons: https://github.com/kni-labs/rrssb (More examples) -->
                                <span class="label">share this:</span>
                
                                <!-- Buttons start here. Copy this ul to your document. -->
                                <!-- Buttons end here -->
                            </div><!--//share-container--> 
                            
                            
                            
                            <nav class="post-nav col-md-8 col-sm-10 col-xs-12 col-md-offset-2 col-sm-offset-1 col-xs-offset-0">
            						<span class="nav-previous"><?php previous_post_link('%link', '<i class="fa fa-long-arrow-left"></i>Previous Post' ); ?> </span>
    						<span class="nav-next"><?php next_post_link('%link', 'Next Post <i class="fa fa-long-arrow-right"></i>'); ?></span>
            				</nav><!--//post-nav-->
            				
            				
            				<div id="comment-area" class="comment-area  col-md-8 col-sm-10 col-xs-12 col-md-offset-2 col-sm-offset-1 col-xs-offset-0">
            				        <!--//DISQUS script starts-->
            				        <div id="disqus_thread"></div>
                                    <script type="text/javascript">
                                        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                                        var disqus_shortname = 'wegotplayers'; // required: replace example with your forum shortname
                                
                                        /* * * DON'T EDIT BELOW THIS LINE * * */
                                        (function() {
                                            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                                            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                                            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                                        })();
                                    </script>
                                    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                                    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
                                    <!--//DISQUS script ends-->
        
            				</div><!--//comment-area-->
                        </div><!--//row-->
                    </div><!--//container-->                                               
                </article><!--//post-->       
                   <?php endwhile; endif; ?>  
                               
            </div><!--//blog-entry-->
        </div>
<?php include('footer.php'); ?>