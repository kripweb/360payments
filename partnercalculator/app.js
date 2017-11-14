$( document ).ready(function() {
	
	
	
	$(".select2").select2({
		width: "100%"
	});
	
	$('[data-toggle="tooltip"]').tooltip();
	
	
});

var site_url = $("#site_url").val();

function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};


function percentage (a) {
	return Math.round(a * 100 * 100)/100+" %";
}

function formatCurrency(total) {
    var neg = false;
    if(total < 0) {
        neg = true;
        total = Math.abs(total);
    }
    return (neg ? "-$ " : '$ ') + parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
}


function calculate(){
	
	$(".error").each(function() {
		$(this).removeClass("error");
	});
	
	$(".error2").each(function() {
		$(this).hide();
	});
	
	var name = $("#name").val();
	var optionSelected = $("#type").find("option:selected");
	var type = optionSelected.val();
	var rate = optionSelected.attr("rate");
	var ms = $("#ms").val().replace(/\,/g,"");
	var tr = $("#tr").val();
	var fees = $("#fees").val().replace(/\,/g,"");
	
	var error = 0;
	if(type==0 || !type){
		error=1;
		$(".select2-selection").addClass("error");
	}
	
	
	if(ms==0 || !ms){
		error=1;
		$("#igms").addClass("error");
	}
	
	if(tr==0 || !tr){
		error=1;
		$("#tr").addClass("error");
	}
	
	if(fees==0 || !fees){
		error=1;
		$("#igfees").addClass("error");
	}
	
	if(error==0) {
	
		var r1 = ms/tr;
		var r2 = fees/ms;
		var r3 = rate;
		var r4 = r2-r3;
		var r5 = 0.6;
		var r6 = r4*r5;
		var r7 = +r3+r6;
		var r8 = (r2-r7)*ms;
		var r9 = r8*12;
		var r10 = r9*3;
		
		$("#r1").html(formatCurrency(r1));
		$("#r2").html(percentage(r2));
		$("#r3").html(percentage(r3));
		$("#r4").html(percentage(r4));
		$("#r5").html(percentage(r5));
		$("#r6").html(percentage(r6));
		$("#r7").html(percentage(r7));
		$("#r8").html(formatCurrency(r8));
		$("#r9").html(formatCurrency(r9));
		$("#r10").html(formatCurrency(r10));
		
		$("#results").show();
	}
}



function step2(){
	$(".error").each(function() {
		$(this).removeClass("error");
	});
	
	$(".error2").each(function() {
		$(this).hide();
	});
	
	
	var name = $("#name").val();
	var optionSelected = $("#type").find("option:selected");
	var type = optionSelected.val();
	var rate = optionSelected.attr("rate");
	var ms = $("#ms").val().replace(/\,/g,"");
	var tr = $("#tr").val();
	var fees = $("#fees").val().replace(/\,/g,"");
	var ccp = $("#ccp").val();
	
	var error = 0;
	if(name==0 || !name){
		error=1;
		$("#name").addClass("error");
		$("#e_name").show();
	}
	
	if(type==0 || !type){
		error=1;
		$(".select2-selection").addClass("error");
		$("#e_type").show();
	}
	
	
	if(ms==0 || !ms){
		error=1;
		$("#igms").addClass("error");
		$("#e_ms").show();
	}
	
	if(tr==0 || !tr){
		error=1;
		$("#tr").addClass("error");
		$("#e_tr").show();
	}
	
	if(fees==0 || !fees){
		error=1;
		$("#igfees").addClass("error");
		$("#e_fees").show();
	}
	
	if(ccp==0 || !ccp){
		error=1;
		$("#ccp").addClass("error");
		$("#e_ccp").show();
	}
	
	var ccp2 = ccp.toLowerCase();
	if (ccp2.indexOf('360') > -1 || ccp2.indexOf('you') > -1){
		error=1;
		$("#e_ccp").html("We're glad you're already our customer! Give us a call at (408) 295-8360 and we'll answer any questions you have.");
		$("#e_ccp").show();
		
	}
	
	if(error==0) {
		$("#step1").hide();
		$("#step2").show();
	}
	
	
}



