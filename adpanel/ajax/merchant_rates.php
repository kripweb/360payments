<?php

include '../core/config.php';
include '../core/functions.php';

$error_code=0;
$error="";
if($_POST) {
	extract($_POST);
	$type_query = "SELECT * FROM merchants_rates WHERE merchants_id='$id' ORDER BY description ASC";
	$type_query = mysqli_query($mysqli, $type_query);
	$data='<option value="" rate="0">Choose type of business</option>';
	while($type_row = mysqli_fetch_assoc($type_query)){
		$data.='<option value="'.$type_row['id'].'" rate="'.$type_row['charge'].'">'.$type_row['description'].' - '.$type_row['code'].'</option>';
	}
	
	
	$query = "SELECT * FROM merchants WHERE id='$id'";
	$results = mysqli_query($mysqli, $query);
	$row = mysqli_fetch_assoc($results);
	$merchant_id = $row['id'];
	$merchant_name = $row['name'];
	$sca = $row['sca'];
	

} else {
	
	$error = "Something went wrong! Error code 0";
}


if($error){
	$error_code = 1;
}
$json= array(
	'error_code' => $error_code,
	'error' => $error,
	'data' => $data,
	'merchant_id' => $merchant_id,
	'merchant_name' => $merchant_name,
	'sca' => $sca
);
$jsonstring = json_encode($json, JSON_PRETTY_PRINT);
echo $jsonstring;



?>