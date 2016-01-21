<?php

/**
 * @author Le Duc Cuong
 * @copyright 2010
 */

$to      = 'duccuong0205@yahoo.com';
$subject = 'The test mail';
$message = 'Hi Le Duc Cuong';
$headers = 'From: nguyen.cuong@mwc.vn' . "\r\n" .
    'Reply-To: nguyen.cuong@mwc.vn' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if(mail($to, $subject, $message, $headers)){
    echo "Send!";
}
else{
    echo "No send!";    
}
?>