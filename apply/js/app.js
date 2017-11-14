$(document).ready(function(){
	var optionSelected = $("#158").find("option:selected");
	var value    = optionSelected.val();
	
	if(value==0){
		$("#q159").hide();
		$("#q160").hide();
		$("#q158a").hide();
		$("#q158b").hide();
	}
	
	if(value==1){
		$("#q159").hide();
		$("#q160").hide();
		$("#q158a").hide();
		$("#q158b").hide();
	}
	
	if(value==2){
		$("#q159").hide();
		$("#q160").hide();
		$("#q158a").hide();
		$("#q158b").hide();
	}
	
	if(value==3){
		$("#159").html($("#b1").html());
		$("#q159").show();
		$("#q160").show();
		$("#q158a").hide();
		$("#q158b").hide();
	}
	
	if(value==4){
		$("#159").html($("#b2").html());
		$("#q159").show();
		$("#q160").show();
		$("#q158a").hide();
		$("#q158b").hide();
	}
	
	if(value==5){
		$("#q159").hide();
		$("#q160").hide();
		$("#q158a").hide();
		$("#q158b").hide();
	}
	
	if(value==6){
		$("#159").html($("#b3").html());
		$("#q159").show();
		$("#q160").show();
		$("#q158a").hide();
		$("#q158b").hide();
	}
	
	if(value==7){
		$("#q159").hide();
		$("#q160").hide();
		$("#q158a").hide();
		$("#q158b").hide();
	}
	
	if(value==8){
		$("#159").html($("#b4").html());
		$("#q159").show();
		$("#q160").show();
		$("#q158a").hide();
		$("#q158b").hide();
	}
	
	if(value==9){
		$("#q159").hide();
		
		
		$("#q158a").show();
		$("#q158b").show();
		$("#q160").show();
	}
	
	
	
	//New required function
	$("#92").change(function() {
		var value = $("#92").find("option:selected").val();
		
		if(value==1){
			$("#93").addClass("required2");
			$("#94").addClass("required2");
		} else {
			$("#93").removeClass("required2");
			$("#94").removeClass("required2");
		}
	});
	
	
	$("#96").change(function() {
		var value = $("#96").find("option:selected").val();
		
		if(value==1){
			$("#97").addClass("required2");
			
		} else {
			$("#97").removeClass("required2");
			
		}
	});
	
	
	$("#120").change(function() {
		var value = $("#120").find("option:selected").val();
		
		if(value==1){
			$("#122").addClass("required2");
			
		} else {
			$("#122").removeClass("required2");
			
		}
	});
	
	
	$("#121").change(function() {
		var value = $("#121").find("option:selected").val();
		
		if(value==1){
			$("#122a").addClass("required2");
			
		} else {
			$("#122a").removeClass("required2");
			
		}
	});
	
	
	$("#155").change(function() {
		var value = $("#155").find("option:selected").val();
		
		if(value==1){
			$("#156").addClass("required2");
			
		} else {
			$("#156").removeClass("required2");
			
		}
	});
	if($('#n1').val()){ $('#n1').attr('size', $('#n1').val().length); }
	if($('#113').val()) { $('#113').attr('size', $('#113').val().length); }
	
	
	
});



$(function(){
	$('#113,#n1').keyup(function() {
		$(this).attr('size', $(this).val().length);
	});
});


$(document).on('change', 'select', function(){
	var show     = $(this).attr("show");
	var check    = $(this).attr("check");
	var showon   = $(this).attr("showon");
	var condition = $(this).attr("condition");
	var optionSelected = $(this).find("option:selected");
	var value    = optionSelected.val();
	if(condition==1) {
		if(check>0){
			var coptionSelected = $("#"+check).find("option:selected");
			var cvalue    = coptionSelected.val();
			
			if(showon==value || showon==cvalue){
				$("#question_"+show).show();
			} else {
				$("#question_"+show).hide();
			}
		} else {
			if(showon==value){
				$("#question_"+show).show();
			} else {
				$("#question_"+show).hide();
			}
		}
	}
});

