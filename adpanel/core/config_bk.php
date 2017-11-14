<?php
//Connect to database


$dbhost = "localhost";
$dbuser = "kripweb";
$dbpass = "krip1234@";
$dbname = "360p_applications";

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
mysqli_set_charset($mysqli, "utf8");

//Set timezone
date_default_timezone_set("America/Los_Angeles");


$site_url="https://www.360payments.com/adpanel";

$setting_row['email_from_name'] = "360 Payments";
$setting_row['email_from_email'] = "noreply@360payments.com";
$eheaders  = "From: ".$setting_row['email_from_name']." < ".$setting_row['email_from_email']." >\n"; 
$eheaders .= "Reply-To:< ".$setting_row['email_from_email']." >\r\n";
$eheaders .= "X-Sender: ".$setting_row['email_from_name']." < ".$setting_row['email_from_email']." >\n";
$eheaders .= 'X-Mailer: PHP/' . phpversion();
$eheaders .= "X-Priority: 1\n"; // Urgent message!
$eheaders .= "Return-Path: ".$setting_row['email_from_email']."\n"; // Return path for errors
$eheaders .= "MIME-Version: 1.0\r\n";
$eheaders .= "Content-Type: text/html; charset=iso-8859-1\n";

// SENDGRID API KEY
$sgapiKey = '';

?>
