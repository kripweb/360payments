<?php
	$url = "";
	if(!empty($_POST['url'])){
		$url = $_POST['url'];
	}
	
	if(!$url){ $url="http://www.payworks.mpymnt.com/"; }
	$html = file_get_contents($url);
	$dom = new DOMDocument();
	$dom->loadHTML($html);
	$xpath = new DOMXPath($dom);
	$div = $xpath->query('//div[@class="section content-section"]');
	$data = $div->item(0);
	$result = $dom->saveXML($data);
	
	if($url="http://www.payworks.mpymnt.com/") {
		$result.='<script>
		jQuery(function ($) {
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
		</script>
	
	';
	}
	echo $result;
	
	

?>