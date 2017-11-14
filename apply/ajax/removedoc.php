<?php 
	session_start();
	require_once('config.php');

	$user_id = $_SESSION['user_id'];
	$cid = $_SESSION['cid'];
	$error="";
	
	//Update value 
	if(isset($_POST) && $user_id){
		$id = "q".$_POST['id'];
		$data[$id]="";
		$update_data = mysql_update_array('user_answers', $data, $user_id, array());
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