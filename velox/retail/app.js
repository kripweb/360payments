	jQuery(function ($) {
		$.ajax({
			type: 'post',
			url: 'https://www.360payments.com/velox/retail/data.php',
			data: "",
			success: function (data) {
				$("#page-sidebar").html(data);
			}
		});
		
		
		$.ajax({
			type: 'post',
			url: 'https://www.360payments.com/velox/retail/page.php',
			data: "",
			success: function (data) {
				$("#page-content").html(data);
			}
		});
		
	});
	
	
	
	
	