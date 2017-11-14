	jQuery(function ($) {
		$.ajax({
			type: 'post',
			url: 'https://www.360payments.com/velox/ecomm/data.php',
			data: "",
			success: function (data) {
				$("#velox-ecomm").html(data);
			}
		});
		
		
	});
	
	
	