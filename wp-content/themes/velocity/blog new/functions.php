<?php
if ( function_exists('register_sidebar') ){
register_sidebar(array('name'=>'Category menu',
		'before_widget' => '', 
		'after_widget' => '',
		'before_title' => '<h1 style="display:none">',
		'after_title' => '</h1>',     
		));

register_sidebar(array('name'=>'Archieve menu',
		'before_widget' => '', 
		'after_widget' => '',
		'before_title' => '<h1 style="display:none">',
		'after_title' => '</h1>',     
		));

}
if ( function_exists( 'register_nav_menus' ) ) {
 register_nav_menus( array(
		'primary' => __( 'Primary Navigation'),
		'footer' => __( 'Footer Navigation'),
	) );
}
   
 /* This code filters the Categories archive widget to include the post count inside the link */
add_filter('wp_list_categories', 'cat_count_span');
function cat_count_span($links) {
$links = str_replace('</a> (', ' (', $links);
$links = str_replace(')', ')</a>', $links);
return $links;
}
/* This code filters the Archive widget to include the post count inside the link */
add_filter('get_archives_link', 'archive_count_span');
function archive_count_span($links) {
$links = str_replace('</a>&nbsp;(', ' (', $links);
$links = str_replace(')', ')</a>', $links);
return $links;
}

add_theme_support( 'post-thumbnails' );
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );


// Add ID and CLASS attributes to the first <ul> occurence in wp_page_menu
function add_menuclass( $ulclass ) {
  return preg_replace( '/<ul>/', '<ul id="nav" class="nav navbar-nav animated activate slideInRight">', $ulclass, 1 );
}
add_filter( 'wp_page_menu', 'add_menuclass' );
?>
<?php  function new_excerpt_more($more) {
   global $post;
   return '';
   }
   add_filter('excerpt_more', 'new_excerpt_more');
   
   
   
   
   function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }
  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('&laquo;'),
    'next_text'       => __('&raquo;'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
	 
    echo "<nav class='pagination'>";
      echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</nav>";
  }

}
//pagination testing
function my_post_queries( $query ) {
  // do not alter the query on wp-admin pages and only alter it if it's the main query
  if (!is_admin() && $query->is_main_query()){

    // alter the query for the home and category pages 

    if(is_home()){
      $query->set('posts_per_page', 4);
    }

    if(is_category()){
      $query->set('posts_per_page', 4);
    }

  }
}
add_action( 'pre_get_posts', 'my_post_queries' );


?>

