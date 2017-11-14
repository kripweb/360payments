$( document ).ready(function() {
	$('.form').find('input, textarea').on('keyup blur focus', function (e) {
	  
		var $this = $(this),
		 label = $this.prev('label');

		 
		if ($this.val() === '') {
		  label.removeClass('active highlight');
		} else {
		  label.addClass('active highlight');
		}
			

	});
	
	
	$('.form').find('input, textarea').on('change', function (e) {
	  
		 var $this = $(this),
		 label = $this.prev('label');
		 
		 if ($this.val() === '') {
		  label.removeClass('active highlight');
		} else {
		  label.addClass('active highlight');
		}

	});

	$('.tab a').on('click', function (e) {
	  
	  e.preventDefault();
	  
	  $(this).parent().addClass('active');
	  $(this).parent().siblings().removeClass('active');
	  
	  target = $(this).attr('href');

	  $('.tab-content > div').not(target).hide();
	  
	  $(target).fadeIn(600);
	  
	});

});