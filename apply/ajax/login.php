<?php 
session_start();
require_once('config.php');

$error=1;
$error_code="Something went wrong, please try again.";
$cid=1;
if(isset($_POST)){
	$email = mysqli_real_escape_string($mysqli, $_POST['email']);
	$pass = mysqli_real_escape_string($mysqli, $_POST['pass']);
	
	//Check if email exists
	$user_query = "SELECT * FROM users_form WHERE email='$email'";
	$user_query = mysqli_query($mysqli, $user_query);
	$total = mysqli_num_rows($user_query);
	$row = mysqli_fetch_assoc($user_query);
	if($total>0){
		//check if password matches.
		if($row['password']==$pass){
			$error=0;
			$cid = $row['cid'];
			$_SESSION['user_id']=$row["id"];
			
		} else {
			$error_code="The password you have entered is incorrect.";
		}
		
	} else {
		//New email id add to database
		$error=0;
		$date = date("Y-m-d H:i:s");
		$insert = "INSERT INTO users_form (email, password, addedon, cid) VALUES ('$email', '$pass', '$date', '1')";
		$insert = mysqli_query($mysqli, $insert);
		$_SESSION['user_id']= mysqli_insert_id($mysqli);
	}
}

$json= array(
	'error' => $error,
	'error_code' => $error_code,
	'cid' => $cid
);

$jsonstring = json_encode($json, JSON_PRETTY_PRINT);
echo $jsonstring;

mysqli_close($mysqli);
?>