<?
$account="ddistenfield@360payments.com";
$password="US.army.28";
$to="kripweb.in@gmail.com";
$email_1 = "prasanna.n4u@gmail.com";
$from="noreply@360payments.com";
$from_name="360 payments Sendgrid";
$msg="<strong>How are you today? Sendgrid.</strong>"; // HTML message
$subject="Hi, This is smtp test for sendgrid.";
/*End Config*/

include("phpmailer/class.phpmailer.php");
$mail = new PHPMailer();
//$mail->IsSMTP();
$mail->CharSet = 'UTF-8';
$mail->Host = "smtp.sendgrid.net";
$mail->SMTPAuth= true;
$mail->Port = 587;
$mail->Username= $account;
$mail->Password= $password;
$mail->SMTPSecure = 'tls';
$mail->From = $from;
$mail->FromName= $from_name;
$mail->isHTML(true);
$mail->Subject = $subject;
$mail->Body = $msg;
$mail->addAddress($to);
$mail->AddCC($email_1);
if(!$mail->send()){
 echo "Mailer Error: " . $mail->ErrorInfo;
}else{
 echo "E-Mail has been sent";
}
?>
