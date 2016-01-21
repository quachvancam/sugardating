<?php
/**
 * @author Le Duc Cuong
 * @copyright 2010
 */
 /*
ini_set("SMTP","smtp.unoeuro.com");
$to      = 'nguyen.cuong@mwc.vn';
$subject = 'The subject';
$message = 'Hello';
$headers = 'From: duccuong0205@yahoo.com' . "\r\n" .
    'Reply-To: duccuong0205@yahoo.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    
$send = mail($to, $subject, $message, $headers);
if($send){
    echo "Sended";
}else{
    echo "Error";
}
*/
//define('DIR_MAILER', 'var/www/vhosts/sugardating.dk/httpdocs/mail/');
//echo "Dau tien";

require_once('class.phpmailer.php');
$mail = new PHPMailer(); // defaults to using php "mail()"
$mail->Host = 'smtp.unoeuro.com';
$mail->Port = 25;            
$mail->SMTPAuth = true;
$mail->SMTPDebug = 2;
$mail->IsSMTP();
 
$mail->IsSendmail(); // telling the class to use SendMail transport

$body             = 'Test mail ne. Kaka';

$mail->AddReplyTo("duccuong0205@yahoo.com","Le Cuong");
$mail->SetFrom('duccuong0205@yahoo.com', 'Le Cuong');


$address = "nguyen.cuong@mwc.vn";

$mail->AddAddress($address, "Cuong MWC");

$mail->Subject    = "PHPMailer Test Subject Le Duc Cuong";
 
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

//$mail->AddAttachment("images/phpmailer.gif");      // attachment

if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
?>