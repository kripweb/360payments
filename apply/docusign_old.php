<?php
	session_start();
	require_once('ajax/config.php');
	
	$return_url = "http://projects.kripweb.in/360payments/complete.php";
	$user_id = $_SESSION['user_id'];
	
	if(!$user_id){ echo "Invlid access!"; exit(); }
	
	$user = "SELECT * FROM users_form WHERE id='$user_id'";
	$user = mysqli_query($mysqli, $user);
	$user_row = mysqli_fetch_assoc($user);
	
	$user_name = $user_row['firstname']." ".$user_row['lastname'];
	$user_email = $user_row['email'];
	
	$uniqid = $user_id;
	
	
	$user_query = "SELECT * FROM user_answers WHERE user_id='$user_id'";
	$user_query = mysqli_query($mysqli, $user_query);
	$total = mysqli_num_rows($user_query);
	$row = mysqli_fetch_assoc($user_query);

	require_once('docusign/autoload.php');
	
    // DocuSign environment we are using
   
	
	$username = "32258f6a-15a1-4909-b3b1-dbfdc7cd7645";
	$password = "krip1234";
	$integrator_key = "88694ba4-e991-468d-ba04-95cc08676374";   

	// change to production (www.docusign.net) before going live
	$host = "https://demo.docusign.net/restapi";

	// create configuration object and configure custom auth header
	$config = new DocuSign\eSign\Configuration();
	$config->setHost($host);
	$config->addDefaultHeader("X-DocuSign-Authentication", "{\"Username\":\"" . $username . "\",\"Password\":\"" . $password . "\",\"IntegratorKey\":\"" . $integrator_key . "\"}");

	// instantiate a new docusign api client
	$apiClient = new DocuSign\eSign\ApiClient($config);
	$accountId = null;
	
	try 
	{
		//*** STEP 1 - Login API: get first Account ID and baseURL
		$authenticationApi = new DocuSign\eSign\Api\AuthenticationApi($apiClient);
		$options = new \DocuSign\eSign\Api\AuthenticationApi\LoginOptions();
		$loginInformation = $authenticationApi->login($options);
		if(isset($loginInformation) && count($loginInformation) > 0)
		{
			$loginAccount = $loginInformation->getLoginAccounts()[0];
			$host = $loginAccount->getBaseUrl();
			$host = explode("/v2",$host);
			$host = $host[0];
			
			$base_url = $host;

			// UPDATE configuration object
			$config->setHost($host);
	
			// instantiate a NEW docusign api client (that has the correct baseUrl/host)
			$apiClient = new DocuSign\eSign\ApiClient($config);

			if(isset($loginInformation))
			{
				$accountId = $loginAccount->getAccountId();
				if(!empty($accountId))
				{
					//*** STEP 2 - Signature Request from a Template
					// create envelope call is available in the EnvelopesApi
					$envelopeApi = new DocuSign\eSign\Api\EnvelopesApi($apiClient);
					// assign recipient to template role by setting name, email, and role name.  Note that the
					// template role name must match the placeholder role name saved in your account template.
					$templateRole = new  DocuSign\eSign\Model\TemplateRole();
					$templateRole->setEmail($user_email);
					$templateRole->setName($user_name);
					$templateRole->setRoleName("Signature");
					$templateRole->setClientUserId($uniqid);
					
					
					//
					if(!$row['q81']){$row['q81']=$row['q80'];}
					
					/*
					$tab1 = new \DocuSign\eSign\Model\Text();
					$tab1->setTabLabel("All Card Types");
					$tab1->setValue($row['q4']);
					
					$tab2 = new \DocuSign\eSign\Model\Text();
					$tab2->setTabLabel("Voice");
					$tab2->setValue($row['q5']);
					*/
					
					$tab3 = new \DocuSign\eSign\Model\Text();
					$tab3->setTabLabel("Qual/disc");
					$tab3->setValue($row['q6']);
					
					$tab4 = new \DocuSign\eSign\Model\Text();
					$tab4->setTabLabel("NameBusiness");
					$tab4->setValue($row['q80']);
					
					$tab5= new \DocuSign\eSign\Model\Text();
					$tab5->setTabLabel("DBA Name  25 characters max");
					$tab5->setValue($row['q81']);
					
					$tab6 = new \DocuSign\eSign\Model\Text();
					$tab6->setTabLabel("Legal Address Suite");
					$tab6->setValue($row['q82']);
					
					$tab7 = new \DocuSign\eSign\Model\Text();
					$tab7->setTabLabel("suit1");
					$tab7->setValue($row['q82a']);
					
					$tab8 = new \DocuSign\eSign\Model\Text();
					$tab8->setTabLabel("City State ZIP");
					$tab8->setValue($row['q82b']);
					
					$tab9 = new \DocuSign\eSign\Model\Text();
					$tab9->setTabLabel("state");
					$tab9->setValue($row['q82c']);
					
					$tab10 = new \DocuSign\eSign\Model\Text();
					$tab10->setTabLabel("zip1");
					$tab10->setValue($row['q82d']);
					
					$tab11 = new \DocuSign\eSign\Model\Text();
					$tab11->setTabLabel("DBA Address Physical location no PO Boxes Suite");
					$tab11->setValue($row['q83']);
					
					$tab12 = new \DocuSign\eSign\Model\Text();
					$tab12->setTabLabel("suit2");
					$tab12->setValue($row['q83a']);
					
					$tab13 = new \DocuSign\eSign\Model\Text();
					$tab13->setTabLabel("City State ZIP_2");
					$tab13->setValue($row['q83b']);
					
					$tab14 = new \DocuSign\eSign\Model\Text();
					$tab14->setTabLabel("State2");
					$tab14->setValue($row['q83c']);
					
					$tab15 = new \DocuSign\eSign\Model\Text();
					$tab15->setTabLabel("zip2");
					$tab15->setValue($row['q83d']);
					
					$tab16 = new \DocuSign\eSign\Model\Text();
					$tab16->setTabLabel("web address");
					$tab16->setValue($row['q84']);
					
					$tab17 = new \DocuSign\eSign\Model\Text();
					$tab17->setTabLabel("legal phone 1");
					$tab17->setValue($row['q85']);
					
					
					
					$tab20 = new \DocuSign\eSign\Model\Text();
					$tab20->setTabLabel("dba phone 1");
					$tab20->setValue($row['q85']);
					
					
					
					$tab23 = new \DocuSign\eSign\Model\Text();
					$tab23->setTabLabel("If yes what is the processors name");
					$tab23->setValue($row['q93']);
					
					$tab24 = new \DocuSign\eSign\Model\Text();
					$tab24->setTabLabel("%1");
					$tab24->setValue($row['q98']);
					
					$tab25 = new \DocuSign\eSign\Model\Text();
					$tab25->setTabLabel("%2");
					$tab25->setValue($row['q99']);
					
					$tab26 = new \DocuSign\eSign\Model\Text();
					$tab26->setTabLabel("%3");
					$tab26->setValue($row['q100']);
					
					$tab27 = new \DocuSign\eSign\Model\Text();
					$tab27->setTabLabel("%4");
					$tab27->setValue($row['q101']);
					
					$tab28 = new \DocuSign\eSign\Model\Text();
					$tab28->setTabLabel("%5");
					$tab28->setValue($row['q102']);
					
					$tab29 = new \DocuSign\eSign\Model\Text();
					$tab29->setTabLabel("Taxpayer Identification Number Must be 9 digits");
					$tab29->setValue($row['q109']);
					
					$tab30 = new \DocuSign\eSign\Model\Text();
					$tab30->setTabLabel("1");
					$tab30->setValue($row['q109']);
					
					$tab31 = new \DocuSign\eSign\Model\Text();
					$tab31->setTabLabel("SSN 2");
					$tab31->setValue($row['q109']);
					
					$tab32 = new \DocuSign\eSign\Model\Text();
					$tab32->setTabLabel("SSN 3");
					$tab32->setValue($row['q109']);
					
					$tab33 = new \DocuSign\eSign\Model\Text();
					$tab33->setTabLabel("Name of OwnerOfficer and TitleRow1");
					$tab33->setValue($row['q111']);
					
					$tab34 = new \DocuSign\eSign\Model\Text();
					$tab34->setTabLabel("Name");
					$tab34->setValue($row['q111']);
					
					
					
					$tab36 = new \DocuSign\eSign\Model\Text();
					$tab36->setTabLabel("Printed Name of Owner or Officer 1");
					$tab36->setValue($row['q111']);
					
					$tab37 = new \DocuSign\eSign\Model\Text();
					$tab37->setTabLabel("Printed Name of Owner or Officer 2");
					$tab37->setValue($row['q111a']);
					
					
					
					$tab39 = new \DocuSign\eSign\Model\Text();
					$tab39->setTabLabel("SP DOB");
					$tab39->setValue($row['q112']);
					
					$tab40 = new \DocuSign\eSign\Model\Text();
					$tab40->setTabLabel("Date of Birth_3");
					$tab40->setValue($row['q112']);
					
					$tab41 = new \DocuSign\eSign\Model\Text();
					$tab41->setTabLabel("Date of Birth");
					$tab41->setValue($row['q112']);
					
					$tab42 = new \DocuSign\eSign\Model\Text();
					$tab42->setTabLabel("Residential Address City State Zip");
					$tab42->setValue($row['q113']);
					
					$tab43 = new \DocuSign\eSign\Model\Text();
					$tab43->setTabLabel("Residential Phone Number");
					$tab43->setValue($row['q114']);
					
					$tab44 = new \DocuSign\eSign\Model\Text();
					$tab44->setTabLabel("percent 1");
					$tab44->setValue($row['q115']);
					
					$tab45 = new \DocuSign\eSign\Model\Text();
					$tab45->setTabLabel("DLID");
					$tab45->setValue($row['q116']);
					
					$tab46 = new \DocuSign\eSign\Model\Text();
					$tab46->setTabLabel("Date of Issuance");
					$tab46->setValue($row['q117']);
					
					$tab47 = new \DocuSign\eSign\Model\Text();
					$tab47->setTabLabel("date of iss");
					$tab47->setValue($row['q117a']);
					
					$tab48 = new \DocuSign\eSign\Model\Text();
					$tab48->setTabLabel("Expiration Date_2");
					$tab48->setValue($row['q117b']);
					
					$tab49 = new \DocuSign\eSign\Model\Text();
					$tab49->setTabLabel("years");
					$tab49->setValue($row['q118']);
					
					$tab50 = new \DocuSign\eSign\Model\Text();
					$tab50->setTabLabel("months");
					$tab50->setValue($row['q119']);
					
					$tab51 = new \DocuSign\eSign\Model\Text();
					$tab51->setTabLabel("Bank name 1");
					$tab51->setValue($row['q123']);
					
					$tab52 = new \DocuSign\eSign\Model\Text();
					$tab52->setTabLabel("Bank name 1");
					$tab52->setValue($row['q124']);
					
					$tab53 = new \DocuSign\eSign\Model\Text();
					$tab53->setTabLabel("Routing Number Shown on the bottom of check1");
					$tab53->setValue($row['q125']);
					
					$tab54 = new \DocuSign\eSign\Model\Text();
					$tab54->setTabLabel("Bank Account Number Shown on the bottom of check1");
					$tab54->setValue($row['q126a']);
					
					$tab55 = new \DocuSign\eSign\Model\Text();
					$tab55->setTabLabel("Provide separate pages if needed");
					$tab55->setValue($row['q127']);
					
					$tab56 = new \DocuSign\eSign\Model\Text();
					$tab56->setTabLabel("MCC  SIC");
					$tab56->setValue($row['q128']);
					
					
					$tab150 = new \DocuSign\eSign\Model\Text();
					$tab150->setTabLabel("OwnerName");
					$tab150->setValue($row['q111']);
					
					$tab151 = new \DocuSign\eSign\Model\Text();
					$tab151->setTabLabel("Print name_2");
					$tab151->setValue($row['q111']);
					
					$tab152 = new \DocuSign\eSign\Model\Text();
					$tab152->setTabLabel("Title_2");
					$tab152->setValue($row['q111a']);
					
					
					//Checkbox
					
					$checkbox=array();
					
					$tab57 = "";
					if($row['q91']==1){
						$tab57 = new \DocuSign\eSign\Model\Checkbox();
						$tab57->setTabLabel("Sole Proprietorship Date of Birth");
						$tab57->setSelected(true);
						$checkbox[]=$tab57;
					}
					
					$tab58 = "";
					if($row['q91']==2){
						$tab58 = new \DocuSign\eSign\Model\Checkbox();
						$tab58->setTabLabel("LLC");
						$tab58->setSelected(true);
						$checkbox[]=$tab58;
					}
					
					$tab59 = "";
					if($row['q91']==3){
						$tab59 = new \DocuSign\eSign\Model\Checkbox();
						$tab59->setTabLabel("Partnership");
						$tab59->setSelected(true);
						$checkbox[]=$tab59;
					}
					
					$tab60 = "";
					if($row['q91']==4){
						$tab60 = new \DocuSign\eSign\Model\Checkbox();
						$tab60->setTabLabel("Ltd Liability Partnership");
						$tab60->setSelected(true);
						$checkbox[]=$tab60;
					}
					
					$tab61 = "";
					if($row['q91']==5){
						$tab61 = new \DocuSign\eSign\Model\Checkbox();
						$tab61->setTabLabel("Government Entity");
						$tab61->setSelected(true);
						$checkbox[]=$tab61;
					}
					
					$tab62 = "";
					if($row['q91']==6){
						$tab62 = new \DocuSign\eSign\Model\Checkbox();
						$tab62->setTabLabel("Trust");
						$tab62->setSelected(true);
						$checkbox[]=$tab62;
					}
					
					$tab63 = "";
					if($row['q91']==7){
						$tab63 = new \DocuSign\eSign\Model\Checkbox();
						$tab63->setTabLabel("Professional Association");
						$tab63->setSelected(true);
						$checkbox[]=$tab63;
					}
					
					$tab64 = "";
					if($row['q91']==8){
						$tab64 = new \DocuSign\eSign\Model\Checkbox();
						$tab64->setTabLabel("Political Organization");
						$tab64->setSelected(true);
						$checkbox[]=$tab64;
					}
					
					$tab65 = "";
					if($row['q91']==9){
						$tab65 = new \DocuSign\eSign\Model\Checkbox();
						$tab65->setTabLabel("Public Corporation");
						$tab65->setSelected(true);
						$checkbox[]=$tab65;
					}
					
					$tab66 = "";
					if($row['q91']==10){
						$tab66 = new \DocuSign\eSign\Model\Checkbox();
						$tab66->setTabLabel("Private Corporation");
						$tab66->setSelected(true);
						$checkbox[]=$tab66;
					}
					
					$tab67 = "";
					if($row['q91']==11){
						$tab67 = new \DocuSign\eSign\Model\Checkbox();
						$tab67->setTabLabel("Non Profit Corporation");
						$tab67->setSelected(true);
						$checkbox[]=$tab67;
					}
					
					
					//RadioGroup
					$radiogroup=array();
					
					$tab68="";
					if($row['q92']==1){
						$tab68_radio = new \DocuSign\eSign\Model\Radio();
						$tab68_radio->setValue("Yes_6");
						$tab68_radio->setSelected(true);
						
						$tab68 = new \DocuSign\eSign\Model\RadioGroup();
						$tab68->setGroupName("Have you ever accepted credit cards before");
						$tab68->setRadios(array($tab68_radio));
						
						$radiogroup[]=$tab68;
					
					} else if($row['q92']==2){
						$tab68_radio = new \DocuSign\eSign\Model\Radio();
						$tab68_radio->setValue("No_6");
						$tab68_radio->setSelected(true);
						
						$tab68 = new \DocuSign\eSign\Model\RadioGroup();
						$tab68->setGroupName("Have you ever accepted credit cards before");
						$tab68->setRadios(array($tab68_radio));
						$radiogroup[]=$tab68;
					
					}
					
					$tab69 = new \DocuSign\eSign\Model\Text();
					$tab69->setTabLabel("Number of locations");
					$tab69->setValue($row['q93']);
					
					$tab70 = new \DocuSign\eSign\Model\Text();
					$tab70->setTabLabel("If you are affiliated with an existing account please provide existing Merchant ID");
					$tab70->setValue($row['q95']);
					
					
					$tab71="";
					if($row['q96']==1){
						$tab71_radio = new \DocuSign\eSign\Model\Radio();
						$tab71_radio->setValue("Yes_7");
						$tab71_radio->setSelected(true);
						
						$tab71 = new \DocuSign\eSign\Model\RadioGroup();
						$tab71->setGroupName("Do you bill your customers prior to goods being shipped");
						$tab71->setRadios(array($tab71_radio));
						
						$radiogroup[]=$tab71;
					
					} else if($row['q96']==2){
						$tab71_radio = new \DocuSign\eSign\Model\Radio();
						$tab71_radio->setValue("No_7");
						$tab71_radio->setSelected(true);
						
						$tab71 = new \DocuSign\eSign\Model\RadioGroup();
						$tab71->setGroupName("Do you bill your customers prior to goods being shipped");
						$tab71->setRadios(array($tab71_radio));
						$radiogroup[]=$tab71;
					
					}
					
					$tab72 = "";
					if($row['q97']==1){
						$tab72 = new \DocuSign\eSign\Model\Checkbox();
						$tab72->setTabLabel("02 days");
						$tab72->setSelected(true);
						$checkbox[]=$tab72;
					}
					
					$tab73 = "";
					if($row['q97']==2){
						$tab73 = new \DocuSign\eSign\Model\Checkbox();
						$tab73->setTabLabel("330 days");
						$tab73->setSelected(true);
						$checkbox[]=$tab73;
					}
					
					$tab74 = "";
					if($row['q97']==3){
						$tab74 = new \DocuSign\eSign\Model\Checkbox();
						$tab74->setTabLabel("3160 days");
						$tab74->setSelected(true);
						$checkbox[]=$tab74;
					}
					
					$tab75 = "";
					if($row['q97']==4){
						$tab75 = new \DocuSign\eSign\Model\Checkbox();
						$tab75->setTabLabel("6190 days");
						$tab75->setSelected(true);
						$checkbox[]=$tab75;
					}
					
					$tab76 = "";
					if($row['q97']==5){
						$tab76 = new \DocuSign\eSign\Model\Checkbox();
						$tab76->setTabLabel("Over 90 days");
						$tab76->setSelected(true);
						$checkbox[]=$tab76;
					}
					
					$tab77 = "";
					if($row['q103']==1){
						$tab77 = new \DocuSign\eSign\Model\Checkbox();
						$tab77->setTabLabel("Yes_11");
						$tab77->setSelected(true);
						$checkbox[]=$tab77;
					}
					
					$tab78 = "";
					if($row['q103']==2){
						$tab78 = new \DocuSign\eSign\Model\Checkbox();
						$tab78->setTabLabel("No If Yes indicate by X the months that are ACTIVE");
						$tab78->setSelected(true);
						$checkbox[]=$tab78;
					}
					
					$tab79 = "";
					if($row['q104a']==1){
						$tab79 = new \DocuSign\eSign\Model\Checkbox();
						$tab79->setTabLabel("Jan");
						$tab79->setSelected(true);
						$checkbox[]=$tab79;
					}
					
					$tab80 = "";
					if($row['q104b']==2){
						$tab80 = new \DocuSign\eSign\Model\Checkbox();
						$tab80->setTabLabel("Feb");
						$tab80->setSelected(true);
						$checkbox[]=$tab80;
					}
					
					$tab81 = "";
					if($row['q104c']==3){
						$tab81 = new \DocuSign\eSign\Model\Checkbox();
						$tab81->setTabLabel("Mar");
						$tab81->setSelected(true);
						$checkbox[]=$tab81;
					}
					
					$tab82 = "";
					if($row['q104d']==4){
						$tab82 = new \DocuSign\eSign\Model\Checkbox();
						$tab82->setTabLabel("Apr");
						$tab82->setSelected(true);
						$checkbox[]=$tab82;
					}
					
					$tab83 = "";
					if($row['q104e']==5){
						$tab83 = new \DocuSign\eSign\Model\Checkbox();
						$tab83->setTabLabel("May");
						$tab83->setSelected(true);
						$checkbox[]=$tab83;
					}
					
					$tab84 = "";
					if($row['q104f']==6){
						$tab84 = new \DocuSign\eSign\Model\Checkbox();
						$tab84->setTabLabel("jun");
						$tab84->setSelected(true);
						$checkbox[]=$tab84;
					}
					
					$tab85 = "";
					if($row['q104g']==7){
						$tab85 = new \DocuSign\eSign\Model\Checkbox();
						$tab85->setTabLabel("Jul");
						$tab85->setSelected(true);
						$checkbox[]=$tab85;
					}
					
					$tab86 = "";
					if($row['q104h']==8){
						$tab86 = new \DocuSign\eSign\Model\Checkbox();
						$tab86->setTabLabel("Aug");
						$tab86->setSelected(true);
						$checkbox[]=$tab86;
					}
					
					$tab87 = "";
					if($row['q104i']==9){
						$tab87 = new \DocuSign\eSign\Model\Checkbox();
						$tab87->setTabLabel("Sep");
						$tab87->setSelected(true);
					}
					
					$tab88 = "";
					if($row['q104j']==10){
						$tab88 = new \DocuSign\eSign\Model\Checkbox();
						$tab88->setTabLabel("Oct");
						$tab88->setSelected(true);
						$checkbox[]=$tab88;
					}
					
					$tab89 = "";
					if($row['q104k']==11){
						$tab89 = new \DocuSign\eSign\Model\Checkbox();
						$tab89->setTabLabel("Nov");
						$tab89->setSelected(true);
						$checkbox[]=$tab89;
					}
					
					$tab90 = "";
					if($row['q104l']==12){
						$tab90 = new \DocuSign\eSign\Model\Checkbox();
						$tab90->setTabLabel("Dec");
						$tab90->setSelected(true);
						$checkbox[]=$tab90;
					}
					
					
					$tab91 = "";
					if($row['q105a']==1){
						$tab91 = new \DocuSign\eSign\Model\Checkbox();
						$tab91->setTabLabel("Retail");
						$tab91->setSelected(true);
						$checkbox[]=$tab91;
					}
					
					$tab92 = "";
					if($row['q105b']==2){
						$tab92 = new \DocuSign\eSign\Model\Checkbox();
						$tab92->setTabLabel("Retail with Tips");
						$tab92->setSelected(true);
						$checkbox[]=$tab92;
					}
					
					$tab93 = "";
					if($row['q105c']==3){
						$tab93 = new \DocuSign\eSign\Model\Checkbox();
						$tab93->setTabLabel("Restaurant");
						$tab93->setSelected(true);
						$checkbox[]=$tab93;
					}
					
					$tab94 = "";
					if($row['q105d']==4){
						$tab94 = new \DocuSign\eSign\Model\Checkbox();
						$tab94->setTabLabel("MOTO");
						$tab94->setSelected(true);
						$checkbox[]=$tab94;
					}
					
					$tab95 = "";
					if($row['q105e']==5){
						$tab95 = new \DocuSign\eSign\Model\Checkbox();
						$tab95->setTabLabel("Internet");
						$tab95->setSelected(true);
						$checkbox[]=$tab95;
					}
					
					$tab96 = "";
					if($row['q105f']==6){
						$tab96 = new \DocuSign\eSign\Model\Checkbox();
						$tab96->setTabLabel("Lodging");
						$tab96->setSelected(true);
						$checkbox[]=$tab96;
					}
					
					$tab97 = "";
					if($row['q105g']==7){
						$tab97 = new \DocuSign\eSign\Model\Checkbox();
						$tab97->setTabLabel("Supermarket");
						$tab97->setSelected(true);
						$checkbox[]=$tab97;
					}
					
					$tab98 = "";
					if($row['q105h']==8){
						$tab98 = new \DocuSign\eSign\Model\Checkbox();
						$tab98->setTabLabel("Utility");
						$tab98->setSelected(true);
						$checkbox[]=$tab98;
					}
					
					$tab99 = "";
					if($row['q105i']==9){
						$tab99 = new \DocuSign\eSign\Model\Checkbox();
						$tab99->setTabLabel("Pharmacy");
						$tab99->setSelected(true);
						$checkbox[]=$tab99;
					}
					
					$tab100 = "";
					if($row['q105j']==10){
						$tab100 = new \DocuSign\eSign\Model\Checkbox();
						$tab100->setTabLabel("Business to Business");
						$tab100->setSelected(true);
						$checkbox[]=$tab100;
					}
					
					$tab101 = "";
					if($row['q110']==1){
						$tab101 = new \DocuSign\eSign\Model\Checkbox();
						$tab101->setTabLabel("EIN");
						$tab101->setSelected(true);
						$checkbox[]=$tab101;
					}
					
					$tab102 = "";
					if($row['q110']==2){
						$tab102 = new \DocuSign\eSign\Model\Checkbox();
						$tab102->setTabLabel("Social Security Number orN");
						$tab102->setSelected(true);
						$checkbox[]=$tab102;
					}
					
					$tab103 = "";
					if($row['q110']==3){
						$tab103 = new \DocuSign\eSign\Model\Checkbox();
						$tab103->setTabLabel("ITIN");
						$tab103->setSelected(true);
						$checkbox[]=$tab103;
					}
					
					
					$tab104="";
					if($row['q120']==1){
						$tab104_radio = new \DocuSign\eSign\Model\Radio();
						$tab104_radio->setValue("Yes");
						$tab104_radio->setSelected(true);
						
						$tab104 = new \DocuSign\eSign\Model\RadioGroup();
						$tab104->setGroupName("Any prior bankruptcies Business");
						$tab104->setRadios(array($tab104_radio));
						
						$radiogroup[]=$tab104;
					
					} else if($row['q120']==2){
						$tab104_radio = new \DocuSign\eSign\Model\Radio();
						$tab104_radio->setValue("No");
						$tab104_radio->setSelected(true);
						
						$tab104 = new \DocuSign\eSign\Model\RadioGroup();
						$tab104->setGroupName("Any prior bankruptcies Business");
						$tab104->setRadios(array($tab104_radio));
						$radiogroup[]=$tab104;
					
					}
					
					$tab105="";
					if($row['q121']==1){
						$tab105_radio = new \DocuSign\eSign\Model\Radio();
						$tab105_radio->setValue("Yes_2");
						$tab105_radio->setSelected(true);
						
						$tab105 = new \DocuSign\eSign\Model\RadioGroup();
						$tab105->setGroupName("Any prior bankruptcies Business");
						$tab105->setRadios(array($tab105_radio));
						
						$radiogroup[]=$tab105;
					
					} else if($row['q121']==2){
						$tab105_radio = new \DocuSign\eSign\Model\Radio();
						$tab105_radio->setValue("No_2");
						$tab105_radio->setSelected(true);
						
						$tab105 = new \DocuSign\eSign\Model\RadioGroup();
						$tab105->setGroupName("Any prior bankruptcies Business");
						$tab105->setRadios(array($tab105_radio));
						
						$radiogroup[]=$tab105;
					
					}
					
					$tab106 = new \DocuSign\eSign\Model\Text();
					$tab106->setTabLabel("If Yes Filing Date");
					$tab106->setValue($row['q122']);
					
					$tab107 = new \DocuSign\eSign\Model\Text();
					$tab107->setTabLabel("If Yes Filing Date_2");
					$tab107->setValue($row['q122']);
					
					$tab108 = new \DocuSign\eSign\Model\Text();
					$tab108->setTabLabel("Business Legal Name Printed 1");
					$tab108->setValue($row['q80']);
					
					$address = $row['q82']." ".$row['q82a']." ".$row['q82b']." ".$row['q82c']." ".$row['q82d'];
					$tab109 = new \DocuSign\eSign\Model\Text();
					$tab109->setTabLabel("Business Legal Name Printed 2");
					$tab109->setValue($address);
					
					$tab110 = new \DocuSign\eSign\Model\Text();
					$tab110->setTabLabel("Business Legal Name Printed 3");
					$tab110->setValue($row['q85']);
					
					
					$tabs = new DocuSign\eSign\Model\Tabs();
					//$tabs->setTextTabs(array($textTab));
					$tabs->setTextTabs([$tab3, $tab4, $tab5, $tab6, $tab7, $tab8, $tab9, $tab10, $tab11, $tab12, $tab13, $tab14, $tab15, $tab16, $tab17, $tab20, $tab23, $tab24, $tab25, $tab26, $tab27, $tab28, $tab29, $tab30, $tab31, $tab32, $tab33, $tab34, $tab36, $tab37, $tab39, $tab40, $tab41, $tab42, $tab43, $tab44, $tab45, $tab46, $tab47, $tab48, $tab49, $tab50, $tab51, $tab52, $tab53, $tab54, $tab55, $tab56, $tab69, $tab70, $tab106, $tab107, $tab108, $tab109, $tab110, $tab150, $tab151, $tab152]);
					
					$tabs->setCheckboxTabs($checkbox);
					
					$tabs->setRadioGroupTabs($radiogroup);
					
					$templateRole->setTabs($tabs);
					
					
							

					// instantiate a new envelope object and configure settings
					$envelop_definition = new DocuSign\eSign\Model\EnvelopeDefinition();
					$envelop_definition->setEmailSubject("[DocuSign PHP SDK] - Signature Request Sample");
					$envelop_definition->setTemplateId("1fda9f2f-d523-4d3d-91e3-7d46e9fb48a0");
					$envelop_definition->setTemplateRoles(array($templateRole));
					
					// set envelope status to "sent" to immediately send the signature request
					$envelop_definition->setStatus("sent");

					// optional envelope parameters
					$options = new \DocuSign\eSign\Api\EnvelopesApi\CreateEnvelopeOptions();
					$options->setCdseMode(null);
					$options->setMergeRolesOnDraft(null);

					// create and send the envelope (aka signature request)
					$envelop_summary = $envelopeApi->createEnvelope($accountId, $envelop_definition, $options);
					if(!empty($envelop_summary))
					{
						//echo "$envelop_summary";
						
						$envelop_id = $envelop_summary->getEnvelopeId();
						
						//echo $envelop_id;
						
						//GET SIGNING URL
						$envelopeApi = new DocuSign\eSign\Api\EnvelopesApi($apiClient);
						$recipient_view_request = new \DocuSign\eSign\Model\RecipientViewRequest();
						
						$recipient_view_request->setReturnUrl($return_url);
						$recipient_view_request->setClientUserId($uniqid);
						$recipient_view_request->setAuthenticationMethod("email");
						$recipient_view_request->setUserName($user_name);
						$recipient_view_request->setEmail($user_email);
						
						$signingView = $envelopeApi->createRecipientView($accountId, $envelop_id, $recipient_view_request);
						//$this->assertNotEmpty($signingView);
						$signing_url = $signingView->getUrl();
						
						header("Location:".$signing_url);
					}
				}
			}
		}
	}
	catch (DocuSign\eSign\ApiException $ex)
	{
		echo "Exception: " . $ex->getMessage() . "\n";
	}
	
	
	
		
?>