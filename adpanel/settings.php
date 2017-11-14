<?php 

session_start();
include 'core/config.php';
include 'core/functions.php';
if(admin_login_check($mysqli) == true) {

	$active="";
	$title="Settings";
	
	if(isset($_POST['FormSubmit'])){
		extract($_POST);
		$check['password']=$_POST['password'];
		$error = IfEmpty($check);
		if($error){
			echo $error;
		} else {
			if(!empty($_POST['password'])){
				$_POST['password'] = md5($_POST['password']);
			} else {
				unset($_POST['password']);
			}
			$insert_data = mysql_update_array('admin', $_POST, $admin_row['id'], array('FormSubmit'));
			if($insert_data['mysqli_error']==false){
				
				$info = "Record updated successfully!";
				
			} else {
				$error = $insert_data['mysqli_error'];
			}
			
		}
	}
	
	
	
	include("template/header.html");
	include("template/settings.html");
	include("template/footer.html");

}
else {
	
	$length = 200;
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	header("Location:".$site_url."/login/");
}

?>