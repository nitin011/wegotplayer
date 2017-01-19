</div><!--//wrapper-->

 <!-- ******FOOTER****** --> 
    <footer class="footer">
        <div class="footer-content">
            <div class="container">
                <div class="row">                    
                    <div class="footer-col links col-md-2 col-sm-4 col-xs-6">
                        <div class="footer-col-inner">
                            <h3 class="title">About us</h3>
                            <?php wp_nav_menu( array( 'theme_location' => 'footer1' ,'menu_class'=>'list-unstyled' ) ); ?>
                           <!-- <ul class="list-unstyled">
                                <li><a href="#"><i class="fa fa-caret-right"></i>Who we are</a></li>
                                <li><a href="#"><i class="fa fa-caret-right"></i>Press</a></li>
                                <li><a href="#"><i class="fa fa-caret-right"></i>Blog</a></li>
                                <li><a href="#"><i class="fa fa-caret-right"></i>Jobs</a></li>
                                <li><a href="#"><i class="fa fa-caret-right"></i>Contact us</a></li>
                            </ul>-->
                        </div><!--//footer-col-inner-->
                    </div><!--//foooter-col-->    
                    <div class="footer-col links col-md-2 col-sm-4 col-xs-6">
                        <div class="footer-col-inner">
                            <h3 class="title">Product</h3>
                            <?php wp_nav_menu( array( 'theme_location' => 'footer2' ,'menu_class'=>'list-unstyled' ) ); ?>
                            <!--<ul class="list-unstyled">
                                <li><a href="#"><i class="fa fa-caret-right"></i>How it works</a></li>
                                <li><a href="#"><i class="fa fa-caret-right"></i>API</a></li>
                                <li><a href="#"><i class="fa fa-caret-right"></i>Download Apps</a></li>
                                <li><a href="#"><i class="fa fa-caret-right"></i>Pricing</a></li>
                            </ul>-->
                        </div><!--//footer-col-inner-->
                    </div><!--//foooter-col-->              
                    <div class="footer-col links col-md-3 col-sm-4 col-xs-12 sm-break">
                        <div class="footer-col-inner">

                            <?php dynamic_sidebar( 'Contact' ); ?>
                         <!--     <h3 class="title">Contact us</h3>                          
                          <p class="adr clearfix">
                                <i class="fa fa-map-marker pull-left"></i>        
                                <span class="adr-group pull-left">       
                                    <span class="street-address">College Green</span><br>
                                    <span class="region">56 College Green Road</span><br>
                                    <span class="postal-code">BS1 XR18</span><br>
                                    <span class="country-name">UK</span>
                                </span>
                            </p>
                            <p class="tel"><i class="fa fa-phone"></i>0800 123 4567</p>
                            <p class="email"><i class="fa fa-envelope-o"></i><a href="#">enquires@website.com</a></p>  -->
                        </div><!--//footer-col-inner-->            
                    </div><!--//foooter-col-->   
                    <div class="footer-col connect col-md-5 col-sm-12 col-xs-12">
                        <div class="footer-col-inner">
                             <?php dynamic_sidebar( 'Social Icon' ); ?>
                       <!--     <ul class="social list-inline">
                                <li><a href="https://twitter.com/3rdwave_themes" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>        
                                <li class="row-end"><a href="#"><i class="fa fa-rss"></i></a></li>             
                            </ul>
                            <div class="form-container">
                                <p class="intro">Stay up to date with the latest news and offers from Velocity</p>  -->
                                                           
<script type="text/javascript">
//<![CDATA[
if (typeof newsletter_check !== "function") {
window.newsletter_check = function (f) {
    var re = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-]{1,})+\.)+([a-zA-Z0-9]{2,})+$/;
    if (!re.test(f.elements["ne"].value)) {
        alert("The email is not correct");
        return false;
    }
    for (var i=1; i<20; i++) {
    if (f.elements["np" + i] && f.elements["np" + i].required && f.elements["np" + i].value == "") {
        alert("");
        return false;
    }
    }
    if (f.elements["ny"] && !f.elements["ny"].checked) {
        alert("You must accept the privacy statement");
        return false;
    }
    return true;
}
}
//]]>
</script>

                          
                            </div><!--//subscription-form-->
                        </div><!--//footer-col-inner-->
                    </div><!--//foooter-col-->
                    <div class="clearfix"></div> 
                </div><!--//row-->
                
            </div><!--//container-->
        </div><!--//footer-content-->
        <div class="bottom-bar">
            <div class="container">
                      <?php dynamic_sidebar( 'Copyright' ); ?>       
            </div><!--//container-->
        </div><!--//bottom-bar-->
    </footer><!--//footer-->
    
       <!-- Javascript -->          
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/assets/plugins/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/assets/plugins/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/assets/plugins/bootstrap-hover-dropdown.min.js"></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/assets/plugins/back-to-top.js"></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/assets/plugins/jquery-placeholder/jquery.placeholder.js"></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/assets/plugins/FitVids/jquery.fitvids.js"></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/assets/plugins/flexslider/jquery.flexslider-min.js"></script> 
            
    <!-- blog page specific js starts --> 
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/assets/plugins/imagesloaded/imagesloaded.pkgd.min.js"></script>     
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/assets/plugins/masonry.pkgd.min.js"></script> 
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/assets/js/blog.js"></script>
    <!-- blog page specific js ends -->   
     
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/assets/js/main.js"></script>
    
    <?php wp_footer() ?>
            
</body>
</html> 

