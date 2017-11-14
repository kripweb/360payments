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



$site_url="https://www.360payments.com";

/*
$setting_query = "SELECT * FROM settings";
$setting_query=mysqli_query($mysqli,$setting_query);
$setting_row = mysqli_fetch_assoc($setting_query);
//print_r($setting_row);
*/
$setting_row['email_from_name'] = "360 Payments";
$setting_row['email_from_email'] = "noreply@360payments.com";

//Email Headers
$eheaders  = "From: ".$setting_row['email_from_name']." < ".$setting_row['email_from_email']." >\n"; 
$eheaders .= "Reply-To:< ".$setting_row['email_from_email']." >\r\n";
$eheaders .= "X-Sender: ".$setting_row['email_from_name']." < ".$setting_row['email_from_email']." >\n";
$eheaders .= 'X-Mailer: PHP/' . phpversion();
$eheaders .= "X-Priority: 1\n"; // Urgent message!
$eheaders .= "Return-Path: ".$setting_row['email_from_email']."\n"; // Return path for errors
$eheaders .= "MIME-Version: 1.0\r\n";
$eheaders .= "Content-Type: text/html; charset=iso-8859-1\n";


function mysql_update_array($table, $data, $id, $exclude = array()) {
	Global $mysqli;

    if( !is_array($exclude) ) $exclude = array($exclude);
	$query ='';
	$i=1;
    foreach( array_keys($data) as $key ) {
        if( !in_array($key, $exclude) ) {
			if($i==1){
				$query.=$key."='" . mysqli_real_escape_string($mysqli, $data[$key]) . "'";
			} else {
				$query.=", ".$key."='" . mysqli_real_escape_string($mysqli, $data[$key]) . "'";
			}
            $i++;
        }
    }

    if( mysqli_query($mysqli, "UPDATE `$table` SET $query WHERE id='$id'") ) {
        return array( "mysqli_error" => false,
                      "mysqli_insert_id" => mysqli_insert_id($mysqli),
                      "mysqli_affected_rows" => mysqli_affected_rows($mysqli),
                      "mysqli_info" => mysqli_info($mysqli),
					  "query" => $query,
                    );
    } else {
        return array( "mysqli_error" => mysqli_error($mysqli) );
    }
}


function mysql_insert_array($table, $data, $exclude = array()) {
	Global $mysqli;
    $fields = $values = array();
    if( !is_array($exclude) ) $exclude = array($exclude);
    foreach( array_keys($data) as $key ) {
        if( !in_array($key, $exclude) ) {
            $fields[] = "`$key`";
            $values[] = "'" . mysqli_real_escape_string($mysqli, $data[$key]) . "'";
        }
    }
    $fields = implode(",", $fields);
    $values = implode(",", $values);
    if( mysqli_query($mysqli, "INSERT INTO `$table` ($fields) VALUES ($values)") ) {
        return array( "mysqli_error" => false,
                      "mysqli_insert_id" => mysqli_insert_id($mysqli),
                      "mysqli_affected_rows" => mysqli_affected_rows($mysqli),
                      "mysqli_info" => mysqli_info($mysqli)
                    );
    } else {
        return array( "mysqli_error" => mysqli_error($mysqli) );
    }
}



// SENDGRID API KEY
$sgapiKey = '';
?>
