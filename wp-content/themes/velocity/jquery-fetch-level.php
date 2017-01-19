<?php
// Our include
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');
 
// Our variables
echo $sports = (isset($_REQUEST['sports'])) ? $_REQUEST['sports'] : '';

if($sports!=''){

 $seconddb = new wpdb('weplayer','WegotPlayer!@#$','backall','mysql.wegotplayers.com');                             

       $level= $seconddb->get_results("SELECT * FROM `wgp_levels` where sportId='$sports'");   
      
         if( count($level)==0 ) {
                          echo "<span>No position found</span>\n";
                   }else{   
                                                  
                           $data= "<option value=\"\">Select Level</option>\n"; 
                           foreach($level as $rs){                            
                                   $data.= "<option value=\"$rs->levelId\">$rs->levelName</option>\n";              
                           } //end foreach                               
                           echo $data; 
                             
                } //end else 
//END: Find the list of SUBPAGES of parent page PRODUCTS page with page_id=716
              }else{

                 echo "<span>Error getting Level values from database</span>\n";
              }
