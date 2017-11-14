<?php
	$url = "http://www.payworks.mpymnt.com/";
	$html = file_get_contents($url);
	$dom = new DOMDocument();
	$dom->loadHTML($html);
	$xpath = new DOMXPath($dom);
	$div = $xpath->query('//ul[@class="sidebar-menu"]');
	$data = $div->item(0);
	$result = $dom->saveXML($data);
	
	$result.='
		<script>
		jQuery(function ($) {
			 $("#page-sidebar a").click(function(){
				$(".linkactive").removeClass("linkactive");
				$(this).addClass("linkactive");
				var url = $(this).attr("href");
				var url = "http://www.payworks.mpymnt.com"+url;
				
				$.ajax({
					type: "post",
					url: "https://www.360payments.com/velox/retail/page.php",
					data: "url="+url,
					success: function (data) {
						$("#page-content").html(data);
					}
				});
				
				return false;
			});
			
			
			$("#node-322 .panel a").click(function(){
				//$(".linkactive").removeClass("linkactive");
				//$(this).addClass("linkactive");
				var url = $(this).attr("href");
				var url = "http://www.payworks.mpymnt.com/"+url;
				
				$.ajax({
					type: "post",
					url: "https://www.360payments.com/velox/retail/page.php",
					data: "url="+url,
					success: function (data) {
						$("#page-content").html(data);
					}
				});
				
				return false;
			});
			
			
		});
		
		
		
		jQuery(document).ready(function() {

				var nav = jQuery(\'.sidebar-menu\');

				// Show for the currently active
				var $topTheActiveElement = jQuery(\'.sidebar-menu a.active\').parents(\'.block-menu\').find(\'span.first\');
				if($topTheActiveElement) {
					$topTheActiveElement.next().show();
					$topTheActiveElement.addClass(\'active-dropdown-first\');
					//jQuery(\'.sidebar-menu\').find(\'svg\').removeClass(\'svg-active\');
					//$this.parent().find(\'svg\').addClass(\'svg-active\');
				}


				nav.on(\'click\', \'span\', function() {
					jQuery(this).next().slideToggle();
					//jQuery(\'.home\').css(\'color\', \'#0d2048\');
				});

				function something($this) {
					if ($this.hasClass(\'active-dropdown-first\')) {
						$this.removeClass(\'active-dropdown-first\');
						$this.parent().find(\'svg\').removeClass(\'svg-active\');
					} else if (jQuery(\'.sidebar-menu span\').hasClass(\'active-dropdown\')) {
						hideMenuFirst();
						jQuery(\'.sidebar-menu span\').removeClass(\'active-dropdown active-dropdown-first\');
						$this.addClass(\'active-dropdown-first\');
						jQuery(\'.sidebar-menu\').find(\'svg\').removeClass(\'svg-active\');
						$this.parent().find(\'svg\').addClass(\'svg-active\');
						jQuery(\'.dropdown-second\').parent().find(\'svg\').removeClass(\'svg-active\');
					} else {
						hideMenuFirst();
						jQuery(\'.sidebar-menu span\').removeClass(\'active-dropdown active-dropdown-first\');
						$this.addClass(\'active-dropdown-first\');
						jQuery(\'.sidebar-menu\').find(\'svg\').removeClass(\'svg-active\');
						$this.parent().find(\'svg\').addClass(\'svg-active\');
						jQuery(\'.dropdown-second\').parent().find(\'svg\').removeClass(\'svg-active\');
					}
				}

				jQuery("span.first").click(function() {
					var $this = jQuery(this);
					something($this);
				});

				//function somethingElse($this) {
				//	if ($this.hasClass(\'active-dropdown\')) {
				//		$this.removeClass(\'active-dropdown\');
				//		$this.parent().find(\'svg\').removeClass(\'svg-active\').addClass(\'svg-normal\');
				//	} else {
				//		hideMenuSecond();
				//		jQuery(\'.sidebar-menu span\').removeClass(\'active-dropdown active-dropdown-first\');
				//		$this.addClass(\'active-dropdown\');
				//		jQuery(\'.sidebar-menu\').find(\'svg\').removeClass(\'svg-active\').addClass(\'svg-normal\');
				//		$this.parent().find(\'svg\').removeClass(\'svg-normal\').addClass(\'svg-active\');
				//	}
				//}
				//
				//jQuery(\'.sidebar-menu ul li\').on(\'click\', \'span\', function() {
				//	var $this = jQuery(this);
				 //   somethingElse($this);
				//});

				function hideMenuFirst() {
					if(jQuery(\'.sidebar-menu span\').hasClass(\'active-dropdown\')) {
						jQuery(\'.active-dropdown\').parent().parent().slideToggle();
						jQuery(\'.active-dropdown\').next().slideToggle();
					}
					if(jQuery(\'.sidebar-menu span\').hasClass(\'active-dropdown-first\')) {
						jQuery(\'.active-dropdown-first\').next().slideToggle();
					}
				}
				//function hideMenuSecond() {
				//	if(jQuery(\'.sidebar-menu span\').hasClass(\'active-dropdown\')) {
				//		jQuery(\'.active-dropdown\').next().slideToggle();
				//	}
				//}

				jQuery(document).ready(function() {

					var release = jQuery(\'.release-item button\');



					release.on(\'click\', function() {
						if (jQuery(this).next().css(\'display\') !== \'block\') {
							jQuery(this).find(\'svg:nth-child(1)\').css(\'display\', \'none\');
							jQuery(this).find(\'svg:nth-child(2)\').css(\'display\', \'inline-block\');
							jQuery(this).next().slideToggle();
						} else {
							jQuery(this).find(\'svg:nth-child(2)\').css(\'display\', \'none\');
							jQuery(this).find(\'svg:nth-child(1)\').css(\'display\', \'inline-block\');
							jQuery(this).next().slideToggle();
						}
					});


				});
			});
		</script>
	
	
	';
	echo $result;
?>