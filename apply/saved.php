<?php
	// SEND SAVED EMAIL
	session_start();
	require_once('ajax/config.php');
	
	$user_id = $_SESSION['user_id'];
	
	
	$user_query = "SELECT * FROM user_answers WHERE id='$user_id'";
	$user_query = mysqli_query($mysqli, $user_query);
	$total = mysqli_num_rows($user_query);
	$row = mysqli_fetch_assoc($user_query);
	
	$user_queryc = "SELECT * FROM user_answers WHERE id='$user_id'";
	$user_queryc = mysqli_query($mysqli, $user_queryc);
	$rowc = mysqli_fetch_assoc($user_queryc);
	$cid = $rowc['cid'];
	$pid = $rowc['pid'];
	if(!$pid) {
		$pid=1;
	}
	
	if($total<=0) {
		header('Location:'.$site_url); 
		exit();
	}
	
	$subject = "Your 360 Payments merchant application has been saved!";
	$body=' 
			<h4>Dear '.$rowc['firstname'].' '.$rowc['lastname'].',</h4>
			<p>Thank you for starting your application with 360 Payments!</p>
			<p>When you are ready to continue, you can access your saved form by clicking this <a href="'.$site_url.'">link</a>. </p>
			<p>If you have any questions or need help filling out the form, please feel free to chat with us via our <a href="https://www.360payments.com">website</a> or call us at 1-855-360-0360. </p>
			<p>Thank you! We look forward to growing with you.</p>
			<br>
			
			<p><b>Sincerely, <br> 360 Payments</b></p>';
			
	
	mail($rowc['email'], $subject, $body, $eheaders);
	mail('kclough@360payments.com', $subject, $body, $eheaders);
	
		
	

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
	<link rel="stylesheet" href="<?php echo $site_url; ?>/css/style.css">
	<link rel="stylesheet" href="<?php echo $site_url; ?>/css/pd-mr.css">
	<script src="<?php echo $site_url; ?>/js/app.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
	<div class="container topbar">
		<div class="row">
			<div class="col-sm-12 pt-20 pb-20 text-center">
				<img src="<?php echo $site_url; ?>/images/logo.png" />
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-12 mt-20">
				<div class="alert alert-success text-center" role="alert">
					Thank you for starting your application with 360 Payments!<br>
					When you are ready to continue, you can access your saved form by clicking this <a href="<?php echo $site_url; ?>">link</a>. <br>
					If you have any questions or need help filling out the form, please feel free to chat with us via our <a href="https://www.360payments.com">website</a> or call us at 1-855-360-0360. <br>
					Thank you! We look forward to growing with you.
				</div>
			</div>
		</div>
		
		
	</div>
  
	<!-- begin olark code -->
	<script type="text/javascript" async> ;(function(o,l,a,r,k,y){if(o.olark)return; r="script";y=l.createElement(r);r=l.getElementsByTagName(r)[0]; y.async=1;y.src="//"+a;r.parentNode.insertBefore(y,r); y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)}; y.extend=function(i,j){y("extend",i,j)}; y.identify=function(i){y("identify",k.i=i)}; y.configure=function(i,j){y("configure",i,j);k.c[i]=j}; k=y._={s:[],t:[+new Date],c:{},l:a}; })(window,document,"static.olark.com/jsclient/loader.js");
	/* custom configuration goes here (www.olark.com/documentation) */
	olark.identify('4988-702-10-6055');</script>
	<!-- end olark code -->
  
  
  </body>
</html>