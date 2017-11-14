<?php

	session_start();
	include 'core/config.php';
	include 'core/functions.php';
	session_destroy();
	header("Location:".$site_url."/login/");
	
?>