<?php
ob_start();									  

require_once "dompdf_config.inc.php";
$dompdf = new DOMPDF();
$dompdf->set_paper("A4");

$vehicle_id = $_REQUEST['vehicle_id'];
$vehicle_id = base64_decode($vehicle_id);

$email = $_REQUEST['email'];
$email = base64_decode($email);

$Url = 'http://autosist.com/portal/PDF/pdf.php?vehicle_id='.$vehicle_id.'&email='.$email.'';

$Html2 = file_get_contents($Url); 

$dompdf->load_html($Html2);
$dompdf->render(); 
$dompdf->stream("AUTOsistReceiptHistoryReport.pdf");

//header("Location: http://adept-testing.com/invoicenew/invoice/view_advance_payment/".base64_encode($invoiceID)."/send");
exit();




?>