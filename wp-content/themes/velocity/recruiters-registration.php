<?php /*
Template Name: Recruiters Registration
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
<section class="resetpass-section access-section section">
            <div class="container">
                <div class="row">
                    <div class="form-box col-md-10 col-sm-10 col-xs-12 col-md-offset-1">     
                        <div class="form-box-inner">
                            <h2 class="title text-center"><?php the_title(); ?></h2>    
                            <p class="intro">Please enter your details.</p>             
                            <div class="row">
                                <div class="form-container">
                                    <form class="resetpass-form">              
                                        <div class="form-group">
                                            <label class="form-label">First Name <span>*<span></label>
                                            <input type="text" class="form-control" placeholder="First Name">
                                        </div><!--//form-group-->  
                                        <div class="form-group">
                                            <label class="form-label">First Name <span>*<span></label>
                                            <input type="text" class="form-control" placeholder="First Name">
                                        </div><!--//form-group--> 
                                        <div class="form-group">
                                            <label class="form-label">Last Name <span>*<span></label>
                                            <input type="text" class="form-control" placeholder="Last Name">
                                        </div><!--//form-group--> 
                                        <div class="form-group">
                                            <label class="form-label">E-mail Address <span>*<span></label>
                                            <input type="email" class="form-control" placeholder="E-mail Address" autocomplete="off">
                                        </div><!--//form-group--> 
                                        <div class="form-group">
                                            <label class="form-label">Password<span>*<span></label>
                                            <input type="password" class="form-control" placeholder="Password" autocomplete="off">
                                        </div><!--//form-group--> 
                                        <div class="form-group">
                                            <label class="form-label">Password Confirmation <span>*<span></label>
                                            <input type="password" class="form-control" placeholder="Password Confirmation">
                                        </div><!--//form-group--> 
                                        <div class="form-group">
                                            <label class="form-label">Recruiter’s Occupation <span>*<span></label>
                                            <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Your Org / Team Name  <span>*<span></label>
                                            <input type="text" class="form-control" placeholder="Your Org / Team Name ">
                                        </div><!--//form-group-->

                                        <div class="form-group">
                                            <label class="form-label">Sport <span>*<span></label>
                                            <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>

                                            </select>
                                        </div>
                                            <div class="form-group">
                                            <label class="form-label">Level <span>*<span></label>
                                            <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>

                                            </select>
                                       </div>
                                            <div class="form-group">
                                            <label class="form-label">What Gender You Coach <span>*<span></label>
                                            <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>

                                            </select> 
                                            </div>

                                         <div class="form-group">
                                            <label class="form-label">Website  <span>*<span></label>
                                            <input type="text" class="form-control" placeholder="Wevsite ">
                                        </div><!--//form-group-->
                                         <div class="form-group">
                                            <label class="form-label">Address  <span>*<span></label>
                                            <input type="text" class="form-control" placeholder="Address ">
                                        </div><!--//form-group-->
                                         <div class="form-group">
                                            <label class="form-label">Zip Code  <span>*<span></label>
                                            <input type="text" class="form-control" placeholder="Zip Code ">
                                        </div><!--//form-group-->
                                         <div class="form-group">
                                            <label class="form-label">City  <span>*<span></label>
                                            <input type="text" class="form-control" placeholder="City ">
                                        </div><!--//form-group-->
                                         <div class="form-group">
                                            <label class="form-label">State  <span>*<span></label>
                                            <input type="text" class="form-control" placeholder="State">
                                        </div><!--//form-group-->
                                         <div class="form-group">
                                            <label class="form-label">Country <span>*<span></label>
                                            <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>

                                            </select> 
                                            </div>
                                            <p class="lead text-center"> By Signing Up with WeGotPlayers.com and creating your sports recruiter’ profile, you acknowledge that you have read, understood and agreed with our Terms and Privacy.  </p>
                                        <button type="submit" class="btn btn-block btn-cta-primary">Submit</button>
                                    </form>
                                    <p class="lead text-center">Already have an account? <a href="http://www.wegotplayers.com/login">login</a> page</p>
                                </div><!--//form-container-->
                            </div><!--//row-->
                        </div><!--//form-box-inner-->
                    </div><!--//form-box-->
                </div><!--//row-->
            </div><!--//container-->
        </section><!--//contact-section-->
    </div><!--//upper-wrapper--><!--//signup-section-->
                

<?php endwhile; endif; ?>  

<?php include('footer.php'); ?>