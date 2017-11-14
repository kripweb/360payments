<?php 

session_start();
include 'core/config.php';
include 'core/functions.php';
if(admin_login_check($mysqli) == true) {
	$id="";
	if(!empty($_GET['id'])){$id=mysqli_real_escape_string($mysqli, $_GET['id']);}
	if(!$id){ header("Location:".$site_url."/applications/"); exit();}
	
	$_SESSION['user_id']= $id;
	$_SESSION['cid']= 1;
	
	header("Location:https://www.360payments.com/apply/form/");
			
}
?>