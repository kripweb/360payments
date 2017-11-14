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

			$data ='
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;"><strong>Name of Business</strong></td>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;">'.$name.'</td>
						</tr>
						<tr>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;"><strong>Type of Business</strong></td>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;">'.$type_name.'</td>
						</tr>
						<tr>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;"><strong>Monthly Sales</strong></td>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;">$ '.number_format($ms, 2).'</td>
						</tr>
						<tr>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;"><strong>Number of Transactions</strong></td>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;">'.$tr.'</td>
						</tr>
						<tr>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;"><strong>Total Fees</strong></td>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;">$ '.number_format($fees,2).'</td>
						</tr>
						<tr>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;"><strong>Average Ticket</strong></td>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;">$ '.number_format($avg_ticket,2).'</td>
						</tr>
						<tr>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;"><strong>Current Effectiv Rate</strong></td>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;">'.percentage($current_eff_rate).'</td>
						</tr>
						<tr>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;"><strong>Effective Interchange cost</strong></td>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;">'.percentage($eff_int_cost).'</td>
						</tr>
						<tr>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;"><strong>Spread Percentage</strong></td>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;">'.percentage($spread_per).'</td>
						</tr>
						<tr>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;"><strong>Spread Cut amount</strong></td>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;">'.percentage($sca).'</td>
						</tr>
						<tr>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;"><strong>BP Charged</strong></td>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;">'.percentage($bp_charged).'</td>
						</tr>
						<tr>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;"><strong>Trans Fee Charged</strong></td>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;">$ '.number_format($tran_fee_charged,2).'</td>
						</tr>
						<tr>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;"><strong>Trans Fee BP Profit above cost</strong></td>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;">'.percentage($tran_fee_bp_above).'</td>
						</tr>
						<tr>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;"><strong>Monthly Fee&nbsp;</strong></td>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;">$ '.number_format($monthly_fee,2).'</td>
						</tr>
						<tr>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;"><strong>Monthly Fee in BP</strong></td>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;">'.percentage($monthly_fee_bp).'</td>
						</tr>
						<tr>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;"><strong>New Effective Rate</strong></td>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;">'.percentage($new_fee).'</td>
						</tr>
						<tr>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;"><strong>Savings</strong></td>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;">$ '.number_format($savings,2).'</td>
						</tr>
						<tr>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;"><strong>Annual Savings</strong></td>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;">$ '.number_format($savings_anual,2).'</td>
						</tr>
						<tr>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;"><strong>3 Year Savings</strong></td>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;">$ '.number_format($savings_3years,2).'</td>
						</tr>
						<tr>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;"><strong>360 Revenue</strong></td>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;">$ '.number_format($revenue,2).'</td>
						</tr>
						<tr>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;"><strong>W2 Sales Monthly Residual</strong></td>
							<td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px 15px;">$ '.number_format($w2sales,2).'</td>
						</tr>
					</tbody>
				</table>
				
				<button type="button" class="btn btn-primary btn-lg" name="FormSubmit" onclick="calculate()">Continue</button>
				
				';
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