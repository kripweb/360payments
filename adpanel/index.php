<?php 

session_start();
include 'core/config.php';
include 'core/functions.php';
if(admin_login_check($mysqli) == true) {

	$active="dashboard";
	$title="Dashboard";
	
	
	//Day 1 
	$day1=date("Y-m-d", strtotime("6 days ago"));
	$day_from = $day1." 00:00:00";
	$day_to = $day1." 23:23:59";
	$query = "SELECT id FROM user_answers WHERE addedon>='$day_from' AND addedon<='$day_to'";
	$query = mysqli_query($mysqli, $query);
	$day1_count = mysqli_num_rows($query);
	
	$day2=date("Y-m-d", strtotime("5 days ago"));
	$day_from = $day2." 00:00:00";
	$day_to = $day2." 23:23:59";
	$query = "SELECT id FROM user_answers WHERE addedon>='$day_from' AND addedon<='$day_to'";
	$query = mysqli_query($mysqli, $query);
	$day2_count = mysqli_num_rows($query);
	
	
	$day3=date("Y-m-d", strtotime("4 days ago"));
	$day_from = $day3." 00:00:00";
	$day_to = $day3." 23:23:59";
	$query = "SELECT id FROM user_answers WHERE addedon>='$day_from' AND addedon<='$day_to'";
	$query = mysqli_query($mysqli, $query);
	$day3_count = mysqli_num_rows($query);
	
	
	$day4=date("Y-m-d", strtotime("3 days ago"));
	$day_from = $day4." 00:00:00";
	$day_to = $day4." 23:23:59";
	$query = "SELECT id FROM user_answers WHERE addedon>='$day_from' AND addedon<='$day_to'";
	$query = mysqli_query($mysqli, $query);
	$day4_count = mysqli_num_rows($query);
	
	
	$day5=date("Y-m-d", strtotime("2 days ago"));
	$day_from = $day5." 00:00:00";
	$day_to = $day5." 23:23:59";
	$query = "SELECT id FROM user_answers WHERE addedon>='$day_from' AND addedon<='$day_to'";
	$query = mysqli_query($mysqli, $query);
	$day5_count = mysqli_num_rows($query);
	
	
	$day6=date("Y-m-d", strtotime("1 days ago"));
	$day_from = $day6." 00:00:00";
	$day_to = $day6." 23:23:59";
	$query = "SELECT id FROM user_answers WHERE addedon>='$day_from' AND addedon<='$day_to'";
	$query = mysqli_query($mysqli, $query);
	$day6_count = mysqli_num_rows($query);
	
	
	$day7=date("Y-m-d");
	$day_from = $day7." 00:00:00";
	$day_to = $day7." 23:23:59";
	$query = "SELECT id FROM user_answers WHERE addedon>='$day_from' AND addedon<='$day_to'";
	$query = mysqli_query($mysqli, $query);
	$day7_count = mysqli_num_rows($query);
	
	
	include("template/header.html");
	include("template/index.html");
	include("template/footer.html");

}
else {
	
	$length = 200;
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	header("Location:".$site_url."/login/");
}

?>