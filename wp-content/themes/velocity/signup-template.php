<?php /*
Template Name: SignUp Template
*/
?>

<?php include('header-signup.php'); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>




<?php 
      if (has_post_thumbnail( $post->ID ) ): 
         $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') );
        
 else :
        $image = get_bloginfo( 'stylesheet_directory') . '/images/banner-ground.jpg'; 
 endif; 

   ?>

<!-- ******Signup Section****** --> 
        <section class="signup-section access-section section">
            <div class="container">
                <div class="row">
                    <div class="form-box col-md-10 col-sm-12 col-xs-12 col-md-offset-1 col-sm-offset-0 col-sm-offset-0">     
                        <div class="form-box-inner">
                            <h2 class="title text-center">Sign Up Now</h2>  
                            
                            <div class="signup-box">
                            
                           </div>


              
                            <div class="row">
                                <div class="form-container col-md-5 col-sm-12 col-xs-12">
                                        <input type="button" class="btn btn-block btn-cta-primary" onClick="location.href='http://www.wegotplayers.com/players-registration'" value='Players Registration'>
                                </div><!--//form-container-->
                                <div class="col-md-5 col-sm-12 col-xs-12 col-md-offset-2">                 
                                   
                                      <input type="button" class="btn btn-block btn-cta-primary" onClick="location.href='http://www.wegotplayers.com/welcome-recruiters'" value='Recruiters Registration'>
                    
                               </div><!--//social-login-->
                            </div><!--//row-->
                        </div><!--//form-box-inner-->
                    </div><!--//form-box-->
                </div><!--//row-->
            </div><!--//container-->
        </section><!--//signup-section-->
                

<?php endwhile; endif; ?>  

<?php include('footer.php'); ?>