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


$site_url="https://www.360payments.com/apply";


?>
