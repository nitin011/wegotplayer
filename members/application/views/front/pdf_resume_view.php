
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Resume</title>
<style>

.canvascontent{
    background-color: #F63;
    color: #FFF;
    display: block;
    float: left;
    font-family: "Roboto";
    font-size: 18px;
    font-weight: 700;
    margin: 0px 0px 0px 15px;
    padding: 15px 0px;
    text-align: center;
    width: 100px;
    text-transform: capitalize;
    box-shadow: 0px 4px 6px 0px rgba(0, 0, 0, 0.16), 0px 2px 10px 0px rgba(0, 0, 0, 0.12);
    border-radius: 5px;
}
.percent_x{
width:100%;
}
.col-md-9 {
    width: 100%;
}
ul {
    margin: 0px;
    padding-left: 20px;
    padding-bottom: 0px;
    color:#999
}
.percent_x li.per_1 {
    text-align: right;
    width: 28%;
}
.percent_x li {
    float: left;
    list-style: outside none none;
}
.percent_x li.per_2 {
    width: 29%;
    text-align: right;
}
.percent_x li.per_3 {
    width: 28%;
    text-align: right;
}
.percent_x li.per_4 {
    width: 28%;
    text-align: right;
}
.percent_x li.per_5 {
    width: 60%;
    text-align: right;
}
.refer ul li {
    list-style: outside none none;
}
.refer ul li blockquote {
    text-align: justify;
}
blockquote {
    border-left: 4px solid rgba(0, 0, 0, 0.086);
}
blockquote {
    padding-left: 15px;
    border-left: 5px solid #DDD;
    font-size: 16px;
    line-height: 22px;
    font-style: italic;
}
address, blockquote, dl, fieldset, figure, ol, p, pre, ul {
    margin: 0px 0px 15px;
}
.refer ul li span {
    padding: 5px;
    font-size: 14px;
    color: #B0B0B0;
    font-family: "Roboto";
    font-weight: 700;
    float: right;
}
.timeline_item {
    position: relative;
    min-height: 64px;
    padding: 16px 0px;
    box-sizing: border-box;
}
.timeline_icon_success {
    background: #7CB342 none repeat scroll 0% 0%;
}
.timeline_date span {
    font-size: 11px;
    display: block;
    text-transform: uppercase;
}
.timeline_icon {
    position: absolute;
    left:50px;
    top: 16px;
    height: 44px;
    width: 44px;
    border-radius: 50%;
    background: #9E9E9E none repeat scroll 0% 0%;
    text-align: center;
    border: 4px solid #FFF;
}
.timeline, .timeline *, .timeline *::after, .timeline *::before, .timeline::after, .timeline::before {
    box-sizing: border-box;
}
.timeline_icon .material-icons {
    font-size: 18px;
    line-height: 36px;
    color: #FFF;
}
.material-icons {
    font-family: "Material Icons";
    font-weight: 400;
    font-style: normal;
    font-size: 18px;
    display: inline-block;
    width: 1em;
    height: 1em;
    line-height: 1;
    text-transform: none;
    letter-spacing: normal;
    text-rendering: optimizelegibility;
    font-feature-settings: "liga";
    vertical-align: -4px;
    color: rgba(0, 0, 0, 0.54);
}
.timeline_date {
    float: left;
    min-width: 60px;
    color: #AAA;
    text-align: center;
    line-height: 18px;
    font-size: 16px;
    margin-right: 8px;
    padding-top: 6px;
    margin-left:114px;
}
.event_detail {
    margin-top: 10px;
    padding: 5px 0px 0px;
    color: #AAA;
}
.event_detail span {
    padding: 10px;
}
.social-foot {
    margin: 0px;
    padding: 0px;
}
.social-foot ul {
    float: left;
    list-style: outside none none;
    margin: 0px;
    padding: 20px 0px;
    text-align: center;
    width: 100%;
}
.social-foot ul li {
    margin: 0px;
    padding: 0px 0px 0px 10px;
    display: inline;
}
button.adept-md-btn-primary {
    background: #F47921 none repeat scroll 0% 0% !important;
}
.material-icons.md-light {
    color: #FFF;
}
h1{
    margin:0px; color:#000000; 
    font-size:30px; 
    font-weight:700; 
    font-family:Roboto; 
    padding:10px;
    text-transform: uppercase
}

