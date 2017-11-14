<?php

session_start();
include '../core/config.php';
include '../core/functions.php';

$error="";
$error_code=0;
$data="";

if($_POST) {
	extract($_POST);
	if(empty($name)){
		$error="Something went wrong! Error Code 1";
	}
	
	else if(empty($type)){
		$error="Something went wrong! Error Code 2";
	}
	
	else if(empty($rate)){
		$error="Something went wrong! Error Code 3";
	}
	
	else if(empty($ms)){
		$error="Something went wrong! Error Code 4";
	}
	
	else if(empty($tr)){
		$error="Something went wrong! Error Code 5";
	}
	
	else if(empty($fees)){
		$error="Something went wrong! Error Code 6";
	}
	
	else if(empty($ccp)){
		$error="Something went wrong! Error Code 7";
	}
	
	
	else if(empty($sca)){
		$error="Something went wrong! Error Code 12";
	}
	
	else if(empty($merchant_id)){
		$error="Something went wrong! Error Code 13";
	}
	
	else {
		
			
			//Calculate
			$avg_ticket = $ms/$tr;
			$current_eff_rate = $fees/$ms;
			$eff_int_cost = $rate;
			$spread_per = $current_eff_rate-$eff_int_cost;
			$sca = $sca/100;
			$tran_fee_charged = 0.05;
			$tran_fee_bp_above = ($tran_fee_charged-0.04)/$avg_ticket;
			$monthly_fee = $mfee;
			$monthly_fee_bp = $monthly_fee/$ms;
			$bp_charged = (($sca*$spread_per)-($tran_fee_charged/$avg_ticket)-($monthly_fee/$ms));
			$new_fee = $bp_charged+$eff_int_cost;
			$savings = ($current_eff_rate-$new_fee)*$ms;
			$savings_anual = $savings*12;
			$savings_3years = $savings*36;
			$revenue = (($bp_charged+$tran_fee_bp_above)*$ms)*12;
			$w2sales = ($revenue/12)*0.2;

			if($current_eff_rate<$new_fee) {
				
				$data = '<div class="col-xs-12 col-md-12">
					<div class="panel panel-border-color panel-border-color-primary">
					  <div class="panel-body style="padding:10px 20px;"">
						<div class="row">
							<div class="col-xs-12 col-sm-12 text-center" style="margin: 30px auto 10px;">
								
								<h1 class="main_color" style="font-size: 36px;margin-bottom: 0px;">We are looking forward to working with you. We have a couple more questions to provide you the most update quote. Someone from our team will call you shortly.</h1>
								<h2 class="main_color" style="margin-top:5px">Don’t want to wait? Call us now at 408-295-8360</h2>
								
								<hr>
								
								<button class="btn btn-default btn-lg" onclick="recalculate()">Recalculate</button>
								
								<hr>
							</div>
						</div>
						
						<div class="row" style="margin-top:80px;">
							<div class="col-sm-6 text-center" style="margin-bottom:60px">
								<p><img alt="" src="https://v.fastcdn.co/t/421cc712/1f3b485d/1506392092-13705053-126x126-003-money.png" style="height:126px; width:126px" /></p>

								<p style="text-align: center; font-size: 20px;"><b>Easy, transparent pricing - always</b></p>

								<p style="text-align: center; font-size: 18px;">Credit card pricing shouldn&#39;t be complicated. Our rates are reasonable, clearly stated, and we&#39;ll explain anything you don&#39;t understand - guaranteed.</p>
							
							</div>
							
							
							<div class="col-sm-6 text-center" style="margin-bottom:60px">
								<p><img alt="" src="https://v.fastcdn.co/t/421cc712/1f3b485d/1506392088-15517286-127x127x127x127x0x0-001-men-shaking-hand.png" style="height:127px; width:127px" /></p>

								<p style="text-align: center; font-size: 20px;"><b>Simple installation with a human touch</b></p>

								<p style="text-align: center; font-size: 18px;">Picture this: your new point of sale system arrives quickly and in perfect condition. A friendly, trained technician sets up the entire thing and trains your team. This is our reality.</p>
							</div>
							
							
							<div class="col-sm-6 text-center" style="margin-bottom:60px">
								<p><img alt="" src="https://v.fastcdn.co/t/421cc712/1f3b485d/1506392084-13705058-127x127-004-security.png" style="height:127px; width:127px" /></p>

								<p style="text-align: center; font-size: 20px;"><b>Chargeback protection you can count on</b></p>

								<p style="text-align: center; font-size: 18px;">We know that chargebacks are a big deal, so we stand behind our customers. We provide the tools and resources you need to prevent chargebacks, and protection when they do occur.</p>
							</div>
							
							
							<div class="col-sm-6 text-center" style="margin-bottom:60px">
								<p><img alt="" src="https://v.fastcdn.co/t/421cc712/1f3b485d/1506392087-15517311-128x128x128x128x0x0-002-book.png" style="height:128px; width:128px" /></p>

								<p style="text-align: center; font-size: 20px;"><b>Customer service that&#39;s always ready to serve</b></p>

								<p style="text-align: center; font-size: 18px;">Our customer service is top-notch - we pride ourselves on it! There&#39;s no question too silly, no problem too small. Reach out to us, we love to help!</p>
							</div>
						</div>
						
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<h3 style="margin-top:15px; text-align:center">Want to learn more? Check out our <a href="https://www.360payments.com/blog/" target="_blank" style="color: #78ac41;">blog</a> and <a href="https://www.youtube.com/channel/UC564QtYKW9GnZsJNNMhGJzw" target="_blank" style="color: #78ac41;">Youtube channel</a></h3>
							</div>
						</div>
					
					  </div>
					</div>
				</div>';
				
			} else {
			$data = '
				<div class="col-xs-12 col-md-12" id="results">
					<div class="panel panel-border-color panel-border-color-primary">
					  <div class="panel-body" style="padding:10px 20px;">
						<div class="row">
							<div class="col-xs-6 col-sm-6">
								<h3 class="cur_rate">'.percentage($current_eff_rate).'</h3>
								<p class="cur_rate_sub">Current Effective Rate</p>
							</div>
							<div class="col-xs-6 col-sm-6 text-right">
								<h3 class="new_rate">'.percentage($new_fee).'</h3>
								<p class="new_rate_sub">Your New 360 Rate</p>
							</div>
							<div class="col-xs-12 col-sm-12 text-center">
								<h3 style="margin-bottom: 30px;margin-top: 20px;font-size: 24px;font-weight: bold;">Saving you <span class="main_color">$'.number_format($savings).'</span> per month and ...</h3>
								<h1 style="margin-bottom: 30px;font-size: 46px;font-weight: bold;"><span class="main_color">$'.number_format($savings_3years).'</span> over three years</h1>
							</div>
							
							<div class="col-xs-12 col-sm-12 text-center">
								<button class="btn btn-primary btn-lg" onclick="finalize()">Continue</button>
							</div>
						</div>
						
						<div class="row" style="margin-top:80px;">
							<div class="col-sm-6 text-center" style="margin-bottom:60px">
								<p><img alt="" src="https://v.fastcdn.co/t/421cc712/1f3b485d/1506392092-13705053-126x126-003-money.png" style="height:126px; width:126px" /></p>

								<p style="text-align: center; font-size: 20px;"><b>Easy, transparent pricing - always</b></p>

								<p style="text-align: center; font-size: 18px;">Credit card pricing shouldn&#39;t be complicated. Our rates are reasonable, clearly stated, and we&#39;ll explain anything you don&#39;t understand - guaranteed.</p>
							
							</div>
							
							
							<div class="col-sm-6 text-center" style="margin-bottom:60px">
								<p><img alt="" src="https://v.fastcdn.co/t/421cc712/1f3b485d/1506392088-15517286-127x127x127x127x0x0-001-men-shaking-hand.png" style="height:127px; width:127px" /></p>

								<p style="text-align: center; font-size: 20px;"><b>Simple installation with a human touch</b></p>

								<p style="text-align: center; font-size: 18px;">Picture this: your new point of sale system arrives quickly and in perfect condition. A friendly, trained technician sets up the entire thing and trains your team. This is our reality.</p>
							</div>
							
							
							<div class="col-sm-6 text-center" style="margin-bottom:60px">
								<p><img alt="" src="https://v.fastcdn.co/t/421cc712/1f3b485d/1506392084-13705058-127x127-004-security.png" style="height:127px; width:127px" /></p>

								<p style="text-align: center; font-size: 20px;"><b>Chargeback protection you can count on</b></p>

								<p style="text-align: center; font-size: 18px;">We know that chargebacks are a big deal, so we stand behind our customers. We provide the tools and resources you need to prevent chargebacks, and protection when they do occur.</p>
							</div>
							
							
							<div class="col-sm-6 text-center" style="margin-bottom:60px">
								<p><img alt="" src="https://v.fastcdn.co/t/421cc712/1f3b485d/1506392087-15517311-128x128x128x128x0x0-002-book.png" style="height:128px; width:128px" /></p>

								<p style="text-align: center; font-size: 20px;"><b>Customer service that&#39;s always ready to serve</b></p>

								<p style="text-align: center; font-size: 18px;">Our customer service is top-notch - we pride ourselves on it! There&#39;s no question too silly, no problem too small. Reach out to us, we love to help!</p>
							</div>
						</div>
						
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<h3 style="margin-top:15px; text-align:center">Want to learn more? Check out our <a href="https://www.360payments.com/blog/" target="_blank" style="color: #78ac41;">blog</a> and <a href="https://www.youtube.com/channel/UC564QtYKW9GnZsJNNMhGJzw" target="_blank" style="color: #78ac41;">Youtube channel</a></h3>
							</div>
						</div>
						
					  </div>
					</div>
				</div>
				
				
				
				
				
				<div class="col-xs-12 col-md-12" id="finalize" style="display:none">
					<div class="panel panel-border-color panel-border-color-primary">
					  <div class="panel-heading">Finalize Quote</div>
					  <div class="panel-body style="padding:10px 20px;"">
						<div class="row">
						  <div class="form-group col-md-5">
							<label>First name (*)</label>
							<input type="text" class="form-control" id="firstname" name="firstname" require>
						  </div>
					    </div>
						
						<div class="row">
						  <div class="form-group col-md-5">
							<label>Last name (*)</label>
							<input type="text" class="form-control" id="lastname" name="lastname" required>
						  </div>
					    </div>
						
						<div class="row">
						  <div class="form-group col-md-5">
							<label>Email Address (*)</label>
							<input type="email" class="form-control" id="email" name="email" required>
						  </div>
					    </div>
						
						<div class="row">
						  <div class="form-group col-md-5">
							<label>Contact Number (*)</label>
							<input type="text" class="form-control" id="contact" name="contact" required autocomplete="off">
						  </div>
					    </div>
						
						<div class="row">
						  <div class="form-group col-md-5">
							<label>Password (*)</label>
							<input type="text" class="form-control" id="password" name="password" required autocomplete="new-password">
						  </div>
					    </div>
						
						
						<div class="row">
						  <div class="form-group col-md-5">
						    <hr>
							<label>Email Ids of sales rep assigned (press enter to add new)</label>
							<select style="display:none" multiple="" class="tags" id="exmails">
							  
							</select>
						  </div>
					    </div>
						
						
						
						
						<div class="row">
							<div class="col-md-12" style="margin: 30px auto 10px;">
								<button class="btn btn-primary btn-lg" onclick="save()">Save & Continue to Application</button>
								<button class="btn btn-default btn-lg" onclick="backtoresults()">Back to Results</button>
								<button class="btn btn-default btn-lg" onclick="recalculate()">Recalculate</button>
							</div>
						</div>
					  </div>
					</div>
				</div>
				
				<script>
					App.formElements();
				</script>
			';
			
			}

	}

} else {
	
	$content_code = "Something went wrong! Error code 0";
}


if($error){
	$error_code = 1;
}
$json= array(
	'error_code' => $error_code,
	'error' => $error,
	'data' => $data
);
$jsonstring = json_encode($json, JSON_PRETTY_PRINT);
echo $jsonstring;



?>