<?php 

session_start();
include 'core/config.php';
include 'core/functions.php';
if(admin_login_check($mysqli) == true) {

	$active="users";
	$title="Users Add";
	
	$info="";
	$error="";
	
	if(isset($_POST['FormSubmit'])){
		extract($_POST);
		$check['name']=$_POST['name'];
		$check['password']=$_POST['password'];
		$check['email']=$_POST['email'];
		$error = IfEmpty($check);
		if($error){
			echo $error;
		} else {
			$_POST['username']=$_POST['email'];
			$_POST['password'] = md5($_POST['password']);
			$insert_data = mysql_insert_array('admin', $_POST, array('FormSubmit'));
			if($insert_data['mysqli_error']==false){
				
				$info = "User added successfully!";
				
			} else {
				
				$error = $insert_data['mysqli_error'];
			}
			
		}
	}	
	
	
	include("template/header.html");
	include("template/users-add.html");
	include("template/footer.html");

}
else {
	
	$length = 200;
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	header("Location:".$site_url."/login/");
}

?>