<?php 
	session_start();
	require_once('config.php');

	$user_id = $_SESSION['user_id'];
 
	if(isset($_POST) && $user_id){
		extract($_POST);
		//check if email already exists.
		$query="SELECT COUNT(id) AS num FROM contactinfo WHERE user_id='$user_id' AND email='$email'";
		$query = mysqli_query($mysqli, $query);
		$row = mysqli_fetch_assoc($query);
		$total = $row['num'];
		if($total<=0){
			
			$insert = "INSERT INTO contactinfo (user_id, name, title, email) VALUES ('$user_id', '$name', '$title', '$email')";
			$insert = mysqli_query($insert);
			
		}
	}

?>