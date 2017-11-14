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
					
					$tab1 = new \DocuSign\eSign\Model\Text();
					$tab1->setTabLabel("All Card Types");
					$tab1->setValue($row['q4']);
					
					$tab2 = new \DocuSign\eSign\Model\Text();
					$tab2->setTabLabel("Voice");
					$tab2->setValue($row['q5']);
					
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
					
					$tab35 = new \DocuSign\eSign\Model\Text();
					$tab35->setTabLabel("Print name");
					$tab35->setValue($row['q111']);
					
					$tab36 = new \DocuSign\eSign\Model\Text();
					$tab36->setTabLabel("Printed Name of Owner or Officer 1");
					$tab36->setValue($row['q111']);
					
					$tab37 = new \DocuSign\eSign\Model\Text();
					$tab37->setTabLabel("Printed Name of Owner or Officer 2");
					$tab37->setValue($row['q111']);
					
					$tab38 = new \DocuSign\eSign\Model\Text();
					$tab38->setTabLabel("Name");
					$tab38->setValue($row['q111a']);
					
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
					
					//Checkbox
					
					$tab57 = new \DocuSign\eSign\Model\Checkbox();
					$tab57->setTabLabel("Restaurant");
					$tab57->setSelected(true);
					
					
					//Radio Button
					$tab58_radio = new \DocuSign\eSign\Model\Radio();
					$tab58_radio->setValue("Yes");
					$tab58_radio->setSelected(true);
					
					$tab58 = new \DocuSign\eSign\Model\RadioGroup();
					$tab58->setGroupName("Any prior bankruptcies Business");
					$tab58->setRadios(array($tab58_radio));
					
					
					$tabs = new DocuSign\eSign\Model\Tabs();
					//$tabs->setTextTabs(array($textTab));
					$tabs->setTextTabs([$tab1, $tab2, $tab3, $tab4, $tab5, $tab6, $tab7, $tab8, $tab9, $tab10, $tab11, $tab12, $tab13, $tab14, $tab15, $tab16, $tab17, $tab20, $tab23, $tab24, $tab25, $tab26, $tab27, $tab28, $tab29, $tab30, $tab31, $tab32, $tab33, $tab34, $tab35, $tab36, $tab37, $tab38, $tab39, $tab40, $tab41, $tab42, $tab43, $tab44, $tab45, $tab46, $tab47, $tab48, $tab49, $tab50, $tab51, $tab52, $tab53, $tab54, $tab55, $tab56]);
					
					$tabs->setCheckboxTabs(array($tab57));
					
					$tabs->setRadioGroupTabs(array($tab58));
					
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