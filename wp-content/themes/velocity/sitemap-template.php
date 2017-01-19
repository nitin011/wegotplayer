<?php /*
Template Name: Sitemap Page 
*/
?>
<?php require('header.php'); ?>
 <section class="featured-blog-posts section">       
       
            <div class="flexslider blog-slider">
                <ul class="slides">
                 <?php 
                  $background_image=get_bloginfo('template_directory')."/images/special-india-visitas.png"; 
                  ?>
                  <li class="slide slide-1" style="background-image: url('<?php echo $background_image; ?>')">
                        <div class="flex-caption container">
                            <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                          
                            
                        </div><!--//flex-caption-->
                    </li>
              
                 
                </ul><!--//slides-->
            </div><!--//flexslider-->
                    
        </section><!--//featured-blog-posts--> 
        
        <!-- ******BLOG LIST****** --> 
<div class="blog blog-category blog-archive container">
          		
<!-- <h2 id="authors">Authors</h2> -->
	<ul> 
		<?php  //wp_list_authors( array('exclude_admin' => false,));?>
	</ul>	 
	<h2 id="pages">Pages</h2>
	<ul class="sitemap-page">
		<?php // Add pages you'd like to exclude in the exclude here
				wp_list_pages(array('exclude' => '','title_li' => '',));
		?>
	</ul>

	<h2 id="posts">Posts</h2>
	<ul class="sitemap-post">
	<?php // Add categories you'd like to exclude in the exclude here
		$cats = get_categories('exclude=');
		foreach ($cats as $cat) {
	  			echo "<h3>".$cat->cat_name."</h3>";
	  			echo "<ul class=\"sitemap-post-cat\">";

	  		query_posts('posts_per_page=-1&cat='.$cat->cat_ID);

	  		while(have_posts()) {
					the_post();

	    		$category = get_the_category();

	    // Only display a post link once, even if it's in multiple categories

	    if ($category[0]->cat_ID == $cat->cat_ID) {

	      echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';

	    }

	  }
	  echo "</ul>";

	}

	?>

	</ul>

</div>
<?php require('footer.php'); ?>