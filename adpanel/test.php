<?php

$url = "https://api.pipedrive.com/v1/deals/11719?api_token=f6372ae7757e04f1297d8ab93c811cff33bfd008";
$data = file_get_contents($url);
/*
$data = json_decode($data);
$save = array();
if($data->data->fba153569f8bba6a85fa4d11da7d18e8f73e228b){
	$save['pd_short_notes']=$data->data->fba153569f8bba6a85fa4d11da7d18e8f73e228b;
}
if($data->data->a9b9292bd9886a5c0f8900f91b13823fc70d806c){
	$save['q93']=$data->data->a9b9292bd9886a5c0f8900f91b13823fc70d806c;
	$save['cal_ccp']=$data->data->a9b9292bd9886a5c0f8900f91b13823fc70d806c;
}
if($data->data->99dbd822a10de41075fc99790c1d2022d72d98d0){
	$save['pd_software']=$data->data->99dbd822a10de41075fc99790c1d2022d72d98d0;
}
if($data->data->0f32c7a45097545a9dfde15ebe52a557513d6b49){
	$save['firstname']=$data->data->0f32c7a45097545a9dfde15ebe52a557513d6b49;
}
if($data->data->a853ea6b734cb60dfe5cb5864960ad3b58c2f50f){
	$save['lastname']=$data->data->a853ea6b734cb60dfe5cb5864960ad3b58c2f50f;
}

if($data->data->0f32c7a45097545a9dfde15ebe52a557513d6b49 && $data->data->a853ea6b734cb60dfe5cb5864960ad3b58c2f50f){
	$save['q111']=$save['firstname']." ".$save['lastname'];
}


if($data->data->9f1d824b6f88469287319794ff8fa7d78ddd6659){
	$save['email']=$data->data->9f1d824b6f88469287319794ff8fa7d78ddd6659;
	$save['qn1']=$data->data->9f1d824b6f88469287319794ff8fa7d78ddd6659;
}


if($data->data->fa9fa0d2c8c8718fa1c0a62962b6a69fdf1d2a84){
	$save['pd_long_notes']=$data->data->fa9fa0d2c8c8718fa1c0a62962b6a69fdf1d2a84;
}

if($data->data->8ac8b8580923863ac011918c71c8d10ec329a872){
	$save['pd_referal_partner']=$data->data->8ac8b8580923863ac011918c71c8d10ec329a872;
}


if($data->data->66a8024fd27537a764d412b80becaaaba4eea686){
	$save['pd_nextdate']=$data->data->66a8024fd27537a764d412b80becaaaba4eea686;
}

if($data->data->accc078d8a8bfed395a301c9db729637f107f6ef){
	$save['pd_flusher']=$data->data->accc078d8a8bfed395a301c9db729637f107f6ef;
}


if($data->data->d203bb98aac11eb61038973654f9ef77ca3fe627){
	$save['pd_sfdealid']=$data->data->d203bb98aac11eb61038973654f9ef77ca3fe627;
}

if($data->data->e05b5a76b6d7a72d2015ea57f7b5f5b500cd5d96){
	$save['pd_dealtemp']=$data->data->e05b5a76b6d7a72d2015ea57f7b5f5b500cd5d96;
}

if($data->data->426baf2171ab69263396aac08d9b50eba45a301e){
	$save['pd_salesb']=$data->data->426baf2171ab69263396aac08d9b50eba45a301e;
}

if($data->data->3f785b91570950447569ccb0f0f2207c19eeb76f){
	$save['pd_cldate']=$data->data->3f785b91570950447569ccb0f0f2207c19eeb76f;
}

if($data->data->85eac430c0d5dfd07bcc9080874b49bbc14d35cd){
	$save['pd_clreason']=$data->data->85eac430c0d5dfd07bcc9080874b49bbc14d35cd;
}

if($data->data->c8453ae9026c0b2c8eea224f505c02a8b539da64){
	$save['pd_avgticket']=$data->data->c8453ae9026c0b2c8eea224f505c02a8b539da64;
}

if($data->data->273045f0bf6f033a15ffbe0cad429edcc1eb7ef8){
	$save['pd_cfe']=$data->data->273045f0bf6f033a15ffbe0cad429edcc1eb7ef8;
}

if($data->data->181dfbfb0b26625a4bb24b0ceeed0dbfea8fdabd){
	$save['pd_eir']=$data->data->181dfbfb0b26625a4bb24b0ceeed0dbfea8fdabd;
}

if($data->data->5ebcce2bce6f32520d5894643c4821740856f751){
	$save['pd_sp1']=$data->data->5ebcce2bce6f32520d5894643c4821740856f751;
}

if($data->data->d485774b179c4f26bc06d96f1378dff4536b003c){
	$save['pd_sp2']=$data->data->d485774b179c4f26bc06d96f1378dff4536b003c;
}

if($data->data->50d088ea06ef973ddbd4758835962a5abe0834ce){
	$save['cal_sca']=$data->data->50d088ea06ef973ddbd4758835962a5abe0834ce;
}

if($data->data->bafe823daca442fbb022426a87eb7d8f626f94cc){
	$save['pd_bps']=$data->data->bafe823daca442fbb022426a87eb7d8f626f94cc;
}

if($data->data->d826a0814626efc96105b03fb03a03aa86a3c54a){
	$save['pd_ner']=$data->data->d826a0814626efc96105b03fb03a03aa86a3c54a;
}

if($data->data->ab56fc8145d22b4d25ece1b24c31affdf6307dbd){
	$save['pd_savings_m']=$data->data->ab56fc8145d22b4d25ece1b24c31affdf6307dbd;
}

if($data->data->e79d259a4957143067f03c9c38cf2974b5b056f9){
	$save['pd_savings_a']=$data->data->e79d259a4957143067f03c9c38cf2974b5b056f9;
}

if($data->data->56905daf4356914502cdd6eff6fce694bda9fd61){
	$save['pd_savings_3']=$data->data->56905daf4356914502cdd6eff6fce694bda9fd61;
}

if($data->data->2bebecf0815352a9dc9d195cfa482c5f3899eb90){
	$save['pd_authfee']=$data->data->2bebecf0815352a9dc9d195cfa482c5f3899eb90;
}

if($data->data->d0c7f45879a3f65ce8f887abfca9a8c51c7665f6){
	$save['q116']=$data->data->d0c7f45879a3f65ce8f887abfca9a8c51c7665f6;
}


if($data->data->961a9926671f02ed01f503d63d3ed1d955530b4d){
	$save['q117']=$data->data->961a9926671f02ed01f503d63d3ed1d955530b4d;
}



if($data->data->b987aca4f3afdafc33cbdde9b3fb5b66cf066cdb){
	$save['q117b']=$data->data->b987aca4f3afdafc33cbdde9b3fb5b66cf066cdb;
}

if($data->data->b38933c265863489114ca9afe67643d8313590b7){
	$save['q117a']=$data->data->b38933c265863489114ca9afe67643d8313590b7;
}

if($data->data->b15a004610a2b406b570b94ddabe8466b38167da){
	$save['qn2a']=$data->data->b15a004610a2b406b570b94ddabe8466b38167da;
}


if($data->data->83045df2b77104a9a5ad0daf788a2c524048158d){
	$save['q109']=$data->data->83045df2b77104a9a5ad0daf788a2c524048158d;
}

if($data->data->54de7bc9f9a9154460edcefaeffba2ccfcf2d28e){
	$save['q112']=$data->data->54de7bc9f9a9154460edcefaeffba2ccfcf2d28e;
}


*/
header('Content-Type: application/json');
$json_pretty = json_encode(json_decode($data), JSON_PRETTY_PRINT);
echo $json_pretty;

/*

$data = json_decode($data);
print_r($data);
echo "Current Processor: ".$data->data->{'a9b9292bd9886a5c0f8900f91b13823fc70d806c'};
*/


?>