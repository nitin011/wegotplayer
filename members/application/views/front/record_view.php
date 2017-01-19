<h4>Records </h4>

<?php if(!empty($record)){ ?>
<div class="inner">
    <ul>
       <li><b>30 meters sprint</b><i>:</i>
           <span><?php echo $record->run_30.' sec';?></span>
       </li>
       <li><b>100 meters sprint</b><i>:</i>
           <span><?php echo $record->run_100.' sec';?></span>
       </li>
       <li><b>One Mile Run </b><i>:</i>
           <span><?php echo $record->one_mile.' min';?></span>
       </li>
       <li><b>Max Bench press/reps</b><i>:</i>
           <span><?php echo $record->max_bench; ?></span>
       </li>
       <li><b>Vertical Jump </b><i>:</i>
           <span><?php echo $record->vertical_jump." inches"; ?></span>
       </li>
       <li><b>Horizontal Jump </b><i>:</i>
           <span><?php echo $record->horizontal_jump." inches"; ?></span>
       </li>
     </ul>
</div>


<?php } else{ 
 echo "<h3 class=\"heading_b heading_b_c uk-margin-bottom\">Data Not Avilable</h3>";

}?>