function showerror(ele){
	$(ele).addClass("rerror");
	$('#errorModal').modal('show')
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

	
    $(".next-step1").click(function (e) {
		
		var q80 = $("#80").val();
		
		var q81a = $("#81a").find("option:selected").val();
		var q81 = $("#81").val();
		
		var q82 = $("#82").val();
		var q82a = $("#82a").val();
		var q82b = $("#82b").val();
		var q82c = $("#82c").val();
		var q82d = $("#82d").val();
		
		var q83p = $("#83p").find("option:selected").val();
		var q83 = $("#83").val();
		var q83a = $("#83a").val();
		var q83b = $("#83b").val();
		var q83c = $("#83c").val();
		var q83d = $("#83d").val();
		
		var q84 = $("#84").val();
		var q85a = $("#85a").val();
		var qn1 = $("#n1").val();
		
		var error=0;
		
		if(!q80){
			showerror("#80");
			error=1;
		}
		
		if(q81a==0){
			showerror("#81a");
			error=1;
		}
		
		if(q81a==1 && !q81){
			showerror("#81");
			error=1;
		}
		
		if(!q82){
			showerror("#82");
			error=1;
		}
		
		if(!q82b){
			showerror("#82b");
			error=1;
		} 
		
		if(!q82c){
			showerror("#82c");
			error=1;
		} 
		
		if(!q82d){
			showerror("#82d");
			error=1;
		} 
		
		if(q83p==0){
			showerror("#83p");
			error=1;
		}
		
		if(q83p==2 && !q83){
			showerror("#83");
			error=1;
		} 
		
		if(q83p==2 && !q83b){
			showerror("#83b");
			error=1;
		}
		
		if(q83p==2 && !q83c){
			showerror("#83c");
			error=1;
		} 
		
		if(q83p==2 && !q83d){
			showerror("#83d");
			error=1;
		} 
		
		if(!q84){
			showerror("#84");
			error=1;
		} 
		
		if(!q85a){
			showerror("#85a");
			error=1;
		} 
		
		if(!qn1){
			showerror("#n1");
			error=1;
		} 
		
		if(!error || error==0){
			
			$(".rerror").each(function( ) {
				$(this).removeClass('rerror');
			});
			
			var $active = $('.wizard .nav-tabs li.active');
			$active.next().removeClass('disabled');
			nextTab($active);
			window.scrollTo(0,0);
		}
    });
	
	$(".next-step2").click(function (e) {
		var error = 0;
		$("input.required2").each(function(){
			var value = $(this).val();
			if(!value || value==''){
				showerror(this);
				error=1;
			}
		});
		
		
		$("select.required2").each(function(){
			var value = $(this).find("option:selected").val();
			if(!value || value==0){
				showerror(this);
				error=1;
			}
		});
		
		
		var q105a = $("#105a").val();
		var q105b = $("#105b").val();
		var q105c = $("#105c").val();
		var q105d = $("#105d").val();
		var q105e = $("#105e").val();
		var q105f = $("#105f").val();
		var q105g = $("#105g").val();
		var q105h = $("#105h").val();
		var q105i = $("#105i").val();
		var q105j = $("#105j").val();
		
		if(!q105a && !q105b && !q105c && !q105d && !q105e && !q105f && !q105g && !q105h && !q105i && !q105j){
			$("#error_105").html("Select minimum one option.");
			error=1;
		}
		
		var q103 = $("#103").find("option:selected").val();
		var q104a = $("#104a").val();
		var q104b = $("#104b").val();
		var q104c = $("#104c").val();
		var q104d = $("#104d").val();
		var q104e = $("#104e").val();
		var q104f = $("#104f").val();
		var q104g = $("#104g").val();
		var q104h = $("#104h").val();
		var q104i = $("#104i").val();
		var q104j = $("#104j").val();
		var q104k = $("#104k").val();
		var q104l = $("#104l").val();
		
		if(q103==1 && !q104a && !q104b && !q104c && !q104d && !q104e && !q104f && !q104g && !q104h && !q104i && !q104j && !q104k && !q104l){
			$("#error_104").html("Select minimum one option.");
			error=1;
		}
		
        if(!error || error==0){
			
			$("#error_105").html("");
			$("#error_104").html("");
			
			$(".rerror").each(function( ) {
				$(this).removeClass('rerror');
			});
			
			var $active = $('.wizard .nav-tabs li.active');
			$active.next().removeClass('disabled');
			nextTab($active);
			window.scrollTo(0,0);
		}

    });
	
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);
		window.scrollTo(0,0);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}

