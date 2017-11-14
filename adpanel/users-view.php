<?php 

session_start();
include 'core/config.php';
include 'core/functions.php';
if(admin_login_check($mysqli) == true) {

	$active="users";
	
	$info = "";
	$error = "";

	$id="";
	if(!empty($_GET['id'])){$id=mysqli_real_escape_string($mysqli, $_GET['id']);}
	if(!$id){ header("Location:".$site_url."/users/list/"); exit();}
	
	
	if(isset($_POST['FormSubmit'])){
		extract($_POST);
		$check['name']=$_POST['name'];
		$check['username']=$_POST['username'];
		$check['email']=$_POST['email'];
		$error = IfEmpty($check);
		if($error){
			echo $error;
		} else {
			if(!empty($_POST['password'])){
				$_POST['password'] = md5($_POST['password']);
			} else {
				unset($_POST['password']);
			}
			$insert_data = mysql_update_array('admin', $_POST, $id, array('FormSubmit'));
			if($insert_data['mysqli_error']==false){
				
				$info = "User updated successfully!";
				
			} else {
				$error = $insert_data['mysqli_error'];
			}
			
		}
	}
	
	
	$query = "SELECT * FROM admin WHERE id='$id'";
	$result=mysqli_query($mysqli,$query);
	$row = mysqli_fetch_assoc($result);
	
	include("template/header.html");
	include("template/users-view.html");
	include("template/footer.html");

}
else {
	
	$length = 200;
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	header("Location:login.php?ref=".$actual_link);
}

?>