function step3(){
	$(".error").each(function() {
		$(this).removeClass("error");
	});
	
	$(".error2").each(function() {
		$(this).hide();
	});
	
	$("#error").hide();
	
	var name = $("#name").val();
	var optionSelected = $("#type").find("option:selected");
	var type = optionSelected.val();
	var type_name = optionSelected.text();
	var rate = optionSelected.attr("rate");
	var ms = $("#ms").val().replace(/\,/g,"");
	var tr = $("#tr").val();
	var fees = $("#fees").val().replace(/\,/g,"");
	var ccp = $("#ccp").val();
	
	
	var firstname = $("#firstname").val();
	var lastname = $("#lastname").val();
	var email = $("#email").val();
	var contact = $("#contact").val();
	var pass = $("#password").val();
	
	var sca = $("#sca").val();
	var merchant_id = $("#merchant_id").val();
	
	var error = 0;
	if(firstname==0 || !firstname){
		error=1;
		$("#firstname").addClass("error");
		$("#e_firstname").show();
	}
	
	if(lastname==0 || !lastname){
		error=1;
		$("#lastname").addClass("error");
		$("#e_lastname").show();
	}
	
	
	if(email==0 || !email || !isValidEmailAddress(email)){
		error=1;
		$("#email").addClass("error");
		$("#e_email").show();
	}
	
	if(contact==0 || !contact){
		error=1;
		$("#contact").addClass("error");
		$("#e_contact").show();
	}
	
	if(pass==0 || !pass){
		error=1;
		$("#pass").addClass("error");
		$("#e_password").show();
	}
	
	
	
	if(error==0) {
		$("#email_error").html("");
		//Verify email
		
		$.ajax({
			type: 'post',
			url: 'https://www.360payments.com/partnercalculator/ajax/calculate.php',
			data: "name="+name+"&type="+type+"&rate="+rate+"&ms="+ms+"&tr="+tr+"&fees="+fees+"&ccp="+ccp+"&firstname="+firstname+"&lastname="+lastname+"&email="+email+"&contact="+contact+"&pass="+pass+"&sca="+sca+"&merchant_id="+merchant_id+"&rate="+rate+"&type_name="+type_name,
			dataType: "JSON",
			success: function (data) {
				if(data.error_code==1){
					$("#error").html(data.error);
					$("#error").show();
				} else {
					$("#finaldata").html(data.data);
				}
			}
		});
	}
	
	
}

function moreinfo(){
	$("#results").hide();
	$("#moreinfo").show();
}

function backtoresults(){
	$("#results").show();
	$("#moreinfo").hide();
}


function backtomain(){
	$("#step1").show();
	$("#step2").hide();
}


String.prototype.reverse = function () {
	return this.split("").reverse().join("");
}

function reformatText(input) {        
	var x = input.value;
	x = x.replace(/,/g, ""); // Strip out all commas
	x = x.reverse();
	x = x.replace(/.../g, function (e) {
		return e + ",";
	}); // Insert new commas
	x = x.reverse();
	x = x.replace(/^,/, ""); // Remove leading comma
	input.value = x;
}


$('#ms').inputmask("numeric", {
    radixPoint: ".",
    groupSeparator: ",",
    digits: 2,
    autoGroup: true,
    prefix: '', //No Space, this will truncate the first character
    rightAlign: false,
    oncleared: function () { self.Value(''); }
});

$('#fees').inputmask("numeric", {
    radixPoint: ".",
    groupSeparator: ",",
    digits: 2,
    autoGroup: true,
    prefix: '', //No Space, this will truncate the first character
    rightAlign: false,
    oncleared: function () { self.Value(''); }
});