var site_url = "https://www.360payments.com/apply"

function save(){
	/*
	var q4 = $("#4").val();
	var q5 = $("#5").val();
	var q16 = $("#16").find("option:selected").val();
	var q80 = $("#80").val();
	var q81 = $("#81").val();
	var q82 = $("#82").val();
	var q82a = $("#82a").val();
	var q82b = $("#82b").val();
	var q82c = $("#82c").val();
	var q82d = $("#82d").val();
	var q83 = $("#83").val();
	var q83a = $("#83a").val();
	var q83b = $("#83b").val();
	var q83c = $("#83c").val();
	var q83d = $("#83d").val();
	var q84 = $("#84").val();
	var q85 = $("#85").val();
	*/
	
	$.ajax({
		type: "post",
		url: site_url+"/ajax/saveform.php",
		data: $("#mainform").serialize(),
		dataType: "JSON",
		success: function (data) {
			if(data.error==1){
				console.log("success");
			}
			else{
				
				console.log(data.error);
				
			}
		}
	});
	
}


function saveClose(){
	$.ajax({
		type: "post",
		url: site_url+"/ajax/saveform.php",
		data: $("#mainform").serialize(),
		dataType: "JSON",
		success: function (data) {
			if(data.error==1){
				console.log("success");
				window.location.href = site_url+'/saved/';
			}
			else{
				
				console.log(data.error);
				
			}
		}
	});
}


jQuery(function($) {
  $('input[type="file"]').change(function() {
    if ($(this).val()) {
         var filename = $(this).val();
		 filename = filename.split('/').pop();
		 filename = filename.split('\\').pop();
         $(this).closest('.media-body').find('.custom-file-upload').html('<i class="glyphicon glyphicon-paperclip mr-5"></i>'+filename);
    }
  });
});


function PhysicalAddress(){
	var optionSelected = $("#83p").find("option:selected");
	var value    = optionSelected.val();
	
	if(value==1){
		$("#83").val($("#82").val());
		$("#83a").val($("#82a").val());
		$("#83b").val($("#82b").val());
		$("#83c").val($("#82c").val());
		$("#83d").val($("#82d").val());
		$("#sphysical").hide();
		
	} else {
		
		$("#83").val("");
		$("#83a").val("");
		$("#83b").val("");
		$("#83c").val("");
		$("#83d").val("");
		$("#sphysical").show();
	}
}


function total100(){
	var v98 = $("#98").val();
	var v99 = $("#99").val();
	var v100 = $("#100").val();
	var v101 = $("#101").val();
	
	if(!v98){v98=0;}
	if(!v99){v99=0;}
	if(!v101){v101=0;}
	if(!v100){v100=0;}
	
	var total = parseInt(v98)+parseInt(v99)+parseInt(v100)+parseInt(v101);
	if(total>=100){
		$("#98").val(v98);
		$("#99").val(v99);
		$("#100").val(v100);
		$("#101").val(v101);
	}
	$("#total100").html(total+" %");
}

function change15(){
	var optionSelected = $("#91").find("option:selected");
	var value    = optionSelected.val();
	
	if(value==1){
		
		var data ='<option value="0" ></option><option value="1" >EIN</option><option value="2" >SSN</option><option value="3" >ITIN</option>';
		$("#110").html(data);
		
	} else {
		var data ='<option value="1" >EIN</option>';
		$("#110").html(data);
	}
}



function resizeInput() {
    $(this).attr('size', $(this).val().length);
}


