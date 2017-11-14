<?php 

session_start();
include 'core/config.php';
include 'core/functions.php';
if(admin_login_check($mysqli) == true) {

	$active="calculator";
	$title = "Effective rate calculator";
	
	$info = "";
	$error = "";
	
	if(isset($_POST['FormSubmit'])){
		extract($_POST);
		$check['name']=$_POST['name'];
		$check['type']=$_POST['type'];
		$check['ms']=$_POST['ms'];
		$check['tr']=$_POST['tr'];
		$check['fees']=$_POST['fees'];
		$error = IfEmpty($check);
		if($error){
			echo $error;
		} else {
			
			
		}
	}	
	
	$query = "SELECT * FROM merchants WHERE id='1'";
	$results = mysqli_query($mysqli, $query);
	$row = mysqli_fetch_assoc($results);
	$merchant_id = $row['id'];
	$merchant_name = $row['name'];
	$sca = $row['sca'];
	$merchant_id = 1;
	if(!$sca OR $sca<=0) {
		$sca=60;
	}
	
	include("template/header.html");
	include("template/calculator.html");
	include("template/footer.html");

}
else {
	
	$length = 200;
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	header("Location:login.php?ref=".$actual_link);
}

?>