</style>
</head>
<body>
    <table width="500px" cellpadding="0" cellspacing="0" style="margin:0px auto; border:1px solid #000000; box-shadow:0px 0px 10px #ccc">
    <tr style="padding:10px; background-color:#000000">
        <td width="120" style="padding:10px; vertical-align:top;">
            <img style="width:150px; height:150px;" src="<?php echo $dp_url;?>" alt="Profile Image"/></td>
        <td width="120">
          <h1 style="margin:0px; color:#fff; font-size:20px; font-weight:700; font-family:Roboto;"><?php echo ucwords($name);?></h1>
            <p style="margin:0px; color:#fff; font-size:14px; font-weight:700; font-family:Roboto;"><?php print_r($user_detail->sport);?></p>
            <p style="margin:0px; color:#999999; font-size:12px; font-family:Roboto;"><strong style="color:#fff; font-weight:normal;">Level:</strong><?php print_r($user_detail->level);?></p>
            <p style="margin:0px; color:#999999; font-size:12px; font-family:Roboto;"><strong style="color:#fff; font-weight:normal;">Height:</strong><?php print_r($user_detail->height);?></p>
            <p style="margin:0px; color:#999999; font-size:12px; font-family:Roboto;"><strong style="color:#fff; font-weight:normal;">Hand:</strong><?php print_r($user_detail->hand);?></p>
      <p style="margin:0px; color:#999999; font-size:12px; font-family:Roboto;"><strong style="color:#fff; font-weight:normal;">Seeking:</strong><?php print_r($seeking);?></p></td>
    <td width="120">
      <p style="margin:56px 0px 0px 0px; color:#999999; font-size:12px; font-family:Roboto;"><strong style="color:#fff; font-weight:normal;">Position:</strong><?php print_r($position); ?></p>
            <p style="margin:0px; color:#999999; font-size:12px; font-family:Roboto;"><strong style="color:#fff; font-weight:normal;">Weight:</strong><?php print_r($user_detail->weight);?></p>
            <p style="margin:0px; color:#999999; font-size:12px; font-family:Roboto;"><strong style="color:#fff; font-weight:normal;">Foot:</strong><?php print_r($user_detail->foot);?></p>
            <?php  
                        if($user_detail->graduation_month!=''){
                             $monthNum  = $user_detail->graduation_month;
                              $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                              $monthName = $dateObj->format('F');
                        ?>
      <p style="margin:0px; color:#999999; font-size:12px; font-family:Roboto;"><strong style="color:#fff; font-weight:normal;">HS Graduation:</strong><?php echo $monthName.' '.$user_detail->graduation_year;?></p></td>
          <?php } ?>
        <td width="140">
            <img style="margin-bottom:10px;" src="<?php echo base_url(); ?>images/image-contact.png" alt="Image Contact"/>
      <p style="margin:0px; color:#fff; font-size:12px; font-family:Roboto;"><img style="margin-bottom:-6px; margin-right:10px;" src="<?php echo base_url(); ?>images/icon-address.png" alt="Image Address"/><?php print_r($user_detail->address);?></p>      </td>
  </tr>


     <tr style="background-color:#000000">
        <td style="border-top:1px solid #ccc; margin:0px; padding:10px; color:#7f7f7f; font-size:14px; font-family:Roboto; font-weight:300; vertical-align:top;" colspan="2"><?php echo $personal_info; ?> </td>
        <td style="border-top:1px solid #ccc; margin:0px; padding:10px; color:#7f7f7f; font-size:14px; font-family:Roboto; font-weight:300; vertical-align:top;" colspan="2"><?php echo $objective; ?></td>
    </tr>

   <?php if($stats_details){ ?> 
       <tr bgcolor="#eee">
            <td style="padding:10px" colspan="4"><h1>experince</h1></td>
       </tr>
       <tr bgcolor="#eee">
       <td> &nbsp;</td>
        <?php foreach($stats_details as $value) { ?>
                <?php foreach ($season as $key => $sea) {
                        if($value->season==$key){
                           echo '<td><p style="text-align:center">'.$sea.'</p></td>';
                        }
                      } 
              } ?> 
       
       </tr>
    <?php } ?>
   

