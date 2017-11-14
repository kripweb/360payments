<?php 

session_start();
include 'core/config.php';
include 'core/functions.php';

$error="";
$info="";

if(isset($_POST['FormSubmit'])){
	extract($_POST);
	$check['username']=$_POST['username'];
	$check['password']=$_POST['password'];
	$error = IfEmpty($check);
	if($error){
		//echo $error;
	} else {
		$cpassword = md5($password);
		$query = "SELECT * FROM admin WHERE username='$username' AND password='$cpassword'";
		$result=mysqli_query($mysqli,$query);
		$total_record = mysqli_num_rows($result);
		$row=mysqli_fetch_assoc($result);
		if($total_record>0){
			$uid = $row['id'];
			$ip_address = $_SERVER['REMOTE_ADDR'];
			$user_browser = $_SERVER['HTTP_USER_AGENT'];
			$_SESSION['admin_id']=$uid;
			$_SESSION['admin_string']= md5($cpassword.$ip_address.$user_browser);
			$ref=$_GET['ref'];
			if($ref){
			 header("Location:".$ref);  
			 exit();
			}
			else {
			 header("Location:".$site_url."/");  
			 exit();
			}
			
			
		} else {
			$error = "Invalid username or password.";
		}
	}
}

include("template/login.html");

?>