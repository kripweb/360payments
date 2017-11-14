<?php
session_start();
include '../core/config.php';
include '../core/functions.php';


if(isset($_POST)){
	extract($_POST);
	if($status && $id){
		$update = "Update user_answers SET status='$status' WHERE id='$id'";
		$update = mysqli_query($mysqli, $update);
	}
	
}


?>