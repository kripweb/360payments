<?php
	session_start();
	if($_SESSION['user_id']) {
		unset($_SESSION['user_id']);
	}
	require_once('ajax/config.php');
	
	if(isset($_POST['RegisterForm'])){
		//Register User
		$firstname = mysqli_real_escape_string($mysqli, $_POST['firstname']);
		$lastname = mysqli_real_escape_string($mysqli, $_POST['lastname']);
		$email = mysqli_real_escape_string($mysqli, $_POST['email']);
		$password = mysqli_real_escape_string($mysqli, $_POST['password']);
		
		if(!$firstname){ $r_error="Please enter your firstname"; }
		else if(!$lastname) { $r_error="Please enter your lastname"; }
		else if(!$email) { $r_error="Please enter your email"; }
		else if(!$password) { $r_error="Please enter your password"; }
		else {
			$user_query = "SELECT * FROM user_answers WHERE email='$email'";
			$user_query = mysqli_query($mysqli, $user_query);
			$total = mysqli_num_rows($user_query);
			$row = mysqli_fetch_assoc($user_query);
			if($total>0){
				$r_error="This email id is already registered.";
			} else {
				$date = date("Y-m-d H:i:s");
				$insert = "INSERT INTO user_answers (firstname, lastname, email, password, addedon, cid) VALUES ('$firstname', '$lastname', '$email', '$password', '$date', '1')";
				$insert = mysqli_query($mysqli, $insert);
				$_SESSION['user_id']= mysqli_insert_id($mysqli);
				$_SESSION['cid']= 1;
				
				header('Location:form.php'); 
				//Send email for registration.
				
				$subject="Welcome to 360 Payments!";
				$body="
				<p>Hi ".$firstname.",</p><br>

				<p>Welcome to the 360 Payments family! You're in good hands with us. Below you'll find your login details - save this information because you'll need it to access your application if you don't finish it all at once.</p>
				<br>
				<p>Have questions or need some tech support? We're here for you! Give us a call at 1-855-360-0360, Monday - Friday, 8am-5pm Pacific Time. Have a great day!</p><br>

				<p><b>Sincerely, <br> 360 Payments</b></p>

				<p>PS. Username is <b>".$email."</b> PW is <b>".$password."</b></p>
				<p>PSS. Click <a href='".$site_url."'>this link</a> to access your application anytime.<p>";
				
				mail($email, $subject, $body, $eheaders);
				
				
			}
		}
	}
	
	if(isset($_POST['LoginForm'])){
		//Login User
		$email = mysqli_real_escape_string($mysqli, $_POST['email']);
		$password = mysqli_real_escape_string($mysqli, $_POST['password']);
		
		if(!$email) { $l_error="Please enter your email"; }
		else if(!$password) { $l_error="Please enter your password"; }
		else {
			$user_query = "SELECT * FROM user_answers WHERE email='$email' AND password='$password'";
			$user_query = mysqli_query($mysqli, $user_query);
			$total = mysqli_num_rows($user_query);
			$row = mysqli_fetch_assoc($user_query);
			if($total>0){
				$_SESSION['user_id']= $row['id'];
				$_SESSION['cid']= $row['cid'];
				if(!$row['cid']){
					$_SESSION['cid']=1;
				}
				//Send email for login.
				header('Location:'.$site_url.'/form/'); 
			} else {
				$l_error="Invalid email or password.";
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
    <title>360 Payments Get Quote</title>
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
		  <ul class="tab-group">
			<li class="tab active"><a href="#signup">Sign Up</a></li>
			<li class="tab"><a href="#login">Log In</a></li>
		  </ul>
		  
		  <div class="tab-content">
			<div id="signup">   
			  <h1>Join our family</h1>
			  <?php 
				if($l_error) { echo '<div class="alert alert-warning">'.$l_error.'</div>'; }
				if($r_error) { echo '<div class="alert alert-warning">'.$r_error.'</div>'; }
			  ?>
			  <form id="RegisterForm" method="post">
			  
			  <div class="top-row">
				<div class="field-wrap">
				  <label>
					First Name<span class="req">*</span>
				  </label>
				  <input name="firstname" type="text" required autocomplete="false" />
				</div>
			
				<div class="field-wrap">
				  <label>
					Last Name<span class="req">*</span>
				  </label>
				  <input name="lastname" type="text"required autocomplete="false"/>
				</div>
			  </div>

			  <div class="field-wrap">
				<label>
				  Email Address<span class="req">*</span>
				</label>
				<input name="email" type="email"required autocomplete="false"/>
			  </div>
			  
			  <div class="field-wrap">
				<label>
				  Set a Password<span class="req">*</span>
				</label>
				<input name="password" type="password"required autocomplete="new-password"/>
			  </div>
			  
			  <button type="submit" name="RegisterForm" class="button button-block"/>Get Started</button>
			  
			  </form>

			</div>
			
			<div id="login">   
			  <h1>Welcome Back!</h1>
			  
			  <form id="LoginForm" method="post">
			  
				<div class="field-wrap">
				<label>
				  Email Address<span class="req">*</span>
				</label>
				<input name="email" type="email"required autocomplete="false"/>
			  </div>
			  
			  <div class="field-wrap">
				<label>
				  Password<span class="req">*</span>
				</label>
				<input name="password" type="password"required autocomplete="new-password"/>
			  </div>
			  
			  <p class="forgot"><a href="<?php echo $site_url; ?>/forgot/">Forgot Password?</a></p>
			  
			  <button class="button button-block" name="LoginForm" />Log In</button>
			  
			  </form>

			</div>
			
		  </div><!-- tab-content -->
		  
	</div>
	<!-- begin olark code -->
	<script type="text/javascript" async> ;(function(o,l,a,r,k,y){if(o.olark)return; r="script";y=l.createElement(r);r=l.getElementsByTagName(r)[0]; y.async=1;y.src="//"+a;r.parentNode.insertBefore(y,r); y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)}; y.extend=function(i,j){y("extend",i,j)}; y.identify=function(i){y("identify",k.i=i)}; y.configure=function(i,j){y("configure",i,j);k.c[i]=j}; k=y._={s:[],t:[+new Date],c:{},l:a}; })(window,document,"static.olark.com/jsclient/loader.js");
	/* custom configuration goes here (www.olark.com/documentation) */
	olark.identify('4988-702-10-6055');</script>
	<!-- end olark code -->
</body>
</html>