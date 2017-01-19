<?php if(($acc_type=='PRO')||($acc_type=='PLUS')){ ?>

<div id="resume_print">
  <header>
      <div class="container">
        <div class="row">
          <a class="md-fab md-fab-small md-fab-accent edit_resume" id="edit-personal" href="#">
                      <i class="material-icons">&#xE150;</i>
          </a> 
          <div class="col-xs-12 col-sm-8 col-md-8">
            <div class="resztt">
              <img src="<?php echo $dp_url; ?>">
              <h2><?php echo ucwords($name); ?></h2>              
              <span class="resume_sport"><?php print_r($user_detail->sport);?></span>
              <p><span>Level :</span> <?php print_r($user_detail->level);?></p>
              <p><span>Position :</span> <?php print_r($position);?></p> 
              <p><span>Height : </span><?php print_r($user_detail->height);?></p> 
              <p><span>Weight :</span> <?php print_r($user_detail->weight);?></p>
              <p><span>Hand : </span><?php print_r($user_detail->hand);?></p> 
              <p><span>Foot : </span><?php print_r($user_detail->foot);?></p>
           <?php if($seeking!=''){ ?> <p><span>Seeking : </span><?php  print_r($seeking);}?></p>
                   <?php  
                        if($user_detail->graduation_month!=''){
                             $monthNum  = $user_detail->graduation_month;
                              $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                              $monthName = $dateObj->format('F');
                        ?>
              <p><span>HS Graduation : </span><?php echo $monthName.' '.$user_detail->graduation_year;?></p> 
                <?php } ?></div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="social-header">
              <ul>
                 <li><a href="#"><img src="<?php echo base_url(); ?>images/contactbar.png"></a></li> 
                <!-- <li><a href="#"><p class="phone">0175 5528473</p></a></li> -->
               <!--  <li><a href="#"><p class="message"><?php //echo $email; ?></p></a></li> -->
                 <li><a href="#"><p class="location"><?php print_r($user_detail->address);?></p></a></li> 
              </ul>              
            </div>
          </div>
        </div>
        <div class="row">
          <div class="lorem">
            <div class="col-xs-12 col-sm-12 col-md-6"> 
              <!-- <h3>Personal Information </h3> -->                
              <p><?php print_r($personal_info); ?></p>
            </div> 
            <div class="col-xs-12 col-sm-12 col-md-6">
             <!--  <h3>Objective </h3> -->              
              <p><?php if($objective) {print_r(ucwords($objective));}?></p>
            </div>           
          </div>
        </div>
      </div>    
  </header>
  
                    
   <?php if($stats_details){ ?>     
  <section>
    <div class="experince">
      <div class="container">
        <div class="row">
          
          <div class="col-xs-12 col-sm-12 col-md-12">
            <h1>experince</h1>
              <a class="md-fab md-fab-small md-fab-accent edit_resume" id="edit-experince" href="#">
                      <i class="material-icons">&#xE150;</i>
              </a>
            <div class="boxpara">

             <?php              
             foreach($stats_details as $value) { ?>
              <div class="global">
                <div class="indicator">
                  <h6><?= $value->level ?></h6>
                    <p>Games Played  <?= $value->games_played ?> </p>
                    <p>Goals  <?= $value->goals ?> </p>
                </div>
                <div class="global_img">
                  <img src="<?php echo base_url(); ?>images/indicator.png">
                </div>
                </div>

                <?php }?>
               
                 
            </div>
            <div class="box">
                <div class="trapezoidthree">              
                </div>
                <div class="trapezoidtwo">              
                </div>
                <div class="trapezoid">              
                </div>
            </div>         
            <div class="yearbar">
              <ul>
            <?php foreach($stats_details as $value) { ?>
                <?php foreach ($season as $key => $sea) {
                        if($value->season==$key){
                           echo '<li>'.$sea.'</li>';
                        }
                      } 
              } ?>              
                
              </ul>              
            </div>            
          </div>
        </div>        
      </div>
    </div>
  </section>
  <?php  } ?>

<?php if($honors){ ?>
  <section>
    <div class="awards">
      <div class="container">
        <div class="row">          
          <div class="col-xs-12 col-sm-12 col-md-12">
            <h1>awards</h1>
            <a class="md-fab md-fab-small md-fab-accent edit_resume" id="edit-honor" href="#">
                      <i class="material-icons">&#xE150;</i>
            </a>
              <ul>              
                <?php foreach ($honors as  $honors_row) { ?>
                 <li><img src="<?php base_url(); ?>images/trofi-red.png"/>
                 <?php  echo '<h3>'.$honors_row->awards_honors_name.'</h3>'; 
                  echo '<span>'.$honors_row->school_organization_name.'</span>'; ?>
                          </li>
                  <?php } ?>

              </ul>            
          </div>
        </div>
      </div>      
    </div>
  </section>
  <?php  } ?>
  
  

  
  <section>
    <div class="milerun">
      <div class="container">
        <div class="row">
        <a class="md-fab md-fab-small md-fab-accent edit_resume" id="edit-skills" href="#">
                      <i class="material-icons">&#xE150;</i>
          </a>  
          <h2>Skills</h2> 
            <div id="canvas">
                <div class="circle" id="circles-1"></div>
                <div class="circle" id="circles-2"></div>
                <div class="circle" id="circles-3"></div>
                <div class="circle" id="circles-4"></div>
                  <div style="display:none;">
                 <span id="percent-1"><?php print_r($technical['percent']); ?></span>
                 <span id="percent-2"><?php print_r($techtical['percent']); ?></span>
                 <span id="percent-3"><?php print_r($physical['percent']); ?></span>
                 <span id="percent-4"><?php print_r($psyhosocial['percent']); ?></span>
                  </div>
            </div>
            <!--title-->
            <div class="row">
              <div class="canvascontent">
                <span>Technical</span>
                <span>Tactical</span>
                <span>Physical</span>
                <span>Psyhosocial</span>
              </div>
            </div>
            <script src="<?php echo base_url(); ?>js/circles.js"></script>
            <script>
    var colors = [
        ['#D3B6C6', '#4B253A'], ['#FCE6A4', '#EFB917'], ['#BEE3F7', '#45AEEA'], ['#F8F9B6', '#D2D558'], ['#F4BCBF', '#D43A43']
      ],
      circles = [];

    for (var i = 1; i <= 4; i++) {
      var child = document.getElementById('circles-' + i);                   
      var percentage = $("#percent-"+i).text();;
        
        circle = Circles.create({
          id:         child.id,
          value:      percentage,
          radius:     getWidth(),
          width:      20,
          colors:     colors[i - 1]
        });

      circles.push(circle);
    }

    window.onresize = function(e) {
      for (var i = 0; i < circles.length; i++) {
        circles[i].updateRadius(getWidth());
      }
    };

    function getWidth() {
      return window.innerWidth / 13;
    }

  </script>

                           
            </div>
          </div>
        </div>
      </div>      
    </div>
  </section>

  <?php if($record){ ?>
  <section>
    <div class="gym">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
          <h2>Records</h2> 
            <a class="md-fab md-fab-small md-fab-accent edit_resume" id="edit-record" href="#">
                <i class="material-icons">&#xE150;</i>
            </a>  
          </div>
          </div>
          <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">         
            <ul>
              <li>
                <div class="sports">
                  <div class="sports_img">
                    <img src="<?php echo base_url(); ?>images/sprinting.png">
                  </div>
                  <div class="sports_content">
                    <h3>30 meters sprint</h3>
                   <p><?php echo $record->run_30.' sec';?></p>
                  </div>
                </div>
              </li>
              <li>
                <div class="sports">
                  <div class="sports_img">
                    <img src="<?php echo base_url(); ?>images/sprinting.png">
                  </div>
                  <div class="sports_content">
                    <h3>100 meters sprint</h3>
                   <p><?php echo $record->run_100.' sec';?></p>
                  </div>
                </div>
              </li>
              <li>
                <div class="sports">
                  <div class="sports_img">
                    <img src="<?php echo base_url(); ?>images/sprinting.png">
                  </div>
                  <div class="sports_content">
                    <h3>One Mile Run</h3>
                   <p><?php echo $record->one_mile.' min';?></p>
                  </div>
                </div>
              </li>
              <li>
                <div class="chest">
                  <div class="chest_img">
                    <img src="<?php echo base_url(); ?>images/chest.png">
                  </div>
                  <div class="chest_content">
                    <h3>max bench press/reps</h3>
                    <p><?php echo $record->max_bench; ?></p>
                  </div>
                </div>
              </li>
              <li>
                <div class="sports">
                    <div class="sports_img">
                        <img src="<?php echo base_url(); ?>images/backflip.png">
                    </div>
                    <div class="sports_content">
                        <h3>vertical jump</h3>
                        <p><?php echo $record->vertical_jump." inches"; ?></p>
                    </div>                     
                </div>
              </li>
              <li>
                <div class="chest">
                  <div class="chest_img">
                    <img src="<?php echo base_url(); ?>images/hurdle.png">
                  </div>
                  <div class="chest_content">
                    <h3>horizontal jump</h3>
                    <p><?php echo $record->horizontal_jump." inches"; ?></p>
                  </div>
                </div>
              </li>
            </ul>
          </div>          
        </div>        
      </div>
    </div>
  </section>

  <?php } ?>
  <section>
    <div class="languges">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="objectives">            
              <h2>languages</h2>
              <a class="md-fab md-fab-small md-fab-accent edit_resume" id="edit-languages" href="#">
                      <i class="material-icons">&#xE150;</i>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="col-xs-2 col-sm-12 col-md-2 lang_y">              
              <ul class="graph">
                <?php 
                if($language_data){
                  foreach ($language_data as $row) { 
                    $l=$row->level; 
                    $percent = $l*20;
                  ?>
                  <li> <?php print_r(ucwords($row->language));?></li>
                     <?php    }  }?>
              </ul>
            </div>
            <div class="col-xs-10 col-sm-12 col-md-10 lang_x">
              <ul class="graph">              

                <?php 
                if($language_data){
                  foreach ($language_data as $row) { 
                    $l=$row->level; 
                    $percent = $l*20;
                  ?>

                 <li class="percent<?php echo $percent; ?>" style="width:<?php echo $percent; ?>%" >
                 <span class="language_content" style="display:none"> <?php  print_r(ucwords($row->language));?> </span>
                  <span><?php //echo $percent; ?></span>
                </li>               
                     
               <?php    }  }?>
               </ul> 
           
            </div>
            <div class="col-xs-3 col-sm-12 col-md-3">  
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9">
                 <ul class="percent_x">
                 <?php  for($i=1; $i <=5 ; $i++) { ?>               
                      <li class="per_<?php echo $i; ?>"><?php echo $i*20; ?>% </li>
                 <?php } ?>
               </ul> 
            </div>

          </div>
          <br>
         
        </div>        
      </div>      
    </div>
  </section>
 <?php if($reference){ ?>
  <section>
    <div class="resume_reference">
        <div class="container">
         <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="objectives">            
              <h2>References</h2>
              <a class="md-fab md-fab-small md-fab-accent edit_resume" id="edit-reference" href="#">
                      <i class="material-icons">&#xE150;</i>
            </a>
            </div>
          </div>

                          
                    <?php foreach($reference as $key=>$value) { ?>
                      <div class="col-xs-12 col-sm-12 col-md-6 refer"> 
                    <ul>
                      <li><blockquote><?php echo $value->comment;?> </blockquote></li> 
                      <li>
                        <span class="orgnization"><?php echo $value->organization; ?></span><br>
                        <span><?php echo $value->full_name.'('.$value->full_time_occupation.')';?> </span>
                      </li>
                  </ul>
                </div>
                  <?php } ?>
                    <?php if(isset($asked_ref) && ($asked_ref!='')){

                      foreach ($asked_ref as $key => $row) {                       
                          echo "<div class=\"col-xs-12 col-sm-12 col-md-6 refer\"><ul> ";                          
                          echo "<li><blockquote>".$row->comment."</blockquote></li>"; 
                          echo "<li><span class=\"organization\">". ucwords($row->organization)."</span><br>";
                          echo "<span class=\"md-list-heading\">".ucwords($row->name)."(".$row->occupation.")</span></li> </ul></div>";
                      }
                  }  ?>
             
                     
        </div>
      </div>
    </div>
</section>

<?php  }
if($event_detail) {?>
<section>
  <div class="languges">
  <div class="container">
     <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="objectives"> 
              <h2>Schedule</h2>
          </div>
         </div>

          <div class="col-xs-12 col-sm-12 col-md-12">
               <div class="timeline">
          <?php foreach ($event_detail as  $event) { ?>               
                
               <div class="timeline_item">
                    <div class="timeline_icon timeline_icon_success"><i class="material-icons">&#xE85D;</i></div>
                        <div class="timeline_date">
                              <?php $event_start_ary=$event->wgp_event_start; 
                                  $evt_ary = explode(' ', $event_start_ary);
                                     $event_full_date =$evt_ary[0];
                                     $event_time =$evt_ary[1];

                                     $event_arry = explode('-', $event_full_date);
                                     $event_date = $event_arry[0];
                                     $event_month = $event_arry[1];

                              ?> <?php echo $event_date;?><span><?php echo $event_month;?></span>
                              </div>
                          <div class="event_detail"> <?php echo ucwords($event_name =$event->wgp_event_name); ?>, 
                                <span><i><?php 
                                        $date = new DateTime($event_time);
                                      echo $date->format('h:i A') ;
                                ?></i> </span></div>
                   </div>


      <?php }?>

             </div>  
              


         </div>
     </div>
  </div>
</div>
</section>
 <?php } ?>
  
  <footer>
    <div class="foot">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="social-foot">
              <ul>                
                <li><button type="button" class="btn btn-primary adept-md-btn-primary btn-md" onclick="printDiv('resume_print')"><i class="material-icons md-24 md-light">&#xE8AD;</i> Resume</button></li>
              </ul>              
            </div>
          </div>        
        </div>
      </div>
    </div>
  </footer>

</div>
<?php } else{
          echo "<div class=\"md-card-content\">";
          echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">For PRO and PLUS Account! Update your account type for view this feature.</h3>";
          echo '<a href="'.base_url().'pricing/" target="_blank" class="uk-badge">Upgrade</a></div>';
        } ?>

<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>

<script>

 $("#edit-personal").click(function(){
      $("#personal_tab").trigger("click");
 }); 

 $("#edit-experince").click(function(){
      $("#atheletics_tab").trigger("click");
 });

 $("#edit-honor").click(function(){
      $("#academics_tab").trigger("click");
 }); 

 $("#edit-skills").click(function(){
      $("#atheletics_tab").trigger("click");
 });

$("#edit-record").click(function(){
    $("#atheletics_tab").trigger("click");
 });

$("#edit-languages").click(function(){
  $("#academics_tab").trigger("click");
});
$("#edit-reference").click(function(){
  $("#references_tab").trigger("click");
});


  
 

 

 
 
</script>
