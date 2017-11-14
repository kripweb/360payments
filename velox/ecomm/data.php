<?php
	$url = "https://secure.networkmerchants.com/gw/merchants/resources/integration/integration_portal.php#integration_overview";
	$html = file_get_contents($url);
	$html = str_replace("download.php?", "https://secure.networkmerchants.com/gw/merchants/resources/integration/download.php?", $html);
	$html = str_replace("color:red;", "", $html);
	$html = str_replace("font-weight:bold;", "font-weight:bold", $html);
	$html = str_replace("font-weight:bold", "font-weight:bold;color:#78ac41;", $html);
	$dom = new DOMDocument();
	$dom->loadHTML($html);
	$xpath = new DOMXPath($dom);
	$div = $xpath->query('//div[@class="main_content"]');
	foreach ($div as $rowNode) {
		$data = $rowNode;
		$result = $dom->saveXML($data);
		echo $result;
	}
	
	echo '
	
	<script>
		jQuery(function ($) {
			function hashChanged(hash) {
				$(".current_content").toggleClass("content").toggleClass("current_content");
				$(hash).toggleClass("content").toggleClass("current_content");
				$(".active").toggleClass("active");
				$("a[href=\'" + hash + "\']").toggleClass("active");
			}
			if (window.location.hash) {
				hashChanged(window.location.hash);
			}
			if ("onhashchange" in window) {
				window.onhashchange = function() {
					hashChanged(window.location.hash);
				}
			} else {
				var storedHash = window.location.hash;
				window.setInterval(function() {
					if (window.location.hash != storedHash) {
						storedHash = window.location.hash;
						hashChanged(storedHash);
					}
				}, 100);
			}
			$(".view > a").click(function() {
				$(".active").toggleClass("active");
				$(this).toggleClass("active");
			});
			$(".folder > a.expanded + ul").slideToggle("fast");
			$(".folder > a").click(function() {
				if (!$(this).hasClass("expanded")) {
					$(".folder > a.expanded").toggleClass("expanded").toggleClass("collapsed").parent().find(\'> ul\').slideToggle("fast");
				}
				$(this).toggleClass("expanded").toggleClass("collapsed").parent().find(\'> ul\').slideToggle("fast");
			});
			$(".subfolder > a.expanded + ul").slideToggle("fast");
			$(".subfolder > a").click(function() {
				$(this).toggleClass("expanded").toggleClass("collapsed").parent().find(\'> ul\').slideToggle("fast");
			});
			$(".menu_link").click(function() {
				$(".current_content").toggleClass("content").toggleClass("current_content");
				var section = $(this).attr("href");
				$(section).toggleClass("content").toggleClass("current_content");
			});
			
			hljs.initHighlightingOnLoad();
			
		});
	</script>
	
	';
?>