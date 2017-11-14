

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
	$("#error").hide();
	$(".error").each(function() {
		$(this).removeClass("error");
	});
	
	var name = $("#name").val();
	var optionSelected = $("#type").find("option:selected");
	var type = optionSelected.val();
	var rate = optionSelected.attr("rate");
	var ms = $("#ms").val().replace(/\,/g,"");
	var tr = $("#tr").val();
	var fees = $("#fees").val().replace(/\,/g,"");
	var ccp = $("#ccp").val();
	
	var sca = $("#sca").val();
	var mfee = $("#mfee").val();
	var merchant_id = $("#merchant_id").val();
	
	var error = 0;
	if(name==0 || !name){
		error=1;
		$("#name").addClass("error");
	}
	
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
	
	if(ccp==0 || !ccp){
		error=1;
		$("#ccp").addClass("error");
	}
	
	if(sca==0 || !sca){
		error=1;
		$("#scaw").addClass("error");
	}
	
	if(mfee==0 || !mfee){
		error=1;
		$("#mfeew").addClass("error");
	}
	
	if(error==0) {
		$.ajax({
			type: 'post',
			url: 'https://www.360payments.com/adpanel/ajax/calculate.php',
			data: "name="+name+"&type="+type+"&rate="+rate+"&ms="+ms+"&tr="+tr+"&fees="+fees+"&ccp="+ccp+"&sca="+sca+"&merchant_id="+merchant_id+"&rate="+rate+"&mfee="+mfee,
			dataType: "JSON",
			success: function (data) {
				if(data.error_code==1){
					$("#error").html(data.error);
					$("#error").show();
				} else {
					$("#finaldata").html(data.data);
					$("#finaldata").show();
					$("#calculator").hide();
				}
			}
		});
	}
}


function precalculate(){
	$("#error").hide();
	$(".error").each(function() {
		$(this).removeClass("error");
	});
	
	var name = $("#name").val();
	var optionSelected = $("#type").find("option:selected");
	var type = optionSelected.val();
	var type_name = optionSelected.text();
	var rate = optionSelected.attr("rate");
	var ms = $("#ms").val().replace(/\,/g,"");
	var tr = $("#tr").val();
	var fees = $("#fees").val().replace(/\,/g,"");
	var ccp = $("#ccp").val();
	
	var sca = $("#sca").val();
	var mfee = $("#mfee").val();
	var merchant_id = $("#merchant_id").val();
	
	var error = 0;
	if(name==0 || !name){
		error=1;
		$("#name").addClass("error");
	}
	
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
	
	if(ccp==0 || !ccp){
		error=1;
		$("#ccp").addClass("error");
	}
	
	if(sca==0 || !sca){
		error=1;
		$("#scaw").addClass("error");
	}
	
	if(mfee==0 || !mfee){
		error=1;
		$("#mfeew").addClass("error");
	}
	
	if(error==0) {
		$("#precalculator").hide();
		$.ajax({
			type: 'post',
			url: 'https://www.360payments.com/adpanel/ajax/precalculate.php',
			data: "name="+name+"&type="+type+"&rate="+rate+"&ms="+ms+"&tr="+tr+"&fees="+fees+"&ccp="+ccp+"&sca="+sca+"&merchant_id="+merchant_id+"&rate="+rate+"&mfee="+mfee+"&type_name="+type_name,
			dataType: "JSON",
			success: function (data) {
				if(data.error_code==1){
					$("#error").html(data.error);
					$("#error").show();
				} else {
					$("#precalculator").html(data.data);
					$("#precalculator").show();
					$(window).scrollTop($('#precalculator').offset().top);
				}
			}
		});
	}
}

function recalculate(){
	$("#error").hide();
	$("#finaldata").hide();
	$("#calculator").show();
}


function finalize(){
	$("#error").hide();
	$("#results").hide();
	$("#finalize").show();
}


function backtoresults(){
	$("#error").hide();
	$("#results").show();
	$("#finalize").hide();
}



function save(){
	$(".error").each(function() {
		$(this).removeClass("error");
	});
	
	$("#error").hide();
	
	var name = $("#name").val();
	var optionSelected = $("#type").find("option:selected");
	var type = optionSelected.val();
	var rate = optionSelected.attr("rate");
	var type_name = optionSelected.text();
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
	var mfee = $("#mfee").val();
	var merchant_id = $("#merchant_id").val();
	
	var exmails = $("#exmails").val();
	
	var error = 0;
	if(firstname==0 || !firstname){
		error=1;
		$("#firstname").addClass("error");
	}
	
	if(lastname==0 || !lastname){
		error=1;
		$("#lastname").addClass("error");
	}
	
	
	if(email==0 || !email || !isValidEmailAddress(email)){
		error=1;
		$("#email").addClass("error");
	}
	
	if(contact==0 || !contact){
		error=1;
		$("#contact").addClass("error");
	}
	
	if(pass==0 || !pass){
		error=1;
		$("#password").addClass("error");
	}
	
	
	
	if(error==0) {
		$("#email_error").html("");
		//Verify email
		
		$.ajax({
			type: 'post',
			url: 'https://www.360payments.com/adpanel/ajax/save.php',
			data: "name="+name+"&type="+type+"&rate="+rate+"&ms="+ms+"&tr="+tr+"&fees="+fees+"&ccp="+ccp+"&firstname="+firstname+"&lastname="+lastname+"&email="+email+"&contact="+contact+"&pass="+pass+"&sca="+sca+"&merchant_id="+merchant_id+"&rate="+rate+"&type_name="+type_name+"&exmails="+exmails+"&mfee="+mfee,
			dataType: "JSON",
			success: function (data) {
				if(data.error_code==1){
					$("#error").html(data.error);
					$("#error").show();
				} else {
					window.open('https://www.360payments.com/apply/form/', '_blank'); 
					//$("#finaldata").html(data.data);
				}
			}
		});
	}
	
	
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

$('#mfee').inputmask("numeric", {
    radixPoint: ".",
    groupSeparator: ",",
    digits: 2,
    autoGroup: true,
    prefix: '', //No Space, this will truncate the first character
    rightAlign: false,
    oncleared: function () { self.Value(''); }
});


function savestatus(id){
	var optionSelected = $("#st"+id).find("option:selected");
	var statu = optionSelected.val();
	$.ajax({
		type: 'post',
		url: 'https://www.360payments.com/adpanel/ajax/changestatus.php',
		data: "status="+statu+"&id="+id,
		dataType: "JSON",
		success: function (data) {
			
		}
	});
}
