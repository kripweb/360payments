<?php

	session_start();
	include '../core/config.php';
		
	$url="calculator";
	$title="Effective Rate Calculator";
	$description="Effective Rate Calculator";
	
	$merchant = "";
	$merchant_id = "";
	
	if(!empty($_GET['m'])){ $merchant = mysqli_real_escape_string($mysqli, $_GET['m']); }
	
	if($merchant) {
		$query = "SELECT * FROM merchants WHERE url='$merchant'";
		$results = mysqli_query($mysqli, $query);
		$row = mysqli_fetch_assoc($results);
		$merchant_id = $row['id'];
		$merchant_name = $row['name'];
		$sca = $row['sca'];
		if(!$sca){$sca=60;}
	}

	if(!$merchant_id) {
		$merchant_id = 1;
	}
	
	
	$query = "SELECT * FROM merchants WHERE id='$merchant_id'";
	$results = mysqli_query($mysqli, $query);
	$row = mysqli_fetch_assoc($results);
	$merchant_id = $row['id'];
	$merchant_name = $row['name'];
	$sca = $row['sca'];
	if(!$sca || $sca==0){$sca=60;}
	
	
	
	include("../template/header.html");
	include("calculator.html");
	include("../template/footer.html");


?>