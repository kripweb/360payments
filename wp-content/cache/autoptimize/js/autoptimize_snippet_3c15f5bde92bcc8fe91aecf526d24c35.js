function nmi701_deletePM(id,apikey,gatewayurl,vaultid,position,e,nonce,tokenid){if(e.target.nodeName=='A'){document.getElementById('paymentmethodli'+position).style.backgroundColor="#CCCCCC";jQuery.ajax({type:"POST",url:frontendajax.ajaxurl,async:false,data:{action:'nmi701_deletePaymentMethod',apikey:apikey,gatewayurl:gatewayurl,vaultid:vaultid,billingid:id,security:nonce,tokenid:tokenid},success:function(response){var responseid=response.replace(/^\s+|\s+$/gm,'');if(responseid>3)responseid=responseid/10;if(responseid==1||responseid==3){document.getElementById('paymentmethodli'+position).style.display="none";if(document.getElementById('paymentmethodid').value==id){document.getElementById('paymentmethodid').value="";document.getElementById('customervaultid').value="";}}},error:function(jqXHR,textStatus,errorThrown){document.getElementById('paymentmethodli'+position).style.backgroundColor="#FFFFFF";alert(textStatus);}});}};