function removedoc(id) {
	$("#"+id).show();
	$("#doc"+id).hide();
	$.ajax({
		type: "post",
		url: site_url+"/ajax/removedoc.php",
		data: "id="+id,
		dataType: "JSON",
		success: function (data) {
			if(data.error==1){
				console.log("deleted");
			}
			else{
				
				console.log(data.error);
				
			}
		}
	});
}

function SelectBranch(){
	var optionSelected = $("#158").find("option:selected");
	var value    = optionSelected.val();
	
	if(value==0){
		$("#q159").hide();
		$("#q160").hide();
		$("#q158a").hide();
		$("#q158b").hide();
		
		$("#q159").removeClass("required2");
		$("#q160").removeClass("required2");
		$("#q158a").removeClass("required2");
		$("#q158b").removeClass("required2");
	}
	
	if(value==1){
		$("#q159").hide();
		$("#q160").hide();
		$("#q158a").hide();
		$("#q158b").hide();
		
		$("#q159").removeClass("required2");
		$("#q160").removeClass("required2");
		$("#q158a").removeClass("required2");
		$("#q158b").removeClass("required2");
	}
	
	if(value==2){
		$("#q159").hide();
		$("#q160").hide();
		$("#q158a").hide();
		$("#q158b").hide();
		
		$("#q159").removeClass("required2");
		$("#q160").removeClass("required2");
		$("#q158a").removeClass("required2");
		$("#q158b").removeClass("required2");
	}
	
	if(value==3){
		$("#159").html($("#b1").html());
		$("#q159").show();
		$("#q160").show();
		$("#q158a").hide();
		$("#q158b").hide();
		
		$("#q159").addClass("required2");
		$("#q160").addClass("required2");
		$("#q158a").removeClass("required2");
		$("#q158b").removeClass("required2");
	}
	
	if(value==4){
		$("#159").html($("#b2").html());
		$("#q159").show();
		$("#q160").show();
		$("#q158a").hide();
		$("#q158b").hide();
		
		$("#q159").addClass("required2");
		$("#q160").addClass("required2");
		$("#q158a").removeClass("required2");
		$("#q158b").removeClass("required2");
	}
	
	if(value==5){
		$("#q159").hide();
		$("#q160").hide();
		$("#q158a").hide();
		$("#q158b").hide();
		
		$("#q159").removeClass("required2");
		$("#q160").removeClass("required2");
		$("#q158a").removeClass("required2");
		$("#q158b").removeClass("required2");
	}
	
	if(value==6){
		$("#159").html($("#b3").html());
		$("#q159").show();
		$("#q160").show();
		$("#q158a").hide();
		$("#q158b").hide();
		
		$("#q159").addClass("required2");
		$("#q160").addClass("required2");
		$("#q158a").removeClass("required2");
		$("#q158b").removeClass("required2");
	}
	
	if(value==7){
		$("#q159").hide();
		$("#q160").hide();
		$("#q158a").hide();
		$("#q158b").hide();
		
		$("#q159").removeClass("required2");
		$("#q160").removeClass("required2");
		$("#q158a").removeClass("required2");
		$("#q158b").removeClass("required2");
	}
	
	if(value==8){
		$("#159").html($("#b4").html());
		$("#q159").show();
		$("#q160").show();
		$("#q158a").hide();
		$("#q158b").hide();
		
		$("#q159").addClass("required2");
		$("#q160").addClass("required2");
		$("#q158a").removeClass("required2");
		$("#q158b").removeClass("required2");
	}
	
	if(value==9){
		$("#q159").hide();
		
		
		$("#q158a").show();
		$("#q158b").show();
		$("#q160").show();
		
		$("#q159").removeClass("required2");
		$("#q160").removeClass("required2");
		$("#q158a").removeClass("required2");
		$("#q158b").removeClass("required2");
	}
}


function ssn(){
	var optionSelected = $("#110").find("option:selected");
	var value    = optionSelected.val();
	if(value==2) {
		var n2a = $("#n2a").val();
		
		if(!n2a) {
			$("#n2a").val($("#109").val());
		}
	}
}
	