<?php if($honors){ ?>
     <tr style="background:#FFFFFF">
        <td colspan="4"><h1>awards</h1></td>
    </tr>
    <tr style="background:#FFFFFF">
     <?php foreach ($honors as  $honors_row) { ?>
    <td style="padding:10px">   
        <img style="width:85px; height:112px; padding:10px; margin-left:20px" src="<?php echo base_url(); ?>images/award-image.png" alt="Award-image">
        <p style="margin:0px; padding:10px; color:#444; font-size:16px; font-family:Roboto; font-weight:700; vertical-align:top;"><?php echo $honors_row->awards_honors_name; ?></p>
        <p style="margin: -22px 4px 0px; padding:10px; color:#CCCCCC; font-size:14px; font-family:Roboto; font-weight:500; vertical-align:top;"><?php echo $honors_row->school_organization_name; ?> </p>
    </td><?php } ?>
   
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<?php } ?>

<tr style="background-color:#eee">
    <td colspan="4" style="padding:10px">
        <h1 style="margin:0px; color:#000000; font-size:30px; font-weight:700; font-family:Roboto; padding:10px;text-transform: uppercase">Skills</h1>
    </td>
</tr>

<tr style="background-color:#eee">   
    <td class="circle" id="circles-1">  
        <span id="percent-1"><?php print_r($technical['percent']); ?></span>
    </td>
    <td class="circle" id="circles-2"> 
        <span id="percent-2"><?php print_r($techtical['percent']); ?></span>
    </td>
    <td class="circle" id="circles-3">
        <span id="percent-3"><?php print_r($physical['percent']); ?></span>
    </td>
    <td class="circle" id="circles-4">
        <span id="percent-4"><?php print_r($psyhosocial['percent']); ?></span>
    </td>   
 
