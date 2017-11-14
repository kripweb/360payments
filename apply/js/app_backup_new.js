/* EXTRA FUNCTIONS */

$( document ).on( 'keypress', 'input', function(e) {
    if(e.which == 13){
        $(this).blur();    
    }
});


function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};

function resizeInput() {
    $(this).attr('size', $(this).val().length);
}
$('input[type="text"]').keyup(resizeInput).each(resizeInput);


(function($){
    $.fn.focusTextToEnd = function(){
        this.focus();
        var $thisVal = this.val();
        this.val('').val($thisVal);
        return this;
    }
}(jQuery));



/*LOGIN FUNCTION*/
$( document ).on( 'blur', '#L1', function() {
	//check if valid email else add password question.
	var email = $('#L1').val();
	if(!isValidEmailAddress(email)) {
		$("#error_L1").html('Please enter valid email id.');
		$('#L1').focus();
	} else {
		$("#error_L1").html('');
		var lid = $('#lid').val();
		if(lid==1) {
			$('#lid').val('2');
			$('.question_active').addClass('question_inactive');
			$('.question_active').addClass('bounce');
			$('.question_active').css({
				'transform': 'scale(0.75)'
			});
			$('.question_active').removeClass('question_active');
			$("#question_L2").addClass('question_active');
			$("#question_L2").show();
			$('#L2').focus();
		}
	}
});


$( document ).on( 'blur', '#L2', function() {

	var pass = $('#L2').val();
	if(!pass || pass==""){
		$("#error_L2").html('Please enter valid password.');
		$('#L2').focus();
	} else {
		$("#error_L2").html('');
		var lid = $('#lid').val();
		if(lid==2) {
			$('#lid').val('b1');
			$('.question_active').addClass('question_inactive');
			$('.question_active').addClass('bounce');
			$('.question_active').css({
				'transform': 'scale(0.75)'
			});
			$('.question_active').removeClass('question_active');
			$("#wb1").addClass('question_active');
			$("#wb1").show();
			
		}
	}
	
});



$( document ).on( 'click', '#b1', function() {
	var email = $('#L1').val();
		if(!isValidEmailAddress(email)) {
			$("#error_L2").html('Please enter valid email id.');
			$('#L1').focus();
		} else {
			var pass = $('#L2').val();
			if(!pass || pass==""){
				$("#error_L2").html('Please enter valid password.');
				$('#L2').focus();
			} else {
				$("#error_L2").html('Processing...');
				//make ajax call and load new content.
				$.ajax({
					type: 'post',
					url: 'ajax/login.php',
					data: "email="+email+"&pass="+pass,
					dataType: "JSON",
					success: function (data) {
						if(data.error==1){
							$("#error_L2").html(data.error_code);
						} else {
							
							//logged in successful
							var qid = data.cid;
							if(!qid || qid==0){ qid=1; }
							
							$("#qid").val(qid);
							
							$("#qw-1").hide();
							$("#qw-2").show();
							
							$("#question_"+qid).addClass('question_active');
							$("#question_"+qid).show();
							$("#"+qid).focusTextToEnd();
							
						}
					}
				});
			}
		}
});

$(document).ready(function(){
	var qid = $("#qid").val();
	$("#question_"+qid).addClass('question_active');
	$("#question_"+qid).show();
	$("#"+qid).focusTextToEnd();
	
	var pid = $("#pid").val();
	$("#page-"+pid).addClass('pactive');
	//$("#page-"+pid).show();
	$(".pactive .question:first").addClass('question_active');
	$(".pactive .question:first").show();
});

$(document).on('blur', 'input', function(){
	var autonext = $(this).attr("autonext");
	var qnumber  = $(this).attr("qnumber");
	var next     = $(this).attr("next");
	var addnew   = $(this).attr("addnew");
	var type     = $(this).attr("type");
	var value    = $(this).val();
	var nextpagebtn = $(this).attr("nextpagebtn");
	if(autonext==1) {
		var error = '';
		$("#error_"+qnumber).html("");
		if(type=='email' && !isValidEmailAddress(value)) {
			error = "Please enter valid email id.";
			$("#error_"+qnumber).html(error);
			$(this).focusTextToEnd();
		} else if (value=='' || !value){
			error = "Please provide valid answer.";
			$("#error_"+qnumber).html(error);
			$(this).focusTextToEnd();
		} else {
			//go to next question & save current
			
			//Save data to database & update cid
			$.ajax({
				type: 'post',
				url: 'ajax/savedata.php',
				data: "question="+qnumber+"&answer="+value,
				success: function (data) {
				}
			});
				
			if(addnew==1) {
				//$(this).attr("addnew", "0");
				$('.question_active').addClass('question_inactive');
				$('.question_active').addClass('bounce');
				$('.question_active').css({
					'transform': 'scale(0.75)'
				});
				$("#question_"+next).show();
				$('.question_active').removeClass('question_active');
				$("#question_"+next).addClass('question_active');
				
				if(nextpagebtn>0){
					$("#page-"+nextpagebtn+"-btn").show();
					$('.pagebtn_active').removeClass('pagebtn_active');
					$("#page-"+nextpagebtn+"-btn").addClass('pagebtn_active');
					$("#question_content").scrollTop($("#question_content")[0].scrollHeight);
				}
				
				$("#"+next).focusTextToEnd();
				
			} else {
				$("#"+next).focusTextToEnd();
			}
			
		}
		
	}
});



