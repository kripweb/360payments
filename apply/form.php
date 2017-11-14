<?php
	session_start();
	require_once('ajax/config.php');
	
	$user_id = $_SESSION['user_id'];
	
	
	$user_query = "SELECT * FROM user_answers WHERE id='$user_id'";
	$user_query = mysqli_query($mysqli, $user_query);
	$total = mysqli_num_rows($user_query);
	$row = mysqli_fetch_assoc($user_query);
	
	if(!$row['qn1']){$row['qn1']=$row['email'];}
	if(!$row['q111']){$row['q111']=$row['firstname']." ".$row['lastname'];}
	
	if(!$row['q92']){$row['q92']=1;}
	if(!$row['q103']){$row['q103']=2;}
	if(!$row['q120']){$row['q120']=2;}
	if(!$row['q121']){$row['q121']=2;}
	if(!$row['q115']){$row['q115']=100;}
	if(!$row['q126']){$row['q126']=1;}
	
	if(!$row['q96']){$row['q96']=2;}
	if(!$row['q155']){$row['q155']=2;}
	if(!$row['q157']){$row['q157']=2;}
	
	if(!$row['q94']){$row['q94']=1;}
	
	
	
	
	
	$update = "Update user_answers SET status='1' WHERE id='$user_id'";
	$update = mysqli_query($mysqli, $update);
	
	$cid = $row['cid'];
	$pid = $row['pid'];
	if(!$pid) {
		$pid=1;
	}
	
	if($total<=0) {
		header('Location:'.$site_url); 
	} else {
		
		
	if(isset($_POST['q80'])){
		$uploaddir = "uploads/";
		//Upload Documents to server.
		$bname = str_replace(" ", "_", $_POST['q80']);
		if(!file_exists($_FILES['q129']['tmp_name']) || !is_uploaded_file($_FILES['q129']['tmp_name'])) {
			$data['q129']="";
		} else {
			$path = $_FILES['q129']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			
			$name = $user_id."-".$bname."-".time()."-check.".$ext;
			$uploadfile = $uploaddir.$name;
			move_uploaded_file($_FILES['q129']['tmp_name'], $uploadfile);
			$data['q129']=$name;
		}
		
		
		if(!file_exists($_FILES['q131']['tmp_name']) || !is_uploaded_file($_FILES['q131']['tmp_name'])) {
			$data['q131']="";
		} else {
			$path = $_FILES['q131']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			
			$name = $user_id."-".$bname."-".time()."-DL.".$ext;
			$uploadfile = $uploaddir.$name;
			move_uploaded_file($_FILES['q131']['tmp_name'], $uploadfile);
			$data['q131']=$name;
		}
		
		if(!file_exists($_FILES['q133']['tmp_name']) || !is_uploaded_file($_FILES['q133']['tmp_name'])) {
			$data['q133']="";
		} else {
			$path = $_FILES['q133']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			
			$name = $user_id."-".$bname."-".time()."-statement.".$ext;
			$uploadfile = $uploaddir.$name;
			move_uploaded_file($_FILES['q133']['tmp_name'], $uploadfile);
			$data['q133']=$name;
		}
		
		$data['q113'] = $_POST['q113a']." ".$_POST['q113b']." ".$_POST['q113c']." ".$_POST['q113d']." ".$_POST['q113e'];		
		$update_data = mysql_update_array('user_answers', $data, $row['id'], array());
		
		
		header('Location:'.$site_url.'/review/'); 
		
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
	
	<link href="<?php echo $site_url; ?>/plugins/datepicker/datepicker3.css" rel="stylesheet">
	<script src="<?php echo $site_url; ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
	
	<!-- Bootstrap Helper -->
    <link href="<?php echo $site_url; ?>/plugins/bs-helper/dist/css/bootstrap-formhelpers.min.css" rel="stylesheet">
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
				<div class="wizard col-sm-12">
					<div class="wizard-inner">
						<div class="connecting-line"></div>
						<ul class="nav nav-tabs" role="tablist">


							<li role="presentation" class="active">
								<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
									<span class="round-tab">
										1
									</span>
								</a>
							</li>
							<li role="presentation" class="disabled">
								<a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
									<span class="round-tab">
										2
									</span>
								</a>
							</li>

							<li role="presentation" class="disabled">
								<a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
									<span class="round-tab">
										3
									</span>
								</a>
							</li>
						</ul>
					</div>

					<form role="form" id="mainform" method="post" enctype="multipart/form-data">
						<div class="tab-content">
							
							<div class="tab-pane active" role="tabpanel" id="step1">
								<div class="question">
									Please answer the following questions about your business. All questions are required.
								</div>
								<!--Q80-->
								<div id="question_80" class="question">
									<div class="media">
									  <div class="media-left">
										1.
									  </div>
									  <div class="media-body">
										What is the legal name of your business (Max 25 characters)? <span data-toggle="tooltip" data-placement="auto" title="What you use for taxes and state filings." style="font-size:16px; cursor:pointer;"><i class="glyphicon glyphicon-question-sign" ></i></span>
										<input class="form-input required" maxlength="25" autocomplete="off" type="text"  name="q80" id="80" value="<?php echo $row['q80']; ?>" />
										<p class="error" id="error_80"></p>
									  </div>
									</div>
								</div>
									
								<!--Q81-->
								<div id="question_81a" class="question">
									<div class="media">
									  <div class="media-left">
										2.
									  </div>
									  <div class="media-body">
										Do you use a different DBA name? 
										<select class="form-input required input-small" id="81a" show="81" showon='1' condition='1'>
											<option value="0" <?php if($row['q81a']==0){ echo "selected"; } ?>></option>
											<option value="1" <?php if($row['q81a']==1){ echo "selected"; } ?>>Yes</option>
											<option value="2" <?php if($row['q81a']==2){ echo "selected"; } ?>>No</option>
										</select>
									  </div>
									</div>
								</div>	
								
								
								<div id="question_81" class="question" style="display:none">
									<div class="media">
									  <div class="media-left">
										&nbsp; &nbsp;
									  </div>
									  <div class="media-body">
										What is your DBA name (Max 25 characters)? <input maxlength="25" class="form-input required" autocomplete="off" type="text"  name="q81" id="81" value="<?php echo $row['q81']; ?>" />
										<p class="error" id="error_81"></p>
									  </div>
									</div>
								</div>
								
								<!--Q82-->
								<div id="question_82" class="question">
									<div class="media">
									  <div class="media-left">
										3.
									  </div>
									  <div class="media-body">
											What is your business’s legal address (what you use for taxes and state filings)?

											<table class="table table-bordered mt-20" >
												<tr>
													<td class="lefthead">Address</td>
													<td>
														<input class="form-input required" autocomplete="off" type="text" name="q82" id="82" value="<?php echo $row['q82']; ?>" />
														<p class="error" id="error_82"></p>
													</td>
													
												</tr>
												
												<tr>
													<td class="lefthead">Suite</td>
													<td>
														<input class="form-input required" autocomplete="off" placeholder="" type="text" name="q82a" id="82a" value="<?php echo $row['q82a']; ?>" />
														<p class="error" id="error_82a"></p>
													</td>
												</tr>
												
												<tr>
													<td class="lefthead">City</td>
													<td>
														<input class="form-input required" autocomplete="off" placeholder="" type="text" name="q82b" id="82b" value="<?php echo $row['q82b']; ?>" />
														<p class="error" id="error_82b"></p>
													</td>
												</tr>
												
												<tr>
													<td class="lefthead">State</td>
													<td>
														<input class="form-input required" autocomplete="off" placeholder="" type="text" name="q82c" id="82c" value="<?php echo $row['q82c']; ?>" />
														<p class="error" id="error_82c"></p>
													</td>
												</tr>
												
												<tr>
													<td class="lefthead">Zip</td>
													<td>
														<input class="form-input required" autocomplete="off" placeholder="" type="text" name="q82d" id="82d" value="<?php echo $row['q82d']; ?>" />
														<p class="error" id="error_82d"></p>
													</td>
												</tr>
											</table>	
										</div>
									</div>
								</div>
								
								<!--Q83-->
								
								<div id="question_83" class="question">
									<div class="media">
									  <div class="media-left">
										4.
									  </div>
									  <div class="media-body">
											Is your physical address the same as your legal address? 
											<select class="form-input required input-small" id="83p" onchange="PhysicalAddress()" >
												<option value="0" <?php if($row['q83a']==0){ echo "selected"; } ?>></option>
												<option value="1" <?php if($row['q83a']==1){ echo "selected"; } ?>>Yes</option>
												<option value="2" <?php if($row['q83a']==2){ echo "selected"; } ?>>No</option>
											</select>

											<table class="table table-bordered mt-20" style="display:none" id="sphysical">
												<tr>
													<td class="lefthead">Address</td>
													<td>
														<input class="form-input required" autocomplete="off" type="text" name="q83" id="83" value="<?php echo $row['q83']; ?>" />
														<p class="error" id="error_83"></p>
													</td>
													
												</tr>
												
												<tr>
													<td class="lefthead">Suite</td>
													<td>
														<input class="form-input required" autocomplete="off" placeholder="" type="text" name="q83a" id="83a" value="<?php echo $row['q83a']; ?>" />
														<p class="error" id="error_83a"></p>
													</td>
												</tr>
												
												<tr>
													<td class="lefthead">City</td>
													<td>
														<input class="form-input required" autocomplete="off" placeholder="" type="text" name="q83b" id="83b" value="<?php echo $row['q83b']; ?>" />
														<p class="error" id="error_83b"></p>
													</td>
												</tr>
												
												<tr>
													<td class="lefthead">State</td>
													<td>
														<input class="form-input required" autocomplete="off" placeholder="" type="text" name="q83c" id="83c" value="<?php echo $row['q83c']; ?>" />
														<p class="error" id="error_83c"></p>
													</td>
												</tr>
												
												<tr>
													<td class="lefthead">Zip</td>
													<td>
														<input class="form-input required" autocomplete="off" placeholder="" type="text" name="q83d" id="83d" value="<?php echo $row['q83d']; ?>" />
														<p class="error" id="error_83d"></p>
													</td>
												</tr>
											</table>	
										</div>
									</div>
								</div>
								
								
								
								<!--Q84-->
								<div id="question_84" class="question">
									<div class="media">
									  <div class="media-left">
										5.
									  </div>
									  <div class="media-body">
										What is your website? <input class="form-input required" autocomplete="off" type="text"  name="q84" id="84" value="<?php echo $row['q84']; ?>" />
										<p class="error" id="error_84"></p>
									  </div>
									</div>
								</div>
								
								<!--Q85-->
								<div id="question_85" class="question">
									<div class="media">
									  <div class="media-left">
										6.
									  </div>
									  <div class="media-body">
										What is your phone number? (Enter numbers only)
										<input class="form-input bfh-phone" data-country="US" autocomplete="off" type="text" name="q85a" id="85a" value="<?php echo $row['q85a']; ?>" data-number="<?php echo $row['q85a']; ?>"  required />
										<p class="error" id="error_85"></p>
									  </div>
									</div>
								</div>
								
								
								<div id="question_84" class="question">
									<div class="media">
									  <div class="media-left">
										7.
									  </div>
									  <div class="media-body">
										What is your email address? <input class="form-input required" autocomplete="off" type="email"  name="qn1" id="n1" value="<?php echo $row['qn1']; ?>" style="max-width:100%; width:auto;" />
										<p class="error" id="error_n1"></p>
									  </div>
									</div>
								</div>
								
								
								<button type="button" class="btn btn-success next-step1" onclick="save()">Save and Continue</button>
								<button type="button" class="btn btn-danger" onclick="saveClose()">Save for Later</button>
								
								<p class="mt-15 text-center"><i>We take your privacy and security seriously and are committed to protecting your data from unauthorized access. All information you provide to us is transmitted over a secure encrypted gateway. We will never disclose or sell your information to any third party, except as required by law.</i></p>
							</div>
							
							<div class="tab-pane" role="tabpanel" id="step2">
								<!--Q91-->
								<div id="question_91" class="question">
									<div class="media">
									  <div class="media-left">
										8.
									  </div>
									  <div class="media-body">
										What type of business entity do you operate?
										<select name="q91" class="form-input required2 input-small" id="91" onchange="change15()">
										<option value="0" <?php if($row['q91']==0){ echo "selected"; } ?>></option>
										<option value="1" <?php if($row['q91']==1){ echo "selected"; } ?>>Sole Proprietorship</option>
										<option value="2" <?php if($row['q91']==2){ echo "selected"; } ?>>LLC</option>
										<option value="3" <?php if($row['q91']==3){ echo "selected"; } ?>>Partnership</option>
										<option value="4" <?php if($row['q91']==4){ echo "selected"; } ?>>Ltd Liability Partnership</option>
										<option value="5" <?php if($row['q91']==5){ echo "selected"; } ?>>Government Entity</option>
										<option value="6" <?php if($row['q91']==6){ echo "selected"; } ?>>Trust</option>
										<option value="7" <?php if($row['q91']==7){ echo "selected"; } ?>>Professional Association</option>
										<option value="8" <?php if($row['q91']==8){ echo "selected"; } ?>>Political Organization</option>
										<option value="9" <?php if($row['q91']==9){ echo "selected"; } ?>>Public Corporation</option>
										<option value="10" <?php if($row['q91']==10){ echo "selected"; } ?>>Private Corporation</option>
										<option value="11" <?php if($row['q91']==11){ echo "selected"; } ?>>Non Profit Corporation</option>
										</select>
										<p class="error" id="error_91"></p>
										</div>
									</div>
								</div>
								
								<!--Q92 & Q93-->
								<div id="question_92" class="question">
									 <div class="media">
									  <div class="media-left">
										9.
									  </div>
									  <div class="media-body">
									  
										Have you ever accepted credit cards before?  
										<select name="q92" class="form-input required2 input-small" id="92" show="94" showon='1' condition='1'>
											<option value="0" <?php if($row['q92']==0){ echo "selected"; } ?>></option>
											<option value="1" <?php if($row['q92']==1){ echo "selected"; } ?>>Yes</option>
											<option value="2" <?php if($row['q92']==2){ echo "selected"; } ?>>No</option>
										</select>
										
										<p class="error" id="error_92"></p>
										
									</div>
									</div>
								</div>
								
								<!--Q94 & Q95-->
								<div id="question_94" class="question" <?php if($row['q92']==1){} else {echo 'style="display:none"'; } ?> >
									<div class="media">
									  <div class="media-left">
										&nbsp; &nbsp;
									  </div>
									  <div class="media-body">
									  <p>What was the processor’s name? <input class="form-input " autocomplete="off" type="text"  name="q93" id="93" value="<?php echo $row['q93']; ?>" /> </p>
									  <p>How many locations? <input class="form-input input-small" autocomplete="off" type="text" name="q94" id="94" value="<?php echo $row['q94']; ?>" /></p>
									<!--<p>If your former processor was TransFirst, please provide your Merchant ID number.
									<input class="form-input required" autocomplete="off" type="text"  name="q95" id="95" value="<?php echo $row['q95']; ?>" />  <span data-toggle="tooltip" data-placement="auto" title="If you don't know your Merchant ID number, please enter 1111 for now. We will help you find the correct number later." style="font-size:16px; cursor:pointer;"><i class="glyphicon glyphicon-question-sign" ></i></span></p>-->
									<p class="error" id="error_94"></p>
									<p class="error" id="error_95"></p>
									</div>
									</div>
								</div>
								
								<!--Q96-->
								<div id="question_96" class="question">
									 <div class="media">
									  <div class="media-left">
										10.
									  </div>
									  <div class="media-body">
									  Do you bill your customers prior to goods being shipped?
									<select name="q96" class="form-input required2 input-small" id="96" show="97" showon='1' condition='1'>
									<option value="0" <?php if($row['q96']==0){ echo "selected"; } ?>></option>
									<option value="1" <?php if($row['q96']==1){ echo "selected"; } ?>>Yes</option>
									<option value="2" <?php if($row['q96']==2){ echo "selected"; } ?>>No</option>
									</select>
									<p class="error" id="error_96"></p>
									</div>
									</div>
								</div>
								
								<!--Q97-->
								<div id="question_97" class="question" style="display:none">
									<div class="media">
									  <div class="media-left">
										
									  </div>
									  <div class="media-body">
									In how many days?
									<select name="q97" class="form-input input-small" id="97">
									<option value="0" <?php if($row['q97']==0){ echo "selected"; } ?>></option>
									<option value="1" <?php if($row['q97']==1){ echo "selected"; } ?>>0-2 days</option>
									<option value="2" <?php if($row['q97']==2){ echo "selected"; } ?>>3-30 days</option>
									<option value="3" <?php if($row['q97']==3){ echo "selected"; } ?>>31-60 days</option>
									<option value="4" <?php if($row['q97']==4){ echo "selected"; } ?>>61-90 days</option>
									<option value="5" <?php if($row['q97']==5){ echo "selected"; } ?>>over 90 days</option>
									</select>
									<p class="error" id="error_97"></p>
									</div>
									</div>
								</div>
								
								<!--Q98, Q99, Q100, Q101-->
								<div id="question_98" class="question">
									<div class="media">
									  <div class="media-left">
										11.
									  </div>
									  <div class="media-body">
									What methods do you use for processing credit cards?
									
									<table class="table table-bordered mt-20 fs-22 tableshort">
									<tr>
									<td class="lefthead w80">Card swiped transaction</td>
									<td><input class="tbl-input form-input required2 input-small" autocomplete="off" type="number"  name="q98" id="98" value="<?php echo $row['q98']; ?>" onkeyup="total100()" />%</td>
									</tr>
									<tr>
									<td class="lefthead w80">Manually keyed <br>(<small>card present</small>)</td>
									<td><input class="tbl-input form-input required2 input-small" autocomplete="off" type="number"  name="q99" id="99" value="<?php echo $row['q99']; ?>" onkeyup="total100()" />%</td>
									</tr>
									<tr>
									<td class="lefthead w80">Manually keyed <br>(<small>card not present and/or mail order/telephone order</small>)</td>
									<td><input class="tbl-input form-input required2 input-small" autocomplete="off" type="number"  name="q100" id="100" value="<?php echo $row['q100']; ?>" onkeyup="total100()" />%</td>
									</tr>
									<tr>
									<td class="lefthead w80">eCommerce <br>(<small>card not present</small>)</td>
									<td><input class="tbl-input form-input required2 input-small" autocomplete="off" type="number"  name="q101" id="101" value="<?php echo $row['q101']; ?>" onkeyup="total100()" />%</td>
									</tr>
									<tr>
									<td class="lefthead w80">Total <br>(<small>must equal 100%</small>)</td>
									<td class="text-center" id="total100"><?php echo $row['q98']+$row['q99']+$row['q100']+$row['q101']; ?> %</td>
									</tr>
								 </table>
									<p class="error" id="error_98"></p>
									<p class="error" id="error_99"></p>
									<p class="error" id="error_100"></p>
									<p class="error" id="error_101"></p>
									</div>
									</div>
								</div>
								
								<!--Q102-->
								<div id="question_102" class="question">
									<div class="media">
									  <div class="media-left">
										12.
									  </div>
									<div class="media-body">
									What percentage of your sales are business to business (must be 0-100%)
									<input class="form-input required2 input-small" autocomplete="off" type="number"  name="q102" id="102" value="<?php echo $row['q102']; ?>" />%</td>
									<p class="error" id="error_102"></p>
									</div>
									</div>
								</div>
							
							<!--Q103-->
							<div id="question_103" class="question">
								 <div class="media">
									  <div class="media-left">
										13.
									  </div>
									  <div class="media-body">
								 Does your business close completely for entire months out of the year?
								<select name="q103" class="form-input required2 input-small" id="103" show="104" showon='1' condition='1'>
									<option value="0" <?php if($row['q103']==0){ echo "selected"; } ?>></option>
									<option value="1" <?php if($row['q103']==1){ echo "selected"; } ?>>Yes</option>
									<option value="2" <?php if($row['q103']==2){ echo "selected"; } ?>>No</option>
								</select>
								<p class="error" id="error_103"></p>
								</div>
								</div>
							</div>
							
							<!--Q104-->
							<div id="question_104" class="question" <?php if($row['q103']==1){} else {echo 'style="display:none"'; } ?> >
							<div class="media">
							  <div class="media-left">
								
							  </div>
							  <div class="media-body">
									  During which months?
									
							<div><label><input class="checkbox-input form-input required" name="q104a" id="104a" type="checkbox" value="1" <?php if($row['q104a']==1){ echo "checked"; } ?> /> JAN</label></div>
									
							<div><label><input class="checkbox-input form-input required" name="q104b" id="104b" type="checkbox" value="2" <?php if($row['q104b']==2){ echo "checked"; } ?> /> FEB</label></div>
										
							<div><label><input class="checkbox-input form-input required" name="q104c" id="104c" type="checkbox" value="3" <?php if($row['q104c']==3){ echo "checked"; } ?> /> MAR</label></div>
										
							<div><label><input class="checkbox-input form-input required" name="q104d" id="104d" type="checkbox" value="4" <?php if($row['q104d']==4){ echo "checked"; } ?> /> APR</label></div>
										
							<div><label><input class="checkbox-input form-input required" name="q104e" id="104e" type="checkbox" value="5" <?php if($row['q104e']==5){ echo "checked"; } ?> /> MAY</label></div>
										
							<div><label><input class="checkbox-input form-input required" name="q104f" id="104f" type="checkbox" value="6" <?php if($row['q104f']==6){ echo "checked"; } ?> /> JUN</label></div>
										
							<div><label><input class="checkbox-input form-input required" name="q104g" id="104g" type="checkbox" value="7" <?php if($row['q104g']==7){ echo "checked"; } ?> /> JUL</label></div>
										
							<div><label><input class="checkbox-input form-input required" name="q104h" id="104h" type="checkbox" value="8" <?php if($row['q104h']==8){ echo "checked"; } ?> /> AUG</label></div>
										
							<div><label><input class="checkbox-input form-input required" name="q104i" id="104i" type="checkbox" value="9" <?php if($row['q104i']==9){ echo "checked"; } ?> /> SEP</label></div>
										
							<div><label><input class="checkbox-input form-input required" name="q104j" id="104j" type="checkbox" value="10" <?php if($row['q104j']==10){ echo "checked"; } ?> /> OCT</label></div>
										
							<div><label><input class="checkbox-input form-input required" name="q104k" id="104k" type="checkbox" value="11" <?php if($row['q104k']==11){ echo "checked"; } ?> /> NOV</label></div>
										
							<div><label><input class="checkbox-input form-input required" name="q104l" id="104l" type="checkbox" value="12" <?php if($row['q104l']==12){ echo "checked"; } ?> /> DEC</label></div>
							<p class="error" id="error_104" ></p>
							</div>
							</div>
							</div>
								
						<!--Q105, Q106, Q107-->
						<div id="question_105" class="question">
						<div class="media">
						  <div class="media-left">
							14.
						  </div>
						  <div class="media-body">
						What type of business do you operate?
						<div><label><input class="checkbox-input form-input required" name="q105a" id="105a" type="checkbox" value="1" <?php if($row['q105a']==1){ echo "checked"; } ?> /> RETAIL</label></div>
								
						<div><label><input class="checkbox-input form-input required" name="q105b" id="105b" type="checkbox" value="2" <?php if($row['q105b']==2){ echo "checked"; } ?> /> RESTAURANT WITH TIPS</label></div>
									
						<div><label><input class="checkbox-input form-input required" name="q105c" id="105c" type="checkbox" value="3" <?php if($row['q105c']==3){ echo "checked"; } ?> /> RESTAURANT</label></div>
									
						<div><label><input class="checkbox-input form-input required" name="q105d" id="105d" type="checkbox" value="4" <?php if($row['q105d']==4){ echo "checked"; } ?> /> MAIL/TELEPHONE ORDER  </label></div>
									
						<div><label><input class="checkbox-input form-input required" name="q105e" id="105e" type="checkbox" value="5" <?php if($row['q105e']==5){ echo "checked"; } ?> /> ECOMMERCE </label></div>
									
						<div><label><input class="checkbox-input form-input required" name="q105f" id="105f" type="checkbox" value="6" <?php if($row['q105f']==6){ echo "checked"; } ?> /> LODGING</label></div>	

						<div><label><input class="checkbox-input form-input required" name="q105g" id="105g" type="checkbox" value="7" <?php if($row['q105g']==7){ echo "checked"; } ?> /> SUPERMARKET</label></div>
								 
						<div><label><input class="checkbox-input form-input required" name="q105h" id="105h" type="checkbox" value="8" <?php if($row['q105h']==8){ echo "checked"; } ?> /> UTILITY</label></div>
									
						<div><label><input class="checkbox-input form-input required" name="q105i" id="105i" type="checkbox" value="9" <?php if($row['q105i']==9){ echo "checked"; } ?> /> PHARMACY</label></div>

						<div><label><input class="checkbox-input form-input required" name="q105j" id="105j" type="checkbox" value="10" <?php if($row['q105j']==10){ echo "checked"; } ?> /> BUSINESS TO BUSINESS </label></div>
						<p class="error" id="error_105"></p>
						<p class="error" id="error_106"></p>
						<p class="error" id="error_107"></p>
						</div>
						</div>
						</div>	
						
						    <!--Q109 & Q110-->
							<div id="question_109" class="question">
								 <div class="media">
								  <div class="media-left">
									15.
								  </div>
								  <div class="media-body">
								 What is your Taxpayer Identification Number?
								 <input class="form-input required2" autocomplete="off" type="text"  name="q109" id="109" value="<?php echo $row['q109']; ?>" /><br>
								 This number is a/an:
								<select name="q110" class="form-input required2 input-small" id="110" onchange="ssn()">
									<option value="0" <?php if($row['q110']==0){ echo "selected"; } ?> ></option>
									<option value="1" <?php if($row['q110']==1){ echo "selected"; } ?> >EIN</option>
									<option value="2" <?php if($row['q110']==2){ echo "selected"; } ?> >SSN</option>
									<option value="3" <?php if($row['q110']==3){ echo "selected"; } ?> >ITIN</option>
								</select>
								<span data-toggle="tooltip" data-placement="auto" title="We do a soft credit check when processing your application. This information is required for that credit check." style="font-size:16px; cursor:pointer;"><i class="glyphicon glyphicon-question-sign" ></i> Why do we need this?</span>
								
								<p class="error" id="error_109"></p>
								<p class="error" id="error_110"></p>
								</div>
								</div>
							</div>
							
							<!--Q111, Q111a, Q112, Q113, Q114 & Q115-->
							<div id="question_111" class="question">
								 <div class="media">
								  <div class="media-left">
									16.
								  </div>
								  <div class="media-body">
									<div class="mb-10">
										What is the name of one owner who holds at least a 50% stake in the business?
										<input class="form-input required2" autocomplete="off" type="text"  name="q111" id="111" value="<?php echo $row['q111']; ?>" /> <span data-toggle="tooltip" data-placement="auto" title="We do a soft credit check when processing your application. This information is required for that credit check." style="font-size:16px; cursor:pointer;"><i class="glyphicon glyphicon-question-sign" ></i> Why do we need this?</span>
										<p class="error" id="error_111"></p>
										
									</div>
								 
									<div class="mt-10 mb-10">
										What is their title (CEO, President, Secretary, etc.)?  <input class="form-input required2" autocomplete="off" type="text"  name="q111a" id="111a" value="<?php echo $row['q111a']; ?>" />
										<p class="error" id="error_111a"></p>
									</div>
									
									<div class="mt-10 mb-10">
										What is their date of birth (MM/DD/YYYY)? 
										<input class="form-input required2 bfh-phone" autocomplete="off" type="text"  name="q112" id="112"  value="<?php echo $row['q112']; ?>" data-format="dd/dd/dddd" data-number="<?php echo $row['q112']; ?>" placeholder="_ _/_ _/_ _ _ _" />
										<p class="error" id="error_112"></p> 
									</div>
								 
									<div class="mt-10 mb-10">
										What is their home address?
										<table class="table table-bordered mt-20" >
											<tr>
												<td class="lefthead">Address</td>
												<td>
													<input class="form-input required2" autocomplete="off" type="text" name="q113a" id="113a" value="<?php echo $row['q113a']; ?>" />
													<p class="error" id="error_113a"></p>
												</td>
												
											</tr>
											
											<tr>
												<td class="lefthead">Suite</td>
												<td>
													<input class="form-input required" autocomplete="off" placeholder="" type="text" name="q113b" id="113b" value="<?php echo $row['q113b']; ?>" />
													<p class="error" id="error_113b"></p>
												</td>
											</tr>
											
											<tr>
												<td class="lefthead">City</td>
												<td>
													<input class="form-input required2" autocomplete="off" placeholder="" type="text" name="q113c" id="113c" value="<?php echo $row['q113c']; ?>" />
													<p class="error" id="error_113c"></p>
												</td>
											</tr>
											
											<tr>
												<td class="lefthead">State</td>
												<td>
													<input class="form-input required2" autocomplete="off" placeholder="" type="text" name="q113d" id="113d" value="<?php echo $row['q113d']; ?>" />
													<p class="error" id="error_113d"></p>
												</td>
											</tr>
											
											<tr>
												<td class="lefthead">Zip</td>
												<td>
													<input class="form-input required2" autocomplete="off" placeholder="" type="text" name="q113e" id="113e" value="<?php echo $row['q113e']; ?>" />
													<p class="error" id="error_113e"></p>
												</td>
											</tr>
										</table>
									</div>
								 
									<div class="mt-10 mb-10">
										What is their phone number? (Enter numbers only)
										<input class="form-input bfh-phone required2" data-country="US" autocomplete="off" type="text"  name="q114a" id="114a" value="<?php echo $row['q114a']; ?>" data-number="<?php echo $row['q114a']; ?>" /> 
										
										<p class="error" id="error_114"></p>
									</div>
								 
									
									
									
									<div class="mt-10 mb-10">
										What percentage of the business do they own (1-100%)?
										<input class="form-input required2 input-small" autocomplete="off" type="number"  name="q115" id="115" value="<?php echo $row['q115']; ?>" />%
										<p class="error" id="error_115"></p>
									</div>
								 
									<div class="mt-10 mb-10">
										What is their social security number? (Enter numbers only) <span data-toggle="tooltip" data-placement="auto" title="We do a soft credit check when processing your application. This information is required for that credit check." style="font-size:16px; cursor:pointer;"><i class="glyphicon glyphicon-question-sign" ></i></span>
										<input class="form-input bfh-phone required2" data-format="ddd-dd-dddd" autocomplete="off" type="text"  name="qn2a" id="n2a" value="<?php echo $row['qn2a']; ?>" data-number="<?php echo $row['qn2a']; ?>" />
										<p class="error" id="error_n2"></p>
									</div>
								
								</div>
								</div>
							</div>
							
							<!--Q116, Q117, Q117a, Q117b-->
							<div id="question_116" class="question">
									 <div class="media">
									  <div class="media-left">
										17.
									  </div>
									  <div class="media-body">
									 <div class="mb-10">
										What is this owner’s driver’s license number?
										<input class="form-input required2" autocomplete="off" type="text"  name="q116" id="116" value="<?php echo $row['q116']; ?>"  /> <span data-toggle="tooltip" data-placement="auto" title="We do a soft credit check when processing your application. This information is required for that credit check." style="font-size:16px; cursor:pointer;"><i class="glyphicon glyphicon-question-sign" ></i> Why do we need this?</span>
										<p class="error" id="error_116"></p>
									 </div>
									 
									 <div class="mt-10 mb-10">
										What is the date of issuance (MM/DD/YYYY)? 
										 <input class="form-input required2 bfh-phone" autocomplete="off" type="text"  name="q117" id="117" value="<?php echo $row['q117']; ?>" data-format="dd/dd/dddd" data-number="<?php echo $row['q117']; ?>" placeholder="_ _/_ _/_ _ _ _" />
										 <p class="error" id="error_117"></p>
									  </div>
									
									 
									 <div class="mt-10 mb-10">
										 What is the expiration date (MM/DD/YYYY)? 
										 <input class="form-input required2 bfh-phone" autocomplete="off" type="text"  name="q117b" id="117b" value="<?php echo $row['q117b']; ?>" data-format="dd/dd/dddd" data-number="<?php echo $row['q117b']; ?>" placeholder="_ _/_ _/_ _ _ _" />
										 <p class="error" id="error_117b"></p>
									 </div>
									 
									 <div class="mt-10 mb-10">
										 What is the state of issuance? 
										 <input class="form-input required2" autocomplete="off" type="text"  name="q117a" id="117a" value="<?php echo $row['q117a']; ?>" />
										 <p class="error" id="error_117a"></p>
									 </div>
									 
									
									</div>
									</div>
							</div>	
							
							<!--Q118 & Q119-->
							<div id="question_118" class="question">
									 <div class="media">
									  <div class="media-left">
										18.
									  </div>
									  <div class="media-body">
									  How long have you owned your business?
									 <input class="form-input required2 input-small" autocomplete="off" type="text"  name="q118" id="118" value="<?php echo $row['q118']; ?>" /> years,
									
									 <input class="form-input input-small" autocomplete="off" type="text"  name="q119" id="119" value="<?php echo $row['q119']; ?>" /> months.
									 
									 <span data-toggle="tooltip" data-placement="auto" title="We do a soft credit check when processing your application. This information is required for that credit check." style="font-size:16px; cursor:pointer;"><i class="glyphicon glyphicon-question-sign" ></i> Why do we need this?</span>
									 
									<p class="error" id="error_118"></p>
									<p class="error" id="error_119"></p>
									</div>
									</div>
							</div>	
						
							<!--Q120 & Q121-->
							<div id="question_120" class="question">
								<div class="media">
								  <div class="media-left">
									19.
								  </div>
								  <div class="media-body">
									  Prior bankruptcies for the business 
								<select name="q120" class="form-input required2 input-small" id="120" show="122" showon='1' condition='1'>
									<option value="0" <?php if($row['q120']==0){ echo "selected"; } ?>></option>
									<option value="1" <?php if($row['q120']==1){ echo "selected"; } ?>>Yes</option>
									<option value="2" <?php if($row['q120']==2){ echo "selected"; } ?>>No</option>
								</select>,
								
								for you personally 
								<select name="q121" class="form-input required2 input-small" id="121" show="122a" showon='1' condition='1'>
									<option value="0" <?php if($row['q121']==0){ echo "selected"; } ?>></option>
									<option value="1" <?php if($row['q121']==1){ echo "selected"; } ?>>Yes</option>
									<option value="2" <?php if($row['q121']==2){ echo "selected"; } ?>>No</option>
								</select>
								<p class="error" id="error_120"></p>
								<p class="error" id="error_121"></p>
								</div>
								</div>
							</div>	
						
							<!--Q122-->
							<div id="question_122" class="question" <?php if($row['q120']==1){ } else { echo 'style="display:none"'; } ?> >
									<div class="media">
									  <div class="media-left">
										
									  </div>
									  <div class="media-body">
									  Filing date for the business (MM/DD/YYYY)
									 <input class="form-input required bfh-phone" autocomplete="off" type="text" name="q122" id="122" value="<?php echo $row['q122']; ?>" data-format="dd/dd/dddd" data-number="<?php echo $row['q122']; ?>" placeholder="_ _/_ _/_ _ _ _" />
									<p class="error" id="error_122"></p>
									</div>
									</div>
							</div>
							
							<div id="question_122a" class="question" <?php if($row['q121']==1){ } else { echo 'style="display:none"'; } ?> >
									<div class="media">
									  <div class="media-left">
										
									  </div>
									  <div class="media-body">
									  Filing date for you personally (MM/DD/YYYY)
									 <input class="form-input required bfh-phone" autocomplete="off" type="text" name="q122a" id="122a" value="<?php echo $row['q122a']; ?>" data-format="dd/dd/dddd" data-number="<?php echo $row['q122a']; ?>" placeholder="_ _/_ _/_ _ _ _"/>
									<p class="error" id="error_122a"></p>
									</div>
									</div>
							</div>
							
							
						    <!--Q123, Q124, Q125 & Q126, Q126a-->
							<div id="question_123" class="question">
								 <div class="media">
								  <div class="media-left">
									20.
								  </div>
								  <div class="media-body">
									<div class="mb-10">
										What is the name of your bank?
										 <input class="form-input required2" autocomplete="off" type="text"  name="q123" id="123" value="<?php echo $row['q123']; ?>"  /> 
										 <span data-toggle="tooltip" data-placement="auto" title="We do a soft credit check when processing your application. This information is required for that credit check." style="font-size:16px; cursor:pointer;"><i class="glyphicon glyphicon-question-sign" ></i> Why do we need this?</span>
										 <p class="error" id="error_123"></p>
									</div>	 
									<div class="mt-10 mb-10">
										 What is their phone number? (Enter numbers only)
										 <input class="form-input bfh-phone required2" data-country="US" autocomplete="off" type="text"  name="q124a" id="124a" value="<?php echo $row['q124a']; ?>" data-number="<?php echo $row['q124a']; ?>" />
										 
										 <p class="error" id="error_124"></p>
									</div>
									<div class="mt-10 mb-10">
										What is your routing number? 
										<input class="form-input  required2" autocomplete="off" type="text"  name="q125" id="125" value="<?php echo $row['q125']; ?>"/>
										<p class="error" id="error_125"></p>
									</div>
									
									<div class="mt-10 mb-10">
										What is your account number? 
										<input class="form-input required2" autocomplete="off" type="text"  name="q126a" id="126a" value="<?php echo $row['q126a']; ?>"  />
										<p class="error" id="error_126a"></p>
									</div>
									
									<div class="mt-10 mb-10">
										What type of account is this? 
										<select name="q126" class="form-input required2 input-small" id="126">
										<option value="0" <?php if($row['q126']==0){ echo "selected"; } ?>></option>
										<option value="1" <?php if($row['q126']==1){ echo "selected"; } ?>>Checking Account</option>
										<option value="2" <?php if($row['q126']==2){ echo "selected"; } ?>>Saving Account</option>
										<option value="3" <?php if($row['q126']==3){ echo "selected"; } ?>>General Ledger</option>
										</select>
										<p class="error" id="error_126"></p>
									</div>
									
								
								</div>
								</div>
							</div>	
						
							<!--Q127 & Q128-->
							<div id="question_127" class="question">
								 <div class="media">
								  <div class="media-left">
									21.
								  </div>
								  <div class="media-body"> Please provide a description of the products and/or services that you sell:
								 <input class="form-input " autocomplete="off" type="text"  name="q127" id="127" value="<?php echo $row['q127']; ?>" style="width:100%; max-width:100%" />
								<p class="error" id="error_127"></p>
								<p class="error" id="error_128"></p>
								</div>
								</div>
							</div>	
							
							
							<!--Q81-->
							<div id="question_155" class="question">
								<div class="media">
								  <div class="media-left">
									22.
								  </div>
								  <div class="media-body">
									Do you plan to integrate this payment into a software or point of sale system? <span data-toggle="tooltip" data-placement="auto" title='Software refers to any business management software you use to run your business. It may help you track invoices, organize customer orders, and/or schedule appointments. A "gateway" simply facilitates communication with banks during a transaction. A gateway connects credit card processors to your POS such as Authorize.net, USAepay or Velox' style="font-size:16px; cursor:pointer;"><i class="glyphicon glyphicon-question-sign" ></i></span>
									<select class="form-input required2 input-small" id="155" show="156" showon='1' condition='1' name="q155">
										<option value="0" <?php if($row['q155']==0){ echo "selected"; } ?>></option>
										<option value="1" <?php if($row['q155']==1){ echo "selected"; } ?>>Yes</option>
										<option value="2" <?php if($row['q155']==2){ echo "selected"; } ?>>No</option>
									</select>
								  </div>
								</div>
							</div>	
							
							
							<div id="question_156" class="question" style="display:none">
								<div class="media">
								  <div class="media-left">
									&nbsp; &nbsp;
								  </div>
								  <div class="media-body">
									Which software or POS? <input class="form-input required" autocomplete="off" type="text"  name="q156" id="156" value="<?php echo $row['q156']; ?>" />
									<p class="error" id="error_156"></p>
								  </div>
								</div>
							</div>
							
							
							
							<div id="question_157" class="question">
								<div class="media">
								  <div class="media-left">
									23.
								  </div>
								  <div class="media-body">
									
										Were you referred by your bank? 
										<select class="form-input required2 input-small" name="q157" id="157" show="158" showon='1' condition='1'>
											<option value="0" <?php if($row['q157']==0){ echo "selected"; } ?>></option>
											<option value="1" <?php if($row['q157']==1){ echo "selected"; } ?>>Yes</option>
											<option value="2" <?php if($row['q157']==2){ echo "selected"; } ?>>No</option>
										</select>
									
									
									<div id="question_158" class="mt-10 mb-10" <?php if($row['q157']==1){ } else { echo 'style="display:none"'; } ?>>
										Which bank? <select class="form-input required" name="q158" id="158" onchange="SelectBranch()">
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
										<p class="error" id="error_158"></p>
									
									
									
									<div class="mt-10 mb-10" id="q158a" style="display:none">
										Bank name? <input class="form-input" autocomplete="off" type="text"  name="q158a" id="158a" value="<?php echo $row['q158a']; ?>" />
										<p class="error" id="error_158a"></p>
									</div>
									
									
									<div class="mt-10 mb-10" id="q158b" style="display:none">
										Which branch? <input class="form-input" autocomplete="off" type="text"  name="q158b" id="158b" value="<?php echo $row['q158b']; ?>" />
										<p class="error" id="error_158b"></p>
									</div>
									
									
									<div class="mt-10 mb-10" id="q159" style="display:none">
										Which branch? 
										<select class="form-input" id="159" name="q159"></select>
										<p class="error" id="error_159"></p>
									</div>
									
									<div class="mt-10 mb-10" id="q160" style="display:none">
										What employee referred you? <input class="form-input" autocomplete="off" type="text"  name="q160" id="160" value="<?php echo $row['q160']; ?>" />
										<p class="error" id="error_160"></p>
									</div>
									
									</div>
									
								  </div>
								</div>
							</div>	
							
							
							
								
								<button type="button" class="btn btn-default prev-step mb-10" onclick="save()">Previous</button>
								<button type="button" class="btn btn-success btn-info-full next-step2 mb-10" onclick="save()">Save and Continue</button>
								<button type="button" class="btn btn-danger mb-10" onclick="saveClose()">Save for Later</button>
								
								<p class="mt-15 text-center"><i>We take your privacy and security seriously and are committed to protecting your data from unauthorized access. All information you provide to us is transmitted over a secure encrypted gateway. We will never disclose or sell your information to any third party, except as required by law.</i></p>
								
							</div>
							<div class="tab-pane" role="tabpanel" id="complete">
								
								<!--Q129-->
								<div id="question_129" class="question">
									 <div class="media">
									  <div class="media-left">
										24.
									  </div>
									  <div class="media-body"> 
									  <p>Please upload a cancelled check (if available) <span data-toggle="tooltip" data-placement="auto" title="We need this information to confirm the bank details your provided earlier." style="font-size:16px; cursor:pointer;"><i class="glyphicon glyphicon-question-sign" ></i> Why do we need this?</span></p>
									  <label for="129" class="custom-file-upload">
											<i class="glyphicon glyphicon-paperclip mr-5"></i> UPLOAD A CHECK
									  </label>
									  <input  style="display:none"  class="input-file" autocomplete="off" type="file"  name="q129" id="129"/>
									<p class="error" id="error_129"></p>
									</div>
									</div>
								</div>	

								<!--Q131-->
								<div id="question_131" class="question">
									 <div class="media">
								  <div class="media-left">
									25.
								  </div>
								  <div class="media-body"> 
									<p>Please upload an image of your driver's license (if available) <span data-toggle="tooltip" data-placement="auto" title="We do a soft credit check when processing your application. This information is required for that credit check." style="font-size:16px; cursor:pointer;"><i class="glyphicon glyphicon-question-sign" ></i> Why do we need this?</span></p>
									<label for="131" class="custom-file-upload">
											<i class="glyphicon glyphicon-paperclip mr-5"></i> UPLOAD DRIVER’S LICENSE
									</label>
									<input   style="display:none" class="input-file" autocomplete="off" type="file"  name="q131" id="131"/>
									 
									<p class="error" id="error_131"></p>
									</div>
									</div>
								</div>

								<!--Q133-->
								<div id="question_133" class="question">
									 <div class="media">
									  <div class="media-left">
										26.
									  </div>
									  <div class="media-body">
									  <p>Please upload three months of processing statements (if available). <span data-toggle="tooltip" data-placement="auto" title="We want to make sure we have all the details about your business’s credit card processing history listed correctly. This information helps us do that." style="font-size:16px; cursor:pointer;"><i class="glyphicon glyphicon-question-sign" ></i> Why do we need this?</span></p>
									  <label for="133" class="custom-file-upload">
											<i class="glyphicon glyphicon-paperclip mr-5"></i> UPLOAD STATEMENTS
									  </label>
									  <input  style="display:none" class="input-file" autocomplete="off" type="file"  name="q133" id="133"/>
									 
									 
									<p class="error" id="error_133"></p>
									</div>
									</div>
								</div>	
								
								<button type="button" class="btn btn-default prev-step mb-10" onclick="save()">Previous</button>
								<button type="submit" class="btn btn-success mb-10" name="FormSubmit" onclick="save()">Review & Sign</button>
								<button type="button" class="btn btn-danger mb-10" onclick="saveClose()">Save for Later</button>
								
								
								
								<h4 class="mt-20 mb-20">If you have any questions feel free to call us <b>Monday-Friday 7am-6pm Pacific Time</b> at <b>1-855-360-0360</b></h4>
								
								<p class="mt-15 text-center"><i>We take your privacy and security seriously and are committed to protecting your data from unauthorized access. All information you provide to us is transmitted over a secure encrypted gateway. We will never disclose or sell your information to any third party, except as required by law.</i></p>
							   
							</div>
							<div class="clearfix"></div>
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
	
	
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="errorModal">
	  <div class="modal-dialog modal-sm" role="document">
		
		<div class="modal-content text-center">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title text-center text-danger" id="gridSystemModalLabel">ERROR</h4>
			</div>
			<div class="modal-body text-center text-danger">
				Please correct the errors marked in red before proceeding. All questions are required.
			</div>
		</div>
	  </div>
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
