<?php
	session_start();
	require_once('ajax/config.php');
	
	$user_id = $_SESSION['user_id'];
	
	$error="";
	
	$user_query = "SELECT * FROM user_answers WHERE id='$user_id'";
	$user_query = mysqli_query($mysqli, $user_query);
	$total = mysqli_num_rows($user_query);
	$row = mysqli_fetch_assoc($user_query);
	

	$cid = $row['cid'];
	$pid = $row['pid'];
	if(!$pid) {
		$pid=1;
	}
	
	if($total<=0) {
		header('Location:index.php'); 
	} else {
		
	
	if(!$row['q81']){$row['q81']=$row['q80'];}
	if(!$row['q83']){$row['q83']=$row['q82'];}
	if(!$row['q83a']){$row['q83a']=$row['q82a'];}
	if(!$row['q83b']){$row['q83b']=$row['q82b'];}
	if(!$row['q83c']){$row['q83c']=$row['q82c'];}
	if(!$row['q83d']){$row['q83d']=$row['q82d'];}
	
	
	if(isset($_POST['q80'])){
		$update_data = mysql_update_array('user_answers', $_POST, $user_id, array('q129', 'q131', 'q133'));
	
		
		$user_query = "SELECT * FROM user_answers WHERE id='$user_id'";
		$user_query = mysqli_query($mysqli, $user_query);
		$total = mysqli_num_rows($user_query);
		$row = mysqli_fetch_assoc($user_query);
		
		$uploaddir = "uploads/";
		
		//Error finding
		if($_POST['q92']==1 && !$_POST['q93']){
			$error = "Please provide the card processor name.";
		} else if($_POST['q92']==1 && !$_POST['q94']){
			$error = "Please provide number of locations.";
		} else if($_POST['q96']==1 && !$_POST['q97']){
			$error = "Please answer in how many days do you bill your customers prior to goods being shipped.";
		} else if(($_POST['q98']+$_POST['q99']+$_POST['q100']+$_POST['q101'])!=100){
			$error = "Credit card processing methods should be 100%";
		} else if(!$_POST['q105a'] && !$_POST['q105b'] && !$_POST['q105c'] && !$_POST['q105d'] && !$_POST['q105e'] && !$_POST['q105f'] && !$_POST['q105g'] && !$_POST['q105h'] && !$_POST['q105i'] && !$_POST['q105j']) {
			$error = "Please answer What type of business do you operate?";
		} else if($_POST['q103']==1 && !$_POST['q104a'] && !$_POST['q104b'] && !$_POST['q104c'] && !$_POST['q104d'] && !$_POST['q104e'] && !$_POST['q104f'] && !$_POST['q104g'] && !$_POST['q104h'] && !$_POST['q104i'] && !$_POST['q104j'] && !$_POST['q104k'] && !$_POST['q104l']) {
			$error = "Please select your business active months.";
		} else if($_POST['q120']==1 && !$_POST['q122']){
			$error = "Please provide business bankruptcies filling date.";
		} else if($_POST['q121']==1 && !$_POST['q122a']){
			$error = "Please provide personal bankruptcies filling date.";
		}
		
		//Upload Documents to server.
		$bname = str_replace(" ", "_", $_POST['q80']);
		if ($_FILES['q129']['size'] == 0 && $_FILES['q129']['error'] == 0 && !$row['q129']){
			$data['q129']="";
		} else {
			$path = $_FILES['q129']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			
			$name = $user_id."-".$bname."-".time()."-check.".$ext;
			$uploadfile = $uploaddir.$name;
			move_uploaded_file($_FILES['q129']['tmp_name'], $uploadfile);
			$data['q129']=$name;
		}
		
		
		if ($_FILES['q131']['size'] == 0 && $_FILES['q131']['error'] == 0 && !$row['q131']){
			$data['q131']="";
		} else {
			$path = $_FILES['q131']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			
			$name = $user_id."-".$bname."-".time()."-DL.".$ext;
			$uploadfile = $uploaddir.$name;
			move_uploaded_file($_FILES['q131']['tmp_name'], $uploadfile);
			$data['q131']=$name;
		}
		
		if ($_FILES['q133']['size'] == 0 && $_FILES['q133']['error'] == 0 && !$row['q133']){
			$data['q133']="";
		} else {
			$path = $_FILES['q133']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			
			$name = $user_id."-".$bname."-".time()."-statement.".$ext;
			$uploadfile = $uploaddir.$name;
			move_uploaded_file($_FILES['q133']['tmp_name'], $uploadfile);
			$data['q133']=$name;
		}
		
		$update_data = mysql_update_array('user_answers', $data, $row['id'], array());
		
		if(!$error){
			header('Location:'.$site_url.'/docusign/'); 
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
	
	<!-- Bootstrap Helper -->
    <link href="<?php echo $site_url; ?>/plugins/bs-helper/dist/css/bootstrap-formhelpers.min.css" rel="stylesheet">
	<script src="<?php echo $site_url; ?>/plugins/bs-helper/dist/js/bootstrap-formhelpers.js"></script>
	
	<link href="<?php echo $site_url; ?>/plugins/datepicker/datepicker3.css" rel="stylesheet">
	<script src="<?php echo $site_url; ?>/js/bootstrap-formhelpers-phone.format.js"></script>
	<script src="<?php echo $site_url; ?>/js/bootstrap-formhelpers-phone.js"></script>
	
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
			<div class="col-sm-12 pt-20 pb-20">
				<img src="<?php echo $site_url; ?>/images/logo.png" />
			</div>
		</div>
	</div>
	
	<div class="container mb-20">
		<div class="row">
			<section>
				<div class="col-sm-12 text-center"><h3>Please review your application. When
you&#39;re satisfied, click "Continue to Document" at the bottom.</h3></div>
				<div class="col-sm-12 pageborder">
					<form role="form" id="mainform" method="post" enctype="multipart/form-data">
						<div class="row">
						
							<?php if($error){ ?>
							<div class="col-sm-12 mb-10 mt-10">
								<div class="alert alert-danger"><?php echo $error; ?></div>
							</div>
							<?php } ?>
							<div class="col-sm-12">
								<h4>1. Business Information</h4>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label style="font-size:13px" for="q80">Legal Name of Business (25 characters max)</label>
									<input type="text" class="form-control" value="<?php echo $row['q80']; ?>" id="q80" name="q80" maxlength="25" required>
								</div>
							</div>
							<div class="col-sm-8">
								<div class="form-group">
									<label style="font-size:13px" for="q82">Legal Address</label>
									<input type="text" class="form-control" value="<?php echo $row['q82']; ?>" id="q82" name="q82" required>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label style="font-size:13px" for="q82a">Suite</label>
									<input type="text" class="form-control" value="<?php echo $row['q82a']; ?>" id="q82a" name="q82a" >
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group">
									<label style="font-size:13px" for="q82b">City</label>
									<input type="text" class="form-control" value="<?php echo $row['q82b']; ?>" id="q82b" name="q82b" required>
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group">
									<label style="font-size:13px" for="q82c">State</label>
									<input type="text" class="form-control" value="<?php echo $row['q82c']; ?>" id="q82c" name="q82c" required>
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group">
									<label style="font-size:13px" for="q82d">ZIP</label>
									<input type="text" class="form-control" value="<?php echo $row['q82d']; ?>" id="q82d" name="q82d" required>
								</div>
							</div>
							
							<div class="col-sm-3">
								<div class="form-group">
									<label style="font-size:13px" for="exampleInputEmail1">How long have you owned your business?</label>
									<div class="row">
										<div class="col-sm-6">
											<div class="input-group">
												<input class="form-control input-sm" autocomplete="off" type="number"  name="q118" id="q118" value="<?php echo $row['q118']; ?>" required />
												<div class="input-group-addon">Years</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="input-group">
												<input class="form-control input-sm" autocomplete="off" type="number"  name="q119" id="q119" value="<?php echo $row['q119']; ?>" />
												<div class="input-group-addon">Months</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="row">
							<div class="col-sm-12">
								<hr>
								<h4>2. DBA Information</h4>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label style="font-size:13px" for="q81">DBA Name (25 characters max)</label>
									<input type="text" class="form-control" name="q81" id="q81" value="<?php echo $row['q81']; ?>" required>
								</div>
							</div>
							<div class="col-sm-8">
								<div class="form-group">
									<label style="font-size:13px" for="q83">DBA Address (Physical location, no PO Boxes)</label>
									<input type="text" class="form-control" name="q83" id="q83" value="<?php echo $row['q83']; ?>" required>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label style="font-size:13px" for="q83a">Suite</label>
									<input type="text" class="form-control" name="q83a" id="q83a" value="<?php echo $row['q83a']; ?>" >
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group">
									<label style="font-size:13px" for="q83b">City</label>
									<input type="text" class="form-control" name="q83b" id="q83b" value="<?php echo $row['q83b']; ?>" required>
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group">
									<label style="font-size:13px" for="q83c">State</label>
									<input type="text" class="form-control" name="q83c" id="q83c" value="<?php echo $row['q83c']; ?>" required>
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group">
									<label style="font-size:13px" for="q83d">ZIP</label>
									<input type="text" class="form-control" name="q83d" id="q83d" value="<?php echo $row['q83d']; ?>" required>
								</div>
							</div>
						</div>
						
						
						<div class="row">
							<div class="col-sm-12">
								<hr>
								<h4>3. Contact & Website Information</h4>
							</div>
							
							
							<div class="col-sm-4">
								<div class="form-group">
									<label style="font-size:13px" for="q84">Website Address</label>
									<input type="text" class="form-control" name="q84" id="q84" value="<?php echo $row['q84']; ?>" required>
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group">
									<label style="font-size:13px" for="q85a">Phone Number</label>
									<input type="text" class="form-control bfh-phone" data-country="US" name="q85a" id="q85a" value="<?php echo $row['q85a']; ?>" data-number="<?php echo $row['q85a']; ?>" required>
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group">
									<label style="font-size:13px" for="qn1">Email Address</label>
									<input type="text" class="form-control" name="qn1" id="qn1" value="<?php echo $row['qn1']; ?>" required>
								</div>
							</div>
						</div>
						
						
						<div class="row">
							<div class="col-sm-12">
								<hr>
								<h4>4. Type of Ownership</h4>
							</div>
							
							
							<div class="col-sm-12">
								<label style="font-size:13px" class="radio-inline">
								  <input type="radio" name="q91" value="1" <?php if($row['q91']==1){ echo "checked"; } ?> required > Sole Proprietorship
								</label>
								<label style="font-size:13px" class="radio-inline">
								  <input type="radio" value="2" name="q91" <?php if($row['q91']==2){ echo "checked"; } ?> required > LLC
								</label>
								<label style="font-size:13px" class="radio-inline">
								  <input type="radio"   value="3" name="q91" <?php if($row['q91']==3){ echo "checked"; } ?> required > Partnership
								</label>
								<label style="font-size:13px" class="radio-inline">
								  <input type="radio"   value="4" name="q91" <?php if($row['q91']==4){ echo "checked"; } ?> required > Ltd Liability Partnership
								</label>
								<label style="font-size:13px" class="radio-inline">
								  <input type="radio"   value="5" name="q91" <?php if($row['q91']==5){ echo "checked"; } ?> required > Government Entity
								</label>
								<label style="font-size:13px" class="radio-inline">
								  <input type="radio"   value="6" name="q91" <?php if($row['q91']==6){ echo "checked"; } ?> required > Trust
								</label>
								<label style="font-size:13px" class="radio-inline">
								  <input type="radio"   value="7" name="q91" <?php if($row['q91']==7){ echo "checked"; } ?> required > Professional Association
								</label>
								<label style="font-size:13px" class="radio-inline">
								  <input type="radio"   value="8" name="q91" <?php if($row['q91']==8){ echo "checked"; } ?> required > Political Organization
								</label>
								<label style="font-size:13px" class="radio-inline">
								  <input type="radio"   value="9" name="q91" <?php if($row['q91']==9){ echo "checked"; } ?> required > Public Corporation
								</label>
								<label style="font-size:13px" class="radio-inline">
								  <input type="radio"   value="10" name="q91" <?php if($row['q91']==10){ echo "checked"; } ?> required > Private Corporation
								</label>
								<label style="font-size:13px" class="radio-inline">
								  <input type="radio"   value="11" name="q91" <?php if($row['q91']==11){ echo "checked"; } ?> required > Nonprofit Corporation
								</label>
							</div>
						</div>
						
						
						<div class="row">
							<div class="col-sm-12">
								<hr>
								<h4>5. Card Processing Information</h4>
							</div>
							
							
							<div class="col-sm-12">
								<label style="font-size:14px" class="mr-10">Have you ever accepted credit cards before?</label>
								<label style="font-size:13px" class="radio-inline">
									<input type="radio" name="q92"  value="1" <?php if($row['q92']==1){ echo "checked"; } ?> required > Yes
								</label>
								<label style="font-size:13px" class="radio-inline">
									<input type="radio" name="q92"  value="2" <?php if($row['q92']==2){ echo "checked"; } ?> required > No
								</label>
							</div>
							
							<div class="col-sm-3">
								<div class="form-group">
									<label style="font-size:13px" for="q93">What was the processor's name?</label>
									<input type="text" class="form-control" name="q93" id="q93" value="<?php echo $row['q93']; ?>">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label style="font-size:13px" for="q94">Number of locations?</label>
									<input type="text" class="form-control" name="q94" id="q94" value="<?php echo $row['q94']; ?>">
								</div>
							</div>
							
							
							<div class="col-sm-12">
								<label style="font-size:14px" class="mr-10">Do you bill your customers prior to goods being shipped?</label>
								<label style="font-size:13px" class="radio-inline">
									<input type="radio" name="q96"  value="1" <?php if($row['q96']==1){ echo "checked"; } ?> required > Yes
								</label>
								<label style="font-size:13px" class="radio-inline">
									<input type="radio" name="q96"  value="2" <?php if($row['q96']==2){ echo "checked"; } ?> required > No
								</label>
							</div>
							
							<div class="col-sm-12 mt-10">
								<label style="font-size:14px" class="mr-10">If yes, in how many days?</label>
								<label style="font-size:13px" class="radio-inline">
									<input type="radio" name="q97"  value="1" <?php if($row['q97']==1){ echo "checked"; } ?>> 0-2 days
								</label>
								<label style="font-size:13px" class="radio-inline">
									<input type="radio" name="q97"  value="2" <?php if($row['q97']==2){ echo "checked"; } ?>> 3-30 days
								</label>
								<label style="font-size:13px" class="radio-inline">
									<input type="radio" name="q97"  value="3" <?php if($row['q97']==3){ echo "checked"; } ?>> 31-60 days
								</label>
								<label style="font-size:13px" class="radio-inline">
									<input type="radio" name="q97"  value="4" <?php if($row['q97']==4){ echo "checked"; } ?>> 61-90 days
								</label>
								<label style="font-size:13px" class="radio-inline">
									<input type="radio" name="q97"  value="5" <?php if($row['q97']==5){ echo "checked"; } ?>> Over 90 days
								</label>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12">
								<hr>
								<h4>6. Credit Card Processing Methods</h4>
							</div>
							<div class="col-sm-12 tabels mt-10">
								
								<table class="table table-bordered tableshort2" style="">
									<tr>
										<td class="lefthead w80">Card swiped transaction</td>
										<td>
											<div class="input-group">
												<input class="form-control input-sm" autocomplete="off" type="number"  name="q98" id="98" value="<?php echo $row['q98']; ?>" onkeyup="total100()" required />
												<div class="input-group-addon">%</div>
											</div>
										</td>
									</tr>
									<tr>
										<td class="lefthead w80">Manually keyed <br>(<small>card present</small>)</td>
										<td>
											<div class="input-group">
												<input class="form-control input-sm" autocomplete="off" type="number"  name="q99" id="99" value="<?php echo $row['q99']; ?>" onkeyup="total100()" required />
												<div class="input-group-addon">%</div>
											</div>
										</td>
									</tr>
									<tr>
										<td class="lefthead w80">Manually keyed <br>(<small>card not present and/or mail order/telephone order</small>)</td>
										<td>
											<div class="input-group">
												<input class="form-control input-sm" autocomplete="off" type="number"  name="q100" id="100" value="<?php echo $row['q100']; ?>" onkeyup="total100()" required />
												<div class="input-group-addon">%</div>
											</div>
											</td>
									</tr>
									<tr>
										<td class="lefthead w80">eCommerce <br>(<small>card not present</small>)</td>
										<td>
											<div class="input-group">
												<input class="form-control input-sm" autocomplete="off" type="number"  name="q101" id="101" value="<?php echo $row['q101']; ?>" onkeyup="total100()" required />
												<div class="input-group-addon">%</div>
											</div>
										</td>
									</tr>
									<tr class="active">
										<td class="lefthead w80">Total <br>(<small>must equal 100%</small>)</td>
										<td class="text-center" id="total100"><?php echo $row['q98']+$row['q99']+$row['q100']+$row['q101']; ?> %</td>
									</tr>
									<tr>
										<td class="lefthead w80">What percentage of your sales are business to business?<br>(must be 0-100%)</td>
										<td>
											<div class="input-group">
												<input class="form-control input-sm" autocomplete="off" type="number"  name="q102" id="q102" value="<?php echo $row['q102']; ?>" required />
												<div class="input-group-addon">%</div>
											</div>
										</td>
									</tr>
								 </table>
							</div>
						</div>
						
						
						<div class="row">
							<div class="col-sm-12">
								<hr>
								<h4>7. Type of Business</h4>
							</div>
							
							
							<div class="col-sm-12 mb-10">
								<label style="font-size:14px; display:block;" class="mr-10">What type of business do you operate?</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input type="checkbox" name="q105a"  <?php if($row['q105a']==1){ echo "checked"; } ?> value="1"> Retail
								</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input type="checkbox" name="q105b" <?php if($row['q105b']==2){ echo "checked"; } ?>  value="2"> Restaurant with tips
								</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input type="checkbox" name="q105c" <?php if($row['q105c']==3){ echo "checked"; } ?>  value="3"> Restaurant
								</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input type="checkbox" name="q105d" <?php if($row['q105d']==4){ echo "checked"; } ?>  value="4"> Mail / Telephone order
								</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input type="checkbox" name="q105e" <?php if($row['q105e']==5){ echo "checked"; } ?>  value="5"> E-commerce
								</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input type="checkbox" name="q105f" <?php if($row['q105f']==6){ echo "checked"; } ?>  value="6"> Lodging
								</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input type="checkbox" name="q105g" <?php if($row['q105g']==7){ echo "checked"; } ?>  value="7"> Supermarket
								</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input type="checkbox" name="q105h" <?php if($row['q105h']==8){ echo "checked"; } ?>  value="8"> Utility
								</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input type="checkbox" name="q105i" <?php if($row['q105i']==9){ echo "checked"; } ?>  value="9"> Pharmacy
								</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input type="checkbox" name="q105j" <?php if($row['q105j']==10){ echo "checked"; } ?>  value="10"> Business to business
								</label>
							</div>
							
							<div class="col-sm-12">
								<label style="font-size:14px" class="mr-10">Does your business close completely for entire months out of the year?</label>
								<label style="font-size:13px" class="radio-inline">
									<input type="radio" name="q103"  value="1" <?php if($row['q103']==1){ echo "checked"; } ?> required > Yes
								</label>
								<label style="font-size:13px" class="radio-inline">
									<input type="radio" name="q103"  value="2" <?php if($row['q103']==2){ echo "checked"; } ?> required > No
								</label>
							</div>
							
							<div class="col-sm-12 mt-10">
								<label style="font-size:14px; display:block;" class="mr-10">If yes, during which months?</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input name="q104a" id="104a" type="checkbox" value="1" <?php if($row['q104a']==1){ echo "checked"; } ?>> Jan
								</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input name="q104b" id="104b" type="checkbox" value="2" <?php if($row['q104b']==2){ echo "checked"; } ?>> Feb
								</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input name="q104c" id="104c" type="checkbox" value="3" <?php if($row['q104c']==3){ echo "checked"; } ?>> Mar
								</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input name="q104d" id="104d" type="checkbox" value="4" <?php if($row['q104d']==4){ echo "checked"; } ?>> Apr
								</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input name="q104e" id="104e" type="checkbox" value="5" <?php if($row['q104e']==5){ echo "checked"; } ?>> May
								</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input name="q104f" id="104f" type="checkbox" value="6" <?php if($row['q104f']==6){ echo "checked"; } ?>> Jun
								</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input name="q104g" id="104g" type="checkbox" value="7" <?php if($row['q104g']==7){ echo "checked"; } ?>> Jul
								</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input name="q104h" id="104h" type="checkbox" value="8" <?php if($row['q104h']==8){ echo "checked"; } ?>> Aug
								</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input name="q104i" id="104i" type="checkbox" value="9" <?php if($row['q104i']==9){ echo "checked"; } ?>> Sep
								</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input name="q104j" id="104j" type="checkbox" value="10" <?php if($row['q104j']==10){ echo "checked"; } ?> > Oct
								</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input name="q104k" id="104k" type="checkbox" value="11" <?php if($row['q104k']==11){ echo "checked"; } ?> > Nov
								</label>
								<label style="font-size:13px" class="checkbox-inline">
									<input name="q104l" id="104l" type="checkbox" value="12" <?php if($row['q104l']==12){ echo "checked"; } ?> > Dec
								</label>
							</div>
						</div>
						
						
						<div class="row">
							<div class="col-sm-12">
								<hr>
								<h4>8. W-9 Information</h4>
							</div>
							
							
							<div class="col-sm-4">
								<div class="form-group">
									<label style="font-size:13px" for="q109">Taxpayer Identification Number</label>
									<input type="text" class="form-control" name="q109" id="q109" value="<?php echo $row['q109']; ?>" required >
								</div>
							</div>
							
							
							<div class="col-sm-12">
								<div class="form-group">
									<label style="font-size:13px; display:block" for="exampleInputEmail1">This number is a/an</label>
									<label style="font-size:13px" class="radio-inline">
										<input type="radio" name="q110"  value="1" <?php if($row['q110']==1){ echo "checked"; } ?> required > EIN
									</label>
									<label style="font-size:13px" class="radio-inline">
										<input type="radio" name="q110"  value="2" <?php if($row['q110']==2){ echo "checked"; } ?> required > Social Security Number
									</label>
									<label style="font-size:13px" class="radio-inline">
										<input type="radio" name="q110"  value="3" <?php if($row['q110']==3){ echo "checked"; } ?> required > ITIN
									</label>
								</div>
							</div>
						</div>
						
						
						<div class="row">
							<div class="col-sm-12">
								<hr>
								<h4>9. Owner Information (holds at least a 50% stake in the business)</h4>
							</div>
							
							
							<div class="col-sm-8">
								<div class="form-group">
									<label style="font-size:13px" for="q111">Name</label>
									<input type="text" class="form-control" name="q111" id="q111" value="<?php echo $row['q111']; ?>" required >
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group">
									<label style="font-size:13px" for="q111a">Title (CEO, President, Secretary, etc.)</label>
									<input type="text" class="form-control" name="q111a" id="q111a" value="<?php echo $row['q111a']; ?>" required >
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group">
									<label style="font-size:13px" for="q113">Home address</label>
									<input type="text" class="form-control" name="q113" id="q113" value="<?php echo $row['q113']; ?>" required >
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group">
									<label style="font-size:13px" for="q112">Date of birth</label>
									<input type="text" class="form-control bfh-phone" name="q112" id="q112"  value="<?php echo $row['q112']; ?>" required data-format="dd/dd/dddd" data-number="<?php echo $row['q112']; ?>" placeholder="MM/DD/YYYY" >
								</div>
							</div>
							
							<div class="col-sm-3">
								<div class="form-group">
									<label style="font-size:13px" for="q114a">Home phone number</label>
									<input type="text" class="form-control bfh-phone" data-country="US" name="q114a" id="114a" value="<?php echo $row['q114a']; ?>" data-number="<?php echo $row['q114a']; ?>" required >
								</div>
							</div>
							
							
							<div class="col-sm-3">
								<div class="form-group">
									<label style="font-size:13px" for="qn2a">Social security number</label>
									<input type="text" class="form-control bfh-phone" data-format="ddd-dd-dddd" name="qn2a" id="qn2a" value="<?php echo $row['qn2a']; ?>" data-number="<?php echo $row['qn2a']; ?>" required >
								</div>
							</div>
							
							<div class="col-sm-2">
								<div class="form-group">
									<label style="font-size:13px" for="q115">Percent owned</label>
									<div class="input-group">
										<input class="form-control input-sm" autocomplete="off" type="number"  name="q115" id="q115" value="<?php echo $row['q115']; ?>" required />
										<div class="input-group-addon">%</div>
									</div>
								</div>
							</div>
							
							
							<div class="col-sm-12">
								<div class="form-group">
									<label style="font-size:13px" for="q116">Owner’s driver’s license number</label>
									<input class="form-control" autocomplete="off" name="q116" id="q116" value="<?php echo $row['q116']; ?>" required />
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group">
									<label style="font-size:13px" for="q117">Date of issuance</label>
									<input class="form-control bfh-phone" autocomplete="off" name="q117" id="q117" value="<?php echo $row['q117']; ?>" required data-format="dd/dd/dddd" data-number="<?php echo $row['q117']; ?>" placeholder="MM/DD/YYYY" />
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group">
									<label style="font-size:13px" for="q117b">Expiration date</label>
									<input class="form-control" autocomplete="off" name="q117b" id="q117b" value="<?php echo $row['q117b']; ?>" required />
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group">
									<label style="font-size:13px" for="q117a">State of issuance</label>
									<input class="form-control bfh-phone" autocomplete="off" name="q117a" id="q117a" value="<?php echo $row['q117a']; ?>" required data-format="dd/dd/dddd" data-number="<?php echo $row['q117a']; ?>" placeholder="MM/DD/YYYY" />
								</div>
							</div>
						</div>
						
						
						<div class="row">
							<div class="col-sm-12">
								<hr>
								<h4>10. Any prior bankruptcies?</h4>
							</div>
							
							
							<div class="col-sm-4">
								<div class="form-group">
									<label style="font-size:14px;" for="">Business</label>
									<label style="font-size:13px" class="radio-inline">
										<input type="radio" name="q120" <?php if($row['q120']==1){ echo "checked"; } ?>  value="1" required> Yes
									</label>
									<label style="font-size:13px" class="radio-inline">
										<input type="radio" name="q120" <?php if($row['q120']==2){ echo "checked"; } ?>  value="2" required> No
									</label>
								</div>
								
								<div class="form-group mt-10">
									<label style="font-size:13px" for="q122">If yes, filling date</label>
									<input class="form-control bfh-phone" autocomplete="off" name="q122" id="q122" value="<?php echo $row['q122']; ?>" data-format="dd/dd/dddd" data-number="<?php echo $row['q122']; ?>" placeholder="MM/DD/YYYY" />
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group">
									<label style="font-size:14px;" for="">Personal</label>
									<label style="font-size:13px" class="radio-inline">
										<input type="radio" name="q121" <?php if($row['q121']==1){ echo "checked"; } ?>  value="1" required> Yes
									</label>
									<label style="font-size:13px" class="radio-inline">
										<input type="radio" name="q121" <?php if($row['q121']==2){ echo "checked"; } ?>  value="2" required> No
									</label>
								</div>
								
								<div class="form-group mt-10">
									<label style="font-size:13px" for="q122a">If yes, filling date</label>
									<input class="form-control bfh-phone" autocomplete="off" name="q122a" id="q122a" value="<?php echo $row['q122a']; ?>" data-format="dd/dd/dddd" data-number="<?php echo $row['q122a']; ?>" placeholder="MM/DD/YYYY" />
								</div>
							</div>
						</div>
						
						
						<div class="row">
							<div class="col-sm-12">
								<hr>
								<h4>11. Banking Information</h4>
							</div>
							
							
							<div class="col-sm-12">
								<div class="form-group">
									<label style="font-size:13px" for="q123">Name of bank</label>
									<input type="text" class="form-control" name="q123" id="q123" value="<?php echo $row['q123']; ?>" required>
								</div>
							</div>
							
							<div class="col-sm-3">
								<div class="form-group">
									<label style="font-size:13px" for="q124a">Phone number</label>
									<input type="text" class="form-control bfh-phone" data-country="US" name="q124a" id="q124a" value="<?php echo $row['q124a']; ?>" data-number="<?php echo $row['q124a']; ?>" required>	
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group">
									<label style="font-size:13px" for="q125">Routing number</label>
									<input type="text" class="form-control" name="q125" id="q125" value="<?php echo $row['q125']; ?>" required>
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="form-group">
									<label style="font-size:13px" for="q126a">Account number</label>
									<input type="text" class="form-control" name="q126a" id="126a" value="<?php echo $row['q126a']; ?>" required>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group">
									<label style="font-size:13px; display:block" for="exampleInputEmail1">Account type</label>
									<label style="font-size:13px" class="radio-inline">
										<input type="radio" name="q126" <?php if($row['q126']==1){ echo "checked"; } ?>  value="1" required > Checking Account
									</label>
									<label style="font-size:13px" class="radio-inline">
										<input type="radio" name="q126" <?php if($row['q126']==2){ echo "checked"; } ?>  value="2" required > Saving Account
									</label>
									<label style="font-size:13px" class="radio-inline">
										<input type="radio" name="q126" <?php if($row['q126']==3){ echo "checked"; } ?>  value="3" required > General Ledger
									</label>
								</div>
							</div>
						</div>
						
						
						<div class="row">
							<div class="col-sm-12">
								<hr>
								<h4>12. Description of the products and/or services that you sell</h4>
							</div>
							
							
							<div class="col-sm-12">
								<div class="form-group">
									<textarea type="text" class="form-control" name="q127" id="q127" rows="5"><?php echo $row['q127']; ?></textarea>
								</div>
							</div>
							
						</div>
						
						
						<div class="row">
							<div class="col-sm-12">
								<hr>
								<h4>13. Other</h4>
							</div>
							
							
							<div class="col-sm-12">
								<div class="form-group">
									<label style="font-size:14px;" for="">Do you plan to integrate this payment into a software or point of sale system?</label>
									<label style="font-size:13px" class="radio-inline">
										<input type="radio" name="q155" <?php if($row['q155']==1){ echo "checked"; } ?>  value="1" required> Yes
									</label>
									<label style="font-size:13px" class="radio-inline">
										<input type="radio" name="q155" <?php if($row['q155']==2){ echo "checked"; } ?>  value="2" required> No
									</label>
								</div>
							</div>
							
							<div class="col-sm-8">
								<div class="form-group">
									<label style="font-size:13px" for="q156">If yes, Which Software or POS?</label>
									<input class="form-control" autocomplete="off" name="q156" id="q156" value="<?php echo $row['q156']; ?>" />
								</div>
							</div>
							
							
							<div class="col-sm-12">
								<div class="form-group">
									<label style="font-size:14px;" for="">Were you referred by your bank?</label>
									<label style="font-size:13px" class="radio-inline">
										<input type="radio" name="q157" <?php if($row['q157']==1){ echo "checked"; } ?>  value="1" required> Yes
									</label>
									<label style="font-size:13px" class="radio-inline">
										<input type="radio" name="q157" <?php if($row['q157']==2){ echo "checked"; } ?>  value="2" required> No
									</label>
								</div>
							</div>
							
							<div class="col-sm-5">
								<div class="form-group">
									<label style="font-size:13px;" for="">If yes, Which bank?</label>
									<select class="form-control" name="q158" id="158" onchange="SelectBranch()">
										<option value="0" <?php if($row['q158']==0){ echo "selected"; } ?>></option>
										<option value="1" <?php if($row['q158']==1){ echo "selected"; } ?>>Avid Bank</option>
										<option value="2" <?php if($row['q158']==2){ echo "selected"; } ?>>Bridge Bank</option>
										<option value="3" <?php if($row['q158']==3){ echo "selected"; } ?>>Heritage Bank of Commerce</option>
										<option value="4" <?php if($row['q158']==4){ echo "selected"; } ?>>First Republic Bank</option>
										<option value="5" <?php if($row['q158']==5){ echo "selected"; } ?>>Meriwest</option>
										<option value="6" <?php if($row['q158']==6){ echo "selected"; } ?>>Oak Valley Community Bank</option>
										<option value="7" <?php if($row['q158']==7){ echo "selected"; } ?>>Santa Cruz Community Credit Union</option>
										<option value="8" <?php if($row['q158']==8){ echo "selected"; } ?>>Trivalley</option>
										<option value="9" <?php if($row['q158']==9){ echo "selected"; } ?>>Other</option>
									</select>
								</div>
								
								
								
								<div class="form-group" id="q158a" style="display:none">
									<label style="font-size:13px;" for="">Bank name?</label>
									<input class="form-control" autocomplete="off" type="text"  name="q158a" id="158a" value="<?php echo $row['q158a']; ?>" />
								</div>
								
								
								<div class="form-group" id="q158b" style="display:none">
									<label style="font-size:13px;" for="">Which Branch?</label>
									<input class="form-control" autocomplete="off" type="text"  name="q158b" id="158b" value="<?php echo $row['q158b']; ?>" />
								</div>
								
								
								<div class="form-group" id="q159" style="display:none">
									<label style="font-size:13px;" for="">Which Branch?</label>
									<select class="form-control" id="159" name="q159"></select>
								</div>
								
								<div class="form-group" id="q160" style="display:none">
									<label style="font-size:13px;" for="">What employee referred you?</label>
									<input class="form-control" autocomplete="off" type="text"  name="q160" id="q160" value="<?php echo $row['q160']; ?>" />
								</div>
								
							</div>
							
						</div>
						
						
						<div class="row">
							<div class="col-sm-12">
								<hr>
								<h4>14. Upload Documents</h4>
							</div>
							
							
							<div class="col-sm-12">
								<div class="form-group">
									<label style="font-size:13px" for="q129">Upload a cancelled check</label>
									
									<input <?php if($row['q129']){ echo ' style="display:none" '; } ?> class="input-file" autocomplete="off" type="file"  name="q129" id="129"/>
									
									<?php if($row['q129']){ ?>
									<p id="doc129"><a class="btn btn-info btn-sm mr-5 mb-5" href="<?php echo $site_url; ?>/uploads/<?php echo $row['q129']; ?>" target="_blank">View Uploaded Document</a> 
									<a class="btn btn-danger btn-sm mr-5 mb-5" onclick="removedoc('129')">Remove Uploaded Document</a></p>
									<?php } ?>
								</div>
							</div>
							
							
							<div class="col-sm-12">
								<div class="form-group">
									<label style="font-size:13px" for="q131">Upload an image of your driver’s license</label>
									<input <?php if($row['q131']){ echo ' style="display:none" '; } ?> class="input-file" autocomplete="off" type="file"  name="q131" id="131"/>
									
									<?php if($row['q131']){ ?>
									<p id="doc131"><a href="<?php echo $site_url; ?>/uploads/<?php echo $row['q131']; ?>" target="_blank" class="btn btn-info btn-sm mr-5 mb-5">View Uploaded Document</a> <a class="btn btn-danger btn-sm mr-5 mb-5" onclick="removedoc('131')">Remove Uploaded Document</a></p>
									<?php } ?>
									
								</div>
							</div>
							
							
							<div class="col-sm-12">
								<div class="form-group">
									<label style="font-size:13px" for="q125">Upload three months of processing statements</label>
									<input <?php if($row['q133']){ echo ' style="display:none" '; } ?> class="input-file" autocomplete="off" type="file"  name="q133" id="133"/>
									
									<?php if($row['q133']){ ?>
									<p id="doc133"><a href="<?php echo $site_url; ?>/uploads/<?php echo $row['q133']; ?>" target="_blank" class="btn btn-info btn-sm mr-5 mb-5">View Uploaded Document</a> <a class="btn btn-danger btn-sm mr-5 mb-5" onclick="removedoc('133')">Remove Uploaded Document</a></p>
									<?php } ?>
									
								</div>
							</div>
							
						</div>
						
						
						<div class="row">
							<div class="col-sm-12">
								<hr>
									<p>You will need to digitally  sign in three places. Please call us at 1-855-360-0360 if you have any questions or concerns.</p>
								<hr>
							</div>
							
							<div class="col-sm-12">
								<button type="submit" class="btn btn-success mb-10">Continue to Sign your Document</button>
								<button type="button" class="btn btn-danger mb-10" onclick="saveClose()">Save for Later</button>
							</div>
						</div>
						
					</form>
				</div>
			</section>
	   </div>
	</div>
	
	<div id="b1" style="display:none">
		<option value="0" <?php if($row['q159']==0){ echo "selected"; } ?> ></option>
		<option value="1" <?php if($row['q159']==1){ echo "selected"; } ?> >Danville</option>
		<option value="2" <?php if($row['q159']==2){ echo "selected"; } ?> >Fremont</option>
		<option value="3" <?php if($row['q159']==3){ echo "selected"; } ?> >Gilroy</option>
		<option value="4" <?php if($row['q159']==4){ echo "selected"; } ?> >Hollister</option>
		<option value="5" <?php if($row['q159']==5){ echo "selected"; } ?> >Los Altos</option>
		<option value="6" <?php if($row['q159']==6){ echo "selected"; } ?> >Los Gatos</option>
		<option value="7" <?php if($row['q159']==7){ echo "selected"; } ?> >Morgan Hill</option>
		<option value="8" <?php if($row['q159']==8){ echo "selected"; } ?> >Pleasanton</option>
		<option value="9" <?php if($row['q159']==9){ echo "selected"; } ?> >San Jose</option>	
		<option value="10" <?php if($row['q159']==10){ echo "selected"; } ?> >Sunnyvale</option>	
		<option value="11" <?php if($row['q159']==11){ echo "selected"; } ?> >Walnut Creek</option>	
	</div>
	
	<div id="b2" style="display:none">
		<option value="12" <?php if($row['q159']==12){ echo "selected"; } ?> ></option>
		<option value="13" <?php if($row['q159']==13){ echo "selected"; } ?> >Burlingame</option>
		<option value="14" <?php if($row['q159']==14){ echo "selected"; } ?> >Cupertino</option>
		<option value="15" <?php if($row['q159']==15){ echo "selected"; } ?> >Danville</option>
		<option value="16" <?php if($row['q159']==16){ echo "selected"; } ?> >Palo Alto</option>
		<option value="17" <?php if($row['q159']==17){ echo "selected"; } ?> >Orinda/Oakland</option>
		<option value="18" <?php if($row['q159']==18){ echo "selected"; } ?> >San Mateo</option>
		<option value="19" <?php if($row['q159']==19){ echo "selected"; } ?> >Millbrae</option>
		<option value="20" <?php if($row['q159']==20){ echo "selected"; } ?> >Redwood City</option>
		<option value="21" <?php if($row['q159']==21){ echo "selected"; } ?> >Livermore</option>
		<option value="22" <?php if($row['q159']==22){ echo "selected"; } ?> >Walnut Creek</option>
		<option value="23" <?php if($row['q159']==23){ echo "selected"; } ?> >Los Altos</option>
		<option value="24" <?php if($row['q159']==24){ echo "selected"; } ?> >San Jose</option>
		<option value="25" <?php if($row['q159']==25){ echo "selected"; } ?> >Menlo Park</option>
		<option value="26" <?php if($row['q159']==26){ echo "selected"; } ?> >Sunnyvale</option>
		<option value="27" <?php if($row['q159']==27){ echo "selected"; } ?> >Los Gatos</option>
		<option value="28" <?php if($row['q159']==28){ echo "selected"; } ?> >Pleasanton</option>
		<option value="29" <?php if($row['q159']==29){ echo "selected"; } ?> >San Jose (The Alameda)</option>
	</div>
	
	<div id="b3" style="display:none">
		<option value="30" <?php if($row['q159']==30){ echo "selected"; } ?> ></option>
		<option value="31" <?php if($row['q159']==31){ echo "selected"; } ?> >Oakdale (Corporate)</option>
		<option value="32" <?php if($row['q159']==32){ echo "selected"; } ?> >Oakdale (3rd Ave)</option>
		<option value="33" <?php if($row['q159']==33){ echo "selected"; } ?> >Sonora Downtown</option>
		<option value="34" <?php if($row['q159']==34){ echo "selected"; } ?> >Sonora East</option>
		<option value="35" <?php if($row['q159']==35){ echo "selected"; } ?> >Modesto (12th & I)</option>
		<option value="36" <?php if($row['q159']==36){ echo "selected"; } ?> >Modesto (Dale)</option>
		<option value="37" <?php if($row['q159']==37){ echo "selected"; } ?> >Modesto (McHenry)</option>
		<option value="38" <?php if($row['q159']==38){ echo "selected"; } ?> >Turlock</option>
		<option value="39" <?php if($row['q159']==39){ echo "selected"; } ?> >Patterson</option>
		<option value="40" <?php if($row['q159']==40){ echo "selected"; } ?> >Escalon</option>
		<option value="41" <?php if($row['q159']==41){ echo "selected"; } ?> >Ripon</option>
		<option value="42" <?php if($row['q159']==42){ echo "selected"; } ?> >Stockton</option>
		<option value="43" <?php if($row['q159']==43){ echo "selected"; } ?> >Manteca</option>
		<option value="44" <?php if($row['q159']==44){ echo "selected"; } ?> >Tracy</option>
	</div>
	
	<div id="b4" style="display:none">
		<option value="45" <?php if($row['q159']==45){ echo "selected"; } ?> ></option>
		<option value="46" <?php if($row['q159']==46){ echo "selected"; } ?> >Livermore</option>
		<option value="47" <?php if($row['q159']==47){ echo "selected"; } ?> >San Ramon</option>
	</div>
	
	<script>
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
		
	</script>

	<!-- begin olark code -->
	<script type="text/javascript" async> ;(function(o,l,a,r,k,y){if(o.olark)return; r="script";y=l.createElement(r);r=l.getElementsByTagName(r)[0]; y.async=1;y.src="//"+a;r.parentNode.insertBefore(y,r); y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)}; y.extend=function(i,j){y("extend",i,j)}; y.identify=function(i){y("identify",k.i=i)}; y.configure=function(i,j){y("configure",i,j);k.c[i]=j}; k=y._={s:[],t:[+new Date],c:{},l:a}; })(window,document,"static.olark.com/jsclient/loader.js");
	/* custom configuration goes here (www.olark.com/documentation) */
	olark.identify('4988-702-10-6055');</script>
	<!-- end olark code -->
  </body>
</html>
<?php } ?>
