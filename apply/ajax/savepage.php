<?php 
	session_start();
	require_once('config.php');

	$user_id = $_SESSION['user_id'];
	$cid = $_SESSION['cid'];
	
	//Update value 
	if(isset($_POST) && $user_id){
		$page = mysqli_real_escape_string($mysqli, $_POST['page']);
		
		if($page){
			
			$update="UPDATE users_form SET pid='$page' WHERE id='$user_id'";
			$update=mysqli_query($mysqli, $update);
			
			
		}
	}

?>