$(document).on('change', 'select', function(){
	var autonext = $(this).attr("autonext");
	var qnumber  = $(this).attr("qnumber");
	var next     = $(this).attr("next");
	var addnew   = $(this).attr("addnew");
	var type     = $(this).attr("type");
	var condition= $(this).attr("condition");
	var optionSelected = $(this).find("option:selected");
	var nextpagebtn = $(this).attr("nextpagebtn");
	var value    = optionSelected.val();
	if(autonext==1) {
		var error = '';
		$("#error_"+qnumber).html("");
		if (value==0 || !value){
			error = "Please select correct option.";
			$("#error_"+qnumber).html(error);
			$(this).focus();
		} else {
			//go to next question & save current
			
			$.ajax({
				type: 'post',
				url: 'ajax/savedata.php',
				data: "question="+qnumber+"&answer="+value,
				success: function (data) {
					
				}
			});
			
			if(addnew==1) {
				
				
				//$(this).attr("addnew", "0");
				$('.question_active').addClass('question_inactive');
				$('.question_active').addClass('bounce');
				$('.question_active').css({
					'transform': 'scale(0.75)'
				});
				
				if(condition==1) {
					
					//hide remove all other options after condition
					$(this).attr("addnew", "1");
					$(this).parent().nextAll(".question").hide();
					$(this).parent().show();
					var next = $(this).attr("next"+value); 
					var nextpagebtn = $(this).attr("nextpagebtn"+value);
				}
				
				$('.question_active').removeClass('question_active');
				$("#question_"+next).addClass('question_active');
				
				
				$("#question_"+next).show();
				$("#"+next).focus();
				
				if(nextpagebtn>0){
					$("#page-"+nextpagebtn+"-btn").show();
					$('.pagebtn_active').removeClass('pagebtn_active');
					$("#page-"+nextpagebtn+"-btn").addClass('pagebtn_active');
					$("#question_content").scrollTop($("#question_content")[0].scrollHeight);
				}
				
			} else {
				if(condition==1) { 
					var next = $(this).attr("next"+value); 
					var nextpagebtn = $(this).attr("nextpagebtn"+value);
				}
				
				$("#"+next).focus();
			}
			
		}
	}
});



$(document).on('blur', 'select', function(e){
	var autonext = $(this).attr("autonext");
	var qnumber  = $(this).attr("qnumber");
	var next     = $(this).attr("next");
	var addnew   = $(this).attr("addnew");
	var type     = $(this).attr("type");
	var condition= $(this).attr("condition");
	var optionSelected = $(this).find("option:selected");
	var nextpagebtn = $(this).attr("nextpagebtn");
	var value    = optionSelected.val();
	if(autonext==1) {
		var error = '';
		$("#error_"+qnumber).html("");
		if (value==0 || !value){
			error = "Please select correct option.";
			$("#error_"+qnumber).html(error);
			$(this).focus();
		} else {
			//go to next question & save current
			
			$.ajax({
				type: 'post',
				url: 'ajax/savedata.php',
				data: "question="+qnumber+"&answer="+value,
				success: function (data) {
					
				}
			});
			
			if(addnew==1) {
				
				
				//$(this).attr("addnew", "0");
				$('.question_active').addClass('question_inactive');
				$('.question_active').addClass('bounce');
				$('.question_active').css({
					'transform': 'scale(0.75)'
				});
				
				if(condition==1) {

					$(this).attr("addnew", "1");
					$(this).parent().nextAll(".question").hide();
					$(this).parent().show();
					var next = $(this).attr("next"+value); 
					var nextpagebtn = $(this).attr("nextpagebtn"+value);
				}
				
				$('.question_active').removeClass('question_active');
				$("#question_"+next).addClass('question_active');
				
				
				$("#question_"+next).show();
				$("#"+next).focus();
				
				if(nextpagebtn>0){
					$("#page-"+nextpagebtn+"-btn").show();
					$('.pagebtn_active').removeClass('pagebtn_active');
					$("#page-"+nextpagebtn+"-btn").addClass('pagebtn_active');
					$("#question_content").scrollTop($("#question_content")[0].scrollHeight);
				}
				
			} else {
				if(condition==1) { var next = $(this).attr("next"+value); }
				$("#"+next).focus();
			}
			
		}
	}
});


$(document).on('click', 'button', function(){
	var autonext = $(this).attr("autonext");
	var qnumber  = $(this).attr("qnumber");
	var next     = $(this).attr("next");
	var addnew   = $(this).attr("addnew");
	var type     = $(this).attr("type");
	var nextpagebtn = $(this).attr("nextpagebtn");
	var value    = $(this).val();
	if(autonext==1) {
		var error = '';
		
		//go to next question & save current
		if(addnew==1) {
			$(this).attr("addnew", "0");
			$('.question_active').addClass('question_inactive');
			$('.question_active').addClass('bounce');
			$('.question_active').css({
				'transform': 'scale(0.75)'
			});
			$("#question_"+next).show();
			$('.question_active').removeClass('question_active');
			$("#question_"+next).addClass('question_active');
			
			$("#"+next).focusTextToEnd();
			
			if(nextpagebtn>0){
				$("#page-"+nextpagebtn+"-btn").show();
				$('.pagebtn_active').removeClass('pagebtn_active');
				$("#page-"+nextpagebtn+"-btn").addClass('pagebtn_active');
				$("#question_content").scrollTop($("#question_content")[0].scrollHeight);
			}
			
		}
	}
});



function showpage(page) {
	$(".pactive").removeClass('pactive');
	$("#page-"+page).addClass('pactive');
	$("#page-"+page).show();
	
	//Save current page
	
	$.ajax({
		type: 'post',
		url: 'ajax/savepage.php',
		data: "page="+page,
		success: function (data) {
			
		}
	});
	
}




$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}