</tr>

  <?php if($record){ ?>
<tr style="background:#FFFFFF">
     <td colspan="4" style="padding:10px">
        <h1 style="margin:0px; color:#000000; font-size:30px; font-weight:700; font-family:Roboto; padding:10px;text-transform: uppercase">Records</h1></td>
</tr>
     <tr bgcolor="#FFFFFF">
        <td style="border-bottom:1px solid #eee">
        <img style="width:60px; height:80px; padding:10px;" src="<?php echo base_url(); ?>images/strong-man.png" alt="tecinical">
        
        </td>
        <td style="border-right:1px solid #eee; border-bottom:1px solid #eee">
            <p style="margin:0px; padding:10px; color:#000000; font-size:16px; text-transform: uppercase; font-family:Roboto; font-weight:700; vertical-align:top;">30 meters sprint</p>
        <p style="margin:0px;color:#07BF69; font-size:25px; font-family:Roboto; font-weight:700; vertical-align:top;"><?php echo $record->run_30.' sec';?></p>
        </td>
        <td style="border-bottom:1px solid #eee">
            <img style="width:60px; height:80px; padding:10px;" src="<?php echo base_url(); ?>images/strong-man.png" alt="tecinical">
       </td>
       <td style="border-bottom:1px solid #eee">
        <p style="margin:0px; padding:10px; color:#000000; font-size:16px; text-transform: uppercase; font-family:Roboto; font-weight:700; vertical-align:top;">100 meters sprint</p>
        <p style="margin:0px;color:#07BF69; font-size:25px; font-family:Roboto; font-weight:700; vertical-align:top;"><?php echo $record->run_100.' sec';?></p>
        </td>
    </tr>
    
    
<tr style="background:#FFFFFF">
    <td style="border-bottom:1px solid #eee">
        <img style="width:60px; height:80px; padding:10px;" src="<?php echo base_url(); ?>images/strong-man.png" alt="tecinical">
    </td>
       
    <td style="border-right:1px solid #eee; border-bottom:1px solid #eee">
        <p style="margin:0px; padding:10px; color:#000000; font-size:16px; text-transform: uppercase; font-family:Roboto; font-weight:700; vertical-align:top;">One Mile Run</p>
        <p style="margin:0px;color:#07BF69; font-size:25px; font-family:Roboto; font-weight:700; vertical-align:top;"><?php echo $record->one_mile.' min';?></p>
   </td>
    <td style="border-bottom:1px solid #eee">
        <img style="width:60px; height:80px; padding:10px;" src="<?php echo base_url(); ?>images/gym.png" alt="gym">
    </td>
    <td style="border-bottom:1px solid #eee">
        <p style="margin:0px; padding:10px; color:#000000; font-size:16px; text-transform: uppercase; font-family:Roboto; font-weight:700; vertical-align:top;">max bench press/reps</p>
        <p style="margin:0px;color:#07BF69; font-size:25px; font-family:Roboto; font-weight:700; vertical-align:top;"><?php echo $record->max_bench; ?></p>
    </td>
</tr>
<tr style="background:#FFFFFF">
    <td style="border-bottom:1px solid #eee">
        <img style="width:60px; height:80px; padding:10px;" src="<?php echo base_url(); ?>images/vertical.png"  alt="vertical">
    </td>
    <td style="border-right:1px solid #eee; border-bottom:1px solid #eee">
        <p style="margin:0px; padding:10px; color:#000000; font-size:16px; text-transform: uppercase; font-family:Roboto; font-weight:700; vertical-align:top;">vertical jump</p>
        <p style="margin:0px;color:#07BF69; font-size:25px; font-family:Roboto; font-weight:700; vertical-align:top;"><?php echo $record->vertical_jump." inches"; ?></p>
    </td>
    <td style="border-bottom:1px solid #eee"><img style="width:60px; height:80px; padding:10px; float:left" src="<?php echo base_url(); ?><?php echo base_url(); ?>images/horizental.png" / alt="horizental">
    </td>
    <td style="border-bottom:1px solid #eee">
    <p style="margin:0px; padding:10px; color:#000000; font-size:16px; text-transform: uppercase; font-family:Roboto; font-weight:700; vertical-align:top;">horizontal jump</p>
    <p style="margin:0px; color:#07BF69; font-size:25px; font-family:Roboto; font-weight:700; vertical-align:top;"><?php echo $record->horizontal_jump." inches"; ?></p>
    </td>
</tr>
<?php } ?>
<?php  if($language_data){ ?>
 <tr style="background-color:#eee">
        <td colspan="4" style="padding:10px">
            <h1 style="margin:0px; color:#000000; font-size:30px; font-weight:700; font-family:Roboto; padding:10px;text-transform: uppercase">languages</h1>
        </td>
</tr>


    <?php 
     if($language_data){
                echo '<tr style="background-color:#eee; width:130px;"><td style="border-right:1px solid #000000;padding:10px 20px;">';
                  foreach ($language_data as $row) { 
                    $l=$row->level; 
                    $percent = $l*20;
                  ?>
          <center><p style="height:20px; background: #07BF69 none repeat scroll 0px 0px; width:100px; text-align:center;padding: 7px; font-weight:700; box-shadow: 0px 4px 6px 0px rgba(0, 0, 0, 0.16), 0px 2px 10px 0px rgba(0, 0, 0, 0.12); border-radius: 5px; color:#FFFFFF">
            <?php print_r(ucwords($row->language));?></p></center>
                     <?php    }  }?>
    
        </td>
        <td colspan="3" style="border-bottom:1px solid #000000">
            <?php 
                if($language_data){
                  foreach ($language_data as $row) { 
                    $l=$row->level; 
                    $percent = $l*20;
                  ?>
           <center><p style="height:20px; background: #07BF69 none repeat scroll 0px 0px; width:<?php echo $percent; ?>%; text-align:center;padding: 7px; font-weight:700; box-shadow: 0px 4px 6px 0px rgba(0, 0, 0, 0.16), 0px 2px 10px 0px rgba(0, 0, 0, 0.12); border-radius: 5px;"></p></center>
            <?php    }  }?>
       </td>
        </tr>
        <tr style="background-color:#eee">
            <td>&nbsp;</td>
            <td colspan="3" style="padding:10px;float:left;">
                  <p style="display:inline;;margin-right:-10px;">0%</p>       
                  <p style="display:inline;margin-left:60px;">20%</p>
                  <p style="display:inline;margin-left:60px;">40%</p>
                  <p style="display:inline;margin-left:60px;">60%</p>
                  <p style="display:inline;margin-left:60px;">80%</p>
                  <p style="display:inline;margin-left:50px;">100%</p>                           
            </td>           
    </tr>

<?php } ?>

