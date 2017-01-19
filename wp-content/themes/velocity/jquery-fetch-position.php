<?php
// Our include
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');
 
// Our variables
echo $sports = (isset($_REQUEST['sports'])) ? $_REQUEST['sports'] : '';

if($sports!=''){

 $seconddb = new wpdb('weplayer','WegotPlayer!@#$','backall','mysql.wegotplayers.com');                             

       $position= $seconddb->get_results("SELECT * FROM `wgp_positions` where sportId='$sports'");   
      
         if( count($position)==0 ) {
                          echo "<span>No position found</span>\n";
                   }else{   
                                                  
                           $data= "<option value=\"\">Select Position</option>\n"; 
                           foreach($position as $rs){                            
                                   $data.= "<option value=\"$rs->positionId\">$rs->positionName</option>\n";              
                           } //end foreach                               
                           echo $data; 
                             
                } //end else 
//END: Find the list of SUBPAGES of parent page PRODUCTS page with page_id=716
              }else{

                 echo "<span>Error getting position values from database</span>\n";
              }
