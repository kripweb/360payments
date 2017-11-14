<?php 

session_start();
include 'core/config.php';
include 'core/functions.php';
if(admin_login_check($mysqli) == true) {

	$active="calculator";
	$title="Merchants List";
	
	$info="";
	$error="";
	
	$task = "";
	$id="";
	if(!empty($_GET['task'])){$task=mysqli_real_escape_string($mysqli, $_GET['task']);}
	if(!empty($_GET['id'])){$id=mysqli_real_escape_string($mysqli, $_GET['id']);}

	if($task=='delete' && $id && $id!=1){
		$del = "DELETE FROM merchants WHERE id='$id'";
		$del = mysqli_query($mysqli, $del);
		
		$del = "DELETE FROM merchants_rates WHERE merchants_id='$id'";
		$del = mysqli_query($mysqli, $del);
		
		header("Location:".$site_url."/partners/list/");
	}
	
	
	
	include("template/header.html");
	include("template/merchants-list.html");
	include("template/footer.html");

}
else {
	
	$length = 200;
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	header("Location:".$site_url."/login/");
}

?>