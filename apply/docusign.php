<?php
	session_start();
	require_once('ajax/config.php');
	
	$return_url = $site_url."/complete/";
	$user_id = $_SESSION['user_id'];
	
	if(!$user_id){ echo "Invlid access!"; exit(); }
	
	$user = "SELECT * FROM user_answers WHERE id='$user_id'";
	$user = mysqli_query($mysqli, $user);
	$user_row = mysqli_fetch_assoc($user);
	
	$update = "Update user_answers SET status='2' WHERE id='$user_id'";
	$update = mysqli_query($mysqli, $update);
	
	
	$user_query = "SELECT * FROM user_answers WHERE id='$user_id'";
	$user_query = mysqli_query($mysqli, $user_query);
	$total = mysqli_num_rows($user_query);
	$row = mysqli_fetch_assoc($user_query);
	
	$user_name = $row['q111'];
	$user_email = $user_row['email'];
	$uniqid = $user_id;

	require_once('docusign/autoload.php');
	
    // DocuSign environment we are using
   
	
	//$username = "rleveque@360payments.com";
	//$password = "Dreambig7!";
	$username = "tickets@360-payments.com";
	$password = "360rocks!";
	$integrator_key = "88694ba4-e991-468d-ba04-95cc08676374";   

	// change to production (www.docusign.net) before going live
	$host = "https://www.docusign.net/restapi";

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
					
					
					$address = $row['q82']." ".$row['q82a']." ".$row['q82b']." ".$row['q82c']." ".$row['q82d'];
					
					
					$tab1 = new \DocuSign\eSign\Model\Text();
					$tab1->setTabLabel("owner_name");
					$tab1->setValue($row['q111']);
					
					$tab6 = new \DocuSign\eSign\Model\Text();
					$tab6->setTabLabel("owner_name2");
					$tab6->setValue($row['q111']);
					
					$tab7 = new \DocuSign\eSign\Model\Text();
					$tab7->setTabLabel("owner_name3");
					$tab7->setValue($row['q111']);
					
					$tab2 = new \DocuSign\eSign\Model\Text();
					$tab2->setTabLabel("owner_title");
					$tab2->setValue($row['q111a']);
					
					$tab8 = new \DocuSign\eSign\Model\Text();
					$tab8->setTabLabel("owner_title2");
					$tab8->setValue($row['q111a']);
					
					$tab3 = new \DocuSign\eSign\Model\Text();
					$tab3->setTabLabel("business_name");
					$tab3->setValue($row['q80']);
					
					$tab4 = new \DocuSign\eSign\Model\Text();
					$tab4->setTabLabel("business_address");
					$tab4->setValue($address);
					
					$tab5 = new \DocuSign\eSign\Model\Text();
					$tab5->setTabLabel("business_phone");
					$tab5->setValue($row['q85a']);
					

					
					$tabs = new DocuSign\eSign\Model\Tabs();
					//$tabs->setTextTabs(array($textTab));
					$tabs->setTextTabs([$tab1, $tab2, $tab3, $tab4, $tab5, $tab6, $tab7, $tab8]);

					$templateRole->setTabs($tabs);
					
					
							

					// instantiate a new envelope object and configure settings
					$envelop_definition = new DocuSign\eSign\Model\EnvelopeDefinition();
					$envelop_definition->setEmailSubject("360 Payments Merchant Document");
					//$envelop_definition->setTemplateId("e2f3ffec-327d-42bb-ac3a-cdfbee875064");
					$envelop_definition->setTemplateId("e900f8a0-be21-4583-b03e-97fb363a1d20");
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