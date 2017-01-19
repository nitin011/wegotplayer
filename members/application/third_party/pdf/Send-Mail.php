<?php
ob_start();
ini_set('memory_limit', '-1');
require_once "dompdf_config.inc.php";
//Database Coonection

//Database Coonection
mysql_connect("localhost","autosist_desktop","AutoSis&1?$") or die ("Could not connect to server");
mysql_select_db("autosist_test_autosist_webapp_desktop") or die("database is not connected");
 
 $dompdf = new DOMPDF();
 $MailSendTo = $_REQUEST['send_to'];

 $MailSubject = 'AUTOsist Receipt History Report';
 $MailMsg = ' ';
 
 $vehicle_id = $_REQUEST['vehicle_id'];
 $vehicle_id = base64_decode($vehicle_id);

 $email = $_REQUEST['email'];
 $email = base64_decode($email);
 



 

// SEND MAIL
if( $_REQUEST['send_to'] )
{

$Url = 'http://autosist.com/portal/PDF/pdf.php?vehicle_id='.$vehicle_id.'&email='.$email.'';

$Html2 = file_get_contents($Url); 
$dompdf->load_html($Html2);
$dompdf->render(); 
$output = $dompdf->output();

$FileName = "AUTOsistReceiptHistoryReport.pdf";
$file_to_save = "uploads/".$FileName."";

file_put_contents($file_to_save, $output);

$my_file = $FileName;
$my_path = $_SERVER['DOCUMENT_ROOT']."/portal/PDF/uploads/";
$my_name = "AUTOsist";
$my_mail = $email;
$my_replyto = $email;
$my_subject = $MailSubject;
$my_message = $MailMsg;

$Result = mail_attachment($my_file, $my_path, $MailSendTo, $my_mail, $my_name, $my_replyto, $my_subject, $my_message);
 
 if( $Result == 1 ){
 
  header("Location: http://autosist.com/portal/home/index/".$vehicle_id."/send");
  }else{
  header("Location: http://autosist.com/portal/home/index/".$vehicle_id."/error");
  }


}



 
// MAIL SCRIPT
function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
    $file = $path.$filename;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid  = md5(uniqid(time()));
    $name = basename($file);
    $header  = "From: ".$from_name." <".$from_mail.">\r\n";
    $header .= "Reply-To: ".$replyto."\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $header .= $message."\r\n\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
    $header .= $content."\r\n\r\n";
    $header .= "--".$uid."--";
	
	
	
    if (mail($mailto, $subject, "", $header)) {
		
       return(1); 
    } else {
        return(2);
    }
}
////////////////////////////////////

?>