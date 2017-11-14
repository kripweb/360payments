<?php

session_start();
include '../core/config.php';
include '../core/functions.php';

$id=$_GET['id'];
if ($_FILES['file']['size'] != 0){

    $path = $_FILES['file']['name'];
	$ext = pathinfo($path, PATHINFO_EXTENSION);
	$uploaddir = "../uploads/docusign/";
	$name = $id."-".time()."-docusign.".$ext;
	$uploadfile = $uploaddir.$name;
	move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
	
	$addedon = date("Y-m-d H:i:s");
	$regsql = "INSERT INTO uploads (name,location,aid,addedon) VALUES ('$path', '$name', '$id', '$addedon')" ;
	$reg = mysqli_query($mysqli, $regsql);
}

?>