<?php 

session_start();
include 'core/config.php';
include 'core/functions.php';
if(admin_login_check($mysqli) == true) {

	$active="calculator";
	$title="Merchants Add";
	
	$info="";
	$error="";
	
	if(isset($_POST['FormSubmit'])){
		extract($_POST);
		$check['name']=$_POST['name'];
		$check['url']=$_POST['url'];
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
			$insert_data = mysql_insert_array('merchants', $_POST, array('FormSubmit', 'executive'));
			if($insert_data['mysqli_error']==false){
				
				//INSERT DEFAULT RECORDS.
				$query = "SELECT * FROM merchants_rates WHERE merchants_id='1'";
				$results = mysqli_query($mysqli, $query);
				$id = $insert_data['mysqli_insert_id'];
				while($row = mysqli_fetch_array($results)){
					$data=array();
					$data['merchants_id']=$id;
					$data['code']=$row['code'];
					$data['description']=$row['description'];
					$data['charge']=$row['charge'];
					$new_data = mysql_insert_array('merchants_rates', $data, array(''));
				}
				
				$info = "Partner added successfully!";
				
			} else {
				$error = $insert_data['mysqli_error'];
			}
			
		}
	}	
	
	
	include("template/header.html");
	include("template/merchants-add.html");
	include("template/footer.html");

}
else {
	
	$length = 200;
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	header("Location:".$site_url."/login/");
}

?>