<?php if($reference) { ?>
 <tr style="background-color:#FFFFFF;border:1px solid #000000;">
        <td colspan="4" style="padding:10px">
            <h1 style="margin:0px; color:#000000; font-size:30px; font-weight:700; font-family:Roboto; padding:10px;text-transform: uppercase">References</h1></td>
   </tr>

<tr style="background-color:#FFFFFF">
       <?php foreach($reference as $key=>$value) { ?>
       <td height="94" colspan="2" class="refer" style="border:1px solid #CCCCCC; height:80px; box-shadow: 0px 0px 2px;">
        <ul>
             <li><blockquote><?php echo $value->comment;?> </blockquote></li> 
              <li><span><?php echo $value->full_name.'('.$value->full_time_occupation.')';?></span></li>
       </ul>
       </td>
       <?php } ?>
</tr>
<tr style="background-color:#FFFFFF;border:1px solid #000000;">
     <?php if(isset($asked_ref) && ($asked_ref!='')){
            foreach ($asked_ref as $key => $row) { ?>
             <td height="94" colspan="2" class="refer" style="border:1px solid #CCCCCC; height:80px; box-shadow: 0px 0px 2px;">
        <ul>
             <li><blockquote> <?php echo $row->comment;?> </blockquote></li>  
               <li><span>   <?php echo ucwords($row->name)."(".$row->occupation.")";?></span></li>
                 
        </ul>
     </td>
        <?php  } } ?>
    </tr>

 <?php } 

  if($event_detail) { ?>

<tr style="background-color:#eee">
    <td colspan="4" style="padding:20px"><h1 style="margin:0px; color:#000000; font-size:30px; font-weight:700; font-family:Roboto; padding:10px;text-transform: uppercase">Schedule</h1></td>
</tr>

<?php foreach ($event_detail as  $event) { ?>   
<tr>
  <td colspan="4">
    
           <?php $event_start_ary=$event->wgp_event_start; 
                  $evt_ary = explode(' ', $event_start_ary);
                     $event_full_date =$evt_ary[0];
                     $event_time =$evt_ary[1];

                     $event_arry = explode('-', $event_full_date);
                     $event_date = $event_arry[0];
                     $event_month = $event_arry[1];

              ?> <?php echo $event_date;?><span><?php echo $event_month;?></span>
                             
                          <?php echo ucwords($event_name =$event->wgp_event_name); ?>, 
                          <span><i><?php $date = new DateTime($event_time);
                                          echo $date->format('h:i A') ;?>
                        </i> </span>
             

 </td>
</tr>

<?php }  }?>

</table>
    

</body>
</html>