<?php 

session_start();
include 'core/config.php';
include 'core/functions.php';
if(admin_login_check($mysqli) == true) {

	$active="calculator";
	
	$info = "";
	$error = "";

	$id="";
	if(!empty($_GET['id'])){$id=mysqli_real_escape_string($mysqli, $_GET['id']);}
	if(!$id){ header("Location:".$site_url."/partners/list/"); exit();}
	
	
	$task = "";
	$tid="";
	if(!empty($_GET['task'])){$task=mysqli_real_escape_string($mysqli, $_GET['task']);}
	if(!empty($_GET['tid'])){$tid=mysqli_real_escape_string($mysqli, $_GET['tid']);}
	
	
	if($task=='delete' && $tid){
		
		$del = "DELETE FROM merchants_rates WHERE id='$tid'";
		$del = mysqli_query($mysqli, $del);
		
		header("Location:".$site_url."/partners/view/".$id."/");
	}
	
	if(isset($_POST['FormSubmit'])){
		extract($_POST);
		$check['name']=$_POST['name'];
		$check['url']=$_POST['url'];
		$check['sca']=$_POST['sca'];
		$error = IfEmpty($check);
		if($error){
			echo $error;
		} else {
			
			$e_query = "SELECT * FROM admin WHERE id='$executive'";
			$e_query = mysqli_query($mysqli, $e_query);
			$e_row=mysqli_fetch_array($e_query);
			
			$_POST['exe_id'] = $e_row['id'];
			$_POST['exe_name'] = $e_row['name'];
			$_POST['emails'] = $e_row['email'];
			$insert_data = mysql_update_array('merchants', $_POST, $id, array('FormSubmit', 'executive'));
			if($insert_data['mysqli_error']==false){
				
				$info = "Record updated successfully!";
				
			} else {
				$error = $insert_data['mysqli_error'];
			}
			
		}
	}
	
	
	if(isset($_POST['ChargeSubmit'])){
		extract($_POST);
		$check['code']=$_POST['code'];
		$check['description']=$_POST['description'];
		$check['charge']=$_POST['charge'];
		$error = IfEmpty($check);
		if($error){
			echo $error;
		} else {
			$_POST['merchants_id'] = $id;
			$insert_data = mysql_insert_array('merchants_rates', $_POST, array('ChargeSubmit'));
			if($insert_data['mysqli_error']==false){
				
				$info = "Record added successfully!";
				
			} else {
				$error = $insert_data['mysqli_error'];
			}
			
		}
	}
	
	
	if(isset($_POST['DeleteSubmit'])){
		foreach ($_POST['makesd'] as $aid) {
		     $del = "DELETE FROM merchants_rates where id='$aid'";
			 $del = mysqli_query($mysqli, $del);
		}
		header("Location:".$site_url."/partners/view/".$id."/");
		
	}
	
	
	
	
	$query = "SELECT * FROM merchants WHERE id='$id'";
	$result=mysqli_query($mysqli,$query);
	$row = mysqli_fetch_assoc($result);
	
	include("template/header.html");
	include("template/merchants-view.html");
	include("template/footer.html");

}
else {
	
	$length = 200;
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	header("Location:login.php?ref=".$actual_link);
}

?>