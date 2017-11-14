<?php 

session_start();
include 'core/config.php';
include 'core/functions.php';
if(admin_login_check($mysqli) == true) {

	$active="users";
	$title="Users List";
	
	$info="";
	$error="";
	
	$task = "";
	$id="";
	if(!empty($_GET['task'])){$task=mysqli_real_escape_string($mysqli, $_GET['task']);}
	if(!empty($_GET['id'])){$id=mysqli_real_escape_string($mysqli, $_GET['id']);}

	if($task=='delete' && $id){
		$del = "DELETE FROM admin WHERE id='$id'";
		$del = mysqli_query($mysqli, $del);
		
		header("Location:".$site_url."/users/list/");
	}
	
	include("template/header.html");
	include("template/users-list.html");
	include("template/footer.html");

}
else {
	
	$length = 200;
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	header("Location:".$site_url."/login/");
}

?>