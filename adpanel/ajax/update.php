<?php
session_start();
include '../core/config.php';
include '../core/functions.php';
	
	if(isset($_POST)){
		extract($_POST);
		if($charge && $description && $code && $id) {
			$data['charge']=$charge;
			$data['description']=$description;
			$data['code']=$code;
			$insert_data = mysql_update_array('merchants_rates', $data, $id, array(''));			
		}	
		
	}
?>