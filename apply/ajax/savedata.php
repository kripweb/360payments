<?php 
	session_start();
	require_once('config.php');

	$user_id = $_SESSION['user_id'];
	$cid = $_SESSION['cid'];
	
	//Update value 
	if(isset($_POST) && $user_id){
		$question = mysqli_real_escape_string($mysqli, $_POST['question']);
		$answer = mysqli_real_escape_string($mysqli, $_POST['answer']);
		
		if($question){
			$coloumnname = "q".$question;
			$update="UPDATE user_answers SET ".$coloumnname."='$answer' WHERE id='$user_id'";
			$update=mysqli_query($mysqli, $update) OR die(mysqli_error($mysqli));
			
			/*
			$update="UPDATE users_form SET cid='$question' WHERE id='$user_id'";
			$update=mysqli_query($mysqli, $update);
			*/
			
			echo "$user_id:$coloumnname:$answer";
			
		}
	}

?>