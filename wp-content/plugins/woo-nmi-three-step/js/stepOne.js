//performs step one of the nmi three step process.  formats non-secure data and retrieves a url
function nmi701_stepOne(data, path) {
    var items = [];
    for (var x=0;x<data['itemcount'];x++) {
        var item = {
            productid: data['item'+x]['productid'],
            name: data['item'+x]['name'],
            line_total: data['item'+x]['line_total'],
            qty: data['item'+x]['qty'],
            line_subtotal: data['item'+x]['line_subtotal']
        }
        
        items.push(item);
    }
    
    jQuery.ajax({
        type:   "POST",
        url:    frontendajax.ajaxurl,
        async: false,
        data: {
            action: 'nmi701_stepOne',
            orderid: data['orderid'],
            apikey: data['apikey'],
            transactiontype: data['transactiontype'],
            gatewayurl: data['gatewayurl'],
            ordertotal: data['ordertotal'],
            ordertax: data['ordertax'],
            ordershipping: data['ordershipping'],
            savepaymentmethod: data['savepaymentmethod'],
            customervaultid: data['customervaultid'],
            user_email: data['user_email'],
            userid: data['userid'],
            last4: data['last4'],
            expiry: data['expiry'],
            billingid: data['billingid'],
            billingfirstname: data['billingfirstname'],
            billinglastname: data['billinglastname'],
            billingaddress1: data['billingaddress1'],
            billingcity: data['billingcity'],
            billingstate: data['billingstate'],
            billingpostcode: data['billingpostcode'],
            billingcountry: data['billingcountry'],
            billingemail: data['billingemail'],
            billingphone: data['billingphone'],
            billingcompany: data['billingcompany'],
            billingaddress2: data['billingaddress2'],
            shippingfirstname: data['shippingfirstname'],
            shippinglastname: data['shippinglastname'],
            shippingaddress1: data['shippingaddress1'],
            shippingcity: data['shippingcity'],
            shippingstate: data['shippingstate'],
            shippingpostcode: data['shippingpostcode'],
            shippingcountry: data['shippingcountry'],
            shippingphone: data['shippingphone'],
            shippingcompany: data['shippingcompany'],
            shippingaddress2: data['shippingaddress2'],
            items: items,
            itemcount: data['itemcount'],
            security: data['security']
        },
        success:function(response){
            var formurl = response;
            //alert('i do get here');
            //if data['billingid'] is not null, that implies a payment method was selected and we don't have to do step 2, just skip to step three
            if (formurl.indexOf('Payment Gateway Failed') !== -1) {
                //error returned, force redirect and display error
                console.log('error');
                console.log(response);
                debugger;
            }
            else if (data['billingid'] == '') {
                //one off pm or saving new pm
              //console.log('submitpayment form submitted');
              document.getElementById('submitpayment').action = formurl.replace(/^\s+|\s+$/gm,'');
              //console.log('formurl: ' + formurl);
              //console.log(response);
              //debugger;
              document.getElementById('submitpayment').submit();
            }
            else {
                //using saved payment method - most of this one isn't needed
                var checkoutURL = "/checkout/";
                //console.log('submitpaymentmethod form submitted');
                //console.log(formurl);
                //debugger;
                var response = formurl.split('||');
                var url = response[0];
                var rc = response[1];
                var tid = response[2];
                var ac = response[3];
                var ar = response[4];
                
                var posturl = url;

                var token = "";
                var token = url.split("/");
                token = token[(token.length - 1)];
                
                var url = checkoutURL + "?key=woo&order=" + data['orderid'] + "&token-id=" + token;
                url += "&rc=" + rc + "&tid=" + tid + "&ac=" + ac + "&ar=" + ar;
                
                document.getElementById('submitpaymentmethod').action = posturl;
                document.getElementById('submitpaymentmethod').submit();
                //
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(textStatus);
            alert(errorThrown);
        }
    });
}