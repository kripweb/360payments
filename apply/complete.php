<?php

session_start();
require_once('ajax/config.php');

$user_id = $_SESSION['user_id'];
	
$update = "Update user_answers SET status='3' WHERE id='$user_id'";
$update = mysqli_query($mysqli, $update);

$user_query = "SELECT * FROM user_answers WHERE id='$user_id'";
$user_query = mysqli_query($mysqli, $user_query);
$total = mysqli_num_rows($user_query);
$row = mysqli_fetch_assoc($user_query);

if($total>0){
$subject = $row['name']." application";
$body=' 
		<h4>Dear Admin,</h4>
		
		<p>A new application has been completed by '.$row['firstname'].' '.$row['lastname'].'</p>
		<p>You can view application at this <a href="https://www.360payments.com/adpanel/applications/view/'.$user_id.'/">link</a>. </p>
		<br>
		<p>Username: kripweb</p>
		<p>Password: krip1234@</p>
		<br>
		
		<p><b>Sincerely, <br>360 Payments</b></p>';
}
mail('tickets@360-payments.com', $subject, $body, $eheaders);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	
	<!-- Metatags -->
    <title>360Payments Get Quote</title>
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
			<div class="col-sm-12">
				<div class="alert alert-success text-center" role="alert">Thank you! Your application will be reviewed shortly. A representative will contact you within two business days - usually
much sooner.<br>Please call us at 855-360-0360 if you have any questions.</div>
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