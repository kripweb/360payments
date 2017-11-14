<?php
	session_start();
	require_once('ajax/config.php');
	
	if(isset($_POST['LoginForm'])){
		//Login User
		$email = mysqli_real_escape_string($mysqli, $_POST['email']);
		
		if(!$email) { $error="Please enter your email"; }
		else {
			$user_query = "SELECT * FROM user_answers WHERE email='$email'";
			$user_query = mysqli_query($mysqli, $user_query);
			$total = mysqli_num_rows($user_query);
			$row = mysqli_fetch_assoc($user_query);
			if($total>0){
				
				//SEND EMAIL FOR FORGOT Password
				$subject = "Your 360 Payments Password!";
				$body = '
					<h3><b>Hello, '.$row['firstname'].' '.$row['lastname'].'</b></h3>
					<p>You recently requested the password for your 360 Payments account.</p>
					<p>Please find your account details below:</p>
					<p><b>Email:</b> '.$row['email'].'</p>
					<p><b>Password:</b> '.$row['password'].'</p>
					<p><a href="'.$site_url.'/">Click here to return to your application</a></p>
					<br><br>
					
					<p>Sincerely,</p>
					<p><b>360 Payments</b></p>
					';
					
				$send = mail($row['email'], $subject, $body, $eheaders);
				if($send==1){
					$info = "We have sent an email with your login details to your registered email id. Thank you!";
				}
				
			} else {
				$error="Invalid email or password.";
			}
		}
		
	}










?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	
	<!-- Metatags -->
    <title>360 Payments - Forgot Password</title>
	<meta name="Description" content="360Payments Get Quote"/>

	<!-- Favicon -->
	<link href="<?php echo $site_url; ?>/images/favicon.png" rel="icon" type="image/x-icon" />
	
	<!-- JQUERY -->
	<script src="<?php echo $site_url; ?>/js/jquery.min.js"></script>
	<script src="<?php echo $site_url; ?>/js/iscroll.min.js"></script>

	<!-- Plugins -->
    <!-- Bootstrap -->
    <link href="<?php echo $site_url; ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="<?php echo $site_url; ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
	
	<!-- CUSTOM -->
	<link rel="stylesheet" href="<?php echo $site_url; ?>/css/index.css">
	<link rel="stylesheet" href="<?php echo $site_url; ?>/css/pd-mr.css">
	<script src="<?php echo $site_url; ?>/js/index.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
	<div class="form">
		  <div class="text-center">
		     <img class="logo" src="<?php echo $site_url; ?>/images/logo.png" />
		  </div>
		 
			
		<div id="login">   
			  <h1>Forgot Password?</h1>
			  <?php 
				if($error) { echo '<div class="alert alert-warning">'.$error.'</div>'; }
				if($info) { echo '<div class="alert alert-success">'.$info.'</div>'; }
			  ?>
			  <form id="LoginForm" method="post">
				<div class="field-wrap">
				<label>
				  Email Address<span class="req">*</span>
				</label>
				<input name="email" type="email"required autocomplete="false"/>
			  </div>
			 
			  
			  <button class="button button-block" name="LoginForm" /> Get Password</button>
			  
			  </form>

			</div>
			
		  
	</div>
	
	<!-- begin olark code -->
	<script type="text/javascript" async> ;(function(o,l,a,r,k,y){if(o.olark)return; r="script";y=l.createElement(r);r=l.getElementsByTagName(r)[0]; y.async=1;y.src="//"+a;r.parentNode.insertBefore(y,r); y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)}; y.extend=function(i,j){y("extend",i,j)}; y.identify=function(i){y("identify",k.i=i)}; y.configure=function(i,j){y("configure",i,j);k.c[i]=j}; k=y._={s:[],t:[+new Date],c:{},l:a}; })(window,document,"static.olark.com/jsclient/loader.js");
	/* custom configuration goes here (www.olark.com/documentation) */
	olark.identify('4988-702-10-6055');</script>
	<!-- end olark code -->
</body>
</html>