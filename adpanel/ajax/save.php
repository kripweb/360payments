<?php

session_start();
include '../core/config.php';
include '../core/functions.php';
require '../../sendgrid/vendor/autoload.php';

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
			
		//Check if email already registered
		$query = "SELECT * FROM user_answers WHERE email='$email'";
		$query=mysqli_query($mysqli,$query);
		$total_email=mysqli_num_rows($query);
		if($total_email>=1 && ($email!='ddistenfield@360payments.com' && $email!='derekbelldistenfield@gmail.com' && $email!='KRussell@360payments.com' && $email!='derekdistenfield@hotmail.com')){
			$error="This email is already associated with a quote please call 408-295-8360 we will be happy to serve you.";
		} else {
			
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
				
				$v_query = "SELECT * FROM merchants WHERE id='$merchant_id'";
				$v_query = mysqli_query($mysqli, $v_query);
				$v_row = mysqli_fetch_assoc($v_query);
				$merchant_name = $v_row['name'];
				
				include '../../emailtemplate/quote.php';
				
				
				//SEND EMAILS TO EXECUTIVE
				$exmails = str_replace(",", ", ", $exmails);
				if($exmails && $exmails!='null'){$exmails.= ", ".$v_row['emails']; }
				else { $exmails= $v_row['emails']; }
				$exmails = array_unique(explode(", ", $exmails ));
				
				
				$from = new SendGrid\Email("360 Payments", "noreply@360payments.com");
				$admin_email_subject = "Effective rate quote generated for ".$firstname." ".$lastname;
				$to = new SendGrid\Email("", "tickets@360-payments.com");
				$content = new SendGrid\Content("text/html", $et_quote);
				$mail = new SendGrid\Mail($from, $admin_email_subject, $to, $content);
				
				foreach($exmails as $value) {
					$cc = new SendGrid\Email("", $value);
					$mail->personalization[0]->addCc($cc);
				}
				$sg = new \SendGrid($sgapiKey);
				$response = $sg->client->mail()->send()->post($mail);
				
				
				//Custumer email template.
				$c_subject=$firstname." ".$lastname.", Your 360 Payments Quote!";
				$to = new SendGrid\Email($firstname." ".$lastname, $email);
				$content = new SendGrid\Content("text/html", $et_quote);
				$mail2 = new SendGrid\Mail($from, $c_subject, $to, $content);
				$sg = new \SendGrid($sgapiKey);
				$response = $sg->client->mail()->send()->post($mail2);
				
				
				//SAVE DATA
				$save['firstname']=$firstname;
				$save['lastname']=$lastname;
				$save['q111']=$firstname." ".$lastname;
				$save['email']=$email;
				$save['password']=$pass;
				$save['q80']=$name;
				$save['qn1']=$email;
				$save['q114a']=$contact;
				
				$save['q85a']=$contact;
				$save['q93']=$ccp;
			
			
				$save['cal_type']=$type;
				$save['cal_type_name']=$type_name;
				$save['cal_type_rate']=$rate;
				$save['cal_ms']=$ms;
				$save['cal_tr']=$tr;
				$save['cal_fees']=$fees;
				$save['cal_ccp']=$ccp;
				$save['cal_mfee']=$monthly_fee;
				$save['cal_sca']=$sca;
				$save['cal_contact']=$contact;
				$save['cal_gen_id']=$admin_row['id'];
				$save['cal_gen_name']=$admin_row['name'];
				$save['addedon']=date("Y-m-d H:i:s");
				$save['merchant_id']=$merchant_id;
				$save['merchant_name']=$merchant_name;
				$new_data = mysql_insert_array('user_answers', $save, array(''));
				$_SESSION['user_id']= $new_data['mysqli_insert_id'];
				$_SESSION['cid']= 1;
				
				
				$data = '<div class="alert alert-primary mb-0 p-10" role="alert">The quote has been succesully saved and emailed.</div>';
			
			}

		}
	}

else {
	
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