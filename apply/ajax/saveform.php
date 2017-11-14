<?php 
	session_start();
	require_once('config.php');

	$user_id = $_SESSION['user_id'];
	$cid = $_SESSION['cid'];
	$error="";
	
	//Update value 
	if(isset($_POST) && $user_id){
		$query = "SELECT * FROM user_answers WHERE id='$user_id'";
		$query = mysqli_query($mysqli, $query);
		$row=mysqli_fetch_assoc($query);
		$id = $row['id'];
		$update_data = mysql_update_array('user_answers', $_POST, $user_id, array('q129', 'q131', 'q133'));
		if($update_data['mysqli_error']==false){
			$error = 1;
		} else {
			$error = $update_data['mysqli_error'];
		}
	}
	
	
	$json= array(
		'error' => $error
	);
	$jsonstring = json_encode($json, JSON_PRETTY_PRINT);
	echo $jsonstring;

?>